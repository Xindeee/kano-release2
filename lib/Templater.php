<?php
class Templater {
    public static $__dextep;
    
    public static  $_styles = ['all_v6.min','mdb'];
    private static $_scripts = ['mdb.min','jquery_v3.2.1.min'];
    
    public static function basePage($__title, $__content = '', $__stylesheets = array(), $__scripts = array()) {
        Templater::$__dextep = new Dextep();
       
        $resultStyles =  array_merge(Templater::$_styles, $__stylesheets);
        $resultScripts = array_merge(Templater::$_scripts, $__scripts);
        
        Templater::$__dextep->setVar('page_title', $__title);
        Templater::$__dextep->setVar('content', $__content);
	
        //Итоговые таблицы стилей и скриптов
        Templater::$__dextep->setVar('stylesheets', $resultStyles);
        Templater::$__dextep->setVar('scripts', $resultScripts);

        echo Templater::$__dextep->getTemplate('main');
        die();
    }
    
    public static function loginPage() {
        
        Templater::$__dextep = new Dextep();
   
        
        $stylesheets = ['bootstrap.min','all_v6.min'];
        $scripts     = [ 'jquery_v3.2.1.min','../templates/common/login'];
        
      
        
        Templater::$__dextep->setVar('scripts', $scripts);
        Templater::$__dextep->setVar('stylesheets', $stylesheets);
        Templater::$__dextep->setVar('page_title', 'Страница авторизации');
        
        echo Templater::$__dextep->getTemplate('common/login');
    }  
        
    public static function errorPage($__error_type, $__error_message) {
        Templater::$__dextep = new Dextep();
        
       
        Templater::$__dextep->setVar('errorTitle', 'Ошибка');
        Templater::$__dextep->setVar('errorText', $__error_message);
             
        self::basePage('Ошибка', Templater::$__dextep->getTemplate('common/error'));
        die();
    }
	
}
