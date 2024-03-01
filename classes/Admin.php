<?php

//include 'Authenticate.php';



class Admin
{
    public $firstname;
    public $lastname;
    public $email;
    public $password;
    public $joinedOn;
    public $conn;


    function __construct($conn, $firstname, $lastname, $email, $password, $joinedOn)
    {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->password = $password;
        $this->joinedOn = $joinedOn;
        $this->conn = $conn;
    }


    function logAdminIn()
    {
        $auth = new Authenticate();
        $auth->login($this->conn, $this->email, $this->password, "admins");
    }


    function fetchDashboardData()
    {
        $returnArray = array();
        $sel = mysqli_query($this->conn, "SELECT * FROM camps WHERE status = 'active'");
        $row = mysqli_fetch_array($sel);
        $campId = mysqli_num_rows($sel) > 0 ? $row['id'] : 0;
        $regularFee = @$_SESSION['regularFee'];


        $selCamp = mysqli_query($this->conn, "SELECT * FROM camp_reg_ WHERE camp_id = '$campId'");
        $rrr = 0;
        $rrf = 0;
        $rpr = 0;
        $trr = 0;
        $tregr = 0;
        $tregp = 0;
        while ($rowCamp = mysqli_fetch_array($selCamp)) {
            if ($rowCamp["reg_type"] == "regular") {
                $rrr += (int)$regularFee;
                $rf = (int)$rowCamp["support_kc"];
                $rrf += $rf;
                $tregr += 1;
            }


            if ($rowCamp["reg_type"] == "premium") {
                $rpr += $rowCamp["support_kc"];
                $tregp += 1;
            }
        }


        $trr = $rrr + $rpr;


        $returnArray["rrr"] = $rrr;
        $returnArray["rrf"] = $rrf;
        $returnArray["rpr"] = $rpr;
        $returnArray["trr"] = $trr;
        $returnArray["tregr"] = $tregr;
        $returnArray["tregp"] = $tregp;


        echo json_encode($returnArray);
    }


    function fetchCampDetails($campId)
    {
        $returnArray = array();
        $sel = mysqli_query($this->conn, "SELECT * FROM camps WHERE id = '$campId'");
        if (mysqli_num_rows($sel) < 1) {
            echo json_encode(array());
            return;
        }

        $row = mysqli_fetch_array($sel);
        $regularFee = $row['regular_fee'];


        $selCamp = mysqli_query($this->conn, "SELECT * FROM camp_reg_ WHERE camp_id = '$campId'");
        $rrr = 0;
        $rrf = 0;
        $rpr = 0;
        $trr = 0;
        $tregr = 0;
        $tregp = 0;
        while ($rowCamp = mysqli_fetch_array($selCamp)) {
            if ($rowCamp["reg_type"] == "regular") {
                $rrr += (int)$regularFee;
                $rf = (int)$rowCamp["support_kc"];
                $rrf += $rf;
                $tregr += 1;
            }


            if ($rowCamp["reg_type"] == "premium") {
                $rpr += $rowCamp["support_kc"];
                $tregp += 1;
            }
        }


        $trr = $rrr + $rpr;


        $returnArray["rrr"] = $rrr;
        $returnArray["rrf"] = $rrf;
        $returnArray["rpr"] = $rpr;
        $returnArray["trr"] = $trr;
        $returnArray["tregr"] = $tregr;
        $returnArray["tregp"] = $tregp;
        $returnArray['regularFee'] = $regularFee;


        echo json_encode($returnArray);
    }


    function closeCamp()
    {
        $tableFields = "status = 'closed'";
        $variables = "status = 'active'";
        $table = "camps";
        $success = "Camp closed";
        $failure = "Failed";
        Query::dbUpdate($this->conn, $table, $tableFields, $variables, $success, $failure);
    }


    function registerAdmin()
    {
        $tableFields = "firstname, lastname, email, password, date_created";
        $variables = "'$this->firstname','$this->lastname','$this->email', '$this->password', '$this->joinedOn'";
        $table = "admins";
        $success = "Registration Successful";
        $failure = "Oops! Something went wrong, please try again";
        Query::dbInsert($this->conn, $table, $tableFields, $variables, $success, $failure);
    }


    function fetchAdmins()
    {
        $returnArray = array();
        $sel = mysqli_query($this->conn, "SELECT * FROM admins ORDER BY id DESC");


        while ($row = mysqli_fetch_array($sel)) {
            $holdingArray = array();
            $holdingArray["id"] = $row["id"];
            $holdingArray["firstname"] = $row["firstname"];
            $holdingArray["lastname"] = $row["lastname"];
            $holdingArray["email"] = $row["email"];
            $holdingArray["dc"] = $row["date_created"];


            array_push($returnArray, $holdingArray);
        }


        echo json_encode($returnArray);
    }


