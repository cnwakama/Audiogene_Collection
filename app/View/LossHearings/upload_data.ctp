<h1>AudioGene</h1>

<?php

echo $this->Form->create('Analysis', array('enctype' => 'multipart/form-data'));

echo $this->Form->input('filepath', array('type' => 'file'));

echo $this->Form->input('email');

echo $this->Form->end('Next Step');

?>