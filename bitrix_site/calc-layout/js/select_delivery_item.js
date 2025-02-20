function initializeSelectDeliveryItem() {
    // if (!deliveryItems) {
        deliveryItems = document.querySelectorAll('.list-help');
        deliveryItems.forEach((deliveryItem) => {
            deliveryItem.addEventListener('click', selectDeliveryItem);
        });
    document.querySelectorAll('.offer-button').forEach(button => {button.setAttribute('disabled', '')});
    // }

}

function selectDeliveryItem(event) {
    const selectItem = document.querySelector('.list-help.selected');
    let offerButton = event.currentTarget.querySelector('.report-white-data.offer-button.report-cargo-data');
    let mainOfferButton = document.querySelector('.main-offer-button');
    if (selectItem) {
        let otherOfferButton = selectItem.querySelector('.report-white-data.offer-button.report-cargo-data');
        if (selectItem !== event.currentTarget) {
            selectItem.classList.remove('selected');
            otherOfferButton.setAttribute('disabled', '');
        }
    }
    event.currentTarget.classList.toggle('selected');
    if (event.currentTarget.classList.contains('selected')) {
        offerButton.removeAttribute('disabled');
        mainOfferButton.removeAttribute('disabled');
    }
    else {
        offerButton.setAttribute('disabled', '');
        mainOfferButton.setAttribute('disabled', '');
    }
}