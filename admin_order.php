<?php

include_once "admin_head.php";
setuppage();
include_once "admin_header.php";



if (isset($_GET["id"])) {
    // storing  order and user detail in variables for later use
    $id = $_GET["id"];
    $result = getidData("orders", "$id");
    $order = mysqli_fetch_assoc($result);
    $user_id = $order['user_id'];
    $product_id = explode(",", $order['product_ids']);
    $user = mysqli_fetch_assoc($result);
} else {
    // redirect if id is not provided
    header('location:admin_orders.php');
}

?>


</style>


<div class="container my-4">
    <div class="row">
        <div class="col-sm-6 col-xs-12 C-details">
            <h3>Customer Details:</h3>
            <hr>
            <?php 

        
            $data = explode("**", $order['details']);
            echo" <div>
            <p> <b>Name:</b>
                $data[0]
            </p>
        </div>
        <div>
            <p> <b>Address:</b>
                $data[3],$data[4]
            </p>
        </div>
        <div>
            <p> <b>Phone:</b>
                 $data[2]
            </p>
        </div>
        <div>
            <p> <b>Email:</b>
                $data[1]
            </p>
        </div>
        <div>
            <p> <b>Desc:</b>
                $data[5]
            </p>
        </div>";
        ?>
        </div>
        <div class="col-xs-12 col-sm-6 O-details ">
            <h3>Order Details:</h3>
            <hr class="lead">
            <div class="row">
                <div class="col-xs-12 ">
                    <p>
                        <b>Order Id:</b>
                        <?php echo $order['order_id']; ?>
                    </p>
                </div>
                <div class="col-xs-12 no-print">
                    <p>
                        <b>Refference:</b>
                        <?php
                        if ($order['reffer_id'] != 0) {
                        $reffer_id =  getConditionData("refference","uid",$order['reffer_id']);
                        if(mysqli_num_rows($reffer_id) > 0){
                        $reffer = mysqli_fetch_assoc($reffer_id);
                            echo $reffer['name'];
                        }else{
                            echo "no reffer";
                        }
                        }else{
                            echo "no reffer";
                        }
                    
                        ?>
                    </p>
                </div>
                <div class="col-xs-12 ">
                    <p>
                        <b>Status:</b>
                        <?php echo $order['status']; ?>
                    </div>
                    <?php
                        if ($order['status'] == "cancelled" || $order['status'] == "completed") {

                        }else{
                            echo "<div class=\" col-12 no-print\">
                            <form action=\"#\" method=\"post\">

                            <p style=\"display:inline;\"> <B>Update status to </B></p>
                        <input type=\"hidden\" name=\"id\" value=\"$order[id]\">
                        <div class=\"row mt-10\">
                            <div class=\"col-8\">";
                            
                            $processing_input = "";
                            $hold_input = "";
                            $shipped_input = "";
                                $complete_input = "";


                                // checking values & assign value
                                if ($order['status'] == "neworder") {
                                    $processing_input = "selected";
                                }
                                if ($order['status'] == "processing") {
                                    $hold_input = "selected";
                                }
                                if ($order['status'] == "completed") {
                                    $complete_input = "selected";
                                }
                                echo "
                            <select name=\"status\" class=\"form-control shadow-none\">";
                            if($order['status'] == "processing"){
                            echo "
                            <option $complete_input value=\"completed\">Completed</option>";
                        }else{
                            echo "
                            <option $processing_input value=\"processing\">processing</option>
                            <option $complete_input value=\"completed\">Completed</option>";
                        }
                            echo"</select>

                            </div>
                            <div class=\"col-4\">
                            <input type=\"submit\" class=\"btn btn-primary form-control\" name=\"update_status\">
                            </div>
                        </div>
                    </form>
                    <div>
                    <form method=\"post\">
                    <input type=\"hidden\" name=\"id\" value=\"$order[id]\">
                        <button type=\"submit\" class=\"btn btn-danger lead mt-3\" name=\"cancel_order\">
                    Cancel order
                    </button>
                    </form>

                        </div>";
                    }
                    ?>
                </div>
            </div>
            </div>
        <div class="col-xs-12 ">
            <div class="table-responsive mt-20">
                <table class="table mt-20">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>price</th>
                            <th>Quantity</th>
                            <th>Total price</th>
                            <!-- <th>color</th>
                        <th>size</th> -->
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $total_grant_price = 0;
                        foreach ($product_id as $index => $id) {
                            $result = getOrderData("products", "$id");
                            $product = mysqli_fetch_assoc($result);
                            $quantity = explode(",", $order['quantity']);
                            $total_price = $product['price'] * $quantity[$index];
                            $total_grant_price += $total_price;
                            $products = explode(",", $product['images']);
                            echo "
                        <tr>
                        <td>  <img src=\"$proimagesrc/" . $products[0] . " \"/ style=\" width:50px; height:50px; \" ></td>
                        <td>" . $product['name'] . "</td>
                        <td>" . $product['price'] . "</td>
                        <td>" . $quantity[$index] . "</td>
                        <td>" . $total_price . "</td>
                        </tr>
                        ";
                        }
                        // <td> <span style=\" height:25px; width:25px; box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.3); display:block; background-color: " . $product_color[$index] . ";\"></span></td>
                        // <td>" . $product_size[$index] . "</td>
                        
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <hr>
    <div class="row">
        <div class="col-xs-6 mt-10 no-print lead">
            <button onclick="window.print()" class="btn btn-primary">Print</button>
        </div>
        <div class="col-xs-6 text-right mb-5  mt-3 lead grand-price">
            <strong>Total Grant Price:</strong> <span>
                <?php echo $total_grant_price ?>
            </span>
        </div>
    </div>
</div>






<?php

include_once "admin_foot.php";
?>