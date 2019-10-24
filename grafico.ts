import * as d3 from "d3";

interface Data {
    Maxima: number;
    Media: number;
    Minima: number;
    Lugar: string;
}

function drawChart(data: Data[]) {
    let width = 500,
    height = 500,
    radius = Math.min(width, height) / 2,
    colourValues = d3.scale.category20c();

    let arc = d3.svg.arc<d3.layout.pie.Arc<Data>>().innerRadius(radius - 70).outerRadius(radius - 0);    
    let pie = d3.layout.pie<Data>().value((d: Data):number => d.Minima);

    let fill = (d: d3.layout.pie.Arc<Data>): string => colourValues(d.data.Lugar);
    let tf  = (d: d3.layout.pie.Arc<Data>): string => `translate(${arc.centroid(d)})`;
    let text = (d: d3.layout.pie.Arc<Data>): string => d.data.Lugar + "(" + d.data.Minima + ")" + ", (" + d.data.Media + ")" + ", (" + d.data.Maxima + ")";

    let svg = d3.select('.pie-chart').append('svg').attr('width', width).attr('height', height).append('g').attr('transform', 'translate(' + width / 2 + ',' + height / 2 + ')');
    let g = svg.selectAll('.arc').data(pie(data)).enter().append('g').attr('class', 'arc');   
    g.append('path').attr('d', arc).attr('fill', fill);   
    g.append('text').attr('transform', tf).text(text);
}
let js: Data[] = JSON.parse(datos);
drawChart(js);