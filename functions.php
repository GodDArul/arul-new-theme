<?php

/**
 * Fungsi-fungsi Tema Arul New Theme
 *
 * @package Arul_New_Theme
 */

/* -------------------------------------------------------------------------
 *  INCLUDE FILE EKSTERNAL
 * ---------------------------------------------------------------------- */

// Memuat file Related-Post.php yang berisi fungsi artikel terkait
require_once get_template_directory() . '/inc/Related-Post.php';

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