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
$sel = mysqli_query($conn, "SELECT * FROM payedin_camp_reg WHERE is_processed = 0");
$num = mysqli_num_rows($sel);
$counter = 0;
//check if there are payments to process
if ($num > 0) {
    while($row = mysqli_fetch_array($sel)) {
        //connect to PayedIn to get record
        $request_data = json_encode(array("reference" => $row['tx_ref']));
        $response = perform_http_request('POST', $base_url, $request_data);
        if(!$response['success']) {
            echo "An error occurred with message: {$response['message']} - {$row['tx_ref']} <br />";
//            return;
        } else {
            //check if the transaction is successful
            if($response['data']['status'] == 1) {
                $external_reference = $response['data']['external_reference'];
                $reference = $response['data']['reference'];
                //check if exist in the bulk database; if yes, get record and mark as processed
                $query = mysqli_query($conn, "SELECT * FROM payedin_camp_reg WHERE tx_ref = '$external_reference'");
                $count = mysqli_num_rows($query);
                //check if a record exist
                if($count > 0) {
                    $row = mysqli_fetch_assoc($query);
                    $firstname = $row['firstname'];
                    $lastname = $row["lastname"];
                    $phone = $row["phone"];
                    $email = $row["email"];
                    $ageGroup = $row["age_group"];
                    $gender = $row["gender"];
                    $kidsComing = $row["cwk"];
                    $kidsNumber = $row["hmk"];
                    $member = $row["member"];
                    $district = $row["district"];
                    $arrivalDate = $row["arrival"];
                    $houseAccess = $row["house"];
                    $anyAmount = $row["support_kc"];
                    $campId = $row["camp_id"];
                    $userId = $row["user_id"];
                    $regType = $row["reg_type"];
                    $date_time = $row["date_created"];
                    $ref = $reference;
                    $tx_ref = $external_reference;
                    $tableFields = "firstname, lastname, phone, email, age_group, gender, cwk, hmk, member, district, arrival, house, support_kc, camp_id, user_id, reg_type, date_created, ref, tx_ref";
                    $variables = "'$firstname', '$lastname', '$phone', '$email', '$ageGroup', '$gender', '$kidsComing', '$kidsNumber', '$member', '$district', '$arrivalDate', '$houseAccess', '$anyAmount', '$campId', '$userId', '$regType', '$date_time', '$ref', '$tx_ref'";
                    $table = "camp_reg_";
                    $sql = mysqli_query($conn, "SELECT * FROM camp_reg_ WHERE tx_ref = '$tx_ref'");
                    $count_res = mysqli_num_rows($sql);
                    if($count_res < 1) {
                        mysqli_query($conn, "INSERT INTO `$table` ($tableFields) VALUES ($variables)");
                    }
                    mysqli_query($conn, "UPDATE payedin_camp_reg SET is_processed = 1 WHERE tx_ref = '$external_reference'");

                    echo "Successfully executed single {$external_reference} at time: ".date('Y-m-d H"i:s')."<br />";
                }
            }
        }
    }
}  else {
    //TODO : Log messages
    error_log('There is nothing to process at the moment'.date('Y-m-d H:i:s'), 3, 'error.log');
}

mysqli_close($conn);