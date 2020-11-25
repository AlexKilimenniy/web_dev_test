<?php

// создаем строку путей
$paths = implode(PATH_SEPARATOR,
	array_merge(
		explode(PATH_SEPARATOR, get_include_path()),
	    array(
	       	SITE_ROOT.'classes/',
	       	SITE_ROOT.'models/',
	    )
	)
);

// устанавливаем пути по которым происходит поиск подключаемых файлов
set_include_path($paths);

// автозагрузка классов
function autoload($class_name)
{
    // У Smarty свой автозагрузчик
    if (strpos($class_name, 'Smarty_') !== false)
    {
        return false;
    }
    require_once($class_name.'.class.php');
}
spl_autoload_register('autoload');
