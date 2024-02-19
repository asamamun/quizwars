<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require __DIR__ . '/../vendor/autoload.php';
// add new category
if (isset($_POST['addnew']) && isset($_POST['newcat'])) {
    $db = new MysqliDb();
    $name  = $_POST['newcat'];
    $data = ["name" => $name];
    $id = $db->insert('categories', $data);
    if ($id){
        $message = 'Category Created Which Serial ID = ' . $id;
    }
}
?>
<?php require __DIR__ . '/components/header.php'; ?>
<style>
    .card:hover {
        box-shadow: 15px 12px 70px 5px darkgray;
        transition: .8s;
    }
</style>

</head>

<body class="sb-nav-fixed">
    <?php require __DIR__ . '/components/navbar.php'; ?>
    <div id="layoutSidenav">
        <?php require __DIR__ . '/components/sidebar.php'; ?>
        <div id="layoutSidenav_content">
            <main class="container w-75 card p-5 mt-3">
                <h1 class="text-center">Add New Category</h1>
                <div style="height:80px;">
                <?php
                if (isset($message)) {
                ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Success:</strong> <?= $message ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
                }
                ?>
                </div>
                <form method="post">
                    <div>
                        <label for="categoryName" class="form-label"><b>Category Name:</b></label>
                        <input type="text" name="newcat" class="form-control p-3" id="categoryName" placeholder="Enter Any category name" required>
                    </div>
                    <div class="d-flex justify-content-end mt-5">
                        <button type="submit" name="addnew" class="btn btn-primary" value="addnew">Add Category</button>
                    </div>
                </form>

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