<?php

include 'Authenticate.php';
include 'helpers.php';
include 'FoodBoots.php';


class User
{

    public $firstname;

    public $lastname;

    public $email;

    public $password;

    public $joinedOn;

    public $conn;

    public $foodboots;



    function __construct($conn, $firstname, $lastname, $email, $password, $joinedOn)
    {

        $this->firstname = $firstname;

        $this->lastname = $lastname;

        $this->email = $email;

        $this->password = $password;

        $this->joinedOn = $joinedOn;

        $this->conn = $conn;

        $this->foodboots = FoodBoots::getBoots($conn);
    }

    function getPayedInBulk($tx_ref, $pref)
    {
        $sel = mysqli_query($this->conn, "SELECT * FROM payedin_bulk_reg WHERE tx_ref = '$tx_ref'");
        $num = mysqli_num_rows($sel);
        if ($num > 0) {
            while ($row = mysqli_fetch_array($sel)) {
                $participantArray = json_decode($row["list"], true);
                $userId = $row['user_id'];
                $campId = $row['camp_id'];
                $date_time = date("Y-m-d h:i:s A");
                $this->bulkRegisterCamp($participantArray, $tx_ref, $userId, $campId, $date_time, $pref);
            }
            //     echo json_encode($returnArray);
        } else {
            echo json_encode($num);
        }
    }

    function getPayedInUser($tx_ref, $pref)
    {
        $returnArray = array();
        $sel = mysqli_query($this->conn, "SELECT * FROM payedin_camp_reg WHERE tx_ref = '$tx_ref'");
        $num = mysqli_num_rows($sel);
        if ($num > 0) {
            while ($row = mysqli_fetch_array($sel)) {
                $holdingArray = array();
                $holdingArray["id"] = $row["id"];
                $holdingArray["firstname"] = $row["firstname"];
                $holdingArray["lastname"] = $row["lastname"];
                $holdingArray["userId"] = $row["user_id"];
                $holdingArray["campId"] = $row["camp_id"];
                $holdingArray["tx_ref"] = $row["tx_ref"];
                array_push($returnArray, $holdingArray);
                $sql = mysqli_query($this->conn, "SELECT * FROM camp_reg_ WHERE tx_ref = '$tx_ref'");
                $query = mysqli_num_rows($sql);
                if ($query < 1) {
                    $this->registerCampAnonymous($row["firstname"],            $row["lastname"],            $row['phone'],            $row['email'],            $row['age_group'],            $row['gender'],            $row['cwk'],            $row['hmk'],            $row['member'],            $row['district'],            $row['arrival'],            $row['house'],            $row['support_kc'],            $row['date_created'],            $row['reg_type'],            $pref,            $row['user_id'],            $row['camp_id'],            $row['tx_ref']);
                }
            }
            echo json_encode($returnArray);
        } else {
            echo json_encode($num);
        }
    }


    function registerPayedInUser(
        $firstname,
        $lastname,
        $phone,
        $email,
        $ageGroup,
        $gender,
        $kidsComing,
        $kidsNumber,
        $member,
        $district,
        $arrivalDate,
        $houseAccess,
        $anyAmount,
        $date_time,
        $regType,
        $ref,
        $userId,
        $campId,
        $payment_status,
        $tx_ref
    ) {
        $tableFields = "firstname, lastname, phone, email, age_group, gender, cwk, hmk, member, district, arrival, house, support_kc, camp_id, user_id, reg_type, date_created, ref, payment_status, tx_ref";
        $variables = "'$firstname', '$lastname', '$phone', '$email', '$ageGroup', '$gender', '$kidsComing', '$kidsNumber', '$member', '$district', '$arrivalDate', '$houseAccess', '$anyAmount', '$campId', '$userId', '$regType', '$date_time', '$ref', '$payment_status', '$tx_ref'";
        $table = "payedin_camp_reg";
        $success = "Registration Successful";
        $failure = "Oops! Something went wrong, please try again";
        Query::dbInsert($this->conn, $table, $tableFields, $variables, $success, $failure);
    }



