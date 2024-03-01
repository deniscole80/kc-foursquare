<?php
  session_start();
  include '../classes/utils.php';

  $firstname = $_SESSION['firstname'];
  $lastname = $_SESSION['lastname'];
  $email = $_SESSION['email'];
  $firstnameFirst = substr($firstname, 0, 1);
  $lastnameFirst = substr($lastname, 0, 1);

  $campId = $_GET['id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Camp list</title>

    <link rel="icon" href="../img/fsLogo.png" type="image/x-icon" />

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <link href="css/pagination.css" rel="stylesheet" type="text/css">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">FS Admin <sup>YC</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="dashboard.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Admin & Camp Management
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Admin</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Admin Section:</h6>
                        <a class="collapse-item" href="create-admin.php">Create new</a>
                        <a class="collapse-item" href="admin-list.php">Admin list</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-angle-up"></i>
                    <span>Camp</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Camp Section:</h6>
                        <a class="collapse-item" href="create-camp.php">Create new</a>
                        <a class="collapse-item" href="camp-list.php">Camp list</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                User Management
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Users</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Users Section:</h6>
                        <a class="collapse-item" href="user-list.php">Users List</a>
                        <a class="collapse-item" href="scan-code.php">Scan Code</a>
                    </div>
                </div>
            </li>

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $firstname.' '.$lastname ?></span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Camp Statistics</h1>

                    <div class="card p-5">
                        <h6>Sort List by: </h6>
                        
                        <div class="row">
                            <div style="display: none" id="campIdHolder"><?php echo $campId ?></div>

                            <div class="col-sm-12 col-md-2">                                    
                                <div class="form-group">
                                    <label for="district" class="text-primary">District</label>
                                    <?php echo $districts; ?>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-2">
                                <div class="form-group">
                                    <label for="regType" class="text-primary">Registration type</label>
                                    <select class="browser-default custom-select form-control form-control-user" id="regType">
                                        <option value="" selected>Choose answer</option>
                                        <option value="regular">Regular</option>
                                        <option value="premium">Premium</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-2">
                                <div class="form-group">
                                    <label for="rName" class="text-primary">Registrer name</label>
                                    <input type="text" class="form-control form-control-user" id="rName"
                                        placeholder="Firstname Lastname">
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-2">
                                <div class="form-group">
                                    <label for="hic" class="text-primary">House in camp?</label>
                                    <select class="browser-default custom-select form-control form-control-user" id="hic">
                                        <option value="" selected>Choose answer</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-2">
                                <div class="form-group">
                                    <label for="pNumber" class="text-primary">Phone number</label>
                                    <input type="text" class="form-control form-control-user" id="pNumber"
                                        placeholder="Mobile">
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-2" style="padding-top: 32px">
                                <button class="form-control form-control-user btn btn-success" id="fetchStats"><i class="fas fa-search"></i> Search</button>
                            </div>
                        </div>
                        
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow my-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-arrow-left" id="backToCampList" style="cursor: pointer"></i> View All Statistics</h6>
                            <h6 style="float: right">Total: <span class="font-weight-bold text-primary totalStats">0</span></h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>Age Group</th>
                                            <th>Gender</th>
                                            <th>Foursquare Member?</th>
                                            <th>District</th>
                                            <th>Foodboot</th>
                                            <th>Amount Paid</th>
                                            <th>Reg Type</th>
                                            <th>Date Created</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>Age Group</th>
                                            <th>Gender</th>
                                            <th>Foursquare Member?</th>
                                            <th>District</th>
                                            <th>Have House</th>
                                            <th>Amount Paid</th>
                                            <th>Reg Type</th>
                                            <th>Date Created</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody id="statsList">
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div id="pagination-demo1"></div>
                            <button class="btn btn-success float-right" id="exportToExcel">Export to Excel</button>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Powered By <a href="https://corestack.com.ng" target="_blank">Core Stack</a></span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" id="logoutButtonAdmin">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Central Modal Small -->
    <div class="modal fade" id="regModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">

        <!-- Change class .modal-sm to change the size of the modal -->
        <div class="modal-dialog modal-sm" role="document">

            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title w-100" id="modalHeader"><i class="fas fa-exclamation-triangle text-danger"></i> Error</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body text-center" id="modalBody">
                    Email address is required
                </div>
                <!--div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary btn-sm">Save changes</button>
                </div-->
            </div>
        </div>
    </div>
    <!-- Central Modal Small -->
    
    <!-- QrCode Modal Large -->
    <div class="modal fade" id="qrModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <!-- Change class .modal-sm to change the size of the modal -->
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header" id="modalHeader">
                    <h5>QR Retrieved</h5>
                </div>

                <div class="modal-body text-center">
                    <h6 class="text-danger">Make sure to take a screen capture of your profile showing your food boot at the bottom. We have also sent this to your email</h6>
                    <div id="qrCode"></div>
                </div>
                <div class="modal-footer">
                    <!--button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button-->
                    <button type="button" class="btn btn-danger btn-sm" id="okRegAnonymous">Ok</button>
                </div>
            </div>
        </div>
    </div>
    <!-- QrCode Modal Large -->

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <!--script src="js/demo/datatables-demo.js"></script-->

    <script src="js/jquery.table2excel.js"></script>
    <script src="../js/pagination.js"></script>

    <script type="text/javascript" src="../js/index.js"></script>


</body>

</html>