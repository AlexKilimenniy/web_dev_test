<?php
	
class MainSmarty extends SmartyBC
{
    public function __construct()
    {
        parent::__construct();
        
        
        $this->setTemplateDir(array(
                // Массив дирректорий казывается по приоритету поиска в них шаблонов
                'general' 		=> SITE_ROOT.'templates',
            ))
            ->setCompileDir(SITE_ROOT.'compile')
            ->setCacheDir(SITE_ROOT.'cache')
            ->setConfigDir(SITE_ROOT.'configs');
    }
}