    function registerUser()
    {

        $sel = mysqli_query($this->conn, "SELECT * FROM users WHERE email = '$this->email'");

        $num = mysqli_num_rows($sel);

        if ($num > 0) {
            echo "Email already existing";
        } else {
            $tableFields = "firstname, lastname, email, password, joined_on";
            $variables = "'$this->firstname','$this->lastname','$this->email', '$this->password', '$this->joinedOn'";
            $table = "users";
            $success = "Registration Successful";
            $failure = "Oops! Something went wrong, please try again";
            Query::dbInsert($this->conn, $table, $tableFields, $variables, $success, $failure);
        }
    }



    function logUserIn()
    {

        $auth = new Authenticate();

        $auth->login($this->conn, $this->email, $this->password, "users");
    }



    function registerCamp($firstname, $lastname, $phone, $email, $ageGroup, $gender, $kidsComing, $kidsNumber, $member, $district, $arrivalDate, $houseAccess, $anyAmount, $date_time, $regType, $ref, $userId, $campId)
    {
        $foodboot = FoodBoots::getRandom($this->foodboots);

        $tableFields = "firstname, lastname, phone, email, age_group, gender, cwk, hmk, member, district, arrival, house, support_kc, camp_id, user_id, reg_type, date_created, ref, foodboot";

        $variables = "'$firstname', '$lastname', '$phone', '$email', '$ageGroup', '$gender', '$kidsComing', '$kidsNumber', '$member', '$district', '$arrivalDate', '$houseAccess', '$anyAmount', '$campId', '$userId', '$regType', '$date_time', '$ref, '$foodboot'";

        $table = "camp_reg_";

        $success = "Registration Successful";

        $failure = "Oops! Something went wrong, please try again";

        Query::dbInsert($this->conn, $table, $tableFields, $variables, $success, $failure);

        $qr_image = generateQR($campId . '_' . $userId . '_' . $ref);
        $profile = getQRProfile($firstname, $lastname, $district, strtoupper($foodboot), $_SESSION['campName'], ucfirst($regType), $qr_image);

        echo $profile;
        sendRegistrationEmail($email, $firstname, $lastname, $_SESSION['campName'], $profile, $ref);
    }

    function bulkRegisterCamp($participantArray, $tx_ref, $userId, $campId, $date_time, $pref = '')
    {
        $savedIds = [];
        $success = "Registration Successful";
        $failure = "Oops! Something went wrong, please try again";

        for ($i = 0; $i < count($participantArray); $i++) {
            $firstname = $participantArray[$i]["firstname"];
            $lastname = $participantArray[$i]["lastname"];
            $phone = $participantArray[$i]["phone"];
            $email = $participantArray[$i]["email"];
            $ageGroup = $participantArray[$i]["ageGroup"];
            $gender = $participantArray[$i]["gender"];
            $kidsComing = $participantArray[$i]["kidsComing"];
            $kidsNumber = $participantArray[$i]["kidsNumber"];
            $member = $participantArray[$i]["member"];
            $district = $participantArray[$i]["district"];
            $arrivalDate = $participantArray[$i]["arrivalDate"];
            $houseAccess = $participantArray[$i]["houseAccess"];
            $anyAmount = $participantArray[$i]["anyAmount"];
            $regType = $participantArray[$i]["regType"];

            $ref = $tx_ref;
            $foodboot = FoodBoots::getRandom($this->foodboots);
            $tableFields = "firstname, lastname, phone, email, age_group, gender, cwk, hmk, member, district, arrival, house, support_kc, camp_id, user_id, reg_type, date_created, ref, tx_ref, foodboot";
            $variables = "'$firstname', '$lastname', '$phone', '$email', '$ageGroup', '$gender', '$kidsComing', '$kidsNumber', '$member', '$district', '$arrivalDate', '$houseAccess', '$anyAmount', '$campId', '$userId', '$regType', '$date_time', '$ref', '$tx_ref', '$foodboot'";
            $table = "camp_reg_";

            if (mysqli_query($this->conn, "INSERT INTO `$table` ($tableFields) VALUES ($variables)")) {
                $last_id = $this->conn->insert_id;
                array_push($savedIds, $last_id);
            }
        }
        if (count($savedIds) > 0) {
            $regType = count($participantArray) . ' Campite(s)';
            $qr_image = generateQR($campId . '_' . $userId . '_' . $ref . '_bulk');
            $profile = getQRProfile($_SESSION['firstname'], $_SESSION['lastname'], $district, 'GROUP REG', $_SESSION['campName'], $regType, $qr_image);
            echo $profile;
            sendRegistrationEmail($email, $firstname, $lastname, $_SESSION['campName'], $profile, $ref);
        } else {
            echo $failure;
        }
    }

