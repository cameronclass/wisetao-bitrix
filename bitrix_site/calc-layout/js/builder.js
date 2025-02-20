let calcTypeUrl;
let offerData = {};
let offerDataCargo = {};
let offerDataDL = {};
let offerDataPEK = {};
let offerDataJDE = {};
let offerDataKIT = {};
let whiteCompareContainer = null;
let deliveryItems = null;
let dollarGlobal;
let yuanGlobal;
let excelFile;
let generalGoodData = {};
let countdownTimer;
let countryGlobal;
let arrivalCityRusTK;
let buttons;

function loadBuilderData() {
    toggleButton(document.querySelector('.calc-type-button[data-type="cargo"]'));
    getCalcType();
    return Promise.all([
        fetch('/calc-layout/ext_html/from_to.php').then(response => response.text()),
        fetch(calcTypeUrl).then(response => response.text()), // Загружаем контент в зависимости от активной кнопки
        fetch('/calc-layout/ext_html/redeem_data.php').then(response => response.text()),
        fetch('/calc-layout/ext_html/boxing_spoiler.php').then(response => response.text()),
        fetch('/calc-layout/ext_html/delivery_list.php').then(response => response.text()),
    ])
        .then(([fromTo, orderData, redeemData, boxingSpoiler, dropdown]) => {
            document.querySelector('.from-arrival-container').innerHTML = fromTo;
            document.querySelector('.calc-container:not(.redeem-data)').innerHTML = orderData;
            document.querySelector('.redeem-data').innerHTML = redeemData;
            document.querySelector('.boxing-spoiler').innerHTML = boxingSpoiler;
            document.querySelector('#delivery-types-dropdown-auto').innerHTML = dropdown;
            document.querySelector('#delivery-types-dropdown-fast-auto').innerHTML = dropdown;
            document.querySelector('#delivery-types-dropdown-railway').innerHTML = dropdown;
            document.querySelector('#delivery-types-dropdown-avia').innerHTML = dropdown;
            setPositionCounriesContainer();
            initializeGetRate();
            initializeGetOrderData();
            if (calcTypeUrl === '/calc-layout/ext_html/cargo_order_data.php') {
                removeComparison();
                initializeCheckbox();
                initializeAddGoods();
                // hideComparisonData();
                initializeCalcVolume();
            }
            initializeYandexSuggest();
            initializeAddRedeems();
            initializeSubmitRedeemData();
            initializeRedeemCheckbox();
            initializeImgBoxing();
            initializeCountGoods();
            initializeCurrency();
            initializeDeliveryChoice();
            initializeInputPhoto();
            initializeInputExcel();
            initializeTypeOfGoods();
            initializeSpoiler();
            if (calcTypeUrl === '/calc-layout/ext_html/cargo_white_order_data.php') {
                cloneAndAppend('.delivery-types');
            }
            initializeDeliveryList();
            if (calcTypeUrl === '/calc-layout/ext_html/white_order_data.php' || calcTypeUrl === '/calc-layout/ext_html/cargo_white_order_data.php') {
                initializeWhiteCalcSpace();
                initializeAddTnvedCode();
                initializeSuggestion();

                if (calcTypeUrl === '/calc-layout/ext_html/cargo_white_order_data.php') {
                    initializeAjaxRequestCargoWhite();
                }
                if (calcTypeUrl === '/calc-layout/ext_html/white_order_data.php') {
                    initializeGetRate();
                    removeComparison();
                    // hideComparisonData();
                }
                initializeTnvedAjaxRequest();
                fetch('/calc-layout/ext_html/tnved_tree_handling.php')
                    .then(response => response.text())
                    .then((tnvedTree) => {
                        document.querySelector('.tnved-tree-container').innerHTML = tnvedTree;
                        initializePopupTnvedTree();
                        initializeTnvedTreeHandling();
                    })
            }
            if (calcTypeUrl === '/calc-layout/ext_html/cargo_order_data.php') {
                initializeGeneralAjaxRequest();
            }
            if (calcTypeUrl === '/calc-layout/ext_html/white_order_data.php' || calcTypeUrl === '/calc-layout/ext_html/cargo_white_order_data.php') {
                initializeReportWhiteData();
            }
            initializeHelp();
            initializeSelectDeliveryItem();
        });
}

function getCalcType() {
    switch (activeButton.getAttribute('data-type')) {
        case 'cargo':
            calcTypeUrl = '/calc-layout/ext_html/cargo_order_data.php';
            break;
        case 'white':
            calcTypeUrl = '/calc-layout/ext_html/white_order_data.php';
            break;
        case 'comparison':
            calcTypeUrl = '/calc-layout/ext_html/cargo_white_order_data.php';
            break;
        default:
            calcTypeUrl = '/calc-layout/ext_html/cargo_order_data.php';
    }
}

