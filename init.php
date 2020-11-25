<?php

    define("SITE_DIR","");
    define("SITE_ROOT", $_SERVER['DOCUMENT_ROOT']."/");
    
    require_once SITE_ROOT."config.php";
    require_once SITE_ROOT."config/autoload.php";
	
	if(DEBUG_MODE==1) {
    	error_reporting(E_ALL & ~E_NOTICE);
    } else {
    	error_reporting(0);
    }

    // зарегистрированные модули
    $modules = array('cookery');
	$db = new Database();

    $smarty = new MainSmarty();