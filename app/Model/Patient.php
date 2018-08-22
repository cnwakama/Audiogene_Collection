<?php
class Patient extends AppModel{
	public $primaryKey = 'PatientID';     
        public $hasMany = array(
            'Audiogram' => array(
                        'className' => 'Audiogram',
                ),
	'Family_Member' => array(
	            'className' => 'Family_Member',
		),
        );

        public $hasOne = array(
            'Gender_Information' => array(
                                    'className' => 'Gender_Information',
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
