/*
	http://www.highcharts.com/ref/#title
	http://jsfiddle.net/gh/get/jquery/1.7.1/highslide-software/highcharts.com/tree/master/samples/highcharts/yaxis/reversed/
*/

var audiogram_data = new Object();
var valid_audiograms = false;

var maxNumPerPlot = 4;

var plotCount = 0;

$(document).ready(function() {

	//Get data ready
	
	if($("#audiograms-data").attr("value").split("\n").length > 1) {
	
		valid_audiograms = true;
		
		var numAudiograms = $("#audiograms-data").attr("value").split("\n").length;
		var audiograms = $("#audiograms-data").attr("value").split("\n");
		
		for(var i = 1; i < numAudiograms; i++) {
			
			var parts = audiograms[i].split(",");
			
			if(parts.length >= 17) { 
				var id = parts[3];
				var age = parts[4].concat(" (").concat(parts[6]).concat(")");
				
				
				//console.log(id.concat(" ").concat(age));
				
				if(!(audiogram_data.hasOwnProperty(id))) {
					audiogram_data[id] = new Object();
					
				}
				
				audiogram_data[id][age] = parts.splice(7,17);
			}
			
		}
		
		
	}
	
	//Put data in the right form to be presented
	var idKeys = Object.keys(audiogram_data);
	
	idKeys.sort();
	
	for(var i = 0; i < idKeys.length; i++) {
		var id = idKeys[i];
		
		ageKeys = Object.keys(audiogram_data[id]);
		
		ageKeys.sort(function(a,b){
			var compA = parseFloat(a);
			var compB = parseFloat(b);
			return (compA < compB) ? -1 : (compA > compB) ? 1 : 0;
		});
		
		//console.log(ageKeys);
		
		var seriesData = new Array();
		
		for(var j = 0; j < ageKeys.length; j++ ) {
			
			//console.log(audiogram_data[id][ageKeys[j]]);
			
			var rawData = audiogram_data[id][ageKeys[j]]
			var dataArray = new Array();
			
			for(var x = 0; x < 10; x++) {
				if(rawData[x] == "") {
					dataArray.push(null);
				} else {
					dataArray.push( parseFloat(rawData[x]) )
				}	
			}
			
			var newSeries = {
				connectNulls: true,
				data: dataArray,
				name: "Age ".concat(ageKeys[j])   
        	};
        	
			seriesData.push(newSeries);
			
			if(j % maxNumPerPlot == (maxNumPerPlot - 1)) {
				//console.log(j % maxNumPerPlot);
				var plotName = "plot-".concat(plotCount++);
				$("#plots").append('<div id="'.concat(plotName).concat('" style="width: 600px" class="audiogram-plot"></div>'));
				addPlot(plotName,seriesData,id);
				seriesData = new Array();
			}
			
		}
		
		if( seriesData.length > 0) {
			var plotName = "plot-".concat(plotCount++);
			$("#plots").append('<div id="'.concat(plotName).concat('" style="width: 600px"  class="audiogram-plot"></div>'));
			addPlot(plotName,seriesData,id);
		}
		
		
	}
	
	
	var plotName = "placeholder";
	
	
	

});



if (!Object.keys) Object.keys = function(o) {
  if (o !== Object(o))
    throw new TypeError('Object.keys called on a non-object');
  var k=[],p;
  for (p in o) if (Object.prototype.hasOwnProperty.call(o,p)) k.push(p);
  return k;
}