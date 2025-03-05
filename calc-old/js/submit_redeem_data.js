function initializeSubmitRedeemData() {
    $('#submit-redeem-data:not(.submit-excel-file)').on('click', submitRedeemData);
    $('.blank-excel-file').on('click', downloadRedeemBlank);
}

async function submitRedeemData(blobOffer = null) {
    let isAttached = !!document.querySelector('.selected-file-name')?.childNodes[3];
    let isValid = false;
    if (!isAttached) {
        isValid = validateFields();
    }
    // Если все поля заполнены, выполняем AJAX-запрос
    let blobRedeem = false;
    if (isValid || isAttached || blobOffer) {
        blobRedeem = await sendRedeemData(isValid, isAttached, blobOffer);
    } else {
        console.log('Заполните все поля перед отправкой.');
    }
    return blobRedeem;
}

function disableFields() {
    let $redeemData = $('.redeem-data');
    let $inputs = $redeemData.find('.redeem-input, .redeem-currency-input, .redeem-count, .redeem-size, .redeem-color, .photo-input');
    $inputs.each(function () {
        $(this).attr('disabled', '');
        $(this).css('border', 'none');
    });
    $('.redeem-square-outer').each(function () {
        $(this).css('cursor', 'default');
        $(this).css('background', 'gray');
        this.closest('.redeem-square-outer').style.border = '3px dashed #8c8f95';
    });

    $redeemData.each(function () {
        $(this).find('.input-notice').each(function () {
            $(this).css('display', 'none');
        });
        $(this).find('.dropdown.redeem-currency').each(function () {
            $(this).css('background', 'gray');
        });
        $(this).find('.dropdown-toggle').each(function () {
            $(this).css('background', 'gray');
        });
        $(this).find('.custom-input-addon').each(function () {
            $(this).css('background', 'gray');
        });
    })
    let buttonRedeemAdd = $('.add-container.redeem-add').first();
    let buttonRedeemAddElem = $('.add-container.redeem-add .add-button').first();
    buttonRedeemAdd.css('pointer-events', 'none');
    buttonRedeemAddElem.css('pointer-events', 'none');
    buttonRedeemAdd.addClass('disabled');
    buttonRedeemAddElem.addClass('disabled');
}

function enableFields() {
    let $redeemData = $('.redeem-data');
    let $inputs = $redeemData.find('.redeem-input, .redeem-currency-input, .redeem-count, .redeem-size, .redeem-color, .photo-input');
    $inputs.each(function () {
        $(this).removeAttr('disabled');
    });

    $('.redeem-square-outer').each(function () {
        $(this).css('cursor', 'pointer');
        $(this).css('background', '#1a212d');
    });

    $redeemData.each(function () {
        $(this).find('.dropdown.redeem-currency').each(function () {
            $(this).css('background', '#5a667d');
        });
        $(this).find('.dropdown-toggle').each(function () {
            $(this).css('background', '#5a667d');
        });
        $(this).find('.custom-input-addon').each(function () {
            $(this).css('background', '#2f3743');
        });
    })
    let buttonRedeemAdd = $('.add-container.redeem-add').first();
    let buttonRedeemAddElem = $('.add-container.redeem-add .add-button').first();
    buttonRedeemAdd.css('pointer-events', 'all');
    buttonRedeemAddElem.css('pointer-events', 'all');
    buttonRedeemAdd.removeClass('disabled');
    buttonRedeemAddElem.removeClass('disabled');
}

function validateFields() {
    let isValid = true;
    let $redeemData = $('.redeem-data');
    let $inputs = $redeemData.find('.js-validate-num, .redeem-input');
    $inputs.each(function () {
        if ($(this).val() === '') {
            isValid = false;
            return false; // Прерываем цикл, если хотя бы одно поле не заполнено
        }
    });

    $('.selected-photo').each(function () {
        if (!$(this).attr('src')) {
            isValid = false;
            this.closest('.redeem-square-outer').style.border = '3px dashed red';
            return false; // Прерываем цикл, если хотя бы одна картинка не выбрана
        }
    });
    if (!isValid) {
        // Если есть хотя бы одно незаполненное поле, вызываем validateValue для всех
        $inputs.each(function () {
            validateValue(this);
        });
    }
    return isValid;
}

