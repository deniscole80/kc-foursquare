<?php


require_once("PHPMailer-master/src/PHPMailer.php");
require_once("PHPMailer-master/src/SMTP.php");
require_once("PHPMailer-master/src/Exception.php");
require_once("qrcode.php");


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;



function sendEmail($to, $name, $subject, $body, $attachment = [], $embedImage = false){

  $mail = new PHPMailer(true);

  try {

      // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
      $mail->isSMTP();                                            //Send using SMTP
      $mail->SMTPAuth   = true;                                   //Enable SMTP authentication

      $mail->Host       = $_SESSION['config']['smtp_host'];                     //Set the SMTP server to send through
      $mail->Username   = $_SESSION['config']['smtp_username'];                     //SMTP username
      $mail->Password   = $_SESSION['config']['smtp_pass'];                              //SMTP password

      $mail->Port       = 587;
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
      $mail->setFrom('no-reply@foursquareyouth.org.ng', 'Foursquare Youth Camp');
      $mail->addReplyTo('kc@foursquareyouth.org.ng', 'Kingdom Covenant');
      
      //Recipients
      $mail->addAddress($to, $name);               //Name is optional
      //$mail->addCC('cc@example.com');
      //$mail->addBCC('bcc@example.com');

      //Attachments
      if (count($attachment) > 0) {
          $mail->addAttachment($attachment[0], $attachment[1]);    //Optional name
      }
      //Embedded Image
      if (!empty($embedImage)) {
        // $img = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $embedImage));
        $mail->addEmbeddedImage($embedImage, "embed", "embed", "base64", "image/png");
      }
      

      //Content
      $mail->isHTML(true);                                  //Set email format to HTML
      $mail->Subject = $subject;
      $mail->Body    = $body;
      // $mail->AltBody = $altBody;


      $mail->send();

      // echo 'Message sent';

  } catch (Exception $e) {

      echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";

  }

}

function generateQR($code = '') {
  $qr = QRCode::getMinimumQRCode($code, 1);
  $im = $qr->createImage(14, 4);

  $file_path = "../qr-temp/".$code.".png";


  ob_start();
  imagepng($im);
  $image = ob_get_contents();
  ob_end_clean();

  file_put_contents($file_path, $image);

  return $code.".png";
}

function getQRProfile($firstname, $lastname, $district, $foodboot, $campName, $regType, $qr_image) {
  return '<table style="background: #fafafa;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.4);max-width: 270px;margin: auto;text-align: center;">
                  <tr>
                      <td>
                          <img src="'.$_SESSION['config']['upload_url'].$qr_image.'" style="width:100%">
                          <br>
                          <h5 style="color: black;margin-top:0.5em;">'. $firstname.' '. $lastname .'</h5>
                          <p style="color: grey;font-size: 16px;">'. $district .'</p>
                          <p style="color: black;font-size: 14px;">'.$campName. ' - '. $regType .'</p>
                          <a style="margin:0;border: none;outline: 0;display: inline-block;width: 270px;
                            padding: 8px;color: white;background-color: #000;text-align: center;text-decoration: none;
                            cursor: pointer;width: 100%;font-size: 18px;" href="'.$_SESSION['config']['upload_url'].$qr_image.'">
                            '.$foodboot.'
                          </a>
                      </td>
                  </tr>
              </table>';
}

function sendRegistrationEmail($email, $firstname, $lastname, $campName, $profile, $ref) {
  $emailbody = '<div>
            <p>Hello '.$firstname.'</p>
            <p>Thanks for registering for '.$campName.'</p>
            <p>Below is your QR code kindly bring this along for checkin at Ajebo Camp gate.</p><br>
          </div>
          '.$profile;
  
  sendEmail($email, $firstname.' '.$lastname, $campName.' Registration Success - '.$ref, $emailbody);
}

?>