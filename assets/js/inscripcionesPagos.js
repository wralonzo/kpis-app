$(document).ready(function() {

    moment.locale('es');
    var hoy = moment(new Date(), "DD MMMM YYYY");
    var mesactual = hoy.format("MMMM");
    var anioactual = hoy.format("YYYY");

    $(function () {
        $("#cicloescolar").datepicker({
            format: " yyyy",
            viewMode: "years",
            minViewMode: "years"

        });

    });

    $(function () {
        $("#anioInscripcion").datepicker({
            format: " yyyy",
            viewMode: "years",
            minViewMode: "years"

        });

    });

    $(function () {
        $("#anioInscripcion").val(anioactual);
    })


    $('#slccarrera').on('change', function() {
    //$("#slccarrera").change(function () {

        $("#resultadosinscripciones").empty();
       var grado = $("#slcgrado").val();
       var carrera = $(this).val();
       var anio = $("#anioInscripcion").val();


       var aniolimpio = anio.substr(-4,4);

        $.ajax({
            type: "POST",
            url: baseurl + 'inscripcion/getGradoCarreraAnio',
            dataType: 'json',
            data: {grado: grado, carrera:carrera, anio:aniolimpio},
            success: function (res) {

                if (res!==false) {
                    console.log(res);
                    $.each(res, function (j, val) {

                        var id = j+=1;
                        $("#resultadosinscripciones").append('<tr id="inscripcion"><td align="center" id=pago>'+ id+' </td>' +
                            '<td align="center" data-id=' + val.codcoope + '  id=pago>' + val.codcoope + '' +
                            '<td align="center">' + val.nombre + ' '+val.apellido+'</td>' +
                            '<td align="center">' + val.Fecha+'</td>' +
                            '<td align="center">' + val.cicloescolar + '</td>' +
                            '<td align="center">' + val.montoinscripcion + '</td>'+
                            '<td align="center">' + val.montoseguro + '</td>'+
                            '<td align="center">' + val.montomensual + '</td>'+
                            '<td align="center"><a href="inscripcion/editar/'+val.idInscripcion+'"><i class="fa fa-edit fa-2x"></i> </a> </td>' +
                            '<td align="center"><a href="inscripcion/getTrasladar/'+val.idInscripcion+'"><i class="fa fa-spinner fa-spin fa-2x" aria-hidden="true"></i> </a> </td></tr>');

                    });
                }
                else {
                    //$("#resultadosinscripciones").append('<tr class="text-danger" id="inscripcion"><td class="text-danger">NO SE ENCONTRARON INSCRIPCIONES</td></tr>');
                    swal("Lo sentimos!", "No se encontraron inscripciones", "error")
                }

            }
        });
    });

    $('#slcgrado').on('change', function() {
    //$("#slcgrado").change(function () {

        $("#resultadosinscripciones").empty();
        var grado = $("#slcgrado").val();
        var carrera = $(this).val();
        var anio = $("#anioInscripcion").val();


        var aniolimpio = anio.substr(-4,4);

        $.ajax({
            type: "POST",
            url: baseurl + 'inscripcion/getGradoCarreraAnio',
            dataType: 'json',
            data: {grado: grado, carrera:carrera, anio:aniolimpio},
            success: function (res) {

                if (res!==false) {
                    console.log(res);
                    $.each(res, function (j, val) {

                        var id = j+=1;
                        $("#resultadosinscripciones").append('<tr id="inscripcion"><td align="center" id=pago>'+ id+' </td>' +
                            '<td align="center" data-id=' + val.codcoope + '  id=pago>' + val.codcoope + '' +
                            '<td align="center">' + val.nombre + ' '+val.apellido+'</td>' +
                            '<td align="center">' + val.Fecha+'</td>' +
                            '<td align="center">' + val.cicloescolar + '</td>' +
                            '<td align="center">' + val.montoinscripcion + '</td>'+
                            '<td align="center">' + val.montoseguro + '</td>'+
                            '<td align="center">' + val.montomensual + '</td>'+
                            '<td align="center"><a href="inscripcion/editar/'+val.idInscripcion+'"><i class="fa fa-edit fa-2x"></i> </a> </td>' +
                            '<td align="center"><a href="inscripcion/getTrasladar/'+val.idInscripcion+'"><i class="fa fa-spinner fa-spin fa-2x" aria-hidden="true"></i> </a> </td></tr>');

                    });
                }
                else {
                    //$("#resultadosinscripciones").append('<tr class="text-danger" id="inscripcion"><td class="text-danger">NO SE ENCONTRARON INSCRIPCIONES</td></tr>');
                    swal("Lo sentimos!", "No se encontraron inscripciones", "error")
                }

            }
        });
    });

    //ACTUALIZAR ALGUN ESTUDIANTE
    $("#editar_inscripcion_form").submit(function (e) {
        e.preventDefault();
        swal({
                title: "Esta operación no se puede deshacer",
                text: "Está seguro de esto?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Sí, Continuar!",
                cancelButtonText: "No, Cancelar!",
                closeOnConfirm: false,
                closeOnCancel: true
            },
            function  (isConfirm) {
                if (isConfirm) {

                    $.ajax({
                        type: 'POST',
                        url: $("#editar_inscripcion_form").attr('action'),
                        data: $("#editar_inscripcion_form").serialize()

                    });


                    swal("Listo!", "La información del estudiante ha sido modificada", "success");
                    window.location = baseurl+"inscripcion";


                }else{

                    return false;
                }
            });
    });

    $("#trasladar_form").submit(function (e) {
        e.preventDefault();
        var idestudiante = $("#idestudiante").val();
        var cicloescolar = $("#cicloescolar").val();
        console.log(idestudiante);
        console.log(cicloescolar);

        $.ajax({
            type: "POST",
            url: baseurl + 'inscripcion/getVerificarInscripcion',
            dataType: 'json',
            data: {idestudiante: idestudiante, cicloescolar:cicloescolar},
            success: function (res) {

                if (res) {

                    swal("Lo sentimos!", "Este estudiante ya esta inscrito en el ciclo escolar "+cicloescolar, "error")
                    return false;

                }else {
                    swal({
                            title: "Esta operación no se puede deshacer",
                            text: "Está seguro de esto?",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Sí, Continuar!",
                            cancelButtonText: "No, Cancelar!",
                            closeOnConfirm: false,
                            closeOnCancel: true
                        },
                        function  (isConfirm) {
                            if (isConfirm) {

                                $.ajax({
                                    type: 'POST',
                                    url: $("#trasladar_form").attr('action'),
                                    data: $("#trasladar_form").serialize()

                                });


                                swal("Listo!", "El estudiante fue trasladado al nuevo grado con éxito", "success");
                                window.location = baseurl+"inscripcion";


                            }else{

                                return false;
                            }
                        });
                }


            }
        });


    });


    //FUNCION PARA ENCONTRAR UN ESTUDIANTE DESDE EL MENU DE INSCRIPCIONES
    var entrada;
//hacemos focus al campo de búsqueda
    $("#entradanombres").focus();
//comprobamos si se pulsa una tecla
    $("#entradanombres").keyup(function () {

        //ocultamos la tabla principal
        $("table.tablajax").hide();

        //eliminamos el estudiante mostrado anteriormente
        $("td.estudiante").remove()
        //obtenemos el texto introducido en el campo de búsqueda
        entrada = $("#entradanombres").val();

        //hace la búsqueda
        if (entrada != "" ) {
            $.post(baseurl + 'ajaxsearch/getBuscaInscripcion', {nombre: entrada}, function (mensaje) {
                if (mensaje != '') {
                    $("#inscripcionesencontradas").show();
                    $("#inscripcionesencontradas").html(mensaje);

                } else {
                    $("#inscripcionesencontradas").html('');

                }

            });
        }
    });

    $( document ).on( "click", ".inscripcionajax", function (e) {

        e.preventDefault();
        $("#resultadosinscripciones").empty();

        $("#inscripcionesencontradas").hide();
        $("#entradanombres").val('');


        var idestudiante = $(this).data("id");

            $.ajax({
                type: "POST",
                url: baseurl + 'ajaxsearch/getDetalleInscripcionAjax',
                dataType: 'json',
                data: {idestudiante: idestudiante, anio:anioactual},
                success: function (res) {

                    if (res ) {

                        $.each(res, function (j, val) {
                            var id = j+=1;
                            $("#resultadosinscripciones").append('<tr id="inscripcion"><td align="center" id=pago>' + id + ' </td>' +
                                '<td align="center" data-id=' + val.codcoope + '  id=pago>' + val.codcoope + '' +
                                '<td align="center">' + val.nombre + ' ' + val.apellido + '</td>' +
                                '<td align="center">' + val.fechainscripcion + '</td>' +
                                '<td align="center">' + val.cicloescolar + '</td>' +
                                '<td align="center">' + val.montoinscripcion + '</td>' +
                                '<td align="center">' + val.montoseguro + '</td>' +
                                '<td align="center">' + val.montomensual + '</td>' +
                                '<td align="center"><a href="inscripcion/editar/' + val.idInscripcion + '"><i class="fa fa-edit fa-2x"></i> </a> </td>' +
                                '<td align="center"><a href="inscripcion/getTrasladar/' + val.idInscripcion + '"><i class="fa fa-spinner fa-spin fa-2x" aria-hidden="true"></i> </a> </td></tr>');

                        });

                    }
                    else {
                        swal("Lo sentimos!", "No se encontraron inscripciones", "error")
                    }

                }

            });

    });

});