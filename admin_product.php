<?php

include_once "admin_head.php";
setuppage();
include_once "admin_header.php";

?>

<div class="container my-4">
    <form method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-lg-4 col-6 my-md-0 my-3">
            <label for="">Name:</label>
            <input type="text" class="form-control shadow-none" name="name" required>
        </div>
        <div class="col-lg-4 col-6 my-md-0 my-3">
            <label for="">Cost:</label>
            <input type="number" class="form-control shadow-none" name="cost" required>
        </div>
        <div class="col-lg-4 col-6 my-md-0 my-3">
            <label for="">Discounted:</label>
            <input type="number" class="form-control shadow-none" name="discount" required>
        </div>
        <div class="col-lg-4 col-6 my-md-0 my-3">
            <label for="">Price:</label>
            <input type="number" class="form-control shadow-none" name="price" required>
        </div>
        <div class="col-lg-4 col-6 my-md-0 my-3">
            <label for="">Qty:</label>
            <input type="number" class="form-control shadow-none" name="qty" required>
        </div>
        <div class="col-lg-4 col-6 my-md-0 my-3">
            <label for="">Brand:</label>
            <select class="form-select shadow-none" name="brand" aria-label="Default select example">
                <?php
                $brand = getAllData("brand");
                while($row = mysqli_fetch_assoc($brand)){
                    echo"<option value=\"$row[id]\">$row[name]</option>";
                }
                ?>
            </select>
        </div>
        <div class="col-lg-4 col-md-6 my-md-0 my-3">
            <label for="">Desc:</label>
            <textarea name="desc" class="form-control shadow-none" required></textarea>
            <!-- <input type="text" class="form-control shadow-none" name="desc" required> -->
        </div>
        <div class="col-lg-4 col-md-6 my-md-0 my-3">
            <label for="">Image:</label>
            <input type="file" class="form-control shadow-none" name="image[]" accept="image/*" required multiple>
        </div>
        <div class="col-lg-4 col-12 my-4 text-center">
            <input type="submit" value="Add Product" name="add_product" class="btn btn-primary">
        </div>
    </div>
    </form>
</div>
<hr>
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-stripped table-bordered text-center">
                    <thead>
                        <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Cost</th>
                        <th scope="col">Discount</th>
                        <th scope="col">Price</th>
                        <th scope="col">Brand</th>
                        <th scope="col">Qty</th>
                        <th scope="col">Desc</th>
                        <th scope="col">Image</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $reffer = getAllDataAdmin("products");
                        while ($row = mysqli_fetch_assoc($reffer)) {
                            $Brand = getbrandname("brand",$row['brand_id']);
                            $image = explode(",", $row['images']);
                            echo "<tr>
                            <form method=\"post\">
                            <th scope=\"row\">$row[id]</th>
                            <td>$row[name]</td>
                            <td>$row[cost]</td>
                            <td>$row[discounted]</td>
                            <td>$row[price]</td>
                            <td>$Brand</td>
                            <td>$row[qty]</td>
                            <td>$row[description]</td>
                            <td><img src=\"$proimagesrc/$image[0]\" loading=\"lazy\" height=\"50px\" width=\"50px\"></td>
                            <td>
                            <input type=\"hidden\" name=\"page\" Value=\"admin_product.php\">
                            <input type=\"hidden\" name=\"id\" Value=\"$row[id]\">
                            <input type=\"hidden\" name=\"name\" Value=\"products\">
                            <input type=\"submit\" name=\"delete_id\" Value=\"Delete\" class=\"btn btn-danger\">
                            </td>
                            </form>
                            </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>






<?php

include_once "admin_foot.php";
?>