<?php
    class Connection {        
        private $_host;
        private $_nameDataBase;
        private $_user;
        private $_password;
        private static $_instance;

        function __construct()
        {
            $this->_host = 'localhost';
            $this->_nameDataBase = 'test';
            $this->_user = 'root';
            $this->_password = '';
        }

        public static function GetInstance(){
            if(!self::$_instance instanceof self){
                self::$_instance = new self();
            }
            return self::$_instance;
        }  
        
        public function GetHost(): string 
        {
            return $this->_host;
        } 

        public function GetNameOfDataBase(): string 
        {
            return $this->_nameDataBase;
        }

        public function GetUser(): string 
        {
            return $this->_user;
        }

        public function GetPassword(): string 
        {
            return $this->_password;
        }
    }
?>