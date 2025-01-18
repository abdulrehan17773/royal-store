<?php


include_once "head.php";
include_once "header.php";
?>

<div class="container-fluid ">
    <div class="row ">
        <div class="col-12 px-0">
            <img src="<?php echo $imagesrc."/".$settings["slider"] ?>" class="" alt="Banner-Image" style="min-height:180px;" width="100%" loading="lazy">
        </div>
    </div>
</div>

<div class="container my-4">
    <div class="row">
        <div class="col-12 text-center">
            <h3><strong>Why Shop At Our Store</strong></h3>
        </div>
        <div class="col-md-3 col-6 d-flex justify-content-center align-items-center gap-2 flex-column mt-3">
            <i class="fas fa-store why-color"></i>
            <strong>Affordable Price</strong>
        </div>
        <div class="col-md-3 col-6 d-flex justify-content-center align-items-center gap-2 flex-column mt-3">
            <i class="fas fa-truck why-color"></i>
            <strong>Home Delivery</strong>
        </div>
        <div class="col-md-3 col-6 d-flex justify-content-center align-items-center gap-2 flex-column mt-3">
            <i class="fas fa-star why-color"></i>
            <strong>100% Orignal</strong>
        </div>
        <div class="col-md-3 col-6 d-flex justify-content-center align-items-center gap-2 flex-column mt-3">
            <i class="fas fa-credit-card why-color"></i>
            <strong>Cash on Delivery</strong>
        </div>
    </div>
</div>
<hr>

<div class="container my-4">
    <div class="row">
        <div class="col-12 p-0">
            <div class="profile-container" id="profileContainer">
            <div class="profile-images justify-content-start align-items-center gap-4">
            <?php
            $result = getAllData("brand");
            while ($row = mysqli_fetch_array($result)) {
                echo "<div class=\"cat-cards p-0 text-center\" >
                    <span class=\"p-0\">
                        <img src=\"$catimagesrc/$row[image]\" class=\"cat-images\" alt=\"\" width=\"70px\" height=\"70px\" loading=\"lazy\">
                    </span>
                    <div class=\"text-center mt-3\">
                        <small><strong>$row[name]</strong></small>
                    </div>
                </div>";
            }
            ?>
            </div>
            </div>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="container">
    <div class="row">
        <div class="col-12 d-flex justify-content-between align-items-center ">
            <p class="mb-0"><strong class="down-border">Offer of the week</strong></p>
            <strong page="shop.php">View all</strong>
        </div>
        <div class="col-12 my-3">
            <div class="row">
                <?php
                $result = limitedData("products", 9);
                while ($row = mysqli_fetch_array($result)) {
                    $image = explode(",",$row['images']);
                    echo"<div class=\" col-lg-2 col-md-3 col-sm-4 col-4 my-1 p-md-3 p-1\" >
                    <div page=\"product.php\" id=\"$row[id]\" class=\"pro-cards\" openProductCookie>
                    <img src=\"$proimagesrc/$image[0]?>\" class=\"rounded-2 pro-card-height\" width=\"100%\" loading=\"lazy\">
                    <p class=\"textheight my-1\">$row[name]</p>
                    <small class=\"strike-price mb-0\"><strike>RS $row[discounted]</strike></small>
                    <h6 class=\"text-dark my-1\"><strong>RS $row[price]</strong></h6>
                    </div>
                </div>";
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php
include_once "footer.php";
?>
<script>
    initializeTouchSlider("profileContainer");
</script>