<?php
class Gender_Information extends AppModel{
	public $primaryKey = 'FamilyID';
	public $useTable = 'gender_informations';     
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
