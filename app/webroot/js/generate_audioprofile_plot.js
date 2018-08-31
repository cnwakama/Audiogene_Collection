var audioprofile_data = new Object();
var audioprofile_count = new Object();
var audioprofileSeriesData = new Object();
var valid_audiograms = false;

var maxNumPerPlot = 4;

var plotCount = 0;

var lociKeys ;

var audioprofile_chart;

$(document).ready(function() {

	//Get data ready
	
	if($("#audioprofiles-data").attr("value").split("\n").length > 1) {
	
		valid_audiograms = true;
		
		var numAudiograms = $("#audioprofiles-data").attr("value").split("\n").length;
		var audiograms = $("#audioprofiles-data").attr("value").split("\n");
		
		for(var i = 0; i < numAudiograms; i++) {
			var parts = audiograms[i].split(",");
			
			var id = parts[0];
			var age = parts[1];
			
			
			//console.log(id.concat(" ").concat(age));
			
			if(!(audioprofile_data.hasOwnProperty(id))) {
				audioprofile_data[id] = new Object();
				
			}
			
			if(!(audioprofile_count.hasOwnProperty(id))) {
				audioprofile_count[id] = new Object();
			}
			
			audioprofile_count[id][age] = parts[12];
			audioprofile_data[id][age] = parts.splice(2,12);
			
			
		}
		
		
	}
	
	//Put data in the right form to be presented
	lociKeys = Object.keys(audioprofile_data);
	
	//lociKeys.sort(function numOrdA(a, b){ a=a.replace(/[^0-9]/g, ''); b=b.replace(/[^0-9]/g, ''); ; return (a-b); });
	
	lociKeys.sort(function numOrdA(a, b){ 
			a_text = a.replace("DFNA","");
			a = a.replace(/\/.*$/,''); 
			a=a.replace(/[^0-9]/g, ''); 
			
			b_text = b.replace("DFNA","");
			b = b.replace(/\/.*$/,''); 
			b=b.replace(/[^0-9]/g, ''); 
			
			if(a == b) {
				return ( ( a_text > b_text ) ? 1 : -1 );
			}
			
			return (a-b); })
	
	
	for(var i = 0; i < lociKeys.length; i++) {
		var id = lociKeys[i];
		
		if(id != "") {
			$("#audioprofile-select").append('<option value="'+id+'">'+id+'</option>');
		}
		ageKeys = Object.keys(audioprofile_data[id]);
		
		ageKeys.sort(function(a,b){
			var compA = parseFloat(a);
			var compB = parseFloat(b);
			return (compA < compB) ? -1 : (compA > compB) ? 1 : 0;
		});
		
		//console.log(ageKeys);
		
		var seriesData = new Array();
		
		for(var j = 0; j < ageKeys.length; j++ ) {
			
			//console.log(audioprofile_count[id][ageKeys[j]]);
			
			var rawData = audioprofile_data[id][ageKeys[j]]
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
				name: getName(ageKeys[j],audioprofile_count[id][ageKeys[j]]) /*"Age ".concat(ageKeys[j])  */
        	};
        	
			seriesData.push(newSeries);
						
		}
		
		if(id != "") {
			audioprofileSeriesData[id] = seriesData;
		}
		
		if( seriesData.length > 0 && i > 0 && i < 2) {
			//var plotName = "plot2-".concat(plotCount++);
			$("#audioprofiles").append('<div id="audioprofile-plot"'.concat(' style="width: 600px; display:none"></div>'));
			audioprofile_chart = addPlot("audioprofile-plot",seriesData,id);
			
		}

		
		
	}
	
	
	
	var plotName = "placeholder";
	
	$('select').on('change', function() {
	  //alert( this.value ); // or $(this).val()
		console.log(audioprofileSeriesData[this.value]);
		//audioprofile_chart.series[0].setData( audioprofileSeriesData[this.value],true );
		audioprofile_chart = addPlot("audioprofile-plot",audioprofileSeriesData[this.value],this.value);
	});
	
});




function getName(age,count) {
	
	str = "Age "

	if(age == 0) {
		str = str.concat("0-20 ");
	} else if(age == 20){
		str = str.concat("20-40 ");
	} else if(age == 40) {
		str = str.concat("40-60 ");
	} else {
		str = str.concat("60+ ");
	}
	
	return str.concat("(").concat( count ).concat(")");
	
}

if (!Object.keys) Object.keys = function(o) {
  if (o !== Object(o))
    throw new TypeError('Object.keys called on a non-object');
  var k=[],p;
  for (p in o) if (Object.prototype.hasOwnProperty.call(o,p)) k.push(p);
  return k;
}