            <?php if (!is_front_page()) : ?>
                <?php get_template_part( 'template-parts/elevator' ); ?>
            <?php endif; ?>

        </main>

        <?php get_template_part( 'template-parts/main-navigation' ); ?>

    </div>

    <footer id="footer">
        <?php
            wp_nav_menu( 
                array(
                    'theme_location' => 'footer',
                    'menu' => 'Footer'
                )
            ); 
        ?>
    </footer>
    
    <script src="<?php echo get_template_directory_uri(); ?>/assets/smooth-scroll.min.js"></script>
    <script>
        var scroll = new SmoothScroll('a[href*="#"]', {
            speed: 300
        });
    </script>
    <script src="<?php echo get_template_directory_uri(); ?>/assets/script.js"></script>
    <div id="ticker-style"></div>
    </body>

    <?php wp_footer(); ?>

</html>