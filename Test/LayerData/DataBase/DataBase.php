<?php

    include_once '../LayerEntity/Connection.php';

    class DataBaseDAL {
        private static $_instance;
        private $_instanceConnection;

        function __construct(){
            $this->_instanceConnection = Connection::GetInstance();
        }

        public static function GetInstance(){
            if(!self::$_instance instanceof self){
                self::$_instance = new self();
            }
            return self::$_instance;
        }

        public function Connect() {
            try{
                $conexionporpdo = new PDO(
                    'mysql: host=' . $this->_instanceConnection->GetHost() . 
                    '; dbname=' . $this->_instanceConnection->GetNameOfDataBase(), 
                    $this->_instanceConnection->GetUser(), 
                    $this->_instanceConnection->GetPassword()
                );
                $conexionporpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $conexionporpdo;
            }catch(PDOException $e){
                return "error";
            }
        }
    }
?>