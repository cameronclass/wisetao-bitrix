
let count = 0;
function initializeGeneralAjaxRequest() {
    // Функция для отправки POST-запроса
    let $arrival = $("input[name='arrival']");
    let maxDimension;
    let dimensions = $("#checkbox_input_type");
    let cargoCalcButton = $("#cargo-calc-button");
    let cargoDimensionsCalcButton = $("#cargo-calc-dimensions-button");
    let $lengthInput = $('.dimensions-input-group .length');
    let $widthInput = $('.dimensions-input-group .width');
    let $heightInput = $('.dimensions-input-group .height');
    let $currencyInput = $('.currency_for_dimensions');
    let $weightInput = $('.weight:not(.logistic-check__item_text)');
    let $quantityInput = $('.quantity');
    let $insurance = $("input[name='insurance']");
    let $typeOfGoodsDropdown = $('.type-of-goods-dropdown-toggle.dimensions');
    let $brand = $('.brand-checkbox');
    let $brandGood = $("input[name='brand-good']");
    let $dimBrand = $("input[name='dim-brand']");
    $lengthInput.addClass('collected');
    $widthInput.addClass('collected');
    $heightInput.addClass('collected');
    $currencyInput.addClass('collected');
    $weightInput.addClass('collected');
    $quantityInput.addClass('collected');
    $typeOfGoodsDropdown.addClass('collected');
    $brand.addClass('collected');
    let dollar, yuan;
    let pendingRequest = null;
    let semicolonHelp = '<span style="color: black">; </span>';
    let semicolonHelpTspan = '<tspan fill="black">; </tspan>';

    let arrivalCity = {
        'Россия': 'Москва (ТК «Южные ворота»)',
        'Кыргызстан': 'Бишкек',
        'Казахстан': 'Алматы',
    }
    
    function trackAndSendAjaxRequests() {
        if (activeButton.dataset.type === 'cargo') {
            dataChanged = true; // Устанавливаем флаг изменений в true
            if (!pendingRequest) {
                pendingRequest = sendMultipleAjaxRequests();
                pendingRequest.then(function () {
                    pendingRequest = null;
                });
            }
        }
    }

    function trackAndSendDimensionsAjaxRequests() {
        if (activeButton.dataset.type === 'cargo') {
            dataChanged = true; // Устанавливаем флаг изменений в true
            if (!pendingRequest) {
                pendingRequest = sendMultipleDimensionsAjaxRequests();
                pendingRequest.then(function () {
                    pendingRequest = null;
                });
            }
        }
    }

    const mutationObserver = new MutationObserver(function (mutationsList) {
        // Обработка изменений и добавление класса .collected
        mutationsList.forEach(function (mutation) {
            if (mutation.type === 'childList' && !mutation.target.classList.contains('suggestion')) {
                const containers = $('[data-container]');
                const lastContainer = containers.last();
                const addedElements = lastContainer.find(':not(.collected)');
                addedElements.each(function() {
                    const element = $(this);
                    if (element.is('.dimensions-input-group .length') && !element.hasClass('collected')) {
                        element.addClass('collected');
                        $lengthInput = $lengthInput.add(element);
                    }

                    if (element.is('.dimensions-input-group .width') && !element.hasClass('collected')) {
                        element.addClass('collected');
                        $widthInput = $widthInput.add(element);
                    }

                    if (element.is('.dimensions-input-group .height') && !element.hasClass('collected')) {
                        element.addClass('collected');
                        $heightInput = $heightInput.add(element);
                    }

                    if (element.is('.currency_for_dimensions') && !element.hasClass('collected')) {
                        element.addClass('collected');
                        $currencyInput = $currencyInput.add(element);
                    }

                    if (element.is('.weight') && !element.hasClass('collected')) {
                        element.addClass('collected');
                        $weightInput = $weightInput.add(element);
                    }

                    if (element.is('.quantity') && !element.hasClass('collected')) {
                        element.addClass('collected');
                        $quantityInput = $quantityInput.add(element);
                    }

                    if (element.is('.type-of-goods-dropdown-toggle.dimensions') && !element.hasClass('collected')) {
                        element.addClass('collected');
                        $typeOfGoodsDropdown = $typeOfGoodsDropdown.add(element);
                    }

                    if (element.is('.brand-checkbox') && !element.hasClass('collected')) {
                        $brand = $brand.add(element);
                        element.addClass('collected');
                    }
                });
                $lengthInput = $lengthInput.filter(function() {
                    // Условие: оставить элементы только если они не имеют класс 'deleted'
                    return !$(this).hasClass('deleted-input');
                });
                $widthInput = $widthInput.filter(function() {
                    // Условие: оставить элементы только если они не имеют класс 'deleted'
                    return !$(this).hasClass('deleted-input');
                });
                $heightInput = $heightInput.filter(function() {
                    // Условие: оставить элементы только если они не имеют класс 'deleted'
                    return !$(this).hasClass('deleted-input');
                });
                $currencyInput = $currencyInput.filter(function() {
                    // Условие: оставить элементы только если они не имеют класс 'deleted'
                    return !$(this).hasClass('deleted-input');
                });
                $weightInput = $weightInput.filter(function() {
                    // Условие: оставить элементы только если они не имеют класс 'deleted'
                    return !$(this).hasClass('deleted-input');
                });
                $quantityInput = $quantityInput.filter(function() {
                    // Условие: оставить элементы только если они не имеют класс 'deleted'
                    return !$(this).hasClass('deleted-input');
                });
            }
        });
    });

    mutationObserver.observe(document.body, {
        childList: true,
        subtree: true,
    });

    document.addEventListener('clone', function (event) {
        // Уберите класс .collected с новых элементов
        const newElements = event.target.querySelectorAll('.collected');
        newElements.forEach(function (element) {
            element.classList.remove('collected');
        });
    });

    function checkInputs() {
        let isAllFilled = true;
        if ($lengthInput.length && $arrival.length && $widthInput.length && $heightInput.length && $currencyInput.length && $weightInput.length && $quantityInput.length && $typeOfGoodsDropdown.length) {
            $lengthInput.add($arrival).add($widthInput).add($heightInput).add($currencyInput).add($weightInput).add($quantityInput).each(function () {
                if ($(this).val() === "") {
                    isAllFilled = false;
                    return false; // Выход из цикла, если нашли пустой элемент
                }
            });
            $typeOfGoodsDropdown.each(function () {
                if ($(this).text() === "") {
                    isAllFilled = false;
                    return false; // Выход из цикла, если нашли пустой элемент
                }
            });
        }
        return isAllFilled;
    }

    let dataChanged = false; // Флаг для отслеживания изменений

    async function sendMultipleAjaxRequests() {
        const submitButton = document.querySelector('.submit-general-button');
        submitButton.disabled = true;
        const boxingExpandButton = document.querySelector('.boxing-spoiler-header');
        boxingExpandButton.style.pointerEvents = 'none';
        boxingExpandButton.parentElement.style.background = 'grey';
        const calcTypeButtons = document.querySelectorAll('.calc-type-button:not(.tnved-calc-button.submit-redeem-data.submit-excel-file):not(.submit-general-button):not(.submit-dimensions-button):not(.tnved-calc-button.submit-redeem-data.blank-excel-file)');
        calcTypeButtons.forEach((calcTypeButton) => {calcTypeButton.setAttribute('disabled', '')});
        disableBoxingButtons();
        $('.list-elem').removeClass('enable-pointer');
        $('.list-elem.selected').removeClass('selected');
        document.querySelector('.main-offer-button').setAttribute('disabled', '');
        try {
            const cargoResponse = await sendCargoGeneralAjaxRequest();
            if (!cargoResponse) {
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
                sendDLAjaxRequest(cargoResponse),
                sendPEKAjaxRequest(cargoResponse),
                sendJDEAjaxRequest(cargoResponse),
                sendKITAjaxRequest(cargoResponse),
            ]);
            // Если были изменения, выполнить запросы заново
            if (dataChanged) {
                await sendMultipleAjaxRequests();
            }
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

    async function sendMultipleDimensionsAjaxRequests() {
        const submitButton = document.querySelector('.submit-dimensions-button');
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
            const cargoResponse = await sendCargoDimensionsAjaxRequest();
            if (!cargoResponse) {
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
                sendDLAjaxRequest(cargoResponse),
                sendPEKAjaxRequest(cargoResponse),
                sendJDEAjaxRequest(cargoResponse),
                sendKITAjaxRequest(cargoResponse),
            ]);

            // Если были изменения, выполнить запросы заново
            if (dataChanged) {
                await sendMultipleDimensionsAjaxRequests();
            }
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

    function ajaxOfferDataRequest(deliveryType, deliveryTypeRus, tkType) {
        if (offerData) {
            let tkData;
            if (tkType === '“Южные ворота” Москва' || arrivalCity[countryGlobal] === $arrival.val()) {
                tkData = false;
            }
            if (tkType === 'ИТОГ (КАРГО + ЖДЭ)') {
                tkData = offerDataJDE;
            }
            if (tkType === 'ИТОГ (КАРГО + ПЭК)') {
                tkData = offerDataPEK;
            }
            if (tkType === 'ИТОГ (КАРГО + ДЛ)') {
                tkData = offerDataDL;
            }
            if (tkType === 'ИТОГ (КАРГО + КИТ)') {
                tkData = offerDataKIT;
            }
            let offerDataRequest = {
                DeliveryType: 'Тип доставки: ' + deliveryTypeRus + ' (до г. ' + (tkData ? $arrival.val() : arrivalCity[countryGlobal].split(' ')[0]) + ')',
                ExchangeRateYuan: 'Курс юаня SAIDE: ' + offerData.yuan + "₽",
                ExchangeRateDollar: 'Курс доллара SAIDE: ' + offerData.dollar + "₽",
                TOTAL: 'Стоимость до г. ' + arrivalCity[countryGlobal] + ' : ' + offerData.sum_cost_price[deliveryType] + "$; " + offerData.sum_cost_price_rub[deliveryType] + "₽",
                TOTALTK: tkData ? 'Стоимость до г. ' + $arrival.val() + ' (Терм. ТК ' + tkType.split('ИТОГ (КАРГО + ')[1].replace(')', '') + '): ' + (offerData.sum_cost_price[deliveryType] + tkData.sum_cost_price[deliveryType]).toFixed(2) + "$; " + (offerData.sum_cost_price_rub[deliveryType] + tkData.sum_cost_price_rub[deliveryType]).toFixed(2) + "₽" : '',
                GoodsCost: 'Стоимость товара: ' + offerData.total_cost + "₽",
                Weight: 'Вес: ' + offerData.total_weight + 'кг',
                Volume: 'Объем: ' + parseFloat(offerData.total_volume.toFixed(3)) + 'м' + String.fromCharCode(0x00B3),
                Count: 'Количество: ' + count,
                RedeemCommissionFirst: 'Комиссия SAIDE 5%',
                RedeemCommission: 'от стоимости товара: ' + (offerData.commission_price * offerData.yuan / offerData.dollar).toFixed(2) + "$; " + (offerData.commission_price * offerData.yuan).toFixed(2) + "₽",
                PackageType: 'Упаковка: ' + offerData.type_of_packaging,
                PackageCost: 'За упаковку: ' + offerData.packaging_price_pub + "₽",
                Insurance: 'Страховка: ' + offerData.insurance.toFixed(2) + "$; " + (offerData.insurance * offerData.dollar).toFixed(2) + "₽",
                Kg: 'За кг: ' + offerData.cost_price[deliveryType] + "$; " + offerData.cost_price_rub[deliveryType] + "₽" + '(до г. ' + arrivalCity[countryGlobal].split(' ')[0] + ')',
                Sum: 'Стоимость до г. ' + arrivalCity[countryGlobal].split(' ')[0] + ' ' + offerData.sum_cost_price[deliveryType] + "$; " + offerData.sum_cost_price_rub[deliveryType] + "₽",
                tkType: tkType,
                tkData: tkData ? {
                    kgTk: 'За кг: ' + tkData.cost_price[deliveryType] + '$; ' + tkData.cost_price_rub[deliveryType] + "₽ " + '(г. ' + arrivalCity[countryGlobal].split(' ')[0] + ' - г. ' + $arrival.val() + ')',
                    sumTk: 'Стоимость: ' + tkData.sum_cost_price[deliveryType].toFixed(2) + '$; ' + tkData.sum_cost_price_rub[deliveryType].toFixed(2) + '₽ ' + '(г. ' + arrivalCity[countryGlobal].split(' ')[0] + ' - г. ' + $arrival.val() + ')',
                    kgTotal: 'За кг до г. ' + $arrival.val() + ' (Терм. ТК ' + tkType.split('ИТОГ (КАРГО + ')[1].replace(')', '') + ' ): ' + (offerData.cost_price[deliveryType] + tkData.cost_price[deliveryType]).toFixed(2) + "$; " + (offerData.cost_price_rub[deliveryType] + tkData.cost_price_rub[deliveryType]).toFixed(2) + "₽",
                    sumTotal: 'Общая стоимость до г. ' + $arrival.val() + ' (Терм. ТК ' + tkType.split('ИТОГ (КАРГО + ')[1].replace(')', '') + ' ): ' + (offerData.sum_cost_price[deliveryType] + tkData.sum_cost_price[deliveryType]).toFixed(2) + "$; " + (offerData.sum_cost_price_rub[deliveryType] + tkData.sum_cost_price_rub[deliveryType]).toFixed(2) + "₽",
                    varyKg: ' (стоимость может варьир.)',
                    varySum: ' (стоимость может варьир.)',
                } : ''
            };

            showModal('Идёт передача данных диспетчеру, пожалуйста, подождите... ');
            let countdown = 20; // Максимальное время ожидания в секундах
            countdownTimer = setInterval(function() {
                updateModalMessage('Идёт передача данных диспетчеру, пожалуйста, подождите... ' + countdown + ' сек.');
                countdown--;
                if (countdown < 0) {
                    clearInterval(countdownTimer);
                }
            }, 1000);

            $.ajax({
                type: "POST",
                url: "https://api-calc.wisetao.com:4343/api/get-offer",
                data: offerDataRequest,
                xhrFields: {
                    responseType: 'blob' // Устанавливаем ожидание бинарных данных
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
    
    async function sendCargoGeneralAjaxRequest() {
        // Проверка, если checkbox_input_type отмечен
        // Выберите активный чекбокс с классом .boxing
        let activeCheckbox = $(".boxing:checked");

        // Получите необходимые значения из формы
        let insurance = $insurance.is(":checked") ? $insurance.attr("name") : null;
        count = $("input[name='count']").val().replace(/,/g, '.');
        let $maxDimension = $("input[name='max-dimension']");
        maxDimension = !$maxDimension.val() ? '0' : $maxDimension.val().replace(/,/g, '.');
        let totalCost = $("#currency").val().replace(/,/g, '.');
        let totalVolume = $("input[name='total-volume']").val().replace(/,/g, '.');
        let totalWeight = $("input[name='total-weight']").val().replace(/,/g, '.');
        let arrival = $arrival.val();
        arrivalCityRusTK = $arrival.val();
        let typeOfGoods = $("#type-of-goods").contents().first()
            .text()
            .match(/[A-Za-zА-Яа-я\s]+/g) // Оставить только английские и русские символы и пробелы
            .join(" ") // Объединить в строку с пробелами
            .trim();
        let currencySign = $(".order-data-general .currency-toggle").contents().first()
            .text().trim();
        let boxing = activeCheckbox.length > 0 ? activeCheckbox.attr("name") : null;
        // Проверьте, что все необходимые поля заполнены

        let isRansom = $("input[name='delivery-option']:checked").val() === 'delivery-only';
        let clientName = document.querySelector('input[name="client-name"]').value;
        let clientPhone = document.querySelector('input[name="client-phone"]').value;
        let isClientExist = false;
        let numberIsValid = await validateNumber(clientPhone);
        if (!numberIsValid) {
            showInvalidMessage();
        }
        if (arrival && totalCost && totalVolume && totalWeight && count && maxDimension && typeOfGoods && clientName && clientPhone
            && numberIsValid && (!isRansom && (validateFields() || !!document.querySelector('.selected-file-name')?.childNodes[3]) || isRansom)) {
            activateDeliveryPicks();
            outArrivalCityRusTK();
            prepFields();

            // Определите значение параметра "clause" в зависимости от состояния чекбокса
            let clause = isRansom ? "self-purchase" : "ransom";

            let isBrand = $brandGood.is(":checked");

            let brand = isBrand ? "brand" : null;

            // Подготовьте данные для отправки
            let requestData = {
                arrival: arrival,
                total_cost: totalCost,
                total_volume: totalVolume,
                total_weight: totalWeight,
                count: count,
                max_dimension: maxDimension,
                type_of_goods: typeOfGoods,
                boxing: boxing,
                clause: clause,
                brand: brand,
                currency_sign: currencySign,
                insurance: insurance,
                country: countryGlobal,
            };
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
                showAwait('.cargo-cost-elem', 'cargo', true);
                dataChanged = false;
                $.ajax({
                    type: "POST",
                    url: "https://api-calc.wisetao.com:4343/api/calculate-cargo-delivery",
                    data: requestData,
                    success: function (response) {
                        dollar = response.dollar;
                        yuan = response.yuan;
                        offerData = response;
                        offerData.type_of_packaging = !offerData.type_of_packaging ? 'скотч' : offerData.type_of_packaging;
                        updatePageWithCargoResponse(response);
                        showAwait('.cargo-cost-elem', 'cargo', false);
                        console.log("Успешно отправлено!");
                        console.log("Ответ сервера:", response);

                        resolve(response);
                    },
                    error: function (error) {
                        showAwait('.cargo-cost-elem', 'cargo', false);
                        reject(error);
                    },
                });
            });
        } else {
            console.log("Заполните все обязательные поля. Запрос не будет отправлен.");
            let inputs = document.querySelectorAll('.js-validate-num, .client-requisites-input, .to-arrival-input');

            inputs.forEach(function (input) {
                let event = new Event('blur');
                input.dispatchEvent(event);
            });
            return Promise.reject("Заполните все обязательные поля.");
        }

    }

    async function sendCargoDimensionsAjaxRequest() {
        // Сохраняем данные в массивы
        let goods = [];
        let activeCheckbox = $(".boxing:checked");
        let boxing = activeCheckbox.length > 0 ? activeCheckbox.attr("name") : null;
        let insurance = $insurance.is(":checked") ? $insurance.attr("name") : null;
        // Собираем данные из полей .dimensions-input-group .length, .dimensions-input-group .width, .dimensions-input-group .height
        // Заполняем массив dimensionsData
        // Отправляем данные только если они не пустые
        let arrival = $arrival.val();
        let isRansom = $("input[name='delivery-option']:checked").val() === 'delivery-only';
        let clientName = document.querySelector('input[name="client-name"]').value;
        let clientPhone = document.querySelector('input[name="client-phone"]').value;
        let numberIsValid = await validateNumber(clientPhone);
        if (!numberIsValid) {
            showInvalidMessage();
        }
        if (checkInputs() && numberIsValid
            && (!isRansom && (validateFields() || !!document.querySelector('.selected-file-name')?.childNodes[3]) || isRansom)) {
            activateDeliveryPicks();
            outArrivalCityRusTK();
            prepFields();
            let $currencySign = $(".order-data-dimensions .currency-toggle");
            count = 0;

            for (let i = 0; i < $lengthInput.length; i++) {
                goods.push({
                    length: getFloatMeter($($lengthInput[i]).val()),
                    width: getFloatMeter($($widthInput[i]).val()),
                    height: getFloatMeter($($heightInput[i]).val()),
                    price: $($currencyInput[i]).val().replace(/,/g, '.'),
                    weight: $($weightInput[i]).val().replace(/,/g, '.'),
                    count: $($quantityInput[i]).val().replace(/,/g, '.'),
                    type_of_goods: $($typeOfGoodsDropdown[i]).contents().first()
                        .text()
                        .match(/[A-Za-zА-Яа-я\s]+/g) // Оставить только английские и русские символы и пробелы
                        .join(" ") // Объединить в строку с пробелами
                        .trim(),
                    currency_sign: $($currencySign[i]).contents().first()
                        .text().trim(),
                    brand: $dimBrand.is(':checked') ? "brand" : $($brand[i]).is(':checked') ? "brand" : null,
                });
                count += $($quantityInput[i]).val();
            }

            // Определите значение параметра "clause" в зависимости от состояния чекбокса
            let clause = isRansom ? "self-purchase" : "ransom";
            let type_good_data = $('#checkbox_input_type2');
            let dimensions = type_good_data.is(':checked') ? 'dimensions' : '';
            let good = !type_good_data.is(':checked') ? 'good' : '';
            // Отправляем данные по AJAX запросу
            let requestData = {
                goods: goods,
                arrival: arrival,
                goodsForBitrix: JSON.stringify(goods),
                dimensions: dimensions,
                good: good,
                boxing: boxing,
                clause: clause,
                insurance: insurance
            };
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
                showAwait('.cargo-cost-elem', 'cargo', true);
                dataChanged = false;
                $.ajax({
                    type: "POST",
                    url: "https://api-calc.wisetao.com:4343/api/calculate-cargo-delivery",
                    data: requestData,
                    success: function (response) {
                        dollar = response.dollar;
                        yuan = response.yuan;
                        offerData = response;
                        offerData.type_of_packaging = !offerData.type_of_packaging ? 'скотч' : offerData.type_of_packaging;
                        updatePageWithCargoResponse(response);
                        showAwait('.cargo-cost-elem', 'cargo', false);
                        console.log("Успешно отправлено!");
                        console.log("Ответ сервера:", response);
                        resolve(response);

                    },
                    error: function (error) {
                        showAwait('.cargo-cost-elem', 'cargo', false);
                        reject(error);
                    }
                });
            });
        }
        else {
            console.log("Заполните все обязательные поля. Запрос не будет отправлен.");
            let inputs = document.querySelectorAll('.dimensions-calc-input, .js-validate-num');

            inputs.forEach(function (input) {
                let event = new Event('blur');
                input.dispatchEvent(event);
            });
            return Promise.reject("Заполните все обязательные поля.");
        }
    }

    function sendDLAjaxRequest(response) {
        let totalVolume = response.total_volume;
        let totalWeight = response.total_weight;
        let arrival = $arrival.val();

        return new Promise((resolve, reject) => {
            showAwait('.cargo-cost-elem', 'dl', true);
            $.ajax({
                type: "GET",
                url: "https://api-calc.wisetao.com:4343/api/calculate-dl-delivery",
                data: {
                    arrival: arrival,
                    total_volume: totalVolume,
                    total_weight: totalWeight,
                    count: count,
                    max_dimension: maxDimension,
                    from: countryGlobal === 'Россия' ? 'Москва' : (countryGlobal === 'Кыргызстан' ? 'Бишкек' : (countryGlobal === 'Казахстан' ? 'Алматы' : 'Москва')),
                },
                success: function (dlResponse) {
                    updatePageWithDLResponse(response, dlResponse);
                    showAwait('.cargo-cost-elem', 'dl', false);
                    deleteUnavailableField(document.querySelectorAll('.list-elem.list-help.dl-help'));
                    dlResponse.tkType = 'ДЛ';
                    offerDataDL = dlResponse;
                    console.log("Успешно отправлен второй запрос!");
                    console.log("Ответ второго запроса:", dlResponse);
                    resolve();
                },
                error: function (dlError) {
                    // Обработка ошибки второго запроса
                    console.error("Ошибка при отправке второго запроса:", dlError);
                    showAwait('.cargo-cost-elem', 'dl', false);
                    if (dlError?.responseText.includes('cURL error 28: Operation timed') ||
                        dlError?.responseText.includes('Failed to open stream: HTTP request failed!')) {
                        setUnavailableField(
                            document.querySelectorAll('.list-elem.list-help.dl-help'),
                            'ДЛ',
                        );
                    }
                    reject(dlError);
                }
            });
        });
    }

    function sendPEKAjaxRequest(response) {
        let totalVolume = response.total_volume;
        let totalWeight = response.total_weight;
        let arrival = $arrival.val();
        // Отправляем третий запрос
        return new Promise((resolve, reject) => {
            showAwait('.cargo-cost-elem', 'pek', true);
            $.ajax({
                type: "GET",
                url: "https://api-calc.wisetao.com:4343/api/calculate-pek-delivery",
                data: {
                    arrival: arrival,
                    total_volume: totalVolume,
                    total_weight: totalWeight,
                    count: count,
                    max_dimension: maxDimension,
                    from: countryGlobal === 'Россия' ? 'Москва' : (countryGlobal === 'Кыргызстан' ? 'Бишкек' : (countryGlobal === 'Казахстан' ? 'Алматы' : 'Москва')),
                },
                success: function (pekResponse) {

                    updatePageWithPekResponse(response, pekResponse);
                    showAwait('.cargo-cost-elem', 'pek', false);
                    deleteUnavailableField(document.querySelectorAll('.list-elem.list-help.pek-help'));
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
                    showAwait('.cargo-cost-elem', 'pek', false);
                    if (error?.responseText.includes('cURL error 28: Operation timed') ||
                        error?.responseText.includes('Failed to open stream: HTTP request failed!')) {
                        setUnavailableField(
                            document.querySelectorAll('.list-elem.list-help.pek-help'),
                            'ПЭК',
                        );
                    }
                    reject(error);

                },
            });
        });
    }

    function sendJDEAjaxRequest(response) {
        let totalVolume = response.total_volume;
        let totalWeight = response.total_weight;
        let arrival = $arrival.val();
        // Отправляем третий запрос
        return new Promise((resolve, reject) => {
            showAwait('.cargo-cost-elem', 'jde', true);
            $.ajax({
                type: "GET",
                url: "https://api-calc.wisetao.com:4343/api/calculate-railway-expedition-delivery",
                data: {
                    arrival: arrival,
                    total_volume: totalVolume,
                    total_weight: totalWeight,
                    count: count,
                    max_dimension: maxDimension,
                    from: countryGlobal === 'Россия' ? 'Москва' : (countryGlobal === 'Кыргызстан' ? 'Бишкек' : (countryGlobal === 'Казахстан' ? 'Алматы' : 'Москва')),
                },
                success: function (jdeResponse) {

                    updatePageWithJDEResponse(response, jdeResponse);
                    // Выключаем анимацию и скрываем элементы с анимацией
                    showAwait('.cargo-cost-elem', 'jde', false);
                    deleteUnavailableField(document.querySelectorAll('.list-elem.list-help.jde-help'));
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
                    // Выключаем анимацию и скрываем элементы с анимацией
                    showAwait('.cargo-cost-elem', 'jde', false);
                    if (error?.responseText.includes('cURL error 28: Operation timed') ||
                        error?.responseText.includes('Failed to open stream: HTTP request failed!')) {
                        setUnavailableField(
                            document.querySelectorAll('.list-elem.list-help.jde-help'),
                            'ЖДЭ',
                        );
                    }
                    reject(error);
                },
            });
        });
    }

    function sendKITAjaxRequest(response) {
        let totalVolume = response.total_volume;
        let totalWeight = response.total_weight;
        let price = response.total_cost;
        let arrival = $arrival.val();
        // Отправляем пятый запрос
        return new Promise((resolve, reject) => {
            showAwait('.cargo-cost-elem', 'kit', true);
            $.ajax({
                type: "GET",
                url: "https://api-calc.wisetao.com:4343/api/calculate-kit-delivery",
                data: {
                    arrival: arrival,
                    total_volume: totalVolume,
                    total_weight: totalWeight,
                    count: count,
                    max_dimension: maxDimension,
                    price: price,
                    from: countryGlobal === 'Россия' ? 'Москва' : (countryGlobal === 'Кыргызстан' ? 'Бишкек' : (countryGlobal === 'Казахстан' ? 'Алматы' : 'Москва')),
                },
                success: function (kitResponse) {
                    updatePageWithKITResponse(response, kitResponse);
                    showAwait('.cargo-cost-elem', 'kit', false);
                    deleteUnavailableField(document.querySelectorAll('.list-elem.list-help.kit-help'));
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
                    showAwait('.cargo-cost-elem', 'kit', false);
                    console.error("Ошибка при отправке пятого запроса:", error);
                    if (error?.responseText.includes('cURL error 28: Operation timed') ||
                        error?.responseText.includes('Failed to open stream: HTTP request failed!')) {
                        setUnavailableField(
                            document.querySelectorAll('.list-elem.list-help.kit-help'),
                            'КИТ',
                        );
                    }
                    reject(error);
                },
            });
        });
    }

    function updatePageWithCargoResponse(response) {
        // Обновляем значения для delivery-types-dropdown-auto
        let autoRegularKg = response.cost_price.auto_regular;
        let autoRegularKgRub = response.cost_price_rub.auto_regular;
        $("#delivery-types-dropdown-auto .cost-elem.cargo .kg").html("$" + response.cost_price.auto_regular + ' - ' + "₽" + response.cost_price_rub.auto_regular);
        $("#delivery-types-dropdown-auto .cost-elem.cargo .sum .sum-dollar").html("$" + response.sum_cost_price.auto_regular);
        $("#delivery-types-dropdown-auto .cost-elem.cargo .sum .sum-rub").html("₽" + response.sum_cost_price_rub.auto_regular);
        $("#delivery-types-dropdown-auto .cargo-help .balloon-container .kg").html("$" + response.cost_price.auto_regular + semicolonHelpTspan + "₽" + response.cost_price_rub.auto_regular);
        $("#delivery-types-dropdown-auto .cargo-help .balloon-container .sum").html(response.sum_cost_price.auto_regular + "$" + semicolonHelpTspan + response.sum_cost_price_rub.auto_regular + "₽");
        $("#delivery-types-dropdown-auto .cargo-help .balloon-container .exchange-rate-elem-dollar").html(dollar);
        $("#delivery-types-dropdown-auto .cargo-help .balloon-container .exchange-rate-elem-yuan").html(yuan);
        $("#delivery-types-dropdown-auto .cargo-help .balloon-container .boxing-type").html(response.type_of_packaging);
        $("#delivery-types-dropdown-auto .cargo-help .balloon-container .packaging-price").html((response.packaging_price_pub / dollar).toFixed(2) + "$" + semicolonHelpTspan + response.packaging_price_pub.toFixed(2) + "₽");
        $("#delivery-types-dropdown-auto .cargo-help .balloon-container .redeem-commission").html((response.commission_price * yuan / dollar).toFixed(2) + "$" + semicolonHelpTspan + (response.commission_price * yuan).toFixed(2) + "₽");
        $("#delivery-types-dropdown-auto .cargo-help .balloon-container .insurance").html((response.insurance).toFixed(2) + "$" + semicolonHelpTspan + (response.insurance * dollar).toFixed(2) + "₽");

        let autoFastKg = response.cost_price.auto_fast;
        let autoFastKgRub = response.cost_price_rub.auto_fast;
        // Обновляем значения для delivery-types-dropdown-fast-auto
        $("#delivery-types-dropdown-fast-auto .cost-elem.cargo .kg").html("$" + response.cost_price.auto_fast + ' - ' +  "₽" + response.cost_price_rub.auto_fast);
        $("#delivery-types-dropdown-fast-auto .cost-elem.cargo .sum .sum-dollar").html("$" + response.sum_cost_price.auto_fast);
        $("#delivery-types-dropdown-fast-auto .cost-elem.cargo .sum .sum-rub").html("₽" + response.sum_cost_price_rub.auto_fast);
        $("#delivery-types-dropdown-fast-auto .cargo-help .balloon-container .kg").html("$" + response.cost_price.auto_fast + semicolonHelpTspan +  "₽" + response.cost_price_rub.auto_fast);
        $("#delivery-types-dropdown-fast-auto .cargo-help .balloon-container .sum").html(response.sum_cost_price.auto_fast + "$" + semicolonHelpTspan + response.sum_cost_price_rub.auto_fast + "₽");
        $("#delivery-types-dropdown-fast-auto .cargo-help .balloon-container .exchange-rate-elem-dollar").html(dollar);
        $("#delivery-types-dropdown-fast-auto .cargo-help .balloon-container .exchange-rate-elem-yuan").html(yuan);
        $("#delivery-types-dropdown-fast-auto .cargo-help .balloon-container .boxing-type").html(response.type_of_packaging);
        $("#delivery-types-dropdown-fast-auto .cargo-help .balloon-container .packaging-price").html((response.packaging_price_pub / dollar).toFixed(2) + "$" + semicolonHelpTspan + response.packaging_price_pub.toFixed(2) + "₽");
        $("#delivery-types-dropdown-fast-auto .cargo-help .balloon-container .redeem-commission").html((response.commission_price * yuan / dollar).toFixed(2) + "$" + semicolonHelpTspan + (response.commission_price * yuan).toFixed(2) + "₽");
        $("#delivery-types-dropdown-fast-auto .cargo-help .balloon-container .insurance").html((response.insurance).toFixed(2) + "$" + semicolonHelpTspan + (response.insurance * dollar).toFixed(2) + "₽");
        let railwayKg = response.cost_price.ZhD;
        let railwayKgRub = response.cost_price_rub.ZhD;
        // Обновляем значения для delivery-types-dropdown-railway
        $("#delivery-types-dropdown-railway .cost-elem.cargo .kg").html("$" + response.cost_price.ZhD + ' - ' + "₽" + response.cost_price_rub.ZhD);
        $("#delivery-types-dropdown-railway .cost-elem.cargo .sum .sum-dollar").html("$" + response.sum_cost_price.ZhD);
        $("#delivery-types-dropdown-railway .cost-elem.cargo .sum .sum-rub").html("₽" + response.sum_cost_price_rub.ZhD);
        $("#delivery-types-dropdown-railway .cargo-help .balloon-container .kg").html("$" + response.cost_price.ZhD + semicolonHelpTspan + "₽" + response.cost_price_rub.ZhD);
        $("#delivery-types-dropdown-railway .cargo-help .balloon-container .sum").html(response.sum_cost_price.ZhD + "$" + semicolonHelpTspan + response.sum_cost_price_rub.ZhD + "₽");
        $("#delivery-types-dropdown-railway .cargo-help .balloon-container .exchange-rate-elem-dollar").html(dollar);
        $("#delivery-types-dropdown-railway .cargo-help .balloon-container .exchange-rate-elem-yuan").html(yuan);
        $("#delivery-types-dropdown-railway .cargo-help .balloon-container .boxing-type").html(response.type_of_packaging);
        $("#delivery-types-dropdown-railway .cargo-help .balloon-container .packaging-price").html((response.packaging_price_pub / dollar).toFixed(2) + "$" + semicolonHelpTspan + response.packaging_price_pub.toFixed(2) + "₽");
        $("#delivery-types-dropdown-railway .cargo-help .balloon-container .redeem-commission").html((response.commission_price * yuan / dollar).toFixed(2) + "$" + semicolonHelpTspan + (response.commission_price * yuan).toFixed(2) + "₽");
        $("#delivery-types-dropdown-railway .cargo-help .balloon-container .insurance").html((response.insurance).toFixed(2) + "$" + semicolonHelpTspan + (response.insurance * dollar).toFixed(2) + "₽");

        let aviaKg = response.cost_price.avia;
        let aviaKgRub = response.cost_price_rub.avia;
        // Обновляем значения для delivery-types-dropdown-railway
        $("#delivery-types-dropdown-avia .cost-elem.cargo .kg").html("$" + response.cost_price.avia + ' - ' + response.cost_price_rub.avia + "₽");
        $("#delivery-types-dropdown-avia .cost-elem.cargo .sum .sum-dollar").html("$" + response.sum_cost_price.avia);
        $("#delivery-types-dropdown-avia .cost-elem.cargo .sum .sum-rub").html("₽" + response.sum_cost_price_rub.avia);
        $("#delivery-types-dropdown-avia .cargo-help .balloon-container .kg").html("$" + response.cost_price.avia + semicolonHelpTspan + response.cost_price_rub.avia + "₽");
        $("#delivery-types-dropdown-avia .cargo-help .balloon-container .sum").html(response.sum_cost_price.avia + "$" + semicolonHelpTspan + response.sum_cost_price_rub.avia + "₽");
        $("#delivery-types-dropdown-avia .cargo-help .balloon-container .exchange-rate-elem-dollar").html(dollar);
        $("#delivery-types-dropdown-avia .cargo-help .balloon-container .exchange-rate-elem-yuan").html(yuan);
        $("#delivery-types-dropdown-avia .cargo-help .balloon-container .boxing-type").html(response.type_of_packaging);
        $("#delivery-types-dropdown-avia .cargo-help .balloon-container .packaging-price").html((response.packaging_price_pub / dollar).toFixed(2) + "$" + semicolonHelpTspan + response.packaging_price_pub.toFixed(2) + "₽");
        $("#delivery-types-dropdown-avia .cargo-help .balloon-container .redeem-commission").html((response.commission_price * yuan / dollar).toFixed(2) + "$" + semicolonHelpTspan + (response.commission_price * yuan).toFixed(2) + "₽");
        $("#delivery-types-dropdown-avia .cargo-help .balloon-container .insurance").html((response.insurance).toFixed(2) + "$" + semicolonHelpTspan + (response.insurance * dollar).toFixed(2) + "₽");
    }

    function updatePageWithDLResponse(response, dlResponse) {

        // Обновление элементов внутри delivery-types-dropdown-auto
        let autoRegularKg = dlResponse.sum_cost_price.auto_regular === 'н/д' ? 'н/д' : (parseFloat((response.sum_cost_price.auto_regular + dlResponse.sum_cost_price.auto_regular) / response.total_weight).toFixed(2));
        let autoRegularKgRub = dlResponse.sum_cost_price_rub.auto_regular === 'н/д' ? 'н/д' : (parseFloat((response.sum_cost_price_rub.auto_regular + dlResponse.sum_cost_price_rub.auto_regular) / response.total_weight).toFixed(2));
        $("#delivery-types-dropdown-auto .cost-elem.dl .kg").html(autoRegularKg === 'н/д' ? "$н/д" + ' - ' + " ₽н/д" : "$" + autoRegularKg + ' - ' + '₽' + autoRegularKgRub);
        $("#delivery-types-dropdown-auto .cost-elem.dl .sum .sum-dollar").html(autoRegularKg === 'н/д' ? "$н/д" : "$" + (autoRegularKg * response.total_weight).toFixed(2));
        $("#delivery-types-dropdown-auto .cost-elem.dl .sum .sum-rub").html(autoRegularKg === 'н/д' ? "₽н/д" : "₽" + (autoRegularKgRub * response.total_weight).toFixed(2));

        // Обновление элементов внутри delivery-types-dropdown-fast-auto
        let autoFastKg = dlResponse.sum_cost_price.auto_fast === 'н/д' ? 'н/д' : (parseFloat((response.sum_cost_price.auto_fast + dlResponse.sum_cost_price.auto_fast) / response.total_weight).toFixed(2));
        let autoFastKgRub = dlResponse.sum_cost_price_rub.auto_fast === 'н/д' ? 'н/д' : (parseFloat((response.sum_cost_price_rub.auto_fast + dlResponse.sum_cost_price_rub.auto_fast) / response.total_weight).toFixed(2));
        $("#delivery-types-dropdown-fast-auto .cost-elem.dl .kg").html(autoFastKg === 'н/д' ? "$н/д" + ' - ' + " ₽н/д" : "$" + autoFastKg + ' - ' + "₽" + autoFastKgRub);
        $("#delivery-types-dropdown-fast-auto .cost-elem.dl .sum .sum-dollar").html(autoFastKg === 'н/д' ? "$н/д" : "$" + (autoFastKg * response.total_weight).toFixed(2));
        $("#delivery-types-dropdown-fast-auto .cost-elem.dl .sum .sum-rub").html(autoFastKg === 'н/д' ? "₽н/д" : "₽" + (autoFastKgRub * response.total_weight).toFixed(2));

        // Обновление элементов внутри delivery-types-dropdown-avia
        let aviaKg = dlResponse.sum_cost_price.avia === 'н/д' ? 'н/д' : (parseFloat((response.sum_cost_price.avia + dlResponse.sum_cost_price.avia) / response.total_weight).toFixed(2));
        let aviaKgRub = dlResponse.sum_cost_price_rub.avia === 'н/д' ? 'н/д' : (parseFloat((response.sum_cost_price_rub.avia + dlResponse.sum_cost_price_rub.avia) / response.total_weight).toFixed(2));
        $("#delivery-types-dropdown-avia .cost-elem.dl .kg").html(aviaKg === 'н/д' ? "$н/д" + ' - ' + " ₽н/д" : "$" + aviaKg + ' - ' + "₽" + aviaKgRub);
        $("#delivery-types-dropdown-avia .cost-elem.dl .sum .sum-dollar").html(aviaKg === 'н/д' ? "$н/д" : "$" + (aviaKg * response.total_weight).toFixed(2));
        $("#delivery-types-dropdown-avia .cost-elem.dl .sum .sum-rub").html(aviaKg === 'н/д' ? "₽н/д" : "₽" + (aviaKgRub * response.total_weight).toFixed(2));

        // Обновление элементов внутри delivery-types-dropdown-auto dl-help
        $("#delivery-types-dropdown-auto .dl-help .balloon-container .kg").html(autoRegularKg === 'н/д' ? "$н/д" + semicolonHelp + "₽н/д" : "$" + autoRegularKg + semicolonHelpTspan + '₽' + autoRegularKgRub);
        $("#delivery-types-dropdown-auto .dl-help .balloon-container .sum").html(autoRegularKg === 'н/д' ? "$н/д" + semicolonHelp + "₽н/д" : (autoRegularKg * response.total_weight).toFixed(2) + "$" + semicolonHelpTspan + (autoRegularKgRub * response.total_weight).toFixed(2) + "₽");
        $("#delivery-types-dropdown-auto .dl-help .balloon-container .exchange-rate-elem-dollar").html(dollar);
        $("#delivery-types-dropdown-auto .dl-help .balloon-container .exchange-rate-elem-yuan").html(yuan);
        $("#delivery-types-dropdown-auto .dl-help .balloon-container .boxing-type").html(response.type_of_packaging);
        $("#delivery-types-dropdown-auto .dl-help .balloon-container .packaging-price").html((response.packaging_price_pub / dollar).toFixed(2) + "$" + semicolonHelpTspan + response.packaging_price_pub.toFixed(2) + "₽");
        $("#delivery-types-dropdown-auto .dl-help .balloon-container .kg-cargo").html((response.sum_cost_price.auto_regular / response.total_weight).toFixed(2) + "$" + semicolonHelpTspan + (response.sum_cost_price.auto_regular / response.total_weight * dollar).toFixed(2) + "₽");
        $("#delivery-types-dropdown-auto .dl-help .balloon-container .sum-cargo").html((response.sum_cost_price.auto_regular).toFixed(2) + "$" + semicolonHelpTspan + (response.sum_cost_price.auto_regular * dollar).toFixed(2) + "₽");
        $("#delivery-types-dropdown-auto .dl-help .balloon-container .redeem-commission").html((response.commission_price * yuan / dollar).toFixed(2) + "$" + semicolonHelpTspan + (response.commission_price * yuan).toFixed(2) + "₽");
        $("#delivery-types-dropdown-auto .dl-help .balloon-container .insurance").html((response.insurance).toFixed(2) + "$" + semicolonHelpTspan + (response.insurance * dollar).toFixed(2) + "₽");

        // Обновление элементов внутри delivery-types-dropdown-fast-auto dl-help
        $("#delivery-types-dropdown-fast-auto .dl-help .balloon-container .kg").html(autoFastKg === 'н/д' ? "$н/д" + semicolonHelp + "₽н/д" : "$" + autoFastKg + semicolonHelpTspan + "₽" + autoFastKgRub);
        $("#delivery-types-dropdown-fast-auto .dl-help .balloon-container .sum").html(autoFastKg === 'н/д' ? "$н/д" + semicolonHelp + "₽н/д" : (autoFastKg * response.total_weight).toFixed(2) + "$" + semicolonHelpTspan + (autoFastKgRub * response.total_weight).toFixed(2) + "₽");
        $("#delivery-types-dropdown-fast-auto .dl-help .balloon-container .exchange-rate-elem-dollar").html(dollar);
        $("#delivery-types-dropdown-fast-auto .dl-help .balloon-container .exchange-rate-elem-yuan").html(yuan);
        $("#delivery-types-dropdown-fast-auto .dl-help .balloon-container .boxing-type").html(response.type_of_packaging);
        $("#delivery-types-dropdown-fast-auto .dl-help .balloon-container .packaging-price").html((response.packaging_price_pub / dollar).toFixed(2) + "$" + semicolonHelpTspan + response.packaging_price_pub.toFixed(2) + "₽");
        $("#delivery-types-dropdown-fast-auto .dl-help .balloon-container .kg-cargo").html((response.sum_cost_price.auto_regular / response.total_weight).toFixed(2) + "$" + semicolonHelpTspan + (response.sum_cost_price.auto_regular / response.total_weight * dollar).toFixed(2) + "₽");
        $("#delivery-types-dropdown-fast-auto .dl-help .balloon-container .sum-cargo").html((response.sum_cost_price.auto_regular).toFixed(2) + "$" + semicolonHelpTspan + (response.sum_cost_price.auto_regular * dollar).toFixed(2) + "₽");
        $("#delivery-types-dropdown-fast-auto .dl-help .balloon-container .redeem-commission").html((response.commission_price * yuan / dollar).toFixed(2) + "$" + semicolonHelpTspan + (response.commission_price * yuan).toFixed(2) + "₽");
        $("#delivery-types-dropdown-fast-auto .dl-help .balloon-container .insurance").html((response.insurance).toFixed(2) + "$" + semicolonHelpTspan + (response.insurance * dollar).toFixed(2) + "₽");

        // Обновление элементов внутри delivery-types-dropdown-avia dl-help
        $("#delivery-types-dropdown-avia .dl-help .balloon-container .kg").html(aviaKg === 'н/д' ? "$н/д" + semicolonHelp + "₽н/д" : "$" + aviaKg + semicolonHelpTspan + "₽" + aviaKgRub);
        $("#delivery-types-dropdown-avia .dl-help .balloon-container .sum").html(aviaKg === 'н/д' ? "$н/д" + semicolonHelp + "₽н/д" : (aviaKg * response.total_weight).toFixed(2) + "$" + semicolonHelpTspan + (aviaKgRub * response.total_weight).toFixed(2) + "₽");
        $("#delivery-types-dropdown-avia .dl-help .balloon-container .exchange-rate-elem-dollar").html(dollar);
        $("#delivery-types-dropdown-avia .dl-help .balloon-container .exchange-rate-elem-yuan").html(yuan);
        $("#delivery-types-dropdown-avia .dl-help .balloon-container .boxing-type").html(response.type_of_packaging);
        $("#delivery-types-dropdown-avia .dl-help .balloon-container .packaging-price").html((response.packaging_price_pub / dollar).toFixed(2) + "$" + semicolonHelpTspan + response.packaging_price_pub.toFixed(2) + "₽");
        $("#delivery-types-dropdown-avia .dl-help .balloon-container .kg-cargo").html((response.sum_cost_price.auto_regular / response.total_weight).toFixed(2) + "$" + semicolonHelpTspan + (response.sum_cost_price.auto_regular / response.total_weight * dollar).toFixed(2) + "₽");
        $("#delivery-types-dropdown-avia .dl-help .balloon-container .sum-cargo").html((response.sum_cost_price.auto_regular).toFixed(2) + "$" + semicolonHelpTspan + (response.sum_cost_price.auto_regular * dollar).toFixed(2) + "₽");
        $("#delivery-types-dropdown-avia .dl-help .balloon-container .redeem-commission").html((response.commission_price * yuan / dollar).toFixed(2) + "$" + semicolonHelpTspan + (response.commission_price * yuan).toFixed(2) + "₽");
        $("#delivery-types-dropdown-avia .dl-help .balloon-container .insurance").html((response.insurance).toFixed(2) + "$" + semicolonHelpTspan + (response.insurance * dollar).toFixed(2) + "₽");
    }

    function updatePageWithPekResponse(response, pekResponse) {
        // Обновляем значения для delivery-types-dropdown-auto
        let autoRegularKg = pekResponse.sum_cost_price.auto_regular === 'н/д' ? 'н/д' : (parseFloat((response.sum_cost_price.auto_regular + pekResponse.sum_cost_price.auto_regular) / response.total_weight).toFixed(2));
        let autoRegularSum = pekResponse.sum_cost_price.auto_regular === 'н/д' ? 'н/д' : (parseFloat((response.sum_cost_price.auto_regular + pekResponse.sum_cost_price.auto_regular)).toFixed(2));

        let autoRegularKgRub = pekResponse.sum_cost_price_rub.auto_regular === 'н/д' ? 'н/д' : (parseFloat((response.sum_cost_price_rub.auto_regular + pekResponse.sum_cost_price_rub.auto_regular) / response.total_weight).toFixed(2));
        let autoRegularSumRub = pekResponse.sum_cost_price_rub.auto_regular === 'н/д' ? 'н/д' : (parseFloat((response.sum_cost_price_rub.auto_regular + pekResponse.sum_cost_price_rub.auto_regular)).toFixed(2));
        $("#delivery-types-dropdown-auto .cost-elem.pek .kg").html((autoRegularKg === 'н/д') ? "$н/д" + ' - ' + " ₽н/д" : "$" + autoRegularKg + ' - ' + "₽" + autoRegularKgRub);
        $("#delivery-types-dropdown-auto .cost-elem.pek .sum .sum-dollar").html((autoRegularSum === 'н/д') ? "$н/д" : "$" + autoRegularSum);
        $("#delivery-types-dropdown-auto .cost-elem.pek .sum .sum-rub").html((autoRegularSum === 'н/д') ? "₽н/д" : "₽" + autoRegularSumRub);

        // Обновляем значения для delivery-types-dropdown-auto dl-help
        $("#delivery-types-dropdown-auto .pek-help .balloon-container .kg").html((autoRegularKg === 'н/д') ? "$н/д" + semicolonHelp + "₽н/д" : "$" + autoRegularKg + semicolonHelpTspan + autoRegularKgRub + "₽");
        $("#delivery-types-dropdown-auto .pek-help .balloon-container .sum").html((autoRegularSum === 'н/д') ? "$н/д" + semicolonHelp + "₽н/д" : (autoRegularSum) + "$" + semicolonHelpTspan + autoRegularSumRub + "₽");
        $("#delivery-types-dropdown-auto .pek-help .balloon-container .exchange-rate-elem-dollar").html(dollar);
        $("#delivery-types-dropdown-auto .pek-help .balloon-container .exchange-rate-elem-yuan").html(yuan);
        $("#delivery-types-dropdown-auto .pek-help .balloon-container .boxing-type").html(response.type_of_packaging);
        $("#delivery-types-dropdown-auto .pek-help .balloon-container .packaging-price").html((response.packaging_price_pub / dollar).toFixed(2) + "$" + semicolonHelpTspan + response.packaging_price_pub.toFixed(2) + "₽");
        $("#delivery-types-dropdown-auto .pek-help .balloon-container .kg-cargo").html((response.sum_cost_price.auto_regular / response.total_weight).toFixed(2) + "$" + semicolonHelpTspan + (response.sum_cost_price.auto_regular / response.total_weight * dollar).toFixed(2) + "₽");
        $("#delivery-types-dropdown-auto .pek-help .balloon-container .sum-cargo").html((response.sum_cost_price.auto_regular).toFixed(2) + "$" + semicolonHelpTspan + (response.sum_cost_price.auto_regular * dollar).toFixed(2) + "₽");
        $("#delivery-types-dropdown-auto .pek-help .balloon-container .redeem-commission").html((response.commission_price * yuan / dollar).toFixed(2) + "$" + semicolonHelpTspan + (response.commission_price * yuan).toFixed(2) + "₽");
        $("#delivery-types-dropdown-auto .pek-help .balloon-container .insurance").html((response.insurance).toFixed(2) + "$" + semicolonHelpTspan + (response.insurance * dollar).toFixed(2) + "₽");

        // Обновляем значения для delivery-types-dropdown-avia
        let aviaKg = pekResponse.sum_cost_price.avia === 'н/д' ? 'н/д' : (parseFloat((response.sum_cost_price.avia + pekResponse.sum_cost_price.avia) / response.total_weight).toFixed(2));
        let aviaSum = pekResponse.sum_cost_price.avia === 'н/д' ? 'н/д' : (parseFloat(response.sum_cost_price.avia + pekResponse.sum_cost_price.avia).toFixed(2));

        let aviaKgRub = pekResponse.sum_cost_price_rub.avia === 'н/д' ? 'н/д' : (parseFloat((response.sum_cost_price_rub.avia + pekResponse.sum_cost_price_rub.avia) / response.total_weight).toFixed(2));
        let aviaSumRub = pekResponse.sum_cost_price_rub.avia === 'н/д' ? 'н/д' : (parseFloat(response.sum_cost_price_rub.avia + pekResponse.sum_cost_price_rub.avia).toFixed(2));
        $("#delivery-types-dropdown-avia .cost-elem.pek .kg").html((aviaKg === 'н/д') ? "$н/д" + ' - ' + "₽н/д" : "$" + aviaKg + ' - ' + "₽" + aviaKgRub);
        $("#delivery-types-dropdown-avia .cost-elem.pek .sum .sum-dollar").html((aviaSum === 'н/д') ? "$н/д" : "$" + aviaSum);
        $("#delivery-types-dropdown-avia .cost-elem.pek .sum .sum-rub").html((aviaSum === 'н/д') ? "₽н/д" : "₽" + aviaSumRub);

        // Обновляем значения для delivery-types-dropdown-avia dl-help
        $("#delivery-types-dropdown-avia .pek-help .balloon-container .kg").html((aviaKg === 'н/д') ? "$н/д" + semicolonHelp + " ₽н/д" : "$" + aviaKg + semicolonHelpTspan + "₽" + aviaKgRub);
        $("#delivery-types-dropdown-avia .pek-help .balloon-container .sum").html((aviaSum === 'н/д') ? "$н/д" + semicolonHelp + " ₽н/д" : aviaSum + "$" + semicolonHelpTspan + aviaSumRub + "₽");
        $("#delivery-types-dropdown-avia .pek-help .balloon-container .exchange-rate-elem-dollar").html(dollar);
        $("#delivery-types-dropdown-avia .pek-help .balloon-container .exchange-rate-elem-yuan").html(yuan);
        $("#delivery-types-dropdown-avia .pek-help .balloon-container .boxing-type").html(response.type_of_packaging);
        $("#delivery-types-dropdown-avia .pek-help .balloon-container .packaging-price").html((response.packaging_price_pub / dollar).toFixed(2) + "$" + semicolonHelpTspan + response.packaging_price_pub.toFixed(2) + "₽");
        $("#delivery-types-dropdown-avia .pek-help .balloon-container .kg-cargo").html((response.sum_cost_price.auto_regular / response.total_weight).toFixed(2) + "$" + semicolonHelpTspan + (response.sum_cost_price.auto_regular / response.total_weight * dollar).toFixed(2) + "₽");
        $("#delivery-types-dropdown-avia .pek-help .balloon-container .sum-cargo").html((response.sum_cost_price.auto_regular).toFixed(2) + "$" + semicolonHelpTspan + (response.sum_cost_price.auto_regular * dollar).toFixed(2) + "₽");
        $("#delivery-types-dropdown-avia .pek-help .balloon-container .redeem-commission").html((response.commission_price * yuan / dollar).toFixed(2) + "$" + semicolonHelpTspan + (response.commission_price * yuan).toFixed(2) + "₽");
        $("#delivery-types-dropdown-avia .pek-help .balloon-container .insurance").html((response.insurance).toFixed(2) + "$" + semicolonHelpTspan + (response.insurance * dollar).toFixed(2) + "₽");
    }

    function updatePageWithJDEResponse(response, jdeResponse) {
        // Обновление элементов внутри delivery-types-dropdown-auto для auto_regular
        let autoRegularKg = (jdeResponse.sum_cost_price.auto_regular === 'н/д') ? 'н/д' : (parseFloat((response.sum_cost_price.auto_regular + jdeResponse.sum_cost_price.auto_regular) / response.total_weight).toFixed(2));
        let autoRegularKgRub = (jdeResponse.sum_cost_price_rub.auto_regular === 'н/д') ? 'н/д' : (parseFloat((response.sum_cost_price_rub.auto_regular + jdeResponse.sum_cost_price_rub.auto_regular) / response.total_weight).toFixed(2));
        $("#delivery-types-dropdown-auto .cost-elem.jde .kg").html((autoRegularKg === 'н/д') ? "$н/д" + ' - ' + "₽н/д" : "$" + autoRegularKg + ' - ' + "₽" + autoRegularKgRub);
        $("#delivery-types-dropdown-auto .cost-elem.jde .sum-dollar").html((autoRegularKg === 'н/д') ? "$н/д" : "$" + (autoRegularKg * response.total_weight).toFixed(2));
        $("#delivery-types-dropdown-auto .cost-elem.jde .sum-rub").html((autoRegularKg === 'н/д') ? "₽н/д" : "₽" + (autoRegularKgRub * response.total_weight).toFixed(2));

        // Обновление элементов внутри delivery-types-dropdown-fast-auto для auto_fast
        let autoFastKg = (jdeResponse.sum_cost_price.auto_fast === 'н/д') ? 'н/д' : (parseFloat((response.sum_cost_price.auto_fast + jdeResponse.sum_cost_price.auto_fast) / response.total_weight).toFixed(2));
        let autoFastKgRub = (jdeResponse.sum_cost_price_rub.auto_fast === 'н/д') ? 'н/д' : (parseFloat((response.sum_cost_price_rub.auto_fast + jdeResponse.sum_cost_price_rub.auto_fast) / response.total_weight).toFixed(2));
        $("#delivery-types-dropdown-fast-auto .cost-elem.jde .kg").html((autoFastKg === 'н/д') ? "$н/д" + ' - ' + "₽н/д" : "$" + autoFastKg + ' - ' + "₽" + autoFastKgRub);
        $("#delivery-types-dropdown-fast-auto .cost-elem.jde .sum .sum-dollar").html((autoFastKg === 'н/д') ? "$н/д" : "$" + (autoFastKg * response.total_weight).toFixed(2));
        $("#delivery-types-dropdown-fast-auto .cost-elem.jde .sum .sum-rub").html((autoFastKg === 'н/д') ? "₽н/д" : "₽" + (autoFastKgRub * response.total_weight).toFixed(2));

        // Обновление элементов внутри delivery-types-dropdown-auto jde-help для auto_regular
        $("#delivery-types-dropdown-auto .jde-help .balloon-container .kg").html((autoRegularKg === 'н/д') ? "$н/д" + semicolonHelp + " ₽н/д" : "$" + autoRegularKg + semicolonHelpTspan + autoRegularKgRub + "₽");
        $("#delivery-types-dropdown-auto .jde-help .balloon-container .sum").html((autoRegularKg === 'н/д') ? "$н/д" + semicolonHelp + " ₽н/д" : (autoRegularKg * response.total_weight).toFixed(2) + "$" + semicolonHelpTspan + (autoRegularKgRub * response.total_weight).toFixed(2) + "₽");
        $("#delivery-types-dropdown-auto .jde-help .balloon-container .exchange-rate-elem-dollar").html(dollar);
        $("#delivery-types-dropdown-auto .jde-help .balloon-container .exchange-rate-elem-yuan").html(yuan);
        $("#delivery-types-dropdown-auto .jde-help .balloon-container .boxing-type").html(response.type_of_packaging);
        $("#delivery-types-dropdown-auto .jde-help .balloon-container .packaging-price").html((response.packaging_price_pub / dollar).toFixed(2) + "$" + semicolonHelpTspan + response.packaging_price_pub.toFixed(2) + "₽");
        $("#delivery-types-dropdown-auto .jde-help .balloon-container .kg-cargo").html((response.sum_cost_price.auto_regular / response.total_weight).toFixed(2) + "$" + semicolonHelpTspan + (response.sum_cost_price.auto_regular / response.total_weight * dollar).toFixed(2) + "₽");
        $("#delivery-types-dropdown-auto .jde-help .balloon-container .sum-cargo").html((response.sum_cost_price.auto_regular).toFixed(2) + "$" + semicolonHelpTspan + (response.sum_cost_price.auto_regular * dollar).toFixed(2) + "₽");
        $("#delivery-types-dropdown-auto .jde-help .balloon-container .redeem-commission").html((response.commission_price * yuan / dollar).toFixed(2) + "$" + semicolonHelpTspan + (response.commission_price * yuan).toFixed(2) + "₽");
        $("#delivery-types-dropdown-auto .jde-help .balloon-container .insurance").html((response.insurance).toFixed(2) + "$" + semicolonHelpTspan + (response.insurance * dollar).toFixed(2) + "₽");

        // Обновление элементов внутри delivery-types-dropdown-fast-auto jde-help для auto_fast
        $("#delivery-types-dropdown-fast-auto .jde-help .balloon-container .kg").html((autoFastKg === 'н/д') ? "$н/д" + semicolonHelp + " ₽н/д" : "$" + autoFastKg + semicolonHelpTspan + autoFastKgRub + "₽");
        $("#delivery-types-dropdown-fast-auto .jde-help .balloon-container .sum").html((autoFastKg === 'н/д') ? "$н/д" + semicolonHelp + " ₽н/д" : (autoFastKg * response.total_weight).toFixed(2) + "$" + semicolonHelpTspan + (autoFastKgRub * response.total_weight).toFixed(2) + "₽");
        $("#delivery-types-dropdown-fast-auto .jde-help .balloon-container .exchange-rate-elem-dollar").html(dollar);
        $("#delivery-types-dropdown-fast-auto .jde-help .balloon-container .exchange-rate-elem-yuan").html(yuan);
        $("#delivery-types-dropdown-fast-auto .jde-help .balloon-container .boxing-type").html(response.type_of_packaging);
        $("#delivery-types-dropdown-fast-auto .jde-help .balloon-container .packaging-price").html((response.packaging_price_pub / dollar).toFixed(2) + "$" + semicolonHelpTspan + response.packaging_price_pub.toFixed(2) + "₽");
        $("#delivery-types-dropdown-fast-auto .jde-help .balloon-container .kg-cargo").html((response.sum_cost_price.auto_regular / response.total_weight).toFixed(2) + "$" + semicolonHelpTspan + (response.sum_cost_price.auto_regular / response.total_weight * dollar).toFixed(2) + "₽");
        $("#delivery-types-dropdown-fast-auto .jde-help .balloon-container .sum-cargo").html((response.sum_cost_price.auto_regular).toFixed(2) + "$" + semicolonHelpTspan + (response.sum_cost_price.auto_regular * dollar).toFixed(2) + "₽");
        $("#delivery-types-dropdown-fast-auto .jde-help .balloon-container .redeem-commission").html((response.commission_price * yuan / dollar).toFixed(2) + "$" + semicolonHelpTspan + (response.commission_price * yuan).toFixed(2) + "₽");
        $("#delivery-types-dropdown-fast-auto .jde-help .balloon-container .insurance").html((response.insurance).toFixed(2) + "$" + semicolonHelpTspan + (response.insurance * dollar).toFixed(2) + "₽");
    }

    function updatePageWithKITResponse(response, kitResponse) {

        // Обновление элементов внутри delivery-types-dropdown-auto
        let autoRegularKg = (kitResponse.sum_cost_price.auto_regular !== 'н/д') ? (parseFloat((response.sum_cost_price.auto_regular + kitResponse.sum_cost_price.auto_regular) / response.total_weight).toFixed(2)) : 'н/д';
        let autoRegularKgRub = (kitResponse.sum_cost_price_rub.auto_regular !== 'н/д') ? (parseFloat((response.sum_cost_price_rub.auto_regular + kitResponse.sum_cost_price_rub.auto_regular) / response.total_weight).toFixed(2)) : 'н/д';
        $("#delivery-types-dropdown-auto .cost-elem.kit .kg").html((autoRegularKg !== 'н/д') ? "$" + autoRegularKg + ' - ' + "₽" + autoRegularKgRub : "$н/д" + ' - ' + " ₽н/д");
        $("#delivery-types-dropdown-auto .cost-elem.kit .sum .sum-dollar").html((autoRegularKg !== 'н/д') ? "$" + (autoRegularKg * response.total_weight).toFixed(2) : "$н/д");
        $("#delivery-types-dropdown-auto .cost-elem.kit .sum .sum-rub").html((autoRegularKg !== 'н/д') ? "₽" + (autoRegularKgRub * response.total_weight).toFixed(2) : "₽н/д");

        // Обновление элементов внутри delivery-types-dropdown-fast-auto
        let autoFastKg = (kitResponse.sum_cost_price.auto_fast !== 'н/д') ? (parseFloat((response.sum_cost_price.auto_fast + kitResponse.sum_cost_price.auto_fast) / response.total_weight).toFixed(2)) : 'н/д';
        let autoFastKgRub = (kitResponse.sum_cost_price_rub.auto_fast !== 'н/д') ? (parseFloat((response.sum_cost_price_rub.auto_fast + kitResponse.sum_cost_price_rub.auto_fast) / response.total_weight).toFixed(2)) : 'н/д';
        $("#delivery-types-dropdown-fast-auto .cost-elem.kit .kg").html((autoFastKg !== 'н/д') ? "$" + autoFastKg + ' - ' + "₽" + autoFastKgRub : "$н/д" + ' - ' + " ₽н/д");
        $("#delivery-types-dropdown-fast-auto .cost-elem.kit .sum .sum-dollar").html((autoFastKg !== 'н/д') ? "$" + (autoFastKg * response.total_weight).toFixed(2) : "$н/д");
        $("#delivery-types-dropdown-fast-auto .cost-elem.kit .sum .sum-rub").html((autoFastKg !== 'н/д') ? "₽" + (autoFastKgRub * response.total_weight).toFixed(2) : "₽н/д");

        // Обновление элементов внутри delivery-types-dropdown-auto kit-help
        $("#delivery-types-dropdown-auto .kit-help .balloon-container .kg").html((autoRegularKg !== 'н/д') ? "$" + autoRegularKg + semicolonHelpTspan + autoRegularKgRub + "₽" : "$н/д" + semicolonHelp + " ₽н/д");
        $("#delivery-types-dropdown-auto .kit-help .balloon-container .sum").html((autoRegularKg !== 'н/д') ? (autoRegularKg * response.total_weight).toFixed(2) + "$" + semicolonHelpTspan + (autoRegularKgRub * response.total_weight).toFixed(2) + "₽" : "$н/д" + semicolonHelp + " ₽н/д");
        $("#delivery-types-dropdown-auto .kit-help .balloon-container .exchange-rate-elem-dollar").html(dollar);
        $("#delivery-types-dropdown-auto .kit-help .balloon-container .exchange-rate-elem-yuan").html(yuan);
        $("#delivery-types-dropdown-auto .kit-help .balloon-container .boxing-type").html(response.type_of_packaging);
        $("#delivery-types-dropdown-auto .kit-help .balloon-container .packaging-price").html((response.packaging_price_pub / dollar).toFixed(2) + "$" + semicolonHelpTspan + response.packaging_price_pub.toFixed(2) + "₽");
        $("#delivery-types-dropdown-auto .kit-help .balloon-container .kg-cargo").html((response.sum_cost_price.auto_regular / response.total_weight).toFixed(2) + "$" + semicolonHelpTspan + (response.sum_cost_price.auto_regular / response.total_weight * dollar).toFixed(2) + "₽");
        $("#delivery-types-dropdown-auto .kit-help .balloon-container .sum-cargo").html((response.sum_cost_price.auto_regular).toFixed(2) + "$" + semicolonHelpTspan + (response.sum_cost_price.auto_regular * dollar).toFixed(2) + "₽");
        $("#delivery-types-dropdown-auto .kit-help .balloon-container .redeem-commission").html((response.commission_price * yuan / dollar).toFixed(2) + "$" + semicolonHelpTspan + (response.commission_price * yuan).toFixed(2) + "₽");
        $("#delivery-types-dropdown-auto .kit-help .balloon-container .insurance").html((response.insurance).toFixed(2) + "$" + semicolonHelpTspan + (response.insurance * dollar).toFixed(2) + "₽");

        // Обновление элементов внутри delivery-types-dropdown-fast-auto kit-help
        $("#delivery-types-dropdown-fast-auto .kit-help .balloon-container .kg").html((autoFastKg !== 'н/д') ? "$" + autoFastKg + semicolonHelpTspan + autoFastKgRub + "₽" : "$н/д" + semicolonHelp + " ₽н/д");
        $("#delivery-types-dropdown-fast-auto .kit-help .balloon-container .sum").html((autoFastKg !== 'н/д') ? (autoFastKg * response.total_weight).toFixed(2) + "$" + semicolonHelpTspan + (autoFastKgRub * response.total_weight).toFixed(2) + "₽" : "$н/д" + semicolonHelp + " ₽н/д");
        $("#delivery-types-dropdown-fast-auto .kit-help .balloon-container .exchange-rate-elem-dollar").html(dollar);
        $("#delivery-types-dropdown-fast-auto .kit-help .balloon-container .exchange-rate-elem-yuan").html(yuan);
        $("#delivery-types-dropdown-fast-auto .kit-help .balloon-container .boxing-type").html(response.type_of_packaging);
        $("#delivery-types-dropdown-fast-auto .kit-help .balloon-container .packaging-price").html((response.packaging_price_pub / dollar).toFixed(2) + "$" + semicolonHelpTspan + response.packaging_price_pub.toFixed(2) + "₽");
        $("#delivery-types-dropdown-fast-auto .kit-help .balloon-container .kg-cargo").html((response.sum_cost_price.auto_regular / response.total_weight).toFixed(2) + "$" + semicolonHelpTspan + (response.sum_cost_price.auto_regular / response.total_weight * dollar).toFixed(2) + "₽");
        $("#delivery-types-dropdown-fast-auto .kit-help .balloon-container .sum-cargo").html((response.sum_cost_price.auto_regular).toFixed(2) + "$" + semicolonHelpTspan + (response.sum_cost_price.auto_regular * dollar).toFixed(2) + "₽");
        $("#delivery-types-dropdown-fast-auto .kit-help .balloon-container .redeem-commission").html((response.commission_price * yuan / dollar).toFixed(2) + "$" + semicolonHelpTspan + (response.commission_price * yuan).toFixed(2) + "₽");
        $("#delivery-types-dropdown-fast-auto .kit-help .balloon-container .insurance").html((response.insurance).toFixed(2) + "$" + semicolonHelpTspan + (response.insurance * dollar).toFixed(2) + "₽");
    }

    cargoCalcButton.on('click', function (event) {
        event.stopPropagation();
        event.preventDefault();
        if (_tmr) {
            _tmr.push({ type: 'reachGoal', id: 3555455, goal: 'calculate_button'});
        }
        changeArrivalSaide();
        trackAndSendAjaxRequests();
        event.stopPropagation();
        event.preventDefault();
    });
    cargoDimensionsCalcButton.on('click', function (event) {
        event.stopPropagation();
        event.preventDefault();
        if (_tmr) {
            _tmr.push({ type: 'reachGoal', id: 3555455, goal: 'calculate_button'});
        }
        changeArrivalSaide();
        trackAndSendDimensionsAjaxRequests();
        event.stopPropagation();
        event.preventDefault();
    });

    let $boxing = $(".boxing");
    if (dimensions.is(":checked")) {
        $boxing.off('change');
        if (_tmr) {
            _tmr.push({ type: 'reachGoal', id: 3555455, goal: 'calculate_button'});
        }
        $boxing.on('change', trackAndSendAjaxRequests);
    }
    else {
        $boxing.off('change');
        if (_tmr) {
            _tmr.push({ type: 'reachGoal', id: 3555455, goal: 'calculate_button'});
        }
        $boxing.on('change', trackAndSendDimensionsAjaxRequests);
    }

    dimensions.on('change', function() {
        if (!dimensions.is(':checked')) {
            // Чекбокс отмечен, продолжаем отслеживать изменения в полях
            $boxing.off('change');
            if (_tmr) {
                _tmr.push({ type: 'reachGoal', id: 3555455, goal: 'calculate_button'});
            }
            $boxing.on('change', trackAndSendDimensionsAjaxRequests);
        } else {
            // Чекбокс не отмечен, останавливаем отслеживание изменений в полях
            $boxing.off('change');
            if (_tmr) {
                _tmr.push({ type: 'reachGoal', id: 3555455, goal: 'calculate_button'});
            }
            $boxing.on('change', trackAndSendAjaxRequests);
        }
    });

    let $offerButtons = $(".offer-button");
    $offerButtons.on('click', function (event) {
        event.stopPropagation();
        event.preventDefault();

        if (document.querySelector('.list-help.selected')) {
            if (_tmr) {
                _tmr.push({ type: 'reachGoal', id: 3555455, goal: 'calculate_offer'});
            }
            ajaxOfferDataRequest(
                document.querySelector('.list-help.selected').closest('.desc').querySelector('.delivery-types-dropdown').dataset.delivery_type,
                document.querySelector('.list-help.selected').closest('.desc').querySelector('.delivery-item-label').textContent.trim(),
                document.querySelector('.list-help.selected').querySelector('.tk-type').textContent.trim(),
            );
            // document.querySelector('.pop-up-dark-back-offer').style.display = 'flex';
        }
        event.stopPropagation();
        event.preventDefault();
    });

    // let $offerButton = $(".pop-up-offer-button");
    // $offerButton.on('click', function (event) {
    //     event.stopPropagation();
    //     event.preventDefault();
    //     let notice = document.querySelector('.pop-up-email').nextElementSibling;
    //     if (document.querySelector('.pop-up-email').value !== '') {
    //         if (document.querySelector('.list-help.selected')) {
    //             ajaxOfferDataRequest(
    //                 document.querySelector('.list-help.selected').closest('.desc').querySelector('.delivery-types-dropdown').dataset.delivery_type,
    //                 document.querySelector('.list-help.selected').closest('.desc').querySelector('.delivery-item-label').textContent.trim(),
    //             );
    //         }
    //         hideNoticePopUp();
    //     }
    //     else {
    //         notice.textContent = "заполните " + '"EMail"';
    //         notice.style.display = 'block'; // Отобразить надпись
    //         document.querySelector('.pop-up-email').style.border = '1px solid #a81d29';
    //     }
    //     event.stopPropagation();
    //     event.preventDefault();
    // });
}

// function hideNoticePopUp() {
//     let notice = document.querySelector('.pop-up-email').nextElementSibling;
//     notice.style.display = 'none'; // Скрыть надпись
//     document.querySelector('.pop-up-email').style.border = ''; // Убрать красную рамку поля
// }

function showAwait(costElemName, deliveryName, onShow) {
    let costElem = $(`${costElemName}.${deliveryName}`);

    let clocks = costElem.map(function() {
        let currentCostElem = $(this);
        let clocks = currentCostElem.closest('li').find('.clock');
        return clocks.get();
    }).get();

    let markers = costElem.map(function() {
        let currentCostElem = $(this);
        let markers = currentCostElem.closest('li').find('.marker');
        return markers.get();
    }).get();

    let overlays = costElem.map(function() {
        let currentCostElem = $(this);
        let overlays = currentCostElem.closest('li').find('.overlay-delivery-item');
        return overlays.get();
    }).get();

    if (onShow) {
        $(clocks).show();
        $(markers).css('animation-play-state', 'running');
        $(markers).show();
        $(overlays).show();
        $(overlays).parent().removeClass('enable-pointer');
    }
    else {
        $(clocks).hide();
        $(markers).css('animation-play-state', 'paused');
        $(markers).hide();
        $(overlays).hide();
        $(overlays).parent().addClass('enable-pointer');
    }
}

function prepFields() {
    let boxingContentContainer = document.querySelector('.boxing-content-container');
    if (boxingContentContainer) {
        boxingContentContainer.classList.remove('hidden');
    }
    const selectors = [
        '.kg',
        '.sum .sum-dollar',
        '.sum .sum-rub',
        '.balloon-container .sum',
        '.balloon-container .exchange-rate-elem-dollar',
        '.balloon-container .exchange-rate-elem-yuan',
        '.boxing-type',
        '.packaging-price',
        '.redeem-commission',
        '.insurance',
        '.kg-cargo',
        '.sum-cargo'
    ];

    selectors.forEach(selector => {
        const elements = document.querySelectorAll(selector);
        elements.forEach(element => {
            if (element.classList.contains('kg')) {
                element.innerHTML = '$н/д - ₽н/д';
            }
            else {
                element.innerHTML = 'н/д';
            }
        });
    });
}

function setUnavailableField(cells, name) {
    let unavailableField = document.createElement('div');
    unavailableField.innerHTML = `Сервис ${name}<br>временно недоступен`;
    unavailableField.classList.add('unavailable-field');
    unavailableField.style.background = 'rgba(47, 55, 67)';
    cells.forEach(cell => {
        cell.classList.remove('enable-pointer');
        cell.parentElement.insertBefore(unavailableField.cloneNode(true), cell);
    });

}

function deleteUnavailableField(cells) {
    cells.forEach(cell => {
        cell.classList.add('enable-pointer');
        let liElem = cell.parentElement;
        let unavailableField = liElem.querySelector('.unavailable-field');
        if (unavailableField) {
            liElem.removeChild(unavailableField);
        }
    });
}

async function sendOrderDataForEmail(requestData, clientName, clientPhone, isClientExist) {
    let emailData = { ...requestData }; // Копируем данные из requestData
    emailData.SITE_ID = 's3'; // Добавляем SITE_ID
    emailData.sessid = BX.message('bitrix_sessid'); // Добавляем идентификатор сессии

    let formData = new FormData();

    for (const key in emailData) {
        if (emailData.hasOwnProperty(key)) {
            formData.append(key, emailData[key]);
        }
    }

    if (emailData.clause === 'ransom' || emailData.clause === 'ransom-white') {
        let blobRedeem = await submitRedeemData(); // \calc-layout\js\submit_redeem_data.js
        formData.append('redeemFile', new File([blobRedeem], 'Данные для выкупа заказа.xlsx', { type: blobRedeem.type }));
    }
    formData.append('name', clientName);
    formData.append('phone', clientPhone);
    formData.append('isClientExist', isClientExist);
    formData.set('clause', emailData.clause === 'self-purchase' ? 'Нет' : 'Да');

    let query = {
        action: 'telegram:document.api.OrderDataController.send_order_data_by_email' // Определяем маршрут для второго запроса
    };

    let options = {
        type: 'POST',
        url: '/bitrix/services/main/ajax.php?' + $.param(query),
        data: formData,
        contentType: false,
        processData: false,
        dataType: 'json',
    };

    return $.ajax(options)
        .then(function (response) {
            console.log('Данные успешно отправлены:', response);
            return response;
        })
        .catch(function (error) {
            console.error('Ошибка при отправке данных:', error);
            return { error: error };
        });
}

function outArrivalCityRusTK() {
    document.querySelectorAll('.arrival-city-rus-tk').forEach(cityRusTK => {
        cityRusTK.innerHTML += ` - до г. ${arrivalCityRusTK}`;
    });
}

function getFloatMeter(value) {
    return parseFloat(value.replace(/,/g, '.')) / 100;
}

function showInvalidMessage() {
    let notice = document.querySelector('.input-notice-valid-number');
    if (notice) {
        notice.style.display = 'block';
        notice.textContent = 'Неверный номер';
        let inputPhone = notice.parentElement.querySelector('.client-requisites-input.phone');
        if (inputPhone) {
            inputPhone.style.color = '#ed5555';
        }
    }
}