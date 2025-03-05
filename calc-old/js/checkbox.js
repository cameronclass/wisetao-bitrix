function initializeCheckbox() {
    const checkbox_input_type = document.getElementById('checkbox_input_type');
    const checkbox_input_type2 = document.getElementById('checkbox_input_type2');
    const dimensionsButton = document.querySelector('.main-calc-button.submit-dimensions-button');
    const commonButton = document.querySelector('.main-calc-button.submit-general-button');
    const text1 = document.querySelector('#text1.active');
    const text2 = document.querySelector('#text2.active');
    const text3 = document.querySelector('#text3.active');
    const text4 = document.querySelector('#text4.active');
    const mayDisableCheckboxContainer = document.querySelector('.may-disable');
    const copyLabelsContainer = document.querySelector('.copy-labels');
    const orderDataGeneral = document.querySelector('.order-data-general'); // Найти контейнер order-data
    const orderDataDimensions = document.querySelector('.order-data-dimensions'); // Найти контейнер order-data
    const addContainer = document.querySelector('.add-container:not(.redeem-add)'); // Найти контейнер order-data
    const container = document.querySelector('.calc-container:not(.redeem-data)'); // Найти контейнер .calc-container
    const dimBrand = document.getElementById('dim-brand');
    const pointCheckboxes = document.querySelectorAll('.point-checkbox');
    const boxingContainer = document.querySelector('.boxing-content-container');
    // Глобальные переменные для сохранения высоты контейнера
    window.containerHeightWhenChecked = '270px'; // Высота по умолчанию
    window.containerHeightWhenUnchecked = '323px'; // Высота по умолчанию
    container.classList.remove('comparison-calc-container');
    boxingContainer.classList.remove('comparison-boxing-container');
    // container.classList.add('comparison-calc-container');
    function hideOrderData() {
        const containers = document.querySelectorAll('[data-container]');
        orderDataGeneral.classList.remove('screen-size__display'); // Скрыть контейнер order-data
        // orderDataDimensions.style.display = 'flex';
        addContainer.style.display = 'flex';
        containers.forEach(function (dim) {
            dim.style.display = 'flex';
        })
    }

    function showOrderData() {
        const containers = document.querySelectorAll('[data-container]');
        orderDataGeneral.classList.add("screen-size__display"); // Показать контейнер order-data
        // orderDataDimensions.style.display = 'none';
        addContainer.style.display = 'none';
        containers.forEach(function (dim) {
            dim.style.display = 'none';
        })

    }

    function increaseContainerHeight() {
        container.style.height = window.containerHeightWhenUnchecked; // Увеличить высоту контейнера .calc-container
    }

    function decreaseContainerHeight() {
        container.style.height = window.containerHeightWhenChecked; // Установить высоту контейнера .calc-container на автоматический размер
    }

    let dimCheckbox = document.querySelector('.dim-checkbox');
    if (checkbox_input_type.checked) {
        dimCheckbox.style.display = 'none';
        commonButton.parentElement.classList.remove('hidden');
        dimensionsButton.parentElement.classList.add('hidden');
        if (text1) {
            text1.style.color = '#f09123';
            text2.style.color = 'white';
            text3.style.color = '#9d9d9d';
            text4.style.color = '#9d9d9d';
        }
        checkbox_input_type2.disabled = true;
        checkbox_input_type2.parentElement.classList.add('hidden');
        mayDisableCheckboxContainer.classList.add('disabled');
        showOrderData(); // Показать order-data при загрузке страницы
        decreaseContainerHeight(); // Установить высоту контейнера .calc-container на автоматический размер при загрузке страницы

    } else {
        commonButton.parentElement.classList.add('hidden');
        dimensionsButton.parentElement.classList.remove('hidden');
        dimCheckbox.style.display = 'block';
        if (text1) {
            text1.style.color = 'white';
            text2.style.color = '#f09123';
        }
        checkbox_input_type2.parentElement.classList.remove('hidden');
        checkbox_input_type2.disabled = false;
        setGoodsVars();
        mayDisableCheckboxContainer.classList.remove('disabled');
        hideOrderData(); // Скрыть order-data при загрузке страницы
        increaseContainerHeight(); // Увеличить высоту контейнера .calc-container при загрузке страницы
    }

    checkbox_input_type.addEventListener('change', function () {
        const text1 = document.querySelector('#text1.active');
        const text2 = document.querySelector('#text2.active');
        const text3 = document.querySelector('#text3.active');
        const text4 = document.querySelector('#text4.active');
        if (this.checked) {
            commonButton.parentElement.classList.remove('hidden');
            dimensionsButton.parentElement.classList.add('hidden');
            dimCheckbox.style.display = 'none';
            if (text1) {
                text1.style.color = '#f09123';
                text2.style.color = 'white';
                text3.style.color = '#9d9d9d';
                text4.style.color = '#9d9d9d';
            }
            checkbox_input_type2.disabled = true;
            checkbox_input_type2.parentElement.classList.add('hidden');
            mayDisableCheckboxContainer.classList.add('disabled');
            showOrderData(); // Показать order-data при изменении чекбокса
            decreaseContainerHeight(); // Установить высоту контейнера .calc-container на автоматический размер при изменении чекбокса
        } else {
            commonButton.parentElement.classList.add('hidden');
            dimensionsButton.parentElement.classList.remove('hidden');
            dimCheckbox.style.display = 'block';
            if (text1) {
                text1.style.color = 'white';
                text2.style.color = '#f09123';
            }
            checkbox_input_type2.disabled = false;
            checkbox_input_type2.parentElement.classList.remove('hidden');
            setGoodsVars();
            mayDisableCheckboxContainer.classList.remove('disabled');
            hideOrderData(); // Скрыть order-data при изменении чекбокса
            increaseContainerHeight(); // Увеличить высоту контейнера .calc-container при изменении чекбокса
        }
    });

    function setGoodsVars() {
        const text1 = document.querySelector('#text1.active');
        const text3 = document.querySelector('#text3.active');
        const text4 = document.querySelector('#text4.active');
        if (!checkbox_input_type.checked) {

            setLabels(checkbox_input_type2.checked);
            if (checkbox_input_type2.checked) {
                if (text1) {
                    text3.style.color = '#f09123';
                    text4.style.color = 'white';
                }
                dimBrand.style.display = 'flex';
                pointCheckboxes.forEach(function (pointCheckbox) {
                    pointCheckbox.checked = false;
                    pointCheckbox.style.display = 'none';
                })
            } else {
                if (text1) {
                    text3.style.color = 'white';
                    text4.style.color = '#f09123';
                }
                dimBrand.style.display = 'none';
                dimBrand.checked = false;
                pointCheckboxes.forEach(function (pointCheckbox) {
                    pointCheckbox.style.display = 'flex';
                })
            }
        }
    }

    setGoodsVars();

    function setLabels(checked) {
        let labelPrices = document.querySelectorAll('.dimensions-container .label-price');
        let labelDimensions = document.querySelectorAll('.dimensions-container .custom-input-label-dimensions');
        let labelAdds = document.querySelector('.add-container:not(.redeem-add) .add');
        if (checked) {
            labelAdds.textContent = "Добавить место";
            labelPrices.forEach(function (labelPrice) {
                labelPrice.textContent = "Общая стоимость";
            })
            labelDimensions.forEach(function (labelDimension) {
                labelDimension.textContent = "Кол-во мест";
            })
        } else {
            labelAdds.textContent = "Добавить товар";
            labelPrices.forEach(function (labelPrice) {
                labelPrice.textContent = "Стоимость ед.";
            })
            labelDimensions.forEach(function (labelDimension) {
                labelDimension.textContent = "Кол-во ед.";
            })
        }

    }

    checkbox_input_type2.addEventListener('change', function () {
        const text1 = document.querySelector('#text1.active');
        const text3 = document.querySelector('#text3.active');
        const text4 = document.querySelector('#text4.active');
        let pointCheckboxes = document.querySelectorAll('.point-checkbox');
        let delSpans = document.querySelectorAll('.order-data-dimensions .custom-span');
        if (this.checked) {
            delSpans.forEach((delSpan)  => {
                if (!delSpan.closest('.order-data-dimensions').classList.contains('first')) {
                    delSpan.classList.add('custom-span-display');
                }
                delSpan.classList.remove('center-del-span');
                delSpan.style.position = 'relative';
            });
            if (text1) {
                text3.style.color = '#f09123';
                text4.style.color = 'white';
            }
            dimBrand.style.display = 'flex';
            pointCheckboxes.forEach(function (pointCheckbox) {
                pointCheckbox.checked = false;
                pointCheckbox.style.display = 'none';
            })
        } else {
            delSpans.forEach((delSpan)  => {
                delSpan.classList.add('center-del-span');
                delSpan.classList.remove('custom-span-display');
                delSpan.style.position = 'absolute';
            });
            if (text1) {
                text3.style.color = 'white';
                text4.style.color = '#f09123';
            }
            dimBrand.style.display = 'none';
            dimBrand.checked = false;
            pointCheckboxes.forEach(function (pointCheckbox) {
                pointCheckbox.style.display = 'flex';
            })
        }
        setLabels(this.checked);
    });
}