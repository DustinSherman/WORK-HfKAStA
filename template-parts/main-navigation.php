<div class="hamburger hamburger--squeeze" id="hamburger">
    <div class="hamburger-box">
        <div class="hamburger-inner"></div>
    </div>
</div>

<nav id="nav">
    <!-- original place for hamburger -->

    <?php if (get_field('sidebar_note_top')) : ?>
        <div class="sidebar_note_top">
            <p>
                <?php the_field('sidebar_note_top'); ?>
            </p>
        </div>
    <?php endif; ?>
    
    <div class="nav_content">
        <?php get_search_form(); ?>

        <?php
            wp_nav_menu( 
                array(
                    'theme_location' => 'main',
                    'menu' => 'Main'
                )
            );
        ?>
    </div>

    <?php get_template_part( 'template-parts/sidebar-content' ); ?>

</nav>