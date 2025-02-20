// Type of Goods

let ajax_form_inc;
let listenerInitializeToggle = [];
let listenerInitializeTypeOfGoodsValues = [];
let listenerInitializeTypeOfGoodsItems = [];
let listenerInitializeDropdownList = [];
let listenerInitializeDocument = [];
let reviewDropdownToggle;
let reviewFormListsDropdowns;

let expandButtons;
let ajax_reviews_inc;
let listenerInitializeExpandButtons = [];
let reviewsItem;

let answersText, questionsText;
let FAQItemsList;
let ajax_FAQ_inc;
let listenerInitializeFAQItems = [];
let askPanelCloseButton;
let askPanel;
let ajax_ask_inc;
let listenerInitializeAskClose;
let listenerInitializeAskPanelFormSubmit;
let askPanelForm;

let questionBlock;
let ajax_question_inc;
let listenerInitializeQuestionBlockFormSubmit;
let datasetAskInc;

let questionInputsNotice;
let questionBlockForm;
let questionInputs;
let listenerInitializeQuestionInputsInput = [];
let listenerInitializeQuestionInputsBlur = [];

let orderServiceInputsNotice;
let orderServiceBlockForm;
let orderServiceInputs;
let orderServiceButton;
let listenerInitializeOrderServiceInputsInput = [];
let listenerInitializeOrderServiceInputsBlur = [];


document.addEventListener('DOMContentLoaded', function () {
    reviewFormListsDropdowns = document.querySelectorAll('.review-form-lists-dropdown');
    reviewDropdownToggle = document.querySelector('.review-form-lists-dropdown-toggle');
    if (reviewDropdownToggle) {
        ajax_form_inc = reviewDropdownToggle.dataset.ajax_form_inc;
    }
    expandButtons = document.querySelectorAll('.reviews__item_more');
    reviewsItem = document.querySelector('.reviews__items');
    if (reviewsItem) {
        ajax_reviews_inc = reviewsItem.dataset.ajax_reviews_inc;
    }

    answersText = document.querySelectorAll(".accordion-js__item");
    questionsText = document.querySelectorAll(".accordion-js__head");

    FAQItemsList = document.querySelector('.accordion-js__list');
    if (FAQItemsList) {
        ajax_FAQ_inc = FAQItemsList.dataset.ajax_FAQ_inc;
    }

    askPanelCloseButton = document.querySelector(".js-ask-close");
    askPanel = document.querySelector(".ask-panel");
    if (askPanelCloseButton) {
        ajax_ask_inc = askPanelCloseButton.dataset.ajax_ask_inc;
    }

    questionBlock = document.querySelector(".question-block__submit");
    if (questionBlock) {
        ajax_question_inc = questionBlock.dataset.ajax_question_inc;
    }

    questionBlockForm = document.querySelector('.question-block__form');
    if (questionBlockForm) {
        questionInputsNotice = questionBlockForm.querySelectorAll('.input-form__notice');
        questionInputs = questionBlockForm.querySelectorAll('.question-block__form_input');
    }

    orderServiceBlockForm = document.querySelector('.ask-panel__form');
    if (orderServiceBlockForm) {
        orderServiceInputsNotice = orderServiceBlockForm.querySelectorAll('.input-form__notice');
        orderServiceInputs = orderServiceBlockForm.querySelectorAll('.order-service__form_input');
        datasetAskInc = orderServiceBlockForm.parentElement.parentElement.querySelector('.js-ask-close');
        orderServiceButton = orderServiceBlockForm.parentElement.parentElement.querySelector('button[name="web_form_submit"]');
    }
});

