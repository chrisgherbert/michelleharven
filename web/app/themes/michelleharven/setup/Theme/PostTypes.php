<?php
/**
 * This class creates our post types
 */

namespace Theme;

class PostTypes {

	protected $types = array(
		'work_sample'
	);

	public function __construct(){
		if ($this->types && !empty($this->types)){
			foreach ($this->types as $type) {
				$this->$type();
			}
		}
	}

	public function work_sample(){

		register_via_cpt_core(
			array(
				'Work Sample',
				'Work Samples',
				'work-sample'
			),
			array(
				'menu_icon' => 'dashicons-media-text',
				'supports' => array('title', 'thumbnail'),
				'has_archive' => true
			)
		);

	}

}