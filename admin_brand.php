<?php

include_once "admin_head.php";
setuppage();
include_once "admin_header.php";
?>




<div class="container my-4">
    <form method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-lg-4 col-md-6 my-md-0 my-3">
            <label for="">Name:</label>
            <input type="text" class="form-control shadow-none" name="name" required>
        </div>
        <div class="col-lg-4 col-md-6 my-md-0 my-3">
            <label for="">Image:</label>
            <input type="file" class="form-control shadow-none" name="image" accept="image/*" required>
        </div>
        <div class="col-lg-4 col-12 my-4 text-center">
            <input type="submit" value="Add Brand" name="add_brand" class="btn btn-primary">
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
                        <th scope="col">Image</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $reffer = getAllData("brand");
                        while ($row = mysqli_fetch_assoc($reffer)) {
                            echo "<tr>
                            <form method=\"post\">
                            <th scope=\"row\">$row[id]</th>
                            <td>$row[name]</td>
                            <td><img src=\"$catimagesrc/$row[image]\" loading=\"lazy\" height=\"50px\" width=\"50px\"></td>
                            <td>
                            <input type=\"hidden\" name=\"page\" Value=\"admin_brand.php\">
                            <input type=\"hidden\" name=\"id\" Value=\"$row[id]\">
                            <input type=\"hidden\" name=\"name\" Value=\"brand\">
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