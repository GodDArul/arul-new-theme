<?php
/**
 * Template Name: Layanan
 * Template Post Type: page
 *
 * Ini adalah file template khusus untuk halaman Layanan.
 *
 * @package Arul_New_Theme
 */

get_header();
?>

<main id="primary" class="site-main">
    <!-- Hero Section untuk Halaman Layanan -->
    <section class="service-hero-section">
        <div class="container">
            <div class="service-hero-content">
                <h1 class="service-hero-title">LAYANAN PERBAIKAN GADGET</h1>
                <p class="service-hero-subtitle">Kami menyediakan layanan perbaikan profesional untuk berbagai jenis gadget Anda.</p>
            </div>
        </div><!-- .container --></
    </section><!-- .service-hero-section -->

    <!-- Bagian Pilihan Kategori Perangkat -->
    <section class="device-categories-section">
        <div class="container">
            <h2>PILIH JENIS PERANGKAT ANDA :</h2>
            <div class="device-grid">
                <div class="device-card">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/Iphone.png' ); ?>" alt="iPhone Repair">
                    <h3>iPhone</h3>
                </div>
                <div class="device-card">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/Android.png' ); ?>" alt="Android Repair">
                    <h3>Android</h3>
                </div>
                <div class="device-card">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/Tablet.png' ); ?>" alt="Tablet Repair">
                    <h3>Tablet</h3>
                </div>
                <div class="device-card">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/ClassicPhone.png' ); ?>" alt="Clssic Phone Repair">
                    <h3>Classic Phone</h3>
                </div>
            </div><!-- .device-grid -->
            <p class="device-cta-text">Tidak yakin perangkat Anda masuk kategori mana? <a href="<?php echo esc_url( home_url( '/hubungi-kami/' ) ); ?>">Hubungi Kami</a> untuk konsultasi gratis!</p>
        </div><!-- .container -->
    </section><!-- .device-categories-section -->

    <!-- Tambahan konten halaman dari editor WordPress (opsional) -->
    <div class="container">
        <?php
        // Ini akan menampilkan konten yang kamu tulis di editor halaman "Layanan" di dashboard WordPress
        if ( have_posts() ) :
            while ( have_posts() ) : the_post();
                the_content();
            endwhile;
        endif;
        ?>
    </div>

</main><!-- #primary -->

<?php get_footer();?>
