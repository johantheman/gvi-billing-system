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