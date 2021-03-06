<?php

$arrOptions = [
    'strName' => 'anna',
    'strEmail' => 'anna@gmail.com',
    'strPassword' => 'annaqwerty',
    'token' => 'rIGU7NLzDUCzXcUHqhZctGVwP2d9Jc0hwtW2BWDT'
];

$arrDetails = [
    'strName' => "Product 8",
    'strDetail' => "Detail from test again 8"
];


$arrResult = GetToken($arrOptions);
if (!$arrResult['strError']) {
    if (!empty($arrResult['strToken'])) {
        $arrDetails['strToken'] = $arrResult['strToken'];
        AddItem($arrDetails);
    } else {
        echo "Token is expired or not correct!";
    }
}else {
    print_r($arrResult['strError']);
}


function GetToken($arrOptions)
{
    $arrResult = array();
    $strError = false;
    $strResult = "";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://larapassport.local/oauth/token");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("X-Requested-With: XMLHttpRequest"));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

    $postData = array(
        'username' => $arrOptions['strEmail'],
        'password' => $arrOptions['strPassword'],
        'client_id' => '2',
        'client_secret' => $arrOptions['token'],
        'grant_type' => 'password'
    );

    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
    $arrCurlResult = json_decode(curl_exec($ch));
    if (isset($arrCurlResult->error) && $arrCurlResult->error) {
        $strError = $arrCurlResult->error;
    } else {
        $strResult = $arrCurlResult->access_token;
    }

    $arrResult['strError'] = $strError;
    $arrResult['strToken'] = $strResult;

    return $arrResult;
}


function AddItem($arrDetails)
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "http://larapassport.local/api/v1/products",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"name\"\r\n\r\n" . $arrDetails['strName'] . "\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"detail\"\r\n\r\n" . $arrDetails['strDetail'] . "\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
        CURLOPT_HTTPHEADER => array(
            "Accept: application/json",
            "Authorization: Bearer {$arrDetails['strToken']}",
            "Cache-Control: no-cache",
            "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW"
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
}
