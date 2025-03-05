function initializeRedeemCheckbox() {
    const checkboxes = document.querySelectorAll('.custom-radio-redeem input[type="radio"]');
    const redeemDataContainer = document.querySelector('.redeem-data');
    const fromToBlock = document.querySelector('.main-calc-first__from-to');
    checkboxes.forEach((checkbox) => {
        checkRedeem(checkbox, redeemDataContainer);
        checkbox.addEventListener('change', function () {
            checkRedeem(checkbox, redeemDataContainer);
            activateCalculator();

            fromToBlock.classList.add('active');
        });
    });
}

function checkRedeem(checkbox, redeemDataContainer) {
    if (checkbox.checked) {
        if (checkbox.getAttribute('value') === 'delivery-only') {
            redeemDataContainer.style.display = 'none';
        } else {
            redeemDataContainer.style.display = 'flex';
        }
    }
}

function activateCalculator() {
    if ($('input[name="delivery-option"]:checked').length > 0) {
        document.querySelector('.first-step').style.display = 'none';
        document.querySelectorAll('.disabled-shutter').forEach(shutter => {
            shutter.classList.add('hidden');
        });
        let elems = [];
        elems.push(document.querySelectorAll('.rectangle'));
        elems.push(document.querySelectorAll('.group-input'));
        elems.push(document.querySelectorAll('.label-text'));
        elems.push(document.querySelectorAll('.from-to-container-other-elems'));
        elems.push(document.querySelectorAll('.switch-btn__block'));
        elems.push(document.querySelectorAll('.switch-btn__text'));
        elems.push(document.querySelectorAll('.may-disable'));
        elems.push(document.querySelectorAll('.input-label'));
        elems.push(document.querySelectorAll('.custom-input'));
        elems.push(document.querySelectorAll('.img-boxing-checkmark'));
        elems.push(document.querySelectorAll('.img-boxing-item-label'));
        elems.push(document.querySelectorAll('.input-addon'));
        elems.push(document.querySelectorAll('.addon-text'));
        elems.push(document.querySelectorAll('.custom-input-label'));
        elems.push(document.querySelectorAll('.custom-input-field'));
        elems.push(document.querySelectorAll('.custom-input-addon'));
        elems.push(document.querySelectorAll('button.submit-general-button'));
        elems.push(document.querySelectorAll('.main-calc-button'));
        elems.push(document.querySelectorAll('button.tnved-calc-button'));
        elems.push(document.querySelectorAll('.custom-checkbox'));
        elems.push(document.querySelectorAll('.brand'));
        elems.push(document.querySelectorAll('.dropdown'));
        elems.push(document.querySelectorAll('.dropdown-toggle'));
        elems.push(document.querySelectorAll('.label-price'));
        elems.push(document.querySelectorAll('.arrow'));
        elems.push(document.querySelectorAll('.shaft'));
        elems.push(document.querySelectorAll('.tip'));
        elems.push(document.querySelectorAll('.type-of-goods-label'));
        elems.push(document.querySelectorAll('.type-of-goods-dropdown-toggle'));
        elems.push(document.querySelectorAll('.svg-arrow'));
        elems.push(document.querySelectorAll('.custom-checkbox-insurance'));
        elems.push(document.querySelectorAll('.custom-input-label-dimensions'));
        elems.push(document.querySelectorAll('.custom-input-field-dimensions'));
        elems.push(document.querySelectorAll('.plus'));
        elems.push(document.querySelectorAll('.add-button'));
        elems.push(document.querySelectorAll('.boxing-spoiler-header'));
        elems.push(document.querySelectorAll('.triangle-arrow'));
        elems.push(document.querySelectorAll('.select-delivery-type'));
        elems.push(document.querySelectorAll('.redeem-data-plus'));
        elems.push(document.querySelectorAll('.redeem-data-minus'));
        elems.push(document.querySelectorAll('.redeem-name-input-label'));
        elems.push(document.querySelectorAll('.delivery-item-label'));
        elems.push(document.querySelectorAll('.svg-stroke'));
        elems.push(document.querySelectorAll('.rate-sign'));
        elems.push(document.querySelectorAll('.exchange-rate-elem-dollar'));
        elems.push(document.querySelectorAll('.exchange-rate-elem-yuan'));
        elems.push(document.querySelectorAll('.circle-help'));
        elems.push(document.querySelectorAll('button.tnved-calc-button'));
        elems.push(document.querySelectorAll('label.select-by-name-label'));
        elems.push(document.querySelectorAll('label.tnved-input-label'));
        elems.push(document.querySelectorAll('.tnved-calc-button'));
        elems.push(document.querySelectorAll('.arrow-to'));
        elems.push(document.querySelectorAll('.main-calc-checkbox'));
        elems.forEach((elemList) => {
            if (elemList) {
                elemList.forEach((elem) => {
                    elem.classList.add('active');
                });
            }
        });
        const text1 = document.querySelector('#text1.active');
        const text2 = document.querySelector('#text2.active');
        const text3 = document.querySelector('#text3.active');
        const text4 = document.querySelector('#text4.active');
        const checkboxIT = document.querySelector('#checkbox_input_type');
        const checkboxIT2 = document.querySelector('#checkbox_input_type2');
        if (text1 && checkboxIT.checked) {
            text1.style.color = '#f09123';
            text2.style.color = 'white';
            text3.style.color = '#9d9d9d';
            text4.style.color = '#9d9d9d';
        }
        if (text1 && !checkboxIT.checked && checkboxIT2.checked) {
            text1.style.color = 'white';
            text2.style.color = '#f09123';
            text3.style.color = '#f09123';
            text4.style.color = 'white';
        }
        if (text1 && !checkboxIT.checked && !checkboxIT2.checked) {
            text1.style.color = 'white';
            text2.style.color = '#f09123';
            text3.style.color = 'white';
            text4.style.color = '#f09123';
        }
    }
}