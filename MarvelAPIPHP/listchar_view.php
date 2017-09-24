<html>
    <head>
        <title>Marvel API</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        
        <div class="loader"></div>
        <div id="header">
            <h1>Marvel Heroes</h1>
            <h2>Liste des personnages</h2>
        </div>
        <table id="marvelhero">
            <tr id="personnages">
                <th id="tab_char">Personnages</th>
                <th id=tab_img">Images</th>
                <th id="tab_fav">Favoris</th>
            </tr>   
            <?php foreach($data as $index => $char): 
                $img = $char['thumbnail']['path'].'/standard_xlarge.'.$char['thumbnail']['extension'];
                $description = "";
                if($char['description'] != null){
                    $description = '<li>'.$char['description'].'</li>';
                }
                else{
                    $description = "";
                }
                
                $nbcomics = $char['comics']['available'];
                $comics = '<ul>';
                $maxcomics = 3;
                if($nbcomics < 3 ){
                    $maxcomics = $nbcomics;
                }
                
                for($x = 0; $x < $maxcomics; $x++){

                    if($char['comics']['items'] != null){
                        $comics .= '<li>'.$char['comics']['items'][$x]['name'].'</li>';
                    }
                }
                $comics .= '</ul>';
            ?>
                   <tr id="<?php echo $char['id']; ?>">
                       <td>
                           <h3 id ="<?php echo $char['id']; ?>" class="name_char" ><?php echo $char['name']?></h3>
                           <ul id="charac_<?php echo $char['id']; ?>" class="characteristic">
                               <?php echo $description ?>
                               <li>Nombre de comics où le personnage apparait :<?php echo $nbcomics ?> </li>
                               <li> Les 3 1er comics où le personnage apparait :<?php echo $comics ?></li>
                           </ul>
                       </td>
                       <td><img src="<?php echo $img; ?>"></td>
                       <td><?php if($fav == "off"): ?>
                           <a id="fav_<?php echo $char['id']; ?>" class="favoris">Ajouter aux favoris</a>
                           <?php endif; ?>
                       </td>    
                   </tr>

            <?php endforeach; ?>
        </table>
        
        <?php if($fav == "off"): ?>
            <div id="favoris_block">
                <form id="favoris" action="index.php" method="post">
                    <input type="submit" value="Voir les favoris">
                </form>
            </div>
        <?php endif; ?>
        
        <?php if($fav == "on"): ?>
            <div id="char_block">
                <a href="index.php" id="char_show">Remontrer tous les personnages</a>
            </div>
        <?php endif; ?>
        
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script type="text/javascript" src="js/marvelapi.js"></script>
        <script>
            $(document).ready(function() {
                $(".loader").fadeOut("slow");
            });
        </script>
    </body>
    
</html>