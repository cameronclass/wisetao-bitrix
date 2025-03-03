<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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

if (!isset($_SESSION['ajax_question_inc'])) {
    $_SESSION['ajax_question_inc'] = 0;
}
$_SESSION['ajax_question_inc']++;

?>

<div class="question-block__bg">
    <img src="<?=SITE_TEMPLATE_PATH?>/assets/images/review-form.png" alt="">
</div>
<div class="question-block__block">
    <div class="question-block__submit" data-ajax_question_inc="<?= $_SESSION['ajax_question_inc'] ?>">
        <div class="question-block__title">
            <div class="question-block__title_text">
                <span class="question-block__title_first">ОСТАЛИСЬ ВОПРОСЫ?</span>
                <span class="question-block__title_divide">/</span>
                <span class="question-block__title_last">ХОЧЕШЬ НАЧАТЬ СОТРУДНИЧЕСТВО?</span>
            </div>
            <div class="question-block__subtitle">Мы всегда на связи и готовы помочь!</div>
        </div>
        <form name="SIMPLE_FORM_1" class="question-block__form" action="" method="POST" enctype="multipart/form-data">
            <?=bitrix_sessid_post() ?>
            <input type="hidden" name="WEB_FORM_ID" value="1">
            <div class="question-block__form_title">Мы внимательно относимся к каждой заявке и ответим вам в течение 15 минут. <br> Оставьте ваши данные, чтобы мы связались с вами:</div>
            <div class="question-block__form_block">
                <div class="input-question-form__block">
                    <input type="text" placeholder="Ваше Имя *" name="form_text_1" class="main-input question-block__form_input client-name" required>
                    <div class="input-form__notice hidden"></div>
                </div>
                <div class="input-question-form__block">
                    <input type="text" placeholder="Контактный телефон *" name="form_text_3" class="main-input question-block__form_input phone" required>
                    <div class="input-form__notice hidden"></div>
                    <div class="input-form__notice-valid-number hidden"></div>
                </div>
                <div class="input-question-form__block">
                    <input type="email" placeholder="E-mail *" name="form_email_2" class="main-input question-block__form_input email" required>
                    <div class="input-form__notice hidden"></div>
                </div>
                <button class="main-btn" name="web_form_submit" value="ОТПРАВИТЬ" type="submit" onclick="_tmr.push({ type: 'reachGoal', id: 3555455, goal: 'E-mail_form'}); return true;">ОТПРАВИТЬ</button>
            </div>
        </form>
        <div class="question-block__contacts">
            <div class="question-block__contacts_title">Или пишите лично в нашей группе во Вконтакте</div>
            <div class="question-block__contacts_block">
                <a target="_blank" href="https://vk.me/wisetao" class="question-block__contacts_link link-vk" onclick="_tmr.push({ type: 'reachGoal', id: 3555455, goal: 'Vk_messend'}); return true;">Перейти во Вконтакте</a>
                <a target="_blank" href="https://api.whatsapp.com/send?phone=8613154567328" class="question-block__contacts_link link-whatsapp" onclick="_tmr.push({ type: 'reachGoal', id: 3555455, goal: 'Watsapp'}); return true;">Написать в Whatsapp</a>
                <a target="_blank" href="https://t.me/+79676433973" class="question-block__contacts_link link-telegram" onclick="_tmr.push({ type: 'reachGoal', id: 3555455, goal: 'Telegram'}); return true;">Написать в Telegram</a>
            </div>
        </div>
    </div>
    <div class="question-block__result d-none">
        <div class="question-block__title">Запрос <span class="_orange">успешно</span> отправлен!</div>
        <div class="ask-panel__result_svg">
            <svg width="61" height="53" viewBox="0 0 61 53" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M21 27.5L30.5 38.5L57.5 3.5" stroke="#F09123" stroke-width="5" />
                <circle cx="30" cy="31" r="21.5" stroke="#F09123" />
            </svg>
        </div>
    </div>
</div>