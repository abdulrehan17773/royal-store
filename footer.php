
<footer class="footer text-light py-2" >
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-12 border-2 border-dark border-end pb-2 footer-menu-border">
            <div class="d-flex justify-content-start align-items-center flex-column gap-1 " style="color:white;">
                    <strong page="about.php" class="under_line">About Us</strong>
                    <strong page="contact.php" class="under_line">Contact Us</strong>
                    <strong page="refund.php" class="under_line">Refund Policy</strong>
                    <strong page="privacy.php" class="under_line">Privacy & Policy</strong>
                </div>
            </div>
            <div class="col-md-6 col-12 pb-2 ">
                <hr class="d-md-none d-block text-dark">
                <div class="d-flex justify-content-start text-dark align-items-center flex-column gap-1">
                    <div><strong>Name: </strong><span><?php echo $settings["store_name"] ?></span></div>
                    <div><strong>Phone: </strong><span><?php echo $settings["number"] ?></span></div>
                    <div><strong>Email: </strong><span><?php echo $settings["email"] ?></span></div>
                    <div><strong>Address: </strong><span><?php echo $settings["address"] ?></span></div>
                </div>
            </div>
            <hr class="text-dark">
            <div class="col-12 text-center text-dark footer">
                <span><strong>Copyright &copy; 2024, All rights reserved.</strong> <br> Developed by A.Rehan <a href="https://wa.me/+923441141506"  target="_blank">
        <strong > send Message</strong>
    </a> 
            </span>
            </div>
        </div>
    </div>
</footer>



<?php 
$cookie_status = getCookieValue("cookie_status");
if (!$cookie_status) {
    echo "<div id=\"cookie-alert\">
    <span>Your data has been saved in a cookie. Please accept the cookie to proceed.</span>
    <button onclick=\"acceptCookie(this)\" class=\"btn btn-sm btn-primary\">Accept Cookies</button>
    </div>";
}
?>


<div class="">
    <a href="https://wa.me/<?php echo $settings['number'] ?>" id="whatsapp-popup" target="_blank">
        <i class="fab fa-whatsapp bounce"></i>
    </a>
</div>

<?php
$alert = getCookieValue("alert_msg");
if($alert){
    echo "<div class=\"alert-message d-flex justify-content-center align-item-center\">
        <strong id=\"alert-content\"><span onclick=\"removeAlert(this)\" class=\"text-danger pe-3  display-6\" style=\"cursor:pointer;\">X</span>$alert</strong>
    </div>";
}

?>


</body>
<!-- bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<!-- script -->
 <script src="assets/js/awan.js"></script>



</html>