<?php 

require "RequestAPI.php";

$PRIVATE_KEY = "dfca20ced88613b51a8c6536c43765bd46494563";
$PUBLIC_KEY = "de4c9474d125a7254b4a4b3b04260c1b";

$fav = "off";

if(!isset($_POST['action'])){
    $data = MarvelApiRequestChar($PRIVATE_KEY, $PUBLIC_KEY);
    
    if($data != null){

        require 'listchar_view.php';
    }
}
else if(isset($_POST['action'])){
    $tab_favoris = $_POST['action'];
    
    $data = array();
    foreach($tab_favoris as $key => $id){
        $char = MarvelApiRequestFavorisChar($PRIVATE_KEY, $PUBLIC_KEY, $id);
        $data = array_merge($data, $char);
    }

    $fav = "on";
    
    if($data != null){
        require 'listchar_view.php';
    }
}

?>