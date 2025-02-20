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

if (!\Bitrix\Main\Loader::includeModule("iblock"))
    return;

use Bitrix\Iblock\ElementTable;

if (!isset($_SESSION['ajax_ask_inc'])) {
    $_SESSION['ajax_ask_inc'] = 0;
}
$_SESSION['ajax_ask_inc']++;

$this->setFrameMode(false);

$query = ElementTable::query();

$query->setSelect([
    'NAME',
]);

$query->setFilter([
    'IBLOCK_ID' => 32,
    '=CODE' => $_GET['name'] // Символьный код элемента
]);

$result = $query->exec();
$element = $result->fetch();

// Добавляем элементы в структуру


// Получаем свойства элемента
if ($element) {
    $title = $element['NAME'];
}
else {
    $element = CIBlockSection::GetList(
        [],
        [
            '=CODE' => $_GET['name'],
            'IBLOCK_ID' => 32,
        ],
        false,
        [
            'NAME',
        ],
    )->fetch();
    $title = $element['NAME'];
}
?>

<button class="js-ask-close" data-ajax_ask_inc="<?= $_SESSION['ajax_ask_inc'] ?>">
    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="100" height="100" viewBox="0 0 50 50">
        <path d="M 9.15625 6.3125 L 6.3125 9.15625 L 22.15625 25 L 6.21875 40.96875 L 9.03125 43.78125 L 25 27.84375 L 40.9375 43.78125 L 43.78125 40.9375 L 27.84375 25 L 43.6875 9.15625 L 40.84375 6.3125 L 25 22.15625 Z"></path>
    </svg>
</button>

<div class="ask-panel__submit">
    <div class="ask-panel__title" style="margin-top: 15px;">Рассчитаем стоимость услуги</div>
    <div class="ask-panel__title ask-panel__title_orange">
        <span class="css service-name" data-splitting="words">"<?=$title?>"</span>
    </div>
    <div class="ask-panel__title">в коммерческом предложении</div>
    <div class="ask-panel__subtitle">Оставьте свои данные, чтобы мы могли оперативно выслать вам коммерческое предложение</div>
    <form name="SIMPLE_FORM_2" class="ask-panel__form" action="" method="POST" enctype="multipart/form-data">
        <?=bitrix_sessid_post() ?>
        <input type="hidden" name="WEB_FORM_ID" value="2">
        <input type="hidden" name="form_hidden_8" value="<?=$title?>">
        <div class="input-question-form__block">
            <input type="text" placeholder="Ваше Имя *" class="main-input order-service__form_input client-name" name="form_text_4" required>
            <div class="input-form__notice hidden"></div>
        </div>
        <div class="input-question-form__block">
            <input type="tel" placeholder="Контактный телефон *" class="main-input order-service__form_input phone" name="form_text_5" required>
            <div class="input-form__notice hidden"></div>
            <div class="input-form__notice-valid-number hidden"></div>
        </div>
        <div class="input-question-form__block">
            <input type="email" placeholder="E-mail *" class="main-input order-service__form_input email" name="form_email_6" required>
            <div class="input-form__notice hidden"></div>
        </div>
        <textarea placeholder="Дополнительный вопрос менеджеру" class="main-input service-question" name="form_textarea_7" id=""></textarea>
        <button class="main-btn _white m-0" name="web_form_submit" type="submit" value="ОТПРАВИТЬ"
                onclick="_tmr.push({ type: 'reachGoal', id: 3555455, goal: 'E-mail_form'}); return true;">ОТПРАВИТЬ</button>
    </form>
    <div class="ask-panel__subtitle mt-3">Или задайте вопрос в удобном для вас мессенджере:</div>
    <div class="ask-panel__contact">
        <a target="_blank" class="ask-panel__btn _telegram" href="https://t.me/+79676433973"
            onclick="_tmr.push({ type: 'reachGoal', id: 3555455, goal: 'Telegram'}); return true;">
            <span>Написать в Telegram</span>
            <img class="ask-panel__btn_icon" src="<?=SITE_TEMPLATE_PATH?>/assets/images/icons/telegram-neon.png" alt="">
        </a>
        <a target="_blank" class="ask-panel__btn _whatsapp" href="https://api.whatsapp.com/send?phone=8613154567328"
            onclick="_tmr.push({ type: 'reachGoal', id: 3555455, goal: 'Watsapp'}); return true;">
            <span>Написать в Whatsapp</span>
            <img class="ask-panel__btn_icon" src="<?=SITE_TEMPLATE_PATH?>/assets/images/icons/whatsapp-neon.png" alt="">
        </a>
        <a target="_blank" class="ask-panel__btn _vk" href="https://vk.me/wisetao"
            onclick="_tmr.push({ type: 'reachGoal', id: 3555455, goal: 'Vk_messend'}); return true;">
            <span>Перейти во Вконтакте</span>
            <img class="ask-panel__btn_icon" src="<?=SITE_TEMPLATE_PATH?>/assets/images/icons/vk-neon.png" alt="">
        </a>
    </div>
