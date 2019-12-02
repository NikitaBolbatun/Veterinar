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

$resFullname = $db->query("SELECT username FROM useraccount WHERE id = '{$id}' LIMIT 1");


$form = new InfoForm($_POST);

if (isset($_POST["AdminNick"])) {
   if ($form->validate()) {
       $Fullname = $db->escape($form->getFullname());
       $db->query("UPDATE useraccount SET username = '{$Fullname}' WHERE id = '{$id}'");
       unset($_POST);
    }
}
if (isset($_POST["Diagnos"])) {
	if ($form->validate()){
		$Bolez = $db->escape($form->getBolez());
     	$Opisanie = $db->escape($form->getOpisanie());
      	$db->query("INSERT INTO diagnosis (title,Description) VALUES ('{$Bolez}','{$Opisanie}')");
      	unset($_POST);
	}   	
}
if (isset($_POST["Service"])) {
	if ($form->validate()){
		$Bolez = $db->escape($form->getBolez());
     	$Opisanie = $db->escape($form->getOpisanie());
      	$db->query("INSERT INTO service (title,Cost) VALUES ('{$Bolez}','{$Opisanie}')");
      	unset($_POST);
	}   	
}
if (isset($_POST["Medicine"])) {
	if ($form->validate()){
		$Bolez = $db->escape($form->getBolez());
		$Pet = $db->escape($form->getPet());
     	$Opisanie = $db->escape($form->getOpisanie());
      	$db->query("INSERT INTO medicines (title,Dosage,CourseDuration) VALUES ('{$Bolez}','{$Pet}','{$Opisanie}')");
      	unset($_POST);
	}   	
}
if (isset($_POST["refel"])) {
   if ($form->validate()) {
       $Fullname = $db->escape($form->getFullname());
       $db->query("INSERT INTO referral (title) VALUES ('{$Fullname}')");
       unset($_POST);
    }
}

