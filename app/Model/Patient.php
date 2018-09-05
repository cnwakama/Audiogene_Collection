<?php
class Patient extends AppModel{
	public $primaryKey = 'PatientID';     
        public $hasMany = array(
            'Audiogram' => array(
                        'className' => 'Audiogram',
			'foreignKey' => 'PatientID',
                ),
	'Family_member' => array(
	            'className' => 'Family_member',
			'foreignKey' => 'PatientID',
		),
	'Gender_information' => array(
                                    'className' => 'Gender_information',
                                       'foreignKey' => 'PatientID',)
        );

        /*public $hasOne = array(
            'Gender_information' => array(
                                    'className' => 'Gender_Information',
					'foreignKey' => 'PatientID',
                        )*/
       // );
      //  public $belongsTo = array(
        //        'Patient' => array(
          //              'className' => 'Patient',
            //    ),
               // 'Method_of_Interpolation' => array(
                //        'className' => 'Method_of_Interpolation',
               // )
       // );
}
