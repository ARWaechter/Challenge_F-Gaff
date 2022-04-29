<?php

    // require_once("dao/UserDAO.php");
    // require_once("db.php");
    // require_once("globals.php");
    // require_once("models/Message.php");
    require_once("templates/header.php");

    //$message = new Message($BASE_URL);

    $userDao = new UserDAO($conn, $BASE_URL);
    $userData = $userDao->verifyToken(true);
    
?>

        <div class="main-container container-fluid">
            <h1 class="section-title">Add contact</h1>
                <div class="col-md-5 offset-md-3">
                    <form action="<?= $BASE_URL ?>contact_process.php" method="post">
                        <input type="hidden" name="type" value="create">
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Contact name">
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone:</label>
                            <input type="tel" name="phone" id="phone" class="form-control" placeholder="Contact phone">
                        </div>
                        <div class="form-group">
                            <label for="email">E-mail:</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Contact e-mail">
                        </div>
                        <div class="form-group">
                            <label for="observations">observations:</label>
                            <textarea name="observations" id="observations" rows="5" class="form-control" placeholder="Observations here..."></textarea>
                        </div>
                        <input type="submit" value="Add contact" class="btn card-btn">
                    </form> 
                </div>
        </div>

<?php

    require_once("templates/footer.php");

?>