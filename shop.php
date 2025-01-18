<?php


include_once "head.php";
include_once "header.php";

?>




<div class="container-md my-sm-5 pt-sm-5">
    <div class="row">
        <!-- filteration on products -->
        <div class="col-xl-2 col-lg-3 col-sm-4 col-12 mt-3">

        <h3>Search By</h3>
        <label for="category" class="mt-md-4 mt-2">Categories</label>
            <select class="form-select mt-2 border-dark shadow-none rounded-1" id="filter-category-value" aria-label="Small select example">
                <?php  
                $filter_shop = getCookieValue("filterShop");
                if ($filter_shop != null) {
                    $filter = explode(",", $filter_shop);
                    $select = "";
                    $brand = getAllData("brand");
                    while ($catrow = mysqli_fetch_assoc($brand)) {
                        if($filter[0] === $catrow['id']){
                            $select = "selected";
                        }else{
                            $select = "";
                        }
                        echo "<option value=\"$catrow[id]\" $select>$catrow[name]</option>";
                    }
                }else{
                    $brand = getAllData("brand");
                    while ($catrow = mysqli_fetch_assoc($brand)) {
                        echo "<option value=\"$catrow[id]\">$catrow[name]</option>";
                    }
                }
                ?>
            </select>
            
            <h5 class="mt-sm-5 mt-3">Price</h5>
            <div class="row">
                <div class="col-6">
                    <label for="price" class="mt-0">Min Price</label>
                    <?php
                    $filter = explode(",", $filter_shop);
                    $min_val = 1;
                    
                    if($filter_shop != null){
                    if($filter[1] > 1){
                        $min_val = $filter[1];
                    }}
                    echo "<input class=\"form-control inputTypeNum mt-2 border-dark shadow-none rounded-1\" value=\"$min_val\" id=\"filter-min-value\" type=\"number\" ></input>";
                    ?>
                </div>
                <div class="col-6">
                    <label for="price" class="mt-0">Max Price</label>
                    <?php   
                    $maxPrice = getMaxPrice();
                    $maxShowPrice = mysqli_fetch_assoc($maxPrice);
                    $max_val = $maxShowPrice['price'];
                    if($filter_shop != null){
                    if($filter[2] > 1){
                        $max_val = $filter[2];
                    }}
                    echo"<input class=\"form-control inputTypeNum mt-2 border-dark shadow-none rounded-1\" value=\"$max_val\" id=\"filter-max-value\" type=\"number\" ></input>";
                    ?>
                </div>
            </div>
            <div class="d-flex justify-content-between align-items center">
            <span page="shop.php" class=" px-3 py-1 mt-3  rounded-1 border-1 color-search-icon" id="filter" filter-shop-cookies>Apply</span>
            <span page="shop.php" class=" px-3 py-1 mt-3  rounded-1 border-1 color-search-icon" id="filter" onclick="removeCookie('filterShop')">Reset</span>
            </div>
            
        </div>
        <hr class="d-block d-sm-none my-3">
        <!-- Show all product -->
        <div class="col-xl-10 col-lg-9 col-sm-8 col-12 mt-md-1 my-3">
            <div class="row">
            <?php
            if($filter_shop != null){
                $filter = explode(",", $filter_shop);
                $filterData = getFilter($filter[0],$filter[1],$filter[2]);
                $numf = mysqli_num_rows($filterData);
                if($numf > 0){
                while ($frow = mysqli_fetch_assoc($filterData)) {
                    $image = explode(",",$frow['images']);
                    echo "<div class=\"col-xl-2 col-lg-3 col-md-4 col-sm-4 col-4 my-1 p-md-2 p-1\" >
                    <div page=\"product.php\" id=\"$frow[id]\" class=\"pro-cards\" openProductCookie>
                    <img src=\"$proimagesrc/$image[0]?>\" class=\"rounded-2 pro-card-height\" width=\"100%\" loading=\"lazy\">
                    <p class=\"textheight my-1\">$frow[name]</p>
                    <small class=\"strike-price mb-0\"><strike>RS $frow[discounted]</strike></small>
                    <h6 class=\"text-dark my-1\"><strong>RS $frow[price]</strong></h6>
                    </div>
                </div>";
        }}else{
            echo "<h4 class=\"col-12 text-center my-4\">No product found with this Filteration</h4> <hr>
                        <h4>All Products</h4>";
                $result = getAllData("products");
                while ($row = mysqli_fetch_assoc($result)) {
                    $image = explode(",",$row['images']);
                    echo "<div class=\"col-xl-2 col-lg-3 col-md-4 col-sm-4 col-4 my-1 p-md-2 p-1\" >
                    <div page=\"product.php\" id=\"$row[id]\" class=\"pro-cards\" openProductCookie>
                    <img src=\"$proimagesrc/$image[0]?>\" class=\"rounded-2 pro-card-height\" width=\"100%\" loading=\"lazy\">
                    <p class=\"textheight my-1\">$row[name]</p>
                    <small class=\"strike-price mb-0\"><strike>RS $row[discounted]</strike></small>
                    <h6 class=\"text-dark my-1\"><strong>RS $row[price]</strong></h6>
                    </div>
                </div>";
        }}
            }elseif($searchProduct != null){
                $searchResult = getConditionData("products","name",$searchProduct);
                $snum = mysqli_num_rows($searchResult);
                if($snum > 0){
                    while($srow = mysqli_fetch_assoc($searchResult)){
                        $image = explode(",",$srow['images']);
                    echo "<div class=\"col-xl-2 col-lg-3 col-md-4 col-sm-4 col-4 my-1 p-md-2 p-1\" >
                    <div page=\"product.php\" id=\"$srow[id]\" class=\"pro-cards\" openProductCookie>
                    <img src=\"$proimagesrc/$image[0]?>\" class=\"rounded-2 pro-card-height\" width=\"100%\" loading=\"lazy\">
                    <p class=\"textheight my-1\">$srow[name]</p>
                    <small class=\"strike-price mb-0\"><strike>RS $srow[discounted]</strike></small>
                    <h6 class=\"text-dark my-1\"><strong>RS $srow[price]</strong></h6>
                    </div>
                </div>";
                    }
                }else{
                    echo "<h4 class=\"col-12 text-center my-4\">No product found with your search</h4> <hr>
                        <h4>All Products</h4>";
                $result = getAllData("products");
                while ($row = mysqli_fetch_assoc($result)) {
                    $image = explode(",",$row['images']);
                    echo "<div class=\"col-xl-2 col-lg-3 col-md-4 col-sm-4 col-4 my-1 p-md-2 p-1\" >
                    <div page=\"product.php\" id=\"$row[id]\" class=\"pro-cards\" openProductCookie>
                    <img src=\"$proimagesrc/$image[0]?>\" class=\"rounded-2 pro-card-height\" width=\"100%\" loading=\"lazy\">
                    <p class=\"textheight my-1\">$row[name]</p>
                    <small class=\"strike-price mb-0\"><strike>RS $row[discounted]</strike></small>
                    <h6 class=\"text-dark my-1\"><strong>RS $row[price]</strong></h6>
                    </div>
                </div>";
        }
                }
            }else{
                $result = getAllData("products");
                while ($row = mysqli_fetch_assoc($result)) {
                    $image = explode(",",$row['images']);
                    echo "<div class=\"col-xl-2 col-lg-3 col-md-4 col-sm-4 col-4 my-1 p-md-2 p-1\" >
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