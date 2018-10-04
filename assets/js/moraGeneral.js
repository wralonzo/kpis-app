$(document).ready(function() {

    //obtener el anio del archivo de excel a subir
    $(function () {
        $("#aniomorageneral").datepicker({
            format: " yyyy",
            viewMode: "years",
            minViewMode: "years"

        });

    });


    $("#aniomorageneral").click( function () {
        $('#aniomorageneral').on('change', function() {

            anio = $(this).val();
            //limpiamos la cadena del input, solo tomamos los ultimos 4 caracteres
            anilimpiio = anio.substr(-4,4);
            $("tr#totalmorageneral").empty();

            $.ajax({
                type: "POST",
                url: baseurl + 'reporte/getMoraAnioDeterminado',
                dataType: 'json',
                data: {anio: anilimpiio},
                success: function (res) {

                    if (res !=0) {

                            $("#totalmorageneral").append('<td  align="center" >' + anilimpiio + '</td>',
                                '<td  align="center"  ><a href="" title="Informacion" >Q ' + res + '</a></td>');

                    }
                    else {
                        $("tr#totalmorageneral").empty();
                        swal("Lo sentimos!", "No hay datos", "error")
                    }

                }
            });
        });
    });


});
