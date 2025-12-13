<?php $i = 0; ?>
<?php $content_lead = get_field('content_lead', $id); ?>
<?php $content_builder = get_field('content_builder', $id); ?>

<?php if ($content_lead || $content_builder) { ?>
    <article class="l-article">
        <?php if ($content_lead) { ?>
            <div class="l-article__lead">
                <?php echo wpautop($content_lead); ?>
            </div>
        <?php } ?>
        <?php if ($content_builder) { ?>
            <?php foreach ($content_builder as $content) { ?>
                <?php switch ($content['acf_fc_layout']) {
                    case 'naglowek': ?>
                        <?php $heading = $content['naglowek']; ?>
                        <?php if ($heading) { ?>
                            <h2 id="<?php echo sanitize_title($heading); ?>"><?php echo $heading; ?></h2>
                        <?php } ?>
                        <?php break; ?>
                    <?php case 'tresc': ?>
                        <?php $content = $content['tresc']; ?>
                        <?php if ($content) { ?>
                            <div class="l-article__block">
                                <?php echo $content; ?>
                            </div>
                        <?php } ?>
                        <?php break; ?>
                    <?php case 'cytat': ?>
                        <?php $cytat_tresc = $content['cytat_tresc']; ?>
                        <?php $cytat_podpis = $content['cytat_podpis']; ?>
                        <?php if ($cytat_tresc) { ?>
                            <blockquote>
                                <p><?php echo $cytat_tresc; ?></p>
                                <?php if ($cytat_podpis) { ?>
                                    <cite><?php echo $cytat_podpis; ?></cite>
                                <?php } ?>
                            </blockquote>
                        <?php } ?>
                        <?php break; ?>
                    <?php case 'fotografie': ?>
                        <?php $photos = $content['fotografie']; ?>
                        <div class="l-article__photo <?php echo count($photos) >= 2 ? 'l-article__photo--multi' : ''; ?> js-gallery"  data-ui-pswp>
                            <?php foreach ($photos as $photo) { ?>
                                <?php $photo = $photo['fotografia']; ?>
                                <figure>
                                    <a class="js-gallery-item" href="<?php echo esc_url($photo['sizes']['photo']); ?>" data-pswp-width="<?php echo $image['sizes']['photo'.'-width']; ?>" data-pswp-height="<?php echo $image['sizes']['photo'.'-height']; ?>" data-cropped="true" target="_blank">
                                        <img src="<?php echo esc_url($photo['sizes']['photo-md']); ?>" alt="<?php echo $photo['alt']; ?>">
                                    </a>
                                    <?php if ($photo['caption']) { ?>
                                        <figcaption>
                                            <?php echo esc_html($photo['caption']); ?>
                                        </figcaption>
                                    <?php } ?>
                                </figure>
                            <?php } ?>
                        </div>
                        <?php break; ?>
                    <?php case 'galeria': ?>
                        <?php $gallery = $content['galeria']; ?>
                        <?php if ($gallery) { ?>
                            <div class="l-article__gallery js-gallery" data-ui-pswp>
                                <?php foreach ($gallery as $image) { ?>
                                    <figure>
                                        <a class="js-gallery-item" href="<?php echo esc_url($image['sizes']['gallery-md']); ?>" data-pswp-width="<?php echo $image['sizes']['gallery-md'.'-width']; ?>" data-pswp-height="<?php echo $image['sizes']['gallery-md'.'-height']; ?>" data-cropped="true" target="_blank">
                                            <img src="<?php echo esc_url($image['sizes']['gallery-sm']); ?>" alt="Obraz Główny: <?php echo $image['alt']; ?>"/>
                                        </a>
                                        <?php if ($image['caption']) { ?>
                                            <figcaption>
                                                <?php echo esc_html($image['caption']); ?>
                                            </figcaption>
                                        <?php } ?>
                                    </figure>
                                <?php } ?>
                                <?php $i++; ?>
                            </div>
                        <?php } ?>
                        <?php break; ?>
                    <?php case 'slider': ?>
                        <?php $slider = $content['slider']; ?>
                        <?php $slider_arrows = $content['slider_arrows']; ?>
                        <?php $slider_bullets = $content['slider_bullets']; ?>
                        <?php if ($slider) { ?>
                            <div class="c-news__slider js-slider is-peek">
                                <div class="swiper"
                                     data-ui-content-builder-slider
                                     data-speed="900"
                                     data-loop="true"
                                >
                                    <div class="swiper-wrapper">
                                        <?php foreach ($slider as $image) { ?>
                                            <div class="swiper-slide">
                                                <div class="c-news__slider__item">
                                                    <figure>
                                                        <img src="<?php echo esc_url($image['sizes']['photo-md']); ?>" alt="Slajd: <?php echo $image['alt']; ?>"/>
                                                    </figure>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <?php if ($slider_arrows) { ?>
                                        <div class="swiper__header">
                                            <nav class="swiper__navigation">
                                                <button class="swiper__button swiper__button--prev">
                                                    <span class="visually-hidden">Poprzedni slide</span>
                                                    <i class="icon icon-arrow-left"></i>
                                                </button>
                                                <button class="swiper__button swiper__button--next">
                                                    <span class="visually-hidden">Następny slide</span>
                                                    <i class="icon icon-arrow-right"></i>
                                                </button>
                                            </nav>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>
                        <?php break; ?>
                    <?php case 'logotypy': ?>
                        <?php $logotypes = $content['logotypy']; ?>
                        <?php if ($logotypes) { ?>
                            <div class="l-article__gallery">
                                <?php foreach ($logotypes as $image) { ?>
                                    <figure>
                                        <img src="<?php echo esc_url($image['sizes']['gallery-sm']); ?>" alt="Obraz Główny: <?php echo $image['alt']; ?>"/>
                                        <?php if ($image['caption']) { ?>
                                            <figcaption>
                                                <?php echo esc_html($image['caption']); ?>
                                            </figcaption>
                                        <?php } ?>
                                    </figure>
                                <?php } ?>
                                <?php $i++; ?>
                            </div>
                        <?php } ?>
                        <?php break; ?>
                    <?php case 'linki': ?>
                        <?php $links = $content['linki']; ?>
                        <?php if ($links) { ?>
                            <div class="l-article__links">
                                <?php foreach ($links as $link) { ?>
                                    <?php
                                    $link = $link['link'];
                                    $link_url = $link['url'];
                                    $link_title = $link['title'];
                                    $link_target = $link['target'] ? $link['target'] : '_self';
                                    if ($link) { ?>
                                        <div class="l-article__links__item">
                                            <a href="<?php echo esc_url($link_url); ?>" tabindex="-1" target="<?php echo $link_target; ?>"><?php echo esc_html($link_title); ?></a>
                                            <a href="<?php echo esc_url($link_url); ?>" target="<?php echo $link_target; ?>" class="c-button c-button--outlined"><i class="icon icon-chevron-right"></i></a>
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                        <?php break; ?>
                    <?php case 'pliki': ?>
                        <?php $files = $content['pliki']; ?>
                        <?php if ($files) { ?>
                            <div class="l-article__links">
                                <?php foreach ($files as $file) { ?>
                                    <?php
                                    $file = $file['plik'];
                                    $file_url = $file['url'];
                                    $file_title = $file['title'];
                                    $path_info = pathinfo($file_url);
                                    if ($file) { ?>
                                    <div class="l-article__links__item">
                                        <a href="<?php echo esc_url($file_url); ?>" tabindex="-1" download><?php echo esc_html($file_title).'.'.$path_info['extension']; ?></a>
                                        <i class="icon icon-file-type icon-file-type-<?php echo $path_info['extension']; ?>"></i>
                                        <span>[<?php echo size_format(filesize(get_attached_file($file['ID']))); ?>]</span>
                                        <a href="<?php echo esc_url($file_url); ?>" class="c-button" download><i class="icon icon-download"></i></a>
                                    </div>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                        <?php break; ?>
                    <?php case 'film_yt': ?>
                        <?php $youtube_id = $content['youtube_id']; ?>
                        <?php if ($youtube_id) { ?>
                            <div class="l-article__media">
                                <figure>
                                    <iframe src="https://www.youtube.com/embed/<?php echo $youtube_id; ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                                </figure>
                            </div>
                        <?php } ?>
                        <?php break; ?>
                    <?php case 'separator': ?>
                        <div class="l-article__separator">
                            <hr/>
                        </div>
                        <?php break; ?>
                    <?php case 'akordeon': ?>
                        <?php $akordeon = $content['akordeon']; ?>
                        <div class="l-accordion">
                            <?php foreach ($akordeon as $item) { ?>
                                <?php $tytul = $item['tytul']; ?>
                                <?php $tresc = $item['tresc']; ?>
                                <div class="l-accordion__control">
                                    <input class="visually-hidden" id="<?php echo sanitize_title($tytul); ?>" type="checkbox"/>
                                    <h3>
                                        <label for="<?php echo sanitize_title($tytul); ?>"><span><?php echo $tytul; ?></span> <i class="icon icon-chevron-down"></i></label>
                                    </h3>
                                </div>
                                <div class="l-accordion__panel" id="<?php echo sanitize_title($tytul); ?>_panel" style="display: none;">
                                    <?php echo $tresc; ?>
                                </div>
                            <?php } ?>
                        </div>
                        <?php break; ?>
                    <?php } ?>
            <?php } ?>
        <?php } ?>
    </article>
<?php } ?>