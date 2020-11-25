<?php
header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set('Europe/Minsk');
session_start();

// разбиение входящего url'а
$url = $_SERVER['REQUEST_URI'];
$url = preg_replace('/\?(.*?)$/', '', $url);
$url = explode("/", $url);

//--
require_once "init.php";

function clear_url($url) {
    $new_url = array();
    foreach ($url as $k=>$v) {
        if(is_null($v) || trim($v)=='' || $v==SITE_DIR || !preg_match("/^[a-zA-Z0-9-_\.\=\%\&\?]+$/", $v))
            unset($url[$k]);
        else
            $new_url[] = $v;
    }
    return $new_url;
}

function just_clear_url($url) {
    foreach ($url as $k=>$v) {
        if(trim($v==''||$v==SITE_DIR)) unset($url[$k]);
    }
    return $url;
}

$url = clear_url($url);

if(sizeof($url)==0) {
    // index page
    require_once("modules/index.php");
    exit();
}

$clear_url = join("/", just_clear_url($url));
$just_clear_url = $url;
$mod_file = '';
$is_html = false;
// определяем содержит ли запрос .html
if(preg_match("!\.(html)!si", $url[count($url)-1]) && strpos($url[count($url)-1], '.html') > 0) {
    array_pop($just_clear_url);
    $is_html = true;
    $just_clear_url = join("/", clear_url($just_clear_url));
}
// если есть .html, то при поиске модуля не используем имя страницы, чтобы не выбрать модуль по случайному совпадению с именем страницы, вроде index.html = index модуль
if($is_html)
    $clear_url = $just_clear_url;
// Ищем в урле зарегистрированный модуль
foreach ($modules as $mod) {
    if(preg_match('/'.$mod.'/', $clear_url)) {
        $mod_file = 'modules/' . $mod . '.php';
        if(!file_exists($mod_file)) {
            $mod_file = '';
        }
        else {
            break;
        }
    }
}
// если есть модуль и нет html с не отключенной категорией -модулим
if($mod_file != '' && !$is_html) {
    require_once($mod_file);
    die();
    // если урл заканчивается вызовом хтмл-страницы и она находится в существующей, открытой категории
} elseif($is_html) {

} else {
    header("HTTP/1.0 404 Not Found");
    $smarty->display('404.tpl');
    die();
}