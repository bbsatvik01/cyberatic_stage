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




 ?>

<?php include "navigation.php"; ?>

<!-- <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script> -->
<!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" /> -->
<!-- <script src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.dataTables.min.css" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
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


if (isset($_POST["edit_score"])) {
    $edit_user_id=$_POST["edit_user_id"];
    $edit_user_score=$_POST["edit_user_score"];
    $test_name = $_POST["test_name"];
    $edit_user_email=$_POST["user_email"];
    $total_test_count=$_POST["total_test_count"];
$total_marks=0;








    $edited_user_score=mysqli_query($connection,"UPDATE score SET score_test_marks=$edit_user_score WHERE score_id=$edit_user_id");
    if (!$edited_user_score) {

    die("Users total count query failed".mysqli_error($connection));
    }
    else {


      $querysigma = "SELECT score_test_marks FROM score Where score_user_email= '$edit_user_email'";

      $sigma_details = mysqli_query($connection,$querysigma);

      if(!$sigma_details){
      die("query failed".mysqli_error($connection));
      }

  while($row1= mysqli_fetch_assoc($sigma_details)){
    $total_marks+=$row1["score_test_marks"];
  }


        $edited_user_final_score=mysqli_query($connection,"UPDATE users SET user_score=$total_marks/$total_test_count WHERE user_email='$edit_user_email'");


      if (!$edited_user_final_score) {

      die("Users total count query failed".mysqli_error($connection));
    }else{
      ?><div class="alert alert-success"> <strong>Success! </strong> Score Updated Succesfully</div> <?php
}
    }


    }




    if (isset($_POST["delete_user"])) {
        $delete_user_id=$_POST["delete_user_id"];
        $null= NULL;
        $deleted_user_score=mysqli_query($connection,"UPDATE score SET score_test_marks=0 WHERE score_id='$delete_user_id'");
        if (!$deleted_user_score) {
        die("Users total count query failed".mysqli_error($connection));
        }
        else {
          ?><div class="alert alert-success"> <strong>Success! </strong> Score Deleted Succesfully</div> <?php

        }
    }

    ?>






<?php

