<?php
/**
 * Created by PhpStorm.
 * User: disol
 * Date: 05.04.2018
 * Time: 12:17
 */

require_once('head.php');

if (!isset($_REQUEST['add'])) {


    $BrandsArr = $Centurio->getBrands(false, $DB);
    $SitesArr = $Centurio->getSites($DB);

    ?>


    <style>
        /**
    * CENTURION styles
    */



        h5{margin:0;}

        .scol{
            border-bottom:solid 1px #DCB858;
            padding:10px;
            margin: 0;
        }
        .scol:hover{
            background-color: #DCB858;
        }
        .col{
            vertical-align:middle;
            height:60px;
            width: 22%;
            display: inline-block;

        }
        .centurion {
            background-color: #DCB858;
            padding: 3.4em;
        }

        .centurion__content {
            padding: 1.7em;
        }

        .centurion .position, .centurion .sites {
            border-bottom: solid 2px gray;
            padding: 1.7em;
            margin-bottom: 1.7em;
            background-color: #fff;
        }

        .centurion .position li, .centurion .sites li {
            display: inline-block;
            margin-left: 0.85em;
        }
    </style>
    <!-- split modules/CENTURION -->
    <div class="centurion" data-qcontent="module__CENTURION">
        <div class="centurion__content">
            <form method="get" action="add.php" onsubmit="return setResult();">
                <input id="key" type="hidden" name="key" value="">
                <div class="position">
                    <ul>
                        <li>
                            <label>Брэнд:
                                <select name="brand" onchange="reloadBrand()">
                                    <option></option>
                                    <?php
                                    foreach ($BrandsArr as $brand) {
                                        if(isset($_GET['t']) && $brand['id']==$_GET['b']){
                                            echo "<option selected=\"selected\" value='" . $brand['id'] . "'>" . $brand['name'] . "<option/>";
                                        }else
                                        echo "<option value='" . $brand['id'] . "'>" . $brand['name'] . "<option/>";
                                    }; ?>
                                </select>
                            </label>
                        </li>
                        <li>
                            <label>Имя позиции
                                <input name="name" type="text"/>
                            </label>
                        </li>
                        <li>
                            <label>Регулярная цена
                                <input name="regular" type="text"/>
                            </label>
                        </li>
                    </ul>
                </div>
                <div class="sites">
                    <?php
                    foreach ($SitesArr as $site):?>
                        <ul class="scol">
                            <li class="col">
                                <h5><a href="<?php echo $site['mainUrl'] ?>"
                                       target="_blank"><?php echo $site['site_title'] ?></a></h5>
                            </li>
                            <li class="col">
                                <?php if(isset($_GET['b'])):?>
                                     <label>Всего этого брэнда:
                                    <span><?php echo ($range = $Centurio->countAllBrandsPositionBySiteId($_GET['b'], $site['id'], $DB)) ?></span>
                                </label>
                                <?php endif;?>

                            </li>

                            <li class="col">
                                <label>Путь к позиции
                                    <input class="link" name="<?php echo $site["id"] . '_' ?>map" type="text"
                                           value="Пропустить"/>
                                </label>
                                <input class="siteId" type="hidden" name="siteId" value="<?php echo $site['id'] ?>"/>
                            </li>
                            <li class="col">
                                <label > Нет в ассортименте
                                    <input name="assortment" type="checkbox" class="assrt"
                                           value="2"/>
                                </label>
                            </li>

                        </ul>

                    <?php endforeach; ?>
                </div>
                <input type="hidden" value="" name="result" id="result">
                <button type="submit" name="add" value="ok">Сохранить</button>
            </form>
        </div>
    </div>
    <script>
        var reloadBrand= function () {
            var slct = document.getElementsByTagName('select');
            location.replace("/centurio/add.php?t=1&b="+slct[0].value);
        }
        var setResult = function () {
            var slct = document.getElementsByTagName('select');
            var data = document.getElementsByTagName('input');
            for(var i = 0; i< slct.length; i++){
                if(slct[i].value==''){
                    slct[i].style.borderColor='red';
                    scroll(0,0)
                    return false;
                }else{
                    slct[i].style.borderColor='initial';
                }
            }

           for(var i = 0; i< data.length; i++){
               if(data[i].value=='' && data[i].type != 'hidden'  && data[i].type != 'checkbox'){
                   data[i].style.borderColor='red';
                   scroll(0,0)
                   return false;
               }else{
                   data[i].style.borderColor='initial';
               }
           }

            var key = document.getElementById('key');
            key.value = Math.random();
            var res = {
                resArr: []
            };

            var siteIds = document.getElementsByClassName('siteId');
            var links = document.getElementsByClassName('link');
            var resBox = document.getElementById('result');
            var assrt = document.getElementsByClassName('assrt');

            for (var i = 0; i < siteIds.length; i++) {

                if (links[i].value != "Пропустить") {


                    res.resArr.push(JSON.stringify({id: siteIds[i].value, link: links[i].value}));
                }else {
                    if(assrt[i].checked){
                        res.resArr.push(JSON.stringify({id: siteIds[i].value,link:0}));
                    }
                }

            }
            var qRes = confirm('Уверены?');

            if (!qRes) {
                return false;
            }
            resBox.value = JSON.stringify(res);
        }
        //setResult();
    </script>

<?php } else {
    echo '<pre> Происходит загрузка данных... <br>';

    if (!isset($_SESSION['last_key'])) {
        $_SESSION['last_key'] = 0;
    }
    $key = $_GET['key'];
    if ($key == $_SESSION['last_key']) {
        echo "[ОШИБКА] - Вы пытаетесь отправить форму повторно. <br>";
        exit;

    } else {
        $_SESSION['last_key'] = $key;
    }

    $brand = $_GET['brand'];
    $name = $_GET['name'];
    $regular = $_GET['regular'];
    if (isset($_GET['result']) && $brand && $name && $regular) {

        $stmt = $DB->prepare("INSERT INTO SKU (brand_id, regullar_price,title) VALUES (:brandId, :regularPrice,:title)");
        $stmt->bindParam(':brandId', $brand);
        $stmt->bindParam(':regularPrice', $regular);
        $stmt->bindParam(':title', $name);

        $stmt->execute();
        $lastSku = $DB->lastInsertId();


        $stmt = $DB->prepare("INSERT INTO MAP (site_id, position_id,way) VALUES (:siteId, :positionId,:way)");
        $stmt->bindParam(':siteId', $siteId);
        $stmt->bindParam(':positionId', $positionId);
        $stmt->bindParam(':way', $way);

        $resultsArr = json_decode($_GET['result'], true);


        foreach ($resultsArr['resArr'] as $res) {

            $line = json_decode($res, true);

            $siteId = $line['id'];
            $positionId = $lastSku;
            $way = $line['link'];
            echo $way;
            if($way==0){

               $Centurio->addSiteBrandException($siteId,$brand,$DB);

            }else{
                if (mb_substr($line['link'], 0, 1, 'UTF-8') != '/') {
                    $way = '/' . $way;
                }
                $stmt->execute();
            }



        }
            echo "[Успех] загрузка данных завершена, молодец, Тащи еще !!!";
            echo "<a href='/centurio/add.php'>Ок, я смогу еще раз</a>";
            echo "<img src='img/zbs).jpg'>";
    } else {
        echo '[ОШИБКА]- Данных не поступило';
    }



}