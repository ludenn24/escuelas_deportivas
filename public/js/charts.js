

identificador = $('#identificador').val();

if (identificador == "georeferenciados") {
    RacionesRotalesGeorreferenciadas();
    OllasTotalesGeorreferenciadas();
    PrecioPromedio();
    Top5distritosgeo();
    OllasAtendidasPordistrito();
    Accesoagua();
    Accesoluz();
    Beneficiarios();
} else if (identificador == "atendidas") {
    OllasTotalesAtendidas();
    RacionesTotalesAtendidas();
    OllasAtendidasPordistrito();
    Ollasatendidas();
    Top5distritos();
    RacionesPorDistrito();
}

function Parametros() {
    tipo_lima = $('#obj_tipo').val();
    tipo_distrito = $('#obj_distrito').val();
    OllasTotalesAtendidas(tipo_lima, tipo_distrito);
    RacionesTotalesAtendidas(tipo_lima, tipo_distrito);
    OllasAtendidasPordistrito(tipo_lima, tipo_distrito);
    Ollasatendidas(tipo_lima, tipo_distrito);
    Top5distritos(tipo_lima, tipo_distrito);
    RacionesPorDistrito(tipo_lima, tipo_distrito);
}

function Parametros2() {
    tipo_lima = $('#obj_tipo').val();
    tipo_distrito = $('#obj_distrito').val();
    obj_ano = $('#obj_ano').val();
    RacionesRotalesGeorreferenciadas(tipo_lima, tipo_distrito, obj_ano);
    OllasTotalesGeorreferenciadas(tipo_lima, tipo_distrito, obj_ano);
    PrecioPromedio(tipo_lima, tipo_distrito);
    Top5distritosgeo(tipo_lima, tipo_distrito);
    OllasAtendidasPordistrito(tipo_lima, tipo_distrito);
    Accesoagua(tipo_lima, tipo_distrito);
    Accesoluz(tipo_lima, tipo_distrito);
    Beneficiarios(tipo_lima, tipo_distrito);
}

function am4themes_animated(target) {
    if (target instanceof am4core.ColorSet) {
        target.list = [
            am4core.color("#bb711b"),
            am4core.color("#084782"),
            am4core.color("#12a8a0"),
            am4core.color("#f7a616"),
            am4core.color("#bfbfbf"),
            am4core.color("#bb711b"),
            am4core.color("#084782"),
            am4core.color("#12a8a0"),
            am4core.color("#f7a616"),
            am4core.color("#bfbfbf"),
            am4core.color("#bb711b"),
            am4core.color("#084782"),
            am4core.color("#12a8a0"),
            am4core.color("#f7a616"),
            am4core.color("#bfbfbf"),
            am4core.color("#bb711b"),
            am4core.color("#084782"),
            am4core.color("#12a8a0"),
            am4core.color("#f7a616"),
            am4core.color("#bfbfbf"),
            am4core.color("#bb711b"),
            am4core.color("#084782"),
            am4core.color("#12a8a0"),
            am4core.color("#f7a616"),
            am4core.color("#bfbfbf"),
            am4core.color("#bb711b"),
            am4core.color("#084782"),
            am4core.color("#12a8a0"),
            am4core.color("#f7a616"),
            am4core.color("#bfbfbf"),
            am4core.color("#bb711b"),
            am4core.color("#084782"),
            am4core.color("#12a8a0"),
            am4core.color("#f7a616"),
            am4core.color("#bfbfbf"),
        ];
    }
}

function OllasTotalesAtendidas(tipo_lima, tipo_distrito) {
    $.ajax({
        url: 'ollastotalesatendidas',
        type: 'GET',
        data: {
            lima: tipo_lima,
            distrito: tipo_distrito,
        },
        success: function (data) {
            $.each(data, function (i, item) {
                $(".counterollastotalesatendidas").html(item.total);
                $('.counterollastotalesatendidas').counterUp({
                });
            });
        },
        error: function () {
        }
    })
}

