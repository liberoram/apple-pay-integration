<?php
$validation_url = $_GET['u'];
$Display = $_GET['Display'];

if( "https" == parse_url($validation_url, PHP_URL_SCHEME) && substr( parse_url($validation_url, PHP_URL_HOST), -10 )  == ".apple.com" ){
   $PRODUCTION_CERTIFICATE_KEY = '/your/path/to/applepay_includes/ApplePay.key.pem';
   $PRODUCTION_CERTIFICATE_PATH ='/your/path/to/applepay_includes/ApplePay.crt.pem';

   $ch = curl_init();
   $data = '{"merchantIdentifier":"'.$MerchantIdentifier.'", "initiativeContext":"'.$_SERVER["HTTP_HOST"].'", "displayName":"'.$Display.'", "initiative": "web"}';

   curl_setopt($ch, CURLOPT_URL, $validation_url);
   curl_setopt($ch, CURLOPT_SSLCERT, $PRODUCTION_CERTIFICATE_PATH);
   curl_setopt($ch, CURLOPT_SSLKEY, $PRODUCTION_CERTIFICATE_KEY);
   curl_setopt($ch, CURLOPT_SSLKEYPASSWD, "PRODUCTION_CERTIFICATE_KEY_PASS"); 
   curl_setopt($ch, CURLOPT_POST, 1);
   curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

   if(curl_exec($ch) === false)
   {
    echo '{"curlError":"' . curl_error($ch) . '"}';
}
curl_close($ch);
}
?>
