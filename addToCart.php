<?php
session_start();

// Database connection
$conn = new mysqli("localhost", "root", "", "quantify");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if (!isset($_SESSION['cartId'])) {

    $cartId = uniqid('cart_');
    $_SESSION['cartId'] = $cartId;


    $dateCreated = date('Y-m-d H:i:s');
    $sqlInsertCart = "INSERT INTO cart (Cart_ID, Date_Created) VALUES ('$cartId', '$dateCreated')";

    if ($conn->query($sqlInsertCart) !== TRUE) {
        echo "Error creating cart: " . $conn->error;
        exit;
    }
} else {
    $cartId = $_SESSION['cartId'];
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productId = $_POST('productId');
    $productName = $_POST['productName'];
    $quantity = $_POST['productQuantity'];


   $sqlCheckItem = "SELECT * FROM cartitem WHERE Cart_ID = '$cartId' AND Product_Name = '$productName'";
   $resultCheckItem = $conn->query($sqlCheckItem);

   if ($resultCheckItem->num_rows > 0) {
       $sqlUpdateQuantity = "UPDATE cartitem SET Quantity = Quantity + $productQuantity WHERE Cart_ID = '$cartId' AND Product_Name = '$productName'";

       if ($conn->query($sqlUpdateQuantity) !== TRUE) {
           echo "Error updating quantity: " . $conn->error;
           exit;
       }
   } else {
       $cartItemId = uniqid('item_'); 
       $sqlInsertItem = "INSERT INTO cartitem (CartItemID, Cart_ID, Product_Name, Quantity) VALUES ('$cartItemId', '$cartId', '$productName', $productQuantity)";

       if ($conn->query($sqlInsertItem) !== TRUE) {
           echo "Error adding item to cart: " . $conn->error;
           exit;
       }
   }

   header("Location: index.php");
   exit;
} else {
   echo "Invalid request method.";
   exit;
}


$conn->close();
?>