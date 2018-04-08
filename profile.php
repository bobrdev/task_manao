<?php

require_once('php/router.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>Test task</title>
</head>
<body>
    <div class="wrapper">
        <header>
            <div class="logout">
                <button id="btn_logout" class="btn">
                   <a href="profile.php?action=out">Выйти</a>
                </button>
            </div>
        </header>
        <section class="main container">
            <h3>Ура вы авторизовались!</h3>
            <?php
               $hello_message = '<p> Hello <b>'.$_SESSION['logged_user']['name'].'</b>!</p>';
               echo $hello_message;
            ?>
        </section>
    </div>
    <footer class="container">
        <span>Artur Drabinko</span>
    </footer>
</body>

</html>
