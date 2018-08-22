<?php
//App::uses('ArraySource','Datasources.Model/DataSource');
class PatientsController extends AppController{
	public $helpers = array('Html', 'Form');
	public $newData = ' ';
	

	public function index(){
		$this->set('audiograms', $this->Audiogram->find('all'));
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
  public function formatter($json, $path)
    {
      $a = array();
      for ($x = 0; $x < count($path); $x++)
        {
              array_push($a, array('PatientID' => 1, 'AudiogramID' => $x + 1, 'Age' => $json['Age'], 'AudioPic' => $path[$x]));
        }
      $new = array(
        'Patient' => array('Gender' => $json['Gender'], 'Ethnicity' => $json['Ethnicity'], 'PatientID' => 1,
		'Audiogram' => $a, 'Gender_information' => array('FamilyID' => 1, 'Inheritance_Pattern' => $json['Inheritance_Pattern'], 'Genetic_Diagnosis' => $json['Genetic_Diagnosis']),
		'Family_member' => array('MemberID' => 1, 'Relationship' => $json['Relationship'])),
        //'Gender_information' => array('FamilyID' => 1, 'Inheritance_Pattern' => $json['Inheritance_Pattern'], 'Genetic_Diagnosis' => $json['Genetic_Diagnosis']),
        //'Family_member' => array('MemberID' => 1, 'Relationship' => $json['Relationship']),
        //'Audiogram' => $a,
      );
      
      return $new;
    }

    
	/**
	 * receiving infomation 
	 * Gender, Ethnicity, Genetic Diagnose, Inheritance Pattern, FamilyID, Age (conversion from date of birth), Relationship
	 * Date_of_Collection, PatientID, AudiogramID, MethodID, FamilyID, FrequencyID
	 */  
	public function insert(){
	            $path = array('/path/');
			$this->set('newData', '');
		// Get JSON encoded data submitted to a PUT/POST action
		if ($this->request->is('post')){
			$data = json_decode($this->request->data['object'], true);
                                    $newData = $this->formatter($data, $path);
                                    $this->set('newData', $newData);
			if ($this->Patient->saveAll($newData, array('deep' => true))){
                                        $this->Session->setFlash('The Post has been saved');
                                }
                            	else{
                                        $this->Session->setFlash('Error.');
                                }
			//debug($this->Audiogram->validationErrors);
			$this->render('/Patients/insert');
			return $this->redirect(array('controller' => 'patients', 'action' => 'insert'));
			if ($this->request->accepts('json')){
				$data = $this->request->input('json_decode', true);
				$data['Audiogram']['AudioPic'] = $path;
				unset($this->Audiogram->validate['AudioPic']);
				//$this->Recipe->create();
				if ($this->Audiogram->saveAssociated($dataInfo)){
					$this->Session->setFlash('The Post has been saved');
				}
				else{
					$this->Session->setFlash('Error.');
				}
				$info = TRUE;
			}
			else{
                        	$binary =$newData['upload_file']; //base64_decode($newData['upload_file']);
                        	$this->response->type('bitmap; charset=utf-8');
                        	$file = fopen(WWW_ROOT . 'img/Audiograms/' . $newData['name'], 'wb');
                        	fwrite($file, $binary);
                        	fclose($file);

				//$newData = $this->request->data;
				$this->set('newData', $newData);
		//if ($this->request->accepts('file')){
				//if (!empty($this->data) && is_uploaded_file($this->data['Audiogram']['file']['tmp_name'])){
					$this->render('/Audiograms/insert');
					$file = $newData['uploaded_file'];
				//	return $this->redirect(array('controller' => 'audiograms', 'action' => 'insert'));
					//$fileOk = $this->uploadFiles('img/Audiograms', $newData['file'], $newData['name']);
					move_uploaded_file($file['tmp_name'], WWW_ROOT . 'img/Audiograms/' . $file['filename']);
					$this->Session->setFlash('The Image has been stored');
					// will return
					//Array
					//(
					//	[urls] => Array
					//		(
					//			[0] => img/files/15_zamri.jpg
					//		)
					//
					//)	
					if (array_key_exists('url', $fileOk)) {
						// save the url in the form data
						$path = $fileOk['urls'][0];
						$picture = TRUE;
					}
				//$this->render('/Audiograms/insert');

			//}
		
		}
		//$picture = TRUE;
		$this->set('picture', $picture);
		$this->set('info', $info);
		$this->render('/Audiograms/insert');
		// $this->response->header('Location', '/Audiograms/insert');
        //return $this->response;
		return $this->redirect($this->referer());
		//return $this->redirect(array('controller' => 'audiograms', 'action' => 'insert'));



	}
	//$picture = TRUE;
	//$this->render();
  //              $this->set('picture', $picture);

	//return $this->redirect(array('controller' => 'audiograms', 'action' => 'insert'));
}
}
