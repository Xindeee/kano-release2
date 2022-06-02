<?php

require __DIR__ .'/../vendor/autoload.php';

session_start();

define("EDITOR", Authentication::isAuth() && Authentication::isEditor());


if(Authentication::isEditor()) {
    $editorId = (int)Authentication::getLoginedUserId();
    define("EDITORID", $editorId);
    define("USERID", Authentication::getLoginedUserId());
}
else {
    define("USERID", Authentication::getLoginedUserId());
    define("EDITORID", false);
}

unset($editorId);

