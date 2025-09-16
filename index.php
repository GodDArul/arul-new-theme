<?php
/**
 * Template utama untuk halaman blog.
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 * @package Arul_New_Theme
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container">
        <!-- Judul Halaman Blog -->
        <header class="page-header">
            <h1 class="page-title"><?php echo esc_html__('BLOG KAMI', 'arul-new-theme'); ?></h1>
            <p class="archive-description"><?php echo esc_html__('Temukan tips, berita, dan informasi terbaru seputar gadget dan perbaikan.', 'arul-new-theme'); ?></p>
        </header><!-- .page-header -->

        <div class="blog-page-wrapper">
            <div class="blog-content-area">
                <?php if ( have_posts() ) : ?>
                    <?php while ( have_posts() ) : the_post(); ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class('blog-post-card'); ?>>
                            <?php if ( has_post_thumbnail() ) : ?>
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('large', array('class' => 'post-thumbnail')); ?>
                                </a>
                            <?php endif; ?>

                            <div class="post-card-content">
                                <header class="entry-header">
                                    <?php the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>'); ?>
                                    <div class="entry-meta">
                                        <span class="posted-on">Diposting pada: <?php echo esc_html(get_the_date()); ?></span>
                                        <span class="byline">Oleh: <?php the_author(); ?></span>
                                        <span class="cat-links">Kategori: <?php the_category(', '); ?></span>
                                    </div>
                                </header><!-- .entry-header -->

                                <div class="entry-content">
                                    <?php the_excerpt(); ?>
                                    <div class="read-more-button-top">
                                        <a href="<?php the_permalink(); ?>" class="btn-read-more">
                                            <?php echo esc_html__('Baca Selengkapnya', 'arul-new-theme'); ?> &rarr;
                                        </a>
                                    </div>
                                </div><!-- .entry-content -->
                            </div><!-- .post-card-content -->
                        </article>
                    <?php endwhile; ?>

                    <?php
                    the_posts_navigation(array(
                        'prev_text'          => '<span class="nav-prev">' . esc_html__('Sebelumnya', 'arul-new-theme') . '</span>',
                        'next_text'          => '<span class="nav-next">' . esc_html__('Selanjutnya', 'arul-new-theme') . '</span>',
                        'screen_reader_text' => esc_html__('Navigasi Halaman', 'arul-new-theme'),
                    ));
                    ?>
                <?php else : ?>
                    <p><?php esc_html_e('Maaf, tidak ada postingan yang ditemukan.', 'arul-new-theme'); ?></p>
                <?php endif; ?>
            </div><!-- .blog-content-area -->
        </div><!-- .blog-page-wrapper -->
    </div><!-- .container -->
</main><!-- #primary -->

<?php get_footer(); ?>
