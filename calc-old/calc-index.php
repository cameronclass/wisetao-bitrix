<div class="main-calc">
    <div class="pop-up-ads">
        <div class="pop-up-ads-content">
            <div class="pop-up-ads-cross-close">
                <img src="/calc-layout/images/cross.svg" alt="">
            </div>
            <div class="pop-up-ads-container">
                <div class="pop-up-tittle">
                    <?
                    $APPLICATION->IncludeComponent(
                        "bitrix:news.detail",
                        "ads_image",
                        Array(
                            "IBLOCK_TYPE" => "ads",
                            "IBLOCK_ID" => "35",
                            "ELEMENT_ID" => "2049",
                            "CHECK_DATES" => "Y",
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
                    );?>
                </div>
                <a target="_blank" class="ask-panel__btn _vk" href="https://vk.com/wisetao"
                    onclick="_tmr.push({ type: 'reachGoal', id: 3555455, goal: 'tap_to_VK'}); return true;">
                    <span>Подписаться на Вконтакте</span>
                    <img class="ask-panel__btn_icon" src="<?=SITE_TEMPLATE_PATH?>/assets/images/icons/vk-neon.png" alt="">
                </a>
            </div>
            <script>
                document.querySelector('.pop-up-ads-cross-close').addEventListener('click', (event) => {
                    event.stopPropagation();
                    document.querySelector('.pop-up-ads').style.display = 'none';
                });
            </script>
        </div>
    </div>
    <div class="first-step"></div>
    <script>
        document.querySelector('.first-step').addEventListener('click', () => {
            showCargoMessage('Выберите, пожалуйста, тип доставки');
        })
    </script>
    <form method="post" name="main-calc__form" id="main_form">
        <div class="main-calc-select">
            <!-- класс .calc-type-button не удалять -->
            <button class="main-calc-select__btn calc-type-button" data-type="cargo">
                <span class="main-calc-select__btn_title">Карго</span>
                <span class="main-calc-select__btn_subtitle">от 0,8$/кг</span>
            </button>
            <button class="main-calc-select__btn calc-type-button" data-type="white">
                <span class="main-calc-select__btn_title">Таможенный</span>
                <span class="main-calc-select__btn_subtitle">от 0,25$/кг</span>
            </button>
            <button class="main-calc-select__btn calc-type-button" data-type="comparison">Сравнение</button>
        </div>
        <div class="main-calc-first from-arrival-container"></div>
        <div class="calc-container redeem-data"></div>
        <div class="main-calc-container calc-container"></div>
        <div class="main-calc-packing">
            <div class="boxing-spoiler"></div>
        </div>

        <div class="main-calc-container client-requisite-container">
            <h4 class="main-calc__title _small label-text">
                <span class="main-calc__title_icon"></span>
                <span class="main-calc__title_text label-text">Введите ваши данные</span>
            </h4>
            <div class="main-client-requisites-parametr__main">
                <div class="group-input">
                    <div class="group-input__input">
                        <label for="client-name" class="hidden">Ваше имя</label>
                        <input type="text" id="client-name" class="client-requisites-input"  name="client-name" placeholder="Ваше имя: ">
                        <div class="input-notice" ></div>
                    </div>
                </div>
                <div class="group-input">
                    <div class="group-input__input">
                        <label for="client-phone" class="hidden">Контактный телефон</label>
                        <input type="text" id="client-phone" class="client-requisites-input phone" name="client-phone" placeholder="Контактный телефон: " maxlength="18">
                        <div class="input-notice"></div>
                        <div class="input-notice-valid-number"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="main-calc-parametr__main_btn">
            <button class="main-calc-button submit-general-button" data-scroll-to="calc-table" id="cargo-calc-button">РАСЧИТАТЬ ОНЛАЙН</button>
        </div>
        <div class="main-calc-parametr__main_btn hidden">
            <button class="main-calc-button submit-dimensions-button" data-scroll-to="calc-table" id="cargo-calc-dimensions-button">РАСЧИТАТЬ ОНЛАЙН</button>
        </div>
        <div class="main-calc-parametr__main_btn hidden">
            <button class="main-calc-button tnved-calc-button" data-scroll-to="calc-table" id="white-calc-button">РАСЧИТАТЬ ОНЛАЙН</button>
        </div>
        <div class="main-calc-parametr__main_btn hidden">
            <button class="main-calc-button tnved-calc-button" data-scroll-to="calc-table" id="cargo-white-calc-button">РАСЧИТАТЬ ОНЛАЙН</button>
        </div>
        <div id="calc-table"></div>
        <div class="boxing-content-container hidden">
            <h4 class="main-calc__title _small label-text">
                <span class="main-calc__title_icon"></span>
                <span class="main-calc__title_text label-text">Расценки по видам доставки</span>
            </h4>
            <div class="main-calc__subtitle">
                Стоимость доставки на сборный груз от 5т рассчитываем индивидуально, через менеджера, от 0.25$/кг
                <button data-scroll-to="request">Оставить заявку</button>
            </div>
            <div class="select-delivery-type">Выберите удобный вам способ доставки:</div>
            <div class="delivery-types">
                <div class="desc">
                    <div class="exchange-rate-container delivery-item">
                        <div style="position: relative; display: flex; align-items: center; width: 100%;">
                            <div class="costs-data-exchange-rate">
                                <div class="costs-data-exchange-rate-elem">
                                    <span class="rate-sign">$</span><span class="exchange-rate-elem-dollar">н/д</span>
                                </div>
                                <div class="costs-data-exchange-rate-elem">
                                    <div class="help cargo-help yuan-help">
                                        <div class="circle-help" style="width: 16px; height: 16px;" id="circle-help">
                                            ?
                                        </div>
                                        <span class="calc-tooltip">
                                            <span class="calc-tooltip__text">
                                                <a class="yuan-link" target="_blank" href="https://wisetao.com/from-china/about/blog/chistyy-i-gryaznyy-yuan-v-chem-razlichiya-i-kakoy-vybrat-2058/">Почему у нас такой курс юаня?</a>
                                                <span class="rate-info hidden">Курс ЦБ России</span>
                                            </span>
                                        </span>
                                    </div>
                                    <span class="rate-sign" style="align-items: center; display: flex;">¥</span><span style="margin-right: 0;" class="exchange-rate-elem-yuan">н/д</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="needed-space"></div>
                    <div class="type-of-goods-dimensions">
                        <div class="delivery-types-dropdown" id="delivery-types-dropdown-auto1">
                            <div class="img-delivery-type">
                                <img class="cargo-page-img active" alt="" src="/calc-layout/images/CARGO.png?v=<?= filemtime($_SERVER['DOCUMENT_ROOT'].'/calc-layout/images/CARGO.png') ?>">
                                <img class="white-page-img white" alt="" src="/calc-layout/images/WHITE.png?v=<?= filemtime($_SERVER['DOCUMENT_ROOT'].'/calc-layout/images/WHITE.png') ?>">
                            </div>
                            <div class="delivery-name-container">
                                <span class="delivery-name cargo-page-delivery-name active">Карго</span>
                                <div class="help cargo-help delivery-help cargo-page-help active">
                                    <div class="circle-help" id="circle-help">
                                        ?
                                    </div>
                                    <span class="calc-tooltip">
                                        <span class="calc-tooltip__title">КАРГО ДОСТАВКА</span>
                                        <span class="calc-tooltip__text">
                                            Процесс транспортировки грузов с использованием различных средств
                                            транспорта - грузовиков, поездов, самолетов или кораблей. Этот процесс
                                            включает в себя все этапы  от планирования маршрута и упаковки
                                            груза до его доставки конечному получателю и разгрузки.
                                            <br><br>
                                            <span class="text-orange">Доставка осуществляется только до г.Москва "Южные ворота". Доставка до вашего города осуществляется с помощью российских транспортных компаний.</span>
                                        </span>
                                    </span>
                                </div>
                                <span class="delivery-name white-page-delivery-name">Белая</span>
                                <div class="help white-help delivery-help white-page-help">
                                    <div class="circle-help" id="circle-help">
                                        ?
<!--                                        <img class="balloon-delivery-type" alt="" src="/calc-layout/images/WHITE.svg">-->
                                    </div>
                                    <span class="calc-tooltip">
                                        <span class="calc-tooltip__title">БЕЛАЯ ДОСТАВКА</span>
                                        <span class="calc-tooltip__text">
                                            Белая доставка — это официальный ввоз товара , без серых таможенных
                                            деклараций и сертификатов, с уплатой НДС и пошлины на таможне. Все операции с товаром
                                            полностью соответствуют местным законодательствам.
                                            <br> <br>
                                            <span class="text-orange">Расчет доставки включает в себя услуги компании Saide (до России) + доставка данной транспортной компанией до города назначения</span>
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="type-of-goods-dimensions">
                        <div class="delivery-types-dropdown" id="delivery-types-dropdown-auto1">
                            <div class="img-delivery-type">
                                <img alt="" class="zhde" src="/calc-layout/images/ЖДЭ.png?v=<?= filemtime($_SERVER['DOCUMENT_ROOT'].'/calc-layout/images/ЖДЭ.png') ?>">
                            </div>
                            <div class="delivery-name-container">
                                <span class="delivery-name">ЖДЭ</span>
                                <div class="help cargo-help delivery-help">
                                    <div class="circle-help" id="circle-help">
                                        ?
                                    </div>
                                    <span class="calc-tooltip">
                                        <span class="calc-tooltip__title">ЖэлДорЭкспедиция</span>
                                        <span class="calc-tooltip__text">
                                            Транспортная компания ЖелДорЭкспедиция осуществляет грузоперевозки по России из
                                            Москвы. Доставка грузов жд, авиа и автотранспортном. Филиалы в 294 городах.
                                            <br> <br>
                                            <span class="text-orange">Расчет доставки включает в себя услуги компании Saide (до России) + доставка данной транспортной компанией до города назначения</span>
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="type-of-goods-dimensions">
                        <div class="delivery-types-dropdown" id="delivery-types-dropdown-auto1">
                            <div class="img-delivery-type">
                                <img alt="" class="pek" src="/calc-layout/images/ПЭК.png">
                            </div>
                            <div class="delivery-name-container">
                                <span class="delivery-name">ПЭК</span>
                                <div class="help cargo-help delivery-help">
                                    <div class="circle-help" id="circle-help">
                                        ?
                                    </div>
                                    <span class="calc-tooltip">
                                        <span class="calc-tooltip__title">Первая Экспедиционная Компания</span>
                                        <span class="calc-tooltip__text">
                                            Логистическая компания «ПЭК» принимает как необъемные корреспондентские
                                            отправления, так и габаритные грузы массой более 20 тонн. Популярность услуг
                                            объясняется масштабами клиентской базы – ежемесячно более 300 тысяч клиентов
                                            заказывают грузоперевозки в региональной сети представительств. В зоне
                                            обслуживания находится более 100000 населенных пунктов.
                                            <br> <br>
                                            <span class="text-orange">Расчет доставки включает в себя услуги компании Saide (до России) + доставка данной транспортной компанией до города назначения</span>
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="type-of-goods-dimensions">
                        <div class="delivery-types-dropdown" id="delivery-types-dropdown-auto1">
                            <div class="img-delivery-type">
                                <img alt="" class="dl" src="/calc-layout/images/ДЛ.png?v=<?= filemtime($_SERVER['DOCUMENT_ROOT'].'/calc-layout/images/ДЛ.png') ?>">
                            </div>
                            <div class="delivery-name-container">
                                <span class="delivery-name">Деловые<br>линии</span>
                                <div class="help cargo-help delivery-help" >
                                    <div class="circle-help" id="circle-help">
                                        ?
                                    </div>
                                    <span class="calc-tooltip">
                                        <span class="calc-tooltip__title">ГК «Деловые Линии»</span>
                                        <span class="calc-tooltip__text">
                                            Российская компания, предоставляющая услуги экспресс-доставки грузов и
                                            документов, складские и другие транспортно-экспедиторские и логистические услуги в России и по всему миру.
                                            <br> <br>
                                            <span class="text-orange">Расчет доставки включает в себя услуги компании Saide (до России) + доставка данной транспортной компанией до города назначения</span>
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="type-of-goods-dimensions">
                        <div class="delivery-types-dropdown" id="delivery-types-dropdown-auto1">
                            <div class="img-delivery-type">
                                <img alt="" class="kit" src="/calc-layout/images/КИТ.png?v=<?= filemtime($_SERVER['DOCUMENT_ROOT'].'/calc-layout/images/КИТ.png') ?>">
                            </div>
                            <div class="delivery-name-container">
                                <span class="delivery-name">КИТ</span>
                                <div class="help cargo-help delivery-help">
                                    <div class="circle-help" id="circle-help">
                                        ?
                                    </div>
                                    <span class="calc-tooltip">
                                        <span class="calc-tooltip__title">КИТ</span>
                                        <span class="calc-tooltip__text">
                                            Транспортная компания "КИТ" специализируется на перевозке сборных грузов и посылок по России и странам
                                            СНГ. Доставка осуществляется различными видами транспорта: автомобильным, железнодорожным и
                                            авиационным. Предлагает широкий спектр логистических услуг, включая складскую обработку, страхование грузов
                                            и предоставление индивидуальных решений для клиентов в области транспортной логистики.
                                            <br> <br>
                                            <span class="text-orange">Расчет доставки включает в себя услуги компании Saide (до России) + доставка данной транспортной компанией до города назначения</span>
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="desc">
                    <div class="delivery-item img-boxing-item-delivery-type">
                        <div class="delivery-item__header">
                            <div class="delivery-item__icon">
                                <svg width="65" height="38" viewBox="0 0 65 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_2362_2956)">
                                        <path class="svg-stroke" d="M40.9988 25.9968L44.5584 4.45335C44.856 2.65685 43.4701 1.02075 41.6466 1.02075H7.5185L5.42773 14.4292" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path class="svg-stroke" d="M10.6434 31.4883L7.51855 31.4912" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path class="svg-stroke" d="M45.6234 31.4768L21.999 31.4856" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path class="svg-stroke" d="M45.0693 6.22949H55.4037C57.204 6.22949 58.8437 7.2619 59.6198 8.88341L63.3282 16.6352C63.7571 17.5335 63.9817 18.5192 63.9817 19.5137V27.2946C63.9817 29.5986 62.1144 31.468 59.8065 31.468H56.6263" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path class="svg-stroke" d="M54.9456 10.4407H47.4238V19.9365H57.5044C58.4964 19.9365 59.1704 18.9332 58.7969 18.0146L55.9901 11.1435C55.818 10.7177 55.4037 10.4407 54.9456 10.4407Z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path class="svg-stroke" d="M51.3513 36.7729C54.2695 36.7729 56.6352 34.4083 56.6352 31.4913C56.6352 28.5744 54.2695 26.2097 51.3513 26.2097C48.4331 26.2097 46.0674 28.5744 46.0674 31.4913C46.0674 34.4083 48.4331 36.7729 51.3513 36.7729Z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path class="svg-stroke" d="M16.613 36.7729C19.5312 36.7729 21.8969 34.4083 21.8969 31.4913C21.8969 28.5744 19.5312 26.2097 16.613 26.2097C13.6948 26.2097 11.3291 28.5744 11.3291 31.4913C11.3291 34.4083 13.6948 36.7729 16.613 36.7729Z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_2362_2956">
                                            <rect width="65" height="37.7907" fill="white"/>
                                        </clipPath>
                                    </defs>
                                </svg>
                                <span class="delivery-item-label">Авто</span>
                            </div>
                            <span class="delivery-item-label delivery-item__time">22-30 дней</span>
                        </div>
                        <label class="img-boxing-checkbox-container">
                            <input type="checkbox">
                            <span class="img-boxing-checkmark">
                                <span class="img-boxing-checkmark-sign"></span>
                            </span>
                        </label>

                    </div>

                    <div class="type-of-goods-dimensions delivery-data">
                        <div class="type-of-goods-dropdown delivery-types-dropdown delivery-data" id="delivery-types-dropdown-auto" data-delivery_type="auto_regular" data-delivery_type_rus="Авто"></div>
                    </div>

                </div>
                <div class="desc">
                    <div class="delivery-item img-boxing-item-delivery-type">
                        <div class="delivery-item__header">
                            <div class="delivery-item__icon">
                                <svg width="65" height="38" viewBox="0 0 65 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_2252_28053)">
                                        <path class="svg-stroke" d="M7.51855 1.02075H41.6466C43.4702 1.02075 44.8561 2.65685 44.5585 4.45335L40.9989 25.9968" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path class="svg-stroke" d="M10.6434 31.4883L7.51855 31.4912" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path class="svg-stroke" d="M45.6234 31.4768L21.999 31.4856" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path class="svg-stroke" d="M45.0693 6.22949H55.4037C57.204 6.22949 58.8437 7.2619 59.6198 8.88341L63.3282 16.6352C63.7571 17.5335 63.9817 18.5192 63.9817 19.5137V27.2946C63.9817 29.5986 62.1144 31.468 59.8065 31.468H56.6263" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path class="svg-stroke" d="M54.9456 10.4407H47.4238V19.9365H57.5044C58.4964 19.9365 59.1704 18.9332 58.7969 18.0146L55.9901 11.1435C55.818 10.7177 55.4037 10.4407 54.9456 10.4407Z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path class="svg-stroke" d="M51.3513 36.7729C54.2695 36.7729 56.6352 34.4083 56.6352 31.4913C56.6352 28.5744 54.2695 26.2097 51.3513 26.2097C48.4331 26.2097 46.0674 28.5744 46.0674 31.4913C46.0674 34.4083 48.4331 36.7729 51.3513 36.7729Z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path class="svg-stroke" d="M16.613 36.7729C19.5312 36.7729 21.8969 34.4083 21.8969 31.4913C21.8969 28.5744 19.5312 26.2097 16.613 26.2097C13.6948 26.2097 11.3291 28.5744 11.3291 31.4913C11.3291 34.4083 13.6948 36.7729 16.613 36.7729Z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path class="svg-stroke" d="M4.94824 18.8604H13.6575" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path class="svg-stroke" d="M1.02148 12.5813H15.5661" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path class="svg-stroke" d="M5.23438 6.3374H17.7366" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_2252_28053">
                                            <rect width="65" height="37.7907" fill="white"/>
                                        </clipPath>
                                    </defs>
                                </svg>
                                <span class="delivery-item-label">Быстрое авто</span>
                            </div>
                            <span class="delivery-item-label delivery-item__time">15-20 дней</span>
                        </div>
                        <label class="img-boxing-checkbox-container">
                            <input type="checkbox">
                            <span class="img-boxing-checkmark">
                                <span class="img-boxing-checkmark-sign"></span>
                            </span>
                        </label>

                    </div>

                    <div class="type-of-goods-dimensions delivery-data">
                        <div class="type-of-goods-dropdown delivery-types-dropdown delivery-data" id="delivery-types-dropdown-fast-auto" data-delivery_type="auto_fast" data-delivery_type_rus="Быстрое авто"></div>
                    </div>

                </div>
                <div class="desc">
                    <div class="delivery-item img-boxing-item-delivery-type">
                        <div class="delivery-item__header">
                            <div class="delivery-item__icon">
                                <svg width="65" height="43" viewBox="0 0 65 43" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_2252_28056)">
                                        <path class="svg-stroke" d="M1.36035 1.35669L34.1441 1.42646V1.43033C45.5333 1.44971 63.6355 10.6628 63.6355 22.0193C63.6355 30.806 55.7875 31.8021 50.365 31.7943L1.36035 31.7052" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path class="svg-stroke" d="M4.8877 15.3952H41.1454C42.0588 15.3952 42.5136 14.2905 41.8645 13.6471L36.1854 8.06968C35.237 7.13559 33.9542 6.61621 32.6249 6.61621H7.24985" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path class="svg-stroke" d="M61.587 15.3951H57.7232C53.5135 15.3951 49.4437 13.8873 46.2563 11.1432L42.6724 8.05794C42.2915 7.72849 42.5247 7.10059 43.03 7.10059H52.2386" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path class="svg-stroke" d="M1.84668 27.0732H62.1472" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path class="svg-stroke" d="M54.0032 19.8797L54.8778 22.1355C55.3871 23.4417 56.697 24.3099 58.1663 24.3099H58.2946C59.2314 24.3099 59.8728 23.4107 59.5268 22.5851L58.8971 21.0812C58.314 19.6859 56.8952 18.7673 55.3093 18.7595H54.8312C54.217 18.7557 53.7895 19.3332 53.9994 19.8797H54.0032Z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path class="svg-stroke" d="M15.2687 31.3679C14.8178 33.5694 12.8626 35.2245 10.5226 35.2245C8.18254 35.2245 6.26231 33.5966 5.78809 31.4261" stroke-width="2" stroke-linejoin="round"/>
                                        <path class="svg-stroke" d="M27.9015 31.3679C27.4506 33.5694 25.4954 35.2245 23.1554 35.2245C20.8153 35.2245 18.8951 33.5966 18.4209 31.4261" stroke-width="2" stroke-linejoin="round"/>
                                        <path class="svg-stroke" d="M40.4181 31.3679C39.9672 33.5694 38.012 35.2245 35.672 35.2245C33.332 35.2245 31.4117 33.5966 30.9375 31.4261" stroke-width="2" stroke-linejoin="round"/>
                                        <path class="svg-stroke" d="M52.7863 31.3679C52.3354 33.5694 50.3802 35.2245 48.0401 35.2245C45.7001 35.2245 43.7799 33.5966 43.3057 31.4261" stroke-width="2" stroke-linejoin="round"/>
                                        <path class="svg-stroke" d="M39.8307 41.3252H4.17461C2.61977 41.3252 1.36035 40.0694 1.36035 38.5191C1.36035 36.9687 2.61977 35.7129 4.17461 35.7129H60.8212C62.3761 35.7129 63.6355 36.9687 63.6355 38.5191C63.6355 40.0694 62.3761 41.3252 60.8212 41.3252H54.8001" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_2252_28056">
                                            <rect width="65" height="42.6817" fill="white"/>
                                        </clipPath>
                                    </defs>
                                </svg>
                                <span class="delivery-item-label">Жд</span>
                            </div>
                            <span class="delivery-item-label delivery-item__time">35-50 дней</span>
                        </div>
                        <label class="img-boxing-checkbox-container">
                            <input type="checkbox">
                            <span class="img-boxing-checkmark">
                                <span class="img-boxing-checkmark-sign"></span>
                            </span>
                        </label>

                    </div>

                    <div class="type-of-goods-dimensions delivery-data">
                        <div class="type-of-goods-dropdown delivery-types-dropdown delivery-data" id="delivery-types-dropdown-railway" data-delivery_type="ZhD" data-delivery_type_rus="Жд"></div>
                    </div>

                </div>
                <div class="desc">
                    <div class="delivery-item img-boxing-item-delivery-type">
                        <div class="delivery-item__header">
                            <div class="delivery-item__icon">
                                <svg width="53" height="52" viewBox="0 0 53 52" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_2252_28060)">
                                        <path class="svg-stroke" d="M22.9967 12.1341L10.3994 3.11017L12.477 1.22363L38.6794 8.53225" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path class="svg-stroke" d="M41.3486 30.1293L50.0378 41.7275L51.9413 39.6725L44.493 14.3906" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path class="svg-stroke" d="M16.4715 38.3301C16.4715 38.3301 18.3581 36.8827 21.2639 34.5625C31.8818 26.0717 56.1106 5.86943 51.422 1.83947C45.4533 -3.29258 14.0879 35.9767 14.0879 35.9767L16.4687 38.3301H16.4715Z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path class="svg-stroke" d="M21.2643 35.0045L23.4625 40.5481L21.0144 42.9566L9.02637 31.1596L11.4745 28.751L17.5612 31.3363" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path class="svg-stroke" d="M47.0449 21.8983L47.5503 21.506C48.1988 20.9177 49.2123 20.9564 49.8131 21.5944C50.4111 22.2325 50.3718 23.2296 49.7233 23.8207L47.991 25.3482" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path class="svg-stroke" d="M48.8311 27.9584L48.9742 27.8286C49.6228 27.2402 50.6363 27.2789 51.2371 27.9169C51.8351 28.555 51.7958 29.5521 51.1472 30.1432L49.721 31.4387" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path class="svg-stroke" d="M26.5107 5.14042L28.7259 3.12958C29.3744 2.54125 30.3879 2.57992 30.9887 3.21797C31.5867 3.85602 31.5474 4.85316 30.8989 5.44425L30.3654 5.93039" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path class="svg-stroke" d="M20.374 3.34226L22.3393 1.38666C22.9878 0.798327 24.0013 0.836997 24.6021 1.47505C25.2001 2.1131 25.1608 3.11024 24.5123 3.70133L23.9676 4.19576" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path class="svg-stroke" d="M0.982422 12.6838L7.84395 5.93311" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path class="svg-stroke" d="M40.5127 51.0334L47.3742 44.2827" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path class="svg-stroke" d="M6.81641 13.3549L10.9294 9.30835" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path class="svg-stroke" d="M39.8018 45.2548L43.9147 41.2083" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path class="svg-stroke" d="M12.2383 14.6725L15.043 11.9131" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path class="svg-stroke" d="M38.6787 39.7086L41.4862 36.9492" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_2252_28060">
                                            <rect width="53" height="52" fill="white"/>
                                        </clipPath>
                                    </defs>
                                </svg>
                                <span class="delivery-item-label">Авиа</span>
                            </div>
                            <span class="delivery-item-label delivery-item__time">5-15 дней</span>
                        </div>
                        <label class="img-boxing-checkbox-container">
                            <input type="checkbox">
                            <span class="img-boxing-checkmark">
                                <span class="img-boxing-checkmark-sign"></span>
                            </span>
                        </label>

                    </div>
                    <div class="type-of-goods-dimensions delivery-data">
                        <div class="type-of-goods-dropdown delivery-types-dropdown delivery-data" id="delivery-types-dropdown-avia" data-delivery_type="avia" data-delivery_type_rus="Авиа"></div>
                    </div>
                </div>
            </div>
            <div class="report-button-container">
                <button class="report-white-data offer-button main-offer-button report-cargo-data" href="" disabled>ПОЛУЧИТЬ РАСЧЕТ В PDF</button>
            </div>
        </div>
    </form>
