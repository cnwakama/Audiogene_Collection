<h1>Audiograms</h1>



<?php echo $this->Html->div('patients');
//print_r($audiograms);
//$query = $this->Users->find()->contain('Cities');
//echo $this->Html->image('/img/Audiograms/Audiogram_Mon_Aug_20_15:46:40_CDT_2018.jpeg');
//print_r($audiograms);
?>

<?php foreach ($audiograms as $a): ?>
  <?php
	//$patientA= 1;
	 //$patientA = $this->Audiogram->find('all', array('Patient.PatientID' => $a['Audiogram']['PatientID']));
<<<<<<< HEAD
	//print_r($a);
=======
//	print_r($a);
>>>>>>> 46781edfd2a74c6fc122e8b935e719c362523a3e
    echo $this->Html->div('patient');
    echo $this->Html->div('column', "Patient: " .  $a['Audiogram']['AudiogramID']);
    echo $this->Html->image($a['Audiogram']['AudioPic']);
  ?>

  <?php if (sizeof($a['Loss_Hearing']) > 0): ?>
    <?php echo $this->Html->div('column'); ?>
   <table>
    <tr>
      <th>Frequency (Hz)<th/>
      <th>Hearing Loss (dB)<th/>
    </tr>
      <?php foreach ($a['Loss_Hearing'] as $f): ?>
        <tr>
          <td> <?php echo $f['Frequency'] ?> </td>
          <td> <?php echo $f['dB Loss'] ?> </td>
        </tr>
      <?php endforeach ?>
  <?php endif ?>
  <br></br>
  <div class="other">
    <fieldset>
      <legend>Other Information</legend>
        Age: <?php echo $a['Audiogram']['Age'] ?><br>
        Genetic Diagnosis: <?php echo $a['Patient']['Gender_information'][0]['Genetic_Diagnosis'] ?><br>
        Inheritance Pattern: <?php echo $a['Patient']['Gender_information'][0]['Inheritance_Pattern'] ?><br>
        Gender: <?php echo $a['Patient']['Gender'] ?><br>
        Ethnicity: <?php echo $a['Patient']['Ethnicity'] ?><br>
    </fieldset>
  </div>
<?php endforeach ?> 		
	

