<?php 
session_start();
    $email=$_POST['email'];
   
$mobile=$_POST['mobile'];
$otp=rand(10000,99999);
$_SESSION['OTP']=$otp;
$fields = array(
"sender_id" => "FSTSMS",
"message" => "This is Test message".$otp,
"language" => "english",
"route" => "p",
"numbers" => "$mobile",
);

$curl = curl_init();

curl_setopt_array($curl, array(
CURLOPT_URL => "https://www.fast2sms.com/dev/bulk",
CURLOPT_RETURNTRANSFER => true,
CURLOPT_ENCODING => "",
CURLOPT_MAXREDIRS => 10,
CURLOPT_TIMEOUT => 30,
CURLOPT_SSL_VERIFYHOST => 0,
CURLOPT_SSL_VERIFYPEER => 0,
CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
CURLOPT_CUSTOMREQUEST => "POST",
CURLOPT_POSTFIELDS => json_encode($fields),
CURLOPT_HTTPHEADER => array(
"authorization: Balx24HfnPNUquwApXebVWdrioszQvL07IYE6ygC1KSt3MZRjTFBlNskLztjT4Yi1MXexAH5KSRcyqvw",
"accept: */*",
"cache-control: no-cache",
"content-type: application/json"
),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
echo "cURL Error #:" . $err;
} else {
echo $response;
}
$data=md5($email);
header('Location:userverification.php?dynamic='.$data);
?>