function RacionesRotalesGeorreferenciadas(tipo_lima, tipo_distrito, obj_ano) {
    $.ajax({
        url: 'racionestotalesgeorreferenciadas',
        type: 'GET',
        data: {
            lima: tipo_lima,
            distrito: tipo_distrito,
            anio: obj_ano,
        },
        success: function (data) {
            $.each(data, function (i, item) {
                $(".counterracionestotalesgeorreferenciadas").html(item.total);
                $('.counterracionestotalesgeorreferenciadas').counterUp({
                });
            });
        },
        error: function () {
        }
    })
}

function OllasTotalesGeorreferenciadas(tipo_lima, tipo_distrito, obj_ano) {
    $.ajax({
        url: 'ollastotalesgeorreferenciadas',
        type: 'GET',
        data: {
            lima: tipo_lima,
            distrito: tipo_distrito,
            anio: obj_ano,
        },
        success: function (data) {
            $.each(data, function (i, item) {
                $(".counterollastotalesgeorreferenciadas").html(item.total);
                $('.counterollastotalesgeorreferenciadas').counterUp({
                });
            });
        },
        error: function () {
        }
    })
}

function RacionesTotalesAtendidas(tipo_lima, tipo_distrito) {
    $.ajax({
        url: 'racionestotalesatendidas',
        type: 'GET',
        data: {
            lima: tipo_lima,
            distrito: tipo_distrito,
        },
        success: function (data) {
            $.each(data, function (i, item) {
                $(".counterracionestotalesatendidas").html(item.total);
                $('.counterracionestotalesatendidas').counterUp({
                });
            });
        },
        error: function () {
        }
    })
}

function PrecioPromedio(tipo_lima, tipo_distrito) {
    $.ajax({
        url: 'preciopromedio',
        type: 'GET',
        data: {
            lima: tipo_lima,
            distrito: tipo_distrito,
        },
        success: function (data) {
            am4core.useTheme(am4themes_animated);
            var chart = am4core.create("preciopromedio", am4charts.XYChart);
            chart.data = data;
            var valueAxisX = chart.xAxes.push(new am4charts.ValueAxis());
            valueAxisX.renderer.ticks.template.disabled = true;
            valueAxisX.renderer.axisFills.template.disabled = true;
            var valueAxisY = chart.yAxes.push(new am4charts.ValueAxis());
            valueAxisY.renderer.ticks.template.disabled = true;
            valueAxisY.renderer.axisFills.template.disabled = true;
            var series = chart.series.push(new am4charts.LineSeries());
            series.dataFields.valueX = "cantidad";
            series.dataFields.valueY = "promedio";
            series.dataFields.value = "nombre";
            series.strokeOpacity = 0;
            series.sequencedInterpolation = true;
            series.tooltip.pointerOrientation = "vertical";
            var bullet = series.bullets.push(new am4core.Circle());
            //bullet.fill = am4core.color("#004783");
            //bullet.propertyFields.fill = "color";
            bullet.strokeOpacity = 0;
            bullet.strokeWidth = 2;
            bullet.fillOpacity = 0.5;
            bullet.stroke = am4core.color("#ffffff");
            bullet.hiddenState.properties.opacity = 0;
            bullet.tooltipText = "[bold]{nombre}[/]\nRaciones: {valueX.value}\nPromedio de costo: {valueY.value}";
            var outline = chart.plotContainer.createChild(am4core.Circle);
            outline.fillOpacity = 0;
            outline.strokeOpacity = 0.8;
            outline.stroke = am4core.color("#ff0000");
            outline.strokeWidth = 2;
            outline.hide(0);
            var blurFilter = new am4core.BlurFilter();
            outline.filters.push(blurFilter);

            bullet.events.on("over", function(event) {
                var target = event.target;
                outline.radius = target.pixelRadius + 2;
                outline.x = target.pixelX;
                outline.y = target.pixelY;
                outline.show();
            });
            bullet.events.on("out", function(event) {
                outline.hide();
            });
            var hoverState = bullet.states.create("hover");
            hoverState.properties.fillOpacity = 1;
            hoverState.properties.strokeOpacity = 1;
            series.heatRules.push({ target: bullet, min: 2, max: 60, property: "radius" });
            bullet.adapter.add("tooltipY", function (tooltipY, target) {
                return -target.radius;
            });
            chart.cursor = new am4charts.XYCursor();
            chart.cursor.behavior = "zoomXY";
            chart.cursor.snapToSeries = series;
            chart.scrollbarX = new am4core.Scrollbar();
            chart.scrollbarY = new am4core.Scrollbar();

        },
        error: function () {
        }
    })
}

