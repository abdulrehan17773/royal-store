<?php


include_once "head.php";
include_once "header.php";

?>



<!-- cart system -->
<div class="container-md my-sm-5 pt-sm-5">
    <div class="row">
        <div class="col-sm-6 mt-3">
            <h4>Order Details</h4>
            <form method="post">
                <?php
                $details = getCookieValue("cookiesOrderDetails");
                ?>
                <div class="mb-2 mt-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class=" rounded-1 border-1 border-cart shadow-none form-control" id="cookie_name" value="<?php
                            if ($details != "") {
                                $productCartDetails = explode("**", $details);
                                echo $productCartDetails[0];
                            } else {
                                echo "";
                            }
                            ?>" aria-describedby="emailHelp" required>
                </div>
                <div class="mb-2">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class=" rounded-1 border-1 border-cart shadow-none form-control" id="cookie_email" value="<?php
                        if ($details != "") {
                            $productCartDetails = explode("**", $details);
                            echo $productCartDetails[1];
                        } else {
                            echo "";
                        }
                        ?>" aria-describedby="emailHelp" required>
                </div>
                <div class="mb-2">
                    <label for="number" class="form-label">Number</label>
                    <input type="text" class=" rounded-1 border-1 border-cart shadow-none form-control" id="cookie_number" value="<?php
                        if ($details != "") {
                            $productCartDetails = explode("**", $details);
                            echo $productCartDetails[2];
                        } else {
                            echo "";
                        }
                        ?>" required>
                </div>
                <div class="mb-2">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class=" rounded-1 border-1 border-cart shadow-none form-control" id="cookie_address" value="<?php
                        if ($details != "") {
                            $productCartDetails = explode("**", $details);
                            echo $productCartDetails[3];
                        } else {
                            echo "";
                        }
                        ?>" required>
                </div>
                <div class="mb-2">
                    <label for="city" class="form-label">City</label>
                    <input type="text" class=" rounded-1 border-1 border-cart shadow-none form-control" id="cookie_city" value="<?php
                        if ($details != "") {
                            $productCartDetails = explode("**", $details);
                            echo $productCartDetails[4];
                        } else {
                            echo "";
                        }
                        ?>" required>
                </div>
                <div class="mb-2">
                    <label for="note" class="form-label">Additional Notes</label>
                    <textarea class=" rounded-1 border-1 border-cart shadow-none form-control" id="cookie_notes" rows="3"></textarea>
                </div>
                <div class="text-center my-4">
                    <?php
                    $productids = getCookieValue("cartProduct");
                    if ($productids != null) {
                        echo "<button type=\"submit\" name=\"header_confirm\" class=\"p-2 rounded-2 border-0 color-search-icon\" place-order-with-cookies>
                        Place Order
                        </button>";
                    }
                    ?>
                </div>
            </form>
        </div>
        <div class="col-sm-6">
            <div class="row mt-4 ">
                <div class="col-12">
                    <h4>Cart Items</h4>
                </div>
                <?php
                $productCartData = explode(",", $productids);
                if ($productids == null) {
                    echo "<h3 class=\"place-order text-center mt-5 pt-5\">Your cart is currently empty.</h3>
                <span  page=\"shop.php\"  class=\"text-center color-search-icon fw-bold rounded-1\" open-shop-remove-cook>Shop Now</span>";
                }

                $totalProductPrice = 0;
                foreach ($productCartData as $productData) {
                    $cartDataId = explode("**", $productData);

                    $resultCart = getIdData("products", $cartDataId[0]);
                    while ($cartItem  = mysqli_fetch_assoc($resultCart)) {
                        $image = explode(",", $cartItem['images']);
                        $totalPrice = $cartItem['price'] * $cartDataId[1];
                        $totalProductPrice += $totalPrice;
                        echo "<div class=\"col-xl-3 col-lg-4 col-6 my-1 p-md-2 p-1 mt-3\">
                        <div class=\"card p-2 shadow-sm pb-2 rounded-1\">
                    <img src=\"$proimagesrc/$image[0]\"  class=\"card-img-top pro-card-height\" alt=\"\">
                    <div class=\"card-body px-0 pb-0\">
                        <p class=\"card-text mb-1 px-0 fw-bolder\">$cartItem[name]</p>
                        
                        <small class=\"mt-1\">Total: &nbsp; <span class=\"fw-bold\">Rs.</span><span class=\"fw-bolder total-price-class\" id=\"pro-total-$cartItem[id]\"> $totalPrice</span></small>
                        <form method=\"post\" class=\"d-inline\">
                         <button type=\"submit\" name=\"cart\" class=\"float-end border-0 bg-transparent \" id=\"$cartItem[id]\" remove-cart-item-cookies><i class=\"fas fa-trash place-order\" style=\"cursor:pointer;\"></i></button>
                         </form>
                        </div>
                        </div>
                        </div>";
                    }
                }

                ?>
                <hr class="mt-3">
                <div class="col-12">
                    <div class="row">
                        <div class="offset-sm-4  offset-3 col-sm-8 col-9">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td class="fw-bold">Total price:</td>
                                        <td class="text-end">Rs. <span id="total-price"><?php echo $totalProductPrice ?></span></td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Shipping:</td>
                                        <td class="text-end">Free</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Grand price:</td>
                                        <td class="text-end">Rs. <span id="grand-price"><?php echo $totalProductPrice ?></span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
include_once "footer.php";
?>