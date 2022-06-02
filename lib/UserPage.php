<?php

class UserPage {
    
    public static function baseUserPage($__title, $__content, $__styles, $__scripts) {
        
        Templater::$__dextep = new Dextep();
        
        //Инициализация переменных в шаблон
        Templater::$__dextep->setVar('page_title', $__title);
        
        
        //Формирование html
        $header = Templater::$__dextep->getTemplate('common/header');
        $content = $header.$__content;
        
        $baseStyles  = [];
        $baseScripts = ['../templates/user/user_main'];
        
        $adding_styles  = array_merge($__styles, $baseStyles); 
        $adding_scripts = array_merge($__scripts, $baseScripts); 
        
        Templater::basePage($__title, $content, $adding_styles, $adding_scripts);
}

    public static function show_mainUserPage() {
        Templater::loginPage();
    }
    
    public static function take_poll($__poll_id) {
        Templater::$__dextep = new Dextep();
        $categories = DataStorage::getCategoriesByPollId($__poll_id);
        $functions  = DataStorage::getfunctionsByPollId($__poll_id);
        
        $functions_one = array_combine(range(1, count($functions)), array_values($functions));
        Templater::$__dextep->setVar('categories', $categories);
        Templater::$__dextep->setVar('functions', $functions_one);
        
        $content = Templater::$__dextep->getTemplate('/user/main');
        
        $poll = DataStorage::getPollById($__poll_id);
        $styles = ['core.min'];
        $scripts = [];
        self::baseUserPage('Прохождение опроса', $content, $styles, $scripts);
    }
    
    public static function send_answer($__action, $__id, $__answer) {
        
    }
}

