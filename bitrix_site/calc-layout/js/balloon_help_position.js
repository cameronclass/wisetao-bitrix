// Получаем ссылки на все элементы с классом .help
function initializeHelp() {
    const helpElements = document.querySelectorAll('.help:not(.max-dimension-help):not(.brand-help):not(.yuan-help):not(.delivery-help):not(.redeem-help), .list-help');
    const helpElementsBrand = document.querySelectorAll('.brand-help');
    const helpElementsYuan = document.querySelectorAll('.yuan-help');
    const helpElementRedeem = document.querySelector('.redeem-help');
    const helpElementInsurance = document.querySelector('.custom-checkbox-insurance');
    const helpElementFirstStep = document.querySelector('.custom-radio-redeem.custom-radio-redeem2');
    const helpElementMaxDimension = document.querySelector('.help.max-dimension-help');
    const helpDeliveryTypes = document.querySelectorAll('.delivery-help');
    let element = document.querySelector('.element');
    let subcontainer = document.querySelector('.sub-container');
// Функция для обновления позиции balloon-container при наведении

// Добавляем обработчики событий для каждого .help элемента
    helpElements.forEach(helpElement => {
        helpElement.addEventListener('mouseenter', updateBalloonPosition);
        if (helpElement.closest('.delivery-types-list-comparison')) {
            helpElement.addEventListener('mouseenter', updateZIndexDropdown);
        }
        helpElement.addEventListener('mouseleave', updateZIndexDropdown);
        let balloonContainer = helpElement.querySelector('.balloon-container');
        balloonContainer?.addEventListener('transitionend', hideHelpContainer);
    });

    helpElementsBrand.forEach(helpElement => {
        helpElement.addEventListener('mouseenter', updateBalloonBrandPosition);
    });

    helpElementsYuan.forEach(helpElement => {
        helpElement.addEventListener('mouseenter', updateBalloonExchangeRateYuanPosition);
    });
    helpDeliveryTypes.forEach((helpDeliveryType) => {
        helpDeliveryType.addEventListener('mouseenter', updateBalloonDeliveryHelpPosition);
        const balloonContainer = helpDeliveryType.querySelector('.balloon-delivery-type');
        balloonContainer?.addEventListener('transitionend', updateBalloonDeliveryHelpZIndex);
    })
    helpElementInsurance.addEventListener('mouseenter', updateBalloonInsurancePosition);
    helpElementFirstStep.addEventListener('mouseenter', updateBalloonFirstStep);
    helpElementRedeem?.addEventListener('mouseenter', updateBalloonRedeemPosition);

    if (helpElementMaxDimension) {
        helpElementMaxDimension.addEventListener('mouseenter', updateBalloonMaxDimensionPosition);
    }

}

function hideHelpContainer(event) {
    let balloonContainer = event.target;
    let helpContainer = balloonContainer?.parentElement;
    if (event.propertyName === 'opacity' && window.getComputedStyle(balloonContainer).opacity === '0' && !helpContainer.classList.contains('circle-help')) {
        helpContainer.style.display = 'none';
    }
}

function extractCityName(fullAddress) {
    // Используем регулярное выражение для поиска первого слова, начинающегося с заглавной буквы
    var match = fullAddress.match(/[A-ZА-Я][a-zA-Zа-яА-Я-]+/);

    // Возвращаем найденное слово (или полный адрес, если ничего не найдено)
    return match ? match[0] : fullAddress.trim();
}

function updateZIndexDropdown(event) {
    const helpElement = event.currentTarget;
    const balloonContainerWhite = helpElement.querySelector('.balloon-container-white');
    const balloonContainerComparison = helpElement.querySelector('.balloon-container');
    let deliveryTypesDropdown;
    if (balloonContainerWhite) {
        deliveryTypesDropdown = balloonContainerWhite.closest('.delivery-types-dropdown');
        deliveryTypesDropdown.style.zIndex = '0';
    }
    if (balloonContainerComparison) {
        let deliveryTypesLists = balloonContainerComparison?.closest('.delivery-types-dropdown-comparison')?.querySelectorAll('.delivery-types-list-comparison');
        if (deliveryTypesLists) {
            deliveryTypesLists.forEach((deliveryTypesList) => {
                if (deliveryTypesList === balloonContainerComparison.closest('.delivery-types-list-comparison')) {
                    deliveryTypesList.style.zIndex = '0';
                } else {
                    deliveryTypesList.style.zIndex = '-1';
                }
            })
        }

    }
}

