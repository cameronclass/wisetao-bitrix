<h4 class="main-calc__title _small label-text">
    <span class="main-calc__title_icon"></span>
    <span class="main-calc__title_text label-text">Параметры груза</span>
</h4>

<!--Параметры Груза-->
<div class="main-calc-parametr">
    <label class="switch-btn">
        <input name="checkbox_input_type" class="switch-btn__input" id="checkbox_input_type" checked type="checkbox">
        <span class="switch-btn__block"></span>
        <span class="switch-btn__text _first" id="text1">Общий вес и объем</span>
        <span class="switch-btn__text _second" id="text2">По габаритам</span>
    </label>
    <label class="switch-btn hidden">
        <input name="checkbox_input_type2" class="switch-btn__input" id="checkbox_input_type2" checked type="checkbox">
        <span class="switch-btn__block may-disable"></span>
        <span class="switch-btn__text _first" id="text3">Грузовые места</span>
        <span class="switch-btn__text _second" id="text4">Товары</span>
    </label>
    <label class="main-calc-checkbox main-calc-checkbox__form-2 dim-checkbox" id="dim-brand">
        <input type="checkbox" name="dim-brand" class="main-calc-checkbox__input">
        <span class="main-calc-checkbox__mark"></span>
        <span class="main-calc-checkbox__title">Бренд</span>
        <span class="calc-tooltip">
            <span class="calc-tooltip__text">
                Любые товары известных брендов
            </span>
        </span>
    </label>
</div>

