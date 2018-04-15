<?php
include_once('head.php');
$sitesArr = $Centurio->getSites($DB);
foreach($sitesArr as $site){
    echo $site['site_title'];
    print_r($Centurio->publicResult($DB,$site['id'] ,2));
   echo '<br>';
}
?>