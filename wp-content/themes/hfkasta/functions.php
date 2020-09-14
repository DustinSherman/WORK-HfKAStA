<?php
    // Register new Navigations
    function register_menus() {
        register_nav_menus(
            array(
                'main' => __( 'Main' ),
                'footer' => __( 'Footer' ),
                'language-switch' => __( 'Language-Switch' )
            )
        );
    }
    add_action( 'init', 'register_menus' );
    
    // Add Element to Menu Items with children
    function prefix_add_button_after_menu_item_children( $item_output, $item, $depth, $args ) {
        if ( in_array( 'menu-item-has-children', $item->classes ) || in_array( 'page_item_has_children', $item->classes ) ) {
            $item_output = str_replace( $args->link_after . '</a>', $args->link_after . '</a><div class="dropdown"></div>', $item_output );
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
?>