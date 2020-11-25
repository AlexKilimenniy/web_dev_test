<?php
$tags = new Tags();

if (isset($_GET['create'])) {
    $cookery = new Cookery();
    $data = [];
    if (!empty($_POST)){

        if (isset($_POST['name']) && $_POST['name'] != ''){
            $cookery->name = $_POST['name'];
        }
        $cookery->tags = [];
        if (isset($_POST['tags'])){
            foreach ($_POST['tags'] as $tag){
                array_push($cookery->tags, $tag);
            }
        }

        if (!$cookery->save()){
            $data = $_POST;
            $smarty->assign('errors', $cookery->ERRORS);
        } else {
            header("Location:/cookery");
            die();
        }
    }

    $smarty->assign('data', $data);
    $smarty->assign('tags_list', $tags->getList());
    $smarty->assign('new', true);
    $smarty->display('cookery/edit.tpl');
} elseif (isset($_GET['update']) && isset($_GET['id'])) {
    $cookery = new Cookery($_GET['id']);

    if (!empty($_POST)){

        if (isset($_POST['name']) && $_POST['name'] != ''){
            $cookery->name = $_POST['name'];
        }
        $cookery->tags = [];
        if (isset($_POST['tags'])){
            foreach ($_POST['tags'] as $tag){
                array_push($cookery->tags, $tag);
            }
        }


        if (!$cookery->save()){
            $data = $_POST;
            $smarty->assign('errors', $cookery->ERRORS);
        } else {
            header("Location:/cookery");
            die();
        }
    }

    $smarty->assign('update', true);
    $smarty->assign('data', json_decode(json_encode($cookery), true));
    $smarty->assign('tags_list', $tags->getList());
    $smarty->display('cookery/edit.tpl');

} elseif (isset($_GET['remove']) && isset($_GET['id'])) {
    $cookery = new Cookery($_GET['id']);
    $cookery->delete();
    header("Location:/cookery");
    die();
} else {
    $cookery = new Cookery();
    $data = $cookery->getList();
    $smarty->assign('data_list', $data);

    $smarty->display('cookery/index.tpl');
}