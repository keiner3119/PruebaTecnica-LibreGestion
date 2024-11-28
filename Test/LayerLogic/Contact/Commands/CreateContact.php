<?php
    include_once '../LayerLogic/DataBase/DataBase.php';
    include_once '../LayerData/Contact/Queries/ReadContact.php';
    include_once '../LayerData/Contact/Commands/CreateContact.php';
    include_once '../LayerEntity/Response.php';

    class CreateContactBLL{
        private static $_instance;
        private $_instanceDataBase;
        private $_instanceResponse;
        private $_instanceReadContact;
        private $_instanceCreateContact;

        function __construct(){
            $this->_instanceDataBase = DataBaseBLL::GetInstance();
            $this->_instanceResponse = Response::GetInstance();
            $this->_instanceReadContact = ReadContactDAL::GetInstance();
            $this->_instanceCreateContact = CreateContactDAL::GetInstance();
        }

        public static function GetInstance()
        {
            if (!self::$_instance instanceof self) {
                self::$_instance = new self();
            }    
            return self::$_instance;
        }  

        public function CreateContact($contact) : object {
            if ($this->_instanceDataBase->ValidateConnectionToDataBase()){
                if ($this->ValidateUserDuplication($contact->GetPhone())) {
                    $this->_instanceResponse->response = "error";
                    $this->_instanceResponse->message = "El usuario ya existe en la base de datos.";
                } else {
                     return $this->CreateContactInDataBase($contact);
                }     
            } else {
                $this->_instanceResponse->response = "error";
                $this->_instanceResponse->message = "Falló la conexión con la base de datos.";
            }
            return $this->_instanceResponse;           
        }

        private function ValidateUserDuplication($phone) : bool {
            return $this->_instanceReadContact->ReadContact($phone);
        }

        private function CreateContactInDataBase($contact) : object {
            return $this->_instanceCreateContact->CreateContact($contact);
        }

    }
?>