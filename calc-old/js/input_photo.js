
function initializeInputPhoto() {
// Функция для инициализации squareOuter и input file
    function initializeSquareOuter(container) {
        let squareOuter = container.querySelector(".redeem-square-outer");
        let squareOuterPlus = container.querySelector(".redeem-inner-square-plus");
        let squareOuterMinus = container.querySelector(".redeem-inner-square-minus");
        let photoInput = container.querySelector(".photo-input");

        let selectedPhoto = container.querySelector(".selected-photo");

        squareOuter.addEventListener("click", function () {
            photoInput.setAttribute('accept','image/*');
            photoInput.click();
        });

        squareOuterMinus.addEventListener('click', (event) => {
            event.stopPropagation();
            deletePhoto(selectedPhoto, squareOuterPlus, squareOuterMinus);
        });

        photoInput.addEventListener("change", function () {
            let selectedFile = photoInput.files[0];
            if (selectedFile && photoInput.getAttribute('accept') === 'image/*') {
                let reader = new FileReader();
                reader.onload = function (e) {
                    selectedPhoto.src = e.target.result;
                    selectedPhoto.style.display = "block";
                    squareOuterMinus.style.display = 'flex';
                    squareOuterPlus.style.display = 'none';
                    squareOuter.style.border = '3px dashed #8c8f95';
                };
                reader.readAsDataURL(selectedFile);
            }
        });

        photoInput.classList.add("initialized");
        selectedPhoto.classList.add("initialized");
    }

// Создаем MutationObserver
    let observer = new MutationObserver(function (mutationsList) {
        mutationsList.forEach(function (mutation) {
            if (mutation.type === "childList" && mutation.addedNodes.length > 0 && !mutation.target.classList.contains('suggestion')) {
                mutation.addedNodes.forEach(function (node) {
                    if (node.nodeType === 1 && node.classList.contains("redeem-data-one")) {
                        // Инициализируем только новые контейнеры, у которых нет класса initialized
                        if (!node.querySelector(".photo-input.initialized")) {
                            initializeSquareOuter(node);
                        }
                    }
                });
            }
        });
    });

// Начинаем наблюдение за изменениями в DOM
    observer.observe(document.body, {childList: true, subtree: true});

// Вызываем инициализацию для существующих контейнеров при загрузке страницы
    let containers = document.querySelectorAll(".redeem-data-one");
    containers.forEach(function (container) {
        initializeSquareOuter(container);
    });
}

function deletePhoto(selectedPhoto, squareOuterPlus, squareOuterMinus) {
    selectedPhoto.src = '';
    selectedPhoto.style.display = "none";
    squareOuterMinus.style.display = 'none';
    squareOuterPlus.style.display = 'flex';
}