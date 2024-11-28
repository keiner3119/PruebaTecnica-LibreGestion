<?php
    include_once '../LayerData/DataBase/DataBase.php';

    class ReadContactDAL {
        private static $_instance;
        private $_instanceConnection;

        function __construct(){
            $this->_instanceConnection = DataBaseDAL::GetInstance();
        }

        public static function GetInstance(){
            if(!self::$_instance instanceof self){
                self::$_instance = new self();
            }
            return self::$_instance;
        }

        public function ReadContact($phone) : bool {
            $found = false;
            $statementSQL = "SELECT * FROM contacts WHERE phone = '" . $phone . "';";
            $response = $this->_instanceConnection->Connect()->query($statementSQL);
            foreach($response as $row) {
                $found = true;    
            }
            return $found;
        }
    }
?>