    function pbulkRegisterCamp($list, $tx_ref, $userId, $campId, $date_time)
    {
        $tableFields = "list, tx_ref, user_id, camp_id, date";
        $variables = "'$list', '$tx_ref', '$userId', '$campId', '$date_time'";
        $table = "payedin_bulk_reg";
        $success = "Registration Successful";
        $failure = "Oops! Something went wrong, please try again";
        Query::pbulkdbInsert($this->conn, $table, $tableFields, $variables, $success, $failure);
    }



    function registerCampAnonymous(
        $firstname,
        $lastname,
        $phone,
        $email,
        $ageGroup,
        $gender,
        $kidsComing,
        $kidsNumber,
        $member,
        $district,
        $arrivalDate,
        $houseAccess,
        $anyAmount,
        $date_time,
        $regType,
        $ref,
        $userId,
        $campId,
        $tx_ref = null
    ) {
        $foodboot = FoodBoots::getRandom($this->foodboots);
        $tableFields = "firstname, lastname, phone, email, age_group, gender, cwk, hmk, member, district, arrival, house, support_kc, camp_id, user_id, reg_type, date_created, ref, tx_ref, foodboot";
        $variables = "'$firstname', '$lastname', '$phone', '$email', '$ageGroup', '$gender', '$kidsComing', '$kidsNumber', '$member', '$district', '$arrivalDate', '$houseAccess', '$anyAmount', '$campId', '$userId', '$regType', '$date_time', '$ref', '$tx_ref', '$foodboot'";
        $table = "camp_reg_";
        $success = "Registration Successful";
        $failure = "Oops! Something went wrong, please try again";
        Query::payedindbInsert($this->conn, $table, $tableFields, $variables, $success, $failure);

        $qr_image = generateQR($campId . '_' . $userId . '_' . $ref);
        $auxData = $this->fetchAuxData();
        $campName = @$auxData['name'];

        $profile = getQRProfile($firstname, $lastname, $district, strtoupper($foodboot), $campName, ucfirst($regType), $qr_image);

        echo $profile;
        sendRegistrationEmail($email, $firstname, $lastname, $campName, $profile, $ref);
    }



    function fetchCamps()
    {

        $returnArray = array();

        $sel = mysqli_query($this->conn, "SELECT * FROM camps ORDER BY id DESC");

        while ($row = mysqli_fetch_array($sel)) {
            $holdingArray = array();
            $holdingArray["id"] = $row["id"];
            $holdingArray["name"] = $row["name"];
            $holdingArray["theme"] = $row["theme"];
            $holdingArray["start"] = $row["start"];
            $holdingArray["end"] = $row["end"];
            $holdingArray["created"] = $row["date_created"];
            $holdingArray["status"] = $row["status"];


            array_push($returnArray, $holdingArray);
        }



        echo json_encode($returnArray);
    }



    function fetchAuxData()
    {

        $returnArray = array();

        $sel = mysqli_query($this->conn, "SELECT * FROM camps WHERE status='active'");

        while ($row = mysqli_fetch_array($sel)) {
            $returnArray["id"] = $row["id"];
            $returnArray["name"] = $row["name"];
            $returnArray["fee"] = $row["regular_fee"];
            // $holdingArray["theme"] = $row["theme"];
            // $holdingArray["start"] = $row["start"];
            // $holdingArray["end"] = $row["end"];
            // $holdingArray["created"] = $row["date_created"];
            // $holdingArray["status"] = $row["status"];

        }



        return $returnArray;
    }



