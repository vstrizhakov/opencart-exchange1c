<?php
// Heading
$_['heading_title']										= 'Обмен данными с 1C v8.x';
$_['editing']											= 'Редактирование';

// Text
$_['text_module']		= 'Модули';
$_['text_success']		= 'Настройки модуля обновлены!';

$_['tab_general']										= 'Основное';
	$_['actions_log_fieldset']							= 'Журнал действий';
		$_['actions_log_write']							= 'Записывать действия';

$_['tab_product']										= 'Выгрузка номенклатуры';
	$_['product_general_fieldset']						= 'Основное';
		$_['product_general_default_stock_status']		= 'Состоянии на складе при отсутствии товара';

	$_['watermark_fieldset']							= 'Водяные знаки';
		$_['watermark_apply']							= 'Накладывать водяные знаки';
		$_['watermark_image']							= 'Изображение';
	$_['price_types_fieldset']							= 'Типы цен';

$_['tab_order']											= 'Обмен заказами';
	$_['order_general_fieldset']						= 'Основное';

$_['tab_manual']										= 'Ручной импорт';

$_['tab_connection_settings']							= 'Соединение';
	$_['connection_settings_general']					= 'Основное';
	$_['connection_settings_security']					= 'Защита';

$_['text_upload_success']	= 'Импорт завершен';
$_['text_upload_error']		= 'Что-то пошло не так. Загляните в &laquo;Система &rarr; Журнал ошибок&raquo;';
$_['text_max_filesize']		= 'Загружаемый файл не должен превышать %s Мб';

$_['source_code']       = 'Исходный код на GitHub';
$_['text_price_default']	= 'Цена на сайте';

// Entry
$_['entry_username']		= 'Логин';
$_['entry_password']		= 'Пароль';
$_['entry_status']		= 'Статус';
$_['entry_allow_ip']		= 'Разрешенные IP адреса';
$_['entry_allow_ip_tooltip'] = 'Разделять переносом строки. Если пусто, разрешены все адреса.';

$_['entry_config_price_type']	= 'Тип выгружаемой цены';
$_['entry_customer_group']	= 'Группа покупателей';
$_['entry_quantity']		= 'Количество';
$_['entry_priority']		= 'Приоритет';
$_['column_action']		= 'Действие';
$_['entry_flush_product']	= 'Сбрасывать товары';
$_['entry_flush_category']	= 'Сбрасывать категории';
$_['entry_flush_manufacturer']	= 'Сбрасывать производителей';
$_['entry_flush_quantity']	= 'Сбрасывать количество товаров';
$_['entry_flush_attribute']	= 'Сбрасывать атрибуты';
$_['entry_seo_url']		= 'Генерировать SEO URL <br> требуется модуль <a href="http://opencartforum.ru/files/file/332-deadcow-seo-v21-automod/" target="_blank">Deadcow SEO</a>)';
$_['entry_seo_url_deadcow']		= 'через Deadcow SEO';
$_['entry_seo_url_translit']	= 'Транслитерация';

$_['entry_order_status_to_exchange'] 	= 'Выгружать заказы со статусом';
$_['entry_order_status_to_exchange_not'] 	= '- не использовать -';
$_['entry_relatedoptions']	= 'Загружать характеристики как связанные опции (требуется модуль <a href="http://opencartforum.ru/files/file/1501-связанные-опции/">Связанные опции</a>)';
$_['entry_relatedoptions_help']	= "В настройках Связанных опций обязательно должны быть включены опции: 'Пересчитывать количество', 'Обновлять опции', 'Использовать различные варианты связанных опций'";
$_['entry_dont_use_artsync'] = 'Не искать товары по артикулам';

$_['entry_order_status'] 	= 'Статус выгруженых заказов';
$_['entry_order_notify']	= 'Уведомлять пользователей о смене статуса';
$_['entry_order_currency'] 	= 'Обозначение валюты (руб.)';

$_['entry_upload']		= 'Выберите файл';
$_['button_upload']		= 'Загрузить';
$_['button_insert']		= 'Добавить';

// Error
$_['error_permission']		= 'У Вас нет прав для управления этим модулем!';