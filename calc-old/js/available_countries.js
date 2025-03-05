function setPositionCounriesContainer() {
    let countriesContainer = document.querySelector('.available-countries');
    let arrivalContainer = document.querySelector('.arrival-container');
    let toponymInput = document.querySelector('.to-arrival-input');
    if (countriesContainer && toponymInput) {
        toponymInput.addEventListener('focus', () => {
            if (toponymInput.value === '') {
                let inputRect = toponymInput.getBoundingClientRect();
                // Устанавливаем ширину и позицию countriesContainer
                countriesContainer.style.width = `${inputRect.width}px`;
                countriesContainer.style.left = 0;
                countriesContainer.style.top = `${arrivalContainer.getBoundingClientRect().height}px`;
                countriesContainer.style.display = 'block';
                toponymInput.style.borderBottomLeftRadius = '0';
                toponymInput.style.borderBottomRightRadius = '0';
                countriesContainer.nextElementSibling.style.display = 'none';
                toponymInput.style.border = 'none';
            }
        });
        toponymInput.addEventListener('blur', () => {
            countriesContainer.style.display = 'none';
            toponymInput.style.borderBottomLeftRadius = '10px';
            toponymInput.style.borderBottomRightRadius = '10px';
        });
    }
}