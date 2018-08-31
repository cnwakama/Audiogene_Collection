var resultData;

var patientNames = new Array();

var numLoci = 3;

var loci = null;

var load_data;

var dominantHash;

var showDominantProb = 0;

var topPosition = 0;
var bottomPosition = 0;

var marginSet = false;

$(document).ready(function() {


	//Used for debugging
	var easter_egg = new Konami();
	easter_egg.code = function() { $(".experimental").css("display",""); }
	easter_egg.load();
	
	

	var run_id = $("#run_id").attr("value");
	///*added by Ian 6/6/16*/var input_inheritance = $("#input_inheritance").attr("value");
	console.log("Running analysis");

	$.get('../runAnalysis.json?run_id='.concat(run_id), function(data) {
	  	load_data = data;
	  	console.log("Finished loading");
	  	console.log(data['results_dominant']);
	  	$('#results-data').text(data['results']);	
	  	
	  	var lines = data['results'].split("\n");
	  	
	  	var data_results = data['results'];
	  	
	  	var data_dominant = data['results_dominant'];
	  	
	  	if(data_dominant != null) {
	  		
	  		dominantHash = {};
	  		
	  		var lines_dominant = data_dominant.split("\n");
	  		
	  		for(var i=0; i < lines_dominant.length; i++) {
	  			var parts = lines_dominant[i].split("\t");
	  			var prob = parseFloat(parts[2]);
	  			if( parts[1] != "Dominante" ) {
	  				prob = 1.0 - prob;
	  			}
	  			prob = prob * 100;
	  			dominantHash[ parts[0] ] = prob;
	  		}
	  	} else {
	  		showDominantProb = 0;
	  	}
	  	
	  	if(lines.length > 0 && data_results.length > 0) {
	  		resultData = {};
	  		
	  		for(var i=0; i < lines.length; i++) {
	  			var parts = lines[i].split("\t");
	  			
	  			var name = parts[0]
	  			var list = parts[1];
	  			//console.log(name);
	  			patientNames.push(name);
	  			resultData[name] = list;
	  		}
	  		patientNames.sort();
	  		generateResultTable();
	  	} else {
	  		//An error occurred
	  		displayErrorMessage();
	  	
	  	}
	  	
	  	$('#more-button').button();
	  	
	  	$( '#more-button' ).click(function() { 
	  			numLoci++;
	  			generateResultTable();
	  	});
	  	
	  	//console.log(data);
	  	//alert('Load was performed.');
	  	$("#progress").hide();

	  	loci = resultData[Object.keys(resultData)[0]].split(",").sort();
	  	
	  	//enableShowHideLoci();
	  	
	});
	
	/*
	$(".collapsible").click(function() {
		
		if($(".collapsible").hasClass('collapsed')) {
			$(".collapsible").removeClass('collapsed')
		} else {
			$(".collapsible").addClass('collapsed')
		}
		
	});
	*/
	
	$("#audiogram-field").click(function() {
		if($("#plots-fieldset").hasClass('collapsed')) {
			$("#plots-fieldset").removeClass('collapsed')
			topPosition = $('#audioprofiles').offset().top - parseFloat($('#audioprofiles').css('margin-top').replace(/auto/, 0));	
			bottomPosition = $(".audiogram-plot").last().offset().top;
		} else {
			$("#plots-fieldset").addClass('collapsed')
		}
		
	});
	
	$(":checkbox").change(function(event){
		$('#audioprofile-plot').toggle();
		$('#audioprofile-select').toggle();
		
	});
	
	

});

var msie6 = $.browser == 'msie' && $.browser.version < 7;
if (!msie6) {
	
	//var _height = $('#audioprofiles').height();
	$(window).scroll(function(event) {
		var y = $(this).scrollTop();
		//var z =$('#loci-fieldset').offset().top;
		//console.log(topPosition + " " + y + " " + bottomPosition);
		if (y > topPosition && y < bottomPosition) {
			$('#audioprofile-plot').addClass('fixed');
			$('#audioprofile-plot').css('margin-top',"");
			marginSet = false;
		} else if(y > bottomPosition)
		{
		
			$('#audioprofile-plot').removeClass('fixed');
			//Fixes a weird firefox flashing issue
			if(!marginSet) {
				marginSet = true;
				$('#audioprofile-plot').css('margin-top',$(".audiogram-plot").first().height()*($(".audiogram-plot").length - 1));
			}
		} else{
			marginSet = false;
			$('#audioprofile-plot').css('margin-top',"");
			$('#audioprofile-plot').removeClass('fixed');
		}
	});
}



