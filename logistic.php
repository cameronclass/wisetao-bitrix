<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php"); ?>
<?
$title = $_GET['direct-china'] == 'from-china' ? 'Логистика' : 'Логистика в Китай';
$APPLICATION->SetPageProperty("title", $title);
?>
<div class="content-page__page">
    <div class="content-page__content">
        <div class="logistic-page">
            <? if ($_GET['direct-china'] == 'from-china'): ?>
            <div class="logistic-main-title">
                <h3 class="group-title">
                    <span class="text-orange">Онлайн</span> расчет <br> стоимости доставки
                    <!--                            и выкупа-->
                </h3>
                <button data-target=".js-how-to-use" data-class="active" class="main-btn _bordered mb-4">Как
                    пользоваться калькулятором?</button>
            </div>


            <!-- How to use -->
            <div class="ask-panel js-how-to-use">
                <div class="ask-panel__bg"></div>
                <div class="ask-panel__content">
                    <button class="js-ask-close">
                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="100" height="100"
                            viewBox="0 0 50 50">
                            <path
                                d="M 9.15625 6.3125 L 6.3125 9.15625 L 22.15625 25 L 6.21875 40.96875 L 9.03125 43.78125 L 25 27.84375 L 40.9375 43.78125 L 43.78125 40.9375 L 27.84375 25 L 43.6875 9.15625 L 40.84375 6.3125 L 25 22.15625 Z">
                            </path>
                        </svg>
                    </button>
                    <div class="ask-panel__maintitle">
                        <span class="text-orange">Как</span> <br> пользоваться
                    </div>
                    <div class="ask-panel__mainsubtitle">
                        <span class="text-orange">Онлайн</span> - калькулятором расчета логистики
                    </div>

                    <div class="how-to-use-slider my-4" data-aos="fade-up">
                        <div class="swiper">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <a class="how-to-use-calc fancy-link" data-width="200px" data-height="400"
                                        href="<?= SITE_TEMPLATE_PATH ?>/assets/video/1.mp4" data-fancybox="gallery">
                                        <span class="how-to-use-calc__img">
                                            <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/how-to-use-calc.jpg"
                                                alt="">
                                        </span>
                                        <span class="how-to-use-calc__icon">
                                            <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/play-icon.svg" alt="">
                                        </span>
                                    </a>
                                </div>
                                <div class="swiper-slide">
                                    <a class="how-to-use-calc fancy-link"
                                        href="<?= SITE_TEMPLATE_PATH ?>/assets/video/2.mp4" data-fancybox="gallery">
                                        <span class="how-to-use-calc__img">
                                            <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/logistic/2.jpg" alt="">
                                        </span>
                                        <span class="how-to-use-calc__icon">
                                            <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/play-icon.svg" alt="">
                                        </span>
                                    </a>
                                </div>
                                <div class="swiper-slide">
                                    <a class="how-to-use-calc fancy-link"
                                        href="<?= SITE_TEMPLATE_PATH ?>/assets/video/3.mp4" data-fancybox="gallery">
                                        <span class="how-to-use-calc__img">
                                            <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/logistic/3.jpg" alt="">
                                        </span>
                                        <span class="how-to-use-calc__icon">
                                            <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/play-icon.svg" alt="">
                                        </span>
                                    </a>
                                </div>
                                <div class="swiper-slide">
                                    <a class="how-to-use-calc fancy-link"
                                        href="<?= SITE_TEMPLATE_PATH ?>/assets/video/4.mp4" data-fancybox="gallery">
                                        <span class="how-to-use-calc__img">
                                            <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/logistic/4.jpg" alt="">
                                        </span>
                                        <span class="how-to-use-calc__icon">
                                            <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/play-icon.svg" alt="">
                                        </span>
                                    </a>
                                </div>
                            </div>
                            <div class="how-to-use-slider__arrows aos-init aos-animate" data-aos="fade-up">
                                <div class="swiper-button-prev"></div>
                                <div class="casePagination">
                                    <div class="swiper-pagination"></div>
                                </div>
                                <div class="swiper-button-next"></div>
                            </div>
                        </div>
                    </div>



                    <div class="ask-panel__subtitle mt-3"><span class="text-orange">Остались вопросы?</span> Задайте
                        вопрос в удобном для вас мессенджере:</div>
                    <div class="ask-panel__contact">
                        <a target="_blank" class="ask-panel__btn _telegram" href="https://t.me/+79676433973">
                            <span>Написать в Telegram</span>
                            <img class="ask-panel__btn_icon"
                                src="<?= SITE_TEMPLATE_PATH ?>/assets/images/icons/telegram-neon.png" alt="">
                        </a>
                        <a target="_blank" class="ask-panel__btn _whatsapp"
                            href="https://api.whatsapp.com/send?phone=8613154567328">
                            <span>Написать в Whatsapp</span>
                            <img class="ask-panel__btn_icon"
                                src="<?= SITE_TEMPLATE_PATH ?>/assets/images/icons/whatsapp-neon.png" alt="">
                        </a>
                        <a target="_blank" class="ask-panel__btn _vk" href="https://vk.me/wisetao">
                            <span>Перейти во Вконтакте</span>
                            <img class="ask-panel__btn_icon"
                                src="<?= SITE_TEMPLATE_PATH ?>/assets/images/icons/vk-neon.png" alt="">
                        </a>
                    </div>
                </div>
            </div>

            <? require_once($_SERVER["DOCUMENT_ROOT"] . "/calc-new/index.php") ?>

            <div class="logistic-check">
                <h3 class="logistic-check__title group-title">Отследить заказ</h3>
                <div class="logistic-check__block">
                    <form class="logistic-check__form">
                        <input type="text" class="logistic-check__form_text" placeholder="Введите номер заказа">
                        <button class="logistic-check__form_btn main-btn">Отследить</button>
                    </form>
                    <div class="logistic-check__error hidden">
                        Заказ не найден или такого номера заказа не существует
                    </div>
                    <div class="logistic-check__info hidden">
                        <div class="logistic-check__item">
                            <div class="logistic-check__item_title">Получатель:</div>
                            <div class="logistic-check__item_text recipient-name">Вася Пупкин</div>
                        </div>
                        <div class="logistic-check__item">
                            <div class="logistic-check__item_title">Конечная точка прибытия:</div>
                            <div class="logistic-check__item_text arrival">Москва</div>
                        </div>
                        <div class="logistic-check__item">
                            <div class="logistic-check__item_title">Ориентировочная дата прибытия:</div>
                            <div class="logistic-check__item_text arrival-date">24.08.2024</div>
                        </div>
                        <div class="logistic-check__item">
                            <div class="logistic-check__item_title">Способ доставки:</div>
                            <div class="logistic-check__item_text delivery-type">Авиа</div>
                        </div>
                        <div class="logistic-check__item">
                            <div class="logistic-check__item_title">Статус:</div>
                            <div class="logistic-check__item_text _paid payment-status">Оплачено</div>
                        </div>
                        <div class="logistic-check__item">
                            <div class="logistic-check__item_title">Объем:</div>
                            <div class="logistic-check__item_text volume">20 <span>м3</span></div>
                        </div>
                        <div class="logistic-check__item">
                            <div class="logistic-check__item_title">Вес:</div>
                            <div class="logistic-check__item_text weight">20 kg</div>
                        </div>
                    </div>
                    <div class="logistic-check__status hidden">
                        <div class="logistic-check__status_item">
                            <span class="logistic-check__status_item_dot">
                                <span class="_dot"></span>
                            </span>
                            <span class="logistic-check__status_item_text">Отправлен, Шенжень (20.08.2024)</span>
                        </div>
                        <div class="logistic-check__status_item _active">
                            <span class="logistic-check__status_item_dot">
                                <span class="_dot"></span>
                            </span>
                            <span class="logistic-check__status_item_text">В пути в сортировочный центр, Бангкок
                                (22.08.2024)</span>
                        </div>
                        <!--                                 Скрытые элементы-->
                        <div class="logistic-check__status_item hidden">
                            <span class="logistic-check__status_item_dot">
                                <span class="_dot"></span>
                            </span>
                            <span class="logistic-check__status_item_text">На пути к заказчику (25.08.2024)</span>
                        </div>
                        <div class="logistic-check__status_item hidden">
                            <span class="logistic-check__status_item_dot">
                                <span class="_dot"></span>
                            </span>
                            <span class="logistic-check__status_item_text">Доставлено (28.08.2024)</span>
                        </div>
                        <button class="logistic-check__status_more">
                            <span>еще</span>
                            <svg width="11" height="7" viewBox="0 0 11 7" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 1L5.5 6L10 1" stroke="white" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <? endif; ?>

            <div class="logistic-shipping">
                <div class="logistic-shipping__block">
                    <?
                    $customOffset = $_GET['direct-china'] == 'from-china' ? 0 : 4;
                    $customOffsetExtra = $_GET['direct-china'] == 'from-china' ? 0 : 4;
                    $customCountExtra = $_GET['direct-china'] == 'from-china' ? 4 : 10;
                    $APPLICATION->IncludeComponent(
                        "bitrix:news.list",
                        "main_services",
                        array(
                            "ACTIVE_DATE_FORMAT" => "d.m.Y",
                            "ADD_SECTIONS_CHAIN" => "N",
                            "AJAX_MODE" => "N",
                            "AJAX_OPTION_ADDITIONAL" => "",
                            "AJAX_OPTION_HISTORY" => "N",
                            "AJAX_OPTION_JUMP" => "N",
                            "AJAX_OPTION_STYLE" => "Y",
                            "CACHE_FILTER" => "N",
                            "CACHE_GROUPS" => "Y",
                            "CACHE_TIME" => "36000000",
                            "CACHE_TYPE" => "A",
                            "CHECK_DATES" => "Y",
                            "DETAIL_URL" => "",
                            "DISPLAY_BOTTOM_PAGER" => "N",
                            "DISPLAY_DATE" => "N",
                            "DISPLAY_NAME" => "N",
                            "DISPLAY_PICTURE" => "Y",
                            "DISPLAY_PREVIEW_TEXT" => "Y",
                            "DISPLAY_TOP_PAGER" => "N",
                            "FIELD_CODE" => array(
                                0 => "ID",
                                1 => "CODE",
                                2 => "NAME",
                                3 => "PREVIEW_TEXT",
                                4 => "PREVIEW_PICTURE",
                                5 => "",
                            ),
                            "FILE_404" => "",
                            "CUSTOM_OFFSET" => $customOffset,
                            "CUSTOM_COUNT" => 4,
                            "FILTER_NAME" => "",
                            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                            "IBLOCK_ID" => "30",
                            "IBLOCK_TYPE" => "main_services",
                            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                            "INCLUDE_SUBSECTIONS" => "N",
                            "MESSAGE_404" => "",
                            "NEWS_COUNT" => "0",
                            "PAGER_BASE_LINK_ENABLE" => "N",
                            "PAGER_DESC_NUMBERING" => "N",
                            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                            "PAGER_SHOW_ALL" => "N",
                            "PAGER_SHOW_ALWAYS" => "N",
                            "PAGER_TEMPLATE" => ".default",
                            "PAGER_TITLE" => "Услуги",
                            "PARENT_SECTION" => "",
                            "PARENT_SECTION_CODE" => "",
                            "PREVIEW_TRUNCATE_LEN" => "",
                            "SET_BROWSER_TITLE" => "N",
                            "SET_LAST_MODIFIED" => "N",
                            "SET_META_DESCRIPTION" => "N",
                            "SET_META_KEYWORDS" => "N",
                            "SET_STATUS_404" => "N",
                            "SET_TITLE" => "N",
                            "SHOW_404" => "N",
                            "SORT_BY1" => "SORT",
                            "SORT_BY2" => "DATE_CREATE",
                            "SORT_ORDER1" => "ASC",
                            "SORT_ORDER2" => "ASC",
                            "COMPONENT_TEMPLATE" => "main_services",
                            "PROPERTY_CODE" => array(
                                0 => "",
                                1 => "",
                            ),
                            "STRICT_SECTION_CHECK" => "N"
                        ),
                        false
                    ); ?>
                    <!--                        -->
                    <?//
