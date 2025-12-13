<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @author zawdam
 * @package system
 */

get_header();
?>

    <header class="l-header">
        <nav class="l-breadcrumb">
            <ul>
                <li><a href="/">Strona główna</a></li>
                <li><span>Aktualności</span></li>
            </ul>
        </nav>
    </header>

    <main class="l-main" id="main">

        <section class="l-section">
            <div class="l-container__text">
                <div class="l-heading">
                    <h1>Aktualności</h1>
                    <div class="l-heading__actions">
                        <button id="js-filters" class="c-button c-button--icon--right c-button--transparent c-button--xl" aria-expanded="false">Filtruj <i class="icon icon-filter"></i></button>
                        <div id="js-filters-popup" class="c-filters__popup">
                            <span class="c-filters__arrow"></span>
                            <header class="c-filters__header">
                                <button id="js-filters-popup-close" class="c-button c-button--transparent c-button--md" tabindex="-1"><i class="icon icon-close"></i></button>
                            </header>
                            <div class="c-filters">
                                <div class="c-filters__row">
                                    <h3>Gatunek</h3>
                                    <div class="c-filters__list">
                                        <button class="c-tag" tabindex="-1">Gatunek #1</button>
                                        <button class="c-tag" tabindex="-1">Gatunek #2</button>
                                        <button class="c-tag" tabindex="-1">Gatunek #3</button>
                                    </div>
                                </div>
                                <div class="c-filters__row">
                                    <h3>Rodzaj</h3>
                                    <div class="c-filters__list">
                                        <button class="c-tag" tabindex="-1">Rodzaj #1</button>
                                        <button class="c-tag" tabindex="-1">Rodzaj #2</button>
                                        <button class="c-tag" tabindex="-1">Rodzaj #3</button>
                                    </div>
                                </div>
                                <div class="c-filters__row">
                                    <h3>Miejsce</h3>
                                    <div class="c-filters__list">
                                        <button class="c-tag" tabindex="-1">Miejsce #1</button>
                                        <button class="c-tag" tabindex="-1">Miejsce #2</button>
                                        <button class="c-tag" tabindex="-1">Miejsce #3</button>
                                    </div>
                                </div>
                            </div>
                            <footer class="c-filters__footer">
                                <button class="c-button c-button--xs" tabindex="-1">Zastosuj</button>
                                <button class="c-button c-button--transparent c-button--xs" tabindex="-1">Resetuj</button>
                            </footer>
                        </div>
                        <div id="js-filters-popup-blocker" class="c-filters__blocker"></div>
                    </div>
                </div>
                <div class="l-heading__footer">
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus accusantium animi asperiores aut beatae
                        consequatur debitis, dicta facere fugiat labore modi nobis odit placeat porro provident.
                    </p>
                </div>
                <div class="c-filters__active">
                    <h4>Aktywne filtry</h4>
                    <div class="c-filters__list">
                        <button class="c-tag" tabindex="0">Miejsce #1</button>
                        <button class="c-tag" tabindex="0">Miejsce #2</button>
                        <button class="c-tag" tabindex="0">Miejsce #3</button>
                    </div>
                </div>
                <div class="l-post__articles">
                    <div class="l-post" data-featured="true">
                        <figure class="l-post__img">
                            <a href="/aktualności/przykladowa-strona-testowa/" tabindex="-1">
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
                            <h3><a href="/aktualności/przykladowa-strona-testowa/" tabindex="-1">Przykładowa strona testowa</a></h3>
                            <p>
                                <a href="/aktualności/przykladowa-strona-testowa/" tabindex="-1">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis consectetur et libero magnam qui...
                                </a>
                            </p>
                        </div>
                        <a href="/aktualności/przykladowa-strona-testowa/" class="l-post__button c-button c-button--icon--right c-button--outlined">Czytaj więcej <i class="icon icon-arrow-right"></i></a>
                    </div>

                    <div class="l-post">
                        <figure class="l-post__img">
                            <a href="/aktualności/przykladowa-strona-testowa/" tabindex="-1">
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
                            <h3><a href="/aktualności/przykladowa-strona-testowa/" tabindex="-1">Przykładowa strona testowa</a></h3>
                            <p>
                                <a href="/aktualności/przykladowa-strona-testowa/" tabindex="-1">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis consectetur et libero magnam qui...
                                </a>
                            </p>
                        </div>
                        <a href="/aktualności/przykladowa-strona-testowa/" class="l-post__button c-button c-button--icon--right c-button--outlined">Czytaj więcej <i class="icon icon-arrow-right"></i></a>
                    </div>

                    <div class="l-post">
                        <figure class="l-post__img">
                            <a href="/aktualności/przykladowa-strona-testowa/" tabindex="-1">
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
                            <h3><a href="/aktualności/przykladowa-strona-testowa/" tabindex="-1">Przykładowa strona testowa</a></h3>
                            <p>
                                <a href="/aktualności/przykladowa-strona-testowa/" tabindex="-1">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis consectetur et libero magnam qui...
                                </a>
                            </p>
                        </div>
                        <a href="/aktualności/przykladowa-strona-testowa/" class="l-post__button c-button c-button--icon--right c-button--outlined">Czytaj więcej <i class="icon icon-arrow-right"></i></a>
                    </div>

                    <div class="l-post">
                        <figure class="l-post__img">
                            <a href="/aktualności/przykladowa-strona-testowa/" tabindex="-1">
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
                            <h3><a href="/aktualności/przykladowa-strona-testowa/" tabindex="-1">Przykładowa strona testowa dłuższy tytuł</a></h3>
                            <p>
                                <a href="/aktualności/przykladowa-strona-testowa/" tabindex="-1">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis consectetur et libero magnam qui...
                                </a>
                            </p>
                        </div>
                        <a href="/aktualności/przykladowa-strona-testowa/" class="l-post__button c-button c-button--icon--right c-button--outlined">Czytaj więcej <i class="icon icon-arrow-right"></i></a>
                    </div>

                    <div class="l-post">
                        <figure class="l-post__img">
                            <a href="/aktualności/przykladowa-strona-testowa/" tabindex="-1">
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
                            <h3><a href="/aktualności/przykladowa-strona-testowa/" tabindex="-1">Przykładowa strona testowa jeszcze bardziej dłuższy tytuł</a></h3>
                            <p>
                                <a href="/aktualności/przykladowa-strona-testowa/" tabindex="-1">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis consectetur et libero magnam qui...
                                </a>
                            </p>
                        </div>
                        <div class="l-post__link">
                            <a href="/aktualności/przykladowa-strona-testowa/" class="l-post__button c-button c-button--icon--right c-button--outlined">Czytaj więcej <i class="icon icon-arrow-right"></i></a>
                        </div>
                    </div>

                    <div class="l-post">
                        <figure class="l-post__img">
                            <a href="/aktualności/przykladowa-strona-testowa/" tabindex="-1">
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
                            <h3><a href="/aktualności/przykladowa-strona-testowa/" tabindex="-1">Przykładowa strona testowa</a></h3>
                            <p>
                                <a href="/aktualności/przykladowa-strona-testowa/" tabindex="-1">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis consectetur et libero magnam qui...
                                </a>
                            </p>
                        </div>
                        <a href="/aktualności/przykladowa-strona-testowa/" class="l-post__button c-button c-button--icon--right c-button--outlined">Czytaj więcej <i class="icon icon-arrow-right"></i></a>
                    </div>

                    <div class="l-post">
                        <figure class="l-post__img">
                            <a href="/aktualności/przykladowa-strona-testowa/" tabindex="-1">
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
                            <h3><a href="/aktualności/przykladowa-strona-testowa/" tabindex="-1">Przykładowa strona testowa</a></h3>
                            <p>
                                <a href="/aktualności/przykladowa-strona-testowa/" tabindex="-1">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis consectetur et libero magnam qui...
                                </a>
                            </p>
                        </div>
                        <a href="/aktualności/przykladowa-strona-testowa/" class="l-post__button c-button c-button--icon--right c-button--outlined">Czytaj więcej <i class="icon icon-arrow-right"></i></a>
                    </div>

                    <div class="l-post">
                        <figure class="l-post__img">
                            <a href="/aktualności/przykladowa-strona-testowa/" tabindex="-1">
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
                            <h3><a href="/aktualności/przykladowa-strona-testowa/" tabindex="-1">Przykładowa strona testowa</a></h3>
                            <p>
                                <a href="/aktualności/przykladowa-strona-testowa/" tabindex="-1">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis consectetur et libero magnam qui...
                                </a>
                            </p>
                        </div>
                        <a href="/aktualności/przykladowa-strona-testowa/" class="l-post__button c-button c-button--icon--right c-button--outlined">Czytaj więcej <i class="icon icon-arrow-right"></i></a>
                    </div>

                    <div class="l-post">
                        <figure class="l-post__img">
                            <a href="/aktualności/przykladowa-strona-testowa/" tabindex="-1">
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
                            <h3><a href="/aktualności/przykladowa-strona-testowa/" tabindex="-1">Przykładowa strona testowa</a></h3>
                            <p>
                                <a href="/aktualności/przykladowa-strona-testowa/" tabindex="-1">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis consectetur et libero magnam qui...
                                </a>
                            </p>
                        </div>
                        <a href="/aktualności/przykladowa-strona-testowa/" class="l-post__button c-button c-button--icon--right c-button--outlined">Czytaj więcej <i class="icon icon-arrow-right"></i></a>
                    </div>
                </div>
                <div class="c-button__container">
                    <button class="c-button c-button--xl">Wczytaj więcej</button>
                </div>
            </div>
        </section>

    </main>

<?php
get_sidebar();
get_footer();
