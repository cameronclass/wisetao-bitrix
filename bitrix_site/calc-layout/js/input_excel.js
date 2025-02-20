
function initializeInputExcel() {
// Функция для инициализации squareOuter и input file
    let selectFile = document.querySelector(".submit-excel-file");
    let excelInput = document.querySelector(".photo-input");
    let fileNameDisplay = document.querySelector(".selected-file-name");
    let deleteFile = document.querySelector('.del-file');
    deleteFile.addEventListener('click', deleteExcelFile);

    excelInput.addEventListener('click', (event) => {
        event.stopPropagation();
    });

    selectFile.addEventListener("click", function (event) {
        event.stopPropagation();
        event.preventDefault();
        excelInput.removeAttribute('disabled');
        excelInput.setAttribute('accept','application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        excelInput.click();
        excelInput.setAttribute('disabled', '');
        event.preventDefault();
        event.stopPropagation();
    });

    excelInput.addEventListener("change", function () {
        excelFile = excelInput.files[0]; // Получаем выбранный файл
        if (excelFile && excelInput.getAttribute('accept') !== 'image/*') {
            if (fileNameDisplay.childNodes.length >= 4 && fileNameDisplay.childNodes[3].nodeType === Node.TEXT_NODE && fileNameDisplay.childNodes[3].nodeValue.trim().length > 1) {
                let newText = document.createTextNode(excelFile.name);
                fileNameDisplay.replaceChild(newText, fileNameDisplay.childNodes[3]);
            }
            if (fileNameDisplay.childNodes.length < 4) {
                fileNameDisplay.append(excelFile.name);
            }
            fileNameDisplay.style.display = "flex";
            disableFields();
        }
    });
}

function deleteExcelFile() {
    excelFile = null;
    let file = document.querySelector('.selected-file-name');
    file.removeChild(file.childNodes[3]);
    file.style.display = "none";
    enableFields();
}