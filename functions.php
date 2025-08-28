<?php

/**
 * Fungsi-fungsi Tema Arul New Theme
 *
 * @package Arul_New_Theme
 */


 /* -------------------------------------------------------------------------
 *  Enqueue styles & scripts
 * ---------------------------------------------------------------------- */

// Fungsi untuk memuat stylesheet (CSS) dan script (JavaScript) tema.
function arul_new_theme_scripts() {
    // Memuat style.css utama tema.
    // Ini adalah stylesheet utama yang berisi informasi tema dan CSS dasar.
    wp_enqueue_style( 'arul-new-theme-style', get_stylesheet_uri() );

    // Memuat main.css dari folder assets/css.
    // Ini adalah tempat kamu akan menaruh sebagian besar CSS kustom kamu.
    wp_enqueue_style( 'arul-new-theme-main-style', get_template_directory_uri() . '/assets/css/main.css', array(), '1.0.0', 'all' );

    // Memuat script.js dari folder assets/js.
    // Ini adalah tempat kamu akan menaruh kode JavaScript kustom kamu.
    // Parameter true berarti script akan dimuat di footer (sebelum </body>) untuk performa yang lebih baik.
    wp_enqueue_script( 'arul-new-theme-script', get_template_directory_uri() . '/assets/js/script.js', array(), '1.0.0', true );
}
// Menghubungkan fungsi arul_new_theme_scripts() ke hook 'wp_enqueue_scripts'.
// Ini memberitahu WordPress untuk menjalankan fungsi ini saatnya memuat script dan style.
add_action( 'wp_enqueue_scripts', 'arul_new_theme_scripts' );

/* -------------------------------------------------------------------------
 *  Register Navigation Menus
 * ---------------------------------------------------------------------- */

// Fungsi untuk mendaftarkan lokasi menu navigasi tema.
function arul_new_theme_menus() {
    // Mendaftarkan menu dengan nama 'primary' yang akan digunakan di header.
    register_nav_menus( 
        array(
            'primary' => esc_html__( 'Primary Menu', 'arul-new-theme' ),
        ) 
    );
}
add_action( 'init', 'arul_new_theme_menus' );

/* -------------------------------------------------------------------------
 *  Setup Tema (Theme Support)
 * ---------------------------------------------------------------------- */

function arul_new_theme_setup() {
    // Dukungan untuk post thumbnails (featured images)
    add_theme_support( 'post-thumbnails' );
    
    // Dukungan untuk title tag yang dikelola WordPress
    add_theme_support( 'title-tag' );
    
    // Dukungan untuk custom logo
    add_theme_support( 'custom-logo', array(
        'height'      => 100,
        'width'       => 300,
        'flex-height' => true,
        'flex-width'  => true,
    ) );
    
    // Dukungan untuk HTML5 markup
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ) );
    
    // Dukungan untuk custom background
    add_theme_support( 'custom-background', array(
        'default-color' => 'f0f2f5',
    ) );
    
    // Set ukuran gambar custom untuk tema
    add_image_size( 'arul-featured-large', 800, 450, true ); // Untuk featured image besar
    add_image_size( 'arul-featured-small', 400, 225, true ); // Untuk kartu blog
    add_image_size( 'arul-thumbnail', 150, 150, true );      // Untuk sidebar thumbnail
}
add_action( 'after_setup_theme', 'arul_new_theme_setup' );

/* -------------------------------------------------------------------------
 *  Register Widget Areas (Sidebar)
 * ---------------------------------------------------------------------- */

