<hr>
<nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
    <a href="index.php" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
        <h2 class="m-0 text-primary"><img src="<?= settings()['logo'] ?>" alt=""><?= settings()['sitename'] ?></h2>
    </a>
    <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto p-4 p-lg-0">
            <a href="index.php" class="nav-item nav-link active me-3 btn btn-info hover p-2">Home</a>
            <a href="countdown.html" class="nav-item nav-link active me-3 btn btn-info hover p-2">Count Down</a>
            <?php
            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == 'true') {
                if ($_SESSION['role'] == "2") {
            ?>
                    <a href="admin/" class="nav-item nav-link active me-3 btn btn-info hover p-2">Dashboard</a>
                <?php
                }
                ?>
                <a href="logout.php" class="nav-item nav-link active me-3 btn btn-info hover p-2">Logout</a>
            <?php
            } else {
            ?>
                <a href="registration.php" class="nav-item nav-link active me-3 btn btn-info hover p-2">Sign Up</a>
                <a href="login.php" class="nav-item nav-link active me-3 btn btn-info hover p-2">Sign In</a>

            <?php
            }
            ?>

        </div>
    </div>
</nav>
<hr>