function initializeDropDownLists() {

    reviewFormListsDropdowns = document.querySelectorAll('.review-form-lists-dropdown');

    function initializeDropdownList(dropdown, key) {
        const reviewDropdownToggle = dropdown.querySelector('.review-form-lists-dropdown-toggle');
        const dropdownList = dropdown.querySelector('.review-form-lists-dropdown-list');
        const typeOfGoodsValues = dropdown.querySelectorAll('.review-form-lists-values');
        const typeOfGoodsItems = dropdown.querySelectorAll('.review-form-lists-dropdown-list li');

        function updateCurrency(sign) {
            reviewDropdownToggle.textContent = reviewDropdownToggle.dataset.typelist + sign.textContent;
            document.querySelector(`input[name="${reviewDropdownToggle.dataset.input_name}"]`).value = sign.dataset.id_topic;
            if (reviewDropdownToggle.dataset.input_name_additionaly) {
                document.querySelector(`input[name="${reviewDropdownToggle.dataset.input_name_additionaly}"]`).value = sign.textContent;
            }
            dropdownList.classList.remove('active');
            reviewDropdownToggle.style.borderBottomRightRadius = '10px';
            reviewDropdownToggle.style.borderBottomLeftRadius = '10px';
            dropdown.style.borderBottomRightRadius = '10px';
            dropdown.style.borderBottomLeftRadius = '10px';
        }


        //Инициализация элемента с выбранным значением
        function initializeToggle() {
            dropdownList.classList.toggle('active');
            if (dropdownList.classList.contains('active')) {
                reviewDropdownToggle.style.borderBottomRightRadius = 0;
                reviewDropdownToggle.style.borderBottomLeftRadius = 0;
                dropdown.style.borderBottomRightRadius = 0;
                dropdown.style.borderBottomLeftRadius = 0;
            } else {
                reviewDropdownToggle.style.borderBottomRightRadius = '10px';
                reviewDropdownToggle.style.borderBottomLeftRadius = '10px';
                dropdown.style.borderBottomRightRadius = '10px';
                dropdown.style.borderBottomLeftRadius = '10px';
            }
        }
        if (typeof listenerInitializeToggle[key] === 'undefined' || ajax_form_inc < reviewDropdownToggle.dataset.ajax_form_inc) {
            listenerInitializeToggle[key] = initializeToggle;
        }
        reviewDropdownToggle.addEventListener('click', listenerInitializeToggle[key]);


        //Инициализация span'ов со значениями списка
        function initializeTypeOfGoodsValues(event) {
            event.stopPropagation();
            updateCurrency(event.target);
        }
        if (typeof listenerInitializeTypeOfGoodsValues[key] === 'undefined' || ajax_form_inc < reviewDropdownToggle.dataset.ajax_form_inc) {
            listenerInitializeTypeOfGoodsValues[key] = initializeTypeOfGoodsValues;
        }
        typeOfGoodsValues.forEach(function (value) {
            value.addEventListener('click', listenerInitializeTypeOfGoodsValues[key]);
        });


        //Инициализация элементов списка
        function initializeTypeOfGoodsItems(event) {
            event.stopPropagation();
            let value;
            const item = event.currentTarget;
            if (!item.closest('ul').classList.contains('delivery-types-list')) {
                value = item.querySelector('.review-form-lists-values');
            }
            updateCurrency(value);
        }
        if (typeof listenerInitializeTypeOfGoodsItems[key] === 'undefined' || ajax_form_inc < reviewDropdownToggle.dataset.ajax_form_inc) {
            listenerInitializeTypeOfGoodsItems[key] = initializeTypeOfGoodsItems;
        }
        typeOfGoodsItems.forEach(function (item) {
            item.addEventListener('click', listenerInitializeTypeOfGoodsItems[key]);
        });


        //Инициализация списка
        function InitializeList(event) {
            event.stopPropagation();
            reviewDropdownToggle.style.borderBottomRightRadius = '10px';
            reviewDropdownToggle.style.borderBottomLeftRadius = '10px';
            dropdown.style.borderBottomRightRadius = '10px';
            dropdown.style.borderBottomLeftRadius = '10px';
        }
        if (typeof listenerInitializeDropdownList[key] === 'undefined' || ajax_form_inc < reviewDropdownToggle.dataset.ajax_form_inc) {
            listenerInitializeDropdownList[key] = InitializeList;
        }
        dropdownList.addEventListener('click', listenerInitializeDropdownList[key]);


        //Инициализация документа
        function initializeDocument(event) {
            if (!dropdown.contains(event.target) && !reviewDropdownToggle.contains(event.target)) {
                dropdownList.classList.remove('active');
                reviewDropdownToggle.style.borderBottomRightRadius = '10px';
                reviewDropdownToggle.style.borderBottomLeftRadius = '10px';
                dropdown.style.borderBottomRightRadius = '10px';
                dropdown.style.borderBottomLeftRadius = '10px';
            }
        }
        if (typeof listenerInitializeDocument[key] === 'undefined' || ajax_form_inc < reviewDropdownToggle.dataset.ajax_form_inc) {
            listenerInitializeDocument[key] = initializeDocument;
        }
        document.addEventListener('click', listenerInitializeDocument[key]);

    }

    reviewFormListsDropdowns.forEach(function (dropdown, key) {
        initializeDropdownList(dropdown, key);
    });

    let reviewDropdownToggle = document.querySelector('.review-form-lists-dropdown-toggle');
    if (reviewDropdownToggle) {
        if (ajax_form_inc < reviewDropdownToggle.dataset.ajax_form_inc) {
            ajax_form_inc = reviewDropdownToggle.dataset.ajax_form_inc;
        }
    }
}

