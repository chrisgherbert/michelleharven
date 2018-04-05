<?php
/**
 * Class to define our taxonomies
 *
 * Depends on the webdevstudios/taxonomy_core library
 */

namespace Theme;

class Taxonomies {

	protected $taxonomies = array(
		'work_sample_type'
	);

	public function __construct(){

		if ( ! class_exists( 'Taxonomy_Core' ) ){
			error_log('Please load the webdevstudios/taxonomy_core library');
			return false;
		}

		if ($this->taxonomies && !empty($this->taxonomies)){
			foreach ($this->taxonomies as $taxonomy) {
				$this->$taxonomy();
			}
		}

	}

	////////////////
	// Taxonomies //
	////////////////

	public function work_sample_type(){

		register_via_taxonomy_core(
			array(
				'Work Type',
				'Work Types',
				'work-sample-type'
			),
			array(
				'description' => 'The type of work',
				'show_admin_column' => true,
				'query_var' => true
			),
			array('work-sample')
		);

	}

	public function department(){

		register_via_taxonomy_core(
			array(
				'Department', // Singular Name
				'Departments', // Plural Name
				'department'
			),
			array(
				'description' => 'This is a department made up of people',
				'hierarchical' => true, // "true" for category-like interface, "false" for tag-link interface,
				'show_ui' => true,
				'show_admin_column' => false,
				'query_var' => true
			),
			array('person') // Object types (custom post types) to include
		);

	}

}