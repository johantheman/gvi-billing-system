<?php
/**
 * Created by PhpStorm.
 * User: Johan
 * Date: 2/1/2019
 * Time: 11:50 AM
 */

//include the api and tokens
require 'api.php';
include 'credentials.php';

//Setting up the api with the correct parameters
$ins = new ReportingApi($cid, $cs, $rt);
$start = date("m/d/Y",strtotime("-1 day"));
$end = date("m/d/Y");
$xml = "<Envelope><Body>
<GetSentMailingsForUser>
<DATE_START>$start 00:00:01</DATE_START>
<DATE_END>$end 00:00:01</DATE_END>
<!-- optional element <MAILING_COUNT_ONLY/>-->
</GetSentMailingsForUser>
</Body></Envelope>";

//Obtaining the response from the api
$ins->apiPost($xml);
$xml = $ins->response;
$mailing_array = explode("<Mailing>", $xml);
//var_dump($mailing_array);

//I can either create a fuction to add all the mailing to the database not sure yet

function getTextBetweenTags($string, $tagname)
{
    $pattern = "/<$tagname>(.*?)<\/$tagname>/";
    preg_match($pattern, $string, $matches);
    $var = str_replace('<![CDATA[', '', $matches[1]);
    $var = str_replace(']]','',$var);
    $var = str_replace('>','',$var);
    return $var;
}

//Now that i have the text between the tags I can insert loop and insert it