function initializeToggleFAQItems() {
    answersText = document.querySelectorAll(".accordion-js__item");
    questionsText = document.querySelectorAll(".accordion-js__head");
    function initializeFAQItems(questionText, key) {
        function initializeFAQItem() {
            answersText[key].classList.toggle('active');
        }
        let FAQItemsList = document.querySelector('.accordion-js__list');
        if (typeof listenerInitializeFAQItems[key] === 'undefined' || ajax_FAQ_inc < FAQItemsList.dataset.ajax_FAQ_inc) {
            listenerInitializeFAQItems[key] = initializeFAQItem;
        }
        questionText.addEventListener('click', listenerInitializeFAQItems[key]);
    }
    questionsText.forEach(function (questionText, key) {
        initializeFAQItems(questionText, key);
    });

    let FAQItemsList = document.querySelector('.accordion-js__list');
    if (FAQItemsList) {
        if (ajax_FAQ_inc < FAQItemsList.dataset.ajax_FAQ_inc) {
            ajax_FAQ_inc = FAQItemsList.dataset.ajax_FAQ_inc;
        }
    }
}

// Expand Buttons
function initializeExpandButtons() {
    expandButtons = document.querySelectorAll('.reviews__item_more');
    function initializeButtons(button, key) {
        const reviewsText = button.closest('.reviews__item').querySelector('.reviews__item_text');
        const reviewsTextHide = button.closest('.reviews__item').querySelector('.hide-part-review');
        function initializeButton(event) {
            event.preventDefault();
            reviewsText.classList.toggle('active');
            if (reviewsText.classList.contains('active')) {
                reviewsText.textContent = reviewsText.textContent.replace('...', reviewsTextHide.textContent);
                button.querySelector('span').textContent = "Свернуть";
                button.querySelector('img').style.transform = 'rotate(180deg)';
            }
            else {
                reviewsText.textContent = reviewsText.textContent.replace(reviewsTextHide.textContent, '...');
                button.querySelector('span').textContent = "Развернуть";
                button.querySelector('img').style.transform = 'rotate(0deg)';
            }
        }
        const reviewsItem = document.querySelector('.reviews__items');
        if (typeof listenerInitializeExpandButtons[key] === 'undefined' || ajax_reviews_inc < reviewsItem.dataset.ajax_reviews_inc) {
            listenerInitializeExpandButtons[key] = initializeButton;
        }
        button.addEventListener('click', listenerInitializeExpandButtons[key]);
    }
    expandButtons.forEach(function (button, key) {
        initializeButtons(button, key);
    });

    let reviewsItem = document.querySelector('.reviews__items');
    if (reviewsItem) {
        if (ajax_reviews_inc < reviewsItem.dataset.ajax_reviews_inc) {
            ajax_reviews_inc = reviewsItem.dataset.ajax_reviews_inc;
        }
    }
}


