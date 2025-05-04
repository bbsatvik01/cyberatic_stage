<?php include "navigation.php"; ?>
<?php     $i =1;



    $query = "SELECT * FROM tests";
    $test_details = mysqli_query($connection,$query);
    if(!$test_details){
    die("query failed".mysqli_error($connection));
    }
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" /> -->
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />


  </head>

  <body>
    <table id="employee_data" class=" table table-striped table-bordered table-sm  table-dark  table-hovered" >
      <thead class="thead-light">
        <tr>
            <th class="th-sm">S.No</th>
                <th > Name</th>
                <th class="th-sm"> File </th>

                <th class="th-sm"> Users </th>




        </tr>
      </thead>
        <tbody>


                        <?php

                        while ($row = mysqli_fetch_assoc($test_details)) {

                        $test_id              =       $row["test_id"];
                        $test_name            =       $row["test_name"];
                        $test_file            =       $row["test_file"];






                        ?>
                        <tr>
                        <td><?php echo $i; ?></td>
                        <td ><?php if (isset($test_name)) {echo $test_name;} ?></td>
                        <!-- <td><a href="downloads.php?file_id=<?php if (isset($test_id)) {echo $test_id;} ?>">Download</a></td> -->
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

                        <tr>

                        <?php
                                    $i++; }
                                        ?>
        </tbody>



<script type="text/javascript">
console.log("hello");
$(document).ready(function(){
     $('#employee_data').DataTable();
});

</script>
  </body>
</html>
