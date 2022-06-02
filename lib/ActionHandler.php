<?php

class ActionHandler {
    
    //Авторизироваться в системе    
    public static function login($__login, $__password) {
        $isLogined = Authentication::login($__login, $__password);
        echo ($isLogined) ? 'sucess' : 'error';
    }
    
    //Выйти из системы
    public static function logout() {
        Authentication::logout();
        CommonFunctions::location('?');
    }

    //Отобразить страницу создания опроса
    public static function show_create_interview($__intvName = false, $__description = false, $__category = false, $__functions = false) {
        //Создание опроса
        ! $__intvName ?
        : EditorPage::createPoll($__intvName, $__description,$__category, $__functions);
         
        //Пользователь должен быть с правами редактором
        if (!Authentication::isEditor())
            Templater::loginPage ();
        
        EditorPage::show_create_interview();
    }
    
    //Редактировать опрос 
    public static function edit_poll($__pol_id) {
        EditorPage:: show_edit_poll($__pol_id);
    }
    
    //Сохранить редактированный опрос
    public static function save_poll_edits($__id, $__intvName, $__description, $__category, $__function) {
        EditorPage::save_poll_edits($__id, $__intvName, $__description, $__category, $__function);
    }
        
    //Пройти опрос
    public static function take_poll($__poll_id) {
        UserPage::take_poll($__poll_id);
    }

    //Отправить результаты опроса
    public static function send_answer ($__action, $__poll_id, $__answer) {
        
        //toDo продумать взаимодействие с таблицей приглашений + поле login
        //toDo аутентификация незнакомых пользователей(при обновлении страницы сейчас выдает новый id)
        
        $fio = isset($__answer['fio']) ? $__answer['fio'] : '';
        $comment = isset($__answer['comment']) ? $__answer['comment'] : '';        
       
        //регистрация опрашиваемого
        DataStorage::createPassing($__poll_id, $fio, $comment, date("Y-m-d H:m:s"));
        
        //id вновь опрошенного пользователя
        $pass_id = DataStorage::getMaxPassingId()['max'];
        
        //регистрация ответа опрашиваемого
        foreach ($__answer['functions'] as $currentAnswer) {
            $function_id = isset($currentAnswer['id']) ? (int)$currentAnswer['id'] : '';
            $importance = isset($currentAnswer['importance']) ? (int)$currentAnswer['importance'] : ''; 
            $presence = isset($currentAnswer['presence']) ? (int)$currentAnswer['presence'] : ''; 
            $absence = isset($currentAnswer['absence']) ? (int)$currentAnswer['absence'] : '';
            
            //$comment = isset($currentAnswer['comment']) ? (int)$currentAnswer['comment'] : ''; 
            
            //регистрация ответа опрашиваемого
            DataStorage::sendAnswer($function_id, $pass_id, $importance, $presence, $absence);    
        }
        
        //Отобразить страницу с результатами по текущему опросу.
    }
    
    public static function show_mode_selection() {
        self::getModeSelection();
    }
    public static function getModeSelection() {
        //Пользователь Авторизован
        if (Authentication::isAuth()) {
            if (Authentication::isEditor())
                EditorPage::show_mainEditorPage();
            else
                UserPage::show_mainUserPage();
        }
        
        //Пользователь не авторизован
        else
            Templater::loginPage();
        die();
    }
}