function initializeAskPanelAjaxMode() {
    askPanelCloseButton = document.querySelector(".js-ask-close");
    askPanel = document.querySelector(".ask-panel");
    askPanelForm = askPanel?.querySelector('.ask-panel__form');
    orderServiceButton = askPanelForm?.parentElement.parentElement.querySelector('button[name="web_form_submit"]');
    function closeAskPanel() {
        askPanel.classList.remove('active');
        const submitPanel = document.querySelector(".ask-panel__submit");
        const resultPanel = document.querySelector(".ask-panel__result");
        submitPanel.classList.remove("d-none");
        resultPanel.classList.add("d-none");
    }

    function closeAskPanelAfter() {
        const submitPanel = document.querySelector(".ask-panel__submit");
        const resultPanel = document.querySelector(".ask-panel__result");
        submitPanel.classList.toggle("d-none");
        resultPanel.classList.toggle("d-none");
    }

    async function showCompleteFormViewSuccess(event) {
        if (askPanelForm && askPanelForm.checkValidity()) {
            event.preventDefault();
            let clientName = document.querySelector(".ask-panel__form .client-name")?.value;
            let clientPhone = document.querySelector(".ask-panel__form .phone")?.value;
            let clientEmail = document.querySelector(".ask-panel__form .email")?.value;
            let serviceName = document.querySelector(".ask-panel__submit .service-name")?.textContent;
            let serviceQuestion = document.querySelector(".ask-panel__submit .service-question")?.value;
            if (clientPhone && await validateNumber(clientPhone)) {
                const submitPanel = document.querySelector(".ask-panel__submit");
                const resultPanel = document.querySelector(".ask-panel__result");
                submitPanel.classList.toggle("d-none");
                resultPanel.classList.toggle("d-none");
                BX.fireEvent(askPanelForm, 'submit');
                sendClientData(clientName, clientPhone).then(isClientExist => {
                    sendWisetaoFormData(clientName, clientPhone, clientEmail, isClientExist, 'serviceOrder', serviceName, serviceQuestion)
                        .then(function (emailResponse) {
                            console.log('Данные формы успешно отправлены:', emailResponse);
                        })
                        .catch(function (emailError) {
                            console.error('Ошибка при отправке данных формы:', emailError);
                        });
                });
            }
            else {
                showInvalidMessageQuestionFormPhone(askPanelForm);
            }
        }
        else if (askPanelForm) {
            showNotices(event);
        }
    }

    if (askPanelCloseButton && (!listenerInitializeAskClose || ajax_ask_inc < askPanelCloseButton.dataset.ajax_ask_inc)) {

        listenerInitializeAskClose = closeAskPanel;
        askPanelCloseButton.addEventListener('click', listenerInitializeAskClose);

        listenerInitializeAskPanelFormSubmit = function(event) {
            showCompleteFormViewSuccess(event);
        };
        orderServiceButton?.addEventListener('click', listenerInitializeAskPanelFormSubmit);
    }

    if (askPanelCloseButton) {
        if (ajax_ask_inc < askPanelCloseButton.dataset.ajax_ask_inc) {
            closeAskPanelAfter();
        }
    }
}

function initializeQuestionFormAjaxMode() {
    questionBlock = document.querySelector(".question-block__submit");
    questionBlockForm = document.querySelector('.question-block__form');
    questionInputsNotice = document.querySelectorAll('.input-form__notice');
    let questionSubmitButton = questionBlock?.querySelector(".main-btn");

    async function showCompleteFormViewQuestionBefore(event) {
        if (questionBlockForm && questionBlockForm.checkValidity()) {
            event.preventDefault();
            let clientName = document.querySelector(".question-block__submit .client-name")?.value;
            let clientPhone = document.querySelector(".question-block__submit .phone")?.value;
            let clientEmail = document.querySelector(".question-block__submit .email")?.value;
            if (clientPhone && await validateNumber(clientPhone)) {
                const submitBlock = document.querySelector(".question-block__submit");
                const resultBlock = document.querySelector(".question-block__result");
                submitBlock.classList.toggle("d-none");
                resultBlock.classList.toggle("d-none");
                BX.fireEvent(questionBlockForm, 'submit');
                sendClientData(clientName, clientPhone).then(isClientExist => {
                    sendWisetaoFormData(clientName, clientPhone, clientEmail, isClientExist, 'question')
                        .then(function (emailResponse) {
                            console.log('Данные формы успешно отправлены:', emailResponse);
                        })
                        .catch(function (emailError) {
                            console.error('Ошибка при отправке данных формы:', emailError);
                        });
                });
            }
            else {
                showInvalidMessageQuestionFormPhone(questionBlockForm);
            }
        }
        else if (questionBlockForm) {
            showNotices(event);
        }
    }

    function showCompleteFormViewQuestionAfter() {
        const submitBlock = document.querySelector(".question-block__submit");
        const resultBlock = document.querySelector(".question-block__result");
        submitBlock.classList.toggle("d-none");
        resultBlock.classList.toggle("d-none");
        setTimeout(() => {
            submitBlock.classList.toggle("d-none");
            resultBlock.classList.toggle("d-none");
        }, 2000);
    }

    if (questionBlock && (!listenerInitializeQuestionBlockFormSubmit || ajax_question_inc < questionBlock.dataset.ajax_question_inc)) {
        listenerInitializeQuestionBlockFormSubmit = function(event) {
            showCompleteFormViewQuestionBefore(event);
        };
        questionSubmitButton.addEventListener('click', listenerInitializeQuestionBlockFormSubmit);
    }

    if (questionBlock) {
        if (ajax_question_inc < questionBlock.dataset.ajax_question_inc) {
            showCompleteFormViewQuestionAfter();
        }
    }
}

