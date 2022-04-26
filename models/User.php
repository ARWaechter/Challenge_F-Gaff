<?php

    class User
    {

        public $id;
        public $user_name;
        public $email;
        public $password;
        public $token;

        // CREATE TABLE users (id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, user_name VARCHAR(100), email VARCHAR(150), password VARCHAR(200), token VARCHAR(200));

        // public $id;
        // public $user_name;
        // public $email;
        // public $phone;
        // public $observations;
        // public $password;
                
        // CREATE TABLE contacts (id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, user_name VARCHAR(100), phone VARCHAR(30), email VARCHAR(150), observations TEXT, password VARCHAR(200), FOREIGN KEY (users_id) REFERENCES users(id));
        
        public function generateToken()
        {

            return bin2hex(random_bytes(50));
        
        }

        public function generatePassword($password)
        {

            return password_hash($password, PASSWORD_DEFAULT);

        }

    }

    interface UserDAOInterface
    {

        public function buildUser($data);
        public function create(User $user, $authUser = false);
        public function update(User $user, $redirect = true);
        public function verifyToken($protected = false);
        public function setTokenToSession($token, $redirect = true);
        public function authenticateUser($email, $password);
        public function findByName($name);
        public function findById($id);
        public function findByToken($token);
        public function destryToken();
        public function changePassword(User $user);

    }

?>