</div>

<div class="tnved-tree-container"></div>
<div class="overlay"></div>


<?\Bitrix\Main\Page\Asset::getInstance()->addJs('/calc-layout/js/builder.js?v='.filemtime($_SERVER['DOCUMENT_ROOT'].'/calc-layout/js/builder.js'));?>
<?\Bitrix\Main\Page\Asset::getInstance()->addJs('/calc-layout/js/get_exchange_rate.js?v='.filemtime($_SERVER['DOCUMENT_ROOT'].'/calc-layout/js/get_exchange_rate.js'));?>

<!--<script src="/calc-layout/js/suggestView.js?v=--><?php //= filemtime($_SERVER['DOCUMENT_ROOT'].'/calc-layout/js/builder.js')?><!--"></script>-->
<!--<script src="/calc-layout/js/checkbox.js?v=--><?php //= filemtime($_SERVER['DOCUMENT_ROOT'].'/calc-layout/js/get_exchange_rate.js')?><!--" ></script>-->
<!--<script src="/calc-layout/js/suggestView.js?v=--><?php //= filemtime($_SERVER['DOCUMENT_ROOT'].'/calc-layout/js/suggestView.js')?><!--"></script>-->
<!--<script src="/calc-layout/js/checkbox.js?v=--><?php //= filemtime($_SERVER['DOCUMENT_ROOT'].'/calc-layout/js/checkbox.js')?><!--" ></script>-->
<!--<script src="/calc-layout/js/currency.js?v=--><?php //= filemtime($_SERVER['DOCUMENT_ROOT'].'/calc-layout/js/currency.js')?><!--"></script>-->
<!--<script src="/calc-layout/js/count_goods.js?v=--><?php //= filemtime($_SERVER['DOCUMENT_ROOT'].'/calc-layout/js/count_goods.js')?><!--"></script>-->
<!--<script src="/calc-layout/js/type_of_goods.js?v=--><?php //= filemtime($_SERVER['DOCUMENT_ROOT'].'/calc-layout/js/type_of_goods.js')?><!--"></script>-->
<!--<script src="/calc-layout/js/add_goods.js?v=--><?php //= filemtime($_SERVER['DOCUMENT_ROOT'].'/calc-layout/js/add_goods.js')?><!--"></script>-->
<!--<script src="/calc-layout/js/spoiler.js?v=--><?php //= filemtime($_SERVER['DOCUMENT_ROOT'].'/calc-layout/js/spoiler.js')?><!--"></script>-->
<!--<script src="/calc-layout/js/boxing_img.js?v=--><?php //= filemtime($_SERVER['DOCUMENT_ROOT'].'/calc-layout/js/boxing_img.js')?><!--"></script>-->
<!--<script src="/calc-layout/js/input_photo.js?v=--><?php //= filemtime($_SERVER['DOCUMENT_ROOT'].'/calc-layout/js/input_photo.js')?><!--"></script>-->
<!--<script src="/calc-layout/js/add_redeems.js?v=--><?php //= filemtime($_SERVER['DOCUMENT_ROOT'].'/calc-layout/js/add_redeems.js')?><!--"></script>-->
<!--<script src="/calc-layout/js/submit_redeem_data.js?v=--><?php //= filemtime($_SERVER['DOCUMENT_ROOT'].'/calc-layout/js/submit_redeem_data.js')?><!--"></script>-->
<!--<script src="/calc-layout/js/redeem_checkbox.js?v=--><?php //= filemtime($_SERVER['DOCUMENT_ROOT'].'/calc-layout/js/redeem_checkbox.js')?><!--"></script>-->
<!--<script src="/calc-layout/js/delivery_choice.js?v=--><?php //= filemtime($_SERVER['DOCUMENT_ROOT'].'/calc-layout/js/delivery_choice.js')?><!--"></script>-->
<!--<script src="/calc-layout/js/change_delivery_list.js?v=--><?php //= filemtime($_SERVER['DOCUMENT_ROOT'].'/calc-layout/js/change_delivery_list.js')?><!--"></script>-->
<!--<script src="/calc-layout/js/balloon_help_position.js?v=--><?php //= filemtime($_SERVER['DOCUMENT_ROOT'].'/calc-layout/js/balloon_help_position.js')?><!--"></script>-->
<!--<script src="/calc-layout/js/select_calc_type.js?v=--><?php //= filemtime($_SERVER['DOCUMENT_ROOT'].'/calc-layout/js/select_calc_type.js')?><!--"></script>-->
<!--<script src="/calc-layout/js/white_calc_space.js?v=--><?php //= filemtime($_SERVER['DOCUMENT_ROOT'].'/calc-layout/js/white_calc_space.js')?><!--"></script>-->
<!--<script src="/calc-layout/js/add_tnved_code.js?v=--><?php //= filemtime($_SERVER['DOCUMENT_ROOT'].'/calc-layout/js/add_tnved_code.js')?><!--"></script>-->
<!--<script src="/calc-layout/js/suggestion.js?v=--><?php //= filemtime($_SERVER['DOCUMENT_ROOT'].'/calc-layout/js/suggestion.js')?><!--"></script>-->
<!--<script src="/calc-layout/js/tnved-tree-handling.js?v=--><?php //= filemtime($_SERVER['DOCUMENT_ROOT'].'/calc-layout/js/tnved-tree-handling.js')?><!--"></script>-->
<!--<script src="/calc-layout/js/popup_tnved_tree.js?v=--><?php //= filemtime($_SERVER['DOCUMENT_ROOT'].'/calc-layout/js/popup_tnved_tree.js')?><!--"></script>-->
<!--<script src="/calc-layout/js/ajax_request_general.js?v=--><?php //= filemtime($_SERVER['DOCUMENT_ROOT'].'/calc-layout/js/ajax_request_general.js')?><!--"></script>-->
<!--<script src="/calc-layout/js/ajax_request_tnved_calc.js?v=--><?php //= filemtime($_SERVER['DOCUMENT_ROOT'].'/calc-layout/js/ajax_request_tnved_calc.js')?><!--"></script>-->
<!--<script src="/calc-layout/js/ajax_request_cargo_from_white.js?v=--><?php //= filemtime($_SERVER['DOCUMENT_ROOT'].'/calc-layout/js/ajax_request_cargo_from_white.js')?><!--"></script>-->
<!--<script src="/calc-layout/js/ajax_request_get_order_data.js?v=--><?php //= filemtime($_SERVER['DOCUMENT_ROOT'].'/calc-layout/js/ajax_request_get_order_data.js')?><!--"></script>-->
<!--<script src="/calc-layout/js/report_white_data.js?v=--><?php //= filemtime($_SERVER['DOCUMENT_ROOT'].'/calc-layout/js/report_white_data.js')?><!--"></script>-->
<!--<script src="/calc-layout/js/calc_volume.js?v=--><?php //= filemtime($_SERVER['DOCUMENT_ROOT'].'/calc-layout/js/calc_volume.js')?><!--"></script>-->
<!--<script src="/calc-layout/js/select_delivery_item.js?v=--><?php //= filemtime($_SERVER['DOCUMENT_ROOT'].'/calc-layout/js/select_delivery_item.js')?><!--"></script>-->
<!--<script src="/calc-layout/js/input_excel.js?v=--><?php //= filemtime($_SERVER['DOCUMENT_ROOT'].'/calc-layout/js/input_excel.js')?><!--"></script>-->
<!--<script src="/calc-layout/js/send_data_between_calc_types.js?v=--><?php //= filemtime($_SERVER['DOCUMENT_ROOT'].'/calc-layout/js/send_data_between_calc_types.js')?><!--"></script>-->
<!--<script src="/calc-layout/js/available_countries.js?v=--><?php //= filemtime($_SERVER['DOCUMENT_ROOT'].'/calc-layout/js/available_countries.js')?><!--"></script>-->

