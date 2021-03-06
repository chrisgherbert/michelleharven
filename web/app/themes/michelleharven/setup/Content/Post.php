<?php
/**
 * The base Post class for our site
 */

namespace Content;

use bermanco\ExtendedTimberClasses;

class Post extends ExtendedTimberClasses\Post {

	public $PostClass = '\Content\Post';

	public function say_hello(){
		return 'hello!';
	}

	public function cf_field($key){
		return carbon_get_post_meta($this->ID, $key);
	}

}