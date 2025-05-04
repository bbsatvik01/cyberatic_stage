<?php

function escape($string){
  global $connection;
  return mysqli_real_escape_string($connection,trim($string));
}


function encrypt_decrypt($string, $action = 'encrypt')
{
    $encrypt_method = "AES-256-CBC";
    $secret_key = 'WHY5YOUWANTFIND?/4.,><SDSCV3FDGCC}||6fweffASD'; // user define private key
    $secret_iv = '5fgf5HJ5g27'; // user define secret key
    $key = hash('sha256', $secret_key);
    $iv = substr(hash('sha256', $secret_iv), 0, 16); // sha256 is hash_hmac_algo
    if ($action == 'encrypt') {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    } else if ($action == 'decrypt') {
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }
    return $output;
}





function email_exsists($user_email){
  global $connection;
  $query = "SELECT user_email FROM users WHERE user_email ='$user_email'";
  $email_check_query = mysqli_query($connection,$query);
  if(!$email_check_query){
    echo "email_check_query failed".mysqli_error($connection);
  }
  $row = mysqli_num_rows($email_check_query);
  if($row > 0){
    return true;
  }else {
    return false;
  }
}

function email_valid($user_email,$user_security_key){
  global $connection;
  $query = "SELECT user_security_key, user_role FROM users WHERE user_email ='$user_email'";
  $email_check_query = mysqli_query($connection,$query);
  if(!$email_check_query){
    echo "email_check_query failed".mysqli_error($connection);
  }

  $email=0;
  $key=0;
     $row = mysqli_fetch_assoc($email_check_query);

  if($row["user_role"]==-2){
    $email=1;
    if($row["user_security_key"]==$user_security_key){

      $key=1;
    }else{
      $key=0;
    }
  }else {
    $email=0;
    if($row["user_security_key"]==$user_security_key){

      $key=1;
    }else{
      $key=0;
    }
  }
  return array($email,$key);
}



function register_user($user_email,$password,$confirm_password){

  global $connection;

  $user_email = $_POST["user_email"];
  $password = $_POST["password"];
  $confirm_password = $_POST["confirm_password"];

if ($password == $confirm_password ) {

  if(!empty($confirm_password) && !empty($email) && !empty($password) &&  !email_exsists($user_email)) {

    $user_email = mysqli_real_escape_string($connection,$user_email);
    $password= mysqli_real_escape_string($connection,$password);
    $password = password_hash($password, PASSWORD_BCRYPT);


    $query = "INSERT INTO users(user_email,user_password)
              VALUES ('{$user_email}','{$password}')";
    $register_query = mysqli_query($connection,$query);
    if(!$register_query){
      die("failed register query :" .mysqli_error($connection));
    }
    $message = "Registration sucessfull ";
  }

}else {
  $message = "Password and Confirm password not same";
}



}



function login_user($user_email,$password,$after_registration){

global $connection;

  if (isset($user_email) && isset($password)) {

  $message_error_login ="";
  $user_email =  $user_email;
  $password   =  $password;


  $user_email = trim($user_email);
  $password = trim($password);
  $user_email = mysqli_real_escape_string($connection,$user_email);
  $password= mysqli_real_escape_string($connection,$password);

  $query = "SELECT * FROM users WHERE user_email = '{$user_email}' ";
  $found_user = mysqli_query($connection,$query);
  if(!$found_user){

   die("QUERY FAILED ".mysqli_error($connection));

  }elseif (empty(mysqli_num_rows($found_user))) {

  $message_error_login = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
     <strong>OOPS!!</strong> check the email once , the mail is not yet registered please register first
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">  <span aria-hidden="true">&times;</span> </button>
  </div>';

  }
  else {
    // print_r($found_user);
    while($row = mysqli_fetch_assoc($found_user)){


      $db_user_email            =           $row["user_email"];
      $db_user_password         =           $row["user_password"];
      $db_user_id               =           $row["user_id"];
      $db_user_role             =           $row["user_role"];
      $db_user_domain           =           $row["user_domain"];
      $db_user_image            =           $row["user_image"];
      $db_user_theme_setting    =           $row["user_theme_setting"];


    }


    // $password = crypt($password,$db_user_password);


    if(password_verify($password,$db_user_password)){



    if($db_user_role > -1){
      $_SESSION["user_email"]               =           encrypt_decrypt($db_user_email, 'encrypt');
      $_SESSION["user_role"]                =           encrypt_decrypt($db_user_role, 'encrypt');
      $_SESSION["user_id"]                  =           encrypt_decrypt($db_user_id, 'encrypt');
      $_SESSION["user_domain"]              =           encrypt_decrypt($db_user_domain, 'encrypt');
      $_SESSION["user_image"]               =           encrypt_decrypt($db_user_image, 'encrypt');
      $_SESSION["user_theme_setting"]       =           encrypt_decrypt($db_user_theme_setting, 'encrypt');
      $_SESSION["login_message"]            =           1;
if($after_registration == false){
 return "loginnow";
}else {
  return "gotodashboard";
}

    }else {

      $message_error_login = ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
         <strong>OOPS!!</strong> Your account has been deactivated by admin please contact admin
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">  <span aria-hidden="true">&times;</span> </button>
      </div>';

    }


    }
    else {

    $message_error_login = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
       <strong>OOPS!!</strong> Password is wrong please try again
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">  <span aria-hidden="true">&times;</span> </button>
    </div>';

    }
  }




  }



  return $message_error_login;
}