function updateBalloonInsurancePosition(event) {
    const helpElement = event.currentTarget;
    const balloonContainer = helpElemen?.querySelector('.balloon-insurance');
    const helpRect = helpElement?.getBoundingClientRect();
    const balloonRect = balloonContainer?.getBoundingClientRect();
    let helpRectTop = 0;
    let leftMinus = [
        310,
    ]
    if (helpRect?.top < balloonRect?.height) {
        helpRectTop = balloonRect.height - helpRect.top + 25;
    }
    if (balloonContainer) {
        balloonContainer.style.top = `${helpRect.top - 100 + helpRectTop}px`;
        balloonContainer.style.left = `${helpRect.left + helpRect.width - leftMinus[0]}px`;
    }
}

function updateBalloonFirstStep(event) {
    const helpElement = event.currentTarget;
    const balloonContainer = helpElement?.querySelector('.balloon-first-step');
    const helpRect = helpElement?.getBoundingClientRect();
    const balloonRect = balloonContainer?.getBoundingClientRect();
    let helpRectTop = 0;
    let leftMinus = [
        305,
    ]
    if (balloonRect) {
        if (helpRect.top < balloonRect.height) {
            helpRectTop = balloonRect.height - helpRect.top + 25;
        }
        if (balloonContainer) {
            balloonContainer.style.top = `${helpRect.top - 145 + helpRectTop}px`;
            balloonContainer.style.left = `${helpRect.left + helpRect.width - leftMinus[0]}px`;
        }
    }
}

function updateBalloonRedeemPosition(event) {
    const helpElement = event.currentTarget;
    const balloonContainer = helpElement.querySelector('.balloon-redeem');
    const helpRect = helpElement.getBoundingClientRect();
    const balloonRect = balloonContainer.getBoundingClientRect();
    let helpRectTop = 0;
    let leftMinus = [
        290,
    ]
    if (helpRect.top < balloonRect.height) {
        helpRectTop = balloonRect.height - helpRect.top + 25;
    }
    if (balloonContainer) {
        balloonContainer.style.top = `${helpRect.top - 110 + helpRectTop}px`;
        balloonContainer.style.left = `${helpRect.left + helpRect.width - leftMinus[0]}px`;
    }
}

function updateBalloonDeliveryHelpPosition(event) {
    const helpElement = event.currentTarget;
    const balloonContainer = helpElement.querySelector('.balloon-delivery-type');
    let tMinus = 180;
    if (balloonContainer?.classList.contains('jde')) {
        tMinus = 105;
    }
    if (balloonContainer?.classList.contains('pek')) {
        tMinus = 240;
    }
    if (balloonContainer?.classList.contains('dl')) {
        tMinus = 110;
    }
    if (balloonContainer?.classList.contains('kit')) {
        tMinus = 280;
    }
    const helpRect = helpElement.getBoundingClientRect();
    const balloonRect = balloonContainer?.getBoundingClientRect();
    let helpRectTop = 0;
    let leftMinus = [
        -15,
    ]
    if (helpRect?.top < balloonRect?.height) {
        helpRectTop = balloonRect.height - helpRect.top + 15;
    }
    if (balloonContainer) {
        balloonContainer.style.top = `${helpRect.top - tMinus + helpRectTop}px`;
        balloonContainer.style.left = `${helpRect.left + helpRect.width - leftMinus[0]}px`;
        helpElement.closest('.delivery-types-dropdown').style.zIndex = 3;
    }
}

function updateBalloonDeliveryHelpZIndex(event) {
    if (event.propertyName === 'opacity' && window.getComputedStyle(event.currentTarget).opacity === '0') {
        event.currentTarget.closest('.delivery-types-dropdown').style.zIndex = 0;
    }
}

function updateBalloonMaxDimensionPosition(event) {
    const helpElement = event.currentTarget;
    const balloonContainer = helpElement.querySelector('.balloon-max-dimension');
    const helpRect = helpElement.getBoundingClientRect();
    const balloonRect = balloonContainer?.getBoundingClientRect();
    let helpRectTop = 0;
    let leftMinus = [
        285,
    ]
    if (helpRect.top < balloonRect.height) {
        helpRectTop = balloonRect.height - helpRect.top + 25;
    }
    if (balloonContainer) {
        balloonContainer.style.top = `${helpRect.top - 30 + helpRectTop}px`;
        balloonContainer.style.left = `${helpRect.left + helpRect.width - leftMinus[0]}px`;
    }
}

function updateBalloonBrandPosition(event) {
    event.stopPropagation();
    const helpElement = event.currentTarget;
    const balloonContainer = helpElement.querySelector('.balloon-brand');
    const helpRect = helpElement.getBoundingClientRect();
    const balloonRect = balloonContainer?.getBoundingClientRect();
    let helpRectTop = 0;
    let leftMinus = [
        315,
    ]
    if (helpRect.top < balloonRect.height) {
        helpRectTop = balloonRect.height - helpRect.top + 25;
    }
    if (balloonContainer) {
        balloonContainer.style.top = `${helpRect.top - 36 + helpRectTop}px`;
        balloonContainer.style.left = `${helpRect.left + helpRect.width - leftMinus[0]}px`;
    }
    event.stopPropagation();
}

