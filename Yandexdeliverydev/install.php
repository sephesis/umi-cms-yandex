<?php
	/** Установщик модуля */

	/** @var array $INFO реестр модуля */
	$INFO = [
		'name' => 'Yandexdeliverydev', // Имя модуля
		'config' => '1', // У модуля есть настройки
		'default_method_admin' => 'config', // Метод по умолчанию в административной части
	];

	/** @var array $COMPONENTS файлы модуля */
	$COMPONENTS = [
		'./classes/components/Yandexdeliverydev/admin.php',
		'./classes/components/Yandexdeliverydev/class.php',
		'./classes/components/Yandexdeliverydev/customAdmin.php',
		'./classes/components/Yandexdeliverydev/customMacros.php',
		'./classes/components/Yandexdeliverydev/i18n.php',
		'./classes/components/Yandexdeliverydev/install.php',
		'./classes/components/Yandexdeliverydev/lang.php',
		'./classes/components/Yandexdeliverydev/macros.php',
		'./classes/components/Yandexdeliverydev/permissions.php',
	];