function Top5distritosgeo(tipo_lima, tipo_distrito) {
    $.ajax({
        url: 'top5distritosatendidos',
        type: 'GET',
        data: {
            lima: tipo_lima,
            distrito: tipo_distrito,
        },
        success: function (data) {
            // Themes begin
            am4core.useTheme(am4themes_animated);
            // Themes end
            var chart = am4core.create("top5distritosgeo", am4charts.PieChart3D);
            chart.data = data;
            chart.hiddenState.properties.opacity = 0; // this creates initial fade-in
            chart.legend = new am4charts.Legend();
            var series = chart.series.push(new am4charts.PieSeries3D());
            series.dataFields.value = "ollas_atendidas";
            series.dataFields.category = "distrito";
            series.labels.template.disabled = true;
            series.ticks.template.disabled = true;
        },
        error: function () {
        }
    })
}

function Accesoagua(tipo_lima, tipo_distrito) {
    $.ajax({
        url: 'accesoagua',
        type: 'GET',
        data: {
            lima: tipo_lima,
            distrito: tipo_distrito,
        },
        success: function (data) {
            var chart = am4core.create("accesoagua", am4charts.PieChart3D);
            chart.hiddenState.properties.opacity = 0; // this creates initial fade-in
            chart.legend = new am4charts.Legend();
            chart.data = data;
            chart.innerRadius = 100;
            var series = chart.series.push(new am4charts.PieSeries3D());
            series.dataFields.value = "cantidad";
            series.dataFields.category = "nombre";
            series.labels.template.disabled = true;
            series.ticks.template.disabled = true;
        },
        error: function () {
        }
    })
}

function Accesoluz(tipo_lima, tipo_distrito) {
    $.ajax({
        url: 'accesoluz',
        type: 'GET',
        data: {
            lima: tipo_lima,
            distrito: tipo_distrito,
        },
        success: function (data) {
            var chart = am4core.create("accesoluz", am4charts.PieChart3D);
            chart.hiddenState.properties.opacity = 0; // this creates initial fade-in
            chart.legend = new am4charts.Legend();
            chart.data = data;
            chart.innerRadius = 100;
            var series = chart.series.push(new am4charts.PieSeries3D());
            series.dataFields.value = "cantidad";
            series.dataFields.category = "nombre";
            series.labels.template.disabled = true;
            series.ticks.template.disabled = true;
        },
        error: function () {
        }
    })
}

function Beneficiarios(tipo_lima, tipo_distrito) {
    $.ajax({
        url: 'beneficiarios',
        type: 'GET',
        data: {
            lima: tipo_lima,
            distrito: tipo_distrito,
        },
        success: function (data) {
            am4core.useTheme(am4themes_animated);
            var chart = am4core.create("beneficiarios", am4charts.XYChart);
            chart.data = data;
            var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
            categoryAxis.dataFields.category = "categoria";
            categoryAxis.renderer.grid.template.location = 0;
            categoryAxis.renderer.minGridDistance = 30;
            categoryAxis.renderer.labels.template.adapter.add("dy", function(dy, target) {
                if (target.dataItem && target.dataItem.index & 2 == 2) {
                    return dy + 25;
                }
                return dy;
            });
            var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
            var series = chart.series.push(new am4charts.ColumnSeries());
            series.dataFields.valueY = "total";
            series.dataFields.categoryX = "categoria";
            series.name = "Categoria";
            series.columns.template.tooltipText = "{categoryX}: [bold]{valueY}[/]";
            series.columns.template.fillOpacity = .8;
            var columnTemplate = series.columns.template;
            columnTemplate.strokeWidth = 2;
            columnTemplate.strokeOpacity = 1;
        },
        error: function () {
        }
    })
}

