<?php


include_once "head.php";
include_once "header.php";

?>

<style>
    .container {
        width: 80%;
        margin: auto;
        overflow: hidden;
    }
    .header-about {
        background: #333;
        color: #fff;
        margin-top: 20px;
        min-height: 50px;
        border-bottom: #bbb 1px solid;
        text-align: center;
    }
    header h1 {
        margin: 0;
    }
    .content {
        padding: 20px;
        background: white;
        margin-top: 30px;
        box-shadow: inset 0 0 4px black;
        margin-bottom: 20px;
        border-radius: 5px;
    }
    .content h2 {
        color: #333;
    }
    .content p {
        line-height: 1.6;
    }

    @media screen and (max-width: 767px) {
        .container {
            width: 100%;
            padding: 10px;
        }
        .content {
            padding: 10px;
        }
        .content p {
            line-height: 1.3;
        }
    }
</style>

<div class="container my-sm-5 pt-sm-3">
    <div class="content">
        <h2><strong><?php echo $settings["store_name"] ?> </strong> 3-Day Refund Policy</h2>
        <p>At <strong><?php echo $settings["store_name"] ?></strong>, we strive to ensure your complete satisfaction with every purchase. However, if for any reason you are not satisfied with your purchase, we offer a 3-day refund policy to give you peace of mind.</p>

        <p><strong>Eligibility for Refund:</strong> To qualify for a refund, items must be returned within 3 days of the purchase date. The item should be in its original condition, unworn, unwashed, and with all tags attached.</p>

        <p><strong>How to Request a Refund:</strong> Simply contact us within 3 days of receiving your order. Provide your order number and details about the product you wish to return. Our team will guide you through the return process.</p>

        <p><strong>Refund Process:</strong> Once we receive your returned item and confirm it meets our refund criteria, we will process your refund. Please note that the refund will be issued to the original payment method and may take several business days.</p>

        <p><strong>Non-Refundable Items:</strong> Certain items may not be eligible for a refund due to hygiene reasons Please check the product page for specific return conditions.</p>

        <p>Thank you for shopping with <strong><?php echo $settings["store_name"] ?></strong>. We value your business and are committed to ensuring a positive shopping experience.</p>
    </div>
</div>


<?php
include_once "footer.php";
?>