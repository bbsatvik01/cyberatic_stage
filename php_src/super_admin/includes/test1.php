<?php include "navigation.php"; ?>


<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<!-- <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script> -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />














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


<h3 class="text-center pb-3 text-muted">All Notifications Of Coding Club</h3>



<?php

if (isset($_POST["edit_test"])) {


$form_sent_edit_test_id = $_POST["test_id"];

$edit_test_name  =  escape($_POST["test_name"]);

echo $edit_test_name;


?>

<h4>Edit Form</h4>

<div class="container">
    <form enctype="multipart/form-data" class="" action="" method="post">
        <h2 class="text-center">Edit test</h2>
    <div class="row jumbotron">


      <div class="col-sm-6 form-group">
                <label for="address-1">Test Name</label>
                <input type="text" class="form-control" name="test_name" value="<?php echo $edit_test_name; ?>" id="" placeholder="Enter Test Name." required>
            </div>

            <div class="col-sm-6 form-group">
                <label for="name-f">Test File</label>
                <input type="file" class="form-control" name="test_file" value="" id="" placeholder="Enter Test file." >

            </div>





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



$test_exists=0;

$old_test_name=$_POST["old_test_name"];

 $form_sent_edit_test_id= $_POST["test_id"];


  $test_name=$_POST["test_name"];

  $query = "SELECT * FROM tests";
  $test_details = mysqli_query($connection,$query);
  if(!$test_details){
  die("query failed".mysqli_error($connection));
  }

  while ($row = mysqli_fetch_assoc($test_details)) {

    if($test_name==$row["test_name"]){
      ?><div class="alert alert-danger"> <strong>Failed! </strong> Test Name Already Exists</div> <?php

      $test_exists=1;

    }
  }

  if(!$test_exists){
  $filename = $_FILES['test_file']['name'];



  if(empty($filename)){
    $Update_test_without_file = "UPDATE tests SET test_name='{$test_name}' WHERE    test_id =  $form_sent_edit_test_id ";
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
             $Update_test = "UPDATE tests SET test_name='{$test_name}', test_file='{$filename}', test_file_size='{$size}' WHERE    test_id =  $form_sent_edit_test_id ";

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






 ?>










<div class="row pb-5">
  <div class="col-md-4">
    <p>Search by Domain Name :</p>
    <div class="input-group">
      <div class="form-outline">
        <input type="text" id="myInput" onkeyup="myFunction()"   class="form-control" >
        <!-- <label class="form-label" for="form1">Search</label> -->
      </div>
      <button id="search-button" type="button" class="btn btn-primary">
        <i class="fa fa-search"></i>
      </button>
    </div>
  </div>

<!--

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
  </div> -->

</div>
<?php
$i =1;



$query = "SELECT * FROM tests";
$test_details = mysqli_query($connection,$query);
if(!$test_details){
die("query failed".mysqli_error($connection));
}
?>
            <table class="table table-dark table-striped table-hovered" id="employee_data">
            	<thead class="thead-light">
            		<tr>
            		    <th>S.No</th>
                        <th> Name</th>
                        <th> File </th>

                        <th> Users </th>
            			<th >Options</th>



            			<th>options</th>
            		</tr>
            	</thead>



  <?php
                                while ($row = mysqli_fetch_assoc($test_details)) {

                                $test_id              =       $row["test_id"];
                                $test_name            =       $row["test_name"];
                                $test_file            =       $row["test_file"];






                                ?>
                                <tr>
                                <td><?php echo $test_id ?></td>
                                <td ><?php  echo $test_name; ?></td>
                                <td><a target="_blank" class="btn btn-secondary btn-sm" href="../../file-upload-download/uploads/<?php echo $test_file; ?>">View File</a></td>




                                <td>
                                <form class="" action="view_test_users.php" method="post">
                                    <input type="hidden" name="test_name" value="<?php echo $test_name; ?>">

                                    <button type="submit" name="view_test_users"  data-id="<?php echo $view_test_users; ?>" class="btn btn-primary "> View Users </button>
                                </form>
                                </td>


                                <td>

                                        <form class="" action="" method="post">
                                          <input type="hidden" name="test_name" value="<?php echo $test_name; ?>">

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

$(document).ready(function(){
     $('#employee_data').DataTable();
});


$('.confirm-delete').on('click', function(e) {
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
</script>