$result=$db->query("SELECT * FROM diagnosis");
$resultEmail=$db->query("SELECT * FROM useraccount");
$resultService=$db->query("SELECT * FROM service");
$resultMedicines=$db->query("SELECT * FROM medicines");
$resultRef=$db->query("SELECT * FROM referral");
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
		
		<div id="services" class="content-section">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="service-item">
                        <span class="service-icon first"></span>
                        <h3 class="downH3"><?=$resFullname[0]['username']; ?></h3>
                        <p class="downMRG"><strong>Администратор</strong></p>
                    </div> 
                </div> 
               
			   
				<div class="col-md-8 client-border">
                    <div class="service-item">
					<div class="row">
                       <h3 class="downH3">Личная карточка</h3>
					</div>	
						<form method="post">	
								<div class="col-md-12 botbot">
								</div>	
								<div class="col-md-12 botbot"> 
								</div>									
						    <div class="col-md-2 text-center">
								<p class="myCardd"><strong>ФИО:</strong> </p>							
							</div>
							<div class="col-md-10 text-center">
								
									<input type="text" name="Fullname" value="<?=$form->getFullname(); ?>"  placeholder="Иванова В.В.">	
							</div>
							<fieldset class="col-md-12 text-center" >
                            <input type="submit" name="AdminNick" value="Изменить" id="submit" class="button">
							</fieldset>	
						</form>					
                    </div> <!-- /.service-item -->
                </div> <!-- /.col-md-3 -->
				
	





	
				<div class="col-md-12 text-center">
							<h1 class="section-title">Добавление</h1>
					</div>
			
                  
				<div class="col-md-12">
					<div class="col-md-5 client-border">
                    <div class="service-item">
					<div class="row">
                       <h3 class="downH3">Диагноз</h3>
					</div>	
						<form method="post">				
						    <div class="col-md-2 text-center">
								<p class="myCardd"><strong>Название:</strong> </p>							
							</div>
							<div class="col-md-10 text-center">
								<input type="text" value="<?=$form->getBolez(); ?>" name="Bolez" placeholder="Название диагноза">
							</div>
							
							<div class="col-md-2 text-center">
								<p class="myCard"><strong>Описание:</strong> </p>							
							</div>
							<div class="col-md-10 text-center">
								<input type="text" value="<?=$form->getOpisanie(); ?>" name="Opisanie">						
							</div>
								
							<fieldset class="col-md-12 text-center" >
                            <input type="submit" name="Diagnos" value="Добавить" id="submit" class="button">
							</fieldset>
						</form>
					</div> 

                    </div> <!-- /.service-item -->
					
					<div class="col-md-2">
					</div>
					
					<div class="col-md-5 client-border">
                    <div class="service-item">
					<div class="row">
                       <h3 class="downH3">Услуга</h3>
					</div>	
						<form method="post">				
						    <div class="col-md-2 text-center">
								<p class="myCardd"><strong>Название:</strong> </p>							
							</div>
							<div class="col-md-10 text-center">
								<input type="text" value="<?=$form->getBolez(); ?>" name="Bolez" placeholder="Название услуги">							
							</div>
							
							<div class="col-md-2 text-center">
								<p class="myCard"><strong>Стоимость:</strong> </p>							
							</div>
							<div class="col-md-10 text-center">
								<input type="text" value="<?=$form->getOpisanie(); ?>" name="Opisanie" placeholder="$10">							
							</div>
								
							<fieldset class="col-md-12 text-center" >
                            <input type="submit" name="Service" value="Добавить" id="submit" class="button">
							</fieldset>
						</form>
						 							
                    	</div> <!-- /.service-item -->
					</div>
                </div> <!-- /.col-md-3 -->
				
				
				<div class="col-md-12 botbot"> <!-- отступ -->

							</div>
				
				
				
				<div class="col-md-12">
					<div class="col-md-5 client-border">
                    <div class="service-item">
					<div class="row">
                       <h3 class="downH3">Лекарство</h3>
					</div>		
						<form method="post">			
						    <div class="col-md-2 text-center">
								<p class="myCardd"><strong>Название:</strong> </p>							
							</div>
							<div class="col-md-10 text-center">
								<input type="text" value="<?=$form->getBolez(); ?>" name="Bolez"  placeholder="Название лекарства">							
							</div>
							
							<div class="col-md-2 text-center">
								<p class="myCard"><strong>Доза:</strong> </p>							
							</div>
							<div class="col-md-10 text-center">
								<input type="text" value="<?=$form->getPet(); ?>" name="Pet"  placeholder="Доза лекарства">							
							</div>
							
							<div class="col-md-2 text-center">
								<p class="myCard"><strong>Длит:</strong> </p>							
							</div>
							<div class="col-md-10 text-center">
								<input type="text" value="<?=$form->getOpisanie(); ?>" name="Opisanie"  placeholder="Длительность курса">							
							</div>
								
							<fieldset class="col-md-12 text-center" >
                            <input type="submit" name="Medicine" value="Добавить" id="submit" class="button">
							</fieldset>
						</form>
					</div> 			

                    </div> <!-- /.service-item -->		

						<div class="col-md-2">
						</div>	


							<div class="col-md-5 client-border">
                    <div class="service-item">
					<div class="row">
                       <h3 class="downH3">Специальность</h3>
					</div>	
						<form method="POST">				
						    <div class="col-md-2 text-center">
								<p class="myCardd"><strong>Название:</strong> </p>							
							</div>
							<div class="col-md-10 text-center">
								<input type="text"  name="Fullname" value="<?=$form->getFullname(); ?>" placeholder="Название специальности">				
							</div>
								
							<fieldset class="col-md-12 text-center" >
                            <input type="submit" name="refel" value="Добавить" id="submit" class="button">
							</fieldset>
						</form>
						</div> 							
                    </div> <!-- /.service-item -->	
					
					
                </div> <!-- /.col-md-3 -->
				
				
				
				
				<div class="row">
					<div class="col-md-12 text-center">
							<h1 class="section-title">Пользователи</h1>
					</div> <!-- /.col-md-12 -->					
				</div>
				
				<div class="col-md-12">
					<div class="col-md-4 text-center">
					<label>Логин</label>
					<form method="POST" action='poisk.php'>
						<input id="name" type="text" name="name" placeholder="Логин">
					</div>
					<div class="col-md-4 text-center">
					 <input type="submit" name="chane" value="Искать" id="submit" class="button">
					</div>
					</form>
				</div>
				
				<div class="col-md-12">
                    <div class="service-item">				
				<table class="table table-bordered table-hover">
					  <thead>
						<tr>
						  <th>#</th>
						  <th class="text-center">E-mail</th>
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
                </div> <!-- /.col-md-3 -->
				
				
				
				
					<div class="row">
					<div class="col-md-12 text-center">
							<h1 class="section-title">Диагнозы</h1>
					</div> <!-- /.col-md-12 -->					
				</div>
				

				
				<div class="col-md-12">
				
									<div class="col-md-4 text-center">
					<label>Название</label>
					<form method="POST" action="poisk2.php">
					<input id="name" type="text" name="name" placeholder="Название">	
				</div>
					
					<div class="col-md-4 text-center">
					<label>Описание</label>
					 <input id="name" type="text" name="op" placeholder="Описание">
					</div>
					
					
					
					<div class="col-md-4 text-center">
					 <input type="submit" name="chane" value="Искать" id="submit" class="button">
					</div>
					</form>
				</div>
				
				
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
				

				
				
				
				<div class="row">
					<div class="col-md-12 text-center">
							<h1 class="section-title">Услуги</h1>
					</div> <!-- /.col-md-12 -->					
				</div>
				
				
				<div class="col-md-12">
				
				<div class="col-md-4 text-center">
					<label>Название</label>
					<form method="POST" action="poisk3.php">
                            <select class="form-control" name="s">
								<?php foreach ($resultRef as $key => $value){
										echo  '<option value="'.$resultRef[$key]['Title'].'">'.$resultRef[$key]['Title'].'</option>';
								}
								?>
							</select>		
				</div>
					
					<div class="col-md-4 text-center">
					<label>Стоимость</label>
					
					 <input id="name" type="text" name="s2" placeholder="Введите стоимость">
					</div>
					
					
					
					<div class="col-md-4 text-center">
					 <input type="submit" name="chane" value="Искать" id="submit" class="button">
					</div>
					</form>
				</div>
				
				
				<div class="col-md-12">
                    <div class="service-item">				
				<table class="table table-bordered table-hover">
					  <thead>
						<tr>
						  <th>#</th>
						  <th class="text-center">Название</th>
						  <th class="text-center">Стоимость</th>
						  <th class="text-center">Редактирование</th>
						</tr>
					  </thead>
					  <tbody>
						<?php foreach ($resultService as $key => $value) { 
						 echo '<tr>'; 
						 echo '<form method="POST">';
						 echo '<th scope="row">'.$key.'</th>';
						 echo  '<td>'.$resultService[$key]['Title'].'</td>';
						 echo '<td>'.$resultService[$key]['Cost'].'</td>';
						 echo '<td>';
						 echo '<input type="hidden" name="Title" value="'.$resultService[$key]['Title'].'">';
						 echo '<button class="new" formaction="service_update.php">Редактировать</button>
							</form>
						  </td>
						</tr>';
						}
						?>
					  </tbody>
					</table>    
                    </div> <!-- /.service-item -->
                </div> <!-- /.col-md-3 -->
				
				
				
				
				<div class="row">
					<div class="col-md-12 text-center">
							<h1 class="section-title">Лекарства</h1>
					</div> <!-- /.col-md-12 -->					
				</div>
				
				
				
				<div class="col-md-12">			
				<div class="col-md-4 text-center">
					<label>Название</label>
				<form method="POST" action="poisk4.php">
					<input id="name" type="text" name="name" placeholder="Введите название">	
				</div>
					
					<div class="col-md-3 text-center">
					<label>Доза</label>
					 <input id="name" type="text" name="dosage" placeholder="Введите дозу">
					</div>
					
					<div class="col-md-3 text-center">
					<label>Длительность</label>
					 <input id="name" type="text" name="course" placeholder="Введите длительность">
					</div>
						
					<div class="col-md-2 text-center">
					 <input type="submit" name="chane" value="Искать" id="submit" class="button">
				</form>
					</div>					
				</div>
				
				
				
				<div class="col-md-12">
                    <div class="service-item">				
				<table class="table table-bordered table-hover">
					  <thead>
						<tr>
						  <th>#</th>
						  <th class="text-center">Название</th>
						  <th class="text-center">Доза</th>
						  <th class="text-center">Длительность</th>
						  <th class="text-center">Редактирование</th>
						</tr>
					  </thead>
					  <tbody>
							<?php foreach ($resultMedicines as $key => $value) { 
						 	 echo '<tr>';
							 echo '<th scope="row">'.$key.'</th>';							 
							 echo '<form method="POST">';
							 echo  '<td>'.$resultMedicines[$key]['Title'].'</td>';
							 echo '<td>'.$resultMedicines[$key]['Dosage'].'</td>';
							 echo '<td>'.$resultMedicines[$key]['CourseDuration'].'</td>';
							 echo '<td>'; 
							 echo '<input type="hidden" name="Title" value="'.$resultMedicines[$key]['Title'].'">';
						 	 echo '<button class="new" formaction="medical_update.php">Редактировать</button>
							</form>
						  </td>
						</tr>';
						}
						?>
					  </tbody>
					</table>    
                    </div> <!-- /.service-item -->
                </div> <!-- /.col-md-3 -->
				
				
				<div class="row">
					<div class="col-md-12 text-center">
							<h1 class="section-title">Специальности</h1>
					</div> <!-- /.col-md-12 -->					
				</div>
				
				
				
				<div class="col-md-12">			
				<div class="col-md-6 text-center">
					<label>Название</label>
					<form method="POST" action="poisk5.php">
                            <select class="form-control" name="s">
								<?php foreach ($resultRef as $key => $value){
										echo  '<option value="'.$resultRef[$key]['Title'].'">'.$resultRef[$key]['Title'].'</option>';
								}
								?>
							</select>		
				</div>
					
					<div class="col-md-6 text-center">
					 <input type="submit" name="chane" value="Искать" id="submit" class="button">
					</div>					
				</div>
				</form>
				
				
				
				<div class="col-md-12">
                    <div class="service-item">				
				<table class="table table-bordered table-hover">
					  <thead>
						<tr>
						  <th>#</th>
						  <th class="text-center">Название</th>
						  <th class="text-center">Редактирование</th>
						</tr>
					  </thead>
					  <tbody>
							<?php foreach ($resultRef as $key => $value) { 
						 	 echo '<tr>';
							 echo '<th scope="row">'.$key.'</th>';
							 echo '<form method="POST">';
							 echo  '<td>'.$resultRef[$key]['Title'].'</td>';
							 echo '<td>'; 
							 echo '<input type="hidden" name="Title" value="'.$resultRef[$key]['Title'].'">';
						 	 echo '<button class="new" formaction="specialist_update.php">Редактировать</button>
							</form>
						  </td>
						</tr>';
						}
						?>
					  </tbody>
					</table>    
                    </div> <!-- /.service-item -->
                </div> <!-- /.col-md-3 -->
				
				
            </div> <!-- /.row -->
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