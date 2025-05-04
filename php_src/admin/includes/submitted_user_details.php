<?php include "admin_header.php" ?>
<?php include "functions.php" ?>
<?php include "db.php" ?>


<?php

if (isset($_POST["user_skills"])) {
  $user_email         =      escape($_POST["user_email"]) ;
  $user_password      =      escape($_POST["user_password"]) ;
  $user_first_name    =      escape($_POST["user_first_name"]) ;
  $user_last_name     =      escape($_POST["user_last_name"]) ;
//   $user_image         =      $_FILES['image']['name'];
//   $user_image_temp    =      $_FILES['image']['tmp_name'];
  $user_branch        =      escape($_POST["user_branch"]) ;
  $user_semester      =      escape($_POST["user_semester"])  ;
  $user_description   =      escape ($_POST["user_description"]);
  $user_domain        =      escape($_POST["user_domain"])  ;

  $user_gender        =      escape ($_POST["user_gender"]);
  $user_skills        =      escape ($_POST["user_skills"]);
  $user_dob           =      $_POST["user_dob"];
  $password = password_hash($user_password, PASSWORD_BCRYPT);






    move_uploaded_file($user_image_temp,"../../images/$user_image");
    $query = "UPDATE  users SET user_password='$password', user_first_name='$user_first_name', user_last_name='$user_last_name',
    user_branch='$user_branch', user_semester='$user_semester',  user_description='$user_description',
        user_domain='$user_domain', user_skills='$user_skills', user_gender='$user_gender', user_dob='$user_dob',user_role=0 WHERE user_email='$user_email'";

    $user_details = mysqli_query($connection , $query);
    if(!$user_details){
      die("query failed".mysqli_error($connection));
    }else {
      // echo "string";
      // echo $user_email;
      // echo $user_password;
        // $password = openssl_decrypt(base64_decode($user_password));
// echo $user_password;
$after_registration = true;
$whattodo =   login_user($user_email,$user_password,$after_registration);
if($whattodo == "gotodashboard"){
   http_response_code(200);
}else {
   http_response_code(500);
}
    }



}


 ?>
