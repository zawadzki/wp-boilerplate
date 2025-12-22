<?php

if (! defined('ABSPATH')) {
    exit;
}

/** @var array $content_builder */
/** @var int|string $post_id */
if (empty($content_builder) || ! is_array($content_builder)) {
    return;
}

foreach ($content_builder as $block) {
    if (! is_array($block) || empty($block['acf_fc_layout'])) {
        continue;
    }

    $layout = sanitize_key($block['acf_fc_layout']);

    // each layout file: views/blocks/content-builder/{layout}.php
    Z_Content_Builder_Views::render(
        'blocks/content-builder/'.$layout.'.php',
        [
            'block' => $block,
            'layout' => $layout,
            'post_id' => $post_id ?? null,
        ]
    );
}
