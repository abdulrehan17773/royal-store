

<?php 
include_once "head.php";
include_once "header.php";


$allDetails = getCookieValue("cookiesOrderDetails");
$product_Details = getCookieValue("cartProduct");


// /////////////////////////////////////////////

if ($product_Details) {
    $product_array = explode(",", $product_Details);

    $ids = [];
    $quantities = [];

    foreach ($product_array as $product) {
        $detail = explode("**", $product);
        $product_id = $detail[0];
        $quantity = $detail[1];
        $result = getIdData("products", $product_id);

        // Check if product is not deleted (deleted_at is null)
        // Assuming you have a function `isProductDeleted` that checks this
        if (mysqli_num_rows($result) > 0) {
            $ids[] = $product_id;
            $quantities[] = $quantity;
        }
    }

    // Convert arrays to comma-separated strings
    $ids_string = implode(",", $ids);
    $quantities_string = implode(",", $quantities);
    echo $ids_string;
    echo $quantities_string;
    // If either ids or quantities is empty, redirect to the cart page and delete the cookie
    if (empty($ids) || empty($quantities)) {
        // Delete the cartProduct cookie
        setcookie("cartProduct", "", time() - 3600, "/"); // Sets the cookie to expire in the past

        // Redirect to the cart page
        header("Location: /cart.php"); // Adjust the URL to your cart page
        exit;
    }

} else {
    // Redirect to the cart page if no cookie is found
    header("Location: /cart.php");
    exit;
}

// Function to check if product is deleted
function isProductDeleted($product_id) {
    global $db;
    DbConnect("1");
    $sql = "SELECT * FROM products WHERE id = $product_id";
    $res = mysqli_query($db, $sql);
    $row = mysqli_fetch_assoc($res);
    DbConnect("0");
    if ($row['deleted_at'] != null) {
        return false; 
    }else{
        return true; 
    }
}

// /////////////////////////////////

?>
<!-- Confirmation message -->
<div class="container my-5 pt-md-5">
    <div class="row">
        <div class="col-12 text-center">
            <h2>Are you confirm to place order?</h2>
        </div>
        <div class="col-12 text-center mt-3">
            <form method="post" id="orderForm">
                <span class="btn btn-danger rounded-1 me-3" page="cart.php" >Not now</span>
                <input type="hidden" name="cookie_details" value="<?php echo $allDetails ?>">
                <input type="hidden" name="cookie_ids" value="<?php echo $ids_string ?>">
                <input type="hidden" name="cookie_quantiy" value="<?php echo $quantities_string ?>">
                <button class="btn btn-success rounded-1 ms-3" name="place_order" type="submit" id="confirmation" cart-order-place>Confirm</button>
            </form>
        </div>
    </div>
</div>

<hr>
<!-- show products -->
<div class="container-md  mb-5">
    <div class="row">
        <div class="col-12 mt-3">
            <h4>Order Details</h5>
        </div>
        <div class="col-12">
            <div class="row">
                <?php 
                $details = explode("**", $allDetails)
                ?>
                <div class="col-lg-3 col-sm-4 col-6">
                    <input type="text" class="form-control mt-2 rounded 1" value="<?php echo $details[0] ?>" disabled>
                </div>
                <div class="col-lg-3 col-sm-4 col-6">
                    <input type="text" class="form-control mt-2 rounded 1" value="<?php echo $details[1] ?>" disabled>
                </div>
                <div class="col-lg-3 col-sm-4 col-6">
                    <input type="text" class="form-control mt-2 rounded 1" value="<?php echo $details[2] ?>" disabled>
                </div>
                <div class="col-lg-3 col-sm-4 col-6">
                    <input type="text" class="form-control mt-2 rounded 1" value="<?php echo $details[4] ?>" disabled>
                </div>
                <div class="col-lg-6 col-sm-8 col-12">
                    <input type="text" class="form-control mt-2 rounded 1" value="<?php echo $details[3] ?>" disabled>
                </div>
            </div>
        </div>
    </div>
</div>





<?php
include_once "footer.php";
?>