<?php
include('includes/session.php');
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['login']) == 0) {
	header('location:index.php');
} else {
	if (isset($_POST['submit'])) {

		# Assign form data with variable. 
		$serialnumber = $_POST['serialnumber'];
		$emailid = $_POST['emailid'];
		$laptoptitle = $_POST['laptoptitle'];
		$brand = $_POST['brandname'];
		$laptopoverview = $_POST['laptoporcview'];
		$priceperday = $_POST['priceperday'];
		$processor = $_POST['processor'];
		$storage = $_POST['storage'];
		$ram = $_POST['ram'];
		$vimage1 = $_FILES["img1"]["name"];
		$vimage2 = $_FILES["img2"]["name"];
		$vimage3 = $_FILES["img3"]["name"];
		$vimage4 = $_FILES["img4"]["name"];
		$charger = $_POST['charger'];
		$bag = $_POST['bag'];
		$mouse = $_POST['mouse'];
		move_uploaded_file($_FILES["img1"]["tmp_name"], "admin/img/laptopimages/" . $_FILES["img1"]["name"]);
		move_uploaded_file($_FILES["img2"]["tmp_name"], "admin/img/laptopimages/" . $_FILES["img2"]["name"]);
		move_uploaded_file($_FILES["img3"]["tmp_name"], "admin/img/laptopimages/" . $_FILES["img3"]["name"]);
		move_uploaded_file($_FILES["img4"]["tmp_name"], "admin/img/laptopimages/" . $_FILES["img4"]["name"]);

        # Insert form data into tbllaptops. 
		$sql = "INSERT INTO tbllaptops(SerialNumber,OwnerEmail,LaptopTitle,LaptopBrand,
		        LaptopOverview,PricePerDay,Processor,Storage,RAM,Vimage1,Vimage2,Vimage3,Vimage4,
				Charger,Bag,Mouse) 
		        VALUES(:serialnumber,:email,:laptoptitle,:brand,:laptopoverview,:priceperday,
				:processor,:storage,:ram,:vimage1,:vimage2,:vimage3,:vimage4,:charger,:bag,:mouse)";
		$query = $dbh->prepare($sql);
		$query->bindParam(':serialnumber', $serialnumber, PDO::PARAM_STR);
		$query->bindParam(':email', $emailid, PDO::PARAM_STR);
		$query->bindParam(':laptoptitle', $laptoptitle, PDO::PARAM_STR);
		$query->bindParam(':brand', $brand, PDO::PARAM_STR);
		$query->bindParam(':laptopoverview', $laptopoverview, PDO::PARAM_STR);
		$query->bindParam(':priceperday', $priceperday, PDO::PARAM_STR);
		$query->bindParam(':processor', $processor, PDO::PARAM_STR);
		$query->bindParam(':storage', $storage, PDO::PARAM_STR);
		$query->bindParam(':ram', $ram, PDO::PARAM_STR);
		$query->bindParam(':vimage1', $vimage1, PDO::PARAM_STR);
		$query->bindParam(':vimage2', $vimage2, PDO::PARAM_STR);
		$query->bindParam(':vimage3', $vimage3, PDO::PARAM_STR);
		$query->bindParam(':vimage4', $vimage4, PDO::PARAM_STR);
		$query->bindParam(':charger', $charger, PDO::PARAM_STR);
		$query->bindParam(':bag', $bag, PDO::PARAM_STR);
		$query->bindParam(':mouse', $mouse, PDO::PARAM_STR);
		$query->execute();
		$lastInsertId = $dbh->lastInsertId();
		if ($lastInsertId) {
			$msg = "Laptop posted successfully";
		} else {
			$error = "Something went wrong. Please try again";
		}
	}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<meta name="keywords" content="">
	<meta name="description" content="">
	<title>Laptop Rental Portal</title>
	<!--Bootstrap -->
	
	<link rel="stylesheet" href="assets/css/style.css" type="text/css">
	<link rel="stylesheet" href="assets/css/owl.carousel.css" type="text/css">
	<link rel="stylesheet" href="assets/css/owl.transitions.css" type="text/css">
	<link href="assets/css/slick.css" rel="stylesheet">
	<link href="assets/css/bootstrap-slider.min.css" rel="stylesheet">
	  <link href="assets/css/font-awesome.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

	<link rel="stylesheet" id="switcher-css" type="text/css" href="assets/switcher/css/switcher.css" media="all" />
	<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/red.css" title="red" media="all" data-default-color="true" />
	<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/orange.css" title="orange" media="all" />
	<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/blue.css" title="blue" media="all" data-default-color="true" /> />
	<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/pink.css" title="pink" media="all" />
	<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/green.css" title="green" media="all" />
	<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/purple.css" title="purple" media="all" />

	<!-- Font awesome -->
	<link rel="stylesheet" href="admin/css/font-awesome.min.css">
	<!-- Sandstone Bootstrap CSS -->
	<link rel="stylesheet" href="admin/css/bootstrap.min.css">
	<!-- Bootstrap Datatables -->
	<link rel="stylesheet" href="admin/css/dataTables.bootstrap.min.css">
	<!-- Bootstrap social button library -->
	<link rel="stylesheet" href="admin/css/bootstrap-social.css">
	<!-- Bootstrap select -->
	<link rel="stylesheet" href="admin/css/bootstrap-select.css">
	<!-- Bootstrap file input -->
	<link rel="stylesheet" href="admin/css/fileinput.min.css">
	<!-- Awesome Bootstrap checkbox -->
	<link rel="stylesheet" href="admin/css/awesome-bootstrap-checkbox.css">
	<!-- Admin Stye -->
	<link rel="stylesheet" href="admin/css/style.css">

	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/images/favicon-icon/apple-touch-icon-144-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/images/favicon-icon/apple-touch-icon-114-precomposed.html">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/images/favicon-icon/apple-touch-icon-72-precomposed.png">
	<link rel="apple-touch-icon-precomposed" href="assets/images/favicon-icon/apple-touch-icon-57-precomposed.png">
	<link rel="shortcut icon" href="assets/images/favicon-icon/favicon.png">
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">


	<style>
		.errorWrap {
			padding: 10px;
			margin: 0 0 20px 0;
			background: #fff;
			border-left: 4px solid #dd3d36;
			-webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
			box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
		}
		.succWrap {
			padding: 10px;
			margin: 0 0 20px 0;
			background: #fff;
			border-left: 4px solid #5cb85c;
			-webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
			box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
		}
	</style>
	
