<h1>Results</h1>

<?php
#Import JS files
echo $this->Html->script('jquery-1.8.2.min',false);
echo $this->Html->script('jquery-ui-1.8.21.custom.min',false);
echo $this->Html->script('fix_ie_console',false);

#ref: http://neteye.github.com/activity-indicator.html
//echo $this->Html->script('jquery.activity-indicator.min',false);

echo $this->Html->script('results-worker',false);

echo $this->Html->script('highcharts',false);

echo $this->Html->script('highcharts.exporting',false);

#echo $this->Html->script('fauxconsole',false);


echo $this->Html->script('generate_plots',false);
echo $this->Html->script('plot_audiogram',false);
echo $this->Html->script('generate_audioprofile_plot',false);

//echo $this->Html->css('ui-lightness/jquery-ui-1.8.21.custom');

#Used for debugging
echo $this->Html->script('konami',false);

echo $this->Html->css('results');

#Progress bar from: http://ajaxload.info/
echo '<div id="run_id" value="'.$run_id.'" ></div>';
///*added by Ian 6/6/16*/echo '<div id="input_inheritance" value="'.$input_inheritance.'"></div>';


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
?>

<div id="audioprofiles-data" style="display: none" value=<?php print "'".$csv."'";?>>
</div>

<body>

<div id="progress">
<div id="progress-indicator"><img src="/img/progress.gif"></img></div>
<div id="progress-text"><b>Status:</b> Running analysis...</div>
</div>

<div class="experimental" style="display: none">
<label><u><b>Dominant</b></u></label>
</div>
<div id="results-data" style="display: none"></div>

<div id="results-content" ></div>

<div class="experimental" style="display: none">
<br>
<label><u><b>Family</b></u></label>
<div id="results-family-content"><div id="tableWrap"><table id="resultTable" style="width: 800px;"><tbody><tr><th></th><th>1st Prediction</th><th>2nd Prediction</th><th>3rd Prediction</th></tr><tr><td>Family</td><td>DFNA8/12</td><td>DFNA2notAnotB</td><td>DFNA44</td></tr></tbody></table></div></div>
<br>
<label><u><b>Recessive</b></u></label>
<br>
<div id="results-recessive-content">
<div id="tableWrap"><table id="resultTable" style="width: 400px;"><tbody><tr><th>ID</th><th>Recessive Prediction</th></tr><tr><td>Name 0</td><td>T/T</td></tr><tr><td>Name 1</td><td>T/NT</td></tr><tr><td>Name 2</td><td>NT/NT</td></tr><tr><td>Name 3</td><td>T/T</td></tr><tr><td>Name 4</td><td>T/T</td></tr></tbody></table></div></div>
</div>

<button id="more-button" style="">Show more predictions</button>

<fieldset id="plots-fieldset" class="collapsed collapsible">
    <legend><a id="audiogram-field" href="#">Audiograms</a></legend>
    
    <div id="audiograms-data" style="display: none" value=
    	<?php
			print "'".$audiograms."'";
		?>>
    </div>
    <div  style=""><input id="show-audioprofile-checkbox"  type="checkbox">Show Audioprofiles</input></div>
    <select id="audioprofile-select" style="display: none"></select>
    
    	<div id="wrap">
    	<table border="0">
    	<tr>
		<td><div id="plots">
        		<div id="placeholder" style="width: 600px"></div>​
    		</div></td>
		<td><div id="audioprofiles" style=";">
        		<div id="audioprofile-placeholder" style="width: 600px;"></div>​
    		</div>​</td>
		</tr>
		</table>
	</div>
    
	
</fieldset>

<fieldset id="loci-fieldset" class="collapsible" style="display: none;">
    <legend><a href="#">Show/Hide Loci</a></legend>
    <div id="loci">
    
    <table class="loci_selection">
 	<thead><tr><th class="select-all"></th><th>Number of Patients</th><th>Number of Audiograms</th> </tr></thead>
	<tbody>
 	
 	<tr class="odd"><td><div class="form-item" id="edit-DFNA44-wrapper"><label class="option"><input type="checkbox" name="DFNA44" id="edit-DFNA44" value="1" checked="yes;" class="form-checkbox"> DFNA44</label><td></td></tr>
</div>
</td>
    </tbody>
	</table>
    
    </div>
	
</fieldset>

<div id="results-histogram"></div>

<div id="results-info" style="line-height: 200%;">

<br>If you are interested in genetic testing and would like to contact us to consider this option, please use this <a href="../../geneticscreeningrequests">form</a>.

<br>To learn more about our clinical and research studies, visit our website at <a href="https://www.medicine.uiowa.edu/morl/">https://www.medicine.uiowa.edu/morl/</a>

<br>Results were generated with version 4.0 of AudioGene. See version history.

</div>
