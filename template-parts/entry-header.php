<?php
/**
 * Displays header
 */

?>

<header class="entry-header has-text-align-center">

	<div class="entry-header-inner section-inner">

        <?php
        /**
         * Background images / blocks.
         * TODO should be moved to CSS
         *
         **/

        if (get_field('background_boxes') !== 'no-boxes') : ?>
            <div class="<?php the_field('background_boxes') ?>">
                <div class="backgroundbox backgroundbox_01"></div>
                <div class="backgroundbox backgroundbox_02"></div>
                <div class="backgroundbox backgroundbox_03"></div>
                <div class="backgroundbox backgroundbox_04"></div>
            </div>
        <?php endif; ?>

        <?php

		if ( is_singular() ) {
			the_title( '<h1 class="entry-title">', '</h1>' );
		} else {
			the_title( '<h2 class="entry-title heading-size-1"><a href="' . esc_url( get_permalink() ) . '">', '</a></h2>' );
		}

        if (has_category() ) {
        ?>

        <div class="entry-meta">
            <div class="entry-meta-inner">
                <p class="entry-meta-date"><? the_date() ?></p>
                <p class="entry-meta-categories"</p><?php the_category( ' ' ); ?></p>
            </div><!-- .entry-meta-inner -->
        </div><!-- .meta-categories -->

        <?php
		}

        if ( is_singular() ) {

        $note = get_field('note');
        if ( $note ) :
            ?>
            <img src="<?php echo get_template_directory_uri(); ?>/assets/note_line.svg" class="note-line">
            <div class="note">
                <p>
                    <?php the_field('note'); ?>
                </p>
            </div>
        <?php endif; ?>
        <?php } ?>

    </div><!-- .entry-header-inner -->

</header><!-- .entry-header -->
