<?php
/**
 * Template untuk menampilkan single post (artikel blog)
 * Template ini akan menampilkan artikel lengkap dengan sidebar
 * Digunakan untuk menampilkan konten lengkap dari satu postingan.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#single
 * @package Arul_New_Theme
 */

get_header();
?>

<main id="primary" class="site-main">
    <!-- Container dengan class dinamis untuk layout sidebar -->
    <div class="container <?php echo esc_attr( arul_new_theme_container_class() ); ?>">
        
        <!-- Area Konten Artikel -->
        <section class="blog-detail">
            <?php
            // Loop postingan tunggal
            if ( have_posts() ) :
                while ( have_posts() ) : the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    
                    <!-- Header Artikel -->
                    <header class="entry-header">
                        <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                        
                        <div class="entry-meta">
                            <span class="posted-on">
                                <i class="date-icon">📅</i>
                                <strong>Diposting:</strong> <?php echo get_the_date( 'M j, Y' ); ?>
                            </span>
                            
                            <span class="byline">
                                <i class="author-icon">👤</i>
                                <strong>Penulis:</strong> 
                                <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
                                    <?php the_author(); ?>
                                </a>
                            </span>
                            
                            <?php if ( has_category() ) : ?>
                                <span class="cat-links">
                                    <i class="category-icon">📂</i>
                                    <strong>Kategori:</strong> 
                                    <?php the_category( ', ' ); ?>
                                </span>
                            <?php endif; ?>
                            
                            <?php if ( has_tag() ) : ?>
                                <span class="tags-links">
                                    <i class="tag-icon">🏷️</i>
                                    <strong>Tag:</strong> 
                                    <?php the_tags( '', ', ' ); ?>
                                </span>
                            <?php endif; ?>
                            
                            <!-- Tambahan: Waktu baca dan jumlah views -->
                            <span class="reading-time">
                                <i class="time-icon">⏱️</i>
                                <strong>Estimasi baca:</strong> 
                                <?php 
                                $word_count = str_word_count( strip_tags( get_the_content() ) );
                                $reading_time = ceil( $word_count / 200 ); // 200 words per minute
                                echo $reading_time . ' menit';
                                ?>
                            </span>
                        </div>
                    </header><!-- .entry-header -->

                    <!-- Featured Image dengan styling yang lebih baik -->
                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="post-thumbnail">
                            <figure class="featured-image-wrapper">
                                <?php 
                                the_post_thumbnail( 'arul-featured-large', array( 
                                    'class' => 'featured-image',
                                    'alt'   => get_the_title(),
                                    'loading' => 'eager' // Prioritas tinggi untuk featured image
                                ) ); 
                                ?>
                                <!-- Caption jika ada -->
                                <?php 
                                $caption = get_the_post_thumbnail_caption();
                                if ( $caption ) :
                                ?>
                                    <figcaption class="featured-image-caption">
                                        <?php echo esc_html( $caption ); ?>
                                    </figcaption>
                                <?php endif; ?>
                            </figure>
                        </div>
                    <?php endif; ?>

                    <!-- Konten Artikel -->
                    <div class="entry-content">
                        <?php
                        // Menampilkan konten lengkap dari postingan
                        the_content();
                        
                        // Pagination untuk konten yang menggunakan <!--nextpage-->
                        wp_link_pages( array(
                            'before'      => '<div class="page-links"><strong>Halaman:</strong> ',
                            'after'       => '</div>',
                            'link_before' => '<span class="page-number">',
                            'link_after'  => '</span>',
                            'pagelink'    => '%',
                        ) );
                        ?>
                    </div><!-- .entry-content -->

                    <!-- Footer Artikel -->
                    <footer class="entry-footer">
                        
                        <!-- Tags Section (jika ada) -->
                        <?php if ( has_tag() ) : ?>
                            <div class="article-tags">
                                <h4><i class="tag-icon">🏷️</i> Tags Artikel:</h4>
                                <div class="tags-list">
                                    <?php 
                                    $tags = get_the_tags();
                                    if ( $tags ) :
                                        foreach ( $tags as $tag ) :
                                            $tag_link = get_tag_link( $tag->term_id );
                                            ?>
                                            <a href="<?php echo esc_url( $tag_link ); ?>" class="article-tag">
                                                <?php echo esc_html( $tag->name ); ?>
                                            </a>
                                            <?php
                                        endforeach;
                                    endif;
                                    ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        
                        <!-- Share Buttons -->
                        <div class="share-section">
                            <h4><i class="share-icon">📤</i> Bagikan Artikel:</h4>
                            <div class="share-buttons">
                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode( get_permalink() ); ?>" 
                                   target="_blank" 
                                   rel="noopener nofollow" 
                                   class="share-button facebook">
                                    <span class="share-icon">📘</span>
                                    Facebook
                                </a>
                                
                                <a href="https://wa.me/?text=<?php echo urlencode( get_the_title() . ' - ' . get_permalink() ); ?>" 
                                   target="_blank" 
                                   rel="noopener nofollow" 
                                   class="share-button whatsapp">
                                    <span class="share-icon">💬</span>
                                    WhatsApp
                                </a>
                                
                                <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode( get_permalink() ); ?>&text=<?php echo urlencode( get_the_title() ); ?>" 
                                   target="_blank" 
                                   rel="noopener nofollow" 
                                   class="share-button twitter">
                                    <span class="share-icon">🐦</span>
                                    Twitter
                                </a>
                                
                                <a href="mailto:?subject=<?php echo urlencode( get_the_title() ); ?>&body=<?php echo urlencode( 'Saya ingin berbagi artikel menarik ini: ' . get_permalink() ); ?>" 
                                   class="share-button email">
                                    <span class="share-icon">📧</span>
                                    Email
                                </a>
                            </div>
                        </div>
                        
                        <!-- Call to Action khusus untuk konter HP -->
                        <div class="article-cta">
                            <div class="cta-box">
                                <h4><i class="cta-icon">🔧</i> Butuh Bantuan Service HP?</h4>
                                <p>Artikel ini bermanfaat? Tim NAZROEL CELLULER siap membantu memperbaiki perangkat Anda dengan layanan profesional dan terpercaya.</p>
                                <div class="cta-buttons">
                                    <a href="https://wa.me/6285786834468?text=Halo%2C%20saya%20membaca%20artikel%20<?php echo urlencode( get_the_title() ); ?>%20dan%20ingin%20konsultasi%20service%20HP" 
                                       target="_blank" 
                                       rel="noopener" 
                                       class="cta-button primary">
                                        <span class="btn-icon">💬</span>
                                        Konsultasi WhatsApp
                                    </a>
                                    <a href="<?php echo home_url('/layanan/'); ?>" class="cta-button secondary">
                                        <span class="btn-icon">🔧</span>
                                        Lihat Layanan Kami
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                    </footer><!-- .entry-footer -->
                </article><!-- #post-<?php the_ID(); ?> -->

                <!-- Navigasi Artikel Sebelumnya/Selanjutnya -->
                <nav class="post-navigation" role="navigation" aria-label="Navigasi Artikel">
                    <h2 class="screen-reader-text">Navigasi artikel</h2>
                    <div class="nav-links">
                        <?php
                        $prev_post = get_previous_post();
                        $next_post = get_next_post();
                        
                        if ( $prev_post || $next_post ) :
                        ?>
                            <?php if ( $prev_post ) : ?>
                                <div class="nav-previous">
                                    <a href="<?php echo get_permalink( $prev_post ); ?>" rel="prev">
                                        <span class="nav-direction">← Artikel Sebelumnya</span>
                                        <span class="nav-title"><?php echo get_the_title( $prev_post ); ?></span>
                                        <?php if ( has_post_thumbnail( $prev_post ) ) : ?>
                                            <div class="nav-thumbnail">
                                                <?php echo get_the_post_thumbnail( $prev_post, 'thumbnail' ); ?>
                                            </div>
                                        <?php endif; ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                            
                            <?php if ( $next_post ) : ?>
                                <div class="nav-next">
                                    <a href="<?php echo get_permalink( $next_post ); ?>" rel="next">
                                        <span class="nav-direction">Artikel Selanjutnya →</span>
                                        <span class="nav-title"><?php echo get_the_title( $next_post ); ?></span>
                                        <?php if ( has_post_thumbnail( $next_post ) ) : ?>
                                            <div class="nav-thumbnail">
                                                <?php echo get_the_post_thumbnail( $next_post, 'thumbnail' ); ?>
                                            </div>
                                        <?php endif; ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </nav>

                <!-- Area Komentar -->
                <?php
                if ( comments_open() || get_comments_number() ) :
                ?>
                    <div class="comments-section">
                        <h3><i class="comment-icon">💬</i> Diskusi & Komentar</h3>
                        <?php comments_template(); ?>
                    </div>
                <?php
                endif;
                
                endwhile; // Akhir dari loop postingan
                
            else : // Jika tidak ada postingan ditemukan
                ?>
                <div class="no-content">
                    <h2>Artikel Tidak Ditemukan</h2>
                    <p>Maaf, artikel yang Anda cari tidak dapat ditemukan. Silakan kembali ke halaman utama atau cari artikel lainnya.</p>
                    <div class="no-content-actions">
                        <a href="<?php echo home_url('/'); ?>" class="btn-home">← Kembali ke Beranda</a>
                        <a href="<?php echo home_url('/blog/'); ?>" class="btn-blog">Lihat Semua Artikel</a>
                    </div>
                </div>
                <?php
            endif;
            ?>
        </section><!-- .blog-detail -->
        
        <!-- Sidebar - hanya tampil jika fungsi helper mengembalikan true -->
        <?php if ( arul_new_theme_has_sidebar() ) : ?>
            <?php get_sidebar(); ?>
        <?php endif; ?>
        
    </div><!-- .container -->
</main><!-- #primary -->

<!-- ========== RELATED POSTS SECTION (FULL WIDTH) ========== -->
<?php if ( have_posts() ) : ?>
    <div class="related-posts-wrapper">
        <div class="container">
            <?php nazroel_display_related_posts(); ?>
        </div>
    </div>
<?php endif; ?>
<!-- ========== END RELATED POSTS SECTION ========== -->

<?php
get_footer();
?>