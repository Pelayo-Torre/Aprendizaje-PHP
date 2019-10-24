"use strict";
exports.__esModule = true;
var d3 = require("d3");
function drawChart(data) {
    var width = 500, height = 500, radius = Math.min(width, height) / 2, colourValues = d3.scale.category20c();
    var arc = d3.svg.arc().innerRadius(radius - 70).outerRadius(radius - 0);
    var pie = d3.layout.pie().value(function (d) { return d.Minima; });
    var fill = function (d) { return colourValues(d.data.Lugar); };
    var tf = function (d) { return "translate(" + arc.centroid(d) + ")"; };
    var text = function (d) { return d.data.Lugar + "(" + d.data.Minima + ")" + ", (" + d.data.Media + ")" + ", (" + d.data.Maxima + ")"; };
    var svg = d3.select('.pie-chart').append('svg').attr('width', width).attr('height', height).append('g').attr('transform', 'translate(' + width / 2 + ',' + height / 2 + ')');
    var g = svg.selectAll('.arc').data(pie(data)).enter().append('g').attr('class', 'arc');
    g.append('path').attr('d', arc).attr('fill', fill);
    g.append('text').attr('transform', tf).text(text);
}
var js = JSON.parse(datos);
drawChart(js);
