<?php

include '../DB/conn_db.php';
require_once 'common.php';

//base url
//$base_url = 'https://dev-payedin-api-vowex3bi3a-ez.a.run.app/payments/verify'; //development
$base_url = 'https://staging-payedin-api-vowex3bi3a-ez.a.run.app/payments/verify'; //staging
//$base_url = 'https://payedin-api-vowex3bi3a-ez.a.run.app/payments/verify'; //production

// $webhook = new Webhook($conn);
// $webhook->validateBulkPayment();
// echo "I entered here";
$sel = mysqli_query($conn, "SELECT * FROM payedin_bulk_reg WHERE is_processed = 0");
$num = mysqli_num_rows($sel);
$counter = 0;
//records exist
if($num > 0) {
    while($row = mysqli_fetch_array($sel)) {
        //connect to payedin to get record
        $request_data = json_encode(array("reference" => $row['tx_ref']));
        $response = perform_http_request('POST', $base_url, $request_data);
        // echo $response['data']['status'];
        // return;
        //check if there is an error message and display message
        if(!$response['success']) {
            echo "An error occurred with message: {$response['message']} - {$row['tx_ref']} <br />";
//            return;
        } else {
            //check if the transaction is successful
            if($response['data']['status'] == 1) {
                //check if it exist in the data
                $external_reference = $response['data']['external_reference'];
                $reference = $response['data']['reference'];
                //check if exist in the bulk database; if yes, get record and mark as processed
                $query = mysqli_query($conn, "SELECT * FROM payedin_bulk_reg WHERE tx_ref = '$external_reference'");
                $count = mysqli_num_rows($query);
                //check if a record exist
                echo "I executed this query <br />";
                if($count > 0) {
                    $res = mysqli_fetch_assoc($query);
                    $userId = $res['user_id'];
                    $campId = $res['camp_id'];
                    $participantArray = json_decode($res['list'], true);
                    $date_time = date("Y-m-d h:i:s A");

                    $sql = mysqli_query($conn, "SELECT * FROM camp_reg_ WHERE tx_ref = '$external_reference'");
                    $result = mysqli_num_rows($sql);
                    if($result < 1) {
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
                            $date_time = $date_time;
                            $userId = $userId;
                            $tx_ref = $external_reference;
                            $ref = $reference;
                            $tableFields = "firstname, lastname, phone, email, age_group, gender, cwk, hmk, member, district, arrival, house, support_kc, camp_id, user_id, reg_type, date_created, ref, tx_ref";
                            $variables = "'$firstname', '$lastname', '$phone', '$email', '$ageGroup', '$gender', '$kidsComing', '$kidsNumber', '$member', '$district', '$arrivalDate', '$houseAccess', '$anyAmount', '$campId', '$userId', '$regType', '$date_time', '$ref', '$tx_ref'";
                            $table = "camp_reg_";
                            mysqli_query($conn, "INSERT INTO `$table` ($tableFields) VALUES ($variables)");
                        }
                    }
                    //mark record as processed
                    mysqli_query($conn, "UPDATE payedin_bulk_reg SET is_processed = 1 WHERE tx_ref = '$external_reference'");
                    echo "Successfully executed bulk {$external_reference} at time: ".date('Y-m-d H"i:s')."<br />";
                }
            }
        }
    }
} else {
    echo " Nothing to process";
}

mysqli_close($conn);