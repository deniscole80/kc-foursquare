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

<body class="bg-light">
    <!--Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #ffffff;">
        <a class="navbar-brand" href="../../">
            <img src="../../img/fsLogo.png" width="30" height="30" class="d-inline-block align-top" alt="">
            <strong style="color: #f83f3f">Foursquare Youth Camp</strong>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto nav-flex-icons">
                <li class="nav-item avatar dropdown">
                    <a class="primary-text mx-3" href="../register-user">
                        <i class="fas fa-plus"></i> Create Account</a>
                    <a class="primary-text" href="../login/">
                        <i class="fas fa-key"></i> Login</a>
                </li>
            </ul>
        </div>
    </nav>
    <!-- Start your project here-->
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-md-12 col-sm-12 d-flex flex-column justify-content-center align-items-center">
            <div class="card p-4" style="width: 350px; margin-top: 20px;" id="emailCard">
                <!-- Default form group -->
                <h2>Retrieve QRCode</h2>
                <p class="text-danger" id="errorPhone">&nbsp;</p>
                <div class="form-group">
                    <label for="emailAddress" class="grey-text">Registered phone number</label>
                    <input type="number" data-toggle="tooltip" title="Field cannot be empty" class="form-control" id="qrPhone" placeholder="080xxxxx">
                    <div class="invalid-feedback">
                        Please provide a valid city.
                    </div>
                </div>
                <div class="form-group">
                    <button class="btn btn-danger w-100" id="getQRCodeLoader" type="button" style="display: none">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Loading...
                    </button>
                    <button class="btn btn-danger w-100" id="getQRCode">Proceed</button>
                </div>

            </div>
            <div class="card p-4" style="width: 350px; margin-top: 20px; display: none;" id="codeCard">


            </div>
        </div>
    </div>

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
                    Phone number is required
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

    <!-- End your project here-->
    <!-- jQuery -->
    <script type="text/javascript" src="../../js/jquery.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="../../js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="../../js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="../../js/mdb.min.js"></script>
    <!-- Your custom scripts (optional) -->
    <script type="text/javascript" src="../../js/index.js"></script>
</body>

</html>