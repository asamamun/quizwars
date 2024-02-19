<?php
$page = "Home";
$title = "Home";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require __DIR__ . '/vendor/autoload.php';
$db = new MysqliDb();

?>
<?php require __DIR__ . '/components/header.php';?>
<style>
input:checked + label{
    background-color: green;
    color: white;
}
</style>
</head>
<body>
    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1>Best Preparation For Exam</h1>
                </div>
            </div>
            <div class="row">
                <form action="" method="post" id="subForm">
<?php
$i=0;
$quizes = $db->get('quizes');
foreach($quizes as $quize){
    $i++;
    echo <<<html
<div class="col">
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="card-title">{$i}. {$quize['question']}</h5>
            <ol type="a">
                <li>
                    <input type="radio" id="{$quize['unique_key']}op1" name="{$quize['unique_key']}" value="{$quize['op1']}" style="display:none;"/>
                    <label for="{$quize['unique_key']}op1">{$quize['op1']}</label>
                </li>
                <li>
                    <input type="radio" id="{$quize['unique_key']}op2" name="{$quize['unique_key']}" value="{$quize['op2']}" style="display:none;"/>
                    <label for="{$quize['unique_key']}op2">{$quize['op2']}</label>
                </li>
                <li>
                    <input type="radio" id="{$quize['unique_key']}op3" name="{$quize['unique_key']}" value="{$quize['op3']}" style="display:none;"/>
                    <label for="{$quize['unique_key']}op3">{$quize['op3']}</label>
                </li>
                <li>
                    <input type="radio" id="{$quize['unique_key']}op4" name="{$quize['unique_key']}" value="{$quize['op4']}" style="display:none;"/>
                    <label for="{$quize['unique_key']}op4">{$quize['op4']}</label>
                </li>
            </ol>
        </div>
    </div>
</div>
html;
}
?>
                    <button type="button" id="submitGO" class="btn btn-success" name="submit" value="result">Submit</button>
                </form>
            </div>
        </div>
    </div>
<?php 
require __DIR__ . '/components/footer.php';
$db->disconnect();
?>
<script>
$(document).ready(function(){
    $("#submitGO").click(function(){
        $.post(
            "quiz_result.php",
            {data:$("#subForm").serialize()},
            function(d){
                //$("#result").html(d);
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: d+'out of 20',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        );
    });
});
</script>