</head>

<body>

	<!-- Start Switcher -->
	<?php include('includes/colorswitcher.php'); ?>
	<!-- /Switcher -->

	<!--Header-->
	<?php include('includes/header.php'); ?>
	<!-- /Header -->

	<section>
		<?php
        # This block of code grabs the email address of the user current logged in. 
		$email = $_SESSION['login'];
		$sql1 = "SELECT EmailId FROM tblusers WHERE EmailId=:email ";
		$query1 = $dbh->prepare($sql1);
		$query1->bindParam(':email', $email, PDO::PARAM_STR);
		$query1->execute();
		$resultss = $query1->fetchAll(PDO::FETCH_OBJ);
		if ($query1->rowCount() > 0) {
			foreach ($resultss as $results) {
				# echo htmlentities($results->EmailId);
			}
		}
		?>
	</section>

	<div class="ts-main-content">
		<div class="content-wrapper" style="width:1170px;margin:auto">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">

						<h2 class="page-title" style="text-align: center;">Post Your Laptop</h2>

						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Basic Info</div>
									<?php if ($error) { ?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } else if ($msg) { ?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>

									<div class="panel-body">

									     <!--User input form for laptop details-->

										<form method="post" class="form-horizontal" enctype="multipart/form-data">

											<div class="form-group">
												<label class="col-sm-2 control-label">Serial Number<span style="color:red">*</span></label>
												<div class="col-sm-4">
													<input type="text" name="serialnumber" class="form-control" required>
												</div>

												<label class="col-sm-2 control-label">Owner Email<span style="color:red">*</span></label>
												<div class="col-sm-4">
													<input type="email" name="emailid" class="form-control"  value = "<?php echo htmlentities($results->EmailId); ?>" onBlur="checkAvailability()" readonly="readonly" required>
													<span id="user-availability-status" style="font-size:12px;"></span>
												</div>
											</div>
											<div class="hr-dashed"></div>
											<div class="form-group">
												<label class="col-sm-2 control-label">Laptop Title<span style="color:red">*</span></label>
												<div class="col-sm-4">
													<input type="text" name="laptoptitle" class="form-control" required>
												</div>

												<label class="col-sm-2 control-label">Select Brand<span style="color:red">*</span></label>
												<div class="col-sm-4">
													<select class="selectpicker" name="brandname" required>
														<option value=""> Select </option>
														<?php $ret = "select id,BrandName from tblbrands";
														$query = $dbh->prepare($ret);
														$query->execute();
														$results = $query->fetchAll(PDO::FETCH_OBJ);
														if ($query->rowCount() > 0) {
															foreach ($results as $result) {
														?>
															<option value="<?php echo htmlentities($result->id); ?>"><?php echo htmlentities($result->BrandName); ?></option>
														<?php }
														} ?>

													</select>
												</div>
											</div>

											<div class="hr-dashed"></div>
											<div class="form-group">
												<label class="col-sm-2 control-label">Laptop Overview<span style="color:red">*</span></label>
												<div class="col-sm-10">
													<textarea class="form-control" name="laptoporcview" rows="3" required></textarea>
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-2 control-label">Price/Day(in KSH)<span style="color:red">*</span></label>
												<div class="col-sm-4">
													<input type="text" name="priceperday" class="form-control" required>
												</div>
												<label class="col-sm-2 control-label">Processor<span style="color:red">*</span></label>
												<div class="col-sm-4">
													<input type="text" name="processor" class="form-control" required>
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-2 control-label">Storage<span style="color:red">*</span></label>
												<div class="col-sm-4">
													<input type="text" name="storage" class="form-control" required>
												</div>
												<label class="col-sm-2 control-label">RAM<span style="color:red">*</span></label>
												<div class="col-sm-4">
													<input type="text" name="ram" class="form-control" required>
												</div>
											</div>
											<div class="hr-dashed"></div>


											<div class="form-group">
												<div class="col-sm-12">
													<h4><b>Upload Images</b></h4>
												</div>
											</div>


											<div class="form-group">
												<div class="col-sm-4">
													Image 1 <span style="color:red">*</span><input type="file" name="img1" required>
												</div>
												<div class="col-sm-4">
													Image 2<span style="color:red">*</span><input type="file" name="img2" required>
												</div>
												<div class="col-sm-4">
													Image 3<span style="color:red">*</span><input type="file" name="img3" required>
												</div>
											</div>


											<div class="form-group">
												<div class="col-sm-4">
													Image 4<span style="color:red">*</span><input type="file" name="img4" required>
												</div>
											</div>
											<div class="hr-dashed"></div>
									        </div>
								            </div>
							                </div>
						                    </div>

						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Accessories</div>
									<div class="panel-body">

										<div class="form-group">
											<div class="col-sm-3">
												<div class="checkbox checkbox-inline">
													<input type="checkbox" id="charger" name="charger" value="1">
													<label for="charger"> Charger </label>
												</div>
											</div>
											<div class="col-sm-3">
												<div class="checkbox checkbox-inline">
													<input type="checkbox" id="bag" name="bag" value="1">
													<label for="bag"> Bag </label>
												</div>
											</div>
											<div class="col-sm-3">
												<div class="checkbox checkbox-inline">
													<input type="checkbox" id="mouse" name="mouse" value="1">
													<label for="mouse"> Mouse </label>
												</div>
											</div>
										</div><br><br>

										<div class="form-group">
											<div class="col-sm-8 col-sm-offset-2" style="margin-left: 41.66666667%;width: 41.66666667%;">
												<button class="btn btn-default" type="reset">Cancel</button>
												<button class="btn btn-primary" name="submit" type="submit">Save Info</button>
											</div>
										</div>

										</form>

										<!--/User input form-->

									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<!--Footer -->
	<?php include('includes/footer.php'); ?>
	<!-- /Footer-->

	<!--Back to top-->
	<div id="back-top" class="back-top"> <a href="#top"><i class="fa fa-angle-up" aria-hidden="true"></i> </a> </div>
	<!--/Back to top-->

	<!--Login-Form -->
	<?php include('includes/login.php'); ?>
	<!--/Login-Form -->

	<!--Register-Form -->
	<?php include('includes/registration.php'); ?>

	<!--/Register-Form -->

	<!--Forgot-password-Form -->
	<?php include('includes/forgotpassword.php'); ?>
	<!--/Forgot-password-Form -->

	<!-- Scripts -->
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/interface.js"></script>
	<script src="assets/switcher/js/switcher.js"></script>
	<script src="assets/js/bootstrap-slider.min.js"></script>
	<script src="assets/js/slick.min.js"></script>
	<script src="assets/js/owl.carousel.min.js"></script>
	<script src="./admin/js/bootstrap-select.min.js"></script>
	<script src="./admin/js/jquery.dataTables.min.js"></script>
	<script src="./admin/js/Chart.min.js"></script>
	<script src="./admin/js/fileinput.js"></script>
	<script src="./admin/js/chartData.js"></script>
	<script src="./admin/js/main.js"></script>

</body>

<!-- Mirrored from themes.webmasterdriver.net/carforyou/demo/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 16 Jun 2017 07:22:11 GMT -->

</html>
<?php } ?>