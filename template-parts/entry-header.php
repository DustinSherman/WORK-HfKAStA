<div class="entry-header">

    <?php 
        $term = get_queried_object();

        if (get_field('background_boxes', $term) !== 'no-boxes') : ?>

        <div class="boxes <?php the_field('background_boxes', $term) ?>">
            <div class="backgroundbox backgroundbox_01"></div>
            <div class="backgroundbox backgroundbox_02"></div>
            <div class="backgroundbox backgroundbox_03"></div>
            <div class="backgroundbox backgroundbox_04"></div>
        </div>
    <?php endif; ?>

    <?php if (is_category() ) : ?>

        <?php 
            // Display Custom Title or Title of category
            if (get_field('custom_title', $term)) : ?>
            <h1><?php the_field('custom_title', $term); ?></h1>
        <?php else : ?>
            <h1><?php echo single_cat_title(); ?></h1>
        <?php endif; ?>

        
        <?php 
            // Display Category Description
            if (category_description($term)) : ?>

            <div class="category-description">
                <?php echo category_description($term); ?>
            </div>

        <?php endif; ?>

    <?php else : ?>

        <h1>
            <?php the_title(); ?>
        </h1>

    <?php endif; ?>

    <?php 
        // Display note-line and note
        $note_line = random_int(1, 2);
        if (get_field('note', $term)) : ?>

        <div class="note-line note-swoosh-<?php echo $note_line; ?>">
            <div class="note">
                <p>
                    <?php the_field('note', $term); ?>
                </p>
            </div>
        </div>

    <?php endif; ?>

    <?php
    $sidebar_note = get_field('sidebar_note');
    if (empty($sidebar_note)) {
        if (is_page()){
            $object_id = wp_get_post_parent_id($post);
        } elseif(is_single()) {
            $object_id = get_the_category() ? get_the_category()[0] : false;
        } else{
            $object_id = $wp_query->get_queried_object();
        }

        if ($object_id) {
            $sidebar_note = get_field('sidebar_note', $object_id);
        }
    }

    // Display arrow to navigate to sidebar-notes
    if ($sidebar_note): ?>

        <?php if (get_field('hint_to_sidebar_note', $term)) : ?>

            <div class="sidebar_note_link">

                <a href="#content_sidebar-note_anchor" onclick="scroll()" class="scroll">

                    <span><?php the_field('hint_to_sidebar_note', $term); ?></span>

                    <div class="sidebar_note_arrow"></div>

                </a>

            </div>
        <?php endif; ?>



    <?php endif; ?>

</div>
