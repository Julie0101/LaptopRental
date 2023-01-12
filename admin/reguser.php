<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
	header('location:index.php');
} else {

	# Insert new user information into database tblusers form form input. 

	if (isset($_POST['submit'])) {
        $idnumber = $_POST['idnumber'];
        $admno = $_POST['admno'];
        $fname = $_POST['fullname'];
        $email = $_POST['emailid'];
        $password = ($_POST['password']);
        $mobile = $_POST['mobileno'];

        $sql = "INSERT INTO tblusers(IdNumber,AdmNo,FullName,EmailId,ContactNo,Password) 
		        VALUES(:idnumber,:admno,:fullname,:emailid,:mobileno,:password)";
		$query = $dbh->prepare($sql);
		$query->bindParam(':idnumber', $idnumber, PDO::PARAM_STR);
		$query->bindParam(':admno', $admno, PDO::PARAM_STR);
		$query->bindParam(':fullname', $fname, PDO::PARAM_STR);
		$query->bindParam(':emailid', $email, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
		$query->bindParam(':mobileno', $mobile, PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
		if ($lastInsertId) {
			$msg = "User Registered successfully";
		} else {
			$error = "Something went wrong. Please try again";
		}
	}

?>

<script>

  // Script checks whether the email supplied by the user already exists in the database. 

  function checkAvailability() {
    $("#loaderIcon").show();
    jQuery.ajax({
      url: "check_availability.php",
      data: 'emailid=' + $("#emailid").val(),
      type: "POST",
      success: function(data) {
        $("#user-availability-status").html(data);
        $("#loaderIcon").hide();
      },
      error: function() {}
    });
  }
</script>

	<!DOCTYPE html>
	<html lang="en" class="no-js">

	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
		<meta name="description" content="">
		<meta name="author" content="Geofrey Obara">
		<meta name="theme-color" content="#3e454c">

		<title>Laptop Rental Portal | Admin Edit User Info</title>

		<!-- Font awesome -->
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<!-- Sandstone Bootstrap CSS -->
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<!-- Bootstrap Datatables -->
		<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
		<!-- Bootstrap social button library -->
		<link rel="stylesheet" href="css/bootstrap-social.css">
		<!-- Bootstrap select -->
		<link rel="stylesheet" href="css/bootstrap-select.css">
		<!-- Bootstrap file input -->
		<link rel="stylesheet" href="css/fileinput.min.css">
		<!-- Awesome Bootstrap checkbox -->
		<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
		<!-- Admin Stye -->
		<link rel="stylesheet" href="css/style.css">
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
		<?php include('includes/header.php'); ?>
		<div class="ts-main-content">
			<?php include('includes/leftbar.php'); ?>
			<div class="content-wrapper">
				<div class="container-fluid">

					<div class="row">
						<div class="col-md-12">

							<h2 class="page-title">Register User</h2>

							<div class="row">
								<div class="col-md-12">
									<div class="panel panel-default">
										<div class="panel-heading">Basic Info</div>
										<div class="panel-body">
											<?php if ($msg) { ?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>

									        <!-- Form input -->

											<form method="post" class="form-horizontal" enctype="multipart/form-data">

                                                <div class="form-group">
													<label class="col-sm-2 control-label">National ID Number<span style="color:red">*</span></label>
													<div class="col-sm-4">
														<input type="text" name="idnumber" class="form-control" maxlength="8" required>
													</div>
													<label class="col-sm-2 control-label">Admission Number<span style="color:red">*</span></label>
													<div class="col-sm-4">
														<input type="text" name="admno" class="form-control" required>
													</div>
												</div> 

                                                <div class="hr-dashed"></div>

                                                <div class="form-group">
													<label class="col-sm-2 control-label">Full Name<span style="color:red">*</span></label>
													<div class="col-sm-4">
														<input type="text" name="fullname" class="form-control" required>
													</div>
													<label class="col-sm-2 control-label">Contact Number<span style="color:red">*</span></label>
													<div class="col-sm-4">
														<input type="text" name="mobileno" class="form-control" maxlength="10" required>
													</div>
												</div> 

                                                <div class="hr-dashed"></div>

                                                <div class="form-group">
													<label class="col-sm-2 control-label">Email Address<span style="color:red">*</span></label>
													<div class="col-sm-4">
														<input type="text" name="emailid" class="form-control" required>
													</div>
												</div> 

                                                <div class="hr-dashed"></div>

                                                <div class="form-group">
													<label class="col-sm-2 control-label">Password<span style="color:red">*</span></label>
													<div class="col-sm-4">
														<input type="password" name="password" class="form-control" required>
													</div>
													<label class="col-sm-2 control-label">Confirm Paasword<span style="color:red">*</span></label>
													<div class="col-sm-4">
														<input type="password" name="confirmpassword" class="form-control" required>
													</div>
												</div> 

                                                <div class="form-group">
												    <div class="col-sm-8 col-sm-offset-2" style="text-align: center">
													    <button class="btn btn-primary" name="submit" type="submit" style="margin-top:4%">Save Details</button>
												    </div>
											    </div>
                                            </form>      

                                            <!--</form>-->
											
										</div>
									</div>
								</div>
							</div>
			
							</div>
						</div>

					</div>
				</div>
			</div>

			<!-- Loading Scripts -->
			<script src="js/jquery.min.js"></script>
			<script src="js/bootstrap-select.min.js"></script>
			<script src="js/bootstrap.min.js"></script>
			<script src="js/jquery.dataTables.min.js"></script>
			<script src="js/dataTables.bootstrap.min.js"></script>
			<script src="js/Chart.min.js"></script>
			<script src="js/fileinput.js"></script>
			<script src="js/chartData.js"></script>
			<script src="js/main.js"></script>
	</body>

	</html>
<?php } ?>