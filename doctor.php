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
$Doc=$db->query("SELECT * FROM doctors WHERE Id_useraccount = '{$id}' LIMIT 1");
$r=$db->query("SELECT * FROM appointment");
$idRole=$db->query("SELECT * FROM referral WHERE Title = '{$Doc[0]['Position']}'"); 


 ?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8">
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
                    <h1>Здравствуйте <?=$resname[0]['username']; ?></h1>
            </div> <!-- /.col-md-12 -->
		
		<div id="services" class="content-section">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="service-item">
                        <span class="service-icon first"></span>
                        <h3 class="downH3"><?=$resname[0]['username']; ?></h3>
                        <p class="downMRG"><strong>Должность:</strong> <?=$Doc[0]['Position']; ?></p>
						<p class="downMRG"><strong>Стаж:</strong> <?=$Doc[0]['Experience']; ?> </p>
                    </div> <!-- /.service-item -->
                </div> <!-- /.col-md-3 -->
               
			   
				<div class="col-md-8">
                    <div class="service-item">
					<div class="row">
                       <h3 class="downH3">Список назначенных клиентов</h3>
					</div>					
						<table class="table table-bordered table-hover">
					  <thead>
						<tr>
						  <th>#</th>
						  <th class="text-center">ФИО</th>
						  <th class="text-center">Дата</th>
						  <th class="text-center">Время</th>
						  <th class="text-center">Прием</th>
						</tr>
					  </thead>
					  <tbody>
							<?php 
							$i=1;
							foreach ($r as $key => $value) { 
							if ($r[$key]['Status']==0 and $r[$key]['Id_referral']==$idRole[0]['Id']){
								$q=$db->query("SELECT * FROM  useraccount WHERE Id='{$r[$key]['Id_customers']}'");
								echo '<tr>';
								echo '<form method="POST" action="doctor_priem.php">';
								echo '<th scope="row">'.$i.'</th>';
								echo '<td>'.$q[0]['username'].'</td>';
								echo '<td>'.$r[$key]['Data'].'</td>';
								echo '<td>'.$r[$key]['Tim'].'</td>';
								echo '<input type="hidden" name="Id" value="'.$r[$key]['Id'].'">';
								echo  '<td>
									<button class="new">Подробнее</button>
									</form></td>';
								$i++;

							}
						}
						?>
					  </tbody>
					</table>    
                    </div> <!-- /.service-item -->
                </div> <!-- /.col-md-3 -->
				
				<div class="row">
					<div class="col-md-12 text-center">
							<h1 class="section-title">Завершенные приемы</h1>
					</div> <!-- /.col-md-12 -->					
				</div>

		<div class="col-md-12">
				
									<div class="col-md-4 text-center">
					<label>Диагноз</label>
					<form method="POST" action="poisk6.php">
					<input id="name" type="text" name="name" placeholder="Название">	
				</div>
					
					<div class="col-md-4 text-center">
					<label>Цена</label>
					 <input id="name" type="text" name="op" placeholder="Цена">
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
						  <th class="text-center">ФИО</th>
						  <th class="text-center">Пациент</th>
						  <th class="text-center">Дата</th>
						  <th class="text-center">Диагноз</th>						  
						  <th class="text-center">Лечение</th>
						  <th class="text-center">Цена</th>
						</tr>
					  </thead>
					  <tbody>
						<?php $i=1; 
						foreach ($r as $key => $value) { 
							if ($r[$key]['Status']==1 and $r[$key]['Id_referral']==$idRole[0]['Id']){

							$q=$db->query("SELECT * FROM  referral WHERE Id='{$r[$key]['Id_referral']}'");
							$w=$db->query("SELECT * FROM  doctors WHERE Position='{$q[0]['Title']}'");
							$k=$db->query("SELECT * FROM  useraccount WHERE Id='{$r[$key]['Id_customers']}'");
							$k1=$db->query("SELECT * FROM  patients WHERE Id_customers='{$k[0]['Id']}'");
							$k2=$db->query("SELECT * FROM  customers WHERE Id='{$k[0]['Id']}'");
							$patient = $db->query("SELECT * FROM  patientadmission WHERE Id_customers='{$k[0]['Id']}' AND Data = '{$r[$key]['Data']}'");
							$admission=$db->query("SELECT * FROM  appointment WHERE Id_customers='{$patient[0]['Id_customers']}' 
								AND Data = '{$patient[0]['Data']}' AND Id_referral= '{$patient[0]['Id_referral']}' AND Tim= '{$patient[0]['Time']}'");
							$diagnoz=$db->query("SELECT * FROM appointeddiagnosis WHERE Id_admission = '{$admission[0]['Id']}'");
							$diagnoz2=$db->query("SELECT * FROM diagnosis WHERE Id = '{$diagnoz[0]['Id_diagnosis']}'");
							$medi=$db->query("SELECT * FROM prescriptionmedicines WHERE Id_admission = '{$admission[0]['Id']}'");
							$mediz2=$db->query("SELECT * FROM medicines WHERE Id = '{$medi[0]['Id_medicines']}'");
							echo '<tr>';
							echo '<th scope="row">'.$i.'</th>';
							echo '<td>'.$w[0]['FullName'].'</td>';							
							echo  '<td>'.$k1[0]['Type'].'</td>';
							echo '<td>'.$r[$key]['Data'].'</td>';
							echo '<td>'.$diagnoz2[0]['Title'].'</td>';
							echo '<td>'.$mediz2[0]['Title'].'</td>';
							$cost=$patient[0]['TotalPrice'];
							$dis=$k2[0]['Discount'];
							$Total=$cost - $cost/100*$dis;
							echo '<td>'.$Total.'</td>';
							$i++;

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
	
	
	
	
    <div class="site-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-sm-6">

            </div> <!-- /.col-md-6 -->
                <div class="col-md-4 col-sm-6">

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