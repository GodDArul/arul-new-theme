<?php
/**
 * The template for displaying category archives
 *
 * Digunakan untuk menampilkan daftar postingan berdasarkan kategori.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#category
 *
 * @package Arul_New_Theme
 */

get_header(); // Memanggil header tema
?>

<main id="primary" class="site-main">
    <div class="container">
        <header class="page-header">
            <?php
            // Menampilkan judul kategori (misal: Kategori: iPhone)
            the_archive_title( '<h1 class="page-title">', '</h1>' ); // the_archive_title() lebih fleksibel
            // Menampilkan deskripsi kategori jika ada
            the_archive_description( '<div class="archive-description">', '</div>' );
            ?>
        </header><!-- .page-header -->

        <!-- Wrapper untuk Konten Blog (Satu kolom) -->
        <div class="blog-page-wrapper">
            <!-- Kolom Utama Konten Blog -->
            <div class="blog-content-area">
                <?php
                if ( have_posts() ) : // Memeriksa apakah ada postingan yang ditemukan
                    /* Memulai Loop WordPress */
                    while ( have_posts() ) : the_post(); // Melakukan perulangan untuk setiap postingan
                        ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class( 'blog-post-card' ); ?>>
                            <?php if ( has_post_thumbnail() ) : // Memeriksa apakah postingan memiliki thumbnail ?>
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail( 'large', array( 'class' => 'post-thumbnail' ) ); // Menampilkan thumbnail postingan ?>
                                </a>
                            <?php endif; ?>

                            <div class="post-card-content">
                                <header class="entry-header">
                                    <?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); // Menampilkan judul postingan ?>
                                    <div class="entry-meta">
                                        <span class="posted-on">Diposting pada: <?php echo get_the_date(); ?></span>
                                        <span class="byline">Oleh: <?php the_author(); ?></span>
                                        <span class="cat-links">Kategori: <?php the_category( ', ' ); ?></span>
                                    </div>
                                </header><!-- .entry-header -->

                                <div class="entry-content">
                                    <?php the_excerpt(); // Menampilkan ringkasan postingan ?>
                                </div><!-- .entry-content -->

                                <footer class="entry-footer">
                                    <a href="<?php the_permalink(); ?>" class="read-more">Baca Selengkapnya</a>
                                </footer><!-- .entry-footer -->
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

                else : // Jika tidak ada postingan ditemukan
                    ?>
                    <p><?php esc_html_e( 'Maaf, tidak ada postingan yang ditemukan di kategori ini.', 'arul-new-theme' ); ?></p>
                    <?php
                endif; // Akhir dari kondisi have_posts()
                ?>
            </div><!-- .blog-content-area -->
        </div><!-- .blog-page-wrapper -->

    </div><!-- .container -->
</main><!-- #primary -->

<?php
get_footer(); // Memanggil footer tema
?>
