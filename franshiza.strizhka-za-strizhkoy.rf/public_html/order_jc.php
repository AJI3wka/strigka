<?php
error_reporting(-1);
$root=__DIR__.DIRECTORY_SEPARATOR;
require $root.'amo/prepare.php'; #Здесь будут производиться подготовительные действия, объявления функций и т.д.
require $root.'amo/auth.php'; #Здесь будет происходить авторизация пользователя
require $root.'amo/account_current.php'; #Здесь мы будем получать информацию об аккаунте
require $root.'amo/fields_info.php'; #Получим информацию о полях
require $root.'amo/contacts_list.php'; #Проверяем, существует ли уже контакт с таким email
require $root.'amo/lead_add.php'; #Здесь будет происходить добавление сделки
require $root.'amo/contact_add.php'; #Здесь будет происходить добавление контакт
?>
