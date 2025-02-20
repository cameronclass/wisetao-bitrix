function initializeCountGoods() {
        // Функция для инициализации кнопок и input-ов
    function initializeButtonsAndInputs() {
        // Выбираем все кнопки с классами custom-input-left-addon, custom-input-left-addon-dimensions, custom-input-right-addon-dimensions, custom-input-right-addon
        // const buttons = document.querySelectorAll('.custom-input-left-addon:not(.initialized), .custom-input-left-addon-dimensions:not(.initialized), .custom-input-right-addon-dimensions:not(.initialized), .custom-input-right-addon:not(.initialized)');

        // buttons.forEach(function (button) {
        //     button.classList.add('initialized'); // Предотвращаем добавление дублей событий
        //     if (button.classList.contains('custom-input-left-addon') || button.classList.contains('custom-input-left-addon-dimensions')) {
        //         button.addEventListener('click', decreaseValue);
        //     } else if (button.classList.contains('custom-input-right-addon') || button.classList.contains('custom-input-right-addon-dimensions')) {
        //         button.addEventListener('click', increaseValue);
        //     }
        // });

        // Выбираем все input-ы с классами custom-input-field, custom-input-field-dimensions
        const inputs = document.querySelectorAll('.custom-input-field:not(.initialized), .custom-input-field-dimensions:not(.initialized)');

        inputs.forEach(function (input) {
            const notice = input.parentElement.querySelector('.input-notice');
            let label = input.parentElement.querySelector('label'); // Поиск метки перед input
            if (!label) {
                const container = input.parentElement;
                if (container) {
                    const grandContainer = container.parentElement;
                    if (grandContainer) {
                        label = grandContainer.querySelector('label');
                    }
                }
            }

            // notice.style.display = 'none'; // Скрыть надпись
            // input.style.border = ''; // Убрать рамку

            input.classList.add('initialized'); // Предотвращаем добавление дублей событий
            input.addEventListener('input', function () {
                this.value = this.value.replace(/[^0-9]/g, '');
                if (this.value !== "") {
                    notice.style.display = 'none'; // Скрыть надпись
                    input.style.border = ''; // Убрать красную рамку поля
                }
            });
            input.addEventListener('blur', function () {
                if (this.value === "") {
                    notice.textContent = "введите " + label.textContent;
                    notice.style.display = 'block'; // Отобразить надпись
                    input.style.border = '1px solid #a81d29'; // Сделать рамку поля красной
                } else {
                    notice.style.display = 'none'; // Скрыть надпись
                    input.style.border = ''; // Убрать красную рамку поля
                }
            });
        });
    }

    initializeButtonsAndInputs();

    const observer = new MutationObserver(function (mutationsList) {
        for (const mutation of mutationsList) {
            if (mutation.type === 'childList' && !mutation.target.classList.contains('suggestion')) {
                // При добавлении новых элементов инициализируем только новые кнопки и input-ы
                initializeButtonsAndInputs();
            }
        }
    });

    observer.observe(document.body, {childList: true, subtree: true});

    // Обработчик события clone, генерируемого при клонировании
    document.addEventListener('clone', function (event) {
        const cloneButtons = event.detail.clone.querySelectorAll('.custom-input-left-addon, .custom-input-left-addon-dimensions, .custom-input-right-addon-dimensions, .custom-input-right-addon');
        cloneButtons.forEach(function (button) {
            button.classList.remove('initialized'); // Удаляем класс .initialized у новых кнопок после клонирования
        });

        const cloneInputs = event.detail.clone.querySelectorAll('.custom-input-field, .custom-input-field-dimensions');
        cloneInputs.forEach(function (input) {
            input.classList.remove('initialized'); // Удаляем класс .initialized у новых input-ов после клонирования
        });
    });

    // Функция для увеличения значения на 1
    // Функция для увеличения значения на 1
    // function increaseValue(event) {
    //     const container = event.target.closest('.order-data-dimensions, .order-data-general');
    //     if (container) {
    //         const quantityInput = container.querySelector('.custom-input-field, .custom-input-field-dimensions');
    //         if (quantityInput) {
    //             let value = parseInt(quantityInput.value);
    //             value = isNaN(value) ? 1 : value; // Если значение не число, то устанавливаем 1
    //             value++;
    //             quantityInput.value = value;
    //         }
    //     }
    // }

// Функция для уменьшения значения на 1, но не меньше 1
//     function decreaseValue(event) {
//         const container = event.target.closest('.order-data-dimensions, .order-data-general');
//         if (container) {
//             const quantityInput = container.querySelector('.custom-input-field, .custom-input-field-dimensions');
//             if (quantityInput) {
//                 let value = parseInt(quantityInput.value);
//                 value = isNaN(value) ? 1 : value; // Если значение не число, то устанавливаем 1
//                 if (value > 1) {
//                     value--;
//                     quantityInput.value = value;
//                 }
//             }
//         }
//     }

    document.querySelectorAll('.js-validate-num').forEach((input) => {
        input.addEventListener('input', function () {
            this.value = this.value.replace(/[^\d.,]|(?<=[.,]\d*)[.,]|^[.,]|(?<=^0)[^.,]/g, '');
            // Разбиваем значение на целую часть и дробную
            const parts = this.value.split(/[.,]/);
            const separator = this.value.substring(this.value.search(/[,.]/), this.value.search(/[,.]/) + 1);
            if (parts[1] && parts[1].length > 3) {
                parts[1] = parts[1].slice(0, 3); // Ограничиваем до 3 знаков после запятой
                this.value = parts.join(separator);
            }
        });
    });

    document.querySelectorAll('.group-input-increment').forEach(incrementGroup => {
        // Проверка и установка дефолтного значения 1 при некорректном вводе

        increaseValue(incrementGroup.querySelector('.group-input-increment__plus'), incrementGroup.querySelector('input'));
        decreaseValue(incrementGroup.querySelector('.group-input-increment__minus'), incrementGroup.querySelector('input'));

        // Проверка при потере фокуса поля ввода
        validateInputValue(incrementGroup.querySelector('input'));
    });
}

function validateInputValue(input) {
    if (input) {
        input.addEventListener('blur', () => {
            if (isNaN(parseInt(input.value)) || input.value.trim() === '') {
                input.value = 1;  // Если не цифра или пустое значение, ставим 1
            }
        });
        input.value = 1;
        input.classList.add('initialized');
    }
}

function increaseValue(button, input) {
    if (input && button) {
        button.addEventListener('click', () => {
            input.value = parseInt(input.value) + 1;
        });
        button.classList.add('initialized');
    }
}

function decreaseValue(button, input) {
    if (input && button) {
        button.addEventListener('click', () => {
            validateInputValue();
            const currentValue = parseInt(input.value);
            if (currentValue > 1) {  // Уменьшение только если значение больше 1
                input.value = currentValue - 1;
            }
        });
        button.classList.add('initialized');
    }
}





