function initializePopupTnvedTree() {
    const suggestionLinks = document.querySelectorAll(".suggestion-link-container");
    const tnvedTreeCloseButton = document.querySelector(".tnved-tree-close-button");

// Окно "Дерево ТН ВЭД"
    const tnvedTreePopup = document.querySelector(".tnved-tree-container");
    const overlay = document.querySelector('.overlay');
// Обработчик клика по ссылке
// Обработчик клика для каждой ссылки
    suggestionLinks.forEach((link) => {
        link.addEventListener("click", (e) => {
            e.stopPropagation();
            const suggestion = link.closest('.suggestion');

            // Добавляем класс "bindingTree" к текущему suggestion
            suggestion.classList.add('bindingTree');
            // Отображаем окно "Дерево ТН ВЭД"
            tnvedTreePopup.style.display = "block";
            overlay.style.display = "block";
            correctLineHeight();
            // Добавляем класс "open" для затемнения фона
            // document.body.classList.add("open");
        });
    });

    tnvedTreeCloseButton.addEventListener("click", () => {
        tnvedTreePopup.style.display = "none";
        overlay.style.display = "none";
    });

// Обработчик клика вне окна "Дерево ТН ВЭД" для закрытия
    document.addEventListener("click", (e) => {
        if (e.target !== tnvedTreePopup && !tnvedTreePopup.contains(e.target)) {
            // Скрываем окно "Дерево ТН ВЭД"
            tnvedTreePopup.style.display = "none";
            overlay.style.display = "none";
            // Убираем класс "open" для убирания затемнения фона
            // document.body.classList.remove("open");
        }
    });


}
// function correctLineHeight() {
//     var treeItems = document.querySelectorAll('li.tnved-tree-item');
//     Array.from(treeItems).forEach(function(currentTreeItem, index, array) {
//         if (index < array.length - 1) {
//             var nextTreeItem = array[index + 1];
//             var treeItemLine = currentTreeItem.querySelector('.tnved-tree-item-line');
//
//             var currentTreeItemHeight = currentTreeItem.clientHeight;
//             var nextTreeItemHeight = nextTreeItem.clientHeight;
//             var lineHeight = (currentTreeItemHeight + nextTreeItemHeight) / 2;
//
//             treeItemLine.style.height = lineHeight + 'px';
//         }
//     });
// }