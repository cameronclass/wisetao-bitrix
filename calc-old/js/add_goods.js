// Функция для клонирования и обновления контейнера
function initializeAddGoods() {
    function cloneContainer() {
        const containers = document.querySelectorAll('[data-container]');
        const lastContainer = containers[containers.length - 1];
        const newContainer = lastContainer.cloneNode(true);
        document.body.appendChild(newContainer);
        if (newContainer.querySelector('.brand-help')) {
            newContainer.querySelector('.brand-help').addEventListener('mouseenter', updateBalloonBrandPosition)
        }
        const cloneEvent = new CustomEvent('clone', {
            detail: {clone: newContainer},
            bubbles: true,
            cancelable: true
        });
        newContainer.dispatchEvent(cloneEvent);
        const container = document.querySelector(".calc-container:not(.redeem-data)");
        // Генерируем уникальные id для полей ввода
        const inputs = newContainer.querySelectorAll('input');
        inputs.forEach((input, index) => {
            input.id = `${input.id}_${containers.length + 1}`;
            input.value = ''; // Очищаем значения полей\
            if (input.classList.contains('custom-input-field-dimensions')) {
                input.value = '1';
            }
        });

        // Генерируем уникальный id для контейнера type-of-goods-dropdown
        const typeOfGoodsDropdown = newContainer.querySelector('.type-of-goods-dropdown');
        typeOfGoodsDropdown.id = `type-of-goods-dropdown_${containers.length + 1}`;

        // Вставляем новый контейнер перед кнопкой add-container
        const addContainer = document.querySelector('.add-container:not(.redeem-add)');
        addContainer.parentNode.insertBefore(newContainer, addContainer);

        // Увеличиваем его высоту на 320px
        container.style.height = (parseInt(container.style.height) + 126) + "px";

        newContainer.style.marginTop = "20px";
        newContainer.style.zIndex = window.getComputedStyle(newContainer).zIndex - 1;
        newContainer.querySelector('.close-cross').style.display = 'block';

        newContainer.classList.remove('first');
        newContainer.querySelector('.close-cross').addEventListener('click', () => {
            newContainer.querySelectorAll('.dimensions-calc-input').forEach((input) => {
                input.classList.add('deleted-input');
            });
            newContainer.remove();
            container.style.height = (parseInt(container.style.height) - 126) + "px";
            window.containerHeightWhenUnchecked = container.style.height;
        });

        window.containerHeightWhenUnchecked = container.style.height;
        // newContainer.setAttribute('data-container', parseInt(newContainer.getAttribute('data-container')) + 1);
    }

    const addButton = document.querySelector('.add-container:not(.redeem-add) .add');
    addButton.addEventListener('click', cloneContainer);
}
