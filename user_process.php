<?php

    require_once("db.php");
    require_once("globals.php");
    require_once("models/Message.php");
    require_once("models/User.php");
    require_once("dao/UserDAO.php");

    $message = new Message($BASE_URL);
    $userDao = new UserDAO($conn, $BASE_URL);

        // GET FORM TYPE
    $type = filter_input(INPUT_POST, "type");

        // UPDATE USER
    if($type === "update")
    {

            // GET USER DATA
        $userData = $userDao->verifyToken();

            // RECEIVE POST DATA
        $user_name = filter_input(INPUT_POST, "user_name");
        $email = filter_input(INPUT_POST, "email");

        $userData->user_name = $user_name;
        $userData->email = $email;

        $userDao->update($userData);
        
    }
    else if($type === "changepassword")
    {

            // RECEIVE POST DATA
        $password = filter_input(INPUT_POST, "password");
        $confirmPassword = filter_input(INPUT_POST, "confirmpassword");

            // GET USER DATA
        $userData = $userDao->verifyToken();

        $id = $userData->id;
        
            // CONFIRM PASS MATCH
        if($password === $confirmPassword)
        {

                // CREATE NEW USER OBJECT
            $user = new User();

                // GENERATE NEW PASSWORD
            $finalPassword = $user->generatePassword($password);

            $user->password = $finalPassword;
            $user->id = $id;

            $userDao->changePassword($user);

        }
        else
        {

            $message->setMessage("password not match", "error", "back");

        }

    }

    else
    {
        $message->setMessage("Invalid informations!", "error");

    }

?>