<?php
/*
	Plugin Name: AyeShortcodes
	Plugin URI: http://ayelabs.com
	Description: Helpful shortcodes with clean design, also a companion plugin for all themes available at AyeLabs. Build with developers and performance in mind.
	Version: 0.1-alpha
	Author: Hapiuc Robert, AyeLabs
	Author URI: http://ayelabs.com
	License: GPL
	Text domain: ayeshort
*/

define( 'PLUGIN_URL',  plugin_dir_url( __FILE__ ) );
define( 'PLUGIN_PATH', plugin_dir_path( __FILE__ ) );

require_once PLUGIN_PATH . 'includes/class.AyeShortcodesCore.php';
require_once PLUGIN_PATH . 'includes/class.AyeShortcodes.php';
require_once PLUGIN_PATH . 'includes/class.AyeShortcodes.Assets.php';
$aye_shortcodes = new \Aye\Shortcodes\Core();

register_activation_hook( __FILE__, array( '\Aye\Shortcodes\Core()', 'activationHook' ) );
register_deactivation_hook( __FILE__, array( '\Aye\Shortcodes\Core()', 'deactivationHook' ) );