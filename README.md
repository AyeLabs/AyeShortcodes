# AyeShortcodes
Helpful shortcodes with basic design, also a companion plugin for all themes available at AyeLabs.

## Shortcodes available

## Hooks

## F.A.Q

**How to install AyeShortcodes plugin?**

Upload 'ayeshortcodes' to the '/wp-content/plugins/' directory
Activate the plugin through the 'Plugins' menu in WordPress

**How can i integrate the plugin with my theme design?**

See the shortcodes generated markup on /assets/dev/markup.html. Use "aye_shortcodes_available_filter" filter to pass to the plugin what shortcodes your theme is using from the plugin, this will prevent the plugin to enqueue duplicate styles so you can add your ones easily in your theme or child theme.

Example:

	if(class_exists('\Aye\Shortcodes\Core')) {
		global $aye_shortcodes;
		
		add_filter('aye_shortcodes_available_filter', function($array) {
			return array('columns', 'bla');
		});
	}

## Requirements
- PHP 5.3

## Change Log
