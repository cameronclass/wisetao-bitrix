// config.js
export const CONFIG = {
  redeemBotToken: "7773944407:AAEYhChPWpyvyDvDoBuYmKFaJShfDV30JIQ",
  redeemChatId: -4638573770,
  jsonPath: "../../calc-new/js/rates.json",
  insuranceRate: 0.02, // Процент страховки
  localStorageKey: "ratesData", // ключ для кэширования данных о тарифах
  cacheTTL: 1800000, // Время жизни кэша в мс (30 минут, можно менять)
  tnvedApi: "https://api-calc.wisetao.com:4343/api",
  railwayUrl:
    "https://api-calc.wisetao.com:4343/api/calculate-railway-expedition-delivery",
  kitUrl: "https://api-calc.wisetao.com:4343/api/calculate-kit-delivery",
  api: "https://api-calc.wisetao.com:4343",
  daDataUrl:
    "https://suggestions.dadata.ru/suggestions/api/4_1/rs/geolocate/address",
  daDataToken: "9faf0df4e5f608e5e0f42f750b27009d5b4847ae",
};
