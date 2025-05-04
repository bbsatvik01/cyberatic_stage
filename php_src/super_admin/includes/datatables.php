<?php include "navigation.php"; ?>
<?php

                        $query = "SELECT * FROM tests";
                        $test_details = mysqli_query($connection,$query);
 ?>
 <!DOCTYPE html>
 <html>
      <head>
           <title>Webslesson Tutorial | Datatables Jquery Plugin with Php MySql and Bootstrap</title>
           <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> -->
           <!-- <link rel="stylesheet" href="../css/bootstrap/bootstrap.min.css"> -->
           <!-- <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script> -->

           <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" /> -->
           <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
           <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
      </head>
      <body>
           <br /><br />
           <div class="container">
                <h3 align="center">Datatables Jquery Plugin with Php MySql and Bootstrap</h3>
                <br />
                <div class="table-responsive">
                     <table id="user_table" class="table table-dark table-striped table-hovered ">
                          <thead class="thead-light">
                               <tr>
                                    <td>Name</td>
                                    <td>Address</td>
                                    <td>Gender</td>
                                    <td>Gender</td>
                                    <td>Gender</td>
                                    <td>Gender</td>

                               </tr>
                          </thead>
                          <tbody>


                          <?php
                            $i =1;
                          while($row = mysqli_fetch_array($test_details))
                          {
                            $test_id              =       $row["test_id"];
                            $test_name            =       $row["test_name"];
                            $test_file            =       $row["test_file"];


?>

<tr>
<td><?php echo $test_id ?></td>
<td><?php echo $test_name ?></td>
<td><?php echo $test_file ?></td>
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

                               // echo '
                               // <tr>
                               //      <td>'.$test_id.'</td>
                               //      <td>'.$test_name.'</td>
                               //      <td>'.$test_file.'</td>
                               //      <td><a target="_blank" class="btn btn-secondary btn-sm" href="../../file-upload-download/uploads/'.$test_file.'">View File</a></td>
                               //    <td>  <form class="" action="view_test_users.php" method="post">
                               //          <input type="hidden" name="test_name" value="'.$test_name.'">
                               //
                               //          <button type="submit" name="view_test_users"  data-id="" class="btn btn-primary "> View Users </button>
                               //      </form></td>
                               // </tr>
                               // ';
                          }
                          ?>  </tbody>
                     </table>
                </div>
           </div>
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

      </body>
 </html>
 <script>
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
 $(document).ready(function(){
      $('#employee_data').DataTable();
 });
 </script>
