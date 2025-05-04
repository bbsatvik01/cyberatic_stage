<?php include "includes/super_admin_header.php" ?>
<?php  include '../includes/db.php'; ?>
<?php include '../admin/includes/functions.php' ?>


<?php

$_SESSION["user_email"]      =       null;
$_SESSION["user_role"]       =       null;
$_SESSION["user_id"]         =       null;
$_SESSION["user_image"]      =       null;

session_destroy();

 ?>
<script>
    window.location.replace("login");

</script>
