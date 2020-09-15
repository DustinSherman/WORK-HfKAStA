<div class="hamburger hamburger--squeeze" id="hamburger">
    <div class="hamburger-box">
        <div class="hamburger-inner"></div>
    </div>
</div>

<nav id="nav">

    <?php get_search_form(); ?>

    <?php
        wp_nav_menu( 
            array(
                'theme_location' => 'main',
                'menu' => 'Main'
            )
        );
    ?>

    <?php get_template_part( 'template-parts/sidebar-content' ); ?>

</nav>