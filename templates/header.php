<?php

    require_once("db.php");
    require_once("globals.php");
    require_once("models/Message.php");
    require_once("dao/UserDAO.php");

    $userDao = new UserDAO($conn, $BASE_URL);
    $userData = $userDao->verifyToken(false);

    $message = new Message($BASE_URL);

    $flashMessage = $message->getMessage();

    if(!empty($flashMessage["msg"]))
    {

        // CLEAR MESSAGE
        $message->clearMessage();

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My contacts</title>
    <!-- <link rel="short icon" href="<?= $BASE_URL ?>img/moviestar.ico"/> -->
        
        <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.1/css/bootstrap.css" integrity="sha512-Ty5JVU2Gi9x9IdqyHN0ykhPakXQuXgGY5ZzmhgZJapf3CpmQgbuhGxmI4tsc8YaXM+kibfrZ+CNX4fur14XNRg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        
        <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        
        <!-- CSS -->
    <link rel="stylesheet" href="<?= $BASE_URL ?>css/styles.css">
</head>
<body>
    <header>
        <nav id="main-navbar" class="navbar navbar-expand-lg">
            <a href="<?= $BASE_URL ?>" class="navbar-brand"><span id="title">My contacts</span></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="toggle navigation"> <i class="fas fa-bars"></i></button>
            <form action="<?= $BASE_URL ?>" method="get" id="search-form" class="form-inline my-2 my-lg-0">
                <input type="text" name="s" id="search" class="form-control form-inline mr-sm-2" type="search" placeholder="Search contact" aria-label="search">
                <button type="submit" class="btn my-2 my-sm-0">
                    <i class="fas fa-search"></i>
                </button>
            </form>
            <div id="navbar">
                <ul class="navbar-nav">
                    <?php if($userData): ?>
                    <li class="nav-item">
                        <a href="<?= $BASE_URL ?>newcontact.php" class="nav-link">
                            <i class="far fa-plus-square"></i>Add contact
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= $BASE_URL ?>logout.php" class="nav-link">Sign out</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= $BASE_URL ?>editprofile.php" class="nav-link"><i class="fa-solid fa-gear"></i></a>
                    </li>
                    <?php else: ?>
                    <li class="nav-item">
                        <a href="<?= $BASE_URL ?>auth.php" class="nav-link">Sign in / Sign up</a>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>
    </header>
    <?php if(!empty($flashMessage["msg"])): ?>
        <div class="msg-container">
            <p class="msg <?= $flashMessage["msg"] ?>"><?= $flashMessage["msg"] ?></p>
        </div>
    <?php endif; ?>