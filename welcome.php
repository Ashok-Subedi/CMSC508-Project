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
    Item removed from Cart </div>';
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/6c05c045f0.js" crossorigin="anonymous"></script>
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


<body>
<div id="wrapper"> 

    <div id="sidebar-wrapper">
        <ul class="sidebar-nav">
            <a href="welcome.php" class="home-link">
                    <div class="home-img-wrapper">
                        <img src="./img/logoimg.png" class="img" alt="profile pic"/>
                    </div>
            </a>
            <a href="welcome.php" class="profile-link">
                <div class="profile-container">
                    <div class="profile-img-wrapper">
                        <img src="./img/profile.png" class="img" alt="profile pic"/>
                    </div>
                    <span class="username"><?php echo htmlspecialchars($_SESSION["username"]); ?></span>
                </div>
            </a>
            <li><a class="active product" href="welcome.php" ><i class="fa-solid fa-bag-shopping icon-active"></i>Products</a></li>
            <li><a href="contact.php"><i class="fa-solid fa-envelope"></i>Contact</a></li>
            <li><a href="user.php"><i class="fa-solid fa-user"></i>User</a></li>
            <li><a href="index.php"><i class="fa-solid fa-user-lock"></i>Admin</a></li>
            <a class="logout-link" href="index.php"><i class="fa-solid fa-arrow-right-from-bracket"></i>Logout</a>


        </ul>
    </div>

    <div id="product-content" class="main-content container-fluid">
       
        <div class="container">
            <div class="toggle-btn-container">
                <a href="#" id="menu-toggle"><i class="fa-solid fa-bars"></i></a>
            </div>

            <h1 class="product-title">Products</h1>

        </div>
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
                            <td colspan="3" align="right" style="padding-top: 25px; font-weight: 700">Total</td>
                            <td align="center"  style="padding-top: 25px">$ <?php echo number_format($total, 2); ?>  </td>
                            <td><a align="right" class="btn btn-success">Checkout</a></td>
                            
                        </tr>
                <?php
                }else{
                    echo '
                    <tr>
                        <td colspan="5" align="center">No Item in Cart</td>
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
    </div>
</div>


    <!-- Menu toggle script -->
    <script>
        $("#menu-toggle").click(function (e) {
            e.preventDefault();
            $("#wrapper").toggleClass("menu-shown");
        });
    </script>

</body>

</html>