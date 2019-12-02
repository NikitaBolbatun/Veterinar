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

$result=$db->query("SELECT * FROM diagnosis WHERE Title = '{$_POST['name']}' OR Description = '{$_POST['op']}'");
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

      
<div class="col-md-12">
                    <div class="service-item">              
                <table class="table table-bordered table-hover">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th class="text-center">Название</th>
                          <th class="text-center">Описание</th>
                          <th class="text-center">Редактирование</th>
                        </tr>
                      </thead>
                      <tbody>
                         <?php foreach ($result as $key => $value) { 
                         echo '<tr>';
                         echo '<form method="POST">';
                         echo '<th scope="row">'.$key.'</th>';
                         echo  '<td>'.$result[$key]['Title'].'</td>';
                         echo '<td>'.$result[$key]['Description'].'</td>';
                         echo '<td>';
                         echo '<input type="hidden" name="Title" value="'.$result[$key]['Title'].'">';
                         echo '<button class="new" formaction="diagnosis_update.php">Редактировать</button>
                            </form>
                          </td>
                        </tr>';
                        }
                        ?>
                      </tbody>
                    </table>    
                    </div> <!-- /.service-item -->
                </div> <!-- /.col-md-3 -->
                

                    <div class="col-md-12 text-center">                                  
                                <div class="col-md-12 text-left">
                                     <a href="admin.php"><input type="submit" value="Вернуться" id="submit" class="button"></a>                            
                                </div>
                            </div><!-- /.col-md-3 -->
                
                