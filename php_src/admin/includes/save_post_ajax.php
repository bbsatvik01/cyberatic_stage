<?php include "admin_header.php" ?>
<?php include "db.php" ?>
<?php include "functions.php" ?>


<?php


if(isset($_SESSION["user_role"]) && isset($_SESSION["user_domain"]) && isset($_SESSION["user_id"]) && isset($_SESSION["user_email"]) && $_SESSION["user_role"] > -1 && !empty($_SESSION["user_domain"]) && !empty($_SESSION["user_email"]))
{
$session_email           =          encrypt_decrypt($_SESSION["user_email"], 'decrypt');
$session_user_id         =          encrypt_decrypt($_SESSION["user_id"], 'decrypt');

  if(isset($_POST['user_fav'])){
    $existing_fav_arr = array();
    $post_id = $_POST['post_id'];
    $flag = "";
    $for_user_fav = mysqli_query($connection,"SELECT 	user_favourite FROM users WHERE user_email = '$session_email' AND user_id = $session_user_id");
    if($for_user_fav){
      $for_user_fav = mysqli_fetch_array($for_user_fav);
      $user_fav = $for_user_fav['user_favourite'];
       if(strlen($user_fav)){
         $existing_fav_arr = explode (",", $user_fav);

       }else {
         $existing_fav_arr = array();
       }

        $if_saved = in_array($post_id,$existing_fav_arr);
        if($if_saved){
          $flag = "exists";
          echo $flag;

        }else {
          array_push($existing_fav_arr,$post_id);
          if(count($existing_fav_arr) == 0){
            $stringed_array = $existing_fav_arr;
          }else {
            $stringed_array = implode(",",$existing_fav_arr);

          }


          $update_query = mysqli_query($connection,"UPDATE users SET user_favourite = '{$stringed_array}' WHERE user_email = '$session_email' AND user_id = $session_user_id");
          if($update_query){
            $flag = "success";
            echo $flag;

          }else {
            $flag = "fail";
            echo $flag;


          }
        }



    }

  }



  if(isset($_POST['user_fav_unsave'])){
    $post_id = $_POST['post_id'];
    $flag = "";
    $for_user_fav = mysqli_query($connection,"SELECT 	user_favourite FROM users WHERE user_email = '$session_email' AND user_id = $session_user_id");
    if($for_user_fav){
      $for_user_fav = mysqli_fetch_array($for_user_fav);
      $user_fav = $for_user_fav['user_favourite'];
      $existing_fav_arr = explode (",", $user_fav);

     $new_array=array_diff($existing_fav_arr,array($post_id));
     $stringed_array = implode(",",$new_array);
     if(!in_array($post_id,$new_array)){
       $update_query = mysqli_query($connection,"UPDATE users SET user_favourite = '{$stringed_array}' WHERE user_email = '$session_email' AND user_id = $session_user_id");
       if($update_query){
         $flag = "success";
         echo $flag;

       }else {
         $flag = "fail";
         echo $flag;


       }
     }else {
       $flag = "fail";
       echo $flag;
     }



   }else {
     $flag = "dbfail";
     echo $flag;
   }
  }









}



 ?>
