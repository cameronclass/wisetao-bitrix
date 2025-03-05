let activeButton = null; // Для хранения активной кнопки
// Флаг, чтобы отслеживать, было ли уже выполнено клонирование
let isCloned = false;
let comparisonData = []; // Сохраняем ссылку на клонированные данные

let tnvedCodes = [];

let prices = [];

let weights = [];

let volumes = [];

function collectionTnvedData() {
    tnvedCodes = [];
    prices = [];
    weights = [];
    volumes = [];

    $("input[name='tnved_code[]']").each( function() {
        tnvedCodes.push($(this).val());
    });
    $("input[name='currency[]']").each( function() {
        prices.push($(this).val());
    });
    $("input[name='weight[]']").each( function() {
        weights.push($(this).val());
    });
    $("input[name='volume[]']").each( function() {
        volumes.push($(this).val());
    });
}

function toggleButton(button) {
    if (activeButton === button) {
        return;
    }
    if (activeButton) {
        activeButton.classList.remove("active");
        if (!generalGoodData?.oldButton) {
            Object.assign(generalGoodData, {
                'oldButton': activeButton,
            });
        }
        else {
            generalGoodData.oldButton = activeButton;
        }
    }
    else {
        generalGoodData.oldButton = button;
    }
    button.classList.add("active");
    document.querySelector('.delivery-types').style.height = '120px';
    activeButton = button;
    const dimensionsButton = document.querySelector('.main-calc-button.submit-dimensions-button');
    const commonButton = document.querySelector('.main-calc-button.submit-general-button');
    const whiteButton = document.querySelector('#white-calc-button');
    const cargoWhiteButton = document.querySelector('#cargo-white-calc-button');
    if (button.dataset.type === 'white') {
        document.querySelector('.white-page-img').classList.add('active');
        document.querySelector('.white-page-delivery-name').classList.add('active');
        document.querySelector('.white-page-help').classList.add('active');

        document.querySelector('.cargo-page-img').classList.remove('active');
        document.querySelector('.cargo-page-delivery-name').classList.remove('active');
        document.querySelector('.cargo-page-help').classList.remove('active');
        commonButton.parentElement.classList.add('hidden');
        dimensionsButton.parentElement.classList.add('hidden');
        whiteButton.parentElement.classList.remove('hidden');
        cargoWhiteButton.parentElement.classList.add('hidden');
    }
    if (button.dataset.type === 'cargo') {
        document.querySelector('.white-page-img').classList.remove('active');
        document.querySelector('.white-page-delivery-name').classList.remove('active');
        document.querySelector('.white-page-help').classList.remove('active');

        document.querySelector('.cargo-page-img').classList.add('active');
        document.querySelector('.cargo-page-delivery-name').classList.add('active');
        document.querySelector('.cargo-page-help').classList.add('active');
        commonButton.parentElement.classList.add('hidden');
        dimensionsButton.parentElement.classList.remove('hidden');
        whiteButton.parentElement.classList.add('hidden');
        cargoWhiteButton.parentElement.classList.add('hidden');
    }
    if (button.dataset.type === 'comparison') {
        commonButton.parentElement.classList.add('hidden');
        dimensionsButton.parentElement.classList.add('hidden');
        whiteButton.parentElement.classList.add('hidden');
        cargoWhiteButton.parentElement.classList.remove('hidden');
    }
    gatherGoodData(button);
}

// Найти все кнопки

function changeCalc() {
    getCalcType();
    return fetch(calcTypeUrl)
        .then(response => response.text())
        .then(calcTypeInterface => {
            collectionTnvedData();
            initializeGetRate();
            document.querySelector('.calc-container:not(.redeem-data)').innerHTML = calcTypeInterface;
            if (calcTypeUrl === '/calc-layout/ext_html/white_order_data.php' || calcTypeUrl === '/calc-layout/ext_html/cargo_order_data.php' || calcTypeUrl === '/calc-layout/ext_html/cargo_white_order_data.php') {
                let fetchPromise;
                if (calcTypeUrl === '/calc-layout/ext_html/cargo_white_order_data.php') {
                    fetchPromise = fetch('/calc-layout/ext_html/delivery_list_comparison.php');
                } else {
                    fetchPromise = fetch('/calc-layout/ext_html/delivery_list.php');
                }
                fetchPromise
                    .then(response => response.text())
                    .then(deliveryList => {
                        document.querySelector('#delivery-types-dropdown-auto').innerHTML = deliveryList;
                        document.querySelector('#delivery-types-dropdown-fast-auto').innerHTML = deliveryList;
                        document.querySelector('#delivery-types-dropdown-railway').innerHTML = deliveryList;
                        document.querySelector('#delivery-types-dropdown-avia').innerHTML = deliveryList;

                        if (calcTypeUrl === '/calc-layout/ext_html/cargo_white_order_data.php') {
                            addComparison();
                            cloneAndAppend('.delivery-types');
                        } else {
                            removeComparison();
                        }
                        initializeDeliveryList();
                        changeAvailableCountries();
                        if (calcTypeUrl === '/calc-layout/ext_html/cargo_order_data.php') {
                            initializeCheckbox();
                            initializeAddGoods();
                            initializeGeneralAjaxRequest();
                            destroyTnvedTree();
                            // hideComparisonData();
                            initializeCalcVolume();
                        }
                        if (calcTypeUrl === '/calc-layout/ext_html/white_order_data.php' || calcTypeUrl === '/calc-layout/ext_html/cargo_white_order_data.php') {
                            initializeWhiteCalcSpace();
                            initializeAddTnvedCode();
                            initializeSuggestion();
                            fillWhiteData($('.add'));
                            if (calcTypeUrl === '/calc-layout/ext_html/cargo_white_order_data.php') {
                                initializeAjaxRequestCargoWhite();
                            }
                            if (calcTypeUrl === '/calc-layout/ext_html/white_order_data.php') {
                                initializeGetRate();
                                // hideComparisonData();
                            }

                            fetch('/calc-layout/ext_html/tnved_tree_handling.php')
                                .then(response => response.text())
                                .then(tnvedTreeInterface => {
                                    document.querySelector('.tnved-tree-container').innerHTML = tnvedTreeInterface;
                                    initializePopupTnvedTree();
                                    initializeTnvedTreeHandling();
                                })
                        }
                        if (calcTypeUrl === '/calc-layout/ext_html/white_order_data.php' || calcTypeUrl === '/calc-layout/ext_html/cargo_white_order_data.php') {
                            initializeTnvedAjaxRequest();
                            initializeReportWhiteData();
                        }
                        initializeHelp();
                        initializeSelectDeliveryItem();
                        sendGoodData(activeButton);
                        activateCalculator();
                    });
            }
        });
}

// Добавить обработчик события click к каждой кнопке

function addComparison() {
    document.querySelectorAll('.type-of-goods-dimensions.delivery-data').forEach((deliveryTypesDropdown) => {
        deliveryTypesDropdown.classList.add('type-of-goods-dimensions-comparison');
        deliveryTypesDropdown.querySelector('.delivery-types-dropdown.delivery-data').classList.add('delivery-types-dropdown-comparison');
    });
}

function removeComparison() {
    document.querySelectorAll('.type-of-goods-dimensions.delivery-data').forEach((deliveryTypesDropdown) => {
        deliveryTypesDropdown.classList.remove('type-of-goods-dimensions-comparison');
        deliveryTypesDropdown.querySelector('.delivery-types-dropdown.delivery-data').classList.remove('delivery-types-dropdown-comparison');
    });
    document.querySelector('.needed-space').classList.remove('active');

}