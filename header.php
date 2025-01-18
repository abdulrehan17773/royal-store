
<header class="d-flex justify-content-center" >
    <div class="container-fluid w-75" id="header-adjustment" >
        <form  method="post">
        <div class="row p-2  ">
            <div page="home.php" class="col-lg-1 col-2  d-flex justify-content-end align-item-center gap-2 text-light">
                <img  src="<?php echo $imagesrc ."/". $settings["logo"] ?>" alt="logo" class="logo" height="50px">
            </div>
            
          
            <div class="col-2 order-2 order-md-last d-md-none d-block d-flex justify-content-center align-items-center text-light"><span class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon "><i class="fas fa-list" style="font-size:30px !important; position:relative; bottom:2px"></i></span>
    </span></div>
            <div class="div col-xl-8 col-lg-7 col-md-6 col-4 mt-md-2 mt-0 order-md-0 order-last">
            <div class="navbar navbar-expand-md bg-body-transparent w-100 p-0 ">
  <div class="container-fluid">
    
    <div class="collapse navbar-collapse d-md-flex justify-content-center align-items-center text-light" id="navbarNavAltMarkup">
      <div class="navbar-nav  gap-lg-5 gap-md-4 gap-5 flex-row justify-content-center mt-3 mt-md-2">
       <strong page="home.php" class="header-btn">Home</strong>
       <strong page="shop.php" class="header-btn">Shop</strong>
       <strong page="trackorder.php" class="header-btn">Orders</strong>
       <strong page="cart.php" class="header-btn">Cart</strong>
      </div>
    </div>
  </div>
</div>
            </div>

            <div class="col-xl-3 col-md-4 col-8  mt-2 position-relative">
              <?php
              $searchProduct = getCookieValue("searchProduct");
              $value = "";
              if ($searchProduct != null) {
                 $value = $searchProduct;
              }
              echo "<input type=\"text\" name=\"search\" class=\"form-control rounded-5 border-0 shadow-none position-relative start-0\" placeholder=\"Search Product...\" style=\"top:0px;\" value=\"\" id=\"search-product\">";
              ?>
                <span class="fas fa-search position-absolute translate-middle color-search-icon rounded-5" id="click-search-btn" page="shop.php" style="top: 18px;right: -17px;" search-product-with-cookie></span>
            </div>


        </div>
        </form>
    </div>
</header>