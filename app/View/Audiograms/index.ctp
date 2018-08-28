<h1>Audiograms</h1>

<?php
#Import JS files
#echo $this->Html->script('jquery-1.8.2.min',false);
#echo $this->Html->script('jquery-ui-1.8.21.custom.min',false);
#echo $this->Html->script('fix_ie_console',false);

#ref: http://neteye.github.com/activity-indicator.html
//echo $this->Html->script('jquery.activity-indicator.min',false);

//echo $this->Html->script('results-worker',false);

//echo $this->Html->script('highcharts',false);

//echo $this->Html->script('highcharts.exporting',false);

#echo $this->Html->script('audioprofiles',false);

#echo $this->Html->script('plot_audiogram',false);

//echo $this->Html->css('results');

#print_r($audioprofiles[0]['Audioprofiles']);

echo $this->Html->div('patients');
//print_r($audiograms);
echo $this->Html->image('/img/Audiograms/Audiogram_Mon_Aug_20_15:46:40_CDT_2018.jpeg');
foreach ($audiograms as $a){
	//$image = 
            echo $this->Html->image('/img/Audiograms/Audiogram_Mon_Aug_20_15:46:40_CDT_2018.jpeg');
//$a['Audiogram']['AudioPic'];
	//echo "<img src=$image/>";
}
/**
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
#echo '<div id="csv">'.$csv.'</div>';*/

?>
