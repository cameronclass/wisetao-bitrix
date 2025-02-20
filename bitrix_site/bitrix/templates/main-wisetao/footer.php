<? if ($APPLICATION->GetCurPage(false) != '/'
    && $APPLICATION->GetCurPage(false) != '/menu.php'
    && explode('-', $APPLICATION->GetCurPage(false))[0] != '/hash'
    && explode('-', $APPLICATION->GetCurPage(false))[0] != '/bitrix_include_areas'): ?>
    </div>
    </div>
    </main>
    </div>

    </div>

    <footer class="footer">
        <div class="footer-bg">
            <div class="footer-bg__gradient1"></div>
            <div class="footer-bg__gradient2"></div>
            <img class="footer-bg__img" src="<?=SITE_TEMPLATE_PATH?>/assets/images/bg.svg" alt="">
        </div>
        <div class="container-fluid" data-aos="fade-up">
            <div class="footer__block container">
                <div class="footer__logo">
                    <img src="<?=SITE_TEMPLATE_PATH?>/assets/images/logo.svg?v=1.1.1" alt="">
                </div>
                <div class="footer__menu">
                    <div class="footer__menu_block">
                        <div class="footer__menu_title">Из Китая</div>
                        <?
                        $APPLICATION->IncludeComponent("bitrix:news.list", "footer_menu", Array(
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
                            "PAGER_TITLE" => "Меню в подвале",
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
                    </div>
                    <div class="footer__menu_block">
                        <div class="footer__menu_title">В Китай</div>
                        <?
                        $APPLICATION->IncludeComponent("bitrix:news.list", "footer_menu", Array(
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
                            "PAGER_TITLE" => "Меню в подвале",
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
                    </div>
                    <div class="footer__menu_block">
                        <div class="footer__menu_title"><a href="/">Все услуги</a></div>
                        <?
                        $APPLICATION->IncludeComponent("bitrix:news.list", "footer_menu", Array(
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
                            "THIRD_COL" => "Y",
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
                            "PAGER_TITLE" => "Меню в подвале",
                            "PARENT_SECTION" => "",
                            "PARENT_SECTION_CODE" => "",
                            "PREVIEW_TRUNCATE_LEN" => "",
                            "PROPERTY_CODE" => array(
                                0 => "LINK",
                                1 => "",
                            ),
                            'SECTION_ID' => 85,
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
                <div class="footer__contact">
                    <a class="btn-primary" href="mailto:zakaz@wisetao.com"
                        onclick="_tmr.push({ type: 'reachGoal', id: 3555455, goal: 'E-mail_button'}); return true;">zakaz@wisetao.com</a>
                    <a class="footer__number" href="tel:+8613154567328"
                       onclick="_tmr.push({ type: 'reachGoal', id: 3555455, goal: 'Tap_to_phone'}); return true;">+86 13154567328</a>
                    <div class="footer__social">
                        <a href="#" class="footer__social_link">
                            <img src="<?=SITE_TEMPLATE_PATH?>/assets/images/soc-phone.svg" alt="">
                        </a>
                        <a href="https://vk.me/wisetao" class="footer__social_link"
                            onclick="_tmr.push({ type: 'reachGoal', id: 3555455, goal: 'Vk_messend'}); return true;">
                            <img src="<?=SITE_TEMPLATE_PATH?>/assets/images/soc-vk.svg" alt="">
                        </a>
                        <a href="#" class="footer__social_link">
                            <img src="<?=SITE_TEMPLATE_PATH?>/assets/images/soc-youtube.svg" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <div class="block-cookie" data-aos-delay="3000" data-aos="fade-up">
        <div class="container">
            <div class="block-cookie__block">
                <div class="block-cookie__content">
                    <div class="block-cookie__title">Подтвердить COOkie</div>
                    <div class="block-cookie__text">Этот сайт использует файлы Cookie для хранения данных. Продолжая использовать сайт вы даете свое согласие на работу с этими файлами</div>
                </div>
                <button class="calc-panel__link block-cookie__btn">ПРИНИМАЮ</button>
            </div>
        </div>
    </div>

<? endif; ?>

<?
\Bitrix\Main\Page\Asset::getInstance()->addJs(SITE_TEMPLATE_PATH.'/assets/js/others.js?v='.filemtime(SITE_TEMPLATE_PATH.'/assets/js/others.js'));
\Bitrix\Main\Page\Asset::getInstance()->addJs(SITE_TEMPLATE_PATH.'/assets/js/libs.js?v='.filemtime(SITE_TEMPLATE_PATH.'/assets/js/libs.js'));
\Bitrix\Main\Page\Asset::getInstance()->addJs(SITE_TEMPLATE_PATH.'/assets/js/main.js?v='.filemtime(SITE_TEMPLATE_PATH.'/assets/js/main.js'));
\Bitrix\Main\Page\Asset::getInstance()->addJs(SITE_TEMPLATE_PATH.'/assets/js/menu.js?v='.filemtime(SITE_TEMPLATE_PATH.'/assets/js/menu.js'));
\Bitrix\Main\Page\Asset::getInstance()->addJs(SITE_TEMPLATE_PATH.'/assets/js/slider.js?v='.filemtime(SITE_TEMPLATE_PATH.'/assets/js/slider.js'));
\Bitrix\Main\Page\Asset::getInstance()->addJs(SITE_TEMPLATE_PATH.'/assets/js/changes.js?v='.filemtime(SITE_TEMPLATE_PATH.'/assets/js/changes.js'));
?>

<?\Bitrix\Main\Page\Asset::getInstance()->addJs(SITE_TEMPLATE_PATH.'/assets/js/activate_menu.js?v='.filemtime(SITE_TEMPLATE_PATH.'/assets/js/activate_menu.js'));?>

<? if (explode('/', $APPLICATION->GetCurPage(false))[2] == 'logistic'): ?>
    <script src="<?=SITE_TEMPLATE_PATH?>/assets/js/swiper-bundle.min.js"></script>
    <script src="<?=SITE_TEMPLATE_PATH?>/assets/js/main_services.js"></script>
    <script src="<?=SITE_TEMPLATE_PATH?>/assets/js/scroll-magic.min.js"></script>
<?endif;?>
<? if (explode('/', $APPLICATION->GetCurPage(false))[3] == 'blog'): ?>
    <script src="<?=SITE_TEMPLATE_PATH?>/assets/js/tag_line_calc.js"></script>
    <script src="<?=SITE_TEMPLATE_PATH?>/assets/js/main_services.js"></script>
    <script src="<?=SITE_TEMPLATE_PATH?>/assets/js/scroll-magic.min.js"></script>
<?endif;?>
<?
//if (explode('/', $APPLICATION->GetCurPage(false))[2] == 'logistic') {
//    \Bitrix\Main\Page\Asset::getInstance()->addJs(SITE_TEMPLATE_PATH.'/assets/js/swiper-bundle.min.js?v='.filemtime(SITE_TEMPLATE_PATH.'/assets/js/swiper-bundle.min.js'));
//    \Bitrix\Main\Page\Asset::getInstance()->addJs(SITE_TEMPLATE_PATH.'/assets/js/main_services.js?v='.filemtime(SITE_TEMPLATE_PATH.'/assets/js/main_services.js'));
//    \Bitrix\Main\Page\Asset::getInstance()->addJs(SITE_TEMPLATE_PATH.'/assets/js/scroll-magic.min.js?v='.filemtime(SITE_TEMPLATE_PATH.'/assets/js/scroll-magic.min.js'));
//}
//
//if (explode('/', $APPLICATION->GetCurPage(false))[3] == 'blog') {
//    \Bitrix\Main\Page\Asset::getInstance()->addJs(SITE_TEMPLATE_PATH.'/assets/js/tag_line_calc.js?v='.filemtime(SITE_TEMPLATE_PATH.'/assets/js/tag_line_calc.js'));
//    \Bitrix\Main\Page\Asset::getInstance()->addJs(SITE_TEMPLATE_PATH.'/assets/js/main_services.js?v='.filemtime(SITE_TEMPLATE_PATH.'/assets/js/main_services.js'));
//    \Bitrix\Main\Page\Asset::getInstance()->addJs(SITE_TEMPLATE_PATH.'/assets/js/scroll-magic.min.js?v='.filemtime(SITE_TEMPLATE_PATH.'/assets/js/scroll-magic.min.js'));
//}
?>

<?\Bitrix\Main\Page\Asset::getInstance()->addString(
    "<script>
        BX.addCustomEvent('onAjaxSuccess', function(){
            initializeDropDownLists();
            initializeExpandButtons();
            initializeToggleFAQItems();
            if (typeof calcLineTags === 'function') {
                calcLineTags();
            }
            initializeAskPanelAjaxMode();
            initializeQuestionFormAjaxMode();
            initializeValidateQuestionForm();
            initializeValidateServiceOrderForm();
        });
    </script>"
    );
?>

<script src="<?=SITE_TEMPLATE_PATH?>/assets/js/del_params_edit_mode.js"></script>

<?//\Bitrix\Main\Page\Asset::getInstance()->addJs(SITE_TEMPLATE_PATH.'/assets/js/del_params_edit_mode.js?v='.filemtime(SITE_TEMPLATE_PATH.'/assets/js/del_params_edit_mode.js'));?>
<script>
    (function(w,d,u){
        var s=d.createElement('script');s.async=true;s.src=u+'?'+(Date.now()/60000|0);
        var h=d.getElementsByTagName('script')[0];h.parentNode.insertBefore(s,h);
    })(window,document,'https://cdn-ru.bitrix24.ru/b27596596/crm/tag/call.tracker.js');
</script>

</body>

</html>