function displayErrorMessage() {
	$('#results-content').html("An Error Occurred!");
}

function enableShowHideLoci() {
	
	if( loci != null ) {
		
		$('#loci-fieldset').show();
		
	}

}

function getGetOrdinal(n) {
   var s=["th","st","nd","rd"],
       v=n%100;
   return n+(s[(v-20)%10]||s[v]||s[0]);
}

function generateResultTable() 
{
	
	var content = '';
	var input_inheritance = $("#input_inheritance").attr("value");
	
	
	content += '<div id="tableWrap">';
	content += '<table id="resultTable">';
	
	content += '<tr>';
	
	content += '<th>ID</th>';
	
	if(showDominantProb == 1) {
		content += '<th>Probability of Dominant Inheritance</th>';
	}
	
	for (var i = 1; i <= numLoci; i++) {
		content += '<th>';
		content += getGetOrdinal(i).concat(" Prediction");
		content += '</th>';
	}
	content += '</td>';
	
	var audiogramData = $('#audiograms-data').attr("value");
	var dataList = audiogramData.split(",");
	for (var i = 0; i < patientNames.length; i++) 
	{
		var name = patientNames[i];
		
		content += '<tr>';
		
		content += '<td>';
		content += name;
		content += '</td>';
		
		/*if(showDominantProb == 1) {
			content += '<td>';
			content += dominantHash[name].toFixed(2) + " %";
			content += '</td>';
		}*/

		var prioritizedList = resultData[ name ].split(",");
		for(var j = 0; j < numLoci; j++) 
		{
			content += '<td>';
			content += prioritizedList[j] + '<p><button type="button" id="viewaps" onClick="viewAPS('+ i + "," + j + ')">View APS</button></p>';
			//content += prioritizedList[j] + '<p><button type="button" id="viewaps" onClick="viewAPS('+ i + "," + j + ')"><a href="http://audiogene-devel.eng.uiowa.edu/JavaWebStart2.jnlp">View APS</a></button></p>';
			//content += prioritizedList[j] + '<p><button type="button" id="viewaps" onClick="viewAPS('+ i + "," + j + ')"><a href="http://audiogene-devel.eng.uiowa.edu/JavaWebStart2.jnlp?name='name'&prediction='prioritizedList[j]'&age='patientAge[i]'&data'patientData[i]'>View APS</a></button></p>';
			content += '</td>';
		}
		content += '</tr>';
	}

	content += '</table>';
	content += '</div>';
	//console.log(content);
	$('#results-content').html(content);
	$('#resultTable').css('width',200+200*numLoci);

	$('#dominant-label').show();

	/*if(input_inheritance.localeCompare("R") == 0)
	{
		$('#results-content').hide();
		$('#dominant-label').hide();
		$('#more-button').hide();
		
	}
	else if(input_inheritance.localeCompare("X") == 0)
	{
		$('#under-construction').show();
		$('#results-content').hide();
		$('#dominant-label').hide();
		$('#more-button').hide();
		//$('#more-rec-button').hide();
	}*/
}

//gets patients name and prediction based on the selected button.
//NEED to run APSViewer from here, by passing in patient name, prediction, and patient audiogram data
function viewAPS(i,j)
{
	var prioritizedList = resultData[ patientNames[i] ].split(",");
	getAudiogramsData(patientNames[i], prioritizedList[j]);
	//window.location.replace("http://audiogene-devel.eng.uiowa.edu/pages/applet43random");
}

