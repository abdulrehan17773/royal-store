<?php

include_once "admin_head.php";
redirectiflogin();
startSessionIfNeeded();
?>

<body style="height:100vh" class="d-flex justify-content-center align-items-center flex-column gap-3 text-center">

<form action="admin.php" method="post">
<label for="password">Password</label>
<input type="password" class="form-control shadow-none" id="password" name="password">
<input type="submit" name="adminLogin" value="Login" class="btn btn-primary mt-3">
</form>

</body>





<?php

include_once "admin_foot.php";
?>