<?php

    class Message
    {

        private $url;

        public function __construct($url)
        {

            $this->url = $url;
            
        }

        public function setMessage($msg, $type, $redirect = "index.php")
        {

            $_SESSION["msg"] = $msg;
            $_SESSION["type"] = $type;

            //echo "referer  --->  "; 
            //print_r($_SERVER["HTTP_REFERER"]); 
            //echo "<hr>"; 
            //echo "uri  --->  "; 
            //print_r($_SERVER["REQUEST_URI"]); 
            //echo "<hr>"; 
            //print_r($_SERVER); exit;

            if($redirect != "back")
            {

                header("location: $this->url" . $redirect);

            }
            else
            {

                header("location: " . $_SERVER["HTTP_REFERER"]);

            }

        }

        public function getMessage()
        {

            if(!empty($_SESSION["msg"]))
            {

                return ["msg" => $_SESSION["msg"], "type" => $_SESSION["type"]];
            
            }
            else
            {

                return false;

            }

        }

        public function clearMessage()
        {

            $_SESSION["msg"] = "";
            $_SESSION["type"] = "";

        }

    }

?>