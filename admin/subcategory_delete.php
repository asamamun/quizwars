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
if (isset($_GET['id'])) {
    $find_id = $_GET['id'];
    $id = filter_var($find_id, FILTER_VALIDATE_INT);
    if ($id) {
        $db->where('id', $id);
        $db->delete('categories');
        header("location: category.php");
    }
    
    else {
        echo "something went wrong!! contact the administrator";
        exit;
    }
}
