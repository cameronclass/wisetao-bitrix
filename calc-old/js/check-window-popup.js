document.addEventListener('DOMContentLoaded', () => {
    // checkPopup();
});

function checkPopup() {
    var testWindow = window.open('', '_blank', 'width=1,height=1');
    if (!testWindow || testWindow.closed || typeof testWindow.closed == 'undefined') {
        createMessage();
    } else {
        testWindow.close();
    }
}

function createMessage() {
    let allow_popup_message = document.createElement('div');
    allow_popup_message.innerHTML = `<div class="pop-up-allow-popup-content">
        <div class="pop-up-allow-popup-cross-close">
            <img src="/calc-layout/images/cross.svg" alt="">
        </div>
        <div class="pop-up-allow-popup-container">
            <div class="pop-up-tittle">
                АКТИВИРУЙТЕ ВОЗМОЖНОСТЬ ПОЛУЧАТЬ<br>КОММЕРЧЕСКИЕ ПРЕДЛОЖЕНИЯ В PDF<br>ПО РУЗУЛЬАТАМ РАСЧЕТА КАЛЬКУЛЯТОРА
            </div>
            <div class="pop-up-allow-popup-text">
                ДЛЯ АКТИВАЦИИ НУЖНО РАЗРЕШИТЬ<br>ВСПЛЫВАЮЩИЕ ОКНА ДЛЯ ЭТОГО САЙТА.
            </div>
        </div>
    </div>`;
    document.body.appendChild(allow_popup_message);
    document.querySelector('.pop-up-allow-popup-cross-close').addEventListener('click', (event) => {
        event.stopPropagation();
        document.querySelector('.pop-up-allow-popup-content').style.display = 'none';
    });
}