function Reunion() {
    $.ajax({
        url: 'reunion',
        type: 'GET',
        success: function (data) {
            am4core.useTheme(am4themes_animated);
            var chart = am4core.create("reunion", am4charts.PieChart3D);
            chart.hiddenState.properties.opacity = 0;
            chart.legend = new am4charts.Legend();
            chart.data = data;
            var series = chart.series.push(new am4charts.PieSeries3D());
            series.dataFields.value = "total";
            series.dataFields.category = "or35";
            series.labels.template.disabled = true;
            series.ticks.template.disabled = true;
        },
        error: function () {
        }
    })
}

function LineasTematicas() {
    $.ajax({
        url: 'lineatematicas',
        type: 'GET',
        success: function (data) {
            am4core.useTheme(am4themes_animated);
            var chart = am4core.create("tematicas", am4charts.XYChart);
            chart.data = data;
            var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
            categoryAxis.dataFields.category = "nombre";
            categoryAxis.renderer.grid.template.location = 0;
            categoryAxis.renderer.minGridDistance = 30;
            categoryAxis.renderer.labels.template.rotation = -90;
            var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
            valueAxis.min = 0;
            valueAxis.extraMax = 0.1;
            var series = chart.series.push(new am4charts.ColumnSeries());
            series.dataFields.valueY = "cantidad";
            series.dataFields.categoryX = "nombre";
            series.name = "cantidad";
            series.columns.template.tooltipText = "{categoryX}: [bold]{valueY}[/]";
            series.columns.template.fillOpacity = 1;
            series.tooltip.pointerOrientation = "horizontal";
            var columnTemplate = series.columns.template;
            columnTemplate.strokeWidth = 1;
            columnTemplate.strokeOpacity = 0;
            var labelBullet = series.bullets.push(new am4charts.LabelBullet());
            labelBullet.label.verticalCenter = "bottom";
            labelBullet.label.dy = -10;
            labelBullet.label.text = "{values.valueY.workingValue.formatNumber('#.')}";
            chart.cursor = new am4charts.XYCursor();
            chart.scrollbarX = new am4core.Scrollbar();
            series.columns.template.adapter.add("fill", (fill, target) => {
                return chart.colors.getIndex(target.dataItem.index);
            });
        },
        error: function () {
        }
    })
}

function TipoActividades() {
    $.ajax({
        url: 'tiposactividades',
        type: 'GET',
        success: function (data) {
            am4core.useTheme(am4themes_animated);
            var chart = am4core.create("actividades", am4charts.PieChart3D);
            chart.hiddenState.properties.opacity = 0;
            chart.legend = new am4charts.Legend();
            chart.data = data;
            chart.innerRadius = 100;
            var series = chart.series.push(new am4charts.PieSeries3D());
            series.dataFields.value = "cantidad";
            series.dataFields.category = "nombre";
            series.labels.template.disabled = true;
            series.ticks.template.disabled = true;
        },
        error: function () {
        }
    })
}

function Publico() {
    $.ajax({
        url: 'publicotrabajo',
        type: 'GET',
        success: function (data) {
            am4core.useTheme(am4themes_animated);
            var chart = am4core.create("publico", am4charts.XYChart);
            chart.data = data;
            var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
            categoryAxis.dataFields.category = "nombre";
            categoryAxis.renderer.grid.template.location = 0;
            categoryAxis.renderer.minGridDistance = 30;
            categoryAxis.renderer.labels.template.adapter.add("dy", function (dy, target) {
                if (target.dataItem && target.dataItem.index & 2 == 2) {
                    return dy + 25;
                }
                return dy;
            });
            var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
            var series = chart.series.push(new am4charts.ColumnSeries());
            series.dataFields.valueY = "cantidad";
            series.dataFields.categoryX = "nombre";
            series.name = "Cantidad";
            series.columns.template.tooltipText = "{categoryX}: [bold]{valueY}[/]";
            series.columns.template.fillOpacity = .8;
            var columnTemplate = series.columns.template;
            columnTemplate.strokeWidth = 0;
            columnTemplate.strokeOpacity = 1;
            series.columns.template.adapter.add("fill", (fill, target) => {
                return chart.colors.getIndex(target.dataItem.index);
            });
        },
        error: function () {
        }
    })
}

