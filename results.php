<?php
include_once('./includes/head.php');
$sitesArr = $Centurio->getSites($DB);

?>

<!---->
<!--
Created by admin on 07/12/17.


--><!-- split modules/centurioResult -->

<?php $brandsArr = $Centurio->getBrands(false, $DB) ?>

<div class="centurioResult__content" data-qcontent="module__centurioResult">
    <div class="centurioResult">
        <ul class="brandList group group--el">
            <li class="brandList__item col col-1-tp push-1-tp"
            </li>
            <?php foreach ($brandsArr as $brand): ?>
                <li class="brandList__item col col-1-tp push-1-tp"><?php echo $brand['name'] ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="group group--el">
        <ul class="siteList col col-1-tp">
            <?php foreach($sitesArr as $site):?>
                <li class="siteList__item"><?php echo $site['site_title']?></li>
            <?php endforeach;?>
        </ul>

           <?php foreach ($brandsArr as $brand):?>
                <ul class="resultList col col-1-tp">
                    <?php  foreach ($sitesArr as $site): ?>
                        <li class="resultList__item"  data_site_id="<?=$site['id']?>" data_brand_id="<?=$brand['id']?>" ><?php echo $Centurio->publicResult($DB, $site['id'], $brand['id']);?> </li>
                    <?php endforeach;?>
                </ul>
            <?php endforeach;?>



    </div>
</div>

<script src="node_modules/jquery/dist/jquery.js"></script>
<script src="functions.js"></script>
// Logic here

<? echo $twig->render('results.html', array(
'curPage' => 'index',
'menuArr' => $GLOBAL_DATA['menu'] ,
)
);