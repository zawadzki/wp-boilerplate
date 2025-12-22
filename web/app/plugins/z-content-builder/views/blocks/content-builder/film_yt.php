<?php
if (! defined('ABSPATH')) {
    exit;
}

/** @var array $block */
$youtube_id = $block['youtube_id'] ?? '';
$youtube_id = trim((string) $youtube_id);

if (! $youtube_id) {
    return;
}
?>
<div class="l-article__media">
    <figure>
        <iframe
            src="https://www.youtube-nocookie.com/embed/<?= esc_attr($youtube_id); ?>"
            frameborder="0"
            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
            referrerpolicy="strict-origin-when-cross-origin"
            allowfullscreen></iframe>
    </figure>
</div>
