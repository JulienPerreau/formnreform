var PRIV_KEY = "dfca20ced88613b51a8c6536c43765bd46494563";
var PUBLIC_KEY = "de4c9474d125a7254b4a4b3b04260c1b";

function getMarvelResponse() {

    var ts = new Date().getTime();
    var stringToCrypt = (ts + PRIV_KEY + PUBLIC_KEY).toString();
    var hash = $.md5(stringToCrypt); 
    var offset = 100;
    var limit = 20;

    var url = 'https://gateway.marvel.com:443/v1/public/characters';

    $.getJSON(url, {
      ts: ts,
      apikey: PUBLIC_KEY,
      hash: hash,
      offset: offset,
      limit: limit
      })
      .done(function(response) {
        var results = response.data.results;
        var max = results.length;
        var output = '<tr>';

        for(var i=0; i<max; i++){
            //console.log(results[i]);
            var description = "";
            if(results[i].description.length > 0){

                description = '<li>' + results[i].description + '</li>';
            }
            else{
                description = "";
            }

            var nbcomics = results[i].comics.available;
            var comics = '<ul>';
            var maxcomics = 3;
            if(nbcomics < 3 ){
                maxcomics = nbcomics;
            }

            for(var x=0; x<maxcomics; x++){
                if(results[i].comics.items.length > 0){
                    comics += '<li>' + results[i].comics.items[x].name + '</li>';
                }
            }
            comics += '</ul>';

            var img = results[i].thumbnail.path + '/standard_xlarge.' + results[i].thumbnail.extension;
            
            

            //affichage de la ligne
            output += '<td class="name"><h3 id=' + results[i].id + ' class="name_char">' + results[i].name + '</h3>';
            output += '<ul id=charac_'+ results[i].id +' class="characteristic">'
                        + description
                        + '<li> Nombre de comics où le personnage apparait :' + nbcomics + '</li>'
                        + '<li> Les 3 1er comics où le personnage apparait :' + comics + '</li>'
                    + '</ul>'; 
            output += '</td>';
            output += '<td><img src="' + img + '"></td>';
            output += '<td><a id="fav_' + results[i].id + '" class="favoris">Ajouter aux favoris</a></td>';
            output += '</tr>';
            
            
        }
        $(document).ready(function() {
            $(".name_char").click(function () {
                   console.log($(this).attr('id'));
                   var id = $(this).attr('id');
                   var charac_id = "#charac_" + id;
                   console.log("#charac_" + id);
                   $(".characteristic").hide();
                   $(charac_id).show();
            });
            
            var tabfavoris = [];
            $(".favoris").click(function () {
               console.log($(this).attr('id'));
               var id = $(this).attr('id');
               var id_fav = id.replace("fav_", "");
               
               if(tabfavoris.length < 5){
                   tabfavoris.push(id_fav);
                   $(this).parent().parent().attr('id',id_fav);
                   $(this).hide();
               }
               else{
                   alert("Désolé vous ne pouvez avoir que 5 favoris maximum");
               }
               console.log(tabfavoris);
            });
            
            
            $("#favoris_show").click(function(){
                $('table tr:not(:first-child)').each(function(){
                    if($(this).attr('id') == null){
                        $(this).hide();
                    }
                });
                $("#favoris_block").hide();
                $("#char_block").show();
            });
            
            $("#char_block").click(function(){
                $("#char_block").hide();
                $("tr").show();
                $("#favoris_block").show();
            });
        });

        $('#personnages').after(output);
      })
      .fail(function(err){
        console.log(err);
        alert('Une erreur est survenue veuillez recharger la page !');
      });
};

getMarvelResponse();

