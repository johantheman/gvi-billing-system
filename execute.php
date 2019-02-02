<?php
/**
 * Created by PhpStorm.
 * User: Johan
 * Date: 2/1/2019
 * Time: 11:50 AM
 */

require 'api.php';
include 'credentials.php';
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
$ins->apiPost($xml);
var_dump($ins->response);