function initializeValidateQuestionForm() {
    if (questionInputsNotice) {
        questionBlockForm = document.querySelector('.question-block__form');
        questionInputs = document.querySelectorAll('.question-block__form_input');
    }

    function initializeInputs(input, key) {
        async function initializeInputInput() {
            hideNotice(input);
        }

        function initializeInputBlur() {
            prepNotice(input);
        }

        if (typeof listenerInitializeQuestionInputsInput[key] === 'undefined' || ajax_question_inc < questionBlockForm.parentElement.dataset.ajax_question_inc) {
            listenerInitializeQuestionInputsInput[key] = initializeInputInput;
        }
        input.addEventListener('input', listenerInitializeQuestionInputsInput[key]);

        if (typeof listenerInitializeQuestionInputsBlur[key] === 'undefined' || ajax_question_inc < questionBlockForm.parentElement.dataset.ajax_question_inc) {
            listenerInitializeQuestionInputsBlur[key] = initializeInputBlur;
        }
        input.addEventListener('blur', listenerInitializeQuestionInputsBlur[key]);
    }
    if (questionInputs) {
        questionInputs.forEach(function (input, key) {
            initializeInputs(input, key);
        });
    }

    if (questionBlockForm) {
        if (ajax_question_inc < questionBlockForm.parentElement.dataset.ajax_question_inc) {
            ajax_question_inc = questionBlockForm.parentElement.dataset.ajax_question_inc;
        }
    }

}

function initializeValidateServiceOrderForm() {
    if (orderServiceInputsNotice) {
        orderServiceBlockForm = document.querySelector('.ask-panel__form');
        orderServiceInputs = document.querySelectorAll('.order-service__form_input');
        datasetAskInc = orderServiceBlockForm.parentElement.parentElement.querySelector('.js-ask-close');
    }
    function initializeInputs(input, key) {
        async function initializeInputInput() {
            hideNotice(input);
        }

        function initializeInputBlur() {
            prepNotice(input);
        }

        if (typeof listenerInitializeOrderServiceInputsInput[key] === 'undefined' || ajax_ask_inc < datasetAskInc.dataset.ajax_ask_inc) {
            listenerInitializeOrderServiceInputsInput[key] = initializeInputInput;
        }
        input.addEventListener('input', listenerInitializeOrderServiceInputsInput[key]);

        if (typeof listenerInitializeOrderServiceInputsBlur[key] === 'undefined' || ajax_ask_inc < datasetAskInc.dataset.ajax_ask_inc) {
            listenerInitializeOrderServiceInputsBlur[key] = initializeInputBlur;
        }
        input.addEventListener('blur', listenerInitializeOrderServiceInputsBlur[key]);
    }
    if (orderServiceInputs) {
        orderServiceInputs.forEach(function (input, key) {
            initializeInputs(input, key);
        });
    }

    if (orderServiceBlockForm) {
        if (ajax_ask_inc < datasetAskInc.dataset.ajax_ask_inc) {
            ajax_ask_inc = datasetAskInc.dataset.ajax_ask_inc;
        }
    }

}

function hideNotice(input) {
    let notice = input.nextElementSibling;
    notice.classList.add('hidden');
    notice.textContent = '';
    input.style.border = 'none';
    input.style.color = 'white';
    let noticeInvalidNumber = input.parentElement.querySelector('.input-form__notice-valid-number');
    if (noticeInvalidNumber) {
        noticeInvalidNumber.classList.add('hidden');
        noticeInvalidNumber.textContent = '';
    }
}

function prepNotice(input) {
    let notice = input.nextElementSibling;
    if (input.value === '') {
        notice.classList.remove('hidden');
        let inputName = input.getAttribute('placeholder').replace(/ \*$/, '');
        notice.textContent = `Пожалуйста, заполните "${inputName}"`;
        input.style.border = '1px solid rgb(168, 29, 41)';
    }

}

function showNotices(event) {
    if (!questionBlockForm.checkValidity()) {
        event.preventDefault();
        questionInputsNotice.forEach(notice => {
            prepNotice(notice.previousElementSibling);
        })
    }
}

window.addEventListener('resize', function () {
    updateMoreContentPosition();
});

