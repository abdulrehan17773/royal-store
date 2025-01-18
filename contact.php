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
        .header-contact {
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
            background: #fff;
            margin-top: 30px;
            box-shadow:inset 0 0 4px black;
            margin-top: 20px;
            border-radius: 5px;
        }
        .content h2 {
            color: #333;
        }
        .content p {
            line-height: 1.6;
        }
        .map {
            margin-top: 20px;
            border: 0;
            width: 100%;
            height: 400px;
        }
</style>

    
    <div class="container-md my-sm-5 pt-sm-5 pt-2">
        <div class="content">
            <h2>Get in Touch</h2>
            <p>If you have any questions or need assistance, please don't hesitate to reach out to us. We're here to help!</p>
            
            <div class="row">
                <div class="col-md-6 col-12 my-2">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d53381.009081510056!2d73.26775744564847!3d33.25829538124344!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x392005bea6c1b8cf%3A0xc1ef0608b44b1eab!2sGujar%20Khan%2C%20Rawalpindi%2C%20Punjab%2C%20Pakistan!5e0!3m2!1sen!2sus!4v1724596961706!5m2!1sen!2sus" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <hr class="d-block d-md-none mt-3">
                <div class="col-md-6 col-12  my-4">
                    <div class="d-flex justify-content-center align-item-center gap-md-4 gap-3 flex-column">
                        <div>
                            <span class="fw-bold">Service: </span><span> We are base in town called Gujar khan. we are small startup providing best of clothes and other items across all pakistan.</span>
                        </div>
                        <div>
                            <span class="fw-bold">Phone: </span><span><?php echo $settings['number']?></span>
                        </div>
                        <div>
                            <span class="fw-bold">Email: </span><span><?php echo $settings['email']?></span>
                        </div>
                        <div>
                            <span class="fw-bold">Address: </span><span><?php echo $settings['address']?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section>
        <div class="container my-5">
            
        </div>
    </section>


<?php
include_once "footer.php";
?>