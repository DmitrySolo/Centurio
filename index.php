<?php
header('Content-Type: text/html; charset=utf-8');
/**
 * Created by PhpStorm.
 * User: disol
 * Date: 02.04.2018
 * Time: 13:13
 */

require_once('head.php');



echo '<pre>';


$sitesArr = $Centurio->getSites($DB);

foreach($sitesArr as $site){

    $siteWays = $Centurio->getSiteWays($site['id'],$DB);

    foreach ($siteWays as $way){

        $sitePrice =  $Centurio->getPrice($site['mainUrl'],$way['way'],$site['dom_elm']);
        $regularPrice = $Centurio->getRegularPriceById($way['position_id'],$DB);
        $res = round((int)$sitePrice  /   (int)$regularPrice, 2);
        $Centurio->saveResult($way['position_id'],$site['id'],$res,$DB);
    }

    var_dump($res);
}
//

