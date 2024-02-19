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
$subcategories = $db->get('subcategories');
?>
<?php require __DIR__ . '/components/header.php'; ?>
</head>

<body class="sb-nav-fixed">
    <?php require __DIR__ . '/components/navbar.php'; ?>
    <div id="layoutSidenav">
        <?php require __DIR__ . '/components/sidebar.php'; ?>
        <div id="layoutSidenav_content">
            <main>
                <h1>All Sub Categories</h1>
                <table class="table table-responsive">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Category ID</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>

                    <?php
                    foreach ($subcategories as $sc) {
                        // echo $user['name']."(".$user['email'].")<br>";
                        echo "<tr>
    <td>" . $sc['id'] . "</td>
    <td>" . $sc['name'] . "</td>
    <td>" . $sc['category_id'] . "</td>
    <td>" . $sc['created_at'] . "</td>
    <td><a href='subcategory-edit.php?id={$sc['id']}'><i class='bi bi-pencil-square'></i></a> <a href='subcategory_delete.php?id={$sc['id']}' onclick=' confirm(\"Are you sure?\")'><i class='bi bi-trash3'></i></a> </td>

</tr>";
                    }
                    ?>
                </table>
                <!-- changed content  ends-->
            </main>
            <!-- footer -->
            <?php require __DIR__ . '/components/footer.php'; ?>
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