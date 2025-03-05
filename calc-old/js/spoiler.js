function initializeSpoiler() {
    let spoiler = document.querySelector(".boxing-spoiler");
    let spoilerHeader = document.querySelector(".boxing-spoiler-header");
    let spoilerContent = document.querySelector(".boxing-spoiler-content");
    if (spoiler && spoilerHeader && spoilerContent) {
        spoilerContent.style.display = "none";
        const computedStyles = window.getComputedStyle(document.querySelector(".boxing-content-container"));
        let currentHeight = parseInt(computedStyles.height, 10);
        let contentContainer = document.querySelector(".boxing-content-container");
        contentContainer.style.height = currentHeight + 190 + "px";
    }
    // Проверка на существование элементов
    if (spoiler && spoilerHeader && spoilerContent) {
        // Ваш код обработки спойлера
        console.log("All elements found");

        // Добавляем обработчик события для клика на заголовке спойлера
        spoilerHeader.addEventListener("click", function () {
            // Переключаем класс "opened" для спойлера
            spoiler.classList.toggle("opened");

            // Если спойлер открыт, показываем содержимое
            if (spoiler.classList.contains("opened")) {
                spoilerContent.style.display = "flex";
            } else {
                spoilerContent.style.display = "none";
            }
            const computedStyles = window.getComputedStyle(document.querySelector(".boxing-content-container"));
            let currentHeight = parseInt(computedStyles.height, 10);
            let contentContainer = document.querySelector(".boxing-content-container");
            if (spoiler.classList.contains("opened")) {
                contentContainer.style.height = currentHeight + 190 + "px";
            } else {
                contentContainer.style.height = currentHeight - 190 + "px";
            }
        });
    } else {
        console.log("Some elements are missing");
    }
}
