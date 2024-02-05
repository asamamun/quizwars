<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require __DIR__ . '/vendor/autoload.php';
use App\User;
use App\model\Category;
// use App\db;
// $conn = db::connect();
$db = new MysqliDb ();
$page = "Home";
?>
<?php require __DIR__ . '/components/header.php';?>

</head>
<body>
    <div class="container">
<img src="<?= settings()['logo'] ?>" alt="">
<?php require __DIR__ . '/components/menubar.php';?>


</div>
<script>
    
</script>

<?php 
require __DIR__ . '/components/footer.php'; 
$db->disconnect();
?>