<? \Bitrix\Main\Page\Asset::getInstance()->addJs('/calc-layout/js/suggestView.js?v='.filemtime($_SERVER['DOCUMENT_ROOT'].'/calc-layout/js/suggestView.js')); ?>
<? \Bitrix\Main\Page\Asset::getInstance()->addJs('/calc-layout/js/checkbox.js?v='.filemtime($_SERVER['DOCUMENT_ROOT'].'/calc-layout/js/checkbox.js')); ?>
<? \Bitrix\Main\Page\Asset::getInstance()->addJs('/calc-layout/js/currency.js?v='.filemtime($_SERVER['DOCUMENT_ROOT'].'/calc-layout/js/currency.js')); ?>
<? \Bitrix\Main\Page\Asset::getInstance()->addJs('/calc-layout/js/count_goods.js?v='.filemtime($_SERVER['DOCUMENT_ROOT'].'/calc-layout/js/count_goods.js')); ?>
<? \Bitrix\Main\Page\Asset::getInstance()->addJs('/calc-layout/js/type_of_goods.js?v='.filemtime($_SERVER['DOCUMENT_ROOT'].'/calc-layout/js/type_of_goods.js')); ?>
<? \Bitrix\Main\Page\Asset::getInstance()->addJs('/calc-layout/js/add_goods.js?v='.filemtime($_SERVER['DOCUMENT_ROOT'].'/calc-layout/js/add_goods.js')); ?>
<? \Bitrix\Main\Page\Asset::getInstance()->addJs('/calc-layout/js/spoiler.js?v='.filemtime($_SERVER['DOCUMENT_ROOT'].'/calc-layout/js/spoiler.js')); ?>
<? \Bitrix\Main\Page\Asset::getInstance()->addJs('/calc-layout/js/boxing_img.js?v='.filemtime($_SERVER['DOCUMENT_ROOT'].'/calc-layout/js/boxing_img.js')); ?>
<? \Bitrix\Main\Page\Asset::getInstance()->addJs('/calc-layout/js/input_photo.js?v='.filemtime($_SERVER['DOCUMENT_ROOT'].'/calc-layout/js/input_photo.js')); ?>
<? \Bitrix\Main\Page\Asset::getInstance()->addJs('/calc-layout/js/add_redeems.js?v='.filemtime($_SERVER['DOCUMENT_ROOT'].'/calc-layout/js/add_redeems.js')); ?>
<? \Bitrix\Main\Page\Asset::getInstance()->addJs('/calc-layout/js/submit_redeem_data.js?v='.filemtime($_SERVER['DOCUMENT_ROOT'].'/calc-layout/js/submit_redeem_data.js')); ?>
<? \Bitrix\Main\Page\Asset::getInstance()->addJs('/calc-layout/js/redeem_checkbox.js?v='.filemtime($_SERVER['DOCUMENT_ROOT'].'/calc-layout/js/redeem_checkbox.js')); ?>
<? \Bitrix\Main\Page\Asset::getInstance()->addJs('/calc-layout/js/delivery_choice.js?v='.filemtime($_SERVER['DOCUMENT_ROOT'].'/calc-layout/js/delivery_choice.js')); ?>
<? \Bitrix\Main\Page\Asset::getInstance()->addJs('/calc-layout/js/change_delivery_list.js?v='.filemtime($_SERVER['DOCUMENT_ROOT'].'/calc-layout/js/change_delivery_list.js')); ?>
<? \Bitrix\Main\Page\Asset::getInstance()->addJs('/calc-layout/js/balloon_help_position.js?v='.filemtime($_SERVER['DOCUMENT_ROOT'].'/calc-layout/js/balloon_help_position.js')); ?>
<? \Bitrix\Main\Page\Asset::getInstance()->addJs('/calc-layout/js/select_calc_type.js?v='.filemtime($_SERVER['DOCUMENT_ROOT'].'/calc-layout/js/select_calc_type.js')); ?>
<? \Bitrix\Main\Page\Asset::getInstance()->addJs('/calc-layout/js/white_calc_space.js?v='.filemtime($_SERVER['DOCUMENT_ROOT'].'/calc-layout/js/white_calc_space.js')); ?>
<? \Bitrix\Main\Page\Asset::getInstance()->addJs('/calc-layout/js/add_tnved_code.js?v='.filemtime($_SERVER['DOCUMENT_ROOT'].'/calc-layout/js/add_tnved_code.js')); ?>
<? \Bitrix\Main\Page\Asset::getInstance()->addJs('/calc-layout/js/suggestion.js?v='.filemtime($_SERVER['DOCUMENT_ROOT'].'/calc-layout/js/suggestion.js')); ?>
<? \Bitrix\Main\Page\Asset::getInstance()->addJs('/calc-layout/js/tnved-tree-handling.js?v='.filemtime($_SERVER['DOCUMENT_ROOT'].'/calc-layout/js/tnved-tree-handling.js')); ?>
<? \Bitrix\Main\Page\Asset::getInstance()->addJs('/calc-layout/js/popup_tnved_tree.js?v='.filemtime($_SERVER['DOCUMENT_ROOT'].'/calc-layout/js/popup_tnved_tree.js')); ?>
<? \Bitrix\Main\Page\Asset::getInstance()->addJs('/calc-layout/js/ajax_request_general.js?v='.filemtime($_SERVER['DOCUMENT_ROOT'].'/calc-layout/js/ajax_request_general.js')); ?>
<? \Bitrix\Main\Page\Asset::getInstance()->addJs('/calc-layout/js/ajax_request_tnved_calc.js?v='.filemtime($_SERVER['DOCUMENT_ROOT'].'/calc-layout/js/ajax_request_tnved_calc.js')); ?>
<? \Bitrix\Main\Page\Asset::getInstance()->addJs('/calc-layout/js/ajax_request_cargo_from_white.js?v='.filemtime($_SERVER['DOCUMENT_ROOT'].'/calc-layout/js/ajax_request_cargo_from_white.js')); ?>
<? \Bitrix\Main\Page\Asset::getInstance()->addJs('/calc-layout/js/ajax_request_get_order_data.js?v='.filemtime($_SERVER['DOCUMENT_ROOT'].'/calc-layout/js/ajax_request_get_order_data.js')); ?>
<? \Bitrix\Main\Page\Asset::getInstance()->addJs('/calc-layout/js/report_white_data.js?v='.filemtime($_SERVER['DOCUMENT_ROOT'].'/calc-layout/js/report_white_data.js')); ?>
<? \Bitrix\Main\Page\Asset::getInstance()->addJs('/calc-layout/js/calc_volume.js?v='.filemtime($_SERVER['DOCUMENT_ROOT'].'/calc-layout/js/calc_volume.js')); ?>
<? \Bitrix\Main\Page\Asset::getInstance()->addJs('/calc-layout/js/select_delivery_item.js?v='.filemtime($_SERVER['DOCUMENT_ROOT'].'/calc-layout/js/select_delivery_item.js')); ?>
<? \Bitrix\Main\Page\Asset::getInstance()->addJs('/calc-layout/js/input_excel.js?v='.filemtime($_SERVER['DOCUMENT_ROOT'].'/calc-layout/js/input_excel.js')); ?>
<? \Bitrix\Main\Page\Asset::getInstance()->addJs('/calc-layout/js/send_data_between_calc_types.js?v='.filemtime($_SERVER['DOCUMENT_ROOT'].'/calc-layout/js/send_data_between_calc_types.js')); ?>
<? \Bitrix\Main\Page\Asset::getInstance()->addJs('/calc-layout/js/available_countries.js?v='.filemtime($_SERVER['DOCUMENT_ROOT'].'/calc-layout/js/available_countries.js')); ?>
<? \Bitrix\Main\Page\Asset::getInstance()->addJs('/calc-layout/js/check-window-popup.js?v='.filemtime($_SERVER['DOCUMENT_ROOT'].'/calc-layout/js/check-window-popup.js')); ?>
