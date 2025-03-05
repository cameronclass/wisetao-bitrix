function initializeImgBoxing() {
    // const imgItemsDelivery = document.querySelectorAll('.img-boxing-item-delivery-type');
    const imgItemsPackage = document.querySelectorAll('.img-boxing-item-package-type:has(input)');
    const imgItemPackageDefault = document.querySelector('.img-boxing-item-package-type:not(:has(input))');
    // markImg(imgItemsDelivery);
    markImg(imgItemsPackage, imgItemPackageDefault);
}

function markImg(imgItems, imgItemPackageDefault) {
    imgItems.forEach((item, index) => {
        const checkbox = item.querySelector('input[type="checkbox"]');
        item.addEventListener('click', () => {
            checkbox.checked = !checkbox.checked;
            imgItems.forEach((otherItem, otherIndex) => {
                if (otherIndex !== index) {
                    otherItem.querySelector('input[type="checkbox"]').checked = false;
                }
            });
            if (!checkbox.checked) {
                imgItemPackageDefault.querySelector('.img-boxing-checkbox-container').classList.add('active');
            }
            else {
                imgItemPackageDefault.querySelector('.img-boxing-checkbox-container').classList.remove('active');
            }
            if (item.classList.contains('img-boxing-item-package-type')) {
                let event = new Event('change');
                checkbox.dispatchEvent(event);
            }
        });
    });
    imgItemPackageDefault.addEventListener('click', () => {
        imgItemPackageDefault.querySelector('.img-boxing-checkbox-container').classList.add('active');
        const submitButton = document.querySelector('.submit-general-button.active, .tnved-calc-button.active:not(.submit-excel-file):not(.blank-excel-file)');
        if (imgItemPackageDefault.querySelector('.img-boxing-checkbox-container').classList.contains('active')) {
            imgItems.forEach((otherItem) => {
                otherItem.querySelector('input[type="checkbox"]').checked = false;
            });
            if (imgItemPackageDefault.classList.contains('img-boxing-item-package-type')) {
                submitButton.click();
            }
        }
    });
}

function disableBoxingButtons() {
    const imgItemsPackage = document.querySelectorAll('.img-boxing-item-package-type');
    imgItemsPackage.forEach((item) => {
        item.style.pointerEvents = 'none';
        item.querySelector('.img-boxing-checkmark').classList.remove('active');
    });
}

function enableBoxingButtons() {
    const imgItemsPackage = document.querySelectorAll('.img-boxing-item-package-type');
    imgItemsPackage.forEach((item) => {
        item.style.pointerEvents = 'all';
        item.querySelector('.img-boxing-checkmark').classList.add('active');
    });
}