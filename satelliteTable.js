
var satelliteTable = {
    satellites: [],
    getDistance: function(keplerParams) {
        var time = (geoCoordTranslator.currentTime.getTime() - keplerParams.epoch.getTime()) / 1000;
        var eccAnomaly = satelliteTracker.getEccAnomaly(keplerParams.eccentricity, keplerParams.meanMotion, keplerParams.meanAnomaly, time);
        var trueAnomaly = satelliteTracker.getTrueAnomaly(keplerParams.eccentricity, eccAnomaly);
        return satelliteTracker.getDistance(keplerParams.semimajorAxis, keplerParams.eccentricity, eccAnomaly);
    },
//-------------------------------------------------------------------------------------------------------------------------------
    init: function(domContainer) {
        var domTable = document.createElement("table");
        domTable.setAttribute("id", "satelliteTable");
        domContainer.appendChild(domTable);
        satelliteTable.update();
    },
    addSatellite: function(tle, color) {
        var sat = {};
        sat.keplerParams = model.tleParser.getKeplerParams(tle);
        sat.color        = color;
        sat.name         = tle[0];
        sat.number       = parseInt(tle[1].substr(2, 5));
        sat.launchYear   = parseInt(tle[1].substr(9, 2));
        sat.launchYear += (sat.launchYear >= 57 ? 1900 : 2000);
        satelliteTable.satellites.push(sat);
    },
    update: function() {
        var table = "";
        table += "<tr><td>Name</td><td>NORAD Number</td><td>Launch Year</td><td>Mean Motion (rev./day)</td><td>Period (hours)</td><td>Distance (km)</td><td>Height (km)</td><td>Eccentricity</td></tr>";
        for (var i = 0; i < satelliteTable.satellites.length; i++) {
            var distance = satelliteTable.getDistance(satelliteTable.satellites[i].keplerParams);
            table += "<tr>";
            table += "<td><font color=\"" + satelliteTable.satellites[i].color + "\">" + satelliteTable.satellites[i].name + "</font></td>";
            table += "<td>" + satelliteTable.satellites[i].number + "</td>";
            table += "<td>" + satelliteTable.satellites[i].launchYear + "</td>";
            table += "<td>" + (satelliteTable.satellites[i].keplerParams.meanMotion * 24 * 3600).toFixed(6) + "</td>";
            table += "<td>" + (1 / satelliteTable.satellites[i].keplerParams.meanMotion / 3600).toFixed(6) + "</td>";
            table += "<td>" + (distance / 1000).toFixed(6) + "</td>";
            table += "<td>" + (distance / 1000 - 6371.032).toFixed(6) + "</td>";
            table += "<td>" + satelliteTable.satellites[i].keplerParams.eccentricity.toFixed(6) + "</td>";
            table += "</tr>";
        }
        document.getElementById("satelliteTable").innerHTML = table;
        setTimeout(satelliteTable.update, 1000);
    }
};

