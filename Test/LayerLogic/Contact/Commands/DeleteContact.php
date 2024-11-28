<?php
    include_once '../LayerLogic/DataBase/DataBase.php';
    include_once '../LayerData/Contact/Commands/DeleteContact.php';
    include_once '../LayerEntity/Response.php';    

    class DeleteContactBLL{
        private static $_instance;
        private $_instanceResponse;
        private $_instanceDataBase;        
        private $_instanceDeleteContact;

        function __construct(){
            $this->_instanceDataBase = DataBaseBLL::GetInstance();
            $this->_instanceResponse = Response::GetInstance();
            $this->_instanceDeleteContact = DeleteContactDAL::GetInstance();
        }

        public static function GetInstance()
        {
            if (!self::$_instance instanceof self) {
                self::$_instance = new self();
            }    
            return self::$_instance;
        }  

        public function DeleteContact($id) : object {
            if ($this->_instanceDataBase->ValidateConnectionToDataBase()){
                return $this->_instanceDeleteContact->DeleteContact($id);
            } else {
                $this->_instanceResponse->response = "error";
                $this->_instanceResponse->message = "Falló la conexión con la base de datos.";
            }
            return $this->_instanceResponse;           
        }
    }
?>