if(isset($_POST["view_test_users"]) || isset($_POST["test_name"])){


$test_name=$_POST["test_name"];

$query = "SELECT * FROM score ";

$score_details = mysqli_query($connection,$query);
if(!$score_details){
die("query failed".mysqli_error($connection));
}
$i=1;
$temp_test_name2="";
$count=0;

$test_users_array=array();
while ($row = mysqli_fetch_assoc($score_details)) {
$test_users_array[]=$row;


}

?>

<?php
$marks_array = array();
for ($a=0; $a < count($test_users_array) ; $a++) {
  if($test_users_array[$a]["score_test_name"] == $test_name){
     $marks_array[] = $test_users_array[$a]["score_test_marks"];
  }

}


// $marks_array =  array_count_values($marks_array);
// print_r($marks_array);
$students_per_each_score =array();
for ($w=0; $w < 11 ; $w++) {
  $number_of_students = 0;
  for ($j=0; $j < count($marks_array) ; $j++) {
       if($marks_array[$j] == $w){
           $number_of_students++;
       }
  }
  $students_per_each_score[] = $number_of_students;
}

// print_r($students_per_each_score);
// for ($q=0; $q < count($students_per_each_score) ; $q++) {
//   echo $students_per_each_score[$q];
//   echo "<br>";
// }
 ?>






        <legend><h3 class="text-center pt-5">Quick  Analysis</h3></legend>
        <legend><h2 class="text-center pt-5">Number of Students for each mark</h2></legend>


        <script src="../../admin/assets/js/plugins/chartjs.min.js"></script>


        <div class="chart-container">
          <canvas id="bar-chartcanvas" style="height:75px;width:150px;"></canvas>

        </div>

      <script type="text/javascript">
        $(document).ready(function () {

           var  students_marks_array = new Array();
                students_marks_array =  <?php echo json_encode($students_per_each_score); ?>;
        var ctx = $("#bar-chartcanvas");

        var data = {
          labels : ["0","1","2","3","4","5","6","7","8","9","10"],
          datasets : [

            {


              label : "Number Of Students",
              data : students_marks_array,
              backgroundColor : [
                "rgba(50, 150, 250, 0.3)",
                "rgba(50, 150, 250, 0.3)",
                "rgba(50, 150, 250, 0.3)",
                "rgba(50, 150, 250, 0.3)",
                "rgba(50, 150, 250, 0.3)",
                "rgba(50, 150, 250, 0.3)",
                "rgba(50, 150, 250, 0.3)",
                "rgba(50, 150, 250, 0.3)",
                "rgba(50, 150, 250, 0.3)",
                "rgba(50, 150, 250, 0.3)",
                "rgba(50, 150, 250, 0.3)"



              ],
              borderColor : [
                "rgba(55, 150, 250, 1)",
                "rgba(55, 150, 250, 1)",
                "rgba(55, 150, 250, 1)",
                "rgba(55, 150, 250, 1)",
                "rgba(55, 150, 250, 1)",
                "rgba(55, 150, 250, 1)",
                "rgba(55, 150, 250, 1)",
                "rgba(55, 150, 250, 1)",
                "rgba(55, 150, 250, 1)",
                "rgba(55, 150, 250, 1)",
                "rgba(55, 150, 250, 1)"
              ],
              borderWidth : 2
            }
          ]
        };

        var options = {
          responsive:true,
          title : {
            display : true,
            position : "top",
            text : "",
            fontSize : 18
            // fontColor : "#111"
          },

          legend : {
            display : true,
            // position : "bottom"
          },
          scales : {
            yAxes : [{
              ticks : {
                min : 0
              }
            }]
          }
        };

        var chart = new Chart( ctx, {
          type : "bar",
          data : data,
          options : options
        });

      });
      </script>

















            <table class="table  table-dark table-hover" id="test_user_table">
            	<thead class="thead-light">
            		<tr>
            		    <th>S.No</th>
                    <th> User Email</th>
                    <th> Score </th>
            			  <th>Options</th>
                   <th>Options</th>

            			<!-- <th></th> -->
            		</tr>
            	</thead>
                <tbody>


                <?php


foreach ($test_users_array as $test_users ) {


                              $temp_test_name=$test_users["score_test_name"];

                              if($temp_test_name!=$temp_test_name2){
                                $count++;

                              }
                              $temp_test_name2=$temp_test_name;

                              if($test_users["score_test_name"]==$test_name){
                                $score_id             =       $test_users["score_id"];
                                $score_user_email      =       $test_users["score_user_email"];
                                $score_test_marks     =       $test_users["score_test_marks"];

                                   ?>

                         <tr>
                                <td><?php echo $i; ?></td>
                                <td ><?php if (isset($score_user_email)) {echo $score_user_email;} ?></td>
                                <td><?php if (isset($score_test_marks)) {echo $score_test_marks;} ?></td>

                                <td>
                                <button type="submit" name="edit_score"  data-email="<?php echo $score_user_email; ?>"  data-test_name="<?php echo $test_name; ?>"  data-score="<?php echo $score_test_marks; ?>" data-id="<?php echo $score_id;  ?> "
                                  data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap" class="btn btn-warning">  <i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>

                                 </td>

                                 <td>
                                    <button type="submit" name="delete_score" data-email="<?php echo $score_user_email; ?>"  data-id="<?php echo $score_id; ?>" class="btn btn-danger confirm-delete">  <i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                 </td>

                         </tr>
                                <?php
                                            $i++; }}

                                                ?>
                </tbody>
</table>

<?php } ?>



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
      <input type="hidden" id="post_id" name="delete_user_id" value="">
      <button type="submit" name="delete_user" class="btn btn-danger">Delete</button>
    </form>
	</div>
</div>
</div>
</div>







<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit User Score</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body ">
        <p class="modal_content"></p>
        <form action="view_test_users.php" method="post" class="pb-5">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">User Score:</label>
            <input type="hidden" name="edit_user_id" id="form_user_id" value="">
            <input type="hidden" name="test_name" id="form_test_name" value="">
            <input type="hidden" name="user_email" id="form_user_email" value="">
            <input type="hidden" name="edit_user_prev_score" id="form_user_prev_score" value="" >
            <input type="hidden" name="total_test_count" id="total_test_count" value="">

            <input type="number" name="edit_user_score" id="form_user_score" value="" min="0" max="10">


          </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="edit_score" class="btn btn-primary">Update score</button>
      </div>
        </form>
    </div>
  </div>
</div>



<script>
$('[data-toggle="modal"]').on('click', function(e) {
    e.preventDefault();

    var score = $(this).data('score');
    var id =$(this).data('id');
    var modal_text= "Current score is "+score;
    var test_name =$(this).data('test_name');
    var email = $(this).data('email');
    var total_test_count=<?php echo $count; ?>;
    $("#form_user_id").val( id );
       $(" .modal_content").text(modal_text);
       $("#form_user_score").val( score );
       $("#form_test_name").val( test_name );
       $("#form_user_email").val( email );
       $("#form_user_prev_score").val( score );
       $("#total_test_count").val( total_test_count );




});





$('.confirm-delete').on('click', function(e) {
    e.preventDefault();
    var id = $(this).data('id');

    var email = $(this).data('email');
    var modal_text= "Do you really want to delete "+email+" user?";
    $('#myModal').data('id', email).modal('show');
    $(".modal-footer #post_id").val( id );
       $(" .modal_content").text(modal_text);
});

$(document).ready(function(){
     $('#test_user_table').DataTable();
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
