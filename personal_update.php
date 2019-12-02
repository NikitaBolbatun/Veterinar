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

if (isset($_POST["Delete"])) {
		$res=$db->query("SELECT * FROM useraccount WHERE email='{$fa}'");
      	$db->query("DELETE FROM useraccount WHERE email = '{$fa}'");
      	$db->query("DELETE FROM roleaccount WHERE Id_user_account = '{$res[0]['Id']}'");
      	$db->query("DELETE FROM doctors WHERE Id_useraccount = '{$res[0]['Id']}'");
      	header('location: admin.php');
}

$form = new InfoForm($_POST);
$Person=$db->query("SELECT * FROM useraccount WHERE email = '{$fa}'");
$resultRole=$db->query("SELECT * FROM roleaccount WHERE Id_user_account = '{$Person[0]['Id']}' ");
if (isset($_POST["Back"])) {
	$q=md5($_POST['password']);
	if($resultRole[0]['Id_role']=='0'){
       	$db->query("UPDATE useraccount SET username = '{$_POST['Fullname']}' WHERE id = '{$Person[0]['Id']}'");
       	$db->query("UPDATE useraccount SET email = '{$_POST['Email']}' WHERE id = '{$Person[0]['Id']}'");
       	$db->query("UPDATE useraccount SET password = '{$q}' WHERE id = '{$Person[0]['Id']}'");
		if($_POST['s']=='2'){
       	$db->query("INSERT INTO doctors (Fullname,Position,Experience,Id_useraccount) VALUES ('{$_POST['Fullname']}', '{$_POST['s1']}','0','{$Person[0]['Id']}')"); 

       		$db->query("UPDATE roleaccount SET Id_role = '{$_POST['s']}' WHERE Id_user_account = '{$Person[0]['Id']}'");
      	}
		header('location: admin.php');
	}
	if($resultRole[0]['Id_role']=='2'){
		$db->query("UPDATE doctors SET Fullname = '{$_POST['Fullname']}' WHERE Id_useraccount = '{$Person[0]['Id']}'");
		$db->query("UPDATE useraccount SET username = '{$_POST['Fullname']}' WHERE id = '{$Person[0]['Id']}'");
       	$db->query("UPDATE useraccount SET email = '{$_POST['Email']}' WHERE id = '{$Person[0]['Id']}'");
       	$db->query("UPDATE useraccount SET password = '{$q}' WHERE id = '{$Person[0]['Id']}'");
		if($_POST['s']=='0'){
       		$db->query("DELETE FROM doctors WHERE Id_useraccount = '{$Person[0]['Id']}'"); 	
       		$db->query("UPDATE roleaccount SET Id_role = '{$_POST['s']}' WHERE Id_user_account = '{$Person[0]['Id']}'");
      	}
      	header('location: admin.php');
	}	
}


$name = $_POST['email'];
$f = fopen('log.txt', 'w+'); 
fwrite($f, $name);
fclose($f); 
$array=file('log.txt');
$fa=implode(",", $array);


$Person=$db->query("SELECT * FROM useraccount WHERE email = '{$fa}'");
$resultRef=$db->query("SELECT * FROM referral");
?>

<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>Пользователь</title>
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
                    <h1>Пользователь</h1>
            </div> <!-- /.col-md-12 -->
		
		<div id="services" class="content-section">
        <div class="container">
            <div class="row">	   
				<div class="col-md-12">
                    <div class="service-item">
					
					
					
					
					
					<div class="col-md-12 client-border">
					<div class="col-md-12 botbot"> <!-- отступ -->
					</div>
				<form method="POST">
					<div class="col-md-12">		
									<div class="col-md-12 botbot"> <!-- отступ -->					
									</div>
							<div class="col-md-2 text-center">
								<p class="myCardd"><strong>Логин:</strong> </p>							
							</div>
							<div class="col-md-4 text-center">
									<input type="text" name="Email"  placeholder="<?=$Person[0]['email']; ?>">											
							</div>
							
							
								<div class="col-md-2 text-center">
								<p class="myCardd downPriem"><strong>Пароль:</strong> </p>							
							</div>
							<div class="col-md-4 text-center">
							<input type="text" name="password" va placeholder="<?=$Person[0]['password']; ?>">	
					
							</div>
							
							<div class="col-md-2 text-center">
								<p class="myCardd downPriem"><strong>Имя:</strong> </p>							
							</div>
							<div class="col-md-4 text-center">
							<input type="text" name="Fullname"   placeholder="<?=$Person[0]['username']; ?>" >	

							</div>
							
							<div class="col-md-2 text-center">
								<p class="myCardd downPriem"><strong>Выберите роль (На данный момент - <?=$_POST['title'] ?>):</strong> </p>							
							</div>
							<div class="col-md-4 text-center">
							<fieldset class="col-md-6 col-sm-6">
									<select class="form-control" name="s">
									  <option value="0">Клиент</option>
									  <option value="2">Врач</option>
									</select>							
								</fieldset>		
							</div>
							
							
						</div>	
						
							<div class="col-md-2 text-center">
								<p class="myCardd downPriem"><strong>Специальность:</strong> </p>							
							</div>
							<div class="col-md-10 text-center">
							<fieldset class="col-md-12">
									<select class="form-control" name="s1">
									  <?php foreach ($resultRef as $key => $value) { 
										echo  '<option value="'.$resultRef[$key]['Title'].'">'.$resultRef[$key]['Title'].'</option>';
										}
										?>
									</select>							
								</fieldset>		
							</div>




							<div class="col-md-6">									
								<div class="col-md-12 text-center">
									 <input type="submit" name="Back" value="Изменить" id="submit" class="button"  >							
								</div>
							</div>

					</form>

							<div class="col-md-6">									
								<div class="col-md-12 text-center">
									<form method="POST">
									 <input type="submit" name="Delete" value="Удалить" id="submit" class="button"  >	
									</form>						
								</div>
							</div>
							

							
					</div>
					
					
					<div class="col-md-12 toptop">									
								<div class="col-md-12 text-left">
									 <a href="admin.php"><input type="submit" value="Вернуться" id="submit" class="button"></a>							
								</div>
							</div>
							
                    </div> <!-- /.service-item -->
                </div> <!-- /.col-md-3 -->
				
						
				
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </div> <!-- /#services -->
    </div> <!-- /.site-slider -->
	
	
	
	
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