function Registros() {
    $.ajax({
        url: 'registros',
        type: 'GET',
        success: function (data) {
            am4core.useTheme(am4themes_animated);
            var chart = am4core.create("registros", am4charts.XYChart);
            chart.data = data;
            var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
            categoryAxis.dataFields.category = "nombre";
            categoryAxis.renderer.grid.template.location = 0;
            categoryAxis.renderer.minGridDistance = 30;
            categoryAxis.renderer.labels.template.adapter.add("dy", function (dy, target) {
                if (target.dataItem && target.dataItem.index & 2 == 2) {
                    return dy + 25;
                }
                return dy;
            });
            var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
            var series = chart.series.push(new am4charts.ColumnSeries());
            series.dataFields.valueY = "cantidad";
            series.dataFields.categoryX = "nombre";
            series.name = "Cantidad";
            series.columns.template.tooltipText = "{categoryX}: [bold]{valueY}[/]";
            series.columns.template.fillOpacity = .8;
            var columnTemplate = series.columns.template;
            columnTemplate.strokeWidth = 0;
            columnTemplate.strokeOpacity = 1;
            series.columns.template.adapter.add("fill", (fill, target) => {
                return chart.colors.getIndex(target.dataItem.index);
            });
        },
        error: function () {
        }
    })
}

function Plataformas() {
    $.ajax({
        url: 'plataformas',
        type: 'GET',
        success: function (data) {
            am4core.useTheme(am4themes_animated);
            var chart = am4core.create("plataformas", am4charts.PieChart3D);
            chart.hiddenState.properties.opacity = 0;
            chart.legend = new am4charts.Legend();
            chart.data = data;
            chart.innerRadius = 100;
            var series = chart.series.push(new am4charts.PieSeries3D());
            series.dataFields.value = "cantidad";
            series.dataFields.category = "nombre";
            series.labels.template.disabled = true;
            series.ticks.template.disabled = true;
        },
        error: function () {
        }
    })
}


function OllasAtendidasPordistrito(tipo_lima, tipo_distrito) {
    $.ajax({
        url: 'ollasatendidaspordistrito',
        type: 'GET',
        data: {
            lima: tipo_lima,
            distrito: tipo_distrito,
        }
,        success: function (data) {
            am4core.useTheme(am4themes_animated);
            var chart = am4core.create("ollasatendidaspordistrito", am4charts.XYChart);
            chart.data = data;
            var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
            categoryAxis.dataFields.category = "nombre";
            categoryAxis.renderer.grid.template.location = 0;
            categoryAxis.renderer.minGridDistance = 30;
            categoryAxis.renderer.labels.template.rotation = -90;
            var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
            valueAxis.min = 0;
            valueAxis.extraMax = 0.1;
            var series = chart.series.push(new am4charts.ColumnSeries());
            series.dataFields.valueY = "cantidad";
            series.dataFields.categoryX = "nombre";
            series.name = "cantidad";
            series.columns.template.tooltipText = "{categoryX}: [bold]{valueY}[/]";
            series.columns.template.fillOpacity = 1;
            series.tooltip.pointerOrientation = "horizontal";
            var columnTemplate = series.columns.template;
            columnTemplate.strokeWidth = 1;
            columnTemplate.strokeOpacity = 0;
            var labelBullet = series.bullets.push(new am4charts.LabelBullet());
            labelBullet.label.verticalCenter = "bottom";
            labelBullet.label.dy = -10;
            labelBullet.label.text = "{values.valueY.workingValue.formatNumber('#.')}";
            chart.cursor = new am4charts.XYCursor();
            chart.scrollbarX = new am4core.Scrollbar();
            series.columns.template.adapter.add("fill", (fill, target) => {
                return chart.colors.getIndex(target.dataItem.index);
            });
        },
        error: function () {
        }
    })
}

