<?php
include('includes/session.php');
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['login']) == 0) {
  header('location:index.php');
} else {

  # Code executes laptop deletion from the database. 
  if (isset($_REQUEST['del'])) {
		$delid = intval($_GET['del']);
		$sql = "delete from tbllaptops  WHERE  id=:delid";
		$query = $dbh->prepare($sql);
		$query->bindParam(':delid', $delid, PDO::PARAM_STR);
		$query->execute();
		$msg = "Laptop record deleted successfully";
	}

  # Code executes booking cancelation by updating Status in tblbooking to '2'
  if (isset($_REQUEST['eid'])) {
    $eid = intval($_GET['eid']);
    $status = "2";
    $sql = "UPDATE tblbooking SET Status=:status WHERE  id=:eid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':status', $status, PDO::PARAM_STR);
    $query->bindParam(':eid', $eid, PDO::PARAM_STR);
    $query->execute();
    $msg = "Booking Successfully Cancelled";
  }
  
  # Code executes booking confirmation by updating Status in tblbooking to '1'
  if (isset($_REQUEST['aeid'])) {
    $aeid = intval($_GET['aeid']);
    $status = 1;
    $sql = "UPDATE tblbooking SET Status=:status WHERE  id=:aeid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':status', $status, PDO::PARAM_STR);
    $query->bindParam(':aeid', $aeid, PDO::PARAM_STR);
    $query->execute();
    $msg = "Booking Successfully Confirmed";
  }

  # Code executes payment confirmation by updating PayStatus in tblbooking to '1', also updates ReturnStatus to '2'->In use
  if (isset($_REQUEST['pid'])) {
    $laptopid = intval($_GET['lid']);
    $pid = intval($_GET['pid']);
    $status = 1;
    $returnstatus = 2;
    $sql = "UPDATE tblbooking SET PayStatus=:status, ReturnStatus=:returnstatus 
            WHERE  id=:pid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':status', $status, PDO::PARAM_STR);
    $query->bindParam(':returnstatus', $returnstatus, PDO::PARAM_STR);
    $query->bindParam(':pid', $pid, PDO::PARAM_STR);
    $query->execute();
    $msg = "Payment Successfully Confirmed. Your laptop was also deactivated. People will no longer be able to book it.";
  }

  # Code executes laptop return confirmation by updating ReturnStatus in tblbooking to '4'
  if (isset($_REQUEST['rid'])) {
    $rid = intval($_GET['rid']);
    $status = 4;
    $sql = "UPDATE tblbooking SET ReturnStatus=:status WHERE  id=:rid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':status', $status, PDO::PARAM_STR);
    $query->bindParam(':rid', $rid, PDO::PARAM_STR);
    $query->execute();
    $msg = "Laptop Return Successfully Confirmed";
  }

  # Update laptop status from online to in use. 
  if (isset($_REQUEST['lid'])) {
    $lid = intval($_GET['lid']);
    $state = 3;
    $sql = "UPDATE tbllaptops SET Online=:state WHERE  id=:lid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':state', $state, PDO::PARAM_STR);
    $query->bindParam(':lid', $lid, PDO::PARAM_STR);
    $query->execute();
  }

  # Update laptop status from in use to online after laptop return is confirmed.
  if (isset($_REQUEST['ulid'])) {
    $lid = intval($_GET['ulid']);
    $state = 1;
    $sql = "UPDATE tbllaptops SET Online=:state WHERE  id=:ulid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':state', $state, PDO::PARAM_STR);
    $query->bindParam(':ulid', $lid, PDO::PARAM_STR);
    $query->execute();
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
    <title>Laptop Rental</title>
    <!--Bootstrap -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
    <!--Custome Style -->
    <link rel="stylesheet" href="assets/css/style.css" type="text/css">
    <!--OWL Carousel slider-->
    <link rel="stylesheet" href="assets/css/owl.carousel.css" type="text/css">
    <link rel="stylesheet" href="assets/css/owl.transitions.css" type="text/css">
    <!--slick-slider -->
    <link href="assets/css/slick.css" rel="stylesheet">
    <!--bootstrap-slider -->
    <link href="assets/css/bootstrap-slider.min.css" rel="stylesheet">
    <!--FontAwesome Font Style -->
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <!-- SWITCHER -->
    <link rel="stylesheet" id="switcher-css" type="text/css" href="assets/switcher/css/switcher.css" media="all" />
  <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/red.css" title="red" media="all"
    <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/orange.css" title="orange" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/blue.css" title="blue" media="all" data-default-color="true" /> />
    <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/pink.css" title="pink" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/green.css" title="green" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/purple.css" title="purple" media="all" />
    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/images/favicon-icon/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/images/favicon-icon/apple-touch-icon-114-precomposed.html">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/images/favicon-icon/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="assets/images/favicon-icon/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" href="assets/images/favicon-icon/favicon.png">
    <!-- Google-Font-->
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

    <!--Page Header-->
    <section class="page-header">
      <div class="container">
        <div class="page-header_wrap">
          <div class="page-heading">
            <h1>My Laptops</h1>
          </div>
          <ul class="coustom-breadcrumb">
            <li><a href="#">Home</a></li>
            <li>My Laptops</li>
          </ul>
        </div>
      </div>
      <!-- Dark Overlay-->
      <div class="dark-overlay"></div>
    </section>
    <!-- /Page Header-->

    <?php
    # 
    $useremail = $_SESSION['login'];
    $sql = "SELECT * from tblusers where EmailId=:useremail";
    $query = $dbh->prepare($sql);
    $query->bindParam(':useremail', $useremail, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    $cnt = 1;
    if ($query->rowCount() > 0) {
      foreach ($results as $result) { ?>
        <section class="user_profile inner_pages">
          <div class="container">
            <div class="user_profile_info gray-bg padding_4x4_40">
            <div class="upload_user_logo"><img src="assets/images/<?php echo htmlentities($result ->ProfilePhoto);?>"alt="image"></div>

            <div class="dealer_info">
              <h5><?php echo htmlentities($result->FullName); ?></h5>
              <p><?php echo htmlentities($result->AdmNo); ?><br>
              <p><?php echo htmlentities($result->Address); ?><br>
                <?php echo htmlentities($result->City); ?>&nbsp;<?php echo htmlentities($result->Country);
                
                }
                } ?></p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3 col-sm-3">
                <?php include('includes/sidebar.php'); ?>

                <div class="col-md-6 col-sm-8"style="width: 75%">
                  <div class="profile_wrap">
                    <h5 class="uppercase underline">My Laptops </h5>
                    <div class="my_laptops_list">
                      <ul class="laptop_listing">
                        <?php
                        $useremail = $_SESSION['login'];
                        $sql = "SELECT tbllaptops.*,tblbrands.BrandName from tbllaptops 
                                join tblbrands on tblbrands.id=tbllaptops.LaptopBrand 
                                where tbllaptops.OwnerEmail=?;";
                        $query = $dbh->prepare($sql);
                        $query->execute([$useremail]);
                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                        $cnt = 1;
                        if ($query->rowCount() > 0) {
                          foreach ($results as $result) {  ?>
                            <li>
                              <div class="laptop_img"> <a href="laptop-details.php?vhid=<?php echo htmlentities($result->vid); ?>"><img src="admin/img/laptopimages/<?php echo htmlentities($result->Vimage1); ?>" alt="image"></a> </div>
                              <div class="laptop_title">
                                <h6><?php echo htmlentities($result->BrandName); ?> , <?php echo htmlentities($result->LaptopTitle); ?></a></h6>
                                <p style>
                                  <b>Serial Number :</b> <?php echo htmlentities($result->SerialNumber); ?><br>
                                  <b>Laptop Status: </b> <?php if ($result->Online==1){echo htmlentities('Active');}else if($result ->Online == 2)echo htmlentities('Inactive');?>
                                </p>

                                <!--
                                  Laptop Status:
                                  1: Active -> deactivating changes status to value 2
                                  2: Inactuve -> activating changes status to value 1
                                  3: In use -> no action ubtill laptop is returned. 
                                -->
                                <div class="laptop_status"> 
                                  <?php if ($result->Online==1) { ?>

                                  <a href="deactivate.php?id=<?php echo htmlentities ($result->id); ?>"onclick="return confirm('Do you really want to deactivate this laptop?It will not be visible to users who want to book it.')" class="btn outline btn-xs inactive-btn"style="border-color:#fa2837">Deactivate</a>
                                  
                                  <?php } else if ($result->Online==2) { ?>

                                  <a href="activate.php?id=<?php echo htmlentities ($result->id);?>"onclick="return confirm('Do you really want to activate this laptop?Users will be able to book it.')" class="btn outline btn-xs active-btn"style="border-color:#2dcc70">Activate</a>
                                  <?php } else if ($result->Online==3) {?>
                                    <a class="btn outline btn-xs inactive-btn"style="border-color:#fa2837">Laptop is in use</a>
                                  <?php }
                                  ?>

                                 
                                </div>

                                <div class="clearfix"></div>
                                 
                                </div>

                                <div class="edit">
                                  <a href="editlaptop.php?id=<?php echo $result->id; ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                  <?php if ($result->Online==1) { ?>
                                  <a href="my-laptops.php?del=<?php echo $result->id; ?>" onclick="return confirm('Do you want to delete');"><i class="fa fa-trash"></i></a>
                                  <?php } else if ($result->Online==3) { ?>
                                    <a href="my-laptops.php?id=<?php echo $result->id; ?>" onclick="return confirm('Ooops! You cant delete this laptop while it is in use.');"><i class="fa fa-trash"></i></a>
                                  <?php }?>
                                </div>

                                <div class="clearfix"></div>
                            </li>
                        <?php }
                        } ?>


                      </ul>
                    </div>

                  </div>
                </div>
              </div>
            </div>
        </section>


        <div class="ts-main-content">
          <div class="content-wrapper">
            <div class="container-fluid">

              <div class="row">
                <div class="col-md-12">

                  <h2 class="page-title" style="text-align: center;">Manage Bookings</h2>

                  <!-- Zero Configuration Table -->
                  <div class="panel panel-default">
                    <div class="panel-heading">Bookings Info</div>
                    <div class="panel-body">
                      <?php if ($error) { ?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } else if ($msg) { ?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>
                      <table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
										<thead>
											<tr>
                      <th>#</th>
												<th>Borrower's Name</th>
                        <th>Borrower's Phone</th>
												<th>Laptop</th>
												<th>S/No</th>
												<th>From Date</th>
												<th>To Date</th>
												<th>Total Price</th>
												<th>Payment Mode</th>
												<th>Payment Status</th>
												<th>Booking Status</th>
                        <th>Return Status</th>
												<th>Date of Booking</th>
											</tr>
										</thead>
										<tfoot>
											<tr>
                      <th>#</th>
												<th>Borrower's Name</th>
                        <th>Borrower's Phone</th>
												<th>Laptop</th>
												<th>S/No</th>
												<th>From Date</th>
												<th>To Date</th>
												<th>Total Price</th>
												<th>Payment Mode</th>
												<th>Payment Status</th>
												<th>Booking Status</th>
                        <th>Return Status</th>
												<th>Date of Booking</th>
											</tr>
										</tfoot>
										<tbody>

											<?php 
                      $useremail = $_SESSION['login'];
                      $sql = "SELECT tblusers.FullName,tblusers.Id as uid,tblusers.ContactNo,tblbrands.BrandName,tbllaptops.id as lid, tbllaptops.SerialNumber,tbllaptops.LaptopTitle,
											        tblbooking.FromDate,tblbooking.ToDate,tblbooking.TotalPrice,tblbooking.PaymentMode,tblbooking.PayStatus,tblbooking.LaptopId as vid,
													    tblbooking.Status,tblbooking.PostingDate,tblbooking.ReturnStatus,tblbooking.id  from tblbooking
													    join tbllaptops on tbllaptops.id=tblbooking.LaptopId 
													    join tblusers on tblusers.EmailId=tblbooking.userEmail 
													    join tblbrands on tbllaptops.LaptopBrand=tblbrands.id where tbllaptops.OwnerEmail = ? ";
											$query = $dbh->prepare($sql);
											$query->execute([$useremail]);
											$results = $query->fetchAll(PDO::FETCH_OBJ);
											$cnt = 1;
											if ($query->rowCount() > 0) {
												foreach ($results as $result) {	?>
													<tr>
														<td><?php echo htmlentities($cnt); ?></td>
														<td><a href="borrowerprofile.php?id=<?php echo htmlentities($result->uid); ?>"><?php echo htmlentities($result->FullName); ?></td>
														<td><a href="tel:<?php echo htmlentities($result->ContactNo); ?>"><?php echo htmlentities($result->ContactNo); ?></a></td>
														<td><?php echo htmlentities($result->BrandName); ?> , <?php echo htmlentities($result->LaptopTitle); ?></td>
														<td><?php echo htmlentities($result->SerialNumber); ?></td>
														<td><?php echo htmlentities($result->FromDate); ?></td>
														<td><?php echo htmlentities($result->ToDate); ?></td>
                            <td><?php echo htmlentities($result->TotalPrice); ?></td>
														<td><?php echo htmlentities($result->PaymentMode); ?></td>
                            
                            <td><?php
                              # Pay status changes form 0 to 1 when payment confirmed. Also confirming payment changes online status to 3
															if ($result->PayStatus == 0) {?>
																<a href="my-laptops.php?pid=<?php echo htmlentities($result->id); ?>&lid=<?php echo htmlentities($result->lid);?>" onclick="return confirm('Do you really want to Confirm payment for this booking? This action will also deactivate your laptop.')"><?php echo htmlentities('Pending, click to confirm.')?></a>
															<?php } else if ($result->PayStatus == 1){
																echo htmlentities('Paid');
                              }
															?>
														</td>
                            

														<td><?php
                              #Booking Status is 0 by deafult, confirming/cancelling a booking changes status.
															if ($result->Status == 0) { ?>
                                <a href="my-laptops.php?aeid=<?php echo htmlentities($result->id); ?>" onclick="return confirm('Do you really want to Confirm this booking')"> Confirm</a> /
                                <a href="my-laptops.php?eid=<?php echo htmlentities($result->id); ?>" onclick="return confirm('Do you really want to Cancel this Booking')"> Cancel</a>
																
															<?php } else if ($result->Status == 1) {
																echo htmlentities('Confirmed');
															} else {
																echo htmlentities('Cancelled');
															}
															?>
                            </td>
    
                            <td><?php
                              #Return Status id 0 by default. Changes to 1 when a booking request is made, changes to 2 when laptop is borrowed
                              #then changes to 3 when a laptop return request is made. Then finally changes to 4 when the laptop return is confirmed.
															if ($result->ReturnStatus == 0) {
																echo htmlentities('Not borrowed yet');
                              }else if($result->ReturnStatus == 1){
                                echo htmlentities('Incomplete booking');
                              }else if($result->ReturnStatus == 2){
                                echo htmlentities('Laptop in Use.');
                              }else if ($result->ReturnStatus == 3) {?>

                                <a href="my-laptops.php?rid=<?php echo htmlentities($result->id);?>&ulid=<?php echo htmlentities($result->lid);?>" onclick="return confirm('Do you really want to Confirm return of this laptop? Your laptop will be visible for booking.')"><?php echo htmlentities('Pending, click to confirm return.')?></a>

															<?php } else {
																echo htmlentities('Returned');
															}
															?>
                            </td>

														<td><?php echo htmlentities($result->PostingDate); ?></td>

													</tr>
											<?php $cnt = $cnt + 1;
												}
											} ?>

										</tbody>
									</table> 
                  
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!--/my-laptops-->


        <?php include('includes/footer.php'); ?>

        <!-- Scripts -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/interface.js"></script>
        <!--Switcher-->
        <script src="assets/switcher/js/switcher.js"></script>
        <!--bootstrap-slider-JS-->
        <script src="assets/js/bootstrap-slider.min.js"></script>
        <!--Slider-JS-->
        <script src="assets/js/slick.min.js"></script>
        <script src="assets/js/owl.carousel.min.js"></script>
  </body>

  </html>
<?php } ?>