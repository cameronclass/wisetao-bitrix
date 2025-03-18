<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

if (!\Bitrix\Main\Loader::includeModule("iblock"))
    return;

use Bitrix\Iblock\SectionTable;
use Bitrix\Iblock\ElementTable;

$query = ElementTable::query();
$query->setSelect([
    'ID',
    'IBLOCK_ID',
    'NAME',
    'IBLOCK_SECTION_ID',
    'CODE',
]);
$query->setFilter([
    'IBLOCK_ID' => 32,
    '=CODE' => $_GET['name']
]);
$result = $query->exec();
$element = $result->fetch();


// Добавляем элементы в структуру

$elementProperties = [];

// Получаем свойства элемента
if ($element) {
    $elementProps = CIBlockElement::GetProperty(32, $element['ID']);
    while ($prop = $elementProps->Fetch()) {
        $elementProperties[$prop['CODE']] = $prop['VALUE'];
        if ($prop['CODE'] == 'IN_DEV') {
            $elementProperties[$prop['CODE']] = $prop['VALUE_XML_ID'];
        }
    }
    $title = $element['NAME'];
    $serviceTitle = $elementProperties['SERVICE_TITTLE'];
    $getSectionId = $element['IBLOCK_SECTION_ID'];
    $in_dev = $elementProperties['IN_DEV'];
    if (!empty($elementProperties['TITLE_IMG'])) {
        $titleImage = CFile::GetPath($elementProperties['TITLE_IMG']);
    }
    // Получаем UF_TEXT_LONG из раздела
    $sectionData = CIBlockSection::GetList(
        [],
        [
            'ID' => $getSectionId,
            'IBLOCK_ID' => 32,
        ],
        false,
        [
            'UF_TEXT_LONG',
        ],
    )->fetch();
    $textLong = $sectionData['UF_TEXT_LONG'];
} else {
    $element = CIBlockSection::GetList(
        [],
        [
            '=CODE' => $_GET['name'],
            'IBLOCK_ID' => 32,
        ],
        false,
        [
            'ID',
            'IBLOCK_ID',
            'NAME',
            'IBLOCK_SECTION_ID',
            'CODE',
            'UF_SERVICE_TITTLE',
            'UF_IN_DEV',
            'UF_TITLE_IMG',
            'UF_TEXT_LONG',
        ],
    )->fetch();
    $title = $element['NAME'];
    $serviceTitle = $element['UF_SERVICE_TITTLE'];
    $getSectionId = $element['IBLOCK_SECTION_ID'];
    $in_dev = CUserFieldEnum::GetList([], ['ID' => $element['UF_IN_DEV'], 'USER_FIELD_NAME' => 'UF_IN_DEV',])->Fetch()['XML_ID'];
    $titleImage = $element['UF_TITLE_IMG'] ? CFile::GetPath($element['UF_TITLE_IMG']) : '';
    $textLong = $element['UF_TEXT_LONG'];
}

$sectionData = CIBlockSection::GetList(
    [],
    [
        'ID' => $getSectionId,
        'IBLOCK_ID' => 32,
    ],
    false,
    [
        'IBLOCK_SECTION_ID',
        'CODE',
        'UF_IN_DEV',
    ],
)->fetch();

$in_dev_section = CUserFieldEnum::GetList([], ['ID' => $sectionData['UF_IN_DEV'], 'USER_FIELD_NAME' => 'UF_IN_DEV',])->Fetch()['XML_ID'];

$parentSectionData = CIBlockSection::GetList(
    [],
    [
        'ID' => $sectionData['IBLOCK_SECTION_ID'],
        'IBLOCK_ID' => 32,
    ],
    false,
    [
        'CODE',
    ],
)->fetch();

$section_for_dev = CIBlockSection::GetList(
    [],
    [
        '=CODE' => $_GET['data-in-menu'],
        'IBLOCK_ID' => 32,
    ],
    false,
    [
        'UF_IN_DEV',
    ],
)->fetch();
$in_dev_section_parent = CUserFieldEnum::GetList([], ['ID' => $section_for_dev['UF_IN_DEV'], 'USER_FIELD_NAME' => 'UF_IN_DEV',])->Fetch()['XML_ID'];

