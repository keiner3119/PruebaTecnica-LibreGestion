<?php
    include_once '../LayerData/DataBase/DataBase.php';
    include_once '../LayerEntity/Response.php';

    class CreateContactDAL {
        private static $_instance;
        private $_instanceConnection;
        private $_instanceResponse;

        function __construct(){
            $this->_instanceConnection = DataBaseDAL::GetInstance();
            $this->_instanceResponse = Response::GetInstance();
        }

        public static function GetInstance(){
            if(!self::$_instance instanceof self){
                self::$_instance = new self();
            }
            return self::$_instance;
        }

        public function CreateContact($contact) : object {
            $names = $contact->GetNames();
            $phone = $contact->GetPhone();
            $dateOfBirth = $contact->GetDateOfBirth();            
            $address = $contact->GetAddress();
            $email = $contact->GetEmail();
            $isActive = true;
            $stmt = $this->_instanceConnection->Connect()->prepare("INSERT INTO contacts (names, phone, date_of_birth, address, email, is_active) 
                VALUES (:names, :phone, :dateOfBirth, :address, :email, :isActive)");
            $stmt->bindParam(':names', $names, PDO::PARAM_STR, 50);
            $stmt->bindParam(':phone', $phone, PDO::PARAM_INT, 10);
            $stmt->bindParam(':dateOfBirth', $dateOfBirth);
            $stmt->bindParam(':address', $address, PDO::PARAM_STR, 50);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR, 50);
            $stmt->bindParam(':isActive', $isActive, PDO::PARAM_BOOL, 1);
            $stmt->execute();
            if($stmt->rowCount() > 0){
                $this->_instanceResponse->response = "success";
                $this->_instanceResponse->message = "Se registró el contacto en la base de datos."; 
            } else {
                $this->_instanceResponse->response = "error";
                $this->_instanceResponse->message = "Error al registrar en la base de datos.";
            } 
            return $this->_instanceResponse;
        }
    }
?>