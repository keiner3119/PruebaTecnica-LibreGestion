<?php
    include_once '../LayerData/DataBase/DataBase.php';
    include_once '../LayerEntity/Response.php';

    class ReadContactsDAL {
        private static $_instance;
        private $_instanceConnection;
        private $_responseReadContacts;

        function __construct(){
            $this->_instanceConnection = DataBaseDAL::GetInstance();
        }

        public static function GetInstance(){
            if(!self::$_instance instanceof self){
                self::$_instance = new self();
            }
            return self::$_instance;
        }

        public function ReadContacts() : object {
            $this->_responseReadContacts = Response::GetInstance();
            $statementSQL = "SELECT id, names, phone, date_of_birth, address, email, is_active FROM contacts WHERE is_active = '" . true . "';";
            $response = $this->_instanceConnection->Connect()->query($statementSQL);
            foreach($response as $row) {
                $this->_responseReadContacts->response = 'success';
                $this->_responseReadContacts->contacts[] = $row;
            }

            if ($this->_responseReadContacts->response == null) {
                $this->_responseReadContacts->response = 'not_found';
                $this->_responseReadContacts->message = 'No hay data en la base de datos';
                $this->_responseReadContacts->contacts = [];
            }

            return $this->_responseReadContacts;
        }
    }
?>