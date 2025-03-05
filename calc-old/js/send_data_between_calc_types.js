
function gatherGoodData(button) {
    let input_type = $("#checkbox_input_type").is(":checked");
    let input_type2 = $("#checkbox_input_type2").is(":checked");
    generalGoodData.checkbox_input_type = input_type;
    generalGoodData.checkbox_input_type2 = input_type2;
    if (button.dataset.type === 'comparison') {
        if (generalGoodData.oldButton.dataset.type === 'cargo') {
            if (input_type) {
                let inputs = document.querySelectorAll('.general-calc-input:not(.count-input)');
                let goodToggle = document.querySelector('.type-of-goods-dropdown-toggle').childNodes[0].nodeValue.trim();
                let currency = document.querySelector('.dropdown-toggle.currency-toggle').childNodes[0].nodeValue.trim();
                let dataCurrency = document.querySelector('.order-data-general .dropdown-toggle.currency-toggle').dataset.currency;
                inputs.forEach((input) => {
                    Object.assign(generalGoodData, {
                        [input.getAttribute('name')]: input.value,
                    });
                });
                Object.assign(generalGoodData, {
                    'type-of-goods-dropdown-toggle': goodToggle,
                    'brand': $("input[name='brand-good']").is(":checked"),
                    'currency': currency,
                    'dataCurrency': dataCurrency,
                });
            }
            else {
                generalGoodData.goods = [];
                let dimensionsInputGroups = document.querySelectorAll('.dimensions-input-group .result');
                let currencyForDimensions = document.querySelectorAll('.currency_for_dimensions');
                let wightsForDimensions = document.querySelectorAll('.input-container-dimensions .custom-input.weight');
                let currencies = document.querySelectorAll('.order-data-dimensions .dropdown-toggle.currency-toggle');
                let goodToggle = document.querySelectorAll('.type-of-goods-dropdown-toggle-dimensions');
                let brand = true;
                let brands;
                if (input_type2) {
                    brand = $("input[name='dim-brand']").is(":checked");
                }
                else {
                    brands = document.querySelectorAll('.brand-checkbox');
                }
                dimensionsInputGroups.forEach((result, i) => {
                    let good = {
                        'dimension': result.childNodes[0].nodeValue.trim(),
                        'cost': currencyForDimensions[i].value,
                        'weight': wightsForDimensions[i].value,
                        'brand': input_type2 ? brand : $(brands[i]).is(":checked"),
                        'currency': currencies[i].childNodes[0].nodeValue.trim(),
                        'dataCurrency': currencies[i].dataset.currency,
                        'goodToggle': goodToggle[i].childNodes[0].nodeValue.trim(),
                    };
                    if (!generalGoodData.goods) {
                        generalGoodData.goods = [good];
                    }
                    else {
                        generalGoodData.goods.push(good);
                    }
                });
            }
        }
    }
    if (button.dataset.type === 'cargo') {
        if (generalGoodData.oldButton.dataset.type === 'comparison') {
            generalGoodData.goods = [];
            let costs = document.querySelectorAll('.custom-input-tnved-currency');
            let weights = document.querySelectorAll('input[name="weight[]"]');
            let volumes = document.querySelectorAll('input[name="volume[]"]');
            let currencies = document.querySelectorAll('.dropdown-toggle.currency-toggle');
            let brands = document.querySelectorAll('.brand-checkbox');
            let goodToggle = document.querySelectorAll('.cargo-white-data-container .type-of-goods-dropdown-toggle');
            costs.forEach((cost, i) => {
                let good = {
                    'dimension': volumes[i].value,
                    'cost': cost.value,
                    'weight': weights[i].value,
                    'brand': $(brands[i]).is(":checked"),
                    'currency': currencies[i].childNodes[0].nodeValue.trim(),
                    'dataCurrency': currencies[i].dataset.currency,
                    'goodToggle': goodToggle[i].childNodes[0].nodeValue.trim(),
                };
                if (!generalGoodData.goods) {
                    generalGoodData.goods = [good];
                }
                else {
                    generalGoodData.goods.push(good);
                }
            });
        }
    }
    if (button.dataset.type === 'comparison' && generalGoodData.oldButton.dataset.type === 'white' ||
        generalGoodData.oldButton.dataset.type === 'comparison' && button.dataset.type === 'white') {
        generalGoodData.goods = [];
        let byNames = document.querySelectorAll('.select-by-name-input');
        let currencies = document.querySelectorAll('.dropdown-toggle.currency-toggle');
        currencies.forEach((currency, i) => {
            let good = {
                'currency': currency.childNodes[0].nodeValue.trim(),
                'dataCurrency': currency.dataset.currency,
                'byName': byNames[i].getAttribute('placeholder'),
            };
            if (!generalGoodData.goods) {
                generalGoodData.goods = [good];
            }
            else {
                generalGoodData.goods.push(good);
            }
        });
    }
}

