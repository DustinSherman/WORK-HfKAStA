<?php 
    // Template for category-pages

    get_header(); 
?>

    <?php get_template_part( 'template-parts/entry-header' ); ?>

    <?php echo "index.php"; ?>

    <?php the_content(); ?>

<?php get_footer(); ?>