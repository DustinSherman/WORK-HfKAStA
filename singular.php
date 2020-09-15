<?php
/**
 * The template for displaying single posts and pages.
 */

get_header();
?>

    <?php get_template_part( 'template-parts/ticker' ); ?>

    <div class="wrapper">

    <?php get_template_part( 'template-parts/language-switcher' ); ?>

    <main id="site-content" role="main">

        <?php

        if ( have_posts() ) {

            while ( have_posts() ) {
                the_post();

                get_template_part( 'template-parts/content', get_post_type() );
            }
        }

        ?>

        <?php get_template_part( 'template-parts/elevator' ); ?>

    </main><!-- #site-content -->

        <?php get_template_part( 'template-parts/main-navigation' ); ?>

    </div>

<?php get_footer(); ?>