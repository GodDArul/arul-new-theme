<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Arul_New_Theme
 */

get_header(); // Memuat file header.php

?>

<main id="primary" class="site-main">
    <div class="container">
        <!-- Judul Halaman Blog -->
        <header class="page-header">
            <h1 class="page-title">BLOG KAMI</h1>
            <p class="archive-description">Temukan tips, berita, dan informasi terbaru seputar gadget dan perbaikan.</p>
        </header><!-- .page-header -->

        <!-- Wrapper untuk Konten Blog (Sekarang satu kolom) -->
        <div class="blog-page-wrapper">
            <!-- Kolom Utama Konten Blog -->
            <div class="blog-content-area">
                <?php
                if ( have_posts() ) :
                    /* Start the Loop */
                    while ( have_posts() ) :
                        the_post();
                        ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class( 'blog-post-card' ); ?>>
                            <?php if ( has_post_thumbnail() ) : ?>
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail( 'large', array( 'class' => 'post-thumbnail' ) ); ?>
                                </a>
                            <?php endif; ?>

                            <div class="post-card-content">
                                <header class="entry-header">
                                    <?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
                                    <div class="entry-meta">
                                        <span class="posted-on">Diposting pada: <?php echo get_the_date(); ?></span>
                                        <span class="byline">Oleh: <?php the_author(); ?></span>
                                        <span class="cat-links">Kategori: <?php the_category( ', ' ); ?></span>
                                    </div>
                                </header><!-- .entry-header -->

                                <div class="entry-content">
                                    <?php the_excerpt(); // Menampilkan ringkasan postingan ?>
                                    
                                    <!-- Ini adalah tombol 'Baca Selengkapnya' yang pertama dan yang ingin kita pertahankan. -->
                                    <div class="read-more-button-top"> 
                                        <a href="<?php the_permalink(); ?>" class="btn-read-more">
                                            Baca Selengkapnya &rarr;
                                        </a>
                                    </div>
                                </div><!-- .entry-content -->

                                <!--
                                    HAPUS ATAU KOMENTARI BLOK KODE INI UNTUK MENGHILANGKAN TOMBOL KEDUA!
                                    Tombol ini terletak di dalam footer setiap artikel, setelah ringkasan konten.
                                -->
                                <?php /*
                                <footer class="entry-footer">
                                    <a href="<?php the_permalink(); ?>" class="read-more">Baca Selengkapnya</a>
                                </footer><!-- .entry-footer -->
                                */ ?>
                            </div><!-- .post-card-content -->
                        </article><!-- #post-<?php the_ID(); ?> -->
                        <?php
                    endwhile;

                    // Menampilkan navigasi paginasi jika ada lebih dari satu halaman
                    the_posts_navigation( array(
                        'prev_text'          => '<span class="nav-prev">' . esc_html__( 'Sebelumnya', 'arul-new-theme' ) . '</span>',
                        'next_text'          => '<span class="nav-next">' . esc_html__( 'Selanjutnya', 'arul-new-theme' ) . '</span>',
                        'screen_reader_text' => esc_html__( 'Navigasi Halaman', 'arul-new-theme' ),
                    ) );

                else :
                    // Jika tidak ada postingan
                    ?>
                    <p>Maaf, tidak ada postingan yang ditemukan.</p>
                <?php endif; ?>
            </div><!-- .blog-content-area -->

        </div><!-- .blog-page-wrapper -->

    </div><!-- .container -->
</main><!-- #primary -->

<?php get_footer(); // Memuat file footer.php ?>
