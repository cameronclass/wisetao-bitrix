// main.js

import { CalculatorApp } from "./App.js";
import { PdfPrepared } from "./pdf/PdfPrepare.js?v=2.2";
import { PdfGenerate } from "./pdf/PdfGenerate.js";
import { State } from "./data/State.js";
import UiPrepare from "./ui/UiPrepare.js";
import RedeemManager from "./data/RedeemManager.js";
import { ClientData } from "./data/ClientData.js";

const fields = {
  totalCost: document.querySelector('input[name="total_cost"]'),
  currency: document.querySelector('input[name="total_currency"]'),
  totalWeight: document.querySelector('input[name="total_weight"]'),
  totalVolume: document.querySelector('input[name="total_volume"]'),
  totalVolumeCalculated: document.querySelector(
    'input[name="total_volume_calculated"]'
  ),
  volumeLength: document.querySelector('input[name="volume_length"]'),
  volumeWidth: document.querySelector('input[name="volume_width"]'),
  volumeHeight: document.querySelector('input[name="volume_height"]'),
  weightVolumeChange: document.querySelector(
    'input[name="weight_volume_change"]'
  ),
  quantity: document.querySelector('input[name="quantity"]'),
  quantity_checkbox: document.querySelector('input[name="quantity_checkbox"]'),
  category: document.querySelectorAll('input[name="category"]'),
  packingType: document.querySelectorAll('input[name="packing-type"]'),
  insurance: document.querySelector('input[name="insurance"]'),
  brand: document.querySelector('input[name="brand"]'),
  tnvedInput: document.querySelector('input[name="tnved_input"]'),
  address: document.querySelector('input[name="address"]'),
  addressCheck: document.querySelector('input[name="address_checkbox"]'),
  deliveryOption: document.querySelector('input[name="delivery-option"]'),
  nds: document.querySelector('input[name="nds"]'),
  custom_nds: document.querySelector('input[name="custom_nds"]'),
};

const redeem = {
  /* rootSelector: ".client-redeem-data",
  addButtonSelector: ".add-redeem", */
};

document.addEventListener("DOMContentLoaded", () => {
  /* Ui Prepare */
  new UiPrepare()._init();

  /* Client Data */
  new ClientData();

  /* Калькулятор */
  new CalculatorApp(fields);

  /* PDF */
  new PdfGenerate(PdfPrepared, State);

  /* Data Redeem */
  new RedeemManager(redeem);
});