if (isset($in_dev) && $in_dev == 'YES' || isset($in_dev_section) && $in_dev_section == 'YES' || isset($in_dev_section_parent) && $in_dev_section_parent == 'YES') {
    if (!$USER->IsAdmin()) {
        LocalRedirect("/developing/" . $_GET['direct-china'] . '/');
    }
}

?>
<? $APPLICATION->SetPageProperty("title", $title);
?>
<?
$page_url = $APPLICATION->GetCurPage(true);
?>

<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "WebPage",
    "name": "<?= $title; ?>",
    "url": "https://wisetao.com<?= $page_url; ?>",
    "description": "WISETAO предоставляет полный спектр услуг по работе с Китаем: от доставки грузов и производства товаров до бизнес-туров и бухгалтерского сопровождения. Работаем с 2013 года, обеспечивая качественное обслуживание и надежное партнерство.",
    "mainEntity": {
        "@type": "Service",
        "serviceType": "<?= $title; ?>",
        "provider": {
            "@type": "Organization",
            "name": "WiseTao",
            "url": "https://wisetao.com",
            "logo": "https://wisetao.com/bitrix/templates/main-wisetao/assets/images/logo.svg",
            "contactPoint": {
                "@type": "ContactPoint",
                "telephone": "+8613154567328",
                "contactType": "customer service",
                "availableLanguage": ["Chinese", "Russian"]
            },
            "sameAs": [
                "https://vk.me/wisetao",
                "https://t.me/+79676433973",
                "https://api.whatsapp.com/send?phone=8613154567328"
            ]
        },
        "areaServed": {
            "@type": "Place",
            "name": "China"
        },
        "offers": {
            "@type": "Offer",
            "url": "https://wisetao.com<?= $page_url ?>",
            "priceCurrency": ["USD", "RUB", "CNY"],
            "eligibleRegion": {
                "@type": "Place",
                "name": "Worldwide"
            }
        }
    }
}
</script>
<!-- textLong: <?= htmlspecialchars($textLong); ?> -->

