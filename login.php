<?php
session_start();

require_once 'forms/login.form.class.php';
require_once 'db.class.php';
require_once 'password.class.php';
require_once 'session.class.php';


$db_host = 'localhost';
$db_user = 'root';
$db_password = '';
$db_name = 'baza';

$msg = '';

$db = new DB($db_host, $db_user, $db_password, $db_name);
$form = new LoginForm($_POST);

if ($_POST) {
    if ($form->validate()) {
        $email = $db->escape($form->getEmail());
        $password = new Password( $db->escape($form->getPassword()) );

        $res = $db->query("SELECT * FROM useraccount WHERE email = '{$email}' AND password = '{$password}' LIMIT 1");
        if (!$res) {
            $msg = 'Нет такого пользователя';
        } else {
            $user = $res[0]['Id'];
            Session::set('user', $user);    
            $id = $res[0]['email'];
            Session::set('id', $id);
            $role = $db->query("SELECT Id_role FROM roleaccount WHERE Id_user_account = '{$user}'");
            if ($role[0]['Id_role'] == '0' ) 
                header('location: client.php');
            if ($role[0]['Id_role'] == '2' ) 
                header('location: doctor.php');
            if ($role[0]['Id_role'] == '3' ) 
                header('location: admin.php');
            
        }

    } else {
        echo 'Заполни поля';
    }
}


?>

<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>Авторизация</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">

    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/normalize.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/templatemo_misc.css">
    <link rel="stylesheet" href="css/templatemo_style.css">
        <link rel="stylesheet" href="css/menu.css">

    <script src="js/vendor/modernizr-2.6.2.min.js"></script>

</head>
<body>
    <div id="front">
        <div class="site-header">
            <div class="container">
                <div class="row">
                    <div class="col-md-2 col-sm-6 col-xs-6">
                        <div id="templatemo_logo">
                            <h1><a href="#"></a></h1>
                        </div> <!-- /.logo -->
                    </div> <!-- /.col-md-4 -->
                    <div class="col-md-10 col-sm-6 col-xs-6">
                        <a href="#" class="toggle-menu"><i class="fa fa-bars"></i></a>
                        <div>
                            <ul id="menu" >
                                <li><a href="index.php">Главная</a></li>
                            </ul>
                        </div> <!-- /.main-menu -->
                    </div> <!-- /.col-md-8 -->
                </div> <!-- /.row -->
            </div>
        </div> <!-- /.container -->
    </div> <!-- /.front -->
        
    
    
    
    <div class="site-slider">
        <div id="margBot" class="col-md-12 text-center">
            <h1>Авторизация</h1>
         </div> <!-- /.col-md-12 -->
        <div  id="authes" class="content-section">
            <div class="container">
                <div class="col-md-4">                    
                </div> <!-- /.col-md-4 -->
                <div class="col-md-4 auth-border">
                    <div class="service-item">
                        <div class="row otstup">
                            <h3 class="downH3"></h3>
                        </div>
                        <b><?=$msg; ?></b>
                        <form method="post">
                            Email: <input type="text" name="email" value="<?=$form->getEmail(); ?>"/> <br/><br/>
                            Password: <input type="password" name="password"/> <br/><br/>
                            <input type="submit"/>
                        </form>
                        <a href="register.php">Создать аккаунт</a>
                    </div> <!-- /.service-item -->
                </div> <!-- /.col-md-4 -->
                <div class="col-md-4">                    
                </div> <!-- /.col-md-4 -->
            </div> <!-- /.container -->
        </div> <!-- /#services -->
    </div> <!-- /.site-slider -->
    
    <script src="js/vendor/jquery-1.10.1.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.1.min.js"><\/script>')</script>
    <script src="js/jquery.easing-1.3.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>
    <!-- templatemo 401 sprint -->
</body>
</html>