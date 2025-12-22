<?php
if (! defined('ABSPATH')) {
    exit;
}

/** @var array $block */
/** @var int $index */
$items = $block['akordeon'] ?? [];
if (empty($items) || ! is_array($items)) {
    return;
}

$base = 'acc-'.($index ?? 0).'-'.wp_generate_uuid4();
?>
<div class="l-accordion">
    <?php foreach ($items as $k => $item) {
        $title = $item['tytul'] ?? '';
        $content = $item['tresc'] ?? '';

        if (! $title) {
            continue;
        }

        $id = sanitize_title($title);
        $id = $base.'-'.$k.'-'.$id;
        ?>
        <div class="l-accordion__control">
            <input class="visually-hidden" id="<?= esc_attr($id); ?>" type="checkbox">
            <h3>
                <label for="<?= esc_attr($id); ?>">
                    <span><?= esc_html($title); ?></span>
                    <i class="icon icon-chevron-down"></i>
                </label>
            </h3>
        </div>

        <div class="l-accordion__panel" id="<?= esc_attr($id); ?>_panel" style="display: none;">
            <?= wp_kses_post($content); ?>
        </div>
    <?php } ?>
</div>
