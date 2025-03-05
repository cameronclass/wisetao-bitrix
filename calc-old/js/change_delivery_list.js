// Функция для клонирования и обновления контейнера
function initializeDeliveryList() {
    document.querySelectorAll('.type-of-goods-dimensions').forEach((typeOfGoodsDimension) => {
        typeOfGoodsDimension.classList.remove('active');
    });
    document.querySelector('.report-button-container').classList.remove('active');
    document.querySelector('.boxing-content-container').style.height = '350px';

    let deliveryToggles = document.querySelectorAll('.delivery-toggle');
    let deliveryTimes = {
        auto_regular: '20-30 дней',
        auto_fast: '12-18 дней',
        avia: '7-15 дней',
        ZhD: '35-40 дней',
    };
    let otherDeliveryData = {
        otherDelivery: [
            'ЖДЭ',
            'ПЭК',
            'Деловые линии',
            'КИТ',
        ],
        dataWhite: [
            `<div class="title-help title-white tk-type" style="color: black; text-align: center;">ЖДЭ (до вашего города)</div>
            <div class="help-text help-text-content-white" style="color: black;">
                ЗА КГ: <span class="val-customs kg">н/д</span>
            </div>
            <div class="help-text help-text-content-white" style="color: black;">
                СУММА: <span class="val-customs sum sum-white">н/д</span>
            </div>`.trim(),
            `<div class="title-help title-white tk-type" style="color: black; text-align: center;">ПЭК (до вашего города)</div>
            <div class="help-text help-text-content-white" style="color: black;">
                ЗА КГ: <span class="val-customs kg">н/д</span>
            </div>
            <div class="help-text help-text-content-white" style="color: black;">
                СУММА: <span class="val-customs sum sum-white">н/д</span>
            </div>`.trim(),
            `<div class="title-help title-white tk-type" style="color: black; text-align: center;">Деловые линии (до вашего города)</div>
            <div class="help-text help-text-content-white" style="color: black;">
                ЗА КГ: <span class="val-customs kg">н/д</span>
            </div>
            <div class="help-text help-text-content-white" style="color: black;">
                СУММА: <span class="val-customs sum sum-white">н/д</span>
            </div>`.trim(),
            `<div class="title-help title-white tk-type" style="color: black; text-align: center;">КИТ (до вашего города)</div>
            <div class="help-text help-text-content-white" style="color: black;">
                ЗА КГ: <span class="val-customs kg">н/д</span>
            </div>
            <div class="help-text help-text-content-white" style="color: black;">
                СУММА: <span class="val-customs sum sum-white">н/д</span>
            </div>`.trim(),
        ],
        dataCargo: [
            `<tspan x="148" dy="20" class="help-text-content tk-type">ИТОГ (КАРГО + ЖДЭ)</tspan>
            <tspan x="10" dy="17" class="help-text-content" text-anchor="start">За кг:</tspan>
            <tspan x="51" class="help-text-content kg" fill="#c07000" text-anchor="start">н/д</tspan>
            <tspan x="10" dy="17" class="help-text-content" text-anchor="start">Сумма:</tspan>
            <tspan x="63" class="help-text-content sum" fill="#c07000" text-anchor="start">н/д</tspan>`.trim(),

            `<tspan x="148" dy="20" class="help-text-content tk-type">ИТОГ (КАРГО + ПЭК)</tspan>
            <tspan x="10" dy="17" class="help-text-content" text-anchor="start">За кг:</tspan>
            <tspan x="51" class="help-text-content kg" fill="#c07000" text-anchor="start">н/д</tspan>
            <tspan x="10" dy="17" class="help-text-content" text-anchor="start">Сумма:</tspan>
            <tspan x="63" class="help-text-content sum" fill="#c07000" text-anchor="start">н/д</tspan>`.trim(),

            `<tspan x="148" dy="20" class="help-text-content tk-type">ИТОГ (КАРГО + ДЛ)</tspan>
            <tspan x="10" dy="17" class="help-text-content" text-anchor="start">За кг:</tspan>
            <tspan x="51" class="help-text-content kg" fill="#c07000" text-anchor="start">н/д</tspan>
            <tspan x="10" dy="17" class="help-text-content" text-anchor="start">Сумма:</tspan>
            <tspan x="63" class="help-text-content sum" fill="#c07000" text-anchor="start">н/д</tspan>`.trim(),

            `<tspan x="148" dy="20" class="help-text-content tk-type">ИТОГ (КАРГО + КИТ)</tspan>
            <tspan x="10" dy="17" class="help-text-content" text-anchor="start">За кг:</tspan>
            <tspan x="51" class="help-text-content kg" fill="#c07000" text-anchor="start">н/д</tspan>
            <tspan x="10" dy="17" class="help-text-content" text-anchor="start">Сумма:</tspan>
            <tspan x="63" class="help-text-content sum" fill="#c07000" text-anchor="start">н/д</tspan>`.trim(),
        ],
    };
    deliveryToggles.forEach(function(deliveryToggle) {
        if (activeButton.dataset.type === 'cargo') {
            deliveryToggle.innerHTML = `
                <div class="help cargo-help" style="margin-top: 7px">
                    <div id="circle-help">

<svg class="balloon-container" id="balloon-container" width="262.35" height="259.2822470337925" viewBox="0.000003856545077951523 -0.000019705447840578927 262.35 259.2822470337925" xml:space="preserve">
<g transform="matrix(4.7590291399 0 0 4.7033792463 131.1750038565 129.6411038114)">
<path style="stroke: none; fill: rgb(255,255,255); fill-rule: nonzero; opacity: 1;" transform=" translate(0.000005, 0)" d="M -27.5634 -24.71496 C -27.5634 -26.288110000000003 -26.30302 -27.5634 -24.74827 -27.5634 L 24.74826 -27.5634 L 24.74826 -27.5634 C 26.303009999999997 -27.5634 27.56339 -26.288110000000003 27.56339 -24.71496 L 27.56339 24.71496 L 27.56339 24.71496 C 27.56339 26.288110000000003 26.303009999999997 27.5634 24.74826 27.5634 L -24.74827 27.5634 L -24.74827 27.5634 C -26.30302 27.5634 -27.5634 26.288110000000003 -27.5634 24.71496 z" stroke-linecap="round"/>
</g>
<text x="10" y="10" fill="black" class="help-text" text-anchor="middle">
<tspan x="135" dy="10" class="title-help">Только до терминала ТК</tspan>
<tspan x="135" dy="20" class="title-help title-cargo tk-type">“Южные ворота” Москва</tspan>
<tspan x="135" dy="15" class="title-help title-cargo">(примерная стоимость)</tspan>
<tspan x="10" dy="20" class="help-text-content" text-anchor="start">Курс: </tspan>
<tspan x="51" class="help-text-content" fill="#c07000" text-anchor="start"><tspan fill="black">$: </tspan><tspan class="exchange-rate-elem-dollar">₽н/д</tspan><tspan fill="black">; </tspan><tspan fill="black">¥: </tspan><tspan class="exchange-rate-elem-yuan">₽н/д</tspan></tspan>
<tspan x="10" dy="20" class="help-text-content" text-anchor="start">Упаковка: </tspan>
<tspan x="79" class="help-text-content boxing-type" fill="#c07000" text-anchor="start">н/д</tspan>
<tspan x="10" dy="20" class="help-text-content" text-anchor="start">За упаковку: </tspan>
<tspan x="97" class="help-text-content packaging-price" fill="#c07000" text-anchor="start">н/д</tspan>
<tspan x="10" dy="20" class="help-text-content" text-anchor="start">Комиссия (выкуп): </tspan>
<tspan x="136" class="help-text-content redeem-commission" fill="#c07000" text-anchor="start">н/д</tspan>
<tspan x="10" dy="20" class="help-text-content" text-anchor="start">Страховка: </tspan>
<tspan x="88" class="help-text-content insurance" fill="#c07000" text-anchor="start">н/д</tspan>
<tspan x="10" dy="20" class="help-text-content" text-anchor="start">За кг:</tspan>
<tspan x="51" class="help-text-content kg" fill="#c07000" text-anchor="start">н/д</tspan>
<tspan x="10" dy="17" class="help-text-content" text-anchor="start">Сумма:</tspan>
<tspan x="63" class="help-text-content sum" fill="#c07000" text-anchor="start">н/д</tspan>
<tspan x="10" dy="20"  text-anchor="start"></tspan>
<tspan x="10" dy="58" class="help-text-content help-text-content-note" text-anchor="start"><tspan fill="red">* </tspan>Упаковка увеличит вес вашего груза</tspan>
</text>
</svg>
                    </div>
                </div>
                <svg class="dropdown-list-delivery-arrow" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="32.38141722065728" height="22.59489123485507" viewBox="110.22394056737565 250.64901537709036 32.38141722065728 22.59489123485507" xml:space="preserve">
                    <desc>Created with Fabric.js 5.3.0</desc>
                    <g transform="matrix(0 0.979842546 0.979842546 0 126.4146491777 261.9464609945)" id="DLgAgrXuFMXOEYFpJSRZM">
                        <path style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-dashoffset: 0; stroke-linejoin: miter; stroke-miterlimit: 4; fill: rgb(240,145,35); fill-rule: nonzero; opacity: 1;" transform=" translate(0, 0)" d="M 8.536 -3.5215 L -3.183 -14.8535 C -3.9269999999999996 -15.5975 -4.931 -16.0135 -5.999 -16.0135 C -7.068 -16.0135 -8.072 -15.5975 -8.827 -14.8415 C -9.583 -14.0855 -9.999 -13.0815 -9.999 -12.0135 C -9.999 -10.945500000000001 -9.583 -9.9405 -8.827 -9.185500000000001 L -0.29100000000000037 -0.6915000000000013 C -0.10300000000000037 -0.5035000000000014 -3.885780586188048e-16 -0.25350000000000134 -3.885780586188048e-16 0.013499999999998624 C -3.885780586188048e-16 0.28049999999999864 -0.10400000000000038 0.5314999999999986 -0.29300000000000037 0.7204999999999986 L -8.824000000000002 9.1815 C -9.583000000000002 9.9415 -9.999000000000002 10.9465 -9.999000000000002 12.0135 C -9.999000000000002 13.0805 -9.583000000000002 14.0855 -8.827000000000002 14.8415 C -8.072000000000001 15.5975 -7.067000000000002 16.0135 -5.999000000000002 16.0135 C -4.931000000000003 16.0135 -3.9260000000000024 15.5975 -3.170000000000002 14.8415 L -1.564000000000002 13.2355 L 8.519999999999998 3.5645000000000007 C 9.478999999999997 2.6055000000000006 9.998999999999999 1.3495000000000008 9.998999999999999 0.013500000000000512 C 9.998999999999999 -1.3224999999999996 9.479 -2.5774999999999997 8.535999999999998 -3.5214999999999996 z" stroke-linecap="round"/>
                    </g>
                </svg>
            `.trim();
        } else if (activeButton.dataset.type === 'white') {
            deliveryToggle.innerHTML = `
                <div class="help white-help" style="margin-top: 7px">
                    <div id="circle-help">
                         <svg class="balloon-container balloon-container-white" id="balloon-container" width="259.10224700114047" height="520.1116943482469" viewBox="-0.000019691767818130756 -0.00003952848265953435 259.1022470011404 520.1116943482469" xml:space="preserve">
                            <g transform="matrix(4.7001140462 0 0 9.4348247014 129.5511038088 260.0558076456)" id="QFrDCxhPIOVnh4tXOjZ_8">
                                <path style="stroke: none; fill: rgb(255,255,255); fill-rule: nonzero; opacity: 1;" transform=" translate(0, 0)" d="M -27.5634 -25.97852 C -27.5634 -26.85382 -26.13903 -27.5634 -24.381980000000002 -27.5634 L 24.381979999999995 -27.5634 L 24.381979999999995 -27.5634 C 26.139029999999995 -27.5634 27.563399999999994 -26.853830000000002 27.563399999999994 -25.978520000000003 L 27.563399999999994 25.978519999999996 L 27.563399999999994 25.978519999999996 C 27.563399999999994 26.853819999999995 26.139029999999995 27.563399999999994 24.381979999999995 27.563399999999994 L -24.381980000000002 27.563399999999994 L -24.381980000000002 27.563399999999994 C -26.13903 27.563399999999994 -27.5634 26.853829999999995 -27.5634 25.978519999999996 z" stroke-linecap="round"/>
                            </g>
                            <foreignObject x="10" y="10" width="240px" height="510px">
                                <div class="help-text" xmlns="http://www.w3.org/1999/xhtml" style="overflow: auto; height: 100%; width: 100%; text-align: left; white-space: nowrap;">
                                    <div class="help-text" style="font-size: 15px; color: black; text-align: center;">Таможенные расходы</div>
                                    <div class="title-help title-white" style="color: black; text-align: center;">СТАВКА:</div>
                                    <div class="help-text-content-white" style="color: black;">
                                        СУМ. ПОШЛИНА: <span class="val-customs sum-duty">н/д</span>
                                    </div>
                                    <div class="help-text-content-white" style="color: black;">
                                        НДС: <span class="val-customs">20%</span>
                                    </div>
                                    <div class="title-help title-white" style="color: black; text-align: center;">Saide:</div>
                                    <div class="help-text help-text-content-white" style="color: black;">
                                        ПЕРЕВОЗКА: <span class="val-customs">0.6$/КГ</span>
                                    </div>
                                    <div class="help-text help-text-content-white" style="color: black;">
                                        КОМИССИЯ (ВЫКУП): <span class="val-customs redeem-commission">н/д</span>
                                    </div>
                                    <div class="help-text help-text-content-white" style="color: black;">
                                        СТРАХОВКА: <span class="val-customs insurance">н/д</span>
                                    </div>
                                    <div class="help-text help-text-content-white" style="color: black;">
                                        КУРС: <span class="val-customs exchange-saide">н/д</span>
                                    </div>
                                    <div class="help-text help-text-content-white" style="color: black;">
                                        УПАКОВКА: <span class="val-customs boxing-type">н/д</span>
                                    </div>
                                    <div class="help-text help-text-content-white" style="color: black;">
                                        ЗА УПАКОВКУ: <span class="val-customs packaging-price">н/д</span>
                                    </div>
                                    <div class="title-help title-white tk-type" style="color: black; text-align: center; margin-top: 8px;">ИТОГ (Белая+Saide):</div>
                                    <div class="help-text-content-white" style="color: black;">
                                        СУМ. ПОШЛИНА: <span class="val-customs total-duty">н/д</span>
                                    </div>
                                    <div class="help-text-content-white" style="color: black;">
                                        СУМ. НДС: <span class="val-customs total-nds">н/д</span>
                                    </div>
                                    <div class="help-text-content-white" style="color: black;">
                                        СБОРЫ: <span class="val-customs fees">н/д</span>
                                    </div>
                                    <div class="help-text-content-white" style="color: black;">
                                        СУМ. SAIDE: <span class="val-customs sum-saide">н/д</span>
                                    </div>
                                    <div class="help-text-content-white" style="color: black;">
                                        ТАМОЖНЯ: <span class="val-customs total-customs">н/д</span>
                                    </div>
                                    <div class="help-text-content-white" style="color: black;">
                                        ИТОГО: <span class="val-customs total">н/д</span>
                                    </div>
                                    <div class="boxing-note-item">
                                        * <span class="boxing-note">Упаковка увеличит вес вашего груза</span>
                                    </div>
                                    <div class="doc-box">
                                        <div class="title-help title-white licenses" style="color: black; text-align: center; margin-top: 2px;">
                                            ЛИЦЕНЗИЯ:
                                        </div>
                                        <div class="title-help title-white cargo-certificates" style="color: black; text-align: center; margin-top: 8px;">
                                            СЕРТИФИКАТ:
                                        </div>
                                    </div>
                                    <div class="report-white-data">СКАЧАТЬ ПОДРОБНЫЙ ОТЧЕТ<br>(БЕЛАЯ) (XSLX)</div>
                                    <style>
                                        ::-webkit-scrollbar {
                                            width: 5px;
                                            height: 5px;/* ширина вертикальной полосы */
                                        }
                                
                                        ::-webkit-scrollbar-thumb {
                                            background-color: #888; /* цвет полосы прокрутки */
                                            border-radius: 4px; /* скругление углов полосы прокрутки */
                                        }
                                    </style>
                                </div>
                            </foreignObject>
                        </svg>
                    </div>
                </div>
                <svg class="dropdown-list-delivery-arrow" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="32.38141722065728" height="22.59489123485507" viewBox="110.22394056737565 250.64901537709036 32.38141722065728 22.59489123485507" xml:space="preserve">
                    <desc>Created with Fabric.js 5.3.0</desc>
                    <g transform="matrix(0 0.979842546 0.979842546 0 126.4146491777 261.9464609945)" id="DLgAgrXuFMXOEYFpJSRZM">
                        <path style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-dashoffset: 0; stroke-linejoin: miter; stroke-miterlimit: 4; fill: rgb(240,145,35); fill-rule: nonzero; opacity: 1;" transform=" translate(0, 0)" d="M 8.536 -3.5215 L -3.183 -14.8535 C -3.9269999999999996 -15.5975 -4.931 -16.0135 -5.999 -16.0135 C -7.068 -16.0135 -8.072 -15.5975 -8.827 -14.8415 C -9.583 -14.0855 -9.999 -13.0815 -9.999 -12.0135 C -9.999 -10.945500000000001 -9.583 -9.9405 -8.827 -9.185500000000001 L -0.29100000000000037 -0.6915000000000013 C -0.10300000000000037 -0.5035000000000014 -3.885780586188048e-16 -0.25350000000000134 -3.885780586188048e-16 0.013499999999998624 C -3.885780586188048e-16 0.28049999999999864 -0.10400000000000038 0.5314999999999986 -0.29300000000000037 0.7204999999999986 L -8.824000000000002 9.1815 C -9.583000000000002 9.9415 -9.999000000000002 10.9465 -9.999000000000002 12.0135 C -9.999000000000002 13.0805 -9.583000000000002 14.0855 -8.827000000000002 14.8415 C -8.072000000000001 15.5975 -7.067000000000002 16.0135 -5.999000000000002 16.0135 C -4.931000000000003 16.0135 -3.9260000000000024 15.5975 -3.170000000000002 14.8415 L -1.564000000000002 13.2355 L 8.519999999999998 3.5645000000000007 C 9.478999999999997 2.6055000000000006 9.998999999999999 1.3495000000000008 9.998999999999999 0.013500000000000512 C 9.998999999999999 -1.3224999999999996 9.479 -2.5774999999999997 8.535999999999998 -3.5214999999999996 z" stroke-linecap="round"/>
                    </g>
                </svg>
            `.trim();
        }
        else if (activeButton.dataset.type === 'comparison') {
            let contentContainer = document.querySelector(".boxing-content-container");
            contentContainer.style.height = "490px";
            if (deliveryToggle.parentElement.id.endsWith('white')) {
                deliveryToggle.innerHTML = `
                    <div class="help white-help" style="margin-top: 7px">
                        <div id="circle-help">
                            <svg class="balloon-container balloon-container-white" id="balloon-container" width="259.10224700114047" height="520.1116943482469" viewBox="-0.000019691767818130756 -0.00003952848265953435 259.1022470011404 520.1116943482469" xml:space="preserve">
                            <g transform="matrix(4.7001140462 0 0 9.4348247014 129.5511038088 260.0558076456)" id="QFrDCxhPIOVnh4tXOjZ_8">
                                <path style="stroke: none; fill: rgb(255,255,255); fill-rule: nonzero; opacity: 1;" transform=" translate(0, 0)" d="M -27.5634 -25.97852 C -27.5634 -26.85382 -26.13903 -27.5634 -24.381980000000002 -27.5634 L 24.381979999999995 -27.5634 L 24.381979999999995 -27.5634 C 26.139029999999995 -27.5634 27.563399999999994 -26.853830000000002 27.563399999999994 -25.978520000000003 L 27.563399999999994 25.978519999999996 L 27.563399999999994 25.978519999999996 C 27.563399999999994 26.853819999999995 26.139029999999995 27.563399999999994 24.381979999999995 27.563399999999994 L -24.381980000000002 27.563399999999994 L -24.381980000000002 27.563399999999994 C -26.13903 27.563399999999994 -27.5634 26.853829999999995 -27.5634 25.978519999999996 z" stroke-linecap="round"/>
                            </g>
                                <foreignObject x="10" y="10" width="240px" height="510px">
                                    <div class="help-text" xmlns="http://www.w3.org/1999/xhtml" style="overflow: auto; height: 100%; width: 100%; text-align: left; white-space: nowrap;">
                                        <div class="help-text" style="font-size: 15px; color: black; text-align: center;">Таможенные расходы</div>
                                        <div class="title-help title-white" style="color: black; text-align: center;">СТАВКА:</div>
                                        <div class="help-text-content-white" style="color: black;">
                                            СУМ. ПОШЛИНА: <span class="val-customs sum-duty">н/д</span>
                                        </div>
                                        <div class="help-text-content-white" style="color: black;">
                                            НДС: <span class="val-customs">20%</span>
                                        </div>
                                        <div class="title-help title-white" style="color: black; text-align: center;">Saide:</div>
                                        <div class="help-text help-text-content-white" style="color: black;">
                                            ПЕРЕВОЗКА: <span class="val-customs">0.6$/КГ</span>
                                        </div>
                                        <div class="help-text help-text-content-white" style="color: black;">
                                            КОМИССИЯ (ВЫКУП): <span class="val-customs redeem-commission">н/д</span>
                                        </div>
                                        <div class="help-text help-text-content-white" style="color: black;">
                                            СТРАХОВКА: <span class="val-customs insurance">н/д</span>
                                        </div>
                                        <div class="help-text help-text-content-white" style="color: black;">
                                            КУРС: <span class="val-customs exchange-saide">н/д</span>
                                        </div>
                                        <div class="help-text help-text-content-white" style="color: black;">
                                            УПАКОВКА: <span class="val-customs boxing-type">н/д</span>
                                        </div>
                                        <div class="help-text help-text-content-white" style="color: black;">
                                            ЗА УПАКОВКУ: <span class="val-customs packaging-price">н/д</span>
                                        </div>
                                        <div class="title-help title-white tk-type" style="color: black; text-align: center; margin-top: 8px;">ИТОГ (Белая+Saide):</div>
                                        <div class="help-text-content-white" style="color: black;">
                                            СУМ. ПОШЛИНА: <span class="val-customs total-duty">н/д</span>
                                        </div>
                                        <div class="help-text-content-white" style="color: black;">
                                            СУМ. НДС: <span class="val-customs total-nds">н/д</span>
                                        </div>
                                        <div class="help-text-content-white" style="color: black;">
                                            СБОРЫ: <span class="val-customs fees">н/д</span>
                                        </div>
                                        <div class="help-text-content-white" style="color: black;">
                                            СУМ. SAIDE: <span class="val-customs sum-saide">н/д</span>
                                        </div>
                                        <div class="help-text-content-white" style="color: black;">
                                            ТАМОЖНЯ: <span class="val-customs total-customs">н/д</span>
                                        </div>
                                        <div class="help-text-content-white" style="color: black;">
                                            ИТОГО: <span class="val-customs total">н/д</span>
                                        </div>
                                        <div class="boxing-note-item">
                                            * <span class="boxing-note">Упаковка увеличит вес вашего груза</span>
                                        </div>
                                        <div class="doc-box">
                                            <div class="title-help title-white licenses" style="color: black; text-align: center; margin-top: 2px;">
                                                ЛИЦЕНЗИЯ:
                                            </div>
                                            <div class="title-help title-white cargo-certificates" style="color: black; text-align: center; margin-top: 8px;">
                                                СЕРТИФИКАТ:
                                            </div>
                                        </div>
                                        <div class="report-white-data">СКАЧАТЬ ПОДРОБНЫЙ ОТЧЕТ<br>(БЕЛАЯ) (XSLX)</div>
                                        <style>
                                            ::-webkit-scrollbar {
                                                width: 5px;
                                                height: 5px;/* ширина вертикальной полосы */
                                            }
                                    
                                            ::-webkit-scrollbar-thumb {
                                                background-color: #888; /* цвет полосы прокрутки */
                                                border-radius: 4px; /* скругление углов полосы прокрутки */
                                            }
                                        </style>
                                    </div>
                                </foreignObject>
                            </svg>
                        </div>
                    </div>
                    <svg class="dropdown-list-delivery-arrow" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="32.38141722065728" height="22.59489123485507" viewBox="110.22394056737565 250.64901537709036 32.38141722065728 22.59489123485507" xml:space="preserve">
                        <desc>Created with Fabric.js 5.3.0</desc>
                        <g transform="matrix(0 0.979842546 0.979842546 0 126.4146491777 261.9464609945)" id="DLgAgrXuFMXOEYFpJSRZM">
                            <path style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-dashoffset: 0; stroke-linejoin: miter; stroke-miterlimit: 4; fill: rgb(240,145,35); fill-rule: nonzero; opacity: 1;" transform=" translate(0, 0)" d="M 8.536 -3.5215 L -3.183 -14.8535 C -3.9269999999999996 -15.5975 -4.931 -16.0135 -5.999 -16.0135 C -7.068 -16.0135 -8.072 -15.5975 -8.827 -14.8415 C -9.583 -14.0855 -9.999 -13.0815 -9.999 -12.0135 C -9.999 -10.945500000000001 -9.583 -9.9405 -8.827 -9.185500000000001 L -0.29100000000000037 -0.6915000000000013 C -0.10300000000000037 -0.5035000000000014 -3.885780586188048e-16 -0.25350000000000134 -3.885780586188048e-16 0.013499999999998624 C -3.885780586188048e-16 0.28049999999999864 -0.10400000000000038 0.5314999999999986 -0.29300000000000037 0.7204999999999986 L -8.824000000000002 9.1815 C -9.583000000000002 9.9415 -9.999000000000002 10.9465 -9.999000000000002 12.0135 C -9.999000000000002 13.0805 -9.583000000000002 14.0855 -8.827000000000002 14.8415 C -8.072000000000001 15.5975 -7.067000000000002 16.0135 -5.999000000000002 16.0135 C -4.931000000000003 16.0135 -3.9260000000000024 15.5975 -3.170000000000002 14.8415 L -1.564000000000002 13.2355 L 8.519999999999998 3.5645000000000007 C 9.478999999999997 2.6055000000000006 9.998999999999999 1.3495000000000008 9.998999999999999 0.013500000000000512 C 9.998999999999999 -1.3224999999999996 9.479 -2.5774999999999997 8.535999999999998 -3.5214999999999996 z" stroke-linecap="round"/>
                        </g>
                    </svg>
                `.trim();
            }
            else {
                deliveryToggle.innerHTML = `
                    <div class="help cargo-help" style="margin-top: 7px">
                        <div id="circle-help">
<svg class="balloon-container" id="balloon-container" width="262.35" height="259.2822470337925" viewBox="0.000003856545077951523 -0.000019705447840578927 262.35 259.2822470337925" xml:space="preserve">
<g transform="matrix(4.7590291399 0 0 4.7033792463 131.1750038565 129.6411038114)">
<path style="stroke: none; fill: rgb(255,255,255); fill-rule: nonzero; opacity: 1;" transform=" translate(0.000005, 0)" d="M -27.5634 -24.71496 C -27.5634 -26.288110000000003 -26.30302 -27.5634 -24.74827 -27.5634 L 24.74826 -27.5634 L 24.74826 -27.5634 C 26.303009999999997 -27.5634 27.56339 -26.288110000000003 27.56339 -24.71496 L 27.56339 24.71496 L 27.56339 24.71496 C 27.56339 26.288110000000003 26.303009999999997 27.5634 24.74826 27.5634 L -24.74827 27.5634 L -24.74827 27.5634 C -26.30302 27.5634 -27.5634 26.288110000000003 -27.5634 24.71496 z" stroke-linecap="round"/>
</g>
<text x="10" y="10" fill="black" class="help-text" text-anchor="middle">
<tspan x="135" dy="10" class="title-help">Только до терминала ТК</tspan>
<tspan x="135" dy="20" class="title-help title-cargo tk-type">“Южные ворота” Москва</tspan>
<tspan x="135" dy="15" class="title-help title-cargo">(примерная стоимость)</tspan>
<tspan x="10" dy="20" class="help-text-content" text-anchor="start">Курс: </tspan>
<tspan x="51" class="help-text-content" fill="#c07000" text-anchor="start"><tspan fill="black">$: </tspan><tspan class="exchange-rate-elem-dollar">₽н/д</tspan><tspan fill="black">; </tspan><tspan fill="black">¥: </tspan><tspan class="exchange-rate-elem-yuan">₽н/д</tspan></tspan>
<tspan x="10" dy="20" class="help-text-content" text-anchor="start">Упаковка: </tspan>
<tspan x="79" class="help-text-content boxing-type" fill="#c07000" text-anchor="start">н/д</tspan>
<tspan x="10" dy="20" class="help-text-content" text-anchor="start">За упаковку: </tspan>
<tspan x="97" class="help-text-content packaging-price" fill="#c07000" text-anchor="start">н/д</tspan>
<tspan x="10" dy="20" class="help-text-content" text-anchor="start">Комиссия (выкуп): </tspan>
<tspan x="136" class="help-text-content redeem-commission" fill="#c07000" text-anchor="start">н/д</tspan>
<tspan x="10" dy="20" class="help-text-content" text-anchor="start">Страховка: </tspan>
<tspan x="88" class="help-text-content insurance" fill="#c07000" text-anchor="start">н/д</tspan>
<tspan x="10" dy="20" class="help-text-content" text-anchor="start">За кг:</tspan>
<tspan x="51" class="help-text-content kg" fill="#c07000" text-anchor="start">н/д</tspan>
<tspan x="10" dy="17" class="help-text-content" text-anchor="start">Сумма:</tspan>
<tspan x="63" class="help-text-content sum" fill="#c07000" text-anchor="start">н/д</tspan>
<tspan x="10" dy="58" class="help-text-content help-text-content-note" text-anchor="start"><tspan fill="red">* </tspan>Упаковка увеличит вес вашего груза</tspan>
</text>
</svg>
                        </div>
                    </div>
                    <svg class="dropdown-list-delivery-arrow" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="32.38141722065728" height="22.59489123485507" viewBox="110.22394056737565 250.64901537709036 32.38141722065728 22.59489123485507" xml:space="preserve">
                        <desc>Created with Fabric.js 5.3.0</desc>
                        <g transform="matrix(0 0.979842546 0.979842546 0 126.4146491777 261.9464609945)" id="DLgAgrXuFMXOEYFpJSRZM">
                            <path style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-dashoffset: 0; stroke-linejoin: miter; stroke-miterlimit: 4; fill: rgb(240,145,35); fill-rule: nonzero; opacity: 1;" transform=" translate(0, 0)" d="M 8.536 -3.5215 L -3.183 -14.8535 C -3.9269999999999996 -15.5975 -4.931 -16.0135 -5.999 -16.0135 C -7.068 -16.0135 -8.072 -15.5975 -8.827 -14.8415 C -9.583 -14.0855 -9.999 -13.0815 -9.999 -12.0135 C -9.999 -10.945500000000001 -9.583 -9.9405 -8.827 -9.185500000000001 L -0.29100000000000037 -0.6915000000000013 C -0.10300000000000037 -0.5035000000000014 -3.885780586188048e-16 -0.25350000000000134 -3.885780586188048e-16 0.013499999999998624 C -3.885780586188048e-16 0.28049999999999864 -0.10400000000000038 0.5314999999999986 -0.29300000000000037 0.7204999999999986 L -8.824000000000002 9.1815 C -9.583000000000002 9.9415 -9.999000000000002 10.9465 -9.999000000000002 12.0135 C -9.999000000000002 13.0805 -9.583000000000002 14.0855 -8.827000000000002 14.8415 C -8.072000000000001 15.5975 -7.067000000000002 16.0135 -5.999000000000002 16.0135 C -4.931000000000003 16.0135 -3.9260000000000024 15.5975 -3.170000000000002 14.8415 L -1.564000000000002 13.2355 L 8.519999999999998 3.5645000000000007 C 9.478999999999997 2.6055000000000006 9.998999999999999 1.3495000000000008 9.998999999999999 0.013500000000000512 C 9.998999999999999 -1.3224999999999996 9.479 -2.5774999999999997 8.535999999999998 -3.5214999999999996 z" stroke-linecap="round"/>
                        </g>
                    </svg>
                `.trim();
            }
        }
    });
    let deliveryLists = document.querySelectorAll('.delivery-types-list');
    let offerButton = document.querySelector('.offer-button');
    let newOfferButton = offerButton.cloneNode(true);
    // let popupOfferButton = document.querySelector('.pop-up-offer-button');
    // let newPopupOfferButton = popupOfferButton.cloneNode(true);
    if (activeButton.dataset.type === 'white') {
        newOfferButton.classList.add('offer-button-white');
        newOfferButton.classList.remove('offer-button-comparison');
    }
    if (activeButton.dataset.type === 'cargo') {
        newOfferButton.classList.remove('offer-button-white');
        newOfferButton.classList.remove('offer-button-comparison');
    }
    if (activeButton.dataset.type === 'comparison') {
        newOfferButton.classList.remove('offer-button-white');
        newOfferButton.classList.add('offer-button-comparison');
    }
    document.querySelector('.boxing-content-container .report-button-container').removeChild(offerButton);
    document.querySelector('.boxing-content-container .report-button-container').appendChild(newOfferButton);
    // document.querySelector('.pop-up-get-offer-container').removeChild(popupOfferButton);
    // document.querySelector('.pop-up-get-offer-container').appendChild(newPopupOfferButton);
    let dataContainer = document.querySelector('.boxing-content-container');

    let dataElements = dataContainer.querySelectorAll('.kg, .sum');
    dataElements.forEach(function(element) {
        if (element.tagName === 'tspan') {
            element.innerHTML = `$н/д<tspan fill="black">;</tspan> ₽н/д`;
        }
        else {
            if (!element.classList.contains('kg')) {
                element.innerHTML = `<span class="sum-dollar">$н/д</span><span class="sum-rub">₽н/д</span>`;
            }
            else {
                element.innerHTML = `$н/д - ₽н/д`;
            }
        }
    });
    let i = 0;
    deliveryLists.forEach(function(deliveryList) {
        let firstListItem = deliveryList.querySelector('li');

        let costElem = firstListItem.querySelector('.cost-elem');
        let helpDiv = firstListItem.querySelector('.list-help');
        let svg = firstListItem.querySelector('.balloon-container');

        let otherListItems = deliveryList.querySelectorAll('li:not(:first-child)');

        otherListItems.forEach(function (listItem) {
            let costElem = listItem.querySelector('.cost-elem');
            listItem.querySelector('.list-elem').classList.remove('selected');
            listItem.querySelector('.list-elem').classList.remove('enable-pointer');
            if (activeButton.dataset.type === 'cargo') {
                if (!costElem.classList.contains('cargo-cost-elem')) {
                    costElem.classList.add('cargo-cost-elem');
                    costElem.classList.remove('white-cost-elem');
                    let otherSvg = listItem.querySelector('.balloon-container');
                    initOtherCargoHelps(otherSvg, otherDeliveryData.otherDelivery[i], otherDeliveryData.dataCargo[i]);
                    i++;
                }
            }
            else if  (activeButton.dataset.type === 'white') {
                if (!costElem.classList.contains('white-cost-elem')) {
                    costElem.classList.add('white-cost-elem');
                    costElem.classList.remove('cargo-cost-elem');
                    let otherSvg = listItem.querySelector('.balloon-container');
                    initOtherWhiteHelps(otherSvg, otherDeliveryData.otherDelivery[i], otherDeliveryData.dataWhite[i]);
                    i++;
                }
            }
            else if (activeButton.dataset.type === 'comparison') {
                if (deliveryList.classList.contains('white')) {
                    if (!costElem.classList.contains('white-cost-elem')) {
                        costElem.classList.add('white-cost-elem');
                        costElem.classList.remove('cargo-cost-elem');
                        let otherSvg = listItem.querySelector('.balloon-container');
                        initOtherWhiteHelps(otherSvg, otherDeliveryData.otherDelivery[i], otherDeliveryData.dataWhite[i]);
                        i++;
                    }
                }
                else {
                    if (!costElem.classList.contains('cargo-cost-elem')) {
                        costElem.classList.add('cargo-cost-elem');
                        costElem.classList.remove('white-cost-elem');
                        let otherSvg = listItem.querySelector('.balloon-container');
                        initOtherCargoHelps(otherSvg, otherDeliveryData.otherDelivery[i], otherDeliveryData.dataCargo[i]);
                        i++;
                    }
                }
            }
        });
        i = 0;
        if (activeButton.dataset.type === 'cargo') {
            helpDiv.className = 'list-elem list-help cargo-help';
            costElem.className = 'cost-elem ' + costElem.classList[1] + ' cargo-cost-elem';
            costElem.innerHTML = `
                <span class="cost">
                    <span class="kg-container">За кг: <span class="kg">$н/д - ₽н/д</span></span>
                    <span class="sum-container">Сумма: <span class="sum"><span class="sum-dollar">$н/д</span><span class="sum-rub">₽н/д</span></span></span>
                </span>
            `.trim();
            svg.setAttribute('width', '262.35');
            svg.setAttribute('height', '259.2822470337925');
            svg.setAttribute('viewBox', "0.000003856545077951523 -0.000019705447840578927 262.35 259.2822470337925");
            svg.setAttribute('xml:space', "preserve");
            svg.setAttribute('class', 'balloon-container');
            svg.innerHTML = `
<g transform="matrix(4.7590291399 0 0 4.7033792463 131.1750038565 129.6411038114)">
<path style="stroke: none; fill: rgb(255,255,255); fill-rule: nonzero; opacity: 1;" transform=" translate(0.000005, 0)" d="M -27.5634 -24.71496 C -27.5634 -26.288110000000003 -26.30302 -27.5634 -24.74827 -27.5634 L 24.74826 -27.5634 L 24.74826 -27.5634 C 26.303009999999997 -27.5634 27.56339 -26.288110000000003 27.56339 -24.71496 L 27.56339 24.71496 L 27.56339 24.71496 C 27.56339 26.288110000000003 26.303009999999997 27.5634 24.74826 27.5634 L -24.74827 27.5634 L -24.74827 27.5634 C -26.30302 27.5634 -27.5634 26.288110000000003 -27.5634 24.71496 z" stroke-linecap="round"/>
</g>
<text x="10" y="10" fill="black" class="help-text" text-anchor="middle">
<tspan x="135" dy="10" class="title-help">Только до терминала ТК</tspan>
<tspan x="135" dy="20" class="title-help title-cargo tk-type">“Южные ворота” Москва</tspan>
<tspan x="135" dy="15" class="title-help title-cargo">(примерная стоимость)</tspan>
<tspan x="10" dy="20" class="help-text-content" text-anchor="start">Курс: </tspan>
<tspan x="51" class="help-text-content" fill="#c07000" text-anchor="start"><tspan fill="black">$: </tspan><tspan class="exchange-rate-elem-dollar">₽н/д</tspan><tspan fill="black">; </tspan><tspan fill="black">¥: </tspan><tspan class="exchange-rate-elem-yuan">₽н/д</tspan></tspan>
<tspan x="10" dy="20" class="help-text-content" text-anchor="start">Упаковка: </tspan>
<tspan x="79" class="help-text-content boxing-type" fill="#c07000" text-anchor="start">н/д</tspan>
<tspan x="10" dy="20" class="help-text-content" text-anchor="start">За упаковку: </tspan>
<tspan x="97" class="help-text-content packaging-price" fill="#c07000" text-anchor="start">н/д</tspan>
<tspan x="10" dy="20" class="help-text-content" text-anchor="start">Комиссия (выкуп): </tspan>
<tspan x="136" class="help-text-content redeem-commission" fill="#c07000" text-anchor="start">н/д</tspan>
<tspan x="10" dy="20" class="help-text-content" text-anchor="start">Страховка: </tspan>
<tspan x="88" class="help-text-content insurance" fill="#c07000" text-anchor="start">н/д</tspan>
<tspan x="10" dy="20" class="help-text-content" text-anchor="start">За кг:</tspan>
<tspan x="51" class="help-text-content kg" fill="#c07000" text-anchor="start">н/д</tspan>
<tspan x="10" dy="17" class="help-text-content" text-anchor="start">Сумма:</tspan>
<tspan x="63" class="help-text-content sum" fill="#c07000" text-anchor="start">н/д</tspan>
</text>
<foreignObject x="10" y="200" width="255px" height="40px">
    <button xmlns="http://www.w3.org/1999/xhtml" class="report-white-data offer-button report-cargo-data" href="" style="height: 30px; width: 240px; text-align: center; border-radius: 7px;" disabled>ПОЛУЧИТЬ РАСЧЕТ В PDF</button>
</foreignObject>
<text x="10" y="250" fill="black" class="help-text">
<tspan x="10" dy="0" class="help-text-content help-text-content-note" text-anchor="start"><tspan fill="red">* </tspan>Упаковка увеличит вес вашего груза</tspan>
</text>`.trim();
        } else if (activeButton.dataset.type === 'white') {
            helpDiv.className = 'list-elem list-help white-help';
            costElem.className = 'cost-elem white white-cost-elem';
            costElem.innerHTML = `
                <span class="cost">
                    <span class="kg-container">За кг: <span class="kg">$н/д - ₽н/д</span></span>
                    <span class="sum-container">Сумма: <span class="sum"><span class="sum-dollar">$н/д</span><span class="sum-rub">₽н/д</span></span></span>
                </span>
            `.trim();
            // Установите SVG для Белой
            svg.setAttribute('width', '259.1022470011404');
            svg.setAttribute('height', '520.1116943482469');
            svg.setAttribute('viewBox', "-0.000019691767818130756 -0.00003952848265953435 259.1022470011404 520.1116943482469");
            svg.setAttribute('xml:space', "preserve");
            svg.setAttribute('class', 'balloon-container balloon-container-white');
            svg.innerHTML = `
                <g transform="matrix(4.7001140462 0 0 9.4348247014 129.5511038088 260.0558076456)" id="QFrDCxhPIOVnh4tXOjZ_8">
                    <path style="stroke: none; fill: rgb(255,255,255); fill-rule: nonzero; opacity: 1;" transform=" translate(0, 0)" d="M -27.5634 -25.97852 C -27.5634 -26.85382 -26.13903 -27.5634 -24.381980000000002 -27.5634 L 24.381979999999995 -27.5634 L 24.381979999999995 -27.5634 C 26.139029999999995 -27.5634 27.563399999999994 -26.853830000000002 27.563399999999994 -25.978520000000003 L 27.563399999999994 25.978519999999996 L 27.563399999999994 25.978519999999996 C 27.563399999999994 26.853819999999995 26.139029999999995 27.563399999999994 24.381979999999995 27.563399999999994 L -24.381980000000002 27.563399999999994 L -24.381980000000002 27.563399999999994 C -26.13903 27.563399999999994 -27.5634 26.853829999999995 -27.5634 25.978519999999996 z" stroke-linecap="round"/>
                </g>
                <foreignObject x="10" y="10" width="240px" height="510px">
                    <div class="help-text" xmlns="http://www.w3.org/1999/xhtml" style="overflow: auto; height: 100%; width: 100%; text-align: left; white-space: nowrap;">
                        <div class="help-text" style="font-size: 15px; color: black; text-align: center;">Таможенные расходы</div>
                        <div class="title-help title-white" style="color: black; text-align: center;">СТАВКА:</div>
                        <div class="help-text-content-white" style="color: black;">
                            СУМ. ПОШЛИНА: <span class="val-customs sum-duty">н/д</span>
                        </div>
                        <div class="help-text-content-white" style="color: black;">
                            НДС: <span class="val-customs">20%</span>
                        </div>
                        <div class="title-help title-white" style="color: black; text-align: center;">Saide:</div>
                        <div class="help-text help-text-content-white" style="color: black;">
                            ПЕРЕВОЗКА: <span class="val-customs">0.6$/КГ</span>
                        </div>
                        <div class="help-text help-text-content-white" style="color: black;">
                            КОМИССИЯ (ВЫКУП): <span class="val-customs redeem-commission">н/д</span>
                        </div>
                        <div class="help-text help-text-content-white" style="color: black;">
                            СТРАХОВКА: <span class="val-customs insurance">н/д</span>
                        </div>
                        <div class="help-text help-text-content-white" style="color: black;">
                            КУРС: <span class="val-customs exchange-saide">н/д</span>
                        </div>
                        <div class="help-text help-text-content-white" style="color: black;">
                            УПАКОВКА: <span class="val-customs boxing-type">н/д</span>
                        </div>
                        <div class="help-text help-text-content-white" style="color: black;">
                            ЗА УПАКОВКУ: <span class="val-customs packaging-price">н/д</span>
                        </div>
                        <div class="title-help title-white tk-type" style="color: black; text-align: center; margin-top: 8px;">ИТОГ (Белая+Saide):</div>
                        <div class="help-text-content-white" style="color: black;">
                            СУМ. ПОШЛИНА: <span class="val-customs total-duty">н/д</span>
                        </div>
                        <div class="help-text-content-white" style="color: black;">
                            СУМ. НДС: <span class="val-customs total-nds">н/д</span>
                        </div>
                        <div class="help-text-content-white" style="color: black;">
                            СБОРЫ: <span class="val-customs fees">н/д</span>
                        </div>
                        <div class="help-text-content-white" style="color: black;">
                            СУМ. SAIDE: <span class="val-customs sum-saide">н/д</span>
                        </div>
                        <div class="help-text-content-white" style="color: black;">
                            ТАМОЖНЯ: <span class="val-customs total-customs">н/д</span>
                        </div>
                        <div class="help-text-content-white" style="color: black;">
                            ИТОГО: <span class="val-customs total">н/д</span>
                        </div>
                        <div class="boxing-note-item">
                            * <span class="boxing-note">Упаковка увеличит вес вашего груза</span>
                        </div>
                        <div class="doc-box">
                            <div class="title-help title-white licenses" style="color: black; text-align: center; margin-top: 2px;">
                                ЛИЦЕНЗИЯ:
                            </div>
                            <div class="title-help title-white cargo-certificates" style="color: black; text-align: center; margin-top: 8px;">
                                СЕРТИФИКАТ:
                            </div>
                        </div>
                        <div class="report-white-data">СКАЧАТЬ ПОДРОБНЫЙ ОТЧЕТ<br>(БЕЛАЯ) (XSLX)</div>
                        <button xmlns="http://www.w3.org/1999/xhtml" class="report-white-data offer-button report-cargo-data offer-button-white" href="" style="height: 30px; width: 240px; text-align: center; border-radius: 7px; top: 5%;" disabled>ПОЛУЧИТЬ РАСЧЕТ В PDF</button>
                        <style>
                            ::-webkit-scrollbar {
                                width: 5px;
                                height: 5px;/* ширина вертикальной полосы */
                            }
                    
                            ::-webkit-scrollbar-thumb {
                                background-color: #888; /* цвет полосы прокрутки */
                                border-radius: 4px; /* скругление углов полосы прокрутки */
                            }
                        </style>
                    </div>
                </foreignObject>
            `.trim();
        }
        else if (activeButton.dataset.type === 'comparison') {
            if (deliveryList.classList.contains('white')) {
                helpDiv.className = 'list-elem list-help white-help';
                costElem.className = 'cost-elem white white-cost-elem';
                costElem.innerHTML = `
                    <div class="cost">
                        <span class="kg-container kg-container-comparison">Кг: <span class="kg">$н/д - ₽н/д</span></span>
                        <div class="sum-container"><div class="sum sum-comparison"><span class="sum-dollar">$н/д</span><span class="sum-rub">₽н/д</span></div></div>
                    </div>
                `.trim();
                // Установите SVG для Белой
                svg.setAttribute('width', '259.1022470011404');
                svg.setAttribute('height', '520.1116943482469');
                svg.setAttribute('viewBox', "-0.000019691767818130756 -0.00003952848265953435 259.1022470011404 520.1116943482469");
                svg.setAttribute('xml:space', "preserve");
                svg.setAttribute('class', 'balloon-container balloon-container-white');
                svg.innerHTML = `
                    <g transform="matrix(4.7001140462 0 0 9.4348247014 129.5511038088 260.0558076456)" id="QFrDCxhPIOVnh4tXOjZ_8">
                        <path style="stroke: none; fill: rgb(255,255,255); fill-rule: nonzero; opacity: 1;" transform=" translate(0, 0)" d="M -27.5634 -25.97852 C -27.5634 -26.85382 -26.13903 -27.5634 -24.381980000000002 -27.5634 L 24.381979999999995 -27.5634 L 24.381979999999995 -27.5634 C 26.139029999999995 -27.5634 27.563399999999994 -26.853830000000002 27.563399999999994 -25.978520000000003 L 27.563399999999994 25.978519999999996 L 27.563399999999994 25.978519999999996 C 27.563399999999994 26.853819999999995 26.139029999999995 27.563399999999994 24.381979999999995 27.563399999999994 L -24.381980000000002 27.563399999999994 L -24.381980000000002 27.563399999999994 C -26.13903 27.563399999999994 -27.5634 26.853829999999995 -27.5634 25.978519999999996 z" stroke-linecap="round"/>
                    </g>
                    <foreignObject x="10" y="10" width="240px" height="510px">
                        <div class="help-text" xmlns="http://www.w3.org/1999/xhtml" style="overflow: auto; height: 100%; width: 100%; text-align: left; white-space: nowrap;">
                            <div class="help-text" style="font-size: 15px; color: black; text-align: center;">Таможенные расходы</div>
                            <div class="title-help title-white" style="color: black; text-align: center;">СТАВКА:</div>
                            <div class="help-text-content-white" style="color: black;">
                                СУМ. ПОШЛИНА: <span class="val-customs sum-duty">н/д</span>
                            </div>
                            <div class="help-text-content-white" style="color: black;">
                                НДС: <span class="val-customs">20%</span>
                            </div>
                            <div class="title-help title-white" style="color: black; text-align: center;">Saide:</div>
                            <div class="help-text help-text-content-white" style="color: black;">
                                ПЕРЕВОЗКА: <span class="val-customs">0.6$/КГ</span>
                            </div>
                            <div class="help-text help-text-content-white" style="color: black;">
                                КОМИССИЯ (ВЫКУП): <span class="val-customs redeem-commission">н/д</span>
                            </div>
                            <div class="help-text help-text-content-white" style="color: black;">
                                СТРАХОВКА: <span class="val-customs insurance">н/д</span>
                            </div>
                            <div class="help-text help-text-content-white" style="color: black;">
                                КУРС: <span class="val-customs exchange-saide">н/д</span>
                            </div>
                            <div class="help-text help-text-content-white" style="color: black;">
                                УПАКОВКА: <span class="val-customs boxing-type">н/д</span>
                            </div>
                            <div class="help-text help-text-content-white" style="color: black;">
                                ЗА УПАКОВКУ: <span class="val-customs packaging-price">н/д</span>
                            </div>
                            <div class="title-help title-white tk-type" style="color: black; text-align: center; margin-top: 8px;">ИТОГ (Белая+Saide):</div>
                            <div class="help-text-content-white" style="color: black;">
                                СУМ. ПОШЛИНА: <span class="val-customs total-duty">н/д</span>
                            </div>
                            <div class="help-text-content-white" style="color: black;">
                                СУМ. НДС: <span class="val-customs total-nds">н/д</span>
                            </div>
                            <div class="help-text-content-white" style="color: black;">
                                СБОРЫ: <span class="val-customs fees">н/д</span>
                            </div>
                            <div class="help-text-content-white" style="color: black;">
                                СУМ. SAIDE: <span class="val-customs sum-saide">н/д</span>
                            </div>
                            <div class="help-text-content-white" style="color: black;">
                                ТАМОЖНЯ: <span class="val-customs total-customs">н/д</span>
                            </div>
                            <div class="help-text-content-white" style="color: black;">
                                ИТОГО: <span class="val-customs total">н/д</span>
                            </div>
                            <div class="boxing-note-item">
                                * <span class="boxing-note">Упаковка увеличит вес вашего груза</span>
                            </div>
                            <div class="doc-box">
                                <div class="title-help title-white licenses" style="color: black; text-align: center; margin-top: 2px;">
                                    ЛИЦЕНЗИЯ:
                                </div>
                                <div class="title-help title-white cargo-certificates" style="color: black; text-align: center; margin-top: 8px;">
                                    СЕРТИФИКАТ:
                                </div>
                            </div>
                            <div class="report-white-data">СКАЧАТЬ ПОДРОБНЫЙ ОТЧЕТ<br>(БЕЛАЯ) (XSLX)</div>
                            <button xmlns="http://www.w3.org/1999/xhtml" class="report-white-data offer-button report-cargo-data offer-button-white" href="" style="height: 30px; width: 240px; text-align: center; border-radius: 7px; top: 5%;" disabled>ПОЛУЧИТЬ РАСЧЕТ В PDF</button>
                            <style>
                                ::-webkit-scrollbar {
                                    width: 5px;
                                    height: 5px;/* ширина вертикальной полосы */
                                }
                                ::-webkit-scrollbar-thumb {
                                    background-color: #888; /* цвет полосы прокрутки */
                                    border-radius: 4px; /* скругление углов полосы прокрутки */
                                }
                            </style>
                        </div>
                    </foreignObject>
                `.trim();
            }
            else {
                helpDiv.className = 'list-elem list-help cargo-help';
                costElem.className = 'cost-elem cargo cargo-cost-elem';
                costElem.innerHTML = `
                    <div class="cost">
                        <span class="kg-container kg-container-comparison">Кг: <span class="kg">$н/д - ₽н/д</span></span>
                        <div class="sum-container"><div class="sum sum-comparison"><span class="sum-dollar">$н/д</span><span class="sum-rub">₽н/д</span></div></div>
                    </div>
                `.trim();
                // Установите SVG для Карго
                svg.setAttribute('width', '262.35');
                svg.setAttribute('height', '259.2822470337925');
                svg.setAttribute('viewBox', "0.000003856545077951523 -0.000019705447840578927 262.35 259.2822470337925");
                svg.setAttribute('xml:space', "preserve");
                svg.setAttribute('class', 'balloon-container');
                svg.innerHTML = `
<g transform="matrix(4.7590291399 0 0 4.7033792463 131.1750038565 129.6411038114)">
<path style="stroke: none; fill: rgb(255,255,255); fill-rule: nonzero; opacity: 1;" transform=" translate(0.000005, 0)" d="M -27.5634 -24.71496 C -27.5634 -26.288110000000003 -26.30302 -27.5634 -24.74827 -27.5634 L 24.74826 -27.5634 L 24.74826 -27.5634 C 26.303009999999997 -27.5634 27.56339 -26.288110000000003 27.56339 -24.71496 L 27.56339 24.71496 L 27.56339 24.71496 C 27.56339 26.288110000000003 26.303009999999997 27.5634 24.74826 27.5634 L -24.74827 27.5634 L -24.74827 27.5634 C -26.30302 27.5634 -27.5634 26.288110000000003 -27.5634 24.71496 z" stroke-linecap="round"/>
</g>
<text x="10" y="10" fill="black" class="help-text" text-anchor="middle">
<tspan x="135" dy="10" class="title-help">Только до терминала ТК</tspan>
<tspan x="135" dy="20" class="title-help title-cargo tk-type">“Южные ворота” Москва</tspan>
<tspan x="135" dy="15" class="title-help title-cargo">(примерная стоимость)</tspan>
<tspan x="10" dy="20" class="help-text-content" text-anchor="start">Курс:</tspan>
<tspan x="51" class="help-text-content" fill="#c07000" text-anchor="start"><tspan fill="black">$: </tspan><tspan class="exchange-rate-elem-dollar">₽н/д</tspan><tspan fill="black">; </tspan><tspan fill="black">¥: </tspan><tspan class="exchange-rate-elem-yuan">₽н/д</tspan></tspan>
<tspan x="10" dy="20" class="help-text-content" text-anchor="start">Упаковка: </tspan>
<tspan x="79" class="help-text-content boxing-type" fill="#c07000" text-anchor="start">н/д</tspan>
<tspan x="10" dy="20" class="help-text-content" text-anchor="start">За упаковку: </tspan>
<tspan x="97" class="help-text-content packaging-price" fill="#c07000" text-anchor="start">н/д</tspan>
<tspan x="10" dy="20" class="help-text-content" text-anchor="start">Комиссия (выкуп): </tspan>
<tspan x="136" class="help-text-content redeem-commission" fill="#c07000" text-anchor="start">н/д</tspan>
<tspan x="10" dy="20" class="help-text-content" text-anchor="start">Страховка: </tspan>
<tspan x="88" class="help-text-content insurance" fill="#c07000" text-anchor="start">н/д</tspan>
<tspan x="10" dy="20" class="help-text-content" text-anchor="start">За кг:</tspan>
<tspan x="51" class="help-text-content kg" fill="#c07000" text-anchor="start">н/д</tspan>
<tspan x="10" dy="17" class="help-text-content" text-anchor="start">Сумма:</tspan>
<tspan x="63" class="help-text-content sum" fill="#c07000" text-anchor="start">н/д</tspan>
</text>
<foreignObject x="10" y="200" width="255px" height="40px">
    <button xmlns="http://www.w3.org/1999/xhtml" class="report-white-data offer-button report-cargo-data" style="width: 242px; height: 35px;" href="" disabled>ПОЛУЧИТЬ РАСЧЕТ В PDF</button>
</foreignObject>
<text x="10" y="193" fill="black" class="help-text">
<tspan x="10" dy="58" class="help-text-content help-text-content-note" text-anchor="start"><tspan fill="red">* </tspan>Упаковка увеличит вес вашего груза</tspan>
</text>`.trim();
            }
        }
    });
    function initOtherWhiteHelps(otherSvg, otherDelivery, otherDeliveryData) {
        otherSvg.setAttribute('width', '269.3362');
        otherSvg.setAttribute('height', '602.3777');
        otherSvg.setAttribute('viewBox', "0 0 269.3362 602.3777");
        otherSvg.setAttribute('xml:space', "preserve");
        otherSvg.setAttribute('class', 'balloon-container balloon-container-white-others');
        otherSvg.innerHTML = `
            <g transform="matrix(4.8857588116 0 0 10.9271317993 134.6681 300.8568331362)" id="mLQWqDgjNBaa4qoHdDRGo">
                <path style="stroke: none; fill: rgb(255,255,255); fill-rule: nonzero; opacity: 1;" transform=" translate(0, 0)" d="M -27.5634 -26.2565 C -27.5634 -26.603109999999997 -27.25545 -26.93552 -26.7073 -27.180609999999998 C -26.15915 -27.4257 -25.4157 -27.56339 -24.64049 -27.56339 L 24.64049 -27.56339 L 24.64049 -27.56339 C 25.41569 -27.56339 26.15914 -27.4257 26.7073 -27.180609999999998 C 27.25545 -26.935519999999997 27.5634 -26.603109999999997 27.5634 -26.2565 L 27.5634 26.2565 L 27.5634 26.2565 C 27.5634 26.978279999999998 26.25477 27.56339 24.640500000000003 27.56339 L -24.640479999999997 27.56339 L -24.640479999999997 27.56339 C -26.254759999999997 27.56339 -27.563379999999995 26.97827 -27.563379999999995 26.2565 z" stroke-linecap="round"/>
            </g>
            <foreignObject x="10" y="10" width="250px" height="590px">
                <div class="help-text" xmlns="http://www.w3.org/1999/xhtml" style="overflow: auto; height: 100%; width: 100%; text-align: left; white-space: nowrap;">
                    <div class="help-text" style="font-size: 15px; color: black; text-align: center;">Таможенные расходы</div>
                    <div class="title-help title-white" style="color: black; text-align: center;">СТАВКА:</div>
                    <div class="help-text-content-white" style="color: black;">
                        СУМ. ПОШЛИНА: <span class="val-customs sum-duty">н/д</span>
                    </div>
                    <div class="help-text-content-white" style="color: black;">
                        НДС: <span class="val-customs">20%</span>
                    </div>
                    <div class="title-help title-white" style="color: black; text-align: center;">Saide:</div>
                    <div class="help-text help-text-content-white" style="color: black;">
                        ПЕРЕВОЗКА: <span class="val-customs">0.6$/КГ</span>
                    </div>
                    <div class="help-text help-text-content-white" style="color: black;">
                        КОМИССИЯ (ВЫКУП): <span class="val-customs redeem-commission">н/д</span>
                    </div>
                    <div class="help-text help-text-content-white" style="color: black;">
                        СТРАХОВКА: <span class="val-customs insurance">н/д</span>
                    </div>
                    <div class="help-text help-text-content-white" style="color: black;">
                        КУРС: <span class="val-customs exchange-saide">н/д</span>
                    </div>
                    <div class="help-text help-text-content-white" style="color: black;">
                        УПАКОВКА: <span class="val-customs boxing-type">н/д</span>
                    </div>
                    <div class="help-text help-text-content-white" style="color: black;">
                        ЗА УПАКОВКУ: <span class="val-customs packaging-price">н/д</span>
                    </div>
                    ${otherDeliveryData}
                    <div class="title-help title-white" style="color: black; text-align: center; margin-top: 8px;">ИТОГ (Saide+Белая+${otherDelivery}):</div>
                    <div class="help-text-content-white" style="color: black;">
                        СУМ. ПОШЛИНА: <span class="val-customs total-duty">н/д</span>
                    </div>
                    <div class="help-text-content-white" style="color: black;">
                        СУМ. НДС: <span class="val-customs total-nds">н/д</span>
                    </div>
                    <div class="help-text-content-white" style="color: black;">
                        СБОРЫ: <span class="val-customs fees">н/д</span>
                    </div>
                    <div class="help-text-content-white" style="color: black;">
                        СУМ. SAIDE: <span class="val-customs sum-saide">н/д</span>
                    </div>
                    <div class="help-text-content-white" style="color: black;">
                        ТАМОЖНЯ: <span class="val-customs total-customs">н/д</span>
                    </div>
                    <div class="help-text-content-white" style="color: black;">
                        ИТОГО: <span class="val-customs total">н/д</span>
                    </div>
                    <div class="boxing-note-item">
                        * <span class="boxing-note">Упаковка увеличит вес вашего груза</span>
                    </div>
                    <div class="doc-box doc-box-others">
                        <div class="title-help title-white licenses" style="color: black; text-align: center; margin-top: 2px;">
                            ЛИЦЕНЗИЯ:
                        </div>
                        <div class="title-help title-white cargo-certificates" style="color: black; text-align: center; margin-top: 8px;">
                            СЕРТИФИКАТ:
                        </div>
                    </div>
                    <div class="report-white-data">СКАЧАТЬ ПОДРОБНЫЙ ОТЧЕТ<br>(БЕЛАЯ) (XSLX)</div>
                    <button xmlns="http://www.w3.org/1999/xhtml" class="report-white-data offer-button report-cargo-data offer-button-white" href="" style="height: 30px; width: 250px; text-align: center; border-radius: 7px; top: 5%;" disabled>ПОЛУЧИТЬ РАСЧЕТ В PDF</button>
                    <style>
                        ::-webkit-scrollbar {
                        width: 5px;
                        height: 5px;/* ширина вертикальной полосы */
                    }

                        ::-webkit-scrollbar-thumb {
                        background-color: #888; /* цвет полосы прокрутки */
                        border-radius: 4px; /* скругление углов полосы прокрутки */
                    }
                    </style>
                </div>
            </foreignObject>
        `.trim();
    }
    function initOtherCargoHelps(otherSvg, otherDelivery, otherDeliveryData) {
        otherSvg.setAttribute('width', '262.7358922755646');
        otherSvg.setAttribute('height', '301.84014587969517');
        otherSvg.setAttribute('viewBox', "0 0 262.7358922755646 301.84014587969517");
        otherSvg.setAttribute('xml:space', "preserve");
        otherSvg.setAttribute('class', 'balloon-container balloon-container-cargo-others');
        otherSvg.innerHTML = `
<g transform="matrix(4.766029226 0 0 5.475379414 131.3679461378 150.9200729398)" id="sv3He1D-K39enoPRawG7t">
<path style="stroke: none; fill: rgb(255,255,255); fill-rule: nonzero; opacity: 1;" transform=" translate(0.000005, 0)" d="M -27.5634 -25.3448 C -27.5634 -26.5701 -26.42226 -27.563399999999998 -25.0146 -27.563399999999998 L 25.01459 -27.563399999999998 L 25.01459 -27.563399999999998 C 26.42225 -27.563399999999998 27.56339 -26.570099999999996 27.56339 -25.3448 L 27.56339 25.3448 L 27.56339 25.3448 C 27.56339 26.5701 26.42225 27.563399999999998 25.01459 27.563399999999998 L -25.0146 27.563399999999998 L -25.0146 27.563399999999998 C -26.42226 27.563399999999998 -27.5634 26.570099999999996 -27.5634 25.3448 z" stroke-linecap="round"/>
</g>
<text x="10" y="20" fill="black" class="help-text" text-anchor="middle">
<tspan x="135" dy="17" class="title-help">КАРГО - до г. Москва</tspan>
<tspan x="135" dy="14" class="title-help arrival-city-rus-tk">${otherDelivery}</tspan>
<tspan x="135" dy="14" class="help-text-content title-cargo">(примерная стоимость)</tspan>
<tspan x="10" dy="17" class="help-text-content" text-anchor="start">Курс: </tspan>
<tspan x="51" class="help-text-content" fill="#c07000" text-anchor="start"><tspan fill="black">$: </tspan><tspan class="exchange-rate-elem-dollar">₽н/д</tspan><tspan fill="black">; </tspan><tspan fill="black">¥: </tspan><tspan class="exchange-rate-elem-yuan">₽н/д</tspan></tspan>
<tspan x="10" dy="17" class="help-text-content" text-anchor="start">Упаковка: </tspan>
<tspan x="79" class="help-text-content boxing-type" fill="#c07000" text-anchor="start">н/д</tspan>
<tspan x="10" dy="17" class="help-text-content" text-anchor="start">За упаковку: </tspan>
<tspan x="97" class="help-text-content packaging-price" fill="#c07000" text-anchor="start">н/д</tspan>
<tspan x="10" dy="20" class="help-text-content" text-anchor="start">Комиссия (выкуп): </tspan>
<tspan x="136" class="help-text-content redeem-commission" fill="#c07000" text-anchor="start">н/д</tspan>
<tspan x="10" dy="20" class="help-text-content" text-anchor="start">Страховка: </tspan>
<tspan x="88" class="help-text-content insurance" fill="#c07000" text-anchor="start">н/д</tspan>
<tspan x="10" dy="17" class="help-text-content" text-anchor="start">За кг:</tspan>
<tspan x="51" class="help-text-content kg-cargo" fill="#c07000" text-anchor="start">н/д</tspan>
<tspan x="10" dy="17" class="help-text-content" text-anchor="start">Сумма:</tspan>
<tspan x="63" class="help-text-content sum-cargo" fill="#c07000" text-anchor="start">н/д</tspan>
${otherDeliveryData}
</text>
<foreignObject x="10" y="250" width="255px" height="40px">
    <button xmlns="http://www.w3.org/1999/xhtml" class="report-white-data offer-button report-cargo-data" href="" style="height: 30px; width: 240px; text-align: center; border-radius: 7px;" disabled>ПОЛУЧИТЬ РАСЧЕТ В PDF</button>
</foreignObject>
<text x="10" y="293" fill="black" class="help-text">
<tspan x="10" dy="0" class="help-text-content help-text-content-note" text-anchor="start"><tspan fill="red">* </tspan>Упаковка увеличит вес вашего груза</tspan>
</text>`.trim();
    }
}
