<?php
/*
 * sample-rblquery - Bulk rbl checker
 *
 * @author Murat B.
 * @url https://github.com/muratti66/sample-rblquery
 * @version 1.00, 29 Jul 2016
 */
include_once('functions.php');

//Setting Sample DNS servers, RBL Servers and to be 
//queried IP Address in arrays
$dnsArray=array('208.67.222.222');
$rblList=array('b.barracudacentral.org',
    'cbl.abuseat.org', 'dnsrbl.org', 'bl.mailspike.net',
    'bl.score.senderscore.com', 'zen.spamhaus.org',
    'dnsbl.sorbs.net', 'bl.spamcop.net',
    'bl.spameatingmonkey.net', 'all.spamrats.com');

//Single query
$singleIP='8.8.8.8';
$list=checkSingleIP($singleIP, $dnsArray, $rblList);
print_r($list);


//Bulk query
$bulkIP=array('8.8.8.8', '8.8.8.7');
$bulkList=checkRBLS($bulkIP, $dnsArray, $rblList);
print_r($bulkList);
