<?php
function isUserLoggedIn()
{
    if (isset($_SESSION['user_id'])) {
        if ($_SESSION['user_id'] != '0') {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

// require to sign in to use that function/page so user_id can set
function requireLogin()
{
    if (!isUserLoggedIn()) {
        header("Location: home.php");
        exit();
    }
}
// only for login page if it have been login it should not open again
function redirectiflogin()
{
    if (isUserLoggedIn()) {
        header("Location: admin_orders.php");
        exit();
    }
}


// Function to authenticate user login
function loginUser($email, $password)
{
    global $db;
    // Open database connection
    DBConnect("1");

    // Sanitize inputs to prevent SQL injection
    $email = mysqli_real_escape_string($db, $email);
    $password = mysqli_real_escape_string($db, $password);

    // Fetch user details from the database based on the username
    $sql = "SELECT * FROM `settings` WHERE `email` = '$email'";
    $result = mysqli_query($db, $sql);

    // Check if the query was successful
    if ($result) {
        $userDetails = mysqli_fetch_assoc($result);

        // Verify the password
        if ($userDetails && password_verify($password, $userDetails['password'])) {
        // if ($userDetails && $password === $userDetails['password']) {
            // Password is correct
            $_SESSION['user_id'] = $userDetails['id'];
            
        } else {
            // Invalid username or password
            // header('location: admin_orders.php');
            echo "Invalid username or password ";

        }
    } else {
        // Handle query error
        echo "Error executing query: " . $db->error;

    }

    // Close database connection
    DBConnect("0");
}
function settings($check){
if ($check === "1") {
    global $db;
    DbConnect("1");
    $sql = "SELECT * FROM `settings`";
    $result = mysqli_query($db,$sql); 
    DbConnect("0");
    if ($result) {
        return $result;
    }else{
        echo "Error: " . $sql . "<br>" . $db->error;
    }

}else{
    return;
}
}

function limitedData($table, $limit){
    global $db;
    DbConnect("1");
    $sql = "SELECT * FROM `$table` WHERE `deleted_at` IS NULL  LIMIT $limit";
    $result = mysqli_query($db,$sql); 
    DbConnect("0");
    if ($result) {
        return $result;
    }else{
        echo "Error: " . $sql . "<br>" . $db->error;
    }
}


function getAllData($table){
    global $db;
    DbConnect("1");
    $sql = "SELECT * FROM `$table` WHERE `deleted_at` IS NULL";
    $result = mysqli_query($db,$sql); 
    DbConnect("0");
    if ($result) {
        return $result;
    }else{
        echo "Error: " . $sql . "<br>" . $db->error;
    }

}
function getAllOrderData($table){
    global $db;
    DbConnect("1");
    $sql = "SELECT * FROM `$table` WHERE `deleted_at` IS NULL ORDER BY `id` DESC";
    $result = mysqli_query($db,$sql); 
    DbConnect("0");
    if ($result) {
        return $result;
    }else{
        echo "Error: " . $sql . "<br>" . $db->error;
    }

}
function getAllDataAdmin($table){
    global $db;
    DbConnect("1");
    $sql = "SELECT * FROM `$table`";
    $result = mysqli_query($db,$sql); 
    DbConnect("0");
    if ($result) {
        return $result;
    }else{
        echo "Error: " . $sql . "<br>" . $db->error;
    }
}


function getIdData($tableToGet, $id)
{

    global $db;
    DbConnect("1");
    $sql = "SELECT * FROM $tableToGet WHERE `id` = '$id' AND deleted_at IS NULL";
    $result = mysqli_query($db,$sql);

    if ($result) {
        return $result;
    } else {
        echo "Error: " . $sql . "<br>" . $db->error;
    }

    DbConnect("0");
}


function getbrandname($tableToGet, $id)
{

    global $db;
    DbConnect("1");
    $sql = "SELECT * FROM $tableToGet WHERE `id` = '$id';";
    $result = mysqli_query($db,$sql);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        return $row['name'];
    } else {
        echo "Error: " . $sql . "<br>" . $db->error;
    }

    DbConnect("0");
}


function getOrderData($tableToGet, $id)
{

    global $db;
    DbConnect("1");
    $sql = "SELECT * FROM $tableToGet WHERE `id` = '$id';";
    $result = mysqli_query($db,$sql);

    if ($result) {
        return $result;
    } else {
        echo "Error: " . $sql . "<br>" . $db->error;
    }

    DbConnect("0");
}



// get data from an unique match
function getConditionData($tableToGet, $colname, $condition)
{

    global $db;
    DbConnect("1");
    $sql = "SELECT * FROM $tableToGet WHERE $colname = '$condition' AND deleted_at IS NULL";
    $result = mysqli_query($db, $sql);

    if ($result) {
        return $result;
    } else {
        echo "Error: " . $sql . "<br>" . $db->error;
    }

    DbConnect("0");
}

// get data from an unique match
function getFilter($cat, $minPr, $maxPr)
{

    global $db;
    DbConnect("1");
    $sql = "SELECT * FROM `products` WHERE `brand_id` = '$cat' AND `price` >= '$minPr' AND `price` <= '$maxPr' AND deleted_at IS NULL";
    $result = mysqli_query($db, $sql);

    if ($result) {
        return $result;
    } else {
        echo "Error: " . $sql . "<br>" . $db->error;
    }

    DbConnect("0");
}

// get max price product
function getMaxPrice()
{
    global $db;
    DbConnect("1");
    $sql = "SELECT * 
FROM `products` 
WHERE `price` = (SELECT MAX(price) FROM `products` WHERE `deleted_at` IS NULL) 
  AND `deleted_at` IS NULL;
;";
    $result = mysqli_query($db, $sql);

    if ($result) {
        return $result;
    } else {
        echo "Error: " . $sql . "<br>" . $db->error;
    }

    DbConnect("0");
}

// cookies data
function getCookieValue($name) {
    return isset($_COOKIE[$name]) ? $_COOKIE[$name] : null;
}


// place order by cookies
function orderPlace($details,$ids,$quantities)
{
    global $db;
    DbConnect("1");

    $pro = explode(",",$ids);
    foreach ($pro as $index => $val) {
        $sql = "SELECT * FROM `products` WHERE `id` = '$val';";
        $result = mysqli_query($db,$sql);
        $row = mysqli_fetch_assoc($result);
        
        if ($row['qty'] > 1) {
            $sql1 = "UPDATE `products` SET `qty` = `qty` - 1 WHERE `id` = '$val';";
        } else {
            $sql1 = "UPDATE `products` SET `deleted_at` = CURRENT_TIMESTAMP() WHERE `id` = '$val';";
        }
        $result1 = mysqli_query($db, $sql1);
    }
    $sql = "INSERT INTO `orders` (`user_id`, `product_ids`, `quantity`, `details`, `status`) VALUES ('1', '$ids', '$quantities', '$details ', 'neworder');";
    $result = mysqli_query($db,$sql);

    if ($result) {
        $id = mysqli_insert_id($db);
        $code = rand(100000, 999999);
        $order_code = $id."-".$code;
        $order_id = "order-".$id."_".$code;
        $reffer = getCookieValue("reffer");
        $sql = "UPDATE `orders` SET `order_id` = '$order_id',`reffer_id` = '$reffer' WHERE `id` = '$id'";
        $result = mysqli_query($db,$sql);
        if ($result) {
            $message = "Thank you for your order! Your order has been placed successfully. Your Order ID is: <strong id=\"order-id\"> $order_id</strong>. We will send you an email confirmation shortly.";
            setCookieValue("alert_msg", $message, 3650000);
            // $userdetails = explode("**", $details);
            // $emailmessage = "Thank you for your order! Your Order ID is <strong>$order_id</strong>";

            // sendText("Order Place", $userdetails[0], $userdetails[1], "Place Order", $emailmessage);
        }
        header("Location: index.php");
    } else {
    echo "Error: " . $sql . "<br>" . $db->error;
    }

DbConnect("0");
}




function translate(){
    $translate = getCookieValue("translate");
if ($translate != 1) {
    setCookieValue("translate", '1', 3650000);
}else{
    setCookieValue("translate", 2, 3650000);
}
    header('location: trackorder.php');
}

function setCookieValue($name, $value, $expire = '300000') {
    setcookie($name, $value, time() + $expire, '/');
}


function cancelOrder($id){
    global $db;
    DbConnect("1");
    $sql = "SELECT * FROM `orders` WHERE `id` = '$id';" ;
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_assoc($result);
    $pro = explode(",",$row['product_ids']);
    foreach ($pro as $index => $val) {
        $sql = "SELECT * FROM `products` WHERE `id` = '$val';";
        $result = mysqli_query($db,$sql);
        $row = mysqli_fetch_assoc($result);
        
        if (is_null($row['deleted_at'])) {
            $sql1 = "UPDATE `products` SET `qty` = `qty` + 1 WHERE `id` = '$val';";
        } else {
            $sql1 = "UPDATE `products` SET `deleted_at` = NULL WHERE `id` = '$val';";
        }
        $result1 = mysqli_query($db, $sql1);
    }
    $sql = "UPDATE `orders` SET `status` = 'cancelled' WHERE `id` = '$id'";
    $result = mysqli_query($db,$sql);
    if ($result) {
        
        setCookieValue("alert_msg", "Order has been cancelled!",1);
        header("Location: trackorder.php");
    }else{
        echo "Error: " . $sql . "<br>" . $db->error;
    }
    DbConnect("0");
}


    function addReffer($val){
        global $db;
        DbConnect("1");
        $sql = "INSERT INTO `refference` (`name`) VALUES ('$val')";
        $result = mysqli_query($db, $sql);
        $id = mysqli_insert_id($db);
        $uid = 1000 + $id;
        $sql = "UPDATE `refference` SET `uid` = '$uid' WHERE `id` = '$id';";
        $result = mysqli_query($db, $sql);
        if ($result) {
            header('location: admin_reffer.php');
        }else{
            echo "Error: " . $sql . "<br>" . $db->error;
        }
        DbConnect("0");
    }

    function deleteId($tableToGet, $id,$page)
{
    global $db;
    DbConnect("1");

    // Escape user inputs to prevent SQL injection
    $tableToGet = mysqli_real_escape_string($db, $tableToGet);
    $id = mysqli_real_escape_string($db, $id);
    $page = mysqli_real_escape_string($db, $page);
   

        if ($tableToGet != "refference") {
            if ($page != "admin_brand.php") {
            $sql = "SELECT `images` FROM `$tableToGet` WHERE `id` = '$id';";
            $result = mysqli_query($db, $sql);

            $row = mysqli_fetch_assoc($result);
            global $proimagesrc;
            $imageFiles = explode(',', $row['images']);
            foreach ($imageFiles as $image) {
                $imagePath = $proimagesrc . "/" . trim($image);
                if (file_exists($imagePath)) {
                    if (unlink($imagePath)) {
                        $sql = "DELETE FROM $tableToGet WHERE `id` = '$id'";
                        mysqli_query($db, $sql);
                        header('location:'.$page);
                    }else {
                        echo "Error deleting the file.";
                    }
                } 
            }
            }else{
            $sql = "SELECT `image` FROM `$tableToGet` WHERE `id` = '$id';";
            $result = mysqli_query($db, $sql);

            $row = mysqli_fetch_assoc($result);
            global $catimagesrc;
            $imagePath = $catimagesrc ."/". $row['image'];
            if (file_exists($imagePath)) {
                // Delete the file from the folder
                if (unlink($imagePath)) {
                    $sql = "DELETE FROM $tableToGet WHERE `id` = '$id'";
                    mysqli_query($db, $sql);
                    header('location:'.$page);
                }else {
                        echo "Error deleting the file.";
                    }
                }
        }

            
        }else{
            $sql = "DELETE FROM $tableToGet WHERE `id` = '$id'";
            mysqli_query($db, $sql);
            header('location:'.$page);
        }


    DbConnect("0");
}


function addBrand($name,$image){
    global $db;
    DbConnect("1");

    $name = mysqli_real_escape_string($db, $name);

    if ($image != "") {
        $sql = "INSERT INTO `brand` (`name`,`image`) VALUES ('$name','$image')";
    }
    if (mysqli_query($db, $sql) === TRUE) {
        header('location:admin_brand.php');
    } else {
        echo "Error: " . $sql . "<br>" . $db->error;
    }

    DbConnect("0");
}



function addProduct($name,$cost,$discount,$price,$qty,$brand,$desc,$image){
    global $db;
    DbConnect("1");

    $name = mysqli_real_escape_string($db, $name);
    $cost = mysqli_real_escape_string($db, $cost);
    $discount = mysqli_real_escape_string($db, $discount);
    $price = mysqli_real_escape_string($db, $price);
    $qty = mysqli_real_escape_string($db, $qty);
    $brand = mysqli_real_escape_string($db, $brand);
    $desc = mysqli_real_escape_string($db, $desc);
    $image = mysqli_real_escape_string($db, $image);

    if ($image != "") {
        $sql = "INSERT INTO `products` (`name`,`cost`,`discounted`,`price`,`brand_id`,`images`,`description`,`qty`) VALUES ('$name','$cost','$discount','$price','$brand','$image','$desc','$qty')";
    }
    if (mysqli_query($db, $sql) === TRUE) {
        header('location:admin_product.php');
    } else {
        echo "Error: " . $sql . "<br>" . $db->error;
    }

    DbConnect("0");
}


function update_status($id, $status)
{
    global $db;
    DbConnect("1");
    $id = mysqli_real_escape_string($db, $id);
    $status = mysqli_real_escape_string($db, $status);

    
    $sql = "UPDATE orders SET `status` = '$status', `modify_at` = current_timestamp() where `id` = '$id';";
    
    if (mysqli_query($db, $sql) === TRUE) {
        
            header('location: admin_order.php');
    }else {
        echo "Error: " . $sql . "<br>" . $db->error;
    }

    DbConnect("0");
}




function cancel_order($id){
    global $db;
    DbConnect("1");
    $sql = "SELECT * FROM `orders` WHERE `id` = '$id';" ;
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_assoc($result);
    $pro = explode(",",$row['product_ids']);
    foreach ($pro as $index => $val) {
        $sql = "SELECT * FROM `products` WHERE `id` = '$val';";
        $result = mysqli_query($db,$sql);
        $row = mysqli_fetch_assoc($result);
        
        if (is_null($row['deleted_at'])) {
            $sql1 = "UPDATE `products` SET `qty` = `qty` + 1 WHERE `id` = '$val';";
        } else {
            $sql1 = "UPDATE `products` SET `deleted_at` = NULL WHERE `id` = '$val';";
        }
        $result1 = mysqli_query($db, $sql1);
    }
    $sql = "UPDATE orders SET `status` = 'cancelled', `modify_at` = current_timestamp() where `id` = '$id';";
    $result = mysqli_query($db,$sql);
    if ($result) {
        
        header("Location: admin_order.php");
    }else{
        echo "Error: " . $sql . "<br>" . $db->error;
    }
    DbConnect("0");
}