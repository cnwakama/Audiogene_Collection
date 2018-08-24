<?php
class AudioprofilesController extends AppController {
    public $helpers = array('Html', 'Form');
    var $uses = array('Audioprofiles');
    
    public function index() {
    	$this->set('audioprofiles', $this->Audioprofiles->find('all'));
    }

    public function applet42random(){
	$this->set('audioprofiles', $this->Audioprofiles->find('all'));
    }
    
    public function export() {
    	//$this->autoRender = false;
    	$this->layout = 'image';

    	if(isset($this->request->params['named']['locus'])) {
    	 	$locus = $this->request->params['named']['locus'];
    	 	$this->set('audioprofiles', $this->Audioprofiles->findAllByLocus( $locus ));
    	} else {
    		$this->set('audioprofiles', null);
    	}
    }
    
}

?>