async function sendRedeemData(isValid, isAttached, blobOffer = null) {
    let redeemData = gatherRedeemData(isValid, isAttached);
    if (redeemData) {
        if (isAttached && redeemData instanceof FormData) {
            // Если это FormData, добавляем дополнительные параметры
            redeemData.append('SITE_ID', 's3');
            redeemData.append('sessid', BX.message('bitrix_sessid'));
        } else {
            // Если это обычные данные, добавляем их как свойства объекта
            Object.assign(redeemData, {
                SITE_ID: 's3',
                sessid: BX.message('bitrix_sessid')
            });
        }
    }
    let query = {
        action: isValid ? 'telegram:document.api.RedeemDataController.export_redeem_data' :
            'telegram:document.api.RedeemDataController.export_received_excel_redeem_data'
    };

    let options = {
        type: 'POST',
        url: '/bitrix/services/main/ajax.php?' + $.param(query),
        data: redeemData,
        xhrFields: {
            responseType: 'blob' // Устанавливаем ожидание бинарных данных
        },
    }

    if (isAttached) {
        Object.assign(options, {
            processData: false,
            contentType: false,
        });
    }
    let blobRedeemFile;
    let clientPhone = document.querySelector('input[name="client-phone"]')?.value;
    return new Promise((resolve, reject) => {
        $.ajax(
            options,
        ).then(function (blobRedeem) {

            console.log('Данные успешно отправлены:');
            blobRedeemFile = blobRedeem;
            resolve(blobRedeem);
        }).catch(function (error) {
            blobRedeemFile = { error: error };
            reject({ error: error });
        }).always(function() {
            clearInterval(countdownTimer);
            hideModal();
            if (blobOffer) {
                sendFileToBitrix(blobRedeemFile, blobOffer)
                    .then((links) => {
                        setTimeout(() => {
                            createClientActivity(
                                document.querySelector('input[name="client-phone"]').value
                            );
                        }, 2000);
                    })
                    .catch((error) => {
                        console.error('Ошибка при отправке файлов:', error);
                    });
                sendOfferToBitrix24(blobOffer, clientPhone);
            }
            return blobRedeemFile;
        });
    });
}

function sendOfferToBitrix24(offer, clientPhone) {
    if (offer) {
        let formData = new FormData();
        formData.append('OFFER', new File([offer], 'Коммерческое предложение.pdf', { type: offer.type }));
        formData.append('phone', clientPhone);
        formData.append('SITE_ID', 's3');
        formData.append('sessid', BX.message('bitrix_sessid'));

        let query = {
            action: 'telegram:document.api.OrderDataController.send_offer_to_deal_bitrix24'
        };

        let options = {
            type: 'POST',
            url: '/bitrix/services/main/ajax.php?' + $.param(query),
            data: formData,
            processData: false, // Не обрабатывать данные
            contentType: false, // Не устанавливать заголовок contentType
            dataType: 'json', // Ожидаем ответ в формате JSON
        };

        $.ajax(options)
            .then(function (response) {
                console.log('Файл успешно отправлен:', response);
                return response;
            })
            .catch(function (error) {
                console.error('Ошибка при отправке файла:', error);
                return {error: error};
            })
            .always(function () {

            });
    }
}

function gatherRedeemData(isValid, isAttached) {
    if (isValid && !isAttached) {
        let redeemData = [];
        $('.redeem-data .redeem-data-one').each(function () {
            let photo = $(this).find('.selected-photo').attr('src');
            let name = $(this).find('.redeem-name-input').val();
            let cost = $(this).find('.redeem-currency-input').val();
            // let deliveryChina = $(this).find('.redeem-currency-china-input').val();
            let quantity = $(this).find('.redeem-count').val();
            let link = $(this).find('.redeem-url-input').val();
            let size = $(this).find('.redeem-size').val();
            let color = $(this).find('.redeem-color').val();
            let note = $(this).find('.redeem-note').val();
            let currency = $(this).find('.dropdown.redeem-currency .dropdown-toggle').contents().first().text();
            // let currencyChina = $(this).find('.dropdown.redeem-currency.redeem-currency-china .dropdown-toggle-china').contents().first().text();
            redeemData.push({
                photo: photo,
                name: name,
                cost: cost,
                // delivery_china: deliveryChina,
                quantity: quantity,
                link: link,
                size: size,
                color: color,
                note: note,
                currency: currency,
                // currency_china: currencyChina,
            });
        });
        return {
            data: redeemData,
        };
    }
    else if (isAttached && excelFile) {
        let formData = new FormData();
        formData.append('file', excelFile);
        return formData;
    }

}

