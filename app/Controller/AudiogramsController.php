<?php
class AudiogramsController extends AppController{
	public $helpers = array('Html', 'Form');
	
	public function index(){
		$this->loadModel('Loss_Hearing');
		$this->set('audiograms', $this->Audiogram->find('all'));
	}

	 public function add() {
		$this->set('audiograms', $this->Audiogram->find('all', array('contain !=' => array('Loss_Hearing'))));
                if($this->request->is('post')) {

                        if(strcmp($this->data['Audiogram']['input_type'],"S") == 0) {
                                //Check if there is more than one lines

                                $csvLines = explode("\n", $this->data['Audiogram']['csv_data']);

                                if( count( $csvLines ) > 1 ) {
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
