<?php
require_once 'inc/config.php';
$session = $_SESSION;
$cart = [];
foreach($session as $keySession => $value){
    if(substr($keySession, 0, 5) == 'cart_'){
        $cart[$keySession] = $value;
    }
}

$price = array_column($cart,'price');
echo '<pre>';
print_r($price);
$Authority = $_GET['Authority'];
$data = array("merchant_id" => "xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx", "authority" => $Authority, "amount" => $price);
$jsonData = json_encode($data);
$ch = curl_init('https://sandbox.zarinpal.com/pg/v4/payment/verify.json');
curl_setopt($ch, CURLOPT_USERAGENT, 'ZarinPal Rest Api v4');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($jsonData)
));

$result = curl_exec($ch);
curl_close($ch);
$result = json_decode($result, true);
if ($err) {
    echo "cURL Error #:" . $err;
} else {
    $name = implode('و', array_column($cart, 'name'));
    $status =  $result['data'];
    $authority =$result['RefID'];
    $query = mysqli_query($connection, "INSERT INTO orders(name,price,authority,status) VALUES ('$name','$price','$authority','$status')");
   header('Location: http://localhost/ecommerce');

}
