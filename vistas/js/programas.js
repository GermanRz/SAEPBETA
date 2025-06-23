// $('.btnEditarPrograma').click(function(){
$(document).on('click','.btnEditarPrograma', function(){

    let idPrograma = $(this).attr("idPrograma");
    console.log("id programa:", idPrograma);
    let datos = new FormData();
    datos.append("id_programa", idPrograma);
    $.ajax({
        url: "ajax/programas.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){
            console.log(respuesta);
            $("#editDescripcionPrograma").val(respuesta["nombre_programa"]);
            $("#editVersionPrograma").val(respuesta["version_programa"]);
            $("#editIdPrograma").val(respuesta["ID_programas"]);

        }//funcion success


    })//fn ajax


})//fin click btnEditarPrograma


$(document).on('click','.btnActivarPrograma', function(){

    let idProgramaActivar = $(this).attr("idProgramaCambiarEstado");
    let nuevoEstado = $(this).attr("nuevoEstadoprograma");
    // console.log("programa capturado:", idProgramaActivar);
    // console.log("programa estado nuevo:", nuevoEstado);
    let datos = new FormData();
    datos.append("id_cambiarEstado",idProgramaActivar);
    datos.append("estadoPrograma",nuevoEstado);

    $.ajax({
        url: "ajax/programas.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function (respuesta){
            console.log(respuesta);
        }
    })
    if (nuevoEstado == "Inactivo"){
        $(this).removeClass("btn-success");
        $(this).addClass("btn-danger");
        $(this).html("Inactivo");
        $(this).attr("nuevoEstadoprograma", "Activo");
    }else{
        $(this).removeClass("btn-danger");
        $(this).addClass("btn-success");
        $(this).html("Activo");
        $(this).attr("nuevoEstadoprograma", "Inactivo");      

    }


})//fin click btnActivarPrograma
