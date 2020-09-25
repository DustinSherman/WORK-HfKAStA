<?php 
    // Template for regular content-pages

    get_header(); 
?>

    <?php get_template_part( 'template-parts/entry-header' ); ?>

    <div class="content">
        <?php the_content(); ?>
        <?php if (!is_home()) : ?>
            <p class="last-update-info"><i><small>Zuletzt geändert am: <?php echo get_the_modified_time( 'j. F Y' ); ?></small></i></p>
        <?php endif; ?>
    </div>

    <div class="content_sidebar-note" id="content_sidebar-note_anchor">
        <?php get_template_part( 'template-parts/sidebar-content' ); ?>
    </div>

<?php get_footer(); ?>