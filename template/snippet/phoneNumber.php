<?php

function getRealIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

$slovak = "(+421) 905 400 770";
$austria = "(+43) 699 199 62050";
$phone = $slovak;

$ip = getRealIpAddr();

if (strpos($ip, ", ") !== false) {
    $ip = substr($ip, 0, strpos($ip, ", "));
}

$countryCode = file_get_contents("https://ipapi.co/" . $ip . "/country/");

switch ($countryCode) {
    case "AT":
        $phone = $austria;
        break;
    case "DE":
        $phone = $austria;
        break;
    default:
        $phone = $slovak;
        break;
}

echo $phone;

?>