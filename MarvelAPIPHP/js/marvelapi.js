$(document).ready(function() {
    var tabfavoris = [];
    
    $(".name_char").click(function () {
        var id = $(this).attr('id');
        var charac_id = "#charac_" + id;
        $(".characteristic").hide();
        $(charac_id).show();
    });

    $(".favoris").click(function () {
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
    });
    
    $( "#favoris" ).submit(function( event ) {
        if(tabfavoris.length > 0){
            for(var x = 0; x < tabfavoris.length; x++){
                $('#favoris').append('<input type="hidden" name="action['+ x +']" value="' + tabfavoris[x] + '">');
            }
        } 
        else{
            event.preventDefault();
            alert("Vous n'avez aucun favoris");
        }        
    });
});


