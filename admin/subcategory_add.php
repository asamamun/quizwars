<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require __DIR__ . '/../vendor/autoload.php';
$db = new MysqliDb();
// add new category
if (isset($_POST['addnew'])) {
    $category_name  = $_POST['category_name'];
    $sub_name = $_POST['sub_name'];
    $data = [
        "category_id" => $category_name,
        "name" => $sub_name
    ];
    $id = $db->insert('subcategories', $data);
}
    if ($id){
        $message = 'Category Created Which Serial ID = ' . $id;
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
            <main class="container w-75 card p-5">
                <h1 class="text-center p-0 m-0">Add New Sub-category</h1><br>
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
                        <label for="categoryName" class="form-label"><b>Select Category Name:</b></label>
                        <select name="category_name" id="cat_id" class="w-100 p-3">
                            <option value="-1">Select</option>
                            <?php
                            $categories = $db->get('categories');
                            foreach ($categories as $category) {
                                echo "<option value='{$category['id']}'>{$category['name']}</option>";
                            }
                            ?>
                        </select>
                    </div><br>
                    <div class="mt-3">
                        <label for="categoryName" class="form-label"><b>Select Sub-category Name:</b></label><br>
                        <input type="text" name="sub_name" placeholder="Enter Any Sub-category Name" class="w-100 p-3" id="" required> 
                    </div>
                    <div class="d-flex justify-content-end mt-5">
                        <button type="submit" name="addnew" class="btn btn-primary" value="addnew">Add Sub-category</button>
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