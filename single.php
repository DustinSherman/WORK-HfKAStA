<?php 
    // Template for posts

    get_header();
?>

    <div class="content">
        <h4><?php the_title(); ?></h4>
        <p class="post-subline">
            <span class="post-date"><?php the_date(); ?></span>
            <span class="post-subline-seperator">&nbsp;|&nbsp;</span>
            <span class="post-categories">
                <?php 
                    $categories = wp_get_post_categories( get_the_ID() );
                    $iteration = 0;

                    foreach($categories as $c){
                        $cat = get_category( $c );
                        $cat_id = get_cat_ID( $cat->name );

                        if ($cat->slug != 'ticker' && $cat->slug != 'allgemein') {
                            if ($iteration != 0) {
                                echo ', ';
                            }

                            echo '<a href="'.get_category_link($cat_id).'">'.$cat->name.'</a>';

                            $iteration++;
                        }
                    }
                ?>
            </span>
        </p>

        <?php the_content(); ?>
    </div>

<?php get_footer(); ?>