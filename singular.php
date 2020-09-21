<?php 
    // Template for regular content-pages

    get_header(); 
?>

    <?php get_template_part( 'template-parts/entry-header' ); ?>

    <div class="content">
        <?php the_content(); ?>
    </div>

<?php get_footer(); ?>