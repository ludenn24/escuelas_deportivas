google.charts.load("current");
google.charts.setOnLoadCallback(drawVisualization);

function drawVisualization() {
$.ajax({
    url: 'generadormapa',
    type: 'GET',
    success: function (jsonData) {

    let replaceNomDep = {"txtsearch": ["CERCADO DE LIMA", "CUSCO", "ÁNCASH"], "txtreplace": ["LIMA", "CUZCO", "ANCASH"]};
    let auxNomDep = "", auxSearchIndex = -1;

    // Create and populate a data table
    var data = new google.visualization.DataTable();
    data.addColumn("string", "Distrito");
    data.addColumn("number", "Ollas");

    $.each(jsonData, function (i, itemData) {
        auxSearchIndex = replaceNomDep.txtsearch.indexOf(itemData.nombre);
        if (auxSearchIndex >= 0) {
            auxNomDep = replaceNomDep.txtreplace[auxSearchIndex];
        } else {
            auxNomDep = itemData.nombre;
        }
        let auxcantidad = (!isNaN(parseInt(itemData.cantidad))) ? parseInt(itemData.cantidad) : 0;
        data.addRows([[auxNomDep, auxcantidad]]);
    });
    // Instantiate our Geochart GeoJSON object
    var vis = new geochart_geojson.GeoChart(document.getElementById("map"));
    // Set Geochart GeoJSON options
    var options = {
        mapsOptions: {
            center: {lat: -12.04318, lng: -77.02824},
            zoom: 10
        },
        geoJson: "mapa/lima.geojson",
        geoJsonOptions: {
            idPropertyName: "NOMBDIST"
        }
    };
    // Draw our Geochart GeoJSON with the data we created locally
    vis.draw(data, options);
    },
        error: function () {
        }
    })
}
