
/* 
 * Carga las CCAA segun el pais seleccionadao
 */ 
$("#pais").change(function() {
    var idPais = $("#pais option:selected").val();
//    alert(idPais);
    /* Se obtienen las CCAA asociadas al pais seleccionado 
       Globals.baseUrl se ha definido en la vista crear y modificar paciente */
    if(idPais !== "NON") {
        $.ajax({
            url: Globals.baseUrl + 'index.php/General/index/gcbp',
            method: 'POST', 
            data: {'idPais': idPais},
            success: function(data) {
    //            alert(data);
                $("#comunidadAutonoma").html(data);
                $('#comunidadAutonoma').val('NON').trigger('change');

                /* Resetea el valor del select de las provincias*/
                $("#provincia").html('<option value="NON" selected disabled>' + Globals.seleccionarProvincia + '</option>');
                $('#provincia').val('NON').trigger('change');
            }
        });
    } else {
        $("#comunidadAutonomaPaciente").html('<option value="NON" selected disabled>' + Globals.seleccionarComunidad + '</option>');
        $("#comunidadAutonomaPaciente").select2("val", "NON");

        /* Resetea el valor del select de las provincias*/
        $("#provinciaPaciente").html('<option value="NON" selected disabled>' + Globals.seleccionarProvincia + '</option>');
        $("#provinciaPaciente").select2("val", "NON");
    }
    
});


/* 
 * Carga las provincias segun la ccaa seleccionada
 */ 
$("#comunidadAutonoma").change(function() {
    var idComunidad = $("#comunidadAutonoma option:selected").val();
    
    /* Se obtienen las Provincias asociadas a la ccaa seleccionada 
       Globals.baseUrl se ha definido en la vista crear y modificar paciente */
    if(idComunidad !== "NON") {
        $.ajax({
        url: Globals.baseUrl + 'index.php/General/index/gpbc',
        method: 'POST', 
        data: {'idComunidad': idComunidad},
        success: function(data) {
//            alert(data);
            $("#provincia").html(data);
            $('#provincia').val('NON').trigger('change');
        }
    });
    }
    
});