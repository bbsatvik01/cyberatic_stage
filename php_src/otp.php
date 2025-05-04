<?php include "admin/includes/admin_header.php" ?>
<?php include "includes/db.php" ?>
<?php include "admin/includes/functions.php" ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="images/logo.png">
  <link rel="icon" type="image/png" href="images/logo.png">
  <title>
CYBERATIC RVITM - OTP
  </title>



<?php

$_SESSION["wrong_registration"] = "";




$verified=0;
$resent=0;
$not_verified=0;
$change_password_error=0;
$verify_otp_user=0;





if(isset($_POST["resend"])){
  $user_email=$_POST["user_email"];
 
  $resent=1;
  if(isset($_POST["password"])){
    $password=$_POST["password"];
  }
  $rndno=rand(100000, 999999);//OTP generate
  $otp=$rndno;
  $not_verified=0;
  $to_email = $user_email;
  $to_name = "Student";
  $email_subject ="OTP is Resent";
  $template_path ="admin/includes/email_templates/template_resend_otp.php";
  $mail_sent = send_email($to_email,$to_name,$otp,$email_subject,$template_path);
  if($mail_sent){
    
  }else{
     
  }
}



if(isset($_POST["send_otp"])){
    
  $user_email=$_POST["user_email"];
  $password=$_POST["password"];
  $rndno=rand(100000, 999999);//OTP generate
  $otp=$rndno;
  $to_email = $user_email;
  $to_name = "Student";
  $email_subject ="Email Verification";
  $template_path ="admin/includes/email_templates/template_email_verification.php";
  $mail_sent = send_email($to_email,$to_name,$otp,$email_subject,$template_path);
  if($mail_sent){
      
  }else{
      
  }
}





if(isset($_POST["forgot_otp"])){
  $user_email=$_POST["user_email"];
  $user_name=$_POST["user_name"];
  $rndno=rand(100000, 999999);//OTP generate
  $otp=$rndno;
  $to_email =$user_email;
  $to_name = $user_name;
  $email_subject ="Forgot Password";
  $template_path ="admin/includes/email_templates/template_forgot_password.php";
  $mail_sent = send_email($to_email,$to_name,$otp,$email_subject,$template_path);
  if($mail_sent){
  }else{
  }
}







if(isset($_POST["verify"])){
  $user_email=$_POST["user_email"];
  if(isset($_POST["password"])){
    $password=$_POST["password"];
  }
  $temp_otp=$_POST["otp"];
  $otp=$temp_otp;
  $digit1=$_POST["digit_1"];
  $digit2=$_POST["digit_2"];
  $digit3=$_POST["digit_3"];
  $digit4=$_POST["digit_4"];
  $digit5=$_POST["digit_5"];
  $digit6=$_POST["digit_6"];
  $digits=$digit1.$digit2.$digit3.$digit4.$digit5.$digit6;

  if($digits==$otp){
    $verified=1;

    if(!isset($_POST["password"])){
      $verify_otp_user=1;
    }
  }else{
    $not_verified=1;
  }
}



if(isset($_POST["verify_password"])){
$verify_otp_user=1;
$user_email=$_POST["user_email"];
$new_password=$_POST["new_password"];
$confirm_password=$_POST["confirm_password"];
$change_password_error=change_password($confirm_password,$new_password,$user_email);
if($change_password_error==1){
  $after_registration =false;
  $whattodo = login_user($user_email,$new_password,$after_registration);
  if($whattodo=="loginnow"){
    echo "<script type='text/javascript'>  window.location.replace('admin/includes/dashboard'); </script>";
  }
}
}
 ?>
