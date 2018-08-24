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

echo '<div id="csv" style=\'display="none"\'>'.$csv.'</div>';


?>


<body>

Audioprofiles are average audiograms based on all the audiograms in our dataset for each locus, and are grouped in two decade increments.

<br>
<?php if (strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') !== false)
{
    echo '<h1>';
    echo "Please use a browser other than Chrome to view the Surface Viewer";
    echo '</h1>';
    echo '<br>';
    echo '<body>';
    echo "Chrome does not currently support the technology required to run the Surface Viewer. We apologize for the inconvenience.";
    echo '</body>';
} ?>
<!--Uncomment for in browswer applet -->
<object classid="clsid:8AD9C840-044E-11D1-B3E9-00805F499D93"
      width="1000" height="542">
   <param name="code" value="edu.uiowa.MainApplet">
   <param name="archive" value="gluegen-rt.jar,jogl-all.jar,SurfViewerApp.jar,jzy3d-api-0.9.1.jar,jzy3d-swt-0.9.1.jar">
   <param name="jnlp_href" value="SurfViewer.jnlp">
   <comment>
     <embed code="edu.uiowa.MainApplet"
          width="1000" height="542"
          type="application/x-java-applet;version=1.6"
          pluginspage="http://java.sun.com/javase/downloads/ea.jsp"
          archive="gluegen-rt.jar,jogl-all.jar,SurfViewerApp.jar,jzy3d-api-0.9.1.jar,jzy3d-swt-0.9.1.jar"
          jnlp_href="SurfViewer.jnlp">
        <noembed>Sorry, no Java support detected.</noembed>
     </embed>
   </comment>
</object>

<br>
<br>
 <!--<script src="http://www.java.com/js/deployJava.js"></script>
    <script>
        // using JavaScript to get location of JNLP file relative to HTML page
        var dir = location.href.substring(0, location.href.lastIndexOf('/')+1);
        var url = dir + "JavaWebStart.jnlp";
        deployJava.createWebStartLaunchButton(url, '1.6.0');
    </script>-->


<div id="audiograms-data" style="display: none" value=
    	<?php
			print "'".$csv."'";
		?>>
</div>


<div id="plots">
    <div id="placeholder" style="width: 750px"></div>​
    </div>

</body>
