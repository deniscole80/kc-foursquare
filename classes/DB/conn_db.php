<?php
    $dbhost = 'localhost';

    // Test
    // $username = 'root';
    // $pass = '';
    // $CONFIG['base_url'] = 'https://b3b6-188-30-30-21.ngrok-free.app/kycregistration/';

    // Live
    $username = 'foursquare';
    $pass = 'password';
    $CONFIG['base_url'] = 'https://kc.foursquareyouth.org.ng/';

    $CONFIG['smtp_host'] = 'foursquareyouth.org.ng';
    $CONFIG['smtp_username'] = 'no-reply@foursquareyouth.org.ng';
    $CONFIG['smtp_pass'] = 'NOREPLY123!@#';
    $CONFIG['upload_url'] = $CONFIG['base_url'].'qr-temp/';


    $db = 'foursq19_foursquare';
    $conn = mysqli_connect($dbhost, $username, $pass, $db); 
    if(!$conn ){ 
        die('Could not connect'); 
    }
    //echo 'Connected successfully'; 
    //@mysqli_select_db( 'prohms' ); 
    //mysqli_close($conn);
    $_SESSION['config'] = $CONFIG;
?>