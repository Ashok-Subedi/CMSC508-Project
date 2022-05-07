<?php
// Initialize the session
session_start();

require_once "config.php";
$message = '';

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

    
if(isset($_POST["add_to_cart"])){

    if(isset($_COOKIE["shopping_cart"])){
        $cookie_data = stripslashes($_COOKIE['shopping_cart']);
        $cart_data = json_decode($cookie_data, true);

    }
    else{
        $cart_data = array();
    }

    $item_id_list = array_column($cart_data, 'item_id');

    if(in_array($_POST['hidden_id'], $item_id_list)){

        foreach($cart_data as $keys => $values){

            if($cart_data[$keys]["item_id"] == $_POST["hidden_id"]){

                $cart_data[$keys]["item_quantity"] = $cart_data[$keys]["item_quantity"] + $_POST["quantity"];
            }
        }
    }
    else{

        $item_array = array(
            'item_id'  => $_POST["hidden_id"],
            'item_name' => $_POST["hidden_name"],
            'item_price' => $_POST["hidden_price"],
            'item_quantity' => $_POST["quantity"]
        );

        $cart_data[] = $item_array;

    }

    $item_data = json_encode($cart_data);
    setcookie("shopping_cart", $item_data, time() + (86400 * 30));
    header("location:welcome.php?success=1");
}

if(isset($_GET["action"])){
    if($_GET["action"] == "delete"){
        $cookie_data = stripslashes($_COOKIE['shopping_cart']);
        $cart_data = json_decode($cookie_data, true);
        foreach($cart_data as $keys => $values){
            if($cart_data[$keys]['item_id'] == $_GET["id"]){
                unset($cart_data[$keys]);
                $item_data = json_encode($cart_data);
                setcookie('shopping_cart', $item_data, time() + (86400 * 30));
                header("location:welcome.php?remove=1");
            }
        }
    }
}

if(isset($_GET["remove"])){
    $message = '
    <div class="alert alert-success" role="alert">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    Item removed into Cart </div>';
}

    
if(isset($_GET['success'])){
            
    $message = '
    <div class="alert alert-success" role="alert">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    Item added into Cart </div>';

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,500;1,100;1,200;1,300;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./custom.css">
    <style>
        body {
            font: 14px sans-serif;
            text-align: center;
        }
    </style>
</head>


<nav class="navbar navbar-light bg-light">
  <form class="form-inline">
    <a href="employees.php" class="btn btn-outline-success">Quick & Easy</a>
    <a href="C.php" class="btn btn-sm btn-outline-secondary">Catogories</a>
    <a href="employees.php" class="btn btn-sm btn-outline-secondary">Products</a>
    <a href="employees.php" class="btn btn-sm btn-outline-secondary">Contact</a>
    <a href="employees.php" class="btn btn-sm btn-outline-secondary">Employee</a>
    <a href="employees.php" class="btn btn-sm btn-outline-secondary">Admin</a>
  </form>
</nav>

<body>
<div class="container">
    <h1 class="product-title">Products</h1>
<div class="table-div container">
    <h3 class="table-title">Order Details</h3>
    <?php echo $message;?>
    <table class="table table-bordered">
        <tr>
            <th class="table-col" width="40%">Item Name</th>
            <th class="table-col" width="10%">Quantity</th>
            <th class="table-col" width="20%">Price</th>
            <th class="table-col" width="15%">Total</th>
            <th class="table-col" width="5%">Action</th>
        </tr>
        <?php
        if(isset($_COOKIE['shopping_cart'])){

            $total = 0;
            $cookie_data = stripslashes($_COOKIE['shopping_cart']);
            $cart_data = json_decode($cookie_data, true);
            
            foreach($cart_data as $keys => $values){
             ?>
             <tr>
                    <td><?php echo $values["item_name"]; ?> </td> 
                    <td><?php echo $values["item_quantity"];?></td>
                    <td>$ <?php echo $values["item_price"];?></td>
                    <td>$ <?php echo number_format($values["item_quantity"] * $values["item_price"], 2);?></td>
                    <td> <a href="welcome.php?action=delete&id=<?php echo $values["item_id"];?>"><span class="text-danger">Remove</span></a></td>
             </tr>
             <?php 
                $total = $total + ($values["item_quantity"] * $values["item_price"]);
                }
            ?>
                <tr> 
                    <td colspan="3" align="right">Total</td>
                    <td align="right">$ <?php echo number_format($total, 2); ?>  
                </tr>

        <?php
        }else{
            echo '
            <tr>
                <td colspan="5" align="center">No Item in Cart"</td>
            <tr>
            ';
        }
        ?>
    </table>
    </div>
    <br/>
    <div class="container">
    <div class="row">

    <?php
    $query = "SELECT * FROM products ORDER BY product_id ASC";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll();

    foreach($result as $row){
        ?>
            <div class="product-container col-md-3">
                <form method="post">
                    <div class="inner-div">
                        <img src="./drink.png" class="img img-responsive"/>
                        <h4 class="product-name"><?php echo $row["product_name"];?></h4>
                        <h4 class="product-price"><?php echo $row["product_price"];?></h4>
                        <div class="quantity-container">
                        <span class="quality-text"> Quantity : </span>
                        <input type="text" name="quantity" value="1" class="quantity form-control"/>
                        </div>
                        <input type="hidden" name="hidden_name" value="<?php echo $row["product_name"]; ?>" />
                        <input type="hidden" name="hidden_price" value="<?php echo $row["product_price"]; ?>" />
                        <input type="hidden" name="hidden_id" value="<?php echo $row["product_id"]; ?>" />
                        <input type="submit" name="add_to_cart" value="Add to Cart" class=" add-cart-btn btn btn-success" style="margin-top:10px" />
                    </div>  
                </form>
            </div> 

        <?php
    }
    

    ?>
    </div>
    </div>


    <br />
  
 

    <h1 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to Quick & Easy.</h1>
    <h2 class="my-5">We are glad to have you!!</h2>

    <p class="my-5">
        <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
        <a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
    </p>

    <ul>
        <a href="employees.php" class="btn btn-primary">List all employees</a>
    
        <a href="addEmployee.php"class="btn btn-success ml-5">Add Employee</a>

    </ul>

</body>

</html>