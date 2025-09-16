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
        </div><!-- .container -->
    </section><!-- .service-hero-section -->

    <!-- Bagian Pilihan Kategori Perangkat -->
    <section class="device-categories-section">
        <div class="container">
            <h2>PILIH JENIS PERANGKAT ANDA :</h2>
            <div class="device-grid">
                <div class="device-card" onclick="showServiceDetails('iPhone')">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/Device/Iphone.png' ); ?>" alt="iPhone Repair">
                    <h3>iPhone</h3>
                </div>
                <div class="device-card" onclick="showServiceDetails('Android')">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/Device/Android.png' ); ?>" alt="Android Repair">
                    <h3>Android</h3>
                </div>
                <div class="device-card" onclick="showServiceDetails('Tablet')">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/Device/Tablet.png' ); ?>" alt="Tablet Repair">
                    <h3>Tablet</h3>
                </div>
                <div class="device-card" onclick="showServiceDetails('Classic Phone')">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/Device/ClassicPhone.png' ); ?>" alt="Classic Phone Repair">
                    <h3>Classic Phone</h3>
                </div>
            </div><!-- .device-grid -->
            <p class="device-cta-text">Tidak yakin perangkat Anda masuk kategori mana? <a href="<?php echo esc_url( home_url( '/hubungi-kami/' ) ); ?>">Hubungi Kami</a> untuk konsultasi gratis!</p>
        </div><!-- .container -->
    </section><!-- .device-categories-section -->

    <!-- Bagian Layanan Populer -->
    <section class="popular-services-section">
        <div class="container">
            <h2>LAYANAN POPULER KAMI :</h2>
            <div class="services-grid">
                <div class="service-card" onclick="showServiceModal('Service Android', 'Perbaikan menyeluruh untuk semua jenis smartphone Android. Kami menangani masalah software, hardware, dan optimasi performa.', '📱')">
                    <div class="service-icon">📱</div>
                    <h3>Service Android</h3>
                    <p>Perbaikan menyeluruh perangkat Android</p>
                </div>
                <div class="service-card" onclick="showServiceModal('Service iPhone', 'Layanan perbaikan khusus untuk iPhone dengan teknisi berpengalaman dan spare parts original.', '🍎')">
                    <div class="service-icon">🍎</div>
                    <h3>Service iPhone</h3>
                    <p>Perbaikan khusus untuk iPhone</p>
                </div>
                <div class="service-card" onclick="showServiceModal('Ganti LCD/Touchscreen', 'Penggantian layar LCD dan touchscreen untuk semua jenis gadget dengan kualitas terbaik dan garansi resmi.', '🖥️')">
                    <div class="service-icon">🖥️</div>
                    <h3>Ganti LCD/Touchscreen</h3>
                    <p>Penggantian layar rusak atau pecah</p>
                </div>
                <div class="service-card" onclick="showServiceModal('Ganti Baterai', 'Penggantian baterai dengan kapasitas original. Meningkatkan daya tahan gadget Anda seperti baru lagi.', '🔋')">
                    <div class="service-icon">🔋</div>
                    <h3>Ganti Baterai</h3>
                    <p>Penggantian baterai lemah atau rusak</p>
                </div>
                <div class="service-card" onclick="showServiceModal('Unlock Bootloader', 'Layanan unlock bootloader untuk custom ROM dan rooting dengan aman. Cocok untuk pengguna advanced.', '🔓')">
                    <div class="service-icon">🔓</div>
                    <h3>Unlock Bootloader</h3>
                    <p>Membuka akses penuh sistem Android</p>
                </div>
                <div class="service-card" onclick="showServiceModal('Install Ulang Software', 'Instalasi ulang OS untuk mengatasi masalah software, virus, atau sistem yang corrupt dengan data recovery.', '💿')">
                    <div class="service-icon">💿</div>
                    <h3>Install Ulang Software</h3>
                    <p>Instalasi ulang sistem operasi</p>
                </div>
            </div><!-- .services-grid -->
            <div class="services-cta">
                <p>Butuh layanan khusus yang tidak terdaftar? <a href="<?php echo esc_url( home_url( '/hubungi-kami/' ) ); ?>">Konsultasikan dengan tim kami</a></p>
            </div>
        </div><!-- .container -->
    </section><!-- .popular-services-section -->

    <!-- Modal untuk Detail Layanan -->
    <div id="serviceModal" class="service-modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="modalTitle"></h3>
                <span class="close-modal" onclick="closeServiceModal()">&times;</span>
            </div>
            <div class="modal-body">
                <div id="modalIcon" class="modal-icon"></div>
                <p id="modalDescription"></p>
                <div class="modal-actions">
                    <a href="<?php echo esc_url( home_url( '/hubungi-kami/' ) ); ?>" class="btn-contact">Konsultasi Sekarang</a>
                    <a href="https://wa.me/6285786834468" target="_blank" class="btn-whatsapp">WhatsApp Kami</a>
                </div>
            </div>
        </div>
    </div><!-- #serviceModal -->

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

<?php get_footer(); ?>