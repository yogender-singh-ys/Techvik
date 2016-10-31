<?php

class Category extends AppModel {
	public $name = 'Category';
	public $hasMany = array(
					        'Categories' => array(
					            'className' => 'Category',
					            'conditions' => array('Categories.deleted' => '1'),
					         )
    						);
}

?>