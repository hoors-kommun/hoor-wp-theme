<div class="box">
    <?php if (!$module->hideTitle) : ?>
        <h2 class="box__headline"><?php echo $module->post_title; ?></h4>
    <?php endif; ?>

    <iframe src="<?php echo get_field('iframe_url', $module->ID); ?>" frameborder="0" title="<?php echo $module->post_title; ?>" style="height: <?php echo get_field('iframe_height', $module->ID); ?>px;"></iframe>
</div>
