<div class="main-calc-first__block from-to-container-main">
    <div class="main-calc-first__choose">
        <h4 class="main-calc__title _small">
            <span class="main-calc__title_icon"></span>
            <span class="main-calc__title_text">Меня интересует</span>
        </h4>

        <div class="main-calc-first__choose_block">
            <label class="main-calc-radio custom-radio-redeem">
                <span class="main-calc-radio__title">Только доставка</span>
                <input class="main-calc-radio__input" type="radio" name="delivery-option" value="delivery-only" >
                <span class="main-calc-radio__mark"></span>
            </label>

            <label class="main-calc-radio custom-radio-redeem custom-radio-redeem2">
                <span class="main-calc-radio__title">Доставка и выкуп</span>
                <input class="main-calc-radio__input" type="radio" name="delivery-option" value="delivery-and-pickup">
                <span class="main-calc-radio__mark"></span>
                <span class="calc-tooltip">
                    <span class="calc-tooltip__title">Выкуп Товара</span>
                    <span class="calc-tooltip__text">
                        Помимо доставки мы осуществляем выкуп товаров с фабрик Китая, от поставщиков и из интернет-магазинов.
                        Если вам необходим выкуп, воспользуйтесь этой настройкой.
                        Узнать подробнее о <a class="calc-tooltip__link" target="_blank" href="https://wisetao.com/from-china/transaction/full-deal/">выкупе</a>
                    </span>
                </span>
            </label>
        </div>
    </div>
    <div class="main-calc-first__divider"></div>
    <div class="main-calc-first__from-to">
        <div class="main-calc-first__from-to_from group-input">
            <div class="group-input__title">Откуда</div>
            <div class="group-input__input">
                <input type="text" placeholder="Хэйхэ" disabled>
                <svg class="group-input__input_svg" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="6" y="10" width="12" height="8" rx="2" fill="#91969b"/>
                    <path d="M9 10V9C9 7.34315 10.3431 6 12 6C13.6569 6 15 7.34315 15 9V10" stroke="#91969b" stroke-width="2"/>
                </svg>
            </div>
        </div>
        <div class="main-calc-first__from-to_arrow">
            <svg class="arrow-to" width="413.98407" height="400.00037" viewBox="0 0 12.419522 12.000011" fill="none" version="1.1" id="svg1" sodipodi:docname="arrow-sm-down-svgrepo-com.svg" inkscape:version="1.3 (0e150ed6c4, 2023-07-21)" xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape" xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd" xmlns="http://www.w3.org/2000/svg" xmlns:svg="http://www.w3.org/2000/svg">
                <path d="M 1.0000048,6.0000048 H 11.419517 m 0,0 -5,5.0000002 m 5,-5.0000002 -5,-5" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" id="path1" sodipodi:nodetypes="cccccc" style="fill-opacity:1;stroke-width:2.00001;stroke-dasharray:none;stroke-opacity:1"/>
            </svg>
        </div>
        <div class="main-calc-first__from-to_to">
            <div class="arrival-container group-input__input">
                <label for="arrival-input" class="arrival-input-label">Куда</label>
                <input type="text" id="arrival-input" class="calc-text-input to-arrival-input general-input dimensions-calc-input" name="arrival">
                <div class="available-countries">
                    <div>
                        Страны доступные для заказа:
                    </div>
                    <div class="available-country">
                        Россия
                    </div>
                    <div class="available-country"> <!--unavailable-country - класс, если нужно выключить-->
                        Кыргызстан
<!--                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">-->
<!--                        <rect x="6" y="10" width="12" height="8" rx="2" fill="#91969b"/>-->
<!--                        <path d="M9 10V9C9 7.34315 10.3431 6 12 6C13.6569 6 15 7.34315 15 9V10" stroke="#91969b" stroke-width="2"/>-->
<!--                    </svg>-->
                    </div>
                    <div class="available-country">
                        Казахстан
<!--                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">-->
<!--                        <rect x="6" y="10" width="12" height="8" rx="2" fill="#91969b"/>-->
<!--                        <path d="M9 10V9C9 7.34315 10.3431 6 12 6C13.6569 6 15 7.34315 15 9V10" stroke="#91969b" stroke-width="2"/>-->
<!--                    </svg>-->
                    </div>
                    <div class="available-country unavailable-country">
                        США
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="6" y="10" width="12" height="8" rx="2" fill="#91969b"/>
                            <path d="M9 10V9C9 7.34315 10.3431 6 12 6C13.6569 6 15 7.34315 15 9V10" stroke="#91969b" stroke-width="2"/>
                        </svg>
                    </div>
                </div>
                <div class="input-notice" style="top: 72px"></div>
            </div>
        </div>
        <div class="main-calc-first__from-to_check">
            <label class="main-calc-checkbox custom-checkbox-insurance">
                <input type="checkbox" name="insurance" class="main-calc-checkbox__input">
                <span class="main-calc-checkbox__mark"></span>
                <span class="main-calc-checkbox__title">Страховать груз</span>
                <span class="calc-tooltip">
                    <span class="calc-tooltip__title">СТРАХОВКА ГРУЗА</span>
                    <span class="calc-tooltip__text">
                        Если поставить галочку расчет стоимости доставки будет учитывать страховку груза. Стоимость страховки составит 2% от стоимости товара +2% от стоимости доставки.
                    </span>
                </span>
            </label>

        </div>
    </div>
</div>

