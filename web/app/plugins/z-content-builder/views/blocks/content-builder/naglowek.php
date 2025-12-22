<?php
if (! defined('ABSPATH')) {
    exit;
}

/** @var array $block */
$headline = $block['naglowek'] ?? '';

if ($headline) { ?>
    <h2 id="<?= esc_attr(sanitize_title($headline)); ?>">
        <?= esc_html($headline); ?>
    </h2>
<?php } ?>