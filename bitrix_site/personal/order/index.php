<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Заказ");
?><?$APPLICATION->IncludeComponent("bitrix:sale.order.ajax", "my_order_ajax", Array(
	"ADDITIONAL_PICT_PROP_2" => "IMAGES",	// Дополнительная картинка [Велосипеды]
		"ADDITIONAL_PICT_PROP_3" => "IMAGES",	// Дополнительная картинка [Гироскутеры]
		"ALLOW_AUTO_REGISTER" => "N",	// Оформлять заказ с автоматической регистрацией пользователя
		"ALLOW_NEW_PROFILE" => "N",	// Разрешить множество профилей покупателей
		"ALLOW_USER_PROFILES" => "N",	// Разрешить использование профилей покупателей
		"BASKET_IMAGES_SCALING" => "standard",	// Режим отображения изображений товаров
		"BASKET_POSITION" => "before",	// Расположение списка товаров
		"COMPATIBLE_MODE" => "Y",	// Режим совместимости для предыдущего шаблона
		"DELIVERIES_PER_PAGE" => "8",	// Количество доставок на странице
		"DELIVERY_FADE_EXTRA_SERVICES" => "N",	// Дополнительные услуги, которые будут показаны в пройденном (свернутом) блоке
		"DELIVERY_NO_AJAX" => "N",	// Рассчитывать сразу доставки с внешним доступом к сервисам
		"DELIVERY_NO_SESSION" => "Y",	// Проверять сессию при оформлении заказа
		"DELIVERY_TO_PAYSYSTEM" => "d2p",	// Последовательность оформления
		"DISABLE_BASKET_REDIRECT" => "N",	// Оставаться на странице оформления заказа, если список товаров пуст
		"ONLY_FULL_PAY_FROM_ACCOUNT" => "N",	// Разрешить оплату с внутреннего счета только в полном объеме
		"PATH_TO_AUTH" => "/auth/",	// Путь к странице авторизации
		"PATH_TO_BASKET" => "/personal/cart/",	// Путь к странице корзины
		"PATH_TO_PAYMENT" => "/personal/payment/",	// Страница подключения платежной системы
		"PATH_TO_PERSONAL" => "/personal/",	// Путь к странице персонального раздела
		"PAY_FROM_ACCOUNT" => "N",	// Разрешить оплату с внутреннего счета
		"PAY_SYSTEMS_PER_PAGE" => "8",	// Количество платежных систем на странице
		"PICKUPS_PER_PAGE" => "5",	// Количество пунктов самовывоза на странице
		"PRODUCT_COLUMNS_HIDDEN" => "",	// Свойства товаров отображаемые в свернутом виде в списке товаров
		"PRODUCT_COLUMNS_VISIBLE" => array(	// Выбранные колонки таблицы списка товаров
			0 => "PREVIEW_PICTURE",
			1 => "PROPS",
		),
		"SEND_NEW_USER_NOTIFY" => "N",	// Отправлять пользователю письмо, что он зарегистрирован на сайте
		"SERVICES_IMAGES_SCALING" => "standard",	// Режим отображения вспомагательных изображений
		"SET_TITLE" => "Y",	// Устанавливать заголовок страницы
		"SHOW_BASKET_HEADERS" => "N",	// Показывать заголовки колонок списка товаров
		"SHOW_COUPONS_BASKET" => "N",	// Показывать поле ввода купонов в блоке списка товаров
		"SHOW_COUPONS_DELIVERY" => "N",	// Показывать поле ввода купонов в блоке доставки
		"SHOW_COUPONS_PAY_SYSTEM" => "N",	// Показывать поле ввода купонов в блоке оплаты
		"SHOW_DELIVERY_INFO_NAME" => "Y",	// Отображать название в блоке информации по доставке
		"SHOW_DELIVERY_LIST_NAMES" => "Y",	// Отображать названия в списке доставок
		"SHOW_DELIVERY_PARENT_NAMES" => "Y",	// Показывать название родительской доставки
		"SHOW_MAP_IN_PROPS" => "N",	// Показывать карту в блоке свойств заказа
		"SHOW_NEAREST_PICKUP" => "N",	// Показывать ближайшие пункты самовывоза
		"SHOW_ORDER_BUTTON" => "final_step",	// Отображать кнопку оформления заказа (для неавторизованных пользователей)
		"SHOW_PAY_SYSTEM_INFO_NAME" => "Y",	// Отображать название в блоке информации по платежной системе
		"SHOW_PAY_SYSTEM_LIST_NAMES" => "Y",	// Отображать названия в списке платежных систем
		"SHOW_STORES_IMAGES" => "Y",	// Показывать изображения складов в окне выбора пункта выдачи
		"SHOW_TOTAL_ORDER_BUTTON" => "Y",	// Отображать дополнительную кнопку оформления заказа
		"SKIP_USELESS_BLOCK" => "Y",	// Пропускать шаги, в которых один элемент для выбора
		"TEMPLATE_LOCATION" => "popup",	// Визуальный вид контрола выбора местоположений
		"TEMPLATE_THEME" => "red",	// Цветовая тема
		"USE_CUSTOM_ADDITIONAL_MESSAGES" => "N",	// Заменить стандартные фразы на свои
		"USE_CUSTOM_ERROR_MESSAGES" => "N",	// Заменить стандартные фразы на свои
		"USE_CUSTOM_MAIN_MESSAGES" => "N",	// Заменить стандартные фразы на свои
		"USE_PRELOAD" => "Y",	// Автозаполнение оплаты и доставки по предыдущему заказу
		"USE_PREPAYMENT" => "N",	// Использовать предавторизацию для оформления заказа (PayPal Express Checkout)
		"USE_YM_GOALS" => "N",	// Использовать цели счетчика Яндекс.Метрики
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>