<div class="content-page__page">
    <div class="content-page__title
    <?= $titleImage ? 'content-page__title_second' : '' ?>
    <?= ($textLong == '1') ? 'content-page__title_long' : '' ?>
    content-page__title_marketing" data-aos="fade-up">
        <h1 class="content-page__title_text"><?= $title; ?></h1>
        <?php if ($titleImage): ?>
        <div class="content-page__title_img">
            <img class="content-page__title_img_item" src="<?= $titleImage ?>" alt="<?= htmlspecialchars($title) ?>">
        </div>
        <?php endif; ?>
    </div>

    <div class="content-page__content">
        <div class="marketing">

            <div class="row">
                <div class="col-xl-9 mb-5">
                    <?
                    $sectionId = SectionTable::getList([
                        'filter' => [
                            '=IBLOCK_ID' => 33,
                            '=CODE' => $_GET['name'],
                        ],
                        'select' => ['ID'],
                    ])->fetch()['ID'];
                    $arFilter = [
                        'IBLOCK_ID' => 33,
                        'SECTION_ID' => $sectionId,
                        'ACTIVE' => 'Y',
                    ];
                    $APPLICATION->IncludeComponent(
                        "bitrix:news.list",
                        "unit_template_page",
                        array(
                            "ACTIVE_DATE_FORMAT" => "d.m.Y",
                            "ADD_SECTIONS_CHAIN" => "N",
                            "ADD_ELEMENT_CHAIN" => "Y",
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
                            "DISPLAY_TOP_PAGER" => "N",
                            "FIELD_CODE" => array(
                                0 => "ID",
                                1 => "CODE",
                                2 => "NAME",
                                3 => "",
                            ),
                            "FILE_404" => "",
                            "FILTER_NAME" => "arFilter",
                            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                            "IBLOCK_ID" => "33",
                            "IBLOCK_TYPE" => "unit_template_page",
                            "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
                            "INCLUDE_SUBSECTIONS" => "N",
                            "MESSAGE_404" => "",
                            "NEWS_COUNT" => "100",
                            "PAGER_BASE_LINK_ENABLE" => "N",
                            "PAGER_DESC_NUMBERING" => "N",
                            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                            "PAGER_SHOW_ALL" => "N",
                            "PAGER_SHOW_ALWAYS" => "N",
                            "PAGER_TEMPLATE" => ".default",
                            "PAGER_TITLE" => "Блог для внутренней страницы",
                            "PARENT_SECTION" => $sectionId,
                            "PARENT_SECTION_CODE" => "",
                            "PREVIEW_TRUNCATE_LEN" => "",
                            "PROPERTY_CODE" => array(
                                0 => "ELEMENT_TYPE",
                                1 => "USE_TITTLE",
                                2 => "SECTION_ID",
                                3 => "LINKED_ELEMENTS",
                                4 => "",
                            ),
                            "SET_BROWSER_TITLE" => "N",
                            "SET_LAST_MODIFIED" => "N",
                            "SET_META_DESCRIPTION" => "N",
                            "SET_META_KEYWORDS" => "N",
                            "SET_STATUS_404" => "N",
                            "SET_TITLE" => "N",
                            "SHOW_404" => "N",
                            "SORT_BY1" => "SORT",
                            "SORT_BY2" => "SORT",
                            "SORT_ORDER1" => "ASC",
                            "SORT_ORDER2" => "ASC",
                            "COMPONENT_TEMPLATE" => "unit_template_page",
                            "STRICT_SECTION_CHECK" => "N"
                        ),
                        false
                    ); ?>
                </div>
                <div class="col-xl-3 mb-4">
                    <div class="blog-inside__panel">
                        <div class="blog-inside-panel__elements">
                            <div class="calc-panel" data-aos="fade-up">
                                <div class="calc-panel__title">Онлайн - калькулятор расчета логистики</div>
                                <div class="calc-panel__text">Самостоятельно сделайте расчет доставки за 1 минуту! И
                                    выберите оптимальный для вас вариант.
                                </div>
                                <a href="/<?= $_GET['direct-china'] ?>/logistic/" class="calc-panel__link"
                                    onclick="_tmr.push({ type: 'reachGoal', id: 3555455, goal: 'tap_to_calculator'}); return true;">Рассчитать</a>
                            </div>
                            <?
                            $sectionId = SectionTable::getList([
                                'filter' => [
                                    '=IBLOCK_ID' => 17,
                                    '=CODE' => $_GET['name'],
                                ],
                                'select' => ['ID'],
                            ])->fetch()['ID'];
                            $arFilter = [
                                'IBLOCK_ID' => 17,
                                'SECTION_ID' => $sectionId, // Фильтруем по ID раздела
                                'ACTIVE' => 'Y', // Только активные элементы
                                // Другие необходимые условия фильтрации
                            ];
                            BXClearCache('/s3/bitrix/news.list/');
                            $APPLICATION->IncludeComponent(
                                "bitrix:news.list",
                                "blog_articles_from_marketing",
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
                                    "FILTER_NAME" => "arFilter",
                                    "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                                    "IBLOCK_ID" => "17",
                                    "IBLOCK_TYPE" => "blog",
                                    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                                    "INCLUDE_SUBSECTIONS" => "N",
                                    "MESSAGE_404" => "",
                                    "NEWS_COUNT" => 4,
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
                            );
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <br>

            <?
            $templateIblockNames = [
                'first' => $_GET['name'] == 'full-deal' ?
                    [
                        'IBLOCK_ID' => '29',
                        'template' => 'marketing_services',
                        'IBLOCK_TYPE' => 'marketing',
                        'title' => '<h2 class="group-title" data-aos="fade-up">' . $serviceTitle . '</h2>',
                        'open' => '',
                        'close' => '<div class="d-flex justify-content-center mb-5" data-aos="fade-up">
                                        <a href="https://wisetao.com/from-china/logistic/" class="calc-btn">Рассчитать стоимость</a>
                                    </div>',
                    ]
                    : ($_GET['name'] != 'photo-video-report' &&
                        $_GET['name'] != 'redemption-1688-taobao' &&
                        $_GET['name'] != 'photo-video-shooting' &&
                        $_GET['name'] != 'printery' &&
                        $_GET['name'] != 'language-adaptation' &&
                        $_GET['name'] != 'develop-design' &&
                        $_GET['name'] != 'reg-domen' &&
                        $_GET['name'] != 'hosting-cn' &&
                        $_GET['name'] != 'website-develop' &&
                        $_GET['name'] != 'icp-license' &&
                        $_GET['name'] != 'mobile-app' &&
                        $_GET['name'] != 'photo-studio' &&
                        $_GET['name'] != 'transferMoney-company' &&
                        $_GET['data-in-menu'] != 'cons' &&
                        $_GET['name'] != 'invitation-cn' ?
                        [
                            'IBLOCK_ID' => '31',
                            'template' => 'cases_marketing',
                            'IBLOCK_TYPE' => 'cases',
                            'title' => '<div class="group-title" data-aos="fade-up">Наши кейсы</div>',
                            'open' => '<div class="case" data-aos="fade-up" style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff">
                                       <div class="swiper caseSwiperUp">',
                            'close' => '</div>
                                    <div class="swiper-button-next"></div>
                                    <div class="swiper-button-prev"></div>
                                    <div class="casePagination">
                                        <div class="swiper-pagination"></div>
                                    </div>
                                </div>'
                        ]
                        : null),
                'second' => $_GET['name'] == 'full-deal' ?
                    [
                        'IBLOCK_ID' => '31',
                        'template' => 'cases_marketing',
                        'IBLOCK_TYPE' => 'cases',
                        'title' => '<div class="group-title" data-aos="fade-up">Наши кейсы</div>',
                        'open' => '<div class="case" data-aos="fade-up" style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff">
                                       <div class="swiper caseSwiperUp">',
                        'close' => '</div>
                                    <div class="swiper-button-next"></div>
                                    <div class="swiper-button-prev"></div>
                                    <div class="casePagination">
                                        <div class="swiper-pagination"></div>
                                    </div>
                                </div>'
                    ]
                    :
                    [
                        'IBLOCK_ID' => '29',
                        'template' => 'marketing_services',
                        'IBLOCK_TYPE' => 'marketing',
                        'title' => '<h3 class="group-title" data-aos="fade-up">' . $serviceTitle . '</h3>',
                        'open' => '',
                        'close' => '<div class="d-flex justify-content-center mb-5" data-aos="fade-up">
                                        <a href="https://wisetao.com/from-china/logistic/" class="calc-btn">Рассчитать стоимость</a>
                                    </div>',
                    ],

            ];

            $sectionId = SectionTable::getList([
                'filter' => [
                    '=IBLOCK_ID' => $templateIblockNames['first']['IBLOCK_ID'],
                    '=CODE' => $_GET['name'],
                ],
                'select' => ['ID'],
            ])->fetch()['ID'];
            $arFilter = [
                'IBLOCK_ID' => $templateIblockNames['first']['IBLOCK_ID'],
                'SECTION_ID' => $sectionId, // Фильтруем по ID раздела
                'ACTIVE' => 'Y', // Только активные элементы
                // Другие необходимые условия фильтрации
            ];
            ?>
            <? if ($templateIblockNames['first']): ?>
            <?= $templateIblockNames['first']['title'] ?>
            <?= $templateIblockNames['first']['open'] ?>
            <?
                //FIRST_INCLUDE
                $APPLICATION->IncludeComponent(
                    "bitrix:news.list",
                    $templateIblockNames['first']['template'],
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
                        "FILTER_NAME" => "arFilter",
                        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                        "IBLOCK_ID" => $templateIblockNames["first"]["IBLOCK_ID"],
                        "FIRST_INCLUDE_IBLOCK_TYPE" => "FIRST_INCLUDE",
                        "IBLOCK_TYPE" => $templateIblockNames['first']['IBLOCK_TYPE'],
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
                        "PAGER_TITLE" => "Маркетинг (услуги)",
                        "PARENT_SECTION" => $sectionId,
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
                        "SORT_ORDER1" => "ASC",
                        "SORT_ORDER2" => "ASC",
                        "FIRST_INCLUDE_COMPONENT_TEMPLATE" => "FIRST_INCLUDE",
                        "COMPONENT_TEMPLATE" => $templateIblockNames['first']['template'],
                        "PROPERTY_CODE" => array(
                            0 => "",
                            1 => "",
                        ),
                        "STRICT_SECTION_CHECK" => "N"
                    ),
                    false
                ); ?>
            <?= $templateIblockNames['first']['close'] ?>
            <? endif; ?>
            <?= $templateIblockNames['second']['title'] ?>
            <?= $templateIblockNames['second']['open'] ?>
            <? $sectionId = SectionTable::getList([
                'filter' => [
                    '=IBLOCK_ID' => $templateIblockNames['second']['IBLOCK_ID'],
                    '=CODE' => $_GET['name'],
                ],
                'select' => ['ID'],
            ])->fetch()['ID'];
            $arFilter = [
                'IBLOCK_ID' => $templateIblockNames['second']['IBLOCK_ID'],
                'SECTION_ID' => $sectionId, // Фильтруем по ID раздела
                'ACTIVE' => 'Y', // Только активные элементы
                // Другие необходимые условия фильтрации
            ];
            //SECOND_INCLUDE
            $APPLICATION->IncludeComponent(
                "bitrix:news.list",
                $templateIblockNames['second']['template'],
                array(
                    "ACTIVE_DATE_FORMAT" => "d.m.Y",
                    "ADD_SECTIONS_CHAIN" => "N",
                    "ADD_ELEMENT_CHAIN" => "Y",
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
                    "DISPLAY_TOP_PAGER" => "N",
                    "FIELD_CODE" => array(
                        0 => "ID",
                        1 => "CODE",
                        2 => "NAME",
                        3 => "",
                    ),
                    "FILE_404" => "",
                    "FILTER_NAME" => "arFilter",
                    "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                    "IBLOCK_ID" => $templateIblockNames["second"]["IBLOCK_ID"],
                    "SECOND_INCLUDE_IBLOCK_TYPE" => "SECOND_INCLUDE",
                    "IBLOCK_TYPE" => $templateIblockNames['second']['IBLOCK_TYPE'],
                    "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
                    "INCLUDE_SUBSECTIONS" => "N",
                    "MESSAGE_404" => "",
                    "NEWS_COUNT" => "0",
                    "PAGER_BASE_LINK_ENABLE" => "N",
                    "PAGER_DESC_NUMBERING" => "N",
                    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                    "PAGER_SHOW_ALL" => "N",
                    "PAGER_SHOW_ALWAYS" => "N",
                    "PAGER_TEMPLATE" => ".default",
                    "PAGER_TITLE" => "Наши кейсы",
                    "PARENT_SECTION" => $sectionId,
                    "PARENT_SECTION_CODE" => "",
                    "PREVIEW_TRUNCATE_LEN" => "",
                    "PROPERTY_CODE" => array(
                        0 => "",
                        1 => "ELEMENT_TYPE",
                        2 => "SECTION_ID",
                        3 => "LINKED_ELEMENTS",
                        4 => "USE_TITTLE",
                        5 => "",
                    ),
                    "SET_BROWSER_TITLE" => "N",
                    "SET_LAST_MODIFIED" => "N",
                    "SET_META_DESCRIPTION" => "N",
                    "SET_META_KEYWORDS" => "N",
                    "SET_STATUS_404" => "N",
                    "SET_TITLE" => "N",
                    "SHOW_404" => "N",
                    "SORT_BY1" => "SORT",
                    "SORT_BY2" => "SORT",
                    "SORT_ORDER1" => "ASC",
                    "SORT_ORDER2" => "ASC",
                    "SECOND_INCLUDE_COMPONENT_TEMPLATE" => "SECOND_INCLUDE",
                    "COMPONENT_TEMPLATE" => $templateIblockNames['second']['template'],
                    "STRICT_SECTION_CHECK" => "N"
                ),
                false
            ); ?>
            <?= $templateIblockNames['second']['close'] ?>
            <?
            BXClearCache('/s3/bitrix/news.list/');
            $APPLICATION->IncludeComponent(
                "bitrix:news.list",
                "faqs_from_marketing",
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
                    ),
                    "FILE_404" => "",
                    "FILTER_NAME" => "",
                    "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                    "IBLOCK_ID" => "23",
                    "IBLOCK_TYPE" => "faqs",
                    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                    "INCLUDE_SUBSECTIONS" => "N",
                    "MESSAGE_404" => "",
                    "NEWS_COUNT" => 100,
                    "PROPERTY_CODE" => array(
                        0 => "TITLE",
                    ),
                    "PAGER_BASE_LINK_ENABLE" => "N",
                    "PAGER_DESC_NUMBERING" => "N",
                    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                    "PAGER_SHOW_ALL" => "N",
                    "PAGER_SHOW_ALWAYS" => "N",
                    "PAGER_TEMPLATE" => ".default",
                    "PAGER_TITLE" => "Популярные вопросы",
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
            <?
            BXClearCache('/s3/bitrix/news.list/');
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
                        3 => "REVIEW_TYPE",
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
            <div class="question-block" data-aos="fade-up">
                <?
                $APPLICATION->IncludeComponent(
                    "bitrix:form.result.new",
                    "question_collaboration_email", // Имя вашего шаблона
                    array(
                        "WEB_FORM_ID" => "1", // ID вашей веб-формы
                        "COMPONENT_TEMPLATE" => "question_collaboration_email",
                        "LIST_URL" => "",
                        "EDIT_URL" => "",
                        "SUCCESS_URL" => "",
                        "RESULT_ID" => "",
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
                        "VARIABLE_ALIASES" => array(
                            "RESULT_ID" => "",
                            "WEB_FORM_ID" => "",
                            "formresult" => "",
                        ),
                        "formresult" => "",
                        "CHAIN_ITEM_TEXT" => "",
                        "CHAIN_ITEM_LINK" => ""
                    )
                );
                ?>
            </div>
        </div>
    </div>
</div>
<div class="ask-panel">
    <div class="ask-panel__bg"></div>
    <div class="ask-panel__content">

        <?
        $APPLICATION->IncludeComponent(
            "bitrix:form.result.new",
            "service_cost_calculation",
            array(
                "WEB_FORM_ID" => "2",
                "COMPONENT_TEMPLATE" => "service_cost_calculation",
                "LIST_URL" => "",
                "EDIT_URL" => "",
                "SUCCESS_URL" => "",
                "RESULT_ID" => "",
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
                "VARIABLE_ALIASES" => array(
                    "RESULT_ID" => "",
                    "WEB_FORM_ID" => "",
                    "formresult" => "",
                ),
                "formresult" => "",
                "CHAIN_ITEM_TEXT" => "",
                "CHAIN_ITEM_LINK" => ""
            ),
            false
        );
        ?>

    </div>

    <script>
    function toggleCalcForm(e) {
        e.preventDefault();
        if (_tmr) {
            _tmr.push({
                type: 'reachGoal',
                id: 3555455,
                goal: 'order_service_page'
            });
        }
        document.querySelector('.ask-panel').classList.toggle('active');
    }
    </script>

</div>



<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>