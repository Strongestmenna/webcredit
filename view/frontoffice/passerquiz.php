<?php
session_start();
if (!isset($_SESSION['id'])) {
	header("Location:login.php");
} else if ($_SESSION['type'] != "etudiant") {
	header("Location:index.php");
}

if (isset($_GET['logout'])) {
	// Destroy the session
	session_destroy();
	// Redirect to the login page
	header("Location: index.php");
}

include('../../controller/quizC.php');
$quizC = new quizC();
$quiz = $quizC->readquestion($_GET['id']);
$quizz = $quizC->readquestion($_GET['id']);

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Responsive Bootstrap4 Shop Template, Created by Imran Hossain from https://imransdesign.com/">

	<!-- title -->
	<title>Shop</title>

	<!-- favicon -->
	<link rel="shortcut icon" type="image/png" href="assets/img/favicon.png">
	<!-- google font -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
	<!-- fontawesome -->
	<link rel="stylesheet" href="assets/css/all.min.css">
	<!-- bootstrap -->
	<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
	<!-- owl carousel -->
	<link rel="stylesheet" href="assets/css/owl.carousel.css">
	<!-- magnific popup -->
	<link rel="stylesheet" href="assets/css/magnific-popup.css">
	<!-- animate css -->
	<link rel="stylesheet" href="assets/css/animate.css">
	<!-- mean menu css -->
	<link rel="stylesheet" href="assets/css/meanmenu.min.css">
	<!-- main style -->
	<link rel="stylesheet" href="assets/css/main.css">
	<!-- responsive -->
	<link rel="stylesheet" href="assets/css/responsive.css">

</head>

