// Получаем все элементы с классом "tnved-toggle-icon"
function initializeTnvedTreeHandling() {
    // Очищаем контейнер tnvedTreeList и удаляем имеющиеся элементы
    var tnvedTreeList = $('.tnved-tree-list');
    tnvedTreeList.empty();
    // Отправляем GET-запрос на получение элементов дерева
    $.get('https://api-calc.wisetao.com:4343/api/get-tree-elems', { parentNode: '' }, function (data) {
        // Очищаем контейнер tnvedTreeList и удаляем имеющиеся элементы
        var $data = $(data);

        // Находим все элементы списка и извлекаем текст
        $data.find('li').each(function () {
            var itemText = $(this).text().trim();
            var dataId = $(this).attr('data-id');
            var treeItem = $('<li class="tnved-tree-item" data-id="' + dataId + '">' +
                '<div class="tnved-tree-item-line"></div>' +
                '<div class="tnved-toggle-icon"></div>' +
                '<span class="tnved-item-text">' + itemText + '</span>' +
                '</li>');
            tnvedTreeList.append(treeItem);
        });
        handleItemHeight();

        var toggleIcons = document.querySelectorAll('.tnved-toggle-icon');
        var subTree;
        // Перебираем полученные элементы и добавляем обработчик события клика
        toggleIcons.forEach(function (icon) {
            icon.addEventListener('click', function () {

                // Находим ближайший родительский элемент .tnved-tree-item
                var parentItem = icon.closest('.tnved-tree-item');
                ajaxGetSubTree(parentItem, icon).catch(() => {});

                // Находим элемент .tnved-sub-tree внутри родительского элемента


            });
        });
    });
    function ajaxLoadSubTreeAndHandle(parentItem) {
        return new Promise((resolve, reject) => {
            if (!parentItem.querySelector('.tnved-sub-tree')) {
                subTree = document.createElement('ul');
                subTree.classList.add('tnved-sub-tree');
                subTree.classList.add('check');
                parentItem.appendChild(subTree);
                var dataId = parentItem.dataset.id;
                $.get('https://api-calc.wisetao.com:4343/api/get-tree-elems', {parentNode: dataId})
                    .done(function (data) {
                        var $data = $(data);
                        $data.find('li').each(function () {
                            var itemText = $(this).contents().filter(function() {
                                return this.nodeType === 3;
                            }).text().trim();
                            dataId = $(this).attr('data-id');
                            var treeItem = $('<li class="tnved-tree-item" data-id="' + dataId + '">' +
                                '<div class="tnved-tree-item-line"></div>' +
                                '<div class="tnved-toggle-icon"></div>' +
                                '<span class="tnved-code">' + $(this).find('.tnved-tree__node-code').text().trim() + '</span>' +
                                '<span class="tnved-item-text">' + itemText + '</span>' +
                                '</li>');
                            // Добавляем элементы в новое поддерево
                            subTree.appendChild(treeItem[0]);
                        });
                        var listItem = $('<li class="tnved-tree-item" style="height: 0;"></li>');
                        subTree.appendChild(listItem[0]);
                        handleItemHeight();
                        resolve(subTree);
                    })
                    .catch(function (error) {
                        reject(error);
                    });
            } else {
                subTree = parentItem.querySelector('.tnved-sub-tree');
                resolve(subTree);
            }
        });
    }

    var commonParent = document.querySelector('.tnved-tree-list');

    commonParent.addEventListener('click', function (event) {
        var target = event.target;

        if (target.classList.contains('tnved-toggle-icon')) {
            var parentItem = target.closest('.tnved-tree-item')

            // Проверьте, есть ли внутри parentItem элемент с классом 'tnved-code'
            if (parentItem) {
                var hasTnvedCode = Array.from(parentItem.childNodes).find(function(node) {
                    return node.classList && node.classList.contains('tnved-code');
                });

                if (hasTnvedCode && hasTnvedCode.textContent.length < 13) {
                    ajaxGetSubTree(parentItem, target).catch(() => {});
                }
            }
        }
    });

    function startLoadingAnimation(icon) {
        // Добавить класс, который отображает анимацию загрузки
        icon.style.animation = 'spin 1s infinite linear';
    }

    function stopLoadingAnimation(icon) {
        // Удалить класс, который отображает анимацию загрузки
        icon.style.animation = '';
    }

    async function ajaxGetSubTree(parentItem, icon) {
        startLoadingAnimation(icon); // Начать анимацию загрузки

        try {
            var subTree = await ajaxLoadSubTreeAndHandle(parentItem);
            stopLoadingAnimation(icon); // Завершить анимацию загрузки

            if (subTree) {
                addClickEvents(subTree, icon, parentItem);
            }
        } catch (error) {
            stopLoadingAnimation(icon); // Завершить анимацию загрузки в случае ошибки
            // Обработка ошибки, если необходимо
        }
    }

    function addClickEvents(subTree, icon, parentItem) {
        subTree.classList.toggle('open'); // Переключаем класс "open" для управления видимостью
        icon.classList.toggle('expanded'); // Переключаем класс "expanded" для управления внешним видом плюсика
        var subTreeHeight = subTree.clientHeight;
        // Находим следующий элемент после родительского и смещаем его
        var siblingItems = parentItem.nextElementSibling;
        if (siblingItems && siblingItems.classList.contains('tnved-tree-item')) {
            currentMarginTop = parseInt(siblingItems.style.marginTop, 10) || 0;
            siblingItems.style.marginTop = subTree.classList.contains('open') ? subTreeHeight + 'px' : '0';
            parentItem.classList.toggle('open');
            changeHeightLine(parentItem, subTreeHeight);
        }

        // Переходим в уровень выше и смещаем первый соседний элемент
        parentItem = customClosest(parentItem, '.tnved-tree-item');
        var subTreeParent;
        while (parentItem !== null) {
            var firstSibling = parentItem.nextElementSibling;
            currentMarginTop = parseInt(firstSibling.style.marginTop, 10) || 0;
            if (firstSibling && firstSibling.classList.contains('tnved-tree-item')) {
                subTreeParent = parentItem.querySelector('.tnved-sub-tree');
                subTreeHeight = subTreeParent.clientHeight;
                firstSibling.style.marginTop = subTreeParent.classList.contains('open') ? subTreeHeight + 'px' : '0';
                changeHeightLine(parentItem, subTreeHeight);
            }
            parentItem = customClosest(parentItem, '.tnved-tree-item');
        }
        hideLines();
        correctLineHeight(subTree);
        var parentTreeItem = subTree.closest('.tnved-tree-item');
        if (parentTreeItem) {
            var parentTreeItemHeight = parentTreeItem.clientHeight;
            subTree.style.marginTop = parentTreeItemHeight + 10 + 'px';
        }
        toggleMinus(subTree);
    }

    let lineHeight = 34;

    function changeHeightLine(parentItem, addHeight) {
        var newHeight = lineHeight + addHeight;
        parentItem.firstElementChild.style.height = newHeight + 'px';
    }

    function customClosest(element, selector) {
        let current = element.parentElement;

        while (current) {
            if (current.matches(selector)) {
                return current;
            }
            current = current.parentElement;
        }

        return null;
    }

    function handleItemHeight() {
        var allItems = $('.tnved-tree-item');

        allItems.each(function () {
            var item = $(this);
            var text = item.find('.tnved-item-text');
            var textHeight = text.outerHeight();
            var lineHeight = parseInt(item.css('line-height'));

            if (textHeight > lineHeight) {
                var additionalHeight = textHeight - lineHeight;
                changeHeightLine(item, additionalHeight);
            }
        });
    }

    function hideLines() {
// Получаем все ul элементы внутри контейнера tnved-tree-list
        var tnvedTreeList = document.querySelector('.tnved-tree-list');

        if (tnvedTreeList) {
            var ulElements = tnvedTreeList.querySelectorAll('ul');

            // Проходимся по каждому ul элементу
            ulElements.forEach(function (ul) {
                // Получаем все дочерние узлы текущего ul
                var childNodes = ul.childNodes;

                // Фильтруем только li элементы из дочерних узлов
                var liElements = Array.from(childNodes).filter(function (node) {
                    return node.nodeName === 'LI';
                });

                // Проверяем, что у текущего ul есть как минимум два li элемента
                if (liElements.length >= 2) {
                    // Находим предпоследний li элемент
                    var penultimateLi = liElements[liElements.length - 2];

                    // Находим вложенный tnved-tree-item-line элемент и делаем его невидимым
                    var tnvedTreeItemLine = penultimateLi.querySelector('.tnved-tree-item-line');

                    if (tnvedTreeItemLine) {
                        tnvedTreeItemLine.style.display = 'none';
                    }
                }
            });
        }
    }

    function toggleMinus(subTree) {
        // Получаем все ul.tnved-sub-tree
        const tnvedTreePopup = document.querySelector(".tnved-tree-container");
        const overlay = document.querySelector('.overlay');
        var treeItems = Array.from(subTree.childNodes).filter(function (child) {
            return child.nodeName === 'LI' && child.classList.contains('tnved-tree-item');
        });
        // Если внутри ul.tnved-sub-tree ровно два элемента li, добавляем класс expanded к первому элементу
        Array.from(treeItems).forEach(function (currentTreeItem) {
            var tnvedCodeNode = Array.from(currentTreeItem.childNodes).find(function (child) {
                return child.classList && child.classList.contains('tnved-code');
            });

            var tnvedNameNode = Array.from(currentTreeItem.childNodes).find(function (child) {
                return child.classList && child.classList.contains('tnved-item-text');
            });

            var tnvedToggleIconNode = Array.from(currentTreeItem.childNodes).find(function (child) {
                return child.classList && child.classList.contains('tnved-toggle-icon');
            });

            if (tnvedCodeNode && tnvedCodeNode.textContent.length === 13 && tnvedToggleIconNode) {
                tnvedToggleIconNode.classList.add('expanded');
                tnvedCodeNode.style.cursor = 'pointer';
                tnvedCodeNode.addEventListener('click', function () {
                    var suggestion = document.querySelector('.suggestion.bindingTree');
                    // Если suggestion найден, найдите внутри него input с классом '.tnved-input'
                    if (suggestion) {
                        var input = suggestion.parentElement.parentElement.children[1].querySelector('.tnved-input');

                        // Если input найден, добавьте код в input


                        // Удалите класс "bindingTree" у связанного suggestion
                        suggestion.classList.remove('bindingTree');
                        tnvedTreePopup.style.display = "none";
                        overlay.style.display = "none";
                        var suggestionInput = suggestion.previousElementSibling;
                        var event = new Event('input', {
                            bubbles: true, // Разрешить всплытие события (по умолчанию true)
                            cancelable: true // Разрешить отмену события (по умолчанию true)
                        });
                        suggestionInput.value = '';
                        suggestionInput.setAttribute('placeholder', tnvedNameNode.textContent);
                        // Вызовите событие input на элементе
                        suggestionInput.dispatchEvent(event);

                        if (input) {
                            input.value = tnvedCodeNode.textContent;
                            input.dispatchEvent(event);
                        }
                    }
                    // Вставить код в input и удалить класс bindingTree у связанного suggestion
                    // Здесь можно разместить код из предыдущего сообщения
                });
            }
        });
    }

    function correctLineHeight(subTree) {
        if (!subTree.classList.contains('corrected')) {
            subTree.classList.add('corrected');
            var treeItems = Array.from(subTree.childNodes).filter(function (child) {
                return child.nodeName === 'LI' && child.classList.contains('tnved-tree-item');
            });
            Array.from(treeItems).forEach(function (currentTreeItem, index, array) {
                if (index < array.length - 1) {
                    var nextTreeItem = array[index + 1];
                    var treeItemLine = currentTreeItem.querySelector('.tnved-tree-item-line');

                    var currentTreeItemHeight = currentTreeItem.clientHeight;
                    var nextTreeItemHeight = nextTreeItem.clientHeight;
                    var lineHeight = (currentTreeItemHeight + nextTreeItemHeight) / 2 + 10;

                    treeItemLine.style.height = lineHeight + 'px';
                    treeItemLine.style.top = currentTreeItemHeight / 2 + 'px';
                }
            });
        }
    }
}

function destroyTnvedTree() {
    document.querySelector('.tnved-tree-container').innerHTML = '';
}