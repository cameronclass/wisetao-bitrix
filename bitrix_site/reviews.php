<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php"); ?>
<? $APPLICATION->SetPageProperty("title", "Отзывы"); ?>
    <div class="content-page__page">
        <div class="content-page__title">
            <h1 class="content-page__title_text">ОТЗЫВЫ <br> КЛИЕНТОВ</h1>
        </div>
        <div class="content-page__content">
            <div class="content-page__content_center">
                <?
                session_start();
                if (!isset($_SESSION['n_count'])) {
                    $_SESSION['n_count'] = 3;
                    $_SESSION['n_count_requested'] = 3;
                }
                if (isset($_GET['more']) && !isset($_REQUEST['tag'])) {
                    $_SESSION['n_count'] += 100;
                    $_SESSION['n_count_requested'] = $_SESSION['n_count'];
                } elseif (!isset($_REQUEST['tag'])) {
                    $_SESSION['n_count'] = 3;
                    $_SESSION['n_count_requested'] = 3;
                }
                if (isset($_REQUEST['tag']) && !isset($_GET['more'])) {
                    $_SESSION['n_count'] = 100;
                    $_SESSION['n_count_requested'] = 3;
                } elseif (!isset($_GET['more'])) {
                    $_SESSION['n_count'] = 3;
                    $_SESSION['n_count_requested'] = 3;
                }
                if (isset($_GET['more']) && isset($_REQUEST['tag'])) {
                    $_SESSION['n_count'] += 2;
                    $_SESSION['n_count_requested'] += 2;
                }
                BXClearCache('/s3/bitrix/news.list/');
                $APPLICATION->IncludeComponent("bitrix:news.list", "reviews", array(
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
                        6 => "MAIN_TOPIC",
                    ),
                    "FILE_404" => "",
                    "FILTER_NAME" => "",
                    "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                    "IBLOCK_ID" => "21",
                    "IBLOCK_TYPE" => "reviews",
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
                    "PAGER_TITLE" => "Отзывы",
                    "PARENT_SECTION" => "",
                    "PARENT_SECTION_CODE" => "",
                    "PREVIEW_TRUNCATE_LEN" => "",
                    "PROPERTY_CODE" => array(
                        0 => "TOPICS",
                        1 => "SERVICES",
                        2 => "REVIEWER_NAME",
                    ),
                    "SET_BROWSER_TITLE" => "N",
                    "SET_LAST_MODIFIED" => "N",
                    "SET_META_DESCRIPTION" => "N",
                    "SET_META_KEYWORDS" => "N",
                    "SET_STATUS_404" => "N",
                    "SET_TITLE" => "N",
                    "SHOW_404" => "N",
                    "SORT_BY1" => "PROPERTY_TOPICS",
                    "SORT_BY2" => "SORT",
                    "SORT_ORDER1" => "DESC",
                    "SORT_ORDER2" => "ASC",
                ),
                    false
                ); ?>
                <div class="review-ask" data-aos="fade-up">
                    <h3 class="review-ask__title">
                        ОСТАВЬ СВОЙ ЧЕСТНЫЙ ОТЗЫВ
                    </h3>
                    <div class="review-ask__subtitle">Это поможет нам стать еще лучше!</div>
                    <?
                    $APPLICATION->IncludeComponent(
                        "bitrix:iblock.element.add.form",
                        "add_review",
                        array(
                            "AJAX_MODE" => "Y",
                            "AJAX_OPTION_ADDITIONAL" => "",
                            "AJAX_OPTION_HISTORY" => "N",
                            "AJAX_OPTION_JUMP" => "N",
                            "AJAX_OPTION_STYLE" => "Y",
                            "IBLOCK_TYPE" => "reviews",
                            "IBLOCK_ID" => "21",
                            "PROPERTY_CODES" => array(
                                0 => "187",
                                1 => "188",
                                2 => "189",
                                3 => "201",
                                4 => "NAME",
                                5 => "PREVIEW_TEXT",
                            ),
                            "COMPONENT_TEMPLATE" => "add_review",
                            "STATUS_NEW" => "NEW",
                            "LIST_URL" => "",
                            "USE_CAPTCHA" => "N",
                            "USER_MESSAGE_EDIT" => "",
                            "USER_MESSAGE_ADD" => "",
                            "DEFAULT_INPUT_SIZE" => "30",
                            "RESIZE_IMAGES" => "N",
                            "PROPERTY_CODES_REQUIRED" => array(
                                0 => "187",
                                1 => "188",
                                2 => "189",
                                3 => "201",
                                4 => "NAME",
                                5 => "PREVIEW_TEXT",
                            ),
                            "GROUPS" => array(
                                0 => "2",
                            ),
                            "STATUS" => "ANY",
                            "ELEMENT_ASSOC" => "CREATED_BY",
                            "MAX_USER_ENTRIES" => "100000",
                            "MAX_LEVELS" => "100000",
                            "LEVEL_LAST" => "Y",
                            "MAX_FILE_SIZE" => "0",
                            "PREVIEW_TEXT_USE_HTML_EDITOR" => "N",
                            "DETAIL_TEXT_USE_HTML_EDITOR" => "N",
                            "SEF_MODE" => "N",
                            "CUSTOM_TITLE_NAME" => "",
                            "CUSTOM_TITLE_TAGS" => "",
                            "CUSTOM_TITLE_DATE_ACTIVE_FROM" => "",
                            "CUSTOM_TITLE_DATE_ACTIVE_TO" => "",
                            "CUSTOM_TITLE_IBLOCK_SECTION" => "",
                            "CUSTOM_TITLE_PREVIEW_TEXT" => "",
                            "CUSTOM_TITLE_PREVIEW_PICTURE" => "",
                            "CUSTOM_TITLE_DETAIL_TEXT" => "",
                            "CUSTOM_TITLE_DETAIL_PICTURE" => ""
                        ),
                        false
                    );
                    ?>
                </div>
            </div>
        </div>
    </div>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>