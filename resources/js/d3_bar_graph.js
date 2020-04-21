$(document).ready(function () {

    var data = [50, 20, 90];

        // for (var i = 0; i < 3; i++) {
        //     data.push( Math.floor(Math.random() * 7) + 2);
        // }
    var svg = d3.select('.bar_graph').append('svg');

    function rendering(){
        // 將畫布尺寸改成即時取得的寬高
        var margin = 30,//parseInt(d3.select('.bar_graph').style('margin')),
            width = parseInt(d3.selectAll(".bar_graph").style("width"), 10) - margin*2,
            height = parseInt(d3.selectAll(".bar_graph").style("height"), 10) - margin*2;

        console.log("width:"+(parseInt(d3.select('.bar_graph').style('width'), 10)- margin*2));
        console.log("width:"+(parseInt(d3.select('.bar_graph').style('height'), 10)- margin*2));

        svg.html('');

        svg.attr({
            "width": width + margin * 2,
            "height": height + margin * 2,
            "transform": "translate(" + 10 + "," + 10 + ")"
        });

        var xScale = d3.scale.linear()
            .domain([0, data.length])
            .range([0, width]);

        var yScale = d3.scale.linear()
            .domain([0, 100])
            .range([0, height]);

        var yScale2 = d3.scale.linear()
            .domain([0, 100])
            .range([height, 0]);

        var yAxis = d3.svg.axis()
            .scale(yScale2)
            .orient("left");

        svg.selectAll('.bar')
            .data( data )
            .enter()
            .append('g')
            .classed('bar', true)
            .append('rect')
            .attr({
                'x': function(d, i){ return xScale(i) + margin +10; },
                'y': function(d, i){ return height - yScale(d) + margin;  },
                'width': '10%',
                'height': function(d, i){ return yScale(d); },
                'fill': 'rgb(246,244,239)'
            });

        svg.append("g")
            .attr({
                "class": "y axis",
                "transform": "translate("+ margin +", "+ margin +")",
            })
            .call(yAxis);

        svg.select('.x.axis').selectAll('.tick text').attr("dx", width*0.05);
        svg.select('.x.axis').selectAll('.tick line').attr('transform', 'translate('+ width*0.05 +', 0)');
        svg.selectAll('.bar').attr('transform', 'translate('+ width*0.02 +', 0)');
    }
    d3.select(window).on('resize', rendering);
    rendering();

});