function Ollasatendidas() {
    $.ajax({
        url: 'ollasatendidas',
        type: 'GET',
        success: function (data) {
            am4core.useTheme(am4themes_animated);
            var chart = am4core.create("ollasatendidas", am4charts.XYChart);

            chart.legend = new am4charts.Legend()
            chart.legend.position = 'top'
            chart.legend.paddingBottom = 20
            chart.legend.labels.template.maxWidth = 95
            chart.data = [
                {
                    otro_cap: 2020,
                    distritos: 14,
                    ollas: 148,
                    beneficiarios: 62049,
                    raciones: 185076
                },
                {
                    otro_cap: 2021,
                    distritos: 26,
                    ollas: 616,
                    beneficiarios: 55191,
                    raciones: 625010
                },
                {
                    otro_cap: 2022,
                    distritos: 14,
                    ollas: 91,
                    beneficiarios: 7331,
                    raciones: 31509
                }
            ]

            // Create axes
            var categoryAxis = chart.yAxes.push(new am4charts.CategoryAxis());
            categoryAxis.dataFields.category = "otro_cap";
            categoryAxis.numberFormatter.numberFormat = "#";
            categoryAxis.renderer.inversed = true;
            categoryAxis.renderer.grid.template.location = 0;
            categoryAxis.renderer.cellStartLocation = 0.1;
            categoryAxis.renderer.cellEndLocation = 0.9;
            var  valueAxis = chart.xAxes.push(new am4charts.ValueAxis());
            valueAxis.renderer.opposite = true;
            valueAxis.logarithmic = true;
            // Create series
            function createSeries(field, name) {
                var series = chart.series.push(new am4charts.ColumnSeries());
                series.dataFields.valueX = field;
                series.dataFields.categoryY = "otro_cap";
                series.name = name;
                series.columns.template.tooltipText = "{name}: [bold]{valueX}[/]";
                series.columns.template.height = am4core.percent(100);
                series.sequencedInterpolation = true;
                var valueLabel = series.bullets.push(new am4charts.LabelBullet());
                valueLabel.label.text = "{valueX}";
                valueLabel.label.horizontalCenter = "right";
                valueLabel.label.dx = 0;
                valueLabel.label.fill = am4core.color("#fff");
                valueLabel.label.hideOversized = false;
                valueLabel.label.truncate = false;
            }
            createSeries("distritos", "Distritos");
            createSeries("ollas", "Ollas");
            createSeries("beneficiarios", "Beneficiarios");
            createSeries("raciones", "Raciones");
        },
        error: function () {
        }
    })
}

function Ollasatendidas123() {
    $.ajax({
        url: 'ollasatendidas',
        type: 'GET',
        success: function (data) {

            am4core.useTheme(am4themes_animated);
            var chart = am4core.create('ollasatendidas', am4charts.XYChart);
            chart.colors.step = 2;

            chart.legend = new am4charts.Legend()
            chart.legend.position = 'top'
            chart.legend.paddingBottom = 20
            chart.legend.labels.template.maxWidth = 95

            var xAxis = chart.xAxes.push(new am4charts.CategoryAxis())
            xAxis.dataFields.category = 'anio'
            xAxis.renderer.cellStartLocation = 0.1
            xAxis.renderer.cellEndLocation = 0.9
            xAxis.renderer.grid.template.location = 0;

            var yAxis = chart.yAxes.push(new am4charts.ValueAxis());
            yAxis.min = 0;

            function createSeries(value, name) {
                var series = chart.series.push(new am4charts.ColumnSeries())
                series.dataFields.valueY = value
                series.dataFields.categoryX = 'anio'
                series.name = name

                series.events.on("hidden", arrangeColumns);
                series.events.on("shown", arrangeColumns);

                var bullet = series.bullets.push(new am4charts.LabelBullet())
                bullet.interactionsEnabled = false
                bullet.dy = 30;
                bullet.label.text = '{valueY}'
                bullet.label.fill = am4core.color('#ffffff')

                return series;
            }

            chart.data = [
                {
                    anio: 2020,
                    distritos: 14,
                    ollas: 148,
                    beneficiarios: 62049,
                    raciones: 185076
                },
                {
                    anio: 2021,
                    distritos: 26,
                    ollas: 616,
                    beneficiarios: 55191,
                    raciones: 625010
                },
                {
                    anio: 2022,
                    distritos: 14,
                    ollas: 91,
                    beneficiarios: 7331,
                    raciones: 31509
                }
            ]


            createSeries('anio', 'Año');
            createSeries('distritos', 'Distritos');
            createSeries('ollas', 'Ollas');
            createSeries('raciones', 'Raciones');

            function arrangeColumns() {

                var series = chart.series.getIndex(0);

                var w = 1 - xAxis.renderer.cellStartLocation - (1 - xAxis.renderer.cellEndLocation);
                if (series.dataItems.length > 1) {
                    var x0 = xAxis.getX(series.dataItems.getIndex(0), "categoryX");
                    var x1 = xAxis.getX(series.dataItems.getIndex(1), "categoryX");
                    var delta = ((x1 - x0) / chart.series.length) * w;
                    if (am4core.isNumber(delta)) {
                        var middle = chart.series.length / 2;

                        var newIndex = 0;
                        chart.series.each(function(series) {
                            if (!series.isHidden && !series.isHiding) {
                                series.dummyData = newIndex;
                                newIndex++;
                            }
                            else {
                                series.dummyData = chart.series.indexOf(series);
                            }
                        })
                        var visibleCount = newIndex;
                        var newMiddle = visibleCount / 2;

                        chart.series.each(function(series) {
                            var trueIndex = chart.series.indexOf(series);
                            var newIndex = series.dummyData;

                            var dx = (newIndex - trueIndex + middle - newMiddle) * delta

                            series.animate({ property: "dx", to: dx }, series.interpolationDuration, series.interpolationEasing);
                            series.bulletsContainer.animate({ property: "dx", to: dx }, series.interpolationDuration, series.interpolationEasing);
                        })
                    }
                }
            }

        },
        error: function () {
        }
    })
}