function getAudiogramsData(name, prediction)
{
	var audiogramData = $('#audiograms-data').attr("value");
	var dataList = audiogramData.split(",");
	var check = false;
	var audiogram = new Array();
	var age;
	var gender;
	var ear;
	var a125;
	var a250;
	var a500;
	var a1;
	var a1_5;
	var a2;
	var a3;
	var a4;
	var a6;
	var a8;
	var loci = prediction;
	
	var audiogramPush = 12;
	for(var i = 0; i < dataList.length+1; i++)
	{
		if(check == true)
		{
			if(audiogramPush > -1)
			{
				if(audiogramPush == 12)
				{
					age = dataList[i];
				}
				else if(audiogramPush == 11)
				{
					gender = dataList[i];
				}
				else if(audiogramPush == 10)
				{
					ear = dataList[i];
				}
				else if(audiogramPush == 9)
				{
					a125 = dataList[i];
				}
				else if(audiogramPush == 8)
				{
					a250 = dataList[i];
				}
				else if(audiogramPush == 7)
				{
					a500 = dataList[i];
				}
				else if(audiogramPush == 6)
				{
					a1 = dataList[i];
				}
				else if(audiogramPush == 5)
				{
					a1_5 = dataList[i];
				}
				else if(audiogramPush == 4)
				{
					a2 = dataList[i];
				}
				else if(audiogramPush == 3)
				{
					a3 = dataList[i];
				}
				else if(audiogramPush == 2)
				{
					a4 = dataList[i];
				}
				else if(audiogramPush == 1)
				{
					a6 = dataList[i];
				}
				else if(audiogramPush == 0)
				{
					a8 = dataList[i];
					var a8str = a8.substring(0, 1);
					//alert("a8: " + a8 + "\na8: " + a8str);
				}
				audiogramPush--;
			}
			else
			{
				i = dataList.length;
				//'<script src="http://www.java.com/js/deployJava.js"></script>';
				//var url = "http://audiogene-devel.eng.uiowa.edu/JavaWebStart2.jnlp";    
				//deployJava.runApplet(url, name + " " + prediction + " " + age + " " + audiogram.toString(), '1.4');
				//$this->set('a125', $a125); 
				//echo $a125;
				//alert("PatientName: " + name + "\nPrediction: " + prediction + "\nAge: " + age + "\nGender: " + gender + "\nEar: " + ear +"\na125: " + a125 +"\na250: " + a250 +"\na500: " + a500 +"\na1: " + a1 +"\na1_5: " + a1_5 +"\na2: " + a2 +"\na3: " + a3 +"\na4: " + a4 +"\na6: " + a6 +"\na8: " + a8);
				//$.post("http://audiogene-devel.eng.uiowa.edu/pages/applet43random", {"age": age});
				//$.post("http://audiogene-devel.eng.uiowa.edu/pages/applet43random", {"age": age});//{x: 'example', y: 'abc'});
				var url = 'https://audiogene.eng.uiowa.edu/pages/javascriptaudioprofilesurfaceviewer';
				var form = $('<form action="' + url + '" method="post">' +
				  '<input type="text" name="age" value="' + age + '" />' +
				  '<input type="text" name="a125" value="' + a125 + '" />' +
				  '<input type="text" name="a250" value="' + a250 + '" />' +
				  '<input type="text" name="a500" value="' + a500 + '" />' +
				  '<input type="text" name="a1" value="' + a1 + '" />' +
				  '<input type="text" name="a1_5" value="' + a1_5 + '" />' +
				  '<input type="text" name="a2" value="' + a2 + '" />' +
				  '<input type="text" name="a3" value="' + a3 + '" />' +
				  '<input type="text" name="a4" value="' + a4 + '" />' +
				  '<input type="text" name="a6" value="' + a6 + '" />' +
				  '<input type="text" name="a8" value="' + a8 + '" />' +
				  '<input type="text" name="loci" value="' + loci + '" />' +
				  '</form>');
				$('body').append(form);
				form.submit();

				//redirect("http://audiogene-devel.eng.uiowa.edu/pages/applet43random", 'post');
				/*$('#aage').text(age);
				$('#a125').text(a125);
				$('#a250').text(a250);
				$('#a500').text(a500);
				$('#a1').text(a1);
				$('#a1_5').text(a1_5);
				$('#a2').text(a2);
				$('#a3').text(a3);
				$('#a4').text(a4);
				$('#a6').text(a6);
				$('#a8').text(a8);*/
			}
		}
		if(dataList[i] == name)
		{
			check = true;
		}
	}
	
	//alert("Audiogram Data: " + audiogramData);
}
