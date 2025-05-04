<?php include "../admin/includes/admin_header.php" ?>
<?php include "../admin/includes/functions.php" ?>
<?php include "../admin/includes/db.php" ?>


<?php


 ?>


<?php


if(isset($_GET["page"])){
  $page = $_GET["page"];
}else {
  $page ="";
}
if($page == "" || $page == 1){
  $page_1 = 0;
}else {
  $page_1 =($page*15) - 15;
}


// $user_idd = $session_user_id;


if(isset($_POST['liked'])){

  $post_id = $_POST['post_id'];
  $result = mysqli_query($connection,"SELECT post_like_count FROM posts WHERE post_id=$post_id");
  $row = mysqli_fetch_array($result);
  $n = $row['post_like_count'];

  mysqli_query($connection,"INSERT INTO likes (likes_user_id, likes_post_id) VALUES ($user_idd, $post_id)");
  mysqli_query($connection,"UPDATE posts SET post_like_count=$n+1 WHERE post_id=$post_id");

  echo   $n+1;
  exit();
}

 	if (isset($_POST['unliked'])) {
 		$post_id = $_POST['post_id'];
 		$result = mysqli_query($connection, "SELECT post_like_count FROM posts WHERE post_id=$post_id");
 		$row = mysqli_fetch_array($result);
 		$n = $row['post_like_count'];

 		mysqli_query($connection, "DELETE FROM likes WHERE likes_post_id=$post_id AND likes_user_id=$user_idd");
 		mysqli_query($connection, "UPDATE posts SET post_like_count=$n-1 WHERE post_id=$post_id");

 		echo $n-1;
 		exit();
 	}




$query = "SELECT * FROM posts WHERE post_status=1   ORDER BY post_date DESC LIMIT $page_1,15" ;
$post_details = mysqli_query($connection,$query);
if(!$post_details){
die("query failed".mysqli_error($connection));
}else {
$record = array();
$total_posts_count =mysqli_num_rows($post_details);
while ($row = mysqli_fetch_assoc($post_details)) {
 $record[] = $row;
$total_posts_count++;
// $post_id               =     $row["post_id"];
// $post_title            =     $row["post_title"];
// $post_user_email       =     $row["post_user_email"];
// $post_date             =     $row["post_date"];
// $post_link             =     $row["post_link"];
// $project_start_date     =     $row["project_start_date"];
// $project_end_date       =     $row["project_end_date"];
// $post_image            =     $row["post_image"];



}

$count = ceil($total_posts_count/10);

}

 ?>







<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="cyberaticrvitm-touch-icon" sizes="76x76" href="../../images/logo.png">
  <link rel="icon" type="image/png" href="../../images/logo.png">
  <title>
CYBERATIC RVITM
  </title>

  <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="../admin/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../admin/assets/css/black-dashboard.css?v=1.0.0" rel="stylesheet" />

  <link rel="stylesheet" href="../admin/css/timeline.css">
  <link href="../admin/assets/demo/demo.css" rel="stylesheet" />


    <style media="screen">
*{
  padding: 0;
  margin: 0;
}
::-webkit-scrollbar {
display: none;
}
.post_type{

  line-height: 1rem;
  font-size: 0.6rem;
  padding: 6px;

}
.post_image{
   height:300px;
   width:700px;
}
@media (max-width:700px){
 
  .timeline .timeline-body {
      width: 240px;
      margin-left: 23%;
      margin-right: 17%;
      background: #fff;
      position: relative;
      padding: 20px 25px;
      border-radius: 6px;
  }


  .btn-sm {
    font-size: 0.45rem;
    margin-left: 0px;
    border-radius: 0.2857rem;
    line-height: 0.55;
}
  .timeline .timeline-time .time {
    line-height: 24px;
    font-size: 10px;

}

.timeline .timeline-time .date {
    line-height: 16px;
    font-size: 9px;
}

.post_title {
    color: black;
    font-size: 14px;
}

.post_link {
    font-size: 20px;
}

.view_profile {
    left: 20px;
}
.post_image{
    height: 150px;
}

    }

    </style>
