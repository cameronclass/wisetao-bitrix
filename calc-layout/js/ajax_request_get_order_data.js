function initializeGetOrderData() {

    let orderNumberInput = document.querySelector('.logistic-check__form_text');
    let getOrderButton = document.querySelector('.logistic-check__form_btn.main-btn');

    // function trackAndSendAjaxRequests() {
    //     if (activeButton.dataset.type === 'cargo') {
    //         dataChanged = true; // Устанавливаем флаг изменений в true
    //         if (!pendingRequest) {
    //             pendingRequest = sendMultipleAjaxRequests();
    //             pendingRequest.then(function () {
    //                 pendingRequest = null;
    //             });
    //         }
    //     }
    // }

    function ajaxOrderDataRequest() {
        let orderNumber = $(orderNumberInput).val();
        if (orderNumber) {
            let requestData = {
                'order_number': orderNumber,
            };
            return new Promise((resolve, reject) => {
                // showAwait('.cargo-cost-elem', 'cargo', true);
                $.ajax({
                    type: "POST",
                    url: "https://api-calc.wisetao.com:4343/api/get-milestones",
                    data: requestData,
                    success: function (response) {
                        if (response) {
                            document.querySelector('.logistic-check__info').classList.remove('hidden');
                            document.querySelector('.logistic-check__status').classList.remove('hidden');
                            document.querySelector('.logistic-check__error').classList.add('hidden');
                            outputOrderData(response);
                        }
                        else {
                            document.querySelector('.logistic-check__error').classList.remove('hidden');
                            document.querySelector('.logistic-check__info').classList.add('hidden');
                            document.querySelector('.logistic-check__status').classList.add('hidden');
                        }
                        console.log("Успешно отправлено!");
                        console.log("Ответ сервера:", response);

                        resolve(response);
                    },
                    error: function (error) {
                        // showAwait('.cargo-cost-elem', 'cargo', false);
                        document.querySelector('.logistic-check__error').classList.remove('hidden');
                        document.querySelector('.logistic-check__info').classList.add('hidden');
                        document.querySelector('.logistic-check__status').classList.add('hidden');
                        reject(error);

                    },
                });
            });
        }
        else {
            console.log("Заполните все обязательные поля. Запрос не будет отправлен.");
        }
    }

    getOrderButton.addEventListener('click', (event) => {
        event.preventDefault();
        ajaxOrderDataRequest();
        event.preventDefault();
    });
}

function outputOrderData(response) {
    let recipientName = document.querySelector('.logistic-check__item_text.recipient-name');
    let arrival = document.querySelector('.logistic-check__item_text.arrival');
    let arrivalDate = document.querySelector('.logistic-check__item_text.arrival-date');
    let deliveryType = document.querySelector('.logistic-check__item_text.delivery-type');
    let paymentStatus = document.querySelector('.logistic-check__item_text.payment-status');
    let volume = document.querySelector('.logistic-check__item_text.volume');
    let weight = document.querySelector('.logistic-check__item_text.weight');

    recipientName.innerText = response.recipient_name;
    arrival.innerText = response.destination;
    arrivalDate.innerText = response.arrival_date;
    deliveryType.innerText = response.delivery_type.type;
    paymentStatus.innerText = (response.payment_status === 1 ? 'Оплачено' : 'Не оплачено');
    let statusStyle = (response.payment_status === 1 ? '_paid' : '_unpaid');
    let statusStyleRem = (response.payment_status === 1 ? '_unpaid' : '_paid');
    paymentStatus.classList.add(statusStyle);
    paymentStatus.classList.remove(statusStyleRem);
    volume.innerText = response.volume + ' м³';
    weight.innerText = response.weight + ' кг';

    let logisticCheckStatus = document.querySelector('.logistic-check__status');
    let logisticCheckStatusHidden = document.querySelector('.logistic-check__status');
    let activeItemOrigin = document.querySelector('.logistic-check__status_item._active');
    let activeItem = activeItemOrigin.cloneNode(true);

    let hiddenItemOrigin = document.querySelector('.logistic-check__status_item.hidden');
    let hiddenItem = hiddenItemOrigin.cloneNode(true); // Клонируем

    document.querySelectorAll('.logistic-check__status_item').forEach(item => {
        item.remove();
    });

    let shippingDate = parseDate(response.shipping_date);

    shippingDate = new Date(shippingDate);
    let isFirst = true;

    let milestoneKeys = Object.keys(response.milestones);

    for (let milestone in response.milestones) {
        let days = response.milestones[milestone]; // Значение (дни)

        // Добавляем к дате отправки количество дней для текущего этапа
        let milestoneDate = new Date(shippingDate);
        milestoneDate.setDate(shippingDate.getDate() + days);

        let formattedDate = milestoneDate.toLocaleDateString('ru-RU', { day: '2-digit', month: '2-digit', year: 'numeric' });

        if (milestone === milestoneKeys[milestoneKeys.length - 1]) {
            // Заполняем первый элемент и добавляем в документ
            activeItem.textContent = `${milestone} (${formattedDate})`;
            // logisticCheckStatus.appendChild(activeItem); // Добавляем activeItem в документ
            logisticCheckStatus.insertBefore(activeItem, logisticCheckStatus.firstChild); // Добавляем activeItem в документ
            isFirst = false;
        } else {
            // Заполняем остальные элементы и добавляем в документ
            let hiddenClone = hiddenItem.cloneNode(true);
            hiddenClone.textContent = `${milestone} (${formattedDate})`;
            // logisticCheckStatus.appendChild(hiddenClone);
            logisticCheckStatus.insertBefore(hiddenClone, logisticCheckStatus.firstChild); // Добавляем скрытый элемент в документ
        }
    }
}

function parseDate(dateStr) {
    const [day, month, year] = dateStr.split('.').map(Number);
    return new Date(year, month - 1, day); // Месяцы в JavaScript начинаются с 0
}
