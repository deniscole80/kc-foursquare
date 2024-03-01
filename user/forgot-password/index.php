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
                <h2>Forgot Password</h2>
                <p class="text-info">Enter email below to verify</p>

                <div class="form-group">
                    <label for="emailAddress" class="grey-text">Email Address</label>
                    <input type="email" class="form-control" id="emailAddress" placeholder="Enter email">
                </div>

                <div class="form-group">
                    <button class="btn btn-danger w-100" id="verifyLoader" type="button" style="display: none">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Loading...
                    </button>
                    <button class="btn btn-danger w-100" id="verifyEmail">Proceed</button>
                </div>
                
            </div>

            <div class="card p-4" style="width: 350px; margin-top: 20px; display: none;" id="codeCard">
                <!-- Default form group -->
                <h2>Verification Code</h2>
                <p class="text-info">Enter verification code below</p>

                <div class="form-group">
                    <label for="emailAddress" class="grey-text">Verification Code</label>
                    <input type="text" class="form-control" id="vCode" placeholder="Enter code here">
                </div>

                <div class="form-group">
                    <button class="btn btn-danger w-100" id="codeLoader" type="button" style="display: none">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Loading...
                    </button>
                    <button class="btn btn-danger w-100" id="verifyCode">Verify Code</button>
                </div>
                
            </div>

            <div class="card p-4" style="width: 350px; margin-top: 20px; display: none;" id="passwordCard">
                <!-- Default form group -->
                <h2>Reset Password</h2>
                <p class="text-info">Enter new password below</p>

                <div class="form-group">
                    <label for="newPassword" class="grey-text">New Password</label>
                    <input type="password" class="form-control" id="newPassword" placeholder="New password">
                </div>

                <div class="form-group">
                    <label for="repeatPassword" class="grey-text">Repeat Password</label>
                    <input type="password" class="form-control" id="repeatPassword" placeholder="Repeat password">
                </div>

                <div class="form-group">
                    <button class="btn btn-danger w-100" id="passwordLoader" type="button" style="display: none">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Loading...
                    </button>
                    <button class="btn btn-danger w-100" id="changePassword">Change Password</button>
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
