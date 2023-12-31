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
  // Redirect to the login page
  header("Location: login.php");
}
include('../../../../controller/coursC.php');

$userC = new userC();
$users = $userC->reade();

$error = "";

// create cours
$cours = null;

// create an instance of the controller
$coursC = new coursC();
if (
  isset($_POST["nom"]) &&
  isset($_POST["cour"]) &&
  isset($_POST["ide"])
) {
  if (
    !empty($_POST["nom"]) &&
    !empty($_POST['cour']) &&
    !empty($_POST["ide"])
  ) {
    $cours = new cours(
      $_POST['nom'],
      $_POST['cour'],
      $_POST['matiere'],
      $_POST['ide'],
    );
    $coursC->create($cours);
  } else
    $error = "Missing incours";
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Modernize Free</title>
  <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" />
  <link rel="stylesheet" href="../assets/css/styles.min.css" />
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href=# class="text-nowrap logo-img">
            <img src="../assets/images/logos/dark-logo.svg" width="180" alt="" />
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
                  <img src="../assets/images/profile/cours-1.jpg" alt="" width="35" height="35" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                  <div class="message-body">
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-cours fs-6"></i>
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
            <h5 class="card-title mt-5 fw-semibold mb-4">Ajouter un cours</h5>
            <div class="mt-5 card">
              <div class="card-body">
                <form action="" id="formr" method="post">
                  <div class="mb-3">
                    <label class="form-label">Nom :</label>
                    <input type="text" class="form-control" id="nom" name="nom">
                    <span id="nomr"></span>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">cour :</label>
                    <input type="text" class="form-control" id="cour" name="cour">
                    <span id="courr"></span>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">matiere :</label>
                    <select name="matiere" id="">
                      <option value="math">math</option>
                      <option value="svt">svt</option>
                      <option value="histoire">histoire</option>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Enseignant :</label>
                    <select name="ide" class="form-control" id="ideinput">
                      <?php
                      foreach ($users as $u) {
                      ?>
                        <option value="<?= $u['id'] ?>"><?= $u['nom'] ?> <?= $u['prenom'] ?></option>
                      <?php
                      }
                      ?>
                    </select>
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
        let nameinput = document.getElementById('nom');
        let cour = document.getElementById('cour');
        const regex = /^[a-zA-Z-\s]+$/;
        if (cour.value === '') {
          let courr = document.getElementById('courr');
          courr.innerHTML = "le champs cours est vide . ";
          courr.style.color = 'red';
          e.preventDefault();
        }
        if (nameinput.value === '') {
          let nameer = document.getElementById('nomr');
          nameer.innerHTML = "le champs nom est vide . ";
          nameer.style.color = 'red';
          e.preventDefault();
        } else if (!(regex.test(nameinput.value))) {
          let nameer = document.getElementById('nomr');
          nameer.innerHTML = "le nom doit comporter des lettres,et tirets seulements.";
          nameer.style.color = 'red';
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