<?php
    include_once '../LayerData/DataBase/DataBase.php';

    class DataBaseBLL {
        private static $_instance;
        private $_instanceDataBase;

        function __construct() {

        }

        public static function GetInstance()  : self {
            if(!self::$_instance instanceof self){
                self::$_instance = new self();
            }
            return self::$_instance;
        }

        public function ValidateConnectionToDataBase() : bool {
            $this->_instanceDataBase = DataBaseDAL::GetInstance();
            if($this->_instanceDataBase->Connect() != "error"){
                return true;
            } else {
                return false;
            }
        }
    }
?>