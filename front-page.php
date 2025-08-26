<?php
/**
 * Template Halaman Depan Statis (Front Page)
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#front-page-display
 *
 * @package Arul_New_Theme
 */

get_header(); 

?>

<main id="primary" class="site-main">
    <div class="container">
        <!-- Bagian Hero Section untuk Nazroel Celluler -->
        <section class="hero-section">
            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/Perbaikan.jpeg' ); ?>" alt="Teknisi Memperbaiki Smartphone" class="hero-background-image" onerror="this.onerror=null;this.src='https://placehold.co/1200x800/2c3e50/ffffff?text=Gambar+Tidak+Ditemukan';" />

            <div class="hero-content">
                <h1 class="hero-title">SOLUSI GADGET TERBAIK</h1>
                <h2 class="hero-tagline">Servis Cepat, <br>Hasil Memuaskan!</h2>
                <div class="hero-cta">
                    <p>Gadgetmu bermasalah? Jangan tunda lagi, hubungi kami sekarang!</p>
                    <a href="https://wa.me/6285786834468" class="cta-button">
                        <span class="icon">&#9742;</span> +62 857 8683 4468
                    </a>
                    <a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>" class="cta-button">
                        <span class="icon">&#128220;</span> Lihat Blog Kami
                    </a>
                </div>
            </div>
        </section><!-- .hero-section -->


        <section class="now-open-section">
            <h2>Nazroel Celluler - Buka Setiap Hari!</h2>
        </section>
    </div><!-- .container -->
</main><!-- #primary -->

<?php get_footer();?>
