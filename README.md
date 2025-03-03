# Wisetao Bitrix - Инструкция по развёртыванию и настройке

## 1. Описание проекта
Этот проект представляет собой сайт на платформе Bitrix, который сейчас разрабатывается и тестируется локально через XAMPP.

## 2. Требования
- **PHP:** версия >8
- **База данных:** MySQL (используется MariaDB в XAMPP)
- **Bitrix CMS**
- **Веб-сервер:** Apache (или другой, поддерживающий PHP)

## 3. Настройки базы данных
Перед загрузкой проекта на хостинг необходимо обновить конфигурацию базы данных.

Данные для подключения локально:

`/bitrix/.settings.php`


```php
array (
    'className' => '\\Bitrix\\Main\\DB\\MysqliConnection',
    'host' => 'localhost',
    'database' => 'bitrix_local',
    'login' => 'root',
    'password' => '',
    'options' => 2,
);
```


`/bitrix/php_interface/dbconn.php`

```php
define("BX_USE_MYSQLI", true);
define("DBPersistent", false);
$DBType = "mysql";
$DBHost = "localhost";
$DBLogin = "root";
$DBPassword = "";
$DBName = "bitrix_local";
$DBDebug = false;
$DBDebugToFile = false;
```

## 4. Подготовка перед загрузкой на хостинг
Перед переносом проекта на хостинг необходимо изменить параметры базы данных в следующих файлах:

1. **Файл:** `/bitrix/.settings.php`
2. **Файл:** `/bitrix/php_interface/dbconn.php`

### Что менять:
- `host` — указываем хостинг-сервер базы данных (обычно `localhost`, но может отличаться).
- `database` — название базы данных на сервере.
- `login` — логин пользователя базы данных.
- `password` — пароль пользователя базы данных.

Пример изменения в `dbconn.php`:
```php
$DBHost = "new_host";
$DBLogin = "new_user";
$DBPassword = "new_password";
$DBName = "new_database";
```

