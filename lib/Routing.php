<?php

class Routing {
    
    private static $params_arr; #внешние параметры запроса

    private static $etalonParams_arr = array(
        'login' => [
                'parameters' => [
                    'login'    => ['required' => true, 'type' => 'string', 'filter' => 'checkForLogin'],
                    'password' => ['required' => true, 'type' => 'string',]
                ]
            ],
        
        'logout' => [],
        
        //Отобразить страницу создания опроса
        'show_create_interview' => [
            'role' => ['editor'],
            'parameters' => [
                    'intvName' => [],
                    'description' => [],
                    'category' => [],
                    'functions' => []
                ]
        ],
        
        //Редактировать опрос
        'edit_poll' => [
            'role' => ['editor'],
            'parameters' => [
                'id' => []
            ]
        ],
        
        //Сохранить редактированный опрос
        'save_poll_edits' => [
            'role' => ['editor'],
            'parameters' => [
                'id' => [],
                'intvName' => [],
                'description' => [],
                'category' => [],
                'functions' => [],
            ]
        ],
        
        //Пройти опрос
        'take_poll' => [
            'parameters' => [
                'id' => []
            ]
        ],
        
        //Отправить результат опроса
        'send_answer' => [
            'parameters' => [
                'action' =>[],
                'id' => [],
                'answer'=> []
            ]
        ],
        
        'show_mode_selection' => []
        );
    
    #Роутинг по запросу
    public static function route($__request) {
        
        self::$params_arr = self::init_params(self::filter_params($__request));
        
        $isEnoughRights = self::is_enough_rights();
        $methodExists   = method_exists(ActionHandler::class, self::$params_arr['action']);
        
        $action        = self::$params_arr['action'];
        $arguments_arr = self::$params_arr['arguments'];
        
        try {    
            $methodExists && $isEnoughRights
            ? ActionHandler::$action(...$arguments_arr)
            : ActionHandler::getModeSelection();
        }
        
        catch (Exception $exception) {
            Templater::errorPage('Ошибка', $exception);
        }
    }
    
    #Валидация параметров
    private static function filter_params($__request) {
        $filtered_arr = array();
        
        if (!isset($__request['action']))
            return "";
            
        $filteredAction = self::clean($__request['action']);
        
        if (!isset(self::$etalonParams_arr[$filteredAction]))
            return "";

        $filtered_arr['action'] = $filteredAction;
        unset($__request['action']);
        
        #Для вызова action необходимы параметры
        if (isset(self::$etalonParams_arr[$filteredAction]['parameters'])) {
            $argumentsSettings_arr = self::$etalonParams_arr[$filteredAction]['parameters'];
            
            #Бегу по каждому параметру из конфигурации etalonParams
            foreach($argumentsSettings_arr as $argName => $argSettings_arr) {
                
                #Для вызова action не хватает обязательного параметра
                if (isset($argSettings_arr['required'])
                           && $argSettings_arr['required'] == true 
                           && !in_array($argName, array_keys($__request)))
                    return "";
                
                #Во внешнем запросе может не быть необходимого аргумента
                else if (isset($argSettings_arr['default']) && !isset($__request[$argName]))
                    $argValue = $argSettings_arr['default'];
                
                #Существует непустое значение параметра action
                else if (isset($__request[$argName]))
                    $argValue = $__request[$argName];
                else 
                    $argValue = '';
                        
                $filtered_arr['arguments'][$argName] = self::filter_argument($argSettings_arr, $argValue);
            }
        }
        
        return $filtered_arr;
    }
    
    #Валидация аргумента
    private static function filter_argument($__paramsSettings, $__rawArgumentValue) {
                
        #Параметр не удовлетворяет требованиям типизации
        if (isset($__paramsSettings['type']) && !self::is_correct_type($__paramsSettings['type'], $__rawArgumentValue))
            return "";
        
        if (isset($__paramsSettings['filter']))
            return self::clean($__rawArgumentValue, $__paramsSettings['filter']);
        
        return self::clean($__rawArgumentValue);
    }
    
    #Проверка требуемого и заданного типа
    private static function is_correct_type($__etalon, $__userType) {
        $isCorrect = false;
        
        $__etalon != 'array' ? : $isCorrect = is_array($__userType);
        $__etalon != 'bool'  ? : $isCorrect = is_bool($__userType);
        $__etalon != 'float' ? : $isCorrect = is_float($__userType + 0);
        $__etalon != 'int'   ? : $isCorrect = ctype_digit(strval($__userType));
        $__etalon != 'string'? : $isCorrect = is_string($__userType);

        return $isCorrect;
    }

