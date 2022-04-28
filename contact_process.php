<?php

    require_once("globals.php");
    require_once("db.php");
    require_once("models/Message.php");
    require_once("models/User.php");
    require_once("dao/UserDAO.php");
    require_once("dao/ContactDAO.php");

    $message = new Message($BASE_URL);
    $userDao = new UserDAO($conn, $BASE_URL);
    $contactDao = new ContactDAO($conn, $BASE_URL);

        // GET USER DATA
    $userData = $userDao->verifyToken();

        // GET FORM TYPE
    $type = filter_input(INPUT_POST, "type");

        // VERIFY FORM TYPE
    if($type === "create")
    {

            // FILTER POST INPUT
        $name = filter_input(INPUT_POST, "name");
        $email = filter_input(INPUT_POST, "email");
        $phone = filter_input(INPUT_POST, "phone");
        $observations = filter_input(INPUT_POST, "observations");

            // MIN DATA VERIFICATION
        if($name)
        {

                // NAME VERIFICATION
            if($contactDao->findByName($name) === false)
            {

                    // E-MAIL VERIFICATION
                if($userDao->findByEmail($email) === false)
                {

                    $contact = new Contact();

                    $contact->name = $name;
                    $contact->email = $email;
                    $contact->phone = $phone;
                    $contact->observations = $observations;
                    $contact->users_id = $userData->id;

                    // print_r($contact); 
                    // echo "<br>";
                    // print_r($userData);
                    // exit;

                    $contactDao->create($contact);

                }
                else
                {
    
                        // SEND ERROR MESSAGE, E-MAIL ALREADY EXISTS
                    $message->setMessage("E-mail alreay used, try another one.", "error", "back");
    
                }

            }
            else
            {

                    // SEND ERROR MESSAGE, NAME ALREADY EXISTS
                $message->setMessage("Nane already exits, try another one.", "error", "back");

            }

        }
        else
        {

                // SEND ERROR MESSAGE, MISSING REQUIRED DATA
            $message->setMessage("Fill all required fields", "error", "back");

        }

    }
    else if($type === "update")
    {

            // FILTER POST INPUT
        $id = filter_input(INPUT_POST, "id");
        $name = filter_input(INPUT_POST, "name");
        $email = filter_input(INPUT_POST, "email");
        $phone = filter_input(INPUT_POST, "phone");
        $observations = filter_input(INPUT_POST, "observations");

            // GET CONTACT DATA
        $contactData = $contactDao->findById($id);

            // IF FIND CONTACT
        if($contactData)
        {

                // USER OWNS THIS CONTACT?
            if($contactData->users_id === $userData->id)
            {
                $contactData->name = $name;
                $contactData->email = $email;
                $contactData->phone = $phone;
                $contactData->observations = $observations;
                $contactData->users_id = $userData->$users_id;

                $contactDao->create($contactData);

            }
            else
            {
        
                    // SEND ERROR MESSAGE, INVALID INFORMATIONS
                $message->setMessage("Invalid informations", "error");
        
            }

        }
        else
        {
    
                // SEND ERROR MESSAGE, INVALID INFORMATIONS
            $message->setMessage("Invalid informations", "error");
    
        }

    }
    else if($type === "delete")
    {

            // FILTER POST INPUT
        $id = filter_input(INPUT_POST, "id");

            // GET CONTACT DATA
        $contactData = $contactDao->findById($id);

            // IF FIND CONTACT
        if($contactData)
        {

                // USER OWNS THIS CONTACT?
            if($contactData->users_id === $userData->id)
            {

                $contactDao->delete($contactData->id);

            }
            else
            {
        
                    // SEND ERROR MESSAGE, INVALID INFORMATIONS
                $message->setMessage("Invalid informations", "error");
        
            }

        }
        else
        {
    
                // SEND ERROR MESSAGE, INVALID INFORMATIONS
            $message->setMessage("Invalid informations", "error");
    
        }

    }
    else
    {

            // SEND ERROR MESSAGE, INVALID INFORMATIONS
        $message->setMessage("Invalid informations", "error");

    }

?>