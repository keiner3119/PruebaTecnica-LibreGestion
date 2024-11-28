<?php
    include_once '../LayerLogic/DataBase/DataBase.php';
    include_once '../LayerData/Contact/Queries/ReadContacts.php';
    include_once '../LayerEntity/Response.php';

    class ReadContactsBLL{
        private static $_instance;
        private $_instanceResponse;
        private $_instanceDataBase;        
        private $_instanceReadContacts;

        function __construct(){
            $this->_instanceDataBase = DataBaseBLL::GetInstance();
            $this->_instanceResponse = Response::GetInstance();
            $this->_instanceReadContacts = ReadContactsDAL::GetInstance();
        }

        public static function GetInstance()
        {
            if (!self::$_instance instanceof self) {
                self::$_instance = new self();
            }    
            return self::$_instance;
        }  

        public function ReadContacts() : object {
            if ($this->_instanceDataBase->ValidateConnectionToDataBase()){
                return $this->_instanceReadContacts->ReadContacts();
            } else {
                $this->_instanceResponse->response = "error";
                $this->_instanceResponse->message = "Falló la conexión con la base de datos.";
            }
            return $this->_instanceResponse;           
        }
    }
?>