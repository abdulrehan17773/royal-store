<?php

include_once "admin_head.php";
setuppage();
include_once "admin_header.php";
?>



<section>
        <div class="container-lg my-4">
            <div class="row text-center">
                <div class="mt-2 col-sm-3 col-6 p-0" >
                    <button class="filter btn btn-secondary" data-status="neworder">New Order <br><span id="newOrder">(No)</span></button>
                </div>
                <div class="mt-2 col-sm-3 col-6 p-0" >
                    <button class="filter btn btn-primary" data-status="processing">Processing <br><span id="processing">(No)</span></button>
                </div>
                <div class="mt-2 col-sm-3 col-6 p-0">
                    <button class="filter btn btn-success" data-status="completed">Completed <br><span id="completed">(No)</span></button>
                </div>
                <div class="mt-2 col-sm-3 col-6 p-0">
                    <button class="filter btn btn-danger" data-status="cancelled">Cancelled <br><span id="cancelled">(No)</span></button>
                </div>
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

    <script>
    // variable for the orders to show total numbers

    var new_order = 0;
    var shipped = 0;
    var processing = 0;
    var cancelled = 0;
    var completed = 0;
    var on_hold = 0;

    // vanila js ajax call for table data in ordere page
    document.addEventListener("DOMContentLoaded", function() {


        function fetchOrders(status) {
            fetch("GetData.php?getorder=true&status=" + status)
                .then((response) => response.json())
                .then((data) => {
                    updateTable(data);
                    if (status == "all") {
                        updateOrderCount();
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                });
        }
setTimeout(function() {
    fetchOrders('neworder');
},500);
        function updateTable(data) {
            var tableBody = document
                .getElementById("orderTable")
                .getElementsByTagName("tbody")[0];
            tableBody.innerHTML = ""; // Clear existing table rows
            data.forEach(function(order) {
                var products = addValues(order.product_ids);
                // var price = addValues(order.product_price);

                if (order.status == "processing") {
                    var label = "bg-primary";
                    processing++;
                } else if (order.status == "completed") {
                    var label = "bg-success";
                    completed++;
                } else if (order.status == "cancelled") {
                    var label = "bg-danger";
                    cancelled++;
                } else if(order.status == "neworder"){
                    var label = "bg-secondary";
                    new_order++;
                }
                let date = order.created_at.split(" ");
                let dates = date[0].split("-");
                let newdate = dates[2] + "/"+ dates[1] + "/" + dates[0];
                var newRow =
                    "<tr>" +
                    "<td>" +
                    order.order_id +
                    "</td>" +
                    "<td>" +
                    newdate +
                    "</td>" +
                    "<td>Pc " +
                    products.totalItems +
                    // "/ Pkr." +
                    // price.sum +
                    "</td>" +
                    '<td><span class="label px-2 py-1 rounded-2 ' +
                    label +
                    '">' +
                    order.status +
                    "</span></td>" +
                    '<td><a href="admin_order.php?id=' +
                    order.id +
                    '" class="btn btn-dark">View</a></td>' +
                    "</tr>";

                tableBody.insertAdjacentHTML("beforeend", newRow);
            });

        }

        document.querySelectorAll(".filter").forEach(function(button) {
            button.addEventListener("click", function() {
                var status = this.getAttribute("data-status");
                fetchOrders(status);
                console.log();
            });
        });
        // Initial load - assuming load all orders initially
        <?php 
        if (isset($_GET['status'])) {
            $status = $_GET['status'];
            echo 'fetchOrders("'. $status .'")';
        }else{
        echo 'fetchOrders("all");';
        }
        ?>
    });

    //

    //

    // Funtion to add producta and return totall if needed
    function addValues(inputString) {
        // Split the string into an array of values
        var valuesArray = inputString.split(",");

        // Convert each value to a number and sum them up
        // var sum = valuesArray.reduce(function(total, value) {
        //     return total + parseInt(value, 10);
        // }, 0);

        // Get the total number of items
        var totalItems = valuesArray.length;
        // console.log(totalItems);

        // Return an object with both results
        return {
            totalItems: totalItems,
            // sum: sum,
        };
    }

    function updateOrderCount() {
        var newOrderdiv = document.getElementById("newOrder");
        var processingdiv = document.getElementById("processing");
        var cancelleddiv = document.getElementById("cancelled");
        var completeddiv = document.getElementById("completed");

        newOrderdiv.innerHTML = "(" + new_order + ")";
        processingdiv.innerHTML = "(" + processing + ")";
        cancelleddiv.innerHTML = "(" + cancelled + ")";
        completeddiv.innerHTML = "(" + completed + ")";
    }
    </script>







