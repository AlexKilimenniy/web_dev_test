<?php

/**
 * Подключение локального конфига - /config.local.php (не добавляется в репозиторий) 
 * или оригинального - /config.origin.php (добавляется в репозиторий)
 */
if (file_exists(__DIR__.DIRECTORY_SEPARATOR.'config.local.php')) {
    include __DIR__.DIRECTORY_SEPARATOR.'config.local.php';
} else {
    include __DIR__.DIRECTORY_SEPARATOR.'config.origin.php';
}