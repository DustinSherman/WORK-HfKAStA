<?php 
    // Template for category-pages

    get_header();

    // Excluded categories
    $ticker_cat_id = get_cat_id('ticker');
    $preview_title_max_words = 10;
    $preview_max_words = 40;

    global $post;
?>

    <?php get_template_part( 'template-parts/entry-header' ); ?>

    <div class="content">

        <div class="category-menu">

            <h4><?php pll_e('Was möchtest du sehen?'); ?></h4>

            <?php wp_list_categories(array(
                'title_li' => '',
                'exclude' => array(
                    $ticker_cat_id
                ),
            )); ?>
        </div>

        <?php 
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $default_posts_per_page = get_option( 'posts_per_page' );

            $data= new WP_Query(array(
                'post_type'=>'post', // your post type name
                'posts_per_page' => $default_posts_per_page, // post per page
                'paged' => $paged,
            ));

            if($data->have_posts()) : ?>
                <div class="post-list">
                <?php while($data->have_posts())  : $data->the_post(); ?>
                    <div class="post-preview">
                        <a href="<?php the_permalink(); ?>">
                            <h3><?php echo wp_trim_words(get_the_title(), $preview_title_max_words); ?></h3>
                        </a>
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
                        <a href="<?php the_permalink(); ?>">
                            <div class="post-preview-arrow"></div><span>...</span>
                        </a>
                    </div>
                <?php endwhile; ?>
                </div>
                <div class="pagination">
                    <?php
                        next_posts_link( '' );
                        previous_posts_link( '' ); 
                    ?>
                </div>
        <?php else :?>
            <h3>
                <?php _e('404 Error&#58; Not Found', ''); ?>
            </h3>
        <?php endif; ?>
        <?php wp_reset_postdata();?>
    </div>


<?php get_footer(); ?>