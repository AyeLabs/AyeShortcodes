<?php

namespace Aye\Shortcodes;

class AyeShortcodes {
	public $shortcodes = array();

	function __construct() {

		// Available shortcodes
		$shortcodes = array(
				'basic' => array('columns', 'tabs_vertical', 'tabs_horizontal', 'accordion', 'simple_button', 'icon_button', 'cta'),
				'charts_and_tables' => array('pricing', 'progress_bar'),
				'typography' => array('message_box', 'icon_list', 'icon_header', 'dropcap', 'blockquote'),
				'interactive' => array('google_maps', 'ba_slider', 'counter', 'count_down', 'image_mapping', 'timeline')
			);
	}
}