<?php
session_start();

if ( isset($_SESSION['logged_user']) ) {
   header( "Location: ". 'profile.php' );
}

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
            <div class="logo">
                <a href="./">Test</a>
            </div>
            <div class="reg-login">
                <button id="btn_header_registration" class="btn active">Регистарация</button>
                <button id="btn_header_athorization" class="btn">Войти</button>
            </div>
        </header>
        <section class="main container">
            <h3>Для регистрации заполните форму<br>и нажмите кнопку <b>Зарегистрироваться</b></h3>

            <div id="error_box" class="error_message hide"></div>
            <div id="success_box" class="success_mesage hide"></div>

            <form method="POST" id="form_registration" action="javascript:void(null);" onsubmit="handlerRegistrationForm()">
                <div class="form-group col-md-6 pl-0">
                    <label for="">
                        <b>Имя пользователя:</b>
                    </label>
                    <input id="in_user_name" type="text" name="user_name" class="form-control" required>
                    <div class="invalid-feedback hide">
                        Имя уже занято!
                    </div>
                </div>

                <div class="form-group col-md-6 pl-0">
                    <label for="">
                        <b>Логин:</b>
                    </label>
                    <input id="in_login" type="text" name="login" class="form-control" required>
                    <div class="invalid-feedback hide">
                        Логин уже занят!
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <label>
                        <b>Введите E-mail:</b>
                    </label>
                    <input id="in_email" type="email" name="email" class="form-control" placeholder="ivanov@gmail.com" maxlength="35" required>
                    <div class="valid-feedback hide">
                        Email свободен!
                    </div>
                    <div class="invalid-feedback hide">
                        Пользователь с таким email уже существует!
                    </div>
                </div>

                <div class="form-group col-md-6 pl-0">
                    <label for="">
                        <b>Пароль:</b>
                    </label>
                    <input id="in_password" type="password" name="password" class="form-control" required>
                    <div class="invalid-feedback hide">
                        Неверный пароль!
                    </div>
                </div>

                <div class="form-group col-md-6 pl-0">
                    <label for="exampleInputPassword1">
                        <b>Повторите пароль:</b>
                    </label>
                    <input id="in_confirm_password" type="password" name="confirm_password" class="form-control" required>
                    <div class="invalid-feedback hide">
                        Пароли не совпали либо слишко простые!
                    </div>
                </div>

                <div class="form-group col-md-6 pl-0">
                    <button id="btn_form_registration" type="submit" name="btn_registration" class="btn btn-info" >
                        Зарегистрироваться
                    </button>
                 </div>
            </form>


            <form method="POST" id="form_athorization" class="hide" action="javascript:void(null);" onsubmit="handlerAuthorizationForm()">
                <div class="form-group col-md-6 pl-0">
                    <label for="">
                        <b>Логин/E-mail:</b>
                    </label>
                    <input id="in_login_athorization" type="text" name="login" class="form-control" required>
                    <div class="invalid-feedback hide">
                        Логин не существует!
                    </div>
                </div>

                <div class="form-group col-md-6 pl-0">
                    <label for="">
                        <b>Пароль:</b>
                    </label>
                    <input id="in_password_athorization" type="password" name="password" class="form-control" required>
                    <div class="invalid-feedback hide">
                        Неверный пароль!
                    </div>
                </div>

                <div class="form-group col-md-6 pl-0">
                    <button id="btn_form_athorization" type="submit" name="btn_athorization" class="btn btn-info" >
                        Авторизоваться
                    </button>
                </div>
            </form>
        </section>
    </div>
    <footer class="container">
        <span>Artur Drabinko</span>
    </footer>


    <script src="vendor/js/jquery.min.js"></script>
    <script src="js/index.js"></script>
</body>

</html>
