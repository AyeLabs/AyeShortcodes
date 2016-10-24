<?php

namespace Aye\Shortcodes;

class Helpers {

	// Load assets Class
	public $assets;

	public function __construct() {
		$this->assets = new Assets();
	}

	/**
	 * Allow shortcodes to manage icon packes easily
	 *
	 * @param string $set - Icon set keyword, used to loadStyle. To load scripts use a set condition.
	 * @param string $icon - Icon name, without any prefix
	 * @param boolean $class - If true, class will be returned. use the apropriate class condition on return.
	 */
	public function getIcon($set = 'fontawesome', $icon = null, $class = null) {

		// Require assets
	    $this->assets->loadStyle($set);

	    // Return formated markup
	    if($set == 'fontawesome') {
	    	return ($class ? 'fa fa-'. esc_attr($icon) : '<i class="fa fa-'. esc_attr($icon) .'"></i>');
	    }
	}
}