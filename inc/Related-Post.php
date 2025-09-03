<?php
/**
 * 
 * @package Arul_New_Theme
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/* -------------------------------------------------------------------------
 *  NAZROEL RELATED (Berita Terkait) POSTS FUNCTIONALITY
 * ---------------------------------------------------------------------- */
    
/**
 * @param int $post_id ID post yang sedang dibuka
 * @param int $number Jumlah artikel terkait yang ingin ditampilkan
 * @return WP_Query|false Query object atau false jika tidak ada hasil
 */
function nazroel_get_related_posts( $post_id = null, $number = 4 ) {
    if ( ! $post_id ) {
        $post_id = get_the_ID();
    }
    
    // ===== CACHING SYSTEM =====
    // Menggunakan transient WordPress untuk cache hasil query
    // Cache ini meningkatkan performa dengan menyimpan hasil selama 2 jam
    $cache_key = 'nazroel_related_posts_' . $post_id . '_' . $number;
    $related_posts = get_transient( $cache_key );
    
    if ( false === $related_posts ) {
        // ===== MENGAMBIL TAXONOMY DARI POST SAAT INI =====
        // wp_get_post_categories() - mengambil semua kategori dari post
        // wp_get_post_tags() - mengambil semua tag dari post
        $categories = wp_get_post_categories( $post_id );
        $tags = wp_get_post_tags( $post_id );
        
        // ===== SETUP BASE QUERY ARGUMENTS =====
        // Args dasar untuk WP_Query yang akan digunakan di semua prioritas
        $args = array(
            'post_type'              => 'post',                    // Hanya ambil post type 'post'
            'post_status'            => 'publish',                 // Hanya post yang sudah dipublikasi
            'posts_per_page'         => $number,                   // Jumlah post yang diminta
            'post__not_in'           => array( $post_id ),         // Exclude post saat ini agar tidak muncul di related
            'orderby'                => 'date',                    // Urutkan berdasarkan tanggal
            'order'                  => 'DESC',                    // Dari yang terbaru
            'no_found_rows'          => true,                      // Skip penghitungan total rows untuk performa
            'update_post_meta_cache' => false,                     // Skip cache meta untuk performa
            'update_post_term_cache' => false,                     // Skip cache term untuk performa
        );
        
        // ===== PRIORITAS 1: CARI BERDASARKAN KATEGORI DAN TAG =====
        // Jika post memiliki baik kategori maupun tag, cari post yang memiliki salah satunya
        if ( ! empty( $categories ) && ! empty( $tags ) ) {
            // wp_list_pluck() - mengambil field term_id dari array objek tag
            $tag_ids = wp_list_pluck( $tags, 'term_id' );
            
            // tax_query dengan relation 'OR' - post yang memiliki kategori ATAU tag yang sama
            $args['tax_query'] = array(
                'relation' => 'OR',  // Kondisi OR: kategori ATAU tag yang sama
                array(
                    'taxonomy' => 'category',           // Query berdasarkan kategori
                    'field'    => 'term_id',           // Gunakan term_id sebagai identifier
                    'terms'    => $categories,          // Array ID kategori dari post saat ini
                ),
                array(
                    'taxonomy' => 'post_tag',           // Query berdasarkan tag
                    'field'    => 'term_id',           // Gunakan term_id sebagai identifier
                    'terms'    => $tag_ids,             // Array ID tag dari post saat ini
                )
            );
            
            // Eksekusi query pertama dengan WP_Query
            $related_posts = new WP_Query( $args );
        }
        
        // ===== PRIORITAS 2: JIKA HASIL KURANG, CARI BERDASARKAN KATEGORI SAJA =====
        // Backup query jika hasil prioritas 1 tidak mencukupi atau hanya ada kategori
        if ( ( ! isset( $related_posts ) || $related_posts->post_count < $number ) && ! empty( $categories ) ) {
            
            // tax_query hanya berdasarkan kategori (lebih spesifik)
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'category',           // Hanya cari berdasarkan kategori
                    'field'    => 'term_id',           
                    'terms'    => $categories,          // Kategori dari post saat ini
                )
            );
            
            // Jika sudah ada hasil dari prioritas 1, tambahkan ke exclusion list
            if ( isset( $related_posts ) && $related_posts->post_count > 0 ) {
                // wp_list_pluck() - ambil field ID dari array objek post
                $existing_ids = wp_list_pluck( $related_posts->posts, 'ID' );
                
                // Exclude post saat ini DAN post yang sudah didapat sebelumnya
                $args['post__not_in'] = array_merge( array( $post_id ), $existing_ids );
                
                // Kurangi jumlah yang dicari sesuai yang sudah didapat
                $args['posts_per_page'] = $number - $related_posts->post_count;
                
                // Query tambahan untuk melengkapi hasil
                $additional_posts = new WP_Query( $args );
                
                // Gabungkan hasil prioritas 1 + prioritas 2
                $related_posts->posts = array_merge( $related_posts->posts, $additional_posts->posts );
                $related_posts->post_count += $additional_posts->post_count;
            } else {
                // Jika prioritas 1 tidak ada hasil, jalankan query kategori sebagai yang pertama
                $related_posts = new WP_Query( $args );
            }
        }
        
        // ===== PRIORITAS 3: FALLBACK - POST TERBARU =====
        // Jika hasil masih kurang dari yang diminta, ambil post terbaru sebagai fallback
        if ( ! isset( $related_posts ) || $related_posts->post_count < $number ) {
            $remaining = $number - ( isset( $related_posts ) ? $related_posts->post_count : 0 );
            
            // Args untuk fallback query (tanpa filter kategori/tag)
            $fallback_args = array(
                'post_type'              => 'post',
                'post_status'            => 'publish',
                'posts_per_page'         => $remaining,            // Sisa yang dibutuhkan
                'post__not_in'           => array( $post_id ),     // Exclude post saat ini
                'orderby'                => 'date',                // Berdasarkan tanggal terbaru
                'order'                  => 'DESC',
                'no_found_rows'          => true,
                'update_post_meta_cache' => false,
                'update_post_term_cache' => false,
            );
            
            // Jika sudah ada hasil sebelumnya, exclude juga post tersebut
            if ( isset( $related_posts ) && $related_posts->post_count > 0 ) {
                $existing_ids = wp_list_pluck( $related_posts->posts, 'ID' );
                $fallback_args['post__not_in'] = array_merge( array( $post_id ), $existing_ids );
                
                // Query fallback untuk melengkapi
                $fallback_posts = new WP_Query( $fallback_args );
                
                // Gabungkan dengan hasil sebelumnya
                $related_posts->posts = array_merge( $related_posts->posts, $fallback_posts->posts );
                $related_posts->post_count += $fallback_posts->post_count;
            } else {
                // Jika belum ada hasil sama sekali, gunakan fallback sebagai hasil utama
                $related_posts = new WP_Query( $fallback_args );
            }
        }
        
        // ===== SIMPAN HASIL KE CACHE =====
        // set_transient() - menyimpan data ke cache dengan expire time 2 jam
        // Cache ini akan otomatis dihapus saat ada post baru/update
        set_transient( $cache_key, $related_posts, 2 * HOUR_IN_SECONDS );
    }
    
    return $related_posts;
}

