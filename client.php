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

$resname = $db->query("SELECT username FROM useraccount WHERE id = '{$id}' LIMIT 1");
$resData = $db->query("SELECT Date_birth FROM customers WHERE id = '{$id}' LIMIT 1");
$resPhone = $db->query("SELECT Phone FROM customers WHERE id = '{$id}' LIMIT 1");
$resAddress =$db->query("SELECT Address FROM customers WHERE id = '{$id}' LIMIT 1");
$resDiscount =$db->query("SELECT Discount FROM customers WHERE id = '{$id}' LIMIT 1");
$resFullname = $db->query("SELECT Fullname FROM customers WHERE id = '{$id}' LIMIT 1");

$form = new InfoForm($_POST);

if (isset($_POST["first"])) {
   if ($form->validate()) {
       $Fullname = $db->escape($form->getFullname());
       $happy = $db->escape($form->gethappy());
       $address = $db->escape($form->getaddress());
       $phone = $db->escape($form->getphone());
       $db->query("DELETE FROM customers WHERE id = '{$id}'");
       $db->query("INSERT INTO customers(id,Fullname,Date_birth,Address,Phone) VALUES ('{$id}','{$Fullname}','{$happy}','{$address}','{$phone}')");
    }
}

if(isset($_POST["Second"])) {
       $Pet = $db->escape($form->getPet());
       $happyPet = $db->escape($form->gethappyPet());
       $TypePet = $db->escape($form->getTypePet());
       $db->query("INSERT INTO patients(Id_customers,Type,YearBirth,Nickname) VALUES ('{$id}','{$TypePet}','{$happyPet}','{$Pet}')");
}

