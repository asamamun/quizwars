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
                                <span>I</span>
                                <span>Z</span>
                                <span>S</span>
                                <span>E</span>
                                <span>T</span>                                
                            </h1>
                            <div class="form-group">
                                <select name="category_id" class="form-select p-2" id="category_id" required>
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
                                <button class="btn btn-outline-info m-auto d-block">Show Questions</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- question and quizset container -->
                <div class="row">
                    <div class="col-8">
                        <h3>Quizzes</h3>
                        <div id="quizContainer">
                        <?php
$i=0;
$quizes = $db->get('quizes');
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
                        <h3>Quiz Set Questions</h3>
                        <div id="questions">
                            <ul id="setList"></ul>
                        </div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="<?php echo settings()['adminpage'] ?>assets/js/index.js"></script>
    <script>
        $(document).ready(function() {
            displayCartItems();
            // localStorage.clear();
            $("#category_id").change(function() {
                let c = $(this).val();
                $("#subcategory_id option").hide();
                $("#subcategory_id option[parent="+c+"]").show();
                $("#subcategory_id").val("-1");
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
    let html = "<h3>Total: " + cart.total + "</h3>";
    console.log(cart); 
    // return;
    if (cart.length === 0) {
        console.log('The cart is empty.');
    } else {
        console.log('Items in the cart:');
        cart.forEach(item => {
            // console.log(`ID: ${item.id}, Name: ${item.name}`);
            html += `<li>${item.id}<span class="removequiz p-3" data-id="${item.id}">&times</span></li>`;
        });
        $("#setList").html(html);
    }
}
// Function to remove an item from the cart by its ID
function removeItemFromCart(itemId) {
    let cart = getCartFromLocalStorage();
    
    // Find the index of the item with the given ID
    const index = cart.findIndex(item => item.id === itemId);
    
    if (index !== -1) {
        // Remove the item from the cart array
        cart.splice(index, 1);
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
    if(removeItemFromCart($(this).data("id"))) displayCartItems();
})


//cart end





        });
        </script>

</body>

</html>