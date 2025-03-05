goodData = {
    totalWeight: 0,
    totalVolume: 0,
    totalCost: 0,
    count: 0,
    packagingPrice: 0,
    typeOfPackaging: '',
    ransomGoods: 0,
}
function initializeTnvedAjaxRequest() {
    // Находим кнопку "Рассчитать" по классу
    let calculateButton = $('#white-calc-button');
    calculateButton = calculateButton.length > 0 ? calculateButton : $('#cargo-white-calc-button');
    let $arrival = $("input[name='arrival']");
    let totalWeight;
    let totalVolume;
    let totalCost;
    let totalDuty;
    let totalNds;
    let sumDuty;
    let sumRateSaide;
    let sumRateSaideRub;
    const RateSaide = 0.7;
    let exchangeRateSaide;
    let totalCustoms;
    let totalCustomsRub;
    let fees;
    let total;
    let totalRub;
    let kg;
    let kgRub;
    let license;
    let certificate;
    let codes;
    let postfix = '';
    let semicolon = '<span style="color: white">; </span>';
    let semicolonHelp = '<span style="color: black">; </span>';
    let semicolonHelpTspan = '<tspan fill="black">; </tspan>';
    let packagingPrice = 0;
    let boxing;
    let $insurance = $("input[name='insurance']");
    let typeOfPackaging = '';
    let ransomGoods = 0;
    let yuan = 0;
    let successPackaging = false;
    let successRedeem = false;
    let usdRate;
    if (activeButton.dataset.type === 'comparison') {
        postfix = ' .delivery-types-list-comparison.white';
    }

    async function sendWhiteMultipleAjaxRequests() {
        const submitButton = document.querySelector('.tnved-calc-button:not(.submit-excel-file)');
        submitButton.disabled = true;
        const boxingExpandButton = document.querySelector('.boxing-spoiler-header');
        boxingExpandButton.style.pointerEvents = 'none';
        boxingExpandButton.parentElement.style.background = 'grey';
        const calcTypeButtons = document.querySelectorAll('.calc-type-button:not(.tnved-calc-button.submit-redeem-data.submit-excel-file):not(.submit-general-button):not(.submit-dimensions-button)');
        calcTypeButtons.forEach((calcTypeButton) => {calcTypeButton.setAttribute('disabled', '')});
        $('.list-elem').removeClass('enable-pointer');
        $('.list-elem.selected').removeClass('selected');
        disableBoxingButtons();
        document.querySelector('.main-offer-button').setAttribute('disabled', '');
        try {
            const whiteResponse = await sendWhiteGeneralAjaxRequest();
            if (!whiteResponse) {
                // Если cargoResponse не был получен, выходите из функции
                submitButton.disabled = false;
                boxingExpandButton.style.pointerEvents = 'all';
                boxingExpandButton.parentElement.style.background = '#141a24';
                calcTypeButtons.forEach((calcTypeButton) => {calcTypeButton.removeAttribute('disabled')});
                enableBoxingButtons();
                return;
            }
            // Отправляем остальные запросы, передавая cargoResponse
            await Promise.all([
                sendDLAjaxRequest(whiteResponse),
                sendPEKAjaxRequest(whiteResponse),
                sendJDEAjaxRequest(whiteResponse),
                sendKITAjaxRequest(whiteResponse),
            ]);
        } catch (error) {
            console.log("Ошибка при отправке запроса:", error);
        } finally {
            submitButton.disabled = false;
            boxingExpandButton.style.pointerEvents = 'all';
            boxingExpandButton.parentElement.style.background = '#141a24';
            calcTypeButtons.forEach((calcTypeButton) => {calcTypeButton.removeAttribute('disabled')});
            enableBoxingButtons();
        }
    }

    function sumCustoms(response) {
        sumDuty = 0;
        totalDuty = 0;
        totalNds = 0;
        exchangeRateSaide = response.dollar;
        yuan = response.yuan;
        sumRateSaide = 0;
        sumRateSaideRub = 0;
        fees = 0;
        totalCustoms = 0;
        totalCustomsRub = 0;
        total = 0;
        totalRub = 0;
        kg = 0;
        kgRub = 0;
        license = [];
        certificate = [];
        codes = [];
        isDataReceived = true;

        response.RESULT.ITEMS.forEach(function(item) {
            totalDuty += item.DUTY;
            totalNds += item.NDS;
            codes.push(item.TNVED_NAME.match(/\[(.*?)\]/)[1]);
            if (item['LICIMP_PR']) {
                license.push('Нужна, но есть ограничения.');
            }
            else {
                license.push(item['LICENSE'] ? 'Да, нужна' : 'Нет');
            }
            if(item['SAFETY_PR']){
                certificate.push('Нужен, но есть ограничения.');
            }
            else {
                certificate.push(item['SAFETY'] ? 'Да, нужен.' : 'Нет');
            }
            let impPrintValue = parseFloat(item.IMP_PRINT.match(/[\d.]+/));
            sumDuty += impPrintValue;

        });

        usdRate = parseFloat(response.RATES.USD.UF_RATE);

        sumDuty = sumDuty + " €/кг";
        totalDuty = (totalDuty / usdRate).toFixed(2);
        totalNds = (totalNds / usdRate).toFixed(2);
        sumRateSaide = (RateSaide * totalWeight + packagingPrice).toFixed(2);
        sumRateSaideRub = (sumRateSaide * response.dollar).toFixed(2);
        fees = (response.RESULT.DUTY2 / usdRate).toFixed(2);
        totalCustoms = (response.RESULT.TOTAL / usdRate).toFixed(2);
        totalCustomsRub = (response.RESULT.TOTAL).toFixed(2);
        total = parseFloat((parseFloat(totalCustoms) + parseFloat(sumRateSaide)).toFixed(2));
        totalRub = (response.RESULT.TOTAL + parseFloat(sumRateSaideRub)).toFixed(2);
        kg = parseFloat((total / totalWeight).toFixed(2));
        kgRub = parseFloat((totalRub / totalWeight).toFixed(2));

    }

    function ajaxWhiteOfferDataRequest(deliveryType, deliveryTypeRus, tkType) {
        if (offerData) {
            sumCustoms(offerData);
            let tkData;
            if (tkType === 'ИТОГ (Белая+Saide):') {
                tkData = false;
            }
            if (tkType === 'ЖДЭ (до вашего города)') {
                tkData = offerDataJDE;
            }
            if (tkType === 'ПЭК (до вашего города)') {
                tkData = offerDataPEK;
            }
            if (tkType === 'Деловые линии (до вашего города)') {
                tkData = offerDataDL;
            }
            if (tkType === 'КИТ (до вашего города)') {
                tkData = offerDataKIT;
            }
            let offerDataRequest = {
                sumDuty: 'ПОШЛИНА: ' + sumDuty,
                NDS: 'НДС: ' + '20%',
                Saide: 'ПЕРЕВОЗКА SAIDE: 0.7$/кг',
                totalDuty: 'СУММ. ПОШЛИНА: ' + totalDuty + "$",
                totalNds: 'CУММ. НДС: ' + totalNds + "$",
                totalCustoms: 'ТАМОЖНЯ: ' + totalCustoms + "$; " + totalCustomsRub + "₽",
                fees: 'Сборы: ' + fees + "$",
                ExchangeRateYuan: 'Курс юаня SAIDE: ' + offerData.yuan + "₽",
                ExchangeRateDollar: 'Курс доллара SAIDE: ' + offerData.dollar + "₽",
                TOTAL: 'Стоимость до г. Благовещенск (Тамож.+Saide): ' + (total + goodData.packagingPrice).toFixed(2) + "$; " + (parseFloat(totalRub) + goodData.packagingPrice * exchangeRateSaide).toFixed(2) + "₽",
                TOTALTK: tkData ? 'Стоимость до г. ' + $arrival.val() + ' (Терм. ТК ' + tkType.split(' (до вашего города)')[0] + '): ' + (total + goodData.packagingPrice + tkData.sum_cost_price[deliveryType]).toFixed(2) + "$; " + (parseFloat(totalRub) + goodData.packagingPrice * exchangeRateSaide + tkData.sum_cost_price_rub[deliveryType]).toFixed(2) + "₽" : '',
                GoodsCost: 'Стоимость товара: ' + goodData.totalCost.toFixed(2) + "$; " + (goodData.totalCost * dollarGlobal).toFixed(2) + "₽",
                Weight: 'Вес: ' + goodData.totalWeight + 'кг',
                Volume: 'Объем: ' + goodData.totalVolume + 'м' + String.fromCharCode(0x00B3),
                RedeemCommissionFirst: 'Комиссия SAIDE 5%',
                RedeemCommission: 'от стоимости товара: ' + (goodData.ransomGoods * offerData.yuan / offerData.dollar).toFixed(2) + "$; " + (goodData.ransomGoods * offerData.yuan).toFixed(2) + "₽",
                Items: offerData.RESULT.ITEMS,
                SumSaide: 'Стоимость перевозки SAIDE (до г. Благовещенск 0.7$/кг): ' + sumRateSaide + "$; " + sumRateSaideRub + "₽",
                PackageType: 'Упаковка: ' + goodData.typeOfPackaging,
                PackageCost: 'За упаковку: ' + goodData.packagingPrice + "₽",
                Kg: 'За кг: ' + ((parseFloat(kg) + goodData.packagingPrice) / totalWeight).toFixed(2) + "$; " + ((parseFloat(kgRub) + goodData.packagingPrice) * exchangeRateSaide / goodData.totalWeight).toFixed(2) + "₽ (Тамож. + SAIDE до г. Благовещенск)",
                Sum: 'Стоимость: ' + (total + goodData.packagingPrice).toFixed(2) + "$; " + (parseFloat(totalRub) + goodData.packagingPrice * exchangeRateSaide).toFixed(2) + "₽ (Тамож. + SAIDE до г. Благовещенск)",
                tkType: tkType,
                tkData: tkData ? {
                    kgTk: 'За кг: ' + tkData.cost_price[deliveryType] + '$; ' + tkData.cost_price_rub[deliveryType] + "₽ " + '(г. Благовещенск - г. ' + $arrival.val() + ')',
                    sumTk: 'Стоимость: ' + tkData.sum_cost_price[deliveryType].toFixed(2) + '$; ' + tkData.sum_cost_price_rub[deliveryType].toFixed(2) + '₽ ' + '(г. Благовещенск - г. ' + $arrival.val() + ')',
                    kgTotal: 'За кг до г. ' + $arrival.val() + ' (Терм. ТК ' + tkType.split(' (до вашего города)')[0] + ' ): ' + (parseFloat(kg) + tkData.cost_price[deliveryType]).toFixed(2) + "$; " + (parseFloat(kgRub) + tkData.cost_price_rub[deliveryType]).toFixed(2) + "₽",
                    sumTotal: 'Общая стоимость до г. ' + $arrival.val() + ' (Терм. ТК ' + tkType.split(' (до вашего города)')[0] + ' ): ' + (total + tkData.sum_cost_price[deliveryType]).toFixed(2) + "$; " + (parseFloat(totalRub) + tkData.sum_cost_price_rub[deliveryType]).toFixed(2) + "₽",
                    varyKg: ' (варьир.)',
                    varySum: ' (варьир.)',
                } : '',
                USD_RATE: usdRate,
            };

            showModal('Идёт передача данных менеджеру, пожалуйста, подождите... ');
            let countdown = 20;
            countdownTimer = setInterval(function() {
                updateModalMessage('Идёт передача данных менеджеру, пожалуйста, подождите... ' + countdown + ' сек.');
                countdown--;
                if (countdown < 0) {
                    clearInterval(countdownTimer);
                }
            }, 1000);

            $.ajax({
                type: "POST",
                url: "https://api-calc.wisetao.com:4343/api/get-offer-white",
                data: offerDataRequest,
                xhrFields: {
                    responseType: 'blob'
                },
                success: function (response) {
                    // Создаем объект URL из ответа
                    let url = URL.createObjectURL(response);

                    // Создаем временную ссылку для открытия в новой вкладке
                    let aOpen = document.createElement('a');
                    aOpen.href = url;
                    aOpen.target = '_blank';

                    // Симулируем клик по ссылке для открытия в новой вкладке
                    document.body.appendChild(aOpen);
                    aOpen.click();
                    document.body.removeChild(aOpen);

                    // Создаем временную ссылку для скачивания файла
                    let aDownload = document.createElement('a');
                    aDownload.href = url;
                    aDownload.download = 'Коммерческое предложение.pdf';

                    // Симулируем клик по ссылке для скачивания файла
                    document.body.appendChild(aDownload);
                    aDownload.click();
                    document.body.removeChild(aDownload);

                    // Освобождаем ресурсы URL
                    URL.revokeObjectURL(url);

                    submitRedeemData(response);

                    console.log("Успешно отправлено!");
                    console.log("Ответ сервера:", response);
                },
                error: function (error) {
                    clearInterval(countdownTimer);
                    hideModal();
                },
            });
        }
    }

    async function sendWhiteGeneralAjaxRequest() {
        let isAllInputFieldsFilled = true;
        let activeCheckbox = $(".boxing:checked");
        boxing = activeCheckbox.length > 0 ? activeCheckbox.attr("name") : null;
        let insurance = $insurance.is(":checked") ? $insurance.attr("name") : null;
        $('.tnved-data-container input').add($arrival).each(function () {
            if (!$(this).hasClass('select-by-name-input')) {
                if ($(this).val() === "") {
                    isAllInputFieldsFilled = false;
                    return false;
                }
            }
        });
        let isRansom = $("input[name='delivery-option']:checked").val() === 'delivery-only';
        let clientName = document.querySelector('input[name="client-name"]').value;
        let clientPhone = document.querySelector('input[name="client-phone"]').value;
        let numberIsValid = await validateNumber(clientPhone);
        if (!numberIsValid) {
            showInvalidMessage();
        }
        if (isAllInputFieldsFilled
            && (!isRansom && (validateFields() || !!document.querySelector('.selected-file-name')?.childNodes[3]) || isRansom)) {
            activateDeliveryPicks();
            let requestData = {
                "date-currency": "",
                "action": "customs-calculator-calculate",
                "costs-to-border": "0",
                "costs-to-border-currency": "USD",
                "items": []
            };
            totalWeight = 0;
            totalVolume = 0;
            totalCost = 0;

            let currencySign = $(".tnved-currency .dropdown-toggle").contents().first()
                .text().trim();

            let redeemCommission = isRansom ? "self-purchase" : "ransom-white";
            items = [];
            let itemsForBitrix = [];
            $('.tnved-data-container').each(function () {
                let weight = parseFloat($(this).find('[name="weight[]"]').val());
                let volume = parseFloat($(this).find('[name="volume[]"]').val());
                let currency = parseFloat($(this).find('[name="currency[]"]').val());
                totalWeight += weight;
                totalVolume += volume;
                totalCost += $(this).find('.dropdown-toggle').data('currency') === 'USD' ? currency :
                    $(this).find('.dropdown-toggle').data('currency') === 'CNY' ? currency * yuanGlobal / dollarGlobal :
                    currency / dollarGlobal;
                let item = {
                    "code": $(this).find('[name="tnved_code[]"]').val().replace(/\s/g, ""),
                    "price": $(this).find('[name="currency[]"]').val(),
                    "price-currency": $(this).find('.dropdown-toggle').data('currency'),
                    "weight": weight,
                    "country": 1
                };
                let itemForBitrix = {
                    'good_name': $(this).find('.select-by-name-input').attr('placeholder'),
                    'volume': volume,
                }
                items.push(item);
                itemsForBitrix.push(Object.assign({}, item, itemForBitrix));
                requestData.items.push(item);

            });
            requestData.itemsForBitrix = JSON.stringify(itemsForBitrix);
            requestData.clause = redeemCommission;
            requestData.calc_type = 'Белая доставка';
            requestData.total_volume = totalVolume;
            requestData.total_weight = totalWeight;
            requestData.boxing = boxing;
            requestData.arrival = $arrival.val();
            goodData.totalCost = totalCost;
            goodData.totalWeight = totalWeight;
            goodData.totalVolume = totalVolume;
            sendClientData(clientName, clientPhone).then(isClientExist => {
                sendOrderDataForEmail(requestData, clientName, clientPhone, isClientExist)
                    .then(function (emailResponse) {
                        console.log('Данные успешно отправлены на email:', emailResponse);
                    })
                    .catch(function (emailError) {
                        console.error('Ошибка при отправке данных на email:', emailError);
                    });
            });
            return new Promise((resolve, reject) => {
                showAwait('.white-cost-elem', 'white', true);
                isDataReceived = false;
                let promises = [];
                $.ajax({
                    url: 'https://api-calc.wisetao.com:4343/api/get-tnved-calculation',
                    type: 'POST',
                    data: requestData,
                    success: function (response) {
                        if (boxing !== null || redeemCommission === 'ransom-white') {
                            if (boxing !== null) {
                                let requestPackagingPrice = {
                                    "boxing": boxing,
                                    "volume": totalVolume,
                                };
                                promises.push(
                                    new Promise((resolvePackaging, rejectPackaging) => {
                                        $.ajax({
                                            url: 'https://api-calc.wisetao.com:4343/api/get-boxing-price',
                                            type: 'POST',
                                            data: requestPackagingPrice,
                                            success: function (packagingResponse) {
                                                packagingPrice = packagingResponse.packaging_price;
                                                typeOfPackaging = packagingResponse.type_of_packaging;
                                                goodData.packagingPrice = packagingResponse.packaging_price;
                                                goodData.typeOfPackaging = packagingResponse.type_of_packaging;
                                                resolvePackaging();
                                            },
                                            error: function (error) {
                                                console.error('Ошибка при выполнении запроса: ', error);
                                                rejectPackaging(error);
                                            }
                                        });
                                    })
                                );
                            }
                            if (redeemCommission === 'ransom-white') {
                                let requestRedeem = {
                                    "ransom": redeemCommission,
                                    'total_cost': totalCost,
                                    'currency_sign': '$',
                                };
                                promises.push(
                                    new Promise((resolveRedeem, rejectRedeem) => {
                                        $.ajax({
                                            url: 'https://api-calc.wisetao.com:4343/api/get-redeem-commission',
                                            type: 'POST',
                                            data: requestRedeem,
                                            success: function (redeemResponse) {
                                                ransomGoods = redeemResponse.ransom;
                                                goodData.ransomGoods = ransomGoods;
                                                resolveRedeem();
                                            },
                                            error: function (error) {
                                                console.error('Ошибка при выполнении запроса: ', error);
                                                rejectRedeem(error);
                                            }
                                        });
                                    })
                                );
                            }
                            Promise.all(promises)
                                .then(() => {
                                    showAwait('.white-cost-elem', 'white', false);
                                    sumCustoms(response);
                                    offerData = response;
                                    updatePageWithWhiteResponse(response);
                                    console.log(response);
                                    resolve(response);
                                })
                                .catch((error) => {
                                    console.error('Ошибка при выполнении запроса: ', error);
                                    reject(error);
                                });
                        }
                        else {
                            showAwait('.white-cost-elem', 'white', false);
                            typeOfPackaging = 'коробка';
                            goodData.typeOfPackaging = 'коробка';
                            ransomGoods = 0;
                            goodData.ransomGoods = ransomGoods;
                            sumCustoms(response);
                            offerData = response;
                            updatePageWithWhiteResponse(response);
                            console.log(response);
                            resolve(response);
                        }
                    },
                    error: function (error) {
                        console.error('Ошибка при выполнении запроса: ', error);
                        showAwait('.white-cost-elem', 'white', false);
                        resolve(reject);
                    }
                });
            });
        } else {
            console.log('Заполните все поля ввода перед рассчетом.');
            let inputs = document.querySelectorAll('.tnved-data-container input');

            inputs.forEach(function (input) {
                let event = new Event('blur');
                input.dispatchEvent(event);
            });
        }
    }

    calculateButton.on('click', function (event) {
        // Проверяем, что все поля ввода заполнены
        event.preventDefault();
        if (_tmr) {
            _tmr.push({ type: 'reachGoal', id: 3555455, goal: 'calculate_button'});
        }
        if (activeButton.dataset.type === 'white' || activeButton.dataset.type === 'comparison') {
            prepFields();
            cleanFieldsWhite();
            sendWhiteMultipleAjaxRequests().catch(() => {});
        }
        event.preventDefault();
        event.stopPropagation();
    });

    let $offerButtons = $(".offer-button");
    $offerButtons.on('click', function (event) {
        event.preventDefault();
        event.stopPropagation();
        if (document.querySelector('.list-help.selected').closest('ul').firstElementChild.querySelector('li .list-help').classList.contains('white-help')) {
            if (_tmr) {
                _tmr.push({ type: 'reachGoal', id: 3555455, goal: 'calculate_offer'});
            }
            ajaxWhiteOfferDataRequest(
                document.querySelector('.list-help.selected').closest('.desc').querySelector('.delivery-types-dropdown').dataset.delivery_type,
                document.querySelector('.list-help.selected').closest('.desc').querySelector('.delivery-types-dropdown').dataset.delivery_type_rus,
                document.querySelector('.list-help.selected').querySelector('.tk-type').textContent.trim(),
            );
            // document.querySelector('.pop-up-dark-back-offer').style.display = 'flex';
        }
        event.preventDefault();
        event.stopPropagation();
    });

    // let $offerButton = $(".pop-up-offer-button");
    // $offerButton.on('click', function (event) {
    //     event.stopPropagation();
    //     event.preventDefault();
    //     let notice = document.querySelector('.pop-up-email').nextElementSibling;
    //     if (document.querySelector('.pop-up-email').value !== '') {
    //         if (document.querySelector('.list-help.selected').closest('ul').firstElementChild.querySelector('li .list-help').classList.contains('white-help')) {
    //             ajaxWhiteOfferDataRequest(
    //                 document.querySelector('.list-help.selected').closest('.desc').querySelector('.delivery-types-dropdown').dataset.delivery_type,
    //                 document.querySelector('.list-help.selected').closest('.desc').querySelector('.delivery-types-dropdown').dataset.delivery_type_rus,
    //             );
    //         }
    //         hideNoticePopUp();
    //
    //     }
    //     else {
    //         notice.textContent = "заполните " + '"EMail"';
    //         notice.style.display = 'block'; // Отобразить надпись
    //         document.querySelector('.pop-up-email').style.border = '1px solid #a81d29';
    //     }
    //     event.stopPropagation();
    //     event.preventDefault();
    // });

    function handleBoxingChangeWhite() {
        if (activeButton.dataset.type === 'white' || activeButton.dataset.type === 'comparison') {
            sendWhiteMultipleAjaxRequests().catch(() => {});
        }
    }

    let $boxing = $(".boxing");
    $boxing.off('change', handleBoxingChangeWhite);
    $boxing.on('change', handleBoxingChangeWhite);

    function sendDLAjaxRequest(response) {

        return new Promise((resolve, reject) => {
            showAwait('.white-cost-elem', 'dl', true);
            $.ajax({
                type: "GET",
                url: "https://api-calc.wisetao.com:4343/api/calculate-dl-delivery",
                data: {
                    arrival: $arrival.val(),
                    total_volume: totalVolume,
                    total_weight: totalWeight,
                    // count: count,
                    // max_dimension: maxDimension,
                    from: 'Благовещенск',
                },
                success: function (dlResponse) {
                    updatePageWithDLResponse(response, dlResponse);
                    showAwait('.white-cost-elem', 'dl', false);
                    dlResponse.tkType = 'ДЛ';
                    offerDataDL = dlResponse;
                    console.log("Успешно отправлен второй запрос!");
                    console.log("Ответ второго запроса:", dlResponse);
                    resolve();
                },
                error: function (dlError) {
                    // Обработка ошибки второго запроса
                    console.error("Ошибка при отправке второго запроса:", dlError);
                    showAwait('.white-cost-elem', 'dl', false);
                    reject(dlError);
                }
            });
        });
    }

    function sendPEKAjaxRequest(response) {
        // Отправляем третий запрос
        return new Promise((resolve, reject) => {
            showAwait('.white-cost-elem', 'pek', true);
            $.ajax({
                type: "GET",
                url: "https://api-calc.wisetao.com:4343/api/calculate-pek-delivery",
                data: {
                    arrival: $arrival.val(),
                    total_volume: totalVolume,
                    total_weight: totalWeight,
                    // count: count,
                    // max_dimension: maxDimension,
                    from: 'Благовещенск',
                },
                success: function (pekResponse) {
                    updatePageWithPekResponse(response, pekResponse);
                    showAwait('.white-cost-elem', 'pek', false);
                    pekResponse.tkType = 'ПЕК';
                    offerDataPEK = pekResponse;
                    // Обработка успешного выполнения третьего запроса
                    console.log("Успешно отправлен третий запрос!");
                    console.log("Ответ сервера (третий запрос):", pekResponse);
                    resolve();
                    // Обновление значений на странице согласно третьему запросу
                    // ... (обновления значений на странице согласно вашим требованиям)
                },
                error: function (error) {
                    // Обработка ошибок при отправке третьего запроса
                    console.error("Ошибка при отправке третьего запроса:", error);
                    showAwait('.white-cost-elem', 'pek', false);
                    reject(error);

                },
            });
        });
    }

    function sendJDEAjaxRequest(response) {

        // Отправляем третий запрос
        return new Promise((resolve, reject) => {
            showAwait('.white-cost-elem', 'jde', true);
            $.ajax({
                type: "GET",
                url: "https://api-calc.wisetao.com:4343/api/calculate-railway-expedition-delivery",
                data: {
                    arrival: $arrival.val(),
                    total_volume: totalVolume,
                    total_weight: totalWeight,
                    // count: count,
                    // max_dimension: maxDimension,
                    from: 'Благовещенск',
                },
                success: function (jdeResponse) {

                    updatePageWithJDEResponse(response, jdeResponse);
                    // Выключаем анимацию и скрываем элементы с анимацией
                    showAwait('.white-cost-elem', 'jde', false);
                    jdeResponse.tkType = 'ЖДЭ';
                    offerDataJDE = jdeResponse;
                    // Обработка успешного выполнения третьего запроса
                    console.log("Успешно отправлен четвертый запрос!");
                    console.log("Ответ сервера (четвертый запрос):", jdeResponse);
                    resolve();
                    // Обновление значений на странице согласно третьему запросу
                    // ... (обновления значений на странице согласно вашим требованиям)
                },
                error: function (error) {
                    // Обработка ошибок при отправке третьего запроса
                    console.error("Ошибка при отправке четвертого запроса:", error);
                    reject(error);
                    // Выключаем анимацию и скрываем элементы с анимацией
                    showAwait('.white-cost-elem', 'jde', false);
                },
            });
        });
    }

    function sendKITAjaxRequest(response) {

        // Отправляем пятый запрос
        return new Promise((resolve, reject) => {
            showAwait('.white-cost-elem', 'kit', true);
            $.ajax({
                type: "GET",
                url: "https://api-calc.wisetao.com:4343/api/calculate-kit-delivery",
                data: {
                    arrival: $arrival.val(),
                    total_volume: totalVolume,
                    total_weight: totalWeight,
                    // count: count,
                    // max_dimension: maxDimension,
                    price: totalCost,
                    from: 'Благовещенск',
                },
                success: function (kitResponse) {

                    updatePageWithKITResponse(response, kitResponse);
                    showAwait('.white-cost-elem', 'kit', false);
                    kitResponse.tkType = 'КИТ';
                    offerDataKIT = kitResponse;
                    // Обработка успешного выполнения пятого запроса
                    console.log("Успешно отправлен пятый запрос!");
                    console.log("Ответ сервера (пятый запрос):", kitResponse);
                    resolve();
                    // Обновление значений на странице согласно пятому запросу
                    // ... (обновления значений на странице согласно вашим требованиям)
                },
                error: function (error) {
                    // Обработка ошибок при отправке пятого запроса
                    showAwait('.white-cost-elem', 'kit', false);
                    console.error("Ошибка при отправке пятого запроса:", error);
                    reject(error);
                },
            });
        });
    }

    function updatePageWithWhiteResponse(response) {

        $("#delivery-types-dropdown-auto" + postfix + " .cost-elem.white .kg").html("$" +  (kg + packagingPrice / totalWeight).toFixed(2) + ' - ' + "₽" + (kgRub + packagingPrice * exchangeRateSaide / totalWeight).toFixed(2));
        $("#delivery-types-dropdown-auto" + postfix + " .cost-elem.white .sum .sum-dollar").html("$" + (total + packagingPrice).toFixed(2));
        $("#delivery-types-dropdown-auto" + postfix + " .cost-elem.white .sum .sum-rub").html("₽" + (parseFloat(totalRub) + packagingPrice * exchangeRateSaide).toFixed(2));

        $("#delivery-types-dropdown-auto" + postfix + " .white-help .balloon-container .total").html((total + packagingPrice).toFixed(2) + "$" + semicolonHelp + (parseFloat(totalRub) + packagingPrice * exchangeRateSaide).toFixed(2) + "₽");
        $("#delivery-types-dropdown-auto" + postfix + " .white-help .balloon-container .total-customs").html(totalCustoms + "$" + semicolonHelp + totalCustomsRub + "₽");
        $("#delivery-types-dropdown-auto" + postfix + " .white-help .balloon-container .sum-saide").html(sumRateSaide + "$" + semicolonHelp + sumRateSaideRub + "₽");
        $("#delivery-types-dropdown-auto" + postfix + " .white-help .balloon-container .fees").text(fees + "$");
        $("#delivery-types-dropdown-auto" + postfix + " .white-help .balloon-container .total-nds").text(totalNds + "$");
        $("#delivery-types-dropdown-auto" + postfix + " .white-help .balloon-container .total-duty").text(totalDuty + "$");
        $("#delivery-types-dropdown-auto" + postfix + " .white-help .balloon-container .redeem-commission").html((ransomGoods * yuan / exchangeRateSaide).toFixed(2) + "$" + semicolonHelp + (ransomGoods * yuan).toFixed(2) + "₽");
        $("#delivery-types-dropdown-auto" + postfix + " .white-help .balloon-container .packaging-price").html(packagingPrice + "$" + semicolonHelp + (packagingPrice * exchangeRateSaide).toFixed(2) + "₽");
        $("#delivery-types-dropdown-auto" + postfix + " .white-help .balloon-container .boxing-type").text(typeOfPackaging);
        $("#delivery-types-dropdown-auto" + postfix + " .white-help .balloon-container .exchange-saide").html("$: " + exchangeRateSaide + "₽" + semicolonHelp + ' ¥: ' + yuan + "₽");
        $("#delivery-types-dropdown-auto" + postfix + " .white-help .balloon-container .sum-duty").text(sumDuty);

        // Обновляем значения для delivery-types-dropdown-fast-auto
        $("#delivery-types-dropdown-fast-auto" + postfix + " .cost-elem.white .kg").html("$" + (kg + packagingPrice / totalWeight).toFixed(2) + ' - ' + "₽" + (kgRub + packagingPrice * exchangeRateSaide / totalWeight).toFixed(2));
        $("#delivery-types-dropdown-fast-auto" + postfix + " .cost-elem.white .sum .sum-dollar").html("$" + (total + packagingPrice).toFixed(2));
        $("#delivery-types-dropdown-fast-auto" + postfix + " .cost-elem.white .sum .sum-rub").html("₽" + (parseFloat(totalRub) + packagingPrice * exchangeRateSaide).toFixed(2));
        $("#delivery-types-dropdown-fast-auto" + postfix + " .white-help .balloon-container .total").html((total + packagingPrice).toFixed(2) + "$" + semicolonHelp + (parseFloat(totalRub) + packagingPrice * exchangeRateSaide).toFixed(2) + "₽");
        $("#delivery-types-dropdown-fast-auto" + postfix + " .white-help .balloon-container .total-customs").html(totalCustoms + "$" + semicolonHelp + totalCustomsRub + "₽");
        $("#delivery-types-dropdown-fast-auto" + postfix + " .white-help .balloon-container .sum-saide").html(sumRateSaide + "$" + semicolonHelp + sumRateSaideRub + "₽");
        $("#delivery-types-dropdown-fast-auto" + postfix + " .white-help .balloon-container .fees").text(fees + "$");
        $("#delivery-types-dropdown-fast-auto" + postfix + " .white-help .balloon-container .total-nds").text(totalNds + "$");
        $("#delivery-types-dropdown-fast-auto" + postfix + " .white-help .balloon-container .total-duty").text(totalDuty + "$");
        $("#delivery-types-dropdown-fast-auto" + postfix + " .white-help .balloon-container .redeem-commission").html((ransomGoods * yuan / exchangeRateSaide).toFixed(2) + "$" + semicolonHelp + (ransomGoods * yuan).toFixed(2) + "₽");
        $("#delivery-types-dropdown-fast-auto" + postfix + " .white-help .balloon-container .packaging-price").html(packagingPrice + "$" + semicolonHelp + (packagingPrice * exchangeRateSaide).toFixed(2) + "₽");
        $("#delivery-types-dropdown-fast-auto" + postfix + " .white-help .balloon-container .boxing-type").text(typeOfPackaging);
        $("#delivery-types-dropdown-fast-auto" + postfix + " .white-help .balloon-container .exchange-saide").html("$: " + exchangeRateSaide + "₽" + semicolonHelp + ' ¥: ' + yuan + "₽");
        $("#delivery-types-dropdown-fast-auto" + postfix + " .white-help .balloon-container .sum-duty").text(sumDuty + "$");

        // Обновляем значения для delivery-types-dropdown-railway
        $("#delivery-types-dropdown-railway" + postfix + " .cost-elem.white .kg").html("$" + (kg + packagingPrice / totalWeight).toFixed(2) + ' - ' + "₽" + (kgRub + packagingPrice * exchangeRateSaide / totalWeight).toFixed(2));
        $("#delivery-types-dropdown-railway" + postfix + " .cost-elem.white .sum .sum-dollar").html("$" + (total + packagingPrice).toFixed(2));
        $("#delivery-types-dropdown-railway" + postfix + " .cost-elem.white .sum .sum-rub").html("₽" + (parseFloat(totalRub) + packagingPrice * exchangeRateSaide).toFixed(2));
        $("#delivery-types-dropdown-railway" + postfix + " .white-help .balloon-container .balloon-container .total").html((total + packagingPrice).toFixed(2) + "$" + semicolonHelp + (parseFloat(totalRub) + packagingPrice * exchangeRateSaide).toFixed(2) + "₽");
        $("#delivery-types-dropdown-railway" + postfix + " .white-help .balloon-container .total-customs").html(totalCustoms + "$" + semicolonHelp + totalCustomsRub + "₽");
        $("#delivery-types-dropdown-railway" + postfix + " .white-help .balloon-container .sum-saide").html(sumRateSaide + "$" + semicolonHelp + sumRateSaideRub + "₽");
        $("#delivery-types-dropdown-railway" + postfix + " .white-help .balloon-container .fees").text(fees + "$");
        $("#delivery-types-dropdown-railway" + postfix + " .white-help .balloon-container .total-nds").text(totalNds + "$");
        $("#delivery-types-dropdown-railway" + postfix + " .white-help .balloon-container .total-duty").text(totalDuty + "$");
        $("#delivery-types-dropdown-railway" + postfix + " .white-help .balloon-container .redeem-commission").html((ransomGoods * yuan / exchangeRateSaide).toFixed(2) + "$" + semicolonHelp + (ransomGoods * yuan).toFixed(2) + "₽");
        $("#delivery-types-dropdown-railway" + postfix + " .white-help .balloon-container .packaging-price").html(packagingPrice + "$" + semicolonHelp + (packagingPrice * exchangeRateSaide).toFixed(2) + "₽");
        $("#delivery-types-dropdown-railway" + postfix + " .white-help .balloon-container .boxing-type").text(typeOfPackaging);
        $("#delivery-types-dropdown-railway" + postfix + " .white-help .balloon-container .exchange-saide").html("$: " + exchangeRateSaide + "₽" + semicolonHelp + ' ¥: ' + yuan + "₽");
        $("#delivery-types-dropdown-railway" + postfix + " .white-help .balloon-container .sum-duty").text(sumDuty + "$");

        // Обновляем значения для delivery-types-dropdown-railway
        $("#delivery-types-dropdown-avia" + postfix + " .cost-elem.white .kg").html("$" + (kg + packagingPrice / totalWeight).toFixed(2) + ' - ' + "₽" + (kgRub + packagingPrice * exchangeRateSaide / totalWeight).toFixed(2));
        $("#delivery-types-dropdown-avia" + postfix + " .cost-elem.white .sum .sum-dollar").html("$" + (total + packagingPrice).toFixed(2));
        $("#delivery-types-dropdown-avia" + postfix + " .cost-elem.white .sum .sum-rub").html("₽" + (parseFloat(totalRub) + packagingPrice * exchangeRateSaide).toFixed(2));
        $("#delivery-types-dropdown-avia" + postfix + " .white-help .balloon-container .total").html((total + packagingPrice).toFixed(2) + "$" + semicolonHelp + (parseFloat(totalRub) + packagingPrice * exchangeRateSaide).toFixed(2) + "₽");
        $("#delivery-types-dropdown-avia" + postfix + " .white-help .balloon-container .total-customs").html(totalCustoms + "$" + semicolonHelp + totalCustomsRub + "₽");
        $("#delivery-types-dropdown-avia" + postfix + " .white-help .balloon-container .sum-saide").html(sumRateSaide + "$" + semicolonHelp + sumRateSaideRub + "₽");
        $("#delivery-types-dropdown-avia" + postfix + " .white-help .balloon-container .fees").text(fees + "$");
        $("#delivery-types-dropdown-avia" + postfix + " .white-help .balloon-container .total-nds").text(totalNds + "$");
        $("#delivery-types-dropdown-avia" + postfix + " .white-help .balloon-container .total-duty").text(totalDuty + "$");
        $("#delivery-types-dropdown-avia" + postfix + " .white-help .balloon-container .redeem-commission").html((ransomGoods * yuan / exchangeRateSaide).toFixed(2) + "$" + semicolonHelp + (ransomGoods * yuan).toFixed(2) + "₽");
        $("#delivery-types-dropdown-avia" + postfix + " .white-help .balloon-container .packaging-price").html(packagingPrice + "$" + semicolonHelp + (packagingPrice * exchangeRateSaide).toFixed(2) + "₽");
        $("#delivery-types-dropdown-avia" + postfix + " .white-help .balloon-container .boxing-type").text(typeOfPackaging);
        $("#delivery-types-dropdown-avia" + postfix + " .white-help .balloon-container .exchange-saide").html("$: " + exchangeRateSaide + "₽" + semicolonHelp + ' ¥: ' + yuan + "₽");
        $("#delivery-types-dropdown-avia" + postfix + " .white-help .balloon-container .sum-duty").text(sumDuty + "$");

        $("#delivery-types-dropdown-auto" + postfix + " .white-help .balloon-container .licenses").html('ЛИЦЕНЗИЯ:');
        $("#delivery-types-dropdown-auto" + postfix + " .white-help .balloon-container .cargo-certificates").html('СЕРТИФИКАТ:');
        $("#delivery-types-dropdown-fast-auto" + postfix + " .white-help .balloon-container .licenses").html('ЛИЦЕНЗИЯ:');
        $("#delivery-types-dropdown-fast-auto" + postfix + " .white-help .balloon-container .cargo-certificates").html('СЕРТИФИКАТ:');
        $("#delivery-types-dropdown-railway" + postfix + " .white-help .balloon-container .licenses").html('ЛИЦЕНЗИЯ:');
        $("#delivery-types-dropdown-railway" + postfix + " .white-help .balloon-container .cargo-certificates").html('СЕРТИФИКАТ:');
        $("#delivery-types-dropdown-avia" + postfix + " .white-help .balloon-container .licenses").html('ЛИЦЕНЗИЯ:');
        $("#delivery-types-dropdown-avia" + postfix + " .white-help .balloon-container .cargo-certificates").html('СЕРТИФИКАТ:');

        certificate.forEach((item, index) => {
            $("#delivery-types-dropdown-auto" + postfix + " .white-help .balloon-container .licenses").append(`
                <div class="help-text-content-white" style="color: black; text-align: left; margin-left: 2px; word-wrap: break-word;">
                    <span class="code-customs code">${codes[index]}: </span><span class="val-customs licence" style="margin-bottom: 3px">${license[index]}</span>
                </div>
            `);
            $("#delivery-types-dropdown-auto" + postfix + " .white-help .balloon-container .cargo-certificates").append(`
                <div class="help-text-content-white" style="color: black; text-align: left; margin-left: 2px; word-wrap: break-word; margin-bottom: 3px">
                    <span class="code-customs code">${codes[index]}: </span><span class="val-customs certificate" style="margin-bottom: 3px">${certificate[index]}</span>
                </div>
            `);
            $("#delivery-types-dropdown-fast-auto" + postfix + " .white-help .balloon-container .licenses").append(`
                <div class="help-text-content-white" style="color: black; text-align: left; margin-left: 2px; word-wrap: break-word;">
                    <span class="code-customs code">${codes[index]}: </span><span class="val-customs licence" style="margin-bottom: 3px">${license[index]}</span>
                </div>
            `);
            $("#delivery-types-dropdown-fast-auto" + postfix + " .white-help .balloon-container .cargo-certificates").append(`
                <div class="help-text-content-white" style="color: black; text-align: left; margin-left: 2px; word-wrap: break-word; margin-bottom: 3px">
                    <span class="code-customs code">${codes[index]}: </span><span class="val-customs certificate" style="margin-bottom: 3px">${certificate[index]}</span>
                </div>
            `);
            $("#delivery-types-dropdown-railway" + postfix + " .white-help .balloon-container .licenses").append(`
                <div class="help-text-content-white" style="color: black; text-align: left; margin-left: 2px; word-wrap: break-word;">
                    <span class="code-customs code">${codes[index]}: </span><span class="val-customs licence" style="margin-bottom: 3px">${license[index]}</span>
                </div>
            `);
            $("#delivery-types-dropdown-railway" + postfix + " .white-help .balloon-container .cargo-certificates").append(`
                <div class="help-text-content-white" style="color: black; text-align: left; margin-left: 2px; word-wrap: break-word; margin-bottom: 3px">
                    <span class="code-customs code">${codes[index]}: </span><span class="val-customs certificate" style="margin-bottom: 3px">${certificate[index]}</span>
                </div>
            `);
            $("#delivery-types-dropdown-avia" + postfix + " .white-help .balloon-container .licenses").append(`
                <div class="help-text-content-white" style="color: black; text-align: left; margin-left: 2px; word-wrap: break-word;">
                    <span class="code-customs code">${codes[index]}: </span><span class="val-customs licence" style="margin-bottom: 3px">${license[index]}</span>
                </div>
            `);
            $("#delivery-types-dropdown-avia" + postfix + " .white-help .balloon-container .cargo-certificates").append(`
                <div class="help-text-content-white" style="color: black; text-align: left; margin-left: 2px; word-wrap: break-word; margin-bottom: 3px">
                    <span class="code-customs code">${codes[index]}: </span><span class="val-customs certificate" style="margin-bottom: 3px">${certificate[index]}</span>
                </div>
            `);
        })
    }

    function updatePageWithDLResponse(response, dlResponse) {

        let autoRegularKg = dlResponse.sum_cost_price.auto_regular === 'н/д' ? 'н/д' : ((parseFloat(total) + parseFloat(dlResponse.sum_cost_price.auto_regular)) / totalWeight).toFixed(2);
        let autoRegularKgRub = dlResponse.sum_cost_price_rub.auto_regular === 'н/д' ? 'н/д' : ((parseFloat(totalRub) + parseFloat(dlResponse.sum_cost_price_rub.auto_regular)) / totalWeight).toFixed(2);
        let autoRegularKgDl = dlResponse.sum_cost_price.auto_regular === 'н/д' ? 'н/д' : ((parseFloat(dlResponse.sum_cost_price.auto_regular) / totalWeight).toFixed(2));
        let autoRegularKgRubDl = dlResponse.sum_cost_price_rub.auto_regular === 'н/д' ? 'н/д' : ((parseFloat(dlResponse.sum_cost_price_rub.auto_regular) / totalWeight).toFixed(2));

        $("#delivery-types-dropdown-auto" + postfix + " .cost-elem.dl .kg").html(autoRegularKg === 'н/д' ? "$н/д" + ' - ' + " ₽н/д" : "$" + (parseFloat(autoRegularKg) + packagingPrice / totalWeight).toFixed(2) + ' - ' + '₽' + (parseFloat(autoRegularKgRub) + packagingPrice * exchangeRateSaide / totalWeight).toFixed(2));
        $("#delivery-types-dropdown-auto" + postfix + " .cost-elem.dl .sum .sum-dollar").html(autoRegularKg === 'н/д' ? "$н/д" : "$" + (autoRegularKg * totalWeight + packagingPrice).toFixed(2));
        $("#delivery-types-dropdown-auto" + postfix + " .cost-elem.dl .sum .sum-rub").html(autoRegularKg === 'н/д'? "₽н/д" : "₽" + (autoRegularKgRub * totalWeight + packagingPrice * exchangeRateSaide).toFixed(2));

        // Обновление элементов внутри delivery-types-dropdown-fast-auto
        let autoFastKg = dlResponse.sum_cost_price.auto_fast === 'н/д' ? 'н/д' : ((parseFloat(total) + parseFloat(dlResponse.sum_cost_price.auto_fast)) / totalWeight).toFixed(2);
        let autoFastKgRub = dlResponse.sum_cost_price_rub.auto_fast === 'н/д' ? 'н/д' : ((parseFloat(totalRub) + parseFloat(dlResponse.sum_cost_price_rub.auto_fast)) / totalWeight).toFixed(2);
        let autoFastKgDl = dlResponse.sum_cost_price.auto_fast === 'н/д' ? 'н/д' : ((parseFloat(dlResponse.sum_cost_price.auto_fast) / totalWeight).toFixed(2));
        let autoFastKgRubDl = dlResponse.sum_cost_price_rub.auto_fast === 'н/д' ? 'н/д' : ((parseFloat(dlResponse.sum_cost_price_rub.auto_fast) / totalWeight).toFixed(2));

        $("#delivery-types-dropdown-fast-auto" + postfix + " .cost-elem.dl .kg").html(autoFastKg === 'н/д' ? "$н/д" + ' - ' + " ₽н/д" : "$" + (parseFloat(autoFastKg) + packagingPrice / totalWeight).toFixed(2) + ' - ' + "₽" + (parseFloat(autoFastKgRub) + packagingPrice * exchangeRateSaide / totalWeight).toFixed(2));
        $("#delivery-types-dropdown-fast-auto" + postfix + " .cost-elem.dl .sum .sum-dollar").html(autoFastKg === 'н/д' ? "$н/д" : "$" + (autoFastKg * totalWeight + packagingPrice).toFixed(2));
        $("#delivery-types-dropdown-fast-auto" + postfix + " .cost-elem.dl .sum .sum-rub").html(autoFastKg === 'н/д' ? "₽н/д" : "₽" + (autoFastKgRub * totalWeight + packagingPrice * exchangeRateSaide).toFixed(2));

        // Обновление элементов внутри delivery-types-dropdown-avia
        let aviaKg = dlResponse.sum_cost_price.avia === 'н/д' ? 'н/д' : ((parseFloat(total) + parseFloat(dlResponse.sum_cost_price.avia)) / totalWeight).toFixed(2);
        let aviaKgRub = dlResponse.sum_cost_price_rub.avia === 'н/д' ? 'н/д' : ((parseFloat(totalRub) + parseFloat(dlResponse.sum_cost_price_rub.avia)) / totalWeight).toFixed(2);
        let aviaKgDl = dlResponse.sum_cost_price.avia === 'н/д' ? 'н/д' : ((parseFloat(dlResponse.sum_cost_price.avia) / totalWeight).toFixed(2));
        let aviaKgRubDl = dlResponse.sum_cost_price_rub.avia === 'н/д' ? 'н/д' : ((parseFloat(dlResponse.sum_cost_price_rub.avia) / totalWeight).toFixed(2));

        $("#delivery-types-dropdown-avia" + postfix + " .cost-elem.dl .kg").html(aviaKg === 'н/д' ? "$н/д" + semicolon + "₽н/д" : "$" + (parseFloat(aviaKg) + packagingPrice / totalWeight).toFixed(2) + ' - ' + "₽" + (parseFloat(aviaKgRub) + packagingPrice * exchangeRateSaide / totalWeight).toFixed(2));
        $("#delivery-types-dropdown-avia" + postfix + " .cost-elem.dl .sum .sum-dollar").html(aviaKg === 'н/д' ? "$н/д" : "$" + (aviaKg * totalWeight + packagingPrice).toFixed(2));
        $("#delivery-types-dropdown-avia" + postfix + " .cost-elem.dl .sum .sum-rub").html(aviaKg === 'н/д' ? "₽н/д" : "₽" + (aviaKgRub * totalWeight + packagingPrice * exchangeRateSaide).toFixed(2));

        // Обновление элементов внутри delivery-types-dropdown-auto dl-help
        $("#delivery-types-dropdown-auto" + postfix + " .dl-help .balloon-container .kg").html(autoRegularKgDl === 'н/д' ? "$н/д" + semicolonHelp + " ₽н/д" : parseFloat(autoRegularKgDl) + "$" + semicolonHelp + autoRegularKgRubDl + "₽");
        $("#delivery-types-dropdown-auto" + postfix + " .dl-help .balloon-container .sum").html(autoRegularKgDl === 'н/д' ? "$н/д" + semicolonHelp + " ₽н/д" : (autoRegularKgDl * totalWeight).toFixed(2) + "$" + semicolonHelp + (autoRegularKgRubDl * totalWeight).toFixed(2) + "₽");
        $("#delivery-types-dropdown-auto" + postfix + " .dl-help .balloon-container .total").html(autoRegularKg === 'н/д' ? "$н/д" + semicolonHelp + " ₽н/д" : (autoRegularKg * totalWeight + packagingPrice).toFixed(2) + "$" + semicolonHelp + (autoRegularKgRub * totalWeight + packagingPrice * exchangeRateSaide).toFixed(2) + "₽");
        $("#delivery-types-dropdown-auto" + postfix + " .dl-help .balloon-container .total-customs").html(totalCustoms + "$" + semicolonHelp + totalCustomsRub + "₽");
        $("#delivery-types-dropdown-auto" + postfix + " .dl-help .balloon-container .sum-saide").html(sumRateSaide + "$" + semicolonHelp + sumRateSaideRub + "₽");
        $("#delivery-types-dropdown-auto" + postfix + " .dl-help .balloon-container .fees").text(fees + "$");
        $("#delivery-types-dropdown-auto" + postfix + " .dl-help .balloon-container .total-nds").text(totalNds + "$");
        $("#delivery-types-dropdown-auto" + postfix + " .dl-help .balloon-container .total-duty").text(totalDuty + "$");
        $("#delivery-types-dropdown-auto" + postfix + " .dl-help .balloon-container .redeem-commission").html((ransomGoods * yuan / exchangeRateSaide).toFixed(2) + "$" + semicolonHelp + (ransomGoods * yuan).toFixed(2) + "₽");
        $("#delivery-types-dropdown-auto" + postfix + " .dl-help .balloon-container .packaging-price").html(packagingPrice + "$" + semicolonHelp + (packagingPrice * exchangeRateSaide).toFixed(2) + "₽");
        $("#delivery-types-dropdown-auto" + postfix + " .dl-help .balloon-container .boxing-type").text(typeOfPackaging);
        $("#delivery-types-dropdown-auto" + postfix + " .dl-help .balloon-container .exchange-saide").html("$: " + exchangeRateSaide + "₽" + semicolonHelp + ' ¥: ' + yuan + "₽");
        $("#delivery-types-dropdown-auto" + postfix + " .dl-help .balloon-container .sum-duty").text(sumDuty);

        // Обновление элементов внутри delivery-types-dropdown-fast-auto dl-help
        $("#delivery-types-dropdown-fast-auto" + postfix + " .dl-help .balloon-container .kg").html(autoFastKgDl === 'н/д' ? "$н/д" + semicolonHelp + " ₽н/д" : parseFloat(autoFastKgDl) + "$" + semicolonHelp + autoFastKgRubDl + "₽");
        $("#delivery-types-dropdown-fast-auto" + postfix + " .dl-help .balloon-container .sum").html(autoFastKgDl === 'н/д' ? "$н/д" + semicolonHelp + " ₽н/д" : (autoFastKgDl * totalWeight).toFixed(2) + "$" + semicolonHelp + (autoFastKgRubDl * totalWeight).toFixed(2) + "₽");
        $("#delivery-types-dropdown-fast-auto" + postfix + " .dl-help .balloon-container .total").html(autoFastKg === 'н/д' ? "$н/д" + semicolonHelp + " ₽н/д" : (autoFastKg * totalWeight + packagingPrice).toFixed(2) + "$" + semicolonHelp + (autoFastKgRub * totalWeight + packagingPrice * exchangeRateSaide).toFixed(2) + "₽");
        $("#delivery-types-dropdown-fast-auto" + postfix + " .dl-help .balloon-container .total-customs").html(totalCustoms + "$" + semicolonHelp + totalCustomsRub + "₽");
        $("#delivery-types-dropdown-fast-auto" + postfix + " .dl-help .balloon-container .sum-saide").html(sumRateSaide + "$" + semicolonHelp + sumRateSaideRub + "₽");
        $("#delivery-types-dropdown-fast-auto" + postfix + " .dl-help .balloon-container .fees").text(fees + "$");
        $("#delivery-types-dropdown-fast-auto" + postfix + " .dl-help .balloon-container .total-nds").text(totalNds + "$");
        $("#delivery-types-dropdown-fast-auto" + postfix + " .dl-help .balloon-container .total-duty").text(totalDuty + "$");
        $("#delivery-types-dropdown-fast-auto" + postfix + " .dl-help .balloon-container .redeem-commission").html((ransomGoods * yuan / exchangeRateSaide).toFixed(2) + "$" + semicolonHelp + (ransomGoods * yuan).toFixed(2) + "₽");
        $("#delivery-types-dropdown-fast-auto" + postfix + " .dl-help .balloon-container .packaging-price").html(packagingPrice + "$" + semicolonHelp + (packagingPrice * exchangeRateSaide).toFixed(2) + "₽");
        $("#delivery-types-dropdown-fast-auto" + postfix + " .dl-help .balloon-container .boxing-type").text(typeOfPackaging);
        $("#delivery-types-dropdown-fast-auto" + postfix + " .dl-help .balloon-container .exchange-saide").html("$: " + exchangeRateSaide + "₽" + semicolonHelp + ' ¥: ' + yuan + "₽");
        $("#delivery-types-dropdown-fast-auto" + postfix + " .dl-help .balloon-container .sum-duty").text(sumDuty);

        // Обновление элементов внутри delivery-types-dropdown-avia dl-help
        $("#delivery-types-dropdown-avia" + postfix + " .dl-help .balloon-container .kg").html(aviaKgDl === 'н/д' ? "$н/д" + semicolonHelp + " ₽н/д" : parseFloat(aviaKgDl) + "$" + semicolonHelp + aviaKgRubDl + "₽");
        $("#delivery-types-dropdown-avia" + postfix + " .dl-help .balloon-container .sum").html(aviaKgDl === 'н/д' ? "$н/д" + semicolonHelp + " ₽н/д" : (aviaKgDl * totalWeight).toFixed(2) + "$" + semicolonHelp + (aviaKgRubDl * totalWeight).toFixed(2) + "₽");
        $("#delivery-types-dropdown-avia" + postfix + " .dl-help .balloon-container .total").html(aviaKg === 'н/д' ? "$н/д" + semicolonHelp + " ₽н/д" : (aviaKg * totalWeight + packagingPrice).toFixed(2) + "$" + semicolonHelp + (aviaKgRub * totalWeight + packagingPrice * exchangeRateSaide).toFixed(2) + "₽");
        $("#delivery-types-dropdown-avia" + postfix + " .dl-help .balloon-container .total-customs").html(totalCustoms + "$" + semicolonHelp + totalCustomsRub + "₽");
        $("#delivery-types-dropdown-avia" + postfix + " .dl-help .balloon-container .sum-saide").html(sumRateSaide + "$" + semicolonHelp + sumRateSaideRub + "₽");
        $("#delivery-types-dropdown-avia" + postfix + " .dl-help .balloon-container .fees").text(fees + "$");
        $("#delivery-types-dropdown-avia" + postfix + " .dl-help .balloon-container .total-nds").text(totalNds + "$");
        $("#delivery-types-dropdown-avia" + postfix + " .dl-help .balloon-container .total-duty").text(totalDuty + "$");
        $("#delivery-types-dropdown-avia" + postfix + " .dl-help .balloon-container .redeem-commission").html((ransomGoods * yuan / exchangeRateSaide).toFixed(2) + "$" + semicolonHelp + (ransomGoods * yuan).toFixed(2) + "₽");
        $("#delivery-types-dropdown-avia" + postfix + " .dl-help .balloon-container .packaging-price").html(packagingPrice + "$" + semicolonHelp + (packagingPrice * exchangeRateSaide).toFixed(2) + "₽");
        $("#delivery-types-dropdown-avia" + postfix + " .dl-help .balloon-container .boxing-type").text(typeOfPackaging);
        $("#delivery-types-dropdown-avia" + postfix + " .dl-help .balloon-container .exchange-saide").html("$: " + exchangeRateSaide + "₽" + semicolonHelp + ' ¥: ' + yuan + "₽");
        $("#delivery-types-dropdown-avia" + postfix + " .dl-help .balloon-container .sum-duty").text(sumDuty);

        $("#delivery-types-dropdown-auto" + postfix + " .dl-help .balloon-container .licenses").html('ЛИЦЕНЗИЯ:');
        $("#delivery-types-dropdown-auto" + postfix + " .dl-help .balloon-container .cargo-certificates").html('СЕРТИФИКАТ:');
        $("#delivery-types-dropdown-fast-auto" + postfix + " .dl-help .balloon-container .licenses").html('ЛИЦЕНЗИЯ:');
        $("#delivery-types-dropdown-fast-auto" + postfix + " .dl-help .balloon-container .cargo-certificates").html('СЕРТИФИКАТ:');
        $("#delivery-types-dropdown-railway" + postfix + " .dl-help .balloon-container .licenses").html('ЛИЦЕНЗИЯ:');
        $("#delivery-types-dropdown-railway" + postfix + " .dl-help .balloon-container .cargo-certificates").html('СЕРТИФИКАТ:');
        $("#delivery-types-dropdown-avia" + postfix + " .dl-help .balloon-container .licenses").html('ЛИЦЕНЗИЯ:');
        $("#delivery-types-dropdown-avia" + postfix + " .dl-help .balloon-container .cargo-certificates").html('СЕРТИФИКАТ:');

        certificate.forEach((item, index) => {
            $("#delivery-types-dropdown-auto" + postfix + " .dl-help .balloon-container .licenses").append(`
                <div class="help-text-content-white" style="color: black; text-align: left; margin-left: 2px; word-wrap: break-word;">
                    <span class="code-customs code">${codes[index]}: </span><span class="val-customs licence" style="margin-bottom: 3px">${license[index]}</span>
                </div>
            `);
            $("#delivery-types-dropdown-auto" + postfix + " .dl-help .balloon-container .cargo-certificates").append(`
                <div class="help-text-content-white" style="color: black; text-align: left; margin-left: 2px; word-wrap: break-word; margin-bottom: 3px">
                    <span class="code-customs code">${codes[index]}: </span><span class="val-customs certificate" style="margin-bottom: 3px">${certificate[index]}</span>
                </div>
            `);
            $("#delivery-types-dropdown-fast-auto" + postfix + " .dl-help .balloon-container .licenses").append(`
                <div class="help-text-content-white" style="color: black; text-align: left; margin-left: 2px; word-wrap: break-word;">
                    <span class="code-customs code">${codes[index]}: </span><span class="val-customs licence" style="margin-bottom: 3px">${license[index]}</span>
                </div>
            `);
            $("#delivery-types-dropdown-fast-auto" + postfix + " .dl-help .balloon-container .cargo-certificates").append(`
                <div class="help-text-content-white" style="color: black; text-align: left; margin-left: 2px; word-wrap: break-word; margin-bottom: 3px">
                    <span class="code-customs code">${codes[index]}: </span><span class="val-customs certificate" style="margin-bottom: 3px">${certificate[index]}</span>
                </div>
            `);
            $("#delivery-types-dropdown-avia" + postfix + " .dl-help .balloon-container .licenses").append(`
                <div class="help-text-content-white" style="color: black; text-align: left; margin-left: 2px; word-wrap: break-word;">
                    <span class="code-customs code">${codes[index]}: </span><span class="val-customs licence" style="margin-bottom: 3px">${license[index]}</span>
                </div>
            `);
            $("#delivery-types-dropdown-avia" + postfix + " .dl-help .balloon-container .cargo-certificates").append(`
                <div class="help-text-content-white" style="color: black; text-align: left; margin-left: 2px; word-wrap: break-word; margin-bottom: 3px">
                    <span class="code-customs code">${codes[index]}: </span><span class="val-customs certificate" style="margin-bottom: 3px">${certificate[index]}</span>
                </div>
            `);
        })
    }

    function updatePageWithPekResponse(response, pekResponse) {
        let autoRegularKg = pekResponse.sum_cost_price.auto_regular === 'н/д' ? 'н/д' : ((parseFloat(total) + parseFloat(pekResponse.sum_cost_price.auto_regular)) / totalWeight).toFixed(2);
        let autoRegularSum = pekResponse.sum_cost_price.auto_regular === 'н/д' ? 'н/д' : (parseFloat(total) + parseFloat(pekResponse.sum_cost_price.auto_regular)).toFixed(2);
        let autoRegularKgPek = pekResponse.sum_cost_price.auto_regular === 'н/д' ? 'н/д' : ((parseFloat(pekResponse.sum_cost_price.auto_regular) / totalWeight).toFixed(2));
        let autoRegularSumPek = pekResponse.sum_cost_price.auto_regular === 'н/д' ? 'н/д' : (parseFloat(pekResponse.sum_cost_price.auto_regular).toFixed(2));

        let autoRegularKgRub = pekResponse.sum_cost_price_rub.auto_regular === 'н/д' ? 'н/д' : ((parseFloat(totalRub) + parseFloat(pekResponse.sum_cost_price_rub.auto_regular)) / totalWeight).toFixed(2);
        let autoRegularSumRub = pekResponse.sum_cost_price_rub.auto_regular === 'н/д' ? 'н/д' : (parseFloat(totalRub) + parseFloat(pekResponse.sum_cost_price_rub.auto_regular)).toFixed(2);
        let autoRegularKgRubPek = pekResponse.sum_cost_price_rub.auto_regular === 'н/д' ? 'н/д' : ((parseFloat(pekResponse.sum_cost_price_rub.auto_regular) / totalWeight).toFixed(2));
        let autoRegularSumRubPek = pekResponse.sum_cost_price_rub.auto_regular === 'н/д' ? 'н/д' : (parseFloat(pekResponse.sum_cost_price_rub.auto_regular).toFixed(2));

        $("#delivery-types-dropdown-auto" + postfix + " .cost-elem.pek .kg").html((autoRegularKg === 'н/д') ? "$н/д" + ' - ' + " ₽н/д" : "$" + (parseFloat(autoRegularKg) + packagingPrice / totalWeight).toFixed(2) + ' - ' + "₽" + (parseFloat(autoRegularKgRub) + packagingPrice * exchangeRateSaide / totalWeight).toFixed(2));
        $("#delivery-types-dropdown-auto" + postfix + " .cost-elem.pek .sum .sum-dollar").html((autoRegularSum === 'н/д') ? "$н/д" : "$" + (parseFloat(autoRegularSum) + packagingPrice).toFixed(2));
        $("#delivery-types-dropdown-auto" + postfix + " .cost-elem.pek .sum .sum-rub").html((autoRegularSum === 'н/д') ? "₽н/д" : "₽" + (parseFloat(autoRegularSumRub) + packagingPrice * exchangeRateSaide).toFixed(2));

        // Обновляем значения для delivery-types-dropdown-auto dl-help
        $("#delivery-types-dropdown-auto" + postfix + " .pek-help .balloon-container .kg").html((autoRegularKgPek === 'н/д') ? "$н/д" + semicolonHelp + " ₽н/д" : parseFloat(autoRegularKgPek) + "$" + semicolonHelp + parseFloat(autoRegularKgRubPek) + "₽");
        $("#delivery-types-dropdown-auto" + postfix + " .pek-help .balloon-container .sum").html((autoRegularSumPek === 'н/д') ? "$н/д" + semicolonHelp + " ₽н/д" : parseFloat(autoRegularSumPek) + "$" + semicolonHelp + parseFloat(autoRegularSumRubPek) + "₽");
        $("#delivery-types-dropdown-auto" + postfix + " .pek-help .balloon-container .total").html((autoRegularSum === 'н/д') ? "$н/д" + semicolonHelp + " ₽н/д" : (parseFloat(autoRegularSum) + packagingPrice).toFixed(2) + "$" + semicolonHelp + (parseFloat(autoRegularSumRub) + packagingPrice * exchangeRateSaide).toFixed(2) + "₽");
        $("#delivery-types-dropdown-auto" + postfix + " .pek-help .balloon-container .total-customs").html(totalCustoms + "$" + semicolonHelp + totalCustomsRub + "₽");
        $("#delivery-types-dropdown-auto" + postfix + " .pek-help .balloon-container .sum-saide").html(sumRateSaide + "$" + semicolonHelp + sumRateSaideRub + "₽");
        $("#delivery-types-dropdown-auto" + postfix + " .pek-help .balloon-container .fees").text(fees + "$");
        $("#delivery-types-dropdown-auto" + postfix + " .pek-help .balloon-container .total-nds").text(totalNds + "$");
        $("#delivery-types-dropdown-auto" + postfix + " .pek-help .balloon-container .total-duty").text(totalDuty + "$");
        $("#delivery-types-dropdown-auto" + postfix + " .pek-help .balloon-container .redeem-commission").html((ransomGoods * yuan / exchangeRateSaide).toFixed(2) + "$" + semicolonHelp + (ransomGoods * yuan).toFixed(2) + "₽");
        $("#delivery-types-dropdown-auto" + postfix + " .pek-help .balloon-container .packaging-price").html(packagingPrice + "$" + semicolonHelp + (packagingPrice * exchangeRateSaide).toFixed(2) + "₽");
        $("#delivery-types-dropdown-auto" + postfix + " .pek-help .balloon-container .boxing-type").text(typeOfPackaging);
        $("#delivery-types-dropdown-auto" + postfix + " .pek-help .balloon-container .exchange-saide").html("$: " + exchangeRateSaide + "₽" + semicolonHelp + ' ¥: ' + yuan + "₽");
        $("#delivery-types-dropdown-auto" + postfix + " .pek-help .balloon-container .sum-duty").text(sumDuty);

        // Обновляем значения для delivery-types-dropdown-avia
        let aviaKg = pekResponse.sum_cost_price.avia === 'н/д' ? 'н/д' : ((parseFloat(total) + parseFloat(pekResponse.sum_cost_price.avia)) / totalWeight).toFixed(2);
        let aviaSum = pekResponse.sum_cost_price.avia === 'н/д' ? 'н/д' : (parseFloat(total) + parseFloat(pekResponse.sum_cost_price.avia)).toFixed(2);
        let aviaKgPek = pekResponse.sum_cost_price.avia === 'н/д' ? 'н/д' : ((parseFloat(pekResponse.sum_cost_price.avia) / totalWeight).toFixed(2));
        let aviaSumPek = pekResponse.sum_cost_price.avia === 'н/д' ? 'н/д' : (parseFloat(pekResponse.sum_cost_price.avia).toFixed(2));

        let aviaKgRub = pekResponse.sum_cost_price_rub.avia === 'н/д' ? 'н/д' : ((parseFloat(totalRub) + parseFloat(pekResponse.sum_cost_price_rub.avia)) / totalWeight).toFixed(2);
        let aviaSumRub = pekResponse.sum_cost_price_rub.avia === 'н/д' ? 'н/д' : (parseFloat(totalRub) + parseFloat(pekResponse.sum_cost_price_rub.avia)).toFixed(2);
        let aviaKgRubPek = pekResponse.sum_cost_price_rub.avia === 'н/д' ? 'н/д' : ((parseFloat(pekResponse.sum_cost_price_rub.avia) / totalWeight).toFixed(2));
        let aviaSumRubPek = pekResponse.sum_cost_price_rub.avia === 'н/д' ? 'н/д' : (parseFloat(pekResponse.sum_cost_price_rub.avia).toFixed(2));

        $("#delivery-types-dropdown-avia" + postfix + " .cost-elem.pek .kg").html((aviaKg === 'н/д')? "$н/д" + ' - ' + "₽н/д" : "$" + (parseFloat(aviaKg) + packagingPrice / totalWeight).toFixed(2) + ' - ' + "₽" + (parseFloat(aviaKgRub) + packagingPrice * exchangeRateSaide / totalWeight).toFixed(2));
        $("#delivery-types-dropdown-avia" + postfix + " .cost-elem.pek .sum .sum-dollar").html((aviaSum === 'н/д')? "$н/д" : "$" + (parseFloat(aviaSum) + packagingPrice).toFixed(2));
        $("#delivery-types-dropdown-avia" + postfix + " .cost-elem.pek .sum .sum-rub").html((aviaSum === 'н/д')? "₽н/д" : "₽" + (parseFloat(aviaSumRub) + packagingPrice * exchangeRateSaide).toFixed(2));

        // Обновляем значения для delivery-types-dropdown-avia dl-help
        $("#delivery-types-dropdown-avia" + postfix + " .pek-help .balloon-container .kg").html((aviaKgPek === 'н/д')? "$н/д" + semicolonHelp + " ₽н/д" : parseFloat(aviaKgPek) + "$" + semicolonHelp + aviaKgRubPek + "₽");
        $("#delivery-types-dropdown-avia" + postfix + " .pek-help .balloon-container .sum").html((aviaSumPek === 'н/д')? "$н/д" + semicolonHelp + " ₽н/д" : parseFloat(aviaSumPek) + "$" + semicolonHelp + aviaSumRubPek + "₽");
        $("#delivery-types-dropdown-avia" + postfix + " .pek-help .balloon-container .total").html((aviaSum === 'н/д')? "$н/д" + semicolonHelp + " ₽н/д" : (parseFloat(aviaSum) + packagingPrice).toFixed(2) + "$" + semicolonHelp + (parseFloat(aviaSumRub) + packagingPrice * exchangeRateSaide).toFixed(2) + "₽");
        $("#delivery-types-dropdown-avia" + postfix + " .pek-help .balloon-container .total-customs").html(totalCustoms + "$" + semicolonHelp + totalCustomsRub + "₽");
        $("#delivery-types-dropdown-avia" + postfix + " .pek-help .balloon-container .sum-saide").html(sumRateSaide + "$" + semicolonHelp + sumRateSaideRub + "₽");
        $("#delivery-types-dropdown-avia" + postfix + " .pek-help .balloon-container .fees").text(fees + "$");
        $("#delivery-types-dropdown-avia" + postfix + " .pek-help .balloon-container .total-nds").text(totalNds + "$");
        $("#delivery-types-dropdown-avia" + postfix + " .pek-help .balloon-container .total-duty").text(totalDuty + "$");
        $("#delivery-types-dropdown-avia" + postfix + " .pek-help .balloon-container .redeem-commission").html((ransomGoods * yuan / exchangeRateSaide).toFixed(2) + "$" + semicolonHelp + (ransomGoods * yuan).toFixed(2) + "₽");
        $("#delivery-types-dropdown-avia" + postfix + " .pek-help .balloon-container .packaging-price").html(packagingPrice + "$" + semicolonHelp + (packagingPrice * exchangeRateSaide).toFixed(2) + "₽");
        $("#delivery-types-dropdown-avia" + postfix + " .pek-help .balloon-container .boxing-type").text(typeOfPackaging);
        $("#delivery-types-dropdown-avia" + postfix + " .pek-help .balloon-container .exchange-saide").html("$: " + exchangeRateSaide + "₽" + semicolonHelp + ' ¥: ' + yuan + "₽");
        $("#delivery-types-dropdown-avia" + postfix + " .pek-help .balloon-container .sum-duty").text(sumDuty);

        $("#delivery-types-dropdown-auto" + postfix + " .pek-help .balloon-container .licenses").html('ЛИЦЕНЗИЯ:');
        $("#delivery-types-dropdown-auto" + postfix + " .pek-help .balloon-container .cargo-certificates").html('СЕРТИФИКАТ:');
        $("#delivery-types-dropdown-fast-auto" + postfix + " .pek-help .balloon-container .licenses").html('ЛИЦЕНЗИЯ:');
        $("#delivery-types-dropdown-fast-auto" + postfix + " .pek-help .balloon-container .cargo-certificates").html('СЕРТИФИКАТ:');
        $("#delivery-types-dropdown-railway" + postfix + " .pek-help .balloon-container .licenses").html('ЛИЦЕНЗИЯ:');
        $("#delivery-types-dropdown-railway" + postfix + " .pek-help .balloon-container .cargo-certificates").html('СЕРТИФИКАТ:');
        $("#delivery-types-dropdown-avia" + postfix + " .pek-help .balloon-container .licenses").html('ЛИЦЕНЗИЯ:');
        $("#delivery-types-dropdown-avia" + postfix + " .pek-help .balloon-container .cargo-certificates").html('СЕРТИФИКАТ:');

        certificate.forEach((item, index) => {
            $("#delivery-types-dropdown-auto" + postfix + " .pek-help .balloon-container .licenses").append(`
                <div class="help-text-content-white" style="color: black; text-align: left; margin-left: 2px; word-wrap: break-word;">
                    <span class="code-customs code">${codes[index]}: </span><span class="val-customs licence" style="margin-bottom: 3px">${license[index]}</span>
                </div>
            `);
            $("#delivery-types-dropdown-auto" + postfix + " .pek-help .balloon-container .cargo-certificates").append(`
                <div class="help-text-content-white" style="color: black; text-align: left; margin-left: 2px; word-wrap: break-word; margin-bottom: 3px">
                    <span class="code-customs code">${codes[index]}: </span><span class="val-customs certificate" style="margin-bottom: 3px">${certificate[index]}</span>
                </div>
            `);
            $("#delivery-types-dropdown-avia" + postfix + " .pek-help .balloon-container .licenses").append(`
                <div class="help-text-content-white" style="color: black; text-align: left; margin-left: 2px; word-wrap: break-word;">
                    <span class="code-customs code">${codes[index]}: </span><span class="val-customs licence" style="margin-bottom: 3px">${license[index]}</span>
                </div>
            `);
            $("#delivery-types-dropdown-avia" + postfix + " .pek-help .balloon-container .cargo-certificates").append(`
                <div class="help-text-content-white" style="color: black; text-align: left; margin-left: 2px; word-wrap: break-word; margin-bottom: 3px">
                    <span class="code-customs code">${codes[index]}: </span><span class="val-customs certificate" style="margin-bottom: 3px">${certificate[index]}</span>
                </div>
            `);
        })
    }

    function updatePageWithJDEResponse(response, jdeResponse) {
        let autoRegularKg = (jdeResponse.sum_cost_price.auto_regular === 'н/д') ? 'н/д' : ((parseFloat(total) + parseFloat(jdeResponse.sum_cost_price.auto_regular)) / totalWeight).toFixed(2);
        let autoRegularKgRub = (jdeResponse.sum_cost_price_rub.auto_regular === 'н/д') ? 'н/д' : ((parseFloat(totalRub) + parseFloat(jdeResponse.sum_cost_price_rub.auto_regular)) / totalWeight).toFixed(2);
        let autoRegularKgJDE = (jdeResponse.sum_cost_price.auto_regular === 'н/д') ? 'н/д' : ((parseFloat(jdeResponse.sum_cost_price.auto_regular) / totalWeight).toFixed(2));
        let autoRegularKgRubJDE = (jdeResponse.sum_cost_price_rub.auto_regular === 'н/д') ? 'н/д' : ((parseFloat(jdeResponse.sum_cost_price_rub.auto_regular) / totalWeight).toFixed(2));

        $("#delivery-types-dropdown-auto" + postfix + " .cost-elem.jde .kg").html((autoRegularKg === 'н/д') ? "$н/д" + ' - ' + " ₽н/д" : "$" + (parseFloat(autoRegularKg) + packagingPrice / totalWeight).toFixed(2) + ' - ' + "₽" + (parseFloat(autoRegularKgRub) + packagingPrice * exchangeRateSaide / totalWeight).toFixed(2));
        $("#delivery-types-dropdown-auto" + postfix + " .cost-elem.jde .sum .sum-dollar").html((autoRegularKg === 'н/д') ? "$н/д" : "$" + (autoRegularKg * totalWeight + packagingPrice).toFixed(2));
        $("#delivery-types-dropdown-auto" + postfix + " .cost-elem.jde .sum .sum-rub").html((autoRegularKg === 'н/д') ? "₽н/д" : "₽" + (autoRegularKgRub * totalWeight + packagingPrice * exchangeRateSaide).toFixed(2));

        // Обновление элементов внутри delivery-types-dropdown-fast-auto для auto_fast
        let autoFastKg = (jdeResponse.sum_cost_price.auto_fast === 'н/д') ? 'н/д' : ((parseFloat(total) + parseFloat(jdeResponse.sum_cost_price.auto_fast)) / totalWeight).toFixed(2);
        let autoFastKgRub = (jdeResponse.sum_cost_price_rub.auto_fast === 'н/д') ? 'н/д' : ((parseFloat(totalRub) + parseFloat(jdeResponse.sum_cost_price_rub.auto_fast)) / totalWeight).toFixed(2);
        let autoFastKgJDE = (jdeResponse.sum_cost_price.auto_fast === 'н/д') ? 'н/д' : ((parseFloat(jdeResponse.sum_cost_price.auto_fast) / totalWeight).toFixed(2));
        let autoFastKgRubJDE = (jdeResponse.sum_cost_price_rub.auto_fast === 'н/д') ? 'н/д' : ((parseFloat(jdeResponse.sum_cost_price_rub.auto_fast) / totalWeight).toFixed(2));

        $("#delivery-types-dropdown-fast-auto" + postfix + " .cost-elem.jde .kg").html((autoFastKg === 'н/д') ? "$н/д" + ' - ' + "₽н/д" : "$" + (parseFloat(autoFastKg) + packagingPrice / totalWeight).toFixed(2) + ' - ' + "₽" + (parseFloat(autoFastKgRub) + packagingPrice * exchangeRateSaide / totalWeight).toFixed(2));
        $("#delivery-types-dropdown-fast-auto" + postfix + " .cost-elem.jde .sum .sum-dollar").html((autoFastKg === 'н/д') ? "$н/д" : "$" + (autoFastKg * totalWeight + packagingPrice).toFixed(2));
        $("#delivery-types-dropdown-fast-auto" + postfix + " .cost-elem.jde .sum .sum-rub").html((autoFastKg === 'н/д') ? "₽н/д" : "₽" + (autoFastKgRub * totalWeight + packagingPrice * exchangeRateSaide).toFixed(2));

        // Обновление элементов внутри delivery-types-dropdown-auto jde-help для auto_regular
        $("#delivery-types-dropdown-auto" + postfix + " .jde-help .balloon-container .kg").html((autoRegularKgJDE === 'н/д') ? "$н/д" + semicolonHelp + " ₽н/д" : autoRegularKgJDE + "$" + semicolonHelp + autoRegularKgRubJDE + "₽");
        $("#delivery-types-dropdown-auto" + postfix + " .jde-help .balloon-container .sum").html((autoRegularKgJDE === 'н/д') ? "$н/д" + semicolonHelp + " ₽н/д" : (autoRegularKgJDE * totalWeight).toFixed(2) + "$" + semicolonHelp + (autoRegularKgRubJDE * totalWeight).toFixed(2) + "₽");
        $("#delivery-types-dropdown-auto" + postfix + " .jde-help .balloon-container .total").html((autoRegularKg === 'н/д') ? "$н/д" + semicolonHelp + " ₽н/д" : (autoRegularKg * totalWeight + packagingPrice).toFixed(2) + "$" + semicolonHelp + (autoRegularKgRub * totalWeight + packagingPrice * exchangeRateSaide).toFixed(2) + "₽");
        $("#delivery-types-dropdown-auto" + postfix + " .jde-help .balloon-container .total-customs").html(totalCustoms + "$" + semicolonHelp + totalCustomsRub + "₽");
        $("#delivery-types-dropdown-auto" + postfix + " .jde-help .balloon-container .sum-saide").html(sumRateSaide + "$" + semicolonHelp + sumRateSaideRub + "₽");
        $("#delivery-types-dropdown-auto" + postfix + " .jde-help .balloon-container .fees").text(fees + "$");
        $("#delivery-types-dropdown-auto" + postfix + " .jde-help .balloon-container .total-nds").text(totalNds + "$");
        $("#delivery-types-dropdown-auto" + postfix + " .jde-help .balloon-container .total-duty").text(totalDuty + "$");
        $("#delivery-types-dropdown-auto" + postfix + " .jde-help .balloon-container .redeem-commission").html((ransomGoods * yuan / exchangeRateSaide).toFixed(2) + "$" + semicolonHelp + (ransomGoods * yuan).toFixed(2) + "₽");
        $("#delivery-types-dropdown-auto" + postfix + " .jde-help .balloon-container .packaging-price").html(packagingPrice + "$" + semicolonHelp + (packagingPrice * exchangeRateSaide).toFixed(2) + "₽");
        $("#delivery-types-dropdown-auto" + postfix + " .jde-help .balloon-container .boxing-type").text(typeOfPackaging);
        $("#delivery-types-dropdown-auto" + postfix + " .jde-help .balloon-container .exchange-saide").html("$: " + exchangeRateSaide + "₽" + semicolonHelp + ' ¥: ' + yuan + "₽");
        $("#delivery-types-dropdown-auto" + postfix + " .jde-help .balloon-container .sum-duty").text(sumDuty);

        // Обновление элементов внутри delivery-types-dropdown-fast-auto jde-help для auto_fast
        $("#delivery-types-dropdown-fast-auto" + postfix + " .jde-help .balloon-container .kg").html((autoFastKgJDE === 'н/д') ? "$н/д" + semicolonHelp + " ₽н/д" : autoFastKgJDE + "$" + semicolonHelp + autoFastKgRubJDE + "₽");
        $("#delivery-types-dropdown-fast-auto" + postfix + " .jde-help .balloon-container .sum").html((autoFastKgJDE === 'н/д') ? "$н/д" + semicolonHelp + " ₽н/д" : (autoFastKgJDE * totalWeight).toFixed(2) + "$" + semicolonHelp + (autoFastKgRubJDE * totalWeight).toFixed(2) + "₽");
        $("#delivery-types-dropdown-fast-auto" + postfix + " .jde-help .balloon-container .total").html((autoFastKg === 'н/д') ? "$н/д" + semicolonHelp + " ₽н/д" : (autoFastKg * totalWeight + packagingPrice).toFixed(2) + "$" + semicolonHelp + (autoFastKgRub * totalWeight + packagingPrice * exchangeRateSaide).toFixed(2) + "₽");
        $("#delivery-types-dropdown-fast-auto" + postfix + " .jde-help .balloon-container .total-customs").html(totalCustoms + "$" + semicolonHelp + totalCustomsRub + "₽");
        $("#delivery-types-dropdown-fast-auto" + postfix + " .jde-help .balloon-container .sum-saide").html(sumRateSaide + "$" + semicolonHelp + sumRateSaideRub + "₽");
        $("#delivery-types-dropdown-fast-auto" + postfix + " .jde-help .balloon-container .fees").text(fees + "$");
        $("#delivery-types-dropdown-fast-auto" + postfix + " .jde-help .balloon-container .total-nds").text(totalNds + "$");
        $("#delivery-types-dropdown-fast-auto" + postfix + " .jde-help .balloon-container .total-duty").text(totalDuty + "$");
        $("#delivery-types-dropdown-fast-auto" + postfix + " .jde-help .balloon-container .redeem-commission").html((ransomGoods * yuan / exchangeRateSaide).toFixed(2) + "$" + semicolonHelp + (ransomGoods * yuan).toFixed(2) + "₽");
        $("#delivery-types-dropdown-fast-auto" + postfix + " .jde-help .balloon-container .packaging-price").html(packagingPrice + "$" + semicolonHelp + (packagingPrice * exchangeRateSaide).toFixed(2) + "₽");
        $("#delivery-types-dropdown-fast-auto" + postfix + " .jde-help .balloon-container .boxing-type").text(typeOfPackaging);
        $("#delivery-types-dropdown-fast-auto" + postfix + " .jde-help .balloon-container .exchange-saide").html("$: " + exchangeRateSaide + "₽" + semicolonHelp + ' ¥: ' + yuan + "₽");
        $("#delivery-types-dropdown-fast-auto" + postfix + " .jde-help .balloon-container .sum-duty").text(sumDuty);

        $("#delivery-types-dropdown-auto" + postfix + " .jde-help .balloon-container .licenses").html('ЛИЦЕНЗИЯ:');
        $("#delivery-types-dropdown-auto" + postfix + " .jde-help .balloon-container .cargo-certificates").html('СЕРТИФИКАТ:');
        $("#delivery-types-dropdown-fast-auto" + postfix + " .jde-help .balloon-container .licenses").html('ЛИЦЕНЗИЯ:');
        $("#delivery-types-dropdown-fast-auto" + postfix + " .jde-help .balloon-container .cargo-certificates").html('СЕРТИФИКАТ:');
        $("#delivery-types-dropdown-railway" + postfix + " .jde-help .balloon-container .licenses").html('ЛИЦЕНЗИЯ:');
        $("#delivery-types-dropdown-railway" + postfix + " .jde-help .balloon-container .cargo-certificates").html('СЕРТИФИКАТ:');
        $("#delivery-types-dropdown-avia" + postfix + " .jde-help .balloon-container .licenses").html('ЛИЦЕНЗИЯ:');
        $("#delivery-types-dropdown-avia" + postfix + " .jde-help .balloon-container .cargo-certificates").html('СЕРТИФИКАТ:');

        certificate.forEach((item, index) => {
            $("#delivery-types-dropdown-auto" + postfix + " .jde-help .balloon-container .licenses").append(`
                <div class="help-text-content-white" style="color: black; text-align: left; margin-left: 2px; word-wrap: break-word;">
                    <span class="code-customs code">${codes[index]}: </span><span class="val-customs licence" style="margin-bottom: 3px">${license[index]}</span>
                </div>
            `);
            $("#delivery-types-dropdown-auto" + postfix + " .jde-help .balloon-container .cargo-certificates").append(`
                <div class="help-text-content-white" style="color: black; text-align: left; margin-left: 2px; word-wrap: break-word; margin-bottom: 3px">
                    <span class="code-customs code">${codes[index]}: </span><span class="val-customs certificate" style="margin-bottom: 3px">${certificate[index]}</span>
                </div>
            `);
            $("#delivery-types-dropdown-fast-auto" + postfix + " .jde-help .balloon-container .licenses").append(`
                <div class="help-text-content-white" style="color: black; text-align: left; margin-left: 2px; word-wrap: break-word;">
                    <span class="code-customs code">${codes[index]}: </span><span class="val-customs licence" style="margin-bottom: 3px">${license[index]}</span>
                </div>
            `);
            $("#delivery-types-dropdown-fast-auto" + postfix + " .jde-help .balloon-container .cargo-certificates").append(`
                <div class="help-text-content-white" style="color: black; text-align: left; margin-left: 2px; word-wrap: break-word; margin-bottom: 3px">
                    <span class="code-customs code">${codes[index]}: </span><span class="val-customs certificate" style="margin-bottom: 3px">${certificate[index]}</span>
                </div>
            `);
        })
    }

    function updatePageWithKITResponse(response, kitResponse) {
// Обновление элементов внутри delivery-types-dropdown-auto
        let autoRegularKg = (kitResponse.sum_cost_price.auto_regular !== 'н/д') ? ((parseFloat(total) + parseFloat(kitResponse.sum_cost_price.auto_regular)) / totalWeight).toFixed(2) : 'н/д';
        let autoRegularKgRub = (kitResponse.sum_cost_price_rub.auto_regular !== 'н/д') ? ((parseFloat(totalRub) + parseFloat(kitResponse.sum_cost_price_rub.auto_regular)) / totalWeight).toFixed(2) : 'н/д';
        let autoRegularKgKit = (kitResponse.sum_cost_price.auto_regular !== 'н/д') ? ((parseFloat(kitResponse.sum_cost_price.auto_regular) / totalWeight).toFixed(2)) : 'н/д';
        let autoRegularKgRubKit = (kitResponse.sum_cost_price_rub.auto_regular !== 'н/д') ? ((parseFloat(kitResponse.sum_cost_price_rub.auto_regular) / totalWeight).toFixed(2)) : 'н/д';

        $("#delivery-types-dropdown-auto" + postfix + " .cost-elem.kit .kg").html((autoRegularKg !== 'н/д') ? "$" + (parseFloat(autoRegularKg) + packagingPrice / totalWeight).toFixed(2) + ' - ' + "₽" + (parseFloat(autoRegularKgRub) + packagingPrice * exchangeRateSaide / totalWeight).toFixed(2) : "$н/д" + ' - ' + "₽н/д");
        $("#delivery-types-dropdown-auto" + postfix + " .cost-elem.kit .sum .sum-dollar").html((autoRegularKg !== 'н/д') ? "$" + (autoRegularKg * totalWeight + packagingPrice).toFixed(2) : "$н/д");
        $("#delivery-types-dropdown-auto" + postfix + " .cost-elem.kit .sum .sum-rub").html((autoRegularKg !== 'н/д') ? "₽" + (autoRegularKgRub * totalWeight + packagingPrice * exchangeRateSaide).toFixed(2) : "₽н/д");

        // Обновление элементов внутри delivery-types-dropdown-fast-auto
        let autoFastKg = (kitResponse.sum_cost_price.auto_fast !== 'н/д') ? ((parseFloat(total) + parseFloat(kitResponse.sum_cost_price.auto_fast)) / totalWeight).toFixed(2) : 'н/д';
        let autoFastKgRub = (kitResponse.sum_cost_price_rub.auto_fast !== 'н/д') ? ((parseFloat(totalRub) + parseFloat(kitResponse.sum_cost_price_rub.auto_fast)) / totalWeight).toFixed(2) : 'н/д';
        let autoFastKgKit = (kitResponse.sum_cost_price.auto_fast !== 'н/д') ? ((parseFloat(kitResponse.sum_cost_price.auto_fast) / totalWeight).toFixed(2)) : 'н/д';
        let autoFastKgRubKit = (kitResponse.sum_cost_price_rub.auto_fast !== 'н/д') ? ((parseFloat(kitResponse.sum_cost_price_rub.auto_fast) / totalWeight).toFixed(2)) : 'н/д';

        $("#delivery-types-dropdown-fast-auto" + postfix + " .cost-elem.kit .kg").html((autoFastKg !== 'н/д') ? "$" + (parseFloat(autoFastKg) + packagingPrice / totalWeight).toFixed(2) + ' - ' + "₽" + (parseFloat(autoFastKgRub) + packagingPrice * exchangeRateSaide / totalWeight).toFixed(2) : "$н/д" + ' - ' + "₽н/д");
        $("#delivery-types-dropdown-fast-auto" + postfix + " .cost-elem.kit .sum .sum-dollar").html((autoFastKg !== 'н/д') ? "$" + (autoFastKg * totalWeight + packagingPrice).toFixed(2) : "$н/д");
        $("#delivery-types-dropdown-fast-auto" + postfix + " .cost-elem.kit .sum .sum-rub").html((autoFastKg !== 'н/д') ? "₽" + (autoFastKgRub * totalWeight + packagingPrice * exchangeRateSaide).toFixed(2) : "₽н/д");

        // Обновление элементов внутри delivery-types-dropdown-auto kit-help
        $("#delivery-types-dropdown-auto" + postfix + " .kit-help .balloon-container .kg").html((autoRegularKgKit !== 'н/д') ? autoRegularKgKit + "$" + semicolonHelp + autoRegularKgRubKit + "₽" : "$н/д" + semicolonHelp + " ₽н/д");
        $("#delivery-types-dropdown-auto" + postfix + " .kit-help .balloon-container .sum").html((autoRegularKgKit !== 'н/д') ? (autoRegularKgKit * totalWeight).toFixed(2) + "$" + semicolonHelp + (autoRegularKgRubKit * totalWeight).toFixed(2) + "₽" : "$н/д" + semicolonHelp + " ₽н/д");
        $("#delivery-types-dropdown-auto" + postfix + " .kit-help .balloon-container .total").html((autoRegularKg !== 'н/д') ? (autoRegularKg * totalWeight + packagingPrice).toFixed(2) + "$" + semicolonHelp + (autoRegularKgRub * totalWeight + packagingPrice * exchangeRateSaide).toFixed(2) + "₽" : "$н/д" + semicolonHelp + " ₽н/д");
        $("#delivery-types-dropdown-auto" + postfix + " .kit-help .balloon-container .total-customs").html(totalCustoms + "$" + semicolonHelp + totalCustomsRub + "₽");
        $("#delivery-types-dropdown-auto" + postfix + " .kit-help .balloon-container .sum-saide").html(sumRateSaide + "$" + semicolonHelp + sumRateSaideRub + "₽");
        $("#delivery-types-dropdown-auto" + postfix + " .kit-help .balloon-container .fees").text(fees + "$");
        $("#delivery-types-dropdown-auto" + postfix + " .kit-help .balloon-container .total-nds").text(totalNds + "$");
        $("#delivery-types-dropdown-auto" + postfix + " .kit-help .balloon-container .total-duty").text(totalDuty + "$");
        $("#delivery-types-dropdown-auto" + postfix + " .kit-help .balloon-container .redeem-commission").html((ransomGoods * yuan / exchangeRateSaide).toFixed(2) + "$" + semicolonHelp + (ransomGoods * yuan).toFixed(2) + "₽");
        $("#delivery-types-dropdown-auto" + postfix + " .kit-help .balloon-container .packaging-price").html(packagingPrice + "$" + semicolonHelp + (packagingPrice * exchangeRateSaide).toFixed(2) + "₽");
        $("#delivery-types-dropdown-auto" + postfix + " .kit-help .balloon-container .boxing-type").text(typeOfPackaging);
        $("#delivery-types-dropdown-auto" + postfix + " .kit-help .balloon-container .exchange-saide").html("$: " + exchangeRateSaide + "₽" + semicolonHelp + ' ¥: ' + yuan + "₽");
        $("#delivery-types-dropdown-auto" + postfix + " .kit-help .balloon-container .sum-duty").text(sumDuty);

        // Обновление элементов внутри delivery-types-dropdown-fast-auto kit-help
        $("#delivery-types-dropdown-fast-auto" + postfix + " .kit-help .balloon-container .kg").html((autoFastKgKit !== 'н/д') ? autoFastKgKit + "$" + semicolonHelp + autoFastKgRubKit + "₽" : "$н/д" + semicolonHelp + " ₽н/д");
        $("#delivery-types-dropdown-fast-auto" + postfix + " .kit-help .balloon-container .sum").html((autoFastKgKit !== 'н/д') ? (autoFastKgKit * totalWeight).toFixed(2) + "$" + semicolonHelp + (autoFastKgRubKit * totalWeight).toFixed(2) + "₽" : "$н/д" + semicolonHelp + " ₽н/д");
        $("#delivery-types-dropdown-fast-auto" + postfix + " .kit-help .balloon-container .total").html((autoFastKg !== 'н/д') ? (autoFastKg * totalWeight + packagingPrice).toFixed(2) + "$" + semicolonHelp + (autoFastKgRub * totalWeight + packagingPrice * exchangeRateSaide).toFixed(2) + "₽" : "$н/д" + semicolonHelp + " ₽н/д");
        $("#delivery-types-dropdown-fast-auto" + postfix + " .kit-help .balloon-container .total-customs").html(totalCustoms + "$" + semicolonHelp + totalCustomsRub + "₽");
        $("#delivery-types-dropdown-fast-auto" + postfix + " .kit-help .balloon-container .sum-saide").html(sumRateSaide + "$" + semicolonHelp + sumRateSaideRub + "₽");
        $("#delivery-types-dropdown-fast-auto" + postfix + " .kit-help .balloon-container .fees").text(fees + "$");
        $("#delivery-types-dropdown-fast-auto" + postfix + " .kit-help .balloon-container .total-nds").text(totalNds + "$");
        $("#delivery-types-dropdown-fast-auto" + postfix + " .kit-help .balloon-container .total-duty").text(totalDuty + "$");
        $("#delivery-types-dropdown-fast-auto" + postfix + " .kit-help .balloon-container .redeem-commission").html((ransomGoods * yuan / exchangeRateSaide).toFixed(2) + "$" + semicolonHelp + (ransomGoods * yuan).toFixed(2) + "₽");
        $("#delivery-types-dropdown-fast-auto" + postfix + " .kit-help .balloon-container .packaging-price").html(packagingPrice + "$" + semicolonHelp + (packagingPrice * exchangeRateSaide).toFixed(2) + "₽");
        $("#delivery-types-dropdown-fast-auto" + postfix + " .kit-help .balloon-container .boxing-type").text(typeOfPackaging);
        $("#delivery-types-dropdown-fast-auto" + postfix + " .kit-help .balloon-container .exchange-saide").html("$: " + exchangeRateSaide + "₽" + semicolonHelp + ' ¥: ' + yuan + "₽");
        $("#delivery-types-dropdown-fast-auto" + postfix + " .kit-help .balloon-container .sum-duty").text(sumDuty);

        $("#delivery-types-dropdown-auto" + postfix + " .kit-help .balloon-container .licenses").html('ЛИЦЕНЗИЯ:');
        $("#delivery-types-dropdown-auto" + postfix + " .kit-help .balloon-container .cargo-certificates").html('СЕРТИФИКАТ:');
        $("#delivery-types-dropdown-fast-auto" + postfix + " .kit-help .balloon-container .licenses").html('ЛИЦЕНЗИЯ:');
        $("#delivery-types-dropdown-fast-auto" + postfix + " .kit-help .balloon-container .cargo-certificates").html('СЕРТИФИКАТ:');
        $("#delivery-types-dropdown-railway" + postfix + " .kit-help .balloon-container .licenses").html('ЛИЦЕНЗИЯ:');
        $("#delivery-types-dropdown-railway" + postfix + " .kit-help .balloon-container .cargo-certificates").html('СЕРТИФИКАТ:');
        $("#delivery-types-dropdown-avia" + postfix + " .kit-help .balloon-container .licenses").html('ЛИЦЕНЗИЯ:');
        $("#delivery-types-dropdown-avia" + postfix + " .kit-help .balloon-container .cargo-certificates").html('СЕРТИФИКАТ:');

        certificate.forEach((item, index) => {
            $("#delivery-types-dropdown-auto" + postfix + " .kit-help .balloon-container .licenses").append(`
                <div class="help-text-content-white" style="color: black; text-align: left; margin-left: 2px; word-wrap: break-word;">
                    <span class="code-customs code">${codes[index]}: </span><span class="val-customs licence" style="margin-bottom: 3px">${license[index]}</span>
                </div>
            `);
            $("#delivery-types-dropdown-auto" + postfix + " .kit-help .balloon-container .cargo-certificates").append(`
                <div class="help-text-content-white" style="color: black; text-align: left; margin-left: 2px; word-wrap: break-word; margin-bottom: 3px">
                    <span class="code-customs code">${codes[index]}: </span><span class="val-customs certificate" style="margin-bottom: 3px">${certificate[index]}</span>
                </div>
            `);
            $("#delivery-types-dropdown-fast-auto" + postfix + " .kit-help .balloon-container .licenses").append(`
                <div class="help-text-content-white" style="color: black; text-align: left; margin-left: 2px; word-wrap: break-word;">
                    <span class="code-customs code">${codes[index]}: </span><span class="val-customs licence" style="margin-bottom: 3px">${license[index]}</span>
                </div>
            `);
            $("#delivery-types-dropdown-fast-auto" + postfix + " .kit-help .balloon-container .cargo-certificates").append(`
                <div class="help-text-content-white" style="color: black; text-align: left; margin-left: 2px; word-wrap: break-word; margin-bottom: 3px">
                    <span class="code-customs code">${codes[index]}: </span><span class="val-customs certificate" style="margin-bottom: 3px">${certificate[index]}</span>
                </div>
            `);
        })
    }
}

function cleanFieldsWhite() {
    const selectors = [
        '.total-customs',
        '.sum-saide',
        '.fees',
        '.total-nds',
        '.total-duty',
        '.sum-duty',
        '.exchange-saide',
    ];

    selectors.forEach(selector => {
        const elements = document.querySelectorAll(selector);
        elements.forEach(element => {
            element.innerHTML = 'н/д';
        });
    });
}