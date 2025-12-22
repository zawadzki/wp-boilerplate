<?php
if (! defined('ABSPATH')) {
    exit;
}

/** @var array $block */
$photos = $block['fotografie'] ?? [];
if (empty($photos) || ! is_array($photos)) {
    return;
}

$multi = count($photos) >= 2;
?>
<div class="l-article__photo <?= $multi ? 'l-article__photo--multi' : ''; ?> js-gallery" data-ui-pswp>
    <?php foreach ($photos as $row) {
        $photo = $row['fotografia'] ?? null;
        if (! $photo || empty($photo['sizes'])) {
            continue;
        }

        $href = $photo['sizes']['photo'] ?? '';
        $src = $photo['sizes']['photo-md'] ?? '';

        $w = $photo['sizes']['photo-width'] ?? '';
        $h = $photo['sizes']['photo-height'] ?? '';
        ?>
        <figure>
            <a class="js-gallery-item"
               href="<?= esc_url($href); ?>"
               data-pswp-width="<?= esc_attr($w); ?>"
               data-pswp-height="<?= esc_attr($h); ?>"
               data-cropped="true"
               target="_blank" rel="noopener">
                <img src="<?= esc_url($src); ?>" alt="<?= esc_attr($photo['alt'] ?? ''); ?>">
            </a>

            <?php if (! empty($photo['caption'])) { ?>
                <figcaption><?= esc_html($photo['caption']); ?></figcaption>
            <?php } ?>
        </figure>
    <?php } ?>
</div>
