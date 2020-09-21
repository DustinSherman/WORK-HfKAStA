<?php 
    // Template for category-pages

    get_header(); 
?>

    <?php get_template_part( 'template-parts/entry-header' ); ?>

    <div class="content">
        <?php
            // Post Loop
            $args = array(
                'post_type' => 'post',
                'posts_per_page' => 15
            );

            echo get_the_category();

            $post_query = new WP_Query($args);
            $preview_title_max_words = 10;
            $preview_max_words = 40;

            if($post_query->have_posts() ) {
                while($post_query->have_posts() ) {
                    $post_query->the_post();
                ?>
                    
                    <div class="post-preview">
                        <h3><?php echo wp_trim_words(get_the_title(), $preview_title_max_words); ?></h3>
                        <span><?php the_date(); ?></span>
                        <span class="post-preview-categories">
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
                        <p>
                            <?php 
                                $preview_content = wp_trim_words(get_the_content(), $preview_max_words, '');
                            
                                echo wp_strip_all_tags($preview_content);
                            ?>
                        </p>
                        <div class="post-preview-arrow"></div><span>...</span>
                    </div>
                <?php
                }
            }
        ?>
    </div>

<?php get_footer(); ?>