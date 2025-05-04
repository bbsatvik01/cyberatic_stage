<?php include "admin/includes/admin_header.php" ?>
<?php include "includes/db.php" ?>
<?php include "admin/includes/functions.php" ?>
<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
 ?>

<?php
$veried_email=0;


if (isset($_POST["verify_email"])) {



$forgot_error_message ="";

$user_email            =       escape($_POST["user_email"]);





$valid_email=forgot_email_exsists($user_email);

if(empty($user_email)){

    $forgot_error_message = '<div class="alert alert-danger alert-dismissible fade show" role="alert">   <strong>EMPTY!!</strong>  Enter a valid Email.'.
    '  <button type="button" class="close" data-dismiss="alert" aria-label="Close">  <span aria-hidden="true">&times;</span> </button>  </div>';
    // $register_error_message ="Please enter email correctly";
}
else if(!$valid_email[0]){


  $forgot_error_message = '<div class="alert alert-warning alert-dismissible fade show" role="alert"> <strong>OOPS!!</strong> Email does not exist. Enter a valid Email. '.
  '  <button type="button" class="close" data-dismiss="alert" aria-label="Close">  <span aria-hidden="true">&times;</span> </button>  </div>';

}






else {
$user_first_name=$valid_email[1];
$user_last_name=$valid_email[2];

    $veried_email=1;
















if($veried_email==1){  ?>
  <div class="containerr" id="containerr">
    <!-- Row -->
    <div class="row">
      <!-- Sign Up -->
      <div class="col align-center flex-col sign-up">
        <div class="form-wrapper align-center">













        </div>

   
      </div>
      <!-- End Sign Up -->
      <!-- Sign In -->
      <div class="col align-center flex-col sign-in">

        <div class=" align-center">

          <form class="" action="otp" method="post">


          <div class=" sign-in">
          <div class="alert alert-info alert-dismissible fade show" role="alert">Hey <strong><?php echo $user_first_name; echo $user_last_name; ?></strong>,  Forgot Your Password?
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">  <span aria-hidden="true">&times;</span> </button>  </div>
            <div class="input-group">
                    
            <input type="hidden" name="user_email"  value="<?php echo $user_email; ?>" placeholder="Email" />

            <input type="hidden" name="user_name"  value="<?php echo $user_first_name;  ?>" placeholder="Email" />                            

              
            </div>





            <button class=" btn btn-primary"   name="forgot_otp">Send Mail</button>
              </form>

          </div>
        </div>

        <!-- <div class="form-wrapper">
          <div class="social-list align-center sign-in">
            <div class="align-center facebook-bg">
              <i class="bx bxl-facebook"></i>
            </div>
            <div class="align-center google-bg">
              <i class="bx bxl-google"></i>
            </div>
            <div class="align-center twitter-bg">
              <i class="bx bxl-twitter"></i>
            </div>
            <div class="align-center insta-bg">
              <i class="bx bxl-instagram-alt"></i>
            </div>
          </div>
        </div> -->
      </div>
      <!-- End Sign In -->
    </div>
    <!-- End Row -->
    <!-- Content Section -->
    <div class="row content-row">
      <!-- Sign In Content -->
      <div class="col align-items flex-col">
        <div class="text sign-in">

          <p>
            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quae et
            cumque consectetur illo accusamus impedit eos ut. Eos, odit
            facilis.
          </p>
        </div>
        <div class="img sign-in">
          <img src="images/signin.svg" alt="" />
        </div>
      </div>

      <!-- Sign Up Content -->
      <div class="col align-items flex-col">
        <div class="img sign-up">
          <img src="images/signup.svg" alt="" />
        </div>
        <div class="text sign-up">
          <h2>Join with us</h2>
          <p>
            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quae et
            cumque consectetur illo accusamus impedit eos ut. Eos, odit
            facilis.
          </p>
        </div>
      </div>
    </div>
  </div>



<?php }

}













}

 ?>




<?php


