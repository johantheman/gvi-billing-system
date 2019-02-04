<?php
/**
 * Created by PhpStorm.
 * User: Johan
 * Date: 2/1/2019
 * Time: 11:50 AM
 */

//include execute componants
require 'api.php';
include 'credentials.php';
include 'functions.php';

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

//I can either create a function to add all the mailing to the database not sure yet
// function usage --> $MailingId = getTextBetweenTags($string, 'MailingId');
//Now that i have the text between the tags I can loop and insert it using the $result = pg_query($dbconn, "select * from users");

//this is used to add mailings to postgres
foreach($mailing_array as $string){

    if (preg_match("/true/i", "$string")) {
        continue;
    } else {
        $MailingId = getTextBetweenTags($string, 'MailingId');
        $ReportId = getTextBetweenTags($string, 'ReportId');
        $ScheduledTS = getTextBetweenTags($string, 'ScheduledTS');
        $MailingName = getTextBetweenTags($string, 'MailingName');
        $ListName = getTextBetweenTags($string, 'ListName');
        $ListId = getTextBetweenTags($string, 'ListId');
        $ParentListId = getTextBetweenTags($string, 'ParentListId');
        $UserName = getTextBetweenTags($string, 'UserName');
        $SentTS = getTextBetweenTags($string, 'SentTS');
        $NumSent = getTextBetweenTags($string, 'NumSent');
        $Subject = getTextBetweenTags($string, 'Subject');
        $Visibility = getTextBetweenTags($string, 'Visibility');
        $ParentTemplateId = getTextBetweenTags($string, 'ParentTemplateId');

        if($NumSent !== '0'){
            echo "Sent Mailings Logged <br>";
            if(pg_connect($conn_string)){
                $dbconn = pg_connect($conn_string);
                echo "PGSQL connection successful <br>";
                $result = pg_query($dbconn, "INSERT INTO mailings VALUES('$MailingId','$ReportId','$ScheduledTS','$MailingName','$ListName','$ListId','$ParentListId','$UserName','$SentTS','$NumSent','$Subject','$Visibility','$ParentTemplateId')");
            } else {
                echo "PGSQL there was an issue connecting <br>";
            }
        } else {
            echo "Sent Mailings Not Logged";
        }
    }

}

