<?php

include_once "admin_head.php";
setuppage();
include_once "admin_header.php";

?>

<div class="container my-4">
    <form method="post">
    <div class="row">
        <div class="col-7">
            <label for="">Name:</label>
            <input type="text" class="form-control shadow-none" name="reffer_val" required>
        </div>
        <div class="col-5 mt-4">
            <input type="submit" value="Add Reffer" name="add_reffer" class="btn btn-primary">
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
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $reffer = getAllData("refference");
                        while ($row = mysqli_fetch_assoc($reffer)) {
                            echo "<tr>
                            <form method=\"post\">
                            <th scope=\"row\">$row[uid]</th>
                            <td >$row[name]</td>
                            <td>
                            <input type=\"hidden\" name=\"page\" Value=\"admin_reffer.php\">
                            <input type=\"hidden\" name=\"id\" Value=\"$row[id]\">
                            <input type=\"hidden\" name=\"name\" Value=\"refference\">
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