    #Чистка параметров по заданному шаблону
    private static function clean($__param, $__patternName = "") {
        
        $__patternName = trim($__patternName);
        
        #Шаблоны для очистки параметров
            #Все, что НЕ ... чистим
        switch ($__patternName) {
            case 'checkForLogin':
                $pattern = '/[^A-Za-z0-9]+/uis';
                break;
            case 'checkForLatin':
                $pattern = '/[^A-Za-z]+/uis';
                break;
            case 'checkForCyrillic':
                $pattern = '/[^A-Яа-яё]+/uis';
                break;
            case 'checkForNumbers':
                $pattern = '/[^0-9]+/uis';
                break;
            case 'checkForJSONFormat':
                $pattern = '/[^A-Za-z0-9_,[]{}\"\'\\]+/uis';
                break;
            case 'checkForFilePath':
                $pattern = '/[^A-Za-z0-9\/\\\.:]+/uis';
                break;
            
            //Кастомные
            case 'harmlessFilter':
                $pattern = '/[<>]+/uis';
                break;
            case 'no':
                $pattern = '//uis';
                break;
            default:
                $pattern = '/[^A-Za-z0-9_,[]]+/uis';
                break;
        }
        
        $__param
            ? $clean_param = is_array($__param) ?  $__param : trim(preg_replace("$pattern", '', $__param))
            : $clean_param  = '';
        
        return $clean_param;
    }
    
    #Инициализация проверенных параметров
    private static function init_params($__cleanParams) {
        
        #На этапе чистки обнаружены ошибки
        if(!$__cleanParams || !isset($__cleanParams['action']))
            return array('action' => "", 'arguments' => "");
        
        $action = $__cleanParams['action'];
        unset($__cleanParams['action']);
        
        isset($__cleanParams['arguments']) 
            ? $methodArguments_arr = array_values($__cleanParams['arguments'])
            : $methodArguments_arr = [];

        return array('action'    => $action,
                     'arguments' => $methodArguments_arr);
    }
    
    public static function getAccessRules() {
//        return (isset(self::$etalonParams_arr[$__actionName]['rules'])) 
//                ? self::$etalonParams_arr[$__actionName]['rules'][0]
//                : '';
        return self::$etalonParams_arr;
    }
    
    #Проверка прав на исполнение запрашиваемого метода
    private static function is_enough_rights() {
        
        $userRole  = self::get_current_user_role();
        $userRules = [];
        $action    = self::$params_arr['action'];
        
        /// роли пропадут и будет только по методам определяться доступ
        if (isset(self::$etalonParams_arr[$action]['rules'])) {
            
            //импорт таблиц для неавторизованного юзера
            if (!isset($_SESSION['id']) ?? in_array($action, $authImortActions)) {
                return true;
            }
            
            isset(self::$etalonParams_arr[$action]['rules']) 
            ? $availableRules_arr = self::$etalonParams_arr[$action]['rules']
            : [];

            if (isset(self::$params_arr['action']) && array_key_exists(self::$params_arr['action'], self::$etalonParams_arr)) {
                if (!isset(self::$etalonParams_arr[$action]['rules']) || (count(self::$etalonParams_arr[$action]['rules']) === 0))
                    return true;
                else if (in_array($availableRules_arr[0], $userRules))
                    return true;
            }
            return false;
        }
        else {
            isset(self::$etalonParams_arr[$action]['roles']) 
            ? $availableRoles_arr = self::$etalonParams_arr[$action]['roles']
            : [];

            #Cуществует такой action
            if (isset(self::$params_arr['action']) && array_key_exists(self::$params_arr['action'], self::$etalonParams_arr)) {
                if (!isset(self::$etalonParams_arr[$action]['roles']))
                    return true;
                else if (in_array($userRole, $availableRoles_arr))
                    return true;
            }

            return false;
            
        }
        
    }

    #Определение роли текущего пользователя
    private static function get_current_user_role() {
       
        if(Authentication::isAuth() && Authentication::isEditor()) return 'editor';     
        else return 'student';
    }

    #Недостаточно прав на исполнения метода
    private static function access_error() {
        Templater::errorPage('Ошибка', 'Идите, пожалуйста, отсюда');
    }
}