async function sendFileToBitrix(blobRedeem, blobOffer) {
    let form = document.getElementById('SIMPLE_FORM_3');

    // Удаляем предыдущие input file, если они есть
    const inputFiles = form.querySelectorAll('input[type="file"]');
    inputFiles.forEach(input => form.removeChild(input));

    // Создаем input file
    let inputFileRedeem = document.createElement('input');
    inputFileRedeem.type = 'file';
    inputFileRedeem.name = 'form_file_9';
    inputFileRedeem.style.display = 'none';

    let inputFileOffer = document.createElement('input');
    inputFileOffer.type = 'file';
    inputFileOffer.name = 'form_file_10';
    inputFileOffer.style.display = 'none';

    // let inputName = document.createElement('input');
    // inputName.type = 'text';
    // inputName.name = 'form_text_12';
    // inputName.style.display = 'none';
    // inputName.value = document.querySelector('input[name="client-name"]').value;

    let inputPhone = document.createElement('input');
    inputPhone.type = 'text';
    inputPhone.name = 'form_text_13';
    inputPhone.style.display = 'none';
    inputPhone.value = document.querySelector('input[name="client-phone"]').value;

    // Создаем кнопку submit
    let submitButton = document.createElement('button');
    submitButton.type = 'submit';
    submitButton.name = 'web_form_submit';
    submitButton.value = 'Отправить данные о выкупе';
    submitButton.style.display = 'none'; // Скрываем кнопку

    // Добавляем элементы в форму
    form.appendChild(inputFileOffer);
    form.appendChild(inputFileRedeem);
    form.appendChild(inputName);
    form.appendChild(inputPhone);
    form.appendChild(submitButton);

    let dataTransferOffer = new DataTransfer();
    let dataTransferRedeem = new DataTransfer();
    // Создаем File объект из Blob и помещаем его в input file

    if (!blobRedeem?.error) {
        let fileRedeem = new File([blobRedeem], 'Данные для выкупа заказа.xlsx', {type: blobRedeem.type});
        dataTransferRedeem.items.add(fileRedeem);
        inputFileRedeem.files = dataTransferRedeem.files;
    }

    let fileOffer = new File([blobOffer], 'КП.pdf', { type: blobOffer.type });
    dataTransferOffer.items.add(fileOffer);
    inputFileOffer.files = dataTransferOffer.files;

    submitButton.click();
}

function createClientActivity(phone) {
    if (phone) {
        let clientData =
            {
                PHONE: phone,
            };

        if (clientData) {
            // Добавляем дополнительные параметры
            clientData.SITE_ID = 's3';
            clientData.sessid = BX.message('bitrix_sessid');
        }

        // Формируем запрос
        let query = {
            action: 'telegram:document.api.RedeemDataController.create_client_activity' // Один маршрут на create_clientAction
        };

        // Опции для AJAX
        let options = {
            type: 'POST',
            url: '/bitrix/services/main/ajax.php?' + $.param(query),
            data: clientData,
            dataType: 'json', // Ожидаем ответ в формате JSON
        };

        // Выполняем AJAX-запрос
        $.ajax(options)
            .then(function (response) {
                console.log('Данные успешно отправлены:', response);
                return response;
            })
            .catch(function (error) {
                console.error('Ошибка при отправке данных:', error);
                return {error: error};
            })
            .always(function () {
                // Действия, которые нужно выполнить всегда, например, скрытие модального окна
            });
    }
}

function downloadRedeemBlank() {
    let query = {
        action: 'telegram:document.api.RedeemDataController.download_redeem_blank'
    };

    let options = {
        type: 'POST', // Используем POST-запрос
        url: '/bitrix/services/main/ajax.php?' + $.param(query),
        data: {
            sessid: BX.message('bitrix_sessid')
        },
        xhrFields: {
            responseType: 'blob'
        }
    };

    $.ajax(options)
        .then(function (response, status, xhr) {
            let filename = getFilenameFromContentDisposition(xhr.getResponseHeader('Content-Disposition'));
            let blob = new Blob([response], { type: xhr.getResponseHeader('Content-Type') });
            let link = document.createElement('a');
            link.href = window.URL.createObjectURL(blob);
            link.download = filename || 'downloaded_file.xlsx'; // Имя файла или дефолтное имя
            link.click();
        })
        .catch(function (error) {
            console.error('Ошибка при скачивании файла:', error);
        })
        .always(function () {

        });
}

function getFilenameFromContentDisposition(header) {
    let filename = "";
    if (header && header.indexOf('attachment') !== -1) {
        let filenameRegex = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/;
        let matches = filenameRegex.exec(header);
        if (matches != null && matches[1]) {
            filename = matches[1].replace(/['"]/g, ''); // Удаляем кавычки
        }
    }
    return filename;
}
