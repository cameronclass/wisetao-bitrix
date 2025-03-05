let suggestionItems;

function initializeSuggestion() {
    let inputField = document.querySelector('#name-good-input');
    suggestionItems = document.querySelectorAll('.suggestion-item');
    addEventSuggestion(inputField);


}

function correctLineHeight() {
    let treeItems = document.querySelectorAll('li.tnved-tree-item');
    Array.from(treeItems).forEach(function(currentTreeItem, index, array) {
        if (index < array.length - 1) {
            let nextTreeItem = array[index + 1];
            let treeItemLine = currentTreeItem.querySelector('.tnved-tree-item-line');

            let currentTreeItemHeight = currentTreeItem.clientHeight;
            let nextTreeItemHeight = nextTreeItem.clientHeight;
            let lineHeight = (currentTreeItemHeight + nextTreeItemHeight) / 2 + 10;

            treeItemLine.style.height = lineHeight + 'px';
            treeItemLine.style.top = currentTreeItemHeight / 2 + 'px';
        }
    });
}

function addEventSuggestion(inputField) {
    // Находим соседний элемент .suggestion
    const suggestionContainer = inputField.nextElementSibling;
    let markers = inputField.previousElementSibling.querySelectorAll('.marker');
    let clock = inputField.previousElementSibling;
    // Клонируем .suggestion-item и вставляем в .suggestion
    const suggestionItemTemplate = suggestionItems[0].cloneNode(true); // Клонируем первый элемент
    document.querySelectorAll('.suggestion').forEach((suggest) => {
        suggest.innerHTML = '';
    });

    const tnvedTreePopup = document.querySelector(".tnved-tree-container");
    const overlay = document.querySelector('.overlay');
    let isCorrected = false;

    let debounceTimer;
    const debounceDelay = 2000;

    function toggleAnimation(isAnimationEnabled) {

        markers.forEach((marker) => {
            marker.style.animationPlayState = isAnimationEnabled ? 'running' : 'paused';
            marker.style.display = isAnimationEnabled ? 'block' : 'none';
        });

        clock.style.display = isAnimationEnabled ? 'block' : 'none';
    }

    inputField.addEventListener('input', function () {
        let inputText = this.value;

        if (inputText.length >= 3) {
            toggleAnimation(true);
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => {
                // Очищаем предыдущие suggestion, если они есть
                suggestionContainer.innerHTMLhtml = '';
                document.querySelectorAll('.suggestion').forEach((suggest) => {
                    suggest.innerHTML = '';
                });

                // Отправляем GET-запрос на указанный URL
                let apiUrl = 'https://api-calc.wisetao.com:4343/api/get-matching-names?good_name=' + inputText;
                $.get(apiUrl, function (data) {
                    $.each(data, function (index, item) {
                        // Клонируем suggestion-item из шаблона
                        let suggestionItem = suggestionItemTemplate.cloneNode(true);

                        // Заполняем элементы внутри клонированного suggestion-item

                        let suggestionCode = suggestionItem.querySelector('.suggestion-code');
                        let suggestionName = suggestionItem.querySelector('.suggestion-name');
                        suggestionCode.innerText = item.CODE;
                        suggestionName.innerText = item.KR_NAIM + ' ' + item.probability;
                        let suggestions = [suggestionCode, suggestionName];
                        suggestions.forEach((suggestionButton) => {
                            suggestionButton.addEventListener('click', function(e) {
                                let input = suggestionContainer.parentElement.parentElement.parentElement.querySelector('.tnved-input');

                                let suggestionInput = suggestionContainer.previousElementSibling;
                                let event = new Event('input', {
                                    bubbles: true, // Разрешить всплытие события (по умолчанию true)
                                    cancelable: true // Разрешить отмену события (по умолчанию true)
                                });
                                suggestionInput.value = '';
                                suggestionInput.setAttribute('placeholder', item.KR_NAIM);
                                // Вызовите событие input на элементе
                                suggestionInput.dispatchEvent(event);

                                if (input) {
                                    input.value = suggestionCode.textContent;
                                    input.dispatchEvent(event);
                                }
                            });
                        });
                        // Добавляем клонированный suggestion-item в контейнер
                        suggestionContainer.appendChild(suggestionItem);
                        suggestionContainer.insertAdjacentHTML('beforeend', '<div class="suggestion-divider"></div>');
                    });
                    // Добавляем событие клика на suggestion-link-container
                    let suggestionLinkContainers = suggestionContainer.querySelectorAll('.suggestion-link-container');
                        suggestionLinkContainers.forEach((suggestionLinkContainer) => {
                            suggestionLinkContainer.addEventListener('click', function(e) {
                            e.stopPropagation();
                            const link = this; // В переменной link будет ссылка на элемент, на который был клик

                            const suggestion = link.closest('.suggestion');

                            // Добавляем класс "bindingTree" к текущему suggestion
                            suggestion.classList.add('bindingTree');
                            // Отображаем окно "Дерево ТН ВЭД"
                            tnvedTreePopup.style.display = 'block';
                            overlay.style.display = 'block';
                            if (!isCorrected) {
                                correctLineHeight();
                                isCorrected = true; // Устанавливаем флаг в true после первого вызова
                            }
                        });
                    });
                    if (suggestionContainer.childElementCount === 0) {
                        let suggestionItem = suggestionItemTemplate.cloneNode(true);
                        suggestionItem.removeChild(suggestionItem.lastChild);
                        suggestionItem.removeChild(suggestionItem.lastChild);
                        suggestionItem.removeChild(suggestionItem.lastChild);
                        suggestionItem.removeChild(suggestionItem.lastChild);
                        suggestionItem.removeChild(suggestionItem.lastChild);
                        suggestionItem.removeChild(suggestionItem.firstChild);
                        suggestionItem.firstChild.removeChild(suggestionItem.firstChild.firstChild);
                        suggestionItem.firstChild.removeChild(suggestionItem.firstChild.firstChild);
                        suggestionItem.firstChild.removeChild(suggestionItem.firstChild.firstChild);
                        suggestionItem.firstChild.removeChild(suggestionItem.firstChild.lastChild);
                        suggestionItem.firstChild.innerText = 'Ничего не найдено';
                        suggestionContainer.appendChild(suggestionItem);
                    }
                    // Показываем suggestion
                    suggestionContainer.style.display = 'block';
                    inputField.classList.add('straight-bottom');
                    // Выключаем анимацию и скрываем элементы с анимацией
                    toggleAnimation(false);
                }).catch(function (error) {
                    console.error('Ошибка при выполнении запроса: ', error);
                });
            }, debounceDelay);
        } else {
            // Скрываем suggestion
            // Выключаем анимацию и скрываем элементы с анимацией
            toggleAnimation(false);
            suggestionContainer.style.display = 'none';
            inputField.classList.remove('straight-bottom');
        }
    });
}