    function fetchUsers()
    {

        $returnArray = array();

        $sel = mysqli_query($this->conn, "SELECT * FROM users ORDER BY id DESC");



        while ($row = mysqli_fetch_array($sel)) {
            $holdingArray = array();
            $holdingArray["id"] = $row["id"];
            $holdingArray["firstname"] = $row["firstname"];
            $holdingArray["lastname"] = $row["lastname"];
            $holdingArray["email"] = $row["email"];
            $holdingArray["dc"] = $row["joined_on"];


            array_push($returnArray, $holdingArray);
        }



        echo json_encode($returnArray);
    }



    function fetchTHistory()
    {

        $returnArray = array();

        $userId = $_SESSION["userId"];



        $sel = mysqli_query($this->conn, "SELECT * FROM camp_reg_ WHERE user_id = '$userId' ORDER BY id DESC");



        while ($row = mysqli_fetch_array($sel)) {
            $holdingArray = array();


            $campId = $row["camp_id"];
            $selCamp = mysqli_query($this->conn, "SELECT * FROM camps WHERE id = '$campId'");
            $rowCamp = @mysqli_fetch_array($selCamp);
            $campName = @$rowCamp["name"];


            $holdingArray["regType"] = $row["reg_type"];
            $holdingArray["firstname"] = $row["firstname"];
            $holdingArray["lastname"] = $row["lastname"];
            $holdingArray["paymentRef"] = $row["ref"];
            $holdingArray["date"] = $row["date_created"];
            $holdingArray["campName"] = $campName;
            if ($row["support_kc"] == "") {
                $holdingArray["amount"] = $_SESSION['regularFee'];
            } else {
                if ($row["reg_type"] == "regular") {
                    $holdingArray["amount"] = $row["support_kc"] + $_SESSION['regularFee'];
                } else {
                    $holdingArray["amount"] = $row["support_kc"];
                }
            }


            array_push($returnArray, $holdingArray);
        }



        echo json_encode($returnArray);
    }



    function fetchHistory($campId)
    {

        $returnArray = array();

        $userId = $_SESSION["userId"];



        $sel = mysqli_query($this->conn, "SELECT * FROM camp_reg_ WHERE user_id = '$userId' AND camp_id = '$campId' ORDER BY id DESC");



        while ($row = mysqli_fetch_array($sel)) {
            $holdingArray = array();


            $campId = $row["camp_id"];
            $selCamp = mysqli_query($this->conn, "SELECT * FROM camps WHERE id = '$campId'");
            $rowCamp = mysqli_fetch_array($selCamp);
            $campName = $rowCamp["name"];


            $holdingArray["regType"] = $row["reg_type"];
            $holdingArray["firstname"] = $row["firstname"];
            $holdingArray["lastname"] = $row["lastname"];
            $holdingArray["gender"] = $row["gender"];
            $holdingArray["hmk"] = $row["hmk"];
            $holdingArray["phone"] = $row["phone"];
            $holdingArray["ageGroup"] = $row["age_group"];
            $holdingArray["district"] = $row["district"];
            $holdingArray["arrival"] = $row["arrival"];
            $holdingArray["paymentRef"] = $row["ref"];
            $holdingArray["date"] = $row["date_created"];
            $holdingArray["campName"] = $campName;
            $holdingArray["amount"] = $row["support_kc"];


            array_push($returnArray, $holdingArray);
        }



        echo json_encode($returnArray);
    }



