<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(false);
session_start();
if (!isset($_SESSION['ajax_form_inc'])) {
    $_SESSION['ajax_form_inc'] = 0;
}
$_SESSION['ajax_form_inc']++;
?>
<form name="iblock_add" data-aos="fade-up" method="post" class="review-ask__form" action="<?=POST_FORM_ACTION_URI?>" enctype="multipart/form-data">
    <?=bitrix_sessid_post() ?>
    <div class="review-ask__input">
        <input type="text" class="main-input" placeholder="Ваше Имя *" name="PROPERTY[189][0]" required>
        <input type="email" class="main-input" placeholder="E-mail *" name="PROPERTY[201][0]" required>
        <input type="hidden" name="PROPERTY[187][0]" class="input-review">
        <input type="hidden" name="PROPERTY[188][0]" class="input-review">
        <input type="hidden" name="PROPERTY[NAME][0]" class="input-review">
        <div class="review-form-lists" style="z-index: 2;">
            <div class="review-form-lists-dropdown">
                <div class="review-form-lists-dropdown-toggle" id="review-form-lists" data-typelist="Тема отзыва: " data-input_name="PROPERTY[187][0]" data-input_name_additionaly="PROPERTY[NAME][0]" data-ajax_form_inc="<?=$_SESSION['ajax_form_inc']?>">
                    Тема отзыва *
                </div>
                <ul class="review-form-lists-dropdown-list">
                    <? foreach ($arResult["PROPERTY_LIST_FULL"][187]['ENUM'] as $key => $list_elem): ?>
                        <li >
                            <span data-id_topic="<?=$key?>" class="review-form-lists-values"><?=$list_elem['VALUE']?></span>
                        </li>
                    <? endforeach; ?>
                </ul>
            </div>
        </div>
        <div class="review-form-lists">
            <div class="review-form-lists-dropdown">
                <div class="review-form-lists-dropdown-toggle" id="review-form-lists" data-typelist="Услуга: " data-input_name="PROPERTY[188][0]" data-ajax_form_inc="<?=$_SESSION['ajax_form_inc']?>">
                    Услуга *
                </div>
                <ul class="review-form-lists-dropdown-list">
                    <? foreach ($arResult["PROPERTY_LIST_FULL"][188]['ENUM'] as $key => $list_elem): ?>
                        <li>
                            <span data-id_topic="<?=$key?>" class="review-form-lists-values"><?=$list_elem['VALUE']?></span>
                        </li>
                    <? endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="review-ask__text">
        <textarea class="main-input main-textarea" name="PROPERTY[PREVIEW_TEXT][0]" id="" required></textarea>
    </div>
    <div style="color: red">
        <? foreach ($arResult["ERRORS"] as $error): ?>
            <? if(str_contains($error, 'Тема')): ?>
                <span style="font-size: 14px; margin-top: 10px; display: block"><?= $error ?></span>
            <? endif; ?>
            <? if(str_contains($error, 'Услуга')): ?>
                <span style="font-size: 14px; display: block"><?= $error ?></span>
            <? endif; ?>
        <? endforeach; ?>

    </div>
    <div style="color: green">
        <? if($arResult["MESSAGE"] != ''): ?>
            <span style="font-size: 14px; margin-top: 10px; display: block">Ваше отзыв получен, и будет опубликован<br>после проверки модератором.</span>
        <? endif; ?>
    </div>
    <div class="review-ask__button">
        <button type="submit" name="iblock_submit" class="main-btn" value="ОТПРАВИТЬ">ОТПРАВИТЬ</button>
    </div>
</form>


