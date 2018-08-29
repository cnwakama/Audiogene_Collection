<h1>Audiograms</h1>



<?php echo $this->Html->div('patients');
//print_r($audiograms);
//$query = $this->Users->find()->contain('Cities');
echo $this->Html->image('/img/Audiograms/Audiogram_Mon_Aug_20_15:46:40_CDT_2018.jpeg');
?>

<? foreach ($audiograms as $a): ?>
  <?
    $this->Html->div('patient');
    $this->Html->div('column', "Patient:" + $a['Audiogram']['AudiogramID']);
    echo $this->Html->image($a['Audiogram']['AudioPic']);
  ?>

  <? if (sizeof($a['Loss_Hearing']) > 0): ?>
    <? echo $this->Html->div('column'); ?>
   <table>
    <tr>
      <th>Frequency (Hz)<th/>
      <th>Hearing Loss (dB)<th/>
    </tr>
      <? foreach ($a['Loss_Hearing'] as $f): ?>
        <tr>
          <td> <? echo $f['Frequency'] ?> </td>
          <td> <? echo $f['dB Loss'] ?> </td>
        </tr>
      <? endforeach ?>
  <? endif ?>
  <br></br>
  <div class="other">
    <fieldset>
      <legend>Other Information</legend>
        Age: <? echo $a['Audiogram']['Age'] ?><br>
        Genetic Diagnosis: <? echo $a['Patient']['Gender_information']['Gender Diagnosis'] ?><br>
        Inheritance Pattern: <? echo $a['Patient']['Gender_information']['Inheritance Pattern'] ?><br>
        Gender: <? echo $a['Patient']['Gender'] ?><br>
        Ethnicity: <? echo $a['Patient']['Ethnicity'] ?><br>
    </fieldset>
  </div>
<? endforeach ?> 		
	

