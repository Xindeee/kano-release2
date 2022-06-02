<?php

class DataStorage {

    //Регистрация пользователя
    public static function registerUser($__login, $__password, $__name, $__patronymic, $__surname, $__role) {
        $query = "INSERT INTO users (id, login, password, name, patronymic, surname, role) VALUES (1, ?,?,?,?,?,?)";
        
        $pdo = PDOInstance::getInstance("PG");
        $statement = $pdo->prepare($query);
        $statement->execute(array($__login, password_hash($__password, PASSWORD_BCRYPT), $__name, $__patronymic, $__surname, $__role));
    }
    
    //Пользователь пользователя по его логину
    public static function getUserByLogin($__login) {
        $query = "SELECT id, login, password, role FROM users WHERE login = ?";
        
        $pdo = PDOInstance::getInstance("PG");
        $statement = $pdo->prepare($query);
        $statement->execute(array($__login));
        
        return $statement->fetch();
    }
    
    //Получить роль пользователя
    public static function getUserRoleById($__userId) {
        $query = "SELECT role from users WHERE id = ?";
        
        $pdo = PDOInstance::getInstance("PG");
        $statement = $pdo->prepare($query);
        
        $statement->execute(array($__userId));
        return $statement->fetch();
    }
    //Получить все опросы
    public static function getPolls() {
        $query = "SELECT id, title, open, owner FROM poll";
        $pdo = PDOInstance::getInstance("PG");
        $statement = $pdo->prepare($query);
        
        $statement->execute(array($__name));
        return $statement->fetchAll();
    }
    
    //Получить опрос по имени
    public static function getPollByName($__name) {
        $query = "SELECT id, title, description, open, owner FROM poll WHERE title = ?";
        $pdo = PDOInstance::getInstance("PG");
        $statement = $pdo->prepare($query);
        
        $statement->execute(array($__name));
        return $statement->fetch();
    }
    
    //Получить опрос по идентификатору
    public static function getPollById($__poll_id) {
        $query = "SELECT id, title, description, open, owner FROM poll WHERE id = ?";
        $pdo = PDOInstance::getInstance("PG");
        $statement = $pdo->prepare($query);
        
        $statement->execute(array($__poll_id));
        return $statement->fetch();
    }
    
    //Получить доступные редактору опросы
    public static function getAvailablePolls($__editorId) {
        $query = "SELECT id, title, description ,open, owner FROM poll WHERE owner = ?";
        $pdo = PDOInstance::getInstance("PG");
        $statement = $pdo->prepare($query);
        
        $statement->execute(array($__editorId));
        return $statement->fetchAll();
    }

    //Получить все категории пользователей для опроса
    public static function getCategoriesByPollId($__poll_id) {
        $query = "SELECT id, poll_id, title FROM category WHERE poll_id = ?";
        $pdo = PDOInstance::getInstance("PG");
        $statement = $pdo->prepare($query);
        
        $statement->execute(array($__poll_id));
        return $statement->fetchAll();
    }
    
    //Получить id категории по имени и id опроса
    public static function getCategoryByTitleAndid($__poll_id, $__title) {
        $query = "SELECT id FROM category WHERE poll_id = ? AND title = ?";
        $pdo = PDOInstance::getInstance("PG");
        $statement = $pdo->prepare($query);
        
        $statement->execute(array($__poll_id, $__title));
        
    }

    //Получить все функции опроса 
    public static function getfunctionsByPollId($__poll_id) {
        $query = "SELECT id, poll_id, title FROM function WHERE poll_id = ?";
        $pdo = PDOInstance::getInstance("PG");
        $statement = $pdo->prepare($query);
        
        $statement->execute(array($__poll_id));
        return $statement->fetchAll();
    }
    //Вернуть максимальный id опрашиваемых
    public static function getMaxPassingId() {
        $query = "SELECT max(id)FROM passing";
        $pdo = PDOInstance::getInstance("PG");
        $statement = $pdo->prepare($query);
        
        $statement->execute(array());
        return $statement->fetch();
    }
    //Вернуть количество решенных опросов
    public static function getCountOfAnswersInPoll($__poll_id) {
        $query = "SELECT count(*) from answer WHERE function_id = (SELECT id FROM function where poll_id = ? LIMIT 1) LIMIT 1;";
        $pdo = PDOInstance::getInstance("PG");
        $statement = $pdo->prepare($query);
        
        $statement->execute(array($__poll_id));
        return $statement->fetch();
    }
    
    //создать опрос
    public static function createPoll($__name, $__description, $__isOpen, $__owner) {
        $query = "INSERT INTO poll (title, description, open, owner) VALUES (?,?,?,?)";
        
        $pdo = PDOInstance::getInstance("PG");
        $statement = $pdo->prepare($query);
        $statement->execute(array($__name, $__description, $__isOpen, $__owner));
    }
    
    //создать функции
    public static function createFunction($__poll_id, $__functionName) {
        $query = "INSERT INTO function (poll_id, title) VALUES (?,?)";
        $pdo = PDOInstance::getInstance("PG");
        $statement = $pdo->prepare($query);
        $statement->execute(array($__poll_id, $__functionName));
    }
    
    //создать категорию
    public static function createCategory($__poll_id, $__categoryName) {
        $query = "INSERT INTO category (poll_id, title) VALUES (?,?)";
        
        $pdo = PDOInstance::getInstance("PG");
        $statement = $pdo->prepare($query);
        $statement->execute(array($__poll_id, $__categoryName));
    }
    
    //Регистрация опрашиваемого
    public static function createPassing($__poll_id, $__fio, $__comment, $__timestampWithTimeZone) {
        $query = "INSERT INTO passing (poll_id, fio, comment, pass_time) VALUES (?,?,?,?)";
        
        $pdo = PDOInstance::getInstance("PG");
        $statement = $pdo->prepare($query);
        $statement->execute(array($__poll_id, $__fio, $__comment, $__timestampWithTimeZone));
    }

    //регистрация ответа опрашиваемого
    public static function sendAnswer($__function_id, $__pass_id, $__importance, $__presence, $__absence) {
        $query = "INSERT INTO answer (pass_id, function_id, importance, presence, absence) VALUES (?,?,?,?,?)";
        
        $pdo = PDOInstance::getInstance("PG");
        $statement = $pdo->prepare($query);
        $statement->execute(array($__pass_id, $__function_id, $__importance, $__presence, $__absence));
    }



    //Изменить название опроса
    public static function EditPollName($__poll_id, $__name) {
        $query = "UPDATE poll SET title = ? WHERE id = ?";
        
        $pdo = PDOInstance::getInstance("PG");
        $statement = $pdo->prepare($query);
        $statement->execute(array($__name, $__poll_id));
    }
    
    //Изменить описание опроса
    public static function EditPollDescription($__poll_id, $__description) {
        $query = "UPDATE poll SET description = ? WHERE id = ?";
        
        $pdo = PDOInstance::getInstance("PG");
        $statement = $pdo->prepare($query);
        $statement->execute(array($__description, $__poll_id));
    }
    
    //Удалить все категории из опроса
    public static function deletePollCategories($__poll_id) {
        $query = "DELETE FROM category WHERE poll_id = ?";
        
        $pdo = PDOInstance::getInstance("PG");
        $statement = $pdo->prepare($query);
        $statement->execute(array($__poll_id));
    }
    
    public static function deletePollFunctions($__poll_id) {
        $query = "DELETE FROM function WHERE poll_id = ?";
        
        $pdo = PDOInstance::getInstance("PG");
        $statement = $pdo->prepare($query);
        $statement->execute(array($__poll_id));
    }
}
