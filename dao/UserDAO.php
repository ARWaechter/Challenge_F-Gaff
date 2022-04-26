<?php

    require_once("models/User.php");
    require_once("models/Message.php");

    class UserDAO implements UserDAOInterface
    {

        private $conn;
        private $url;
        private $message;

        public function __construct(PDO $conn, $url)
        {

            $this->conn = $conn;
            $this->url = $url;
            $this->message = new Message($url);
            
        }

        public function buildUser($data)
        {

            $user = new User();

            $user->id = $data["id"];
            $user->name = $data["name"];
            $user->email = $data["email"];
            $user->password = $data["password"];
            $user->token = $data["token"];

            return $user;

        }

        public function create(User $user, $authUser = false)
        {

            $stmt = $this->conn->prepare("INSERT INTO users (user_name, email, password, token) VALUES (:user_name, :email, :password, :token)");

            $stmt->bindParam(":user_name", $user->name);
            $stmt->bindParam(":email", $user->email);
            $stmt->bindParam(":password", $user->password);
            $stmt->bindParam(":token", $user->token);

            $stmt->execute();

                // AUTHENTICATE USER, WHEN AUTH IS TRUE
            if($authUser)
            {

                $this->setTokenToSession($user->token);

            }

        }

        public function update(User $user, $redirect = true)
        {

        }

        public function verifyToken($protected = false)
        {

            if(!empty($_SESSION["token"]))
            {

                    // TAKE SESSION TOKEN
                $token = $_SESSION["token"];

                $user = $this->findByToken($token);

                if($user)
                {

                    return $user;

                }
                else if($protected)
                {

                        // REDIRECT USER NOT AUTHENTICATED
                    $this->message->setMessage("login to see this page", "erro", "index.php");
                    
                }

            }
            else if($protected)
            {

                    // REDIRECT USER NOT AUTHENTICATED
                $this->message->setMessage("login to see this page", "erro", "index.php");

            }

        }

        public function setTokenToSession($token, $redirect = true)
        {

             // SAVE TOKEN ON SESSION
            $_SESSION["token"] = $token;

            if($redirect)
            {

                    // REDIRECT TO USER PAGE
                $this->message->setMessage("Welcome", "success");

            }

        }

        public function authenticateUser($email, $password)
        {

        }

        public function findById($id)
        {

        }

        public function findByName($name)
        {

        }

        public function findByEmail($email)
        {

        }
        
        public function findByToken($token)
        {

            if($token != "")
            {

                $stmt = $this->conn->prepare("SELECT * FROM users WHERE token = :token");
                $stmt->bindParam(":token", $token);
                $stmt->execute();

                    // SUCCESS TEST
                if($stmt->rowCount() > 0)
                {

                    $data = $stmt->fetch();
                    $user = $this->buildUser($data);

                    return $user;

                }
                else
                {

                    return false;

                }

            }
            else
            {

                return false;

            }

        }

        public function destroyToken()
        {

        }

        public function changePassword(User $user)
        {

        }

    }

?>