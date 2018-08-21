<?php
class Patient extends AppModel{
	public $primaryKey = 'PatientID';     
        public $hasMany = array(
                'Audiogram' => array(
                        'className' => 'Audiogram',
                ),
		'Gender_Information' => array(
			'className' => 'Gender_Information',
		),
		'Family_Member' => array(
			'className' => 'Family_Member',
		),
        );
      //  public $belongsTo = array(
        //        'Patient' => array(
          //              'className' => 'Patient',
            //    ),
               // 'Method_of_Interpolation' => array(
                //        'className' => 'Method_of_Interpolation',
               // )
       // );
}
