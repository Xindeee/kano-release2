<?php

class Authentication {
    
    //Авторизован ли пользователь
    public static function isAuth() {
        return isset($_SESSION['role']) && isset($_SESSION['id']);
    }
    
    //Является ли пользователь редактором опроса
    public static function isEditor() {
        return (isset($_SESSION['role']) && $_SESSION['role'] == 'editor');
    }
    
    
    //ID Авторизованного пользователя
    public static function getLoginedUserId() {
        return (self::isAuth()) ? $_SESSION['id'] : false;
    }
    
    //Получить id пользователя
    public static function getUserId($__login, $__password = false) {
       $user = DataStorage::getUserByLogin($__login);
       if($user) {
           if($__password === false || password_verify($__password, $user['password']))
           return $user['id'];
       }
       return false;
    }

    //Получить роль пользователя
    public static function getUserRoleById($__userId) {
        return DataStorage::getUserRoleById($__userId)['role'];
    }
    
    //Авторизоваться в системе
    public static function login($__login, $__password) {
        $userId = self::getUserId($__login, $__password);
        
        if($userId) {
            $userRole = self::getUserRoleById($userId);
            
            $_SESSION['role'] = $userRole;
            $_SESSION['id']   = $userId;
            return true;
        }

        return false;
    }
    
    //Выйти из системы
    public static function logout() {
        if(isset($_SESSION['role']))
            unset($_SESSION['role']);
        if(isset($_SESSION['id']))
            unset($_SESSION['id']);
    }
}

