<?php


include_once "head.php";
include_once "header.php";

?>

<style>
    .content {
            padding: 20px;
            background-color: #fff;
            margin-top: 20px;
            box-shadow:inset 0 0 4px black;
            margin-bottom: 20px;
            border-radius: 5px;
        }
</style>


    <div class="container my-sm-5 pt-sm-4">
        <div class="content">
            <h2>Privacy Policy</h2>
            <p>Effective Date: <strong>8/20/2024</strong></p>

            <h3>1. Introduction</h3>
<p>Welcome to <strong><?php echo $settings["store_name"] ?>!</strong> We value your privacy and strive to protect your information. This Privacy Policy outlines how we collect, use, and safeguard your data when you visit our website.</p>

<h3>2. Information We Collect</h3>
<ul>
    <li><strong>Personal Info:</strong> Name, email, phone number.</li>
    <li><strong>Usage Data:</strong> Website interaction details.</li>
</ul>

<h3>3. How We Use Your Information</h3>
<ul>
    <li>To process orders and provide customer support.</li>
    <li>To improve our services based on feedback.</li>
</ul>

<h3>4. Sharing Your Information</h3>
<ul>
    <li><strong>Service Providers:</strong> Trusted partners who help run our site and process payments.</li>
    <li><strong>Legal:</strong> Compliance with laws and protection of our rights.</li>
</ul>

<h3>5. Data Security</h3>
<p>We use security measures to protect your data, but note that no method is 100% secure.</p>

<h3>6. Your Rights</h3>
<p>You can access, correct, or delete your data. Contact us at <strong><?php echo $settings["email"] ?></strong> to exercise your rights.</p>


<h3>7. Contact Us</h3>
<p>Questions? Contact us at:</p>
<p><strong>Email:</strong> <?php echo $settings["email"] ?></p>
<p><strong>Phone:</strong> <?php echo $settings["number"] ?></p>
    </div>
    </div>


<?php
include_once "footer.php";
?>