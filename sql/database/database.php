<?php
    require_once 'config.php';

class Database{
    private static $instance;

    public static function getInstance(){
        if(!isset(self::$instance)){
            try{
                self::$instance = new PDO('pgsql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
					//Configurações
					self::$instance->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
					self::$instance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
                    self::$instance->setAttribute(PDO::ATTR_EMULATE_PREPARES,false); //linha do Daniel
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }

        return self::$instance;
    }

    public static function prepare($sql){
        return self::getInstance()->prepare($sql);
    }
}

?>