/**
 * Menampilkan artikel terkait dengan HTML yang sudah terstruktur
 * Fungsi ini menghasilkan output HTML lengkap untuk section related posts
 * 
 * @param int $number Jumlah artikel yang ditampilkan (default: 4)
 * @param string $title Judul section (default: "Artikel Terkait")
 */
function nazroel_display_related_posts( $number = 4, $title = 'Artikel Terkait' ) {
    // is_single() - cek apakah halaman saat ini adalah single post
    // Hanya tampilkan di single post untuk menghindari tampil di halaman lain
    if ( ! is_single() ) {
        return;
    }
    
    // Panggil fungsi untuk mendapatkan related posts
    $related_posts = nazroel_get_related_posts( get_the_ID(), $number );
    
    // Jika tidak ada hasil atau query gagal, keluar dari fungsi
    if ( ! $related_posts || ! $related_posts->have_posts() ) {
        return;
    }
    
    ?>
    <section class="related-posts-section" aria-label="Artikel Terkait">
        <!-- Header Section -->
        <div class="related-posts-header">
            <h3 class="related-posts-title">
                <i class="related-icon">📚</i>
                <?php echo esc_html( $title ); ?>
            </h3>
            <p class="related-posts-subtitle">
                Baca juga artikel lainnya yang mungkin Anda tertarik
            </p>
        </div>
        
        <!-- Grid Articles -->
        <div class="related-posts-grid">
            <?php 
            // ===== LOOP THROUGH RELATED POSTS =====
            // have_posts() & the_post() - WordPress loop standar untuk iterasi post
            while ( $related_posts->have_posts() ) : 
                $related_posts->the_post();
                ?>
                <article class="related-post-item">
                    <!-- Thumbnail -->
                    <div class="related-post-thumbnail">
                        <a href="<?php the_permalink(); ?>" 
                           title="<?php echo esc_attr( get_the_title() ); ?>"
                           aria-label="Baca artikel: <?php echo esc_attr( get_the_title() ); ?>">
                            <?php 
                            // has_post_thumbnail() - cek apakah post memiliki featured image
                            if ( has_post_thumbnail() ) {
                                // the_post_thumbnail() - tampilkan featured image dengan size custom
                                the_post_thumbnail( 'arul-featured-small', array(
                                    'class' => 'related-post-image',
                                    'alt'   => get_the_title(),
                                    'loading' => 'lazy'  // Lazy loading untuk performa
                                ) );
                            } else {
                                // Default placeholder jika tidak ada thumbnail
                                ?>
                                <div class="related-post-placeholder">
                                    <span class="placeholder-icon">📱</span>
                                </div>
                                <?php
                            }
                            ?>
                            <!-- Overlay dengan kategori -->
                            <?php 
                            // get_the_category() - mengambil kategori dari post dalam loop
                            $categories = get_the_category();
                            if ( ! empty( $categories ) ) :
                            ?>
                                <span class="related-post-category">
                                    <?php echo esc_html( $categories[0]->name ); ?>
                                </span>
                            <?php endif; ?>
                        </a>
                    </div>
                    
                    <!-- Content -->
                    <div class="related-post-content">
                        <!-- Meta Info -->
                        <div class="related-post-meta">
                            <span class="related-post-date">
                                <i class="meta-icon">📅</i>
                                <?php echo get_the_date( 'M j, Y' ); ?>
                            </span>
                            <span class="related-post-reading-time">
                                <i class="meta-icon">⏱️</i>
                                <?php 
                                // ===== KALKULASI WAKTU BACA =====
                                // get_the_content() - ambil konten lengkap post
                                // strip_tags() - hilangkan HTML tags untuk hitung kata
                                // str_word_count() - hitung jumlah kata
                                $word_count = str_word_count( strip_tags( get_the_content() ) );
                                // Asumsi: 200 kata per menit (standar reading speed)
                                $reading_time = max( 1, ceil( $word_count / 200 ) );
                                echo $reading_time . ' min';
                                ?>
                            </span>
                        </div>
                        
                        <!-- Title -->
                        <h4 class="related-post-title">
                            <a href="<?php the_permalink(); ?>" 
                               title="<?php echo esc_attr( get_the_title() ); ?>">
                                <?php 
                                // Batasi judul maksimal 60 karakter untuk konsistensi tampilan
                                $title = get_the_title();
                                echo esc_html( strlen( $title ) > 60 ? substr( $title, 0, 57 ) . '...' : $title );
                                ?>
                            </a>
                        </h4>
                        
                        <!-- Excerpt -->
                        <div class="related-post-excerpt">
                            <?php 
                            // ===== CUSTOM EXCERPT UNTUK RELATED POSTS =====
                            // get_the_excerpt() - ambil excerpt/ringkasan post
                            // Batasi panjang excerpt khusus untuk tampilan related posts
                            $excerpt = get_the_excerpt();
                            if ( strlen( $excerpt ) > 100 ) {
                                $excerpt = substr( $excerpt, 0, 97 ) . '...';
                            }
                            echo esc_html( $excerpt );
                            ?>
                        </div>
                        
                        <!-- Read More Link -->
                        <div class="related-post-footer">
                            <a href="<?php the_permalink(); ?>" 
                               class="related-read-more"
                               title="Baca selengkapnya: <?php echo esc_attr( get_the_title() ); ?>">
                                Baca Selengkapnya
                                <span class="read-more-arrow">→</span>
                            </a>
                        </div>
                    </div>
                </article>
                <?php
            endwhile;
            
            // ===== RESET POST DATA =====
            // wp_reset_postdata() - kembalikan global $post ke post asli setelah custom query
            // Ini PENTING untuk mencegah masalah pada template tags lainnya
            wp_reset_postdata();
            ?>
        </div>
        
        <!-- Link ke halaman blog jika ingin melihat lebih banyak -->
        <div class="related-posts-footer">
            <a href="<?php echo home_url('/blog/'); ?>" 
               class="view-all-posts">
                <span class="view-all-icon">📖</span>
                Lihat Semua Artikel
                <span class="view-all-arrow">→</span>
            </a>
        </div>
    </section>
    <?php
}

