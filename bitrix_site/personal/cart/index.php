<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Персональный раздел");
?><?$APPLICATION->IncludeComponent("bitrix:sale.basket.basket", "basket", Array(
	"ACTION_VARIABLE" => "basketAction",	// Название переменной действия
		"AUTO_CALCULATION" => "Y",	// Автопересчет корзины
		"COLUMNS_LIST" => array(	// Выводимые колонки
			0 => "NAME",
			1 => "DISCOUNT",
			2 => "WEIGHT",
			3 => "DELETE",
			4 => "DELAY",
			5 => "TYPE",
			6 => "PRICE",
			7 => "QUANTITY",
		),
		"COUNT_DISCOUNT_4_ALL_QUANTITY" => "N",
		"GIFTS_BLOCK_TITLE" => "Выберите один из подарков",
		"GIFTS_CONVERT_CURRENCY" => "N",
		"GIFTS_HIDE_BLOCK_TITLE" => "N",
		"GIFTS_HIDE_NOT_AVAILABLE" => "N",
		"GIFTS_MESS_BTN_BUY" => "Выбрать",
		"GIFTS_MESS_BTN_DETAIL" => "Подробнее",
		"GIFTS_PAGE_ELEMENT_COUNT" => "4",
		"GIFTS_PLACE" => "BOTTOM",
		"GIFTS_PRODUCT_PROPS_VARIABLE" => "prop",
		"GIFTS_PRODUCT_QUANTITY_VARIABLE" => "",
		"GIFTS_SHOW_DISCOUNT_PERCENT" => "Y",
		"GIFTS_SHOW_IMAGE" => "Y",
		"GIFTS_SHOW_NAME" => "Y",
		"GIFTS_SHOW_OLD_PRICE" => "N",
		"GIFTS_TEXT_LABEL_GIFT" => "Подарок",
		"HIDE_COUPON" => "Y",	// Спрятать поле ввода купона
		"PATH_TO_ORDER" => "/personal/order/",	// Страница оформления заказа
		"PRICE_VAT_SHOW_VALUE" => "N",	// Отображать значение НДС
		"QUANTITY_FLOAT" => "N",	// Использовать дробное значение количества
		"SET_TITLE" => "Y",	// Устанавливать заголовок страницы
		"TEMPLATE_THEME" => "blue",	// Цветовая тема
		"USE_GIFTS" => "N",	// Показывать блок "Подарки"
		"USE_PREPAYMENT" => "N",	// Использовать предавторизацию для оформления заказа (PayPal Express Checkout)
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>