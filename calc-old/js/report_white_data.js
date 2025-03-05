// Функция для клонирования и обновления контейнера
let isDataReceived;
let items = [];

function initializeReportWhiteData() {
    let reportWhiteDataButtons = document.querySelectorAll('.report-white-data:not(.offer-button-white):not(.offer-button-comparison):not(.offer-button)');
    reportWhiteDataButtons.forEach( function (button) {
        button.addEventListener('click', function (event) {
            event.preventDefault();
            reportWhiteData(event);
            event.preventDefault();
        });
    })
}

function reportWhiteData(event) {
    event.stopPropagation();
    if(isDataReceived) {
        $.ajax({
            url: 'https://api-calc.wisetao.com:4343/api/get-tnved-calculation-file',
            type: 'POST',
            data: {
                'items': items,
            },
            success: function (response) {
                let mimeType = "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet";
                let a = document.createElement("a");
                document.body.appendChild(a);
                a.style.display = "none";
                a.href = 'data:' + mimeType + ';base64,'+ response;
                a.download = `white-data.xlsx`;
                a.click();
                a.remove();
            },
            error: function (error) {
                console.error('Ошибка при выполнении запроса: ', error);
            }
        });
    }
    event.stopPropagation();
}
