<?php

    session_start();



    include 'DB/conn_db.php';

    include 'Query.php';

    include 'User.php';

    include 'Admin.php';



    if(isset($_POST["registerUser"])){

        $firstname = mysqli_real_escape_string($conn, htmlentities($_POST["firstname"]));

        $lastname = mysqli_real_escape_string($conn, htmlentities($_POST["lastname"]));

        $email = mysqli_real_escape_string($conn, htmlentities($_POST["email"]));

        $password = mysqli_real_escape_string($conn, htmlentities($_POST["password"]));

        $rPassword = mysqli_real_escape_string($conn, htmlentities($_POST["rPassword"]));

        $date_time = date("Y-m-d h:i:s A");



        $userObj = new User($conn, $firstname, $lastname, $email, $password, $date_time);

        $userObj->registerUser();

    }

    else if(isset($_POST["registerAdmin"])){

        $firstname = mysqli_real_escape_string($conn, htmlentities($_POST["firstname"]));

        $lastname = mysqli_real_escape_string($conn, htmlentities($_POST["lastname"]));

        $email = mysqli_real_escape_string($conn, htmlentities($_POST["email"]));

        $password = mysqli_real_escape_string($conn, htmlentities($_POST["password"]));

        $rPassword = mysqli_real_escape_string($conn, htmlentities($_POST["rPassword"]));

        $date_time = date("Y-m-d h:i:s A");



        $adminObj = new Admin($conn, $firstname, $lastname, $email, $password, $date_time);

        $adminObj->registerAdmin();

    }

    else if(isset($_POST["createCamp"])){

        $campName = mysqli_real_escape_string($conn, htmlentities($_POST["campName"]));

        $campTheme = mysqli_real_escape_string($conn, htmlentities($_POST["campTheme"]));

        $startDate = mysqli_real_escape_string($conn, htmlentities($_POST["startDate"]));

        $endDate = mysqli_real_escape_string($conn, htmlentities($_POST["endDate"]));

        $rrFee = mysqli_real_escape_string($conn, htmlentities($_POST["rrFee"]));

        $status = "active";

        $date_time = date("Y-m-d h:i:s A");



        $adminObj = new Admin($conn, "", "", "", "", "");

        $adminObj->createCamp($campName, $campTheme, $startDate, $endDate, $rrFee, $status, $date_time);

    }

    else if(isset($_POST["search"])){
        $tx_ref = mysqli_real_escape_string($conn, htmlentities($_POST["tx_ref"]));
        $pref = mysqli_real_escape_string($conn, htmlentities($_POST["pref"]));
        $userObj = new User($conn, "", "", "", "", "");
        $userObj->getPayedInUser($tx_ref, $pref); 
    }
    else if(isset($_POST["searchbulk"])){
        $tx_ref = mysqli_real_escape_string($conn, htmlentities($_POST["tx_ref"]));
        $pref = mysqli_real_escape_string($conn, htmlentities($_POST["pref"]));
        $userObj = new User($conn, "", "", "", "", "");
        // echo "$tx_ref, in ppp";
        $userObj->getPayedInBulk($tx_ref, $pref);  
    }

    else if(isset($_POST["pregularRegAnonymous"])){
        $firstname = mysqli_real_escape_string($conn, htmlentities($_POST["firstname"]));
        $lastname = mysqli_real_escape_string($conn, htmlentities($_POST["lastname"]));
        $phone = mysqli_real_escape_string($conn, htmlentities($_POST["phone"]));
        $email = mysqli_real_escape_string($conn, htmlentities($_POST["email"]));
        $ageGroup = mysqli_real_escape_string($conn, htmlentities($_POST["ageGroup"]));
        $gender = mysqli_real_escape_string($conn, htmlentities($_POST["gender"]));
        $kidsComing = mysqli_real_escape_string($conn, htmlentities($_POST["kidsComing"]));
        $kidsNumber = mysqli_real_escape_string($conn, htmlentities($_POST["kidsNumber"]));
        $member = mysqli_real_escape_string($conn, htmlentities($_POST["member"]));
        $district = mysqli_real_escape_string($conn, htmlentities($_POST["district"]));
        $arrivalDate = mysqli_real_escape_string($conn, htmlentities($_POST["arrivalDate"]));
        $houseAccess = mysqli_real_escape_string($conn, htmlentities($_POST["houseAccess"]));
        $anyAmount = mysqli_real_escape_string($conn, htmlentities($_POST["anyAmount"]));
        $ref = mysqli_real_escape_string($conn, htmlentities($_POST["ref"]));
        $userId = mysqli_real_escape_string($conn, htmlentities($_POST["userId"]));
        $campId = mysqli_real_escape_string($conn, htmlentities($_POST["campId"]));
        $payment_status = mysqli_real_escape_string($conn, htmlentities($_POST["payment_status"]));
        $tx_ref = mysqli_real_escape_string($conn, htmlentities($_POST["tx_ref"]));
        $date_time = date("Y-m-d h:i:s A");
        $regType = "regular";
        $refrence = 
        $userObj = new User($conn, "", "", "", "", "");
        $userObj->registerPayedInUser($firstname, $lastname, $phone, $email, $ageGroup, $gender, $kidsComing, $kidsNumber,
                                $member, $district, $arrivalDate, $houseAccess, $anyAmount, $date_time, $regType, $ref, $userId, $campId, $payment_status, $tx_ref);
    }

    else if(isset($_POST["logUserIn"])){

        $email = mysqli_real_escape_string($conn, htmlentities($_POST["email"]));

        $password = mysqli_real_escape_string($conn, htmlentities($_POST["password"]));

        $date_time = date("Y-m-d h:i:s A");



        $userObj = new User($conn, "", "", $email, $password, $date_time);

        $userObj->logUserIn();

    }

    else if(isset($_POST["adminLogin"])){

        $email = mysqli_real_escape_string($conn, htmlentities($_POST["email"]));

        $password = mysqli_real_escape_string($conn, htmlentities($_POST["password"]));

        $date_time = date("Y-m-d h:i:s A");



        $adminObj = new Admin($conn, "", "", $email, $password, $date_time);

        $adminObj->logAdminIn();

    }

    else if(isset($_POST["bulkReg"])){ 

        $participantArray = json_decode($_POST["arrayParticipant"], true);
        $ref = mysqli_real_escape_string($conn, htmlentities($_POST["ref"]));
        $userId = mysqli_real_escape_string($conn, htmlentities($_POST["userId"]));
        $campId = mysqli_real_escape_string($conn, htmlentities($_POST["campId"]));
        $date_time = date("Y-m-d h:i:s A");



        $userObj = new User($conn, "", "", "", "", "");

        $userObj->bulkRegisterCamp($participantArray, $ref, $userId, $campId, $date_time);

    }
    else if(isset($_POST["payedBulk"])){ 
        $list = $_POST["arrayParticipant"];
        $tx_ref = mysqli_real_escape_string($conn, htmlentities($_POST["tx_ref"]));
        $userId = mysqli_real_escape_string($conn, htmlentities($_POST["userId"]));
        $campId = mysqli_real_escape_string($conn, htmlentities($_POST["campId"]));
        $date_time = date("Y-m-d h:i:s A");


        $userObj = new User($conn, "", "", "", "", "");
        $userObj->pbulkRegisterCamp($list, $tx_ref, $userId, $campId, $date_time);

    }

    else if(isset($_POST["regularRegAnonymous"])){

        $firstname = mysqli_real_escape_string($conn, htmlentities($_POST["firstname"]));

        $lastname = mysqli_real_escape_string($conn, htmlentities($_POST["lastname"]));

        $phone = mysqli_real_escape_string($conn, htmlentities($_POST["phone"]));

        $email = mysqli_real_escape_string($conn, htmlentities($_POST["email"]));

        $ageGroup = mysqli_real_escape_string($conn, htmlentities($_POST["ageGroup"]));

        $gender = mysqli_real_escape_string($conn, htmlentities($_POST["gender"]));

        $kidsComing = mysqli_real_escape_string($conn, htmlentities($_POST["kidsComing"]));

        $kidsNumber = mysqli_real_escape_string($conn, htmlentities($_POST["kidsNumber"]));

        $member = mysqli_real_escape_string($conn, htmlentities($_POST["member"]));

        $district = mysqli_real_escape_string($conn, htmlentities($_POST["district"]));

        $arrivalDate = mysqli_real_escape_string($conn, htmlentities($_POST["arrivalDate"]));

        $houseAccess = mysqli_real_escape_string($conn, htmlentities($_POST["houseAccess"]));

        $anyAmount = mysqli_real_escape_string($conn, htmlentities($_POST["anyAmount"]));

        $ref = mysqli_real_escape_string($conn, htmlentities($_POST["ref"]));

        $userId = mysqli_real_escape_string($conn, htmlentities($_POST["userId"]));

        $campId = mysqli_real_escape_string($conn, htmlentities($_POST["campId"]));

        $date_time = date("Y-m-d h:i:s A");

        $regType = "regular";



        $userObj = new User($conn, "", "", "", "", "");

        $userObj->registerCampAnonymous($firstname, $lastname, $phone, $email, $ageGroup, $gender, $kidsComing, $kidsNumber,

                                $member, $district, $arrivalDate, $houseAccess, $anyAmount, $date_time, $regType, $ref, $userId, $campId);

    }

    else if(isset($_POST["premiumReg"])){

        $firstname = mysqli_real_escape_string($conn, htmlentities($_POST["firstname"]));

        $lastname = mysqli_real_escape_string($conn, htmlentities($_POST["lastname"]));

        $phone = mysqli_real_escape_string($conn, htmlentities($_POST["phone"]));

        $email = mysqli_real_escape_string($conn, htmlentities($_POST["email"]));

        $ageGroup = mysqli_real_escape_string($conn, htmlentities($_POST["ageGroup"]));

        $gender = mysqli_real_escape_string($conn, htmlentities($_POST["gender"]));

        $kidsComing = mysqli_real_escape_string($conn, htmlentities($_POST["kidsComing"]));

        $kidsNumber = mysqli_real_escape_string($conn, htmlentities($_POST["kidsNumber"]));

        $member = mysqli_real_escape_string($conn, htmlentities($_POST["member"]));

        $district = mysqli_real_escape_string($conn, htmlentities($_POST["district"]));

        $arrivalDate = mysqli_real_escape_string($conn, htmlentities($_POST["arrivalDate"]));

        $houseAccess = mysqli_real_escape_string($conn, htmlentities($_POST["houseAccess"]));

        $anyAmount = mysqli_real_escape_string($conn, htmlentities($_POST["premiumAmount"]));

        $ref = mysqli_real_escape_string($conn, htmlentities($_POST["ref"]));

        $userId = mysqli_real_escape_string($conn, htmlentities($_POST["userId"]));

        $campId = mysqli_real_escape_string($conn, htmlentities($_POST["campId"]));

        $date_time = date("Y-m-d h:i:s A");

        $regType = "premium";



        $userObj = new User($conn, "", "", "", "", "");

        $userObj->registerCamp($firstname, $lastname, $phone, $email, $ageGroup, $gender, $kidsComing, $kidsNumber,

                                $member, $district, $arrivalDate, $houseAccess, $anyAmount, $date_time, $regType, $ref, $userId, $campId);

        //echo "In php";

    }

    else if(isset($_POST["premiumRegAnonymous"])){

        $firstname = mysqli_real_escape_string($conn, htmlentities($_POST["firstname"]));

        $lastname = mysqli_real_escape_string($conn, htmlentities($_POST["lastname"]));

        $phone = mysqli_real_escape_string($conn, htmlentities($_POST["phone"]));

        $email = mysqli_real_escape_string($conn, htmlentities($_POST["email"]));

        $ageGroup = mysqli_real_escape_string($conn, htmlentities($_POST["ageGroup"]));

        $gender = mysqli_real_escape_string($conn, htmlentities($_POST["gender"]));

        $kidsComing = mysqli_real_escape_string($conn, htmlentities($_POST["kidsComing"]));

        $kidsNumber = mysqli_real_escape_string($conn, htmlentities($_POST["kidsNumber"]));

        $member = mysqli_real_escape_string($conn, htmlentities($_POST["member"]));

        $district = mysqli_real_escape_string($conn, htmlentities($_POST["district"]));

        $arrivalDate = mysqli_real_escape_string($conn, htmlentities($_POST["arrivalDate"]));

        $houseAccess = mysqli_real_escape_string($conn, htmlentities($_POST["houseAccess"]));

        $anyAmount = mysqli_real_escape_string($conn, htmlentities($_POST["premiumAmount"]));

        $ref = mysqli_real_escape_string($conn, htmlentities($_POST["ref"]));

        $userId = mysqli_real_escape_string($conn, htmlentities($_POST["userId"]));

        $campId = mysqli_real_escape_string($conn, htmlentities($_POST["campId"]));

        $date_time = date("Y-m-d h:i:s A");

        $regType = "premium";



        $userObj = new User($conn, "", "", "", "", "");

        $userObj->registerCampAnonymous($firstname, $lastname, $phone, $email, $ageGroup, $gender, $kidsComing, $kidsNumber,

                                $member, $district, $arrivalDate, $houseAccess, $anyAmount, $date_time, $regType, $ref, $userId, $campId);

        //echo "In php";

    }
    else if(isset($_POST["ppremiumRegAnonymous"])){

        $firstname = mysqli_real_escape_string($conn, htmlentities($_POST["firstname"]));

        $lastname = mysqli_real_escape_string($conn, htmlentities($_POST["lastname"]));

        $phone = mysqli_real_escape_string($conn, htmlentities($_POST["phone"]));

        $email = mysqli_real_escape_string($conn, htmlentities($_POST["email"]));

        $ageGroup = mysqli_real_escape_string($conn, htmlentities($_POST["ageGroup"]));

        $gender = mysqli_real_escape_string($conn, htmlentities($_POST["gender"]));

        $kidsComing = mysqli_real_escape_string($conn, htmlentities($_POST["kidsComing"]));

        $kidsNumber = mysqli_real_escape_string($conn, htmlentities($_POST["kidsNumber"]));

        $member = mysqli_real_escape_string($conn, htmlentities($_POST["member"]));

        $district = mysqli_real_escape_string($conn, htmlentities($_POST["district"]));

        $arrivalDate = mysqli_real_escape_string($conn, htmlentities($_POST["arrivalDate"]));

        $houseAccess = mysqli_real_escape_string($conn, htmlentities($_POST["houseAccess"]));

        $anyAmount = mysqli_real_escape_string($conn, htmlentities($_POST["premiumAmount"]));

        $ref = mysqli_real_escape_string($conn, htmlentities($_POST["ref"]));

        $userId = mysqli_real_escape_string($conn, htmlentities($_POST["userId"]));

        $campId = mysqli_real_escape_string($conn, htmlentities($_POST["campId"]));
        
        $payment_status = mysqli_real_escape_string($conn, htmlentities($_POST["payment_status"]));
        $tx_ref = mysqli_real_escape_string($conn, htmlentities($_POST["tx_ref"]));

        $date_time = date("Y-m-d h:i:s A");

        $regType = "premium";



        $userObj = new User($conn, "", "", "", "", "");
        $userObj->registerPayedInUser($firstname, $lastname, $phone, $email, $ageGroup, $gender, $kidsComing, $kidsNumber, $member, $district, $arrivalDate, $houseAccess, $anyAmount, $date_time, $regType, $ref, $userId, $campId, $payment_status, $tx_ref);

        // echo "In php";

    }

    else if(isset($_POST["fetchCamps"])){

        $userObj = new User($conn, "", "", "", "", "");

        $userObj->fetchCamps();

    }

    else if(isset($_POST["logout"])){

        $userObj = new User($conn, "", "", "", "", "");

        $userObj->logout();

    }

    else if(isset($_POST["closeCamp"])){

        $adminObj = new Admin($conn, "", "", "", "", "");

        $adminObj->closeCamp();

    }

    else if(isset($_POST["fetchDashboard"])){

        $adminObj = new Admin($conn, "", "", "", "", "");

        $adminObj->fetchDashboardData();

    }

    else if(isset($_POST["fetchDetails"])){

        $campId = $_POST["campId"];

        $adminObj = new Admin($conn, "", "", "", "", "");

        $adminObj->fetchCampDetails($campId);

    }

    else if(isset($_POST["fetchAdmins"])){

        $adminObj = new Admin($conn, "", "", "", "", "");

        $adminObj->fetchAdmins();

    }

    else if(isset($_POST["fetchUsers"])){

        $userObj = new User($conn, "", "", "", "", "");

        $userObj->fetchUsers();

    }

    else if(isset($_POST["fetchTHistory"])){

        $userObj = new User($conn, "", "", "", "", "");

        $userObj->fetchTHistory();

    }

    else if(isset($_POST["fetchHistory"])){

        $campId = $_POST['campId'];

        $userObj = new User($conn, "", "", "", "", "");

        $userObj->fetchHistory($campId);

    }

    else if(isset($_POST["fetchHistoryAdmin"])){

        $campId = $_POST['campId'];

        $userId = $_POST['userId'];

        $userObj = new User($conn, "", "", "", "", "");

        $userObj->fetchHistoryAdmin($campId, $userId);

    }

    else if(isset($_POST["fetchStats"])){

        $campId = $_POST['campId'];

        $district = $_POST['district'];

        $regType = $_POST['regType'];

        $rName = $_POST['rName'];

        $pNumber = $_POST['pNumber'];

        $hic = $_POST['hic'];

        //echo $campId.' - '.$district.' - '.$regType.' - '.$rName.' - '.$hic;

        $adminObj = new Admin($conn, "", "", "", "", "");

        $adminObj->fetchStats($campId, $district, $regType, $rName, $pNumber, $hic);

    }

    else if(isset($_POST["verifyUser"])){

        $userId = $_POST['userId'];

        $campId = $_POST['campId'];

        $refId = $_POST['refId'];

        //echo $campId.' - '.$district.' - '.$regType.' - '.$rName.' - '.$hic;

        $adminObj = new Admin($conn, "", "", "", "", "");

        $adminObj->verifyQrCode($userId, $campId, $refId);

    }

    else if(isset($_POST["verifyUser2"])){

        $userId = $_POST['userId'];
        $campId = $_POST['campId'];
        $refId = $_POST['refId'];
        $isBulk = $_POST['isBulk'];

        //echo $campId.' - '.$district.' - '.$regType.' - '.$rName.' - '.$hic;

        $adminObj = new Admin($conn, "", "", "", "", "");

        $adminObj->verifyQrCode2($userId, $campId, $refId, $isBulk);

    }

    else if(isset($_POST["verifyEmail"])){

        $email = mysqli_real_escape_string($conn, htmlentities($_POST["email"]));

        $userObj = new User($conn, "", "", "", "", "");

        $userObj->verifyEmail($email);

    }

    else if(isset($_POST["verifyCode"])){

        $email = mysqli_real_escape_string($conn, htmlentities($_POST["email"]));

        $code = mysqli_real_escape_string($conn, htmlentities($_POST["code"]));

        $userObj = new User($conn, "", "", "", "", "");

        $userObj->verifyCode($email, $code);

    }

    else if(isset($_POST["changePassword"])){

        $email = mysqli_real_escape_string($conn, htmlentities($_POST["email"]));

        $np = mysqli_real_escape_string($conn, htmlentities($_POST["np"]));

        $rp = mysqli_real_escape_string($conn, htmlentities($_POST["rp"]));

        $userObj = new User($conn, "", "", "", "", "");

        $userObj->changePassword($email, $np, $rp);

    }

    else if(isset($_POST["changePword"])){

        $np = mysqli_real_escape_string($conn, htmlentities($_POST["pword"]));

        $rp = mysqli_real_escape_string($conn, htmlentities($_POST["rpword"]));

        $adminObj = new Admin($conn, "", "", "", "", "");

        $adminObj->changePword($np, $rp);

    }

    else if(isset($_POST["deleteAdmin"])){

        $userId = mysqli_real_escape_string($conn, htmlentities($_POST["userId"]));

        $adminObj = new Admin($conn, "", "", "", "", "");

        $adminObj->deleteAdmin($userId);

    }

    else if(isset($_POST["getBarcode"])){

        $phone = mysqli_real_escape_string($conn, htmlentities($_POST["phone"]));
        $campId = mysqli_real_escape_string($conn, htmlentities($_POST["campId"]));
        
        $userObj = new User($conn, "", "", "", "", "");

        $userObj->getUserQRcode($phone, $campId, isset($_POST["isBulk"]));

    }



?>