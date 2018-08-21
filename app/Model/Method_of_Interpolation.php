<?php
class Method_of_Interpolation extends AppModel{
	public $name = 'method_of_interpolations';
	public $primaryKey = 'MethodID';     
        public $hasMany = array(
                'Audiogram' => array(
                        'className' => 'Audiogram',
                )
        );
}
