<?php
if (! defined('ABSPATH')) {
    exit;
}

/** @var array $block */
$links = $block['linki'] ?? [];
if (empty($links) || ! is_array($links)) {
    return;
}
?>
<div class="l-article__links">
    <?php foreach ($links as $row) {
        $link = $row['link'] ?? null;
        if (empty($link) || empty($link['url']) || empty($link['title'])) {
            continue;
        }

        $url = $link['url'];
        $title = $link['title'];
        $target = ! empty($link['target']) ? $link['target'] : '_self';
        ?>
        <div class="l-article__links__item">
            <a href="<?= esc_url($url); ?>" tabindex="-1" target="<?= esc_attr($target); ?>" rel="noopener">
                <?= esc_html($title); ?>
            </a>
            <a href="<?= esc_url($url); ?>" target="<?= esc_attr($target); ?>" rel="noopener" class="c-button c-button--outlined">
                <i class="icon icon-chevron-right"></i>
            </a>
        </div>
    <?php } ?>
</div>
