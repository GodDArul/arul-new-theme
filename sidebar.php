<?php
/**
 * Sidebar Template untuk NAZROEL CELLULER
 * 
 * Template sidebar yang berisi widget-widget khusus untuk website konter HP
 * 
 * @package Arul_New_Theme
 */

// Jangan tampilkan sidebar jika tidak ada widget atau konten
if ( ! is_active_sidebar( 'sidebar-1' ) && ! dynamic_sidebar( 'sidebar-1' ) ) : ?>

<aside id="secondary" class="sidebar widget-area" role="complementary">
    
    <!-- Widget Pencarian -->
    <section class="widget widget-search">
        <h3 class="widget-title">
            <i class="search-icon">🔍</i>
            Cari Artikel
        </h3>
        <div class="widget-content">
            <?php get_search_form(); ?>
        </div>
    </section>

    <!-- Widget Kontak Cepat -->
    <section class="widget widget-contact">
        <h3 class="widget-title">
            <i class="contact-icon">📞</i>
            Kontak Kami
        </h3>
        <div class="widget-content">
            <div class="contact-info">
                <div class="contact-item whatsapp-contact">
                    <span class="contact-icon-wa">💬</span>
                    <div class="contact-details">
                        <strong>WhatsApp</strong>
                        <a href="https://wa.me/6285786834468" target="_blank" rel="noopener">
                            +62 857-8683-4468
                        </a>
                    </div>
                </div>
                
                <div class="contact-item phone-contact">
                    <span class="contact-icon-phone">📱</span>
                    <div class="contact-details">
                        <strong>Telepon</strong>
                        <span>+62 857-8683-4468</span>
                    </div>
                </div>
                
                <div class="contact-item address-contact">
                    <span class="contact-icon-address">📍</span>
                    <div class="contact-details">
                        <strong>Alamat Toko</strong>
                        <span>Pengging<br>Boyolali, Jawa Tengah</span>
                    </div>
                </div>
                
                <div class="contact-item hours-contact">
                    <span class="contact-icon-hours">🕒</span>
                    <div class="contact-details">
                        <strong>Jam Buka</strong>
                        <span>Senin - Minggu: 09:00 - 21:00
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Widget Kategori Blog -->
    <section class="widget widget-categories">
        <h3 class="widget-title">
            <i class="category-icon">📂</i>
            Kategori Artikel
        </h3>
        <div class="widget-content">
            <ul class="categories-list">
                <?php 
                wp_list_categories( array(
                    'orderby'      => 'count',
                    'order'        => 'DESC',
                    'show_count'   => true,
                    'title_li'     => '',
                    'hide_empty'   => true,
                    'number'       => 8, // Batasi maksimal 8 kategori
                    'exclude'      => array(1), // Exclude kategori "Uncategorized" (ID 1)
                ) );
                ?>
            </ul>
        </div>
    </section>

    <!-- Widget Postingan Terbaru -->
    <section class="widget widget-recent-posts">
        <h3 class="widget-title">
            <i class="recent-icon">📄</i>
            Artikel Terbaru
        </h3>
        <div class="widget-content">
            <div class="recent-posts-list">
                <?php
                // Query untuk mendapatkan 5 postingan terbaru
                $recent_posts = new WP_Query( array(
                    'posts_per_page' => 5,
                    'post_status'    => 'publish',
                    'orderby'        => 'date',
                    'order'          => 'DESC',
                    'no_found_rows'  => true, // Optimasi performa
                ) );

                if ( $recent_posts->have_posts() ) :
                    while ( $recent_posts->have_posts() ) :
                        $recent_posts->the_post();
                        ?>
                        <article class="recent-post-item">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <div class="recent-post-thumbnail">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail( 'thumbnail', array( 'alt' => get_the_title() ) ); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                            
                            <div class="recent-post-content">
                                <h4 class="recent-post-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h4>
                                
                                <div class="recent-post-meta">
                                    <span class="post-date">
                                        <i class="date-icon">📅</i>
                                        <?php echo get_the_date( 'M j, Y' ); ?>
                                    </span>
                                </div>
                            </div>
                        </article>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                    ?>
                    <p class="no-recent-posts">Belum ada artikel terbaru.</p>
                    <?php
                endif;
                ?>
            </div>
        </div>
    </section>

    <!-- Widget Layanan Populer -->
    <section class="widget widget-services">
        <h3 class="widget-title">
            <i class="service-icon">🔧</i>
            Layanan Populer
        </h3>
        <div class="widget-content">
            <ul class="services-list">
                <li class="service-item">
                    <span class="service-icon-android">📱</span>
                    <a href="<?php echo home_url('/layanan/'); ?>">Service Android</a>
                </li>
                <li class="service-item">
                    <span class="service-icon-iphone">🍎</span>
                    <a href="<?php echo home_url('/layanan/'); ?>">Service iPhone</a>
                </li>
                <li class="service-item">
                    <span class="service-icon-screen">💻</span>
                    <a href="<?php echo home_url('/layanan/'); ?>">Ganti LCD/Touchscreen</a>
                </li>
                <li class="service-item">
                    <span class="service-icon-battery">🔋</span>
                    <a href="<?php echo home_url('/layanan/'); ?>">Ganti Baterai</a>
                </li>
                <li class="service-item">
                    <span class="service-icon-unlock">🔓</span>
                    <a href="<?php echo home_url('/layanan/'); ?>">Unlock Bootloader</a>
                </li>
                <li class="service-item">
                    <span class="service-icon-software">⚙️</span>
                    <a href="<?php echo home_url('/layanan/'); ?>">Install Ulang Software</a>
                </li>
            </ul>
        </div>
    </section>

    <!-- Widget Media Sosial -->
    <section class="widget widget-social">
        <h3 class="widget-title">
            <i class="social-icon">🌐</i>
            Ikuti Kami
        </h3>
        <div class="widget-content">
            <div class="social-links">
                <a href="https://www.facebook.com/Nazxreolll/" target="_blank" rel="noopener" class="social-link facebook">
                    <span class="social-icon-fb">📘</span>
                    <span class="social-text">Facebook</span>
                </a>
                
                <a href="https://www.instagram.com/nazroelcell_/" target="_blank" rel="noopener" class="social-link instagram">
                    <span class="social-icon-ig">📷</span>
                    <span class="social-text">Instagram</span>
                </a>
                
                <a href="https://wa.me/6285786834468" target="_blank" rel="noopener" class="social-link whatsapp">
                    <span class="social-icon-wa">💬</span>
                    <span class="social-text">WhatsApp</span>
                </a>
                
            </div>
        </div>
    </section>

    <!-- Widget Arsip Artikel -->
    <section class="widget widget-archives">
        <h3 class="widget-title">
            <i class="archive-icon">📚</i>
            Arsip Artikel
        </h3>
        <div class="widget-content">
            <ul class="archives-list">
                <?php 
                wp_get_archives( array(
                    'type'            => 'monthly',
                    'limit'           => 12, // Tampilkan 12 bulan terakhir
                    'format'          => 'html',
                    'before'          => '',
                    'after'           => '',
                    'show_post_count' => true,
                    'echo'            => true,
                    'order'           => 'DESC'
                ) );
                ?>
            </ul>
        </div>
    </section>

    <!-- Widget Tag Cloud -->
    <section class="widget widget-tags">
        <h3 class="widget-title">
            <i class="tag-icon">🏷️</i>
            Tag Populer
        </h3>
        <div class="widget-content">
            <div class="tags-cloud">
                <?php
                $tags = get_tags( array(
                    'orderby' => 'count',
                    'order'   => 'DESC',
                    'number'  => 15, // Tampilkan maksimal 15 tag
                ) );

                if ( $tags ) :
                    foreach ( $tags as $tag ) :
                        $tag_link = get_tag_link( $tag->term_id );
                        ?>
                        <a href="<?php echo esc_url( $tag_link ); ?>" class="tag-link" title="<?php echo esc_attr( $tag->description ); ?>">
                            <?php echo esc_html( $tag->name ); ?>
                            <span class="tag-count">(<?php echo $tag->count; ?>)</span>
                        </a>
                        <?php
                    endforeach;
                else :
                    ?>
                    <p class="no-tags">Belum ada tag artikel.</p>
                    <?php
                endif;
                ?>
            </div>
        </div>
    </section>

    <!-- Widget Custom: Call to Action -->
    <section class="widget widget-cta">
        <h3 class="widget-title">
            <i class="cta-icon">🚀</i>
            Butuh Service HP?
        </h3>
        <div class="widget-content">
            <div class="cta-content">
                <p class="cta-text">
                    HP rusak? Jangan khawatir! Tim teknisi berpengalaman kami siap membantu memperbaiki perangkat Anda dengan cepat dan terpercaya.
                </p>
                
                <div class="cta-buttons">
                    <a href="https://wa.me/6285786834468?text=Halo%2C%20saya%20ingin%20konsultasi%20service%20HP" 
                       target="_blank" 
                       rel="noopener" 
                       class="cta-button whatsapp-cta">
                        💬 Chat WhatsApp
                    </a>
                    
                    <a href="<?php echo home_url('/hubungi-kami/'); ?>" 
                       class="cta-button contact-cta">
                        📞 Hubungi Kami
                    </a>
                </div>
            </div>
        </div>
    </section>

    <?php
    // Tampilkan widget area dinamis jika tersedia
    if ( is_active_sidebar( 'sidebar-1' ) ) :
        dynamic_sidebar( 'sidebar-1' );
    endif;
    ?>

</aside><!-- #secondary -->

<?php endif; ?>