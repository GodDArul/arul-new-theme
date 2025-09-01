<?php
/**
 * Template Name: Hubungi Kami
 * Template Post Type: page
 */

// Ini adalah file template khusus untuk halaman Hubungi Kami.

$package_arid_new_theme;
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
        </div><!-- .container -->
    </section><!-- .contact-hero-section -->

    <!-- Bagian Informasi Kontak -->
    <section class="contact-info-section">
        <div class="container">
            <h2>INFORMASI KONTAK</h2>
            <div class="contact-grid">
                <div class="contact-card">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/Medsos-icon/WhatsApp.png' ); ?>" alt="WhatsApp">
                    <h3>WhatsApp</h3>
                    <p>+62 857 8683 4468</p>
                </div>
                <div class="contact-card">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/Medsos-icon/Instagram.png' ); ?>" alt="Instagram">
                    <h3>Instagram</h3>
                    <p>@nazroelcell_</p>
                </div>
                <div class="contact-card">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/Medsos-icon/Facebook.png' ); ?>" alt="Facebook">
                    <h3>Facebook</h3>
                    <p>Nazroel Celluler</p>
                </div>
            </div><!-- .contact-grid -->
        </div>
    </section><!-- .contact-info-section -->

    <!-- Form Kontak dan Peta -->
    <section class="contact-form-section">
        <div class="container">
            <div class="contact-form-wrapper">
                <div class="contact-form-left">
                    <h2>KIRIM PESAN</h2>
                    <div id="form-messages"></div>
                    <form id="contact-form" method="POST" action="">
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
                                <input type="tel" id="contact-phone" name="contact_phone">
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
                            <i class="arrow-icon">→</i>
                        </button>
                    </form>
                </div>

                <div class="contact-form-right">
                    <h2>LOKASI KAMI</h2>
                    <div class="map-container">
                        <iframe 
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3955.2267381793986!2d110.67475147591415!3d-7.550236574547592!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a6bef054b5479%3A0xdb4d7d5c6d88d553!2sSERVIS%20HP%20ANDROID%20DAN%20IPHONE%20NAZROELCELL%20PENGGING!5e0!3m2!1sen!2sid!4v1755066558738!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </iframe>
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

</main><!-- #primary -->

<?php get_footer(); ?>