<?php

/**
Mult step form info:
http://stackoverflow.com/questions/8507639/cakephp-what-is-the-best-way-to-ensure-flow-unidirectional-between-actions
**/

class LossHearingController extends AppController {
    public $helpers = array('Html', 'Form');
    var $uses = array('Result','Analysis','Audioprofiles');
    
    public function index() {
    
		if($this->request->is('post')) {
		
			if(strcmp($this->data['Analysis']['input_type'],"S") == 0) {
				//Check if there is more than one lines
				
				$csvLines = explode("\n", $this->data['Analysis']['csv_data']);
				
				if( count( $csvLines ) > 1 ) {
					if ($this->Analysis->save($this->data))
					{
						
						$saved_analysis = $this->Analysis->findById($this->Analysis->getInsertId());
						
						
						$this->redirect(array('controller' => 'analyses', 'action' => 'results','run_id' => $saved_analysis['Analysis']['run_id']));
						//$this->redirect(array('controller' => 'analyses', 'action' => 'confirmAudiograms','run_id' => $saved_analysis['Analysis']['run_id']));
						
					}
				}
				
			} else {
				if (!empty($this->data))
				{
					if ($this->Analysis->save($this->data))
					{
						$this->Session->setFlash('File upload successful.');
						print_r($this->data);
						
						$saved_analysis = $this->Analysis->findById($this->Analysis->getInsertId());
						//print($saved_analysis['Analysis']['run_id']);
						//$this->Session->write('Audiogene.analysis_step', '2');
						//$this->Session->write('Audiogene.analysis_id', );
						$this->redirect(array('controller' => 'analyses', 'action' => 'results','run_id' => $saved_analysis['Analysis']['run_id']));
						
					}
				}
			}
		
		}
  	
    }
    
    public function results() {
    	
    	$this->set('run_id', $this->request->params['named']['run_id']);
			
		if(!isset($this->request->params['named']['run_id'])) {
			$this->redirect(array('controller' => 'analyses', 'action' => 'index'));
		}
		
		$run_id = $this->request->params['named']['run_id'];
		
		$saved_analysis = $this->Analysis->findByRunId($run_id);
		
		$this->set('audiograms',$saved_analysis['Analysis']['csv_data']);
		
		$this->set('audioprofiles', $this->Audioprofiles->find('all'));
		
		$this->set('run_id', $run_id);
		
		///*added by ian 6/6/16*/$input_inheritance = $saved_analysis['Analysis']['input_inheritance'];
		///*added by ian 6/6/16*/$this->set('input_inheritance', $input_inheritance);
    	
    	
    }
    
    
    /* Deprecated */
    public function confirmAudiograms() {
    
    	if($this->request->is('post')) {
    		$this->redirect(array('controller' => 'analyses', 'action' => 'selectLoci','run_id' => $saved_analysis['Analysis']['run_id']));
    	} else {
			$this->set('run_id', $this->request->params['named']['run_id']);
			
			if(!isset($this->request->params['named']['run_id'])) {
				$this->redirect(array('controller' => 'analyses', 'action' => 'index'));
			}
			
			$run_id = $this->request->params['named']['run_id'];
			
			$analysis= $this->Analysis->findByRunId($run_id);
			
			$this->set('analysis', $analysis);
    	}
    	
    }
    
    public function selectLoci() {
    
    }
    
    public function runAnalysis() {
    
    	if(isset($this->request->query['run_id'])) {
    		$runId = $this->request->query['run_id'];
    		
    		
    		if($this->Result->findByRunId($runId) == null) {
    		
				$analysis = $this->Analysis->findByRunId($runId);
				
				
				//print_r($analysis);
				
				$tmpfname = tempnam("/tmp", "FOO");
				$handle = fopen($tmpfname, "w");
				fwrite($handle, $analysis['Analysis']['csv_data']);
				fclose($handle);
				
				#echo('/bin/bash /Library/WebServer/Documents/cakephp/AudioGene/run_prob_classifier.sh '.escapeshellarg($tmpfname));
				
				$email = $analysis['Analysis']['email'];
				$run_id = $analysis['Analysis']['run_id'];
				///*added by ian 6/6/16*/$input_inheritance = $analysis['Analysis']['input_inheritance'];
				
				$execString = '/bin/bash /var/www/html/audiogene/audiogene_site_dataset/classifier/run_prob_classifier.sh '.escapeshellarg($tmpfname).' '.escapeshellarg($email).' '.escapeshellarg($run_id);
				//print_r($execString);
				$output = array();
				exec('/bin/bash /var/www/html/audiogene/audiogene_site_dataset/classifier/run_prob_classifier.sh '.escapeshellarg($tmpfname).' '.escapeshellarg($email).' '.escapeshellarg($run_id),$output);
				
				//Run dominant vs recessive predictions
				$output_dominant = array();
				exec('/bin/bash /var/www/html/audiogene/audiogene_site_dataset/classifier/run_recess_classifier.sh '.escapeshellarg($tmpfname),$output_dominant);
				
				
				$version = file_get_contents('/var/www/html/audiogene/audiogene_site_dataset/VERSION');
				
				$version = rtrim($version);
				
				//unlink($tmpfname);
				//unlink($tmpfname.".out");
				
				//print_r($output);
				
				$resultString = implode("\n",$output);
				$resultDominantString = implode("\n",$output_dominant);
				
				if(count($output) > 0) {    		
					$this->Result->create();
					$this->Result->set('run_id', $runId);
					$this->Result->set('results', $resultString);
					$this->Result->set('results_dominant', $resultDominantString);
					$this->Result->set('version', $version);
					$this->Result->save();
				}
    			$this->set('results', $resultString);
    			$this->set('results_dominant', $resultDominantString);
    			//$this->set('_serialize',  "results");
    			$this->set('_serialize',  array ("results" ,"results_dominant"));
    		} else {
    			$result = $this->Result->findByRunId($runId);
    			//print_r($result);
    			$this->set('results', $result['Result']['results']);
    			$this->set('results_dominant', $result['Result']['results_dominant']);
    			$this->set('_serialize',  array ("results" ,"results_dominant"));
    			//$this->set('_serialize',  "results");
    		}    		
    	}
    
    	
    }

}
