

<link rel="stylesheet" href="../css/navbar.css">
<!-- <script src="../js/jquery.min.js"></script> -->
<script src="../js/navbar.js"></script>
<!-- Bootstrap NavBar -->
<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">

    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="#">
        <span class="menu-collapsed">Coding Club (ADMIN)</span>
    </a>

    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <!-- This menu is hidden in bigger devices with d-sm-none.
           The sidebar isn't proper for smaller screens imo, so this dropdown menu can keep all the useful sidebar items exclusively for smaller screens  -->
            <li class="nav-item dropdown d-sm-block d-md-none">
                <a class="nav-link" href="dashboard.php"><span class="fa fa-dashboard fa-fw mr-2"></span>Dashboard</a>
                <a class="nav-link" href=".php"><span class="fa fa-user fa-fw mr-2"></span>Profile</a>

                <a class="nav-link dropdown-toggle" href="#productsmenu"  id="smallerscreenmenu" data-toggle="collapse" aria-haspopup="true" aria-expanded="false"><span class="fa fa-list fa-fw mr-2"></span>
                  Content Management
                </a>
                <div class="collapse" id="productsmenu">

                    <!-- <a class="nav-link" href="displaySellerProducts.php">Products</a> -->
                </div>

                <a class="nav-link dropdown-toggle" href="#ordersmenu" data-toggle="collapse" aria-haspopup="true" aria-expanded="false"><span class="fa fa-list fa-fw mr-2"></span>
                  USers Management
                </a>
                <div class="collapse" id="ordersmenu">
                    <a class="nav-link" href=""> All Users</a>
                    <a class="nav-link" href="#">Admin Users</a>
                    <!-- <a class="nav-link" href="#">Cancelled Orders</a> -->
                </div>

                <a class="nav-link dropdown-toggle" href="#sellercentralmenu" data-toggle="collapse" aria-haspopup="true" aria-expanded="false"><span class="fa fa-gear fa-fw mr-2"></span>
                  Events Management
                </a>
                <div class="collapse" id="">

                    <a class="nav-link" href="#">All Events</a>
                    <a class="nav-link" href="#">Add Events</a>
                    <!-- <a class="nav-link" href="#"></a> -->


                </div>

                <a class="nav-link" href="displaySellerPromocode.php"><span class="fa fa-calendar fa-fw mr-2"></span>Promo Codes</a>
                <a class="nav-link" href="displayContactUsForSeller.php"><span class="fa fa-clipboard fa-fw mr-2"></span>Contact Us</a>
                <a class="nav-link" href="logout.php"><span class="fa fa-sign-out fa-fw mr-2"></span>Logout</a>
            </li>


            <li class="nav-item d-sm-block d-md-none">
                <a class="nav-link">Hi,&nbsp;<?php ?>
                </a>
            </li>
            <!-- Smaller devices menu END -->
        </ul>
    </div>

    <ul class="navbar-nav mr-2 d-none d-lg-inline-flex">

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="rightNavOptions" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="../../images/<?php if(isset($session_user_image)){echo $session_user_image;} ?>" width="30" height="30" class="rounded-circle" style="border-radius:40%;">
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="rightNavOptions">
              <a class="dropdown-item" href=""><span class="fa fa-user fa-fw mr-2"></span>Profile</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href=""><span class="fa fa-key fa-fw mr-2"></span>Change Password</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="../logout.php"><span class="fa fa-sign-out fa-fw mr-2"></span>Logout</a>
            </div>
        </li>
    </ul>
</nav>
<!-- NavBar END -->

