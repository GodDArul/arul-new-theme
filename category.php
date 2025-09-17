<?php
/**
 * Template untuk menampilkan arsip kategori
 * @package Arul_New_Theme
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container">
        <header class="page-header">
            <?php
            the_archive_title('<h1 class="page-title">', '</h1>');
            the_archive_description('<div class="archive-description">', '</div>');
            ?>
        </header>

        <div class="blog-page-wrapper">
            <div class="blog-content-area">
                <?php if (have_posts()) : ?>
                    <?php while (have_posts()) : the_post(); ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class('blog-post-card'); ?>>
                            <?php if (has_post_thumbnail()) : ?>
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('large', ['class' => 'post-thumbnail']); ?>
                                </a>
                            <?php endif; ?>

                            <div class="post-card-content">
                                <header class="entry-header">
                                    <?php the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>'); ?>
                                    <div class="entry-meta">
                                        <span class="posted-on">Diposting pada: <?php echo get_the_date(); ?></span>
                                        <span class="byline">Oleh: <?php the_author(); ?></span>
                                        <span class="cat-links">Kategori: <?php the_category(', '); ?></span>
                                    </div>
                                </header>
                                <div class="entry-content">
                                    <?php the_excerpt(); ?>
                                </div>
                                <footer class="entry-footer">
                                    <a href="<?php the_permalink(); ?>" class="read-more">Baca Selengkapnya</a>
                                </footer>
                            </div>
                        </article>
                    <?php endwhile; ?>

                    <?php
                    // Paginasi yang lebih optimal
                    the_posts_pagination([
                        'prev_text' => '<span class="nav-prev">' . esc_html__('Sebelumnya', 'arul-new-theme') . '</span>',
                        'next_text' => '<span class="nav-next">' . esc_html__('Selanjutnya', 'arul-new-theme') . '</span>',
                        'screen_reader_text' => esc_html__('Navigasi Halaman', 'arul-new-theme'),
                    ]);
                    ?>

                <?php else : ?>
                    <p><?php esc_html_e('Maaf, tidak ada postingan yang ditemukan di kategori ini.', 'arul-new-theme'); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>
