<?php
    // Register new Navigations
    function register_menus() {
        register_nav_menus(
            array(
                'main' => __( 'Main' ),
                'footer' => __( 'Footer' )
            )
        );
    }
    add_action( 'init', 'register_menus' );
    
    // Add Element to Menu Items with children
    function prefix_add_button_after_menu_item_children( $item_output, $item, $depth, $args ) {
        if ( in_array( 'menu-item-has-children', $item->classes ) || in_array( 'page_item_has_children', $item->classes ) ) {
            $item_output = str_replace( $args->link_after . '</a>', $args->link_after . '</a><div class="dropdown-btn"></div>', $item_output );
        }
    
        return $item_output;
    }
    add_filter( 'walker_nav_menu_start_el', 'prefix_add_button_after_menu_item_children', 10, 4 );

    // Add Class to active Menu Parents
    function wpse_310629_nav_menu_css_class( $classes, $item, $args, $depth ) {
        if ( $depth === 0 ) {
            if ( 
                in_array( 'current-menu-item', $classes ) || 
                in_array( 'current-menu-ancestor', $classes ) 
            ) {
                $classes[] = 'is-open';
            }
        }
    
        return $classes;
    }
    add_filter( 'nav_menu_css_class', 'wpse_310629_nav_menu_css_class', 10, 4 );

    // Limit Menu depth
    function limit_menu_depth( $hook ) {
        if ( $hook != 'nav-menus.php' ) return;
      
        // override default value right after 'nav-menu' JS
        wp_add_inline_script( 'nav-menu', 'wpNavMenu.options.globalMaxDepth = 1;', 'after' );
    }
    add_action( 'admin_enqueue_scripts', 'limit_menu_depth' );

    /**
     * Add support for custom color palettes in Gutenberg.
     */
    function tabor_gutenberg_color_palette() {
        // Disable Custom Colors
        add_theme_support( 'disable-custom-colors' );
        // Editor Color Palette
        add_theme_support(
            'editor-color-palette', array(
                array(
                    'name'  => esc_html__( 'Lila', '@@textdomain' ),
                    'slug' => 'purple',
                    'color' => '#5A00BE',
                ),
                array(
                    'name'  => esc_html__( 'Rot', '@@textdomain' ),
                    'slug' => 'red',
                    'color' => '#D50E31',
                ),
                array(
                    'name'  => esc_html__( 'Türkis', '@@textdomain' ),
                    'slug' => 'turquoise',
                    'color' => '#64F5DC',
                )
            )
        );
    }
    add_action( 'after_setup_theme', 'tabor_gutenberg_color_palette' );

    add_filter( 'allowed_block_types', 'misha_allowed_block_types' );
    function misha_allowed_block_types( $allowed_blocks ) {
        return array(
            'core/image',
            'core/paragraph',
            'core/heading',
            'core/list',
            'core/table',
            'core/button',
            'core/gallery',
            'core/video',
            'core/separator',
            'core/spacer',
            'core/shortcode',
            'core/embed',
            'core-embed/twitter',
            'core-embed/youtube',
            'core-embed/facebook',
            'core-embed/instagram',
            'core-embed/wordpress',
            'core-embed/soundcloud',
            'core-embed/spotify',
            'core-embed/flickr',
            'core-embed/vimeo',
            'core-embed/mixcloud',
            'jetpack/slideshow',
        );
    }

    // [desktoponly] shortcode
    add_shortcode('desktoponly', 'shailan_desktop_only_shortcode');
    function shailan_desktop_only_shortcode($atts, $content = null){
        if( !wp_is_mobile() ){
            return wpautop( do_shortcode( $content ) );
        } else {
            return null;
        }
    }

    // [mobileonly] shortcode
    add_shortcode('mobileonly', 'shailan_mobile_only_shortcode');
    function shailan_mobile_only_shortcode($atts, $content = null){
        if( wp_is_mobile() ){
            return  wpautop( do_shortcode( $content ) );
        } else {
            return null;
        }
    }

    // Register strings
    pll_register_string('Category Menu Title', 'Was möchtest du sehen?', 'Wordpress');
    pll_register_string('Search Result Success', 'Suchergebnis für', 'Wordpress');
    pll_register_string('Search Result Fail', 'Kein Suchergebnis für', 'Wordpress');

    // exclude styling (css) from "The newsletter plugin"
    // see: https://www.thenewsletterplugin.com/documentation/customization/subscription-forms-style/
    add_filter('newsletter_enqueue_style', '__return_false');

    // Remove dashboard widgets
    function remove_dashboard_meta() {
        // remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
        // remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
        remove_meta_box( 'dashboard_primary', 'dashboard', 'normal' );
        remove_meta_box( 'dashboard_secondary', 'dashboard', 'normal' );
        remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
        // remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );
        remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
        remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
        // remove_meta_box( 'dashboard_activity', 'dashboard', 'normal');
    }
    add_action( 'admin_init', 'remove_dashboard_meta' );

    include_once 'organigramm.php';

?>