<!-- Bootstrap row -->
<div class="row" id="body-row">             <!-- will remain unclosed in every file -->
    <div class="col-md-12">
        <span id="sidenav-open" class="fa fa-bars fa-2x d-none mt-3"></span>
    </div>
    <!-- Sidebar -->
    <div id="sidebar-container" class="sidebar-expanded d-none d-lg-block col-3">

        <ul class="list-group sticky-top sticky-offset">
            <!-- For Hide -->
            <div class="col-12 text-right text-white">
                <span class="fa fa-remove fa-2x mt-2" id="sidenav-close"></span>
            </div>
            <!-- Separator with title -->
            <li class="list-group-item sidebar-separator-title text-muted d-flex align-items-center menu-collapsed">
                <small>Panel Menu</small>
            </li>

            <a href="dashboard.php" class="bg-dark list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-dashboard fa-fw mr-3"></span>
                    <span class="menu-collapsed">Dashboard</span>
                </div>
            </a>


            <li class="list-group-item sidebar-separator-title text-muted d-flex align-items-center menu-collapsed">
                <small>Content Management</small>
            </li>


            <a href="#submenu5" data-toggle="collapse" aria-expanded="false" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-gear fa-fw mr-3"></span>
                    <span class="menu-collapsed">Tests Management </span>
                    <span class="submenu-icon ml-auto"></span>
                </div>
            </a>

            <div id="submenu5" class="collapse sidebar-submenu">
              <a href="add_test.php" class="list-group-item list-group-item-action bg-dark text-white">
                  <span class="menu-collapsed"> Add Test </span>
              </a>
              <a href="view_all_tests.php" class="list-group-item list-group-item-action bg-dark text-white">
                  <span class="menu-collapsed"> All tests  </span>
              </a>



            </div>

            <a href="#submenu2" data-toggle="collapse" aria-expanded="false" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-list fa-fw mr-3"></span>
                    <span class="menu-collapsed">Events Management</span>
                    <span class="submenu-icon ml-auto"></span>
                </div>
            </a>
            <div id="submenu2" class="collapse sidebar-submenu">
              <a href="add_event.php" class="list-group-item list-group-item-action bg-dark text-white">
                  <span class="menu-collapsed"> Add Events</span>
              </a>
                <a href="view_all_events.php" class="list-group-item list-group-item-action bg-dark text-white">
                    <span class="menu-collapsed">All Events</span>
                </a>

            </div>



            <a href="#submenu4" data-toggle="collapse" aria-expanded="false" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-gear fa-fw mr-3"></span>
                    <span class="menu-collapsed">Notifications Management </span>
                    <span class="submenu-icon ml-auto"></span>
                </div>
            </a>
            <div id="submenu4" class="collapse sidebar-submenu">
                <a href="add_notification.php" class="list-group-item list-group-item-action bg-dark text-white">
                    <span class="menu-collapsed"> Add Notification  </span>
                </a>
                <a href="view_all_notifications.php" class="list-group-item list-group-item-action bg-dark text-white">
                    <span class="menu-collapsed"> All Notifications  </span>
                </a>


            </div>








            <a href="view_all_posts.php" class="list-group-item list-group-item-action bg-dark text-white ">
                <span class="menu-collapsed fa fa-users fa-fw mr-3">  </span> All Projects</span>
            </a>
            <a href="view_all_users.php" class="list-group-item list-group-item-action bg-dark text-white ">
                <span class="menu-collapsed fa fa-users fa-fw mr-3">  </span> All Users</span>
            </a>
            <a href="view_all_internships.php" class="list-group-item list-group-item-action bg-dark text-white ">
                <span class="menu-collapsed fa fa-users fa-fw mr-3">  </span> All Internships</span>
            </a>
            <a href="collaborations.php" class="list-group-item list-group-item-action bg-dark text-white ">
                <span class="menu-collapsed fa fa-users fa-fw mr-3">  </span> All Collaborations</span>
            </a>


            <li class="list-group-item sidebar-separator menu-collapsed"></li>


            <a href="../logout.php" class="bg-dark list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-sign-out fa-fw mr-3"></span>
                    <span class="menu-collapsed">Logout</span>
                </div>
            </a>
        </ul>

    </div>


    <div class="col py-3">

        <!-- whatever content/file used, close 2 divs and one body and html tag -->

<script>
    $("#sidenav-close").on("click",function()
    {
       $("#sidebar-container").removeClass("sidebar-expanded d-none d-lg-block col-3").addClass("d-none");
       $("#sidenav-open").addClass("d-inline-block");
    });

    $("#sidenav-open").on("click",function()
    {
       $("#sidebar-container").addClass("sidebar-expanded d-none d-lg-block col-3");
       $("#sidenav-open").removeClass("d-inline-block");
    });
</script>
