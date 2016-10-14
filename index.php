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

define('PLUGIN_URL', plugin_dir_url( __FILE__ ));
define('PLUGIN_PATH', plugin_dir_path( __FILE__ ));

require_once PLUGIN_PATH . 'includes/class.AyeShortcodesCore.php';
require_once PLUGIN_PATH . 'includes/class.AyeShortcodes.php';
$aye_shortcodes = new \Aye\Shortcodes\Core();

register_activation_hook( __FILE__, array( '\Aye\Shortcodes\Core()', 'activationHook' ) );
register_deactivation_hook( __FILE__, array( '\Aye\Shortcodes\Core()', 'deactivationHook' ) );