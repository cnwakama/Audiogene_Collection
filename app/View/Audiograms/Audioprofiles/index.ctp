<h1>Audioprofiles</h1>

<?php
#Import JS files
echo $this->Html->script('jquery-1.8.2.min',false);
echo $this->Html->script('jquery-ui-1.8.21.custom.min',false);
echo $this->Html->script('fix_ie_console',false);

#ref: http://neteye.github.com/activity-indicator.html
//echo $this->Html->script('jquery.activity-indicator.min',false);

//echo $this->Html->script('results-worker',false);

echo $this->Html->script('highcharts',false);

echo $this->Html->script('highcharts.exporting',false);

echo $this->Html->script('audioprofiles',false);

echo $this->Html->script('plot_audiogram',false);

echo $this->Html->css('results');

#print_r($audioprofiles[0]['Audioprofiles']);

$csv = "";

foreach ($audioprofiles as $a) {
	
	$csv = $csv . $a['Audioprofiles']['locus'];
	$csv = $csv . "," . $a['Audioprofiles']['age'];
	$csv = $csv . "," . $a['Audioprofiles']['125Hz'];
	$csv = $csv . "," . $a['Audioprofiles']['250Hz'];
	$csv = $csv . "," . $a['Audioprofiles']['500Hz'];
	$csv = $csv . "," . $a['Audioprofiles']['1kHz'];
	$csv = $csv . "," . $a['Audioprofiles']['1_5kHz'];
	$csv = $csv . "," . $a['Audioprofiles']['2kHz'];
	$csv = $csv . "," . $a['Audioprofiles']['3kHz'];
	$csv = $csv . "," . $a['Audioprofiles']['4kHz'];
	$csv = $csv . "," . $a['Audioprofiles']['6kHz'];
	$csv = $csv . "," . $a['Audioprofiles']['8kHz'];
	$csv = $csv . "," . $a['Audioprofiles']['count'];
	$csv = $csv . "\n";
}

echo $this->Html->div('.$csv.');
#echo '<div id="csv">'.$csv.'</div>';

?>


<body>
<a href='../pages/splash'>Click here to go to the APS viewer</a>
<br>
<br>
Audioprofiles are average audiograms based on all the audiograms in our dataset for each locus, and are grouped in two decade increments.
<br></br>
**Note: To print, download, or interact with 2D Audioprofiles, please use a browser other than Chrome.
<br></br>
Browsers known to allow printing, downloading, and interaction: Firefox, Safari, Internet Explorer, Microsoft Edge
<div id="audiograms-data" style="display: none" value=
    	<?php
			print "'".$csv."'";
		?>>
</div>

<br/>
<br/>
Display: <span id="2Dtext">2D</span><a id="2Dlink" href="javascript:void(0);">2D</a> | <span id="3Dtext">3D</span><a id="3Dlink" href="javascript:void(0);">3D</a>

<script>
  $("#aps").hide();
  $("#2Dlink").hide();
  $("#3Dtext").hide();
  $("#3Dlink").click(function() {
    $("#plots").hide();
    $("#aps").show();
    $("#2Dtext").hide();
    $("#3Dlink").hide();
    $("#3Dtext").show();
    $("#2Dlink").show();
  });
  $("#2Dlink").click(function() {
    $("#aps").hide();
    $("#plots").show();
    $("#2Dlink").hide();
    $("#3Dtext").hide();
    $("#3Dlink").show();
    $("#2Dtext").show();
  });
</script>

<div id="plots">
    <div id="placeholder" style="width: 750px"></div>​
    </div>

<div id="aps">
  <img src="DFNA1.png"/>
  <br/>
  <img src="DFNA2A.png"/>
  <br/>
  <img src="DFNA2B.png"/>
  <br/>
  <img src="DFNA2notAnotB.png"/>
  <br/>
  <img src="DFNA3A.png"/>
  <br/>
  <img src="DFNA4A.png"/>
  <br/>
  <img src="DFNA4B.png"/>
  <br/>
  <img src="DFNA5.png"/>
  <br/>
  <img src="DFNA6_14_38.png"/>
  <br/>
  <img src="DFNA8_12.png"/>
  <br/>
  <img src="DFNA9.png"/>
  <br/>
  <img src="DFNA10.png"/>
  <br/>
  <img src="DFNA11.png"/>
  <br/>
  <img src="DFNA13.png"/>
  <br/>
  <img src="DFNA15.png"/>
  <br/>
  <img src="DFNA16.png"/>
  <br/>
  <img src="DFNA17.png"/>
  <br/>
  <img src="DFNA18.png"/>
  <br/>
  <img src="DFNA20_26.png"/>
  <br/>
  <img src="DFNA21.png"/>
  <br/>
  <img src="DFNA22.png"/>
  <br/>
  <img src="DFNA24.png"/>
  <br/>
  <img src="DFNA25.png"/>
  <br/>
  <img src="DFNA27.png"/>
  <br/>
  <img src="DFNA28.png"/>
  <br/>
  <img src="DFNA31.png"/>
  <br/>
  <img src="DFNA33.png"/>
  <br/>
  <img src="DFNA36A.png"/>
  <br/>
  <img src="DFNA36notA.png"/>
  <br/>
  <img src="DFNA41.png"/>
  <br/>
  <img src="DFNA43.png"/>
  <br/>
  <img src="DFNA44.png"/>
  <br/>
  <img src="DFNA50.png"/>
  <br/>
  <img src="DFNA57.png"/>
  <br/>
  <img src="DFNA59.png"/>
  <br/>
</div>

</body>
