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
// var_dump($_POST["ids"]);
try{
    $db->startTransaction();
    $date = [
        'category_id' => $_POST["cat"],
        'subcategory_id' => $_POST["subcat"],
        'quiz_title' => $_POST["title"],
        'descriptions' => $_POST["descriptions"],
        'totalquiz' => $_POST["totalquiz"],
        'start_time' => $_POST["start_time"],
        'end_time' => $_POST["end_time"]
    ];
    $db->insert('quizsets', $date);
    $current = $db->getInsertId();
    $isa = $_POST["ids"]??[];
    foreach ($isa as $value) {
        $datas = [
            'quizset_id' => $current,
            'quiz_id' => $value['id']
        ];
        $db->insert('quizset_quiz', $datas);
    }
    $db->commit();
    echo "insert successfull";
}catch(\Throwable $th){
    echo $th->getMessage();
    $db->rollback();
}

?>