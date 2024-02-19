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
$sub_cats = $db->where('category_id', $_GET["category_id"])->get("subcategories");
foreach ($sub_cats as $sub_cat) {
    echo "<option value='{$sub_cat['id']}'>{$sub_cat['name']}</option>";
}