<body>

	<!--PreLoader-->
	<div class="loader">
		<div class="loader-inner">
			<div class="circle"></div>
		</div>
	</div>
	<!--PreLoader Ends-->

	<!-- header -->
	<div class="top-header-area" id="sticker">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-sm-12 text-center">
					<div class="main-menu-wrap">
						<!-- logo -->
						<div class="site-logo">
							<a href=#>
								<img src="assets/img/logo.png" alt="">
							</a>
						</div>
						<!-- logo -->

						<!-- menu start -->
						<nav class="main-menu">
							<ul>
								<li><a href="cours.php">Cours</a></li>
								<li><a href="favories.php">Favories</a></li>
								<li><a href="quiz.php">Quiz</a></li>
								<li><a href="?logout">logout</a></li>
								<li>
									<div class="header-icons">
										<a class="shopping-cart" href=#><i class="fas fa-shopping-cart"></i></a>
										<a class="mobile-hide search-bar-icon" href="#"><i class="fas fa-search"></i></a>
									</div>
								</li>
							</ul>
						</nav>
						<a class="mobile-show search-bar-icon" href="#"><i class="fas fa-search"></i></a>
						<div class="mobile-menu"></div>
						<!-- menu end -->
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end header -->

	<!-- search area -->
	<div class="search-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<span class="close-btn"><i class="fas fa-window-close"></i></span>
					<div class="search-bar">
						<div class="search-bar-tablecell">
							<h6>Search For:</h6>
							<form action="" method="get">
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end search arewa -->

	<!-- breadcrumb-section -->
	<div class="breadcrumb-section breadcrumb-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="breadcrumb-text">
						<p>cours et cours</p>
						<h1>liste des quiz</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end breadcrumb section -->

	<!-- products -->
	<div class="product-section mt-150 mb-150">
		<div class="container">

			<div class="row product-lists">
				<br>
				<?php
				$correctAnswers = []; // Initialize an empty array
				$i = 0;
				foreach ($quizz as $q) {
					$correctAnswers[$i] = $q["reponse"]; // Add a new correct answer to the array in each iteration
					$i++;
				}

				if ($_SERVER["REQUEST_METHOD"] === "POST") {
					// Define the correct answers for each question (assuming you have them)


					$userAnswers = $_POST['options']; // Assuming 'options' is the name of the radio button group

					$score = 0; // Initialize the score to 0

					// Loop through user answers and check correctness
					foreach ($userAnswers as $questionIndex => $userAnswer) {
						echo ("<script>
						var a = 'Hello, World!';
						console.log(a);
					</script>");
						if (isset($correctAnswers[$questionIndex]) && $userAnswer == $correctAnswers[$questionIndex]) {
							$score++;
						}
					}

					// Display the user's score
					echo "<h1 style='color:red'>Votre note est de : $score sur " . count($correctAnswers) . "</h1>";
				}
				?>
				<form action="" method="post">
					<h2>Passer quiz</h2>
					<?php foreach ($quiz as $key => $q) : ?>
						----------------------------------------------------
						<br>
						<h3 style="color:red"><?= $q['question'] ?></h3>
						<label for="option1<?= $key ?>">
							<h6>Option 1 :</h6>
						</label>

						<br>
						<input type="radio" class="input-control" id="option1<?= $key ?>" name="options[<?= $key ?>]" value="1">
						<h7><?= $q['r1'] ?></h7>
						<br>
						<label for="option2<?= $key ?>">
							<h6>Option 2 :</h6>
						</label>
						<br>
						<input type="radio" class="input-control" id="option2<?= $key ?>" name="options[<?= $key ?>]" value="2">
						<h7><?= $q['r2'] ?></h7>
						<br>
						<label for="option3<?= $key ?>">
							<h6>Option 3 :</h6>
						</label>
						<br>
						<input type="radio" class="input-control" id="option3<?= $key ?>" name="options[<?= $key ?>]" value="3">
						<h7><?= $q['r3'] ?></h7>
						<br>
					<?php endforeach ?>
					----------------------------------------------------
					<br>
					<button type="submit" class="btn btn-primary">envoyer</button>
				</form>
			</div>
		</div>
	</div>
	<!-- end products -->

	<!-- footer -->
	<div class="footer-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-6">
					<div class="footer-box about-widget">
						<h2 class="widget-title">About us</h2>
						<p>Ut enim ad minim veniam perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae.</p>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="footer-box get-in-touch">
						<h2 class="widget-title">Get in Touch</h2>
						<ul>
							<li>34/8, East Hukupara, Gifirtok, Sadan.</li>
							<li>support@fruitkha.com</li>
							<li>+00 111 222 3333</li>
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="footer-box subscribe">
						<h2 class="widget-title">Subscribe</h2>
						<p>Subscribe to our mailing list to get the latest updates.</p>
						<input type="email" placeholder="Email">
						<button type="submit"><i class="fas fa-paper-plane"></i></button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end footer -->

	<!-- copyright -->
	<div class="copyright">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-12">
					<p>Copyrights &copy; 2019 - <a href="https://imransdesign.com/">Imran Hossain</a>, All Rights Reserved.</p>
				</div>
				<div class="col-lg-6 text-right col-md-12">
					<div class="social-icons">
						<ul>
							<li><a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
							<li><a href="#" target="_blank"><i class="fab fa-twitter"></i></a></li>
							<li><a href="#" target="_blank"><i class="fab fa-instagram"></i></a></li>
							<li><a href="#" target="_blank"><i class="fab fa-linkedin"></i></a></li>
							<li><a href="#" target="_blank"><i class="fab fa-dribbble"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end copyright -->

	<!-- jquery -->
	<script src="assets/js/jquery-1.11.3.min.js"></script>
	<!-- bootstrap -->
	<script src="assets/bootstrap/js/bootstrap.min.js"></script>
	<!-- count down -->
	<script src="assets/js/jquery.countdown.js"></script>
	<!-- isotope -->
	<script src="assets/js/jquery.isotope-3.0.6.min.js"></script>
	<!-- waypoints -->
	<script src="assets/js/waypoints.js"></script>
	<!-- owl carousel -->
	<script src="assets/js/owl.carousel.min.js"></script>
	<!-- magnific popup -->
	<script src="assets/js/jquery.magnific-popup.min.js"></script>
	<!-- mean menu -->
	<script src="assets/js/jquery.meanmenu.min.js"></script>
	<!-- sticker js -->
	<script src="assets/js/sticker.js"></script>
	<!-- main js -->
	<script src="assets/js/main.js"></script>

</body>

</html>