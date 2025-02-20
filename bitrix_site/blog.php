<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>
<?$APPLICATION->SetPageProperty("title","Блог");?>
                        <div class="content-page__page" itemscope itemtype="https://schema.org/Blog">
                            <div class="content-page__title" data-aos="fade-up">
                                <div class="content-page__title_block">
                                    <h1 class="content-page__title_text _text-left" itemprop="name">Блог</h1>
                                    <div class="content-page__title_logo"><img src="<?=SITE_TEMPLATE_PATH?>/assets/images/wisetao-blog-logo.svg" alt=""></div>
                                    <div class="content-page__title_subtext" itemprop="description">о самом интересном и важном в работе с Китаем</div>
                                </div>
                            </div>
                            <div class="content-page__content">
                                <div class="blog-page">
                                    <?
                                    session_start();
                                    if (!isset($_SESSION['n_count'])) {
                                        $_SESSION['n_count'] = 13;
                                        $_SESSION['n_count_requested'] = 12;
                                    }
                                    if (isset($_GET['more']) && !isset($_REQUEST['tag']) && !isset($_REQUEST['search'])) {
                                        $_SESSION['n_count'] += 4;
                                        $_SESSION['n_count_requested'] = $_SESSION['n_count'] - 1;
                                    } elseif (!isset($_REQUEST['tag']) && !isset($_REQUEST['search'])) {
                                        $_SESSION['n_count'] = 13;
                                        $_SESSION['n_count_requested'] = 12;
                                    }
                                    if ((isset($_REQUEST['tag']) || isset($_REQUEST['search'])) && !isset($_GET['more'])) {
                                        $_SESSION['n_count'] = 20;
                                        $_SESSION['n_count_requested'] = 12;
                                    }
                                    elseif (!isset($_GET['more'])) {
                                        $_SESSION['n_count'] = 13;
                                        $_SESSION['n_count_requested'] = 12;
                                    }
                                    if (isset($_GET['more']) && (isset($_REQUEST['tag']) || isset($_REQUEST['search']))) {
                                        $_SESSION['n_count'] += 4;
                                        $_SESSION['n_count_requested'] += 4;
                                    }
                                    BXClearCache('/s3/bitrix/news.list/');
                                    $APPLICATION->IncludeComponent("bitrix:news.list", "blog_articles_and_tags", Array(
                                        "ACTIVE_DATE_FORMAT" => "d.m.Y",
                                        "ADD_SECTIONS_CHAIN" => "N",
                                        "AJAX_MODE" => "Y",
                                        "AJAX_OPTION_ADDITIONAL" => "",
                                        "AJAX_OPTION_HISTORY" => "N",
                                        "AJAX_OPTION_JUMP" => "N",
                                        "AJAX_OPTION_LOADING" => "N",
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
                                        "NEWS_COUNT" => $_SESSION['n_count'],
                                        "PAGER_BASE_LINK_ENABLE" => "N",
                                        "PAGER_DESC_NUMBERING" => "N",
                                        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                                        "PAGER_SHOW_ALL" => "N",
                                        "PAGER_SHOW_ALWAYS" => "N",
                                        "PAGER_TEMPLATE" => ".default",
                                        "PAGER_TITLE" => "Блог (Статьи и тэги)",
                                        "PARENT_SECTION" => "",
                                        "PARENT_SECTION_CODE" => "",
                                        "PROPERTY_CODE" => array(
                                            0 => "AUTHOR_OF_THE_ARTICLE",
                                            1 => "HEADER_PIC",
                                            2 => "TAGS",
                                            3 => "MAX_AGE_NEW_ARTICLE",
                                        ),
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

                                    <div class="logistic-additional block-services" itemscope itemtype="https://schema.org/Service">
                                        <div class="block-services__wrap">
                                            <h3 class="logistic-check__title group-title logistic-additional__title" itemprop="name">Наши Услуги</h3>
                                            <div class="block-services__body">
                                                <?$APPLICATION->IncludeComponent(
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
                                                );?>

                                            </div>
                                        </div>
                                    </div>

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
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>