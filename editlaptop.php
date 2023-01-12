<?php
include('includes/session.php');
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['login']) == 0) {
    header('location:index.php');
} else {

	if (isset($_POST['submit'])) {
		$serialnumber = $_POST['serialnumber'];
		$emailid = $_POST['emailid'];
		$laptoptitle = $_POST['laptoptitle'];
		$brand = $_POST['brandname'];
		$laptopoverview = $_POST['laptopoverview'];
		$priceperday = $_POST['priceperday'];
		$processor = $_POST['processor'];
		$storage = $_POST['storage'];
		$ram = $_POST['ram'];
		$charger = $_POST['charger'];
		$bag = $_POST['bag'];
		$mouse = $_POST['mouse'];
		$id = intval($_GET['id']);

		$sql = "update tbllaptops 
		set SerialNumber=:serialnumber,OwnerEmail=:emailid,LaptopTitle=:laptoptitle,
		LaptopBrand=:brandname,LaptopOverview=:laptopoverview,PricePerDay=:priceperday,
		Processor=:processor,Storage=:storage,RAM=:ram,
		Charger=:charger,Bag=:bag,Mouse=:mouse 
		where id=:id ";

		$query = $dbh->prepare($sql);
		$query->bindParam(':serialnumber', $serialnumber, PDO::PARAM_STR);
		$query->bindParam(':emailid', $emailid, PDO::PARAM_STR);
		$query->bindParam(':laptoptitle', $laptoptitle, PDO::PARAM_STR);
		$query->bindParam(':brandname', $brand, PDO::PARAM_STR);
		$query->bindParam(':laptopoverview', $laptopoverview, PDO::PARAM_STR);
		$query->bindParam(':priceperday', $priceperday, PDO::PARAM_STR);
		$query->bindParam(':processor', $processor, PDO::PARAM_STR);
		$query->bindParam(':storage', $storage, PDO::PARAM_STR);
		$query->bindParam(':ram', $ram, PDO::PARAM_STR);
		$query->bindParam(':charger', $charger, PDO::PARAM_STR);
		$query->bindParam(':bag', $bag, PDO::PARAM_STR);
		$query->bindParam(':mouse', $mouse, PDO::PARAM_STR);
		$query->bindParam(':id', $id, PDO::PARAM_STR);
		$query->execute();

		$msg = "Data updated successfully";
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
        <title>Laptop Rental Portal | Edit Laptp Details</title>
        <!--Bootstrap -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="assets/css/style.css" type="text/css">
        <link rel="stylesheet" href="assets/css/owl.carousel.css" type="text/css">
        <link rel="stylesheet" href="assets/css/owl.transitions.css" type="text/css">
        <link href="assets/css/slick.css" rel="stylesheet">
        <link href="assets/css/bootstrap-slider.min.css" rel="stylesheet">
        <link href="assets/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
        <link rel="stylesheet" id="switcher-css" type="text/css" href="assets/switcher/css/switcher.css" media="all" />
      <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/red.css" title="red" media="all"
        <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/orange.css" title="orange" media="all" />
        <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/blue.css" title="blue" media="all" data-default-color="true" /> />
        <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/pink.css" title="pink" media="all" />
        <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/green.css" title="green" media="all" />
        <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/purple.css" title="purple" media="all" />
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/images/favicon-icon/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/images/favicon-icon/apple-touch-icon-114-precomposed.html">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/images/favicon-icon/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="assets/images/favicon-icon/apple-touch-icon-57-precomposed.png">
        <link rel="shortcut icon" href="assets/images/favicon-icon/favicon.png">
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">

        <link rel="stylesheet" href="admin/css/awesome-bootstrap-checkbox.css">
        <link rel="stylesheet" href="admin/css/fileinput.min.css">
        <link rel="stylesheet" href="admin/css/bootstrap-select.css">
        <link rel="stylesheet" href="admin/css/font-awesome.min.css">

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
            //this block of code grabs the email address of the user current logged in. 
            $email = $_SESSION['login'];
            $sql1 = "SELECT EmailId FROM tblusers WHERE EmailId=:email ";
            $query1 = $dbh->prepare($sql1);
            $query1->bindParam(':email', $email, PDO::PARAM_STR);
            $query1->execute();
            $resultss = $query1->fetchAll(PDO::FETCH_OBJ);
            if ($query1->rowCount() > 0) {
                foreach ($resultss as $results) {
                    // echo htmlentities($results->EmailId);
                }
            }
            ?>
        </section>



        <div class="container-fluid" style="width:80%; margin:auto;padding-top:25px">
					<div class="row">
						<div class="col-md-12">

							<h2 class="page-title" style = "text-align:center">Edit Laptop Details</h2>

							<div class="row">
								<div class="col-md-12">
									<div class="panel panel-default">
										<div class="panel-heading">Basic Info</div>
										<div class="panel-body">
											<?php if ($msg) { ?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>
											<?php
											$id = intval($_GET['id']);
											$sql = "SELECT tbllaptops.*,tblbrands.BrandName,tblbrands.id as bid from tbllaptops join tblbrands on tblbrands.id=tbllaptops.LaptopBrand where tbllaptops.id=:id";
											$query = $dbh->prepare($sql);
											$query->bindParam(':id', $id, PDO::PARAM_STR);
											$query->execute();
											$results = $query->fetchAll(PDO::FETCH_OBJ);
											$cnt = 1;
											if ($query->rowCount() > 0) {
												foreach ($results as $result) {	?>

													<form method="post" class="form-horizontal" enctype="multipart/form-data">
														<div class="form-group">
															<label class="col-sm-2 control-label">Serial Number<span style="color:red">*</span></label>
															<div class="col-sm-4">
																<input type="text" name="serialnumber" class="form-control" value="<?php echo htmlentities($result->SerialNumber) ?>" required>
															</div>

															<label class="col-sm-2 control-label">Owner Email<span style="color:red">*</span></label>
															<div class="col-sm-4">
																<input type="email" name="emailid" class="form-control" value="<?php echo htmlentities($result->OwnerEmail) ?>" onBlur="checkAvailability()" required>
																<span id="user-availability-status" style="font-size:12px;"></span>
															</div>
														</div>
														<div class="hr-dashed"></div>
														<div class="form-group">
															<label class="col-sm-2 control-label">Laptop Title<span style="color:red">*</span></label>
															<div class="col-sm-4">
																<input type="text" name="laptoptitle" class="form-control" value="<?php echo htmlentities($result->LaptopTitle) ?>" required>
															</div>
															<label class="col-sm-2 control-label">Select Brand<span style="color:red">*</span></label>
															<div class="col-sm-4">
																<select class="selectpicker" name="brandname" required>
																	<option value="<?php echo htmlentities($result->bid); ?>"><?php echo htmlentities($bdname = $result->BrandName); ?> </option>
																	<?php $ret = "select id,BrandName from tblbrands";
																	$query = $dbh->prepare($ret);
																	//$query->bindParam(':id',$id, PDO::PARAM_STR);
																	$query->execute();
																	$resultss = $query->fetchAll(PDO::FETCH_OBJ);
																	if ($query->rowCount() > 0) {
																		foreach ($resultss as $results) {
																			if ($results->BrandName == $bdname) {
																				continue;
																			} else { ?>
																				<option value="<?php echo htmlentities($results->id); ?>"><?php echo htmlentities($results->BrandName); ?></option>
																	<?php  }
																		}
																	} ?>

																</select>
															</div>
														</div>

														<div class="hr-dashed"></div>
														<div class="form-group">
															<label class="col-sm-2 control-label">Laptop Overview<span style="color:red">*</span></label>
															<div class="col-sm-10">
																<textarea class="form-control" name="laptopoverview" rows="3" required><?php echo htmlentities($result->LaptopOverview); ?></textarea>
															</div>
														</div>

														<div class="form-group">
															<label class="col-sm-2 control-label">Price/Day(in KSH)<span style="color:red">*</span></label>
															<div class="col-sm-4">
																<input type="text" name="priceperday" class="form-control" value="<?php echo htmlentities($result->PricePerDay); ?>" required>
															</div>
															<label class="col-sm-2 control-label">Processor<span style="color:red">*</span></label>
															<div class="col-sm-4">
																<input type="text" name="processor" class="form-control" value="<?php echo htmlentities($result->Processor); ?>" required>
															</div>
														</div>


														<div class="form-group">
															<label class="col-sm-2 control-label">Storage<span style="color:red">*</span></label>
															<div class="col-sm-4">
																<input type="text" name="storage" class="form-control" value="<?php echo htmlentities($result->Storage); ?>" required>
															</div>
															<label class="col-sm-2 control-label">RAM<span style="color:red">*</span></label>
															<div class="col-sm-4">
																<input type="text" name="ram" class="form-control" value="<?php echo htmlentities($result->RAM); ?>" required>
															</div>
														</div>

														<div class="hr-dashed"></div>
														<div class="form-group">
															<div class="col-sm-12">
																<h4><b>Laptop Images</b></h4>
															</div>
														</div>


														<div class="form-group">
															<div class="col-sm-4">
																Image 1 <img src="assets/images/laptopimages/<?php echo htmlentities($result->Vimage1); ?>" width="300" height="300" style="border:solid 1px #000">
																<a href="changeimage1.php?imgid=<?php echo htmlentities($result->id) ?>">Change Image 1</a>
															</div>
															<div class="col-sm-4">
																Image 2<img src="assets/images/laptopimages/<?php echo htmlentities($result->Vimage2); ?>" width="300" height="300" style="border:solid 1px #000">
																<a href="changeimage2.php?imgid=<?php echo htmlentities($result->id) ?>">Change Image 2</a>
															</div>
															<div class="col-sm-4">
																Image 3<img src="assets/images/laptopimages/<?php echo htmlentities($result->Vimage3); ?>" width="300" height="300" style="border:solid 1px #000">
																<a href="changeimage3.php?imgid=<?php echo htmlentities($result->id) ?>">Change Image 3</a>
															</div>
														</div>

														<div class="form-group">
															<div class="col-sm-4">
																Image 4<img src="assets/images/laptopimages/<?php echo htmlentities($result->Vimage4); ?>" width="300" height="300" style="border:solid 1px #000">
																<a href="changeimage4.php?imgid=<?php echo htmlentities($result->id) ?>">Change Image 4</a>
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
													<?php if ($result->Charger == 1) { ?>
														<div class="checkbox checkbox-inline">
															<input type="checkbox" id="inlineCheckbox1" name="charger" checked value="1">
															<label for="inlineCheckbox1"> Charger </label>
														</div>
													<?php } else { ?>
														<div class="checkbox checkbox-inline">
															<input type="checkbox" id="inlineCheckbox1" name="charger" value="1">
															<label for="inlineCheckbox1"> Charger </label>
														</div>
													<?php } ?>
												</div>

												<div class="col-sm-3">
													<?php if ($result->Bag == 1) { ?>
														<div class="checkbox checkbox-inline">
															<input type="checkbox" id="inlineCheckbox1" name="bag" checked value="1">
															<label for="inlineCheckbox2"> Bag </label>
														</div>
													<?php } else { ?>
														<div class="checkbox checkbox-success checkbox-inline">
															<input type="checkbox" id="inlineCheckbox1" name="bag" value="1">
															<label for="inlineCheckbox2"> Bag </label>
														</div>
													<?php } ?>
												</div>

												<div class="col-sm-3">
													<?php if ($result->Mouse == 1) { ?>
														<div class="checkbox checkbox-inline">
															<input type="checkbox" id="inlineCheckbox1" name="mouse" checked value="1">
															<label for="inlineCheckbox2"> Mouse </label>
														</div>
													<?php } else { ?>
														<div class="checkbox checkbox-success checkbox-inline">
															<input type="checkbox" id="inlineCheckbox1" name="mouse" value="1">
															<label for="inlineCheckbox2"> Mouse </label>
														</div>
													<?php } ?>
												</div>

												<div class="form-group">

											<?php
												}
											}
											?>

											<div class="form-group">
												<div class="col-sm-8 col-sm-offset-2">
													<button class="btn btn-primary" name="submit" type="submit" style="margin-top:4%">Save changes</button>
												</div>
											</div>
												</div>

												</form>
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
        <script src="admin/js/bootstrap-select.min.js"></script>
		<script src="admin/js/main.js"></script>

    </body>

    <!-- Mirrored from themes.webmasterdriver.net/carforyou/demo/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 16 Jun 2017 07:22:11 GMT -->

    </html>
<?php } ?>