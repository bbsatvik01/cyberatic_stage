<?php include "admin_header.php" ?>
<?php include "db.php" ?>
<?php include "functions.php" ?>
<?php

if(isset($_POST['reported'])){
    
if(isset($_SESSION["user_role"]) && isset($_SESSION["user_domain"]) && isset($_SESSION["user_id"]) && isset($_SESSION["user_email"]) && $_SESSION["user_role"] > -1 && !empty($_SESSION["user_domain"]) && !empty($_SESSION["user_email"]))
{
  



    $post_id = escape($_POST['post_id']);
    $field = escape($_POST['field']);
    $reason = escape($_POST['reason']);
    $sender_email = escape($_POST['sender_email']);
$report_exists=   mysqli_query($connection,"SELECT * FROM   report WHERE report_post_id='$post_id' AND report_sender_email='$sender_email' AND report_field='$field' AND report_reason='$reason'");



if(!mysqli_num_rows($report_exists)){

  $reported=  mysqli_query($connection,"INSERT INTO  report(report_post_id,report_sender_email, report_field, report_reason) VALUES('{$post_id}','{$sender_email}','{$field}','{$reason}')");
  if(!$reported){
    echo "report_fail";
  }else{
    $reported_count=mysqli_query($connection,"UPDATE posts SET post_report_count=post_report_count+1 WHERE post_id = $post_id ");
    if(!$reported_count){
    echo "count_fail";
  }else{
    echo "success";
  }
  }

}else{
  echo "exists";
}
    exit();
  }
}