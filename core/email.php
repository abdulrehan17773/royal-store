<?php
// email section start

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require 'PHPMailer/PHPMailer/src/Exception.php'; // your PHP mailer code path
require 'PHPMailer/PHPMailer/src/PHPMailer.php'; // your PHP mailer code path
require 'PHPMailer/PHPMailer/src/SMTP.php'; // your PHP mailer code path

$mail = new PHPMailer();

// Settings
$mail->IsSMTP();
$mail->CharSet = 'UTF-8';

$mail->Host       = "pos.example.com";                 // SMTP server: here use: mail.rangehinaa.com
$mail->SMTPDebug  = 2;                                    // enables SMTP debug information (for testing)
$mail->SMTPAuth   = true;                                // enable SMTP authentication
$mail->Port       = 25;                                 // set the SMTP port for the your email server
$mail->Username   = "mail@TheRoyal.com";             // e.g. test@rangehinaa.com
$mail->Password   = "";                   // password for above email id as created in the cPanel.
$mail->setfrom("mail@TheRoyal.com", "The Royal");

$mail->isHTML(true);

function makeMailBody($subject,$body,$thanksMessage ) {
    

    $mailbody   ="
    <!DOCTYPE html>
<html lang='en' xmlns='http://www.w3.org/1999/xhtml' xmlns:o='urn:schemas-microsoft-com:office:office'>
<head>
  <meta charset='UTF-8'>
  <meta name='viewport' content='width=device-width,initial-scale=1'>
  <meta name='x-apple-disable-message-reformatting'>
  <title></title>
  <!--[if mso]>
  <noscript>
    <xml>
      <o:OfficeDocumentSettings>
        <o:PixelsPerInch>96</o:PixelsPerInch>
      </o:OfficeDocumentSettings>
    </xml>
  </noscript>
  <![endif]-->
  <style>
    table, td, div, h1, p {font-family: Arial, sans-serif;}
  </style>
</head>
<body style='margin:0;padding:0;'>
  <table role='presentation' style='width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#ffffff;'>
    <tr>
      <td align='center' style='padding:0;'>
        <table role='presentation' style='width:602px;border-collapse:collapse;border:1px solid #cccccc;border-spacing:0;text-align:left;'>
          <tr>
            <td align='center' style='padding:40px 0 30px 0;'>
              <img src='https://rangehinaa.com/images/logo.png' alt='' width='300' style='height:auto;display:block;' />
			  <h1 style='font-size:24px;margin:0 0 20px 0;font-family: Pacifico;'>Rang E Hina</h1>
            </td>
          </tr>
          <tr>
            <td style='padding:36px 30px 42px 30px;'>
              <table role='presentation' style='width:100%;border-collapse:collapse;border:0;border-spacing:0;'>
                <tr>
                  <td style='padding:0 0 36px 0;color:#153643;'>
                    <h1 style='font-size:24px;margin:0 0 20px 0;font-family:Arial,sans-serif;'>$subject</h1>
                    <p style='margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;'>$body</p>
                    <p style='margin:0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;'>$thanksMessage</p>
                  </td>
                </tr>
                <tr>
                  <td style='padding:0;'>
                    <table role='presentation' style='width:100%;border-collapse:collapse;border:0;border-spacing:0;'>
                      <tr>
                        <td style='width:260px;padding:0;vertical-align:top;color:#153643;'>
                          <p style='margin:0 0 25px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;'></p>
						  <h1>Information</h1>
                          <p style='margin:0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;'><a href='https://rangehinaa.com/contact.php' style='color:black;text-decoration:underline;'>Contact Us</a></p>
                          <p style='margin:0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;'><a href='https://rangehinaa.com/privacy_policy.php'style='color:black;text-decoration:underline;'>Privacy Policy</a></p>
                          <p style='margin:0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;'><a href='https://rangehinaa.com/terms.php' style='color:black;text-decoration:underline;'>Term & onditions</a></p>
                        </td>
                        <td style='width:20px;padding:0;font-size:0;line-height:0;'>&nbsp;</td>
                        <td style='width:260px;padding:0;vertical-align:top;color:#153643;'>
                          <p style='margin:0 0 25px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;'></p>
						  <h1>Social</h1>
                          <p style='margin:0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;'><a href='https://www.facebook.com/rangehina.hinazafar' style='color:black;text-decoration:underline;'>Facebook</a></p>
                          <p style='margin:0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;'><a href='https://www.youtube.com/@rangehina7334' style='color:black;text-decoration:underline;'>Youtube</a></p>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
          <tr>
            <td style='padding:30px;background:grey;'>
              <table role='presentation' style='width:100%;border-collapse:collapse;border:0;border-spacing:0;font-size:9px;font-family:Arial,sans-serif;'>
                <tr>
                  <td style='padding:0;width:50%;' align='left'>
                    <p style='margin:0;font-size:14px;line-height:16px;font-family:Arial,sans-serif;color:#ffffff;'>
                      Designed & developed by<br/>Abdul Rehan
                    </p>
                  </td>
                  
                </tr>
              </table>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
</html>
    ";
    
    
    return $mailbody;
    }

function sendText($subject, $username, $useremail, $title, $message) 
{
    global $mail;
    $body = makeMailBody($title, $message,"Thank your For Choosing The Royal Store");
    try {
        $mail->Subject = $subject;
        $mail->addAddress($useremail, $username);
        $mail->Body = $body;
        $mail->AltBody = "hello";
        $mail->send();
    } catch (Exception $e) {

    }
}