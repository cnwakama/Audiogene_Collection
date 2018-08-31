function addPlot(plotName,data,id) {
	var chart = new Highcharts.Chart({
        chart: {
            renderTo: plotName,
            animation: false
        },
        title: {
        	text: id
        },
        legend: {
            align: 'right',
            layout: 'vertical',
            verticalAlign: 'top',
            x: 0,
            y: 100
        },
        plotOptions: {
        	series: {
        		animation: false
        	}
        }
        ,
        xAxis: {
            opposite: true,
        	categories: ['125','250','500','1k','1.5k','2k','3k','4k','6k','8k'],
        	title: {
            	text: "Frequency in Hz"
            }
        },
        yAxis: {
            reversed: true,
            text: "Apc",
            startOnTick: false,
            endOnTick: false,
            minPadding: 0.0,
            min: -10,
            max: 130,
            tickInterval: 10,
            title: {
            	text: "Hearing Level in dB"
            }
        },
        
        series: data,

        credits: {
        	enabled: false	
        },
        exportting: {
        	enable: true,
        	url: "https://audiogene-devel.eng.uiowa.edu/audiogene/app/webroot/exporting-server/"
        }
        
    });
    
    return chart;
}
