<?php
/*
 * sample-rblquery - Bulk rbl checker
 *
 * @author Murat B.
 * @url https://github.com/muratti66/sample-rblquery
 * @version 1.00, 29 Jul 2016
 */
include_once("message.php");

function checkSingleIP($queryIP, $dnsArray, $rblList) {
    global $messageYes, $messageNo;
    $itemArr=array();
    //IP address parsing digits
    list($one, $two, $three, $four) = explode(".", $queryIP);
    //IP addresses will be reversed
    $reverseIP=$four . "." . $three . "." . $two . "." . $one;
    $rblStatus=array();
    //Looping rbl array
    foreach ($rblList as $rbl) {
        //Query format preparing
        $queryItem=$reverseIP . "." . $rbl;
        //Query
        $rblCheck=dns_get_record($queryItem, DNS_TXT, $dnsArray);
        //if no message in rbl query output is not in blacklist
        if(!empty($rblCheck)) {
            //Pulling multiple message and 
            //written in rbl_message_array
            foreach ($rblCheck as $rblItems) {
                $rblMessageArr=$rblItems['entries'];
                //All rbl output parts will be merged one line
                $rblStatus[$rbl][]=implode(" ", $rblMessageArr);
            }
        } else {
            $rblStatus[$rbl][]=$messageNo;
        }
    }
    return $rblStatus;
}
function checkRBLS($ipArr, $dnsArray, $rblList) {
    $allRblStatus=array();
    foreach($ipArr as $ip) {
        $singleQuery=checkSingleIP($ip, $dnsArray, $rblList);
        $allRblStatus[$ip]=$singleQuery;
    }
    return $allRblStatus;
}
