<?php
session_start(); //Запускаем сессии
 
/** 
 * Класс для авторизации
 * @author дизайн студия ox2.ru 
 */ 
class AuthClass {
    private $_login = "admin"; //Устанавливаем логин
    private $_password = "123"; //Устанавливаем пароль
 
    /**
     * Проверяет, авторизован пользователь или нет
     * Возвращает true если авторизован, иначе false
     * @return boolean 
     */
    public function isAuth() {
        if (isset($_SESSION["is_auth"])) { //Если сессия существует
            return $_SESSION["is_auth"]; //Возвращаем значение переменной сессии is_auth (хранит true если авторизован, false если не авторизован)
        }
        else return false; //Пользователь не авторизован, т.к. переменная is_auth не создана
    }
     
    /**
     * Авторизация пользователя
     * @param string $login
     * @param string $passwors 
     */
    public function auth($login, $passwors) {
        if ($login == $this->_login && $passwors == $this->_password) { //Если логин и пароль введены правильно
            $_SESSION["is_auth"] = true; //Делаем пользователя авторизованным
            $_SESSION["login"] = $login; //Записываем в сессию логин пользователя
            return true;
        }
        else { //Логин и пароль не подошел
            $_SESSION["is_auth"] = false;
            return false; 
        }
    }
     
    /**
     * Метод возвращает логин авторизованного пользователя 
     */
    public function getLogin() {
        if ($this->isAuth()) { //Если пользователь авторизован
            return $_SESSION["login"]; //Возвращаем логин, который записан в сессию
        }
    }
     
     
    public function out() {
        $_SESSION = array(); //Очищаем сессию
        session_destroy(); //Уничтожаем
    }
}
 
$auth = new AuthClass();
 
if (isset($_POST["login"]) && isset($_POST["password"])) { //Если логин и пароль были отправлены
    if (!$auth->auth($_POST["login"], $_POST["password"])) { //Если логин и пароль введен не правильно
        echo "<h2 style=\"color:red;\">Логин и пароль введен не правильно!</h2>";
    }
}
 
if (isset($_POST["is_exit"])) { //Если нажата кнопка выхода
            $auth->out(); //Выходим
       // header("Location: ?is_exit=0"); //Редирект после выхода
    //}
}
 
?>