<!--  Общий вес и Объем  -->
<div class="order-data-general">
    <div class="main-calc-parametr__main">

        <div class="group-input">
            <div class="group-input__title">Общий объём</div>
            <div class="group-input__input">
                <input class="js-validate-num" type="text" required value="0.1" name="total-volume">
                <span class="group-input__param">м³</span>
                <div class="input-notice"></div>
            </div>
        </div>

        <div class="group-input">
            <div class="group-input__title">Общий вес</div>
            <div class="group-input__input">
                <input class="js-validate-num" type="text" required name="total-weight">
                <span class="group-input__param">кг</span>
                <div class="input-notice"></div>
            </div>
        </div>

        <div class="group-input">
            <div class="group-input__title">Макс. габарит</div>
            <div class="group-input__input">
                <input class="js-validate-num" type="text" name="max-dimension">
                <span class="group-input__param">м</span>
                <div class="input-notice"></div>
            </div>
        </div>

        <div class="group-input">
            <div class="group-input__title">Кол-во мест</div>
            <div class="group-input-increment">
                <span class="group-input-increment__minus">-</span>
                <input class="js-validate-num" type="number" value="1" id="quantity" name="count" required>
                <span class="group-input-increment__plus">+</span>
                <div class="input-notice"></div>
            </div>
        </div>

        <div class="group-input">
            <div class="group-input__title">Общая стоимость</div>
            <div class="group-input__input">
                <input class="js-validate-num" type="number" id="currency" name="total-cost">
                <div class="dropdown">
                    <div class="dropdown-toggle currency-toggle" data-currency="CNY">
                        ¥
                        <svg class="dropdown-list-currency-arrow" xmlns="http://www.w3.org/2000/svg"
                             xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="32.38141722065728"
                             height="22.59489123485507"
                             viewBox="110.22394056737565 250.64901537709036 32.38141722065728 22.59489123485507"
                             xml:space="preserve">
                                            <desc>Created with Fabric.js 5.3.0</desc>
                            <g transform="matrix(0 0.979842546 0.979842546 0 126.4146491777 261.9464609945)"
                               id="DLgAgrXuFMXOEYFpJSRZM">
                                <path class="svg-arrow"
                                      style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-dashoffset: 0; stroke-linejoin: miter; stroke-miterlimit: 4; fill-rule: nonzero; opacity: 1;"
                                      transform=" translate(0, 0)"
                                      d="M 8.536 -3.5215 L -3.183 -14.8535 C -3.9269999999999996 -15.5975 -4.931 -16.0135 -5.999 -16.0135 C -7.068 -16.0135 -8.072 -15.5975 -8.827 -14.8415 C -9.583 -14.0855 -9.999 -13.0815 -9.999 -12.0135 C -9.999 -10.945500000000001 -9.583 -9.9405 -8.827 -9.185500000000001 L -0.29100000000000037 -0.6915000000000013 C -0.10300000000000037 -0.5035000000000014 -3.885780586188048e-16 -0.25350000000000134 -3.885780586188048e-16 0.013499999999998624 C -3.885780586188048e-16 0.28049999999999864 -0.10400000000000038 0.5314999999999986 -0.29300000000000037 0.7204999999999986 L -8.824000000000002 9.1815 C -9.583000000000002 9.9415 -9.999000000000002 10.9465 -9.999000000000002 12.0135 C -9.999000000000002 13.0805 -9.583000000000002 14.0855 -8.827000000000002 14.8415 C -8.072000000000001 15.5975 -7.067000000000002 16.0135 -5.999000000000002 16.0135 C -4.931000000000003 16.0135 -3.9260000000000024 15.5975 -3.170000000000002 14.8415 L -1.564000000000002 13.2355 L 8.519999999999998 3.5645000000000007 C 9.478999999999997 2.6055000000000006 9.998999999999999 1.3495000000000008 9.998999999999999 0.013500000000000512 C 9.998999999999999 -1.3224999999999996 9.479 -2.5774999999999997 8.535999999999998 -3.5214999999999996 z"
                                      stroke-linecap="round"/>
                            </g>
                                        </svg>
                    </div>
                    <ul class="dropdown-list">
                        <li><span class="currency-sign" data-currency="USD">$</span></li>
                        <li><span class="currency-sign" data-currency="RU">₽</span></li>
                        <li><span class="currency-sign" data-currency="CNY">¥</span></li>
                    </ul>
                </div>
                <div class="input-notice"></div>
            </div>
        </div>

        <div class="group-input">
            <div class="group-input__title">Категория груза</div>
            <div class="group-input__input">
                <div class="type-of-goods-dropdown">
                    <div class="type-of-goods-dropdown-toggle" id="type-of-goods">
                        Xiaobaihuo (小百)
                        <div class="help type-of-goods-dropdown-toggle-help">
                            <div class="circle-help">
                                ?
                            </div>
                            <span class="calc-tooltip">
                                <span class="calc-tooltip__title">Xiaobaihuo (小百)</span>
                                <span class="calc-tooltip__text">
                                    Товары повседневного спроса (продукты питания (кроме деликатесных товаров), средства личной гигиены,
                                    косметика, хоз-товары)
                                </span>
                            </span>
                        </div>
                        <svg class="dropdown-list-goods-arrow" xmlns="http://www.w3.org/2000/svg"
                             xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="32.38141722065728"
                             height="22.59489123485507"
                             viewBox="110.22394056737565 250.64901537709036 32.38141722065728 22.59489123485507"
                             xml:space="preserve">
            <desc>Created with Fabric.js 5.3.0</desc>
                            <g transform="matrix(0 0.979842546 0.979842546 0 126.4146491777 261.9464609945)"
                               id="DLgAgrXuFMXOEYFpJSRZM">
                                <path class="svg-arrow"
                                      style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-dashoffset: 0; stroke-linejoin: miter; stroke-miterlimit: 4; fill-rule: nonzero; opacity: 1;"
                                      transform=" translate(0, 0)"
                                      d="M 8.536 -3.5215 L -3.183 -14.8535 C -3.9269999999999996 -15.5975 -4.931 -16.0135 -5.999 -16.0135 C -7.068 -16.0135 -8.072 -15.5975 -8.827 -14.8415 C -9.583 -14.0855 -9.999 -13.0815 -9.999 -12.0135 C -9.999 -10.945500000000001 -9.583 -9.9405 -8.827 -9.185500000000001 L -0.29100000000000037 -0.6915000000000013 C -0.10300000000000037 -0.5035000000000014 -3.885780586188048e-16 -0.25350000000000134 -3.885780586188048e-16 0.013499999999998624 C -3.885780586188048e-16 0.28049999999999864 -0.10400000000000038 0.5314999999999986 -0.29300000000000037 0.7204999999999986 L -8.824000000000002 9.1815 C -9.583000000000002 9.9415 -9.999000000000002 10.9465 -9.999000000000002 12.0135 C -9.999000000000002 13.0805 -9.583000000000002 14.0855 -8.827000000000002 14.8415 C -8.072000000000001 15.5975 -7.067000000000002 16.0135 -5.999000000000002 16.0135 C -4.931000000000003 16.0135 -3.9260000000000024 15.5975 -3.170000000000002 14.8415 L -1.564000000000002 13.2355 L 8.519999999999998 3.5645000000000007 C 9.478999999999997 2.6055000000000006 9.998999999999999 1.3495000000000008 9.998999999999999 0.013500000000000512 C 9.998999999999999 -1.3224999999999996 9.479 -2.5774999999999997 8.535999999999998 -3.5214999999999996 z"
                                      stroke-linecap="round"/>
                            </g>
            </svg>
                    </div>
                    <ul class="type-of-goods-dropdown-list">
                        <li>
                            <span class="type-of-goods-values">Xiaobaihuo (小百)</span>
                            <div class="help xiaobaihuo-help">
                                <div class="circle-help">
                                    ?
                                </div>
                                <span class="calc-tooltip">
                                    <span class="calc-tooltip__title">Xiaobaihuo (小百)</span>
                                    <span class="calc-tooltip__text">
                                        Товары повседневного спроса (продукты питания (кроме деликатесных товаров), средства личной гигиены,
                                        косметика, хоз-товары)
                                    </span>
                                </span>
                            </div>
                        </li>
                        <li>
                            <span class="type-of-goods-values">Dabaihuo (大百)</span>
                            <div class="help dabaihuo-help">
                                <div class="circle-help">
                                    ?
                                </div>
                                <span class="calc-tooltip">
                                    <span class="calc-tooltip__title">Dabaihuo (大百)</span>
                                    <span class="calc-tooltip__text">
                                        тов. не повседневного спроса (электроника, одежда (кроме штанов и т.п., [рубашек, кофт, курток и т.п],
                                        обуви) и другие товары долгосрочного пользования)
                                    </span>
                                </span>
                            </div>
                        </li>
                        <li>
                            <span class="type-of-goods-values">Одежда</span>
                            <div class="help cloth-help">
                                <div class="circle-help">
                                    ?
                                </div>
                                <span class="calc-tooltip">
                                    <span class="calc-tooltip__title">Одежда</span>
                                    <span class="calc-tooltip__text">
                                        Одежда (штаны и т.п., [рубашки, футболки, кофты, куртки и т.п, платья, юбки и т.п], обувь)
                                    </span>
                                </span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <label class="main-calc-checkbox main-calc-checkbox__form">
            <input type="checkbox" name="brand-good" value="brand" class="main-calc-checkbox__input">
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

