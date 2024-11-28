<?php
    include_once '../LayerLogic/DataBase/DataBase.php';
    include_once '../LayerData/Contact/Commands/UpdateContact.php';
    include_once '../LayerEntity/Response.php';    

    class UpdateContactBLL{
        private static $_instance;
        private $_instanceDataBase;
        private $_instanceResponse;
        private $_instanceUpdateContact;

        function __construct(){
            $this->_instanceDataBase = DataBaseBLL::GetInstance();
            $this->_instanceResponse = Response::GetInstance();
            $this->_instanceUpdateContact = UpdateContactDAL::GetInstance();
        }

        public static function GetInstance()
        {
            if (!self::$_instance instanceof self) {
                self::$_instance = new self();
            }    
            return self::$_instance;
        }  

        public function UpdateContact($contact) : object {
            if ($this->_instanceDataBase->ValidateConnectionToDataBase()){
                return $this->_instanceUpdateContact->UpdateContact($contact);
            } else {
                $this->_instanceResponse->response = "error";
                $this->_instanceResponse->message = "Falló la conexión con la base de datos.";
            }
            return $this->_instanceResponse;           
        }
    }
?>