</head>

<body>



<body class="">
  <div class="wrapper">

      <div class="main-panel">
        <!-- Navbar -->

      <!-- End Navbar -->
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-plain">
              <div class="card-header text-center">
              <legend>
                  <h1 class="text-center text-primary pt-3">Feed Page</h1></legend>

              </div>
              <div class="card-body">






                <div class="profile-content">
                   <!-- begin tab-content -->
                   <div class="tab-content p-0">
                      <!-- begin #profile-post tab -->
                      <div class="tab-pane fade active show" id="profile-post">
                         <!-- begin timeline -->
                         <ul class="timeline">


                           <?php foreach($record as $rec){?>
                            <li class="col-sm-12">
                               <!-- begin timeline-time -->
                               <div class="timeline-time ">
                                  <span class="date"><?php   echo date(' d F Y', strtotime($rec['post_date'])); ?></span>
                                  <span class="time text-info"><?php     echo date('H:i a ', strtotime($rec['post_date'])); ?></span>
                               </div>
                               <!-- end timeline-time -->
                               <!-- begin timeline-icon -->
                               <div class="timeline-icon ">
                                  <a href="javascript:;">&nbsp;</a>
                               </div>
                               <!-- end timeline-icon -->
                               <!-- begin timeline-body -->
                               <div class="timeline-body">

                            <?php
                                  $email_for_post = $rec['post_user_email'];



                             $query3 = "SELECT user_image, user_first_name, user_last_name,user_id ,user_semester  FROM users WHERE user_email='{$email_for_post}'  " ;
                                    $user_details = mysqli_query($connection,$query3);
                                    if(!$user_details){
                                    die("query failed".mysqli_error($connection));
                                    }else {

                                    while ($row1 = mysqli_fetch_assoc($user_details)) {
                                             $user_id              =          $row1["user_id"];
                                             $user_image           =          $row1['user_image'];
                                             $user_first_name      =          $row1['user_first_name'];
                                             $user_last_name       =          $row1['user_last_name'];
                                             $user_semester        =          $row1['user_semester'];
                                             $user_name            =          substr($email_for_post, 0, strpos($email_for_post, "_"));
                                             $user_name            =          $user_name . $user_semester;

                                      ?>

                                      <div class="timeline-header">
                                        <span > <a href="../../profile.php/<?php echo $user_name; ?> " class="btn btn-disabled btn-sm pull-right view_profile">View Profile
                                        </a> </span>
                                      <span class="userimage" ><img src="../images/<?php echo $user_image; ?>" alt="" class="rounded "></span>
                                      <p style="color:black" class="font-italic"><?php echo  $user_first_name , $user_last_name; ?> <small></small></p>


                                      <!-- <span class="pull-right text-muted">18 Views</span> -->
                                   </div>

                                <?php      }


                                    }

                                     ?>

                                  <div class="timeline-content">

                                  <h5 class="" >

                                      <button  type="button" name="button"class="btn btn-link" data-link="<?php echo $rec['post_link']; ?>" data-image="<?php echo  $rec['post_image'];  ?>"

                                        data-type="<?php echo $rec["post_type"];  ?>" data-title="<?php echo strtoupper($rec['post_title']);  ?>" data-start_date="<?php   echo " ". date(' d F Y', strtotime($rec['project_start_date']));  ?>"
                                         data-end_date="<?php   echo " ". date(' d F Y', strtotime($rec['project_end_date']));   ?>"
                                         data-description= "<?php echo $rec["post_description"];  ?>"
                                         data-toggle="modal" data-target="#exampleModal"  data-whatever="@getbootstrap" >
                                      <span class="pull-left h3 post_title mb-0" style="color:black"><?php  echo  strtoupper($rec['post_title']); ?></span>
                                      </button>
                                      <?php if ( $rec["post_type"] == 1) {
                                      ?><span class=" btn btn-primary btn-sm  view_profile pull-right">Project</span> <?php
                                      }elseif ( $rec["post_type"] == 0) {
                                      ?><span class=" btn btn-primary btn-sm post_type  view_profile pull-right">Certification</span> <?php
                                      }

                                        ?>

                                   </h5>

                                       <span class="userimage img-fluid img-responsive  " ><img class="post_image" data-image="images/<?php echo $rec['post_image'];
                                        ?>" src="../images/<?php echo $rec['post_image'];  ?>" alt=""  data-toggle="modal" data-target="#modal1"></span>
                                       <br>

          <span class="btn btn-secondary btn-sm pull-left"> <i class="fa fa-calendar-minus-o pr-1" aria-hidden="true"> </i>  <?php  echo " ". date(' d F Y', strtotime($rec['project_start_date']));  ?> </span>
          <span class="btn btn-secondary btn-sm pull-right">  <i class="fa fa-calendar-check-o pr-1" aria-hidden="true"> </i>  <?php  echo " ". date(' d F Y', strtotime($rec['project_end_date']));  ?> </span>





                                  </div>
                                  <div class="timeline-likes">
                                     <div class="stats-right">


                                     </div>
                                     <div class="stats">
                                        <span class="fa-stack fa-fw stats-icon">
                                        <i class="fa fa-circle fa-stack-2x text-danger"></i>
                                        <i class="fa fa-heart fa-stack-1x fa-inverse "></i>
                                        </span>
                                        <a target="_blank" href="<?php if(isset($rec['post_link'])){echo $rec['post_link'];} ?>"> <i class="fa fa-github-square fa-2x pr-1 pull-right pt-0 mt-0 pb-0 post_link" aria-hidden="true"> </i> </a>


                                        <!-- <span class="fa-stack fa-fw stats-icon"> -->
                                        <!-- <i class="fa fa-circle fa-stack-2x text-primary"></i> -->
                                        <!-- <i class="fa fa-thumbs-up fa-stack-1x fa-inverse"></i> -->
                                        <!-- </span> -->

                                        <span class="likes_count stats-total" data-likes="<?php echo $rec['post_id'] ?>" >  <?php echo $rec['post_like_count']; ?></span>
                                     </div>
                                  </div>



                               </div>
                               <!-- end timeline-body -->
                            </li>

                            <?php } ?>

                         </ul>
                         <!-- end timeline -->
                      </div>
                      <!-- end #profile-post tab -->
                   </div>
                   <!-- end tab-content -->
                </div>


                <nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
      <?php
      for($i=1;$i<=$count;$i++){

        if($i == $page ){
?>
<li class="page-item"><a class="page-link active" href="timeline.php?page= <?php echo $i; ?>"><?php echo $i; ?></a></li>

<?php        }else {
?>      <li class="page-item"><a class="page-link " href="timeline.php?page= <?php echo $i; ?>"><?php echo $i; ?></a></li>
<?php        }

      }

       ?>

    </ul>
  </nav>



  <div class="modal fade " id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">



        <div class="modal-header  text-centre">
          <h3 class="modal-title model_type" id="exampleModalLabel">Details</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>



        <div class="modal-body mt-0">
          <div class="col-md-12 shadow_div">
              <div class="">

                  <div class="panel-body row">

                      <div class="bio-chart col-md-4">
                        <div style="display:inline;width:100px;height:100px;">
                           <img src="" class="img-fluid img-responsive img-circle modal_image" alt="..." style="display:inline;width:100px;height:100px;">
                         </div>
                         <a target="_blank"  class="btn btn-primary btn-sm model_link mt-3"  href=" "><i class="fa fa-github-square  pr-1  pt-0 mt-0 pb-0 post_link" aria-hidden="true"> </i> Git Link </a>

                      </div>
                      <div class=" col-md-8 bio-desk">
                        <h4 class="text-primary modal_title"></h4>
                         <p class="modal_description"></p>
                         <p>
                           <p class="modal_start_date"></p>
                           <p class="modal_end_date"></p>
                         </p>


                      </div>
                  </div>
              </div>
              </div>
        </div>
        <div class="modal-footer pull-right ">
          <button type="button" class="btn btn-secondary text-right pull-right " data-dismiss="modal">Close</button>
        </div>
          </form>
      </div>
    </div>
  </div>
















              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
  <div class="fixed-plugin">
    <div class="dropdown show-dropdown">
      <a href="#" data-toggle="dropdown">
        <i class="fa fa-cog fa-2x fa-spin"> </i>
      </a>
      <ul class="dropdown-menu">
        <li class="header-title"> Sidebar Background</li>
        <li class="adjustments-line">
          <a href="javascript:void(0)" class="switch-trigger background-color">
            <div class="badge-colors text-center">
              <span class="badge filter badge-primary active" data-color="primary"></span>
              <span class="badge filter badge-info" data-color="blue"></span>
              <span class="badge filter badge-success" data-color="green"></span>
            </div>
            <div class="clearfix"></div>
          </a>
        </li>
        <li class="adjustments-line text-center color-change">
          <span class="color-label">LIGHT MODE</span>
          <span class="badge light-badge mr-2"></span>
          <span class="badge dark-badge ml-2"></span>
          <span class="color-label">DARK MODE</span>
        </li>

      </ul>
    </div>
  </div>

  <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">

      <!--Content-->
      <div class="modal-content">

        <!--Body-->
        <div class="modal-body mb-0 p-0">

          <div class="embed-responsive embed-responsive-16by9 z-depth-1-half">

              <img class="embed-responsive-item" src=""
                  >
          </div>

        </div>

        <!--Footer-->


      </div>
      <!--/.Content-->

    </div>
  </div>
