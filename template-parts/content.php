<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

    <?php

    get_template_part( 'template-parts/entry-header' );

    ?>

    <div class="post-inner <?php echo is_page_template( 'templates/template-full-width.php' ) ? '' : 'thin'; ?> ">

        <div class="entry-content">

            <?php
            if ( is_search() ) {

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

                echo "<p>$result</p>";

            } elseif (! is_singular() ) {
                the_excerpt();
            } else {
                the_content( __( 'Continue reading', 'twentytwenty' ) );
            }
            ?>

        </div>

    </div>

    <?php

    /**
     *  Output comments wrapper if it's a post, or if comments are open,
     * or if there's a comment number – and check for password.
     * */
    if ( ( is_single() || is_page() ) && ( comments_open() || get_comments_number() ) && ! post_password_required() ) {
        ?>

        <div class="comments-wrapper section-inner">

            <?php comments_template(); ?>

        </div>

        <?php
    }
    ?>

</article><!-- .post -->