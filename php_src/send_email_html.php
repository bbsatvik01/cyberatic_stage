<?php include "includes/header.php" ?>
<?php include "includes/db.php" ?>
<?php include "admin/includes/functions.php" ?>


<?php


$to_email = "satvikrs_is19.rvitm@rvei.edu.in";
$to_name = "B B Satvik";
$otp ="";
$email_subject ="Welcome To Cyberatic";
$template_path ="admin/includes/email_templates/template_welcome.php";
$mail_sent = send_email($to_email,$to_name,$otp,$email_subject,$template_path);
if($mail_sent){
    echo "successs";
}else{
    echo"fail";
}
?>