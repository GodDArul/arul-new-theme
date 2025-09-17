<?php
/**
 * Template Name: Hubungi Kami
 * Template Post Type: page
 */

// Ini adalah file template khusus untuk halaman Hubungi Kami.
?>

<?php get_header(); ?>

<main id="primary" class="site-main">
    <!-- Hero Section untuk Halaman Contact -->
    <section class="contact-hero-section">
        <div class="container">
            <div class="contact-hero-content">
                <h1 class="contact-hero-title">HUBUNGI KAMI</h1>
                <p class="contact-hero-subtitle">Kami siap membantu Anda dengan layanan terbaik. Jangan ragu untuk menghubungi kami.</p>
            </div>
        </div>
    </section>

    <!-- Bagian Informasi Kontak -->
    <section class="contact-info-section">
        <div class="container">
            <h2>INFORMASI KONTAK</h2>
            <div class="contact-grid">
                <div class="contact-card">
                    <a href="https://wa.me/6285786834468" target="_blank" rel="noopener">
                        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/Medsos-icon/WhatsApp.png' ); ?>" alt="WhatsApp">
                        <h3>WhatsApp</h3>
                        <p>+62 857 8683 4468</p>
                    </a>
                </div>
                <div class="contact-card">
                    <a href="https://instagram.com/nazroelcell_" target="_blank" rel="noopener">
                        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/Medsos-icon/Instagram.png' ); ?>" alt="Instagram">
                        <h3>Instagram</h3>
                        <p>@nazroelcell_</p>
                    </a>
                </div>
                <div class="contact-card">
                    <a href="https://facebook.com/nazroelcelluler" target="_blank" rel="noopener">
                        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/Medsos-icon/Facebook.png' ); ?>" alt="Facebook">
                        <h3>Facebook</h3>
                        <p>Nazroel Celluler</p>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Form Kontak dan Peta -->
    <section class="contact-form-section">
        <div class="container">
            <div class="contact-form-wrapper">
                <div class="contact-form-left">
                    <h2>KIRIM PESAN</h2>
                    <div id="form-messages"></div>
                    <form id="contact-form" method="POST">
                        <?php wp_nonce_field('contact_form_nonce', 'contact_nonce'); ?>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="contact-name">Nama Lengkap *</label>
                                <input type="text" id="contact-name" name="contact_name" required>
                            </div>
                            <div class="form-group">
                                <label for="contact-email">Email *</label>
                                <input type="email" id="contact-email" name="contact_email" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="contact-phone">Nomor Telepon</label>
                                <input type="tel" id="contact-phone" name="contact_phone" pattern="^\+?\d{9,15}$" title="Masukkan nomor telepon yang valid">
                            </div>
                            <div class="form-group">
                                <label for="contact-subject">Subjek *</label>
                                <input type="text" id="contact-subject" name="contact_subject" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="contact-service">Layanan yang Diminati</label>
                            <select id="contact-service" name="contact_service">
                                <option value="">Pilih Layanan</option>
                                <option value="smartphone-repair">Perbaikan Smartphone</option>
                                <option value="tablet-repair">Perbaikan Tablet</option>
                                <option value="laptop-repair">Perbaikan Laptop</option>
                                <option value="desktop-repair">Perbaikan Desktop</option>
                                <option value="data-recovery">Recovery Data</option>
                                <option value="consultation">Konsultasi</option>
                                <option value="other">Lainnya</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="contact-message">Pesan *</label>
                            <textarea id="contact-message" name="contact_message" rows="6" placeholder="Tuliskan pesan Anda di sini..." required></textarea>
                        </div>
                        <button type="submit" class="btn-submit">
                            <span>Kirim Pesan</span>
                            <i class="arrow-icon" aria-hidden="true">→</i>
                        </button>
                    </form>
                </div>
                <div class="contact-form-right">
                    <h2>LOKASI KAMI</h2>
                    <div class="map-container">
                        <?php $maps_url = get_theme_mod('google-maps'); ?>
                        <iframe src="<?php echo esc_url($maps_url ?: 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d...'); ?>" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                    <div class="contact-additional-info">
                        <h3>Informasi Tambahan</h3>
                        <ul>
                            <li>✓ Konsultasi gratis untuk masalah perangkat</li>
                            <li>✓ Garansi perbaikan hingga 6 bulan</li>
                            <li>✓ Teknisi berpengalaman dan bersertifikat</li>
                            <li>✓ Spare part original dan berkualitas</li>
                            <li>✓ Layanan antar-jemput untuk area tertentu</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tampilkan konten halaman dari editor WordPress (opsional) -->
    <div class="container">
        <?php
        // Ini akan menampilkan konten yang kamu tulis di editor halaman "Hubungi Kami" di dashboard WordPress
        if ( have_posts() ) : the_post();
            the_content();
        endif;
        ?>
    </div>
</main>

<?php get_footer(); ?>