function sendGoodData(button) {
    if (button.dataset.type === 'comparison') {
        if (generalGoodData.oldButton.dataset.type === 'cargo') {
            if (generalGoodData.checkbox_input_type === true) {
                document.querySelector('#currency').value = generalGoodData['total-cost'];
                document.querySelector('input[name="weight[]"]').value = generalGoodData['total-weight'];
                document.querySelector('input[name="volume[]"]').value = generalGoodData['total-volume'];
                document.querySelector('.dropdown-toggle.currency-toggle').childNodes[0].nodeValue = generalGoodData['currency'];
                document.querySelector('.dropdown-toggle.currency-toggle').dataset.currency = generalGoodData['dataCurrency']
                if (generalGoodData['brand'] === true) {
                    document.querySelector('.brand-checkbox').setAttribute('checked', '');
                }
                else {
                    document.querySelector('.brand-checkbox').removeAttribute('checked');
                }
                [...document.querySelectorAll('li span.type-of-goods-values')].some(typeOfGoodsValue => {
                    if (typeOfGoodsValue.textContent.trim() === generalGoodData['type-of-goods-dropdown-toggle']) {
                        sendToggleValues(typeOfGoodsValue);
                        return true;
                    }
                    return false;
                });
            }
            else {
                let addButton = document.querySelector('.add-container:not(.redeem-add) .add-button .add');
                generalGoodData.goods.forEach((good, index) => {
                    if (index > 0) {
                        addButton.click();
                    }
                });
                let costs = document.querySelectorAll('.custom-input-tnved-currency');
                let weights = document.querySelectorAll('input[name="weight[]"]');
                let volumes = document.querySelectorAll('input[name="volume[]"]');
                let brand = document.querySelectorAll('.brand-checkbox');
                let currencies = document.querySelectorAll('.dropdown-toggle.currency-toggle');
                generalGoodData.goods.forEach((good, i) => {
                    costs[i].value = good['cost'];
                    weights[i].value = good['weight'];
                    volumes[i].value = good['dimension'];
                    currencies[i].childNodes[0].nodeValue = good['currency'];
                    currencies[i].dataset.currency = good['dataCurrency'];
                    if (good['brand'] === true) {
                        brand[i].setAttribute('checked', '');
                    }
                    else {
                        brand[i].removeAttribute('checked');
                    }
                });

                document.querySelectorAll('ul.type-of-goods-dropdown-list:not(.delivery-types-list)').forEach((typeOfGoodsList, index) => {
                    [...typeOfGoodsList.querySelectorAll('li span.type-of-goods-values')].some(typeOfGoodsValue =>
                    {
                        if (typeOfGoodsValue.textContent.trim() === generalGoodData.goods[index]['goodToggle']) {
                            sendToggleValues(typeOfGoodsValue);
                            return true;
                        }
                        return false;
                    });
                });
            }
        }
    }
    if (button.dataset.type === 'cargo') {
        if (generalGoodData.oldButton.dataset.type === 'comparison') {
            let addButton = document.querySelector('.add-container:not(.redeem-add) .add-button .add');
            document.querySelector('#checkbox_input_type').click();
            document.querySelector('#checkbox_input_type2').click();
            generalGoodData.goods.forEach((good, index) => {
                if (index > 0) {
                    addButton.click();
                }
            });
            let volumes = document.querySelectorAll('.dimensions-input-group .result');
            let costs = document.querySelectorAll('.currency_for_dimensions');
            let weights = document.querySelectorAll('.input-container-dimensions .custom-input.weight');
            let currencies = document.querySelectorAll('.order-data-dimensions .dropdown-toggle.currency-toggle');
            let brands = document.querySelectorAll('.brand-checkbox');
            generalGoodData.goods.forEach((good, i) => {
                costs[i].value = good['cost'];
                weights[i].value = good['weight'];
                volumes[i].childNodes[0].nodeValue = good['dimension'];
                currencies[i].childNodes[0].nodeValue = good['currency'];
                currencies[i].dataset.currency = good['dataCurrency'];
                if (good['brand'] === true) {
                    brands[i].setAttribute('checked', '');
                }
                else {
                    brands[i].removeAttribute('checked');
                }
            });

            document.querySelectorAll('.order-data-dimensions ul.type-of-goods-dropdown-list:not(.delivery-types-list)').forEach((typeOfGoodsList, index) => {
                [...typeOfGoodsList.querySelectorAll('li span.type-of-goods-values')].some(typeOfGoodsValue =>
                {
                    if (typeOfGoodsValue.textContent.trim() === generalGoodData.goods[index]['goodToggle']) {
                        sendToggleValues(typeOfGoodsValue);
                        return true;
                    }
                    return false;
                });
            });
        }
    }
    if (button.dataset.type === 'comparison' && generalGoodData.oldButton.dataset.type === 'white' ||
        generalGoodData.oldButton.dataset.type === 'comparison' && button.dataset.type === 'white') {
        let currencies = document.querySelectorAll('.dropdown-toggle.currency-toggle');
        let byNames = document.querySelectorAll('.select-by-name-input');
        generalGoodData.goods.forEach((good, i) => {
            currencies[i].childNodes[0].nodeValue = good['currency'];
            currencies[i].dataset.currency = good['dataCurrency'];
            byNames[i].setAttribute('placeholder', good['byName']);
        });
    }
}

function sendToggleValues(typeOfGoodsValue) {
    const helpContent = typeOfGoodsValue.nextElementSibling.cloneNode(true);
    if (helpContent) {
        helpContent.addEventListener('mouseenter', updateBalloonPosition);
        helpContent.className = 'help ' + 'type-of-goods-dropdown-toggle-' + helpContent.className.split(' ')[1];
    }
    let arrow = document.querySelector('.dropdown-list-goods-arrow').cloneNode(true);
    helpContent.innerHTML.trim();
    typeOfGoodsValue.closest('ul').previousElementSibling.innerHTML = typeOfGoodsValue.textContent.trim();
    typeOfGoodsValue.closest('ul').previousElementSibling.appendChild(helpContent);
    typeOfGoodsValue.closest('ul').previousElementSibling.appendChild(arrow);
}

