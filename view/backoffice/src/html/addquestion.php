<?php
session_start();
if (!isset($_SESSION['id'])) {
  header("Location:login.php");
} else if ($_SESSION['type'] == "etudiant") {
  header("Location:login.php");
}
if (isset($_GET['logout'])) {
  // Destroy the session
  session_destroy();
  // Redirect to the login preponse
  header("Location: login.php");
}
if (isset($_GET['q'])) {
  $q = $_GET['q'];
  if ($q == 0) {
    header('Location:quiz.php');
  }
}
include('../../../../controller/questionC.php');

$userC = new userC();
$users = $userC->reade();

$error = "";

// create question
$question = null;
// create an instance of the controller
$questionC = new questionC();
$var = $questionC->getquizid();
$nbrq = $questionC->getnbrq();
if (
  isset($_POST["question"]) &&
  isset($_POST["r1"]) &&
  isset($_POST["r2"]) &&
  isset($_POST["r3"]) &&
  isset($_POST["reponse"])
) {
  if (
    !empty($_POST["question"]) &&
    !empty($_POST['r1']) &&
    !empty($_POST["r2"]) &&
    !empty($_POST['r3']) &&
    !empty($_POST["reponse"])
  ) {
    $question = new question(
      $var["id"],
      $_POST['question'],
      $_POST['r1'],
      $_POST['r2'],
      $_POST['r3'],
      $_POST['reponse'],
    );
    $questionC->create($question);
  } else
    $error = "Missing inquestion";
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Modernize Free</title>
  <link rel="shortcut icon" type="imreponse/png" href="../assets/imreponses/logos/favicon.png" />
  <link rel="stylesheet" href="../assets/css/styles.min.css" />
</head>

<body>
  <!--  Body Wrapper -->
  <div class="preponse-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href=# class="text-nowrap logo-img">
            <img src="../assets/imreponses/logos/dark-logo.svg" width="180" alt="" />
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>
        <?php include("side.php") ?>
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
          <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
              <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-icon-hover" href="javascript:void(0)">
                <i class="ti ti-bell-ringing"></i>
                <div class="notification bg-primary rounded-circle"></div>
              </a>
            </li>
          </ul>
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
              <a href="https://adminmart.com/product/modernize-free-bootstrap-admin-dashboard/" target="_blank" class="btn btn-primary">Download Free</a>
              <li class="nav-item dropdown">
                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
                  <img src="../assets/imreponses/profile/question-1.jpg" alt="" width="35" height="35" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                  <div class="messreponse-body">
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-question fs-6"></i>
                      <p class="mb-0 fs-3">My Profile</p>
                    </a>
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-mail fs-6"></i>
                      <p class="mb-0 fs-3">My Account</p>
                    </a>
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-list-check fs-6"></i>
                      <p class="mb-0 fs-3">My Task</p>
                    </a>
                    <a href="?logout" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!--  Header End -->
      <div class="container-fluid">
        <!--  Row 1 -->
        <div class="row">
          <div class="card-body">
            <h5 class="card-title mt-5 fw-semibold mb-4">Ajouter une question</h5>
            <div class="mt-5 card">
              <div class="card-body">
                <form action="" id="formr" method="post">
                  <div class="mb-3">
                    <label class="form-label">Question :</label>
                    <input type="text" class="form-control" id="question" name="question">
                    <span id="questionr"></span>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Option 1 :</label>
                    <input type="text" class="form-control" id="r1" name="r1">
                    <span id="r1r"></span>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Option 2 :</label>
                    <input type="text" class="form-control" id="r2" name="r2">
                    <span id="r2r"></span>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Option 3 :</label>
                    <input type="text" class="form-control" id="r3" name="r3">
                    <span id="r3r"></span>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Reponse :</label>
                    <input type="text" class="form-control" id="reponse" name="reponse">
                    <span id="reponser"></span>
                  </div>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script>
      let myform = document.getElementById('formr');
      myform.addEventListener('submit', function(e) {
        let question = document.getElementById('question');
        let r1 = document.getElementById('r1');
        let r2 = document.getElementById('r2');
        let r3 = document.getElementById('r3');
        let reponse = document.getElementById('reponse');

        const regex = /^[a-zA-Z-\s]+$/;
        if (question.value === '') {
          let questionr = document.getElementById('questionr');
          questionr.innerHTML = "le champs question est vide . ";
          questionr.style.color = 'red';
          e.preventDefault();
        }
        if (r1.value === '') {
          let r1r = document.getElementById('r1r');
          r1r.innerHTML = "le champs reponse 1 est vide . ";
          r1r.style.color = 'red';
          e.preventDefault();
        }
        if (r3.value === '') {
          let r3r = document.getElementById('r3r');
          r3r.innerHTML = "le champs reponse 3 est vide . ";
          r3r.style.color = 'red';
          e.preventDefault();
        }
        if (reponse.value === '') {
          let reponser = document.getElementById('reponser');
          reponser.innerHTML = "le champs reponse est vide . ";
          reponser.style.color = 'red';
          e.preventDefault();
        } else if (!(/^[1-3]+$/.test(reponse.value))) {
          let reponser = document.getElementById('reponser');
          reponser.innerHTML = "la reponse doit comporter que des numero entre 1 er 3";
          reponser.style.color = 'red';
          e.preventDefault();
        }
      });
    </script>
    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/sidebarmenu.js"></script>
    <script src="../assets/js/app.min.js"></script>
    <script src="../assets/libs/apexcharts/dist/apexcharts.min.js"></script>
    <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
    <script src="../assets/js/dashboard.js"></script>
</body>

</html>