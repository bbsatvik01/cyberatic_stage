<?php include "includes/super_admin_header.php"; ?>
<?php  include '../includes/db.php'; ?>
<?php include '../admin/includes/functions.php'; ?>

<?php $_SESSION["wrong_registration"] =""; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/login.css">


    <title>Admin Login</title>

  </head>
  <body>

<div class="containerr sign-in" id="containerr">
<!-- Row -->
<div class="row">
  <!-- Sign Up -->
  <div class="col align-center flex-col sign-up">
    <div style="padding-bottom:5px;"class="" id="display_error_message">

    </div>
    <!-- <div class="form-wrapper align-center">





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
        <div class="input-group">
          <i class="bx bxs-lock-alt"></i>
          <input type="text" name="security_key"  placeholder="Security Key" />
        </div>
        <button name="new_user_registration">Sign up</button>
        <p>
          <span>Already have an account?</span>
          <b  id="sign-in">Sign in here</b>
        </p>
      </form>








    </div> -->


  </div>


  <div class="col align-center flex-col sign-in">


    <div class="form-wrapper align-center">
      <form class="" action="" >
        <div class="login_error_message">

        </div>
        <?php if(isset($message_error_login) ){

      echo $message_error_login;


        }?>

      <div class="form sign-in">
        <div class="input-group">
          <i class="bx bxs-user"></i>
          <input type="email" name="user_email" id="user_email" placeholder="Email" />
        </div>
        <div class="input-group">
          <i class="bx bxs-lock-alt"></i>
          <input name="password" name="login_user" id="password" type="password" placeholder="Password" />
        </div>

        <div class="input-group">
          <i class="bx bxs-lock-alt"></i>
          <input type="password" name="security_key"  placeholder="Security Key"  id="security_key"/>
        </div>

<a href="#" class="btn btn-primary solid" id="sign-in-btn"  name="login_user" >Login</a>

          </form>
        <p>
          <b>Forgot password?</b>
        </p>
        <p>

        </p>
      </div>
    </div>


  </div>
  <!-- End Sign In -->
</div>
<!-- End Row -->
<!-- Content Section -->
<div class="row content-row signup_content">
  <!-- Sign In Content -->
  <div class="col align-items flex-col">
    <div class="text sign-in ">
      <h2>Welcome Back Admin</h2>
      <p>
      Got a lot of work and responsibily login and do your work ASAP and easily
      </p>
    </div>
    <div class="img sign-in">
      <img src="../images/signin.svg" alt="" />
    </div>
  </div>

  <!-- Sign Up Content -->
  <!-- <div class="col align-items flex-col">
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
  </div> -->
</div>
</div>




<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script type="text/javascript">
    var error_after_registration = '<?php echo $_SESSION["wrong_registration"]; ?>';

    var containerr =document.querySelector(".containerr");
    var register_error_div = document.querySelector("#display_error_message");
    // const signIn = document.getElementById("sign-in");
    // const signUp = document.getElementById("sign-up");
    // const toggle = () => {
    // containerr.classList.toggle("sign-in");
    // containerr.classList.toggle("sign-up");
    // };
    if(error_after_registration != ""){

        containerr.classList.add("sign-up");
        // signIn.addEventListener("click", toggle);
        // signUp.addEventListener("click", toggle);
        register_error_div.innerHTML += error_after_registration;
          containerr.removeClass("sign-in");

    }


setTimeout(() => {
containerr.classList.add("sign-in");
}, 200);



// signIn.addEventListener("click", toggle);
// signUp.addEventListener("click", toggle);


    
$( "#sign-in-btn" ).on( "click", function() {
  console.log("sss");




var user_email = document.getElementById("user_email").value;
var password = document.getElementById("password").value;
var security_key = document.getElementById("security_key").value;



$.ajax({

   type: "POST",
   url: "includes/login_super_admin",
   data: {
     user_email: user_email,
     password:password,
     security_key:security_key





   },
   cache: false,
   success: function (data) {
     result = $.trim(data);
     if(result=="login_super_admin"){
      window.location.replace("includes/dashboard");
    
}
else{
  $('.login_error_message').html(data);

}
}
});



});

    </script>
  </body>
</html>
