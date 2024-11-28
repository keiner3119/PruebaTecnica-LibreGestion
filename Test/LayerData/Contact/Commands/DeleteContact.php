<?php
    include_once '../LayerData/DataBase/DataBase.php';
    include_once '../LayerEntity/Response.php';

    class DeleteContactDAL {
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

        public function DeleteContact($id) : object {
            $isActive = false;
            $stmt = $this->_instanceConnection->Connect()->prepare("
                UPDATE contacts SET is_active = :isActive WHERE id = :id;
            ");
            $stmt->bindParam(':isActive', $isActive);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            if($stmt->rowCount() > 0) {
                $this->_instanceResponse->response = 'success';
                $this->_instanceResponse->message = 'Contacto eliminado con éxito.';
            } else {
                $this->_instanceResponse->response = 'error';
                $this->_instanceResponse->message = 'Lo sentimos, pero no se pudo eliminar el contacto de la base de datos.';
            }
            return $this->_instanceResponse;
        }
    }
?>