<!--  По габаритам  -->
<div class="main-calc-bordered order-data-dimensions first" data-container="1">
    <div class="close-cross">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
             width="29.5558703725" height="29.5558703725"
             viewBox="154.70573108694998 97.92453478204999 29.5558703725 29.5558703725" xml:space="preserve">
                <g transform="matrix(1 0 0 1 169.4836662732 112.7024699683)" id="k3KNRoqNc6poTgMk0-mS0">
                    <g style="">
                        <g transform="matrix(0.5361434886 0 0 0.5361434886 0 0)" id="TtVKn0Vpwc73qYTht60LM">
                            <path class="cross-border"
                                  style="stroke: rgb(179,25,24); stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-dashoffset: 0; stroke-linejoin: miter; stroke-miterlimit: 4; fill-rule: nonzero; opacity: 1;"
                                  transform=" translate(0, 0)"
                                  d="M 0 -27.5634 C 15.21499 -27.5634 27.5634 -15.215000000000002 27.5634 0 C 27.5634 15.21499 15.215000000000002 27.5634 0 27.5634 C -15.21499 27.5634 -27.5634 15.215000000000002 -27.5634 0 C -27.5634 -15.21499 -15.215000000000002 -27.5634 0 -27.5634 z"
                                  stroke-linecap="round"/>
                        </g>
                        <g transform="matrix(0.4501312202 0 0 0.4501312202 0 0)" id="UNUcbtI9Ts4pakmCW0QUX">
                            <path class="cross-back"
                                  style="stroke: rgb(179,25,24); stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-dashoffset: 0; stroke-linejoin: miter; stroke-miterlimit: 4; fill-rule: nonzero; opacity: 1;"
                                  transform=" translate(0, 0)"
                                  d="M 0 -27.5634 C 15.21499 -27.5634 27.5634 -15.215000000000002 27.5634 0 C 27.5634 15.21499 15.215000000000002 27.5634 0 27.5634 C -15.21499 27.5634 -27.5634 15.215000000000002 -27.5634 0 C -27.5634 -15.21499 -15.215000000000002 -27.5634 0 -27.5634 z"
                                  stroke-linecap="round"/>
                        </g>
                        <g transform="matrix(0.4487730328 0 0 0.4487730328 0 0)" id="_16PNKPtF4U3-sJUah521">
                            <path class="cross-path"
                                  style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-dashoffset: 0; stroke-linejoin: miter; stroke-miterlimit: 4; fill-rule: nonzero; opacity: 1;"
                                  transform=" translate(0, 0)"
                                  d="M 14.14294 -14.1405 C 12.58094 -15.702499999999999 10.045939999999998 -15.702499999999999 8.484939999999998 -14.1405 L -0.00006000000000128125 -5.656499999999999 L -8.484060000000001 -14.1395 C -10.04606 -15.7015 -12.580060000000001 -15.7015 -14.14206 -14.1395 C -15.70406 -12.5775 -15.70406 -10.0435 -14.14206 -8.4835 L -5.657060000000001 0.0005000000000006111 L -14.14206 8.4845 C -15.70406 10.0465 -15.70406 12.5805 -14.14206 14.1405 C -12.580060000000001 15.702499999999999 -10.04606 15.702499999999999 -8.48406 14.1405 L -0.000059999999999504894 5.657499999999999 L 8.48394 14.1405 C 10.04594 15.702499999999999 12.57994 15.702499999999999 14.141940000000002 14.1405 C 15.703940000000001 12.5785 15.703940000000001 10.043499999999998 14.141940000000002 8.4845 L 5.656940000000002 0.0005000000000006111 L 14.141940000000002 -8.4835 C 15.703940000000001 -10.0465 15.703940000000001 -12.5795 14.142940000000001 -14.1405 z"
                                  stroke-linecap="round"/>
                        </g>
                    </g>
                </g>
            </svg>
    </div>
    <div class="dimensions-data">
        <div class="main-calc-parametr__secondary_block dimensions-input-group">

                <div class="group-input group-input-dimensions">
                    <div class="group-input__title">Габариты (ДxШxВ), см</div>
                    <div class="group-input-dimensions__block">
                        <input type="text" required class="dimensions-input dimensions-calc-input length" placeholder="см">
                        <div class="cross">✖</div>
                        <input type="text" required class="dimensions-input dimensions-calc-input width" placeholder="см">
                        <div class="cross">✖</div>
                        <input type="text" required class="dimensions-input dimensions-calc-input height" placeholder="см">
                        <!-- Знак "=", "0" и "м³" также в одной линии с полями ввода -->
                        <span class="equals">=</span>
                        <div>
                            <span class="result">0</span>
                            <span class="m3">м³</span>
                        </div>
                        <div class="input-notice"></div>
                    </div>
                </div>

                <div class="group-input">
                    <div class="group-input__title">Кол-во мест</div>
                    <div class="group-input-increment">
                        <span class="group-input-increment__minus">-</span>
                        <input class="js-validate-num quantity" type="number" value="1" id="quantity1" required>
                        <span class="group-input-increment__plus">+</span>
                        <div class="input-notice"></div>
                    </div>
                </div>

                <div class="group-input">
                    <div class="group-input__title">Вес</div>
                    <div class="group-input__input">
                        <input class="js-validate-num weight" id="custom-input3" type="text" required>
                        <span class="group-input__param">кг</span>
                        <div class="input-notice"></div>
                    </div>
                </div>

                <div class="group-input">
                    <div class="group-input__title">Стоимость</div>
                    <div class="group-input__input">
                        <input class="js-validate-num currency_for_dimensions dimensions-calc-input" type="number" id="currency_for_dimensions" required>
                        <div class="dropdown">
                            <div class="dropdown-toggle currency-toggle" data-currency="CNY">
                                ¥
                                <svg class="dropdown-list-currency-arrow" xmlns="http://www.w3.org/2000/svg"
                                     xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="32.38141722065728"
                                     height="22.59489123485507"
                                     viewBox="110.22394056737565 250.64901537709036 32.38141722065728 22.59489123485507"
                                     xml:space="preserve">
                                                <desc>Created with Fabric.js 5.3.0</desc>
                                    <g transform="matrix(0 0.979842546 0.979842546 0 126.4146491777 261.9464609945)"
                                       id="DLgAgrXuFMXOEYFpJSRZM">
                                        <path class="svg-arrow"
                                              style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-dashoffset: 0; stroke-linejoin: miter; stroke-miterlimit: 4; fill-rule: nonzero; opacity: 1;"
                                              transform=" translate(0, 0)"
                                              d="M 8.536 -3.5215 L -3.183 -14.8535 C -3.9269999999999996 -15.5975 -4.931 -16.0135 -5.999 -16.0135 C -7.068 -16.0135 -8.072 -15.5975 -8.827 -14.8415 C -9.583 -14.0855 -9.999 -13.0815 -9.999 -12.0135 C -9.999 -10.945500000000001 -9.583 -9.9405 -8.827 -9.185500000000001 L -0.29100000000000037 -0.6915000000000013 C -0.10300000000000037 -0.5035000000000014 -3.885780586188048e-16 -0.25350000000000134 -3.885780586188048e-16 0.013499999999998624 C -3.885780586188048e-16 0.28049999999999864 -0.10400000000000038 0.5314999999999986 -0.29300000000000037 0.7204999999999986 L -8.824000000000002 9.1815 C -9.583000000000002 9.9415 -9.999000000000002 10.9465 -9.999000000000002 12.0135 C -9.999000000000002 13.0805 -9.583000000000002 14.0855 -8.827000000000002 14.8415 C -8.072000000000001 15.5975 -7.067000000000002 16.0135 -5.999000000000002 16.0135 C -4.931000000000003 16.0135 -3.9260000000000024 15.5975 -3.170000000000002 14.8415 L -1.564000000000002 13.2355 L 8.519999999999998 3.5645000000000007 C 9.478999999999997 2.6055000000000006 9.998999999999999 1.3495000000000008 9.998999999999999 0.013500000000000512 C 9.998999999999999 -1.3224999999999996 9.479 -2.5774999999999997 8.535999999999998 -3.5214999999999996 z"
                                              stroke-linecap="round"/>
                                    </g>
                                            </svg>
                            </div>
                            <ul class="dropdown-list">
                                <li><span class="currency-sign" data-currency="USD">$</span></li>
                                <li><span class="currency-sign" data-currency="RU">₽</span></li>
                                <li><span class="currency-sign" data-currency="CNY">¥</span></li>
                            </ul>
                        </div>
                        <div class="input-notice"></div>
                    </div>
                </div>

                <div class="group-input">
                    <div class="group-input__title">Категория груза</div>
                    <div class="group-input__input">
                        <div class="type-of-goods-dropdown">
                            <div class="type-of-goods-dropdown-toggle dimensions">
                                Xiaobaihuo (小百)
                                <div class="help type-of-goods-dropdown-toggle-help">
                                    <div class="circle-help">
                                        ?
                                    </div>
                                    <span class="calc-tooltip">
                                <span class="calc-tooltip__title">Xiaobaihuo (小百)</span>
                                <span class="calc-tooltip__text">
                                    Товары повседневного спроса (продукты питания (кроме деликатесных товаров), средства личной гигиены,
                                    косметика, хоз-товары)
                                </span>
                            </span>
                                </div>
                                <svg class="dropdown-list-goods-arrow" xmlns="http://www.w3.org/2000/svg"
                                     xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="32.38141722065728"
                                     height="22.59489123485507"
                                     viewBox="110.22394056737565 250.64901537709036 32.38141722065728 22.59489123485507"
                                     xml:space="preserve">
            <desc>Created with Fabric.js 5.3.0</desc>
                                    <g transform="matrix(0 0.979842546 0.979842546 0 126.4146491777 261.9464609945)"
                                       id="DLgAgrXuFMXOEYFpJSRZM">
                                        <path class="svg-arrow"
                                              style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-dashoffset: 0; stroke-linejoin: miter; stroke-miterlimit: 4; fill-rule: nonzero; opacity: 1;"
                                              transform=" translate(0, 0)"
                                              d="M 8.536 -3.5215 L -3.183 -14.8535 C -3.9269999999999996 -15.5975 -4.931 -16.0135 -5.999 -16.0135 C -7.068 -16.0135 -8.072 -15.5975 -8.827 -14.8415 C -9.583 -14.0855 -9.999 -13.0815 -9.999 -12.0135 C -9.999 -10.945500000000001 -9.583 -9.9405 -8.827 -9.185500000000001 L -0.29100000000000037 -0.6915000000000013 C -0.10300000000000037 -0.5035000000000014 -3.885780586188048e-16 -0.25350000000000134 -3.885780586188048e-16 0.013499999999998624 C -3.885780586188048e-16 0.28049999999999864 -0.10400000000000038 0.5314999999999986 -0.29300000000000037 0.7204999999999986 L -8.824000000000002 9.1815 C -9.583000000000002 9.9415 -9.999000000000002 10.9465 -9.999000000000002 12.0135 C -9.999000000000002 13.0805 -9.583000000000002 14.0855 -8.827000000000002 14.8415 C -8.072000000000001 15.5975 -7.067000000000002 16.0135 -5.999000000000002 16.0135 C -4.931000000000003 16.0135 -3.9260000000000024 15.5975 -3.170000000000002 14.8415 L -1.564000000000002 13.2355 L 8.519999999999998 3.5645000000000007 C 9.478999999999997 2.6055000000000006 9.998999999999999 1.3495000000000008 9.998999999999999 0.013500000000000512 C 9.998999999999999 -1.3224999999999996 9.479 -2.5774999999999997 8.535999999999998 -3.5214999999999996 z"
                                              stroke-linecap="round"/>
                                    </g>
            </svg>
                            </div>
                            <ul class="type-of-goods-dropdown-list">
                                <li>
                                    <span class="type-of-goods-values">Xiaobaihuo (小百)</span>
                                    <div class="help xiaobaihuo-help">
                                        <div class="circle-help">
                                            ?
                                        </div>
                                        <span class="calc-tooltip">
                                    <span class="calc-tooltip__title">Xiaobaihuo (小百)</span>
                                    <span class="calc-tooltip__text">
                                        Товары повседневного спроса (продукты питания (кроме деликатесных товаров), средства личной гигиены,
                                        косметика, хоз-товары)
                                    </span>
                                </span>
                                    </div>
                                </li>
                                <li>
                                    <span class="type-of-goods-values">Dabaihuo (大百)</span>
                                    <div class="help dabaihuo-help">
                                        <div class="circle-help">
                                            ?
                                        </div>
                                        <span class="calc-tooltip">
                                    <span class="calc-tooltip__title">Dabaihuo (大百)</span>
                                    <span class="calc-tooltip__text">
                                        тов. не повседневного спроса (электроника, одежда (кроме штанов и т.п., [рубашек, кофт, курток и т.п],
                                        обуви) и другие товары долгосрочного пользования)
                                    </span>
                                </span>
                                    </div>
                                </li>
                                <li>
                                    <span class="type-of-goods-values">Одежда</span>
                                    <div class="help cloth-help">
                                        <div class="circle-help">
                                            ?
                                        </div>
                                        <span class="calc-tooltip">
                                    <span class="calc-tooltip__title">Одежда</span>
                                    <span class="calc-tooltip__text">
                                        Одежда (штаны и т.п., [рубашки, футболки, кофты, куртки и т.п, платья, юбки и т.п], обувь)
                                    </span>
                                </span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <label class="main-calc-checkbox main-calc-checkbox__form point-checkbox">
                    <input type="checkbox" class="main-calc-checkbox__input brand-checkbox">
                    <span class="main-calc-checkbox__mark"></span>
                    <span class="main-calc-checkbox__title">Бренд</span>
                    <span class="calc-tooltip">
                    <span class="calc-tooltip__text">
                        Любые товары известных брендов
                    </span>
                </span>
                </label>

<!--                <label class="custom-checkbox point-checkbox brand-help" style="margin-left: auto;">-->
<!--                    <span class="brand">Бренд</span>-->
<!--                    <span class="calc-tooltip">-->
<!--                        <span class="calc-tooltip__text">-->
<!--                            Любые товары известных брендов-->
<!--                        </span>-->
<!--                    </span>-->
<!--                    <input type="checkbox" class="brand-checkbox">-->
<!--                    <span class="checkmark"></span>-->
<!--                </label>-->

        </div>
    </div>
</div>

<div class="add-container">
    <div class="add-button">
        <span class="plus">+</span>
        <span class="add">Добавить место</span>
    </div>
</div>