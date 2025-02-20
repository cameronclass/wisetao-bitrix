<!DOCTYPE html>
<html lang="ru">
<head>
<?
/** @var CMain $APPLICATION */
$APPLICATION->ShowHead();
?>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <meta name="robots" content="index, follow">
    <!-- MetaTags -->
    <meta name="description" content="WISETAO предоставляет полный спектр услуг по работе с Китаем: от доставки грузов и производства товаров до бизнес-туров и бухгалтерского сопровождения. Работаем с 2013 года, обеспечивая качественное обслуживание и надежное партнерство.">
    <meta name="keywords" content="оптовые поставки из Китая, доставка грузов из Китая, производство товаров в Китае, бизнес-туры в Китай, регистрация компаний в Китае, WISETAO, оптовая доставка, логистика Китай, маркетплейсы Китай, контроль производства Китай">
    <!-- OG tags -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://wisetao.com">
    <meta property="og:title" content="WISETAO - работаем в Китае с 2013 года">
    <meta property="og:image" content="<?=SITE_TEMPLATE_PATH?>/assets/images/icons/Logo.png">
    <meta property="og:description" content="WISETAO предоставляет полный спектр услуг по работе с Китаем: доставка грузов, производство товаров, бизнес-туры, регистрация компаний, бухгалтерское сопровождение и многое другое.">
    <meta property="og:site_name" content="WISETAO - работаем в Китае с 2013 года">
    <meta property="og:locale" content="ru_RU">

    <link rel="canonical" href="https://wisetao.com/" />

    <!-- Favivon -->
    <link rel="shortcut icon" href="<?=SITE_TEMPLATE_PATH?>/assets/images/logo.svg" type="image/x-icon">
    <!-- Apple Touch Icon -->
    <link rel="apple-touch-icon" href="<?=SITE_TEMPLATE_PATH?>/assets/images/logo.svg?v=1.1.1">
    <!-- Mobiles Header Color -->
    <meta name="theme-color" content="#000">
    <meta name="msapplication-navbutton-color" content="#000">
    <meta name="apple-mobile-web-app-status-bar-style" content="#000">
    <!-- CSS -->
    <link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/assets/css/custom.css?v=1.1.2">
    <link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/assets/css/changes.css?v=1.1.2">
    <link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/assets/css/logistic.css?v=1.1.2">


