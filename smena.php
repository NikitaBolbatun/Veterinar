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
$array=file('log.txt');
$fa=implode(",", $array);
$g=$_POST['Data'];
$r=$db->query("SELECT * FROM appointment WHERE Id_referral='{$fa}' AND Id_customers='{$id}' AND Data = '{$g}'");
if(isset($_POST["send"])) {
  $q=$_POST['s'];
  $Diag=$db->query("SELECT * FROM referral WHERE Title = '{$q}'");
    $db->query("UPDATE appointment SET Id_referral='{$Diag[0]['Id']}', Data = '{$_POST['date']}', Tim = '{$_POST['time']}'  WHERE Id_referral='{$fa}' AND Id_customers='{$id}' LIMIT 1");
    header('location: client.php');
}
$name = $_POST['Id_referral'];
$f = fopen('log.txt', 'w+'); 
fwrite($f, $name);
fclose($f); 
$array=file('log.txt');
$fa=implode(",", $array);

$result = $db->query("SELECT * FROM referral");
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
                            <ul id="menu" >
                                <li><a href="index.php">Главная</a></li>
                                <li><a href="logout.php">Выход (<?=Session::get('id'); ?>)</a></li>
                            </ul>
                        </div> 
                    </div> <!-- /.col-md-8 -->
                </div> <!-- /.row -->
      </div>
        </div> <!-- /.container -->
    </div> <!-- /.front -->
        
        
  
  <div id="contact" class="content-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1 class="section-title">Изменение записи</h1>
                </div> <!-- /.col-md-12 -->
            </div> <!-- /.row -->
            <div class="row">

                <div class="col-md-12 text-center">
                    <form method="post" name="Zapis"> 
                        <fieldset class="col-md-12 text-center">
                            <select class="form-control" name="s">
                <?php foreach ($result as $key => $value){
                    echo  '<option value="'.$result[$key]['Title'].'">'.$result[$key]['Title'].'</option>';
                }
                ?>
              </select>
              
                        </fieldset>
                        <fieldset class="col-md-12 text-center">
                            <label for="inputDate">Введите дату:</label>
              <input type="date" name="date" class="form-control">        
                        </fieldset>
             <fieldset class="col-md-12 text-center" id="datetimepicker4">
                <label for="inputDate">Выберите время:</label>
                <select class="form-control" name="time">
                  <option value = "12:00">12:00</option>
                    <option value = "13:00">13:00</option>
                  <option value = "14:00">14:00</option>
                    <option value = "15:00">15:00</option>
                    <option value = "16:00">16:00</option>
                    <option value = "17:00">17:00</option>
                  <option value = "18:00">18:00</option>
                    <option value = "19:00">19:00</option>
                  <option value = "20:00">20:00</option>
              </select>
                        </fieldset>
                        <fieldset class="col-md-12 text-center" >
                            <input type="submit" name="send" value="Записаться" id="submit" class="button">
                        </fieldset>
                     
                    </form>
                    
                </div> 
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </div> <!-- /#products -->
  
  
    <div class="site-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-sm-6">
            </div> <!-- /.col-md-6 -->
                <div class="col-md-4 col-sm-6">
                </div> <!-- /.col-md-6 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </div> <!-- /.site-footer -->

    
    <script src="js/vendor/jquery-1.10.1.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.1.min.js"><\/script>')</script>
    <script src="js/jquery.easing-1.3.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>
    <!-- templatemo 401 sprint -->
</body>
</html>