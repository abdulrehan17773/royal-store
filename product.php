<?php
include_once "head.php";
include_once "header.php";


$productids = getCookieValue("openProductWithId");
if (isset($_GET['product_id'])) {
    $productids = $_GET['product_id']; 
} 
if(!$productids && !isset($_GET['product_id'])){
    header("Location: shop.php");
    exit(); 
}



$result = getIdData("products", $productids);

if (mysqli_num_rows($result) == 0) {
    header("Location: shop.php");
    exit(); 
}

$product = mysqli_fetch_assoc($result);
$image = explode(",", $product['images']);
?>
<!-- product images -->
<section class="py-3">
    <div class="container my-sm-5 pt-sm-5">
        <div class="row gx-4">
            <aside class="col-lg-5">
                <div class="border rounded-4 mb-3 d-flex justify-content-center">
                    <img id="mainImage" style="max-width: 100%; height: 40vh; margin: auto;" class="rounded-4 fit" src="<?php echo $proimagesrc . "/" . $image['0'] ?>" />
                </div>
                <div class="d-flex justify-content-start  mb-3 product-img-scroll">
                    <!-- <a class="border mx-1 rounded-2 item-thumb show-image">
                        <img width="60" height="60" class="rounded-2" src="" showImage />
                    </a> -->
                    <?php
                    foreach ($image as $img) {
                        echo "<a class=\"border mx-1 rounded-2 item-thumb show-image\">
                        <img width=\"60\" height=\"60\" class=\"rounded-2\" src=\"$proimagesrc/$img\"  showImage/>
                    </a>";
                    }
                    ?>
                    <!-- Add more thumbnail links as needed -->
                </div>
            </aside>


            <!-- Description -->
            <main class="col-lg-7">
                <div class="ps-lg-3">
                    <h4 class="title text-dark">
                        <?php echo $product['name'] ?>
                    </h4>
                    <div class="d-flex flex-row my-md-3 my-1">
                        <div class=" mb-1 me-2">
                        <small class="strike-price mb-0"><strike>RS <?php echo $product['discounted'] ?></strike></small>
                        </div>
                    </div>

                    <div class="">
                        <span class="h5 text-success">Rs. <?php echo $product['price'] ?></span>
                    </div>

                    <p>
                    <?php echo $product['description'] ?>
                    </p>

                    <div class="row">
                        <dt class="col-3">Type:</dt>
                        <dd class="col-9">Regular</dd>

                        <dt class="col-3">Brand:</dt>
                        <dd class="col-9"><?php 
                        $cat = getIdData("brand", $product['brand_id']);
                        $cat1 = mysqli_fetch_assoc($cat);
                        echo $cat1['name']; 
                        ?></dd>
                    </div>
                    <?php
                        $productId = $product['id']; 
                        $currentUrl = "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                        
                        if (strpos($currentUrl, '?') !== false) {
                            $whatsappShareUrl = "https://api.whatsapp.com/send?text=" . urlencode("Check out this product: " . $currentUrl . "&product_id=" . $productId);
                        } else {
                            $whatsappShareUrl = "https://api.whatsapp.com/send?text=" . urlencode("Check out this product: " . $currentUrl . "?product_id=" . $productId);
                        }
                        ?>
                        

                        <div class="product-page-container" data-product-id="<?php echo $productId; ?>">
                            <a href="<?php echo $whatsappShareUrl; ?>" class="whatsapp-share-btn"><i class="fa fa-share"></i> Share on Whatsapp</a>
                        </div>


                    <hr>

                    
                    <input type="hidden" id="quantityInput" value="1">
                    <?php
                    $productCartId = getCookieValue("cartProduct");
                    $productCartData = explode(",", $productCartId);

                    $inCart = false;

                    foreach ($productCartData as $productData) {
                        $cartDataId = explode("**", $productData);

                        if ($cartDataId[0] == $product['id']) {
                            $inCart = true;
                            break;
                        }
                    }

                    if ($inCart) {
                        echo "
                        <button name=\"cart\" page=\"cart.php\" class=\" inCart-btn shadow-0 \">Product in Cart</button>";
                    } else {
                        echo "<input type=\"hidden\" id=\"product-id-for-cookies\" value=\"$product[id]\"><button  class=\"shadow-0 addTo-card\" buy-product-button-with-cookies> <i class=\"me-1 fa fa-shopping-basket\"></i> Add to cart </button>";
                    }
                    ?>
                </div>
            </main>
        </div>
    </div>
</section>

<div class="container my-4">
    <div class="row">
        <div class="col-12 text-center">
            <h5>You May Also Like</h5>
        </div>
        <div class="col-12">
            <div class="row">
                <?php
                $result = limitedData("products", 6);
                while ($row = mysqli_fetch_assoc($result)) {
                    if ($row['id'] != $productids) {

                        $image = explode(",", $row['images']);
                        echo "<div class=\" col-lg-2 col-md-3 col-sm-4 col-4 my-1 p-md-3 p-1\" >
                    <div page=\"product.php\" id=\"$row[id]\" class=\"pro-cards\" openProductCookie>
                    <img src=\"$proimagesrc/$image[0]?>\" class=\"rounded-2 pro-card-height\" width=\"100%\" loading=\"lazy\">
                    <p class=\"textheight my-1\">$row[name]</p>
                    <small class=\"strike-price mb-0\"><strike>RS $row[discounted]</strike></small>
                    <h6 class=\"text-dark my-1\"><strong>RS $row[price]</strong></h6>
                    </div>
                </div>";
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>


<?php
include_once "footer.php";
?>