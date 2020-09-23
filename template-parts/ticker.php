<?php 
    // the query
    $the_query = new WP_Query( array(
        'posts_per_page' => 3,
        'category_name' => 'ticker'
    ));

    $ticker_news_count = 6;
?>

<script>
    let tickerNewsCount = <?php echo $ticker_news_count ?>;
</script>

<div class="ticker-wrap">
    <div class="ticker" id="ticker">
        <?php if ( $the_query->have_posts() ) : ?>
            <?php for ($i = 0 ; $i < $ticker_news_count; $i++) : ?>
                <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                    <?php 
                        $ticker_max_words = 10;

                        $message = wp_trim_words(get_field('ticker_message') ? get_field('ticker_message') : get_the_title(), $ticker_max_words);

                        $message = wp_strip_all_tags($message);
                    ?>
                    <div class="news">
                        <a href="<?php echo get_permalink(); ?>"><p><?php echo $message; ?></p></a>
                    </div>
                    <div class="news_seperator"> + + + </div>
                <?php endwhile; ?>
            <?php endfor; ?>
            <?php wp_reset_postdata(); ?>
        <?php endif; ?>
    </div>
</div>