var audiogram_data = new Object();
var audiogram_count = new Object();
var valid_audiograms = false;

var maxNumPerPlot = 4;

var plotCount = 0;

var idKeys ;

var audioprofile_chart;

$(document).ready(function() {

	//Get data ready
	
	if($("#audiograms-data").attr("value").split("\n").length > 1) {

		valid_audiograms = true;
		
		var numAudiograms = $("#audiograms-data").attr("value").split("\n").length;
		var audiograms = $("#audiograms-data").attr("value").split("\n");
		
		for(var i = 0; i < numAudiograms; i++) {
			var parts = audiograms[i].split(",");
			
			var id = parts[0];
			var age = parts[1];
			
			
			//console.log(id.concat(" ").concat(age));
			
			if(!(audiogram_data.hasOwnProperty(id))) {
				audiogram_data[id] = new Object();
				
			}
			
			if(!(audiogram_count.hasOwnProperty(id))) {
				audiogram_count[id] = new Object();
			}
			
			audiogram_count[id][age] = parts[12];
			audiogram_data[id][age] = parts.splice(2,12);
			
			
		}
		
		
	}
	
	//Put data in the right form to be presented
	idKeys = Object.keys(audiogram_data);
	
	//idKeys.sort(function numOrdA(a, b){ a=a.replace(/[^0-9]/g, ''); b=b.replace(/[^0-9]/g, ''); ; return (a-b); });
	
	idKeys.sort(function numOrdA(a, b){ 
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
			
			//console.log(audiogram_count[id][ageKeys[j]]);
			
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
				name: getName(ageKeys[j],audiogram_count[id][ageKeys[j]]) /*"Age ".concat(ageKeys[j])  */
        	};
        	
            //if (newSeries.name == )
			seriesData.push(newSeries);
			
			if(j % maxNumPerPlot == (maxNumPerPlot - 1)) {
				//console.log(j % maxNumPerPlot);
				var nameOfPlot = namePlot(id);
                //plotCount++
				var plotName = "plot-".concat(plotCount);
                if (id == "DFNA2A"){
                    //add visible
				    $("#plots").append('<div id="'.concat(plotName).concat('" style="width: 600px"></div>'));
				    addPlot(plotName,seriesData,nameOfPlot);
                }
				seriesData = new Array();
			}
			
		}
		
		/**if( seriesData.length > 0 && i > 0) {
			var nameOfPlot = namePlot(id);
			var plotName = "plot-".concat(plotCount++);
			$("#plots").append('<div id="'.concat(plotName).concat('" style="width: 600px"></div>'));
			audioprofile_chart = addPlot(plotName,seriesData,nameOfPlot);
		}*/
		
		
	}
	
	
	var plotName = "placeholder";
	
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

function namePlot(id) {

	var Name = "Gene (Locus)";

	if(id == "DFNA1"){
		Name = "DIAPH1 (DFNA1)";
	} else if(id == "DFNA2A"){
		Name = "KCNQ4 (DFNA2A)";
	} else if(id == "DFNA2B"){
		Name = "GJB3 (DFNA2B)";
	} else if(id == "DFNA2notAnotB"){
		Name = "Unknown Gene (DFNA2notAnotB)";
	} else if(id == "DFNA3A"){
		Name = "GJB2 (DFNA3A)";
	} else if(id == "DFNA4A"){
		Name = "MYH14 (DFNA4A)";
	} else if(id == "DFNA4B"){
		Name = "CEACAM16 (DFNA4B)";
	} else if(id == "DFNA5"){
		Name = "DFNA5 (DFNA5)";
	} else if(id == "DFNA6/14/38"){
		Name = "WFS1 (DFNA6/14/38)";
	} else if(id == "DFNA8/12"){
		Name = "TECTA (DFNA8/12)";
	} else if(id == "DFNA9"){
		Name = "COCH (DFNA9)";
	} else if(id == "DFNA10"){
		Name = "EYA4 (DFNA10)";
	} else if(id == "DFNA11"){
		Name = "MYO7A (DFNA11)";
	} else if(id == "DFNA13"){
		Name = "COL11A2 (DFNA13)";
	} else if(id == "DFNA15"){
		Name = "POU4F3 (DFNA15)";
	} else if(id == "DFNA16"){
		Name = "Unknown Gene (DFNA16)";
	} else if(id == "DFNA17"){
		Name = "MYH9 (DFNA17)";
	} else if(id == "DFNA18"){
		Name = "Unknown Gene (DFNA18)";
	} else if(id == "DFNA20/26"){
		Name = "ACTG1 (DFNA20/26)";
	} else if(id == "DFNA21"){
		Name = "Unknown Gene (DFNA21)";
	} else if(id == "DFNA22"){
		Name = "MYO6 (DFNA22)";
	} else if(id == "DFNA24"){
		Name = "Unknown Gene (DFNA24)";
	} else if(id == "DFNA25"){
		Name = "SLC17A8 (DFNA25)";
	} else if(id == "DFNA27"){
		Name = "Unknown Gene (DFNA27)";
	} else if(id == "DFNA28"){
		Name = "TFCP2L3 (DFNA28)";
	} else if(id == "DFNA31"){
		Name = "Unknown Gene (DFNA31)";
	} else if(id == "DFNA33"){
		Name = "Unknown Gene (DFNA33)";
	} else if(id == "DFNA36A"){
		Name = "TMC1 (DFNA36A)";
	} else if(id == "DFNA36notA"){
		Name = "Unknown Gene (DFNA36notA)";
	} else if(id == "DFNA41"){
		Name = "Unknown Gene (DFNA41)";
	} else if(id == "DFNA43"){
		Name = "Unknown Gene (DFNA43)";
	} else if(id == "DFNA44"){
		Name = "CCDC50 (DFNA44)";
	} else if(id == "DFNA50"){
		Name = "MIRN96 (DFNA50)";
	} else if(id == "DFNA57"){
		Name = "Unknown Gene (DFNA57)";
	} else if(id == "DFNA59"){
		Name = "Unknown Gene (DFNA59)";
	}

	return Name;

}

if (!Object.keys) Object.keys = function(o) {
  if (o !== Object(o))
    throw new TypeError('Object.keys called on a non-object');
  var k=[],p;
  for (p in o) if (Object.prototype.hasOwnProperty.call(o,p)) k.push(p);
  return k;
}

