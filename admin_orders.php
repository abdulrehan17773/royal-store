<?php

include_once "admin_head.php";
setuppage();
include_once "admin_header.php";
?>



<section>
        <div class="container-lg my-4">
            <div class="row text-center">
                <div class="col-12 mt-4">
                        <div class="table-responsive" >
                            <table class="table text-center table-bordered table-stripped" id="orderTable">
                                <thead>
                                    <tr>
                                        <th class="text-center">Order ID</th>
                                        <th class="text-center">Date</th>
                                        <th class="text-center">Total Pc</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $all_orders = getAllOrderData("orders");
                                    $label = "";
                                    while ($row = mysqli_fetch_assoc($all_orders)) {
                                        if ($row['status'] == "processing") {
                                            $label = "bg-primary";
                                        } elseif ($row['status'] == "completed") {
                                            $label = "bg-success";
                                        } elseif ($row['status'] == "cancelled") {
                                            $label = "bg-danger";
                                        } else if($row['status'] == "neworder"){
                                            $label = "bg-secondary";
                                        }
                                        $date = explode(" ",$row['created_at']);
                                        $dates = explode("-", $date[0]);
                                        $newdate = $dates[2] ."/". $dates[1] ."/". $dates[0]; 
                                        $quantity = explode(",",$row['product_ids']);
                                        $qty = sizeof($quantity);

                                        echo "<tr>
                                        <td>$row[order_id]</td>
                                        <td>$newdate</td>
                                        <td>$qty</td>
                                        <td><span class=\"$label rounded-2 py-1 px-2\">$row[status]</span></td>
                                        <td><a href=\"admin_order.php?id=$row[id]\" class=\"btn btn-dark\">View</a></td>
                                        </tr>";
                                    }

                                    ?>
                                </tbody>
                            </table>
                        </div>
                </div>
            </div>
        </div>
    </section>


    
<?php

include_once "admin_foot.php";
?>

   






