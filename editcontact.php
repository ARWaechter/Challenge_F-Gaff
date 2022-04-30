<?php

    require_once("templates/header.php");

        // VERIFY USER AUTHENTICATION
    require_once("dao/ContactDAO.php");
    require_once("dao/UserDAO.php");
    require_once("models/User.php");

    $user = new User;
    $contactDao = new ContactDAO($conn, $BASE_URL);
    $userDao = new UserDAO($conn, $BASE_URL);
    
        // VERIFYING USER ATHENTICATION
    $userData = $userDao->verifyToken(true);
    $id = filter_input(INPUT_GET, "id");

        // CHECK CONTAC ID
    if(!empty($id))
    {

        $contact = $contactDao->findById($id);

            // CHECK CONTACT EXISTENSE
        if(!$contact)
        {

            $message->setMessage("Contact not found", "error");

        }
        
    }
    else
    {

        $message->setMessage("contact not found", "error");

    }

?>

    <?php if($userData): ?>
        <div id="main-container" class="container-fluid">
            <h1 class="section-title">Edit contact</h1>
                <form action="<?= $BASE_URL ?>contact_process.php" id="contact-form" method="post">
                    <input type="hidden" name="type" value="update">
                    <input type="hidden" name="id" value="<?= $contact->id ?>">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Contact name" value="<?= $contact->name ?>">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone:</label>
                        <input type="tel" name="phone" id="phone" class="form-control" placeholder="Contact phone" value="<?= $contact->phone ?>">
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail:</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Contact e-mail" value="<?= $contact->email ?>">
                    </div>
                    <div class="form-group">
                        <label for="observations">observations:</label>
                        <textarea name="observations" id="observations" rows="5" class="form-control" placeholder="Observations here..."><?= $contact->observations ?></textarea>
                    </div>
                    <input type="submit" value="Update contact" class="btn">
                </form>
            </div>
        </div>
    <?php endif; ?>
<?php

    require_once("templates/footer.php");

?>