<!--    --><?//$version = date('YmdHi');
//
//    \Bitrix\Main\Page\Asset::getInstance()->addJs('https://cdn-ru.bitrix24.ru/b27596596/crm/tag/call.tracker.js?v=' . $version, true);?>
<!--    <link rel="stylesheet" href="/calc-layout/css/calc-style.css?v=1.1.4">-->
    <? \Bitrix\Main\Page\Asset::getInstance()->addCss('/calc-layout/css/calc-style.css?v='.filemtime($_SERVER['DOCUMENT_ROOT'].'/calc-layout/css/calc-style.css')); ?>
    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&apikey=daa45afb-a989-4163-8df6-1b1edba1137d&suggest_apikey=5e11305c-8d8a-4669-9069-5c56422200c1"></script>
    <title><?$APPLICATION->ShowTitle();?></title>


    <!-- Yandex.Metrika counter -->
    <script>
        (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
            m[i].l=1*new Date();
            for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
            k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
        (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

        ym(97300667, "init", {
            clickmap:true,
            trackLinks:true,
            accurateTrackBounce:true,
            webvisor:true
        });
    </script>
    <!-- /Yandex.Metrika counter -->

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-PRC5J9LZ');
    </script>
    <!-- End Google Tag Manager -->

    <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>
</head>
<body>

<div id="preloader">
    <dotlottie-player style="width: 120px;height: 120px;" src="<?=SITE_TEMPLATE_PATH?>/assets/js/preloader.json" background="transparent" speed="1" style="width: 100%; height: 100%" direction="1" playMode="normal" autoplay loop></dotlottie-player>
</div>

<div class="link-clicked">
    <dotlottie-player style="width: 120px;height: 120px;" src="<?=SITE_TEMPLATE_PATH?>/assets/js/preloader.json" background="transparent" speed="1" style="width: 100%; height: 100%" direction="1" playMode="normal" autoplay loop></dotlottie-player>
</div>


<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PRC5J9LZ"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<div id="panel"><? $APPLICATION->ShowPanel(); ?></div>
<?//
//if (isset($_SERVER['REAL_FILE_PATH'])) {
//    $currentFile = $_SERVER['REAL_FILE_PATH'];
//} elseif (isset($_SERVER['SCRIPT_NAME'])) {
//    $currentFile = $_SERVER['SCRIPT_NAME'];
//} else {
//    $currentFile = $_SERVER['PHP_SELF'];
//}
//
//echo "Current script: " . $currentFile;
//?>
<? if ($APPLICATION->GetCurPage(false) == '/'
    || explode('-', $APPLICATION->GetCurPage(false))[0] == '/hash'
    || explode('-', $APPLICATION->GetCurPage(false))[0] == '/bitrix_include_areas'
    && count(explode('/', $APPLICATION->GetCurPage(false))) == 3): ?>
    <!-- Главное меню -->
    <div class="main js-main-menu <?=($_GET['data-in-menu'] ? '' : 'active') ?>">
        <section class="container">
            <div class="main-select">

                <div class="main-select__circle" style="position: relative">

                    <svg class="main-select__circle_1" width="860" height="860" viewBox="0 0 860 860" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="430" cy="430" r="428.5" stroke="url(#paint0_linear_2105_84525)" stroke-width="3" />
                        <defs>
                            <linearGradient id="paint0_linear_2105_84525" x1="1.68421e-08" y1="430" x2="866.028" y2="425.479" gradientUnits="userSpaceOnUse">
                                <stop class="svg-left" offset="0.26" stop-color="white" />
                                <stop offset="0.445" stop-color="white" stop-opacity="0" />
                                <stop offset="0.555" stop-color="white" stop-opacity="0" />
                                <stop class="svg-right" offset="0.74" stop-color="white" />
                            </linearGradient>
                        </defs>
                    </svg>
                    <div class="main-select__circle_bg"></div>

                    <img class="main-select__circle_line" src="<?=SITE_TEMPLATE_PATH?>/assets/images/home/line.svg" alt="">
                    <img class="main-select__circle_2 scale-up-center-100" src="<?=SITE_TEMPLATE_PATH?>/assets/images/home/circle-4.svg" alt="">
                    <div class="main-select__logo">
                        <img class="main-select__circle_3 scale-up-rotate-200" src="<?=SITE_TEMPLATE_PATH?>/assets/images/home/circle-3.svg" alt="">
                        <img class="main-select__circle_4 scale-up-rotate-300" src="<?=SITE_TEMPLATE_PATH?>/assets/images/home/circle-2.svg" alt="">
                        <img class="main-select__circle_5 scale-up-rotate-400" src="<?=SITE_TEMPLATE_PATH?>/assets/images/home/circle-1.svg" alt="">
                        <div class="main-select__logo_wrapper scale-up-center-nt-500">
                            <img class="main-select__logo_img" src="<?=SITE_TEMPLATE_PATH?>/assets/images/logo.svg?v=1.1.1" alt="">
                            <div class="main-select__logo_text">Работаем с 2013 г.</div>
                        </div>
                    </div>
<!--                    <dotlottie-player style="position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);z-index: 2;width: 300px;height: 300px;" src="--><?php //=SITE_TEMPLATE_PATH?><!--/assets/js/logo.json" background="transparent" speed="1" style="width: 100%; height: 100%" direction="1" playMode="normal" autoplay></dotlottie-player>-->
                    <button type="button" class="main-select__from">Из Китая</button>
                    <button type="button" class="main-select__to">В Китай</button>
                </div>

                <div class="main-select__menu">
                    <ul class="main-select__menu_left">
                        <?
                        $APPLICATION->IncludeComponent("bitrix:news.list", "first_menu", Array(
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
                            5 => "DATE_CREATE",
                            6 => "",
                            ),
                            "FILE_404" => "",
                            "FILTER_NAME" => "",
                            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                            "IBLOCK_ID" => "32",
                            "IBLOCK_TYPE" => "menu",
                            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                            "INCLUDE_SUBSECTIONS" => "N",
                            "MESSAGE_404" => "",
                            "NEWS_COUNT" => 0,
                            "PAGER_BASE_LINK_ENABLE" => "N",
                            "PAGER_DESC_NUMBERING" => "N",
                            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                            "PAGER_SHOW_ALL" => "N",
                            "PAGER_SHOW_ALWAYS" => "N",
                            "PAGER_TEMPLATE" => ".default",
                            "PAGER_TITLE" => "Меню",
                            "PARENT_SECTION" => "",
                            "PARENT_SECTION_CODE" => "",
                            "PREVIEW_TRUNCATE_LEN" => "",
                            "PROPERTY_CODE" => array(
                            0 => "LINK",
                            1 => "",
                            ),
                            'SECTION_ID' => 74,
                            "SET_BROWSER_TITLE" => "N",
                            "SET_LAST_MODIFIED" => "N",
                            "SET_META_DESCRIPTION" => "N",
                            "SET_META_KEYWORDS" => "N",
                            "SET_STATUS_404" => "N",
                            "SET_TITLE" => "N",
                            "SHOW_404" => "N",
                            "SORT_BY1" => "ID",
                            "SORT_BY2" => "ID",
                            "SORT_ORDER1" => "ASC",
                            "SORT_ORDER2" => "ASC",
                        ),
                        false
                        );
                        ?>
                    </ul>
                    <ul class="main-select__menu_right">
                        <?
                        $APPLICATION->IncludeComponent("bitrix:news.list", "first_menu", Array(
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
                                5 => "DATE_CREATE",
                                6 => "",
                            ),
                            "FILE_404" => "",
                            "FILTER_NAME" => "",
                            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                            "IBLOCK_ID" => "32",
                            "IBLOCK_TYPE" => "menu",
                            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                            "INCLUDE_SUBSECTIONS" => "N",
                            "MESSAGE_404" => "",
                            "NEWS_COUNT" => 0,
                            "PAGER_BASE_LINK_ENABLE" => "N",
                            "PAGER_DESC_NUMBERING" => "N",
                            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                            "PAGER_SHOW_ALL" => "N",
                            "PAGER_SHOW_ALWAYS" => "N",
                            "PAGER_TEMPLATE" => ".default",
                            "PAGER_TITLE" => "Меню",
                            "PARENT_SECTION" => "",
                            "PARENT_SECTION_CODE" => "",
                            "PREVIEW_TRUNCATE_LEN" => "",
                            "PROPERTY_CODE" => array(
                                0 => "LINK",
                                1 => "",
                            ),
                            'SECTION_ID' => 75,
                            "SET_BROWSER_TITLE" => "N",
                            "SET_LAST_MODIFIED" => "N",
                            "SET_META_DESCRIPTION" => "N",
                            "SET_META_KEYWORDS" => "N",
                            "SET_STATUS_404" => "N",
                            "SET_TITLE" => "N",
                            "SHOW_404" => "N",
                            "SORT_BY1" => "ID",
                            "SORT_BY2" => "ID",
                            "SORT_ORDER1" => "ASC",
                            "SORT_ORDER2" => "ASC",
                        ),
                            false
                        );
                        ?>
                    </ul>
                </div>

            </div>
        </section>
    </div>

    <!-- Из Китая -->
    <div class="js-left-menu js-secondary-menu <?=(explode('-', $_GET['data-in-menu'])[1] == 'left' ? 'active' : '') ?>">
        <header class="header">
            <div class="container">
                <div class="header__block">
                    <a href="#" class="header__logo js-go-index">
                        <img src="<?=SITE_TEMPLATE_PATH?>/assets/images/logo.svg?v=1.1.1" alt="logo">
                    </a>
                    <div class="header__block_bg"></div>
                </div>
            </div>
        </header>
        <div class="main-menu">
            <div class="container">
                <div class="main-menu__block">

                    <?
                    $APPLICATION->IncludeComponent("bitrix:news.list", "menu", Array(
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
                            5 => "DATE_CREATE",
                            6 => "",
                        ),
                        "FILE_404" => "",
                        "FILTER_NAME" => "",
                        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                        "IBLOCK_ID" => "32",
                        "IBLOCK_TYPE" => "menu",
                        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                        "INCLUDE_SUBSECTIONS" => "N",
                        "MESSAGE_404" => "",
                        "NEWS_COUNT" => 6,
                        "PAGER_BASE_LINK_ENABLE" => "N",
                        "PAGER_DESC_NUMBERING" => "N",
                        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                        "PAGER_SHOW_ALL" => "N",
                        "PAGER_SHOW_ALWAYS" => "N",
                        "PAGER_TEMPLATE" => ".default",
                        "PAGER_TITLE" => "Меню",
                        "PARENT_SECTION" => "",
                        "PARENT_SECTION_CODE" => "",
                        "PREVIEW_TRUNCATE_LEN" => "",
                        "PROPERTY_CODE" => array(
                            0 => "LINK",
                            1 => "",
                        ),
                        'SECTION_ID' => 74,
                        'DATA_IN_MENU' => explode('-', $_GET['data-in-menu'])[2],
                        "SET_BROWSER_TITLE" => "N",
                        "SET_LAST_MODIFIED" => "N",
                        "SET_META_DESCRIPTION" => "N",
                        "SET_META_KEYWORDS" => "N",
                        "SET_STATUS_404" => "N",
                        "SET_TITLE" => "N",
                        "SHOW_404" => "N",
                        "SORT_BY1" => "ID",
                        "SORT_BY2" => "ID",
                        "SORT_ORDER1" => "ASC",
                        "SORT_ORDER2" => "ASC",
                    ),
                        false
                    );
                    ?>

                    <button class="mobile-back mobile-back-1">
                        <img class="mobile-back__icon" src="<?=SITE_TEMPLATE_PATH?>/assets/images/icons/arrow-left.svg" alt="">
                        <span class="mobile-back__text">Назад</span>
                    </button>

                    <button class="mobile-back mobile-back-2">
                        <img class="mobile-back__icon" src="<?=SITE_TEMPLATE_PATH?>/assets/images/icons/arrow-left.svg" alt="">
                        <span class="mobile-back__text">Назад</span>
                    </button>

                    <button class="js-go-index menu-back-btn"><span> &lt; </span> <span>Из Китая</span></button>
                    
                </div>
            </div>
        </div>
        </div>


    <!-- В Китай -->
    <div class="js-right-menu js-secondary-menu <?=(explode('-', $_GET['data-in-menu'])[1] == 'right' ? 'active' : '') ?>">
        <header class="header">
            <div class="container">
                <div class="header__block">
                    <a href="#" class="header__logo js-go-index">
                        <img src="<?=SITE_TEMPLATE_PATH?>/assets/images/logo.svg?v=1.1.1" alt="logo">
                    </a>
                    <div class="header__block_bg"></div>
                </div>
            </div>
        </header>
        <div class="main-menu">
            <div class="container">
                <div class="main-menu__block">
                    <?
                    $APPLICATION->IncludeComponent("bitrix:news.list", "menu", Array(
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
                            5 => "DATE_CREATE",
                            6 => "",
                        ),
                        "FILE_404" => "",
                        "FILTER_NAME" => "",
                        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                        "IBLOCK_ID" => "32",
                        "IBLOCK_TYPE" => "menu",
                        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                        "INCLUDE_SUBSECTIONS" => "N",
                        "MESSAGE_404" => "",
                        "NEWS_COUNT" => 6,
                        "PAGER_BASE_LINK_ENABLE" => "N",
                        "PAGER_DESC_NUMBERING" => "N",
                        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                        "PAGER_SHOW_ALL" => "N",
                        "PAGER_SHOW_ALWAYS" => "N",
                        "PAGER_TEMPLATE" => ".default",
                        "PAGER_TITLE" => "Меню",
                        "PARENT_SECTION" => "",
                        "PARENT_SECTION_CODE" => "",
                        "PREVIEW_TRUNCATE_LEN" => "",
                        "PROPERTY_CODE" => array(
                            0 => "LINK",
                            1 => "",
                        ),
                        'SECTION_ID' => 75,
                        'DATA_IN_MENU' => explode('-', $_GET['data-in-menu'])[2],
                        "SET_BROWSER_TITLE" => "N",
                        "SET_LAST_MODIFIED" => "N",
                        "SET_META_DESCRIPTION" => "N",
                        "SET_META_KEYWORDS" => "N",
                        "SET_STATUS_404" => "N",
                        "SET_TITLE" => "N",
                        "SHOW_404" => "N",
                        "SORT_BY1" => "ID",
                        "SORT_BY2" => "ID",
                        "SORT_ORDER1" => "ASC",
                        "SORT_ORDER2" => "ASC",
                    ),
                        false
                    );
                    ?>

                    <button class="mobile-back mobile-back-1">
                        <img class="mobile-back__icon" src="<?=SITE_TEMPLATE_PATH?>/assets/images/icons/arrow-left.svg" alt="">
                        <span class="mobile-back__text">Назад</span>
                    </button>

                    <button class="mobile-back mobile-back-2">
                        <img class="mobile-back__icon" src="<?=SITE_TEMPLATE_PATH?>/assets/images/icons/arrow-left.svg" alt="">
                        <span class="mobile-back__text">Назад</span>
                    </button>

                    <button class="js-go-index menu-back-btn"><span> &lt; </span> <span>В Китай</span></button>
                </div>
            </div>
        </div>

    </div>
    <div class="main-bg">
        <div class="main-bg__overlay">
            <img class="main-bg__img" src="<?=SITE_TEMPLATE_PATH?>/assets/images/bg.svg" alt="">
        </div>
    </div>

