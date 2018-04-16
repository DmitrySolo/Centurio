<style>

    5.0
    .0
    | MIT License | github.com /necolas/ normalize.css *

    /
    html {
        -ms-text-size-adjust: 100%;
        -webkit-text-size-adjust: 100%
    }

    body {
        margin: 0
    }

    ::-webkit-file-upload-button {
        -webkit-appearance: button;
        font: inherit
    }

    * {
        box-sizing: border-box
    }

    body {
        background-color: #f3f3f3
    }

    html {
        font-family: Fira Sans, Sans-Serif;
        font-weight: 400;
        color: #3b3a3a;
        font-size: 14px;
        line-height: 1.7
    }

    @media (min-width: 900px) {
        html {
            font-size: calc(14px + 2 * ((100vw - 900px) / 340))
        }
    }

    @media (min-width: 1240px) {
        html {
            font-size: 16px
        }
    }

    li, ul {
        margin: 0
    }

    li, ul {
        padding: 0
    }

    li {
        list-style: none
    }

    @media screen and (min-width: 600px) {
        .col.col-1-tp {
            width: 8.33333%
        }

        .push-1-tp {
            margin-left: 8.33333%
        }
    }

    .group {
        letter-spacing: -.65em;
        text-align: left;
        display: block
    }

    .group--el {
        margin-right: -.2em;
        margin-left: -.2em
    }

    .group--el > .col {
        padding-left: .2em;
        padding-right: .2em
    }

    .col {
        width: 100%;
        letter-spacing: normal;
        display: inline-block;
        position: relative;
        float: none;
        text-align: left;
        vertical-align: top;
        box-sizing: border-box
    }

    body, html {
        height: 100%
    }

    .centurioResult__content {
        background-color: #fff
    }

    .centurioResult__content ul {
        padding: 0 !important;
        margin: 0
    }

    .centurioResult__content ul li {
        padding: .68em 0;
        font-size: .8rem;
        margin: 0
    }

    .centurioResult .brandList {

        font-weight: 700;
        color: #3d255b;
        border-bottom: 2px solid #55347f;
    }

    .centurioResult .brandList__item, .siteList__item {
        text-align: center;
    }

    .siteList__item {
        border-bottom: solid #4a3565 1px;
        padding: .68em 1.36em;
        background-color: #3d255b;
        color: #fff
    }

    .resultList:nth-child(2n) {
        background-color: #f2edf8
    }

    .resultList__item {
        text-align: center;
        font-weight: bold;
        border-bottom: solid 1px #d6cce2;
    }

    html {
        overflow-x: hidden
    }

    ::-webkit-scrollbar {
        width: .5em
    }

    ::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, .5);
        pointer-events: none
    }

    ::-webkit-scrollbar-thumb {
        background-color: #fbfff8;
        outline: 1px solid #f3f6ff;
        margin-left: .5em;
        pointer-events: none
    }
</style>
<?php
include_once('head.php');
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
                        <li class="resultList__item"><?php echo $Centurio->publicResult($DB, $site['id'], $brand['id']);?> </li>
                    <?php endforeach;?>
                </ul>
            <?php endforeach;?>



    </div>
</div>
