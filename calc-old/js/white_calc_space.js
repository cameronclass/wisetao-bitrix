function initializeWhiteCalcSpace() {
    const whileCalcContainer = document.querySelector('.calc-container:not(.redeem-data)');
    const boxingContainer = document.querySelector('.boxing-content-container');
    if (activeButton.dataset.type === 'comparison' || activeButton.dataset.type === 'white') {
        whileCalcContainer.classList.add('comparison-calc-container');
        boxingContainer.classList.add('comparison-boxing-container');
        whileCalcContainer.style.height = '';
    }
    else {
        whileCalcContainer.classList.remove('comparison-calc-container');
        boxingContainer.classList.remove('comparison-boxing-container');
        whileCalcContainer.style.height = '200px';
    }

}