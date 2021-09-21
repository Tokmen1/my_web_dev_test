<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="initial-scale=1, minimum-scale=1, width=device-width" name="viewport">
    <link rel="stylesheet" href="style.css">
    <script src="validator.js"></script>
    <title>Pineapple</title>
</head>
<body>
    <div class="header">
        <div></div>
        <div class="logo">
            <img src="logo_pineapple.svg" alt="logo_pineapple" class="big"></img>
            <img src="logo_pineapple_small.svg" alt="logo_pineapple" class="small"></img>
        </div>
        <div class="empty"></div>
        <div class="about"><a href="http://">About</a></div>
        <div class="how_it_works">How it works</div>
        <div class="contact">Contact</div>
        <div class="empty2">.</div>
    </div>
    <form class="content" id="content" method="post" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <div class="heading">Subscribe to newsletter</div>
        <div class="content_text">Subscribe to our newsletter and get 10% discount on pineapple glasses.</div>
        <div class="email">
            <input type="text" name="email" id="email" onkeyup="validate_email()" placeholder="Type your email address here..."></input>
            <input type="image" src="ic_arrow.svg" alt="Submit" id="submit" value="Submit"  onclick="validate_email()"></input>
        
        <div id="error">
            <noscrit>
                <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $var_email = "";
                        include "email.php";
                        $email =new Email();
                        $var_email = $_POST["email"];
                        $check = isset($_POST['terms']) ? true : false;
                            echo $email->validate_email($var_email, $check);
                        echo $redy_to_submit;
                    }
                ?>
            </noscrit>
	    </div>
        </div>
        <div class="terms">
            <input type="checkbox" name="terms" id="terms" value="true" onchange="validate_email()"></input>
            <label for="terms">I agree to <a href="http://google.com"> terms of service</a></label> 
        </div>
    </form>
    <div id="valid_email">
        <img src="ic_success.svg" alt="">
        <h1>Thanks for subscribing!</h1>
        <p>You have successfully subscribed to our email listing. Check your email for the discount code.</p>
    </div>
        <div class="social_media">
            <a href="https://facebook.com" class="facebook">
                <img src="ic_facebook.svg" alt="ic_facebook">
            </a>
            <a href="https://instagram.com" class="ig">
                <img src="ic_instagram.svg" alt="ic_instagram">
            </a>
            <a href="https://www.twitter.com" class="twitter">
                <img src="ic_twitter.svg" alt="ic_twitter">
            </a>
            <a href="https://www.youtube.com" class="youtube">
                <img src="ic_youtube.svg" alt="ic_youtube">
            </a>
        </div>
    <br>
</body>
</html>
