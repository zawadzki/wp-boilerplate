<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @author zawdam
 * @package system
 */

get_header();

global $post;
$post_id = $post->ID;
$post_title = $post->post_title;
?>

<?php $thumbnail_id = get_post_thumbnail_id($post->ID); ?>
<?php $featured_img_url = get_the_post_thumbnail_url($post->ID, 'header-img'); ?>
<?php $featured_img_alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true); ?>
<?php $featured_img_caption = get_the_post_thumbnail_caption($post->ID); ?>

    <header class="l-header">
        <nav class="l-breadcrumb">
            <ul>
                <li><a href="/">Strona główna</a></li>
                <li><a href="/aktualnosci">Aktualności</a></li>
                <li><span>Przykładowa strona testowa</span></li>
            </ul>
        </nav>

        <div class="l-container">
            <figure>
                <img src="<?php echo $featured_img_url; ?>" alt="<?php echo $featured_img_alt; ?>">
                <?php if($featured_img_caption): ?>
                    <figcaption><?php echo $featured_img_caption; ?></figcaption>
                <?php endif; ?>
            </figure>

            <div class="l-header__content">
                <h1><?php echo get_the_title(); ?></h1>
            </div>
        </div>
    </header>
    <div class="l-header__footer">
        <div class="l-container">
            <div class="c-tags">
                <a href="term.html" class="c-tag">Gatunek</a>
                <a href="term.html" class="c-tag">Rodzaj</a>
                <a href="term.html" class="c-tag">Miejsce</a>
            </div>
            <time>23.12.23</time>
        </div>
    </div>

    <main class="l-main" id="main">

        <?php echo do_shortcode('[intui_content_builder id="'.$post_id.'"]'); ?>

        <section class="l-section l-section--bg l-section--bg--light">
            <div class="l-container__text">
                <div class="l-heading">
                    <h2>Powiązane</h2>
                    <div class="l-heading__actions">
                        <a href="archive.html" class="c-button c-button--icon--right c-button--transparent c-button--xl">Przejdź do aktualności <i class="icon icon-arrow-right"></i></a>
                    </div>
                </div>
                <div class="l-heading__footer">
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus accusantium animi asperiores aut beatae
                        consequatur debitis, dicta facere fugiat labore modi nobis odit placeat porro provident.
                    </p>
                </div>
                <div class="l-post__articles">
                    <div class="l-post">
                        <figure class="l-post__img">
                            <a href="single.html" tabindex="-1">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/img-412x412.jpg" alt="Image">
                            </a>
                        </figure>
                        <div class="l-post__info">
                            <time>23.12.23</time>
                            <div class="l-post__tags__scroll">
                                <div class="l-post__tags c-tags">
                                    <a href="term.html" class="c-tag">Gatunek</a>
                                    <a href="term.html" class="c-tag">Rodzaj</a>
                                    <a href="term.html" class="c-tag">Miejsce</a>
                                </div>
                            </div>
                        </div>
                        <div class="l-post__content">
                            <h3><a href="single.html" tabindex="-1">Przykładowa strona testowa</a></h3>
                            <p>
                                <a href="single.html" tabindex="-1">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis consectetur et libero magnam qui...
                                </a>
                            </p>
                        </div>
                        <a href="single.html" class="l-post__button c-button c-button--icon--right c-button--outlined">Czytaj więcej <i class="icon icon-arrow-right"></i></a>
                    </div>

                    <div class="l-post">
                        <figure class="l-post__img">
                            <a href="single.html" tabindex="-1">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/img-412x412.jpg" alt="Image">
                            </a>
                        </figure>
                        <div class="l-post__info">
                            <time>23.12.23</time>
                            <div class="l-post__tags__scroll">
                                <div class="l-post__tags c-tags">
                                    <a href="term.html" class="c-tag">Gatunek</a>
                                    <a href="term.html" class="c-tag">Rodzaj</a>
                                    <a href="term.html" class="c-tag">Miejsce</a>
                                </div>
                            </div>
                        </div>
                        <div class="l-post__content">
                            <h3><a href="single.html" tabindex="-1">Przykładowa strona testowa</a></h3>
                            <p>
                                <a href="single.html" tabindex="-1">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis consectetur et libero magnam qui...
                                </a>
                            </p>
                        </div>
                        <a href="single.html" class="l-post__button c-button c-button--icon--right c-button--outlined">Czytaj więcej <i class="icon icon-arrow-right"></i></a>
                    </div>

                    <div class="l-post">
                        <figure class="l-post__img">
                            <a href="single.html" tabindex="-1">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/img-412x412.jpg" alt="Image">
                            </a>
                        </figure>
                        <div class="l-post__info">
                            <time>23.12.23</time>
                            <div class="l-post__tags__scroll">
                                <div class="l-post__tags c-tags">
                                    <a href="term.html" class="c-tag">Gatunek</a>
                                    <a href="term.html" class="c-tag">Rodzaj</a>
                                    <a href="term.html" class="c-tag">Miejsce</a>
                                </div>
                            </div>
                        </div>
                        <div class="l-post__content">
                            <h3><a href="single.html" tabindex="-1">Przykładowa strona testowa</a></h3>
                            <p>
                                <a href="single.html" tabindex="-1">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis consectetur et libero magnam qui...
                                </a>
                            </p>
                        </div>
                        <a href="single.html" class="l-post__button c-button c-button--icon--right c-button--outlined">Czytaj więcej <i class="icon icon-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </section>

    </main>

<?php
get_footer();