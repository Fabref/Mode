/******************************************************************************/
/*****************************  GRAFICA ENCUESTA  *****************************/
/******************************************************************************/

$(document).ready(function () {
    var url = window.location.href;
    var base_url = url.substr(0, url.indexOf("index"));
    //alert (base_url);
    /**
     * Grafica de las sesiones del año actual por licencia
     */
    $.ajax({
        url: base_url + 'index.php/Campanya/index/cdrc/' + Globals.id_campana,
        method: 'POST',
        success: function (infoGraficaJSON) {
//            alert(infoGraficaJSON);
            /* Convierte a array el JSON */
            var infoGrafica = $.parseJSON(infoGraficaJSON);

            /* Array donde se almacenan los datasets de la grafica */
            var datasetsAspectos = [];
            var aspectosGrafica = infoGrafica['aspectosGrafica'];
            var aspecto = {
                label: '',
                borderColor: 'rgb(255, 255, 255, 0)',
                backgroundColor: 'rgb(255, 255, 255, 0)',
                data: [{
                        x: 0,
                        y: 0
                    }]
            };

            datasetsAspectos.push(aspecto);

            /* Array de colores siempre fijo de 20 elementos */
            var colores = ['rgb(205, 92, 205)',
                'rgb(255, 192, 203)',
                'rgb(255, 160, 122)',
                'rgb(255, 215, 0)',
                'rgb(230, 230, 250)',
                'rgb(173, 255, 47)',
                'rgb(0, 255, 255)',
                'rgb(255, 248, 220)',
                'rgb(240, 255, 240)',
                'rgb(192, 192, 192)',
                'rgb(205, 92, 205)',
                'rgb(220, 20, 60)',
                'rgb(255, 20, 147)',
                'rgb(255, 127, 80)',
                'rgb(255, 255, 0)',
                'rgb(218, 112, 214)',
                'rgb(50, 205, 50)',
                'rgb(95, 158, 160)',
                'rgb(224, 164, 96)',
                'rgb(112, 128, 144)'
            ];
            //alert(colores);

            for (var i = 0; i < aspectosGrafica.length; i++) {
//                var color = 'rgb(' + (Math.floor(Math.random() * (254 - 1)) +
//                        1) + ", " + (Math.floor(Math.random() * (254 - 1)) +
//                        1) + ", " + (Math.floor(Math.random() * (254 - 1)) +
//                        1) + ", 1)";
                var color = colores[i];
                //alert(color);
                aspecto = {
                    label: aspectosGrafica[i]['nombre'],
                    data: [{
                            x: aspectosGrafica[i]['desviacion'],
                            y: aspectosGrafica[i]['media']
                        }],
                    backgroundColor:
                            color
                    ,
                    borderColor:
                            color
                    ,
                    borderWidth: 1,
                    pointRadius: 10,
                    pointHoverRadius: 15,
                    showLine: false //Gráfica de puntos, sin unirlos.
                };
                datasetsAspectos.push(aspecto);
            }

            aspecto = {
                label: '',
                borderColor: 'rgb(255, 255, 255, 0)',
                backgroundColor: 'rgb(255, 255, 255, 0)',
                data: [{
                        x: 3,
                        y: 0
                    }]
            };

            datasetsAspectos.push(aspecto);

            var ctx = document.getElementById("grafica").getContext('2d');
            var scatterChart = new Chart(ctx, {
                type: 'scatter',
                data: {
                    datasets: datasetsAspectos
                },
                options: {
                    scales: {
                        xAxes: [{
                                type: 'linear',
                                position: 'bottom'
                            }]
                    },
                    showLines: false,
                    legend: {
                        onClick: (e) => e.stopPropagation()
                    }
                }
            });
        }
    });
}
);