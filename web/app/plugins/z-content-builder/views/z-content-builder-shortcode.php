<?php
$content_lead = get_field('content_lead', $id);
$content_builder = get_field('content_builder', $id);

if ($content_lead || $content_builder) { ?>
    <article class="l-article">
        <?php if ($content_lead) { ?>
            <div class="l-article__lead">
                <?= wpautop($content_lead); ?>
            </div>
        <?php } ?>

        <?php Z_Content_Builder_Views::render('blocks/content-builder.php', [
            'content_builder' => $content_builder,
            'post_id' => $id,
        ]); ?>
    </article>
<?php } ?>
