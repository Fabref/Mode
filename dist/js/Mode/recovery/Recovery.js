
/**
 * Se ejecuta siempre que se cargue cada pagina para comprobar si esta en la que 
 * muestra el mensaje de expiracion del token. Si lo esta, a los 60" se redirige
 * al menu principal
 */
$(function(){ // jQuery dom ready event
    if (window.location.href.toLowerCase().indexOf("cvte") > 0) {
        setTimeout(
        function() 
        {
            var href = $('#linkVolverMPTE').attr('href');
            window.location.href = href;
        }, 60000);
    }
});


/**
 * Evento onclick del boton de solicitud de recuperacion de la contraseña cuando
 * el usuario del centro introduce su nif.
 * Tras validar su NIF, muestra el resultado en pantalla y si es correcto, lo advierte, 
 * se envia el email al usuario y es redirigido a la ventana del login a lo 30"
 */
$('#restaurarPassword').click(function() {
    var url = window.location.href;
    var base_url = url.substr(0, url.indexOf("index"));
    
    var nifCentro = $('#nifRecuperarPass').val();
    
    $.ajax({
        url: base_url + 'index.php/Recovery/index/vnc',
        method: 'POST', 
        data: {'nifCentro': nifCentro},
        success: function(resultadoValidacionJson) {
//            alert(resultadoValidacionJson);
            
            /* Convierte a array el JSON */
            var resultadoValidacion = $.parseJSON(resultadoValidacionJson);
            
            $("#respuestaRecuperarPassword").html(resultadoValidacion['mensaje']);
            $("#nifRecuperarPass").val('');
            
            if ( ! resultadoValidacion['error']) {
                $('#divBotonRecuperar').addClass('hidden');
                $('#divBotonVolver').removeClass('hidden');
                $('#divNif').addClass('hidden');
                
                /* Transcurridos 30" redirige al login*/
                setTimeout(
                    function() 
                    {
                        var href = $('#linkVolverMP').attr('href');
                        window.location.href = href;
                    }, 30000);
            } 
            
        }
        
    });
});


/**
 * Evento onclick del boton de confirmar el cambio de la contraseña. Si las contraseñas
 * introducidas son iguales y no estan en blanco, se actualizan y muestra el mensaje
 * al usuario. En caso contrario, tambien se advierte al usuario.
 * Es redirigido a la ventana del login a lo 30"
 */
$('#confirmarPassword').click(function() {
    var url = window.location.href;
    var base_url = url.substr(0, url.indexOf("index"));
    
    var passwordNuevo1 = $('#passwordNuevo1').val();
    var passwordNuevo2 = $('#passwordNuevo2').val();
    var token = $('#token').val();
    
    $.ajax({
        url: base_url + 'index.php/Recovery/index/rc',
        method: 'POST', 
        data: {'passwordNuevo1': passwordNuevo1, 'passwordNuevo2': passwordNuevo2, 'token': token},
        success: function(resultadoCambioPassJson) {
//            alert(resultadoCambioPassJson);
            
            /* Convierte a array el JSON */
            var resultadoCambioPass = $.parseJSON(resultadoCambioPassJson);
            
            $("#respuestaConfirmarPassword").html(resultadoCambioPass['mensaje']);
            $("#passwordNuevo1").val('');
            $("#passwordNuevo2").val('');
            
            if ( ! resultadoCambioPass['error']) {
                $('#divNuevoPassARecuperar').addClass('hidden');
                $('#divBotonAceptar').removeClass('hidden');
                $('#divBotonConfirmar').addClass('hidden');
                
                /* Transcurridos 30" redirige al login*/
                setTimeout(
                    function() 
                    {
                        var href = $('#linkAceptarVolverMP').attr('href');
                        window.location.href = href;
                    }, 30000);
            } 
            
        }
        
    });
});
    

/**
 * Evento onclick del boton para iniciar el proceso de recuperacion de la contraseña
 * tras haber expirado el anterior tiempo de vida del token para recuperarla.
 * Carga la vista xa solicitar de nuevo la recuperacion.
 */
$('#recuperarPassTokenExpirado').click(function() {
    var href = $('#recuperarPassTokenExpirado').attr('href');
    window.location.href = href;
    
});
