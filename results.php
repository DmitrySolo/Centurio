<style>

    .col-1{
        width: 100%;
    }
    .col-2{
        width: 49%;
    }
    .col-3{
        width: 33%
    }
    .col-4{
        width: 24%
    }

</style>
<?php
include_once('head.php');
$sitesArr = $Centurio->getSites($DB);
foreach($sitesArr as $site){
    echo $site['site_title'];
    print_r($Centurio->publicResult($DB,$site['id'] ,2));
   echo '<br>';
}
?>