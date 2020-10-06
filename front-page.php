<?php 

    get_header();

    $show_js_boxes = TRUE;
?>

    <div class="content" id="start">

        <?php if (!$show_js_boxes) : ?>
            <?php the_content(); ?>
        <?php endif; ?>

    </div>

    <?php get_template_part( 'template-parts/sidebar-content' ); ?>

    <?php if ($show_js_boxes) : ?>
        <script src="<?php echo get_template_directory_uri(); ?>/assets/p5.min.js"></script>
        <script src="<?php echo get_template_directory_uri(); ?>/assets/p5.collide2d.min.js"></script>
        <script src="<?php echo get_template_directory_uri(); ?>/assets/boxes.js"></script>
    <?php endif; ?>

<?php get_footer(); ?>