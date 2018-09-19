<?php
class AudiogramsController extends AppController{
	public $helpers = array('Html', 'Form');
	
	public function index(){
		//$this->loadModel('Loss_Hearing');
		$this->Audiogram->bindModel([
                        'belongsTo' => [
                                'Patient' => [
                                        'foreignKey' => 'PatientID',
                                        'joinType' => 'INNER'
                                ]
                        ]
                ]);
		 $this->Audiogram->recursive = 2;
		$this->set('audiograms', $this->Audiogram->find('all'));
	}

	 public function add() {
		//$this->set('csv', 'hello');
		
		$this->set('audiograms', $this->Audiogram->find('list', array('contain' => 'Patient')));

		if (isset($this->request->data['Pic'])){
			$this->Session->setFlash($this->data['Audiogram']['Patient']);
			$this->redirect(array('controller' => 'audiograms', 'action' => 'add')); 
		}
                else if($this->request->is('post')) {
			$csvLines = explode("\n", $this->data['Audiogram']['csv_data']);
                                //$this->Session->setFlash(implode(" ",$this->data));
                                //$this->redirect(array('controller' => 'audiograms', 'action' => 'add'));
                        if(strcmp($this->data['Audiogram']['input_type'],"S") == 0) {
                                //Check if there is more than one lines

                                $csvLines = explode("\n", $this->data['Audiogram']['csv_data']);
				$this->redirect(array('controller' => 'audiograms', 'action' => 'add')); 
				//$this->render('/Patients/insert');
                                if( count( $csvLines ) > 1 ) 
                                    {
                                    //print_r($this->data);
                                    $this->redirect(array('controller' => 'audiograms', 'action' => 'add')); 
                                        if ($this->Audiogram->Loss_Hearing->save($this->data))
                                        {
						$this->flash->set('Frequency Values have been loaded');
                                                //$saved_analysis = $this->Analysis->findById($this->Analysis->getInsertId());


                                                //$this->redirect(array('controller' => 'analyses', 'action' => 'results','run_id' => $saved_analysis['Audiogram']['run_id']));
                                                //$this->redirect(array('controller' => 'analyses', 'action' => 'confirmAudiograms','run_id' => $saved_analysis['Analysis']['run_id']));

                                        }
                                }

                        } 
                                
                       

                }

    }


}
