
var baseurl = 'http://localhost/mycole/';

$(document).ready(function() {

    moment.locale('es');
    var hoy = moment(new Date(), "DD MMMM YYYY");
    var mesactual = hoy.format("MMMM");
    var anioactual = hoy.format("YYYY");


    var meses=["ENERO", "FEBRERO", "MARZO", "ABRIL", "MAYO", "JUNIO", "JULIO", "AGOSTO","SEPTIEMBRE", "OCTUBRE", "NOVIEMBRE", "INSCRIPCION", "SEGURO"];


    $("table.tablajax").hide()

    $("#importar").click(function () {

        window.open(baseurl + 'pago/uploadexcel', '_blank')
    });

    //FUNCION PARA BUSCAR UN ESTUDIANTE EN EL AREA DE PAGOS
    var consulta;
//hacemos focus al campo de búsqueda
    $("#nombresAlumno").focus();
//comprobamos si se pulsa una tecla
    $("#nombresAlumno").keyup(function (e) {

        //ocultamos la tabla principal
        $("table.tablajax").hide();

        //eliminamos el estudiante mostrado anteriormente
        $("td.estudiante").remove()
        //obtenemos el texto introducido en el campo de búsqueda
        consulta = $("#nombresAlumno").val();

        //hace la búsqueda
        if (consulta != "" ) {
            $.post(baseurl + 'ajaxsearch/searchestudianteajax', {nombre: consulta}, function (mensaje) {
                if (mensaje != '') {
                    $("#resultadoBusqueda").show();
                    $("#resultadoBusqueda").html(mensaje);

                } else {
                    $("#resultadoBusqueda").html('');

                }

            });
        }
    });
//FIN FUNCION PARA BUSCAR UN ESTUDIANTE EN EL AREA DE PAGOS


    //aca ya reemplzamos la funcion .live por .on para capturar click sobre elementos
    //creados dinamicamente

    $( document ).on( "click", ".estudianteajax", function (e) {
        //var mesesupdate = [];

        var monto= 0;
        var total = 0;

        e.preventDefault();
        $("table.tablajax").show();
        $("#resultadoBusqueda").hide();
        $("#nombresAlumno").val('');

        //$("a.btn"+ nombreboton).attr('href', '').css({'cursor': 'wait', 'pointer-events' : 'none',  'background': 'red'});

        var idestudiante = $(this).data("id");
        var codcoope = $(this).data("codcoope");

        var nombreestudiante = $(this).data("nombre");


        $("#mostrarestudiantes").append('<td align="center" class="estudiante" data-codigo=' + codcoope + ' >'+ codcoope +'</td>',
                                        '<td id="nombres" align="center" class="estudiante" data-id=' + idestudiante + ' ><a href="" title="Informacion" >'+ nombreestudiante +'</a></td>',
                                        '<td id="estado" align="center" class="estudiante danger" ><a href="" title="Informacion" ><i class="fa fa-user"></i></a></td>',

                                        '<td align="center" class="estudiante text" data-id=' + idestudiante + ' ><a id="mostrarhis"  data-toggle="modal" data-target="#modalhistorialestudiante" data-nombre='+ nombreestudiante +' data-codcoope='+codcoope+'  class="btn btn-info btn-sm historial "  title="Historial Pagos"><i class="fa  fa-bar-chart ">  Historial</i></a></td>');

        //PETICION QUE VERIFICA CADA MES DEL ANIO CON TODOS LOS MESES DE TABLA DE PAGOS GENERALES, IMPORTADOS DESDE EXCEL
        $.each(meses, function (a, mes) {
            $.ajax({
                type: "POST",
                url: baseurl + 'ajaxsearch/getEncuentraMes',
                dataType: 'json',
                data: {codcoope: codcoope, ano: anioactual, mes:mes},
                success: function (res) {

                    if (res ) {

                        $("td#estado").addClass("btn btn-success btn-sm").text("Solvente");



                    }
                    else {
                        $("td#estado").addClass("btn btn-danger btn-sm").text("Insolvente");



                    }

                }

            });

        });


    });


    //funcion para mostrar el historial de un estudiante cuando de presione el boton historial
    $( document ).on( "click", "#mostrarhis", function (e) {
        e.preventDefault();
        $("#anioestudiante").val("");



        $("li#idpago").remove();
        var codcoope = $(this).data("codcoope");


        //otener el nombre completo del estudiante, enviando el codigo de coope
        $.ajax({
            type: "POST",
            url: baseurl + 'ajaxsearch/getNombresEstudiante',
            dataType: 'json',
            data: {codcoope: codcoope},
            success: function (res1) {

                if (res1) {

                       var nombre = res1.nombre +' ' + res1.apellido;

                    $("#labelnombrestudiante").text("PAGOS DEL ESTUDIANTE "+nombre);

                }
                else {
                    console.log("No hay datos");
                }

            }
        });

        $.ajax({
            type: "POST",
            url: baseurl + 'ajaxsearch/historialanoajax',
            dataType: 'json',
            data: {codcoope: codcoope, ano: anioactual},
            success: function (res) {

                if (res) {
                    console.log(res);
                    $.each(res, function (j, val) {

                        $("tr#cabeceratablahistorial").show();

                            $("#resultados").append('<tr id="pago"><td data-id=' + val.nofactura + '  id=pago>' + val.mes + '' +
                                '<td >' + val.valorpagado + '</td>' +
                                '<td >' + val.fechapago + '</td></tr>').hover(function () {

                                $(this).css("cursor", "pointer");
                            }, function () {
                                $(this).css("cursor", "hand");

                            });

                        if (val.mes === "SEGURO"){
                            $("tr#pago").eq(j).addClass("text-primary");
                        }
                        if (val.mes === "INSCRIPCION"){
                            $("tr#pago").eq(j).addClass("text-primary");
                        }

                    });


                }
                else {
                    $("tr#cabeceratablahistorial").hide();
                    $("#resultados").append('<tr class="text-danger" id="pago"><td>NO SE ENCONTRARON PAGOS PARA ESTE ESTUDIANTE</td></tr>');
                    console.log("No hay datos");
                }

            }
        });

        //si se elije un anio diferente al actual
        if ($("#anioestudiante").change(function () {

                anio = $(this).val();
                //limpiamos la cadena del input, solo tomamos los ultimos 4 caracteres
                anilimpiio = anio.substr(-4,4);
                $("tr#pago").empty();

                $.ajax({
                    type: "POST",
                    url: baseurl + 'ajaxsearch/historialanoajax',
                    dataType: 'json',
                    data: {codcoope: codcoope, ano: anilimpiio},
                    success: function (res) {

                        if (res) {
                            console.log(res);
                            $.each(res, function (h, val) {


                                $("tr#cabeceratablahistorial").show();

                                $("#resultados").append('<tr id="pago"><td data-id=' + val.nofactura + '  id=pago>' + val.mes + '' +
                                    '<td >' + val.valorpagado + '</td>' +
                                    '<td >' + val.fechapago + '</td></tr>').hover(function () {

                                    $(this).css("cursor", "pointer");
                                }, function () {
                                    $(this).css("cursor", "hand");

                                });

                                if (val.mes === "SEGURO"){
                                    $("tr#pago").eq(h).addClass("text-primary");
                                }
                                if (val.mes === "INSCRIPCION"){
                                    $("tr#pago").eq(h).addClass("text-primary");
                                }

                            });

                        }
                        else {
                            $("tr#cabeceratablahistorial").hide();
                            $("#resultados").append('<tr class="text-danger" id="pago"><td>NO SE ENCONTRARON PAGOS PARA ESTE ESTUDIANTE</td></tr>');
                            console.log("No hay datos");
                        }

                    }
                });
            }));

    });

    //obtener el anio del archivo de excel a subir
    $(function () {
        $("#anioexcel").datepicker({
            format: " yyyy",
            viewMode: "years",
            minViewMode: "years"


        });

    });

    //anio para mostrar historial en el modal
    $(function () {
        $("#anioestudiante").datepicker({
            format: " yyyy",
            viewMode: "years",
            minViewMode: "years"


        });

    });


    //si se cierra la ventana modal elimina los alimentos mostrados anteriormente
    $( document ).on( "click", "#btncerrarmodalhistorial", function (e) {
        $("tr#pago").remove();
    });

    //si se presiona el boton de listo en la ventana modal se eliminan los alimentos mostrados anteriormen
    $( document ).on( "click", "#btnconfirmarmodalhistorial", function (e) {
        $("tr#pago").remove();
    });
}); // fin $(document).ready..

// fin del archivo historialAjaxEstudiante.js