function initializeDeliveryChoice() {
    // Находим все элементы DOM с классом 'delivery-toggle'
    const deliveryToggles = document.querySelectorAll('.delivery-toggle');
    deliveryToggles.forEach(handleDeliveryToggle);
}

function handleDeliveryToggle(deliveryToggle) {
    const deliveryTypesDropdown = deliveryToggle.closest('.delivery-types-dropdown');
    const kgElement = deliveryTypesDropdown.querySelector('.costs-data .kg');
    const sumElement = deliveryTypesDropdown.querySelector('.costs-data .sum');
    const costElems = deliveryTypesDropdown.querySelectorAll('.cost-elem');

    // Добавляем обработчики событий на элементы списка внутри текущего deliveryToggle
    costElems.forEach((elem) => {
        elem.addEventListener('click', () => {
            // Обновляем текст в deliveryToggle
            const arrow = deliveryToggle.querySelector('.dropdown-list-delivery-arrow');
            const rates = deliveryToggle.querySelector('.costs-data-exchange-rate');
            deliveryToggle.textContent = elem.firstChild.textContent;
            // Находим элемент li и его элемент help
            const listItem = elem.closest('li');
            const helpElement = listItem.querySelector('.help');

            // Если найден элемент help, добавляем его в delivery-toggle
            if (helpElement) {
                const clonedHelpElement = helpElement.cloneNode(true);
                deliveryToggle.appendChild(clonedHelpElement);
                deliveryToggle.querySelector('.help').style.marginTop = '7px';
                clonedHelpElement.addEventListener('mouseenter', updateBalloonPosition);
            }
            if (rates) {
                deliveryToggle.append(rates);
            }
            if (arrow) {
                deliveryToggle.append(arrow);
            }
            // Обновляем значения в kgElement и sumElement
            const costElement = elem.querySelector('.cost');
            const kgValue = costElement.querySelector('.kg').innerHTML;
            const sumValue = costElement.querySelector('.sum').innerHTML;

            kgElement.innerHTML = kgValue;
            sumElement.innerHTML = sumValue;
        });
    });
    // function updateBalloonPosition(event) {
    //     const helpElement = event.currentTarget;
    //     const balloonContainer = helpElement.querySelector('.balloon-container');
    //
    //     // Получаем позицию .help элемента
    //     const helpRect = helpElement.getBoundingClientRect();
    //
    //     // Устанавливаем позицию .balloon-container относительно .help элемента
    //     balloonContainer.style.top = `${helpRect.top - 208}px`;
    //     balloonContainer.style.left = `${helpRect.left + helpRect.width - 200}px`;
    // }
}