$(function () {
    $.ajaxSetup({
        error: function (err) {
            flashE("Ocurrió un Error Inesperado");
        }
    });
    $(document).keyup(function (e) {
        if (e.keyCode === 27) {
            CloseDialog();
            CloseCharm();
        }
    }).click(function (e) {
        var container = $("#charm");
        if (!container.is(e.target) && container.has(e.target).length === 0) {
            CloseCharm();
        }
    });
    $("#search").focusout(function () {
        $(".app-search a").show();
        $(".app-search div").addClass('hidden');
    }).keyup(function (event) {
        if (event.keyCode === 13) {
            Charm("/Application/search?text=" + $("#search").val());
        }
    });
    $.fn.select2.defaults.set('language', 'es');
});
function Search() {
    $(".app-search a").hide();
    $(".app-search div").removeClass('hidden');
    $("#search").focus();
}
function Titulo(tit1, tit2, back, url, icon) {
    var ico = (icon !== undefined) ? "<span class='mif-" + icon + " place-right padding20 no-padding-bottom no-padding-left'></span>" : "";
    tit2 += ico;
    var html = "";
    if (!back)
        html = '<h1>' + tit1 + '<small class="on-right"> ' + tit2 + '</small></h1><hr class="thin"/>';
    else {
        if (url !== undefined)
            html = '<h1><a href="' + url + '"><span class="mif-arrow-left fg-dark"></span></a> ' + tit1 + '<small class="on-right"> ' + tit2 + '</small></h1><hr class="thin"/>';
        else
            html = '<h1><a href="javascript: window.history.back()"><span class="mif-arrow-left fg-dark"></span></a> ' + tit1 + '<small class="on-right"> ' + tit2 + '</small></h1><hr class="thin"/>';
    }
    $("#contenido").prepend(html);
}

