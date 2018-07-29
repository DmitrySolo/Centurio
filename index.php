<?
include_once('./includes/head.php');


// Logic here
echo $twig->render('index.html', array(
        'curPage' => 'index',
        'menuArr' => $GLOBAL_DATA['menu'] ,
    )
    );


