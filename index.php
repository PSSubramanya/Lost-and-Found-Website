<?php
require("conn.php");
session_start();
if (isset($_POST['register'])) {
	$fullname = $_POST['fullname'];
	$password = md5($_POST['password']);
	$mobile_number = $_POST['mobile_number'];
	$query = "INSERT INTO user (`full_name`,`mobile_number`,`password`) VALUES('$fullname','$mobile_number','$password')";
	$result = mysqli_query($conn, $query);
	if ($result) {
		echo '<script>alert("user registerd successfully");</script>';
	} else {
		echo '<script>alert("Error while registering");</script>';
	}
}

if (isset($_POST['Adminlogin'])) {
	$mobile = $_POST['mobile'];
	$password = ($_POST['passwd']);


	if ($mobile == "7204958072" and $password == "admin") {
		header("Location: admin/dashboard.php");
		$_SESSION['admin_id'] = $mobile;
	}
}

if (isset($_POST['login'])) {
	$mobile_number = $_POST['mobile_number'];
	$password = md5($_POST['password']);

	// echo "$mobile_number" . $password;

	$query = "SELECT * FROM user WHERE mobile_number = '$mobile_number' AND password = '$password' ";
	$result = mysqli_query($conn, $query);

	// var_dump($result);

	// $row = mysqli_fetch_array($result);
	if (mysqli_num_rows($result) == 1) {
		$_SESSION['mobile_number'] = $mobile_number;
		if ($row = mysqli_fetch_assoc($result)) {
			$_SESSION['user_id'] = $row['user_id'];
		}
		echo '<script>alert("Logged In");</script>';
		header("Location:trial.php");
	} else {
		echo '<script>alert("Invalid Credentials");</script>';
	}
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Equip - Free Bootstrap 4 Template by Colorlib</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="css/animate.css">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- Bootstrap core CSS -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<!-- Material Design Bootstrap -->
	<link href="css/mdb.min.css" rel="stylesheet">
	<!-- Your custom styles (optional) -->
	<!-- <link href="css/style.css" rel="stylesheet"> -->
	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="css/owl.theme.default.min.css">
	<link rel="stylesheet" href="css/magnific-popup.css">

	<link rel="stylesheet" href="css/aos.css">

	<!-- <link rel="stylesheet" href="css/ionicons.min.css"> -->

	<link rel="stylesheet" href="css/bootstrap-datetimepicker.min.css">
	<link rel="stylesheet" href="css/nouislider.css">


	<!-- <link rel="stylesheet" href="css/flaticon.css"> -->
	<link rel="stylesheet" href="css/icomoon.css">
	<link rel="stylesheet" href="css/style.css">
	<!-- Font Awesome -->
	<!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"> -->
	<!-- Bootstrap core CSS -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
	<!-- Material Design Bootstrap -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.10/css/mdb.min.css" rel="stylesheet">
	<style>
		body {
			background: url('images/bg_1.jpg')no-repeat !important;
			background-size: cover;

		}
	</style>
</head>

<body>

	<div class="main-section">

		<!-- <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar"> -->
		<!-- <div class="container"> -->
		<!-- <a class="navbar-brand" href="index.html">Equip.</a> -->
		<!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> Menu
	      </button> -->
		<div class="collapse navbar-collapse" id="ftco-nav">
			<ul class="navbar-nav ml-auto">
				<li class="dropdown nav-item">
					<a href="#" class="dropdown-toggle nav-link icon d-flex align-items-center" data-toggle="dropdown">
						<i class="ion-ios-apps mr-2"></i>
						Components
						<b class="caret"></b>
					</a>
					<div class="dropdown-menu dropdown-menu-left">
						<a href="#" class="dropdown-item"><i class="ion-ios-apps mr-2"></i> All Components</a>
						<a href="#" class="dropdown-item"><i class="ion-ios-document mr-2"></i> Documentation</a>
					</div>
				</li>
				<li class="nav-item cta"><a href="#" class="nav-link icon d-flex align-items-center"><i class="ion-ios-cloud-download mr-2"></i> Download</a></li>
			</ul>
		</div>
	</div>
	</nav>
	<!-- END nav -->

	<section class="hero-wrap">
		<!-- <div class="overlay"></div> -->

		<div class="container">
			<div class="row description align-items-center justify-content-center">
				<div class="col-md-8 text-center">
					<div class="text">
						<h1 style="color: white;margin-top:10%;font-weight:bold;">LOST AND FOUND</h1>
						<h4 class="mb-5">For Campus Purpose</h4>
						<!-- <p><a href="#" class="btn btn-primary px-5 py-4 mb-2"><i class="ion-ios-cloud-download mr-2"></i>LOST</a> <a href="#" class="btn btn-dark px-5 py-4 mb-2"><i class="ion-ios-code mr-2"></i>FOUND</a></p> -->
						<!-- <p><a data-toggle="modal" href="Lost.html" data-target="#modalLRForm" class="btn btn-secondary px-5 py-4 mb-2"><i class="fa fa-thumbs-o-down" -->

						<?php
						if (isset($_SESSION['mobile_number'])) {
							echo '<p><a  href=""  class="btn btn-secondary px-5 py-4 mb-2"><i class="fa fa-thumbs-o-down"
								aria-hidden="true"></i>LOST</a>';
						} else {
							echo '<p><a href="" class="btn btn-secondary px-5 py-4 mb-2" data-toggle="modal" data-target="#modalLRForm"><i class="fa fa-thumbs-o-down"
								aria-hidden="true"></i>LOST</a>';
						}
						?>
						<a href="Found.php" class="btn btn-dark px-5 py-4 mb-2"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> FOUND</a></p>

						<p><a class="btn btn-dark px-5 py-4 mb-2" data-toggle="modal" data-target="#modalLRFormAdmin"><i class="fa fa-user" aria-hidden="true"></i>Admin-login</a></p>
						<!-- 
									
									// echo isset($_SESSION['email']);
										// if(isset($_SESSION['mobile_number'])){
										// 	echo'<a href=" Found.php"
										// 	class="btn btn-dark px-5 py-4 mb-2"><i class="fa fa-thumbs-o-up"
										// 		aria-hidden="true"></i> FOUND</a></p>';
										// }else{
										// 	echo'<a href="Lost.php"
										// 	class="btn btn-dark px-5 py-4 mb-2"><i class="fa fa-thumbs-o-up"
										// 		aria-hidden="true"></i> LOST </a></p>';
										// }
									?> -->
						<!-- <div class="designed d-inline-block">
  							<d class="d-flex align-items-center">
	  							<div class="img" style="background-image: url(images/person.jpg);"></div>
	  							<div class="ml-3"><p class="mb-0">Designed by: <span>Colorlib.com</span></p></div>
  							</d>
						  </div> -->
					</div>
				</div>
			</div>
		</div>
		<!-- <div class="text">
				<h3 align="left">HOW THE PROJECT WORKS</h3>
		  </div> -->
		<!-- <div class="mouse">
				<a href="#" class="mouse-icon">
					<div class="mouse-wheel"><span class="ion-ios-arrow-round-down"></span></div>
				</a>
			</div> -->
	</section>


	<!--Modal: Login / Register Form-->
	<div class="modal fade" id="modalLRForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog cascading-modal" role="document">
			<!--Content-->
			<div class="modal-content">
				<!--Modal cascading tabs-->
				<div class="modal-c-tabs">

					<!-- Nav tabs -->
					<ul class="nav nav-tabs md-tabs tabs-2 light-blue darken-3" role="tablist">
						<li class="nav-item">
							<a class="nav-link active" data-toggle="tab" href="#panel7" role="tab"><i class="fa fa-user mr-1"></i>
								Login</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#panel8" role="tab"><i class="fa fa-user-plus mr-1"></i>
								Register</a>
						</li>
					</ul>

					<!-- Tab panels -->
					<div class="tab-content">
						<!--Panel 7-->
						<div class="tab-pane fade in show active" id="panel7" role="tabpanel">
							<!--Body-->
							<form action="index.php" method="post">
								<div class="modal-body mb-1">
									<div class="md-form form-sm mb-5">
										<i class="fa fa-envelope prefix"></i>
										<input type="text" id="modalLRInput10" class="form-control form-control-sm validate" name="mobile_number" style="color: black;">
										<label data-error="wrong" data-success="right" for="modalLRInput10">Your Mobile NUmber</label>
									</div>

									<div class="md-form form-sm mb-4">
										<i class="fa fa-lock prefix"></i>
										<input type="password" id="modalLRInput11" class="form-control form-control-sm validate" name="password" style="color: black;">
										<label data-error="wrong" data-success="right" for="modalLRInput11">Your password</label>
									</div>
									<div class="text-center mt-2">
										<button class="btn btn-warning" type="submit" name="login">Log in <i class="fa fa-sign-in ml-1"></i></button>
									</div>
								</div>
							</form>
						</div>
						<!--/.Panel 7-->

						<!--Panel 8-->
						<div class="tab-pane fade" id="panel8" role="tabpanel">
							<!--Body-->
							<form action="index.php" method="post">
								<div class="modal-body">
									<div class="md-form form-sm mb-5">
										<i class="fa fa-envelope prefix"></i>
										<input type="text" id="modalLRInput12" class="form-control form-control-sm validate" name="fullname">
										<label data-error="wrong" data-success="right" for="modalLRInput12">Full Name</label>
									</div>

									<div class="md-form form-sm mb-5">
										<i class="fa fa-lock prefix"></i>
										<input type="password" id="modalLRInput13" class="form-control form-control-sm validate" name="password">
										<label data-error="wrong" data-success="right" for="modalLRInput13">Your password</label>
									</div>

									<div class="md-form form-sm mb-4">
										<i class="fa fa-lock prefix"></i>
										<input type="text" id="modalLRInput14" class="form-control form-control-sm validate" name="mobile_number">
										<label data-error="wrong" data-success="right" for="modalLRInput14">Mobile Number</label>
									</div>

									<div class="text-center form-sm mt-2">
										<button class="btn btn-warning" type="submit" name="register">Sign up <i class="fa fa-sign-in ml-1"></i></button>
									</div>

								</div>
							</form>
							<!--/.Panel 8-->
						</div>

					</div>
				</div>
				<!--/.Content-->
			</div>
		</div>
	</div>


	<div class="modal fade" id="modalLRFormAdmin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog cascading-modal" role="document">
			<!--Content-->
			<div class="modal-content">
				<!--Modal cascading tabs-->
				<div class="modal-c-tabs">

					<!-- Nav tabs -->
					<ul class="nav nav-tabs md-tabs tabs-2 light-blue darken-3" role="tablist">
						<li class="nav-item">
							<a class="nav-link active" data-toggle="tab" href="#panel7" role="tab"><i class="fa fa-user mr-1"></i>
								Login</a>
						</li>
						<!-- <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#panel8" role="tab"><i class="fas fa-user-plus mr-1"></i>
                                Register</a>
                        </li> -->
					</ul>

					<!-- Tab panels -->
					<div class="tab-content">
						<!--Panel 7-->
						<div class="tab-pane fade in show active" id="panel7" role="tabpanel">
							<!--Body-->
							<form action="index.php" method="post">
								<div class="modal-body mb-1">
									<div class="md-form form-sm mb-5">
										<i class="fa fa-envelope prefix"></i>
										<input type="text" id="modalLRInput10" class="form-control form-control-sm validate" name="mobile">
										<label data-error="wrong" data-success="right" for="modalLRInput10">Your Mobile Number</label>
									</div>

									<div class="md-form form-sm mb-4">
										<i class="fa fa-lock prefix"></i>
										<input type="password" id="modalLRInput11" class="form-control form-control-sm validate" name="passwd">
										<label data-error="wrong" data-success="right" for="modalLRInput11">Your password</label>
									</div>
									<div class="text-center mt-2">
										<button class="btn btn-warning" type="submit" name="Adminlogin">Log in <i class="fa fa-sign-in ml-1"></i></button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--Modal: Login / Register Form-->


	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="js/jquery-migrate-3.0.1.min.js"></script>
	<script src="js/jquery.easing.1.3.js"></script>
	<script src="js/jquery.waypoints.min.js"></script>
	<script src="js/jquery.stellar.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/aos.js"></script>

	<script src="js/nouislider.min.js"></script>
	<script src="js/moment-with-locales.min.js"></script>
	<script src="js/bootstrap-datetimepicker.min.js"></script>
	<script src="js/main.js"></script>
	<!-- Bootstrap tooltips -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
	<!-- Bootstrap core JavaScript -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<!-- MDB core JavaScript -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.10/js/mdb.min.js"></script>
	<!-- Bootstrap tooltips -->

</body>

</html>