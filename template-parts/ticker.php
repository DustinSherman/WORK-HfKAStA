<?php 
    // the query
    $the_query = new WP_Query( array(
        'posts_per_page' => 3,
        'category_name' => 'ticker'
    )); 
?>

<div class="ticker-wrap">
    <div class="ticker" id="ticker">
        <?php if ( $the_query->have_posts() ) : ?>
            <?php for ($i = 0 ; $i < 4; $i++) : ?>
                <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                    <?php 
                        $ticker_max_words = 10;

                        $message = wp_trim_words(get_field('ticker_message') ? get_field('ticker_message') : get_the_title(), $ticker_max_words);

                        $message = wp_strip_all_tags($message);
                    ?>
                    <div class="news">
                        <?php /* Link wenn, der post keinen Inhalt hat oder der externe Link gesetzt ist. */ ?>
                        <?php if ( '' !== get_post()->post_content || !empty(get_post_meta($post->ID,'me_spr_post_redirect',true)) ) : ?>
                            <a href="<?php echo get_permalink(); ?>"><p><?php echo $message; ?></p></a>
                        <?php else : ?>
                            <p><?php echo $message; ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="news_seperator"> + + + </div>
                <?php endwhile; ?>
            <?php endfor; ?>
            <?php wp_reset_postdata(); ?>
        <?php endif; ?>
    </div>
</div>