if(isset($_POST["send"])) {
	$q=$_POST['s'];
	$Diag=$db->query("SELECT * FROM referral WHERE Title = '{$q}'");
    $db->query("INSERT INTO appointment(Id_customers,Id_referral,Data,Tim,Status) 
    	VALUES ('{$id}','{$Diag[0]['Id']}','{$_POST['date']}','{$_POST['time']}','0')");
}
$Petname = $db->query("SELECT Nickname FROM patients WHERE Id_customers = '{$id}' LIMIT 1");
$PetData = $db->query("SELECT YearBirth FROM patients WHERE Id_customers = '{$id}' LIMIT 1");
$PetType = $db->query("SELECT Type FROM patients WHERE Id_customers = '{$id}' LIMIT 1");
$result = $db->query("SELECT * FROM referral");
$r=$db->query("SELECT * FROM appointment");

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
        
	
	
	
	<div class="site-slider">		
		<div id="services" class="content-section">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="service-item">
                        <span class="service-icon first"></span>
                        <h3 class="downH3"><?=$resname[0]['username']; ?></h3>
                        <p class="downMRG"><strong>Полное имя :</strong><?=$resFullname[0]['Fullname']; ?></p>
                        <p class="downMRG"><strong>Год рождения:</strong><?=$resData[0]['Date_birth']; ?></p>
						<p class="downMRG"><strong>Тел:</strong> <?=$resPhone[0]['Phone']; ?></p>
						<p class="downMRG"><strong>Адрес:</strong><?=$resAddress[0]['Address']; ?></p>
						<p class="downMRG"><strong>Скидка:</strong> <?=$resDiscount[0]['Discount']; ?> %</p>
                    </div> <!-- /.service-item -->
                </div> <!-- /.col-md-3 -->
               
			   
				<div class="col-md-8 client-border">
                    <div class="service-item">
					<div class="row">
                       <h3 class="downH3">Личная карточка</h3>
					</div>
						<form method="post" name="Info">					
						    <div class="col-md-2 text-center">
								<p class="myCardd"><strong>ФИО:</strong> </p>							
							</div>
							<div class="col-md-10 text-center">
								<input type="text" name="Fullname" value="<?=$form->getFullname(); ?>" placeholder="Иванова В.В.">										</div>
							
							<div class="col-md-2 text-center">
								<p class="myCard"><strong>Год:</strong> </p>							
							</div>
							<div class="col-md-4 text-center">
								<input type="date" name="happy" value="<?=$form->gethappy(); ?>" class="form-control">
							</div>
							
							<div class="col-md-2 text-center">
								<p class="myCard"><strong>Тел:</strong> </p>							
							</div>
							<div class="col-md-4 text-center">
								<input type="text" name="phone" value="<?=$form->getphone(); ?>" placeholder="+7-999-999-99-99">
							</div>
							
							
							<div class="col-md-2 text-center">
								<p class="myCardd"><strong>Адрес:</strong> </p>							
							</div>
							<div class="col-md-10 text-center">
								<input type="text" name="address"  placeholder="ул. Ленина 20">							
							</div>
								
							<fieldset class="col-md-12 text-center" >
                            <input type="submit" name="first" value="Изменить" id="submit" class="button">
							</fieldset>	
						</form>					
                    </div> <!-- /.service-item -->
                </div> <!-- /.col-md-3 -->
				
				
				<div class="col-md-12 text-center">
							<h1 class="section-title">Питомцы</h1>
					</div>
			
				<div class="col-md-4">
                    <div class="service-item">
                        <span class="service-icon first"></span>
                        <h3 class="downH3"><?=$Petname[0]['Nickname']; ?> </h3>
                        <p class="downMRG"><strong>Год рождения:</strong> <?=$PetData[0]['YearBirth']; ?> </p>
						<p class="downMRG"><strong>Тип:</strong><?=$PetType[0]['Type']; ?> </p>
                    </div> <!-- /.service-item -->
                </div> <!-- /.col-md-3 -->
               
               <div class="col-md-8 client-border">
                    <div class="service-item">
					<div class="row">
                       <h3 class="downH3">Информация</h3>
					</div>
						<form method="post" name="PetInfo">				
						    <div class="col-md-2 text-center">
								<p class="myCardd"><strong>Кличка:</strong> </p>							
							</div>
							<div class="col-md-10 text-center">
								<input type="text" name="Pet" value="<?=$form->getPet(); ?>" placeholder="Буча">
							</div>
							<div class="col-md-2 text-center">
								<p class="myCardd"><strong>Тип:</strong> </p>							
							</div>
							<div class="col-md-10 text-center">
								<input type="text" name="TypePet" value="<?=$form->getTypePet(); ?>" placeholder="Кошка">						
							</div>
							<div class="col-md-2 text-center">
								<p class="myCard"><strong>Год:</strong> </p>							
							</div>
							<div class="col-md-4 text-center">
								<input type="date" name="happyPet" value="<?=$form->gethappyPet(); ?>" class="form-control">
							</div>
								
							<fieldset class="col-md-12 text-center" >
                            <input type="submit" name="Second" value="Изменить" id="submit" class="button">
							</fieldset>	
						</form>					
                    </div> <!-- /.service-item -->
                </div> <!-- /.col-md-3 -->
				
				<div class="row">
					<div class="col-md-12 text-center">
							<h1 class="section-title">Записи</h1>
					</div> <!-- /.col-md-12 -->					
				</div>
				
				<div class="col-md-12">
                    <div class="service-item">				
				<table class="table table-bordered table-hover">
					  <thead>
						<tr>
						  <th>#</th>
						  <th class="text-center">Услуга</th>
						  <th class="text-center">Врач</th>
						  <th class="text-center">Питомец</th>
						  <th class="text-center">Дата</th>
						  <th class="text-center">Время</th>
						  <th class="text-center">Прием</th>
						  <th class="text-center">Редактирование</th>
						</tr>
					  </thead>
					  <tbody>
						<?php foreach ($r as $key => $value) { 
							if ($id == $r[$key]['Id_customers']) {
							$q=$db->query("SELECT * FROM  referral WHERE Id='{$r[$key]['Id_referral']}'");
							$w=$db->query("SELECT * FROM  doctors WHERE Position='{$q[0]['Title']}'");
							$k=$db->query("SELECT * FROM  patients WHERE Id_customers='{$id}'");
							echo '<tr>';
							echo '<th scope="row">'.$key.'</th>';
							echo  '<td>Прием '.$q[0]['Title'].'а</td>';
							echo '<td>'.$w[0]['FullName'].'</td>';
							echo '<td>'.$k[0]['Nickname'].'</td>';
							echo '<td>'.$r[$key]['Data'].'</td>';
							echo '<td>'.$r[$key]['Tim'].'</td>';
							echo '<form method="POST">';
							if ($r[$key]['Status']==0){
								echo '<td class="color_td_g">Активен</td>';
								echo '<input type="hidden" name="Id_referral" value="'.$r[$key]['Id_referral'].'">';
							echo '<input type="hidden" name="Data" value="'.$r[$key]['Data'].'">';
							echo '<td><button class="new" formaction="smena.php">Изменить</button>
							</form>';
							}
							if ($r[$key]['Status']==1){
								echo '<td class="color_td_r">Завершен</td>';
								echo '<td></td>';
							}
							
							
						   echo '</td>';
							}
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
	
	<div id="contact" class="content-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1 class="section-title">Запись</h1>
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