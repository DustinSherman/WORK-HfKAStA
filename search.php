<?php 
    // Template for search results

    get_header();

    global $wp_query;
    $result_max_words = 10;
?>

<div class="entry-header">

    <div class="boxes box-layout-00">
        <div class="backgroundbox backgroundbox_01"></div>
        <div class="backgroundbox backgroundbox_02"></div>
        <div class="backgroundbox backgroundbox_03"></div>
        <div class="backgroundbox backgroundbox_04"></div>
    </div>

    <?php     
        if ( $wp_query->found_posts ) {
            ?>
                <h1><?php pll_e('Suchergebnis für'); ?> "<?php echo get_search_query(); ?>"</h1>
            <?php
        } else {
            ?>
                <h1><?php pll_e('Keine Suchergebnis für'); ?> "<?php echo get_search_query() ?>"</h1>
            <?php
        }
    ?>

</div>

<?php

    if ( have_posts() ) {
        ?>
            <div class="content">
                <?php
                    while ( have_posts() ) {
                        the_post();
                        ?>
                            <a href="<?php the_permalink(); ?>" class="search-result-link">
                                <h3><?php the_title(); ?></h3>
                                <p>
                                    <?php
                                        $text_padding = 100;
                                        $key_word = get_search_query();
                                        $str = wp_strip_all_tags(get_the_content());
                                        $str_pos = stripos($str, get_search_query());

                                        $str_start = ($str_pos - $text_padding < 0) ? 0 : stripos($str, ' ', $str_pos - $text_padding);
                                        $str_end = ($str_pos + $text_padding > strlen($str)) ? strlen($str) :  stripos($str, ' ', $str_pos + $text_padding);

                                        $result = substr($str, $str_start, $str_end);
                                        
                                        $result = substr($result, 0, $text_padding * 2 + strlen($key_word));
                                        $result = substr_replace($result, '<strong>', ($str_pos - $str_start), 0);
                                        $result = substr_replace($result, '</strong>', (($str_pos - $str_start) + strlen($key_word) + strlen('<strong>')), 0);

                                        echo $result.'...';
                                    ?>
                                </p>
                                <span><?php the_permalink(); ?></span>
                            </a>
                        <?php
                    }
                ?>
            </div>
        <?php
    }
?>

<?php get_footer(); ?>