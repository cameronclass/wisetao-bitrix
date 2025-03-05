<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
if (!\Bitrix\Main\Loader::includeModule("iblock"))
    return;

use Bitrix\Iblock\SectionTable;
?>
<div class="content-page__page">
    <?
    BXClearCache('/s3/bitrix/news.detail/');
    $APPLICATION->IncludeComponent(
        "bitrix:news.detail",
        "blog_inside",
        array(
            "IBLOCK_TYPE" => "blog",
            "IBLOCK_ID" => $_REQUEST["IBLOCK_ID"],
            "ELEMENT_ID" => $_REQUEST["ID"],
            "CHECK_DATES" => "Y",
            "FIELD_CODE" => array(
                0 => "DATE_CREATE",
            ),
            "PROPERTY_CODE" => array(
                0 => "TAGS",
                1 => "AUTHOR_OF_THE_ARTICLE",
                2 => "HEADER_PIC",
            ),
            "SET_TITLE" => "N",
            "SET_BROWSER_TITLE" => "Y",
            "SET_META_KEYWORDS" => "Y",
            "SET_META_DESCRIPTION" => "Y",
            "SET_LAST_MODIFIED" => "Y",
            "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
            "ADD_SECTIONS_CHAIN" => "Y",
            "CACHE_TYPE" => "A",
            "CACHE_TIME" => "3600",
            "CACHE_NOTES" => "",
            "CACHE_GROUPS" => "Y",
            "ACTIVE_DATE_FORMAT" => "d.m.Y",
            "USE_PERMISSIONS" => "N",
            "GROUP_PERMISSIONS" => array(),
            "DISPLAY_DATE" => "Y",
            "DISPLAY_NAME" => "Y",
            "DISPLAY_PICTURE" => "Y",
            "DISPLAY_PREVIEW_TEXT" => "Y",
            "USE_SHARE" => "N",
            "PAGER_TEMPLATE" => "",
            "DISPLAY_TOP_PAGER" => "N",
            "DISPLAY_BOTTOM_PAGER" => "Y",
            "PAGER_TITLE" => "",
            "PAGER_SHOW_ALWAYS" => "N",
            "PAGER_DESC_NUMBERING" => "N",
            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
            "PAGER_SHOW_ALL" => "N",
            "DISPLAY_IMG_WIDTH" => "80",
            "DISPLAY_IMG_HEIGHT" => "80",
            "USE_RATING" => "N",
            "MAX_VOTE" => "5",
            "VOTE_NAMES" => array("1", "2", "3", "4", "5"),
            "USE_COMMENTS" => "N",
            "BROWSER_TITLE" => "-",
            "TEMPLATE_THEME" => "blue",
        )
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
                "IGNORE_CUSTOM_TEMPLATE" => "N",
                "USE_EXTENDED_ERRORS" => "N",
                "SEF_MODE" => "Y",
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
        ?>
    </div>
    <? $APPLICATION->IncludeComponent(
        "bitrix:news.list",
        "blog_articles_from_blog_inside",
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
<div class="content-page__content_right">
    <div class="blog-inside__panel">
        <div class="blog-inside-panel__elements" itemscope itemtype="https://schema.org/Blog">
            <div class="calc-panel" data-aos="fade-up">
                <div class="calc-panel__title">Онлайн - калькулятор расчета логистики</div>
                <div class="calc-panel__text">Самостоятельно сделайте расчет доставки за 1 минуту! И выберите
                    оптимальный для вас вариант.</div>
                <a href="/<?= $_GET['direct-china'] ?>/logistic/" class="calc-panel__link">Рассчитать</a>
            </div>
            <h3 class="blog-inside__panel_title" data-aos="fade-up" itemprop="name">Похожие</h3>
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
            ); ?>
        </div>
    </div>
</div>
</div>

<!--                        <div class="content-page__more ">-->
<!--                            <div class="email-sub">-->
<!--                                <div class="email-sub__title">Статьи были полезны?</div>-->
<!--                                <div class="email-sub__text"><b>Подпишись</b> на нашу рассылку и не пропусти самые важные бизнес-новости</div>-->
<!--                                <form class="email-sub__form" action="#" method="post">-->
<!--                                    <input type="text" placeholder="Ваш E-mail" class="main-input">-->
<!--                                    <div class="email-sub__title"></div>-->
<!--                                    <button class="main-btn" type="submit">ОТПРАВИТЬ</button>-->
<!--                                </form>-->
<!--                            </div>-->
<!--                        </div>-->
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>