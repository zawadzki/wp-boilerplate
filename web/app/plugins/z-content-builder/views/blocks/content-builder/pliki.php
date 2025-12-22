<?php
if (! defined('ABSPATH')) {
    exit;
}

/** @var array $block */
$files = $block['pliki'] ?? [];
if (empty($files) || ! is_array($files)) {
    return;
}
?>
<div class="l-article__links">
    <?php foreach ($files as $row) {
        $file = $row['plik'] ?? null;
        if (empty($file) || empty($file['url']) || empty($file['title'])) {
            continue;
        }

        $url = $file['url'];
        $title = $file['title'];

        $path_info = pathinfo($url);
        $ext = $path_info['extension'] ?? '';

        $size_label = '';
        if (! empty($file['ID'])) {
            $attached = get_attached_file((int) $file['ID']);
            if ($attached && file_exists($attached)) {
                $size_label = size_format(filesize($attached));
            }
        }
        ?>
        <div class="l-article__links__item">
            <a href="<?= esc_url($url); ?>" tabindex="-1" download>
                <?= esc_html($title.($ext ? '.'.$ext : '')); ?>
            </a>

            <?php if ($ext) { ?>
                <i class="icon icon-file-type icon-file-type-<?= esc_attr(strtolower($ext)); ?>"></i>
            <?php } ?>

            <?php if ($size_label) { ?>
                <span>[<?= esc_html($size_label); ?>]</span>
            <?php } ?>

            <a href="<?= esc_url($url); ?>" class="c-button" download>
                <i class="icon icon-download"></i>
            </a>
        </div>
    <?php } ?>
</div>
