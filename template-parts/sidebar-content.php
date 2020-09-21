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

    if ($sidebar_note): ?>
    <div class="sidebar_note">
        <p>
            <?php echo $sidebar_note; ?>
        </p>
    </div>
<?php endif; ?>