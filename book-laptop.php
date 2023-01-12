<?php
include('includes/session.php');
include('includes/config.php');
error_reporting(0);
if (isset($_POST['submit'])) {
  $fromdate = $_POST['fromdate'];
  $todate = $_POST['todate'];
  $paymode = $_POST['paymentmode'];
  $totalprice = $_POST['totalprice'];
  $useremail = $_SESSION['login'];
  $status = 0;
  $returnstatus = 1;

  $vhid = $_GET['vhid'];

  $sql = "INSERT INTO  tblbooking(userEmail,LaptopId,FromDate,ToDate,PaymentMode,TotalPrice,
          PayStatus,Status,ReturnStatus) 
          VALUES (:useremail,:vhid,:fromdate,:todate,:paymentmode,:totalprice,
          :paystatus,:status,:returnstatus)";
  $query = $dbh->prepare($sql);
  $query->bindParam(':useremail', $useremail, PDO::PARAM_STR);
  $query->bindParam(':vhid', $vhid, PDO::PARAM_STR);
  $query->bindParam(':fromdate', $fromdate, PDO::PARAM_STR);
  $query->bindParam(':todate', $todate, PDO::PARAM_STR);
  $query->bindParam(':paymentmode', $paymode, PDO::PARAM_STR);
  $query->bindParam(':totalprice', $totalprice, PDO::PARAM_STR);
  $query->bindParam(':paystatus', $status, PDO::PARAM_STR);
  $query->bindParam(':status', $status, PDO::PARAM_STR);
  $query->bindParam(':returnstatus', $returnstatus, PDO::PARAM_STR);
  $query->execute();
  $lastInsertId = $dbh->lastInsertId();
  if ($lastInsertId) {
    echo "<script>alert('Booking successfull.');</script>";
    header('location:bookingsummary.php');
  } else {
    echo "<script>alert('Something went wrong. Please try again');</script>";
  }
}

?>

<script> 
  function getprice(){

    var fromdate = new Date(document.getElementById('fromdate').value);

    var todate = new Date(document.getElementById('todate').value);

    var priceperday = document.getElementById('priceperday').value;

    var time_difference = todate.getTime() - fromdate.getTime();

    var days_difference = time_difference / (1000*3600*24);

    var totalprice = priceperday*days_difference;

    document.getElementById('totalprice').value = totalprice;

  } 
</script>
    

<!DOCTYPE html>
<html lang="en">

<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width,initial-scale=1">
   <meta name="keywords" content="">
   <meta name="description" content="">
   <title>Laptop Rental Portal | Laptop Details</title>
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

    <!--Listing-Image-Slider-->
    <?php
    $vhid = intval($_GET['vhid']);
    $sql = "SELECT tbllaptops.*,tblbrands.BrandName,tblbrands.id as bid  from tbllaptops join tblbrands on tblbrands.id=tbllaptops.LaptopBrand where tbllaptops.id=:vhid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':vhid', $vhid, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    $cnt = 1;

    if ($query->rowCount() > 0) {foreach ($results as $result) { ?>
    <!--Listing-detail-->
    <section class="listing-detail">
        <div class="container">

           <div class="listing_detail_head row">
               <div class="col-md-9">
                    <h2><?php echo htmlentities($result->BrandName); ?> , <?php echo htmlentities($result->LaptopTitle); ?></h2>
               </div>
               <div class="col-md-3">
                    <div class="price_info">
                        <p>Ksh.<?php echo htmlentities($result->PricePerDay); ?> </p>Per Day
                    </div>
               </div>
           </div>

          <div class="row">
            <div class="col-md-9"style="margin-left: 380px;width:100%">
              <div class="main_features">
                <ul>
                    <li> <i class="fa fa-hdd-o" aria-hidden="true"></i>
                        <h5><?php echo htmlentities($result->Storage); ?></h5>
                        <p>Storage</p>
                    </li>
                    <li> <i class="bi bi-cpu" aria-hidden="true"></i>
                        <h5><?php echo htmlentities($result->Processor); ?></h5>
                        <p>Processor</p>
                    </li>
                    <li> <i class="bi bi-memory" aria-hidden="true"></i>
                        <h5><?php echo htmlentities($result->RAM); ?></h5>
                        <p>RAM</p>
                    </li>
                </ul>
              </div>
          
            </div>
            
          </div>
          
    <!--Listing-detail-->
    </section>

    <section>
        <div class="container">
            <div class="row">
            <div class="col-md-9"style="width:100%">

                <div class="sidebar_widget">
                   <div class="widget_heading"style="width: 90%;margin: auto">
                        <h5><i class="fa fa-envelope" aria-hidden="true"></i>Book Now</h5>
                   </div>
                   <div class="book"style="margin: auto;width: 90%">

                   <form method="post" name="book">
                        <div class="form-group">
                            <label for="">From Date:</label>
                            <input type="date" class="form-control" name="fromdate" placeholder="From Date" id="fromdate" min=<?php echo date('Y-m-d');?> required>
                        </div>

                        <div class="form-group">
                            <label for="">To Date:</label>
                            <input type="date" class="form-control" name="todate" placeholder="To Date" id="todate" min=<?php echo date('Y-m-d', strtotime("+ 1 day"));?> onchange="getprice()" required>
                        </div>



                        <div class="form-group">
                            <input type="hidden" class="form-control" name="priceperday" value="<?php echo htmlentities($result->PricePerDay)?>" id="priceperday" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="">Total Price</label>
                            <input type="text" class="form-control" name="totalprice" placeholder="" id = "totalprice" readonly="readonly" required>
                        </div>

                        <div class="form-group">
                            <label for="">Payment Method:</label>
                            <select class="form-control" aria-label="Default select example" name="paymentmode">
                                <option selected>Payment Mode</option>
                                <option value="Mpesa on Delivery">Mpesa on Delivery</option>
                                <option value="Cash on Delivery">Cash on Delivery</option>
                            </select>
                        </div>

                        <?php if ($_SESSION['login']) { ?>

                        <div class="form-group"style="text-align:center">
                            <button class="btn" type="reset">Cancel</button>
                            <input type="submit" class="btn" name="submit" value="Book Now">
                        </div>

                        <?php } else { ?>
                        <a href="#loginform" class="btn btn-xs uppercase" data-toggle="modal" data-dismiss="modal">Login To Book</a>
                        <?php } ?>

                    </form>

                    </div>
                </div>
            </div>
            </div>
        </div>
    </section>    

    <?php }
      } ?>


    <div class="space-20"></div>
    
 
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

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/interface.js"></script>
    <script src="assets/switcher/js/switcher.js"></script>
    <script src="assets/js/bootstrap-slider.min.js"></script>
    <script src="assets/js/slick.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>

</body>

</html>