<?php
if($verify_otp_user==1){
?>
  <div class="containerr" id="containerr">
    <!-- Row -->
    <div class="row">
      <!-- Sign Up -->

      <!-- End Sign Up -->
      <!-- Sign In -->
      

      <div class="col align-center flex-col sign-in">
          
          
<div class="form-wrapper align-center verify mt-0">

          
</div>

        
        <div class="form-wrapper align-center verify">

          <form class="" action="" method="post">
              <?php if($change_password_error<0){ ?>

              
<div class=" alert alert-warning alert-dismissible fade show" role="alert"> <strong>OOPS!!</strong> Passwords Don't Match. Please Try Again!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">  <span aria-hidden="true">&times;</span> </button>  </div>
            
                    <?php } ?>


          <div class="form sign-in">
          <p><h2 style="color:#ffff" class="title pb-3">Change Your Password</h2></p>

            <div class="input-group">

              <input type="hidden" name="user_email"  value="<?php echo $user_email ?>" placeholder="Email" />
            </div>

            <div class="input-group">
                <i class="bx bxs-lock-alt"></i>
              <input  name="new_password"  type="password" placeholder=" New Password" />
            </div>

            <div class="input-group">
                <i class="bx bxs-lock-alt"></i>
              <input  name="confirm_password" type="password" placeholder=" Re-Enter Password" />
            </div>
            <!-- <div class="input-group">

              <input  name="otp" value="<?php echo $rndno ?>" type="hidden" placeholder="Password" />
            </div> -->
            <button class="btn-primary"   name="verify_password">Verify</button>
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
  <?php
}
 ?>





    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link
      href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css"
      rel="stylesheet"
    />
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">

    <style media="screen">
    body{
      color:#ffff;
    }
    .text-primary {
      color: #e14eca !important;
    }
    .btn.btn-link,
    .navbar .navbar-nav>a.btn.btn-link {
      color: #344675;
    }

    .btn.btn-link:hover,
    .btn.btn-link:focus,
    .btn.btn-link:active,
    .navbar .navbar-nav>a.btn.btn-link:hover,
    .navbar .navbar-nav>a.btn.btn-link:focus,
    .navbar .navbar-nav>a.btn.btn-link:active {
      background-color: transparent !important;
      background-image: none !important;
      color: #ffffff !important;
      text-decoration: none;
      box-shadow: none;
    }

    a.text-primary:hover,
    a.text-primary:focus {
      color: #c221a9 !important;
    }
    .card1{
      margin-top: 100px;
      background-color: #27293d;
      color:#ffff;
      border-radius: 30px;
    }

  input.form-control{
      background-color: #27293d;
      color:#fff;
    }
    .inputs input {
        width: 40px;
        height: 40px
    }

    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        margin: 0
    }



    .form-control:focus {
        box-shadow: none;
        border: 2px solid #e14eca;
        background-color: #27293d;
          color:#fff;
    }

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
 height:660px;
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

      .form-wrapper.align-center.verify {

      position: absolute;
       right: 0;
       margin-right:200px;

      }

 @media only screen and (max-width: 567px){
     .form-wrapper.align-center.verify {

      position: fixed;
      right: 0;
      margin-right:0px;

      }
 }

    </style>
  </head>
  <body>
    <?php if($verify_otp_user==0){ ?>
<!-- containerr -->
<div class="containerr" id="containerr">
<!-- Row -->
<div class="row">
  <!-- Sign Up -->

  <!-- End Sign Up -->
  <!-- Sign In -->
  <div class=" col align-center flex-col sign-in">
    <div class="form-wrapper align-center verify">

      <div class="main-panel">
        <!-- Navbar -->


        <!-- End Navbar -->

          <div class="">
            <div class="">




              <div class="">
                <div class="">

                </div>
                <div class="">
                  <div style="display:none;" class="alert alert-warning alert-dismissible fade show wrong_otp" role="alert"> <small >Please verify the otp you have entered</small>!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">  <span aria-hidden="true">&times;</span> </button>  </div>
                  <!-- <div style="display:none;" class="alert alert-danger mt-3 wrong_otp">  <small >Please verify the otp you have entered</small> </div> -->

                  <div class="container height-100 d-flex justify-content-center align-items-center">
                      <div class="position-relative">
                          <div class=" pt-3 text-center">

    <?php if($resent==0 && $verified==0){ ?>
                                <h6></h6>

        <div> <span>A code has been sent to</span> <small><?php echo $user_email; ?></small> </div>
  <?php }
  elseif($resent==1 && $verified==0) {
    ?>
                            <div> <span>An OTP has been sent to</span> <small><?php echo $user_email; ?></small> </div>

       <?php
  } else{
    ?>
                     <div class="alert alert-success mt-3" role="alert">
                                            <h6 >YOUR VERIFICATION HAS BEEN SUCCESSFUL </h6>
                                              </div>
                                              <div> <span>Proceed to enter your details</span>  </div>

  <?php  } ?>


  <?php if($verified==0){ ?>

                              <form class="pt-4 pb-3" action="" method="post">
                                <input type="hidden" id="function_mail" name="user_email" value="<?php echo $user_email; ?>" placeholder="Your Email">

<?php if (isset($password)){ ?>
                                <input type="hidden" name="password" value="<?php echo $password; ?>" placeholder="Password">
<?php } ?>

                                <input type="hidden" id="function_otp"type="text" name="otp" value="<?php echo $otp; ?>" placeholder="Password">

                              <div id="otp" class="inputs d-flex flex-row justify-content-center mt-2">
                                <input name="digit_1" class="m-2 text-center form-control rounded" type="number" id="first" maxlength="1" />

                                 <input name="digit_2" class="m-2 text-center form-control rounded" type="number" id="second" maxlength="1" />
                                  <input name="digit_3" class="m-2 text-center form-control rounded" type="number" id="third" maxlength="1" />
                                  <input name="digit_4" class="m-2 text-center form-control rounded" type="number" id="fourth" maxlength="1" />
                                  <input name="digit_5" class="m-2 text-center form-control rounded" type="number" id="fifth" maxlength="1" />
                                   <input name="digit_6" class="m-2 text-center form-control rounded" type="number" id="sixth" maxlength="1" />
                                 </div>


                              <div class="mt-4 pb-2 pt-4"> <button name="verify" class="btn btn-primary btn-block validate">Validate</button> </div>
                              <div class="pb-3"><span class="float-right"> <small><button name="resend" class="  btn btn-link text-primary  validate">Resend OTP</button></small> </span>  </div>

                                 </form>

  <?php } ?>







  <?php if($verified==1){ ?>



                                 <form class="" action="admin/includes/details" method="post">
                                   <input type="hidden" name="user_email" value="<?php echo $user_email; ?>" placeholder="Your Email">


                                   <input type="hidden" name="password" value="<?php echo $password; ?>" placeholder="Password">



                                 <div class="mt-4 pb-4"> <button name="verified" class="btn btn-primary  validate">Next</button> </div>
                                    </form>
          <?php } ?>
                          </div>

                      </div>
                  </div>

                </div>
              </div>
            </div>
          </div>


      </div>
    </div>
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
      <h2 >Entering Space</h2>
      <p>
       good luck on your journey
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


    var error_after_registration = '<?php echo $_SESSION["wrong_registration"]; ?>';



setTimeout(() => {
containerr.classList.add("sign-in");
}, 200);





    </script>





























    <script>

    if(<?php echo $not_verified; ?>){

      $('.wrong_otp').css('display','block');
    }
    document.addEventListener("DOMContentLoaded", function(event) {

  function OTPInput() {
  const inputs = document.querySelectorAll('#otp > *[id]');
  for (let i = 0; i < inputs.length; i++) { inputs[i].addEventListener('keydown', function(event) { if (event.key==="Backspace" ) { inputs[i].value='' ; if (i !==0) inputs[i - 1].focus(); } else { if (i===inputs.length - 1 && inputs[i].value !=='' ) { return true; } else if (event.keyCode> 47 && event.keyCode < 58) { inputs[i].value=event.key; if (i !==inputs.length - 1) inputs[i + 1].focus(); event.preventDefault(); } else if (event.keyCode> 64 && event.keyCode < 91) { inputs[i].value=String.fromCharCode(event.keyCode); if (i !==inputs.length - 1) inputs[i + 1].focus(); event.preventDefault(); } } }); } } OTPInput(); });
      $(document).ready(function() {
        $().ready(function() {
          $sidebar = $('.sidebar');
          $navbar = $('.navbar');
          $main_panel = $('.main-panel');

          $full_page = $('.full-page');

          $sidebar_responsive = $('body > .navbar-collapse');
          sidebar_mini_active = true;
          white_color = false;

          window_width = $(window).width();

          fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();



          $('.fixed-plugin a').click(function(event) {
            if ($(this).hasClass('switch-trigger')) {
              if (event.stopPropagation) {
                event.stopPropagation();
              } else if (window.event) {
                window.event.cancelBubble = true;
              }
            }
          });

          $('.fixed-plugin .background-color span').click(function() {
            $(this).siblings().removeClass('active');
            $(this).addClass('active');

            var new_color = $(this).data('color');

            if ($sidebar.length != 0) {
              $sidebar.attr('data', new_color);
            }

            if ($main_panel.length != 0) {
              $main_panel.attr('data', new_color);
            }

            if ($full_page.length != 0) {
              $full_page.attr('filter-color', new_color);
            }

            if ($sidebar_responsive.length != 0) {
              $sidebar_responsive.attr('data', new_color);
            }
          });

          $('.switch-sidebar-mini input').on("switchChange.bootstrapSwitch", function() {
            var $btn = $(this);

            if (sidebar_mini_active == true) {
              $('body').removeClass('sidebar-mini');
              sidebar_mini_active = false;
              blackDashboard.showSidebarMessage('Sidebar mini deactivated...');
            } else {
              $('body').addClass('sidebar-mini');
              sidebar_mini_active = true;
              blackDashboard.showSidebarMessage('Sidebar mini activated...');
            }

            // we simulate the window Resize so the charts will get updated in realtime.
            var simulateWindowResize = setInterval(function() {
              window.dispatchEvent(new Event('resize'));
            }, 180);

            // we stop the simulation of Window Resize after the animations are completed
            setTimeout(function() {
              clearInterval(simulateWindowResize);
            }, 1000);
          });

          $('.switch-change-color input').on("switchChange.bootstrapSwitch", function() {
            var $btn = $(this);

            if (white_color == true) {

              $('body').addClass('change-background');
              setTimeout(function() {
                $('body').removeClass('change-background');
                $('body').removeClass('white-content');
              }, 900);
              white_color = false;
            } else {

              $('body').addClass('change-background');
              setTimeout(function() {
                $('body').removeClass('change-background');
                $('body').addClass('white-content');
              }, 900);

              white_color = true;
            }


          });

          $('.light-badge').click(function() {
            $('body').addClass('white-content');
          });

          $('.dark-badge').click(function() {
            $('body').removeClass('white-content');
          });
        });
      });
    </script>

  </body>
</html>
