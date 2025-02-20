// Функция для клонирования и обновления контейнера
function initializeAddRedeems() {
        function dispatchCloneEvent(newContainer) {
            const cloneEvent = new CustomEvent('clone', {
                detail: {clone: newContainer},
                bubbles: true,
                cancelable: true
            });
            newContainer.dispatchEvent(cloneEvent);
        }

        function cloneContainer() {
            const containers = document.querySelectorAll('[data-container-redeem]');
            const lastContainer = containers[containers.length - 1];
            const newContainer = lastContainer.cloneNode(true);
            newContainer.querySelector('img').src = '';
            newContainer.querySelector('img').style.display = 'none';
            var squareOuterPlus = newContainer.querySelector(".redeem-inner-square-plus");
            var squareOuterMinus = newContainer.querySelector(".redeem-inner-square-minus");
            squareOuterMinus.style.display = 'none';
            squareOuterPlus.style.display = 'flex';
            const container = document.querySelector(".calc-container.redeem-data");
            const computedStyles = window.getComputedStyle(container);
            const currentHeight = parseInt(computedStyles.height, 10);
            // Генерируем уникальные id для полей ввода
            const inputs = newContainer.querySelectorAll('input');
            inputs.forEach((input, index) => {
                const baseId = input.id.split('_')[0]; // Получаем базовый ID без номера
                const currentNumber = containers.length + 1; // Текущее количество контейнеров, начиная с 2
                input.id = `${baseId}_${currentNumber}`;
                input.value = ''; // Очищаем значения полей
                if (input.classList.contains('custom-input-field-dimensions')) {
                    input.value = '1';
                }
            });

            // Удаляем класс initialized у клонированных контейнеров
            const clonedPhotoInput = newContainer.querySelector(".photo-input");
            const clonedSelectedPhoto = newContainer.querySelector(".selected-photo");
            if (clonedPhotoInput && clonedSelectedPhoto) {
                clonedPhotoInput.classList.remove("initialized");
                clonedSelectedPhoto.classList.remove("initialized");
            }

            const addButton = document.querySelector('.redeem-buttons');
            container.insertBefore(newContainer, addButton);

            // Увеличиваем высоту контейнера redeem-data на 335px
            container.style.height = (currentHeight + 214) + "px";
            newContainer.style.zIndex = window.getComputedStyle(newContainer).zIndex - 1;
            newContainer.style.marginTop = "20px";
            newContainer.querySelector('.close-cross').style.display = 'block';

            newContainer.querySelector('.close-cross').addEventListener('click', () => {
                newContainer.remove();
                const computedStyles = window.getComputedStyle(document.querySelector(".calc-container.redeem-data"));
                let currentHeight = parseInt(computedStyles.height, 10);
                container.style.height = (currentHeight - 214) + "px";
            });
            dispatchCloneEvent(newContainer);
        }

        const addButtonRedeem = document.querySelector('.redeem-add');
        addButtonRedeem.addEventListener('click', cloneContainer);
}
