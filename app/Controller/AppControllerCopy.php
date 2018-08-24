<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
 
 
 #menu module from https://github.com/torifat/cake-menu_builder
class AppController extends Controller {
//	var $helpers = array('Form', 'Html', 'Session', 'Js', 'Usermgmt.UserAuth','MenuBuilder.MenuBuilder');
 //                 public $components = array('Session','RequestHandler', 'Usermgmt.UserAuth');	
	
	var $helpers = array('Form', 'Html', 'Session', 'Js', 'MenuBuilder.MenuBuilder');
		public $components = array('Session','RequestHandler');
		function beforeFilter(){
//			$this->userAuth();
			
			// Define your menu
    $menu = array(
        'left-menu' => array(
			array(
                'title' => 'Home',
                'url' => "/",
            ),
            
            array(
                'title' => 'Run AudioGene 4.0',
                'url' => array('controller' => 'analyses', 'action' => 'index'),
            ),
            
            array(
                'title' => 'Audioprofiles',
                'url' => array('controller' => 'audioprofiles', 'action' => 'index'),
            ),

            array(
                'title' => 'Audioprofile Surface Viewer',
                'url' => array('controller' => 'pages', 'action' => 'splash'),
            ),
            
            array(
                'title' => 'Citing Us',
                'url' => array('controller' => 'pages', 'action' => 'citing_us'),
            ),
            
            array(
                'title' => 'Genetic Screening Request',
                'url' => array('controller' => 'geneticscreeningrequests', 'action' => 'index'),
            ),
            
            array(
                'title' => 'Contact Us',
                'url' => array('controller' => 'pages', 'action' => 'contact_us'),
            ),
            
            array(
                'title' => 'Molecular Otolaryngology & Renal Research Laboratory (MORL)',
                'url' => 'https://www.medicine.uiowa.edu/morl/',
            ),

        ),
    );

    // For default settings name must be menu
    $this->set(compact('menu'));
		}

		private function userAuth(){
			$this->UserAuth->beforeFilter($this);
		}

}
