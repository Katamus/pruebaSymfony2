function consulta() {
    var url = $("#urlConsulta").val();
    $.ajax({
        type: "POST",
        url: url,
        dataType: "json",
        success: function(data) {
            pintarPantalla(data);
        },
        error: function() {
            alert('Error occured');
        }
    });
}

function pintarPantalla(data){
    $("#contenidoPagina").html('');
    $.each(data, function(i, item) {
        console.log(item);
        $("#contenidoPagina").append(crearPlantilla(item));
        $("#contenidoPagina").append("<br/>");
    });
}

function crearPlantilla(item){

    var url = $("#urleditar").val();
    var urlEliminar = $("#urleliminar").val();

    var plantilla =  "<div class='col-sm'><div class='card' style='width: 18rem;'>";
    plantilla +=  "<div class='card-body'>";
    plantilla +="<h5 class='card-title'>"+item.nombre+"</h5>";
    plantilla +="<p class='card-text'>"+item.descripcion+"</p>"
    plantilla +="<a href='"+url+"/"+item.idtarea+"' class='card-link'>Modificar Tarea</a>"
    plantilla +="<a href='"+urlEliminar+"/"+item.idtarea+"' class='card-link'>Terminar Tarea</a>"
    plantilla += "</div>";
    plantilla += "</div></div>";

    return plantilla;
}

function consultaPorNombre($item){
    var url = $("#urlConsulta").val();
    $.ajax({
        type: "POST",
        url: url,
        dataType: "json",
        data: {
            texto: $item
        },
        success: function(data) {
            pintarPantalla(data);
        },
        error: function() {
            alert('Error occured');
        }
    });
}

function consultaporboton(){
    var consulta = $("#tareas").val();
    consultaPorNombre(consulta);
}

$(document).ready(function() {
    consulta();
    var tags = [ "c++", "java", "php", "coldfusion", "javascript", "asp", "ruby" ];
    var urlConsultarNombres = $("#urlConsultarNombres").val();
    $("#tareas").autocomplete({
        source: function( request, response ) {
            $.ajax( {
                url: urlConsultarNombres,
                dataType: "jsonp",
                method: "POST",
                data: {
                    term: request.term
                },
                success: function( data ) {
                    response( data );
                }
            } );
        },
        minLength: 1,
        select: function( event, ui ) {
           //alert("Selected: " + ui.item.value + " aka " + ui.item.id)
            consultaPorNombre(ui.item.label);
        }
    } );
});