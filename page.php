<?php
/**
 * The template for displaying all single pages
 *
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-page
 *
 * @package Arul_New_Theme
 */

get_header(); // Memuat header.php
?>

<main id="primary" class="site-main">
    <div class="container">
        <?php
        // Memulai Loop WordPress untuk halaman statis
        if ( have_posts() ) :
            while ( have_posts() ) : the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header">
                        <?php the_title( '<h1 class="entry-title">', '</h1>' ); // Menampilkan judul halaman ?>
                    </header><!-- .entry-header -->

                    <div class="entry-content">
                        <?php
                        the_content(); // Menampilkan konten utama dari halaman tersebut
                        // Ini adalah fungsi kunci untuk menampilkan isi yang kamu tulis di editor halaman WordPress
                        ?>
                    </div><!-- .entry-content -->
                </article><!-- #post-<?php the_ID(); ?> -->
                <?php
            endwhile; // Akhir dari Loop
        else :
            // Jika tidak ada konten halaman ditemukan
            ?>
            <p><?php esc_html_e( 'Maaf, tidak ada konten yang ditemukan untuk halaman ini.', 'arul-new-theme' ); ?></p>
        <?php endif; ?>
    </div><!-- .container -->
</main><!-- #primary -->

<?php
get_footer(); // Memuat footer.php
?>