function login_super_admin($user_email,$password,$security_key){

global $connection;

  if (isset($user_email) && isset($password)  && isset($security_key)) {

  $message_error_login ="";
  $user_email             =         $user_email;
  $password               =         $password;
  $user_security_key      =         $security_key;


  $user_email             =         trim($user_email);
  $password               =         trim($password);
  $user_security_key      =         trim($user_security_key);


  $user_email             =        mysqli_real_escape_string($connection,$user_email);
  $password               =        mysqli_real_escape_string($connection,$password);
  $user_security_key      =        mysqli_real_escape_string($connection,$user_security_key);

  $query = "SELECT * FROM users WHERE user_email = '{$user_email}' ";
  $found_user = mysqli_query($connection,$query);
  if(!$found_user){

   die("QUERY FAILED ".mysqli_error($connection));

  }elseif (empty(mysqli_num_rows($found_user))) {

  $message_error_login = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
     <strong>OOPS!!</strong> check the email once , the mail is not registered
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">  <span aria-hidden="true">&times;</span> </button>
  </div>';

  }
  else {

          while($row = mysqli_fetch_assoc($found_user)){


            $db_user_email            =           $row["user_email"];
            $db_user_password         =           $row["user_password"];
            $db_user_security_key     =           $row["user_security_key"];
            $db_user_id               =           $row["user_id"];
            $db_user_role             =           $row["user_role"];
            $db_user_image            =           $row["user_image"];

          }




          if(password_verify($password,$db_user_password)){

                  if($db_user_security_key == $user_security_key){

                          if($db_user_role > 0 ){
                                  $_SESSION["user_email"]       =            encrypt_decrypt($db_user_email, 'encrypt');
                                  $_SESSION["user_role"]        =            encrypt_decrypt($db_user_role, 'encrypt');
                                  $_SESSION["user_id"]          =            encrypt_decrypt($db_user_id, 'encrypt');
                                  $_SESSION["user_image"]       =            encrypt_decrypt($db_user_image, 'encrypt');


                                      return "login_super_admin";

                            } else {

                                  $message_error_login = ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                     <strong>OOPS!!</strong> Your account Doesnot have super admin powers
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">  <span aria-hidden="true">&times;</span> </button>
                                  </div>';

                          }


                }else {
                    $message_error_login = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                       <strong>OOPS!!</strong> Security Key  is wrong please try again
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">  <span aria-hidden="true">&times;</span> </button>
                    </div>';
                  }

        }else {

          $message_error_login = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
             <strong>OOPS!!</strong> Password is wrong please try again
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">  <span aria-hidden="true">&times;</span> </button>
          </div>';

          }



    }




  }



  return $message_error_login;
}





function change_password ($re_Confirmed_password,$new_password,$user_form_email){

  global $connection;



          if ($re_Confirmed_password == $new_password) {
                  $new_password = password_hash($re_Confirmed_password, PASSWORD_BCRYPT);

                  $query = "UPDATE users SET user_password = '{$new_password}'  WHERE user_email = '{$user_form_email}'";

                      $user_details = mysqli_query($connection , $query);
                          if(!$user_details){
                                die("query failed".mysqli_error($connection));
                                $change_password_error =-1;
                          }else {
                                $change_password_error = 1;
                         }
          }else {
            $change_password_error = -2;
          }





  return $change_password_error;


}


function forgot_email_exsists($user_email){
  global $connection;
  $query = "SELECT * FROM users WHERE user_email ='$user_email' AND user_role>-1 ";
  $email_check_query = mysqli_query($connection,$query);
  if(!$email_check_query){
    echo "email_check_query failed".mysqli_error($connection);

  }else{
  $row = mysqli_num_rows($email_check_query);

 if($row > 0){
    $row1 = mysqli_fetch_assoc($email_check_query);
    $user_first_name= $row1["user_first_name"];
    $user_last_name= $row1["user_last_name"];

     return array(1,$user_first_name,$user_last_name);
  }else {
    return array(0);
  }
}
}



function send_email($to_email,$to_name,$otp,$mail_subject,$template_path){

$to_email = $to_email;
$to_name =$to_name;
$otp = $otp;
$mail_subject = $mail_subject;

   

	$template_file = $template_path;
	


	$email_from = "CYBERATIC RVITM <satvikballa19@gmail.com>";


	$swap_var = array(
		"{SITE_ADDR}" => "https://cyberaticrvitm.com",
		"{EMAIL_LOGO}" => "https://upload.wikimedia.org/wikipedia/commons/2/2f/Logo_TV_2015.svg",
		"{EMAIL_TITLE}" => $mail_subject,
		"{TO_NAME}" => $to_name,
		"{TO_EMAIL}" => $to_email,
		"{OTP}"=>$otp
	);


	$email_headers = "From: ".$email_from."\r\nReply-To: ".$email_from."\r\n";
	$email_headers .= "MIME-Version: 1.0\r\n";
	$email_headers .= "Content-Type: text/html; charset=ISO-8859-1 \r\n";

   
	$email_to = $swap_var['{TO_EMAIL}'];
	$email_subject = $swap_var['{EMAIL_TITLE}']; 


	if (file_exists($template_file))
		$email_message = file_get_contents($template_file);
	else
		die ("Unable to locate your template file");


	foreach (array_keys($swap_var) as $key){
		if (strlen($key) > 2 && trim($swap_var[$key]) != '')
			$email_message = str_replace($key, $swap_var[$key], $email_message);
			
	}


	if ( mail($email_to, $email_subject, $email_message, $email_headers) ){
	   return true;
	   
	}
	     
	
	else
		 return false;


}


 ?>
