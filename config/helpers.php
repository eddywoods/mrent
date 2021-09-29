<?php
function mrentSMS($msg, $phone)
{

    $post = array(
      "apiKey" => config("services.southwell.key"),
      "shortCode" => "M-RENT",
      "message" => $msg,
      "recipient" =>  $phone,
      "callbackURL" => "",
      "enqueue" => 0
    );

    $url = "https://api.vaspro.co.ke/v3/BulkSMS/api/create";
  $response = sendPostData($url, $post);

}

  function sendPostData($url, $data) {
  $httpRequest = curl_init($url);
  curl_setopt($httpRequest, CURLOPT_NOBODY, true);
  curl_setopt($httpRequest, CURLOPT_POST, true);
  curl_setopt($httpRequest, CURLOPT_POSTFIELDS, json_encode($data));
  curl_setopt($httpRequest, CURLOPT_TIMEOUT, 30); //timeout after 30 seconds
  curl_setopt($httpRequest, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($httpRequest, CURLOPT_HTTPHEADER, array('Content-Type: '
      . 'application/json', 'Content-Length: ' . strlen(json_encode($data))));
   curl_setopt($httpRequest, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($httpRequest, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($httpRequest, CURLOPT_HEADER, false);
  $response = curl_exec($httpRequest);
  $status = curl_getinfo($httpRequest, CURLINFO_HTTP_CODE);

  curl_close($httpRequest);
  return array("statusCode" => $status, "response" => $response);
}

