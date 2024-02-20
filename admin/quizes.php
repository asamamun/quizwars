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
?>
<?php
$db = new MysqliDb();
if (isset($_POST['reset'])) {
    $category_id = $_POST['category_id'];
    $subCategory_id = $_POST['subCategory_id'];
    $questionDescrip = $_POST['questionDescrip'];
    $option_a = $_POST['option_a'];
    $option_b = $_POST['option_b'];
    $option_c = $_POST['option_c'];
    $option_d = $_POST['option_d'];
    $correct_answer = $_POST['correct_answer'];
    $explan = $_POST['explanation'];
    $status = $_POST['status'];
    $userId = $_POST['user_id'];
    $category_id = "";
    $subCategory_id = "";
    $questionDescrip = "";
    $option_a = "";
    $option_b = "";
    $option_c = "";
    $option_d = "";
    $correct_answer = "";
    $explan = "";
}
if (isset($_POST['submit'])) {
    $category_id = $_POST['category_id'];
    $subCategory_id = $_POST['subCategory_id'];
    $questionDescrip = $_POST['questionDescrip'];
    $option_a = $_POST['option_a'];
    $option_b = $_POST['option_b'];
    $option_c = $_POST['option_c'];
    $option_d = $_POST['option_d'];
    $correct_answer = $_POST['options'] ?? null;
    $explan = $_POST['explanation'];
    if (!$correct_answer) {
        die("Select Correct Answer");
        exit;
    }
    $data = [
        'category_id' => $category_id,
        'subcategory_id' => $subCategory_id,
        'question' => $questionDescrip,
        'op1' => $option_a,
        'op2' => $option_b,
        'op3' => $option_c,
        'op4' => $option_d,
        'c_answer' => $correct_answer,
        'explanation' => $explan,
        'user_id' => $_SESSION['userid'],
    ];
    $db->insert("quizes", $data);

    // $sub_cats = $db->where('category_id', $_GET["category_id"])->get("subcategories");
};
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="../assets/css/style.css"> -->
    <?php require __DIR__ . '/components/header.php'; ?>


</head>

