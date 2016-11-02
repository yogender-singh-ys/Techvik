<?php

class Article extends AppModel {
	public $name = 'Article';
	public $hasMany = array(
						        'Categories' => array(
						            'className' => 'ArticleCategory'
						         ),
						         'Videos' => array(
						            'className' => 'Video'
						         ),
						         'Images' => array(
						            'className' => 'Image'
						         )
                           );
}

?>