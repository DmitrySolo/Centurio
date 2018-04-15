<?php
/**
 * Created by PhpStorm.
 * User: disol
 * Date: 02.04.2018
 * Time: 15:33
 */


class Centurio
{
    function getPrice($siteUrl, $priceWay, $domElement)
    {


        $base = $siteUrl . $priceWay;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_URL, $base);
        curl_setopt($curl, CURLOPT_REFERER, $base);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        $str = curl_exec($curl);
        curl_close($curl);
        $html = new simple_html_dom();
        $html->load($str);

        $idx = 0;
        if (is_object($html)) { //check for connecting

            $checkIndex = explode('*',$domElement);

            if(count($checkIndex) ==2){

                $idx = $checkIndex[1];


            }

            echo $idx;
            $domEl = $html->find($checkIndex[0], $idx);

            if (is_object($domEl)) { //check for serching dom el
                $domEl->plaintext;
                $price = (int)preg_replace('/(\h|&nbsp;)/', "", $domEl->plaintext);

            } else {
                return 'centurio cant find current dom element on this page';
            }


            if (is_int($price)) {

                return $price;

            } else {

                return 'Centurio is trubble getting price';
            }
        } else {
            var_dump($html);
            return 'Centurio is trubble getting connecting';
        }
    }

    function getSites($DB)
    {

        return $DB->query('SELECT * FROM `sites` WHERE true', PDO::FETCH_ASSOC)->fetchAll();

    }

    function getSiteWays($site_id, $DB)
    {

        return $DB->query("SELECT * FROM `map` WHERE site_id = $site_id", PDO::FETCH_ASSOC)->fetchAll();

    }

    function saveResult($pos_id, $site_id, $result, $DB)
    {

        $sql = "INSERT INTO `results` (`pos_id`, `site_id`, `result`) VALUES ($pos_id,$site_id,$result)";
        $DB->exec($sql);

    }

    function getRegularPriceById($id, $DB)
    {

        return ($DB->query("SELECT regullar_price FROM `sku` WHERE id = $id", PDO::FETCH_ASSOC)->fetch())['regullar_price'];

    }

    function getBrands($id = false, $DB)
    {
        if (!$id) {
            return $DB->query("SELECT name, id FROM `brands` WHERE true", PDO::FETCH_ASSOC)->fetchAll();
        }
    }

    function countAllBrandsPositionBySiteId($brandId, $siteId, $DB)
    {


        $range = ($DB->query("SELECT COUNT(*) FROM sku INNER JOIN map ON sku.id = map.position_id AND map.site_id = $siteId AND sku.brand_id = $brandId", PDO::FETCH_ASSOC)->fetchAll())[0]['COUNT(*)'];

        if(!$range){
           $rs = $DB->query("SELECT EXISTS(SELECT * FROM out_assortment WHERE site_id = $siteId AND brand_id = $brandId)")->fetch()[0];
          if($rs){
              return "<span style=\"color: orangered\">НЕТ В АССОРТИМЕНТЕ</span>";
          }
        }else{
            return $range;
        }
    }

    function getAllBrandsPositionBySiteId($DB)
    {


        return ($DB->query("SELECT * FROM sku INNER JOIN map ON sku.id = map.position_id AND map.site_id = 1", PDO::FETCH_ASSOC)->fetchAll());

    }

    function publicResult($DB, $siteId, $brandId)
    {

        $arr =  ($DB->query("SELECT * FROM results LEFT JOIN sites ON results.site_id = sites.id JOIN sku ON results.pos_id = sku.id JOIN brands ON sku.brand_id = brands.id WHERE sites.id = $siteId and brands.id = $brandId", PDO::FETCH_ASSOC)->fetchAll());
        $cnt = count($arr);
        if(!$cnt){

            return 'Непроверено';

        }else{
            $summ = 0;
            $siteName = $arr[0]['site_title'];
            $brandName = $arr[0]['name'];
            foreach ($arr as $itemArr){

                $summ += $itemArr['result'];
            }
            $generalResult = $summ/$cnt;

            echo ' '.$brandName.' -'.(100 - round($generalResult,3)*100).'%';
        }

    }

    function addSiteBrandException($site_id,$brandId,$DB){

        $sql = "INSERT INTO `out_assortment` (`site_id`, `brand_id`) VALUES ($site_id,$brandId)";
        $DB->exec($sql);

    }

}