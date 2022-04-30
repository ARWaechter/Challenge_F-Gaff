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
                    <div id="change-password-container">
                        <h1 class="section-title">Change password</h2>
                        <p class="page-description">Type your new password</p>
                        <form action="<?= $BASE_URL ?>user_process.php" class="pass-form" method="post">
                            <input type="hidden" name="type" value="changepassword">
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Insert your new password">
                            </div>
                            <div class="form-group">
                                <label for="confirmpassword">Confirm password:</label>
                                <input type="password" name="confirmpassword" id="confirmpassword" class="form-control" placeholder="Insert your new password again">
                            </div>
                            <input type="submit" value="Change password" class="card-btn btn">
                        </form>
                    </div>
            </div>
        </div>

<?php

    require_once("templates/footer.php");

?>