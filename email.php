<?php
if(isset($_POST['SendMail']))
{
    $email=$_POST['email'];
 

}
/**
* Php version 7.2.10
*
* @category Components
* @package Packagename
* @author Sumit kumar Pandey <pandeysumit399@gmail.com>
* @license http://www.php.net/license/3_01.txt PHP License 3.01
* @link http://localhost/training/php%20mysql%20task1/register/signup.php
*/
require "vendor/autoload.php";

$robo = 'achalsaxena31@gmail.com';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


$developmentMode = true;
$mailer = new PHPMailer($developmentMode);

try {
$mailer->SMTPDebug = 2;
$mailer->isSMTP();

if ($developmentMode) {
$mailer->SMTPOptions = [
'ssl' => [
'verify_peer' => false,
'verify_peer_name' => false,
'allow_self_signed' => true
]
];
}

$mailer->Host = 'ssl://smtp.gmail.com';
$mailer->SMTPAuth = true;
$mailer->Username = 'achalsaxena31@gmail.com';
$mailer->Password = 'ASUSROG@3';
$mailer->SMTPSecure = 'ssl';
$mailer->Port = 465;

$mailer->setfrom('achalsaxena31@gmail.com', 'Name of sender');
$mailer->addAddress($email, 'Name of recipient');

$mailer->isHTML(true);
$mailer->Subject = 'PHPMailer Test';
$mailer->Body = 'This is a <b>SAMPLE<b> email sent through <b>PHPMailer<b>';

$mailer->send();
$mailer->ClearAllRecipients();
echo "MAIL HAS BEEN SENT SUCCESSFULLY";
} catch (Exception $e) {
echo "EMAIL SENDING FAILED. INFO: " . $mailer->ErrorInfo;
}