function arul_new_theme_widgets_init() {
    // Mendaftarkan area sidebar utama
    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar Utama', 'arul-new-theme' ),
        'id'            => 'sidebar-1',
        'description'   => esc_html__( 'Widget area untuk sidebar blog dan halaman artikel.', 'arul-new-theme' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
    
    // Sidebar khusus untuk footer (opsional)
    register_sidebar( array(
        'name'          => esc_html__( 'Footer Widget 1', 'arul-new-theme' ),
        'id'            => 'footer-1',
        'description'   => esc_html__( 'Widget area untuk footer kolom pertama.', 'arul-new-theme' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );
    
    register_sidebar( array(
        'name'          => esc_html__( 'Footer Widget 2', 'arul-new-theme' ),
        'id'            => 'footer-2',
        'description'   => esc_html__( 'Widget area untuk footer kolom kedua.', 'arul-new-theme' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );
    
    register_sidebar( array(
        'name'          => esc_html__( 'Footer Widget 3', 'arul-new-theme' ),
        'id'            => 'footer-3',
        'description'   => esc_html__( 'Widget area untuk footer kolom ketiga.', 'arul-new-theme' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );
}
add_action( 'widgets_init', 'arul_new_theme_widgets_init' );

/* -------------------------------------------------------------------------
 *  Custom Search Form
 * ---------------------------------------------------------------------- */

function arul_new_theme_search_form( $form ) {
    $form = '
    <form role="search" method="get" class="search-form" action="' . esc_url( home_url( '/' ) ) . '">
        <label class="screen-reader-text" for="search-field">' . esc_html__( 'Cari artikel...', 'arul-new-theme' ) . '</label>
        <input type="search" 
               id="search-field" 
               class="search-field" 
               placeholder="' . esc_attr__( 'Cari artikel, tips, tutorial...', 'arul-new-theme' ) . '" 
               value="' . get_search_query() . '" 
               name="s" 
               required />
        <button type="submit" class="search-submit">
            <span class="screen-reader-text">' . esc_html__( 'Cari', 'arul-new-theme' ) . '</span>
            🔍
        </button>
    </form>';
    
    return $form;
}
add_filter( 'get_search_form', 'arul_new_theme_search_form' );

/* -------------------------------------------------------------------------
 *  Custom Excerpt Length & More Link
 * ---------------------------------------------------------------------- */

// Mengubah panjang excerpt default
function arul_new_theme_excerpt_length( $length ) {
    // Untuk halaman blog, buat excerpt lebih pendek
    if ( is_home() || is_category() || is_tag() || is_archive() ) {
        return 25; // 25 kata
    }
    return $length; // Default WordPress (55 kata)
}
add_filter( 'excerpt_length', 'arul_new_theme_excerpt_length', 999 );

// Custom "read more" link
function arul_new_theme_excerpt_more( $more ) {
    if ( is_admin() ) {
        return $more;
    }
    
    $link = sprintf(
        '<a href="%1$s" class="read-more">%2$s</a>',
        esc_url( get_permalink() ),
        esc_html__( 'Baca Selengkapnya →', 'arul-new-theme' )
    );
    
    return ' ... ' . $link;
}
add_filter( 'excerpt_more', 'arul_new_theme_excerpt_more' );

/* -------------------------------------------------------------------------
 *  Custom Pagination
 * ---------------------------------------------------------------------- */

function arul_new_theme_pagination() {
    if ( is_singular() ) {
        return;
    }

    global $wp_query;

    if ( $wp_query->max_num_pages <= 1 ) {
        return;
    }

    $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
    $max   = intval( $wp_query->max_num_pages );

    // Jangan tampilkan link jika hanya ada 1 halaman
    if ( $paged >= 1 && $max > 1 ) {
        echo '<nav class="navigation pagination" role="navigation">';
        echo '<div class="nav-links">';
        
        // Link ke halaman sebelumnya
        if ( $paged > 1 ) {
            printf( '<a class="prev page-numbers" href="%s">« Sebelumnya</a>', get_pagenum_link( $paged - 1 ) );
        }
        
        // Nomor halaman
        for ( $i = 1; $i <= $max; $i++ ) {
            if ( $i == $paged ) {
                echo '<span class="page-numbers current">' . $i . '</span>';
            } else {
                printf( '<a class="page-numbers" href="%s">%d</a>', get_pagenum_link( $i ), $i );
            }
        }
        
        // Link ke halaman selanjutnya
        if ( $paged < $max ) {
            printf( '<a class="next page-numbers" href="%s">Selanjutnya »</a>', get_pagenum_link( $paged + 1 ) );
        }
        
        echo '</div>';
        echo '</nav>';
    }
}

/* -------------------------------------------------------------------------
 *  Fungsi Helper untuk Sidebar
 * ---------------------------------------------------------------------- */

// Cek apakah halaman membutuhkan sidebar
function arul_new_theme_has_sidebar() {
    // Halaman yang TIDAK menggunakan sidebar
    $no_sidebar_pages = array(
        'front-page.php',
        'page-layanan.php', 
        'Page-HubungiKami.php',
    );
    
    // Cek template saat ini
    $current_template = basename( get_page_template() );
    
    // Jika template ada dalam daftar no sidebar, return false
    if ( in_array( $current_template, $no_sidebar_pages ) ) {
        return false;
    }
    
    // Tampilkan sidebar untuk halaman blog, single post, archive, dll
    return ( is_home() || is_single() || is_category() || is_tag() || is_archive() || is_search() );
}

// Mendapatkan class CSS untuk container berdasarkan ada/tidaknya sidebar
function arul_new_theme_container_class() {
    if ( arul_new_theme_has_sidebar() ) {
        return 'blog-layout-wrapper'; // Class khusus untuk layout dengan sidebar
    }
    return ''; // Class default tanpa sidebar
}

/* -------------------------------------------------------------------------
 *  Optimasi Performa untuk Widget Recent Posts
 * ---------------------------------------------------------------------- */

// Fungsi untuk mendapatkan postingan terbaru dengan caching
function arul_new_theme_get_recent_posts( $number = 5 ) {
    // Cek apakah sudah ada cache
    $cache_key = 'arul_recent_posts_' . $number;
    $recent_posts = get_transient( $cache_key );
    
    if ( false === $recent_posts ) {
        // Jika belum ada cache, query database
        $recent_posts = new WP_Query( array(
            'posts_per_page'      => $number,
            'post_status'         => 'publish',
            'orderby'             => 'date',
            'order'               => 'DESC',
            'no_found_rows'       => true,
            'update_post_meta_cache' => false,
        ) );
        
        // Simpan hasil ke cache selama 1 jam
        set_transient( $cache_key, $recent_posts, HOUR_IN_SECONDS );
    }
    
    return $recent_posts;
}

// Hapus cache saat ada post baru
function arul_new_theme_clear_recent_posts_cache() {
    delete_transient( 'arul_recent_posts_5' );
    delete_transient( 'arul_recent_posts_3' );
}
add_action( 'save_post', 'arul_new_theme_clear_recent_posts_cache' );
add_action( 'delete_post', 'arul_new_theme_clear_recent_posts_cache' );

/* -------------------------------------------------------------------------
 *  Custom Body Class
 * ---------------------------------------------------------------------- */

function arul_new_theme_body_classes( $classes ) {
    // Tambah class untuk halaman yang menggunakan sidebar
    if ( arul_new_theme_has_sidebar() ) {
        $classes[] = 'has-sidebar';
    } else {
        $classes[] = 'no-sidebar';
    }
    
    // Tambah class untuk mobile detection (opsional)
    if ( wp_is_mobile() ) {
        $classes[] = 'mobile-device';
    }
    
    return $classes;
}
add_filter( 'body_class', 'arul_new_theme_body_classes' );


 /* -------------------------------------------------------------------------
 *  // ===== CONTACT FORM FUNCTIONALITY =====
 * ---------------------------------------------------------------------- */


// Enqueue script dan style khusus untuk halaman Hubungi Kami
function enqueue_contact_form_assets() {
    if (is_page_template('Page-HubungiKami.php')) {
        wp_enqueue_style('contact-form-style', get_template_directory_uri() . '/style.css', [], '1.0', 'all');
        wp_enqueue_script('contact-form-script', get_template_directory_uri() . '/script.js', ['jquery'], '1.0', true);

        wp_localize_script('contact-form-script', 'contactFormData', [
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce'    => wp_create_nonce('contact_form_nonce')
        ]);
    }
}
add_action('wp_enqueue_scripts', 'enqueue_contact_form_assets');

// Handler pengiriman form Hubungi Kami
function handle_contact_form_submission() {
    // Validasi nonce
    if (!isset($_POST['contact_nonce']) || !wp_verify_nonce($_POST['contact_nonce'], 'contact_form_nonce')) {
        wp_send_json_error(['message' => 'Nonce tidak valid.']);
    }

    global $wpdb;

    // Ambil & sanitasi data
    $name    = sanitize_text_field($_POST['name']);
    $email   = sanitize_email($_POST['email']);
    $phone   = sanitize_text_field($_POST['phone']);
    $subject = sanitize_text_field($_POST['subject']);
    $service = sanitize_text_field($_POST['service']);
    $message = sanitize_textarea_field($_POST['message']);

    // Validasi input wajib
    if (empty($name) || empty($email) || empty($message)) {
        wp_send_json_error(['message' => 'Nama, email, dan pesan wajib diisi.']);
    }

    if (!is_email($email)) {
        wp_send_json_error(['message' => 'Format email tidak valid.']);
    }

    // Kirim email ke admin
    $admin_email   = get_option('admin_email');
    $admin_subject = "Pesan Baru dari Form Hubungi Kami: $subject";
    $admin_body    = "Nama: $name\nEmail: $email\nTelepon: $phone\nLayanan: $service\n\nPesan:\n$message";
    $admin_headers = ["From: $name <$email>", "Reply-To: $email"];

    $mail_admin = wp_mail($admin_email, $admin_subject, $admin_body, $admin_headers);

    // Kirim email konfirmasi ke user
    $user_subject = "Konfirmasi Pesan Anda - " . get_bloginfo('name');
    $user_body    = "Halo $name,\n\nTerima kasih sudah menghubungi kami. Pesan Anda telah kami terima dan akan segera kami balas.\n\nSalinan pesan Anda:\n$message\n\nSalam,\n" . get_bloginfo('name');
    $user_headers = ["From: " . get_bloginfo('name') . " <$admin_email>", "Reply-To: $admin_email"];

    $mail_user = wp_mail($email, $user_subject, $user_body, $user_headers);

    // Simpan pesan ke database
    $table_name = $wpdb->prefix . 'contact_messages';

    // Cek apakah tabel ada, jika belum buat
    $table_exists = $wpdb->get_var($wpdb->prepare("SHOW TABLES LIKE %s", $table_name));
    if (!$table_exists) {
        require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE $table_name (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            name varchar(100) NOT NULL,
            email varchar(100) NOT NULL,
            phone varchar(50),
            subject varchar(200),
            service varchar(100),
            message text NOT NULL,
            submitted_at datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
            ip_address varchar(50),
            status varchar(20) DEFAULT 'new',
            PRIMARY KEY  (id)
        ) $charset_collate;";

        dbDelta($sql);
    }

    $wpdb->insert(
        $table_name,
        [
            'name'         => $name,
            'email'        => $email,
            'phone'        => $phone,
            'subject'      => $subject,
            'service'      => $service,
            'message'      => $message,
            'submitted_at' => current_time('mysql'),
            'ip_address'   => $_SERVER['REMOTE_ADDR'],
            'status'       => 'new'
        ],
        ['%s','%s','%s','%s','%s','%s','%s','%s','%s']
    );

    // Respon ke AJAX
    if ($mail_admin && $mail_user) {
        wp_send_json_success(['message' => 'Pesan berhasil dikirim. Silakan cek email Anda untuk konfirmasi.']);
    } else {
        wp_send_json_error(['message' => 'Pesan tersimpan, namun email gagal dikirim.']);
    }
}
add_action('wp_ajax_submit_contact_form', 'handle_contact_form_submission');
add_action('wp_ajax_nopriv_submit_contact_form', 'handle_contact_form_submission');

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
    
    // Cek cache terlebih dahulu
    $cache_key = 'nazroel_related_posts_' . $post_id . '_' . $number;
    $related_posts = get_transient( $cache_key );
    
    if ( false === $related_posts ) {
        // Ambil kategori dan tag dari post saat ini
        $categories = wp_get_post_categories( $post_id );
        $tags = wp_get_post_tags( $post_id );
        
        $args = array(
            'post_type'              => 'post',
            'post_status'            => 'publish',
            'posts_per_page'         => $number,
            'post__not_in'           => array( $post_id ), // Exclude post saat ini
            'orderby'                => 'date',
            'order'                  => 'DESC',
            'no_found_rows'          => true,
            'update_post_meta_cache' => false,
            'update_post_term_cache' => false,
        );
        
        // Prioritas 1: Cari berdasarkan kategori DAN tag
        if ( ! empty( $categories ) && ! empty( $tags ) ) {
            $tag_ids = wp_list_pluck( $tags, 'term_id' );
            
            $args['tax_query'] = array(
                'relation' => 'OR',
                array(
                    'taxonomy' => 'category',
                    'field'    => 'term_id',
                    'terms'    => $categories,
                ),
                array(
                    'taxonomy' => 'post_tag',
                    'field'    => 'term_id', 
                    'terms'    => $tag_ids,
                )
            );
            
            $related_posts = new WP_Query( $args );
        }
        
        // Prioritas 2: Jika hasil kurang atau hanya ada kategori, cari berdasarkan kategori saja
        if ( ( ! isset( $related_posts ) || $related_posts->post_count < $number ) && ! empty( $categories ) ) {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'category',
                    'field'    => 'term_id',
                    'terms'    => $categories,
                )
            );
            
            if ( isset( $related_posts ) && $related_posts->post_count > 0 ) {
                // Exclude posts yang sudah ada
                $existing_ids = wp_list_pluck( $related_posts->posts, 'ID' );
                $args['post__not_in'] = array_merge( array( $post_id ), $existing_ids );
                $args['posts_per_page'] = $number - $related_posts->post_count;
                
                $additional_posts = new WP_Query( $args );
                $related_posts->posts = array_merge( $related_posts->posts, $additional_posts->posts );
                $related_posts->post_count += $additional_posts->post_count;
            } else {
                $related_posts = new WP_Query( $args );
            }
        }
        
        // Prioritas 3: Jika masih kurang, ambil post terbaru (fallback)
        if ( ! isset( $related_posts ) || $related_posts->post_count < $number ) {
            $remaining = $number - ( isset( $related_posts ) ? $related_posts->post_count : 0 );
            
            $fallback_args = array(
                'post_type'              => 'post',
                'post_status'            => 'publish',
                'posts_per_page'         => $remaining,
                'post__not_in'           => array( $post_id ),
                'orderby'                => 'date',
                'order'                  => 'DESC',
                'no_found_rows'          => true,
                'update_post_meta_cache' => false,
                'update_post_term_cache' => false,
            );
            
            if ( isset( $related_posts ) && $related_posts->post_count > 0 ) {
                $existing_ids = wp_list_pluck( $related_posts->posts, 'ID' );
                $fallback_args['post__not_in'] = array_merge( array( $post_id ), $existing_ids );
                
                $fallback_posts = new WP_Query( $fallback_args );
                $related_posts->posts = array_merge( $related_posts->posts, $fallback_posts->posts );
                $related_posts->post_count += $fallback_posts->post_count;
            } else {
                $related_posts = new WP_Query( $fallback_args );
            }
        }
        
        // Cache hasil selama 2 jam
        set_transient( $cache_key, $related_posts, 2 * HOUR_IN_SECONDS );
    }
    
    return $related_posts;
}

/**
 * Menampilkan artikel terkait dengan HTML yang sudah terstruktur
 * 
 * @param int $number Jumlah artikel yang ditampilkan (default: 4)
 * @param string $title Judul section (default: "Artikel Terkait")
 */
function nazroel_display_related_posts( $number = 4, $title = 'Artikel Terkait' ) {
    // Hanya tampilkan di single post
    if ( ! is_single() ) {
        return;
    }
    
    $related_posts = nazroel_get_related_posts( get_the_ID(), $number );
    
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
                            if ( has_post_thumbnail() ) {
                                the_post_thumbnail( 'arul-featured-small', array(
                                    'class' => 'related-post-image',
                                    'alt'   => get_the_title(),
                                    'loading' => 'lazy'
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
                                $word_count = str_word_count( strip_tags( get_the_content() ) );
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
                            // Custom excerpt untuk related posts (lebih pendek)
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
            
            // Reset post data
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
 * Hapus cache related posts ketika ada perubahan pada post
 */
function nazroel_clear_related_posts_cache( $post_id ) {
    // Hanya untuk post type 'post'
    if ( get_post_type( $post_id ) !== 'post' ) {
        return;
    }
    
    // Hapus cache untuk post yang bersangkutan
    $cache_keys = array(
        'nazroel_related_posts_' . $post_id . '_4',
        'nazroel_related_posts_' . $post_id . '_3',
        'nazroel_related_posts_' . $post_id . '_6',
    );
    
    foreach ( $cache_keys as $cache_key ) {
        delete_transient( $cache_key );
    }
    
    // Hapus juga cache dari post lain yang mungkin menampilkan post ini sebagai related
    // (untuk optimasi lebih lanjut, bisa ditambahkan logic untuk menghapus cache berdasarkan kategori/tag)
}

// Hook untuk menghapus cache saat post diupdate/delete
add_action( 'save_post', 'nazroel_clear_related_posts_cache' );
add_action( 'delete_post', 'nazroel_clear_related_posts_cache' );
add_action( 'wp_trash_post', 'nazroel_clear_related_posts_cache' );

/**
 * Shortcode untuk menampilkan related posts di mana saja
 * Usage: [nazroel_related_posts number="6" title="Artikel Lainnya"]
 */
function nazroel_related_posts_shortcode( $atts ) {
    $atts = shortcode_atts( array(
        'number' => 4,
        'title'  => 'Artikel Terkait',
    ), $atts, 'nazroel_related_posts' );
    
    // Start output buffering
    ob_start();
    
    // Call the display function
    nazroel_display_related_posts( (int) $atts['number'], sanitize_text_field( $atts['title'] ) );
    
    // Return the buffered content
    return ob_get_clean();
}
add_shortcode( 'nazroel_related_posts', 'nazroel_related_posts_shortcode' );