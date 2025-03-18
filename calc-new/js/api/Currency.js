import { State } from "../data/State.js";

export class Currency {
  constructor(apiBaseUrl) {
    this.apiBaseUrl = apiBaseUrl; // Базовый URL Laravel API
  }

  async loadAndSaveRates() {
    try {
      const response = await fetch(`${this.apiBaseUrl}/api/get-currency-rates`);
      if (!response.ok) {
        throw new Error(`Ошибка запроса: ${response.statusText}`);
      }

      const data = await response.json();
      if (data.error) {
        throw new Error(data.error);
      }

      // 1) Сохраняем данные Wisetao в State
      State.currencyRates.wisetao = {
        dollar:
          parseFloat(data.wisetao.dollar) ||
          State.currencyRates.wisetao?.dollar ||
          0,
        yuan:
          parseFloat(data.wisetao.yuan) ||
          State.currencyRates.wisetao?.yuan ||
          0,
      };

      // 2) Сохраняем данные ЦБ РФ в State
      State.currencyRates.cbr = {
        dollar:
          parseFloat(data.cbr.dollar) || State.currencyRates.cbr?.dollar || 0,
        yuan: parseFloat(data.cbr.yuan) || State.currencyRates.cbr?.yuan || 0,
      };
    } catch (err) {
      console.error("Ошибка при загрузке курсов:", err);
    }
  }
}
