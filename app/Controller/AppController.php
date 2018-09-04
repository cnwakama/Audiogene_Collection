<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');
//App::uses('ArraySource','Datasources.Model/DataSource');
/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		https://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
//	var $helpers = array('Form', 'Html', 'Session', 'Js');
#, 'MenuBuilder.MenuBuilder');
        public $components = array('Session','RequestHandler');
#, 'Menu.MenuBuilder');

var $helpers = array('Form', 'Html', 'Session', 'Js', 'MenuBuilder.MenuBuilder');
                function beforeFilter(){
//                      $this->userAuth();

                        // Define your menu
    $menu = array(
        'left-menu' => array(
                        array(
                'title' => 'Home',
                'url' => "/",
            ),

            array(
                'title' => 'Add/Modify Data',
                'url' => array('controller' => 'audiograms', 'action' => 'add'),
            ),

            array(
                'title' => 'Audiograms',
                'url' => array('controller' => 'audiograms', 'action' => 'index'),
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
