<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
require __DIR__ . '/../vendor/autoload.php';

use App\auth\Admin;

if (!Admin::Check()) {
  header('HTTP/1.1 503 Service Unavailable');
  exit;
}
$db = new MysqliDb();
if (isset($_POST['username'])) {
  require "conn.php";
  $user = $conn->real_escape_string($_POST['username']);
  $pass1 = $_POST['pass1'];
  $pass2 = $_POST['pass2'];
  if ($pass1 === $pass2) {
    $pass = password_hash($pass1, PASSWORD_DEFAULT);
    $insert_query = "INSERT INTO users values(null,'{$user}','{$pass}',CURRENT_TIMESTAMP)";
    $conn->query($insert_query);
    if ($conn->affected_rows) {
      $message = "User '{$user}' registered successfully. Id: {$conn->insert_id}";
    }
  }
}
?>

<?php require __DIR__ . '/components/header.php'; ?>
<!-- </head> -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/fontawesome.min.css" integrity="sha512-d0olNN35C6VLiulAobxYHZiXJmq+vl+BGIgAxQtD5+kqudro/xNMvv2yIHAciGHpExsIbKX3iLg+0B6d0k4+ZA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="sb-nav-fixed">
  <div class="row">
    <div class="col-md-12">
      <!-- static navbar start here -->
      <?php require __DIR__ . '/components/navbar.php'; ?>
    </div>
    <!-- static navbar end here -->
  </div>
  <div class="row">
    <!-- layoutSidenav start here -->
    <div class="col-md-2">
      <div id="layoutSidenav">
        <?php require __DIR__ . '/components/sidebar.php'; ?>
      </div>
    </div>
    <!-- layoutSidenav end here -->
    <!-- </div> -->

    <!-- content start here -->
    <div class="container">
      <div class="row justify-content-center">

        <div class="col-md-6">
          <?php
          if (isset($message)) {
          ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
              <strong>Success!</strong> <?= $message; ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          <?php
          }
          ?>
          <h1>SIGN UP</h1>

          <form class="was-validated" method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
            <div class="d-flex flex-row align-items-center pb-3">
              <i class="fas fa-user fa-lg me-3 fa-fw"></i>
              <div class="form-outline flex-fill mb-0">
                <input type="text" name="username" id="form3Example1c" class="form-control" required placeholder="Your Name" />
                <!-- <label class="form-label" for="form3Example1c">Your Name</label> -->
                <div class="valid-feedback">Valid Feedback</div>
                <div class="invalid-feedback">Inalid Feedback</div>
              </div>
            </div>

            <div class="d-flex flex-row align-items-center pb-3">
              <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
              <div class="form-outline flex-fill mb-0">
                <input type="password" name="pass1" id="form3Example4c" class="form-control" required placeholder="password" />
                <div class="valid-feedback">Valid Feedback</div>
                <div class="invalid-feedback">Inalid Feedback</div>
              </div>
            </div>

            <div class="d-flex flex-row align-items-center pb-3">
            <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
              <div class="form-outline flex-fill mb-0">
                <input type="password" name="pass2" id="form3Example4cd" class="form-control" required placeholder="retype password" />
                <div class="valid-feedback">Valid Feedback</div>
                <div class="invalid-feedback">Inalid Feedback</div>
              </div>
            </div>

            <div class="form-check d-flex justify-content-center pb-3">
              <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3c" />
              <label class="form-check-label" for="form2Example3">
                I agree all statements in <a href="#!">Terms of service</a>
              </label>
            </div>

            <div class="d-flex justify-content-center pb-3">
              <button type="submit" name="btn_submit" class="btn btn-primary btn-lg">Register</button>
            </div>

          </form>
        </div>
        <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
          <img src="assets/images/register.webp" class="img-fluid" alt="Sample image">

        </div>
      </div>
    </div>
    <!-- content end here -->
    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sit voluptatem assumenda unde quibusdam libero dicta, neque debitis cum? Optio obcaecati numquam incidunt doloribus debitis amet quibusdam porro eligendi cupiditate ullam!
    Quisquam minima nostrum in voluptatem vero, odio neque deleniti praesentium! Assumenda pariatur ipsa perspiciatis accusamus perferendis reprehenderit facere rerum ducimus sequi, aliquam exercitationem repellat, voluptate, aperiam vel et aut quia.
    Quis sapiente voluptatem placeat nisi sint nihil explicabo odio pariatur, dicta iusto voluptas quibusdam officiis rerum odit. Consectetur exercitationem libero dolorum quo sed. Voluptatum repudiandae veniam voluptates tempora assumenda et.
    Iste, ducimus nisi sed nostrum, voluptatem dolorem obcaecati iusto, repellendus quo architecto minus magnam. Omnis, culpa minus voluptatum deleniti harum eveniet adipisci, cum possimus veniam ad praesentium voluptatibus cumque quibusdam!
    Cupiditate, natus. Nisi soluta nesciunt doloremque inventore perferendis quos praesentium veniam molestias? Illum, reprehenderit? Nihil, tempore officiis. Fugit aperiam, consequatur dicta esse numquam eos praesentium, veritatis, ex vitae tempore voluptatum.

  </div>
  <script src="<?= settings()['adminpage'] ?>assets/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
  <script src="<?= settings()['adminpage'] ?>assets/demo/chart-area-demo.js"></script>
  <script src="<?= settings()['adminpage'] ?>assets/demo/chart-bar-demo.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
  <script src="<?= settings()['adminpage'] ?>assets/js/datatables-simple-demo.js"></script>
  <script src="<?= settings()['adminpage'] ?>assets/js/index.js"></script>
</body>

</html>