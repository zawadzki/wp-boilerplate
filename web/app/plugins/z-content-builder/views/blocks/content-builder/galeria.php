<?php
if (! defined('ABSPATH')) {
    exit;
}

/** @var array $block */
$gallery = $block['galeria'] ?? [];
if (empty($gallery) || ! is_array($gallery)) {
    return;
}
?>
<div class="l-article__gallery js-gallery" data-ui-pswp>
    <?php foreach ($gallery as $image) {
        if (empty($image['sizes'])) {
            continue;
        }

        $href = $image['sizes']['gallery-md'] ?? '';
        $src = $image['sizes']['gallery-sm'] ?? '';
        $w = $image['sizes']['gallery-md-width'] ?? '';
        $h = $image['sizes']['gallery-md-height'] ?? '';
        ?>
        <figure>
            <a class="js-gallery-item"
               href="<?= esc_url($href); ?>"
               data-pswp-width="<?= esc_attr($w); ?>"
               data-pswp-height="<?= esc_attr($h); ?>"
               data-cropped="true"
               target="_blank" rel="noopener">
                <img src="<?= esc_url($src); ?>" alt="<?= esc_attr($image['alt'] ?? ''); ?>">
            </a>

            <?php if (! empty($image['caption'])) { ?>
                <figcaption><?= esc_html($image['caption']); ?></figcaption>
            <?php } ?>
        </figure>
    <?php } ?>
</div>
