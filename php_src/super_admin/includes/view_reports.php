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

  if(isset($session_role) &&  $session_role == 1 || $session_role == 6 ){




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









    ?>






<?php

if(isset($_POST["show_reports"]) ){


$post_id=$_POST["post_id"];

$query = "SELECT * FROM report WHERE report_post_id=$post_id ";

$report_details = mysqli_query($connection,$query);
if(!$report_details){
die("query failed".mysqli_error($connection));
}
$i=1;
$temp_test_name2="";
$count=0;

$report_array=array();
while ($row = mysqli_fetch_assoc($report_details)) {
$report_array[]=$row;


}

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
                    <th>Field</th>
                   <th>Reason</th>


                 <!-- <th></th> -->
               </tr>
             </thead>
                <tbody>


                <?php


foreach ($report_array as $rep ) {








                                $report_sender_email             =       $rep["report_sender_email"];
                                $report_field      =       $rep["report_field"];
                                $report_reason     =       $rep["report_reason"];

                                   ?>

                         <tr>
                                <td><?php echo $i; ?></td>
                                <td ><?php if (isset($report_sender_email)) {echo $report_sender_email;} ?></td>
                                <td><?php if (isset($report_field)) {echo $report_field;} ?></td>
                                <td><?php if (isset($report_reason)) {echo $report_reason;} ?></td>


                                 

                         </tr>
                                <?php
                                            $i++; }

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