/**
 * Menghapus cache related posts ketika ada perubahan pada post
 * Fungsi ini dipanggil otomatis saat post disimpan/dihapus untuk menjaga cache tetap fresh
 * 
 * @param int $post_id ID post yang diupdate/delete
 */
function nazroel_clear_related_posts_cache( $post_id ) {
    // get_post_type() - cek tipe post, hanya proses untuk post type 'post'
    if ( get_post_type( $post_id ) !== 'post' ) {
        return;
    }
    
    // ===== HAPUS CACHE UNTUK POST YANG BERSANGKUTAN =====
    // Hapus beberapa variasi cache yang mungkin ada (number 3, 4, 6)
    $cache_keys = array(
        'nazroel_related_posts_' . $post_id . '_4',    // Default 4 artikel
        'nazroel_related_posts_' . $post_id . '_3',    // Jika ada yang minta 3 artikel
        'nazroel_related_posts_' . $post_id . '_6',    // Jika ada yang minta 6 artikel
    );
    
    // delete_transient() - hapus data cache dari database
    foreach ( $cache_keys as $cache_key ) {
        delete_transient( $cache_key );
    }
    
    // ===== ADVANCED: HAPUS CACHE POST LAIN YANG MUNGKIN TERPENGARUH =====
    // Untuk optimasi lebih lanjut, bisa ditambahkan logic untuk menghapus cache 
    // berdasarkan kategori/tag yang sama, tapi ini bisa membuat overhead
    // Implementasi saat ini sudah cukup efisien untuk most cases
}

