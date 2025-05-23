<?
use Bitrix\Main\Page\Asset;

$currentPage = $APPLICATION->GetCurPage(); // Получаем текущий URL

if ($currentPage == '/from-china/logistic/') { // Замените на нужный URL
    $asset = Asset::getInstance();
    $asset->addCss('/calc-new/css/new.css?v=' . filemtime($_SERVER['DOCUMENT_ROOT'] . '/calc-new/css/new.css'), false, ['minify' => true]);
}
?>


<script type="module" src="/calc-new/js/main.js?v=2.6"></script>

<div class="main-calc">
    <form method="post" name="main-calc__form">

        <div class="main-calc-select">
            <label class="main-calc-select__label">
                <input class="main-calc-select__input" type="radio" value="calc-cargo" name="calc-type" checked>
                <span class="main-calc-select__btn">
                    <span class="main-calc-select__btn_title">Карго</span>
                    <span class="main-calc-select__btn_subtitle">от 0,8$/кг</span>
                </span>
            </label>
            <label class="main-calc-select__label">
                <input class="main-calc-select__input" type="radio" value="calc-customs" name="calc-type">
                <span class="main-calc-select__btn">
                    <span class="main-calc-select__btn_title">Таможенный</span>
                    <span class="main-calc-select__btn_subtitle">от 0,25$/кг</span>
                </span>
            </label>
            <!-- <label class="main-calc-select__label">
                <input class="main-calc-select__input" type="radio" value="calc-compare" name="calc-type">
                <span class="main-calc-select__btn">
                    <span class="main-calc-select__btn_title">Сравнение</span>
                </span>
            </label> -->
        </div>

        <div class="main-calc__wrapper">

            <div class="main-calc-first">
                <div class="main-calc-first__block">

                    <div class="main-calc-first__choose">
                        <h4 class="main-calc__title _small">
                            <span class="main-calc__title_icon"></span>
                            <span class="main-calc__title_text">Меня интересует</span>
                        </h4>
                        <div class="main-calc-first__choose_block">
                            <label class="main-calc-radio">
                                <span class="main-calc-radio__title">Только доставка</span>
                                <input class="main-calc-radio__input" type="radio" checked name="delivery-option"
                                    value="delivery-only">
                                <span class="main-calc-radio__mark"></span>
                            </label>

                            <label class="main-calc-radio">
                                <span class="main-calc-radio__title">Доставка и выкуп</span>
                                <input class="main-calc-radio__input" type="radio" name="delivery-option"
                                    value="delivery-and-pickup">
                                <span class="main-calc-radio__mark"></span>
                                <span class="calc-tooltip">
                                    <span class="calc-tooltip__title">Выкуп Товара</span>
                                    <span class="calc-tooltip__text">
                                        Помимо доставки мы осуществляем выкуп товаров с фабрик Китая, от поставщиков
                                        и
                                        из интернет-магазинов.
                                        Если вам необходим выкуп, воспользуйтесь этой настройкой.
                                        Узнать подробнее о <a class="calc-tooltip__link" target="_blank"
                                            href="https://wisetao.com/from-china/transaction/full-deal/">выкупе</a>
                                    </span>
                                </span>
                            </label>
                        </div>
                    </div>

                </div>
            </div>

            <div class="main-calc__divider"></div>

            <div class="main-calc__from-to">
                <!-- Откуда -->
                <div class="main-calc__from-to_from group-input">
                    <div class="group-input__title">Откуда</div>
                    <div class="group-input__input">
                        <input type="text" name="from_where" placeholder="Китай - Фошань" disabled="">
                        <svg class="group-input__input_svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <rect x="6" y="10" width="12" height="8" rx="2" fill="#91969b"></rect>
                            <path d="M9 10V9C9 7.34315 10.3431 6 12 6C13.6569 6 15 7.34315 15 9V10" stroke="#91969b"
                                stroke-width="2"></path>
                        </svg>
                    </div>
                </div>
                <!-- Стрелка -->
                <div class="main-calc__from-to_arrow">
                    <svg class="arrow-to active" width="413.98407" height="400.00037" viewBox="0 0 12.419522 12.000011"
                        fill="none" version="1.1" id="svg1" sodipodi:docname="arrow-sm-down-svgrepo-com.svg"
                        inkscape:version="1.3 (0e150ed6c4, 2023-07-21)"
                        xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape"
                        xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd"
                        xmlns="http://www.w3.org/2000/svg" xmlns:svg="http://www.w3.org/2000/svg">
                        <path d="M 1.0000048,6.0000048 H 11.419517 m 0,0 -5,5.0000002 m 5,-5.0000002 -5,-5"
                            stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" id="path1"
                            sodipodi:nodetypes="cccccc"
                            style="fill-opacity:1;stroke-width:2.00001;stroke-dasharray:none;stroke-opacity:1">
                        </path>
                    </svg>
                </div>
                <!-- Куда -->
                <div class="main-calc__from-to_to group-input">
                    <div class="group-input__title">Куда</div>
                    <div class="group-input__input">
                        <input type="text" name="from_to" placeholder="Россия - Москва" disabled="">
                        <svg class="group-input__input_svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <rect x="6" y="10" width="12" height="8" rx="2" fill="#91969b"></rect>
                            <path d="M9 10V9C9 7.34315 10.3431 6 12 6C13.6569 6 15 7.34315 15 9V10" stroke="#91969b"
                                stroke-width="2"></path>
                        </svg>
                        <div class="tooltip">
                            <span class="tooltip-icon">?</span>
                            <span class="calc-tooltip">
                                <span class="calc-tooltip__title">Южные ворота</span>
                                <span class="calc-tooltip__text">
                                    Доставка осуществляется только до г.Москва "Южные ворота". Доставка до вашего
                                    города
                                    осуществляется с помощью российских транспортных компаний.
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
                <!-- Страховка -->
                <div class="main-calc__from-to_check">
                    <label class="main-calc-checkbox">
                        <input type="checkbox" name="insurance" checked class="main-calc-checkbox__input">
                        <span class="main-calc-checkbox__mark"></span>
                        <span class="main-calc-checkbox__title">Страховать груз</span>
                        <span class="calc-tooltip">
                            <span class="calc-tooltip__title">СТРАХОВКА ГРУЗА</span>
                            <span class="calc-tooltip__text">
                                Если поставить галочку расчет стоимости доставки будет учитывать страховку груза.
                                Стоимость страховки составит 2% от стоимости товара + стоимости доставки.
                            </span>
                        </span>
                    </label>

                </div>
                <!-- Точный адресс -->
                <div class="main-calc__from-to_adress group-input">
                    <div class="group-input__title">Ваш адрес</div>
                    <div class="group-input__input">
                        <input type="text" name="address" class="" placeholder="" disabled>
                        <svg class="group-input__input_svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <rect x="6" y="10" width="12" height="8" rx="2" fill="#91969b"></rect>
                            <path d="M9 10V9C9 7.34315 10.3431 6 12 6C13.6569 6 15 7.34315 15 9V10" stroke="#91969b"
                                stroke-width="2"></path>
                        </svg>
                        <span class="error-message"></span>
                    </div>
                </div>
                <!-- Адресс Включатель -->
                <div class="main-calc__from-to_adress_check">
                    <label class="main-calc-checkbox">
                        <input type="checkbox" name="address_checkbox" class="main-calc-checkbox__input">
                        <span class="main-calc-checkbox__mark"></span>
                        <span class="main-calc-checkbox__title">Указать точный адрес</span>
                    </label>
                </div>
            </div>

            <!-- Выкуп -->
            <div class="client-redeem-data hidden">
                <div class="main-calc-container data-redeem">
                    <h4 class="main-calc__title _small">
                        <span class="main-calc__title_icon"></span>
                        <span class="main-calc__title_text">
                            <span>Данные для выкупа</span>
                            <span class="circle-info">?</span>
                        </span>
                        <span class="calc-tooltip">
                            <span class="calc-tooltip__title">ДАННЫЕ ДЛЯ ВЫКУПА</span>
                            <span class="calc-tooltip__text">
                                Данные для выкупа нужны для наших менеджеров, чтобы сделать детальный просчет.
                                Впишите данные в ручную или прикрепите Excel-файл.
                            </span>
                        </span>

                    </h4>

                    <div class="main-calc-bordered" data-redeem="1">
                        <div class="main-calc-buy__close">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                version="1.1" width="29.5558703725" height="29.5558703725"
                                viewBox="154.70573108694998 97.92453478204999 29.5558703725 29.5558703725"
                                xml:space="preserve">
                                <g transform="matrix(1 0 0 1 169.4836662732 112.7024699683)">
                                    <g style="">
                                        <g transform="matrix(0.5361434886 0 0 0.5361434886 0 0)">
                                            <path class="cross-border"
                                                style="stroke: rgb(179,25,24); stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-dashoffset: 0; stroke-linejoin: miter; stroke-miterlimit: 4; fill-rule: nonzero; opacity: 1;"
                                                transform=" translate(0, 0)"
                                                d="M 0 -27.5634 C 15.21499 -27.5634 27.5634 -15.215000000000002 27.5634 0 C 27.5634 15.21499 15.215000000000002 27.5634 0 27.5634 C -15.21499 27.5634 -27.5634 15.215000000000002 -27.5634 0 C -27.5634 -15.21499 -15.215000000000002 -27.5634 0 -27.5634 z"
                                                stroke-linecap="round"></path>
                                        </g>
                                        <g transform="matrix(0.4501312202 0 0 0.4501312202 0 0)">
                                            <path class="cross-back"
                                                style="stroke: rgb(179,25,24); stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-dashoffset: 0; stroke-linejoin: miter; stroke-miterlimit: 4; fill-rule: nonzero; opacity: 1;"
                                                transform=" translate(0, 0)"
                                                d="M 0 -27.5634 C 15.21499 -27.5634 27.5634 -15.215000000000002 27.5634 0 C 27.5634 15.21499 15.215000000000002 27.5634 0 27.5634 C -15.21499 27.5634 -27.5634 15.215000000000002 -27.5634 0 C -27.5634 -15.21499 -15.215000000000002 -27.5634 0 -27.5634 z"
                                                stroke-linecap="round"></path>
                                        </g>
                                        <g transform="matrix(0.4487730328 0 0 0.4487730328 0 0)">
                                            <path class="cross-path"
                                                style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-dashoffset: 0; stroke-linejoin: miter; stroke-miterlimit: 4; fill-rule: nonzero; opacity: 1;"
                                                transform=" translate(0, 0)"
                                                d="M 14.14294 -14.1405 C 12.58094 -15.702499999999999 10.045939999999998 -15.702499999999999 8.484939999999998 -14.1405 L -0.00006000000000128125 -5.656499999999999 L -8.484060000000001 -14.1395 C -10.04606 -15.7015 -12.580060000000001 -15.7015 -14.14206 -14.1395 C -15.70406 -12.5775 -15.70406 -10.0435 -14.14206 -8.4835 L -5.657060000000001 0.0005000000000006111 L -14.14206 8.4845 C -15.70406 10.0465 -15.70406 12.5805 -14.14206 14.1405 C -12.580060000000001 15.702499999999999 -10.04606 15.702499999999999 -8.48406 14.1405 L -0.000059999999999504894 5.657499999999999 L 8.48394 14.1405 C 10.04594 15.702499999999999 12.57994 15.702499999999999 14.141940000000002 14.1405 C 15.703940000000001 12.5785 15.703940000000001 10.043499999999998 14.141940000000002 8.4845 L 5.656940000000002 0.0005000000000006111 L 14.141940000000002 -8.4835 C 15.703940000000001 -10.0465 15.703940000000001 -12.5795 14.142940000000001 -14.1405 z"
                                                stroke-linecap="round"></path>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </div>

                        <div class="main-calc-buy-info">
                            <div class="main-calc-upload__block">
                                <div class="group-input__title">Изображение товара</div>
                                <div class="main-calc-upload">
                                    <!-- <input type="file" accept="image/*" class="main-calc-upload__input photo-input" style="display: none;"> -->
                                    <div class="main-calc-upload__icon"></div>
                                    <div class="main-calc-upload__plus active">
                                        <button class="active add-redeem-photo" type="button">+</button>
                                    </div>
                                    <div class="main-calc-upload__minus">
                                        <div class="active">-</div>
                                    </div>
                                    <img class="main-calc-upload__item" src="" alt="Выбранное фото">
                                </div>
                            </div>


                            <div class="main-calc-buy-info__form">

                                <!-- Имя -->
                                <div class="group-input">
                                    <div class="group-input__title">Наименование товара</div>
                                    <div class="group-input__input">
                                        <input type="text" name="data-name" class="">
                                        <span class="error-message"></span>
                                    </div>
                                </div>

                                <!-- Цена -->
                                <div class="group-input">
                                    <div class="group-input__title">Цена за единицу</div>
                                    <div class="group-input__input">
                                        <input type="number" name="data_cost" value="" class="" required="">
                                        <span class="error-message"></span>
                                        <div class="currency-select">
                                            <div class="currency-select__selected">
                                                <span class="currency-select__selected_name">¥</span>
                                                <span class="currency-select__selected_icon">
                                                    <svg class="dropdown-list-currency-arrow"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                                                        width="32.38141722065728" height="22.59489123485507"
                                                        viewBox="110.22394056737565 250.64901537709036 32.38141722065728 22.59489123485507"
                                                        xml:space="preserve">
                                                        <desc>Created with Fabric.js 5.3.0</desc>
                                                        <g transform="matrix(0 0.979842546 0.979842546 0 126.4146491777 261.9464609945)"
                                                            id="DLgAgrXuFMXOEYFpJSRZM">
                                                            <path class="svg-arrow active"
                                                                style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-dashoffset: 0; stroke-linejoin: miter; stroke-miterlimit: 4; fill-rule: nonzero; opacity: 1;"
                                                                transform=" translate(0, 0)"
                                                                d="M 8.536 -3.5215 L -3.183 -14.8535 C -3.9269999999999996 -15.5975 -4.931 -16.0135 -5.999 -16.0135 C -7.068 -16.0135 -8.072 -15.5975 -8.827 -14.8415 C -9.583 -14.0855 -9.999 -13.0815 -9.999 -12.0135 C -9.999 -10.945500000000001 -9.583 -9.9405 -8.827 -9.185500000000001 L -0.29100000000000037 -0.6915000000000013 C -0.10300000000000037 -0.5035000000000014 -3.885780586188048e-16 -0.25350000000000134 -3.885780586188048e-16 0.013499999999998624 C -3.885780586188048e-16 0.28049999999999864 -0.10400000000000038 0.5314999999999986 -0.29300000000000037 0.7204999999999986 L -8.824000000000002 9.1815 C -9.583000000000002 9.9415 -9.999000000000002 10.9465 -9.999000000000002 12.0135 C -9.999000000000002 13.0805 -9.583000000000002 14.0855 -8.827000000000002 14.8415 C -8.072000000000001 15.5975 -7.067000000000002 16.0135 -5.999000000000002 16.0135 C -4.931000000000003 16.0135 -3.9260000000000024 15.5975 -3.170000000000002 14.8415 L -1.564000000000002 13.2355 L 8.519999999999998 3.5645000000000007 C 9.478999999999997 2.6055000000000006 9.998999999999999 1.3495000000000008 9.998999999999999 0.013500000000000512 C 9.998999999999999 -1.3224999999999996 9.479 -2.5774999999999997 8.535999999999998 -3.5214999999999996 z"
                                                                stroke-linecap="round"></path>
                                                        </g>
                                                    </svg>
                                                </span>
                                            </div>
                                            <div class="currency-select__list">
                                                <label class="custom-select__label">
                                                    <input class="custom-select__input" type="radio" required=""
                                                        name="data_currency" value="dollar">
                                                    <span class="custom-select__name">$</span>
                                                </label>
                                                <label class="custom-select__label">
                                                    <input class="custom-select__input" type="radio" required=""
                                                        name="data_currency" value="ruble">
                                                    <span class="custom-select__name">₽</span>
                                                </label>
                                                <label class="custom-select__label">
                                                    <input class="custom-select__input" type="radio" required=""
                                                        name="data_currency" checked="" value="yuan">
                                                    <span class="custom-select__name">¥</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Количество -->
                                <div class="group-input">
                                    <div class="group-input__title">Кол-во товаров</div>
                                    <div class="group-input-increment">
                                        <span class="group-input-increment__minus initialized">-</span>
                                        <input type="number" name="data-quantity" value="1" class="" required="">
                                        <span class="group-input-increment__plus initialized">+</span>
                                        <span class="error-message"></span>
                                    </div>
                                </div>

                                <!-- Размер -->
                                <div class="group-input">
                                    <div class="group-input__title">Размер</div>
                                    <div class="group-input__input">
                                        <input type="text" name="data-size" class="">
                                        <span class="error-message"></span>
                                    </div>
                                </div>

                                <!-- Цвет -->
                                <div class="group-input">
                                    <div class="group-input__title">Цвет</div>
                                    <div class="group-input__input">
                                        <input type="text" name="data-color" class="">
                                        <span class="error-message"></span>
                                    </div>
                                </div>

                                <!-- Ссылка -->
                                <div class="group-input">
                                    <div class="group-input__title">Ссылка интернет магазина на товар</div>
                                    <div class="group-input__input">
                                        <input type="text" name="data-url" class="">
                                        <span class="error-message"></span>
                                    </div>
                                </div>

                                <!-- Примечание -->
                                <div class="group-input">
                                    <div class="group-input__title">Примечание</div>
                                    <div class="group-input__input">
                                        <input type="text" name="data-extra" class="">
                                        <span class="error-message"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="data-redeem-buttons">
                    <button class="add-redeem js-add-redeem" type="button">
                        <span class="_plus">+</span>
                        <span class="_text">Добавить товар</span>
                    </button>
                    <button class="main-calc-button upload-excel" type="button">
                        <span class="main-calc-button__upload_icon">
                            <svg width="51" height="51" viewBox="0 0 51 51" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M46.9103 28.2876C44.6517 28.2876 42.8207 30.1187 42.8207 32.3773V42.8207H8.19493V32.3773C8.19493 30.1187 6.36386 28.2876 4.10528 28.2876C1.8467 28.2876 0.015625 30.1187 0.015625 32.3773V46.9104C0.015625 49.169 1.8467 51 4.10528 51H46.9103C49.1689 51 51 49.169 51 46.9104V32.3773C51 30.1187 49.1689 28.2876 46.9103 28.2876Z"
                                    fill="white"></path>
                                <path
                                    d="M16.853 18.5281L21.4182 13.963V29.2004C21.4182 31.459 23.2493 33.29 25.5078 33.29C27.7664 33.29 29.5975 31.459 29.5975 29.2004V13.9629L34.1626 18.528C34.9611 19.3266 36.0077 19.7259 37.0544 19.7259C38.1011 19.7259 39.1476 19.3266 39.9462 18.528C41.5434 16.9309 41.5434 14.3416 39.9462 12.7444L28.3996 1.19796C26.8026 -0.399321 24.213 -0.399321 22.616 1.19796L11.0694 12.7446C9.4723 14.3417 9.4723 16.931 11.0694 18.5281C12.6665 20.1253 15.256 20.1253 16.853 18.5281Z"
                                    fill="white"></path>
                            </svg>
                        </span>
                        <span>Прикрепить Excel</span>
                    </button>
                    <a class="vykup-dile-download" href="file/Dannye-dlya-vykupa-zakaza.xlsx" download>
                        <button class="main-calc-button" type="button">
                            <span class="main-calc-button__upload_icon">
                                <svg width="51" height="51" viewBox="0 0 51 51" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_6504_12668)">
                                        <mask id="mask0_6504_12668" style="mask-type:luminance"
                                            maskUnits="userSpaceOnUse" x="0" y="0" width="51" height="51">
                                            <path d="M51 0H0V51H51V0Z" fill="white"></path>
                                        </mask>
                                        <g mask="url(#mask0_6504_12668)">
                                            <path
                                                d="M46.9103 28.2876C44.6517 28.2876 42.8207 30.1187 42.8207 32.3773V42.8207H8.19493V32.3773C8.19493 30.1187 6.36386 28.2876 4.10528 28.2876C1.8467 28.2876 0.015625 30.1187 0.015625 32.3773V46.9104C0.015625 49.169 1.8467 51 4.10528 51H46.9103C49.1689 51 51 49.169 51 46.9104V32.3773C51 30.1187 49.1689 28.2876 46.9103 28.2876Z"
                                                fill="white"></path>
                                            <path
                                                d="M34.1622 14.7619L29.597 19.327V4.0896C29.597 1.831 27.7659 1.975e-07 25.5074 0C23.2488 -1.974e-07 21.4177 1.831 21.4177 4.0896V19.3271L16.8526 14.762C16.0541 13.9634 15.0075 13.5641 13.9608 13.5641C12.9141 13.5641 11.8676 13.9634 11.069 14.762C9.4718 16.3591 9.4718 18.9484 11.069 20.5456L22.6156 32.0921C24.2126 33.6894 26.8022 33.6894 28.3992 32.0921L39.9458 20.5454C41.5429 18.9483 41.5429 16.359 39.9458 14.7619C38.3487 13.1647 35.7592 13.1647 34.1622 14.7619Z"
                                                fill="white"></path>
                                        </g>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_6504_12668">
                                            <rect width="51" height="51" fill="white"></rect>
                                        </clipPath>
                                    </defs>
                                </svg>
                            </span>
                            <span>Скачать образец Excel</span>
                        </button>
                    </a>
                    <button class="main-calc-button upload-invoice" type="button">
                        <span class="main-calc-button__upload_icon">
                            <svg width="51" height="51" viewBox="0 0 51 51" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M46.9103 28.2876C44.6517 28.2876 42.8207 30.1187 42.8207 32.3773V42.8207H8.19493V32.3773C8.19493 30.1187 6.36386 28.2876 4.10528 28.2876C1.8467 28.2876 0.015625 30.1187 0.015625 32.3773V46.9104C0.015625 49.169 1.8467 51 4.10528 51H46.9103C49.1689 51 51 49.169 51 46.9104V32.3773C51 30.1187 49.1689 28.2876 46.9103 28.2876Z"
                                    fill="white"></path>
                                <path
                                    d="M16.853 18.5281L21.4182 13.963V29.2004C21.4182 31.459 23.2493 33.29 25.5078 33.29C27.7664 33.29 29.5975 31.459 29.5975 29.2004V13.9629L34.1626 18.528C34.9611 19.3266 36.0077 19.7259 37.0544 19.7259C38.1011 19.7259 39.1476 19.3266 39.9462 18.528C41.5434 16.9309 41.5434 14.3416 39.9462 12.7444L28.3996 1.19796C26.8026 -0.399321 24.213 -0.399321 22.616 1.19796L11.0694 12.7446C9.4723 14.3417 9.4723 16.931 11.0694 18.5281C12.6665 20.1253 15.256 20.1253 16.853 18.5281Z"
                                    fill="white"></path>
                            </svg>
                        </span>
                        <span>Прикрепить Инфойс</span>
                    </button>
                </div>
            </div>

            <!-- Данные клиента -->
            <div class="main-calc-container сlient-data hidden">
                <h4 class="main-calc__title _small">
                    <span class="main-calc__title_icon"></span>
                    <span class="main-calc__title_text">Введите ваши данные</span>
                </h4>
                <div class="main-client-requisites-parametr__main">
                    <div class="group-input">
                        <div class="group-input__title">Ваше имя:</div>
                        <div class="group-input__input">
                            <input type="text" class="" name="client-name" placeholder="">
                            <span class="error-message"></span>
                        </div>
                    </div>
                    <div class="group-input">
                        <div class="group-input__title">Контактный телефон:</div>
                        <div class="group-input__input">
                            <input type="text" class="" name="client-phone" placeholder="+7, +86, +996">
                            <span class="error-message"></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Белая -->
            <div class="main-calc-container white-cargo hidden">

                <h4 class="main-calc__title _small">
                    <span class="main-calc__title_icon"></span>
                    <span class="main-calc__title_text">Коды ТН ВЭД</span>
                </h4>
                <!--                     <span class="main-calc__subtitle">Внимание! Могут действовать ограничения на 84, 85 и 90 группу, возможен индивидуальный просчет</span> -->

                <div class="main-calc-bordered white-cargo__block">

                    <div class="group-input tnved-input-block">
                        <div class="group-input__title">Подобрать код по наименованию</div>
                        <div class="group-input__input">
                            <input type="text" name="tnved_input" class="tnved-input" required
                                placeholder="Введите наименование или код для подсказок" />
                            <span class="error-message"></span>
                            <div class="after-tnved">Идет Поиск</div>
                            <div class="suggestion"></div>
                        </div>
                    </div>

                    <div class="overlay"></div>
                    <div class="tnved-tree-container">
                        <div class="tnved-tree-close-button">X</div>
                        <ul class="tnved-tree-list"></ul>
                    </div>

                    <div class="white-cargo__justinfo name-code-container hidden">
                        <!-- Поля для ввода имени и кода -->
                        <div class="group-input">
                            <div class="group-input__title">Имя товара:</div>
                            <div class="group-input__input">
                                <span class="tnved-name-input"></span>
                            </div>
                        </div>
                        <div class="group-input">
                            <div class="group-input__title">Код товара:</div>
                            <div class="group-input__input">
                                <span class="tnved-code-input"></span>
                            </div>
                        </div>

                        <div class="group-input">
                            <div class="group-input__title">Ставка Полшина:</div>
                            <div class="group-input__input">
                                <span class="tnved-code-percent"></span>
                            </div>
                        </div>

                        <div class="group-input">
                            <div class="group-input__title">НДС (по умолчанию):</div>
                            <div class="group-input__input nds-block">
                                <input type="text" name="nds" value="20" class="nds-input" disabled>
                                <svg class="group-input__input_svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect x="6" y="10" width="12" height="8" rx="2" fill="#91969b"></rect>
                                    <path d="M9 10V9C9 7.34315 10.3431 6 12 6C13.6569 6 15 7.34315 15 9V10"
                                        stroke="#91969b" stroke-width="2"></path>
                                </svg>
                                <label class="main-calc-checkbox">
                                    <input type="checkbox" name="custom_nds" class="main-calc-checkbox__input">
                                    <span class="main-calc-checkbox__mark"></span>
                                    <span class="main-calc-checkbox__title">Указать свой НДС</span>
                                </label>
                            </div>
                        </div>
                    </div>


                </div>
            </div>

            <!-- Карго -->
            <div class="main-calc-container grey-cargo">
                <h4 class="main-calc__title _small">
                    <span class="main-calc__title_icon"></span>
                    <span class="main-calc__title_text label-text active">Параметры груза</span>
                </h4>
                <!--Параметры Груза-->
                <div class="main-calc-parametr">
                    <label class="switch-btn">
                        <input type="checkbox" name="weight_volume_change" checked="" class="switch-btn__input"
                            data-changeclass-class="active" data-changeclass-targets="#calc-by-info,#calc-by-custom">
                        <span class="switch-btn__block"></span>
                        <span class="switch-btn__text _first" id="text1">Общий вес и объем</span>
                        <span class="switch-btn__text _second" id="text2">По габаритам</span>
                    </label>
                </div>
                <!-- Калькулятор -->
                <div class="main-calc-bordered hidden active">
                    <div class="main-calc-parametr__main">
                        <!--  Общий вес и Объем  -->
                        <div id="calc-by-info" class="group-input hidden active">
                            <div class="group-input__title">Общий объём</div>
                            <div class="group-input__input">
                                <input type="text" name="total_volume" class="" value="" required="">
                                <span class="group-input__param">м³</span>
                                <span class="error-message"></span>
                                <span class="calculated-data hidden"></span>
                            </div>
                        </div>
                        <!--  По габаритам  -->
                        <div id="calc-by-custom" class="group-input calc-by-custom hidden">
                            <div class="group-input__title">Габариты (Длина * Ширина * Высота) см</div>
                            <div class="group-input__inputs volume">
                                <div class="volume-block">
                                    <input type="text" name="volume_length" placeholder="см" required>
                                    <div class="volume-cross">✖</div>
                                    <input type="text" name="volume_width" placeholder="см" required>
                                    <div class="volume-cross">✖</div>
                                    <input type="text" name="volume_height" placeholder="см" required>
                                    <span class="volume-equals">=</span>
                                    <span class="error-message"></span>
                                </div>

                                <div class="volume-total">
                                    <input type="text" name="total_volume_calculated" class="volume-total__result"
                                        readonly>
                                    <span class="volume-total__m3">м³</span>
                                </div>
                                <span class="calculated-data hidden"></span>

                            </div>
                        </div>

                        <!-- Общий вес -->
                        <div class="group-input">
                            <div class="group-input__title">Общий вес</div>
                            <div class="group-input__input">
                                <input type="text" name="total_weight" class="" value="" required>
                                <span class="group-input__param">кг</span>
                                <span class="error-message"></span>
                                <span class="calculated-data hidden"></span>
                            </div>
                        </div>

                        <!-- Кол-во мест -->
                        <div class="group-input">
                            <div class="group-input__title">Кол-во мест</div>
                            <div class="group-input-increment">
                                <span class="group-input-increment__minus initialized">-</span>
                                <input type="number" name="quantity" value="1" class="" required="">
                                <span class="group-input-increment__plus initialized">+</span>
                                <span class="error-message"></span>
                            </div>
                        </div>

                        <!-- Все места одинаковы по размерам и весу -->
                        <label class="main-calc-checkbox _sameValue hidden js-quantity-checkbox">
                            <input type="checkbox" name="quantity_checkbox" class="main-calc-checkbox__input">
                            <span class="main-calc-checkbox__mark"></span>
                            <span class="main-calc-checkbox__title">Все места одинаковы по размерам и весу</span>
                        </label>

                        <!-- Общая стоимость -->
                        <div class="group-input">
                            <div class="group-input__title">Общая стоимость</div>
                            <div class="group-input__input">
                                <input type="number" name="total_cost" value="" class="" required>
                                <span class="error-message"></span>
                                <div class="currency-select">
                                    <div class="currency-select__selected">
                                        <span class="currency-select__selected_name">¥</span>
                                        <span class="currency-select__selected_icon">
                                            <svg class="dropdown-list-currency-arrow" xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                                                width="32.38141722065728" height="22.59489123485507"
                                                viewBox="110.22394056737565 250.64901537709036 32.38141722065728 22.59489123485507"
                                                xml:space="preserve">
                                                <desc>Created with Fabric.js 5.3.0</desc>
                                                <g transform="matrix(0 0.979842546 0.979842546 0 126.4146491777 261.9464609945)"
                                                    id="DLgAgrXuFMXOEYFpJSRZM">
                                                    <path class="svg-arrow active"
                                                        style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-dashoffset: 0; stroke-linejoin: miter; stroke-miterlimit: 4; fill-rule: nonzero; opacity: 1;"
                                                        transform=" translate(0, 0)"
                                                        d="M 8.536 -3.5215 L -3.183 -14.8535 C -3.9269999999999996 -15.5975 -4.931 -16.0135 -5.999 -16.0135 C -7.068 -16.0135 -8.072 -15.5975 -8.827 -14.8415 C -9.583 -14.0855 -9.999 -13.0815 -9.999 -12.0135 C -9.999 -10.945500000000001 -9.583 -9.9405 -8.827 -9.185500000000001 L -0.29100000000000037 -0.6915000000000013 C -0.10300000000000037 -0.5035000000000014 -3.885780586188048e-16 -0.25350000000000134 -3.885780586188048e-16 0.013499999999998624 C -3.885780586188048e-16 0.28049999999999864 -0.10400000000000038 0.5314999999999986 -0.29300000000000037 0.7204999999999986 L -8.824000000000002 9.1815 C -9.583000000000002 9.9415 -9.999000000000002 10.9465 -9.999000000000002 12.0135 C -9.999000000000002 13.0805 -9.583000000000002 14.0855 -8.827000000000002 14.8415 C -8.072000000000001 15.5975 -7.067000000000002 16.0135 -5.999000000000002 16.0135 C -4.931000000000003 16.0135 -3.9260000000000024 15.5975 -3.170000000000002 14.8415 L -1.564000000000002 13.2355 L 8.519999999999998 3.5645000000000007 C 9.478999999999997 2.6055000000000006 9.998999999999999 1.3495000000000008 9.998999999999999 0.013500000000000512 C 9.998999999999999 -1.3224999999999996 9.479 -2.5774999999999997 8.535999999999998 -3.5214999999999996 z"
                                                        stroke-linecap="round"></path>
                                                </g>
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="currency-select__list">
                                        <label class="custom-select__label">
                                            <input class="custom-select__input" type="radio" required
                                                name="total_currency" value="dollar">
                                            <span class="custom-select__name">$</span>
                                        </label>
                                        <label class="custom-select__label">
                                            <input class="custom-select__input" type="radio" required
                                                name="total_currency" value="ruble">
                                            <span class="custom-select__name">₽</span>
                                        </label>
                                        <label class="custom-select__label">
                                            <input class="custom-select__input" type="radio" required
                                                name="total_currency" checked value="yuan">
                                            <span class="custom-select__name">¥</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Категория груза -->
                        <div class="group-input js-calc-category">
                            <div class="group-input__title">Категория груза</div>
                            <div class="group-input__input">
                                <div class="calc-select">
                                    <div class="calc-select__selected js-error-category">
                                        <span class="calc-select__selected_name">Выберите категорию</span>
                                        <span class="calc-select__selected_icon">
                                            <svg class="dropdown-list-currency-arrow" xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                                                width="32.38141722065728" height="22.59489123485507"
                                                viewBox="110.22394056737565 250.64901537709036 32.38141722065728 22.59489123485507"
                                                xml:space="preserve">
                                                <desc>Created with Fabric.js 5.3.0</desc>
                                                <g transform="matrix(0 0.979842546 0.979842546 0 126.4146491777 261.9464609945)"
                                                    id="DLgAgrXuFMXOEYFpJSRZM">
                                                    <path class="svg-arrow active"
                                                        style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-dashoffset: 0; stroke-linejoin: miter; stroke-miterlimit: 4; fill-rule: nonzero; opacity: 1;"
                                                        transform=" translate(0, 0)"
                                                        d="M 8.536 -3.5215 L -3.183 -14.8535 C -3.9269999999999996 -15.5975 -4.931 -16.0135 -5.999 -16.0135 C -7.068 -16.0135 -8.072 -15.5975 -8.827 -14.8415 C -9.583 -14.0855 -9.999 -13.0815 -9.999 -12.0135 C -9.999 -10.945500000000001 -9.583 -9.9405 -8.827 -9.185500000000001 L -0.29100000000000037 -0.6915000000000013 C -0.10300000000000037 -0.5035000000000014 -3.885780586188048e-16 -0.25350000000000134 -3.885780586188048e-16 0.013499999999998624 C -3.885780586188048e-16 0.28049999999999864 -0.10400000000000038 0.5314999999999986 -0.29300000000000037 0.7204999999999986 L -8.824000000000002 9.1815 C -9.583000000000002 9.9415 -9.999000000000002 10.9465 -9.999000000000002 12.0135 C -9.999000000000002 13.0805 -9.583000000000002 14.0855 -8.827000000000002 14.8415 C -8.072000000000001 15.5975 -7.067000000000002 16.0135 -5.999000000000002 16.0135 C -4.931000000000003 16.0135 -3.9260000000000024 15.5975 -3.170000000000002 14.8415 L -1.564000000000002 13.2355 L 8.519999999999998 3.5645000000000007 C 9.478999999999997 2.6055000000000006 9.998999999999999 1.3495000000000008 9.998999999999999 0.013500000000000512 C 9.998999999999999 -1.3224999999999996 9.479 -2.5774999999999997 8.535999999999998 -3.5214999999999996 z"
                                                        stroke-linecap="round"></path>
                                                </g>
                                            </svg>
                                        </span>
                                        <span class="error-message-category"></span>
                                    </div>
                                    <div class="calc-select__options">
                                        <label class="calc-select__label">
                                            <input type="radio" name="category" value="clothes"
                                                class="calc-select__input">
                                            <span class="calc-select__name">Одежда</span>
                                            <span class="tooltip">
                                                <span class="tooltip-icon">?</span>
                                                <span class="calc-tooltip">
                                                    <span class="calc-tooltip__title">Одежда</span>
                                                    <span class="calc-tooltip__text">Все виды одежды, включая
                                                        верхнюю
                                                        (куртки, пальто), повседневную (футболки, рубашки), деловую
                                                        (костюмы, пиджаки), вечернюю (платья, костюмы), спортивную
                                                        (шорты, спортивные костюмы), нижнее белье, аксессуары для
                                                        одежды.</span>
                                                </span>
                                            </span>
                                        </label>
                                        <label class="calc-select__label">
                                            <input type="radio" name="category" value="shoes"
                                                class="calc-select__input">
                                            <span class="calc-select__name">Обувь</span>
                                            <span class="tooltip">
                                                <span class="tooltip-icon">?</span>
                                                <span class="calc-tooltip">
                                                    <span class="calc-tooltip__title">Обувь</span>
                                                    <span class="calc-tooltip__text">Все виды обуви для взрослых и
                                                        детей, включая спортивную обувь (кроссовки), повседневную
                                                        обувь
                                                        (туфли, мокасины), сезонную (сапоги, босоножки), домашнюю
                                                        (тапочки), специальные виды обуви (резиновые сапоги, рабочая
                                                        обувь).</span>
                                                </span>
                                            </span>
                                        </label>
                                        <label class="calc-select__label">
                                            <input type="radio" name="category" value="products"
                                                class="calc-select__input">
                                            <span class="calc-select__name">Продукты</span>
                                            <span class="tooltip">
                                                <span class="tooltip-icon">?</span>
                                                <span class="calc-tooltip">
                                                    <span class="calc-tooltip__title">Продукты</span>
                                                    <span class="calc-tooltip__text">Все виды продовольствия,
                                                        включая
                                                        упаковочные и консервированные продукты, напитки (вода,
                                                        соки,
                                                        алкоголь), бакалею (крупы, макароны), молочные изделия (сыр,
                                                        йогурт), готовую еду, специи, сладости, орехи, снеки.</span>
                                                </span>
                                            </span>
                                        </label>
                                        <label class="calc-select__label">
                                            <input type="radio" name="category" value="consumer_electronics"
                                                class="calc-select__input">
                                            <span class="calc-select__name">Бытовая техника и электроника</span>
                                            <span class="tooltip">
                                                <span class="tooltip-icon">?</span>
                                                <span class="calc-tooltip">
                                                    <span class="calc-tooltip__title">Бытовая техника и
                                                        электроника</span>
                                                    <span class="calc-tooltip__text">Крупная техника: Телевизоры,
                                                        холодильники, морозильники, стиральные машины, кондиционеры,
                                                        водонагреватели.
                                                        <br> Мелкая техника: Электробритвы, пылесосы, утюги,
                                                        микроволновки, духовки, фены, устройства для ухода
                                                        (электрозубные щетки, массажеры).
                                                        <br> Электроника: Принтеры, игровые контроллеры, зарядные
                                                        устройства, камеры наблюдения, кабели, устройства для ПК
                                                        (мыши,
                                                        клавиатуры).
                                                        <br> Инструменты: Электроинструменты, аксессуары для
                                                        автомобилей
                                                        (зарядные устройства).</span>
                                                </span>
                                            </span>
                                        </label>
                                        <label class="calc-select__label">
                                            <input class="calc-select__input" type="radio" name="category"
                                                value="household_goods">
                                            <span class="calc-select__name">Аксессуары и уход</span>
                                            <span class="tooltip">
                                                <span class="tooltip-icon">?</span>
                                                <span class="calc-tooltip">
                                                    <span class="calc-tooltip__title">Аксессуары и уход</span>
                                                    <span class="calc-tooltip__text">Личные вещи: Сумки, косметика,
                                                        парфюмерия, средства для макияжа, головные уборы.
                                                        <br>Дом: Постельные принадлежности, полотенца, одеяла.
                                                        <br>Автомобили: Автозапчасти, аксессуары для машин.
                                                        <br>Скобяные изделия: Замки, садовый инвентарь.
                                                        <br>Игрушки: Для детей, домашних животных.
                                                        <br>Аксессуары для дома и кухни: Гладильные доски, ткани,
                                                        кнопки, подставки для ног.</span>
                                                </span>
                                            </span>
                                        </label>
                                        <label class="calc-select__label">
                                            <input class="calc-select__input" type="radio" name="category"
                                                value="household_products">
                                            <span class="calc-select__name">Домашний и спортивный инвентарь</span>
                                            <span class="tooltip">
                                                <span class="tooltip-icon">?</span>
                                                <span class="calc-tooltip">
                                                    <span class="calc-tooltip__title">Домашний и спортивный
                                                        инвентарь</span>
                                                    <span class="calc-tooltip__text">Дом: Лампы, мебель, посуда,
                                                        текстиль (скатерти, полотенца).
                                                        <br>Ванная: Швабры, крючки, принадлежности для уборки.
                                                        <br>Игрушки: Электровелосипеды, куклы, детские наборы.
                                                        <br>Стройматериалы: Сетки, уголки, аксессуары для ремонта.
                                                        <br>Спорт: Товары для фитнеса, йоги, защитное снаряжение.
                                                        <br>Декор: Часы, картины, обои, вазы.</span>
                                                </span>
                                            </span>
                                        </label>
                                        <label class="calc-select__label">
                                            <input class="calc-select__input" type="radio" name="category"
                                                value="accessory">
                                            <span class="calc-select__name">Мелочевка и бытовые мелочи</span>
                                            <span class="tooltip">
                                                <span class="tooltip-icon">?</span>
                                                <span class="calc-tooltip">
                                                    <span class="calc-tooltip__title">Мелочевка и бытовые
                                                        мелочи</span>
                                                    <span class="calc-tooltip__text">Личные аксессуары: Ремни,
                                                        украшения.
                                                        <br>Быт: Крючки-наклейки, перчатки, силиконовые щетки,
                                                        расходные
                                                        материалы для техники.
                                                        <br>Особые товары: Товары 18+.</span>
                                                </span>
                                            </span>
                                        </label>
                                    </div>
                                    <div class="overflow-tooltip">
                                        <span class="calc-tooltip">
                                            <span class="calc-tooltip__title"></span>
                                            <span class="calc-tooltip__text"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Бренд -->
                        <label class="main-calc-checkbox main-calc-checkbox__form js-calc-brand">
                            <input type="checkbox" name="brand" class="main-calc-checkbox__input">
                            <span class="main-calc-checkbox__mark"></span>
                            <span class="main-calc-checkbox__title">Бренд</span>
                            <span class="calc-tooltip">
                                <span class="calc-tooltip__text">
                                    Любые товары известных брендов
                                </span>
                            </span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Упаковка -->
            <div class="main-calc-packing">
                <div class="main-calc-packing__header js-add-class-packing">
                    <span class="main-calc-packing__header_title">Упаковка (дополнительная услуга)</span>
                    <span class="main-calc-packing__header_btn">
                        <span class="main-calc-packing__header_text">Выбрать Упаковку</span>
                        <svg class="main-calc-packing__header_icon" width="23" height="23"
                            xmlns="http://www.w3.org/2000/svg">
                            <path class="triangle-arrow active"
                                d="M9 20 A4 4, 0, 0, 0, 14 20 L20 8.74 A4 4, 0, 0, 0, 16 2.74 H6 A4 4, 0, 0, 0, 2 8.74 Z"
                                stroke="none"></path>
                        </svg>
                    </span>
                </div>
                <div class="main-calc-packing__content">
                    <label class="main-calc-packing__item">
                        <input type="radio" name="packing-type" value="std_pack" checked
                            class="main-calc-packing__item_radio">
                        <span class="main-calc-packing__item_icon">
                            <svg width="27" height="25" viewBox="0 0 27 25" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 15 l3 3 l10 -10" stroke="white" stroke-width="4" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </span>
                        <img class="main-calc-packing__item_img" src="/calc-new/img/scotch.png" alt="">
                        <span class="main-calc-packing__item_title">Стандартная упаковка <br> (2$ за место) </span>
                    </label>
                    <label class="main-calc-packing__item">
                        <input type="radio" name="packing-type" value="pack_corner"
                            class="main-calc-packing__item_radio">
                        <span class="main-calc-packing__item_icon">
                            <svg width="27" height="25" viewBox="0 0 27 25" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 15 l3 3 l10 -10" stroke="white" stroke-width="4" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </span>
                        <img class="main-calc-packing__item_img" src="/calc-new/img/pallet.png" alt="">
                        <span class="main-calc-packing__item_title">Упаковка с углами <br> (4$ за место)</span>
                    </label>
                    <label class="main-calc-packing__item">
                        <input type="radio" name="packing-type" value="wood_crate"
                            class="main-calc-packing__item_radio">
                        <span class="main-calc-packing__item_icon">
                            <svg width="27" height="25" viewBox="0 0 27 25" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 15 l3 3 l10 -10" stroke="white" stroke-width="4" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </span>
                        <img class="main-calc-packing__item_img" src="/calc-new/img/corners-of-strength.png" alt="">
                        <span class="main-calc-packing__item_title">Деревянная обрешетка <br> (30$/1м3)</span>
                    </label>
                    <label class="main-calc-packing__item">
                        <input type="radio" name="packing-type" value="tri_frame" class="main-calc-packing__item_radio">
                        <span class="main-calc-packing__item_icon">
                            <svg width="27" height="25" viewBox="0 0 27 25" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 15 l3 3 l10 -10" stroke="white" stroke-width="4" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </span>
                        <img class="main-calc-packing__item_img" src="/calc-new/img/wooden-sheathing.png" alt="">
                        <span class="main-calc-packing__item_title">Треугольная деревянная рама <br>
                            (35$/1м3)</span>
                    </label>
                    <label class="main-calc-packing__item">
                        <input type="radio" name="packing-type" value="wood_pallet"
                            class="main-calc-packing__item_radio">
                        <span class="main-calc-packing__item_icon">
                            <svg width="27" height="25" viewBox="0 0 27 25" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 15 l3 3 l10 -10" stroke="white" stroke-width="4" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </span>
                        <img class="main-calc-packing__item_img" src="/calc-new/img/wood_pallet.png" alt="">
                        <span class="main-calc-packing__item_title">Деревянный поддон <br> (4$/1шт)</span>
                    </label>
                    <label class="main-calc-packing__item">
                        <input type="radio" name="packing-type" value="pallet_water"
                            class="main-calc-packing__item_radio">
                        <span class="main-calc-packing__item_icon">
                            <svg width="27" height="25" viewBox="0 0 27 25" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 15 l3 3 l10 -10" stroke="white" stroke-width="4" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </span>
                        <img class="main-calc-packing__item_img" src="/calc-new/img/pallet_water.png" alt="">
                        <span class="main-calc-packing__item_title">Поддон с водонепроницаемой упаковкой <br>
                            (7,5$/1м3)</span>
                    </label>
                    <label class="main-calc-packing__item">
                        <input type="radio" name="packing-type" value="wood_boxes"
                            class="main-calc-packing__item_radio">
                        <span class="main-calc-packing__item_icon">
                            <svg width="27" height="25" viewBox="0 0 27 25" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 15 l3 3 l10 -10" stroke="white" stroke-width="4" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </span>
                        <img class="main-calc-packing__item_img" src="/calc-new/img/wood_boxes.png" alt="">
                        <span class="main-calc-packing__item_title">Деревянные коробки <br> (48$/1м3)</span>
                    </label>
                    <div class="main-calc-packing__item">
                        <input type="radio" name="packing-type" value="wood_boxes"
                            class="main-calc-packing__item_radio">
                        <span class="main-calc-packing__item_icon">
                            <svg width="27" height="25" viewBox="0 0 27 25" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 15 l3 3 l10 -10" stroke="white" stroke-width="4" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </span>
                        <img class="main-calc-packing__item_img" src="/calc-new/img/fumi.png" alt="">
                        <span class="main-calc-packing__item_title">Фумигация груза <br> (уточнять
                            индивидуально)</span>
                    </div>
                    <div class="main-calc-packing__info">* Доп. упаковка увеличит вес вашего груза</div>
                </div>
            </div>

            <!-- Кнопка РАСЧИТАТЬ -->
            <div class="main-calc-parametr__main_btn">
                <button class="main-calc-button js-calculate-result" type="button"
                    data-scroll-to="js-calc-table">РАСЧИТАТЬ ОНЛАЙН</button>
            </div>

            <!-- Результат -->
            <div class="main-calc-result">
                <h4 class="main-calc__title _small label-text active">
                    <span class="main-calc__title_icon"></span>
                    <span class="main-calc__title_text label-text active">Расценки по видам доставки</span>
                </h4>
                <div class="main-calc__subtitle">
                    Стоимость доставки на сборный груз от 5т рассчитываем индивидуально, через менеджера, от
                    0.25$/кг
                    <!-- <button data-scroll-to="request">Оставить заявку</button> -->
                </div>

                <div class="main-calc-result__subtitle">Выберите удобный вам способ доставки:</div>

                <div class="main-calc-result__block">

                    <!-- Валита и Карго -->
                    <div class="main-calc-result__column">
                        <div class="main-calc-result__cell main-calc-result__currency">
                            <div class="main-calc-result__currency_item">
                                <span class="main-calc-result__currency_sign">$</span>
                                <input name="current_rate_ruble" type="text" readonly
                                    class="main-calc-result__currency_num js-currency-dollar">
                            </div>
                            <div class="main-calc-result__currency_item">
                                <span class="main-calc-result__currency_sign">¥</span>
                                <input name="current_rate_yuan" type="text" readonly
                                    class="main-calc-result__currency_num js-currency-yuan">
                            </div>
                            <div class="tooltip main-calc-result__currency_tooltip">
                                <span class="tooltip-icon">?</span>
                                <span class="calc-tooltip">
                                    <span class="calc-tooltip__text">
                                        <a href="#">Почему у нас такой курс юаня?</a>
                                        <span class="rate-info hidden">Курс ЦБ России</span>
                                    </span>
                                </span>
                            </div>
                        </div>

                        <div class="main-calc-result__cell cargo-cell">
                            <div class="cargo-cell__title">Карго</div>
                            <div class="tooltip">
                                <span class="tooltip-icon">?</span>
                                <span class="calc-tooltip">
                                    <span class="calc-tooltip__title">КАРГО ДОСТАВКА</span>
                                    <span class="calc-tooltip__text">
                                        Процесс транспортировки грузов с использованием различных средств
                                        транспорта - грузовиков, поездов, самолетов или кораблей. Этот процесс
                                        включает в себя все этапы от планирования маршрута и упаковки
                                        груза до его доставки конечному получателю и разгрузки.
                                        <br><br>
                                        <span class="text-orange">Доставка осуществляется только до г.Москва "Южные
                                            ворота". Доставка до вашего города осуществляется с помощью российских
                                            транспортных компаний.</span>
                                    </span>
                                </span>
                            </div>
                        </div>

                        <div class="main-calc-result__cell cargo-cell to-address">
                            <div class="cargo-cell__title">Карго + ТК ЖДЭ <span class="cargo-cell__title_span">(по
                                    указанному вами адресу)</span> </div>
                            <div class="tooltip">
                                <span class="tooltip-icon">?</span>
                                <span class="calc-tooltip">
                                    <span class="calc-tooltip__title">ЖэлДорЭкспедиция</span>
                                    <span class="calc-tooltip__text">
                                        Транспортная компания ЖелДорЭкспедиция осуществляет грузоперевозки по России
                                        из
                                        Москвы. Доставка грузов жд, авиа и автотранспортном. Филиалы в 294 городах.
                                        <br><br>
                                        <span class="text-orange">Расчет доставки включает в себя услуги компании
                                            Saide
                                            (до России) + доставка данной транспортной компанией до города
                                            назначения</span>
                                    </span>
                                </span>
                            </div>
                        </div>

                        <div class="main-calc-result__cell cargo-cell to-address">
                            <div class="cargo-cell__title">Карго + ТК KIT <span class="cargo-cell__title_span">(по
                                    указанному вами адресу)</span> </div>
                            <div class="tooltip">
                                <span class="tooltip-icon">?</span>
                                <span class="calc-tooltip">
                                    <span class="calc-tooltip__title">КИТ</span>
                                    <span class="calc-tooltip__text">
                                        Транспортная компания "КИТ" специализируется на перевозке сборных грузов и
                                        посылок по России и странам
                                        СНГ. Доставка осуществляется различными видами транспорта: автомобильным,
                                        железнодорожным и
                                        авиационным. Предлагает широкий спектр логистических услуг, включая
                                        складскую
                                        обработку, страхование грузов
                                        и предоставление индивидуальных решений для клиентов в области транспортной
                                        логистики.
                                        <br><br>
                                        <span class="text-orange">Расчет доставки включает в себя услуги компании
                                            Saide
                                            (до России) + доставка данной транспортной компанией до города
                                            назначения</span>
                                    </span>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Авто -->
                    <div class="main-calc-result__column result_auto">
                        <div class="main-calc-result__cell">
                            <div class="delivery-item__header">
                                <div class="delivery-item__icon">
                                    <svg width="65" height="38" viewBox="0 0 65 38" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_2362_2956)">
                                            <path class="svg-stroke active"
                                                d="M40.9988 25.9968L44.5584 4.45335C44.856 2.65685 43.4701 1.02075 41.6466 1.02075H7.5185L5.42773 14.4292"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            </path>
                                            <path class="svg-stroke active" d="M10.6434 31.4883L7.51855 31.4912"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            </path>
                                            <path class="svg-stroke active" d="M45.6234 31.4768L21.999 31.4856"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            </path>
                                            <path class="svg-stroke active"
                                                d="M45.0693 6.22949H55.4037C57.204 6.22949 58.8437 7.2619 59.6198 8.88341L63.3282 16.6352C63.7571 17.5335 63.9817 18.5192 63.9817 19.5137V27.2946C63.9817 29.5986 62.1144 31.468 59.8065 31.468H56.6263"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            </path>
                                            <path class="svg-stroke active"
                                                d="M54.9456 10.4407H47.4238V19.9365H57.5044C58.4964 19.9365 59.1704 18.9332 58.7969 18.0146L55.9901 11.1435C55.818 10.7177 55.4037 10.4407 54.9456 10.4407Z"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            </path>
                                            <path class="svg-stroke active"
                                                d="M51.3513 36.7729C54.2695 36.7729 56.6352 34.4083 56.6352 31.4913C56.6352 28.5744 54.2695 26.2097 51.3513 26.2097C48.4331 26.2097 46.0674 28.5744 46.0674 31.4913C46.0674 34.4083 48.4331 36.7729 51.3513 36.7729Z"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            </path>
                                            <path class="svg-stroke active"
                                                d="M16.613 36.7729C19.5312 36.7729 21.8969 34.4083 21.8969 31.4913C21.8969 28.5744 19.5312 26.2097 16.613 26.2097C13.6948 26.2097 11.3291 28.5744 11.3291 31.4913C11.3291 34.4083 13.6948 36.7729 16.613 36.7729Z"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            </path>
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_2362_2956">
                                                <rect width="65" height="37.7907" fill="white"></rect>
                                            </clipPath>
                                        </defs>
                                    </svg>
                                    <span class="delivery-item-label active">Авто</span>
                                </div>
                                <span class="delivery-item-label delivery-item__time active">15-20 дней</span>
                            </div>
                        </div>

                        <div class="main-calc-result__cell price-cell">
                            <label class="main-calc-result__price">
                                <input class="main-calc-result__price_input" type="radio" name="all-price" value="auto">
                                <div class="main-calc-result__price_block price-auto">
                                    <div class="main-calc-result__all_cell">
                                        <span class="main-calc-result__all_title calculate-result__title_tarif">За
                                            КГ:
                                        </span>
                                        <div>
                                            <div>
                                                <span class="calculate-result__kg"></span>
                                                <span class="main-calc-result__currency_sign">$</span>
                                            </div>
                                            <span>-</span>
                                            <div>
                                                <span class="calculate-result__kg_ruble"></span>
                                                <span class="main-calc-result__currency_sign">₽</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="main-calc-result__all_cell main-calc-result__all_cell_end">
                                        <span class="main-calc-result__all_title_end">Сумма:</span>
                                        <div class="main-calc-result__all_cell_end_block">
                                            <div>
                                                <span class="calculate-result__dollar"></span>
                                                <span class="main-calc-result__currency_sign">$</span>
                                            </div>
                                            <div>
                                                <span class="calculate-result__ruble"></span>
                                                <span class="main-calc-result__currency_sign">₽</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </label>

                            <div class="overflow-info">
                                <div class="main-calc-result-tooltip">
                                    <div class="main-calc-result-tooltip__title"></div>
                                    <div class="main-calc-result-tooltip__subtitle">(примерная стоимость)</div>
                                    <!-- <div class="main-calc-result-tooltip__subtitle">Перевозка из Китая</div> -->
                                    <div class="main-calc-result-tooltip__row">
                                        <div class="main-calc-result-tooltip__cell">Курс:</div>
                                        <div class="main-calc-result-tooltip__cell">
                                            <span>$: </span> <span class="_number _ruble"></span>
                                            <span>¥: </span> <span class="_number _yuan"></span>
                                        </div>
                                    </div>
                                    <div class="main-calc-result-tooltip__row">
                                        <div class="main-calc-result-tooltip__cell">Упаковка:</div>
                                        <div class="main-calc-result-tooltip__cell _text">
                                            <span class="_packing"></span>
                                        </div>
                                    </div>
                                    <div class="main-calc-result-tooltip__row">
                                        <div class="main-calc-result-tooltip__cell">За упаковку:</div>
                                        <div class="main-calc-result-tooltip__cell _text">
                                            <span class="_pack-dollar"></span>
                                            <span class="_pack-ruble"></span>
                                        </div>
                                    </div>
                                    <div class="main-calc-result-tooltip__row _insurance-tooltip">
                                        <div class="main-calc-result-tooltip__cell">Страховка:</div>
                                        <div class="main-calc-result-tooltip__cell _text">
                                            <span class="_insurance-dollar"></span>
                                            <span class="_insurance-ruble"></span>
                                            <span class="_insurance-from">(от $)</span>
                                        </div>
                                    </div>
                                    <div class="main-calc-result-tooltip__row">
                                        <div class="main-calc-result-tooltip__cell">За кг:</div>
                                        <div class="main-calc-result-tooltip__cell _text">
                                            <span class="_kg-dollar"></span>
                                            <span class="_kg-ruble"></span>
                                        </div>
                                    </div>
                                    <div class="main-calc-result-tooltip__row">
                                        <div class="main-calc-result-tooltip__cell">Итого:</div>
                                        <div class="main-calc-result-tooltip__cell _text">
                                            <span class="_all-cargo-dollar"></span>
                                            <span class="_all-cargo-ruble"></span>
                                        </div>
                                    </div>
                                    <div class="main-calc-result-tooltip__white">
                                        <div class="main-calc-result-tooltip__subtitle">Таможенные расходы в РФ <br>
                                            под
                                            ваш контракт</div>
                                        <div class="main-calc-result-tooltip__row">
                                            <div class="main-calc-result-tooltip__cell">Пошлина:</div>
                                            <div class="main-calc-result-tooltip__cell _text">
                                                <span class="_chosen-imp"></span>
                                                <span class="_chosen-imp-dollar"></span>
                                                <span class="_chosen-imp-ruble"></span>
                                            </div>
                                        </div>
                                        <div class="main-calc-result-tooltip__row">
                                            <div class="main-calc-result-tooltip__cell">НДС:</div>
                                            <div class="main-calc-result-tooltip__cell _text">
                                                <span class="_nds"></span>
                                                <span class="_nds-dollar"></span>
                                                <span class="_nds-ruble"></span>
                                            </div>
                                        </div>
                                        <!-- <div class="main-calc-result-tooltip__row">
                                            <div class="main-calc-result-tooltip__cell">Услуги декларации:</div>
                                            <div class="main-calc-result-tooltip__cell _text">
                                                <span class="_decloration-dollar"></span>
                                                <span class="_decloration-ruble"></span>
                                            </div>
                                        </div> -->
                                        <div class="main-calc-result-tooltip__row">
                                            <div class="main-calc-result-tooltip__cell">Итого:</div>
                                            <div class="main-calc-result-tooltip__cell _text">
                                                <span class="_all-white-dollar"></span>
                                                <span class="_all-white-ruble"></span>
                                            </div>
                                        </div>
                                        <div class="main-calc-result-tooltip__subtitle">Перевозка + Таможенные
                                            расходы
                                        </div>
                                        <div class="main-calc-result-tooltip__row">
                                            <div class="main-calc-result-tooltip__cell">Итого:</div>
                                            <div class="main-calc-result-tooltip__cell _text">
                                                <span class="_all-calculated-price-dollar"></span>
                                                <span class="_all-calculated-price-ruble"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="main-calc-result-tooltip__info">* Доп. упаковка увеличит вес вашего
                                        груза</div>
                                </div>
                            </div>
                        </div>

                        <div class="main-calc-result__cell price-cell to-address jde _load">
                            <div class="loader _load"></div>
                            <label class="main-calc-result__price">
                                <input class="main-calc-result__price_input" type="radio" name="all-price"
                                    value="jde-auto">
                                <div class="main-calc-result__price_block price-auto">
                                    <div class="main-calc-result__all_cell">
                                        <span class="main-calc-result__all_title calculate-result__title_tarif">За
                                            КГ:
                                        </span>
                                        <div>
                                            <div>
                                                <span class="calculate-result__kg"></span>
                                                <span class="main-calc-result__currency_sign">$</span>
                                            </div>
                                            <span>-</span>
                                            <div>
                                                <span class="calculate-result__kg_ruble"></span>
                                                <span class="main-calc-result__currency_sign">₽</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="main-calc-result__all_cell main-calc-result__all_cell_end">
                                        <span class="main-calc-result__all_title_end">Сумма:</span>
                                        <div class="main-calc-result__all_cell_end_block">
                                            <div>
                                                <span class="calculate-result__dollar"></span>
                                                <span class="main-calc-result__currency_sign">$</span>
                                            </div>
                                            <div>
                                                <span class="calculate-result__ruble"></span>
                                                <span class="main-calc-result__currency_sign">₽</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </label>

                            <div class="overflow-info">
                                <div class="main-calc-result-tooltip">
                                    <div class="main-calc-result-tooltip__title"></div>
                                    <div class="main-calc-result-tooltip__subtitle">(примерная стоимость)</div>
                                    <!-- <div class="main-calc-result-tooltip__subtitle">Перевозка из Китая</div> -->
                                    <div class="main-calc-result-tooltip__row">
                                        <div class="main-calc-result-tooltip__cell">Курс:</div>
                                        <div class="main-calc-result-tooltip__cell">
                                            <span>$: </span> <span class="_number _ruble"></span>
                                            <span>¥: </span> <span class="_number _yuan"></span>
                                        </div>
                                    </div>
                                    <div class="main-calc-result-tooltip__row">
                                        <div class="main-calc-result-tooltip__cell">Упаковка:</div>
                                        <div class="main-calc-result-tooltip__cell _text">
                                            <span class="_packing"></span>
                                        </div>
                                    </div>
                                    <div class="main-calc-result-tooltip__row">
                                        <div class="main-calc-result-tooltip__cell">За упаковку:</div>
                                        <div class="main-calc-result-tooltip__cell _text">
                                            <span class="_pack-dollar"></span>
                                            <span class="_pack-ruble"></span>
                                        </div>
                                    </div>
                                    <div class="main-calc-result-tooltip__row _insurance-tooltip">
                                        <div class="main-calc-result-tooltip__cell">Страховка:</div>
                                        <div class="main-calc-result-tooltip__cell _text">
                                            <span class="_insurance-dollar"></span>
                                            <span class="_insurance-ruble"></span>
                                            <span class="_insurance-from">(от $)</span>
                                        </div>
                                    </div>
                                    <div class="main-calc-result-tooltip__row">
                                        <div class="main-calc-result-tooltip__cell">За кг:</div>
                                        <div class="main-calc-result-tooltip__cell _text">
                                            <span class="_kg-dollar"></span>
                                            <span class="_kg-ruble"></span>
                                        </div>
                                    </div>
                                    <div class="main-calc-result-tooltip__row">
                                        <div class="main-calc-result-tooltip__cell">Итого:</div>
                                        <div class="main-calc-result-tooltip__cell _text">
                                            <span class="_all-cargo-dollar"></span>
                                            <span class="_all-cargo-ruble"></span>
                                        </div>
                                    </div>
                                    <div class="main-calc-result-tooltip__white">
                                        <div class="main-calc-result-tooltip__subtitle">Таможенные расходы в РФ <br>
                                            под
                                            ваш контракт</div>
                                        <div class="main-calc-result-tooltip__row">
                                            <div class="main-calc-result-tooltip__cell">Пошлина:</div>
                                            <div class="main-calc-result-tooltip__cell _text">
                                                <span class="_chosen-imp"></span>
                                                <span class="_chosen-imp-dollar"></span>
                                                <span class="_chosen-imp-ruble"></span>
                                            </div>
                                        </div>
                                        <div class="main-calc-result-tooltip__row">
                                            <div class="main-calc-result-tooltip__cell">НДС:</div>
                                            <div class="main-calc-result-tooltip__cell _text">
                                                <span class="_nds"></span>
                                                <span class="_nds-dollar"></span>
                                                <span class="_nds-ruble"></span>
                                            </div>
                                        </div>
                                        <!-- <div class="main-calc-result-tooltip__row">
                                            <div class="main-calc-result-tooltip__cell">Услуги декларации:</div>
                                            <div class="main-calc-result-tooltip__cell _text">
                                                <span class="_decloration-dollar"></span>
                                                <span class="_decloration-ruble"></span>
                                            </div>
                                        </div> -->
                                        <div class="main-calc-result-tooltip__row">
                                            <div class="main-calc-result-tooltip__cell">Итого:</div>
                                            <div class="main-calc-result-tooltip__cell _text">
                                                <span class="_all-white-dollar"></span>
                                                <span class="_all-white-ruble"></span>
                                            </div>
                                        </div>
                                        <div class="main-calc-result-tooltip__subtitle">Перевозка + Таможенные
                                            расходы
                                        </div>
                                        <div class="main-calc-result-tooltip__row">
                                            <div class="main-calc-result-tooltip__cell">Итого:</div>
                                            <div class="main-calc-result-tooltip__cell _text">
                                                <span class="_all-calculated-price-dollar"></span>
                                                <span class="_all-calculated-price-ruble"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="main-calc-result-tooltip__country">
                                        <div class="main-calc-result-tooltip__subtitle">Перевозка по России <br> до
                                            указанного адреса</div>
                                        <div class="main-calc-result-tooltip__row">
                                            <div class="main-calc-result-tooltip__cell">За кг:</div>
                                            <div class="main-calc-result-tooltip__cell _text">
                                                <span class="_jde_dollar"></span>
                                                <span class="_jde_ruble"></span>
                                            </div>
                                        </div>
                                        <div class="main-calc-result-tooltip__row">
                                            <div class="main-calc-result-tooltip__cell">Итого:</div>
                                            <div class="main-calc-result-tooltip__cell _text">
                                                <span class="_jde_all_dollar"></span>
                                                <span class="_jde_all_ruble"></span>
                                            </div>
                                        </div>
                                        <div class="main-calc-result-tooltip__subtitle">Итого за всё</div>
                                        <div class="main-calc-result-tooltip__row">
                                            <div class="main-calc-result-tooltip__cell">Итого:</div>
                                            <div class="main-calc-result-tooltip__cell _text">
                                                <span class="_everything_price_dollar"></span>
                                                <span class="_everything_price_ruble"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="main-calc-result-tooltip__info">* Доп. упаковка увеличит вес вашего
                                        груза</div>
                                </div>
                            </div>
                        </div>

                        <div class="main-calc-result__cell price-cell to-address kit _load">
                            <div class="loader _load"></div>
                            <label class="main-calc-result__price">
                                <input class="main-calc-result__price_input" type="radio" name="all-price"
                                    value="kit-auto">
                                <div class="main-calc-result__price_block price-auto">
                                    <div class="main-calc-result__all_cell">
                                        <span class="main-calc-result__all_title calculate-result__title_tarif">За
                                            КГ:
                                        </span>
                                        <div>
                                            <div>
                                                <span class="calculate-result__kg"></span>
                                                <span class="main-calc-result__currency_sign">$</span>
                                            </div>
                                            <span>-</span>
                                            <div>
                                                <span class="calculate-result__kg_ruble"></span>
                                                <span class="main-calc-result__currency_sign">₽</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="main-calc-result__all_cell main-calc-result__all_cell_end">
                                        <span class="main-calc-result__all_title_end">Сумма:</span>
                                        <div class="main-calc-result__all_cell_end_block">
                                            <div>
                                                <span class="calculate-result__dollar"></span>
                                                <span class="main-calc-result__currency_sign">$</span>
                                            </div>
                                            <div>
                                                <span class="calculate-result__ruble"></span>
                                                <span class="main-calc-result__currency_sign">₽</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </label>

                            <div class="overflow-info">
                                <div class="main-calc-result-tooltip">
                                    <div class="main-calc-result-tooltip__title"></div>
                                    <div class="main-calc-result-tooltip__subtitle">(примерная стоимость)</div>
                                    <!-- <div class="main-calc-result-tooltip__subtitle">Перевозка из Китая</div> -->
                                    <div class="main-calc-result-tooltip__row">
                                        <div class="main-calc-result-tooltip__cell">Курс:</div>
                                        <div class="main-calc-result-tooltip__cell">
                                            <span>$: </span> <span class="_number _ruble"></span>
                                            <span>¥: </span> <span class="_number _yuan"></span>
                                        </div>
                                    </div>
                                    <div class="main-calc-result-tooltip__row">
                                        <div class="main-calc-result-tooltip__cell">Упаковка:</div>
                                        <div class="main-calc-result-tooltip__cell _text">
                                            <span class="_packing"></span>
                                        </div>
                                    </div>
                                    <div class="main-calc-result-tooltip__row">
                                        <div class="main-calc-result-tooltip__cell">За упаковку:</div>
                                        <div class="main-calc-result-tooltip__cell _text">
                                            <span class="_pack-dollar"></span>
                                            <span class="_pack-ruble"></span>
                                        </div>
                                    </div>
                                    <div class="main-calc-result-tooltip__row _insurance-tooltip">
                                        <div class="main-calc-result-tooltip__cell">Страховка:</div>
                                        <div class="main-calc-result-tooltip__cell _text">
                                            <span class="_insurance-dollar"></span>
                                            <span class="_insurance-ruble"></span>
                                            <span class="_insurance-from">(от $)</span>
                                        </div>
                                    </div>
                                    <div class="main-calc-result-tooltip__row">
                                        <div class="main-calc-result-tooltip__cell">За кг:</div>
                                        <div class="main-calc-result-tooltip__cell _text">
                                            <span class="_kg-dollar"></span>
                                            <span class="_kg-ruble"></span>
                                        </div>
                                    </div>
                                    <div class="main-calc-result-tooltip__row">
                                        <div class="main-calc-result-tooltip__cell">Итого:</div>
                                        <div class="main-calc-result-tooltip__cell _text">
                                            <span class="_all-cargo-dollar"></span>
                                            <span class="_all-cargo-ruble"></span>
                                        </div>
                                    </div>
                                    <div class="main-calc-result-tooltip__white">
                                        <div class="main-calc-result-tooltip__subtitle">Таможенные расходы в РФ <br>
                                            под
                                            ваш контракт</div>
                                        <div class="main-calc-result-tooltip__row">
                                            <div class="main-calc-result-tooltip__cell">Пошлина:</div>
                                            <div class="main-calc-result-tooltip__cell _text">
                                                <span class="_chosen-imp"></span>
                                                <span class="_chosen-imp-dollar"></span>
                                                <span class="_chosen-imp-ruble"></span>
                                            </div>
                                        </div>
                                        <div class="main-calc-result-tooltip__row">
                                            <div class="main-calc-result-tooltip__cell">НДС:</div>
                                            <div class="main-calc-result-tooltip__cell _text">
                                                <span class="_nds"></span>
                                                <span class="_nds-dollar"></span>
                                                <span class="_nds-ruble"></span>
                                            </div>
                                        </div>
                                        <!-- <div class="main-calc-result-tooltip__row">
                                            <div class="main-calc-result-tooltip__cell">Услуги декларации:</div>
                                            <div class="main-calc-result-tooltip__cell _text">
                                                <span class="_decloration-dollar"></span>
                                                <span class="_decloration-ruble"></span>
                                            </div>
                                        </div> -->
                                        <div class="main-calc-result-tooltip__row">
                                            <div class="main-calc-result-tooltip__cell">Итого:</div>
                                            <div class="main-calc-result-tooltip__cell _text">
                                                <span class="_all-white-dollar"></span>
                                                <span class="_all-white-ruble"></span>
                                            </div>
                                        </div>
                                        <div class="main-calc-result-tooltip__subtitle">Перевозка + Таможенные
                                            расходы
                                        </div>
                                        <div class="main-calc-result-tooltip__row">
                                            <div class="main-calc-result-tooltip__cell">Итого:</div>
                                            <div class="main-calc-result-tooltip__cell _text">
                                                <span class="_all-calculated-price-dollar"></span>
                                                <span class="_all-calculated-price-ruble"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="main-calc-result-tooltip__country">
                                        <div class="main-calc-result-tooltip__subtitle">Перевозка по России <br> до
                                            указанного адреса</div>
                                        <div class="main-calc-result-tooltip__row">
                                            <div class="main-calc-result-tooltip__cell">За кг:</div>
                                            <div class="main-calc-result-tooltip__cell _text">
                                                <span class="_kit_dollar"></span>
                                                <span class="_kit_ruble"></span>
                                            </div>
                                        </div>
                                        <div class="main-calc-result-tooltip__row">
                                            <div class="main-calc-result-tooltip__cell">Итого:</div>
                                            <div class="main-calc-result-tooltip__cell _text">
                                                <span class="_kit_all_dollar"></span>
                                                <span class="_kit_all_ruble"></span>
                                            </div>
                                        </div>
                                        <div class="main-calc-result-tooltip__subtitle">Итого за всё</div>
                                        <div class="main-calc-result-tooltip__row">
                                            <div class="main-calc-result-tooltip__cell">Итого:</div>
                                            <div class="main-calc-result-tooltip__cell _text">
                                                <span class="_everything_price_dollar"></span>
                                                <span class="_everything_price_ruble"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="main-calc-result-tooltip__info">* Доп. упаковка увеличит вес вашего
                                        груза</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Жд -->
                    <div class="main-calc-result__column result_train">
                        <div class="main-calc-result__cell">
                            <div class="delivery-item__header">
                                <div class="delivery-item__icon">
                                    <svg width="65" height="43" viewBox="0 0 65 43" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_2252_28056)">
                                            <path class="svg-stroke active"
                                                d="M1.36035 1.35669L34.1441 1.42646V1.43033C45.5333 1.44971 63.6355 10.6628 63.6355 22.0193C63.6355 30.806 55.7875 31.8021 50.365 31.7943L1.36035 31.7052"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            </path>
                                            <path class="svg-stroke active"
                                                d="M4.8877 15.3952H41.1454C42.0588 15.3952 42.5136 14.2905 41.8645 13.6471L36.1854 8.06968C35.237 7.13559 33.9542 6.61621 32.6249 6.61621H7.24985"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            </path>
                                            <path class="svg-stroke active"
                                                d="M61.587 15.3951H57.7232C53.5135 15.3951 49.4437 13.8873 46.2563 11.1432L42.6724 8.05794C42.2915 7.72849 42.5247 7.10059 43.03 7.10059H52.2386"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            </path>
                                            <path class="svg-stroke active" d="M1.84668 27.0732H62.1472"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            </path>
                                            <path class="svg-stroke active"
                                                d="M54.0032 19.8797L54.8778 22.1355C55.3871 23.4417 56.697 24.3099 58.1663 24.3099H58.2946C59.2314 24.3099 59.8728 23.4107 59.5268 22.5851L58.8971 21.0812C58.314 19.6859 56.8952 18.7673 55.3093 18.7595H54.8312C54.217 18.7557 53.7895 19.3332 53.9994 19.8797H54.0032Z"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            </path>
                                            <path class="svg-stroke active"
                                                d="M15.2687 31.3679C14.8178 33.5694 12.8626 35.2245 10.5226 35.2245C8.18254 35.2245 6.26231 33.5966 5.78809 31.4261"
                                                stroke-width="2" stroke-linejoin="round"></path>
                                            <path class="svg-stroke active"
                                                d="M27.9015 31.3679C27.4506 33.5694 25.4954 35.2245 23.1554 35.2245C20.8153 35.2245 18.8951 33.5966 18.4209 31.4261"
                                                stroke-width="2" stroke-linejoin="round"></path>
                                            <path class="svg-stroke active"
                                                d="M40.4181 31.3679C39.9672 33.5694 38.012 35.2245 35.672 35.2245C33.332 35.2245 31.4117 33.5966 30.9375 31.4261"
                                                stroke-width="2" stroke-linejoin="round"></path>
                                            <path class="svg-stroke active"
                                                d="M52.7863 31.3679C52.3354 33.5694 50.3802 35.2245 48.0401 35.2245C45.7001 35.2245 43.7799 33.5966 43.3057 31.4261"
                                                stroke-width="2" stroke-linejoin="round"></path>
                                            <path class="svg-stroke active"
                                                d="M39.8307 41.3252H4.17461C2.61977 41.3252 1.36035 40.0694 1.36035 38.5191C1.36035 36.9687 2.61977 35.7129 4.17461 35.7129H60.8212C62.3761 35.7129 63.6355 36.9687 63.6355 38.5191C63.6355 40.0694 62.3761 41.3252 60.8212 41.3252H54.8001"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            </path>
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_2252_28056">
                                                <rect width="65" height="42.6817" fill="white"></rect>
                                            </clipPath>
                                        </defs>
                                    </svg>
                                    <span class="delivery-item-label active">Жд</span>
                                </div>
                                <span class="delivery-item-label delivery-item__time active">35-50 дней</span>
                            </div>
                        </div>

                        <div class="main-calc-result__cell price-cell _off">
                            <label class="main-calc-result__price">
                                <input class="main-calc-result__price_input" type="radio" name="all-price"
                                    value="train">
                                <div class="main-calc-result__price_block price-train">
                                    <div class="main-calc-result__all_cell">
                                        <span class="main-calc-result__all_title calculate-result__title_tarif">За
                                            КГ:
                                        </span>
                                        <div>
                                            <div>
                                                <span class="calculate-result__kg"></span>
                                                <span class="main-calc-result__currency_sign">$</span>
                                            </div>
                                            <span>-</span>
                                            <div>
                                                <span class="calculate-result__kg_ruble"></span>
                                                <span class="main-calc-result__currency_sign">₽</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="main-calc-result__all_cell main-calc-result__all_cell_end">
                                        <span class="main-calc-result__all_title_end">Сумма:</span>
                                        <div class="main-calc-result__all_cell_end_block">
                                            <div>
                                                <span class="calculate-result__dollar"></span>
                                                <span class="main-calc-result__currency_sign">$</span>
                                            </div>
                                            <div>
                                                <span class="calculate-result__ruble"></span>
                                                <span class="main-calc-result__currency_sign">₽</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </label>

                            <div class="overflow-info">
                                <div class="main-calc-result-tooltip">
                                    <div class="main-calc-result-tooltip__title"></div>
                                    <div class="main-calc-result-tooltip__subtitle">(примерная стоимость)</div>
                                    <!-- <div class="main-calc-result-tooltip__subtitle">Перевозка из Китая</div> -->
                                    <div class="main-calc-result-tooltip__row">
                                        <div class="main-calc-result-tooltip__cell">Курс:</div>
                                        <div class="main-calc-result-tooltip__cell">
                                            <span>$: </span> <span class="_number _ruble"></span>
                                            <span>¥: </span> <span class="_number _yuan"></span>
                                        </div>
                                    </div>
                                    <div class="main-calc-result-tooltip__row">
                                        <div class="main-calc-result-tooltip__cell">Упаковка:</div>
                                        <div class="main-calc-result-tooltip__cell _text">
                                            <span class="_packing"></span>
                                        </div>
                                    </div>
                                    <div class="main-calc-result-tooltip__row">
                                        <div class="main-calc-result-tooltip__cell">За упаковку:</div>
                                        <div class="main-calc-result-tooltip__cell _text">
                                            <span class="_pack-dollar"></span>
                                            <span class="_pack-ruble"></span>
                                        </div>
                                    </div>
                                    <div class="main-calc-result-tooltip__row _insurance-tooltip">
                                        <div class="main-calc-result-tooltip__cell">Страховка:</div>
                                        <div class="main-calc-result-tooltip__cell _text">
                                            <span class="_insurance-dollar"></span>
                                            <span class="_insurance-ruble"></span>
                                            <span class="_insurance-from">(от $)</span>
                                        </div>
                                    </div>
                                    <div class="main-calc-result-tooltip__row">
                                        <div class="main-calc-result-tooltip__cell">За кг:</div>
                                        <div class="main-calc-result-tooltip__cell _text">
                                            <span class="_kg-dollar"></span>
                                            <span class="_kg-ruble"></span>
                                        </div>
                                    </div>
                                    <div class="main-calc-result-tooltip__row">
                                        <div class="main-calc-result-tooltip__cell">Итого:</div>
                                        <div class="main-calc-result-tooltip__cell _text">
                                            <span class="_all-cargo-dollar"></span>
                                            <span class="_all-cargo-ruble"></span>
                                        </div>
                                    </div>
                                    <div class="main-calc-result-tooltip__white">
                                        <div class="main-calc-result-tooltip__subtitle">Таможенные расходы в РФ <br>
                                            под
                                            ваш контракт</div>
                                        <div class="main-calc-result-tooltip__row">
                                            <div class="main-calc-result-tooltip__cell">Пошлина:</div>
                                            <div class="main-calc-result-tooltip__cell _text">
                                                <span class="_chosen-imp"></span>
                                                <span class="_chosen-imp-dollar"></span>
                                                <span class="_chosen-imp-ruble"></span>
                                            </div>
                                        </div>
                                        <div class="main-calc-result-tooltip__row">
                                            <div class="main-calc-result-tooltip__cell">НДС:</div>
                                            <div class="main-calc-result-tooltip__cell _text">
                                                <span class="_nds"></span>
                                                <span class="_nds-dollar"></span>
                                                <span class="_nds-ruble"></span>
                                            </div>
                                        </div>
                                        <!-- <div class="main-calc-result-tooltip__row">
                                            <div class="main-calc-result-tooltip__cell">Услуги декларации:</div>
                                            <div class="main-calc-result-tooltip__cell _text">
                                                <span class="_decloration-dollar"></span>
                                                <span class="_decloration-ruble"></span>
                                            </div>
                                        </div> -->
                                        <div class="main-calc-result-tooltip__row">
                                            <div class="main-calc-result-tooltip__cell">Итого:</div>
                                            <div class="main-calc-result-tooltip__cell _text">
                                                <span class="_all-white-dollar"></span>
                                                <span class="_all-white-ruble"></span>
                                            </div>
                                        </div>
                                        <div class="main-calc-result-tooltip__subtitle">Перевозка + Таможенные
                                            расходы
                                        </div>
                                        <div class="main-calc-result-tooltip__row">
                                            <div class="main-calc-result-tooltip__cell">Итого:</div>
                                            <div class="main-calc-result-tooltip__cell _text">
                                                <span class="_all-calculated-price-dollar"></span>
                                                <span class="_all-calculated-price-ruble"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="main-calc-result-tooltip__info">* Доп. упаковка увеличит вес вашего
                                        груза</div>
                                </div>
                            </div>
                        </div>

                        <div class="main-calc-result__cell price-cell to-address jde _load">
                            <div class="loader _load"></div>
                            <label class="main-calc-result__price">
                                <input class="main-calc-result__price_input" type="radio" name="all-price"
                                    value="jde-train">
                                <div class="main-calc-result__price_block price-auto">
                                    <div class="main-calc-result__all_cell">
                                        <span class="main-calc-result__all_title calculate-result__title_tarif">За
                                            КГ:
                                        </span>
                                        <div>
                                            <div>
                                                <span class="calculate-result__kg"></span>
                                                <span class="main-calc-result__currency_sign">$</span>
                                            </div>
                                            <span>-</span>
                                            <div>
                                                <span class="calculate-result__kg_ruble"></span>
                                                <span class="main-calc-result__currency_sign">₽</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="main-calc-result__all_cell main-calc-result__all_cell_end">
                                        <span class="main-calc-result__all_title_end">Сумма:</span>
                                        <div class="main-calc-result__all_cell_end_block">
                                            <div>
                                                <span class="calculate-result__dollar"></span>
                                                <span class="main-calc-result__currency_sign">$</span>
                                            </div>
                                            <div>
                                                <span class="calculate-result__ruble"></span>
                                                <span class="main-calc-result__currency_sign">₽</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </label>

                            <div class="overflow-info">
                                <div class="main-calc-result-tooltip">
                                    <div class="main-calc-result-tooltip__title"></div>
                                    <div class="main-calc-result-tooltip__subtitle">(примерная стоимость)</div>
                                    <!-- <div class="main-calc-result-tooltip__subtitle">Перевозка из Китая</div> -->
                                    <div class="main-calc-result-tooltip__row">
                                        <div class="main-calc-result-tooltip__cell">Курс:</div>
                                        <div class="main-calc-result-tooltip__cell">
                                            <span>$: </span> <span class="_number _ruble"></span>
                                            <span>¥: </span> <span class="_number _yuan"></span>
                                        </div>
                                    </div>
                                    <div class="main-calc-result-tooltip__row">
                                        <div class="main-calc-result-tooltip__cell">Упаковка:</div>
                                        <div class="main-calc-result-tooltip__cell _text">
                                            <span class="_packing"></span>
                                        </div>
                                    </div>
                                    <div class="main-calc-result-tooltip__row">
                                        <div class="main-calc-result-tooltip__cell">За упаковку:</div>
                                        <div class="main-calc-result-tooltip__cell _text">
                                            <span class="_pack-dollar"></span>
                                            <span class="_pack-ruble"></span>
                                        </div>
                                    </div>
                                    <div class="main-calc-result-tooltip__row _insurance-tooltip">
                                        <div class="main-calc-result-tooltip__cell">Страховка:</div>
                                        <div class="main-calc-result-tooltip__cell _text">
                                            <span class="_insurance-dollar"></span>
                                            <span class="_insurance-ruble"></span>
                                            <span class="_insurance-from">(от $)</span>
                                        </div>
                                    </div>
                                    <div class="main-calc-result-tooltip__row">
                                        <div class="main-calc-result-tooltip__cell">За кг:</div>
                                        <div class="main-calc-result-tooltip__cell _text">
                                            <span class="_kg-dollar"></span>
                                            <span class="_kg-ruble"></span>
                                        </div>
                                    </div>
                                    <div class="main-calc-result-tooltip__row">
                                        <div class="main-calc-result-tooltip__cell">Итого:</div>
                                        <div class="main-calc-result-tooltip__cell _text">
                                            <span class="_all-cargo-dollar"></span>
                                            <span class="_all-cargo-ruble"></span>
                                        </div>
                                    </div>
                                    <div class="main-calc-result-tooltip__white">
                                        <div class="main-calc-result-tooltip__subtitle">Таможенные расходы в РФ <br>
                                            под
                                            ваш контракт</div>
                                        <div class="main-calc-result-tooltip__row">
                                            <div class="main-calc-result-tooltip__cell">Пошлина:</div>
                                            <div class="main-calc-result-tooltip__cell _text">
                                                <span class="_chosen-imp"></span>
                                                <span class="_chosen-imp-dollar"></span>
                                                <span class="_chosen-imp-ruble"></span>
                                            </div>
                                        </div>
                                        <div class="main-calc-result-tooltip__row">
                                            <div class="main-calc-result-tooltip__cell">НДС:</div>
                                            <div class="main-calc-result-tooltip__cell _text">
                                                <span class="_nds"></span>
                                                <span class="_nds-dollar"></span>
                                                <span class="_nds-ruble"></span>
                                            </div>
                                        </div>
                                        <!-- <div class="main-calc-result-tooltip__row">
                                            <div class="main-calc-result-tooltip__cell">Услуги декларации:</div>
                                            <div class="main-calc-result-tooltip__cell _text">
                                                <span class="_decloration-dollar"></span>
                                                <span class="_decloration-ruble"></span>
                                            </div>
                                        </div> -->
                                        <div class="main-calc-result-tooltip__row">
                                            <div class="main-calc-result-tooltip__cell">Итого:</div>
                                            <div class="main-calc-result-tooltip__cell _text">
                                                <span class="_all-white-dollar"></span>
                                                <span class="_all-white-ruble"></span>
                                            </div>
                                        </div>
                                        <div class="main-calc-result-tooltip__subtitle">Перевозка + Таможенные
                                            расходы
                                        </div>
                                        <div class="main-calc-result-tooltip__row">
                                            <div class="main-calc-result-tooltip__cell">Итого:</div>
                                            <div class="main-calc-result-tooltip__cell _text">
                                                <span class="_all-calculated-price-dollar"></span>
                                                <span class="_all-calculated-price-ruble"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="main-calc-result-tooltip__country">
                                        <div class="main-calc-result-tooltip__subtitle">Перевозка по России <br> до
                                            указанного адреса</div>
                                        <div class="main-calc-result-tooltip__row">
                                            <div class="main-calc-result-tooltip__cell">За кг:</div>
                                            <div class="main-calc-result-tooltip__cell _text">
                                                <span class="_jde_dollar"></span>
                                                <span class="_jde_ruble"></span>
                                            </div>
                                        </div>
                                        <div class="main-calc-result-tooltip__row">
                                            <div class="main-calc-result-tooltip__cell">Итого:</div>
                                            <div class="main-calc-result-tooltip__cell _text">
                                                <span class="_jde_all_dollar"></span>
                                                <span class="_jde_all_ruble"></span>
                                            </div>
                                        </div>
                                        <div class="main-calc-result-tooltip__subtitle">Итого за всё</div>
                                        <div class="main-calc-result-tooltip__row">
                                            <div class="main-calc-result-tooltip__cell">Итого:</div>
                                            <div class="main-calc-result-tooltip__cell _text">
                                                <span class="_everything_price_dollar"></span>
                                                <span class="_everything_price_ruble"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="main-calc-result-tooltip__info">* Доп. упаковка увеличит вес вашего
                                        груза</div>
                                </div>
                            </div>
                        </div>

                        <div class="main-calc-result__cell price-cell to-address kit _load">
                            <div class="loader _load"></div>
                            <label class="main-calc-result__price">
                                <input class="main-calc-result__price_input" type="radio" name="all-price"
                                    value="kit-train">
                                <div class="main-calc-result__price_block price-auto">
                                    <div class="main-calc-result__all_cell">
                                        <span class="main-calc-result__all_title calculate-result__title_tarif">За
                                            КГ:
                                        </span>
                                        <div>
                                            <div>
                                                <span class="calculate-result__kg"></span>
                                                <span class="main-calc-result__currency_sign">$</span>
                                            </div>
                                            <span>-</span>
                                            <div>
                                                <span class="calculate-result__kg_ruble"></span>
                                                <span class="main-calc-result__currency_sign">₽</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="main-calc-result__all_cell main-calc-result__all_cell_end">
                                        <span class="main-calc-result__all_title_end">Сумма:</span>
                                        <div class="main-calc-result__all_cell_end_block">
                                            <div>
                                                <span class="calculate-result__dollar"></span>
                                                <span class="main-calc-result__currency_sign">$</span>
                                            </div>
                                            <div>
                                                <span class="calculate-result__ruble"></span>
                                                <span class="main-calc-result__currency_sign">₽</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </label>

                            <div class="overflow-info">
                                <div class="main-calc-result-tooltip">
                                    <div class="main-calc-result-tooltip__title"></div>
                                    <div class="main-calc-result-tooltip__subtitle">(примерная стоимость)</div>
                                    <!-- <div class="main-calc-result-tooltip__subtitle">Перевозка из Китая</div> -->
                                    <div class="main-calc-result-tooltip__row">
                                        <div class="main-calc-result-tooltip__cell">Курс:</div>
                                        <div class="main-calc-result-tooltip__cell">
                                            <span>$: </span> <span class="_number _ruble"></span>
                                            <span>¥: </span> <span class="_number _yuan"></span>
                                        </div>
                                    </div>
                                    <div class="main-calc-result-tooltip__row">
                                        <div class="main-calc-result-tooltip__cell">Упаковка:</div>
                                        <div class="main-calc-result-tooltip__cell _text">
                                            <span class="_packing"></span>
                                        </div>
                                    </div>
                                    <div class="main-calc-result-tooltip__row">
                                        <div class="main-calc-result-tooltip__cell">За упаковку:</div>
                                        <div class="main-calc-result-tooltip__cell _text">
                                            <span class="_pack-dollar"></span>
                                            <span class="_pack-ruble"></span>
                                        </div>
                                    </div>
                                    <div class="main-calc-result-tooltip__row _insurance-tooltip">
                                        <div class="main-calc-result-tooltip__cell">Страховка:</div>
                                        <div class="main-calc-result-tooltip__cell _text">
                                            <span class="_insurance-dollar"></span>
                                            <span class="_insurance-ruble"></span>
                                            <span class="_insurance-from">(от $)</span>
                                        </div>
                                    </div>
                                    <div class="main-calc-result-tooltip__row">
                                        <div class="main-calc-result-tooltip__cell">За кг:</div>
                                        <div class="main-calc-result-tooltip__cell _text">
                                            <span class="_kg-dollar"></span>
                                            <span class="_kg-ruble"></span>
                                        </div>
                                    </div>
                                    <div class="main-calc-result-tooltip__row">
                                        <div class="main-calc-result-tooltip__cell">Итого:</div>
                                        <div class="main-calc-result-tooltip__cell _text">
                                            <span class="_all-cargo-dollar"></span>
                                            <span class="_all-cargo-ruble"></span>
                                        </div>
                                    </div>
                                    <div class="main-calc-result-tooltip__white">
                                        <div class="main-calc-result-tooltip__subtitle">Таможенные расходы в РФ <br>
                                            под
                                            ваш контракт</div>
                                        <div class="main-calc-result-tooltip__row">
                                            <div class="main-calc-result-tooltip__cell">Пошлина:</div>
                                            <div class="main-calc-result-tooltip__cell _text">
                                                <span class="_chosen-imp"></span>
                                                <span class="_chosen-imp-dollar"></span>
                                                <span class="_chosen-imp-ruble"></span>
                                            </div>
                                        </div>
                                        <div class="main-calc-result-tooltip__row">
                                            <div class="main-calc-result-tooltip__cell">НДС:</div>
                                            <div class="main-calc-result-tooltip__cell _text">
                                                <span class="_nds"></span>
                                                <span class="_nds-dollar"></span>
                                                <span class="_nds-ruble"></span>
                                            </div>
                                        </div>
                                        <!-- <div class="main-calc-result-tooltip__row">
                                            <div class="main-calc-result-tooltip__cell">Услуги декларации:</div>
                                            <div class="main-calc-result-tooltip__cell _text">
                                                <span class="_decloration-dollar"></span>
                                                <span class="_decloration-ruble"></span>
                                            </div>
                                        </div> -->
                                        <div class="main-calc-result-tooltip__row">
                                            <div class="main-calc-result-tooltip__cell">Итого:</div>
                                            <div class="main-calc-result-tooltip__cell _text">
                                                <span class="_all-white-dollar"></span>
                                                <span class="_all-white-ruble"></span>
                                            </div>
                                        </div>
                                        <div class="main-calc-result-tooltip__subtitle">Перевозка + Таможенные
                                            расходы
                                        </div>
                                        <div class="main-calc-result-tooltip__row">
                                            <div class="main-calc-result-tooltip__cell">Итого:</div>
                                            <div class="main-calc-result-tooltip__cell _text">
                                                <span class="_all-calculated-price-dollar"></span>
                                                <span class="_all-calculated-price-ruble"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="main-calc-result-tooltip__country">
                                        <div class="main-calc-result-tooltip__subtitle">Перевозка по России <br> до
                                            указанного адреса</div>
                                        <div class="main-calc-result-tooltip__row">
                                            <div class="main-calc-result-tooltip__cell">За кг:</div>
                                            <div class="main-calc-result-tooltip__cell _text">
                                                <span class="_kit_dollar"></span>
                                                <span class="_kit_ruble"></span>
                                            </div>
                                        </div>
                                        <div class="main-calc-result-tooltip__row">
                                            <div class="main-calc-result-tooltip__cell">Итого:</div>
                                            <div class="main-calc-result-tooltip__cell _text">
                                                <span class="_kit_all_dollar"></span>
                                                <span class="_kit_all_ruble"></span>
                                            </div>
                                        </div>
                                        <div class="main-calc-result-tooltip__subtitle">Итого за всё</div>
                                        <div class="main-calc-result-tooltip__row">
                                            <div class="main-calc-result-tooltip__cell">Итого:</div>
                                            <div class="main-calc-result-tooltip__cell _text">
                                                <span class="_everything_price_dollar"></span>
                                                <span class="_everything_price_ruble"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="main-calc-result-tooltip__info">* Доп. упаковка увеличит вес вашего
                                        груза</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Авиа -->
                    <div class="main-calc-result__column result_avia">
                        <div class="main-calc-result__cell">
                            <div class="delivery-item__header">
                                <div class="delivery-item__icon">
                                    <svg width="53" height="52" viewBox="0 0 53 52" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_2252_28060)">
                                            <path class="svg-stroke active"
                                                d="M22.9967 12.1341L10.3994 3.11017L12.477 1.22363L38.6794 8.53225"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            </path>
                                            <path class="svg-stroke active"
                                                d="M41.3486 30.1293L50.0378 41.7275L51.9413 39.6725L44.493 14.3906"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            </path>
                                            <path class="svg-stroke active"
                                                d="M16.4715 38.3301C16.4715 38.3301 18.3581 36.8827 21.2639 34.5625C31.8818 26.0717 56.1106 5.86943 51.422 1.83947C45.4533 -3.29258 14.0879 35.9767 14.0879 35.9767L16.4687 38.3301H16.4715Z"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            </path>
                                            <path class="svg-stroke active"
                                                d="M21.2643 35.0045L23.4625 40.5481L21.0144 42.9566L9.02637 31.1596L11.4745 28.751L17.5612 31.3363"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            </path>
                                            <path class="svg-stroke active"
                                                d="M47.0449 21.8983L47.5503 21.506C48.1988 20.9177 49.2123 20.9564 49.8131 21.5944C50.4111 22.2325 50.3718 23.2296 49.7233 23.8207L47.991 25.3482"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            </path>
                                            <path class="svg-stroke active"
                                                d="M48.8311 27.9584L48.9742 27.8286C49.6228 27.2402 50.6363 27.2789 51.2371 27.9169C51.8351 28.555 51.7958 29.5521 51.1472 30.1432L49.721 31.4387"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            </path>
                                            <path class="svg-stroke active"
                                                d="M26.5107 5.14042L28.7259 3.12958C29.3744 2.54125 30.3879 2.57992 30.9887 3.21797C31.5867 3.85602 31.5474 4.85316 30.8989 5.44425L30.3654 5.93039"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            </path>
                                            <path class="svg-stroke active"
                                                d="M20.374 3.34226L22.3393 1.38666C22.9878 0.798327 24.0013 0.836997 24.6021 1.47505C25.2001 2.1131 25.1608 3.11024 24.5123 3.70133L23.9676 4.19576"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            </path>
                                            <path class="svg-stroke active" d="M0.982422 12.6838L7.84395 5.93311"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            </path>
                                            <path class="svg-stroke active" d="M40.5127 51.0334L47.3742 44.2827"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            </path>
                                            <path class="svg-stroke active" d="M6.81641 13.3549L10.9294 9.30835"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            </path>
                                            <path class="svg-stroke active" d="M39.8018 45.2548L43.9147 41.2083"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            </path>
                                            <path class="svg-stroke active" d="M12.2383 14.6725L15.043 11.9131"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            </path>
                                            <path class="svg-stroke active" d="M38.6787 39.7086L41.4862 36.9492"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            </path>
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_2252_28060">
                                                <rect width="53" height="52" fill="white"></rect>
                                            </clipPath>
                                        </defs>
                                    </svg>
                                    <span class="delivery-item-label active">Авиа</span>
                                </div>
                                <span class="delivery-item-label delivery-item__time active">5-15 дней</span>
                            </div>
                        </div>

                        <div class="main-calc-result__cell price-cell _off">
                            <label class="main-calc-result__price">
                                <input class="main-calc-result__price_input" type="radio" name="all-price" value="avia">
                                <div class="main-calc-result__price_block price-avia">
                                    <div class="main-calc-result__all_cell">
                                        <span class="main-calc-result__all_title calculate-result__title_tarif">За
                                            КГ:
                                        </span>
                                        <div>
                                            <div>
                                                <span class="calculate-result__kg"></span>
                                                <span class="main-calc-result__currency_sign">$</span>
                                            </div>
                                            <span>-</span>
                                            <div>
                                                <span class="calculate-result__kg_ruble"></span>
                                                <span class="main-calc-result__currency_sign">₽</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="main-calc-result__all_cell main-calc-result__all_cell_end">
                                        <span class="main-calc-result__all_title_end">Сумма:</span>
                                        <div class="main-calc-result__all_cell_end_block">
                                            <div>
                                                <span class="calculate-result__dollar"></span>
                                                <span class="main-calc-result__currency_sign">$</span>
                                            </div>
                                            <div>
                                                <span class="calculate-result__ruble"></span>
                                                <span class="main-calc-result__currency_sign">₽</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </label>

                            <div class="overflow-info">
                                <div class="main-calc-result-tooltip">
                                    <div class="main-calc-result-tooltip__title"></div>
                                    <div class="main-calc-result-tooltip__subtitle">(примерная стоимость)</div>
                                    <!-- <div class="main-calc-result-tooltip__subtitle">Перевозка из Китая</div> -->
                                    <div class="main-calc-result-tooltip__row">
                                        <div class="main-calc-result-tooltip__cell">Курс:</div>
                                        <div class="main-calc-result-tooltip__cell">
                                            <span>$: </span> <span class="_number _ruble"></span>
                                            <span>¥: </span> <span class="_number _yuan"></span>
                                        </div>
                                    </div>
                                    <div class="main-calc-result-tooltip__row">
                                        <div class="main-calc-result-tooltip__cell">Упаковка:</div>
                                        <div class="main-calc-result-tooltip__cell _text">
                                            <span class="_packing"></span>
                                        </div>
                                    </div>
                                    <div class="main-calc-result-tooltip__row">
                                        <div class="main-calc-result-tooltip__cell">За упаковку:</div>
                                        <div class="main-calc-result-tooltip__cell _text">
                                            <span class="_pack-dollar"></span>
                                            <span class="_pack-ruble"></span>
                                        </div>
                                    </div>
                                    <div class="main-calc-result-tooltip__row _insurance-tooltip">
                                        <div class="main-calc-result-tooltip__cell">Страховка:</div>
                                        <div class="main-calc-result-tooltip__cell _text">
                                            <span class="_insurance-dollar"></span>
                                            <span class="_insurance-ruble"></span>
                                            <span class="_insurance-from">(от $)</span>
                                        </div>
                                    </div>
                                    <div class="main-calc-result-tooltip__row">
                                        <div class="main-calc-result-tooltip__cell">За кг:</div>
                                        <div class="main-calc-result-tooltip__cell _text">
                                            <span class="_kg-dollar"></span>
                                            <span class="_kg-ruble"></span>
                                        </div>
                                    </div>
                                    <div class="main-calc-result-tooltip__row">
                                        <div class="main-calc-result-tooltip__cell">Итого:</div>
                                        <div class="main-calc-result-tooltip__cell _text">
                                            <span class="_all-cargo-dollar"></span>
                                            <span class="_all-cargo-ruble"></span>
                                        </div>
                                    </div>
                                    <div class="main-calc-result-tooltip__white">
                                        <div class="main-calc-result-tooltip__subtitle">Таможенные расходы в РФ <br>
                                            под
                                            ваш контракт</div>
                                        <div class="main-calc-result-tooltip__row">
                                            <div class="main-calc-result-tooltip__cell">Пошлина:</div>
                                            <div class="main-calc-result-tooltip__cell _text">
                                                <span class="_chosen-imp"></span>
                                                <span class="_chosen-imp-dollar"></span>
                                                <span class="_chosen-imp-ruble"></span>
                                            </div>
                                        </div>
                                        <div class="main-calc-result-tooltip__row">
                                            <div class="main-calc-result-tooltip__cell">НДС:</div>
                                            <div class="main-calc-result-tooltip__cell _text">
                                                <span class="_nds"></span>
                                                <span class="_nds-dollar"></span>
                                                <span class="_nds-ruble"></span>
                                            </div>
                                        </div>
                                        <!-- <div class="main-calc-result-tooltip__row">
                                            <div class="main-calc-result-tooltip__cell">Услуги декларации:</div>
                                            <div class="main-calc-result-tooltip__cell _text">
                                                <span class="_decloration-dollar"></span>
                                                <span class="_decloration-ruble"></span>
                                            </div>
                                        </div> -->
                                        <div class="main-calc-result-tooltip__row">
                                            <div class="main-calc-result-tooltip__cell">Итого:</div>
                                            <div class="main-calc-result-tooltip__cell _text">
                                                <span class="_all-white-dollar"></span>
                                                <span class="_all-white-ruble"></span>
                                            </div>
                                        </div>
                                        <div class="main-calc-result-tooltip__subtitle">Перевозка + Таможенные
                                            расходы
                                        </div>
                                        <div class="main-calc-result-tooltip__row">
                                            <div class="main-calc-result-tooltip__cell">Итого:</div>
                                            <div class="main-calc-result-tooltip__cell _text">
                                                <span class="_all-calculated-price-dollar"></span>
                                                <span class="_all-calculated-price-ruble"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="main-calc-result-tooltip__info">* Доп. упаковка увеличит вес вашего
                                        груза</div>
                                </div>
                            </div>
                        </div>

                        <div class="main-calc-result__cell price-cell to-address jde _load">
                            <div class="loader _load"></div>
                            <label class="main-calc-result__price">
                                <input class="main-calc-result__price_input" type="radio" name="all-price"
                                    value="jde-avia">
                                <div class="main-calc-result__price_block price-auto">
                                    <div class="main-calc-result__all_cell">
                                        <span class="main-calc-result__all_title calculate-result__title_tarif">За
                                            КГ:
                                        </span>
                                        <div>
                                            <div>
                                                <span class="calculate-result__kg"></span>
                                                <span class="main-calc-result__currency_sign">$</span>
                                            </div>
                                            <span>-</span>
                                            <div>
                                                <span class="calculate-result__kg_ruble"></span>
                                                <span class="main-calc-result__currency_sign">₽</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="main-calc-result__all_cell main-calc-result__all_cell_end">
                                        <span class="main-calc-result__all_title_end">Сумма:</span>
                                        <div class="main-calc-result__all_cell_end_block">
                                            <div>
                                                <span class="calculate-result__dollar"></span>
                                                <span class="main-calc-result__currency_sign">$</span>
                                            </div>
                                            <div>
                                                <span class="calculate-result__ruble"></span>
                                                <span class="main-calc-result__currency_sign">₽</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </label>

                            <div class="overflow-info">
                                <div class="main-calc-result-tooltip">
                                    <div class="main-calc-result-tooltip__title"></div>
                                    <div class="main-calc-result-tooltip__subtitle">(примерная стоимость)</div>
                                    <!-- <div class="main-calc-result-tooltip__subtitle">Перевозка из Китая</div> -->
                                    <div class="main-calc-result-tooltip__row">
                                        <div class="main-calc-result-tooltip__cell">Курс:</div>
                                        <div class="main-calc-result-tooltip__cell">
                                            <span>$: </span> <span class="_number _ruble"></span>
                                            <span>¥: </span> <span class="_number _yuan"></span>
                                        </div>
                                    </div>
                                    <div class="main-calc-result-tooltip__row">
                                        <div class="main-calc-result-tooltip__cell">Упаковка:</div>
                                        <div class="main-calc-result-tooltip__cell _text">
                                            <span class="_packing"></span>
                                        </div>
                                    </div>
                                    <div class="main-calc-result-tooltip__row">
                                        <div class="main-calc-result-tooltip__cell">За упаковку:</div>
                                        <div class="main-calc-result-tooltip__cell _text">
                                            <span class="_pack-dollar"></span>
                                            <span class="_pack-ruble"></span>
                                        </div>
                                    </div>
                                    <div class="main-calc-result-tooltip__row _insurance-tooltip">
                                        <div class="main-calc-result-tooltip__cell">Страховка:</div>
                                        <div class="main-calc-result-tooltip__cell _text">
                                            <span class="_insurance-dollar"></span>
                                            <span class="_insurance-ruble"></span>
                                            <span class="_insurance-from">(от $)</span>
                                        </div>
                                    </div>
                                    <div class="main-calc-result-tooltip__row">
                                        <div class="main-calc-result-tooltip__cell">За кг:</div>
                                        <div class="main-calc-result-tooltip__cell _text">
                                            <span class="_kg-dollar"></span>
                                            <span class="_kg-ruble"></span>
                                        </div>
                                    </div>
                                    <div class="main-calc-result-tooltip__row">
                                        <div class="main-calc-result-tooltip__cell">Итого:</div>
                                        <div class="main-calc-result-tooltip__cell _text">
                                            <span class="_all-cargo-dollar"></span>
                                            <span class="_all-cargo-ruble"></span>
                                        </div>
                                    </div>
                                    <div class="main-calc-result-tooltip__white">
                                        <div class="main-calc-result-tooltip__subtitle">Таможенные расходы в РФ <br>
                                            под
                                            ваш контракт</div>
                                        <div class="main-calc-result-tooltip__row">
                                            <div class="main-calc-result-tooltip__cell">Пошлина:</div>
                                            <div class="main-calc-result-tooltip__cell _text">
                                                <span class="_chosen-imp"></span>
                                                <span class="_chosen-imp-dollar"></span>
                                                <span class="_chosen-imp-ruble"></span>
                                            </div>
                                        </div>
                                        <div class="main-calc-result-tooltip__row">
                                            <div class="main-calc-result-tooltip__cell">НДС:</div>
                                            <div class="main-calc-result-tooltip__cell _text">
                                                <span class="_nds"></span>
                                                <span class="_nds-dollar"></span>
                                                <span class="_nds-ruble"></span>
                                            </div>
                                        </div>
                                        <!-- <div class="main-calc-result-tooltip__row">
                                            <div class="main-calc-result-tooltip__cell">Услуги декларации:</div>
                                            <div class="main-calc-result-tooltip__cell _text">
                                                <span class="_decloration-dollar"></span>
                                                <span class="_decloration-ruble"></span>
                                            </div>
                                        </div> -->
                                        <div class="main-calc-result-tooltip__row">
                                            <div class="main-calc-result-tooltip__cell">Итого:</div>
                                            <div class="main-calc-result-tooltip__cell _text">
                                                <span class="_all-white-dollar"></span>
                                                <span class="_all-white-ruble"></span>
                                            </div>
                                        </div>
                                        <div class="main-calc-result-tooltip__subtitle">Перевозка + Таможенные
                                            расходы
                                        </div>
                                        <div class="main-calc-result-tooltip__row">
                                            <div class="main-calc-result-tooltip__cell">Итого:</div>
                                            <div class="main-calc-result-tooltip__cell _text">
                                                <span class="_all-calculated-price-dollar"></span>
                                                <span class="_all-calculated-price-ruble"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="main-calc-result-tooltip__country">
                                        <div class="main-calc-result-tooltip__subtitle">Перевозка по России <br> до
                                            указанного адреса</div>
                                        <div class="main-calc-result-tooltip__row">
                                            <div class="main-calc-result-tooltip__cell">За кг:</div>
                                            <div class="main-calc-result-tooltip__cell _text">
                                                <span class="_jde_dollar"></span>
                                                <span class="_jde_ruble"></span>
                                            </div>
                                        </div>
                                        <div class="main-calc-result-tooltip__row">
                                            <div class="main-calc-result-tooltip__cell">Итого:</div>
                                            <div class="main-calc-result-tooltip__cell _text">
                                                <span class="_jde_all_dollar"></span>
                                                <span class="_jde_all_ruble"></span>
                                            </div>
                                        </div>
                                        <div class="main-calc-result-tooltip__subtitle">Итого за всё</div>
                                        <div class="main-calc-result-tooltip__row">
                                            <div class="main-calc-result-tooltip__cell">Итого:</div>
                                            <div class="main-calc-result-tooltip__cell _text">
                                                <span class="_everything_price_dollar"></span>
                                                <span class="_everything_price_ruble"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="main-calc-result-tooltip__info">* Доп. упаковка увеличит вес вашего
                                        груза</div>
                                </div>
                            </div>
                        </div>

                        <div class="main-calc-result__cell price-cell to-address kit _load">
                            <div class="loader _load"></div>
                            <label class="main-calc-result__price">
                                <input class="main-calc-result__price_input" type="radio" name="all-price"
                                    value="kit-avia">
                                <div class="main-calc-result__price_block price-auto">
                                    <div class="main-calc-result__all_cell">
                                        <span class="main-calc-result__all_title calculate-result__title_tarif">За
                                            КГ:
                                        </span>
                                        <div>
                                            <div>
                                                <span class="calculate-result__kg"></span>
                                                <span class="main-calc-result__currency_sign">$</span>
                                            </div>
                                            <span>-</span>
                                            <div>
                                                <span class="calculate-result__kg_ruble"></span>
                                                <span class="main-calc-result__currency_sign">₽</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="main-calc-result__all_cell main-calc-result__all_cell_end">
                                        <span class="main-calc-result__all_title_end">Сумма:</span>
                                        <div class="main-calc-result__all_cell_end_block">
                                            <div>
                                                <span class="calculate-result__dollar"></span>
                                                <span class="main-calc-result__currency_sign">$</span>
                                            </div>
                                            <div>
                                                <span class="calculate-result__ruble"></span>
                                                <span class="main-calc-result__currency_sign">₽</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </label>

                            <div class="overflow-info">
                                <div class="main-calc-result-tooltip">
                                    <div class="main-calc-result-tooltip__title"></div>
                                    <div class="main-calc-result-tooltip__subtitle">(примерная стоимость)</div>
                                    <!-- <div class="main-calc-result-tooltip__subtitle">Перевозка из Китая</div> -->
                                    <div class="main-calc-result-tooltip__row">
                                        <div class="main-calc-result-tooltip__cell">Курс:</div>
                                        <div class="main-calc-result-tooltip__cell">
                                            <span>$: </span> <span class="_number _ruble"></span>
                                            <span>¥: </span> <span class="_number _yuan"></span>
                                        </div>
                                    </div>
                                    <div class="main-calc-result-tooltip__row">
                                        <div class="main-calc-result-tooltip__cell">Упаковка:</div>
                                        <div class="main-calc-result-tooltip__cell _text">
                                            <span class="_packing"></span>
                                        </div>
                                    </div>
                                    <div class="main-calc-result-tooltip__row">
                                        <div class="main-calc-result-tooltip__cell">За упаковку:</div>
                                        <div class="main-calc-result-tooltip__cell _text">
                                            <span class="_pack-dollar"></span>
                                            <span class="_pack-ruble"></span>
                                        </div>
                                    </div>
                                    <div class="main-calc-result-tooltip__row _insurance-tooltip">
                                        <div class="main-calc-result-tooltip__cell">Страховка:</div>
                                        <div class="main-calc-result-tooltip__cell _text">
                                            <span class="_insurance-dollar"></span>
                                            <span class="_insurance-ruble"></span>
                                            <span class="_insurance-from">(от $)</span>
                                        </div>
                                    </div>
                                    <div class="main-calc-result-tooltip__row">
                                        <div class="main-calc-result-tooltip__cell">За кг:</div>
                                        <div class="main-calc-result-tooltip__cell _text">
                                            <span class="_kg-dollar"></span>
                                            <span class="_kg-ruble"></span>
                                        </div>
                                    </div>
                                    <div class="main-calc-result-tooltip__row">
                                        <div class="main-calc-result-tooltip__cell">Итого:</div>
                                        <div class="main-calc-result-tooltip__cell _text">
                                            <span class="_all-cargo-dollar"></span>
                                            <span class="_all-cargo-ruble"></span>
                                        </div>
                                    </div>
                                    <div class="main-calc-result-tooltip__white">
                                        <div class="main-calc-result-tooltip__subtitle">Таможенные расходы в РФ <br>
                                            под
                                            ваш контракт</div>
                                        <div class="main-calc-result-tooltip__row">
                                            <div class="main-calc-result-tooltip__cell">Пошлина:</div>
                                            <div class="main-calc-result-tooltip__cell _text">
                                                <span class="_chosen-imp"></span>
                                                <span class="_chosen-imp-dollar"></span>
                                                <span class="_chosen-imp-ruble"></span>
                                            </div>
                                        </div>
                                        <div class="main-calc-result-tooltip__row">
                                            <div class="main-calc-result-tooltip__cell">НДС:</div>
                                            <div class="main-calc-result-tooltip__cell _text">
                                                <span class="_nds"></span>
                                                <span class="_nds-dollar"></span>
                                                <span class="_nds-ruble"></span>
                                            </div>
                                        </div>
                                        <!-- <div class="main-calc-result-tooltip__row">
                                            <div class="main-calc-result-tooltip__cell">Услуги декларации:</div>
                                            <div class="main-calc-result-tooltip__cell _text">
                                                <span class="_decloration-dollar"></span>
                                                <span class="_decloration-ruble"></span>
                                            </div>
                                        </div> -->
                                        <div class="main-calc-result-tooltip__row">
                                            <div class="main-calc-result-tooltip__cell">Итого:</div>
                                            <div class="main-calc-result-tooltip__cell _text">
                                                <span class="_all-white-dollar"></span>
                                                <span class="_all-white-ruble"></span>
                                            </div>
                                        </div>
                                        <div class="main-calc-result-tooltip__subtitle">Перевозка + Таможенные
                                            расходы
                                        </div>
                                        <div class="main-calc-result-tooltip__row">
                                            <div class="main-calc-result-tooltip__cell">Итого:</div>
                                            <div class="main-calc-result-tooltip__cell _text">
                                                <span class="_all-calculated-price-dollar"></span>
                                                <span class="_all-calculated-price-ruble"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="main-calc-result-tooltip__country">
                                        <div class="main-calc-result-tooltip__subtitle">Перевозка по России <br> до
                                            указанного адреса</div>
                                        <div class="main-calc-result-tooltip__row">
                                            <div class="main-calc-result-tooltip__cell">За кг:</div>
                                            <div class="main-calc-result-tooltip__cell _text">
                                                <span class="_kit_dollar"></span>
                                                <span class="_kit_ruble"></span>
                                            </div>
                                        </div>
                                        <div class="main-calc-result-tooltip__row">
                                            <div class="main-calc-result-tooltip__cell">Итого:</div>
                                            <div class="main-calc-result-tooltip__cell _text">
                                                <span class="_kit_all_dollar"></span>
                                                <span class="_kit_all_ruble"></span>
                                            </div>
                                        </div>
                                        <div class="main-calc-result-tooltip__subtitle">Итого за всё</div>
                                        <div class="main-calc-result-tooltip__row">
                                            <div class="main-calc-result-tooltip__cell">Итого:</div>
                                            <div class="main-calc-result-tooltip__cell _text">
                                                <span class="_everything_price_dollar"></span>
                                                <span class="_everything_price_ruble"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="main-calc-result-tooltip__info">* Доп. упаковка увеличит вес вашего
                                        груза</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Кнопка PDF -->
                <div class="main-calc-result__getblock">
                    <button class="main-calc-button js-get-pdf" disabled type="button">ПОЛУЧИТЬ РАСЧЕТ В
                        PDF</button>
                </div>

            </div>

        </div>

    </form>
    <div class="main-calc__over">
        <span class="main-calc__over_pdf">
            <span>Идёт передача данных менеджеру <br> пожалуйста, подождите...</span>
            <span class="main-calc__over_pdf_count"></span>
        </span>
    </div>
</div>