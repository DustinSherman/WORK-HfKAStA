<?php 
    // Template for regular content-pages

    get_header(); 
?>

    <?php get_template_part( 'template-parts/entry-header' ); ?>

    <div class="content">
        <?php the_content(); ?>
        <?php if (!is_front_page()) : ?>
            <p class="last-update-info"><i><small><?php pll_e('Zuletzt geändert am:'); ?> <?php echo get_the_modified_time( 'j. F Y' ); ?></small></i></p>
        <?php endif; ?>
    </div>

    <?php get_template_part( 'template-parts/sidebar-content' ); ?>

<?php get_footer(); ?>