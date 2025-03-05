

function initializeCalcVolume() {
    // const orderDataDimensions = document.querySelector('.order-data-dimensions');
    // const lengthInput = orderDataDimensions.querySelector('.length');
    // const widthInput = orderDataDimensions.querySelector('.width');
    // const heightInput = orderDataDimensions.querySelector('.height');
    // const resultSpan = orderDataDimensions.querySelector('.result');
    // lengthInput.addEventListener('input', function(event) {
    //     updateResult(lengthInput, widthInput, heightInput, resultSpan, event)
    // });
    // widthInput.addEventListener('input', function(event) {
    //     updateResult(lengthInput, widthInput, heightInput, resultSpan, event)
    // });
    // heightInput.addEventListener('input', function(event) {
    //     updateResult(lengthInput, widthInput, heightInput, resultSpan, event)
    // });
}




// Функция для обновления результата
function updateResult(lengthInput, widthInput, heightInput, resultSpan, event) {
    // Получаем значения из полей ввода
    const lengthValue = parseFloat(lengthInput.value.replace(/,/g, '.')) / 100 || 0;
    const widthValue = parseFloat(widthInput.value.replace(/,/g, '.')) / 100 || 0;
    const heightValue = parseFloat(heightInput.value.replace(/,/g, '.')) / 100 || 0;

    // Вычисляем произведение значений

    // Обновляем текст в элементе результата
    resultSpan.textContent = lengthValue * widthValue * heightValue;

    if (parseFloat(resultSpan.textContent) !== 0) {
        resultSpan.textContent = (lengthValue * widthValue * heightValue).toFixed(3);
    }
}

// Добавляем обработчики событий для полей ввода