function Contenido(item, elem) {
    $(elem).load(item);
}
/* ---------------------------------------------MÉTODOS---------------------------------------------- */
function Charm(url) {
    var charm = $("#charm").data('charm');
    charm.open();
    $("#charm").html("<div class='align-center'><h1>Cargando</h1><hr class='thin'><div data-role='preloader' data-type='metro'></div></div>");
    $.get(url, function (data) {
        $("#charm").html(data);
    });
}
function flashS(text) {
    $.Notify({
        caption: 'Éxito',
        content: text,
        icon: '<span class="mif-checkmark"></span>',
        type: 'success'
    });
}
function flashI(text) {
    $.Notify({
        caption: 'Información',
        content: text,
        icon: '<span class="mif-info"></span>',
        type: 'info'
    });
}
function flashW(text) {
    $.Notify({
        caption: 'Alerta',
        content: text,
        icon: '<span class="mif-warning"></span>',
        type: 'warning'
    });
}
function flashE(text) {
    $.Notify({
        caption: 'Error',
        content: text,
        icon: '<span class="mif-cross"></span>',
        type: 'alert'
    });
}
function ChecarEstado(nombre) {
    var elem = $(nombre);
    LimpiarEstado(nombre);
    if (elem.val() === "" || elem.val() === " ") {
        elem.parent().addClass("error-state");
        elem.attr("placeholder", "Llene este campo");
        return false;
    } else {
        EstadoSuccess(nombre);
        return true;
    }
}
function ChecarCorreo(nombre) {
    var campo = $(nombre);
    LimpiarEstado(nombre);
    var filter = /[\w-\.]{3,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
    if (filter.test(campo.val())) {
        LimpiarEstado(nombre);
        EstadoSuccess(nombre);
        return true;
    } else {
        campo.parent().addClass("error-state");
        campo.attr("placeholder", "Llene este campo");
        return false;
    }
}
function ChecarNumeroPositivo(nombre) {
    var valor = $(nombre).val();
    LimpiarEstado(nombre);
    if (isNaN(valor) || valor < 0 || valor === "") {
        EstadoError(nombre, "Favor de escribir sólo números positivos");
        return false;
    } else {
        EstadoSuccess(nombre);
        return true;
    }
}
function ChecarEstadoCheckbox(nombre) {
    if ($("input[name='" + nombre + "']:checked").length < 1) {
        $("input[name='" + nombre + "']").parent().css("color", "red");
        return false;
    } else {
        $("input[name='" + nombre + "']").parent().css("color", "green");
        return true;
    }
}
function ChecarEstadoSelect(nombre) {
    var elem = $(nombre + " option:selected").val();
    LimpiarEstado(nombre);
    if (elem !== "0" || elem != 0) {
        EstadoSuccess(nombre);
        return true;
    } else {
        EstadoError(nombre);
        return false;
    }
}
function ChecarEstadoCaracteres(nombre, nCar) {
    var elem = $(nombre);
    LimpiarEstado(nombre);
    if (elem.val() === "" || elem.val() === " " || elem.val().length < nCar) {
        elem.parent().addClass("error-state");
        elem.attr("placeholder", "Llene este campo");
        return false;
    } else {
        EstadoSuccess(nombre);
        return true;
    }
}
function ChecarEstadoCantidad(nombre, cant) {
    var elem = $(nombre);
    LimpiarEstado(nombre);
    if (elem.val() === "" || (elem.val() * 1) <= cant) {
        elem.parent().addClass("error-state");
        elem.attr("placeholder", "Llene este campo");
        return false;
    } else {
        EstadoSuccess(nombre);
        return true;
    }
}
function EstadoError(nombre, texto) {
    LimpiarEstado(nombre);
    $(nombre).parent().addClass("error");
    $(nombre).attr("placeholder", texto);
}
function EstadoSuccess(nombre) {
    LimpiarEstado(nombre);
    $(nombre).parent().addClass("success");
}
function LimpiarEstado(nombre) {
    $(nombre).parent().removeClass("success");
    $(nombre).parent().removeClass("error");
    $(nombre).parent().removeClass("warning");
    $(nombre).parent().removeClass("info");
    $(nombre).attr("placeholder", "");
}
function RemoverDefault(nombre) {
    $(nombre).change(
            function () {
                $(nombre + " option[value=-1]").remove();
                $(nombre + " option[value=0]").remove();
                $(nombre + " option[value='-1']").remove();
                $(nombre + " option[value='0']").remove();
            }
    );
}
function Loading(nombre, size, legend) {
    $(nombre).html("<center class='fg-teal'><span class='mif-spinner4 mif-ani-spin' style='font-size: " + size + "px'></span>" + (legend ? "<br><strong style='font-size: " + size / 3 + "px'>Cargando</strong></center>" : ""));
}
function LoadingLine(nombre) {
    $(nombre).html("<center><img src='/public/img/loading.gif'/></center>");
}
function CargarContenido(nombre, liga) { 
    if (!$(nombre).hasClass("cargado")) { 
        $(nombre).addClass("cargado"); 
        $(nombre).load(liga); 
    } 
}
function CargarContenidoP(nombre, liga, param) { 
    if (!$(nombre).hasClass("cargado")) { 
        $(nombre).addClass("cargado");
        $(nombre).load(liga, param); 
    } 
}
function CargarContDialog(liga) {
    window.location.href = liga;
}
function VentanaPlana(item, title, icon) {
    $.get(item,
            function (data) {
                $.Dialog({
                    shadow: true,
                    overlay: true,
                    draggable: true,
                    icon: '<span class="icon-' + icon + '"></span>',
                    title: title,
                    content: data
                });
            });
}
function VentanaBase(item, title, icon) {
    $.get(item, function (data) {
        $("#dialog-title").html(title);
        $("#dialog-content").html(data);
        $("#dialog-icon").addClass("mif-" + icon);
        var dialog = $("#dialog").data('dialog');
        dialog.open();
    });
}
function VentanaContenido(content, title, icon) {
    $("#dialog-title").html(title);
    $("#dialog-content").html(content);
    $("#dialog-icon").addClass("mif-" + icon);
    var dialog = $("#dialog").data('dialog');
    dialog.open();
}
function Ventana(item, title, icon, alto, ancho) {
    $.get(item,
            function (data) {
                $.Dialog({
                    shadow: true,
                    overlay: true,
                    draggable: true,
                    icon: '<span class="icon-' + icon + '"></span>',
                    title: title,
                    width: ancho,
                    height: alto,
                    content: '<div style="height: ' + alto + 'px; overflow-y: auto; overflow-x: hidden; padding: 15px;">' + data + "</div>"
                });
            });
}
function CloseDialog() {
    $("#dialog-content").html("");
    hideMetroDialog('#dialog');
}
function CloseCharm() {
    var charm = $("#charm").data('charm');
    charm.close();
}
function ComboBusqueda(nombre) {
    $(nombre).chosen();
    $(nombre + "_chosen").css("width", "100%");
}
function TablaDinamicaDefault(nombre) {
    $(nombre).dataTable({
        "aLengthMenu": [[10, 50, 100, 250, 500, -1], [10, 50, 100, 250, 500, "Todos"]],
        "bJQueryUI": false,
        "oLanguage": {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sInfo": "Mostrando desde _START_ hasta _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando desde 0 hasta 0 de 0 registros",
            "sInfoFiltered": "(filtrado de _MAX_ registros en total)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "oPaginate": {
                "sFirst": "Primero",
                "sPrevious": "Anterior",
                "sNext": "Siguiente",
                "sLast": "�ltimo"
            }
        }
    });

}
function TablaDinamica(nombre) {
    $(nombre).dataTable({
        "bJQueryUI": false,
        "bPaginate": false,
        "oLanguage": {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sInfo": "Mostrando desde _START_ hasta _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando desde 0 hasta 0 de 0 registros",
            "sInfoFiltered": "(filtrado de _MAX_ registros en total)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "oPaginate": {
                "sFirst": "Primero",
                "sPrevious": "Anterior",
                "sNext": "Siguiente",
                "sLast": "�ltimo"
            }
        }
    });
}
function ChartPie(nombre, titulo, datos) {
    $(nombre).highcharts({
        chart: {
            type: 'pie',
            options3d: {
                enabled: true,
                alpha: 45
            }
        },
        title: {
            text: titulo
        },
        tooltip: {
            pointFormat: 'Porcentaje: <b>{point.percentage:.2f}%</b><br>Cantidad: <b>{point.y}</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                depth: 35,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false
                },
                showInLegend: true
            }
        },
        series: [{
                type: 'pie',
                data: datos
            }]
    });
}
function ChartColumn(nombre, titulo, categorias, datos) {
    $(nombre).highcharts({
        chart: {
            type: 'column',
            margin: 75
        },
        title: {
            text: titulo
        },
        xAxis: {
            categories: categorias
        },
        plotOptions: {
            column: {
                dataLabels: {
                    enabled: true
                }
            }
        },
        yAxis: {
            opposite: true
        },
        series: datos
    });
}
function ChartBar(nombre, titulo, columna, texto, post, rotacion, colorTexto, xTexto, yTexto, datos) {
    $(function () {
        $(nombre).highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: titulo
            },
            xAxis: {
                type: 'category',
                labels: {
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: columna
                }
            },
            legend: {
                enabled: false
            },
            tooltip: {
                pointFormat: texto + '<b>{point.y:.1f} ' + post + '</b>'
            },
            series: [{
                    data: datos,
                    dataLabels: {
                        enabled: true,
                        color: colorTexto,
                        rotation: rotacion,
                        align: 'right',
                        x: xTexto,
                        y: yTexto,
                        style: {
                            fontSize: '13px',
                            fontFamily: 'Verdana, sans-serif'
                        }
                    }
                }]
        });
    }
    );
}
function chart(nombre, titulo, columna, texto, post, rotacion, colorTexto, xTexto, yTexto, datos) {
    $(function () {
        $(nombre).highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: titulo
            },
            xAxis: {
                type: 'category',
                labels: {
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: columna
                }
            },
            legend: {
                enabled: false
            },
            tooltip: {
                pointFormat: texto + '<b>{point.y:.1f} ' + post + '</b>'
            },
            series: [{
                    data: datos,
                    dataLabels: {
                        enabled: true,
                        color: colorTexto,
                        rotation: rotacion,
                        align: 'right',
                        x: xTexto,
                        y: yTexto,
                        style: {
                            fontSize: '13px',
                            fontFamily: 'Verdana, sans-serif'
                        }
                    }
                }]
        });
    }
    );
}
function EliminarEspeciales(nombre) {
    $(nombre).val($(nombre).val().replace(/[^a-zA-Z 0-9.]+/g, ''));
}
function Imprimir(nombre) {
    $(nombre).printArea();
}
function ExportToExcel(elem) {
    window.open('data:application/vnd.ms-excel,' + escape(document.getElementById(elem).outerHTML));
}
function ObtenerValoresCheck(clase) {
    var fin = [];
    $('input:checkbox.' + clase).each(function () {
        if (this.checked)
            fin.push($(this).val());
    });
    return fin;
}
function Contador(name) {
    $(name).each(function () {
        $(this).prop('Counter', 0).animate({
            Counter: $(this).text()
        }, {
            duration: 1000,
            easing: 'swing',
            step: function (now) {
                $(this).text(Math.ceil(now));
            }
        });
    });
}
var position = 1;
function bottonesStepper(limite) {
    $("#stepN").attr("disabled", "");
    $("#stepP").attr("disabled", "");
    if (position < limite)
        $("#stepN").removeAttr("disabled");
    if (position > 1)
        $("#stepP").removeAttr("disabled");
}
function MoverStepper(tipo, elem, limite) {
    $('#stepper').stepper(tipo);
    $(elem + position).toggle();
    if (tipo != 'next')
        position--;
    else
        position++;
    $(elem + position).toggle();
    bottonesStepper(limite);
}
var _MS_PER_DAY = 1000 * 60 * 60 * 24;

function dateDiffInDays(a, b) {
    var utc1 = Date.UTC(a.getFullYear(), a.getMonth(), a.getDate());
    var utc2 = Date.UTC(b.getFullYear(), b.getMonth(), b.getDate());
    return Math.floor((utc2 - utc1) / _MS_PER_DAY);
}