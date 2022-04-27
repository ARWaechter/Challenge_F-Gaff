<?php

    require_once("templates/header.php");
    require_once("models/User.php");
    require_once("dao/UserDAO.php");

    

    $user = new User();
    $userDao = new UserDAO($conn, $BASE_URL);

    $userData = $userDao->verifyToken(true);

    // print_r($userData);

?>

        <div class="main-container container-fluid">
            <div class="col-md-12">
                <form action="<?= $BASE_URL ?>user_process.php" method="post">
                    <input type="hidden" name="type" value="update">
                    <div class="row">
                        <div class="col-md-4">
                            <h1 class="section-title">Welcome <?= $userData->user_name ?></h1>
                            <div class="form-group">
                                <label for="user_name">User name:</label>
                                <input type="text" name="user_name" id="user_name" class="form-control" placeholder="Isert your user user_name" value="<?= $userData->user_name ?>">
                            </div>
                            <div class="form-group">
                                <label for="email">E-mail:</label>
                                <input type="text" name="email" id="email" class="form-control" placeholder="Isert your e-mail" value="<?= $userData->email ?>">
                            </div>
                            <input type="submit" value="Update" class="btn card-btn">
                        </div>
                    </div>
                </form>
                <div class="row" id="change-password-container">
                    <div class="col-md-4">
                        <h2>Change password</h2>
                        <p class="page-description">Type your new password</p>
                        <form action="<?= $BASE_URL ?>user_process.php" method="post">
                            <input type="hidden" name="type" value="changepassword">
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Insert your new password">
                            </div>
                            <div class="form-group">
                                <label for="confirmpassword">Confirm password:</label>
                                <input type="password" name="confirmpassword" id="confirmpassword" class="form-control" placeholder="Insert your new password again">
                            </div>
                            <input type="submit" value="Change password" class="btn card-btn">
                        </form>
                    </div>
                </div>
            </div>
        </div>

<?php

    require_once("templates/footer.php");

?>