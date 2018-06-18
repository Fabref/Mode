
/**
 * Gestiona la precarga de los ficheros que el usuario adjunta a la incidencia.
 * 
 * @param {type} event
 */
function precargarAdjuntos(event) {
    var ficherosAdjuntos = document.getElementById("adjuntos");
    var limiteTamañoFichero = 2097152;
    var numeroMaximoFicheros = 5;
    var fileExtensions = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
    var existeError = false;
    var tipoError = null;


    /* Comprueba el numero máximo de ficheros adjuntos */
    if (ficherosAdjuntos.files.length > numeroMaximoFicheros) {
        existeError = true;
        tipoError = "numero_ficheros";
    } 

    /* Comprueba el tamaño de los ficheros y su extension */
    var contadorFicheros = 0;
    if (! existeError) {
        while ((contadorFicheros < ficherosAdjuntos.files.length) && (! existeError)) {
            /* Comprueba la extension */
            if ($.inArray(ficherosAdjuntos.files[contadorFicheros].type.toLowerCase(), fileExtensions) === -1) {
                existeError = true;
                tipoError = "extension";
            }

            /* Comprueba el tamaño del fichero */
            if (parseInt(ficherosAdjuntos.files[contadorFicheros].size) > limiteTamañoFichero) {
                existeError = true;
                tipoError = "tamaño";
            }

            contadorFicheros++;
        }   
    }

    if (existeError) {
        if (tipoError === "numero_ficheros") {
            $('#titleModalErrorAdjuntos').text(Globals.titleLimiteAdjuntos);
            $('#bodyModalErrorAdjuntos').text(Globals.bodyLimiteAdjuntos);
        } else if (tipoError === "tamaño") {
            $('#titleModalErrorAdjuntos').text(Globals.titleTamanoAdjuntos);
            $('#bodyModalErrorAdjuntos').text(Globals.bodyTamanoAdjuntos);

        } else {
            $('#titleModalErrorAdjuntos').text(Globals.titleExtensionAdjuntos);
            $('#bodyModalErrorAdjuntos').text(Globals.bodyExtensionAdjuntos);

        }
        $('#modalErrorAdjuntos').modal('show');

    } else {
        /* Resetea los ficheros que hubiesen precargados */
        $('#divWrapperImagenes').replaceWith('<div id="divWrapperImagenes" class="row"><div id="wrapperImagenes" class="col-md-11 col-md-offset-1"></div></div>');

        /* Precarga los nuevos */
        for (var i = 0; i < ficherosAdjuntos.files.length; i++) {
            $('#wrapperImagenes').append('<img title="' + ficherosAdjuntos.files[i].name + '" id="img_' + ficherosAdjuntos.files[i].name + '"/>');

            var output = document.getElementById('img_' + ficherosAdjuntos.files[i].name);
            output.src = URL.createObjectURL(event.target.files[i]);
            output.onload = function() {
                redimensionarImagen($(this));
            };
        }
        
        if ($('#divFormatoImagenes').hasClass('hidden')) {
            $('#divFormatoImagenes').removeClass('hidden');
        }
       
    }
}


/**
 * Redimensiona una imagen para que su tamaño sea como máximo de 200x200
 * 
 * @param {type} imagenARedimensionar la imagen a redimensionar
 */
function redimensionarImagen(imagenARedimensionar) {
    var maxWidth = 150; // Max width for the image
    var maxHeight = 120;    // Max height for the image
    var ratio = 0;  // Used for aspect ratio

    var width = imagenARedimensionar.width();    // Current image width
    var height = imagenARedimensionar.height();  // Current image height

    // Check if the current width is larger than the max
    ratio = maxWidth / width;   // get ratio for scaling image
    imagenARedimensionar.css("width", maxWidth); // Set new width
    imagenARedimensionar.css("height", height * ratio);  // Scale height based on ratio
    height = height * ratio;    // Reset height to match scaled image

    var width = imagenARedimensionar.width();    // Current image width
    var height = imagenARedimensionar.height();  // Current image height

    // Check if current height is larger than max
    ratio = maxHeight / height; // get ratio for scaling image
    imagenARedimensionar.css("height", maxHeight);   // Set new height
    imagenARedimensionar.css("width", width * ratio);    // Scale width based on ratio
    width = width * ratio;    // Reset width to match scaled image
}


/**
 * Redirige a la creacion de una nuevo mensaje para añadirlo a la incidencia
 */
function crearNuevoMensajeEnIncidencia(idComunicacion) {
    window.location.href = "../../index/cvcni/" + idComunicacion;
}