</div>

<div class="ask-panel__result d-none">
    <div class="ask-panel__title">Заявка <span class="_orange">успешно</span> отправлена!</div>
    <div class="ask-panel__result_svg">
        <svg width="61" height="53" viewBox="0 0 61 53" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M21 27.5L30.5 38.5L57.5 3.5" stroke="#F09123" stroke-width="5" />
            <circle cx="30" cy="31" r="21.5" stroke="#F09123" />
        </svg>
    </div>
    <div class="ask-panel__subtitle _center">
        Обработаем ее в течение 30 минут
        и вышлем коммерческое предложение
        Вам на почту.
        <br><br>
        Спасибо за ожидание!"
    </div>
    <div class="ask-panel__subtitle _center mt-5">Подписывайтесь на наши соцсети, <br> там много интересного!</div>
    <div class="ask-panel__contact">
        <a target="_blank" class="ask-panel__btn _telegram" href="https://t.me/+79676433973"
           onclick="_tmr.push({ type: 'reachGoal', id: 3555455, goal: 'Telegram'}); return true;">
            <span>Telegram</span>
            <img class="ask-panel__btn_icon" src="assets/images/icons/telegram-neon.png" alt="">
        </a>
        <a target="_blank" class="ask-panel__btn _dzen" href="#">
            <span>Dzen</span>
            <svg class="ask-panel__btn_icon" width="32" height="25" viewBox="0 0 32 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g filter="url(#filter0_d_3771_14437)">
                    <path d="M16.3883 0.990448C16.8288 0.990448 17.2694 0.990448 17.7099 0.990448C17.7225 0.990448 17.7352 0.991193 17.7477 0.992895C17.7603 0.99449 17.773 0.996086 17.7855 0.996298C18.1223 1.0014 18.459 1.00534 18.7957 1.01108C19.5011 1.02332 20.2058 1.0498 20.9092 1.10661C21.4833 1.15299 22.0547 1.22021 22.6198 1.33307C23.1419 1.43732 23.6511 1.58316 24.1387 1.80069C24.9286 2.15321 25.5381 2.69507 25.9278 3.47627C26.2131 4.04834 26.3908 4.65403 26.5134 5.27801C26.6176 5.8086 26.6895 6.34397 26.7265 6.88318C26.7644 7.43823 26.7979 7.99371 26.8191 8.54961C26.8385 9.05786 26.8388 9.56685 26.8479 10.0754C26.8482 10.0939 26.8506 10.1123 26.8527 10.1307C26.854 10.142 26.8546 10.1534 26.8546 10.1647V11.4562C26.8546 11.6254 26.7143 11.7607 26.5453 11.7546C26.3438 11.7473 26.1424 11.74 25.9409 11.7327C25.7248 11.7248 25.5088 11.718 25.2929 11.7088C25.0097 11.6966 24.7265 11.683 24.4435 11.6693C24.2276 11.6588 24.0117 11.6501 23.7962 11.6351C23.4943 11.6139 23.1926 11.5898 22.8913 11.5628C22.6431 11.5406 22.3948 11.5173 22.1479 11.4852C21.9047 11.4536 21.6625 11.4132 21.4207 11.3717C20.8785 11.2787 20.3478 11.142 19.8372 10.9348C18.8335 10.5274 18.0185 9.88586 17.4172 8.97946C16.9067 8.20964 16.6354 7.35068 16.4745 6.4512C16.4279 6.19058 16.3905 5.92827 16.3548 5.66585C16.3262 5.45576 16.3038 5.24461 16.2832 5.03357C16.2645 4.84167 16.2508 4.64924 16.2368 4.45681C16.2191 4.2096 16.201 3.96239 16.1874 3.71487C16.1729 3.45308 16.1627 3.19109 16.1519 2.9292C16.138 2.59104 16.1248 2.25288 16.1122 1.91472C16.1045 1.70963 16.0973 1.50444 16.09 1.29935C16.0841 1.13065 16.2193 0.990448 16.3883 0.990448Z" stroke="#D3CC25" stroke-miterlimit="10" />
                    <path d="M4.83594 13.8329C4.83594 13.4361 4.83594 13.0392 4.83594 12.6425C4.83594 12.4192 5.02103 12.2405 5.24409 12.2483C5.34355 12.2518 5.44301 12.2553 5.54246 12.2589C5.89839 12.272 6.2542 12.285 6.61002 12.2993C6.8667 12.3096 7.12338 12.3191 7.37984 12.3341C7.73693 12.3551 8.09392 12.3782 8.45048 12.4055C8.73099 12.427 9.0117 12.4495 9.29093 12.4833C9.60314 12.5212 9.91459 12.5674 10.2249 12.6185C10.7154 12.6994 11.1962 12.8198 11.6638 12.9903C12.4236 13.2673 13.0969 13.6828 13.6628 14.2618C14.2246 14.8365 14.6238 15.5134 14.8872 16.2716C15.0382 16.7063 15.1487 17.1516 15.2249 17.6048C15.2782 17.9219 15.3229 18.2407 15.3626 18.5598C15.3929 18.8038 15.4117 19.0493 15.4316 19.2944C15.4544 19.575 15.4749 19.8558 15.4922 20.1368C15.5071 20.3772 15.5172 20.6179 15.5275 20.8586C15.5453 21.2798 15.5619 21.7012 15.5784 22.1225C15.5847 22.2819 15.5905 22.4413 15.5964 22.6007C15.6046 22.824 15.4257 23.0096 15.2022 23.0096H13.9952C13.9809 23.0096 13.9665 23.0087 13.9524 23.0068C13.942 23.0053 13.9314 23.004 13.921 23.0038C13.1485 22.9842 12.3757 22.9725 11.6037 22.9428C11.1579 22.9256 10.7125 22.8867 10.2683 22.8444C9.8011 22.7999 9.33731 22.7283 8.87874 22.6258C8.3223 22.5013 7.78267 22.3299 7.27613 22.0625C6.67491 21.745 6.19708 21.3013 5.86243 20.7055C5.62405 20.2813 5.45311 19.831 5.326 19.363C5.15708 18.7409 5.05315 18.1067 4.99752 17.4657C4.94848 16.901 4.90721 16.3352 4.88317 15.769C4.85711 15.156 4.8554 14.5419 4.84253 13.9282C4.84232 13.9204 4.84168 13.9127 4.84072 13.905C4.83753 13.8812 4.83594 13.857 4.83594 13.8329Z" stroke="#D3CC25" stroke-miterlimit="10" />
                    <g filter="url(#filter1_d_3771_14437)">
                        <path d="M17.7184 23.0096H16.386C16.2193 23.0096 16.0862 22.8712 16.092 22.7046C16.092 22.7035 16.0921 22.7026 16.0921 22.7015C16.1001 22.4677 16.1068 22.2339 16.1155 22.0002C16.1283 21.6567 16.1415 21.3132 16.1562 20.9699C16.1661 20.738 16.1765 20.5062 16.1907 20.2745C16.2086 19.9828 16.228 19.6913 16.2513 19.4001C16.2739 19.1179 16.2945 18.8352 16.3298 18.5544C16.374 18.2038 16.4262 17.854 16.4861 17.5057C16.572 17.0053 16.7023 16.5158 16.8898 16.043C17.3051 14.9948 17.9714 14.1498 18.9226 13.5358C19.5836 13.1091 20.3126 12.8566 21.0764 12.6928C21.6511 12.5695 22.2331 12.4937 22.8177 12.4401C23.1984 12.4051 23.5801 12.3785 23.9617 12.3544C24.317 12.332 24.6727 12.3152 25.0286 12.3009C25.4782 12.283 25.9282 12.2706 26.3779 12.2549C26.4349 12.2528 26.4919 12.2505 26.5489 12.2481C26.7163 12.2407 26.8557 12.3745 26.8557 12.5421V13.8352C26.8557 13.8465 26.8551 13.8577 26.8538 13.8689C26.8517 13.8874 26.8493 13.9059 26.849 13.9245C26.8438 14.2666 26.8407 14.6087 26.834 14.9507C26.8183 15.7535 26.7856 16.5554 26.7078 17.355C26.6561 17.8859 26.5846 18.4137 26.4704 18.9351C26.3485 19.4919 26.1821 20.0339 25.9177 20.5418C25.7375 20.8881 25.5214 21.2097 25.2366 21.4793C24.806 21.8869 24.2944 22.1595 23.7412 22.3604C23.129 22.5827 22.494 22.7073 21.8509 22.7945C21.2219 22.8798 20.5893 22.9293 19.9554 22.9526C19.325 22.9759 18.694 22.9845 18.0632 22.9998C17.9483 23.0027 17.8333 23.0063 17.7184 23.0096Z" stroke="#D3CC25" stroke-miterlimit="10" shape-rendering="crispEdges" />
                    </g>
                    <path d="M13.9627 0.990448C14.4121 0.990448 14.8616 0.990448 15.311 0.990448C15.4748 0.990448 15.6054 1.12639 15.5998 1.2901C15.5998 1.29106 15.5997 1.29212 15.5997 1.29308C15.5916 1.52859 15.5848 1.7642 15.576 1.99961C15.5633 2.33596 15.55 2.67231 15.5356 3.00866C15.5254 3.24757 15.5155 3.48659 15.5005 3.72518C15.4795 4.0609 15.456 4.39661 15.4296 4.73189C15.4109 4.97006 15.3928 5.20855 15.3618 5.44523C15.3161 5.79562 15.2654 6.14559 15.2055 6.49385C15.1177 7.00476 14.984 7.50418 14.7902 7.98584C14.4259 8.89085 13.8704 9.65174 13.0878 10.2419C12.4286 10.739 11.6864 11.0548 10.8881 11.2413C10.5239 11.3264 10.1546 11.391 9.78535 11.4521C9.51868 11.4961 9.24881 11.5224 8.97958 11.5501C8.74545 11.5741 8.51048 11.5907 8.27571 11.6075C8.01254 11.6263 7.74917 11.6434 7.48579 11.658C7.23815 11.6719 6.99041 11.6824 6.74267 11.693C6.41876 11.707 6.09486 11.72 5.77085 11.7324C5.55895 11.7405 5.34706 11.7478 5.13506 11.7553C4.97156 11.761 4.83594 11.63 4.83594 11.4664C4.83594 11.0287 4.83594 10.5911 4.83594 10.1534C4.83594 10.1424 4.83658 10.1316 4.83775 10.1207C4.83987 10.102 4.84221 10.0833 4.84253 10.0646C4.84796 9.70833 4.85072 9.35198 4.85828 8.99584C4.87498 8.21081 4.90699 7.42653 4.98369 6.64458C5.0356 6.11548 5.10655 5.58936 5.21994 5.06973C5.34185 4.51096 5.50811 3.96697 5.77404 3.45776C5.98072 3.06206 6.2341 2.70135 6.57747 2.40978C7.03711 2.0195 7.56801 1.76271 8.13636 1.57571C8.71716 1.38456 9.31529 1.27404 9.91981 1.19532C10.5299 1.11597 11.143 1.06853 11.7575 1.04661C12.3738 1.0247 12.9907 1.01502 13.6073 0.999915C13.7258 0.997362 13.8442 0.993746 13.9627 0.990448Z" stroke="#D3CC25" stroke-miterlimit="10" />
                </g>
                <defs>
                    <filter id="filter0_d_3771_14437" x="0.335938" y="0.490265" width="31.0195" height="31.0193" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                        <feFlood flood-opacity="0" result="BackgroundImageFix" />
                        <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
                        <feOffset dy="4" />
                        <feGaussianBlur stdDeviation="2" />
                        <feComposite in2="hardAlpha" operator="out" />
                        <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0" />
                        <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_3771_14437" />
                        <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_3771_14437" result="shape" />
                    </filter>
                    <filter id="filter1_d_3771_14437" x="11.5918" y="11.7478" width="19.7637" height="19.7618" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                        <feFlood flood-opacity="0" result="BackgroundImageFix" />
                        <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
                        <feOffset dy="4" />
                        <feGaussianBlur stdDeviation="2" />
                        <feComposite in2="hardAlpha" operator="out" />
                        <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0" />
                        <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_3771_14437" />
                        <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_3771_14437" result="shape" />
                    </filter>
                </defs>
            </svg>

        </a>
        <a target="_blank" class="ask-panel__btn _vk" href="https://vk.me/wisetao"
            onclick="_tmr.push({ type: 'reachGoal', id: 3555455, goal: 'Vk_messend'}); return true;">
            <span>Вконтакте</span>
            <img class="ask-panel__btn_icon" src="assets/images/icons/vk-neon.png" alt="">
        </a>
    </div>

</div>