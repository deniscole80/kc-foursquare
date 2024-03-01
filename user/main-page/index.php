<?php

include '../../classes/utils.php';

session_start();

if (isset($_SESSION['userId'])) {

    $firstname = $_SESSION['firstname'];

    $lastname = $_SESSION['lastname'];

    $email = $_SESSION['email'];

    $firstnameFirst = substr($firstname, 0, 1);

    $lastnameFirst = substr($lastname, 0, 1);

    $userId = $_SESSION['userId'];

    $campId = @$_SESSION['campId'];

    $regularFee = @$_SESSION['regularFee'];

    $campName = @$_SESSION['campName'];
} else {

    echo '<script>window.location.href = "../../";</script>';
}



?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <meta http-equiv="x-ua-compatible" content="ie=edge" />

    <title>Foursquare Youth Camp</title>

    <!-- MDB icon -->

    <link rel="icon" href="../../img/fsLogo.png" type="image/x-icon" />

    <!-- Font Awesome -->

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">

    <!-- Google Fonts Roboto -->

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">

    <!-- Bootstrap core CSS -->

    <link rel="stylesheet" href="../../css/bootstrap.min.css">

    <!-- Material Design Bootstrap -->

    <link rel="stylesheet" href="../../css/mdb.min.css">

    <!-- Your custom styles (optional) -->

    <link rel="stylesheet" href="../../css/style.css">

</head>