function updateMoreContentPosition() {
    var pageElement = document.querySelector('.content-page__page');
    var moreElement = document.querySelector('.content-page__more');
    if (pageElement) {
        var pageRect = pageElement.getBoundingClientRect();
        if (moreElement !== null) {
            moreElement.style.left = (pageRect.left + pageRect.width) + 29 + 'px';
            moreElement.style.display = 'block';
        }
    }
}

window.addEventListener('load', function () {
    updateMoreContentPosition();
});


//Отправка данных клиента
async function sendClientData(clientName, clientPhone) {
    let clientData =
        {
            NAME: clientName,
            PHONE: clientPhone,
        };

    if (clientData) {
        clientData.SITE_ID = 's3';
        clientData.sessid = BX.message('bitrix_sessid');
    }

    let query = {
        action: 'telegram:document.api.RedeemDataController.create_client'
    };

    let options = {
        type: 'POST',
        url: '/bitrix/services/main/ajax.php?' + $.param(query),
        data: clientData,
        dataType: 'json',
    };
    return new Promise((resolve, reject) => {
        $.ajax(options)
            .then(function (response) {
                console.log('Данные успешно отправлены:', response);
                if (response.data.status === 'exists') {
                    resolve(true);
                } else if (response.data.status === 'success') {
                    resolve(false);
                }
                return response;
            })
            .catch(function (error) {
                console.error('Ошибка при отправке данных:', error);
                reject({error: error});
            })
            .always(function () {

            });
    });
}


//Валидация номера
async function validateNumber(clientPhone) {

    let clientData =
        {
            PHONE: clientPhone,
        };

    if (clientData) {
        clientData.SITE_ID = 's3';
        clientData.sessid = BX.message('bitrix_sessid');
    }

    let query = {
        action: 'telegram:document.api.ContactHandlingController.handle_phone'
    };

    let options = {
        type: 'POST',
        url: '/bitrix/services/main/ajax.php?' + $.param(query),
        data: clientData,
        dataType: 'json',
    };
    return new Promise((resolve, reject) => {
        $.ajax(options)
            .then(function (response) {
                console.log('Данные успешно отправлены:', response);
                if (response.data === 'Неверный номер.') {
                    resolve(false);
                }
                else {
                    resolve(true);
                }
            })
            .catch(function (error) {
                console.error('Ошибка при отправке данных:', error);
                reject({error: error});
            })
            .always(function () {

            });
    });
}

function showInvalidMessageQuestionFormPhone(parent) {
    let notice = parent.querySelector('.input-form__notice-valid-number');
    if (notice) {
        notice.classList.remove('hidden');
        notice.textContent = 'Неверный номер';
        let inputPhone = notice.previousElementSibling.previousElementSibling;
        if (inputPhone) {
            inputPhone.style.color = '#ed5555';
            inputPhone.style.border = '1px solid rgb(168, 29, 41)';
        }
    }
}

async function sendWisetaoFormData(clientName, clientPhone, clientEmail, isClientExist, formName, serviceName = '', serviceQuestion = '', ) {
    let wisetaoFormData = {};
    wisetaoFormData.SITE_ID = 's3';
    wisetaoFormData.sessid = BX.message('bitrix_sessid');
    wisetaoFormData.serviceName = serviceName;
    wisetaoFormData.serviceQuestion = serviceQuestion;
    wisetaoFormData.formName = formName;
    wisetaoFormData.name = clientName;
    wisetaoFormData.phone = clientPhone;
    wisetaoFormData.email = clientEmail;
    wisetaoFormData.isClientExist = isClientExist;
    wisetaoFormData.currentPageUrl = window.location.href;

    let query = {
        action: 'telegram:document.api.WisetaoFormsController.send_wisetao_forms_data_to_deal_bitrix24'
    };

    let options = {
        type: 'POST',
        url: '/bitrix/services/main/ajax.php?' + $.param(query),
        data: wisetaoFormData,
        dataType: 'json',
    };

    return $.ajax(options)
        .then(function (response) {
            console.log('Данные успешно отправлены:', response);
            return response;
        })
        .catch(function (error) {
            console.error('Ошибка при отправке данных:', error);
            return { error: error };
        });
}

document.addEventListener("DOMContentLoaded", () => {
    initializeDropDownLists();
    initializeExpandButtons();
    initializeToggleFAQItems();
    initializeAskPanelAjaxMode();
    initializeQuestionFormAjaxMode();
    initializeValidateQuestionForm();
    initializeValidateServiceOrderForm();
});