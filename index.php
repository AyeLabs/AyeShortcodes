<?php
/*
	Plugin Name: AyeShortcodes
	Plugin URI: http://ayelabs.com
	Description: Cleand design and helpful shortcodes, also a companion plugin for all themes available at AyeLabs.
	Version: 0.0.1
	Author: Hapiuc Robert, AyeLabs
	Author URI: http://ayelabs.com
	License: GPL
	Text domain: ayeshort
*/
require_once plugin_dir_path( __FILE__ ) . 'includes/class.AyeShortcodes.php';
$aye_shortcodes = new \Aye\Shortcodes\AyeShortcodes();

register_activation_hook( __FILE__, array( '\Aye\Shortcodes\AyeShortcodes()', 'activationHook' ) );
register_deactivation_hook( __FILE__, array( '\Aye\Shortcodes\AyeShortcodes()', 'deactivationHook' ) );