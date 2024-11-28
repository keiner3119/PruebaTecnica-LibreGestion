<?php    
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    header("Allow: GET, POST, OPTIONS, PUT, DELETE"); 
    header("Content-Type: application/json");

    include_once '../LayerEntity/Contact.php';
    include_once '../LayerLogic/Contact/Commands/CreateContact.php';
    include_once '../LayerLogic/Contact/Queries/ReadContacts.php';
    include_once '../LayerLogic/Contact/Commands/DeleteContact.php';
    include_once '../LayerLogic/Contact/Commands/UpdateContact.php';

    class Resources {
        private static $_instance;
        private $_instanceContact;
        private $_instanceCreateContact;
        private $_instanceReadContacts;
        private $_instanceDeleteContact;
        private $_instanceUpdateContact;

        function __construct(){
            $this->_instanceContact = Contact::GetInstance();
            $this->_instanceCreateContact = CreateContactBLL::GetInstance();
            $this->_instanceReadContacts = ReadContactsBLL::GetInstance();
            $this->_instanceDeleteContact = DeleteContactBLL::GetInstance();
            $this->_instanceUpdateContact = UpdateContactBLL::GetInstance();
            $this->RunResources();
        }

        public static function GetInstance()
        {
            if (!self::$_instance instanceof self) {
                self::$_instance = new self();
            }    
            return self::$_instance;
        }

        private function RunResources() { 
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'POST':
                    $_POST = json_decode(file_get_contents('php://input'));
                    $this->_instanceContact->SetNames($_POST->names);
                    $this->_instanceContact->SetPhone($_POST->phone);
                    $this->_instanceContact->SetDateOfBirth($_POST->dateOfBirth);
                    $this->_instanceContact->SetAddress($_POST->address);
                    $this->_instanceContact->SetEmail($_POST->email);
                    echo json_encode($this->_instanceCreateContact->CreateContact($this->_instanceContact));
                    break;
                    
                case 'GET':
                    echo json_encode($this->_instanceReadContacts->ReadContacts());
                    break;
                    
                case 'PUT':
                    $_PUT = json_decode(file_get_contents('php://input'));
                    $this->_instanceContact->SetNames($_PUT->names);
                    $this->_instanceContact->SetPhone($_PUT->phone);
                    $this->_instanceContact->SetDateOfBirth($_PUT->dateOfBirth);
                    $this->_instanceContact->SetAddress($_PUT->address);
                    $this->_instanceContact->SetEmail($_PUT->email);
                    echo json_encode($this->_instanceUpdateContact->UpdateContact($this->_instanceContact));
                    break;

                case 'DELETE':
                    $id = $_GET["id"];
                    echo json_encode($this->_instanceDeleteContact->DeleteContact($id));
                    break;                    
            }            
        }
    }
    $Run = Resources::GetInstance();
    $Run;
?>