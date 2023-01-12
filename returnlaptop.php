<?php
include('includes/session.php');
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['login']) == 0) {
  header('location:index.php');
} else {
    
    if (isset($_REQUEST['vhid'])) {
        $vhid = intval($_GET['vhid']);
        $status = 3;
        $sql = "UPDATE tblbooking SET ReturnStatus=:status WHERE  LaptopId=:vhid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->bindParam(':vhid', $vhid, PDO::PARAM_STR);
        $query->execute();
        $msg = "Laptop return initiated. Please wait for owner confirmation.";
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
    <!--Page Header-->
    <!-- /Header -->

    <!--Page Header-->
    <section class="page-header">
      <div class="container">
        <div class="page-header_wrap">
          <div class="page-heading">
            <h1>My Booking</h1>
          </div>
          <ul class="coustom-breadcrumb">
            <li><a href="#">Home</a></li>
            <li>My Booking</li>
          </ul>
        </div>
      </div>
      <!-- Dark Overlay-->
      <div class="dark-overlay"></div>
    </section>
    <!-- /Page Header-->

    <?php
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
          <?php if ($error) { ?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } else if ($msg) { ?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>
            <div class="user_profile_info gray-bg padding_4x4_40">
              <div class="upload_user_logo"><img src="assets/images/<?php echo htmlentities($result ->ProfilePhoto);?>"alt="image">
            </div>

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

                <div class="col-md-6 col-sm-8" style="width: 75%">
                  <div class="profile_wrap">
                    <h5 class="uppercase underline"style="margin-left: 209px;">My Bookings </h5>
                    <div class="my_laptops_list">
                      <ul class="laptop_listing">
                        <?php
                        $useremail = $_SESSION['login'];

                        $sql = "SELECT tbllaptops.Vimage1 as Vimage1,tbllaptops.LaptopTitle,tbllaptops.SerialNumber,tbllaptops.OwnerEmail,tbllaptops.id as vid,
                                tblusers.FullName,tblusers.ContactNo, tblusers.EmailId, tblbrands.BrandName,
                                tblbooking.*  from tblbooking 
                                join tbllaptops on tblbooking.LaptopId=tbllaptops.id 
                                join tblbrands on tblbrands.id=tbllaptops.LaptopBrand 
                                join tblusers on tblusers.EmailId=tbllaptops.OwnerEmail 
                                where tblbooking.userEmail=:useremail";

                        $query = $dbh->prepare($sql);
                        $query->bindParam(':useremail', $useremail, PDO::PARAM_STR);
                        $query->execute();
                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                        $cnt = 1;
                        if ($query->rowCount() > 0) {
                          foreach ($results as $result) {  ?>

                            <li>
                              <div class="laptop_img"> <a href="laptop-details.php?vhid=<?php echo htmlentities($result->vid); ?>"><img src=" admin/img/laptopimages/<?php echo htmlentities($result->Vimage1); ?>" alt="image"></a> </div>
                              <div class="laptop_title">
                                <h6><a href="laptop-details.php?vhid=<?php echo htmlentities($result->vid); ?>"> <?php echo htmlentities($result->BrandName); ?> , <?php echo htmlentities($result->LaptopTitle); ?></a></h6>
                                <p>
                                  <b>Serial Number:</b> <?php echo htmlentities($result->SerialNumber); ?><br/>
                                  <b>Owner Name  :</b> <?php echo htmlentities($result->FullName); ?><br/>
                                  <b>Owner Phone  :</b> <?php echo htmlentities($result->ContactNo); ?><br/>
                                  <b>Owner Email  :</b> <?php echo htmlentities($result->OwnerEmail); ?><br/>
                                  <b>From Date    :</b> <?php echo htmlentities($result->FromDate); ?><br/>
                                  <b>To Date      :</b> <?php echo htmlentities($result->ToDate); ?><br/>
                                  <b>Total Payment:</b> <?php echo htmlentities($result->TotalPrice); ?></br>
                                  <b>Payment Status: </b> <?php if ($result->PayStatus==0){echo htmlentities('Pending');}else if($result ->PayStatus == 1)echo htmlentities('Paid');?></br>

                                  <?php if ($result->PayStatus == 1 && $result->Status==1){?>  
                                      <b>Laptop Return Status: </b> 
                                      <?php 
                                         if ($result->ReturnStatus==0){
                                          echo htmlentities('Not borrowed yet');
                                        }else if($result ->ReturnStatus == 1){
                                          echo htmlentities('Incomplete booking');
                                        }else if($result ->ReturnStatus == 2){
                                          echo htmlentities('In use');
                                        }else if($result ->ReturnStatus == 3){
                                          echo htmlentities('Pending');
                                        }else{
                                          echo htmlentities('Returned');
                                        }
                                      ?><br>
                                  <?php } ?>

                              </div>
                              <?php if ($result->Status == 1) { ?>
                                <div class=" laptop_status"> <a href="#" class="btn outline btn-xs active-btn">Owner Confirmed Booking</a>
                                    <div class="clearfix"></div>
                              </div>

                              <?php } else if ($result->Status == 2) { ?>
                              <div class="laptop_status"> <a href="#" class="btn outline btn-xs inactive-btn">Owner Cancelled Booking</a>
                                <div class="clearfix"></div>
                              </div>
                              <?php } else { ?>

                              <div class="laptop_status"> <a href="#" class="btn outline btn-xs">Not Confirm yet</a>
                                <div class="clearfix"></div>
                              </div>
                              <?php }
                              ?>
                              
                              <!--Implement a return laptop button that is only visible when payment status and booking status are confirmed.
                                  The button changes return status to returned. 
                              -->

                              <?php if ($result->PayStatus == 1 && $result->Status==1 && $result->ReturnStatus == 0){?>   
                              <div class="laptop_status"> <a href="retunlaptop.php?vhid=<?php echo htmlentities($result->vid) ?>" class="btn outline btn-xs active-btn">Return Laptop</a>
                                    <div class="clearfix"></div>
                                </div>
                              <?php } ?>
                              

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