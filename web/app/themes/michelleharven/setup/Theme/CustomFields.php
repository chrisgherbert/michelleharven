<?php
/**
 * This class defines custom fields for our post types
 */

namespace Theme;

class CustomFields {

	/**
	 * Optional custom field prefix
	 * @var string
	 */
	protected $prefix;
	/**
	 * Array of box names - correspond to method names
	 * @var array
	 */
	protected $boxes = array(
		'subtitle',
		'work_sample'
	);

	/**
	 * Constructor - should fire off all metabox creation when called.
	 */
	public function __construct(){
		$this->add_show_on_filters();
		$this->load_boxes();
	}

	///////////////
	// Metaboxes //
	///////////////

	/**
	 * Loop through our boxes property and invoke the corresponding
	 * function that will define its metabox(es)
	 */
	protected function load_boxes(){
		if ($this->boxes && !empty($this->boxes)){
			foreach ($this->boxes as $box) {
				add_action('cmb2_admin_init', array($this, $box));
			}
		}
	}

	public function front(){

		$cmb2 = new_cmb2_box( array(
			'id'           => 'front_page_details',
			'title'        => 'Front Page Details',
			'object_types' => array( 'page', ),
			'show_on' => array( 'key' => 'front-page' )
		) );

		$cmb2->add_field( array(
			'id'       => 'hero_image',
			'name'     => 'Hero Image',
			'type'     => 'file',
			'desc'     => 'An image that will appear prominently on the front page.',
			'options'  => array(
				'url'  => false
			)
		) );

		$this->subtitle_field($cmb2);

	}

	public function subtitle() {

		$cmb2 = new_cmb2_box( array(
			'id' => 'subtitle',
			'title' => 'Subtitle',
			'object_types' => array('page')
		) );

		$cmb2->add_field( array(
			'id' => 'subtitle',
			'name' => 'Subtitle',
			'type' => 'textarea_small',
			'desc' => '(Optional) Enter a subtitle',
		) );

	}

	public function work_sample(){

		$cmb2 = new_cmb2_box(array(
			'id' => 'work_sample',
			'title' => 'Info',
			'object_types' => array('work-sample')
		));

		$cmb2->add_field(array(
			'id' => 'external_url',
			'name' => 'URL',
			'type' => 'text_url'
		));

		$cmb2->add_field(array(
			'id' => 'publication',
			'name' => 'Publication Name',
			'type' => 'text'
		));

		$cmb2->add_field(array(
			'id' => 'work_type_term',
			'name' => 'Work Type',
			'type' => 'taxonomy_radio',
			'taxonomy' => 'work-sample-type',
			'remove_default' => true
		));

	}

	public function article(){

		$cmb2 = new_cmb2_box( array(
			'id'           => 'article_details',
			'title'        => 'Article Details',
			'object_types' => array( 'article', ),
		) );

		$this->subtitle_field($cmb2);

		$this->featured_video_url_field($cmb2);

	}

	/////////////////////
	// Reusable Fields //
	/////////////////////
	//
	// Easily reuse field definitions by passing in the
	// current $cmb2 object being manipulated

	/**
	 * Subtitle field
	 * @param  object $cmb2
	 */
	protected function subtitle_field($cmb2){
		return $cmb2->add_field( array(
			'id'       => 'subtitle',
			'name'     => 'Subtitle',
			'type'     => 'textarea_small',
			'desc'     => '(Optional) Enter a subtitle',
		) );
	}

	/**
	 * Featured Video URL field
	 */
	protected function featured_video_url_field($cmb2){
		return $cmb2->add_field( array(
			'id'       => 'featured_video_url',
			'name'     => 'Featured Video URL',
			'type'     => 'oembed',
			'desc'     => '(YouTube only) Add the URL of the YouTube video you would like featured. This will attempt to retrieve the thumbnail from YouTube and set it as the featured image.',
		) );
	}

	/////////////////////
	// Show On Filters //
	/////////////////////

	/**
	 * Create any custom show_on filters that we may want to utilize
	 */
	protected function add_show_on_filters(){
		add_filter('cmb2_show_on', array($this, 'show_on_front_page'), 10, 2);
	}

	public function show_on_front_page($display, $meta_box){

		// Move along if we haven't defined a "show_on" property
		if ( ! isset( $meta_box['show_on']['key'] ) ){
			return $display;
		}

		// Ignore if not the front-page "show_on"
		if ( 'front-page' !== $meta_box['show_on']['key'] ) {
			return $display;
		}

		$post_id = 0;

		// If we're showing it based on ID, get the current ID
		if ( isset( $_GET['post'] ) ) {
			$post_id = $_GET['post'];
		} elseif ( isset( $_POST['post_ID'] ) ) {
			$post_id = $_POST['post_ID'];
		}

		if ( ! $post_id ) {
			return false;
		}

		// Get ID of page set as front page, 0 if there isn't one
		$front_page = get_option( 'page_on_front' );

		// there is a front page set and we're on it!
		return $post_id == $front_page;

	}

}