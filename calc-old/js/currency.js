function initializeCurrency() {
    const dropdowns = document.querySelectorAll('.dropdown');
    let arrow;
    // Функция для инициализации input-ов
    function initializeInputs() {
        const newInputs = document.querySelectorAll('.js-validate-num:not(.initialized), .dimensions-input:not(.initialized), .select-by-name-input:not(.initialized), .tnved-input:not(.initialized), .to-arrival-input:not(.initialized), .redeem-input:not(.initialized), .redeem-params-input:not(.initialized), .redeem-note-input:not(.initialized), .client-requisites-input:not(.initialized)');
        newInputs.forEach(function (input) {
            const notice = input.parentElement.querySelector('.input-notice');
            let label = input.parentElement.querySelector('.group-input__title, label'); // Поиск метки перед input
            if (!label) {
                const container = input.parentElement;
                if (container) {
                    const grandContainer = container.parentElement;
                    if (grandContainer) {
                        label = grandContainer.querySelector('.group-input__title, label');
                    }
                }
            }

            notice.style.display = 'none'; // Скрыть надпись
            input.style.border = ''; // Убрать рамку

            input.addEventListener('invalid', function (event) {
                event.preventDefault();
            });

            input.addEventListener('input', function () {
                if (this.value !== "") {
                    notice.style.display = 'none'; // Скрыть надпись
                    input.style.border = ''; // Убрать красную рамку поля
                }
                if (!input.classList.contains('select-by-name-input') && !input.classList.contains('tnved-input') && !input.classList.contains('to-arrival-input')
                    && !input.classList.contains('redeem-input') && !input.classList.contains('redeem-params-input') && !input.classList.contains('redeem-note-input')
                    && !input.classList.contains('client-requisites-input')) {
                    this.value = this.value.replace(/[^\d.,]|(?<=[.,]\d*)[.,]|^[.,]|(?<=^0)[^.,]/g, '');
                    // Проверить, если введено более трех цифр после точки
                    const parts = this.value.split(/[.,]/);
                    const separator = this.value.substring(this.value.search(/[,.]/), this.value.search(/[,.]/) + 1);
                    if (parts[1] && parts[1].length > 3) {
                        notice.textContent = "только 3 цифры после запятой";
                        notice.style.display = 'flex'; // Отобразить надпись
                        parts[1] = parts[1].slice(0, 3); // Ограничить одним знаком после точки
                        this.value = parts.join(separator);
                    }
                }
                if (input.id.includes('client-phone')) {
                //     this.value = this.value
                //         .replace(/[^\d]/g, '')
                //         .replace(/(?!7)(\d{1,3})(\d{0,3})?(\d{0,2})?(\d{0,2})?/, function (match, p1, p2, p3, p4) {
                //             let formatted = '+7 (' + p1; // Добавляем код страны и открывающую скобку сразу
                //             if (p2) formatted += ') ' + p2; // Если есть 3 цифры, добавляем закрывающую скобку и пробел
                //             if (p3) formatted += '-' + p3; // Если есть 6 цифр, добавляем дефис
                //             if (p4) formatted += '-' + p4; // Если есть 8 цифр, добавляем ещё один дефис
                //             return formatted; // Возвращаем отформатированную строку
                //         })
                //         .replace(/^7/g, '');
                    let noticeNumber = document.querySelector('.input-notice-valid-number');
                    if (noticeNumber) {
                        noticeNumber.style.display = 'none';
                        let inputPhone = notice.parentElement.querySelector('.client-requisites-input.phone');
                        if (inputPhone) {
                            inputPhone.style.color = 'white';
                        }
                    }
                }
            });

            if (input.classList.contains('length') || input.classList.contains('width') || input.classList.contains('height')) {
                let result = input.parentElement.querySelector('.result');
                let lengthInput = input.parentElement.querySelector('.length');
                let widthInput = input.parentElement.querySelector('.width');
                let heightInput = input.parentElement.querySelector('.height');
                input.addEventListener('input', function(event) {
                    updateResult(lengthInput, widthInput, heightInput, result, event);
                });
            }

            if (!input.classList.contains('select-by-name-input') && !input.classList.contains('not-required')) {
                input.addEventListener('blur', function () {
                    validateValue(input, notice, label);
                });
            }
            input.classList.add('initialized');
        });
    }

    // Функция для инициализации dropdown
    function initializeDropdown(dropdown) {
        const dropdownToggle = dropdown.querySelector('.dropdown-toggle');
        const dropdownList = dropdown.querySelector('.dropdown-list');
        const currencySigns = dropdown.querySelectorAll('.currency-sign');

        function updateCurrency(sign) {
            arrow = dropdownToggle.querySelector('.dropdown-list-currency-arrow');
            dropdownToggle.textContent = sign.textContent;
            dropdownToggle.dataset.currency = sign.dataset.currency;
            dropdownToggle.appendChild(arrow);
            dropdownList.classList.remove('active');
            dropdownToggle.style.borderBottomRightRadius = '10px';
            dropdown.style.borderBottomRightRadius = '10px';
        }

        dropdownToggle.addEventListener('click', function () {
            dropdownList.classList.toggle('active');
            if (dropdownList.classList.contains('active')) {
                dropdownToggle.style.borderBottomRightRadius = 0;
                dropdown.style.borderBottomRightRadius = 0;
            } else {
                dropdownToggle.style.borderBottomRightRadius = '10px';
                dropdown.style.borderBottomRightRadius = '10px';
            }
        });

        currencySigns.forEach(function (sign) {
            sign.addEventListener('click', function (event) {
                event.stopPropagation(); // Предотвращаем всплытие события, чтобы не закрыть список сразу
                updateCurrency(sign);
            });
        });

        const currencyItems = dropdown.querySelectorAll('.dropdown-list li');
        currencyItems.forEach(function (item) {
            item.addEventListener('click', function () {
                const sign = item.querySelector('.currency-sign');
                updateCurrency(sign);
            });
        });

        // Закрываем список при клике внутри списка
        dropdownList.addEventListener('click', function (event) {
            event.stopPropagation(); // Предотвращаем всплытие события, чтобы не закрыть список
            dropdownToggle.style.borderBottomRightRadius = '10px';
            dropdown.style.borderBottomRightRadius = '10px';
        });

        // Закрываем список при клике вне элемента или на другом элементе
        document.addEventListener('click', function (event) {
            if (!dropdown.contains(event.target) && !dropdownToggle.contains(event.target)) {
                dropdownList.classList.remove('active');
                dropdownToggle.style.borderBottomRightRadius = '10px';
                dropdown.style.borderBottomRightRadius = '10px';
            }
        });
    }

    function InitializePlusMinusButtons() {
        const newButtons = document.querySelectorAll('.group-input-increment__minus:not(.initialized), .group-input-increment__plus:not(.initialized)');
        if (newButtons) {
            newButtons.forEach(newButton => {
                let newInput =  newButton.parentElement.querySelector('.js-validate-num');
                validateInputValue(newInput);
                if (newButton.classList.contains('group-input-increment__minus')) {
                    decreaseValue(newButton, newInput);
                }
                if (newButton.classList.contains('group-input-increment__plus')) {
                    increaseValue(newButton, newInput);
                }
            });
        }
    }
    initializeInputs();

    const observer = new MutationObserver(function (mutationsList) {
        for (const mutation of mutationsList) {
            if (mutation.type === 'childList' && !mutation.target.classList.contains('suggestion')) {
                InitializePlusMinusButtons();
                initializeInputs();
                // При добавлении новых элементов также инициализируем новые dropdown-ы
                const newDropdowns = document.querySelectorAll('.dropdown:not(.initialized)');
                newDropdowns.forEach(function (dropdown) {
                    initializeDropdown(dropdown);
                    dropdown.classList.add('initialized');
                });
            }
        }
    });

    observer.observe(document.body, {childList: true, subtree: true});

    dropdowns.forEach(function (dropdown) {
        initializeDropdown(dropdown);
        dropdown.classList.add('initialized');
    });

    // Обработчик события clone, генерируемого при клонировании
    document.addEventListener('clone', function (event) {
        const cloneInputs = event.detail.clone.querySelectorAll('.js-validate-num, .dimensions-input, .select-by-name-input, .tnved-input, .to-arrival-input, .redeem-input, .redeem-params-input, .redeem-note-input');
        cloneInputs.forEach(function (cloneInput) {
            cloneInput.classList.remove('initialized');
        });

        const cloneDropdowns = event.detail.clone.querySelectorAll('.dropdown');
        cloneDropdowns.forEach(function (cloneDropdown) {
            cloneDropdown.classList.remove('initialized');
        });

        const cloneButtons = event.detail.clone.querySelectorAll('.group-input-increment__minus, .group-input-increment__plus');
        cloneButtons.forEach(function (cloneButton) {
            cloneButton.classList.remove('initialized');
        });
    });
}

function validateValue(input, notice = null, label = null) {
    if (!notice && !label) {
        notice = input.parentElement.querySelector('.input-notice');
        label = input.parentElement.querySelector('.group-input__title'); // Поиск метки перед input
        if (!label) {
            const container = input.parentElement;
            if (container) {
                const grandContainer = container.parentElement;
                if (grandContainer) {
                    label = grandContainer.querySelector('.group-input__title, label');
                }
            }
        }
    }
    if (input.value === "") {
        // if (input.classList.contains('dimensions-input')) {
        //     label = input.parentElement.parentElement.querySelector('.group-input__title, label');
        // }
        notice.textContent = "заполните " + '"' + label.textContent+'"';
        notice.style.display = 'flex'; // Отобразить надпись
        input.style.border = '1px solid #a81d29'; // Сделать рамку поля красной
    } else {
        notice.style.display = 'none'; // Скрыть надпись
        input.style.border = ''; // Убрать красную рамку поля
    }
}