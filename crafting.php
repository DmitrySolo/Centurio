<?php
/**
 * Created by PhpStorm.
 * User: disol
 * Date: 12.04.2018
 * Time: 12:29
 */
include_once('head.php');

$stmt = $DB->prepare("INSERT INTO SITES (site_title, home_city_id, mainUrl, dom_elm) VALUES (:title, :home_city_id, :mainUrl, :dom_elm)");

$stmt->bindParam(':title', $title);
$stmt->bindParam(':home_city_id', $home);
$stmt->bindParam(':mainUrl', $url);
$stmt->bindParam(':dom_elm', $dom);
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


$title ='LeroyMerlin';
$home=0;
//$siteId=1;
$url='https://www.castorama.ru/';
$way='/smesitel-dlja-vanny-iddis-district-dissb00i02';
$dom='.price span span';


$sitePrice =  $Centurio->getPrice($url,$way,$dom);

if(is_int($sitePrice)){
    $stmt->execute();
}
var_dump($sitePrice);