<body>

    <!-- Start your project here-->

    <!--Navbar -->

    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #ffffff;"><a class="navbar-brand" href=""> <img src="../../img/fsLogo.png" width="30" height="30" class="d-inline-block align-top" alt=""> <strong style="color: #f83f3f">Foursquare Youth Camp</strong></a><button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto nav-flex-icons">
                <li class="nav-item avatar dropdown"> <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-55" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span class="text-danger border border-danger" style="font-size: 12px; padding:10px;font-size:15px;font-weight:700;border-radius:50%;"> <?php echo $firstnameFirst . " " . $lastnameFirst ?> </span> </a>
                    <div class="dropdown-menu dropdown-menu-lg-right dropdown-secondary" aria-labelledby="navbarDropdownMenuLink-55"> <a class="dropdown-item" id="logoutButton">Logout</a> </div>
                </li>
            </ul>
        </div>

    </nav>

    <!--/.Navbar -->

    <div class="container-fluid">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs md-tabs nav-justified" role="tablist" style="background: #f3f3f3">
            <li class="nav-item tabHeader" id="1">
                <a class="nav-link active black-text" data-toggle="tab" href="#panel555" role="tab">
                    <i class="fas fa-plus"></i><br />Register <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item tabHeader" id="2">
                <a class="nav-link black-text" data-toggle="tab" href="#panel666" role="tab">
                    <i class="fas fa-user"></i><br />Profile</a>
            </li>
            <li class="nav-item tabHeader" id="3">
                <a class="nav-link black-text" data-toggle="tab" href="#panel777" role="tab">
                    <i class="fas fa-history"></i><br />History</a>
            </li>
        </ul>
        <!-- Nav tabs -->


        <!-- Tab panels -->
        <div class="tab-content" style="padding: 0 2em;">
            <!-- Panel 1 -->
            <div class="tab-pane fade in show active p-3" id="panel555" role="tabpanel">
                <?php
                $regForm = '

            <div id="qrData" style="display: none;">' . $userId . ':' . $campId . '</div>


            <div class="row">
                <div class="col-md-4 col-sm-12 col-lg-4">                                        <div class="d-flex flex-row justify-content-center">
                        <!-- Default switch -->
                        <span>Regular</span>&nbsp&nbsp
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="customSwitches">
                            <label class="custom-control-label" for="customSwitches">Premium</label>
                        </div>
                    </div>

                    <div id="regularDiv">


                        <h5 class="mt-4 text-primary formHeader">Regular Registration Form</h5>


                        <div class="alert alert-warning fade show" role="alert">
                            <span id="premiumMessage" style="display: none;"><strong>Notice!</strong> Registration fee covers special treats on; <br>Accomodation, program materials and subsidized feeding.</span>
                            <span id="regularMessage"><strong>Notice!</strong> Regular registration fee is #' . $regularFee . ', any further contribution you made would be added to it and charged together.
                            <br/>The registration fee covers; Accomodation, All program materials and subsidized feeding</span>
                        </div>


                        <div id="regularFee" style="display: none">' . $regularFee . '</div>                        <div id="userEmail" style="display: none">' . $email . '</div>


                        <div class="form-group">
                            <label for="firstname" class="grey-text">First Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="rfirstname" placeholder="Enter first name">
                        </div>


                        <div class="form-group">
                            <label for="lastname" class="grey-text">Last Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="rlastname" placeholder="Enter last name">
                        </div>


                        <div class="form-group">
                            <label for="phone" class="grey-text">Phone number <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="rphone" placeholder="Enter phone number">
                        </div>


                        <div class="form-group">
                            <label for="email" class="grey-text">Email Address</label>
                            <input type="email" class="form-control" id="remail" placeholder="Enter email address">
                        </div>


                        <div class="form-group">
                            <label class="grey-text">Age Group <span class="text-danger">*</span></label>
                            <select class="browser-default custom-select" id="rageGroup">
                                <option value="" selected>Choose age group</option>
                                <option value="11-20 years">11-20 years</option>
                                <option value="21-30 years">21-30 years</option>
                                <option value="31-40 years">31-40 years</option>
                                <option value="41-50 years">41-50 years</option>
                                <option value="Above 50 years">above 50 years</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label class="grey-text">Gender <span class="text-danger">*</span></label>
                            <select class="browser-default custom-select" id="rgender">
                                <option value="" selected>Choose gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>


                        <div class="form-group">
                            <label class="grey-text">Are you a Foursquare member? <span class="text-danger">*</span></label>
                            <select class="browser-default custom-select" id="rmember">
                                <option value="" selected>Choose answer</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>


                        <div class="form-group" id="rdistrictDiv">
                            <label class="grey-text">District <span class="text-danger">*</span></label>
                            ' . $districts . '
                        </div>


                        <div class="form-row isPremium">                            <div class="form-group">
                                <label for="anyAmount" class="grey-text">Are you willing to support ' . $campName . ' financially(Any amount) </label>
                                <input type="number" class="form-control" id="anyAmount" placeholder="Enter the amount">
                            </div>                        </div>


                        <div class="form-group" id="submitRegular">                            <button type="button" class="btn btn-rounded btn-danger submit-button ml-0" id="rregisterCamp"  onclick=""><i class="far fa-plus-square pr-2" aria-hidden="true"></i> Add to List</button>                                <button class="btn btn-danger btn-rounded submit-loader" id="rregisterLoader" type="button" style="display: none">                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>                                    Loading...                                 </button>                        </div>                        <div class="form-group" id="submitPremium" style="display: none;">                            <button type="button" class="btn btn-rounded btn-danger submit-button ml-0" id="pregisterCamp"  onclick=""><i class="far fa-plus-square pr-2" aria-hidden="true"></i> Add to List</button>                                <button class="btn btn-danger btn-rounded submit-loader" id="pregisterLoader" type="button" style="display: none">                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>                                    Loading...                                 </button>                        </div>


                    </div>
                </div>                

                <!--Bulk table-->                <div class="col-md-8 col-lg-8 col-sm-12 p-3">                    <div class="float-right mb-5">                        <h4 class="grey-text">Total : &#8358;<span id="total" class="text-success">0</span></h4>                    </div>                    <div class="table-responsive">                        <table class="table table-striped table-hover" style="">                            <thead>                                <tr>                                <th scope="col">#</th>                                <th scope="col">First</th>                                <th scope="col">Last</th>                                <th scope="col">Phone</th>                                <th scope="col">Email</th>                                <th scope="col">Age group</th>                                <th scope="col">Gender</th>                                <th scope="col">Member</th>                                <th scope="col">District</th>                                <th scope="col">Reg type</th>                                <th scope="col">Fee</th>                                </tr>                            </thead>                            <tbody id="participantTable">                                                            </tbody>                        </table>                    </div>                        <div class="mt-5 text-center">                        <button class="btn btn-danger btn-rounded" id="bulkRegisterLoader" type="button" style="display: none">                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>                                Loading...                        </button>                            <button type="button" class="btn btn-rounded btn-danger" id="bulkRegisterCamp" onclick=""><i class="far fa-plus-square pr-2" aria-hidden="true"></i></i>Process Payment</button>                    </div>                </div>                <!--Bulk table-->            </div>';
                $noRegForm = '<div class="text-center">
                            <img src="../../admin/img/undraw_camping_noc8.svg" style="max-width: 200px; max-height: auto;"/>
                            <div class="text-center text-danger mt-5">No active camp available</div>
                        </div>';
                echo (isset($_SESSION['campId'])) ? $regForm : $noRegForm;


                echo '<div class="form-group" id="isPremiumReplace" style="display: none;"><label for="anyAmount" class="grey-text">Are you willing to support ' . $campName . ' financially (Any amount) </label>
            <input type="number" class="form-control" id="anyAmount" placeholder="Enter the amount"></div>';
                ?>


            </div>
            <!-- Panel 1 -->

            <!-- Panel 2 -->
            <div class="tab-pane fade" id="panel666" role="tabpanel">


                <div class="d-flex justify-content-center">
                    <div class="border border-danger mt-4 text-center d-flex justify-content-center align-items-center" style="border-radius: 100px; padding:20px; width: 100px; height: 100px; background-color: black;">
                        <span class="text-danger" style="font-size: 20px;"><?php echo $firstnameFirst . " " . $lastnameFirst ?></span>
                    </div>
                </div>


                <h6 class="text-center"><?php echo $email; ?></h6>
                <h6 class="text-center text-danger"><i class="far fa-user"></i> User</h6>


                <div class="mt-4">
                    <h4 class="my-4">Transaction History</h4>


                    <div id="transactionList" class="p-2">


                    </div>


                </div>


            </div>
            <!-- Panel 2 -->


            <!-- Panel 3 -->
            <div class="tab-pane fade" id="panel777" role="tabpanel">


                <div class="table-responsive">
                    <!--Table-->
                    <table class="table table-striped">


                        <!--Table head-->
                        <thead>
                            <tr>
                                <th>Camp</th>
                                <th>Theme</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <!--Table head-->


                        <!--Table body-->
                        <tbody id="campList">
                            <tr id="loader" hidden="true">
                                <td colspan="6" class="text-center">
                                    <!--Small yellow-->
                                    <div class="spinner-border text-danger" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                        <!--Table body-->
                    </table>
                    <!--Table-->
                </div>


            </div>
            <!-- Panel 3 -->


        </div>
        <!-- Tab panels -->

    </div>



    <!-- Footer -->
    <footer class="sticky-footer bg-white">
        <div class="container my-auto">
            <div class="copyright text-center my-auto"> <span>Powered By <a href="https://corestack.com.ng" target="_blank">Core Stack</a></span> </div>
        </div>
    </footer>
    <!-- End of Footer -->

    <!-- End your project here-->



    <!-- Central Modal Small -->

    <div class="modal fade" id="regModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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



    <!-- Central Modal Large -->

    <div class="modal fade" id="historyModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <!-- Change class .modal-sm to change the size of the modal -->
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title w-100" id="modalHeaderHistory"><i class="fas fa-exclamation-triangle text-danger"></i> Error</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <div class="table-responsive">
                        <!--Table-->
                        <table class="table table-striped">


                            <!--Table head-->
                            <thead>
                                <tr>
                                    <th>Camp</th>
                                    <th>Fullname</th>
                                    <th>Gender</th>
                                    <th>Kids</th>
                                    <th>Age group</th>
                                    <th>District</th>
                                    <th>Arrival</th>
                                    <th>Amount paid</th>
                                </tr>
                            </thead>
                            <!--Table head-->


                            <!--Table body-->
                            <tbody id="modalBodyHistory">


                            </tbody>
                            <!--Table body-->
                        </table>
                        <!--Table-->
                    </div>
                </div>
                <!--div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary btn-sm">Save changes</button>
        </div-->
            </div>
        </div>

    </div>

    <!-- Central Modal Large -->



    <!-- QrCode Modal Large -->
    <div class="modal fade" id="qrModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <!-- Change class .modal-sm to change the size of the modal -->
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header" id="modalHeader">
                    <h5>Registration Successful</h5>
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



    <!-- jQuery -->

    <script type="text/javascript" src="../../js/jquery.min.js"></script>
    <script type="text/javascript" src="../../js/pagination.js"></script>

    <!-- Bootstrap tooltips -->

    <script type="text/javascript" src="../../js/popper.min.js"></script>

    <!-- Bootstrap core JavaScript -->

    <script type="text/javascript" src="../../js/bootstrap.min.js"></script>

    <!-- MDB core JavaScript -->

    <script type="text/javascript" src="../../js/mdb.min.js"></script>

    <!-- Your custom scripts (optional) -->

    <script type="text/javascript" src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>

    <script src="https://js.paystack.co/v1/inline.js"></script>

    <script type="text/javascript" src="../../js/index.js"></script>
    <!-- <script type="text/javascript" src="../../js/payedin.js"></script> -->


    <script type="text/javascript">
        // $('.datepicker').datepicker({ 
        //     inline: true
        // });
    </script>

</body>

</html>