// if (isset($_POST["login_user"]) && isset($_POST["user_email"])) {
//
//
// $user_email = $_POST["user_email"];
// $password   = $_POST["password"];
//
//
// $user_email = trim($user_email);
// $password = trim($password);
// $user_email = mysqli_real_escape_string($connection,$user_email);
// $password= mysqli_real_escape_string($connection,$password);
//
// $after_registration =false;
// $message_error_login = login_user($user_email,$password,$after_registration);
//
//
// }


 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
         <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="images/logo.png">
  <title>
CYBERATIC RVITM
  </title>
    
    
    
    
    
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link
      href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css"
      rel="stylesheet"
    />
    <!-- <link rel="stylesheet" href="styles.css" /> -->
   
    <style media="screen">
    :root {
    --black: #000;
    --white: #fff;
    --gray: #efefef;
    --gray-2: #757575;

    --facebook-color: #4267b2;
    --google-color: #db4437;
    --twitter-color: #1da1f2;
    --insta-color: #e1306c;
    }

    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600&display=swap");

    *,
    *::after,
    *::before {
    margin: 0;
    padding: 0;
    box-sizing: inherit;
    }

    html {
    box-sizing: border-box;
    }

    body {
    font-family: "Poppins", sans-serif;
    height: 100vh;
    overflow: hidden;
    font-weight: 400;
    background-color: #1e1e2f;
    /*overflow-y: hidden;*/


    }

    .containerr {
    position: relative;
    min-height: 100vh;
    overflow: hidden;
    }

    .row {
    display: flex;
    flex-wrap: wrap;
    height: 100vh;
    }

    .col {
    width: 50%;
    padding: 0 2rem;
    }

    .align-center {
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    }

    .flex-col {
    flex-direction: column;
    }

    .form-wrapper {
    width: 100%;
    max-width: 28rem;

    }

    .form {
    padding: 1rem;
  background:   #27293d;
    border-radius: 1.5rem;
    width: 100%;
    box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.35);
    transform: scale(0);
    transition: 0.5s ease-in-out;
    transition-delay: 1s;
    }

    .input-group {
    position: relative;
    width: 100%;
    margin: 1rem 0;
    }

    .input-group i {
    position: absolute;
    top: 50%;
    left: 1rem;
    transform: translateY(-50%);
    font-size: 1.4rem;
    color: #ffff;
    }

    .input-group input {
    width: 100%;
    padding: 1rem 3rem;
    font-size: 1rem;
    background-color:#27293d;
    border-radius: 0.5rem;
    border: 1px solid #cad1d7;
    outline: none;
    color: #fff
    }

    .input-group input:focus {
    border: 0.125rem solid #e14eca;
    }

    .form button {
    cursor: pointer;
    width: 100%;
    padding: 0.8rem 0;
    border-radius: 0.5rem;
    border: none;
    /* background-color: #e14eca; */
    color: var(--white);
    font-size: 1.2rem;
    outline: none;
    }

    .form p {
    margin: 1rem 0;
    font-size: 0.7rem;
    color: rgb(248,248,255);
    }

    .social-list {
    margin: 2rem 0;
    padding: 1rem;
    border-radius: 1.5rem;
    width: 100%;
    box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.35);
    transform: scale(0);
    transition: 0.5s ease-in-out;
    transition-delay: 1.2s;
    }

    .social-list > div {
    color: var(--white);
    margin: 0 0.5rem;
    padding: 0.7rem;
    cursor: pointer;
    border-radius: 0.5rem;
    cursor: pointer;
    transform: scale(0);
    transition: 0.5s ease-in-out;
    }

    .social-list > div:nth-child(1) {
    transition-delay: 1.4s;
    }

    .social-list > div:nth-child(2) {
    transition-delay: 1.6s;
    }

    .social-list > div:nth-child(3) {
    transition-delay: 1.8s;
    }

    .social-list > div:nth-child(4) {
    transition-delay: 2s;
    }

    .social-list > div > i {
    font-size: 1.5rem;
    transition: 0.4s ease-in-out;
    }

    .social-list > div:hover i {
    transform: scale(1.5);
    }

    .facebook-bg {
    background-color: var(--facebook-color);
    }
    .google-bg {
    background-color: var(--google-color);
    }
    .twitter-bg {
    background-color: var(--twitter-color);
    }
    .insta-bg {
    background-color: var(--insta-color);
    }

    .containerr.sign-in .form.sign-in,
    .containerr.sign-in .social-list.sign-in,
    .containerr.sign-in .social-list.sign-in > div,
    .containerr.sign-up .form.sign-up,
    .containerr.sign-up .social-list.sign-up,
    .containerr.sign-up .social-list.sign-up > div {
    transform: scale(1);
    }

    .content-row {
    position: absolute;
    top: 0;
    left: 0;
    pointer-events: none;
    z-index: 6;
    width: 100%;
    }

    .text {
    position: absolute;
    margin: 4rem;
    color: var(--white);
    z-index: 500;
    }

    .text.sign-in {
    top: 0%;
    max-width: 50%;
    }

    .text.sign-up {
    bottom: 0;
    }

    .text h2 {
    font-size: 3.5rem;
    font-weight: 600;
    margin: 2rem 0;
    transition: 1s ease-in-out;
    }

    .text p {
    transition: 1s ease-in-out;
    transition-delay: 0.2s;
    }

    .img img {
    position: absolute;
    transition: 1s ease-in-out;
    transition-delay: 0.4s;
    z-index: 100;
    }

    .img.sign-in img {
    width: 42vw;
    bottom: 0%;
    }

    .img.sign-up img {
    top: 0%;
    right: 10%;
    width: 34vw;
    }

    .text.sign-in h2,
    .text.sign-in p,
    .img.sign-in img {
    transform: translateX(-250%);
    }

    .text.sign-up h2,
    .text.sign-up p,
    .img.sign-up img {
    transform: translateX(250%);
    }

    .containerr.sign-in .text.sign-in h2,
    .containerr.sign-in .text.sign-in p,
    .containerr.sign-in .img.sign-in img,
    .containerr.sign-up .text.sign-up h2,
    .containerr.sign-up .text.sign-up p,
    .containerr.sign-up .img.sign-up img {
    transform: translateX(0);
    }

    /* Background */

    .containerr::before {
    content: "";
    position: absolute;
    top: 0;
    right: 0;
    height: 100vh;
    width: 300vw;
    transform: translate(35%, 0);
    background-image: linear-gradient(
      -45deg,
    #e14eca 0%,
      #ba54f5 50%,
    #e14eca 100%
    );
    transition: 1s ease-in-out;
    z-index: 6;
    box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.35);
    border-bottom-right-radius: max(50vw, 50vh);
    border-top-left-radius: max(50vw, 50vh);
    }

    .containerr.sign-in::before {
    transform: translate(0, 0);
    right: 50%;
    }

    .containerr.sign-up::before {
    transform: translate(100%, 0);
    right: 50%;
    }

    b#sign-in,
    b#sign-up {
    cursor: pointer;
    }

    @media only screen and (max-width: 996px) {


    .img.sign-in img {
      width: 37vw;
    }

    .img.sign-up img {
      width: 29vw;
    }

    .text {
      margin: 0rem;
    }
    }

    @media only screen and (max-width: 567px) {

      .col.align-center.flex-col{
        background:#1e1e2f;
      }
      .form.sign-in{
        padding: 20px;
      }
      .form.sign-up{
        padding: 20px;
      }
    .containerr::before,
    .containerr.sign-in::before,
    .containerr.sign-up::before {
      height: 100vh;
      border-bottom-right-radius: 0;
      border-top-left-radius: 0;
      z-index: 0;
      transform: none;
      right: 0;
    }

    .containerr.sign-in .col.sign-in,
    .containerr.sign-up .col.sign-up {
      transform: translateY(0);
    }

    .content-row {
      align-items: center !important;
      height: 30vh;
    }

    .content-row .col {
      transform: translate(10%, 20%);
      background-color: unset;
      height: 20%;
      padding: 0;
    }

    .col {
      width: 100%;
      position: absolute;
      padding: 2rem;
      background-color: var(--white);
      border-top-left-radius: 2rem;
      border-top-right-radius: 2rem;

      transform: translateY(100%);
      transition: 1s ease-in-out;
    }

    .row {
      align-items: flex-end;
      justify-content: flex-end;
    }

    .form,
    .social-list {
      box-shadow: none;
      margin: 0;
      padding: 0;
    }

    .text {
      margin: 0;
      width: 100%;
    }

    .text p {
      display: none;
    }

    .text h2 {
      font-size: 2.5rem;
        position: relative;
      top: -30px;
    }

    .img {
      display: none;
    }

    .text.sign-in {
      left: 2%;
      max-width: 100%;
    }
    .text.sign-up {
      left: 11%;
      max-width: 100%;
    }
    .col.align-center.flex-col.sign-up {
      left: 0px;
         top: 80px;
    height: 680px;
  }
  .col.align-center.flex-col.sign-in {
  left: 0px;
  top: 140px;
  height: 680px;
}
    .signup_content{

    bottom: 0px;
    margin-left: -25;
    margin-left: 3px;
    border-bottom-width: 20px;
    padding-bottom: 40px;

    }
    }
    .btn-primary {
      color: #ffffff;
      background-color: #e14eca;
      border-color: #e14eca;
      box-shadow: 0 4px 6px rgba(50, 50, 93, 0.11), 0 1px 3px rgba(0, 0, 0, 0.08);
    }

    .btn-primary:hover {
      color: #ffffff;
      background-color: #db2dc0;
      border-color: #d725bb;
    }

    .btn-primary:focus,
    .btn-primary.focus {
      box-shadow: 0 4px 6px rgba(50, 50, 93, 0.11), 0 1px 3px rgba(0, 0, 0, 0.08), 0 0 0 0 rgba(230, 105, 210, 0.5);
    }

    .btn-primary.disabled,
    .btn-primary:disabled {
      color: #ffffff;
      background-color: #e14eca;
      border-color: #e14eca;
    }

    .btn-primary:not(:disabled):not(.disabled):active,
    .btn-primary:not(:disabled):not(.disabled).active,
    .show>.btn-primary.dropdown-toggle {
      color: #ffffff;
      background-color: #d725bb;
      border-color: #cd23b2;
    }

    .btn-primary:not(:disabled):not(.disabled):active:focus,
    .btn-primary:not(:disabled):not(.disabled).active:focus,
    .show>.btn-primary.dropdown-toggle:focus {
      box-shadow: 0 0 0 0 rgba(230, 105, 210, 0.5);
    }

    </style>
  </head>
  <body>
    <?php if($veried_email==0){ ?>
<!-- containerr -->
<div class="containerr" id="containerr">
<!-- Row -->
<div class="row">
  <!-- Sign Up -->
  <div class="col align-center flex-col sign-up">
    <div style="padding-bottom:5px;"class="" id="display_error_message">

    </div>
    <div class="form-wrapper align-center">





      <form class="form sign-up" method="post" action="">

        <div class="input-group">
          <i class="bx bx-mail-send"></i>
          <input type="email" name="user_email" placeholder="Email" />
        </div>
        <div class="input-group">
          <i class="bx bxs-lock-alt"></i>
          <input type="password" name="password" placeholder="Password" />
        </div>
        <div class="input-group">
          <i class="bx bxs-lock-alt"></i>
          <input type="password" name="confirm_password"  placeholder="Confirm password" />
        </div>
        <!-- <div class="input-group">
          <i class="bx bxs-lock-alt"></i>
          <input type="password" name="security_key"  placeholder="Security Key" />
        </div> -->
        <button class="btn-primary"name="new_user_registration">Sign up</button>
        <p>
          <span>Already have an account?</span>
          <b  id="sign-in">Sign in here</b>
        </p>
      </form>








    </div>

    <!-- <div class="form-wrapper">
      <div class="social-list align-center sign-up">
        <div class="align-center facebook-bg">
          <i class="bx bxl-facebook"></i>
        </div>
        <div class="align-center google-bg">
          <i class="bx bxl-google"></i>
        </div>
        <div class="align-center twitter-bg">
          <i class="bx bxl-twitter"></i>
        </div>
        <div class="align-center insta-bg">
          <i class="bx bxl-instagram-alt"></i>
        </div>
      </div>
    </div> -->
  </div>
  <!-- End Sign Up -->
  <!-- Sign In -->
  <div class=" col align-center flex-col sign-in">
    <div class="form-wrapper align-center">

      <form class="" action="" method="post">
        <div class="login_error_message">

        </div>

        <?php if(isset($forgot_error_message) ){

      echo $forgot_error_message;


        }?>

      <div class="form sign-in">


        <p>
          <b onclick="forgotPassward()">Enter A Valid Email</b>
        </p>


        <div class="input-group">
          <i class="bx bxs-user"></i>
          <input type="email" name="user_email" id="user_email" placeholder="Email" />
        </div>




        <button type="submit"class="btn-primary btn-sm "name="verify_email">Verify</button>


<!-- <a href="#" style="color:white;"  class="btn btn-primary btn-block solid" id="sign-in-btn"  name="login_user" >Verify</a> -->

        <!-- <button name="login_user">Sign in</button> -->
          </form>



      </div>
    </div>

    <!-- <div class="form-wrapper">
      <div class="social-list align-center sign-in">
        <div class="align-center facebook-bg">
          <i class="bx bxl-facebook"></i>
        </div>
        <div class="align-center google-bg">
          <i class="bx bxl-google"></i>
        </div>
        <div class="align-center twitter-bg">
          <i class="bx bxl-twitter"></i>
        </div>
        <div class="align-center insta-bg">
          <i class="bx bxl-instagram-alt"></i>
        </div>
      </div>
    </div> -->
  </div>
  <!-- End Sign In -->
</div>

<!-- End Sign In -->

<!-- End Row -->
<!-- Content Section -->
<div class="row content-row signup_content">
  <!-- Sign In Content -->
  <div class="col align-items flex-col">
    <div class="text sign-in ">
      <h2 >Access error?</h2>
      <p style ="font-size:30px;">
 
Allow us to debug for you
      </p>
    </div>
    <div class="img sign-in">
      <img src="images/signin1.svg" alt="" />
    </div>
  </div>

  <!-- Sign Up Content -->
  <div class="col align-items flex-col">
    <div class="img sign-up">
      <img src="images/signup1.svg" alt="" />
    </div>
    <div class="text sign-up">
      <h2>Join with us</h2>
      <p>
        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quae et
        cumque consectetur illo accusamus impedit eos ut. Eos, odit
        facilis.
      </p>
    </div>
  </div>
</div>
</div>

<?php } ?>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script type="text/javascript">

    function forgotPassward(){
      $('.before').css('display','none');
      $('.after').css('display','block');

    }


    var containerr =document.querySelector(".containerr");
    var register_error_div = document.querySelector("#display_error_message");
    const signIn = document.getElementById("sign-in");
    const signUp = document.getElementById("sign-up");
    const toggle = () => {
    containerr.classList.toggle("sign-in");
    containerr.classList.toggle("sign-up");
    };



setTimeout(() => {
containerr.classList.add("sign-in");
}, 200);



signIn.addEventListener("click", toggle);
signUp.addEventListener("click", toggle);
$( "#sign-in-btn" ).on( "click", function() {




var user_email = document.getElementById("user_email").value;
var password = document.getElementById("password").value;


$.ajax({

   type: "POST",
   url: "admin/includes/login_user",
   data: {
     user_email: user_email,
     password:password





   },
   cache: false,
   success: function (data) {
     result = $.trim(data);
     if(result!="loginnow"){
     $('.login_error_message').html(data);
}
if(result=="loginnow"){
 window.location.replace("admin/includes/dashboard");

}


}
});



});
    </script>
  </body>
</html>