function cloneAndAppend(container) {
        whiteCompareContainer = document.querySelector(container);
        if (!whiteCompareContainer.querySelector('.white-page-img.white').classList.contains('active')) {
            whiteCompareContainer.querySelector('.white-page-img.white').classList.add('active');
            whiteCompareContainer.querySelector('.cargo-page-img').classList.remove('active');

            whiteCompareContainer.querySelector('.delivery-name.cargo-page-delivery-name').classList.remove('active');
            whiteCompareContainer.querySelector('.help.cargo-help.delivery-help.cargo-page-help').classList.remove('active');

            whiteCompareContainer.querySelector('.delivery-name.white-page-delivery-name').classList.add('active');
            whiteCompareContainer.querySelector('.help.white-help.delivery-help.white-page-help').classList.add('active');
        }
        else {
            whiteCompareContainer.querySelector('.white-page-img.white').classList.remove('active');
            whiteCompareContainer.querySelector('.cargo-page-img').classList.add('active');

            whiteCompareContainer.querySelector('.delivery-name.cargo-page-delivery-name').classList.add('active');
            whiteCompareContainer.querySelector('.help.cargo-help.delivery-help.cargo-page-help').classList.add('active');

            whiteCompareContainer.querySelector('.delivery-name.white-page-delivery-name').classList.remove('active');
            whiteCompareContainer.querySelector('.help.white-help.delivery-help.white-page-help').classList.remove('active');
        }
        let deliveryItemsWhite = whiteCompareContainer.querySelectorAll('.list-help');
        deliveryItemsWhite.forEach((deliveryItem) => {
            deliveryItem.addEventListener('click', selectDeliveryItem);
        });
        document.querySelectorAll('.list-help').forEach((deliveryItem) => {
            deliveryItem.classList.remove('selected');
        });
        isCloned = true;
    showComparisonData();
}

function showComparisonData() {
    if (whiteCompareContainer !== null) {
        document.querySelector('.boxing-content-container').style.height = '1550px';
        whiteCompareContainer.style.display = 'flex';
    }
}

function hideComparisonData() {
    if (whiteCompareContainer !== null) {
        whiteCompareContainer.style.display = 'none';
    }
}

document.addEventListener('DOMContentLoaded', function () {
    initChooseCalcTypeButtons();
    loadBuilderData();
});

function initChooseCalcTypeButtons() {
    buttons = document.querySelectorAll('.calc-type-button');
    buttons.forEach(function(button) {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            toggleButton(button);
            changeCalc();
            event.preventDefault();
        });
    });
}

function showModal(message) {
    let modal = document.querySelector('.loading-modal');
    if (!modal) {
        modal = document.createElement('div');
        modal.classList.add('loading-modal');
        modal.innerHTML = '<div><div class="modal-message">' + message + '</div></div>';
        document.body.appendChild(modal);
    }
    modal.style.display = 'flex';
    modal.children[0].children[0].innerText = message;
}

function showCargoMessage(message) {
    let modal = document.querySelector('.first-step');
    if (!modal) {
        modal = document.createElement('div');
        modal.classList.add('first-step');
        modal.innerHTML = `<img class="arrow-animation-calc" src="/bitrix/templates/main-wisetao/assets/images/icons/arrow-down-log.svg" alt="">
                            <div>
                                <div class="cargo-type-message">` + message + `</div>
                            </div>`;
        document.body.appendChild(modal);
    }
    else {
        modal.innerHTML = `<img class="arrow-animation-calc" src="/bitrix/templates/main-wisetao/assets/images/icons/arrow-down-log.svg" alt="">
                            <div>
                                <div class="cargo-type-message">` + message + `</div>
                            </div>`;
    }
    modal.style.background = 'rgba(47, 55, 67, 0.5)';
}

function updateModalMessage(message) {
    let modal = document.querySelector('.loading-modal');
    if (modal) {
        modal.children[0].children[0].innerText = message;
    }
}

function hideModal() {
    let modal = document.querySelector('.loading-modal');
    if (modal) {
        updateModalMessage('Данные переданы.');
        setTimeout(() => {
            modal.style.display = 'none';
            document.querySelector('.pop-up-ads').style.display = 'flex';
        }, 2000); // 1000 миллисекунд = 1 секунда

    }
}

function activateDeliveryPicks() {
    $('.type-of-goods-dimensions').each(function () {
        this.classList.add('active');
    });
    document.querySelector('.delivery-types').style.height = '670px';
    $('.report-button-container').first().addClass('active');
    if (calcTypeUrl === '/calc-layout/ext_html/white_order_data.php' || calcTypeUrl === '/calc-layout/ext_html/cargo_order_data.php') {
        $('.boxing-content-container').first().css('height', '950px');
    }
    if (calcTypeUrl === '/calc-layout/ext_html/cargo_white_order_data.php') {
        document.querySelector('.needed-space').classList.add('active');
        $('.boxing-content-container').first().css('height', '980px');
    }
}

function changeArrivalSaide() {
    let arrivals = document.querySelectorAll('.title-cargo.tk-type');
    arrivals.forEach((arrival) => {
        if (countryGlobal === 'Кыргызстан') {
            arrival.innerHTML = 'в г. Бишкек';
        }
        if (countryGlobal === 'Казахстан') {
            arrival.innerHTML = 'в г. Алматы';
        }
    });
}

function changeAvailableCountries() {
    if (calcTypeUrl !== '/calc-layout/ext_html/cargo_order_data.php') {
        document.querySelectorAll('.available-country').forEach(function (el) {
            const content = el.textContent.trim();

            if (content.includes('Кыргызстан') || content.includes('Казахстан')) {
                el.classList.add('unavailable-country');

                // Добавляем SVG-код через innerHTML
                el.innerHTML += `
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="6" y="10" width="12" height="8" rx="2" fill="#91969b"/>
                <path d="M9 10V9C9 7.34315 10.3431 6 12 6C13.6569 6 15 7.34315 15 9V10" stroke="#91969b" stroke-width="2"/>
            </svg>`;
            }
        });
    }
    else {
        document.querySelectorAll('.available-country').forEach(function (el) {
            const content = el.textContent.trim();

            if (content.includes('Кыргызстан') || content.includes('Казахстан')) {
                el.classList.remove('unavailable-country');
                if (content.includes('Кыргызстан')) {
                    el.innerHTML = `Кыргызстан`;
                }
                if (content.includes('Казахстан')) {
                    el.innerHTML = `Казахстан`;
                }
            }
        });
    }
}