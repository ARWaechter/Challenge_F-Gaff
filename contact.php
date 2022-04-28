<?php

    require_once("templates/header.php");

    require_once("dao/UserDAO.php");
    require_once("dao/ContactDAO.php");
    require_once("models/User.php");

    $user = new User;
    $userDao = new UserDAO($conn, $BASE_URL);
    $contactDao = new ContactDAO($conn, $BASE_URL);

        // VERIFY USER AUTHENTICATION
    $userData = $userDao->verifyToken(true);
    $id = filter_input(INPUT_GET, "id");

        // CHECK CONTACT ID
    if(!empty($id))
    {

        $contact = $contactDao->findById($id);

            // CHECK CONTACT EXISTENCE
        if($contact)
        {

                //CHECK IF USER OWNS THIS CONTACT
            if($contact->users_id != $userData->id)
            {
    
                $message->setMessage("Invalid informations", "error");

            }
    
        }
        else
        {
    
            $message->setMessage("Contact not found", "error");
    
        }

    }
    else
    {

        $message->setMessage("Contact not found", "error");

    }

?>

<div id="main-container" class="container-fluid">
    <div class="col-md-6 offset-md-3">
        <h1 id="main-title"><?= $contact->name ?></h1>
        <p class="bold">Phone:</p>
        <p><?= $contact->phone ?></p>
        <p class="bold">E-mail:</p>
        <p><?= $contact->email ?></p>
        <p class="bold">Observations:</p>
        <p><?= $contact->observations ?></p>
    </div>
</div>
<?php

    require_once("templates/footer.php");

?>