<?php
if (! defined('ABSPATH')) {
    exit;
}

/** @var array $block */
$logotypes = $block['logotypy'] ?? [];
if (empty($logotypes) || ! is_array($logotypes)) {
    return;
}
?>
<div class="l-article__gallery">
    <?php foreach ($logotypes as $image) {
        if (empty($image['sizes'])) {
            continue;
        }
        $src = $image['sizes']['gallery-sm'] ?? '';
        ?>
        <figure>
            <img src="<?= esc_url($src); ?>" alt="<?= esc_attr($image['alt'] ?? ''); ?>">
            <?php if (! empty($image['caption'])) { ?>
                <figcaption><?= esc_html($image['caption']); ?></figcaption>
            <?php } ?>
        </figure>
    <?php } ?>
</div>