<body class="sb-nav-fixed">
    <?php require __DIR__ . '/components/navbar.php'; ?>
    <div id="layoutSidenav">
        <?php require __DIR__ . '/components/sidebar.php'; ?>
        <div id="layoutSidenav_content">
            <!-- main start here -->
            <main class="container col-md-9">
                <div class="row">
                    <div class="col-md-12">
                        <form id="quizform" action="" method="post" class="border border-primary-subtle p-3 card card-hover">
                            <h1 class="text-center fw-bold m-3">
                                <span>I</span>
                                <span>N</span>
                                <span>S</span>
                                <span>E</span>
                                <span>R</span>
                                <span>T</span>
                                &nbsp;&nbsp;
                                <span>Q</span>
                                <span>U</span>
                                <span>E</span>
                                <span>S</span>
                                <span>T</span>
                                <span>I</span>
                                <span>O</span>
                                <span>N</span>
                            </h1>
                            <div class="form-group">
                                <select name="category_id" class="form-control p-2" id="category_id" required onChange="actionFunb()">
                                    <option value="-1">Select</option>
                                    <?php
                                    $category_details = $db->get("categories");
                                    foreach ($category_details as $category_detail) {
                                        echo "<option value='{$category_detail['id']}'>{$category_detail['name']}</option>";
                                    }
                                    ?>
                                </select>
                            </div><br>
                            <div class="form-group">
                                <select name="subCategory_id" class="form-control p-2" id="subCategory_id" required>
                                    <option value="-1">Select</option>
                                </select>
                            </div><br>
                            <div class="form-group">
                                <textarea class="form-control" name="questionDescrip" id="" rows="5" placeholder="Question Description" required></textarea>
                            </div><br>
                            <div>
                                <div class=" text-center pb-4">
                                    <button class="glow-on-hover" type="button">
                                        <h4>OPTION</h4>
                                    </button>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-group mb-3">
                                            <!-- <button class="btn btn-outline-secondary p-2 check" type="radio" id="a" value="op1"><b>(A).</b></button> -->
                                            <input type="radio" class="btn-check" name="options" id="a" value="op1" autocomplete="off">
                                            <label class="btn" for="a">A</label>
                                            <input type="text" name="option_a" class="form-control p-2" id="option_a" placeholder="" aria-label="" value="" aria-describedby="basic-addon1">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group mb-3">
                                            <!-- <button class="btn btn-outline-secondary p-2 check" type="radio" id="b"><b>(B).</b></button> -->
                                            <input type="radio" class="btn-check" name="options" id="b" value="op2" autocomplete="off">
                                            <label class="btn" for="b">B</label>
                                            <input type="text" name="option_b" class="form-control p-2" id="option_b" placeholder="" aria-label="" aria-describedby="basic-addon1">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group mb-3">
                                            <!-- <button class="btn btn-outline-secondary p-2 check" type="button" id="c"><b>(C).</b></button> -->
                                            <input type="radio" class="btn-check" name="options" id="c" value="op3" autocomplete="off">
                                            <label class="btn" for="c">C</label>
                                            <input type="text" name="option_c" class="form-control p-2" placeholder="" aria-label="" aria-describedby="basic-addon1" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group mb-3">
                                            <!-- <button class="btn btn-outline-secondary p-2 check" type="button" id="d"><b>(D).</b></button> -->
                                            <input type="radio" class="btn-check" name="options" id="d" value="op4" autocomplete="off">
                                            <label class="btn" for="d">D</label>
                                            <input type="text" name="option_d" class="form-control p-2" id="option_d" placeholder="" aria-label="" aria-describedby="basic-addon1">
                                        </div>
                                    </div>
                                    <!-- <p class="text-center text-danger fw-bold fst-italic">* Select Correct answer (a, b, c, d)</p> -->
                                </div>
                            </div>
                            <!--                            <div class="form-group">
                                <input type="text" placeholder="Correct Answer" name="correct_answer" class="form-control" id="correct_answer">
                            </div><br> -->
                            <div class="form-group">
                                <textarea class="form-control p-1 mb-2" name="explanation" id="" rows="5" placeholder="Explanation"></textarea>
                            </div><br>
                            <div class="d-flex justify-content">
                                <input type="reset" name="reset" class="btn btn-outline-secondary btn-lg" value="RESET">
                                <input type="submit" id="submitBtn" name="submit" class="btn btn-primary btn-outline-secondary btn-lg ms-auto text-white" value="SUBMIT">
                            </div>
                        </form>
                    </div>
                </div>
            </main>
            <!-- main ends here -->
            <!-- footer start here -->
            <!-- footer end here -->

            <?php require __DIR__ . '/components/footer.php'; ?>
        </div>
    </div>
    <script src="../assets/js/index.js"></script>
    <script src="<?= settings()['adminpage'] ?>assets/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="<?= settings()['adminpage'] ?>assets/js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="<?= settings()['adminpage'] ?>assets/demo/chart-area-demo.js"></script>
    <script src="<?= settings()['adminpage'] ?>assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="<?= settings()['adminpage'] ?>assets/js/datatables-simple-demo.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="<?php echo settings()['adminpage'] ?>assets/js/index.js"></script>
    <script>
        $(document).ready(function() {
            // $('.check').click(function(e) {
            //     var value = $(this).next().val();
            //     var answer = $('#correct_answer').prop("placeholder", value);
            // })

            $("#quizform").on("submit", function(event) {
                let ca = $('input[name="options"]:checked').val();
                alert(ca);
                if (typeof ca === "undefined") {
                    Swal.fire("Please Select Correct Answer!");
                    event.preventDefault();
                }

            });

            // function check(t){
            //     let ca = $('input[name="options"]:checked').val();
            //     alert(ca);
            //     if (typeof ca === "undefined") {
            //         Swal.fire("Please Select Correct Answer!");
            //         return fase;
            //     }
            //     else{
            //         return true;
            //     }
            // }

            // $("#submitBtn").click(function(e) {
            //     e.preventDefault();                
            //     $("#quizform").trigger("submit");
            //     alert(5);
            // });
        })
    </script>
    <!--     
    <script>
        $(document).ready(function() {
            $('.check').click(function(e) {
                var value = $(this).next().val();
                var answer = $('#correct_answer').prop("placeholder", value);
            })
        })
    </script>


    <script>
        function actionFunb() {
            $cat_id_send = document.getElementById("category_id").value;
            fetch(`quize_api.php?category_id=${$cat_id_send}`).then(x => x.text()).then(y => myDisplay(y));

            function myDisplay(data) {
                document.getElementById("subcategory_id").innerHTML = data;
            }
        }
        // $(document).ready(function(){
        //     $(document).on('click','.hello', function(){
        //         $result = $(this).next('input').val();
        //         $('#crrAns').val($result);
        //     })
        // })
    </script>
    <script src="assets/js/scripts.js"></script> -->
    <script>
        function actionFunb() {
            $cat_id_send = document.getElementById("category_id").value;
            fetch(`quize_api.php?category_id=${$cat_id_send}`).then(x => x.text()).then(y => myDisplay(y));

            function myDisplay(data) {
                document.getElementById("subCategory_id").innerHTML = data;
            }
        }
    </script>
</body>

</html>