<? endif; ?>
<? if ($APPLICATION->GetCurPage(false) != '/' && $APPLICATION->GetCurPage(false) != '/menu.php'
&& explode('-', $APPLICATION->GetCurPage(false))[0] != '/hash'
&& explode('-', $APPLICATION->GetCurPage(false))[0] != '/bitrix_include_areas'): ?>
    <div class="content-bg">

        <div class="content-over">
            <div class="header-bg">
                <div class="header-bg__gradient1"></div>
                <div class="header-bg__gradient2"></div>
                <img src="<?=SITE_TEMPLATE_PATH?>/assets/images/bg.svg" alt="">
            </div>
            <? if (explode('/', $APPLICATION->GetCurPage(false))[2] == 'logistic'): ?>
                <div class="main-wall">
                    <div class="block-banner alignfull">
                        <div class="block-banner__top">
                            <video autoplay="" loop="" muted="" playsinline="" id="block-banner__video">
                                <source src="<?=SITE_TEMPLATE_PATH?>/assets/video/banner.mp4" type="video/mp4">
                            </video>
                            <div class="main-wall__overlay"></div>
                            <div class="main-wall__heading">
                                <div class="main-wall__heading_block">
                                    <h1 class="main-wall__heading_h1">
                                        <span class="main-wall__heading_first">ДОСТАВКА ГРУЗОВ</span>
                                        <?$from = $_GET['direct-china'] == 'from-china' ? 'ИЗ КИТАЯ' : 'В КИТАЙ';?>
                                        <?$calc = $_GET['direct-china'] == 'from-china' ? 'РАСЧИТАТЬ СТОИМОСТЬ ОНЛАЙН' : '';?>
                                        <span class="main-wall__heading_second"><?=$from?></span>
                                    </h1>
                                    <div class="main-wall__heading_text">
                                        <span>АВИА / АВТО / ЖД / МОРЕ</span>
                                        <span><?=$calc?></span>
                                        <button class="main-wall__heading_icon js-slide-to-calc" >
                                            <img class="arrow-animation" src="/bitrix/templates/main-wisetao/assets/images/icons/arrow-down-log.svg" alt="">
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <?
                        $APPLICATION->IncludeComponent("bitrix:news.list", "service_balloon", Array(
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
                                5 => "DATE_CREATE",
                                6 => "",
                            ),
                            "FILE_404" => "",
                            "FILTER_NAME" => "",
                            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                            "IBLOCK_ID" => "34",
                            "IBLOCK_TYPE" => "servises_points",
                            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                            "INCLUDE_SUBSECTIONS" => "N",
                            "MESSAGE_404" => "",
                            "NEWS_COUNT" => 0,
                            "PAGER_BASE_LINK_ENABLE" => "N",
                            "PAGER_DESC_NUMBERING" => "N",
                            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                            "PAGER_SHOW_ALL" => "N",
                            "PAGER_SHOW_ALWAYS" => "N",
                            "PAGER_TEMPLATE" => ".default",
                            "PAGER_TITLE" => "Точки сервисы",
                            "PARENT_SECTION" => "",
                            "PARENT_SECTION_CODE" => "",
                            "PREVIEW_TRUNCATE_LEN" => "",
                            "PROPERTY_CODE" => array(
                                0 => "LINK",
                                1 => "",
                            ),
                            "SET_BROWSER_TITLE" => "N",
                            "SET_LAST_MODIFIED" => "N",
                            "SET_META_DESCRIPTION" => "N",
                            "SET_META_KEYWORDS" => "N",
                            "SET_STATUS_404" => "N",
                            "SET_TITLE" => "N",
                            "SHOW_404" => "N",
                            "SORT_BY1" => "ID",
                            "SORT_BY2" => "ID",
                            "SORT_ORDER1" => "ASC",
                            "SORT_ORDER2" => "ASC",
                        ),
                            false
                        );
                        ?>
                    </div>

                </div>
            <?endif;?>
            <main class="container-fluid">
                <div class="content-page">
                    <div class="content-page__block">
                        <button class="hamburger hamburger--squeeze mobile-menu-open js-menu-hamburger" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                        <div class="hover-for-menu"></div>
                        <div class="page-menu">
                            <script>
                                document.addEventListener('DOMContentLoaded', function () {
                                    let fluidContainer = document.querySelector('.container-fluid.main');
                                    let isMainContainer = false;
                                    let isPageMenu = false;
                                    document.addEventListener('mousemove', function (event) {
                                        let x = event.clientX;
                                        let y = event.clientY;
                                        let elementsUnderCursor = document.elementsFromPoint(x, y);
                                        isMainContainer = false;
                                        isPageMenu = false;
                                        elementsUnderCursor.forEach(function (element) {
                                            if (element && element.classList.contains('logistic-page')) {
                                                isMainContainer = true;
                                            }
                                            if (element && element.classList.contains('page-menu')) {
                                                isPageMenu = true;
                                            }
                                        });
                                        if (isMainContainer || isPageMenu) {
                                            if(fluidContainer) {
                                                fluidContainer.style.zIndex = 6;
                                            }
                                        }
                                        else {
                                            if(fluidContainer) {
                                                fluidContainer.style.zIndex = '';
                                            }
                                        }
                                    });
                                });
                            </script>
                            <!-- Logo -->
                            <a href="/" class="page-menu__logo">
                                <img src="<?=SITE_TEMPLATE_PATH?>/assets/images/logo.svg?v=1.1.1" alt="logo">
                            </a>
                            <!-- Menu -->
                            <div class="page-menu__block active">
                                <div class="page-menu__dot">
                                    <div class="page-menu__dot_block">
                                        <img class="page-menu__dot_img" src="<?=SITE_TEMPLATE_PATH?>/assets/images/menu-dot.svg" alt="">
                                        <span class="page-menu__dot_text">Меню</span>
                                    </div>
                                </div>
                                <div class="page-menu__line"></div>
                                <?
                                $rootSectionCodes = [
                                    'from-china' => 74,
                                    'in-china' => 75,
                                ];
                                $APPLICATION->IncludeComponent("bitrix:news.list", "page_menu", Array(
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
                                        5 => "DATE_CREATE",
                                        6 => "",
                                    ),
                                    "FILE_404" => "",
                                    "FILTER_NAME" => "",
                                    "DATA_IN_MENU" => $_GET['data-in-menu'],
                                    "DATA_IN_LEVEL" => $_GET['data-in-level'],
                                    "DATA_THIRD_ACTIVE" => $_GET['name'],
                                    "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                                    "IBLOCK_ID" => "32",
                                    "IBLOCK_TYPE" => "menu",
                                    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                                    "INCLUDE_SUBSECTIONS" => "N",
                                    "MESSAGE_404" => "",
                                    "NEWS_COUNT" => 0,
                                    "PAGER_BASE_LINK_ENABLE" => "N",
                                    "PAGER_DESC_NUMBERING" => "N",
                                    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                                    "PAGER_SHOW_ALL" => "N",
                                    "PAGER_SHOW_ALWAYS" => "N",
                                    "PAGER_TEMPLATE" => ".default",
                                    "PAGER_TITLE" => "Меню",
                                    "PARENT_SECTION" => "",
                                    "PARENT_SECTION_CODE" => "",
                                    "PREVIEW_TRUNCATE_LEN" => "",
                                    "PROPERTY_CODE" => array(
                                        0 => "LINK",
                                        1 => "",
                                    ),
                                    'SECTION_ID' => $rootSectionCodes[explode('?', $_GET['direct-china'])[0]],
                                    "SET_BROWSER_TITLE" => "N",
                                    "SET_LAST_MODIFIED" => "N",
                                    "SET_META_DESCRIPTION" => "N",
                                    "SET_META_KEYWORDS" => "N",
                                    "SET_STATUS_404" => "N",
                                    "SET_TITLE" => "N",
                                    "SHOW_404" => "N",
                                    "SORT_BY1" => "ID",
                                    "SORT_BY2" => "ID",
                                    "SORT_ORDER1" => "ASC",
                                    "SORT_ORDER2" => "ASC",
                                ),
                                    false
                                );
                                ?>

                            </div>
                        </div>

<? endif; ?>