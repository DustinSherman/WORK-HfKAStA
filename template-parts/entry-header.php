<header class="entry-header has-text-align-center">

	<div class="entry-header-inner section-inner">

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

            <h1><?php echo the_title(); ?></h1>

        <?php endif; ?>

        <?php 
            // Display note-line and note
            if (get_field('note', $term)) : ?>

            <div class="note-line">
                <?php $note_line = random_int(0, 3); ?>
                <object type="image/svg+xml" data="<?php echo get_template_directory_uri(); ?>/assets/note_line_<?php echo $note_line; ?>.svg" class="svg-object"></object>
            </div>

            <div class="note">
                <p>
                    <?php the_field('note', $term); ?>
                </p>
            </div>

        <?php endif; ?>

    </div>

</header>
