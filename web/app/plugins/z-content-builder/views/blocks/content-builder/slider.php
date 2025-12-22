<?php
if (! defined('ABSPATH')) {
    exit;
}

/** @var array $block */
$slider = $block['slider'] ?? [];
$slider_arrows = ! empty($block['slider_arrows']);
$slider_bullets = ! empty($block['slider_bullets']); // currently not used in markup (kept for future)

if (empty($slider) || ! is_array($slider)) {
    return;
}
?>
<div class="c-news__slider js-slider is-peek">
    <div class="swiper"
         data-ui-content-builder-slider
         data-speed="900"
         data-loop="true">
        <div class="swiper-wrapper">
            <?php foreach ($slider as $image) {
                if (empty($image['sizes'])) {
                    continue;
                }
                $src = $image['sizes']['photo-md'] ?? '';
                ?>
                <div class="swiper-slide">
                    <div class="c-news__slider__item">
                        <figure>
                            <img src="<?= esc_url($src); ?>" alt="<?= esc_attr($image['alt'] ?? ''); ?>">
                        </figure>
                    </div>
                </div>
            <?php } ?>
        </div>

        <?php if ($slider_arrows) { ?>
            <div class="swiper__header">
                <nav class="swiper__navigation">
                    <button class="swiper__button swiper__button--prev" type="button">
                        <span class="visually-hidden">Poprzedni slide</span>
                        <i class="icon icon-arrow-left"></i>
                    </button>
                    <button class="swiper__button swiper__button--next" type="button">
                        <span class="visually-hidden">Następny slide</span>
                        <i class="icon icon-arrow-right"></i>
                    </button>
                </nav>
            </div>
        <?php } ?>
    </div>
</div>
