<?php

include_once('head.php');


$res = $Centurio->getProductsbyShopAndBrand($DB,2,2);
print_r($res);