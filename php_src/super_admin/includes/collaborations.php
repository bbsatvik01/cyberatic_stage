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

  if(isset($session_role) &&  $session_role == 6 ){




 ?>

<?php include "navigation.php"; ?>
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
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
















if(isset($_POST["delete_collab"])){


  $delete_collab_id      =      $_POST["delete_collab_id"];


 $deleted_collab=mysqli_query($connection,"UPDATE collaborate SET collab_status = -1 WHERE collab_id='$delete_collab_id'");

 if (!$deleted_collab) {

 die("Users total count query failed".mysqli_error($connection));
 }
 else {







   ?><div class="alert alert-success"> <strong>Success! </strong> Collaboration  Deleted  Succesfully</div> <?php

 }
 }


 $total_active_collab= 0;
 $total_archived_collab=0;
 $total_deleted_collab=0;
 $total_collab = 0;
 $total_projects = 0;
 $query = "SELECT * FROM collaborate ORDER BY collab_status DESC";
 $collab_details = mysqli_query($connection,$query);
 if(!$collab_details){
 die("query failed".mysqli_error($connection));
 }


$collab_array=array();

 while ($row = mysqli_fetch_assoc($collab_details)) {
$collab_array[]=$row;
$total_collab++;



      $total_projects++;
      if($row["collab_status"] == 1){
         $total_active_collab++;
      }
      if($row["collab_status"] == 0){
         $total_archived_collab++;
      }
      if($row["collab_status"] == -1){
         $total_deleted_collab++;
      }





}

 ?>







<h3 class="text-center pb-3 text-muted">All Collaborations Of Coding Club</h3>
<div class="row pb-5">









  <legend><h3 class="text-center pt-3">Quick  Overview</h3></legend>


  <div class="col-sm-6 col-md-4 mt-3">
      <div class="card">
          <div class="card-body bg-info">
              <div class="row">
                  <div class="col-3">
                    <i class="fa fa-users fa-5x" aria-hidden="true"></i>

                  </div>
                  <div class="col-9">
                     <div class="row">
                       <div class="col-12">
                         <h5 class="pull-right"> Collaborations </h5>
                           <h5 class="pull-right"> Total - </h5>


                       </div>
                       <div class="col-12">
                         <h6 class="pull-right mt-3 total_numbers">
                             <?php if (isset($total_collab)) {  echo $total_collab; }

                             ?>

                         </h6>
                       </div>
                     </div>
                  </div>
              </div>
          </div>
          <span>
              <div class="card-footer">
                  <span class="pull-left">Scroll Down</span>
                  <span class="pull-right"><i class="fa fa-arrow-circle-down"></i></span>
                  <div class="clearfix"></div>
              </div>
          </span>
      </div>
   </div>

















      <div class="col-sm-6 col-md-4 mt-3">
          <div class="card">
              <div class="card-body bg-warning">
                  <div class="row">
                      <div class="col-3">
                        <i class="fa fa-users fa-5x" aria-hidden="true"></i>

                      </div>
                      <div class="col-9">
                         <div class="row">
                           <div class="col-12">
                             <h5 class="pull-right"> Collaborations </h5>
                               <h5 class="pull-right"> Active - </h5>


                           </div>
                           <div class="col-12">
                             <h6 class="pull-right mt-3 total_numbers">
                                 <?php if (isset($total_active_collab)) {  echo $total_active_collab; }

                                 ?>

                             </h6>
                           </div>
                         </div>
                      </div>
                  </div>
              </div>
              <span>
                  <div class="card-footer">
                      <span class="pull-left">Scroll Down</span>
                      <span class="pull-right"><i class="fa fa-arrow-circle-down"></i></span>
                      <div class="clearfix"></div>
                  </div>
              </span>
          </div>
       </div>





        <div class="col-sm-6 col-md-4 mt-3">
            <div class="card">
                <div class="card-body bg-info">
                    <div class="row">
                        <div class="col-3">
                          <i class="fa fa-users fa-5x" aria-hidden="true"></i>

                        </div>
                        <div class="col-9">
                           <div class="row">
                             <div class="col-12">
                               <h5 class="pull-right"> Collaborations </h5>
                                 <h5 class="pull-right"> pending - </h5>


                             </div>
                             <div class="col-12">
                               <h6 class="pull-right mt-3 total_numbers">
                                   <?php if (isset($total_archived_collab)) {  echo $total_archived_collab; }

                                   ?>

                               </h6>
                             </div>
                           </div>
                        </div>
                    </div>
                </div>
                <span>
                    <div class="card-footer">
                        <span class="pull-left">Scroll Down</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-down"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </span>
            </div>
         </div>






          <div class="col-sm-6 col-md-4 mt-3">
              <div class="card">
                  <div class="card-body bg-info">
                      <div class="row">
                          <div class="col-3">
                            <i class="fa fa-users fa-5x" aria-hidden="true"></i>

                          </div>
                          <div class="col-9">
                             <div class="row">
                               <div class="col-12">
                                 <h5 class="pull-right"> Collaborations </h5>
                                   <h5 class="pull-right"> Deleted - </h5>


                               </div>
                               <div class="col-12">
                                 <h6 class="pull-right mt-3 total_numbers">
                                     <?php if (isset($total_deleted_collab)) {  echo $total_deleted_collab; }

                                     ?>

                                 </h6>
                               </div>
                             </div>
                          </div>
                      </div>
                  </div>
                  <span>
                      <div class="card-footer">
                          <span class="pull-left">Scroll Down</span>
                          <span class="pull-right"><i class="fa fa-arrow-circle-down"></i></span>
                          <div class="clearfix"></div>
                      </div>
                  </span>
              </div>
           </div>





























  <legend><h3 class="text-center pt-5">Quick  Analysis</h3></legend>


  <script src="../../admin/assets/js/plugins/chartjs.min.js"></script>


  <div class="chart-container">
    <canvas id="bar-chartcanvas" style="height:75px;width:150px;"></canvas>

  </div>

<script type="text/javascript">
  $(document).ready(function () {

  var ctx = $("#bar-chartcanvas");

  var data = {
    labels : ["Total Collaborations", "Active Collaborations" , "pending Collaborations" , "Deleted Collaborations "],
    datasets : [

      {


        label : "Count",
        data : [<?php if(isset($total_collab)){ echo $total_collab;} ?>, <?php if(isset($total_active_collab)){ echo $total_active_collab;} ?>,<?php if(isset($total_archived_collab)){ echo $total_archived_collab;} ?> ,
           <?php if (isset($total_deleted_collab)) {echo $total_deleted_collab;}  ?> ],
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























</div>


<legend><h3 class="text-center pt-5">All Collaborations</h3></legend>

            <table class="table  table-dark table-hover" id="posts_table">
            	<thead class="thead-light">
            		<tr>
            			<th style="width:1%">S.No</th>
                  <th style="width:1%">Sender Email</th>
            			<th style="width:1%">Reciever Email</th>
                 <th style="width:93%">Description</th>
                  <th style="width:3%">Status</th>
            			<th style="width:1%">Options</th>
            		</tr>
            	</thead>
              <tbody>


                <?php
                   $i =1;


foreach ($collab_array as $collab ) {



                $collab_id                =     $collab["collab_id"];
                $collab_description       =     $collab["collab_description"];
                $collab_sender_email      =     $collab["collab_sender_email"];
                $collab_receiver_email    =     $collab["collab_receiver_email"];
                $collab_status            =     $collab["collab_status"];






?>
<tr>
<td><?php echo $i; ?></td>
<td><?php echo $collab_sender_email ; ?></td>
<td><?php echo $collab_receiver_email; ?></td>

<td><?php echo $collab_description ; ?></td>


<!--<td><a target="_blank" href="<?php echo $post_link; ?>" class="btn btn-primary btn-sm" > <i class="fa fa-github-square" aria-hidden="true" ></i> GIT </a></td>-->

<td><?php if (isset($collab_status) ) {
if ( $collab_status == 0) {
 ?><button  type="button" name="button" class="btn btn-disabled btn-sm">Request Sent</button> <?php
}elseif ( $collab_status == -1) {
  ?><button  type="button" name="button" class="btn btn-warning btn-sm">Rejected</button> <?php
}
elseif ( $collab_status == 1) {
  ?><button type="button" name="button" class="btn btn-success btn-sm">Accepted</button> <?php
}

} ?></td>



<td>


    <button type="submit" name="delete_collab" data-title="<?php echo $post_title; ?>"  data-id="<?php echo $collab_id; ?>" data-user_email ="<?php echo $post_user_email; ?>" class="btn btn-danger confirm-delete">
      <i class="fa fa-trash-o" aria-hidden="true"></i></button>



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
      <input type="hidden" id="collab_id" name="delete_collab_id" value="">

      <button type="submit" name="delete_collab" class="btn btn-danger">Delete</button>
    </form>
	</div>
</div>
</div>
</div>

<div id="myModal" class="modal hide">
    <div class="modal-header">
        <a href="#" data-dismiss="modal" aria-hidden="true" class="close">×</a>
         <h3>Delete</h3>
    </div>
    <div class="modal-body">
        <p>You are about to delete.</p>
        <p>Do you want to proceed?</p>
    </div>
    <div class="modal-footer">
      <a href="#" id="btnYes" class="btn danger">Yes</a>
      <a href="#" data-dismiss="modal" aria-hidden="true" class="btn secondary">No</a>
    </div>
</div>




<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Post Status</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body ">
        <p class="modal_post_title"></p>
        <p class="modal_content"></p>
        <form action="" method="post" class="pb-5">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Post Status:</label>
            <input type="hidden" name="edited_post_id" id="form_post_id" value="">
            <input type="hidden" name="notify_user_email" id="form_post_user_email" value="">
            <input type="hidden" name="edited_post_name" id="form_post_name" value="">


            <select id="" class="form-control browser-default custom-select" name="edited_post_status" value="">


              <option value="-2">Block</option>
              <option value="0">Unblock(Archieve)</option>
              <!-- <option value="2">Admin</option> -->



        </select>

          </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="edit_post_status" class="btn btn-primary">Update Status</button>
      </div>
        </form>
    </div>
  </div>
</div>



<script>
$('[data-toggle="modal"]').on('click', function(e) {
    e.preventDefault();

    var post_id = $(this).data('post_id');
    var post_status =$(this).data('post_status');
    var post_title =$(this).data('post_title');
    var post_user_email =$(this).data('user_email');


    var status_in_words ="";
    if(post_status == -1){
        status_in_words =" Deleted";
    }
    if(post_status == 0){

        status_in_words = "Archived";
    }
    if(post_status == 1){
        status_in_words =" Published";
    }
    if(post_status == -2){
        status_in_words = "Archived By you";
    }

    var modal_text= "Current status is " +status_in_words;
    var modal_post_title = "You are about to change the status of " + post_title;

    $("#form_post_id").val(post_id);
    $("#form_post_user_email").val(post_user_email);
    $("#form_post_name").val(post_title);
    $(" .modal_content").text(modal_text);
    $(" .modal_post_title").text(modal_post_title);


});



$('.confirm-delete').on('click', function(e) {
    e.preventDefault();

    var id = $(this).data('id');
    var modal_text= "Do you really want to delete collaboration";
    $('#myModal').data('id', id).modal('show');
    $(".modal-footer #collab_id").val( id );


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
    td = tr[i].getElementsByTagName("td")[2];
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
    td = tr[i].getElementsByTagName("td")[1];
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
     $('#posts_table').DataTable();
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
