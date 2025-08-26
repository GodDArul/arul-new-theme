<?php
/**
 * Header Tema
 *
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Arul_New_Theme
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge"> <!-- Penting untuk kompatibilitas browser lama -->
    <title><?php wp_title( '|', true, 'right' ); bloginfo( 'name' ); ?></title>

    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

    <header id="masthead" class="site-header">
        <div class="container"> 

            <div class="site-branding">
                <!-- Menampilkan nama situs atau logo -->
                <p class="site-title">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                        <?php bloginfo( 'name' ); ?>
                    </a>
                </p>
            </div>

            <!-- Navigasi utama situs -->
            <nav id="site-navigation" class="main-navigation">
                <!-- Tombol untuk menu responsive (akan disembunyikan di desktop dengan CSS) -->
                <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                    <?php esc_html_e( 'Menu', 'arul-new-theme' ); ?>
                </button>
                <?php
                // Memanggil menu navigasi WordPress
                // 'theme_location' harus didaftarkan di functions.php
                wp_nav_menu( array(
                    'theme_location' => 'primary', // Nama lokasi menu
                    'menu_id'        => 'primary-menu', // ID untuk elemen <ul> menu
                ) );
                ?>
            </nav><!-- #site-navigation -->

        </div><!-- .container -->
    </header><!-- #masthead -->

    <main id="content" class="site-main">

