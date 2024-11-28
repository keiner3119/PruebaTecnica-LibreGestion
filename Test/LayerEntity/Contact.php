<?php
    class Contact {
        private $_names;
        private $_phone;
        private $_dateOfBirth;
        private $_address;
        private $_email;
        private static $_instance;

        function __construct(){
            
        }

        public static function GetInstance() {
            if (!self::$_instance instanceof self) {
                self::$_instance = new self();
            }    
            return self::$_instance;
        }

        public function SetNames($names) { 
            $this->_names = $names; 
        }
        public function GetNames() : string { 
            return $this->_names; 
        }

        public function SetPhone($phone) { 
            $this->_phone = $phone;
        }
        public function GetPhone() : int {
            return $this->_phone;
        }

        public function SetDateOfBirth($dateOfBirth) {
            $this->_dateOfBirth = $dateOfBirth;
        }
        public function GetDateOfBirth() : string {
            return $this->_dateOfBirth;
        }

        public function SetAddress($address) {
            $this->_address = $address;
        }
        public function GetAddress() : string {
            return $this->_address;
        }

        public function SetEmail($email) {
            $this->_email = $email;
        }
        public function GetEmail() : string {
            return $this->_email;
        }
    }
?>