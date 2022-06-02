<?php

class PDOInstance {
    private static $__pdoInstance = null;
    private static $__dbType = null;
    private static $__username = null;
    private static $__password = null;
    
    public static function getConfig($__dbType) {
        return parse_ini_file('config/DBConfigPGSQL.ini');
    }
    
    private static function init($__dbType, $__username, $__password, $__isDatabase = true) {
        $dbConfig = self::getConfig($__dbType);
        
        self::$__dbType = $__dbType;
        self::$__username = ($__username != null) ? $__username : $dbConfig['DBUser'];
        self::$__password = ($__password != null) ? $__password : $dbConfig['DBPass'];
        
        $connection = "pgsql:host=localhost;port=5432;dbname=postgres;user=".self::$__username.";password=".self::$__password;
        $dbname = 'postgres';

        self::$__pdoInstance = new PDO(
            $connection,
            self::$__username,
            self::$__password,
            array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            )
        );
    }
    
    public static function getInstance($__dbType, $__username = null, $__password = null, $__new = false, $__isDatabase = true) {
        if( self::$__pdoInstance == null ||
            self::$__dbType != $__dbType ||
            $__new ||
            ($__username != null && $__username != self::$__username) ||
            ($__password != null && $__password != self::$__password)) {
            self::init($__dbType, $__username, $__password, $__isDatabase);
        }

        return self::$__pdoInstance;
    }
    
    public static function getLastInsertId() {
        if(self::$__dbType == DB_MYSQL && self::$__pdoInstance != null) {
            return self::$__pdoInstance->lastInsertId();
        }
        return null;
    }
}
