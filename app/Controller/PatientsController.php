<?php
//App::uses('ArraySource','Datasources.Model/DataSource');
class PatientsController extends AppController{
	public $helpers = array('Html', 'Form');
	public $newData = ' ';
	

	public function index(){
		$this->set('audiograms', $this->Patient->find('all'));
	}
  /**
    * format json object and array of $paths to follow the schema of the Table Patient in the
    * database
    * Current Model of Patient
    * public $hasMany = array(
    *        'Audiogram' => array(
    *                    'className' => 'Audiogram',
    *            ),
    *        'Family_Member' => array(
    *                    'className' => 'Family_Member',
    *                    ),
    *    );

    *   public $hasOne = array(
    *        'Gender_Information' => array(
    *                                'className' => 'Gender_Information',
    *                    )
    *    );
  **/
  private function formatter($json)
   {
      $a = array();
      $path = array();
      for ($i = 0; $i < count($json['files']); $i++)
      {
        $binary = base64_decode($json['files'][$i]);
        $this->response->type('bitmap; charset=utf-8');
        array_push($path, 'img/Audiograms/' . $json['names'][$i]);
        $file = fopen(WWW_ROOT .$path[$i], 'wb');
        fwrite($file, $binary);
        fclose($file);
      }
			//return $a;

	//producing IDs and checking if they are in the database

      do
      { 
        $randID = rand(100000, 999999);
      
      }while ($this->Patient->Audiogram->hasAny(['AudiogramID BETWEEN ? AND ?' => array($randID - 1, $randID + count($json['files']))]));
      $c = $randID;

      do
      { 
        $randID = rand(100000, 999999);
      
      }while ($this->Patient->hasAny(['PatientID' => $randID]));
      $y = $randID;

      do
      {
        $randID = rand(100000, 999999);

      }while ($this->Patient->Gender_Information->hasAny(['FamilyID' => $randID]));
      $z = $randID;

      do
      {
        $randID = rand(100000, 999999);

      }while ($this->Patient->Family_member->hasAny(['MemberID' => $randID]));
      $b = $randID;

      for ($x = 0; $x < count($path); $x++)
        {
		/*while ($this->Patient->Audiogram->hasAny(['AudiogramID' => ($c + $x]))
		{
			$c++;
		}*/
              array_push($a, array('AudiogramID' =>$x + $c, 'Age' => $json['Age'], 'AudioPic' => $path[$x]));
        }
      $new = array(
        'Patient' => array('Gender' => $json['Gender'], 'Ethnicity' => $json['Ethnicity'], 'PatientID' => $y,
        'Audiogram' => $a,
        'Gender_Information' => array(
          array('FamilyID' => $z, 'Inheritance_Pattern' => $json['Inheritance_Pattern'], 'Genetic_Diagnosis' => $json['Genetic_Diagnosis'])),
        'Family_member' => array(
          array('MemberID' => $b, 'Relationship' => $json['Relationship'])),)
      );
 	return $new;
    }

  

    
	/**
	 * receiving infomation 
	 * Gender, Ethnicity, Genetic Diagnose, Inheritance Pattern, FamilyID, Age (conversion from date of birth), Relationship
	 * Date_of_Collection, PatientID, AudiogramID, MethodID, FamilyID, FrequencyID
	 */  
  public function insert(){
	$this->set('newData', 'hi');
	$formattedData = '';
    if ($this->request->is('post'))
    {
	
	//$this->render('/Patients/insert');
	// return $this->redirect(array('controller' => 'patients', 'action' => 'insert'));
  		$json = json_decode($this->request->data['object'], true);
      $formattedData = $this->formatter($json);
			$this->set('newData', $formattedData);
      $this->render('/Patients/insert');
	return $this->redirect(array('controller' => 'patients', 'action' => 'insert'));

      if ($this->Patient->saveAll($formattedData, array('deep' => true)))
      {
        $this->Session->setFlash('The Post has been saved');
      }
      else
      {
        $this->Session->setFlash('Error.');
      }
      $this->render('/Patients/insert');

	return $this->redirect(array('controller' => 'patients', 'action' => 'insert'));
    }
}
}