    function fetchHistoryAdmin($campId, $userId)
    {

        $returnArray = array();



        $sel = mysqli_query($this->conn, "SELECT * FROM camp_reg_ WHERE user_id = '$userId' AND camp_id = '$campId' ORDER BY id DESC");



        while ($row = mysqli_fetch_array($sel)) {
            $holdingArray = array();


            $campId = $row["camp_id"];
            $selCamp = mysqli_query($this->conn, "SELECT * FROM camps WHERE id = '$campId'");
            $rowCamp = mysqli_fetch_array($selCamp);
            $campName = $rowCamp["name"];
            $regularFee = @$_SESSION['regularFee'];


            $holdingArray["regType"] = $row["reg_type"];
            $holdingArray["firstname"] = $row["firstname"];
            $holdingArray["lastname"] = $row["lastname"];
            $holdingArray["gender"] = $row["gender"];
            $holdingArray["hmk"] = $row["hmk"];
            $holdingArray["ageGroup"] = $row["age_group"];
            $holdingArray["district"] = $row["district"];
            $holdingArray["arrival"] = $row["arrival"];
            $holdingArray["paymentRef"] = $row["ref"];
            $holdingArray["date"] = $row["date_created"];
            $holdingArray["campName"] = $campName;
            $holdingArray["amount"] = $row["support_kc"];
            $holdingArray["ref"] = $row["ref"];
            $holdingArray["phone"] = $row["phone"];


            if ($row["reg_type"] == "regular") {
                $holdingArray["amount"] = (int)$holdingArray["amount"] + (int)$regularFee;
            }


            array_push($returnArray, $holdingArray);
        }



        echo json_encode($returnArray);
    }



    function logout()
    {

        session_destroy();

        echo "Logout Successfully";
    }



    function verifyEmail($email)
    {

        $sel = mysqli_query($this->conn, "SELECT * FROM users WHERE email = '$email'");

        $num = mysqli_num_rows($sel);

        if ($num > 0) {
            $code = random_int(100000, 999999);
            $up = mysqli_query($this->conn, "UPDATE users SET code = '$code' WHERE email = '$email'");
            if ($up) {
                sendEmail($email, '', 'Forgot Password Code', 'This is your forgot password code <b>' . $code . '</b> <br>Kindly go back to the page to continue');
                echo "Message sent";
            } else {
                echo "Message could not be sent";
            }
        } else {
            echo '404';
        }
    }



    function verifyCode($email, $code)
    {

        $sel = mysqli_query($this->conn, "SELECT * FROM users WHERE email = '$email' AND code = '$code'");

        $num = mysqli_num_rows($sel);

        if ($num > 0) {
            echo 'Valid';
        } else {
            echo 'Invalid';
        }
    }



    function changePassword($email, $np, $rp)
    {

        $up = mysqli_query($this->conn, "UPDATE users SET password = '$np' WHERE email = '$email'");

        if ($up) {
            echo 'Successful';
        } else {
            echo 'Failed';
        }
    }


    function getUserQRcode($phone, $campId, $isBulk = false)
    {
        Authenticate::getActiveCamp($this->conn);

        $qry = "SELECT * FROM camp_reg_ WHERE phone = '$phone' AND camp_id = '$campId' ORDER BY id DESC";

        $sel = mysqli_query($this->conn, $qry);
        $num = mysqli_num_rows($sel);
        $result = array();

        if ($num > 0) {
            while ($row = mysqli_fetch_array($sel)) {
                $tmp = array();

                $qrcode = $campId . '_' . $row['user_id'] . '_' . $row['ref'];
                if ($isBulk) {
                    $qrcode .= '_bulk';
                }
                $qr_image = generateQR($qrcode);
                $foodboot = $isBulk ? 'GROUP REG' : strtoupper($row['foodboot']);
                $reg_type = $isBulk ? $num . ' Campite(s)': ucfirst($row['reg_type']);

                $tmp['qrcode'] = getQRProfile($row['firstname'], $row['lastname'], $row['district'], $foodboot, $_SESSION['campName'], $reg_type, $qr_image);
                $tmp['userId'] = $row['user_id'];
                $tmp['firstname'] = $row['firstname'];
                $tmp['lastname'] = $row['lastname'];
                $tmp['phone'] = $row['phone'];
                $tmp['date_created'] = $row['date_created'];
                $tmp['email'] = $row['email'];
                array_push($result, $tmp);
            }
        }

        echo json_encode($result);
    }
}
