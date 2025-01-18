<?php


include_once "$currentURL/core/db.php";
include_once "$currentURL/core/function.php";
// include_once "$currentURL/core/email.php";
startSessionIfNeeded();

$imagesrc = "assets/images";
$catimagesrc = "assets/images/category";
$proimagesrc = "assets/images/product";

$store_settings = settings("1");
$settings = mysqli_fetch_assoc($store_settings);


function startSessionIfNeeded()
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
}

function setuppage()
{
    startSessionIfNeeded();
    requireLogin();
}

if (isset($_POST['adminLogin'])) {
    $password = $_POST['password'];
    loginUser("theroyal.info4u@gmail.com", $password);
}

if (isset($_POST['header_confirm'])) {
    header('location: confirmation.php');
}


if (isset($_POST['place_order'])) {

    orderPlace($_POST['cookie_details'], $_POST['cookie_ids'], $_POST['cookie_quantiy']);
}

if (isset($_POST['order-cancel'])) {
    cancelOrder($_POST['order_id']);
}
if(isset($_POST['cart'])){
    header('location: cart.php');
}

if (isset($_POST['translate'])) {
    translate();
}

if (isset($_POST['add_reffer'])) {
    addReffer($_POST['reffer_val']);
}

if (isset($_POST['delete_id'])) {

    if (isset($_POST['id']) && $_POST['id'] != '') {
        deleteId($_POST['name'], $_POST['id'], $_POST['page']);
    }

}

if (isset($_POST['add_brand'])) {
    global $catimagesrc;
    $file_name = $_FILES['image']['name'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $image = $currentURL ."/". $catimagesrc . "/" . $file_name;
    $th = move_uploaded_file($file_tmp, $image);
    if ($file_name != "") {
        addBrand($_POST["name"], $file_name);
        return;
    }
}


if (isset($_POST['add_product'])) {
    global $proimagesrc;

    $imageNames = [];
    foreach ($_FILES['image']['name'] as $key => $file_name) {
        $file_tmp = $_FILES['image']['tmp_name'][$key];

        // Set the path for saving the image
        $imagePath = $currentURL ."/".$proimagesrc . "/" . $file_name;

        // Move the uploaded file to the designated path
        $th = move_uploaded_file($file_tmp, $imagePath);

        // Add the filename to the array if the upload is successful
        if ($th && $file_name != "") {
            $imageNames[] = $file_name;
        }
    }
    if (!empty($imageNames)) {
        $imageNamesString = implode(',', $imageNames);

        // Save the comma-separated filenames string to the database
        addProduct($_POST["name"],$_POST["cost"],$_POST["discount"],$_POST["price"],$_POST["qty"],$_POST["brand"],$_POST["desc"], $imageNamesString); 
    }
}


if (isset($_POST['update_status'])) {
    if (isset($_POST['id']) && $_POST['id'] != '') {
        update_status($_POST['id'], $_POST['status']);
    }
}

if (isset($_POST['cancel_order'])) {
    cancel_order($_POST['id']);
}