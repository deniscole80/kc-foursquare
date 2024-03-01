<?php
// require_once("classes/qrcode.php");
include 'classes/User.php';
include 'classes/DB/conn_db.php';
include 'classes/utils.php';
$userObj = new User($conn, "", "", "", "", "");
$auxData = $userObj->fetchAuxData();
$campId = @$auxData['id'];
$regularFee = @$auxData['fee'];
$campName = @$auxData['name'];
// $qr = QRCode::getMinimumQRCode("Korede", 1);
// // イメージ作成(引数:サイズ,マージン)
// $im = $qr->createImage(14, 4);
// // header("Content-type: image/gif");
// ob_start();
// imagepng($im);
// $image = 'data:image/png;base64,' . base64_encode(ob_get_contents());
// ob_end_clean();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta property="og:title" content="Foursquare Youth Camp">
    <meta property="og:description" content="Registration portal for <?php echo $campName ?>">
    <meta property="og:image" content="https://kc.foursquareyouth.org.ng/img/kc24.jpeg">
    <meta property="og:url" content="https://kc.foursquareyouth.org.ng">
    <meta property="og:type" content="website">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Foursquare Youth Camp">
    <meta name="twitter:description" content="Registration portal for <?php echo $campName ?>">
    <meta name="twitter:image" content="https://kc.foursquareyouth.org.ng/img/kc24.jpeg">
    <title>Foursquare Youth Camp</title>
    <!-- MDB icon -->
    <link rel="icon" href="img/fsLogo.png" type="image/x-icon" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Material Design Bootstrap -->
    <link rel="stylesheet" href="css/mdb.min.css">
    <!-- Your custom styles (optional) -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <style>
        body {
            min-height: 100vh;
            position: relative;
        }

        .sticky-footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            padding: 0.3em;
        }
    </style>
    <!-- Start your project here-->
    <!--Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #ffffff;">
        <a class="navbar-brand" href="">
            <img src="img/fsLogo.png" width="30" height="30" class="d-inline-block align-top" alt="">
            <strong style="color: #f83f3f">Foursquare Youth Camp</strong>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto nav-flex-icons">
                <li class="nav-item avatar dropdown">
                    <a class="primary-text mx-3" href="user/register-user"><i class="fas fa-plus"></i> Create Account</a>
                    <a class="primary-text" href="user/login"><i class="fas fa-key"></i> Login</a>
                </li>
            </ul>
        </div>

    </nav>
    <div class="container pb-5">
        <!-- Panel 1 -->
        <div class="tab-pane fade in show active p-3" id="panel555" role="tabpanel">
            <?php
            $regForm = '
            <div id="registrationView" style="display: none;">
                <div class="d-flex flex-row justify-content-center">
                    <!-- Default switch -->
                    <span>Regular</span>&nbsp&nbsp
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="customSwitches">
                        <label class="custom-control-label" for="customSwitches">Premium</label>
                    </div>
                </div>
                <div id="qrData" style="display: none;">' . $campId . '</div>
                <div id="regularDiv">
                    <h5 class="mt-4 text-primary formHeader">Regular Registration Form</h5>
                    <div class="alert alert-warning fade show" role="alert">
                        <span id="premiumMessage" style="display: none;"><strong>Notice!</strong> Registration fee covers special treats on; <br>Accomodation, program materials and subsidized feeding.</span>
                        <span id="regularMessage"><strong>Notice!</strong> Regular registration fee is #' . $regularFee . ', any further contribution you made would be added to it and charged together.
                        <br/>The registration fee covers; Accomodation, All program materials and subsidized feeding</span>
                    </div>
                    <div id="regularFee" style="display: none">' . $regularFee . '</div>
                    
                    <div class="form-row">
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="firstname" class="grey-text">First Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="rfirstname" placeholder="Enter first name">
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="lastname" class="grey-text">Last Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="rlastname" placeholder="Enter last name">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="phone" class="grey-text">Phone number <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="rphone" placeholder="Enter phone number">
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="email" class="grey-text">Email Address</label>
                            <input type="email" class="form-control" id="remail" placeholder="Enter email address">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6 col-sm-12">
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
                        <div class="form-group col-md-6 col-sm-12">
                            <label class="grey-text">Gender <span class="text-danger">*</span></label>
                            <select class="browser-default custom-select" id="rgender">
                                <option value="" selected>Choose gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div class="form-row">
                        <div class="form-group col-md-6 col-sm-12">
                            <label class="grey-text">Are you a Foursquare member? <span class="text-danger">*</span></label>
                            <select class="browser-default custom-select" id="rmember">
                                <option value="" selected>Choose answer</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6 col-sm-12" id="rdistrictDiv">
                            <label class="grey-text">District <span class="text-danger">*</span></label>
                            ' . $districts . '
                        </div>
                    </div>
                    <div class="form-row isPremium">
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="anyAmount" class="grey-text">Are you willing to support ' . $campName . ' financially (Any amount) </label>
                            <input type="number" class="form-control" id="anyAmount" placeholder="Enter the amount">
                        </div>
                    </div>
                    <div class="form-group" id="submitRegular">
                        <button type="button" class="btn btn-rounded btn-danger align-left submit-button" id="rregisterCampAnonymous"  onclick=""><i class="far fa-plus-square pr-2" aria-hidden="true"></i> Register Now</button>
                        <button class="btn btn-danger btn-rounded submit-loader" id="rregisterLoader" type="button" style="display: none">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Loading... 
                        </button>
                    </div>
                    <div class="form-group" id="submitPremium" style="display: none;">
                        <button type="button" class="btn btn-rounded btn-danger align-left submit-button" id="pregisterCampAnonymous"  onclick=""><i class="far fa-plus-square pr-2" aria-hidden="true"></i> Register Now</button>
                        <button class="btn btn-danger btn-rounded submit-loader" id="pregisterLoader" type="button" style="display: none">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Loading... 
                        </button>
                    </div>
                </div>
            </div>
            ';
            $noRegForm = empty($campId) ? '<div class="alert alert-warning" role="alert">
                            No active camp available!
                        </div>' : '';
            $shouldDisable = empty($campId) ? "disabled" : "";
            $startPage = '
                    <div id="homeView" class="mt-5 mb-5 pb-5">
                        <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="border d-flex flex-column">
                                        <img src="img/newness.jpg" style="max-height: auto; max-width: auto;"/>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="p-3 d-flex flex-column justify-content-center align-items-center">
                                        <h5 class="mt-4 text-danger">Welcome!!!</h5>
                                        <h6>to</h6>
                                        <h5 class="text-center">' . $campName . ' Youth Camp Registration Portal</h5>
                                        <h3 class="text-center" style="font-weight: bold;">
                                            Discount! Discount! Discount! <br>
                                            For Early birds:  <br>
                                            Nov - March: #2700. <br>
                                            April - July: #3000 <br>
                                            July - August : #3500
                                        </h3>
                                        <!-- <h3 class="text-center text-primary">This free space expires on 21st July</h3> -->
                                        <br>
                                        <div class="d-flex justify-content-center row">
                                            <!-- <a class="btn btn-rounded btn-danger btn-lg m-2 ' . $shouldDisable . '" href="user/register-user/">Group Registration</a> -->
                                            <a class="btn btn-rounded btn-outline-danger btn-lg m-2" href="#individualRegistration" id="individualRegistration" ' . $shouldDisable . '>Individual Regristration</a>
                                        </div>
                                    </div>
                                </div>
                            <br>
                            <!-- div class="row">
                                Have you registered already? &nbsp; <a href="user/get-barcode"> Retrieve your barcode here</a>
                            </div -->
                            ' . $noRegForm . '
                        </div>
                    </div>';
            echo $startPage;
            echo $regForm;
            echo '<div class="form-group col-md-6 col-sm-12" id="isPremiumReplace" style="display: none;"><label for="anyAmount" class="grey-text">Are you willing to support ' . $campName . ' financially (Any amount) </label>
            <input type="number" class="form-control" id="anyAmount" placeholder="Enter the amount"></div>';
            ?>
        </div>
        <!-- Panel 1 -->
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
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <!-- <script type="text/javascript" src="js/pagination.js"></script> -->
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <!-- Your custom scripts (optional) -->
    <script type="text/javascript" src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
    <script src="https://js.paystack.co/v1/inline.js"></script>
    <script type="text/javascript" src="js/index.js"></script>
    <!-- <script type="text/javascript" src="js/payedin.js"></script> -->
    <!-- <script type="text/javascript">
        $('.datepicker').datepicker({
            inline: true
        });
    </script> -->
</body>

</html>