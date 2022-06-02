<?php

/* 
 * Класс для вспомогательных функцийы
 */

class CommonFunctions {
    public static function location($__url) {
        header("Location: $__url");
        die();
    }
}