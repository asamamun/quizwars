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
            <main class="container col-md-12">
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
                                <span>I</span>
                                <span>Z</span>
                                <span>S</span>
                                <span>E</span>
                                <span>T</span>                                
                            </h1>
                            <div class="form-group">
                                <select name="category_id" class="form-select p-2" id="category_id" required>
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
                            <select name="subcategory_id" class="form-select p-2" id="subcategory_id" required>
                                <option value="-1">Select</option>
                                    <?php
                                    $category_details = $db->get("subcategories");
                                    foreach ($category_details as $category_detail) {
                                        echo "<option value='{$category_detail['id']}' parent='{$category_detail['category_id']}'>{$category_detail['name']}</option>";
                                    }
                                    ?>
                                </select>
                            </div><br>
                            <div class="form-group">
                                <button type="submit" name="submit" value="serchq" class="btn btn-outline-info m-auto d-block">Show Questions</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- question and quizset container -->
                <div class="row">
                    <div class="col-8">
                        <h3 class="mb-3">Quizzes</h3>
                        <div id="quizContainer" class="border border-primary-subtle p-3 card card-hover">
<?php
if(isset($_POST['submit']) && $_POST['submit'] == "serchq"){
    $cat = $_POST['category_id'];
    $sub = $_POST['subcategory_id'];
    $sql = "SELECT * FROM quizes WHERE category_id IN({$cat}) AND subcategory_id IN({$sub})";
    $quizes = $db->query($sql);
}else{
    $quizes = $db->get("quizes");
}
$i=0;
foreach($quizes as $quize){
    $i++;
    echo <<<html
<div class="col">
    <div class="card shadow-sm">
    <div class="card-header">
    Featured
  </div>
        <div class="card-body">
            <h5 class="card-title">{$i}. {$quize['question']}</h5>
            <ol type="a">
                <li>
                    <input type="radio" id="{$quize['id']}op1" name="{$quize['id']}" value="{$quize['op1']}" style="display:none;"/>
                    <label for="{$quize['id']}op1">{$quize['op1']}</label>
                </li>
                <li>
                    <input type="radio" id="{$quize['id']}op2" name="{$quize['id']}" value="{$quize['op2']}" style="display:none;"/>
                    <label for="{$quize['id']}op2">{$quize['op2']}</label>
                </li>
                <li>
                    <input type="radio" id="{$quize['id']}op3" name="{$quize['id']}" value="{$quize['op3']}" style="display:none;"/>
                    <label for="{$quize['id']}op3">{$quize['op3']}</label>
                </li>
                <li>
                    <input type="radio" id="{$quize['id']}op4" name="{$quize['id']}" value="{$quize['op4']}" style="display:none;"/>
                    <label for="{$quize['id']}op4">{$quize['op4']}</label>
                </li>
            </ol>
            <a href="javascript:void(0)" data-quizid="{$quize['id']}" class="btn btn-primary AddToSet">Add</a>
        </div>
    </div>
</div>
html;
}
?>
                        </div>
                    </div>
                    <div class="col-4">
                        <form id="formoOPtion">
                            <h3 class="mb-3">Quiz Set Questions</h3>
                            <div id="questions" class="border border-primary-subtle p-3 card card-hover mb-3">
                                <ul id="setList"></ul>
                            Category Id:  <input type="text" id="qs_cat" readonly>
                            Subcategory Id:<input type="text" id="qs_subcat" readonly>
                            Title:
                            <input type="text" placeholder="Quiz Title" class="form-control mb-3" name="title" id="title">
                            Description: 
                            <textarea name="details" id="descriptions" class="form-control mb-3" name="descriptions"></textarea>
                            <input type="number" placeholder="total Quiz" class="form-control mb-3" name="totalquiz" id="totalquiz">
                            Quiz Start Time
                            <input type="datetime-local" name="start_time" id="start_time" class=" mb-3">
                            Quiz End Time
                            <input type="datetime-local" name="end_time" id="end_time" class=" mb-3">
                            </div>
                            <button type="button" id="createQuizSetBtn" class="btn btn-outline-warning m-auto d-block">Create Quiz Set</button>
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
    <!-- <script src="../assets/js/index.js"></script> -->
    <script src="<?= settings()['adminpage'] ?>assets/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <!-- <script src="<?= settings()['adminpage'] ?>assets/js/scripts.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="<?= settings()['adminpage'] ?>assets/demo/chart-area-demo.js"></script>
    <script src="<?= settings()['adminpage'] ?>assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="<?= settings()['adminpage'] ?>assets/js/datatables-simple-demo.js"></script> -->
    <script src="<?php echo settings()['root'] ?>assets/js/jquery-3.7.1.min.js"></script>    
    <script src="<?php echo settings()['adminpage'] ?>assets/js/index.js"></script>
    <script>
        $(document).ready(function() {
            displayCartItems();
            // localStorage.clear();
            $("#category_id").change(function() {
                let c = $(this).val();
                $("#qs_cat").val(c);                
                $("#subcategory_id option").hide();
                $("#subcategory_id option[parent="+c+"]").show();
                $("#subcategory_id").val("-1");
            });
            $("#subcategory_id").change(function() {
                let c = $(this).val();
                $("#qs_subcat").val(c);
            });

            //
            $("#quizContainer").on("click",".AddToSet",function(){
                $id = $(this).data("quizid");
                const quizToAdd = { id: $id, name: ''};
                let cart = getCartFromLocalStorage();
                if(!isItemInCart(quizToAdd.id,cart)){
                    addItemToCart(quizToAdd,cart);
                }
                displayCartItems();  

            });

//cart start
// Function to check if an item with a given ID already exists in the cart
function isItemInCart(itemId, cart) {
    return cart.some(item => item.id === itemId);
}

// Function to add an item to the cart
function addItemToCart(item, cart) {
    cart.push(item);
    localStorage.setItem('cart', JSON.stringify(cart));
}

// Function to get the cart from local storage
function getCartFromLocalStorage() {
    const cart = localStorage.getItem('cart');
    return cart ? JSON.parse(cart) : [];
}

/* // Example usage:
const itemToAdd = { id: 1, name: 'Product A', price: 10 };
const cart = getCartFromLocalStorage();

if (!isItemInCart(itemToAdd.id, cart)) {
    addItemToCart(itemToAdd, cart);
    console.log('Item added to cart.');
} else {
    console.log('Item already exists in the cart.');
} */

// Function to display all items in the cart
function displayCartItems() {
    const cart = getCartFromLocalStorage();
    // console.log("test"  + cart );
    $("#totQuiz").val(cart.length);
    let html = "";
    // console.log(cart); 
    // return;
    if (cart.length === 0) {
        console.log('The cart is empty.');
        $("#setList").html(html);
    } else {
        console.log('Items in the cart:');
        cart.forEach(item => {
            // console.log(`ID: ${item.id}, Name: ${item.name}`);
            html += `<li>${item.id}<span class="btn btn-warning removequiz" data-id="${item.id}">&times</span></li>`;
        });
        $("#setList").html(html);
    }
}
function clearCart() {
    // Clear the cart array
    const cart = [];
    // Update the cart in local storage
    localStorage.setItem('cart', JSON.stringify(cart));
    $("#setList").html("");
    console.log('Cart cleared.');
}
// Function to remove an item from the cart by its ID
function removeItemFromCart(itemId) {

    let cart = getCartFromLocalStorage();
    
    // Find the index of the item with the given ID
    const index = cart.findIndex(item => item.id === itemId);
    //alert(index);
    if (index !== -1) {
        // Remove the item from the cart array
        cart.splice(index, 1);
        // console.log(cart);
        // Update the cart in local storage
        localStorage.setItem('cart', JSON.stringify(cart));
        console.log(`Item with ID ${itemId} removed from the cart.`);
        return true;
    } else {
        console.log(`Item with ID ${itemId} not found in the cart.`);
        return false;
    }
}



$("#questions").on("click",".removequiz",function(){
    // alert($(this).data("id")); return;
    removeItemFromCart($(this).data("id")); 
    displayCartItems();
})


//cart end


$("#formoOPtion").on("click", "#createQuizSetBtn", function(){
    let ids = "";
    const cart = getCartFromLocalStorage();
    // console.log(cart); return;
/*     cart.forEach(item => {
        ids += item.id+" ";
    }); */
    $.post("quizes_submit.php",
    {
        ids: cart,
        cat: $("#qs_cat").val(),
        subcat: $("#qs_subcat").val(),
        title: $('#title').val(),
        descriptions: $('#descriptions').val(),
        totalquiz: $('#totalquiz').val(),
        start_time: $('#start_time').val(),
        end_time: $('#end_time').val(),
    },
    function(data, status){
        console.log(data); 
        alert("Data: " + data + "\nStatus: " + status);
        clearCart();
    });
});



        });
        </script>

</body>

</html>