<?php
class Loss_Hearing extends AppModel{
	public $useTable = 'loss_hearings';
	public $primaryKey = 'FrequencyID';     
        public $belongsTo = array(
               'Audiogram' => array(
                        'className' => 'Audiogram',
	            'foreignKey' => 'AudiogramID',
                ),
        );
}
