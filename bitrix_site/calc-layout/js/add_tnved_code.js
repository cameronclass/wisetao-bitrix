

function initializeAddTnvedCode() {
    let addButton = document.querySelector('.add-white-code');
    addButton.addEventListener('click', cloneContainer);
}

function fillWhiteData(addButton) {
    tnvedCodes.forEach( (tnvedCode, index) => {
        $("input[name='tnved_code[]']")[index].value = tnvedCode;
        $("input[name='currency[]']")[index].value = prices[index];
        $("input[name='weight[]']")[index].value = weights[index];
        $("input[name='volume[]']")[index].value = volumes[index];
        if (index < tnvedCodes.length - 1) {
            addButton.click();
        }
    });
}

function cloneContainer() {
    const containers = document.querySelectorAll('[data-white-container]');
    const lastContainer = containers[containers.length - 1];
    const newContainer = lastContainer.cloneNode(true);

    // Найдите .select-by-name-input внутри newContainer
    const selectByNameInput = newContainer.querySelector('.select-by-name-input');
    if (newContainer.querySelector('.brand-help')) {
        newContainer.querySelector('.brand-help').addEventListener('mouseenter', updateBalloonBrandPosition)
    }
    if (selectByNameInput) {
        addEventSuggestion(selectByNameInput);
    }
    // Генерируем уникальные id для полей ввода
    const inputs = newContainer.querySelectorAll('input');
    inputs.forEach((input, index) => {
        const idAttribute = input.getAttribute('id');
        if (idAttribute) {
            input.setAttribute('id', idAttribute + '_' + (containers.length + 1));
            input.value = ''; // Очищаем значения полей
        }
    });

    // Генерируем уникальный id для type-of-goods-dropdown
    const typeOfGoodsDropdown = newContainer.querySelector('.arrival-input-label');
    if (typeOfGoodsDropdown) {
        const forAttribute = typeOfGoodsDropdown.getAttribute('for');
        if (forAttribute) {
            typeOfGoodsDropdown.setAttribute('for', forAttribute + '_' + (containers.length + 1));
        }
    }

    document.body.appendChild(newContainer);

    const cloneEvent = new CustomEvent('clone', {
        detail: { clone: newContainer },
        bubbles: true,
        cancelable: true
    });
    newContainer.dispatchEvent(cloneEvent);
    const container = document.querySelector(".calc-container:not(.redeem-data)");
    // Вставляем новый контейнер перед кнопкой add-container
    const addContainer = document.querySelector('.add-white-container');
    addContainer.parentNode.insertBefore(newContainer, addContainer);
    let calcTypeHeight = 0;
    if (activeButton.getAttribute('data-type') !== 'comparison') {
        calcTypeHeight = 124;
        container.style.height = (parseInt(container.style.height) + calcTypeHeight) + "px";
    }
    else {
        calcTypeHeight = 184;
        container.style.height = (parseInt(container.style.height) + calcTypeHeight) + "px";
    }
    newContainer.style.marginTop = "20px";
    newContainer.style.zIndex = window.getComputedStyle(newContainer).zIndex - 1;
    const deleteButton = newContainer.querySelector('.close-cross');
    deleteButton.style.display = 'block';

    if (deleteButton) {
        deleteButton.addEventListener('click', () => {
            newContainer.remove();
            container.style.height = (parseInt(container.style.height) - calcTypeHeight) + "px";
        });
    }
}