/**
 * Shortcode untuk menampilkan related posts di mana saja
 * Memungkinkan penggunaan related posts melalui shortcode di editor
 * 
 * Usage: [nazroel_related_posts number="6" title="Artikel Lainnya"]
 * 
 * @param array $atts Attribut shortcode
 * @return string HTML output dari related posts
 */
function nazroel_related_posts_shortcode( $atts ) {
    // ===== SHORTCODE ATTRIBUTES PROCESSING =====
    // shortcode_atts() - menggabungkan user attributes dengan default values
    $atts = shortcode_atts( array(
        'number' => 4,                    // Default 4 artikel
        'title'  => 'Artikel Terkait',   // Default title
    ), $atts, 'nazroel_related_posts' );
    
    // ===== OUTPUT BUFFERING =====
    // ob_start() - mulai output buffering untuk capture HTML
    ob_start();
    
    // Call the display function dengan parameter yang sudah di-sanitize
    nazroel_display_related_posts( 
        (int) $atts['number'],                    // Cast ke integer untuk keamanan
        sanitize_text_field( $atts['title'] )    // Sanitasi input title
    );
    
    // ob_get_clean() - ambil buffered content dan bersihkan buffer
    return ob_get_clean();
}

/* -------------------------------------------------------------------------
 *  REGISTER HOOKS & SHORTCODES
 * ---------------------------------------------------------------------- */

// Hook untuk menghapus cache saat post diupdate/delete
add_action( 'save_post', 'nazroel_clear_related_posts_cache' );      // Saat post disimpan/update
add_action( 'delete_post', 'nazroel_clear_related_posts_cache' );    // Saat post dihapus permanent
add_action( 'wp_trash_post', 'nazroel_clear_related_posts_cache' );  // Saat post dipindah ke trash

// Register shortcode untuk related posts
add_shortcode( 'nazroel_related_posts', 'nazroel_related_posts_shortcode' );
