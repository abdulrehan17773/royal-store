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
            box-shadow:inset 0 0 4px black;
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
            padding:10px;
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
            <h2>Welcome to <strong><?php echo $settings["store_name"] ?> </strong></h2>
            <p>At <strong><?php echo $settings["store_name"] ?> </strong>, we are passionate about delivering <strong>high-quality</strong> ladies' suits that combine style, comfort, and elegance. Established in<strong> 2024</strong>, our store has become a trusted name in the fashion industry, renowned for our commitment to excellence and <strong>customer satisfaction</strong>.</p>

<p>Our journey began with a simple vision: to offer fashionable ladies' suits that meet the needs of our diverse clientele. From business suits to formal evening wear, our collection is designed to cater to all<strong> tastes and preferences</strong>. We source our fabrics from the best suppliers and work with skilled artisans to ensure every piece meets our high standards of <strong>craftsmanship</strong>.</p>

<p>What sets us apart is our dedication to exceptional<strong> customer service</strong>. Our team is always ready to assist you in finding the <strong>perfect suit</strong>, providing personalized recommendations, and ensuring a seamless shopping experience. We believe that every customer deserves to<strong> feel special</strong>, and we strive to make each visit to our store a memorable one.</p>

<p>Thank you for choosing <strong><?php echo $settings["store_name"] ?> </strong>. We look forward to serving you and<strong> helping </strong>you find suits that make you look and feel your best.</p>  

        </div>
    </div>


<?php
include_once "footer.php";
?>