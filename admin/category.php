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
$categories = $db->get('categories');
?>
<?php require __DIR__ . '/components/header.php'; ?>
<!-- </head> -->

<body class="sb-nav-fixed">
    <div class="row">
        <div class="col-12">
            <!-- static navbar start here -->
            <?php require __DIR__ . '/components/navbar.php'; ?>
        </div>
        <!-- static navbar end here -->
    </div>
    <div>
        <div class="row">
            <!-- layoutSidenav start here -->
            <div class="col-2">
                <div id="layoutSidenav">
                    <?php require __DIR__ . '/components/sidebar.php'; ?>
                </div>
            </div>
            <!-- layoutSidenav end here -->

            <!-- content start here -->
            <div class="col-10">
                <div class="container">
                    <h1>All Categories</h1>
                    <hr>
                    <a href="category_add.php" class="btn btn-primary">Add New</a>
                    <table class="table table-responsive">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>

                        <?php
                        foreach ($categories as $c) {
                            // echo $user['name']."(".$user['email'].")<br>";
                            echo "<tr>
                                    <td>" . $c['id'] . "</td>
                                    <td>" . $c['name'] . "</td>
                                    <td>" . $c['created_at'] . "</td>
                                    <td><a href='category_add.php?id={$c['id']}'><i class='bi bi-pencil-square'></i></a> <a href='category_delete.php?id={$c['id']}' onclick='return confirm(\"Are you sure?\")'><i class='bi bi-trash3'></i></a> </td>
                                  </tr>";
                        }
                        ?>
                    </table>
                </div>
            </div>
            <!-- content end here -->

        </div>
    </div>


    <script src="<?= settings()['adminpage'] ?>assets/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="<?= settings()['adminpage'] ?>assets/js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="<?= settings()['adminpage'] ?>assets/demo/chart-area-demo.js"></script>
    <script src="<?= settings()['adminpage'] ?>assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="<?= settings()['adminpage'] ?>assets/js/datatables-simple-demo.js"></script>
</body>

</html>