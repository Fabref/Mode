

<!--===============================================================================================-->
<script src="<?= base_url() ?>dist/encuesta/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="<?= base_url() ?>dist/encuesta/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
<script src="<?= base_url() ?>dist/encuesta/vendor/bootstrap/js/popper.js"></script>
<script src="<?= base_url() ?>dist/encuesta/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="<?= base_url() ?>dist/encuesta/vendor/select2/select2.min.js"></script>
<script>
    $(".js-select2").each(function () {
        $(this).select2({
            minimumResultsForSearch: 20,
            dropdownParent: $(this).next('.dropDownSelect2')
        });


        $(".js-select2").each(function () {
            $(this).on('select2:close', function (e) {
                if ($(this).val() == "Please chooses") {
                    $('.js-show-service').slideUp();
                } else {
                    $('.js-show-service').slideUp();
                    $('.js-show-service').slideDown();
                }
            });
        });
    })
</script>
<!--===============================================================================================-->
<script src="<?= base_url() ?>dist/encuesta/vendor/daterangepicker/moment.min.js"></script>
<script src="<?= base_url() ?>dist/encuesta/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
<script src="<?= base_url() ?>dist/encuesta/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
<script src="<?= base_url() ?>dist/encuesta/vendor/noui/nouislider.min.js"></script>
<script>
    var filterBar = document.getElementById('filter-bar');

    noUiSlider.create(filterBar, {
        start: [1500, 3900],
        connect: true,
        range: {
            'min': 1500,
            'max': 7500
        }
    });

    var skipValues = [
        document.getElementById('value-lower'),
        document.getElementById('value-upper')
    ];

    filterBar.noUiSlider.on('update', function (values, handle) {
        skipValues[handle].innerHTML = Math.round(values[handle]);
        $('.contact100-form-range-value input[name="from-value"]').val($('#value-lower').html());
        $('.contact100-form-range-value input[name="to-value"]').val($('#value-upper').html());
    });
</script>
<!--===============================================================================================-->
<script src="<?= base_url() ?>dist/encuesta/js/main.js"></script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<!--<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>-->
<script>
//    window.dataLayer = window.dataLayer || [];
//    function gtag() {
//        dataLayer.push(arguments);
//    }
//    gtag('js', new Date());
//
// onclick="genero1.disabled = false"
// 
//    gtag('config', 'UA-23581568-13');
</script>

<script>

    $(function () {
        $("input[name=tipo]").click(function () {
            //alert("La opcion seleccionada es: " + $('input:radio[name=tipo]:checked').val());
            var opcion =  $('input:radio[name=tipo]:checked').val();
            //alert ("Opcion es:" + opcion);
            //alert("La opcion seleccionada es: " + $(this).val());
            if (opcion === "Persona") {
                //alert ("Opcion es:" + opcion);
                $("input[name=genero]").attr("disabled", false);
                //alert("La opcion seleccionada es: " + $('input:radio[name=tipo]:checked').val());
            } else {
                //$("input[name=genero]").attr("checked", false);
                $("input[name=genero]").attr("disabled", true);
            }
        });
    });

    $(function () {
        $("#grupoInteres").change(function () {
            if ($(this).val() === "Otro") {
                $("#otro").prop("disabled", false);
            } else {
                $("#otro").prop("disabled", true);
            }
        });
    });
</script>


</script>

</body>
</html>
