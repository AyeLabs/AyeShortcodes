<?php

namespace Aye\Shortcodes;

class AyeShortcodes {

	// Stores all shortcodes informations
	protected $shortcodes; // maybe delete this one.

	// Shortcodes passed to this array are shortcode that the theme is compatible with
	protected $shortcodes_available;

	function __construct() {

		// Plugin shortcodes
		$this->shortcodes = array(
				'basic' => array('columns', 'tabs_vertical', 'tabs_horizontal', 'accordion', 'simple_button', 'icon_button', 'cta'),
				'charts_and_tables' => array('pricing', 'progress_bar'),
				'typography' => array('message_box', 'icon_list', 'icon_header', 'dropcap', 'blockquote'),
				'interactive' => array('google_maps', 'ba_slider', 'counter', 'count_down', 'image_mapping', 'timeline')
			);

		add_action( 'init', array( $this, 'pluginInit') );
	}

	/**
	 * init plugin after constructor and after theme is ready
	 */
	public function pluginInit() {
		$this->loadAssets();
		$this->shortcodes_available = apply_filters('aye_shortcodes_available_filter', $this->getAvailableShortcodes());
		$this->registerShortcodes();
	}

	/**
	 * Return a shortcodes list containing only shortcodes names
	 *
	 * @return array
	 */
	public function getAvailableShortcodes() {
		$all_shortcodes = array();
		foreach($this->shortcodes as $key => $shortcode) {
			foreach($shortcode as $short) {
				array_push($all_shortcodes, $short);
			}
		}

		return $all_shortcodes;
	}

	/**
	 * Check if the shortcode is available in the plugin
	 *
	 * @return boolean
	 */
	public function validShortcode($item) {
		return in_array($item, $this->getAvailableShortcodes());
	}

	/**
	 * Register enabled shortcodes
	 *
	 * @uses setAvailableShortcodes()
	 */
	public function registerShortcodes() {
		if($this->shortcodes_available) {
			foreach($this->shortcodes_available as $shortcode) {

				// Register if shortcode name and shortcode method are available 
				if(!shortcode_exists('aye_' . $shortcode) and method_exists($this, 'aye_' . $shortcode)) {
					add_shortcode( 'aye_' . $shortcode, array( $this, 'aye_' . $shortcode ) );
				}
			}
		}
	}



	function loadAssets() {

	}

	function enableShortcode($shortcode) {
		$shortcodes_enabled = get_option('aye_enables_shortcodes');

		if(!$shortcode)
			return;

		if(is_array($shortcodes_enabled)) {
			// Check if shortcode was already enabled
			if(!in_array($shortcode, $shortcodes_enabled)) {
				array_push($shortcodes_enabled, $shortcode);
				update_option('aye_enables_shortcodes', $shortcodes_enabled, false);
			}
			
		} else {

			// If option is not initiate, add it with the first shortcode enabled
			add_option('aye_enables_shortcodes', array($shortcode), false);
		}
		
	}

	function disableShortcode($shortcode) {
		$shortcodes_enabled = get_option('aye_enables_shortcodes');

		if(is_array($shortcodes_enabled)) {

			// Search, delete and update the shortcodes list
			$shortcode_delete = array_search($shortcode, $shortcodes_enabled);
			
			unset($shortcodes_enabled[$shortcode_delete]);

			update_option('aye_enables_shortcodes', $shortcodes_enabled, false);

		}
	}

	function activationHook() {
		
	}

	function deactivationHook() {
		
	}

}