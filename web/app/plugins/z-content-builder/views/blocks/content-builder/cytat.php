<?php
if (! defined('ABSPATH')) {
    exit;
}

/** @var array $block */
$content = $block['cytat_tresc'] ?? '';
$sign = $block['cytat_podpis'] ?? '';

if ($content) { ?>
    <blockquote>
        <p><?= esc_html($content); ?></p>
        <?php if ($sign) { ?>
            <cite><?= esc_html($sign); ?></cite>
        <?php } ?>
    </blockquote>
<?php } ?>
