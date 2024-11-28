<?php
    class Response { 
        public $response;
        public $message;
        private static $_instance;
        
        public static function GetInstance() : self {
            if(!self::$_instance instanceof self){
                self::$_instance = new self();
            }
            return self::$_instance;
        }
    }
?>