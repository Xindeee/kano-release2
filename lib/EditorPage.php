<?php

class EditorPage {
    
    public static function baseEditorPage($__title, $__content, $__styles, $__scripts) {
        
        Templater::$__dextep = new Dextep();
        
        //Инициализация переменных в шаблон
        Templater::$__dextep->setVar('page_title', $__title);
        
        
        //Формирование html
        $header = Templater::$__dextep->getTemplate('common/header');
        $content = $header.$__content;
        
        $baseStyles  = [];
        $baseScripts = [];
        
        $adding_styles  = array_merge($__styles, $baseStyles); 
        $adding_scripts = array_merge($__scripts, $baseScripts); 
        
        Templater::basePage($__title, $content, $adding_styles, $adding_scripts);
}
    
    public static function show_mainEditorPage() {
        //Доступные текущему редактору опросы
        $editorId = Authentication::getLoginedUserId();
        
        $polls = DataStorage::getAvailablePolls($editorId);
        
        foreach ($polls as &$currentPoll) {
            
            $answersCount = DataStorage::getCountOfAnswersInPoll($currentPoll['id'])['count'];
            
            $currentPoll['answersCount'] = $answersCount;
        }
        
        Templater::$__dextep = new Dextep();
        
        Templater::$__dextep->setVar('polls', $polls);
        Templater::$__dextep->setVar('isEditor', true);
        
        
        $content = Templater::$__dextep->getTemplate('/editor/main');
        
        $scripts = ['../templates/editor/main'];
        self::baseEditorPage('Главная страница', $content, [], $scripts);
    }
    
    //отобразить страницу редактирования опроса
    public static function show_edit_poll($__poll_id) {
        
        Templater::$__dextep = new Dextep();
        
        $poll = DataStorage::getPollById($__poll_id);
        $categories = [];
        $functions  = [];
        
        //Обращение по неверному id
        if(!$poll)
            Templater::errorPage('Ошибка редактирования', 'Проверьте правильность вводимых данных');
        
        $name = isset($poll['title']) ? $poll['title'] : '';
        $desctiption = isset($poll['description']) ? $poll['description'] : '';
        $categories  = DataStorage::getCategoriesByPollId($__poll_id);
        $functions   = DataStorage::getfunctionsByPollId($__poll_id);
        
        Templater::$__dextep->setVar('id', $__poll_id);
        Templater::$__dextep->setVar('name', $name);
        Templater::$__dextep->setVar('description', $desctiption);
        Templater::$__dextep->setVar('categories', $categories);
        Templater::$__dextep->setVar('functions', $functions);
        
        $content = Templater::$__dextep->getTemplate('/editor/editPoll');
        
        $scripts = ['../templates/common/polls'];
        
        self::baseEditorPage('Редактирование опроса', $content, [], $scripts);
    }
    
    //Сохранить отредактированный опрос
    public static function save_poll_edits($__poll_id, $__intvName, $__description, $__category, $__function) {
        
        //Изменение опроса
        DataStorage::EditPollName($__poll_id, $__intvName);
        DataStorage::EditPollDescription($__poll_id, $__description);
        
        //Очистка категорий и функций
        DataStorage::deletePollCategories($__poll_id);
        DataStorage::deletePollFunctions($__poll_id);
        
        //Добавление категорий опроса в опрос
        if(is_array($__category)) {
            foreach($__category as $currentCategory)
                DataStorage::createCategory($__poll_id, $currentCategory);
        }
        
        //Добавление функций опроса в опрос
        if(is_array($__function)) {
            foreach($__function as $currentFunction)
                DataStorage::createFunction($__poll_id, $currentFunction);
        }
    }
    
    //отобразить страницу создания опроса
    public static function show_create_interview() {
        Templater::$__dextep = new Dextep();
        
        $content = Templater::$__dextep->getTemplate('/editor/createIntv');
        
        
        $scripts = ['../templates/common/polls'];
        self::baseEditorPage('Создание опроса', $content, [], $scripts);
    }
    
    //Создать курс
    
    public static function createPoll($__intvName, $__description, $__category, $__functions) {
        $isOpen = 0;
        $owner = Authentication::getLoginedUserId();
        
        //Создание опроса
        DataStorage::createPoll($__intvName, $__description,  $isOpen, $owner);
        
        $poll_id = DataStorage::getPollByName($__intvName)['id'];
        
        //Добавление категорий пользователей в опрос
        if($__category) {
            foreach($__category as $currentCategory)
                DataStorage::createCategory($poll_id, $currentCategory);
        }
        
        //Добавление функций опроса в опрос
        if($__functions) {
            foreach($__functions as $currentFunction)
                DataStorage::createFunction($poll_id, $currentFunction);
        }
        
    }
}

