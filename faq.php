<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>
<?$APPLICATION->SetPageProperty("title","FAQ");?>
<div class="content-page__page" itemscope itemtype="https://schema.org/FAQPage">
    <div class="content-page__title" data-aos="fade-up">
        <div class="content-page__title_block content-page__title_block_faq">
            <h1 class="content-page__title_text">ЧАСТО ЗАДАВАЕМЫЕ <br> ВОПРОСЫ <span class="text-orange">(FAQ)</span></h1>
        </div>
    </div>
    <div class="content-page__content">
        <div class="faq-page">
            <?
                BXClearCache('/s3/bitrix/news.list/');
                $APPLICATION->IncludeComponent("bitrix:news.list", "faqs", Array(
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
                        3 => "PREVIEW_TEXT",
                    ),
                    "FILE_404" => "",
                    "FILTER_NAME" => "",
                    "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                    "IBLOCK_ID" => "23",
                    "IBLOCK_TYPE" => "faqs",
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
                    "SORT_BY1" => "SORT",
                    "SORT_BY2" => "DATE_CREATE",
                    "SORT_ORDER1" => "ASC",
                    "SORT_ORDER2" => "DESC",
                ),
                    false
                );?>
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
                    ?>
            </div>
        </div>
    </div>
</div>
<div class="content-page__more"></div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>