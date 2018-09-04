<?php
class Audiogram extends AppModel{
	#public $name 'Audiogram';
	public $primaryKey = 'AudiogramID';     
        public $belongTo = array(
		'Patient' => array(
                	'className' => 'Patient',
                	'foreignKey' => 'PatientID',
                ),
		'Method_of_Interpolation' => array(
                        'className' => 'Method_of_Interpolation',
			'foreignKey' => 'MethodID',
                )

        );

	public $hasMany = array(
		'Loss_Hearing' => array(
			'className' => 'Loss_Hearing',
			'foreignKey' => 'AudiogramID',
		)
	);
}
