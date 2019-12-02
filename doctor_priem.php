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
$Сard = $db->query("SELECT * FROM appointment WHERE Id = '{$fa}' OR Id = '{$_POST['Id']}'");
$Pens=$db->query("SELECT * FROM customers WHERE Id = '{$Сard[0]['Id_customers']}'");
$Pens1=$db->query("SELECT * FROM patients WHERE Id_customers = '{$Сard[0]['Id_customers']}'");
$res=$db->query("SELECT * FROM diagnosis");
$Do1=$db->query("SELECT * FROM referral WHERE Id='{$Сard[0]['Id_referral']}'");
$cost=$db->query("SELECT * FROM service WHERE Title = '{$Do1[0]['Title']}'");
$result=$db->query("SELECT * FROM medicines");
$Do=$db->query("SELECT * FROM doctors WHERE Position='{$Do1[0]['Title']}'");
if (isset($_POST["Finish"])) {

        $db->query("UPDATE appointment SET Status=1  WHERE Id='{$fa}'");
        $db->query("UPDATE customers SET Discount='{$_POST['dis']}'  WHERE Id='{$Pens[0]['Id']}'");
        $db->query("INSERT INTO patientadmission (Id_customers,Id_patients,Id_doctors,Id_referral,Data,Time,TotalPrice,Status) 
        	VALUES  ('{$Pens[0]['Id']}','{$Pens1[0]['Id']}','{$Do[0]['Id']}','{$Do1[0]['Id']}','{$Сard[0]['Data']}','{$Сard[0]['Tim']}',
        	'{$cost[0]['Cost']}','1')");
        $db->query("INSERT INTO appointeddiagnosis (Id_admission,Id_diagnosis)  
        	VALUES ('{$fa}','{$_POST['s1']}')") ; 
        $db->query("INSERT INTO assignedservices (Id_admission,Id_services)  
        	VALUES ('{$fa}','{$cost[0]['Id']}')") ; 
        $db->query("INSERT INTO prescriptionmedicines (Id_admission,Id_medicines)  
        	VALUES ('{$fa}','{$_POST['s2']}')") ; 
        header('location: doctor.php');

}

$name = $_POST['Id'];
$f = fopen('log.txt', 'w+'); 
fwrite($f, $name);
fclose($f);


$Сard = $db->query("SELECT * FROM appointment WHERE Id = '{$name}'");
$Pens=$db->query("SELECT * FROM customers WHERE Id = '{$Сard[0]['Id_customers']}'");
$Pens1=$db->query("SELECT * FROM patients WHERE Id_customers = '{$Сard[0]['Id_customers']}'");
$res=$db->query("SELECT * FROM diagnosis");
$Do1=$db->query("SELECT * FROM referral WHERE Id='{$Сard[0]['Id_referral']}'");
$cost=$db->query("SELECT * FROM service WHERE Title = '{$Do1[0]['Title']}'");
$result=$db->query("SELECT * FROM medicines");
$Do=$db->query("SELECT * FROM doctors WHERE Position='{$Do1[0]['Title']}'");
?>


<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>Прием</title>
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
								<li><a href="logout.php">Выход</a></li>
                            </ul>
                        </div> <!-- /.main-menu -->
                    </div> <!-- /.col-md-8 -->
                </div> <!-- /.row -->
			</div>
        </div> <!-- /.container -->
    </div> <!-- /.front -->
        
	
	
	
	<div class="site-slider">
			<div class="col-md-12 text-center">
                    <h1>Прием</h1>
            </div> <!-- /.col-md-12 -->
		
		<div id="services" class="content-section">
        <div class="container">
            <div class="row">	   
				<div class="col-md-12">
                    <div class="service-item">
					<div class="col-md-1">
					</div>
					<div class="col-md-4 priem-border">
                       <h3 class="downH3">Клиент</h3>
					   <div class="col-md-2 text-center">
								<p class="myCardd"><strong>ФИО:</strong> </p>							
							</div>
							<div class="col-md-10 text-center">
								<p class="myCardd2"><strong><?=$Pens[0]['FullName']; ?></strong> </p>							
							</div>
							
							<div class="col-md-2 text-center">
								<p class="myCardd"><strong>Год:</strong> </p>							
							</div>
							<div class="col-md-10 text-center">
								<p class="myCardd2"><strong><?=$Pens[0]['Date_birth']; ?></strong> </p>							
							</div>
							
					</div>					
					
					<div class="col-md-6 priem-border">
                       <h3 class="downH3">Пациент</h3>
					   <div class="col-md-2 text-center">
								<p class="myCardd"><strong>Кличка:</strong> </p>							
							</div>
							<div class="col-md-10 text-center">
								<p class="myCardd2"><strong><?=$Pens1[0]['Nickname']; ?></strong> </p>							
							</div>
							
							<div class="col-md-2 text-center">
								<p class="myCardd"><strong>Вид:</strong> </p>							
							</div>
							<div class="col-md-10 text-center">
								<p class="myCardd2"><strong><?=$Pens1[0]['Type']; ?></strong> </p>							
							</div>
							
							<div class="col-md-2 text-center">
								<p class="myCardd"><strong>Год:</strong> </p>							
							</div>
							<div class="col-md-10 text-center">
								<p class="myCardd2"><strong><?=$Pens1[0]['YearBirth']; ?></strong> </p>							
							</div>
							
							
							
							
					</div>
					<div class="col-md-12 botbot"> <!-- отступ -->
					</div>
					
					
					
					
					<div class="col-md-12 client-border">
					<div class="col-md-12">
                       <h3 class="downH3">Прием</h3>
							<div class="col-md-2 text-center">
								<p class="myCardd"><strong>Услуга:</strong> </p>							
							</div>
							<div class="col-md-8 text-center">
								<p class="myCardd2"><strong><?=$Do1[0]['Title']?></strong> </p>							
							</div>
							<div class="col-md-2 text-center">
								<p class="myCardd"><strong></strong> </p>							
							</div>
							
					</div>
					
					<div class="col-md-12 botbot"> <!-- отступ -->
					<hr>
					</div>
					
				<form method="POST">
					<div class="col-md-12">		
							<div class="col-md-2 text-center">
								<p class="myCardd"><strong>Диагноз:</strong> </p>							
							</div>
							<div class="col-md-4 text-center">
								 <fieldset>
									<select class="form-control" name="s1">
									  <?php foreach ($res as $key => $value) { 
										echo  '<option value="'.$res[$key]['Id'].'">'.$res[$key]['Title'].'</option>';
										}
										?>
									</select>							
								</fieldset>							
							</div>
							
							
								<div class="col-md-2 text-center">
								<p class="myCardd downPriem"><strong>Лекарство:</strong> </p>							
							</div>
							<div class="col-md-4 text-center">
								<select class="form-control" name="s2">
									  		<?php foreach ($result as $key => $value) { 
											echo  '<option value="'.$result[$key]['Id'].'">'.$result[$key]['Title'].'</option>';
											}
											?>
										</select>								
							</div>
			
								
						</div>	
						
							
									<div class="col-md-12 botbot"> <!-- отступ -->
									<hr>
									</div>
							
							
							<div class="col-md-12">									
								<div class="col-md-2 text-center">
									<p class="myCardd"><strong>Скидка:</strong> </p>							
								</div>
								<div class="col-md-4 text-center">
									<select  name="dis">
							 			<option value = "5">5%</option>
								  		<option value = "10">10%</option>
							 	 		<option value = "20">20%</option>
								  		<option value = "25">25%</option>
									</select>						
								</div>
								
								<div class="col-md-2 text-center">
									<p class="myCardd"><strong>Цена:</strong> </p>							
								</div>
								<div class="col-md-4 text-center">
									<p class="myCardd2"><strong><?=$cost[0]['Cost'];?>$</strong> </p>							
								</div>
							</div>
							
							<div class="col-md-12 botbot"> <!-- отступ -->
							<hr>
							</div>
							
							
							<div class="col-md-12">									
								<div class="col-md-12 text-center">
									 <input type="submit" name="Finish" value="Завершить прием" id="submit" class="button"  >							
								</div>
							</div>
							
					</div>
					</form>
					
					
					<div class="col-md-12 toptop">									
								<div class="col-md-12 text-left">
									 <a href="doctor.php"><input type="submit" value="Вернуться" id="submit" class="button"></a>							
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
                    <!-- <span id="copyright">
                    	Copyright &copy; 2014 <a href="#">Company Name</a>
                    </span> -->

            </div> <!-- /.col-md-6 -->
                <div class="col-md-4 col-sm-6">
                    <!-- <ul class="social">
                        <li><a href="#" class="fa fa-facebook"></a></li>
                        <li><a href="#" class="fa fa-twitter"></a></li>
                        <li><a href="#" class="fa fa-instagram"></a></li>
                        <li><a href="#" class="fa fa-linkedin"></a></li>
                        <li><a href="#" class="fa fa-rss"></a></li>
                    </ul> -->
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