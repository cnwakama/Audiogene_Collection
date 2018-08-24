<?php

echo $this->Html->script('jquery-1.8.2.min',false);
echo $this->Html->script('jquery-ui-1.8.21.custom.min',false);
echo $this->Html->script('fix_ie_console',false);

#ref: http://neteye.github.com/activity-indicator.html
//echo $this->Html->script('jquery.activity-indicator.min',false);

//echo $this->Html->script('results-worker',false);

echo $this->Html->script('highcharts',false);

//echo $this->Html->script('highcharts.exporting',false);

echo $this->Html->script('audioprofiles',false);

echo $this->Html->script('plot_audiogram',false);

//echo $this->Html->css('results');

//print_r($audioprofiles);


echo '<div id="csv" style=\'display="none"\'>'.$csv.'</div>';
?>


<body>
<div id="audiograms-data" style="display: none" value=
    	<?php
			print "'".$csv."'";
		?>>
</div>


<div id="plots">

</body>