    function createCamp($campName, $campTheme, $startDate, $endDate, $rrFee, $status, $date_time)
    {
        $sel = mysqli_query($this->conn, "SELECT * FROM camps WHERE status = 'active'");
        $row = mysqli_num_rows($sel);


        if ($row > 0) {
            echo "active camp detected";
        } else {
            $tableFields = "name, theme, start, end, date_created, status, regular_fee";
            $variables = "'$campName','$campTheme','$startDate', '$endDate', '$date_time', '$status', '$rrFee'";
            $table = "camps";
            $success = "Successfully Created";
            $failure = "Oops! Something went wrong, please try again";
            Query::dbInsert($this->conn, $table, $tableFields, $variables, $success, $failure);
        }
    }


    function changePword($np, $rp)
    {
        $adminId = $_SESSION['userId'];
        $up = mysqli_query($this->conn, "UPDATE admins SET password = '$np' WHERE id = '$adminId'");
        if ($up) {
            echo 'Successful';
        } else {
            echo 'Failed';
        }
    }


    function deleteAdmin($userId)
    {
        $del = mysqli_query($this->conn, "DELETE FROM admins WHERE id = '$userId'");
        if ($del) {
            echo 'Successful';
        } else {
            echo 'Failed';
        }
    }


    function verifyQrCode($userId, $campId, $refId)
    {
        $sel = mysqli_query($this->conn, "SELECT * FROM camp_reg_ WHERE camp_id = '$campId' AND user_id = '$userId' AND ref = '$refId'");
        $num = mysqli_num_rows($sel);
        $row = mysqli_fetch_array($sel);

        if ($num > 0) {
            echo "Verified:" . $row['firstname'] . ":" . $row['lastname'] . ":" . $row['email'] . ":" . $row['phone'] . ":" . $row['gender'] . ":" . $row['member'] . ":" . $row['reg_type'];
        } else {
            echo "Failed";
        }
    }


    function verifyQrCode2($userId, $campId, $refId, $isBulk)
    {
        $returnArray = array();
        $qry = "SELECT * FROM camp_reg_ WHERE camp_id = '$campId' AND user_id = '$userId'";
        if (!$isBulk == '') {
            $qry .= " AND ref = '$refId'";
        }

        $sel = mysqli_query($this->conn, $qry);
        $num = mysqli_num_rows($sel);
        if ($num > 0) {
            while ($row = mysqli_fetch_array($sel)) {
                $holdingArray = array();
                $holdingArray["firstname"] = $row["firstname"];
                $holdingArray["lastname"] = $row["lastname"];
                $holdingArray["phone"] = $row["phone"];
                $holdingArray["email"] = $row["email"];
                $holdingArray["gender"] = $row["gender"];
                $holdingArray["member"] = $row["member"];
                $holdingArray["userId"] = $row["user_id"];
                $holdingArray["campId"] = $row["camp_id"];
                $holdingArray["regType"] = $row["reg_type"];
                array_push($returnArray, $holdingArray);

                //echo "Verified:".$row['firstname'].":".$row['lastname'].":".$row['email'].":".$row['phone'].":".$row['gender'].":".$row['member'].":".$row['reg_type'];
            }
            echo json_encode($returnArray);
        } else {
            echo "Failed";
        }
    }

    function fetchStats($campId, $district, $regType, $rName, $pNumber, $hic)
    {
        $query = "SELECT * FROM camp_reg_ WHERE camp_id = '$campId'";
        $params = array();
        $params['district'] = $district;
        $params['reg_type'] = $regType;
        $params['firstname'] = $rName;
        $params['phone'] = $pNumber;
        $params['house'] = $hic;

        foreach ($params as $key => $value) {
            if ($value != '') {
                if ($key == 'firstname') {
                    $query .= " AND (firstname='$value' OR lastname='$value')";
                } else {
                    $query .= " AND " . $key . "='$value'";
                }
            }
        }

        $returnArray = array();
        $sel = mysqli_query($this->conn, $query);

        while ($row = mysqli_fetch_array($sel)) {
            $holdingArray = array();
            $regularFee = @$_SESSION['regularFee'];

            $holdingArray["firstname"] = $row["firstname"];
            $holdingArray["lastname"] = $row["lastname"];
            $holdingArray["phone"] = $row["phone"];
            $holdingArray["ageGroup"] = $row["age_group"];
            $holdingArray["gender"] = $row["gender"];
            $holdingArray["member"] = $row["member"];
            $holdingArray["district"] = $row["district"];
            $holdingArray["house"] = $row["house"];
            $holdingArray["date"] = $row["date_created"];
            $holdingArray["amount"] = $row["support_kc"];
            $holdingArray["regType"] = $row["reg_type"];
            $holdingArray["foodboot"] = $row["foodboot"];
            $holdingArray["campId"] = $row["camp_id"];

            if ($row["reg_type"] == "regular") {
                $holdingArray["amount"] = (int)$holdingArray["amount"] + (int)$regularFee;
            }

            array_push($returnArray, $holdingArray);
        }
        echo json_encode($returnArray);
    }
}
