function initializeTypeOfGoods() {
    const dropdowns = document.querySelectorAll('.type-of-goods-dropdown:not(.delivery-types-dropdown)');
    let arrow;
    function initializeDropdown(dropdown) {

        dropdown.classList.add('initialized'); // Добавляем класс .initialized после инициализации

        const dropdownToggle = dropdown.querySelector('.type-of-goods-dropdown-toggle');
        if (dropdownToggle) {
            const helpContent = dropdownToggle.querySelector('.help');
            helpContent.addEventListener('mouseenter', updateBalloonPosition);
        }
        const dropdownList = dropdown.querySelector('.type-of-goods-dropdown-list');
        const typeOfGoodsValues = dropdown.querySelectorAll('.type-of-goods-values');

        function updateCurrency(sign, helpContent) {
            if (helpContent) {
                if (sign !== null) {
                    arrow = dropdownToggle.querySelector('.dropdown-list-goods-arrow');
                    dropdownToggle.textContent = sign.textContent;
                }
                // Добавляем helpContent в dropdownToggle
                helpContent.innerHTML.trim();
                dropdownToggle.appendChild(helpContent);
                dropdownToggle.appendChild(arrow);
            }
            dropdownList.classList.remove('active');
            dropdownToggle.style.borderBottomRightRadius = '10px';
            dropdownToggle.style.borderBottomLeftRadius = '10px';
            dropdown.style.borderBottomRightRadius = '10px';
            dropdown.style.borderBottomLeftRadius = '10px';
        }

        dropdownToggle.addEventListener('click', function () {
            dropdownList.classList.toggle('active');
            if (dropdownList.classList.contains('active')) {
                dropdownToggle.style.borderBottomRightRadius = 0;
                dropdownToggle.style.borderBottomLeftRadius = 0;
                dropdownList.style.borderTopRightRadius = 0;
                dropdownList.style.borderTopLeftRadius = 0;
                dropdown.style.borderBottomRightRadius = 0;
                dropdown.style.borderBottomLeftRadius = 0;
            } else {
                dropdownToggle.style.borderBottomRightRadius = '10px';
                dropdownToggle.style.borderBottomLeftRadius = '10px';
                dropdown.style.borderBottomRightRadius = '10px';
                dropdown.style.borderBottomLeftRadius = '10px';
            }
        });

        typeOfGoodsValues.forEach(function (value) {
            const helpContent = value.nextElementSibling;
            helpContent.addEventListener('mouseenter', updateBalloonPosition);
        });

        typeOfGoodsValues.forEach(function (value) {
            value.addEventListener('click', function (event) {
                event.stopPropagation();
                const helpContent = value.nextElementSibling.cloneNode(true);
                if (helpContent) {
                    helpContent.addEventListener('mouseenter', updateBalloonPosition);
                    helpContent.className = 'help ' + 'type-of-goods-dropdown-toggle-' + helpContent.className.split(' ')[1];
                }
                updateCurrency(value, helpContent);
            });
        });

        const typeOfGoodsItems = dropdown.querySelectorAll('.type-of-goods-dropdown-list li');
        typeOfGoodsItems.forEach(function (item) {
            item.addEventListener('click', function () {
                let value;
                let helpContent;
                if (!item.closest('ul').classList.contains('delivery-types-list')) {
                    value = item.querySelector('.type-of-goods-values');
                    if (helpContent) {
                        helpContent = item.querySelector('.help').cloneNode(true);
                        helpContent.addEventListener('mouseenter', updateBalloonPosition);
                        helpContent.className = 'help ' + 'type-of-goods-dropdown-toggle-' + helpContent.className.split(' ')[1];
                    }
                }
                updateCurrency(value, helpContent, '.delivery-types-list');
            });
        });

        // Закрываем список при клике внутри списка
        dropdownList.addEventListener('click', function (event) {
            event.stopPropagation(); // Предотвращаем всплытие события, чтобы не закрыть список
            dropdownToggle.style.borderBottomRightRadius = '10px';
            dropdownToggle.style.borderBottomLeftRadius = '10px';
            dropdown.style.borderBottomRightRadius = '10px';
            dropdown.style.borderBottomLeftRadius = '10px';
        });

        // Закрываем список при клике вне элемента или на другом элементе
        document.addEventListener('click', function (event) {
            if (!dropdown.contains(event.target) && !dropdownToggle.contains(event.target)) {
                dropdownList.classList.remove('active');
                dropdownToggle.style.borderBottomRightRadius = '10px';
                dropdownToggle.style.borderBottomLeftRadius = '10px';
                dropdown.style.borderBottomRightRadius = '10px';
                dropdown.style.borderBottomLeftRadius = '10px';
            }
        });
    }

    dropdowns.forEach(function (dropdown) {
        initializeDropdown(dropdown);
    });

    const observer = new MutationObserver(function (mutationsList) {
        for (const mutation of mutationsList) {
            if (mutation.type === 'childList' && !mutation.target.classList.contains('suggestion')) {
                // При добавлении новых элементов инициализируем только новые списки
                const newDropdowns = document.querySelectorAll('.type-of-goods-dropdown:not(.delivery-types-dropdown):not(.initialized)');
                newDropdowns.forEach(function (dropdown) {
                    initializeDropdown(dropdown);
                });
            }
        }
    });

    observer.observe(document.body, { childList: true, subtree: true });

    // Обработчик события clone, генерируемого при клонировании
    document.addEventListener('clone', function (event) {
        const cloneDropdowns = event.detail.clone.querySelectorAll('.type-of-goods-dropdown:not(.delivery-types-dropdown)');
        cloneDropdowns.forEach(function (dropdown) {
            dropdown.classList.remove('initialized'); // Удаляем класс .initialized у новых списков после клонирования
        });
    });
}
