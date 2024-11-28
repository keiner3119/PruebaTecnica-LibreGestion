<?php
    include_once '../LayerData/DataBase/DataBase.php';
    include_once '../LayerEntity/Response.php';

    class UpdateContactDAL {
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

        public function UpdateContact($contact) : object {
            $names = $contact->GetNames();
            $phone = $contact->GetPhone();
            $dateOfBirth = $contact->GetDateOfBirth();            
            $address = $contact->GetAddress();
            $email = $contact->GetEmail();
            $stmt = $this->_instanceConnection->Connect()->prepare("
                    UPDATE contacts SET names = :names, phone = :phone, date_of_birth = :dateOfBirth,
                    address = :address, email = :email WHERE phone = :phone;
                ");
            $stmt->bindParam(':names', $names, PDO::PARAM_STR, 50);
            $stmt->bindParam(':phone', $phone, PDO::PARAM_STR, 10);
            $stmt->bindParam(':dateOfBirth', $dateOfBirth, PDO::PARAM_STR, 10);
            $stmt->bindParam(':address', $address, PDO::PARAM_STR, 50);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR, 100);
            $stmt->execute();
            if($stmt->rowCount() > 0){
                $this->_instanceResponse->response = "success";
                $this->_instanceResponse->message = "Se modificó la información con éxito.";
            } else {
                $this->_instanceResponse->response = "error";
                $this->_instanceResponse->message = "Error al modificar en la base de datos.";
            } 
            return $this->_instanceResponse;
        }
    }
?>