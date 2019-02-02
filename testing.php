<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2019/02/02
 * Time: 21:42
 */

$string = '<MailingId>20297974</MailingId>
<ReportId>1403008178</ReportId>
<ScheduledTS>2019-02-01 00:13:07.0</ScheduledTS>
<MailingName><![CDATA[Alternative Establishments (5)]]></MailingName>
<ListName><![CDATA[Alternative Establishments]]></ListName>
<ListId>4868202</ListId>
<ParentListId>4394565</ParentListId>
<UserName>Duncan Houston</UserName>
<SentTS>2019-02-01 00:13:07.0</SentTS>
<NumSent>295</NumSent>
<Subject><![CDATA[%%First name%%: Travellers also enquired at these popular establishments]]></Subject>
<Visibility>Shared</Visibility>
<ParentTemplateId>15876160</ParentTemplateId>
</Mailing>';

function getTextBetweenTags($string, $tagname)
{
    $pattern = "/<$tagname>(.*?)<\/$tagname>/";
    preg_match($pattern, $string, $matches);
    $var = str_replace('<![CDATA[', '', $matches[1]);
    $var = str_replace(']]','',$var);
    $var = str_replace('>','',$var);
    return $var;
}

$MailingName = getTextBetweenTags($string, 'MailingName');
echo "mailing name = $MailingName <br>";
$MailingId = getTextBetweenTags($string, 'MailingId');
echo "MailingId = $MailingId <br>";