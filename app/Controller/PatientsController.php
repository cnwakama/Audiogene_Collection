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
     /** for (int $i = 0; $i < count($json['files']); $i++)
      {
        $binary = base64_decode($json['file'][$i]);
        $this->response->type('bitmap; charset=utf-8');
        array_push($path, WWW_ROOT . 'img/Audiograms/' . $json['names'][$i])
        $file = fopen($path[$i], 'wb');
        fwrite($file, $binary);
        fclose($file);
      }*/

      
      return $new;
    }

  

    
	/**
	 * receiving infomation 
	 * Gender, Ethnicity, Genetic Diagnose, Inheritance Pattern, FamilyID, Age (conversion from date of birth), Relationship
	 * Date_of_Collection, PatientID, AudiogramID, MethodID, FamilyID, FrequencyID
	 */  
  public function insert(){
	$this->set('newData', 'hi');
    if ($this->request->is('post'))
    {
	$this->render('/Patients/insert');
	 return $this->redirect(array('controller' => 'patients', 'action' => 'insert'));
      $data = json_decode($this->request->data['object'], true);
			$this->set('newData', count($data['files']));
			return $this->redirect(array('controller' => 'patients', 'action' => 'insert'));
     // $formattedData = $this->formatter($data);

      if ($this->Patient->saveAll($newData, array('deep' => true)))
      {
        $this->Session->setFlash('The Post has been saved');
      }
      else
      {
        $this->Session->setFlash('Error.');
      }
      $this->render('/Patients/insert');

		//	return $this->redirect(array('controller' => 'patients', 'action' => 'insert'));
    }
}
}
