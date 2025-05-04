<?php include 'super_admin_header.php'; ?>
<?php  include '../../includes/db.php'; ?>
<?php include '../../admin/includes/functions.php' ?>

<?php

if(isset($_SESSION["user_role"]) &&  isset($_SESSION["user_id"]) && isset($_SESSION["user_email"]) && isset($_SESSION["user_image"])   && !empty($_SESSION["user_role"]) && !empty($_SESSION["user_email"]) && !empty($_SESSION["user_id"])
        && !empty($_SESSION["user_image"]) )
{




  $session_email           =          encrypt_decrypt($_SESSION["user_email"], 'decrypt');
  $session_role            =          encrypt_decrypt($_SESSION["user_role"], 'decrypt');
  $session_user_id         =          encrypt_decrypt($_SESSION["user_id"], 'decrypt');
  $session_user_image      =          encrypt_decrypt($_SESSION["user_image"], 'decrypt');

  if(isset($session_role) &&  $session_role == 4 || $session_role == 6 ){


$test_created_by = $session_email;


 ?>

<?php include "navigation.php"; ?>



<style >
  table.dataTable{
    bordor-collapse:collapse;
  }
  .table-dark{
    background-color: #212529;

  }
  /* div{
    display: inline;
  } */
</style>









<?php

if(isset($_POST["delete_test"])){

 $delete_test_name=$_POST["delete_test_name"];
 $deleted_test=mysqli_query($connection,"DELETE FROM tests WHERE test_name='$delete_test_name'");
 $deleted_test_users=mysqli_query($connection,"DELETE FROM score WHERE score_test_name='$delete_test_name'");

 if (!$deleted_test) {

      ?><div class="alert alert-danger"> <strong>Failed! </strong>Test Could Not Be Deleted. Try Again! Contact Admin!!!</div> <?php

 }
 else {
       ?><div class="alert alert-success"> <strong>Success! </strong>Test Deleted Succesfully</div> <?php

 }
 if (!$deleted_test_users) {

       ?><div class="alert alert-danger"> <strong>Failed! </strong>Test Users Could Not Be Deleted. Try Again! Contact Admin!!!</div> <?php

 }

 }





 ?>


<h3 class="text-center pb-3 text-muted">All Tests Of Coding Club</h3>



<?php

if (isset($_POST["edit_test"])) {

$test_encoded=$_POST["test_encoded"];
$form_sent_edit_test_id = $_POST["test_id"];

$edit_test_name  =  escape($_POST["test_name"]);




?>


<div class="container">
    <form enctype="multipart/form-data" class="" action="" method="post">
        <h2 class="text-center pb-3 pt-3">Edit test</h2>
    <div class="row jumbotron">


      <div class="col-sm-6 form-group">
                <label for="address-1">Test Name</label>
                <input type="text" class="form-control" name="test_name" value="<?php echo $edit_test_name; ?>" id="" placeholder="Enter Test Name." required>
            </div>

            <div class="col-sm-6 form-group">
                <label for="name-f">Test File</label>
                <input type="file" class="form-control" name="test_file" value="" id="" placeholder="Enter Test file." >

            </div>




            <input type="hidden" name="test_encoded" value="<?php echo $test_encoded; ?>">

            <input type="hidden" name="old_test_name" value="<?php if (isset($edit_test_name)) {echo $edit_test_name;} ?>">

<input type="hidden" name="test_id" value="<?php if (isset($form_sent_edit_test_id)) {echo $form_sent_edit_test_id;} ?>">



        <div class="col-sm-12 form-group mb-0">
            <a href="view_all_tests.php" class="btn btn-secondary"> Cancel</a>
           <button class="btn btn-primary float-right" name="submit_edit_test">Update Test</button>
        </div>

    </div>
    </form>
</div>

<?php
}





if(isset($_POST["submit_edit_test"])){

$test_decoded = json_decode(base64_decode($_POST['test_encoded'])); // Server side


$test_exists=0;

$old_test_name=$_POST["old_test_name"];
$form_sent_edit_test_id= $_POST["test_id"];
$test_created_by = $session_email;


  $test_name=$_POST["test_name"];


for ($i=0; $i < count($test_decoded) ; $i++) {
  if($old_test_name != $test_name){


  if($test_name == $test_decoded[$i]->test_name){
    ?><div class="alert alert-danger"> <strong>Failed! </strong> Test Name Already Exists</div> <?php

    $test_exists=1;

  }
    }
}


  if(!$test_exists){
  $filename = $_FILES['test_file']['name'];



  if(empty($filename)){
    $Update_test_without_file = "UPDATE tests SET test_name='{$test_name}' , test_created_by = '{$test_created_by}' WHERE    test_id =  $form_sent_edit_test_id ";
    if (mysqli_query($connection, $Update_test_without_file)) {




         $Update_score = "UPDATE score SET score_test_name='{$test_name}' WHERE    score_test_name =  '$old_test_name' ";
       if (mysqli_query($connection, $Update_score)){


         ?><div class="alert alert-success"> <strong>Success! </strong> Test Updated Succesfully</div> <?php

       }



  }
}
  else {
     // destination of the file on the server
     $destination = '../../file-upload-download/uploads/' . $filename;

     // get the file extension
     $extension = pathinfo($filename, PATHINFO_EXTENSION);

     // the physical file on a temporary uploads directory on the server
     $file = $_FILES['test_file']['tmp_name'];
     $size = $_FILES['test_file']['size'];

     if (!in_array($extension, ['zip', 'pdf', 'docx'])) {
            ?><div class="alert alert-danger"> <strong>Failed! </strong> You file extension must be .zip, .pdf or .docx</div> <?php

     } elseif ($_FILES['test_file']['size'] > 40000000) { // file shouldn't be larger than 1Megabyte
       ?><div class="alert alert-danger"> <strong>Failed! </strong> File Too Large. Upload a Smaller File! </div> <?php
     } else
     {
         // move the uploaded (temporary) file to the specified destination
         if (move_uploaded_file($file, $destination))
         {
             $Update_test = "UPDATE tests SET test_name='{$test_name}', test_file='{$filename}', test_file_size='{$size}',test_created_by = '{$test_created_by}'WHERE    test_id =  $form_sent_edit_test_id ";

             if (mysqli_query($connection, $Update_test))
              {

                $Update_test = "UPDATE score SET score_test_name='{$test_name}' WHERE    score_test_name =  '$old_test_name' ";
              if (mysqli_query($connection, $Update_test)){


                ?><div class="alert alert-success"> <strong>Success! </strong> Test Updated Succesfully</div> <?php

              }

             }
             }
             }
             }
            }
             }

             $query = "SELECT * FROM tests ORDER BY test_id DESC";
             $test_details = mysqli_query($connection,$query);
             if(!$test_details){
             die("query failed".mysqli_error($connection));
             }
                $test_array=array();
             while ($row = mysqli_fetch_assoc($test_details)) {
               $test_array[]=$row;

            }
$test_encoded= base64_encode(json_encode($test_array));




 ?>










<!-- <div class="row pb-5">
  <div class="col-md-4">
    <p>Search by Domain Name :</p>
    <div class="input-group">
      <div class="form-outline">
        <input type="text" id="myInput" onkeyup="myFunction()"   class="form-control" >
      </div>
      <button id="search-button" type="button" class="btn btn-primary">
        <i class="fa fa-search"></i>
      </button>
    </div>
  </div>



  <div class="col-md-4">
    <p>Search by Event Registration Date :</p>
    <div class="input-group">
      <div class="form-outline">
        <input type="date" id="myInput2" onkeyup="myFunction()2"   class="form-control" >

      </div>
      <button id="search-button" type="button" class="btn btn-primary">
        <i class="fa fa-search"></i>
      </button>
    </div>
  </div>

</div> -->
            <table class="table  table-dark table-hover" id="test_table">
            	<thead class="thead-light">
            		<tr>
            		    <th>S.No</th>
                        <th> Name</th>
                        <th>Created By</th>
                        <th> File </th>
                        <th>Users Count</th>
                        <th>View Test Users </th>
            			<th >Options</th>
                  <th >Options</th>




            			<!-- <th></th> -->
            		</tr>
            	</thead>
                <tbody>


                                <?php
                                $i =1;


                                foreach ($test_array as $test ) {


                                $test_id              =       $test["test_id"];
                                $test_name            =       $test["test_name"];
                                $test_created_by      =       $test["test_created_by"];

                                $test_file            =       $test["test_file"];
                                $test_users_count     =       $test["test_users_count"];






                                ?>
                                <tr>
                                <td><?php echo $i; ?></td>
                                <td ><?php if (isset($test_name)) {echo $test_name;} ?></td>
                                  <td ><?php if (isset($test_created_by)) {echo $test_created_by;} ?></td>
                                <!-- <td><a href="downloads.php?file_id=<?php if (isset($test_id)) {echo $test_id;} ?>">Download</a></td> -->
                                <td><a target="_blank" class="btn btn-secondary btn-sm" href="../../file-upload-download/uploads/<?php echo $test_file; ?>">View File</a></td>



                                  <td><?php if (isset($test_users_count)) {echo $test_users_count;} ?></td>
                                <td>
                                <form class="" action="view_test_users.php" method="post">
                                    <input type="hidden" name="test_name" value="<?php echo $test_name; ?>">

                                    <button type="submit" name="view_test_users"  data-id="<?php echo $view_test_users; ?>" class="btn btn-primary btn-primary"> View Test Users </button>
                                </form>
                                </td>


                                <td>

                                        <form class="" action="" method="post">
                                          <input type="hidden" name="test_name" value="<?php echo $test_name; ?>">
                                          <input type="hidden" name="test_encoded" value="<?php echo $test_encoded; ?>">
                                        <input type="hidden" name="test_id" value="<?php echo $test_id; ?>">
                                        <button type="submit" name="edit_test" class="btn btn-warning">  <i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                        </form>
                                 </td>

                                 <td>


                                        <button type="submit" name="delete_test"  data-test_name="<?php echo $test_name; ?>" class="btn btn-danger confirm-delete">  <i class="fa fa-trash-o" aria-hidden="true"></i></button>

                                 </td>

                               </tr>

                                <?php
                                            $i++; }
                                                ?>
                </tbody>
</table>

<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div style="background-color:#dc3545" class="modal-header ">
    <h3 class="" id="myModalLabel">Delete Confirmation</h3>
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

	</div>
	<div class="modal-body">
		<p class="modal_content"></p>
	</div>
	<div class="modal-footer">
		<button class="btn mb-3" data-dismiss="modal" aria-hidden="true">Close</button>
    <form class="" action="" method="post">
      <input type="hidden" id="post_id" name="delete_test_name" value="">
      <button type="submit" name="delete_test" class="btn btn-danger">Delete</button>
    </form>
	</div>
</div>
</div>
</div>











<!-- <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name"> -->
<script>




$('.confirm-delete').on('click', function(e) {
  console.log("yess");
    e.preventDefault();

    var test_name = $(this).data('test_name');
    var modal_text= "Do you really want to delete "+test_name+"  test?";
    $('#myModal').data('id', test_name).modal('show');
    $(".modal-footer #post_id").val( test_name );
       $(" .modal_content").text(modal_text);
});

$('#btnYes').click(function() {
    // handle deletion here
  	var id = $('#myModal').data('id');
  	$('[data-id='+id+']').remove();
  	$('#myModal').modal('hide');
});


function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  console.log(input);
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  console.log(table);
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    console.log(tr.length);
    td = tr[i].getElementsByTagName("td")[3];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}


function myFunction2() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput2");
  console.log(input);
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  console.log(table);
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    console.log(tr.length);
    td = tr[i].getElementsByTagName("td")[3];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
$(document).ready(function(){
     $('#test_table').DataTable();
});
</script>

<?php
  }else{
      echo " You are not authorized to visit the page";
  }
}else {
  echo "Please go back to login page and return back";
}


 ?>
