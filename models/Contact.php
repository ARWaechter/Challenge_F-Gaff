<?php

    class Contact
    {
   
    public $id;
    public $name;
    public $email;
    public $phone;
    public $observations;
    public $users_id;
            
    // CREATE TABLE contacts (id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, name VARCHAR(100), phone VARCHAR(30), email VARCHAR(150), observations TEXT, users_id INT(11) UNSIGNED, FOREIGN KEY (users_id) REFERENCES users(id));

    }

    interface ContactDAOInterface
    {

        public function buildContact($data);
        public function findAll();
        public function getContactByUserId($id);
        public function findById($id);
        public function findByName($name);
        public function findByEmail($email);
        public function findByPhone($phone);

    }

?>