<?php if (get_field('sidebar_note')) : ?>
    <div class="sidebar_note">
        <p>
            <?php the_field('sidebar_note'); ?>
        </p>
    </div>
<?php elseif (is_page()) :
    $parentID = $post->post_parent;
    ?>
    <?php if (get_field('sidebar_note', $parentID)) : ?>
        <div class="sidebar_note">
            <p>
                <?php the_field('sidebar_note', $parentID); ?>
            </p>
        </div>
    <?php endif; ?>
<?php endif; ?>