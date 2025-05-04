<?php  session_start(); ?>
<?php include "includes/db.php" ?>
<?php include "admin/includes/functions.php" ?>

<?php

$_SESSION["user_email"] = null;

$_SESSION["user_role"] =null;
$_SESSION["user_id"] = null;

session_destroy();
// header("Location: login.php");

 ?>

<script>
    window.location.replace("login");

</script>