</body>
  <!--   Core JS Files   -->
  <script src="../admin/assets/js/core/jquery.min.js"></script>
  <script src="../admin/assets/js/core/popper.min.js"></script>
  <script src="../admin/assets/js/core/bootstrap.min.js"></script>
  <script src="../admin/assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>

  <script src="../admin/assets/js/plugins/bootstrap-notify.js"></script>
  <script src="../admin/assets/js/black-dashboard.min.js?v=1.0.0"></script>
  <script src="../admin/assets/demo/demo.js"></script>
  <script>

  $('.post_image').on('click', function(){
    console.log("yes");
    var source = $(this).data('image');
    $('.embed-responsive-item').attr("src", source);

  });

  $('[data-toggle="modal"]').on('click', function(e) {
      e.preventDefault();

      var type = $(this).data('type');
      var description = $(this).data('description');
      var end_date = $(this).data('end_date');
      var start_date = $(this).data('start_date');
      var title = $(this).data('title');
      var link = $(this).data('link');
      var image =$(this).data('image');
  console.log(link);

  if(type==1){
    $(".model_type").text( "Project Deatails" );

  }else{
    $(".model_type").text( "Certification Deatails" );
  }

  $(".modal_title").text( title );
  $(".model_link").attr("href",link);
  $(".modal_start_date").text( "Started: "+start_date );
  $(".modal_end_date").text( "Completed: "+end_date );
  $(".modal_image").attr("src","../../images/"+image);
  $(".modal_description").text( description );


  });











    // when the user clicks on like
    $(document).ready(function(){
  		// when the user clicks on like

  		$('.like').on('click', function(){
  			var postid = $(this).data('id');
        var liked = $(this).data('liked');
        var likes = $(this).data('likes');
  			    $post = $(this);
            console.log("like");

  			$.ajax({
  				url: 'timeline.php',
  				type: 'post',
  				data: {
  					'liked': 1,
  					'post_id': postid
  				},
  				success: function(response){

           $('[data-id='+postid+']').filter('.like').css('display', 'none');
           $('[data-id='+postid+']').filter('.unlike').css('display', 'inline');
  if(liked=="yes"){
    $('[data-likes='+postid+']').filter('.likes_count').text(likes+1);

  }
  else {
    $('[data-likes='+postid+']').filter('.likes_count').text(likes);

  }




  				}
  			});
  		});

  		// when the user clicks on unlike
  		$('.unlike').on('click', function(){
  			var postid = $(this).data('id');
        var liked = $(this).data('liked');
        var likes = $(this).data('likes');
  		    $post = $(this);
          console.log("unlike");

  			$.ajax({
  				url: 'timeline.php',
  				type: 'post',
  				data: {
  					'unliked': 1,
  					'post_id': postid
  				},
  				success: function(response){
            $('[data-id='+postid+']').filter('.like').css('display', 'inline');
            $('[data-id='+postid+']').filter('.unlike').css('display', 'none');
              if(liked=="yes"){

                  $('[data-likes='+postid+']').filter('.likes_count').text(likes-1);
                }
                else{
                $('[data-likes='+postid+']').filter('.likes_count').text(likes);
              }


  				}
  			});
  		});
  	});








    $(document).ready(function() {
      $().ready(function() {
        $sidebar = $('.sidebar');
        $navbar = $('.navbar');
        $main_panel = $('.main-panel');

        $full_page = $('.full-page');

        $sidebar_responsive = $('body > .navbar-collapse');
        sidebar_mini_active = true;
        white_color = false;

        window_width = $(window).width();

        fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();



        $('.fixed-plugin a').click(function(event) {
          if ($(this).hasClass('switch-trigger')) {
            if (event.stopPropagation) {
              event.stopPropagation();
            } else if (window.event) {
              window.event.cancelBubble = true;
            }
          }
        });

        $('.fixed-plugin .background-color span').click(function() {
          $(this).siblings().removeClass('active');
          $(this).addClass('active');

          var new_color = $(this).data('color');

          if ($sidebar.length != 0) {
            $sidebar.attr('data', new_color);
          }

          if ($main_panel.length != 0) {
            $main_panel.attr('data', new_color);
          }

          if ($full_page.length != 0) {
            $full_page.attr('filter-color', new_color);
          }

          if ($sidebar_responsive.length != 0) {
            $sidebar_responsive.attr('data', new_color);
          }
        });

        $('.switch-sidebar-mini input').on("switchChange.bootstrapSwitch", function() {
          var $btn = $(this);

          if (sidebar_mini_active == true) {
            $('body').removeClass('sidebar-mini');
            sidebar_mini_active = false;
            blackDashboard.showSidebarMessage('Sidebar mini deactivated...');
          } else {
            $('body').addClass('sidebar-mini');
            sidebar_mini_active = true;
            blackDashboard.showSidebarMessage('Sidebar mini activated...');
          }

          // we simulate the window Resize so the charts will get updated in realtime.
          var simulateWindowResize = setInterval(function() {
            window.dispatchEvent(new Event('resize'));
          }, 180);

          // we stop the simulation of Window Resize after the animations are completed
          setTimeout(function() {
            clearInterval(simulateWindowResize);
          }, 1000);
        });

        $('.switch-change-color input').on("switchChange.bootstrapSwitch", function() {
          var $btn = $(this);

          if (white_color == true) {

            $('body').addClass('change-background');
            setTimeout(function() {
              $('body').removeClass('change-background');
              $('body').removeClass('white-content');
            }, 900);
            white_color = false;
          } else {

            $('body').addClass('change-background');
            setTimeout(function() {
              $('body').removeClass('change-background');
              $('body').addClass('white-content');
            }, 900);

            white_color = true;
          }


        });

        $('.light-badge').click(function() {
          $('body').addClass('white-content');
        });

        $('.dark-badge').click(function() {
          $('body').removeClass('white-content');
        });
      });
    });
  </script>

</body>

</html>
