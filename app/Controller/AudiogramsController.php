<?php
class AudiogramsController extends AppController{
	public $helpers = array('Html', 'Form');

	

	public function index(){
		$this->set('audiograms', $this->Audiogram->find('all'));
	}
	/**
	 * receiving infomation 
	 * Gender, Ethnicity, Genetic Diagnose, Inheritance Pattern, FamilyID, Age (conversion from date of birth), Relationship
	 * Date_of_Collection, PatientID, AudiogramID, MethodID, FamilyID, FrequencyID
	 */  
	public function insert(){
		$picture = FALSE;
		$info = FALSE;
		$path = '/app/';
		$this->set('picture', $picture);
		$this->set('info', $info);
		$this->set('newData', $this->data);
		//$this->render();
		// Get JSON encoded data submitted to a PUT/POST action
		if ($this->request->is('post')){
			$data = json_decode($this->request->data['object'], true);
			if ($this->Audiogram->saveAssociated($data)){
                                        $this->Session->setFlash('The Post has been saved');
                                }
                            	else{
                                        $this->Session->setFlash('Error.');
                                }
			$this->render('/Audiograms/insert');
			//$data = $this->request->input('json_decode', true);
			//$data = json_decode($this->request->data['object'], true);
			//$this->set('newData',$data);
			//$newData = $this->request->data;
			//$this->set('newData', $newData['tmp_name']);
			//$this->set('newData', $newData['file']['tmp_name']);
			//$this->set('newData', $newData['upload_file'][2]);
			//$this->set('newData1',$this->data['name']);

			//$this->render('/Audiograms/insert');
			//$binary =$newData['upload_file']; //base64_decode($newData['upload_file']);
			//$this->set('newData', $binary);
			//$this->render('/Audiograms/insert');
                        //$this->set('newData1',$this->data['name']);
                        //$this->render('/Audiograms/insert');
			//$this->response->type('bitmap; charset=utf-8');
			//$file = fopen(WWW_ROOT . 'img/Audiograms/' . $newData['name'], 'wb');
			//fwrite($file, $binary);
			///fclose($file);
			//$image = imagecreatefromjpeg($newData['upload_file']);
			//imagejpeg($image, WWW_ROOT . 'img/Audiograms/' . $newData['name']);
			return $this->redirect(array('controller' => 'audiograms', 'action' => 'insert'));
			//return $this->redirect($this->referer());
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
