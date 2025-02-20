function initializeYandexSuggest() {
    var find = function (arr, find) {
        return arr.filter(function (value) {
            return (value + "").toLowerCase().indexOf(find.toLowerCase()) !== -1;
        });
    };

    var myProvider = {
        suggest: function (request, options) {
            var res = find(arr, request),
                arrayResult = [],
                results = Math.min(options.results, res.length);
            for (var i = 0; i < results; i++) {
                arrayResult.push({displayName: res[i], value: res[i]})
            }
            return ymaps.vow.resolve(arrayResult);
        }
    }

    ymaps.ready(init);

    function init() {
        let countriesContainer = document.querySelector('.available-countries');
        var suggestView = new ymaps.SuggestView('arrival-input', {results: 3});
        // Предполагая, что у вас есть контейнер с классом "from-arrival-container"
        var fromArrivalContainer = document.querySelector('.from-arrival-container');
        var arrivalInput = document.getElementById('arrival-input');
        var ymapsContainer = fromArrivalContainer.querySelector('ymaps');
        // Добавление обработчиков событий к контейнеру с использованием захватывающей фазы
        fromArrivalContainer.addEventListener('mousemove', function (event) {
            // Проверяем, что текущая цель (target) или родительская цель (parentNode) содержат класс 'ymaps-2-1-79-suggest-item'
            if (
                event.target.classList.contains('ymaps-2-1-79-suggest-item') ||
                (event.target.parentNode && event.target.parentNode.classList.contains('ymaps-2-1-79-suggest-item')) ||
                (event.target.parentNode.parentNode && event.target.parentNode.parentNode.classList.contains('ymaps-2-1-79-suggest-item'))
            ) {
                event.stopPropagation();
                console.log('Your custom mousemove event for ymaps-2-1-79-suggest-item');
            }
        }, true);

        fromArrivalContainer.addEventListener('mouseover', function (event) {
            // Проверяем, что текущая цель (target) или родительская цель (parentNode) содержат класс 'ymaps-2-1-79-suggest-item'
            if (
                event.target.classList.contains('ymaps-2-1-79-suggest-item') ||
                (event.target.parentNode && event.target.parentNode.classList.contains('ymaps-2-1-79-suggest-item')) ||
                (event.target.parentNode.parentNode && event.target.parentNode.parentNode.classList.contains('ymaps-2-1-79-suggest-item'))
            ) {
                event.stopPropagation();
                console.log('Your custom mouseover event for ymaps-2-1-79-suggest-item');
            }
        }, true);
        var preventDetailedSuggest = false;
        fromArrivalContainer.addEventListener('click', function (event) {
            // Проверяем, что текущая цель (target) или родительская цель (parentNode) содержат класс 'ymaps-2-1-79-suggest-item'
            if (
                event.target.classList.contains('ymaps-2-1-79-suggest-item') ||
                (event.target.parentNode && event.target.parentNode.classList.contains('ymaps-2-1-79-suggest-item')) ||
                (event.target.parentNode.parentNode && event.target.parentNode.parentNode.classList.contains('ymaps-2-1-79-suggest-item'))
            ) {
                // Получаем название города и вносим его в поле (замените 'arrival-input' на ваш реальный ID поля)
                event.stopPropagation();
                preventDetailedSuggest = true;
                document.getElementById('arrival-input').value = extractCityName(event.target.innerText || event.target.textContent);
                if (event.target.classList.contains('ymaps-2-1-79-search__suggest-highlight')) {
                    document.getElementById('arrival-input').value = extractCityName(event.target.parentNode.parentNode.innerText || event.target.parentNode.parentNode.textContent);
                }

                console.log('Your custom click event for ymaps-2-1-79-suggest-item');
            }
        }, true);


        arrivalInput.addEventListener('keydown', function (event) {
            // Находим ближайший элемент <ymaps> внутри fromArrivalContainer
            // Проверяем, отображен ли выпадающий список, и предотвращаем стандартное поведение стрелок вверх и вниз
            if (event.key === 'Enter') {
                event.preventDefault();
            }
            countriesContainer.style.display = 'none';
            if (ymapsContainer && window.getComputedStyle(ymapsContainer).display === 'block' && (event.key === 'ArrowDown' || event.key === 'ArrowUp')) {

                event.stopImmediatePropagation();
                console.log('Your custom keydown event for arrow up/down');

                // Добавьте ваш код для изменения стилей подсветки элементов при использовании стрелок
                // Например, вы можете добавить/удалить класс, изменить цвет фона и т.д.
                // Пример:
                var currentHighlightedItem = ymapsContainer.querySelector('.ymaps-2-1-79-suggest-item.highlighted');
                if (currentHighlightedItem) {
                    currentHighlightedItem.classList.remove('highlighted');
                }

                if (event.key === 'ArrowDown') {
                    // Стрелка вниз
                    // Ваш код для подсветки следующего элемента
                    // Пример:
                    var nextItem = currentHighlightedItem ? currentHighlightedItem.nextElementSibling : ymapsContainer.children[0].children[0].children[0].firstElementChild;
                    if (nextItem) {
                        nextItem.classList.add('highlighted');
                        arrivalInput.value = extractCityName(nextItem.innerText || nextItem.textContent);
                    }
                } else if (event.key === 'ArrowUp') {
                    // Стрелка вверх
                    // Ваш код для подсветки предыдущего элемента
                    // Пример:
                    var prevItem = currentHighlightedItem ? currentHighlightedItem.previousElementSibling : ymapsContainer.children[0].children[0].children[0].lastElementChild;
                    if (prevItem) {
                        arrivalInput.value = extractCityName(prevItem.innerText || prevItem.textContent);
                        prevItem.classList.add('highlighted');
                    }
                }

            }
        }, true);

        const config = {attributes: true, attributeFilter: ['style'], childList: true, subtree: true};
        // Создаем экземпляр MutationObserver, который следит за изменениями внутри fromArrivalContainer
        var observer = new MutationObserver(function (mutationsList) {
            for (let mutation of mutationsList) {
                if (mutation.type === 'attributes' && mutation.attributeName === 'style') {
                    // Произошло изменение в атрибуте style
                    let displayValue = window.getComputedStyle(mutation.target).display;
                    // Теперь displayValue содержит текущее значение display
                    // Вы можете добавить условия для применения стилей
                    if (displayValue === 'block' && preventDetailedSuggest) {
                        // Скрыть suggest и сбросить флаг
                        mutation.target.style.display = 'none';
                        preventDetailedSuggest = false;
                    }
                    else if (displayValue === 'block') {
                        arrivalInput.style.borderBottomLeftRadius = '0';
                        arrivalInput.style.borderBottomRightRadius = '0';
                    }
                    else if (displayValue === 'none') {
                        arrivalInput.style.borderBottomLeftRadius = '10px';
                        arrivalInput.style.borderBottomRightRadius = '10px';
                    }
                }
                if (mutation.type === 'childList') {
                    let addedNodes = [...mutation.addedNodes];
                    let match = false;
                    let ymapsContainer = document.querySelector('ymaps');
                    ymapsContainer.style.display = 'none';
                    // Фильтруем добавленные узлы по классам
                    addedNodes.forEach(node => {
                        if (node.nodeType === Node.ELEMENT_NODE) {
                            let classList = Array.from(node.classList);
                            match = classList.some(className => /^ymaps-2-1-79-suggest-item-\d+$/.test(className));
                            if (match) {
                                updateLockIcons(node);
                            }
                        }
                    });
                    ymapsContainer.style.width = '344px';
                    ymapsContainer.style.display = 'block';
                }
            }
        });
        // Начинаем наблюдение за изменениями внутри fromArrivalContainer
        observer.observe(ymapsContainer, config);
        function updateLockIcons(item) {
            let toponym = extractToponymName(item);
            // Пример: используя API Yandex Maps для проверки страны
            ymaps.geocode(toponym, { results: 1 }).then(result => {
                countryGlobal = result.geoObjects.get(0).getCountry();
                if (calcTypeUrl === '/calc-layout/ext_html/cargo_order_data.php' && countryGlobal !== 'Россия' && countryGlobal !== 'Кыргызстан' && countryGlobal !== 'Казахстан') {
                    addLockIcon(item);
                    item.style.pointerEvents = 'none';
                    item.style.background = '#d0a87c';
                }
                else if (calcTypeUrl !== '/calc-layout/ext_html/cargo_order_data.php' && countryGlobal !== 'Россия') {
                    addLockIcon(item);
                    item.style.pointerEvents = 'none';
                    item.style.background = '#d0a87c';
                }
            });
        }
    }
}

function extractToponymName(item) {
    // Получаем все элементы <ymaps> внутри item
    return item.querySelector('ymaps').textContent.trim();
}

function addLockIcon(item) {
    // Создаем элемент с иконкой замка
    const lockIcon = document.createElement('span');
    lockIcon.innerHTML = `<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="6" y="10" width="12" height="8" rx="2" fill="white"/><path d="M9 10V9C9 7.34315 10.3431 6 12 6C13.6569 6 15 7.34315 15 9V10" stroke="white" stroke-width="2"/></svg>`;

    // Добавляем иконку после текущего содержимого
    item.appendChild(lockIcon);
}
