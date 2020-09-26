<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title><?php wp_title($sep = ' - ', true, $seplocation = 'right'); bloginfo( 'name' ); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta charset="<?php bloginfo( 'charset' ); ?>">

    <!-- Wordpress style.css & CSS -->
    <link href="<?php bloginfo('stylesheet_url'); ?>" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/style/style.css?v=<?php echo filemtime(get_template_directory(). '/style/style.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/style/hamburgers.css?v=<?php echo filemtime(get_template_directory(). '/style/hamburgers.css'); ?>">

    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="57x57" href="<?php echo get_template_directory_uri(); ?>/assets/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?php echo get_template_directory_uri(); ?>/assets/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/assets/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo get_template_directory_uri(); ?>/assets/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_template_directory_uri(); ?>/assets/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo get_template_directory_uri(); ?>/assets/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo get_template_directory_uri(); ?>/assets/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo get_template_directory_uri(); ?>/assets/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/assets/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="<?php echo get_template_directory_uri(); ?>/assets/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/assets/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?php echo get_template_directory_uri(); ?>/assets/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>/assets/favicon/favicon-16x16.png">
    <link rel="manifest" href="<?php echo get_template_directory_uri(); ?>/assets/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/assets/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <?php wp_head() ?>
</head>

<body <?php body_class(); ?>>

    <?php wp_body_open(); ?>

    <?php 
        // Ticker in Header
        get_template_part( 'template-parts/ticker' ); 
    ?>
    
    <div class="wrapper">

        <?php 
            // Language Switch
            get_template_part( 'template-parts/language-switcher' ); 
        ?>

        <?php
            // Home Button
            if (!is_front_page()) : ?>
                <a href="<?php echo get_home_url(); ?>" class="home-link" id="home-link"></a>

        <?php endif; ?>

        <main id="site-content" role="main">