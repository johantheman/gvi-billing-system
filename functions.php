<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2019/02/02
 * Time: 23:04
 */

function getTextBetweenTags($string, $tagname)
{
    $pattern = "/<$tagname>(.*?)<\/$tagname>/";
    preg_match($pattern, $string, $matches);
    $var = str_replace('<![CDATA[', '', $matches[1]);
    $var = str_replace(']]','',$var);
    $var = str_replace('>','',$var);
    return $var;
}
