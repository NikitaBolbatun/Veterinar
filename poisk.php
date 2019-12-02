<?php  
session_start();
require_once('forms/info.form.class.php');
require_once 'session.class.php';
require_once 'db.class.php';

$db_host = 'localhost';
$db_user = 'root';
$db_password = '';
$db_name = 'baza';

$db = new DB($db_host, $db_user, $db_password, $db_name);
$id = Session::get('user');

$resultEmail=$db->query("SELECT * FROM useraccount WHERE email = '{$_POST['name']}'");
?>

<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>Мой аккаунт</title>
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
                        <div >
                            <ul id="menu">
                                <li><a href="index.php">Главная</a></li>
                                <li><a href="logout.php">Выход (<?=Session::get('id'); ?>)</a></li>
                            </ul>
                        </div> <!-- /.main-menu -->
                    </div> <!-- /.col-md-8 -->
                </div> <!-- /.row -->
            </div>
        </div> <!-- /.container -->
    </div> <!-- /.front -->
        
    
    
    
    <div class="site-slider">
            <div class="col-md-12 text-center">
                    <h1>Панель администратора</h1>
            </div> <!-- /.col-md-12 -->

      
                <div class="row">
                    <div class="col-md-12 text-center">
                            <h1 class="section-title">Пользователи</h1>
                    </div> <!-- /.col-md-12 -->                 
                </div>
                <div class="col-md-12">
                    <div class="service-item">              
                <table class="table table-bordered table-hover">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th class="text-center">Логин</th>
                          <th class="text-center">Пароль</th>
                          <th class="text-center">Имя</th>
                          <th class="text-center">Роль</th>
                          <th class="text-center">Редактирование</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($resultEmail as $key => $value) { 
                            $resultRole=$db->query("SELECT Id_role FROM roleaccount WHERE Id_user_account = '{$resultEmail[$key]['Id']}' ");
                            $resultRole2=$db->query("SELECT Title FROM role WHERE Id = '{$resultRole[0]['Id_role']}' ");
                            echo '<tr>';
                            echo '<th scope="row">'.$key.'</th>';
                            echo '<form method="POST" >';
                            echo  '<td>'.$resultEmail[$key]['email'].'</td>';
                            echo '<td>'.$resultEmail[$key]['password'].'</td>';
                            echo '<td>'.$resultEmail[$key]['username'].'</td>';
                            echo '<td>'.$resultRole2[0]['Title'].'</td>';
                            echo '<td>'; 
                            echo '<input type="hidden" name="email" value="'.$resultEmail[$key]['email'].'">';
                            echo '<input type="hidden" name="title" value="'.$resultRole2[0]['Title'].'">';
                            echo '<input type="hidden" name="role" value="'.$resultRole[0]['Id_role'].'">';
                            echo '<button class="new" formaction="personal_update.php">Редактировать</button>
                            </form>';
                           echo '</td>
                        </tr>';
                        }
                        ?>
                      </tbody>
                    </table>    
                    </div> <!-- /.service-item -->
                </div> 

                    <div class="col-md-12 text-center">                                  
                                <div class="col-md-12 text-left">
                                     <a href="admin.php"><input type="submit" value="Вернуться" id="submit" class="button"></a>                            
                                </div>
                            </div><!-- /.col-md-3 -->
                
                