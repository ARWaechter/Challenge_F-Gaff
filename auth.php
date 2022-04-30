<?php

    require_once("templates/header.php");

?>

<div id="main-container" class="container-fluid">
    <div class="col-md-12">
        <div class="row" id="auth-row">
            <div class="col-md-12" id="login-container">
                <h2 class="section-title">Login</h2>
                <form action="<?= $BASE_URL ?>auth_process.php" method="post">
                    <input type="hidden" name="type" value="login">
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Insert your e-mail">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Insert your password">
                    </div>
                    <input type="submit" value="Login" class="btn card-btn">
                    <p class="link">Click <a href="<?= $BASE_URL ?>register.php" class="redirect-link">here</a> to create account.</p>
                </form>
            </div>
        </div>
    </div>
</div>

<?php

    require_once("templates/footer.php");

?>