function Top5distritos(tipo_lima, tipo_distrito) {
    $.ajax({
        url: 'top5distritosatendidos',
        type: 'GET',
        data: {
            lima: tipo_lima,
            distrito: tipo_distrito,
        },
        success: function (data) {
            am4core.useTheme(am4themes_animated);
            var chart = am4core.create("top5distritos", am4charts.PieChart3D);
            chart.hiddenState.properties.opacity = 0;
            chart.legend = new am4charts.Legend();
            chart.data = data;
            var series = chart.series.push(new am4charts.PieSeries3D());
            series.dataFields.value = "ollas_atendidas";
            series.dataFields.category = "distrito";
            series.labels.template.disabled = true;
            series.ticks.template.disabled = true;
        },
        error: function () {
        }
    })
}

function RacionesPorDistrito(tipo_lima, tipo_distrito) {
    $.ajax({
        url: 'racionespordistrito',
        type: 'GET',
        data: {
            lima: tipo_lima,
            distrito: tipo_distrito,
        },
        success: function (data) {
            am4core.useTheme(am4themes_animated);
            var chart = am4core.create("racionespordistrito", am4charts.XYChart);
            chart.data = data;
            var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
            categoryAxis.dataFields.category = "nombre";
            categoryAxis.renderer.grid.template.location = 0;
            categoryAxis.renderer.minGridDistance = 30;
            categoryAxis.renderer.labels.template.rotation = -90;
            var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
            valueAxis.min = 0;
            valueAxis.extraMax = 0.1;
            var series = chart.series.push(new am4charts.ColumnSeries());
            series.dataFields.valueY = "cantidad";
            series.dataFields.categoryX = "nombre";
            series.name = "cantidad";
            series.columns.template.tooltipText = "{categoryX}: [bold]{valueY}[/]";
            series.columns.template.fillOpacity = 1;
            series.tooltip.pointerOrientation = "horizontal";
            var columnTemplate = series.columns.template;
            columnTemplate.strokeWidth = 1;
            columnTemplate.strokeOpacity = 0;
            var labelBullet = series.bullets.push(new am4charts.LabelBullet());
            labelBullet.label.verticalCenter = "bottom";
            labelBullet.label.dy = -10;
            labelBullet.label.text = "{values.valueY.workingValue.formatNumber('#.')}";
            chart.cursor = new am4charts.XYCursor();
            chart.scrollbarX = new am4core.Scrollbar();
            series.columns.template.adapter.add("fill", (fill, target) => {
                return chart.colors.getIndex(target.dataItem.index);
            });
        },
        error: function () {
        }
    })
}

