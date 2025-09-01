<?php
/**
 * Template Name: Lokasi Kami
 * Template Post Type: page
 */

// Ini adalah file template khusus untuk halaman Lokasi Kami.

$package_arul_new_theme;
?>

<?php get_header(); ?>

<main id="primary" class="site-main">
    <!-- Hero Section untuk Halaman Lokasi -->
    <section class="lokasi-hero-section">
        <div class="container">
            <div class="lokasi-hero-content">
                <h1 class="lokasi-hero-title">LOKASI KAMI</h1>
                <p class="lokasi-hero-subtitle">Kunjungi langsung konter Nazroel Celluler untuk mendapatkan pelayanan terbaik dengan teknisi berpengalaman.</p>
            </div>
        </div><!-- .container -->
    </section><!-- .lokasi-hero-section -->

    <!-- Bagian Peta dan Informasi Lokasi -->
    <section class="lokasi-main-section">
        <div class="container">
            <div class="lokasi-wrapper">
                <!-- Kolom Kiri: Peta -->
                <div class="lokasi-map-area">
                    <h2>PETA LOKASI</h2>
                    <div class="map-container">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3955.2267381793986!2d110.67475147591415!3d-7.550236574547592!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a6bef054b5479%3A0xdb4d7d5c6d88d553!2sSERVIS%20HP%20ANDROID%20DAN%20IPHONE%20NAZROELCELL%20PENGGING!5e0!3m2!1sen!2sid!4v1755066558738!5m2!1sen!2sid" 
                            width="600" 
                            height="450" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                    
                    <!-- Petunjuk Arah -->
                    <div class="direction-info">
                        <h3>Petunjuk Arah</h3>
                        <ul>
                            <li>📍 Berlokasi di area Pengging, mudah diakses dari berbagai arah</li>
                            <li>🚗 Tersedia area parkir yang luas untuk kendaraan</li>
                            <li>🏪 500M dari Alun-Alun Pengging</li>
                        </ul>
                    </div>
                </div>

                <!-- Kolom Kanan: Informasi Detail -->
                <div class="lokasi-info-area">
                    <!-- Alamat Lengkap -->
                    <div class="info-box alamat-box">
                        <h2>ALAMAT LENGKAP</h2>
                        <div class="alamat-content">
                            <div class="alamat-item">
                                <strong>Nazroel Celluler</strong>
                                <p>Servis HP Android dan iPhone</p>
                                <p>Pengging, Boyolali, Jawa Tengah</p>
                                <p>Indonesia</p>
                            </div>
                            
                            <div class="alamat-detail">
                                <div class="detail-item">
                                    <span class="detail-icon">📞</span>
                                    <div>
                                        <strong>Telepon</strong>
                                        <p>+62 857 8683 4468</p>
                                    </div>
                                </div>
                                
                                <div class="detail-item">
                                    <span class="detail-icon">📧</span>
                                    <div>
                                        <strong>WhatsApp</strong>
                                        <p>+62 857 8683 4468</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Jam Operasional -->
                    <div class="info-box jam-operasional-box">
                        <h2>JAM OPERASIONAL</h2>
                        <div class="jam-operasional-content">
                            <div class="jam-item">
                                <div class="hari">
                                    <span class="hari-nama">Senin - Minggu</span>
                                </div>
                                <div class="waktu">
                                    <span class="jam-buka">09:00 - 21:00 WIB</span>
                                    <span class="status status-buka">BUKA</span>
                                </div>
                            </div>
                            
                            <div class="catatan-jam">
                                <p><strong>Catatan:</strong> Jam operasional dapat berubah pada hari libur nasional. Hubungi kami untuk memastikan.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Informasi Tambahan -->
                    <div class="info-box fasilitas-box">
                        <h2>FASILITAS & LAYANAN</h2>
                        <div class="fasilitas-grid">
                            <div class="fasilitas-item">
                                <span class="fasilitas-icon">🔧</span>
                                <div>
                                    <strong>Teknisi Ahli</strong>
                                    <p>Teknisi berpengalaman dan bersertifikat</p>
                                </div>
                            </div>
                            
                            <div class="fasilitas-item">
                                <span class="fasilitas-icon">⚡</span>
                                <div>
                                    <strong>Servis Cepat</strong>
                                    <p>Proses perbaikan yang efisien</p>
                                </div>
                            </div>
                            
                            <div class="fasilitas-item">
                                <span class="fasilitas-icon">🛡️</span>
                                <div>
                                    <strong>Garansi Resmi</strong>
                                    <p>Garansi hingga 1 bulan</p>
                                </div>
                            </div>
                            
                            <div class="fasilitas-item">
                                <span class="fasilitas-icon">🚗</span>
                                <div>
                                    <strong>Parkir Luas</strong>
                                    <p>Area parkir yang nyaman</p>
                                </div>
                            </div>
                            
                            <div class="fasilitas-item">
                                <span class="fasilitas-icon">💳</span>
                                <div>
                                    <strong>Pembayaran Mudah</strong>
                                    <p>Cash & Transfer</p>
                                </div>
                            </div>
                            
                            <div class="fasilitas-item">
                                <span class="fasilitas-icon">🏠</span>
                                <div>
                                    <strong>Antar Jemput</strong>
                                    <p>Layanan khusus area tertentu</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Call to Action -->
                    <div class="info-box cta-lokasi-box">
                        <h2>KUNJUNGI KAMI</h2>
                        <div class="cta-lokasi-content">
                            <p>Butuh bantuan segera? Jangan ragu untuk datang langsung ke konter kami atau hubungi terlebih dahulu.</p>
                            
                            <div class="cta-buttons-lokasi">
                                <a href="https://wa.me/6285786834468" class="btn-whatsapp" target="_blank">
                                    <span class="btn-icon">📱</span>
                                    <span>Chat WhatsApp</span>
                                </a>
                                
                                <a href="tel:+6285786834468" class="btn-telepon">
                                    <span class="btn-icon">📞</span>
                                    <span>Telepon Sekarang</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- .lokasi-wrapper -->
        </div><!-- .container -->
    </section><!-- .lokasi-main-section -->

    <!-- Tampilkan konten halaman dari editor WordPress (opsional) -->
    <div class="container">
        <?php
        // Ini akan menampilkan konten yang kamu tulis di editor halaman "Lokasi Kami" di dashboard WordPress
        if ( have_posts() ) : the_post();
            the_content();
        endif;
        ?>
    </div>

</main><!-- #primary -->

<?php get_footer(); ?>