function updateBalloonExchangeRateYuanPosition(event) {
    event.stopPropagation();
    const helpElement = event.currentTarget;
    const balloonContainer = helpElement?.querySelector('.balloon-yuan');
    const helpRect = helpElement?.getBoundingClientRect();
    const balloonRect = balloonContainer?.getBoundingClientRect();
    let helpRectTop = 0;
    let leftMinus = [
        282,
    ]
    if (helpRect?.top < balloonRect?.height) {
        helpRectTop = balloonRect.height - helpRect.top + 20;
    }
    if (balloonContainer) {
        balloonContainer.style.top = `${helpRect.top - 25 + helpRectTop}px`;
        balloonContainer.style.left = `${helpRect.left + helpRect.width - leftMinus[0]}px`;
    }
    event.stopPropagation();
}

function updateBalloonPosition(event) {
    const helpElement = event.currentTarget;
    const helpContainer = helpElement.querySelector('.help-container');
    if (helpContainer) {
        helpContainer.style.display = 'block';
    }
    const balloonContainer = helpElement?.querySelector('.balloon-container');
    const balloonContainerCargoOthers = helpElement?.querySelector('.balloon-container-cargo-others');
    const balloonContainerWhite = helpElement?.querySelector('.balloon-container-white');
    const balloonContainerComparison = helpElement?.querySelector('.balloon-container-comparison');
    const balloonContainerWhiteOthers = helpElement?.querySelector('.balloon-container-white-others');
    var deliveryTypesDropdown;
    const helpRect = helpElement?.getBoundingClientRect();
    const balloonRect = balloonContainer?.getBoundingClientRect();
    let helpRectTop = 0;
    if (helpElement?.closest('.delivery-toggle')) {
        helpElement.closest('.delivery-toggle').style.zIndex = 2;
        helpElement.closest('.delivery-toggle').nextElementSibling.nextElementSibling.nextElementSibling.style.zIndex = 0;
    }
    else if (helpElement?.closest('.delivery-types-list')) {
        // helpElement.closest('.delivery-types-list').style.zIndex = 2;
        // helpElement.closest('.delivery-types-list').previousElementSibling.previousElementSibling.previousElementSibling.style.zIndex = 0;
    }
    if (balloonRect) {
        if (helpRect.top < balloonRect.height) {
            helpRectTop = balloonRect.height - helpRect.top + 25;
        }
    }
    if (balloonContainer) {
        balloonContainer.style.zIndex = 10;
    }
    let leftMinus = [
        helpElement.closest('.desc') ? 276 : 200,
        helpElement.closest('.desc') ? 282 : 200,
    ]
    if (helpElement.closest('.desc')) {
        if (helpElement.closest('#delivery-types-dropdown-auto') || helpElement.closest('#delivery-types-dropdown-auto-white')) {
            leftMinus = [
                -10,
                -10,
            ];
        }
        else {
            leftMinus = [
                helpElement.closest('.desc') ? helpRect.width + 276 : 200,
                helpElement.closest('.desc') ? helpRect.width + 282 : 200,
            ];
        }
    }
    if (helpElement?.closest('.delivery-types')) {
        helpElement.closest('.delivery-types').querySelectorAll('.desc').forEach((desc) => {
            desc.style.zIndex = 0;
        });
        helpElement.closest('.desc').style.zIndex = 10;
    }

    if (balloonContainer) {
        balloonContainer.style.top = `${helpRect.top - (helpElement.closest('.desc') ? 268 : 208) + helpRectTop}px`;
        balloonContainer.style.left = `${helpRect.left + helpRect.width - leftMinus[0]}px`;
    }
    if (balloonContainerCargoOthers) {
        balloonContainer.style.top = `${helpRect.top - 309 + helpRectTop}px`;
        balloonContainer.style.left = `${helpRect.left + helpRect.width - leftMinus[0]}px`;
    }
    if (balloonContainerWhiteOthers) {
        balloonContainer.style.top = `${helpRect.top - 610 + helpRectTop}px`;
        balloonContainer.style.left = `${helpRect.left + helpRect.width - leftMinus[1]}px`;
    }
    if (balloonContainerWhite) {
        balloonContainer.style.top = `${helpRect.top - 528 + helpRectTop}px`;
        balloonContainer.style.left = `${helpRect.left + helpRect.width - leftMinus[0]}px`;

        deliveryTypesDropdown = balloonContainerWhite.closest('.delivery-types-dropdown');
        deliveryTypesDropdown.style.zIndex = '1';
    }

    if (balloonContainerComparison) {
        deliveryTypesDropdown = balloonContainerComparison.closest('.delivery-types-dropdown');
        deliveryTypesDropdown.style.zIndex = '1';
    }
}
