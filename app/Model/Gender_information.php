<?php
class Gender_information extends AppModel{
	public $primaryKey = 'FamilyID';     
        public $belongTo = array(
		'Patient' => array(
                	'className' => 'Patient',
                	'foreignKey' => 'PatientID',
                ),

        );

	public $hasMany = array(
		'Family_member' => array(
			'className' => 'Family_member',
			'foreignKey' => 'FamilyID',
		)
	);
}
