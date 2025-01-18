<?php


include_once "head.php";
include_once "header.php";
?>



<div class="container my-md-4 my-2 pt-sm-5">
    <div class="row">
     
<div class="col-12 mt-sm-4">

<?php 

$translate = getCookieValue("translate");
if ($translate != 1) {
    echo $settings['in_eng'];
}else{
    echo $settings['in_urdu'];
}

?>

</div>
<div class="col-12">
<div class="search-order my-3">
    <div class="input-group mb-3">
        <input type="text" class="form-control shadow-none border-1" id="order-id" placeholder="Enter Order ID" aria-label="Recipient's username" aria-describedby="button-addon2" name="orderid">
        <button class="px-2 rounded-2 rounded-start-0 border-0 shadow-none color-search-icon" page="trackorder.php" id="button-addon2" search-order-with-cookie> Search</button>
    </div>
</div>
</div>
    </div>
</div>
<?php

$order_track = getCookieValue("searchOrder");
if ($order_track != null) {
    $order = getConditionData("orders","order_id",$order_track);
    $num = mysqli_num_rows($order);
    if($num > 0){
    while($row = mysqli_fetch_assoc($order)){
        $details = explode("**", $row['details']);
        $date = explode(" ", $row['created_at']);
        $qty = explode(",", $row['quantity']);
        $totalQty = 0;
        foreach($qty as $q){
            $totalQty += (int)$q;
        }
        $action = "<th scope=\"col\"><strong>Action</strong></th>";
        $actionValue = "<td>
        <form method=\"post\">
        <input type=\"hidden\" name=\"order_id\" value=\"$row[id]\">
            <button type=\"submit\" name=\"order-cancel\" class=\"btn btn-danger btn-sm\" >Cancel</button>
        </form>
        </td>";
        if ($row['status'] != "neworder") {
            $action = "";
            $actionValue = "";
        }
        
        echo "<div class=\"container\">
    <div class=\"row\">
        <div class=\"col-12\">
            <div class=\"table-responsive\">
            <table class=\"table table-bordered\">
                <thead>
                    <tr>
                    <th scope=\"col\"><strong>Order ID</strong></th>
                    <th scope=\"col\"><strong>Date</strong></th>
                    <th scope=\"col\"><strong>qty</strong></th>
                    <th scope=\"col\"><strong>Status</strong></th>
                    $action
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <td>$row[order_id]</td>
                    <td>$date[0]</td>
                    <td>$totalQty</td>
                    <td>$row[status]</td>
                    $actionValue
                    </tr>
                </tbody>
                </table>
            </div>
        </div>
        <div class=\"col-12 mt-1\">
            <div class=\"table-responsive\">
            <table class=\"table table-bordered\">
                <thead>
                    <tr>
                    <th scope=\"col\"><strong>Name</strong></th>
                    <th scope=\"col\"><strong>Number</strong></th>
                    <th scope=\"col\"><strong>Email</strong></th>
                    <th scope=\"col\"><strong>Address</strong></th>
                    <th scope=\"col\"><strong>City</strong></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <td>$details[0]</td>
                    <td>$details[2]</td>
                    <td>$details[1]</td>
                    <td>$details[3]</td>
                    <td>$details[4]</td>
                    </tr>
                </tbody>
                </table>
            </div>
        </div>
        <div class=\"col-12 mt-1\">
            <div class=\"table-responsive\">
            <table class=\"table table-bordered\">
                <thead>
                    <tr>
                    <th scope=\"col\"><strong>#</strong></th>
                    <th scope=\"col\"><strong>Name</strong></th>
                    <th scope=\"col\"><strong>Price</strong></th>
                    <th scope=\"col\"><strong>Qty</strong></th>
                    <th scope=\"col\"><strong>Image</strong></th>
                    </tr>
                </thead>
                <tbody>";

                $product = explode(",", $row['product_ids']);
                $count = 1;
                $total_price = 0;
                foreach ($product as $index => $id) {
                    $result = getOrderData("products", "$id");
                    $details = mysqli_fetch_assoc($result);
                    $total_price += $details['price'] * $qty[$index];
                    $image = explode(",",$details['images']);
                echo"<tr>
                    <td>$count</td>
                    <td>$details[name]</td>
                    <td>$details[price]</td>
                    <td>$qty[$index]</td>
                    <td><img src=\"$proimagesrc/$image[0]\" width=\"40px\" height=\"40px\"></td>
                    </tr>   
                ";
                $count++;
                }

                echo"</tbody>
                </table>
            </div>
        </div>
        <div class=\"col-12 mt-1 d-flex justify-content-end align-items-center gap-2\">
        <span class=\"fw-bold h4  bg-white rounded-3 px-3\">Total Price: $total_price</span> 
        </div>
    </div>
</div>";

}
    }else{
        echo "<h1 class=\"text-center my-5\">No Order Found</h1>";
    }
}


?>



<?php
include_once "footer.php";
?>
