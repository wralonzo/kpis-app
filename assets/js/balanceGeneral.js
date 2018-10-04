$(document).ready(function() {

    //obtener el anio del archivo de excel a subir
    $(function () {
        $("#aniobalance").datepicker({
            format: " yyyy",
            viewMode: "years",
            minViewMode: "years"

        });

    });


    $("#aniobalance").click( function () {
        $('#aniobalance').on('change', function() {

            anio = $(this).val();
            //limpiamos la cadena del input, solo tomamos los ultimos 4 caracteres
            anilimpiio = anio.substr(-4,4);
            $("#resultadosbalancegeneral").empty();
            $("tr.balance").remove();

            $.ajax({
                type: "POST",
                url: baseurl + 'reporte/getBalanceGenealAnio',
                dataType: 'json',
                data: {anio: anilimpiio},
                success: function (res) {

                    if (res.mora !=0) {

                        var ingresos = res.tienda+=res.libreria;
                        var egresos = res.planilla+=res.bus;
                        $("#resultadosbalancegeneral").append('<tr class="balance"><td align="center">Mora</td><td align="center" >' + res.mora + ' </td></tr>' +
                            '<tr class="balance"><td align="center">Planilla</td><td align="center">' + res.planilla + '</td></tr>' +
                            '<tr class="balance"><td align="center">Ingresos Tienda</td><td align="center"> ' + res.tienda + '</td></tr>' +
                            '<tr class="balance"><td align="centr">Buses</td><td align="center">' + res.bus + '</td></tr>' +
                            '<tr class="balance"><td align="center">Libreria</td><td align="center">' + res.libreria + '</td></tr>'+
                            '<tr class="balance"><td align="center">Total Ingresos</td><td align="center">' + ingresos + '</td></tr>'+
                            '<tr class="balance"><td align="center">Total Egresos</td><td align="center">' + egresos + '</td></tr>'

                           );

                    }
                    else {
                        $("#resultadosbalancegeneral").empty();
                        swal("Lo sentimos!", "No hay mora", "error")
                    }

                }
            });
        });
    });

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
});
