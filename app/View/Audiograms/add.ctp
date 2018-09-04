
<?php

?>


<h2>Adding Hearing Loss Data</h2>

<div id="top-header"><font size="5">Upload Audiogram</font></div>

<div id="instructions">
File type: Please download the template below and fill in your data. Please be sure to save the file as a 2003 Excel spreadsheet with the xls extension, and not as a 2008 Excel file format with the xlsx extension. The patient data goes on the first sheet and the audiograms for the patients are placed on the second sheet.
</div>
<br>
<a href="/pages/audiogene_template">template.xls</a>
<br>
<br>
<?php

$this->Html->css(array('analysis','slick_grid/jquery-ui-1.8.5.custom','slick_grid/slick-default-theme.css','slick_grid/slick.grid'), null, array('inline' => false));
echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js',false);
//echo $this->Html->script('scripts2',false);

echo $this->Html->script('fix_ie_console',false);

$scripts = array('slick_grid/slick.cellrangedecorator.js',
                                 'slick_grid/slick.cellrangeselector.js',
                                 'slick_grid/slick.cellselectionmodel.js',
                                 'slick_grid/jquery.event.drag-2.0.min.js',
                                 'slick_grid/slick.cellcopymanager.js',
                                 'slick_grid/slick.core.js',
                                 'slick_grid/slick.editors.js',
                                 'slick_grid/slick.grid.js',
                                 'slick_grid/slick.checkboxselectcolumn.js',
                                 'slick_grid/audiogene_table.js',
                                 'slick_grid/slick.rowselectionmodel.js',
                                 /*'audiogene.js'*/);
echo $this->Html->script($scripts,false);

#Used for debugging
echo $this->Html->script('konami',false);

echo $this->Form->create('LossHearing', array('enctype' => 'multipart/form-data'));

echo '<div id="input-options"><label><b>How do you want to input your audiograms:</b></label>';

$radioAttributes = array( 'legend' => false, 'value' => 'S');

echo $this->Form->radio('input_type', array('F' => 'Upload File','S' => 'Spreadsheet'),$radioAttributes);

echo "</div>";

?>

<fieldset id="spreadsheet-group" style="display: none;">
<legend>Live Spreadsheet</legend>
<div>
 Audiograms can be entered into the following spreadsheet instead of using the excel spreadsheet.  The combination of ID, Age, and Ear must be unique.  Frequency values can be missing, but each audiogram must have at least four frequency values filled.<br>
<ul>
<li><b>Add New Row</b> - Add a new row to the spreadsheet.</li>
<li><b>Delete Rows</b> - Deletes any selected row.</li>
<li><b>Duplicate Row</b> - Duplicates the selected row.</li>
<li><b>Load Demo Data</b> - Generates random data, and can be used to see how AudioGene works.  This will clear any entered data.</li>
</ul>
</div>

<div id="myGrid" style="width: 974px; height: 250px; overflow-x: hidden; overflow-y: hidden; outline-width: 1px; outline-style: initial; outline-color: initial; position: relative; "></div>

<div id="gridButtons"> 
 <button type="button" id="add-new-row">Add New Row</button>
 <button type="button" id="delete-rows" disabled="">Delete</button>
 <button type="button" id="duplicate-row" disabled="">Duplicate Row</button>
 <button type="button" id="load-demo-data">Load Demo Data</button>
</div>

</fieldset>



<?php

//echo $this->Form->textarea('csv_data', array('rows' => '5', 'cols' => '5'));

echo $this->Form->input('filepath', array('type' => 'file','div' => array('id' => 'file-upload'), 'label' => 'Excel File'));

//echo '<div id="experimental" style="display: none">';

//echo '<br><div id="input-family"><label><b>Are the individuals singletons or from the same family:</b></label></div>';

//$familyRadioAttributes = array( 'legend' => false, 'value' => 'S');

//echo $this->Form->radio('input_family', array('S' => 'Singletons','F' => 'Same Family'),$familyRadioAttributes);
//echo '<br><br>';


//echo '<br><div id="input-inheritance"><label><b>What is the believed inheritance pattern:</b></label></div>';

//$inheritanceRadioAttributes = array( 'legend' => false, 'value' => 'D');

//echo $this->Form->radio('input_inheritance', array('D' => 'Dominant','R' => 'Recessive', 'U' => 'Unknown'),$inheritanceRadioAttributes);
//echo '<br><br>';

//echo '</div>'; 

//echo '</div>'; 
echo $this->Form->input('email');

echo $this->Form->end('Next Step'); //outputs stray

?>