//                        $APPLICATION->IncludeComponent("bitrix:news.list", "logistic_about_delivery_types", Array(
//                            "ACTIVE_DATE_FORMAT" => "d.m.Y",
//                            "ADD_SECTIONS_CHAIN" => "N",
//                            "AJAX_MODE" => "N",
//                            "AJAX_OPTION_ADDITIONAL" => "",
//                            "AJAX_OPTION_HISTORY" => "N",
//                            "AJAX_OPTION_JUMP" => "N",
//                            "AJAX_OPTION_STYLE" => "Y",
//                            "CACHE_FILTER" => "N",
//                            "CACHE_GROUPS" => "Y",
//                            "CACHE_TIME" => "36000000",
//                            "CACHE_TYPE" => "A",
//                            "CHECK_DATES" => "Y",
//                            "DETAIL_URL" => "",
//                            "DISPLAY_BOTTOM_PAGER" => "N",
//                            "DISPLAY_DATE" => "N",
//                            "DISPLAY_NAME" => "N",
//                            "DISPLAY_PICTURE" => "Y",
//                            "DISPLAY_PREVIEW_TEXT" => "Y",
//                            "DISPLAY_TOP_PAGER" => "N",
//                            "FIELD_CODE" => array(
//                            0 => "ID",
//                            1 => "CODE",
//                            2 => "NAME",
//                            3 => "PREVIEW_PICTURE",
//                            4 => "PREVIEW_TEXT",
//                            5 => "",
//                            ),
//                            "FILE_404" => "",
//                            "FILTER_NAME" => "",
//                            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
//                            "IBLOCK_ID" => "25",
//                            "IBLOCK_TYPE" => "logistic",
//                            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
//                            "INCLUDE_SUBSECTIONS" => "N",
//                            "MESSAGE_404" => "",
//                            "NEWS_COUNT" => 3,
//                            "PAGER_BASE_LINK_ENABLE" => "N",
//                            "PAGER_DESC_NUMBERING" => "N",
//                            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
//                            "PAGER_SHOW_ALL" => "N",
//                            "PAGER_SHOW_ALWAYS" => "N",
//                            "PAGER_TEMPLATE" => ".default",
//                            "PAGER_TITLE" => "Логистика (о типах доставки)",
//                            "PARENT_SECTION" => "",
//                            "PARENT_SECTION_CODE" => "",
//                            "PREVIEW_TRUNCATE_LEN" => "",
//                            "SET_BROWSER_TITLE" => "N",
//                            "SET_LAST_MODIFIED" => "N",
//                            "SET_META_DESCRIPTION" => "N",
//                            "SET_META_KEYWORDS" => "N",
//                            "SET_STATUS_404" => "N",
//                            "SET_TITLE" => "N",
//                            "SHOW_404" => "N",
//                            "SORT_BY1" => "DATE_CREATE",
//                            "SORT_BY2" => "SORT",
//                            "SORT_ORDER1" => "ASC",
//                            "SORT_ORDER2" => "ASC",
//                            ),
//                            false
//                            ); ?>
                </div>
            </div>

            <div class="logistic-additional block-services">
                <div class="block-services__wrap">
                    <h3 class="logistic-check__title group-title logistic-additional__title">Дополнительные услуги</h3>
                    <div class="block-services__body">
                        <?
                        $APPLICATION->IncludeComponent(
                            "bitrix:news.list",
                            "extra_services",
                            array(
                                "ACTIVE_DATE_FORMAT" => "d.m.Y",
                                "ADD_SECTIONS_CHAIN" => "N",
                                "AJAX_MODE" => "N",
                                "AJAX_OPTION_ADDITIONAL" => "",
                                "AJAX_OPTION_HISTORY" => "N",
                                "AJAX_OPTION_JUMP" => "N",
                                "AJAX_OPTION_STYLE" => "Y",
                                "CACHE_FILTER" => "N",
                                "CACHE_GROUPS" => "Y",
                                "CACHE_TIME" => "36000000",
                                "CACHE_TYPE" => "A",
                                "CHECK_DATES" => "Y",
                                "DETAIL_URL" => "",
                                "DISPLAY_BOTTOM_PAGER" => "N",
                                "DISPLAY_DATE" => "N",
                                "DISPLAY_NAME" => "N",
                                "DISPLAY_PICTURE" => "Y",
                                "DISPLAY_PREVIEW_TEXT" => "Y",
                                "DISPLAY_TOP_PAGER" => "N",
                                "FIELD_CODE" => array(
                                    0 => "ID",
                                    1 => "CODE",
                                    2 => "NAME",
                                    3 => "PREVIEW_TEXT",
                                    4 => "PREVIEW_PICTURE",
                                    5 => "",
                                ),
                                "FILE_404" => "",
                                "CUSTOM_OFFSET" => $customOffsetExtra,
                                "CUSTOM_COUNT" => $customCountExtra,
                                "FILTER_NAME" => "",
                                "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                                "IBLOCK_ID" => "36",
                                "IBLOCK_TYPE" => "extra_services",
                                "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                                "INCLUDE_SUBSECTIONS" => "N",
                                "MESSAGE_404" => "",
                                "NEWS_COUNT" => "0",
                                "PAGER_BASE_LINK_ENABLE" => "N",
                                "PAGER_DESC_NUMBERING" => "N",
                                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                                "PAGER_SHOW_ALL" => "N",
                                "PAGER_SHOW_ALWAYS" => "N",
                                "PAGER_TEMPLATE" => ".default",
                                "PAGER_TITLE" => "Дополнительные услуги",
                                "PARENT_SECTION" => "",
                                "PARENT_SECTION_CODE" => "",
                                "PREVIEW_TRUNCATE_LEN" => "",
                                "SET_BROWSER_TITLE" => "N",
                                "SET_LAST_MODIFIED" => "N",
                                "SET_META_DESCRIPTION" => "N",
                                "SET_META_KEYWORDS" => "N",
                                "SET_STATUS_404" => "N",
                                "SET_TITLE" => "N",
                                "SHOW_404" => "N",
                                "SORT_BY1" => "SORT",
                                "SORT_BY2" => "DATE_CREATE",
                                "SORT_ORDER1" => "ASC",
                                "SORT_ORDER2" => "ASC",
                                "COMPONENT_TEMPLATE" => "extra_services",
                                "PROPERTY_CODE" => array(
                                    0 => "LINK",
                                ),
                                "STRICT_SECTION_CHECK" => "N"
                            ),
                            false
                        );
                        ?>

                    </div>
                </div>
            </div>

            <div class="logistic-about">

                <?
                $APPLICATION->IncludeComponent(
                    "bitrix:news.list",
                    "about_advantages",
                    array(
                        "ACTIVE_DATE_FORMAT" => "d.m.Y",
                        "ADD_SECTIONS_CHAIN" => "N",
                        "AJAX_MODE" => "Y",
                        "AJAX_OPTION_ADDITIONAL" => "",
                        "AJAX_OPTION_HISTORY" => "N",
                        "AJAX_OPTION_JUMP" => "N",
                        "AJAX_OPTION_STYLE" => "Y",
                        "CACHE_FILTER" => "N",
                        "CACHE_GROUPS" => "Y",
                        "CACHE_TIME" => "36000000",
                        "CACHE_TYPE" => "A",
                        "CHECK_DATES" => "Y",
                        "DETAIL_URL" => "",
                        "DISPLAY_BOTTOM_PAGER" => "N",
                        "DISPLAY_DATE" => "N",
                        "DISPLAY_NAME" => "N",
                        "DISPLAY_PICTURE" => "Y",
                        "DISPLAY_PREVIEW_TEXT" => "Y",
                        "DISPLAY_TOP_PAGER" => "N",
                        "FIELD_CODE" => array(
                            0 => "ID",
                            1 => "CODE",
                            2 => "NAME",
                            3 => "PREVIEW_PICTURE",
                            4 => "PREVIEW_TEXT",
                            5 => "",
                        ),
                        "FILE_404" => "",
                        "FILTER_NAME" => "",
                        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                        "IBLOCK_ID" => "16",
                        "IBLOCK_TYPE" => "about",
                        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                        "INCLUDE_SUBSECTIONS" => "N",
                        "MESSAGE_404" => "",
                        "NEWS_COUNT" => "4",
                        "PAGER_BASE_LINK_ENABLE" => "N",
                        "PAGER_DESC_NUMBERING" => "N",
                        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                        "PAGER_SHOW_ALL" => "N",
                        "PAGER_SHOW_ALWAYS" => "N",
                        "PAGER_TEMPLATE" => ".default",
                        "PAGER_TITLE" => "О компании (преимущества)",
                        "PARENT_SECTION" => "",
                        "PARENT_SECTION_CODE" => "",
                        "PREVIEW_TRUNCATE_LEN" => "",
                        "SET_BROWSER_TITLE" => "N",
                        "SET_LAST_MODIFIED" => "N",
                        "SET_META_DESCRIPTION" => "N",
                        "SET_META_KEYWORDS" => "N",
                        "SET_STATUS_404" => "N",
                        "SET_TITLE" => "N",
                        "SHOW_404" => "N",
                        "SORT_BY1" => "SORT",
                        "SORT_BY2" => "SORT",
                        "SORT_ORDER1" => "DESC",
                        "SORT_ORDER2" => "ASC",
                    ),
                    false
                );
                ?>


                <iframe id="videoFrame" class="iframe-wisetao" style="margin-bottom: 40px; margin-top: 40px;"
                    width="100%"
                    src="https://dzen.ru/embed/v_sJZ3yOe0TY?from_block=partner&from=zen&mute=0&autoplay=0&tv=0"
                    allow="autoplay; fullscreen; accelerometer; gyroscope; picture-in-picture; encrypted-media"
                    frameborder="0" scrolling="no" allowfullscreen></iframe>


                <h3 class="group-title">НАША ИСТОРИЯ</h3>
                <div class="timeline">
                    <?
                    session_start();
                    if (!isset($_SESSION['n_count'])) {
                        $_SESSION['n_count'] = 2;
                    }
                    if (isset($_GET['more'])) {
                        $_SESSION['n_count'] = 0;
                    }
                    if (!isset($_GET['more'])) {
                        $_SESSION['n_count'] = 2;
                    }
                    BXClearCache('/s3/bitrix/news.list/');
                    $APPLICATION->IncludeComponent(
                        "bitrix:news.list",
                        "logistic_about_timeline",
                        array(
                            "ACTIVE_DATE_FORMAT" => "d.m.Y",
                            "ADD_SECTIONS_CHAIN" => "N",
                            "AJAX_MODE" => "Y",
                            "AJAX_OPTION_ADDITIONAL" => "",
                            "AJAX_OPTION_HISTORY" => "N",
                            "AJAX_OPTION_JUMP" => "N",
                            "AJAX_OPTION_STYLE" => "Y",
                            "CACHE_FILTER" => "N",
                            "CACHE_GROUPS" => "Y",
                            "CACHE_TIME" => "36000000",
                            "CACHE_TYPE" => "A",
                            "CHECK_DATES" => "Y",
                            "DETAIL_URL" => "",
                            "DISPLAY_BOTTOM_PAGER" => "N",
                            "DISPLAY_DATE" => "N",
                            "DISPLAY_NAME" => "N",
                            "DISPLAY_PICTURE" => "Y",
                            "DISPLAY_PREVIEW_TEXT" => "Y",
                            "DISPLAY_TOP_PAGER" => "N",
                            "FIELD_CODE" => array(
                                0 => "ID",
                                1 => "CODE",
                                2 => "NAME",
                                3 => "PREVIEW_PICTURE",
                                4 => "PREVIEW_TEXT",
                                5 => "",
                            ),
                            "FILE_404" => "",
                            "FILTER_NAME" => "",
                            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                            "IBLOCK_ID" => "26",
                            "IBLOCK_TYPE" => "logistic",
                            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                            "INCLUDE_SUBSECTIONS" => "N",
                            "MESSAGE_404" => "",
                            "NEWS_COUNT" => $_SESSION['n_count'],
                            "PAGER_BASE_LINK_ENABLE" => "N",
                            "PAGER_DESC_NUMBERING" => "N",
                            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                            "PAGER_SHOW_ALL" => "N",
                            "PAGER_SHOW_ALWAYS" => "N",
                            "PAGER_TEMPLATE" => ".default",
                            "PAGER_TITLE" => "Логистика (история компании - шкала)",
                            "PARENT_SECTION" => "",
                            "PARENT_SECTION_CODE" => "",
                            "PREVIEW_TRUNCATE_LEN" => "",
                            "SET_BROWSER_TITLE" => "N",
                            "SET_LAST_MODIFIED" => "N",
                            "SET_META_DESCRIPTION" => "N",
                            "SET_META_KEYWORDS" => "N",
                            "SET_STATUS_404" => "N",
                            "SET_TITLE" => "N",
                            "SHOW_404" => "N",
                            "SORT_BY1" => "DATE_CREATE",
                            "SORT_BY2" => "SORT",
                            "SORT_ORDER1" => "ASC",
                            "SORT_ORDER2" => "ASC",
                        ),
                        false
                    ); ?>
                </div>
            </div>

            <div class="logistic-blog">
                <h3 class="group-title" data-aos="fade-up">ПОЛЕЗНЫЕ СТАТЬИ</h3>
                <div class="logistic-blog__block">

                    <? $APPLICATION->IncludeComponent(
                        "bitrix:news.list",
                        "blog_articles_from_logistic",
                        array(
                            "ACTIVE_DATE_FORMAT" => "d.m.Y",
                            "ADD_SECTIONS_CHAIN" => "N",
                            "AJAX_MODE" => "N",
                            "AJAX_OPTION_ADDITIONAL" => "",
                            "AJAX_OPTION_HISTORY" => "N",
                            "AJAX_OPTION_JUMP" => "N",
                            "AJAX_OPTION_STYLE" => "Y",
                            "CACHE_FILTER" => "N",
                            "CACHE_GROUPS" => "Y",
                            "CACHE_TIME" => "36000000",
                            "CACHE_TYPE" => "A",
                            "CHECK_DATES" => "Y",
                            "DETAIL_URL" => "",
                            "DISPLAY_BOTTOM_PAGER" => "N",
                            "DISPLAY_DATE" => "N",
                            "DISPLAY_NAME" => "N",
                            "DISPLAY_PICTURE" => "Y",
                            "DISPLAY_PREVIEW_TEXT" => "Y",
                            "DISPLAY_TOP_PAGER" => "N",
                            "FIELD_CODE" => array(
                                0 => "ID",
                                1 => "CODE",
                                2 => "NAME",
                                3 => "PREVIEW_PICTURE",
                                4 => "PREVIEW_TEXT",
                                5 => "DATE_CREATE",
                            ),
                            "FILE_404" => "",
                            "FILTER_NAME" => "",
                            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                            "IBLOCK_ID" => "17",
                            "IBLOCK_TYPE" => "blog",
                            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                            "INCLUDE_SUBSECTIONS" => "N",
                            "MESSAGE_404" => "",
                            "NEWS_COUNT" => "4",
                            "PAGER_BASE_LINK_ENABLE" => "N",
                            "PAGER_DESC_NUMBERING" => "N",
                            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                            "PAGER_SHOW_ALL" => "N",
                            "PAGER_SHOW_ALWAYS" => "N",
                            "PAGER_TEMPLATE" => ".default",
                            "PAGER_TITLE" => "Блог (статьи и тэги)",
                            "PARENT_SECTION" => "",
                            "PARENT_SECTION_CODE" => "",
                            "PREVIEW_TRUNCATE_LEN" => "",
                            "PROPERTY_CODE" => array(
                                0 => "TAGS",
                            ),
                            "SET_BROWSER_TITLE" => "N",
                            "SET_LAST_MODIFIED" => "N",
                            "SET_META_DESCRIPTION" => "N",
                            "SET_META_KEYWORDS" => "N",
                            "SET_STATUS_404" => "N",
                            "SET_TITLE" => "N",
                            "SHOW_404" => "N",
                            "SORT_BY1" => "SORT",
                            "SORT_BY2" => "DATE_CREATE",
                            "SORT_ORDER1" => "ASC",
                            "SORT_ORDER2" => "DESC",
                        ),
                        false
                    ); ?>
                </div>
            </div>

            <div class="logistic-reviews">
                <div class="logistic-reviews__block">
                    <?
                    $APPLICATION->IncludeComponent(
                        "bitrix:news.list",
                        "reviews_from_marketing",
                        array(
                            "ACTIVE_DATE_FORMAT" => "d.m.Y",
                            "ADD_SECTIONS_CHAIN" => "N",
                            "AJAX_MODE" => "N",
                            "AJAX_OPTION_ADDITIONAL" => "",
                            "AJAX_OPTION_HISTORY" => "N",
                            "AJAX_OPTION_JUMP" => "N",
                            "AJAX_OPTION_STYLE" => "Y",
                            "CACHE_FILTER" => "N",
                            "CACHE_GROUPS" => "Y",
                            "CACHE_TIME" => "36000000",
                            "CACHE_TYPE" => "A",
                            "CHECK_DATES" => "Y",
                            "DETAIL_URL" => "",
                            "DISPLAY_BOTTOM_PAGER" => "N",
                            "DISPLAY_DATE" => "N",
                            "DISPLAY_NAME" => "N",
                            "DISPLAY_PICTURE" => "Y",
                            "DISPLAY_PREVIEW_TEXT" => "Y",
                            "DISPLAY_TOP_PAGER" => "N",
                            "FIELD_CODE" => array(
                                0 => "ID",
                                1 => "CODE",
                                2 => "NAME",
                                3 => "PREVIEW_PICTURE",
                                4 => "PREVIEW_TEXT",
                                5 => "",
                            ),
                            "FILE_404" => "",
                            "FILTER_NAME" => "",
                            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                            "IBLOCK_ID" => "21",
                            "IBLOCK_TYPE" => "reviews",
                            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                            "INCLUDE_SUBSECTIONS" => "N",
                            "MESSAGE_404" => "",
                            "NEWS_COUNT" => 500,
                            "PROPERTY_CODE" => array(
                                0 => "TOPICS",
                                1 => "SERVICES",
                                2 => "REVIEWER_NAME",
                            ),
                            "PAGER_BASE_LINK_ENABLE" => "N",
                            "PAGER_DESC_NUMBERING" => "N",
                            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                            "PAGER_SHOW_ALL" => "N",
                            "PAGER_SHOW_ALWAYS" => "N",
                            "PAGER_TEMPLATE" => ".default",
                            "PAGER_TITLE" => "Отзывы",
                            "PARENT_SECTION" => "",
                            "PARENT_SECTION_CODE" => "",
                            "PREVIEW_TRUNCATE_LEN" => "",
                            "SET_BROWSER_TITLE" => "N",
                            "SET_LAST_MODIFIED" => "N",
                            "SET_META_DESCRIPTION" => "N",
                            "SET_META_KEYWORDS" => "N",
                            "SET_STATUS_404" => "N",
                            "SET_TITLE" => "N",
                            "SHOW_404" => "N",
                            "SORT_BY1" => "DATE_CREATE",
                            "SORT_BY2" => "SORT",
                            "SORT_ORDER1" => "ASC",
                            "SORT_ORDER2" => "ASC",
                        ),
                        false
                    ); ?>
                </div>
            </div>

            <div id="request" class="question-block mt-4" data-aos="fade-up">
                <?
                $APPLICATION->IncludeComponent(
                    "bitrix:form.result.new",
                    "question_collaboration_email", // Имя вашего шаблона
                    array(
                        "WEB_FORM_ID" => "1", // ID вашей веб-формы
                        "COMPONENT_TEMPLATE" => "question_collaboration_email",
                        "LIST_URL" => "",
                        "IGNORE_CUSTOM_TEMPLATE" => "N",
                        "USE_EXTENDED_ERRORS" => "N",
                        "SEF_MODE" => "Y",
                        "AJAX_MODE" => "Y",
                        "AJAX_OPTION_JUMP" => "N",
                        "AJAX_OPTION_STYLE" => "N",
                        "AJAX_OPTION_HISTORY" => "N",
                        "SEF_FOLDER" => "",
                        "CACHE_TYPE" => "A",
                        "CACHE_TIME" => "3600",
                        "EDIT_URL" => "",
                        "SUCCESS_URL" => "",
                        "CHAIN_ITEM_TEXT" => "",
                        "CHAIN_ITEM_LINK" => "",
                        "VARIABLE_ALIASES" => array(
                            "RESULT_ID" => "",
                            "WEB_FORM_ID" => "",
                            "formresult" => "",
                        ),
                    )
                );
                BXClearCache('/s3/bitrix/form.result.new/');
                $APPLICATION->IncludeComponent(
                    "bitrix:form.result.new",
                    "good_cargo_data",
                    array(
                        "WEB_FORM_ID" => "3",
                        "COMPONENT_TEMPLATE" => "good_cargo_data",
                        "LIST_URL" => "",
                        "EDIT_URL" => "",
                        "SUCCESS_URL" => "",
                        "CHAIN_ITEM_TEXT" => "",
                        "CHAIN_ITEM_LINK" => "",
                        "SEF_MODE" => "Y",
                        "AJAX_MODE" => "Y",
                        "AJAX_OPTION_JUMP" => "N",
                        "AJAX_OPTION_STYLE" => "N",
                        "AJAX_OPTION_HISTORY" => "N",
                        "USE_EXTENDED_ERRORS" => "Y",
                    )
                );
                ?>
            </div>
        </div>
    </div>
</div>


<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>