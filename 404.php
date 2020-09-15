<?php
/**
 * The template for displaying the 404 template in the Twenty Twenty theme.
 */

get_header();
?>

<?php get_template_part( 'template-parts/ticker' ); ?>

    <div class="wrapper">

<?php get_template_part( 'template-parts/language-switcher' ); ?>

    <main id="site-content" role="main">

        <div class="section-inner thin error404-content">

            <h1 class="entry-title"><?php _e( 'Page Not Found', 'twentytwenty' ); ?></h1>

            <div class="intro-text"><p><?php _e( 'The page you were looking for could not be found. It might have been removed, renamed, or did not exist in the first place.', 'twentytwenty' ); ?></p></div>

        </div><!-- .section-inner -->

    </main><!-- #site-content -->

        <?php get_template_part( 'template-parts/main-navigation' ); ?>

    </div>

<?php get_footer(); ?>