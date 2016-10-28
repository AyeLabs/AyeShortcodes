<?php
/*
AyeShortcodes is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
AyeShortcodes is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with AyeShortcodes. 
*/
/*
	Plugin Name: AyeShortcodes
	Plugin URI: http://ayelabs.com
	Description: Helpful shortcodes with clean design, also a companion plugin for all themes available at AyeLabs. Build with developers and performance in mind.
	Version: 0.1-alpha
	Author: Hapiuc Robert, AyeLabs
	Author URI: http://ayelabs.com
	License: GPL2
	Text domain: ayeshort
*/

define( 'PLUGIN_URL',  plugin_dir_url( __FILE__ ) );
define( 'PLUGIN_PATH', plugin_dir_path( __FILE__ ) );

require_once PLUGIN_PATH . 'includes/class.AyeShortcodes.Core.php';
require_once PLUGIN_PATH . 'includes/class.AyeShortcodes.Assets.php';
require_once PLUGIN_PATH . 'includes/class.AyeShortcodes.Helpers.php';
require_once PLUGIN_PATH . 'includes/class.AyeShortcodes.php';
$aye_shortcodes = new \Aye\Shortcodes\Core();

register_activation_hook( __FILE__, array( $aye_shortcodes, 'activationHook' ) );
register_deactivation_hook( __FILE__, array( $aye_shortcodes, 'deactivationHook' ) );