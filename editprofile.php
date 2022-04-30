<?php

    require_once("templates/header.php");
    require_once("models/User.php");
    require_once("dao/UserDAO.php");

    

    $user = new User();
    $userDao = new UserDAO($conn, $BASE_URL);

    $userData = $userDao->verifyToken(true);

    // print_r($userData);

?>

        <div id="main-container" class="container-fluid">
            <div class="col-md-12">
                <form action="<?= $BASE_URL ?>user_process.php" class="user-form" method="post">
                    <input type="hidden" name="type" value="update">
                    <div>
                        <h1 class="section-title"><?= $userData->user_name ?></h1>
                        <div class="form-group">
                            <label for="user_name">User name:</label>
                            <input type="text" name="user_name" id="user_name" class="form-control" placeholder="Isert your user user_name" value="<?= $userData->user_name ?>">
                        </div>
                        <div class="form-group">
                            <label for="email">E-mail:</label>
                            <input type="text" name="email" id="email" class="form-control" placeholder="Isert your e-mail" value="<?= $userData->email ?>">
                        </div>
                        <input type="submit" value="Update" class="card-btn btn">
                    </div>
                </form>
                <p class="link">Click <a href="<?= $BASE_URL ?>pass_change.php" class="redirect-link">here</a> to change your password.</p> 
            </div>
        </div>

<?php

    require_once("templates/footer.php");

?>