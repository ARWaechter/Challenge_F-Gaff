<?php

    require_once("templates/header.php");

?>

    <?php if($userData): ?>
        <div class="main-container container-fluid">
            <h1 class="section-title">My contacts</h1>
        </div>
    <?php else: ?>
        <div class="main-container container-fluid">
            <h1 class="section-title">Login to create and view your contacts</h1>
        </div>
    <?php endif; ?>
<?php

    require_once("templates/footer.php");

?>