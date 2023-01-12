<?php
include('includes/session.php');
include('includes/config.php');
error_reporting(0);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta name="keywords" content="">
  <meta name="description" content="">
  <title>Laptop Rental Portal | Booking Summary</title>
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
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/images/favicon-icon/apple-touch-icon-144-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/images/favicon-icon/apple-touch-icon-114-precomposed.html">
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/images/favicon-icon/apple-touch-icon-72-precomposed.png">
  <link rel="apple-touch-icon-precomposed" href="assets/images/favicon-icon/apple-touch-icon-57-precomposed.png">
  <link rel="shortcut icon" href="assets/images/favicon-icon/favicon.png">
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
</head>

<body>
  <!-- Start Switcher -->
  <?php include('includes/colorswitcher.php'); ?>
  <!-- /Switcher -->
  <!--Header-->
  <?php include('includes/header.php'); ?>
  <!-- /Header -->

  <div class="container bg-light" style="margin-top:36px; margin-bottom:36px">
    <div align="center" class="mt-5">
      <h1 class="fa fa-check-circle" style="font-size: 150px; color: green;"></h1>
      <h5>Your Booking request was placed succesfuly. Please await confirmation from the laptop owner.</h5><br>
      <div class="row justify-content-center">
        <div class="col-md-12">
          <button type="button" data-toggle="modal" data-target="#exampleModal" class="btn"><i class="fa fa-info-circle"></i>See Booking Details</button>&nbsp;&nbsp;
          <a href="index.php" class="btn"><i class="fa fa-arrow-circle-left"></i>Go Back</a>
        </div>
      </div>

      <br>
      <h6>If you wish to cancel your booking, You can <a href="#cancelmodal" data-toggle="modal" data-target="#cancelmodal" style="color: red;">cancel here</a></h6>
    </div>

    <!--Booking Detail Model-->

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog model-xl" role="dialog">
        <div class="modal-content">

          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Your current booking details</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div class="modal-body">
            <table class="table table-responsive-md table-striped">
              <thead>
                <tr>
                  <th>Laptop Image</th>
                  <th>Laptop Title</th>
                  <th>From Date</th>
                  <th>To Date</th>
                  <th>Total Price</th>
                  <th>Payment Mode</th>
                </tr>
              <tbody>
                <?php
                $useremail = $_SESSION['login'];
                $sql = "SELECT tblbrands.BrandName,tbllaptops.LaptopTitle,tbllaptops.Vimage1,
                          tblbooking.FromDate,tblbooking.ToDate,tblbooking.TotalPrice,tblbooking.PaymentMode,
                          tblbooking.LaptopId,tblbooking.id  from tblbooking
                          join tbllaptops on tbllaptops.id=tblbooking.LaptopId 
                          join tblusers on tblusers.EmailId=tblbooking.userEmail 
                          join tblbrands on tbllaptops.LaptopBrand=tblbrands.id where tblbooking.userEmail = ? ORDER BY id DESC LIMIT 0,1";
                $query = $dbh->prepare($sql);
                $query->execute([$useremail]);
                $results = $query->fetchAll(PDO::FETCH_OBJ);
                $cnt = 1;
                if ($query->rowCount() > 0) {
                  foreach ($results as $result) { ?>
                    <td><img src="admin/img/laptopimages/<?php echo htmlentities($result->Vimage1); ?>" alt="image"></td>
                    <td><?php echo htmlentities($result->BrandName); ?> , <?php echo htmlentities($result->LaptopTitle); ?></td>
                    <td><?php echo htmlentities($result->FromDate); ?></td>
                    <td><?php echo htmlentities($result->ToDate); ?></td>
                    <td><?php echo htmlentities($result->TotalPrice); ?></td>
                    <td><?php echo htmlentities($result->PaymentMode); ?></td>
                <?php }
                }
                ?>
              </tbody>
              </thead>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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

  <!--Loading scripts-->
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <script src="assets/js/interface.js"></script>
  <script src="assets/switcher/js/switcher.js"></script>
  <script src="assets/js/bootstrap-slider.min.js"></script>
  <script src="assets/js/slick.min.js"></script>
  <script src="assets/js/owl.carousel.min.js"></script>

</body>

</html>