<?php
    include 'config.inc.php';


    function generateToken($amount) {

        $curl = curl_init();
        $orden = generatePurchaseNumber();
        $_SESSION['orden'] = $orden;
        $data = [
            "amount" => $amount*100,
            "currency" => "PEN",
            "orderId" => $orden,
            "customer" => [
                "email" => $_SESSION['correo']
            ]
        ];

        curl_setopt_array($curl, array(
            CURLOPT_URL => IZIPAY_URL,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTPHEADER => array(
            "Accept: */*",
            'Authorization: '.'Basic '.base64_encode(IZIPAY_CLIENT_ID.":".IZIPAY_CLIENT_SECRET),
            "Content-Type: application/json",
            ),
            CURLOPT_POSTFIELDS => json_encode($data)
        ));
        $response = curl_exec($curl);
        curl_close($curl);

        if ($response === false) {
            return null; // Maneja el error según sea necesario
        }

        $decodedResponse = json_decode($response, true);

        if (isset($decodedResponse['answer']['formToken'])) {
            return $decodedResponse['answer']['formToken'];
        } else {
            return null;
        }
    }

    function generateSesion($amount, $token) {
        $session = array(
            'amount' => $amount,
            'antifraud' => array(
                'clientIp' => $_SERVER['REMOTE_ADDR'],
                'merchantDefineData' => array(
                    'MDD15' => "Valor MDD 15",
                    'MDD20' => "Valor MDD 20",
                    'MDD33' => 'Valor MDD 30'
                ),
            ),
            'channel' => 'web',
        );
        $json = json_encode($session);
        $response = json_decode(postRequest('sss', $json, $token));
        return $response->sessionKey;
    }

    function generateAuthorization($amount, $purchaseNumber, $transactionToken, $token) {
        $data = array(
            'antifraud' => null,
            'captureType' => 'manual',
            'channel' => 'web',
            'countable' => true,
            'order' => array(
                'amount' => $amount,
                'currency' => 'PEN',
                'purchaseNumber' => $purchaseNumber,
                'tokenId' => $transactionToken
            ),
            'recurrence' => null,
            'sponsored' => null
        );
        $json = json_encode($data);
        $session = json_decode(postRequest('sss', $json, $token));
        return $session;
    }

    function postRequest($url, $postData, $token) {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTPHEADER => array(
                'Authorization: '.$token,
                'Content-Type: application/json'
            ),
            CURLOPT_POSTFIELDS => $postData
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

    function generatePurchaseNumber(){
        $purchaseNumber = time() . mt_rand(10, 99);
        return $purchaseNumber;
    }


