function initializeAjaxRequestCargoWhite() {
    let calculateButton = $('#cargo-white-calc-button');
    let $arrival = $("input[name='arrival']");
    let $insurance = $("input[name='insurance']");
    let dollar, yuan;
    let semicolon = '<span style="color: white">; </span>';
    let semicolonHelp = '<span style="color: black">; </span>';
    let semicolonHelpTspan = '<tspan fill="black">; </tspan>';
    async function sendCargoForWhiteMultipleAjaxRequests() {
        const submitButton = document.querySelector('#cargo-white-calc-button');
        submitButton.disabled = true;
        const boxingExpandButton = document.querySelector('.boxing-spoiler-header');
        boxingExpandButton.style.pointerEvents = 'none';
        boxingExpandButton.parentElement.style.background = 'grey';
        const calcTypeButtons = document.querySelectorAll('.calc-type-button:not(.tnved-calc-button.submit-redeem-data.submit-excel-file):not(.submit-general-button):not(.submit-dimensions-button)');
        calcTypeButtons.forEach((calcTypeButton) => {calcTypeButton.setAttribute('disabled', '')});
        $('.list-elem').removeClass('enable-pointer');
        $('.list-elem.selected').removeClass('selected');
        document.querySelector('.main-offer-button').setAttribute('disabled', '');
        disableBoxingButtons();
        try {
            const cargoResponse = await sendCargoFromWhiteAjaxRequest();
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

    function ajaxofferDataCargoRequest(deliveryType, deliveryTypeRus) {
        if (offerDataCargo) {
            let offerDataCargoRequest = {
                DeliveryType: 'Тип доставки: ' + deliveryTypeRus,
                ExchangeRateYuan: 'Курс юаня SAIDE: ' + offerDataCargo.yuan + "₽",
                ExchangeRateDollar: 'Курс доллара SAIDE: ' + offerDataCargo.dollar + "₽",
                TOTAL: 'ИТОГО: ' + offerDataCargo.sum_cost_price[deliveryType] + "$; " + offerDataCargo.sum_cost_price_rub[deliveryType] + "₽",
                GoodsCost: 'Стоимость товара: ' + offerDataCargo.total_cost + "₽",
                Weight: 'Вес: ' + offerDataCargo.total_weight + 'кг',
                Volume: 'Объем: ' + parseFloat(offerDataCargo.total_volume.toFixed(3)) + 'м' + String.fromCharCode(0x00B3),
                Count: 'Количество: ',
                RedeemCommission: 'Комиссия SAIDE 5% от стоимости товара: ' + (offerDataCargo.commission_price * offerDataCargo.yuan / offerDataCargo.dollar).toFixed(2) + "$; " + (offerDataCargo.commission_price * offerDataCargo.yuan).toFixed(2) + "₽",
                PackageType: 'Упаковка: ' + offerDataCargo.type_of_packaging,
                PackageCost: 'За упаковку: ' + offerDataCargo.packaging_price_pub + "₽",
                Insurance: 'Страховка: ' + offerDataCargo.insurance.toFixed(2) + "$; " + (offerDataCargo.insurance * offerDataCargo.dollar).toFixed(2) + "₽",
                Kg: 'За кг: ' + offerDataCargo.cost_price[deliveryType] + "$; " + offerDataCargo.cost_price_rub[deliveryType] + "₽",
                Sum: 'Сумма: ' + offerDataCargo.sum_cost_price[deliveryType] + "$; " + offerDataCargo.sum_cost_price_rub[deliveryType] + "₽",
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
                data: offerDataCargoRequest,
                xhrFields: {
                    responseType: 'blob' // Устанавливаем ожидание бинарных данных
                },
                success: function (response) {
                    let url = URL.createObjectURL(response);

                    // Открываем PDF в новой вкладке браузера
                    window.open(url, '_blank');

                    // Освобождаем ресурсы URL
                    URL.revokeObjectURL(url);

                    console.log("Успешно отправлено!");
                    console.log("Ответ сервера:", response);

                    submitRedeemData(response);
                },
                error: function (error) {
                    clearInterval(countdownTimer);
                    hideModal();
                },
            });
        }
    }

    function sendCargoFromWhiteAjaxRequest() {
        // Проверка, если checkbox_input_type отмечен
        // Выберите активный чекбокс с классом .boxing
        let isAllInputFieldsFilled = true;
        let $tnvedDataContainer = $('.tnved-data-container');
        $tnvedDataContainer.each(function () {
            $(this).find('input').add($arrival).each(function () {
                if (!$(this).hasClass('select-by-name-input')) {
                    if ($(this).val() === "") {
                        isAllInputFieldsFilled = false;
                        return false; // Выход из цикла, как только найдено незаполненное поле
                    }
                }
            });
        });
        let activeCheckbox = $(".boxing:checked");

        let isRansom = $("input[name='delivery-option']:checked").val() === 'delivery-only';

        if (isAllInputFieldsFilled
            && (!isRansom && (validateFields() || !!document.querySelector('.selected-file-name')?.childNodes[3]) || isRansom)) {
            activateDeliveryPicks();
            totalVolume = 0;
            let goods = [];
            // Получение данных из полей ввода и списков
            $tnvedDataContainer.each(function () {
                // Получите значение поля weight и преобразуйте его в число
                let weight = parseFloat($(this).find('[name="weight[]"]').val());
                let volume = parseFloat($(this).find('[name="volume[]"]').val());
                let currency = parseFloat($(this).find('[name="currency[]"]').val());
                let $typeOfGoodsDropdown = $(this).find('.type-of-goods-dropdown-toggle');
                let $currencySign = $(this).find(".currency-toggle");
                let $brand = $(this).find('.brand-checkbox');
                goods.push({
                    price: currency,
                    weight: weight,
                    volume: volume,
                    count: 1,
                    type_of_goods: $typeOfGoodsDropdown.contents().first()
                        .text()
                        .match(/[A-Za-zА-Яа-я\s]+/g) // Оставить только английские и русские символы и пробелы
                        .join(" ") // Объединить в строку с пробелами
                        .trim(),
                    currency_sign: $currencySign.contents().first()
                        .text(),
                    brand: $brand.is(':checked') ? "brand" : null,
                });
                // Создайте объект item и добавьте его в requestData.items (ваш существующий код)
            });
            let boxing = activeCheckbox.length > 0 ? activeCheckbox.attr("name") : null;
            let insurance = $insurance.is(":checked") ? $insurance.attr("name") : null;
            // Получите значение чекбокса с именем "ransom"



            // Определите значение параметра "clause" в зависимости от состояния чекбокса
            let clause = isRansom ? "self-purchase" : "ransom";

            // Подготовьте данные для отправки
            let requestData = {
                goods: goods,
                boxing: boxing,
                clause: clause,
                white: 'white',
                insurance: insurance,
            };
            return new Promise((resolve, reject) => {
                showAwait('.cargo-cost-elem:not(.white-cost-elem)', 'cargo', true);
                $.ajax({
                    type: "POST",
                    url: "https://api-calc.wisetao.com:4343/api/calculate-cargo-delivery",
                    data: requestData,
                    success: function (response) {
                        offerDataCargo = response;
                        dollar = response.dollar;
                        yuan = response.yuan;
                        updatePageWithCargoResponse(response);
                        showAwait('.cargo-cost-elem:not(.white-cost-elem)', 'cargo', false);
                        console.log("Успешно отправлено!");
                        console.log("Ответ сервера:", response);

                        resolve(response);
                    },
                    error: function (error) {
                        showAwait('.cargo-cost-elem:not(.white-cost-elem)', 'cargo', false);
                        reject(error);
                    },
                });
            });
        } else {
            console.log("Заполните все обязательные поля. Запрос не будет отправлен.");
            return Promise.reject("Заполните все обязательные поля.");
        }
    }

    function handleBoxingChangeCargoForWhite() {
        if (activeButton.dataset.type === 'comparison') {
            sendCargoForWhiteMultipleAjaxRequests().catch(() => {});
        }
    }

    let $boxing = $(".boxing");
    $boxing.off('change', handleBoxingChangeCargoForWhite);
    $boxing.on('change', handleBoxingChangeCargoForWhite);

    let $offerButtons = $(".offer-button");
    $offerButtons.on('click', function (event) {
        event.stopPropagation();
        event.preventDefault();
        if (document.querySelector('.list-help.selected').closest('ul').firstElementChild.querySelector('li .list-help').classList.contains('cargo-help')) {
            if (_tmr) {
                _tmr.push({ type: 'reachGoal', id: 3555455, goal: 'calculate_offer'});
            }
            // document.querySelector('.pop-up-dark-back-offer').style.display = 'flex';
            ajaxofferDataCargoRequest(
                document.querySelector('.list-help.selected').closest('.desc').querySelector('.delivery-types-dropdown').dataset.delivery_type,
                document.querySelector('.list-help.selected').closest('.desc').querySelector('.delivery-types-dropdown').dataset.delivery_type_rus,
            );
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
    //         if (document.querySelector('.list-help.selected').closest('ul').firstElementChild.querySelector('li .list-help').classList.contains('cargo-help')) {
    //             ajaxofferDataCargoRequest(
    //                 document.querySelector('.list-help.selected').closest('.desc').querySelector('.delivery-types-dropdown').dataset.delivery_type,
    //                 document.querySelector('.list-help.selected').closest('.desc').querySelector('.delivery-types-dropdown').dataset.delivery_type_rus,
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

    calculateButton.on('click', function (event) {
        // Проверяем, что все поля ввода заполнены
        event.preventDefault();
        if (_tmr) {
            _tmr.push({ type: 'reachGoal', id: 3555455, goal: 'calculate_button'});
        }
        if (activeButton.dataset.type === 'comparison') {
            sendCargoForWhiteMultipleAjaxRequests().catch(() => {});
        }
        event.preventDefault();
        event.stopPropagation();
    });

    function sendDLAjaxRequest(response) {
        let totalVolume = response.total_volume;
        let totalWeight = response.total_weight;
        let arrival = $arrival.val();

        let count = $('.tnved-data-container').length;
        return new Promise((resolve, reject) => {
            showAwait('.cargo-cost-elem:not(.white-cost-elem)', 'dl', true);
            $.ajax({
                type: "GET",
                url: "https://api-calc.wisetao.com:4343/api/calculate-dl-delivery",
                data: {
                    arrival: arrival,
                    total_volume: totalVolume,
                    total_weight: totalWeight,
                    count: count,
                    max_dimension: 0,
                    from: 'Москва',
                },
                success: function (dlResponse) {
                    updatePageWithDLResponse(response, dlResponse);
                    showAwait('.cargo-cost-elem:not(.white-cost-elem)', 'dl', false);
                    console.log("Успешно отправлен второй запрос!");
                    console.log("Ответ второго запроса:", dlResponse);
                    resolve();
                },
                error: function (dlError) {
                    // Обработка ошибки второго запроса
                    console.error("Ошибка при отправке второго запроса:", dlError);
                    showAwait('.cargo-cost-elem:not(.white-cost-elem)', 'dl', false);
                    reject(dlError);
                }
            });
        });
    }

    function sendPEKAjaxRequest(response) {
        let totalVolume = response.total_volume;
        let totalWeight = response.total_weight;
        let arrival = $arrival.val();
        let count = $('.tnved-data-container').length;
        // Отправляем третий запрос
        return new Promise((resolve, reject) => {
            showAwait('.cargo-cost-elem:not(.white-cost-elem)', 'pek', true);
            $.ajax({
                type: "GET",
                url: "https://api-calc.wisetao.com:4343/api/calculate-pek-delivery",
                data: {
                    arrival: arrival,
                    total_volume: totalVolume,
                    total_weight: totalWeight,
                    count: count,
                    max_dimension: 0,
                    from: 'Москва',
                },
                success: function (pekResponse) {

                    updatePageWithPekResponse(response, pekResponse);
                    showAwait('.cargo-cost-elem:not(.white-cost-elem)', 'pek', false);
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
                    showAwait('.cargo-cost-elem:not(.white-cost-elem)', 'pek', false);
                    reject(error);

                },
            });
        });
    }

    function sendJDEAjaxRequest(response) {
        let totalVolume = response.total_volume;
        let totalWeight = response.total_weight;
        let arrival = $arrival.val();
        let count = $('.tnved-data-container').length;
        // Отправляем третий запрос
        return new Promise((resolve, reject) => {
            showAwait('.cargo-cost-elem:not(.white-cost-elem)', 'jde', true);
            $.ajax({
                type: "GET",
                url: "https://api-calc.wisetao.com:4343/api/calculate-railway-expedition-delivery",
                data: {
                    arrival: arrival,
                    total_volume: totalVolume,
                    total_weight: totalWeight,
                    count: count,
                    max_dimension: 0,
                    from: 'Москва',
                },
                success: function (jdeResponse) {

                    updatePageWithJDEResponse(response, jdeResponse);
                    // Выключаем анимацию и скрываем элементы с анимацией
                    showAwait('.cargo-cost-elem:not(.white-cost-elem)', 'jde', false);
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
                    showAwait('.cargo-cost-elem:not(.white-cost-elem)', 'jde', false);
                    reject(error);
                    // Выключаем анимацию и скрываем элементы с анимацией

                },
            });
        });
    }

    function sendKITAjaxRequest(response) {
        let totalVolume = response.total_volume;
        let totalWeight = response.total_weight;
        let price = response.total_cost;
        let arrival = $arrival.val();
        let count = $('.tnved-data-container').length;
        // Отправляем пятый запрос
        return new Promise((resolve, reject) => {
            showAwait('.cargo-cost-elem:not(.white-cost-elem)', 'kit', true);
            $.ajax({
                type: "GET",
                url: "https://api-calc.wisetao.com:4343/api/calculate-kit-delivery",
                data: {
                    arrival: arrival,
                    total_volume: totalVolume,
                    total_weight: totalWeight,
                    count: count,
                    max_dimension: 0,
                    price: price,
                    from: 'Москва',
                },
                success: function (kitResponse) {

                    updatePageWithKITResponse(response, kitResponse);
                    showAwait('.cargo-cost-elem:not(.white-cost-elem)', 'kit', false);
                    // Обработка успешного выполнения пятого запроса
                    console.log("Успешно отправлен пятый запрос!");
                    console.log("Ответ сервера (пятый запрос):", kitResponse);
                    resolve();
                    // Обновление значений на странице согласно пятому запросу
                    // ... (обновления значений на странице согласно вашим требованиям)
                },
                error: function (error) {
                    // Обработка ошибок при отправке пятого запроса
                    showAwait('.cargo-cost-elem:not(.white-cost-elem)', 'kit', false);
                    console.error("Ошибка при отправке пятого запроса:", error);
                    reject(error);
                },
            });
        });
    }

    function updateDeliveryToggle(deliveryToggle, currentKg, currentSum, currentRateDollar, currentRateYuan, kgValue, sumValue, kgValueRub, sumValueRub, helpElement, name) {
        // Находим текущие значения в deliveryToggle
        const kg = currentKg.html();
        const arrow = deliveryToggle[0].querySelector('.dropdown-list-delivery-arrow');
        const rates = deliveryToggle[0].querySelector('.costs-data-exchange-rate');
        // Сравниваем новые значения с текущими и проверяем, что они не равны 'н/д'
        if (kg === "$н/д" + semicolon + " ₽н/д" || parseFloat(kgValue) < parseFloat(kg) || (deliveryToggle[0].innerText.substring(0, 5) === 'Карго' && kg !== "$н/д" + semicolon + " ₽н/д" && name !== 'Карго')) {
            // Обновляем текст в deliveryToggle
            currentKg.html(kgValue + '$' + semicolon + ' ' + kgValueRub + '₽');
            currentSum.html(sumValue + '$' + semicolon + ' ' + sumValueRub + '₽');
            currentRateDollar.text(dollar + '₽');
            currentRateYuan.text(yuan + '₽');
            deliveryToggle[0].textContent = name;
            if (helpElement) {
                const clonedHelpElement = helpElement.cloneNode(true);
                deliveryToggle.append(clonedHelpElement);
                clonedHelpElement.style.marginTop = '7px';
                clonedHelpElement.addEventListener('mouseenter', updateBalloonPosition);
                clonedHelpElement.querySelector('.offer-button').addEventListener('click', function (event) {
                    event.stopPropagation();
                    event.preventDefault();
                    ajaxofferDataCargoRequest(
                        event.target.closest('.desc').querySelector('.delivery-types-dropdown').dataset.delivery_type,
                        event.target.closest('.desc').querySelector('.delivery-item-label').textContent.trim(),
                    );
                    event.preventDefault();
                    event.stopPropagation();
                });
            }
            if (rates) {
                deliveryToggle.append(rates);
            }
            if (arrow) {
                deliveryToggle.append(arrow);
            }
        }
        // Если найден элемент help, обновляем его в delivery-toggle

    }

    function updatePageWithCargoResponse(response) {
        // Обновляем значения для delivery-types-dropdown-auto
        let autoRegularKg = response.cost_price.auto_regular;
        let autoRegularKgRub = response.cost_price_rub.auto_regular;
        $("#delivery-types-dropdown-auto .delivery-types-list-comparison.cargo .cost-elem.cargo .kg").html("$" + response.cost_price.auto_regular + ' - ' + "₽" + response.cost_price_rub.auto_regular);
        $("#delivery-types-dropdown-auto .delivery-types-list-comparison.cargo .cost-elem.cargo .sum .sum-dollar").html("$" + response.sum_cost_price.auto_regular);
        $("#delivery-types-dropdown-auto .delivery-types-list-comparison.cargo .cost-elem.cargo .sum .sum-rub").html("₽" + response.sum_cost_price_rub.auto_regular);
        $("#delivery-types-dropdown-auto .delivery-types-list-comparison.cargo .cargo-help .balloon-container .kg").html("$" + response.cost_price.auto_regular + semicolonHelpTspan + "₽" + response.cost_price_rub.auto_regular);
        $("#delivery-types-dropdown-auto .delivery-types-list-comparison.cargo .cargo-help .balloon-container .sum").html(response.sum_cost_price.auto_regular + "$" + semicolonHelpTspan + response.sum_cost_price_rub.auto_regular + "₽");
        $("#delivery-types-dropdown-auto .delivery-types-list-comparison.cargo .cargo-help .balloon-container .exchange-rate-elem-dollar").html(dollar);
        $("#delivery-types-dropdown-auto .delivery-types-list-comparison.cargo .cargo-help .balloon-container .exchange-rate-elem-yuan").html(yuan);
        $("#delivery-types-dropdown-auto .delivery-types-list-comparison.cargo .cargo-help .balloon-container .boxing-type").html(response.type_of_packaging);
        $("#delivery-types-dropdown-auto .delivery-types-list-comparison.cargo .cargo-help .balloon-container .packaging-price").html((response.packaging_price_pub / dollar).toFixed(2) + "$" + semicolonHelpTspan + (response.packaging_price_pub).toFixed(2) + "₽");
        $("#delivery-types-dropdown-auto .delivery-types-list-comparison.cargo .cargo-help .balloon-container .redeem-commission").html((response.commission_price * yuan / dollar).toFixed(2) + "$" + semicolonHelpTspan + (response.commission_price * yuan).toFixed(2) + "₽");
        $("#delivery-types-dropdown-auto .delivery-types-list-comparison.cargo .cargo-help .balloon-container .insurance").html((response.insurance).toFixed(2) + "$" + semicolonHelpTspan + (response.insurance * dollar).toFixed(2) + "₽");

        let autoFastKg = response.cost_price.auto_fast;
        let autoFastKgRub = response.cost_price_rub.auto_fast;
        // Обновляем значения для delivery-types-dropdown-fast-auto
        $("#delivery-types-dropdown-fast-auto .delivery-types-list-comparison.cargo .cost-elem.cargo .kg").html("$" + response.cost_price.auto_fast + ' - ' +  "₽" + response.cost_price_rub.auto_fast);
        $("#delivery-types-dropdown-fast-auto .delivery-types-list-comparison.cargo .cost-elem.cargo .sum .sum-dollar").html("$" + response.sum_cost_price.auto_fast);
        $("#delivery-types-dropdown-fast-auto .delivery-types-list-comparison.cargo .cost-elem.cargo .sum .sum-rub").html("₽" + response.sum_cost_price_rub.auto_fast);
        $("#delivery-types-dropdown-fast-auto .delivery-types-list-comparison.cargo .cargo-help .balloon-container .kg").html("$" + response.cost_price.auto_fast + semicolonHelpTspan +  "₽" + response.cost_price_rub.auto_fast);
        $("#delivery-types-dropdown-fast-auto .delivery-types-list-comparison.cargo .cargo-help .balloon-container .sum").html(response.sum_cost_price.auto_fast + "$" + semicolonHelpTspan + response.sum_cost_price_rub.auto_fast + "₽");
        $("#delivery-types-dropdown-fast-auto .delivery-types-list-comparison.cargo .cargo-help .balloon-container .exchange-rate-elem-dollar").html(dollar);
        $("#delivery-types-dropdown-fast-auto .delivery-types-list-comparison.cargo .cargo-help .balloon-container .exchange-rate-elem-yuan").html(yuan);
        $("#delivery-types-dropdown-fast-auto .delivery-types-list-comparison.cargo .cargo-help .balloon-container .boxing-type").html(response.type_of_packaging);
        $("#delivery-types-dropdown-fast-auto .delivery-types-list-comparison.cargo .cargo-help .balloon-container .packaging-price").html((response.packaging_price_pub / dollar).toFixed(2) + "$" + semicolonHelpTspan + (response.packaging_price_pub).toFixed(2) + "₽");
        $("#delivery-types-dropdown-fast-auto .delivery-types-list-comparison.cargo .cargo-help .balloon-container .redeem-commission").html((response.commission_price * yuan / dollar).toFixed(2) + "$" + semicolonHelpTspan + (response.commission_price * yuan).toFixed(2) + "₽");
        $("#delivery-types-dropdown-fast-auto .delivery-types-list-comparison.cargo .cargo-help .balloon-container .insurance").html((response.insurance).toFixed(2) + "$" + semicolonHelpTspan + (response.insurance * dollar).toFixed(2) + "₽");

        let railwayKg = response.cost_price.ZhD;
        let railwayKgRub = response.cost_price_rub.ZhD;
        // Обновляем значения для delivery-types-dropdown-railway
        $("#delivery-types-dropdown-railway .delivery-types-list-comparison.cargo .cost-elem.cargo .kg").html("$" + response.cost_price.ZhD + ' - ' + "₽" + response.cost_price_rub.ZhD);
        $("#delivery-types-dropdown-railway .delivery-types-list-comparison.cargo .cost-elem.cargo .sum .sum-dollar").html("$" + response.sum_cost_price.ZhD);
        $("#delivery-types-dropdown-railway .delivery-types-list-comparison.cargo .cost-elem.cargo .sum .sum-rub").html("₽" + response.sum_cost_price_rub.ZhD);
        $("#delivery-types-dropdown-railway .delivery-types-list-comparison.cargo .cargo-help .balloon-container .kg").html("$" + response.cost_price.ZhD + semicolonHelpTspan + "₽" + response.cost_price_rub.ZhD);
        $("#delivery-types-dropdown-railway .delivery-types-list-comparison.cargo .cargo-help .balloon-container .sum").html(response.sum_cost_price.ZhD + "$" + semicolonHelpTspan + response.sum_cost_price_rub.ZhD + "₽");
        $("#delivery-types-dropdown-railway .delivery-types-list-comparison.cargo .cargo-help .balloon-container .exchange-rate-elem-dollar").html(dollar);
        $("#delivery-types-dropdown-railway .delivery-types-list-comparison.cargo .cargo-help .balloon-container .exchange-rate-elem-yuan").html(yuan);
        $("#delivery-types-dropdown-railway .delivery-types-list-comparison.cargo .cargo-help .balloon-container .boxing-type").html(response.type_of_packaging);
        $("#delivery-types-dropdown-railway .delivery-types-list-comparison.cargo .cargo-help .balloon-container .packaging-price").html((response.packaging_price_pub / dollar).toFixed(2) + "$" + semicolonHelpTspan + (response.packaging_price_pub).toFixed(2) + "₽");
        $("#delivery-types-dropdown-railway .delivery-types-list-comparison.cargo .cargo-help .balloon-container .redeem-commission").html((response.commission_price * yuan / dollar).toFixed(2) + "$" + semicolonHelpTspan + (response.commission_price * yuan).toFixed(2) + "₽");
        $("#delivery-types-dropdown-railway .delivery-types-list-comparison.cargo .cargo-help .balloon-container .insurance").html((response.insurance).toFixed(2) + "$" + semicolonHelpTspan + (response.insurance * dollar).toFixed(2) + "₽");

        let aviaKg = response.cost_price.avia;
        let aviaKgRub = response.cost_price_rub.avia;
        // Обновляем значения для delivery-types-dropdown-railway
        $("#delivery-types-dropdown-avia .delivery-types-list-comparison.cargo .cost-elem.cargo .kg").html("$" + response.cost_price.avia + ' - ' + "₽" + response.cost_price_rub.avia);
        $("#delivery-types-dropdown-avia .delivery-types-list-comparison.cargo .cost-elem.cargo .sum .sum-dollar").html("$" + response.sum_cost_price.avia);
        $("#delivery-types-dropdown-avia .delivery-types-list-comparison.cargo .cost-elem.cargo .sum .sum-rub").html("₽" + response.sum_cost_price_rub.avia);
        $("#delivery-types-dropdown-avia .delivery-types-list-comparison.cargo .cargo-help .balloon-container .kg").html("$" + response.cost_price.avia + semicolonHelpTspan + response.cost_price_rub.avia + "₽");
        $("#delivery-types-dropdown-avia .delivery-types-list-comparison.cargo .cargo-help .balloon-container .sum").html(response.sum_cost_price.avia + "$" + semicolonHelpTspan + response.sum_cost_price_rub.avia + "₽");
        $("#delivery-types-dropdown-avia .delivery-types-list-comparison.cargo .cargo-help .balloon-container .exchange-rate-elem-dollar").html(dollar);
        $("#delivery-types-dropdown-avia .delivery-types-list-comparison.cargo .cargo-help .balloon-container .exchange-rate-elem-yuan").html(yuan);
        $("#delivery-types-dropdown-avia .delivery-types-list-comparison.cargo .cargo-help .balloon-container .boxing-type").html(response.type_of_packaging);
        $("#delivery-types-dropdown-avia .delivery-types-list-comparison.cargo .cargo-help .balloon-container .packaging-price").html((response.packaging_price_pub / dollar).toFixed(2) + "$" + semicolonHelpTspan + (response.packaging_price_pub).toFixed(2) + "₽");
        $("#delivery-types-dropdown-avia .delivery-types-list-comparison.cargo .cargo-help .balloon-container .redeem-commission").html((response.commission_price * yuan / dollar).toFixed(2) + "$" + semicolonHelpTspan + (response.commission_price * yuan).toFixed(2) + "₽");
        $("#delivery-types-dropdown-avia .delivery-types-list-comparison.cargo .cargo-help .balloon-container .insurance").html((response.insurance).toFixed(2) + "$" + semicolonHelpTspan + (response.insurance * dollar).toFixed(2) + "₽");
    }

    function updatePageWithDLResponse(response, dlResponse) {

        // Обновление элементов внутри delivery-types-dropdown-auto
        let autoRegularKg = dlResponse.sum_cost_price.auto_regular === 'н/д' ? 'н/д' : (parseFloat((response.sum_cost_price.auto_regular + dlResponse.sum_cost_price.auto_regular) / response.total_weight).toFixed(2));
        let autoRegularKgRub = dlResponse.sum_cost_price_rub.auto_regular === 'н/д' ? 'н/д' : (parseFloat((response.sum_cost_price_rub.auto_regular + dlResponse.sum_cost_price_rub.auto_regular) / response.total_weight).toFixed(2));
        $("#delivery-types-dropdown-auto .delivery-types-list-comparison.cargo .cost-elem.dl .kg").html(autoRegularKg === 'н/д' ? "$н/д" + ' - ' + " ₽н/д" : "$" + autoRegularKg + ' - ' + '₽' + autoRegularKgRub);
        $("#delivery-types-dropdown-auto .delivery-types-list-comparison.cargo .cost-elem.dl .sum .sum-dollar").html(autoRegularKg === 'н/д' ? "$н/д" : "$" + (autoRegularKg * response.total_weight).toFixed(2));
        $("#delivery-types-dropdown-auto .delivery-types-list-comparison.cargo .cost-elem.dl .sum .sum-rub").html(autoRegularKg === 'н/д' ? "₽н/д" : "₽" + (autoRegularKgRub * response.total_weight).toFixed(2));

        // Обновление элементов внутри delivery-types-dropdown-fast-auto
        let autoFastKg = dlResponse.sum_cost_price.auto_fast === 'н/д' ? 'н/д' : (parseFloat((response.sum_cost_price.auto_fast + dlResponse.sum_cost_price.auto_fast) / response.total_weight).toFixed(2));
        let autoFastKgRub = dlResponse.sum_cost_price_rub.auto_fast === 'н/д' ? 'н/д' : (parseFloat((response.sum_cost_price_rub.auto_fast + dlResponse.sum_cost_price_rub.auto_fast) / response.total_weight).toFixed(2));
        $("#delivery-types-dropdown-fast-auto .delivery-types-list-comparison.cargo .cost-elem.dl .kg").html(autoFastKg === 'н/д' ? "$н/д" + ' - ' + "₽н/д" : "$" + autoFastKg + ' - ' + "₽" + autoFastKgRub);
        $("#delivery-types-dropdown-fast-auto .delivery-types-list-comparison.cargo .cost-elem.dl .sum .sum-dollar").html(autoFastKg === 'н/д' ? "$н/д" : "$" + (autoFastKg * response.total_weight).toFixed(2));
        $("#delivery-types-dropdown-fast-auto .delivery-types-list-comparison.cargo .cost-elem.dl .sum .sum-rub").html(autoFastKg === 'н/д' ? "₽н/д" : "₽" + (autoFastKgRub * response.total_weight).toFixed(2));

        // Обновление элементов внутри delivery-types-dropdown-avia
        let aviaKg = dlResponse.sum_cost_price.avia === 'н/д' ? 'н/д' : (parseFloat((response.sum_cost_price.avia + dlResponse.sum_cost_price.avia) / response.total_weight).toFixed(2));
        let aviaKgRub = dlResponse.sum_cost_price_rub.avia === 'н/д' ? 'н/д' : (parseFloat((response.sum_cost_price_rub.avia + dlResponse.sum_cost_price_rub.avia) / response.total_weight).toFixed(2));
        $("#delivery-types-dropdown-avia .delivery-types-list-comparison.cargo .cost-elem.dl .kg").html(aviaKg === 'н/д' ? "$н/д" + ' - ' + " ₽н/д" : "$" + aviaKg + ' - ' + "₽" + aviaKgRub);
        $("#delivery-types-dropdown-avia .delivery-types-list-comparison.cargo .cost-elem.dl .sum .sum-dollar").html(aviaKg === 'н/д' ? "$н/д" : "$" + (aviaKg * response.total_weight).toFixed(2));
        $("#delivery-types-dropdown-avia .delivery-types-list-comparison.cargo .cost-elem.dl .sum .sum-rub").html(aviaKg === 'н/д' ? "₽н/д" : "₽" + (aviaKgRub * response.total_weight).toFixed(2));

        // Обновление элементов внутри delivery-types-dropdown-auto dl-help
        $("#delivery-types-dropdown-auto .delivery-types-list-comparison.cargo .dl-help .balloon-container .kg").html(autoRegularKg === 'н/д' ? "$н/д" + semicolonHelp + " ₽н/д" : "$" + autoRegularKg + semicolonHelpTspan + '₽' + autoRegularKgRub);
        $("#delivery-types-dropdown-auto .delivery-types-list-comparison.cargo .dl-help .balloon-container .sum").html(autoRegularKg === 'н/д' ? "$н/д" + semicolonHelp + " ₽н/д" : (autoRegularKg * response.total_weight).toFixed(2) + "$" + semicolonHelpTspan + (autoRegularKgRub * response.total_weight).toFixed(2) + "₽");
        $("#delivery-types-dropdown-auto .delivery-types-list-comparison.cargo .dl-help .balloon-container .exchange-rate-elem-dollar").html(dollar);
        $("#delivery-types-dropdown-auto .delivery-types-list-comparison.cargo .dl-help .balloon-container .exchange-rate-elem-yuan").html(yuan);
        $("#delivery-types-dropdown-auto .delivery-types-list-comparison.cargo .dl-help .balloon-container .boxing-type").html(response.type_of_packaging);
        $("#delivery-types-dropdown-auto .delivery-types-list-comparison.cargo .dl-help .balloon-container .packaging-price").html((response.packaging_price_pub / dollar).toFixed(2) + "$" + semicolonHelpTspan + (response.packaging_price_pub).toFixed(2) + "₽");
        $("#delivery-types-dropdown-auto .delivery-types-list-comparison.cargo .dl-help .balloon-container .kg-cargo").html((response.sum_cost_price.auto_regular / response.total_weight).toFixed(2) + "$" + semicolonHelpTspan + (response.sum_cost_price.auto_regular / response.total_weight * dollar).toFixed(2) + "₽");
        $("#delivery-types-dropdown-auto .delivery-types-list-comparison.cargo .dl-help .balloon-container .sum-cargo").html((response.sum_cost_price.auto_regular).toFixed(2) + "$" + semicolonHelpTspan + (response.sum_cost_price.auto_regular * dollar).toFixed(2) + "₽");
        $("#delivery-types-dropdown-auto .delivery-types-list-comparison.cargo .dl-help .balloon-container .redeem-commission").html((response.commission_price * yuan / dollar).toFixed(2) + "$" + semicolonHelpTspan + (response.commission_price * yuan).toFixed(2) + "₽");
        $("#delivery-types-dropdown-auto .delivery-types-list-comparison.cargo .dl-help .balloon-container .insurance").html((response.insurance).toFixed(2) + "$" + semicolonHelpTspan + (response.insurance * dollar).toFixed(2) + "₽");

        // Обновление элементов внутри delivery-types-dropdown-fast-auto dl-help
        $("#delivery-types-dropdown-fast-auto .delivery-types-list-comparison.cargo .dl-help .balloon-container .kg").html(autoFastKg === 'н/д' ? "$н/д" + semicolonHelp + " ₽н/д" : "$" + autoFastKg + semicolonHelpTspan + "₽" + autoFastKgRub);
        $("#delivery-types-dropdown-fast-auto .delivery-types-list-comparison.cargo .dl-help .balloon-container .sum").html(autoFastKg === 'н/д' ? "$н/д" + semicolonHelp + " ₽н/д" : (autoFastKg * response.total_weight).toFixed(2) + "$" + semicolonHelpTspan + (autoFastKgRub * response.total_weight).toFixed(2) + "₽");
        $("#delivery-types-dropdown-fast-auto .delivery-types-list-comparison.cargo .dl-help .balloon-container .exchange-rate-elem-dollar").html(dollar);
        $("#delivery-types-dropdown-fast-auto .delivery-types-list-comparison.cargo .dl-help .balloon-container .exchange-rate-elem-yuan").html(yuan);
        $("#delivery-types-dropdown-fast-auto .delivery-types-list-comparison.cargo .dl-help .balloon-container .boxing-type").html(response.type_of_packaging);
        $("#delivery-types-dropdown-fast-auto .delivery-types-list-comparison.cargo .dl-help .balloon-container .packaging-price").html((response.packaging_price_pub / dollar).toFixed(2) + "$" + semicolonHelpTspan + (response.packaging_price_pub).toFixed(2) + "₽");
        $("#delivery-types-dropdown-fast-auto .delivery-types-list-comparison.cargo .dl-help .balloon-container .kg-cargo").html((response.sum_cost_price.auto_regular / response.total_weight).toFixed(2) + "$" + semicolonHelpTspan + (response.sum_cost_price.auto_regular / response.total_weight * dollar).toFixed(2) + "₽");
        $("#delivery-types-dropdown-fast-auto .delivery-types-list-comparison.cargo .dl-help .balloon-container .sum-cargo").html((response.sum_cost_price.auto_regular).toFixed(2) + "$" + semicolonHelpTspan + (response.sum_cost_price.auto_regular * dollar).toFixed(2) + "₽");
        $("#delivery-types-dropdown-fast-auto .delivery-types-list-comparison.cargo .dl-help .balloon-container .redeem-commission").html((response.commission_price * yuan / dollar).toFixed(2) + "$" + semicolonHelpTspan + (response.commission_price * yuan).toFixed(2) + "₽");
        $("#delivery-types-dropdown-fast-auto .delivery-types-list-comparison.cargo .dl-help .balloon-container .insurance").html((response.insurance).toFixed(2) + "$" + semicolonHelpTspan + (response.insurance * dollar).toFixed(2) + "₽");

        // Обновление элементов внутри delivery-types-dropdown-avia dl-help
        $("#delivery-types-dropdown-avia .delivery-types-list-comparison.cargo .dl-help .balloon-container .kg").html(aviaKg === 'н/д' ? "$н/д" + semicolonHelp + " ₽н/д" : "$" + aviaKg + semicolonHelpTspan + "₽" + aviaKgRub);
        $("#delivery-types-dropdown-avia .delivery-types-list-comparison.cargo .dl-help .balloon-container .sum").html(aviaKg === 'н/д' ? "$н/д" + semicolonHelp + " ₽н/д" : (aviaKg * response.total_weight).toFixed(2) + "$" + semicolonHelpTspan + (aviaKgRub * response.total_weight).toFixed(2) + "₽");
        $("#delivery-types-dropdown-avia .delivery-types-list-comparison.cargo .dl-help .balloon-container .exchange-rate-elem-dollar").html(dollar);
        $("#delivery-types-dropdown-avia .delivery-types-list-comparison.cargo .dl-help .balloon-container .exchange-rate-elem-yuan").html(yuan);
        $("#delivery-types-dropdown-avia .delivery-types-list-comparison.cargo .dl-help .balloon-container .boxing-type").html(response.type_of_packaging);
        $("#delivery-types-dropdown-avia .delivery-types-list-comparison.cargo .dl-help .balloon-container .packaging-price").html((response.packaging_price_pub / dollar).toFixed(2) + "$" + semicolonHelpTspan + (response.packaging_price_pub).toFixed(2) + "₽");
        $("#delivery-types-dropdown-avia .delivery-types-list-comparison.cargo .dl-help .balloon-container .kg-cargo").html((response.sum_cost_price.auto_regular / response.total_weight).toFixed(2) + "$" + semicolonHelpTspan + (response.sum_cost_price.auto_regular / response.total_weight * dollar).toFixed(2) + "₽");
        $("#delivery-types-dropdown-avia .delivery-types-list-comparison.cargo .dl-help .balloon-container .sum-cargo").html((response.sum_cost_price.auto_regular).toFixed(2) + "$" + semicolonHelpTspan + (response.sum_cost_price.auto_regular * dollar).toFixed(2) + "₽");
        $("#delivery-types-dropdown-avia .delivery-types-list-comparison.cargo .dl-help .balloon-container .redeem-commission").html((response.commission_price * yuan / dollar).toFixed(2) + "$" + semicolonHelpTspan + (response.commission_price * yuan).toFixed(2) + "₽");
        $("#delivery-types-dropdown-avia .delivery-types-list-comparison.cargo .dl-help .balloon-container .insurance").html((response.insurance).toFixed(2) + "$" + semicolonHelpTspan + (response.insurance * dollar).toFixed(2) + "₽");
    }

    function updatePageWithPekResponse(response, pekResponse) {
        // Обновляем значения для delivery-types-dropdown-auto
        let autoRegularKg = pekResponse.sum_cost_price.auto_regular === 'н/д' ? 'н/д' : (parseFloat((response.sum_cost_price.auto_regular + pekResponse.sum_cost_price.auto_regular) / response.total_weight).toFixed(2));
        let autoRegularSum = pekResponse.sum_cost_price.auto_regular === 'н/д' ? 'н/д' : (parseFloat((response.sum_cost_price.auto_regular + pekResponse.sum_cost_price.auto_regular)).toFixed(2));

        let autoRegularKgRub = pekResponse.sum_cost_price_rub.auto_regular === 'н/д' ? 'н/д' : (parseFloat((response.sum_cost_price_rub.auto_regular + pekResponse.sum_cost_price_rub.auto_regular) / response.total_weight).toFixed(2));
        let autoRegularSumRub = pekResponse.sum_cost_price_rub.auto_regular === 'н/д' ? 'н/д' : (parseFloat((response.sum_cost_price_rub.auto_regular + pekResponse.sum_cost_price_rub.auto_regular)).toFixed(2));
        $("#delivery-types-dropdown-auto .delivery-types-list-comparison.cargo .cost-elem.pek .kg").html((autoRegularKg === 'н/д') ? "$н/д" + ' - ' + " ₽н/д" : "$" + autoRegularKg + ' - ' + "₽" + autoRegularKgRub);
        $("#delivery-types-dropdown-auto .delivery-types-list-comparison.cargo .cost-elem.pek .sum .sum-dollar").html((autoRegularSum === 'н/д') ? "$н/д" : "$" + autoRegularSum);
        $("#delivery-types-dropdown-auto .delivery-types-list-comparison.cargo .cost-elem.pek .sum .sum-rub").html((autoRegularSum === 'н/д') ? "₽н/д" : "₽" + autoRegularSumRub);

        // Обновляем значения для delivery-types-dropdown-auto dl-help
        $("#delivery-types-dropdown-auto .delivery-types-list-comparison.cargo .pek-help .balloon-container .kg").html((autoRegularKg === 'н/д') ? "$н/д" + semicolonHelp + " ₽н/д" : "$" + autoRegularKg + semicolonHelpTspan + autoRegularKgRub + "₽");
        $("#delivery-types-dropdown-auto .delivery-types-list-comparison.cargo .pek-help .balloon-container .sum").html((autoRegularSum === 'н/д') ? "$н/д" + semicolonHelp + " ₽н/д" : (autoRegularSum) + "$" + semicolonHelpTspan + autoRegularSumRub + "₽");
        $("#delivery-types-dropdown-auto .delivery-types-list-comparison.cargo .pek-help .balloon-container .exchange-rate-elem-dollar").html(dollar);
        $("#delivery-types-dropdown-auto .delivery-types-list-comparison.cargo .pek-help .balloon-container .exchange-rate-elem-yuan").html(yuan);
        $("#delivery-types-dropdown-auto .delivery-types-list-comparison.cargo .pek-help .balloon-container .boxing-type").html(response.type_of_packaging);
        $("#delivery-types-dropdown-auto .delivery-types-list-comparison.cargo .pek-help .balloon-container .packaging-price").html((response.packaging_price_pub / dollar).toFixed(2) + "$" + semicolonHelpTspan + (response.packaging_price_pub).toFixed(2) + "₽");
        $("#delivery-types-dropdown-auto .delivery-types-list-comparison.cargo .pek-help .balloon-container .kg-cargo").html((response.sum_cost_price.auto_regular / response.total_weight).toFixed(2) + "$" + semicolonHelpTspan + (response.sum_cost_price.auto_regular / response.total_weight * dollar).toFixed(2) + "₽");
        $("#delivery-types-dropdown-auto .delivery-types-list-comparison.cargo .pek-help .balloon-container .sum-cargo").html((response.sum_cost_price.auto_regular).toFixed(2) + "$" + semicolonHelpTspan + (response.sum_cost_price.auto_regular * dollar).toFixed(2) + "₽");
        $("#delivery-types-dropdown-auto .delivery-types-list-comparison.cargo .pek-help .balloon-container .redeem-commission").html((response.commission_price * yuan / dollar).toFixed(2) + "$" + semicolonHelpTspan + (response.commission_price * yuan).toFixed(2) + "₽");
        $("#delivery-types-dropdown-auto .delivery-types-list-comparison.cargo .pek-help .balloon-container .insurance").html((response.insurance).toFixed(2) + "$" + semicolonHelpTspan + (response.insurance * dollar).toFixed(2) + "₽");

        // Обновляем значения для delivery-types-dropdown-avia
        let aviaKg = pekResponse.sum_cost_price.avia === 'н/д' ? 'н/д' : (parseFloat((response.sum_cost_price.avia + pekResponse.sum_cost_price.avia) / response.total_weight).toFixed(2));
        let aviaSum = pekResponse.sum_cost_price.avia === 'н/д' ? 'н/д' : (parseFloat(response.sum_cost_price.avia + pekResponse.sum_cost_price.avia).toFixed(2));

        let aviaKgRub = pekResponse.sum_cost_price_rub.avia === 'н/д' ? 'н/д' : (parseFloat((response.sum_cost_price_rub.avia + pekResponse.sum_cost_price_rub.avia) / response.total_weight).toFixed(2));
        let aviaSumRub = pekResponse.sum_cost_price_rub.avia === 'н/д' ? 'н/д' : (parseFloat(response.sum_cost_price_rub.avia + pekResponse.sum_cost_price_rub.avia).toFixed(2));
        $("#delivery-types-dropdown-avia .delivery-types-list-comparison.cargo .cost-elem.pek .kg").html((aviaKg === 'н/д') ? "$н/д" + ' - ' + " ₽н/д" : "$" + aviaKg + ' - ' + "₽" + aviaKgRub);
        $("#delivery-types-dropdown-avia .delivery-types-list-comparison.cargo .cost-elem.pek .sum .sum-dollar").html((aviaSum === 'н/д') ? "$н/д" : "$" + aviaSum);
        $("#delivery-types-dropdown-avia .delivery-types-list-comparison.cargo .cost-elem.pek .sum .sum-rub").html((aviaSum === 'н/д') ? "₽н/д" : "₽" + aviaSumRub);

        // Обновляем значения для delivery-types-dropdown-avia dl-help
        $("#delivery-types-dropdown-avia .delivery-types-list-comparison.cargo .pek-help .balloon-container .kg").html((aviaKg === 'н/д') ? "$н/д" + semicolonHelp + " ₽н/д" : "$" + aviaKg + semicolonHelpTspan + "₽" + aviaKgRub);
        $("#delivery-types-dropdown-avia .delivery-types-list-comparison.cargo .pek-help .balloon-container .sum").html((aviaSum === 'н/д') ? "$н/д" + semicolonHelp + " ₽н/д" : aviaSum + "$" + semicolonHelpTspan + aviaSumRub + "₽");
        $("#delivery-types-dropdown-avia .delivery-types-list-comparison.cargo .pek-help .balloon-container .exchange-rate-elem-dollar").html(dollar);
        $("#delivery-types-dropdown-avia .delivery-types-list-comparison.cargo .pek-help .balloon-container .exchange-rate-elem-yuan").html(yuan);
        $("#delivery-types-dropdown-avia .delivery-types-list-comparison.cargo .pek-help .balloon-container .boxing-type").html(response.type_of_packaging);
        $("#delivery-types-dropdown-avia .delivery-types-list-comparison.cargo .pek-help .balloon-container .packaging-price").html((response.packaging_price_pub / dollar).toFixed(2) + "$" + semicolonHelpTspan + (response.packaging_price_pub).toFixed(2) + "₽");
        $("#delivery-types-dropdown-avia .delivery-types-list-comparison.cargo .pek-help .balloon-container .kg-cargo").html((response.sum_cost_price.auto_regular / response.total_weight).toFixed(2) + "$" + semicolonHelpTspan + (response.sum_cost_price.auto_regular / response.total_weight * dollar).toFixed(2) + "₽");
        $("#delivery-types-dropdown-avia .delivery-types-list-comparison.cargo .pek-help .balloon-container .sum-cargo").html((response.sum_cost_price.auto_regular).toFixed(2) + "$" + semicolonHelpTspan + (response.sum_cost_price.auto_regular * dollar).toFixed(2) + "₽");
        $("#delivery-types-dropdown-avia .delivery-types-list-comparison.cargo .pek-help .balloon-container .redeem-commission").html((response.commission_price * yuan / dollar).toFixed(2) + "$" + semicolonHelpTspan + (response.commission_price * yuan).toFixed(2) + "₽");
        $("#delivery-types-dropdown-avia .delivery-types-list-comparison.cargo .pek-help .balloon-container .insurance").html((response.insurance).toFixed(2) + "$" + semicolonHelpTspan + (response.insurance * dollar).toFixed(2) + "₽");
    }

    function updatePageWithJDEResponse(response, jdeResponse) {

        // Обновление элементов внутри delivery-types-dropdown-auto для auto_regular
        let autoRegularKg = (jdeResponse.sum_cost_price.auto_regular === 'н/д') ? 'н/д' : (parseFloat((response.sum_cost_price.auto_regular + jdeResponse.sum_cost_price.auto_regular) / response.total_weight).toFixed(2));
        let autoRegularKgRub = (jdeResponse.sum_cost_price_rub.auto_regular === 'н/д') ? 'н/д' : (parseFloat((response.sum_cost_price_rub.auto_regular + jdeResponse.sum_cost_price_rub.auto_regular) / response.total_weight).toFixed(2));
        $("#delivery-types-dropdown-auto .delivery-types-list-comparison.cargo .cost-elem.jde .kg").html((autoRegularKg === 'н/д') ? "$н/д" + ' - ' + " ₽н/д" : "$" + autoRegularKg + ' - ' + "₽" + autoRegularKgRub);
        $("#delivery-types-dropdown-auto .delivery-types-list-comparison.cargo .cost-elem.jde .sum .sum-dollar").html((autoRegularKg === 'н/д') ? "$н/д" : "$" + (autoRegularKg * response.total_weight).toFixed(2));
        $("#delivery-types-dropdown-auto .delivery-types-list-comparison.cargo .cost-elem.jde .sum .sum-rub").html((autoRegularKg === 'н/д') ? "₽н/д" : "₽" + (autoRegularKgRub * response.total_weight).toFixed(2));

        // Обновление элементов внутри delivery-types-dropdown-fast-auto для auto_fast
        let autoFastKg = (jdeResponse.sum_cost_price.auto_fast === 'н/д') ? 'н/д' : (parseFloat((response.sum_cost_price.auto_fast + jdeResponse.sum_cost_price.auto_fast) / response.total_weight).toFixed(2));
        let autoFastKgRub = (jdeResponse.sum_cost_price_rub.auto_fast === 'н/д') ? 'н/д' : (parseFloat((response.sum_cost_price_rub.auto_fast + jdeResponse.sum_cost_price_rub.auto_fast) / response.total_weight).toFixed(2));
        $("#delivery-types-dropdown-fast-auto .delivery-types-list-comparison.cargo .cost-elem.jde .kg").html((autoFastKg === 'н/д') ? "$н/д" + ' - ' + " ₽н/д" : "$" + autoFastKg + ' - ' + "₽" + autoFastKgRub);
        $("#delivery-types-dropdown-fast-auto .delivery-types-list-comparison.cargo .cost-elem.jde .sum .sum-dollar").html((autoFastKg === 'н/д') ? "$н/д" : "$" + (autoFastKg * response.total_weight).toFixed(2));
        $("#delivery-types-dropdown-fast-auto .delivery-types-list-comparison.cargo .cost-elem.jde .sum .sum-rub").html((autoFastKg === 'н/д') ? "₽н/д" : "₽" + (autoFastKgRub * response.total_weight).toFixed(2));

        // Обновление элементов внутри delivery-types-dropdown-auto jde-help для auto_regular
        $("#delivery-types-dropdown-auto .delivery-types-list-comparison.cargo .jde-help .balloon-container .kg").html((autoRegularKg === 'н/д') ? "$н/д" + semicolonHelp + " ₽н/д" : "$" + autoRegularKg + semicolonHelpTspan + autoRegularKgRub + "₽");
        $("#delivery-types-dropdown-auto .delivery-types-list-comparison.cargo .jde-help .balloon-container .sum").html((autoRegularKg === 'н/д') ? "$н/д" + semicolonHelp + " ₽н/д" : (autoRegularKg * response.total_weight).toFixed(2) + "$" + semicolonHelpTspan + (autoRegularKgRub * response.total_weight).toFixed(2) + "₽");
        $("#delivery-types-dropdown-auto .delivery-types-list-comparison.cargo .jde-help .balloon-container .exchange-rate-elem-dollar").html(dollar);
        $("#delivery-types-dropdown-auto .delivery-types-list-comparison.cargo .jde-help .balloon-container .exchange-rate-elem-yuan").html(yuan);
        $("#delivery-types-dropdown-auto .delivery-types-list-comparison.cargo .jde-help .balloon-container .boxing-type").html(response.type_of_packaging);
        $("#delivery-types-dropdown-auto .delivery-types-list-comparison.cargo .jde-help .balloon-container .packaging-price").html((response.packaging_price_pub / dollar).toFixed(2) + "$" + semicolonHelpTspan + (response.packaging_price_pub).toFixed(2) + "₽");
        $("#delivery-types-dropdown-auto .delivery-types-list-comparison.cargo .jde-help .balloon-container .kg-cargo").html((response.sum_cost_price.auto_regular / response.total_weight).toFixed(2) + "$" + semicolonHelpTspan + (response.sum_cost_price.auto_regular / response.total_weight * dollar).toFixed(2) + "₽");
        $("#delivery-types-dropdown-auto .delivery-types-list-comparison.cargo .jde-help .balloon-container .sum-cargo").html((response.sum_cost_price.auto_regular).toFixed(2) + "$" + semicolonHelpTspan + (response.sum_cost_price.auto_regular * dollar).toFixed(2) + "₽");
        $("#delivery-types-dropdown-auto .delivery-types-list-comparison.cargo .jde-help .balloon-container .redeem-commission").html((response.commission_price * yuan / dollar).toFixed(2) + "$" + semicolonHelpTspan + (response.commission_price * yuan).toFixed(2) + "₽");
        $("#delivery-types-dropdown-auto .delivery-types-list-comparison.cargo .jde-help .balloon-container .insurance").html((response.insurance).toFixed(2) + "$" + semicolonHelpTspan + (response.insurance * dollar).toFixed(2) + "₽");

        // Обновление элементов внутри delivery-types-dropdown-fast-auto jde-help для auto_fast
        $("#delivery-types-dropdown-fast-auto .delivery-types-list-comparison.cargo .jde-help .balloon-container .kg").html((autoFastKg === 'н/д') ? "$н/д" + semicolonHelp + " ₽н/д" : "$" + autoFastKg + semicolonHelpTspan + autoFastKgRub + "₽");
        $("#delivery-types-dropdown-fast-auto .delivery-types-list-comparison.cargo .jde-help .balloon-container .sum").html((autoFastKg === 'н/д') ? "$н/д" + semicolonHelp + " ₽н/д" : (autoFastKg * response.total_weight).toFixed(2) + "$" + semicolonHelpTspan + (autoFastKgRub * response.total_weight).toFixed(2) + "₽");
        $("#delivery-types-dropdown-fast-auto .delivery-types-list-comparison.cargo .jde-help .balloon-container .exchange-rate-elem-dollar").html(dollar);
        $("#delivery-types-dropdown-fast-auto .delivery-types-list-comparison.cargo .jde-help .balloon-container .exchange-rate-elem-yuan").html(yuan);
        $("#delivery-types-dropdown-fast-auto .delivery-types-list-comparison.cargo .jde-help .balloon-container .boxing-type").html(response.type_of_packaging);
        $("#delivery-types-dropdown-fast-auto .delivery-types-list-comparison.cargo .jde-help .balloon-container .packaging-price").html((response.packaging_price_pub / dollar).toFixed(2) + "$" + semicolonHelpTspan + (response.packaging_price_pub).toFixed(2) + "₽");
        $("#delivery-types-dropdown-fast-auto .delivery-types-list-comparison.cargo .jde-help .balloon-container .kg-cargo").html((response.sum_cost_price.auto_regular / response.total_weight).toFixed(2) + "$" + semicolonHelpTspan + (response.sum_cost_price.auto_regular / response.total_weight * dollar).toFixed(2) + "₽");
        $("#delivery-types-dropdown-fast-auto .delivery-types-list-comparison.cargo .jde-help .balloon-container .sum-cargo").html((response.sum_cost_price.auto_regular).toFixed(2) + "$" + semicolonHelpTspan + (response.sum_cost_price.auto_regular * dollar).toFixed(2) + "₽");
        $("#delivery-types-dropdown-fast-auto .delivery-types-list-comparison.cargo .jde-help .balloon-container .redeem-commission").html((response.commission_price * yuan / dollar).toFixed(2) + "$" + semicolonHelpTspan + (response.commission_price * yuan).toFixed(2) + "₽");
        $("#delivery-types-dropdown-fast-auto .delivery-types-list-comparison.cargo .jde-help .balloon-container .insurance").html((response.insurance).toFixed(2) + "$" + semicolonHelpTspan + (response.insurance * dollar).toFixed(2) + "₽");
    }

    function updatePageWithKITResponse(response, kitResponse) {

        // Обновление элементов внутри delivery-types-dropdown-auto
        let autoRegularKg = (kitResponse.sum_cost_price.auto_regular !== 'н/д') ? (parseFloat((response.sum_cost_price.auto_regular + kitResponse.sum_cost_price.auto_regular) / response.total_weight).toFixed(2)) : 'н/д';
        let autoRegularKgRub = (kitResponse.sum_cost_price_rub.auto_regular !== 'н/д') ? (parseFloat((response.sum_cost_price_rub.auto_regular + kitResponse.sum_cost_price_rub.auto_regular) / response.total_weight).toFixed(2)) : 'н/д';
        $("#delivery-types-dropdown-auto .delivery-types-list-comparison.cargo .cost-elem.kit .kg").html((autoRegularKg !== 'н/д') ? "$" + autoRegularKg + ' - ' + "₽" + autoRegularKgRub : "$н/д" + ' - ' + " ₽н/д");
        $("#delivery-types-dropdown-auto .delivery-types-list-comparison.cargo .cost-elem.kit .sum .sum-dollar").html((autoRegularKg !== 'н/д') ? "$" + (autoRegularKg * response.total_weight).toFixed(2) : "$н/д");
        $("#delivery-types-dropdown-auto .delivery-types-list-comparison.cargo .cost-elem.kit .sum .sum-rub").html((autoRegularKg !== 'н/д') ? "₽" + (autoRegularKgRub * response.total_weight).toFixed(2) : "₽н/д");

        // Обновление элементов внутри delivery-types-dropdown-fast-auto
        let autoFastKg = (kitResponse.sum_cost_price.auto_fast !== 'н/д') ? (parseFloat((response.sum_cost_price.auto_fast + kitResponse.sum_cost_price.auto_fast) / response.total_weight).toFixed(2)) : 'н/д';
        let autoFastKgRub = (kitResponse.sum_cost_price_rub.auto_fast !== 'н/д') ? (parseFloat((response.sum_cost_price_rub.auto_fast + kitResponse.sum_cost_price_rub.auto_fast) / response.total_weight).toFixed(2)) : 'н/д';
        $("#delivery-types-dropdown-fast-auto .delivery-types-list-comparison.cargo .cost-elem.kit .kg").html((autoFastKg !== 'н/д') ? "$" + autoFastKg + ' - ' + "₽" + autoFastKgRub : "$н/д" + ' - ' + " ₽н/д");
        $("#delivery-types-dropdown-fast-auto .delivery-types-list-comparison.cargo .cost-elem.kit .sum .sum-dollar").html((autoFastKg !== 'н/д') ? "$" + (autoFastKg * response.total_weight).toFixed(2) : "$н/д" + semicolon + " ₽н/д");
        $("#delivery-types-dropdown-fast-auto .delivery-types-list-comparison.cargo .cost-elem.kit .sum .sum-rub").html((autoFastKg !== 'н/д') ? "₽" + (autoFastKgRub * response.total_weight).toFixed(2) : "$н/д" + semicolon + " ₽н/д");

        // Обновление элементов внутри delivery-types-dropdown-auto kit-help
        $("#delivery-types-dropdown-auto .delivery-types-list-comparison.cargo .kit-help .balloon-container .kg").html((autoRegularKg !== 'н/д') ? "$" + autoRegularKg + semicolonHelpTspan + autoRegularKgRub + "₽" : "$н/д" + semicolonHelp + " ₽н/д");
        $("#delivery-types-dropdown-auto .delivery-types-list-comparison.cargo .kit-help .balloon-container .sum").html((autoRegularKg !== 'н/д') ? (autoRegularKg * response.total_weight).toFixed(2) + "$" + semicolonHelpTspan + (autoRegularKgRub * response.total_weight).toFixed(2) + "₽" : "$н/д" + semicolonHelp + " ₽н/д");
        $("#delivery-types-dropdown-auto .delivery-types-list-comparison.cargo .kit-help .balloon-container .exchange-rate-elem-dollar").html(dollar);
        $("#delivery-types-dropdown-auto .delivery-types-list-comparison.cargo .kit-help .balloon-container .exchange-rate-elem-yuan").html(yuan);
        $("#delivery-types-dropdown-auto .delivery-types-list-comparison.cargo .kit-help .balloon-container .boxing-type").html(response.type_of_packaging);
        $("#delivery-types-dropdown-auto .delivery-types-list-comparison.cargo .kit-help .balloon-container .packaging-price").html((response.packaging_price_pub / dollar).toFixed(2) + "$" + semicolonHelpTspan + (response.packaging_price_pub).toFixed(2) + "₽");
        $("#delivery-types-dropdown-auto .delivery-types-list-comparison.cargo .kit-help .balloon-container .kg-cargo").html((response.sum_cost_price.auto_regular / response.total_weight).toFixed(2) + "$" + semicolonHelpTspan + (response.sum_cost_price.auto_regular / response.total_weight * dollar).toFixed(2) + "₽");
        $("#delivery-types-dropdown-auto .delivery-types-list-comparison.cargo .kit-help .balloon-container .sum-cargo").html((response.sum_cost_price.auto_regular).toFixed(2) + "$" + semicolonHelpTspan + (response.sum_cost_price.auto_regular * dollar).toFixed(2) + "₽");
        $("#delivery-types-dropdown-auto .delivery-types-list-comparison.cargo .kit-help .balloon-container .redeem-commission").html((response.commission_price * yuan / dollar).toFixed(2) + "$" + semicolonHelpTspan + (response.commission_price * yuan).toFixed(2) + "₽");
        $("#delivery-types-dropdown-auto .delivery-types-list-comparison.cargo .kit-help .balloon-container .insurance").html((response.insurance).toFixed(2) + "$" + semicolonHelpTspan + (response.insurance * dollar).toFixed(2) + "₽");

        // Обновление элементов внутри delivery-types-dropdown-fast-auto kit-help
        $("#delivery-types-dropdown-fast-auto .delivery-types-list-comparison.cargo .kit-help .balloon-container .kg").html((autoFastKg !== 'н/д') ? "$" + autoFastKg + semicolonHelpTspan + autoFastKgRub + "₽" : "$н/д" + semicolonHelp + " ₽н/д");
        $("#delivery-types-dropdown-fast-auto .delivery-types-list-comparison.cargo .kit-help .balloon-container .sum").html((autoFastKg !== 'н/д') ? (autoFastKg * response.total_weight).toFixed(2) + "$" + semicolonHelpTspan + (autoFastKgRub * response.total_weight).toFixed(2) + "₽" : "$н/д" + semicolonHelp + " ₽н/д");
        $("#delivery-types-dropdown-fast-auto .delivery-types-list-comparison.cargo .kit-help .balloon-container .exchange-rate-elem-dollar").html(dollar);
        $("#delivery-types-dropdown-fast-auto .delivery-types-list-comparison.cargo .kit-help .balloon-container .exchange-rate-elem-yuan").html(yuan);
        $("#delivery-types-dropdown-fast-auto .delivery-types-list-comparison.cargo .kit-help .balloon-container .boxing-type").html(response.type_of_packaging);
        $("#delivery-types-dropdown-fast-auto .delivery-types-list-comparison.cargo .kit-help .balloon-container .packaging-price").html((response.packaging_price_pub / dollar).toFixed(2) + "$" + semicolonHelpTspan + (response.packaging_price_pub).toFixed(2) + "₽");
        $("#delivery-types-dropdown-fast-auto .delivery-types-list-comparison.cargo .kit-help .balloon-container .kg-cargo").html((response.sum_cost_price.auto_regular / response.total_weight).toFixed(2) + "$" + semicolonHelpTspan + (response.sum_cost_price.auto_regular / response.total_weight * dollar).toFixed(2) + "₽");
        $("#delivery-types-dropdown-fast-auto .delivery-types-list-comparison.cargo .kit-help .balloon-container .sum-cargo").html((response.sum_cost_price.auto_regular).toFixed(2) + "$" + semicolonHelpTspan + (response.sum_cost_price.auto_regular * dollar).toFixed(2) + "₽");
        $("#delivery-types-dropdown-fast-auto .delivery-types-list-comparison.cargo .kit-help .balloon-container .redeem-commission").html((response.commission_price * yuan / dollar).toFixed(2) + "$" + semicolonHelpTspan + (response.commission_price * yuan).toFixed(2) + "₽");
        $("#delivery-types-dropdown-fast-auto .delivery-types-list-comparison.cargo .kit-help .balloon-container .insurance").html((response.insurance).toFixed(2) + "$" + semicolonHelpTspan + (response.insurance * dollar).toFixed(2) + "₽");
    }
}