<?php 
class Family_member extends AppModel {
	public $primaryKey = 'MemberID';
	public $belongTo = array(
		'Patient' => array(
			'className' => 'Patient',
			'foreignKey' => 'MemberID',
		),
		'Gender_information' => array(
			'className' => 'Gender_information',
			'foreignKey' => 'MemberID',
		)
	);	
}
