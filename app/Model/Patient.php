<?php
class Patient extends AppModel{
	public $primaryKey = 'PatientID';     
        public $hasMany = array(
            'Audiogram' => array(
                        'className' => 'Audiogram',
                ),
	'Family_member' => array(
	            'className' => 'Family_member',
		),
        );

        public $hasOne = array(
            'Gender_information' => array(
                                    'className' => 'Gender_information',
                        )
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
