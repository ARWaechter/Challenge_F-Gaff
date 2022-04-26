<?php

    require_once("globals.php");
    require_once("db.php");
    require_once("models/Message.php");
    require_once("models/User.php");
    require_once("dao/UserDAO.php");

    $message = new Message($BASE_URL);
    $userDao = new UserDAO($conn, $BASE_URL);

        // GET FORM TYPE
    $type = filter_input(INPUT_POST, "type");

        // VERIFY FORM TYPE
    if($type === "register")
    {

            // fILTER POST INPUT
        $name = filter_input(INPUT_POST, "name");
        $email = filter_input(INPUT_POST, "email");
        $password = filter_input(INPUT_POST, "password");
        $confirmpassword = filter_input(INPUT_POST, "confirmpassword");

            // MIN DATA VERIFICATION
        if($name && $email && $password)
        {

                // PASSWORD VERIFICATION
            if($password === $confirmpassword)
            {

                    // E_MAIL VERIFICATION
                if($userDao->findByEmail($email) === false)
                {

                    $user = new User();

                        // CREATE PASSWORD
                    $userToken = $user->generateToken();
                    $finalPassword = $user->generatePassword($password);

                    $user->name = $name;
                    $user->email = $email;
                    $user->password = $finalPassword;
                    $user->token = $userToken;

                    $auth = true;

                    $userDao->create($user, $auth);

                }
                else
                {
    
                        // SEND ERROR MESSAGE, E_MAIL ALREADY EXISTS
                    $message->setMessage("E-mail alreay used, try another one.", "error", "back");
    
                }

            }
            else
            {

                    // SEND ERROR MESSAGE, INVALID INFORMATIONS
                $message->setMessage("Password not match", "error", "back");

            }

        }
        else
        {

                // SEND ERROR MESSAGE, MISSING REQUIRED DATA
            $message->setMessage("Fill all required fields", "error", "back");

        }

    }
    else if($type === "login")
    {

    }

    else
    {

            // SEND ERROR MESSAGE, INVALID INFORMATIONS
        $message->setMessage("Invalid informations", "error");

    }

?>