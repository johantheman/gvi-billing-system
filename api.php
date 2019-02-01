<?php
/**
 * Created by PhpStorm.
 * User: Johan
 * Date: 2/1/2019
 * Time: 11:48 AM
 */

class ReportingApi {

    //API Post
    private $accessToken;
    private $response;

    function __construct($Client_token,$Client_secret,$Refresh_token){
        $fields = array(
            'client_id' => $Client_token,
            'client_secret' => $Client_secret,
            'refresh_token' => $Refresh_token,
            'grant_type' => 'refresh_token'
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api1.silverpop.com/oauth/token');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($fields));
        $json_result = curl_exec($ch);
        $result = json_decode($json_result);
        $access_token = $result->access_token;
        var_dump($access_token);
        $this->accessToken = $access_token;
        curl_close($ch);

    }

    function apiPost($xml_post){
        $header = array(
            'Content-Type:text/xml;charset=UTF-8','Authorization: Bearer '.$this->accessToken
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api1.silverpop.com/XMLAPI');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_POST, count($xml_post));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_post);
        $json_result = curl_exec($ch);
        $result = json_decode($json_result);
        $this->response = $result;
        curl_close($ch);

    }


}

