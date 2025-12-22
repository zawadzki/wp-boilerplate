<?php
if (! defined('ABSPATH')) {
    exit;
}

/** @var array $block */
$content = $block['tresc'] ?? '';

if ($content) { ?>
    <div class="l-article__block">
        <?= wp_kses_post($content); ?>
    </div>
<?php } ?>