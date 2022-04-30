<?php

    require_once("templates/header.php");

        // VERIFY USER AUTHENTICATION
    require_once("dao/ContactDAO.php");
    require_once("dao/UserDAO.php");
    require_once("models/User.php");

    $user = new User;
    $contactDao = new ContactDAO($conn, $BASE_URL);
    $userDao = new UserDAO($conn, $BASE_URL);
    
    $userData = $userDao->verifyToken(true);

        // GET SEARCH
    $search=filter_input(INPUT_GET, "search");

    if($search)
    {

        $userContacts = $contactDao->searchContact($search);

        // echo $search;
        // echo "<br>";
        // print_r($userContacts); exit;
        
    }
    else
    {
    
        $userContacts = $contactDao->findByUserId($userData->id);

    }

?>

    <?php if($userData): ?>
        <div id="main-container" class="container-fluid">
            <h1 class="section-title">My contacts</h1>
            <p class="section-description"></p>
                <?php if($search): ?>
                    <div>
                        <p class="search-result">You are searching for: <?= $search?></p>
                    </div>
                <?php endif; ?>
            <!--<div id="add-contact-container">
                <a href="<?= $BASE_URL ?>newcontact.php" class="btn">
                    <i class="fas fa-plus">Add contact</i>
                </a>
            </div>-->
            <div class="col-md-12" id="contact-dash-container">
                <table class="table">
                    <thead>
                        <th scope="col">Name</th>
                        <th scope="col">Phone</th>
                        <th scope="col">E-mail</th>
                        <th scope="col" class="action-column">actions</th>
                    </thead>
                    <tbody>
                        <?php foreach($userContacts as $contact): ?>
                            <tr>
                                <td><a href="<?= $BASE_URL ?>contact.php?id=<?= $contact->id ?>"><?= $contact->name ?></a></td>
                                <td><?= $contact->phone ?></td>
                                <td><?= $contact->email ?></td>
                                <td class="actions-column">
                                    <a href="<?= $BASE_URL ?>editcontact.php?id=<?= $contact->id ?>" class="edit-btn"><i class="far fa-edit"></i></a>
                                    <form action="<?= $BASE_URL ?>contact_process.php?id=<?= $contact->id ?>" method="post">
                                        <input type="hidden" name="type" value="delete">
                                        <input type="hidden" name="id" value="<?= $contact->id ?>">
                                        <button type="submit" class="delete-btn"><i class="fas fa-times"></i></button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php else: ?>
        <div class="container-fluid">
            <h1 class="login-title">Login to create and view your contacts</h1>
        </div>
    <?php endif; ?>
<?php

    require_once("templates/footer.php");

?>