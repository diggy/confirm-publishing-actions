=== Confirm Publishing Actions ===
Contributors: donutz, inbytesinc
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=H23P4H8CHF95N
Tags: publish, delete, update, submit, confirm, confirmation, quickpress, translation-ready
Requires at least: 3.1
Tested up to: 4.2.2
Stable tag: 1.3
License: GPLv2

Prompts a user to click a confirm button whenever he tries to submit, publish, update, schedule or delete a post.

== Description ==

Confirm Publishing Actions is a WordPress plugin that prompts a user to click a confirm (or cancel) button whenever he is trying to submit, publish, update, schedule or delete a WordPress post. Simple, lightweight, customizable and translation-ready.

Once activated, the plugin will intercept publishing actions on the following admin pages: `post.php`, `edit-post.php`, `edit.php`.

== Installation ==

= Minimum Requirements =

* WordPress 3.1 or higher

= Automatic installation =

Log in to your WordPress admin panel, navigate to the Plugins menu and use the search form to search for this plugin. Click Install and WordPress will automatically complete the installation.

= Manual installation =

1. Download the plugin to your computer and unzip it
2. Use an FTP program, or your hosting control panel, to upload the unzipped plugin folder to the plugin directory of your WordPress installation.
3. Log in to your WordPress admin panel and activate the plugin from the Plugins menu.

== Frequently Asked Questions ==

= Where is the settings page? = 

There are currently no settings to configure, however with a little php magic you'll be able to do some customization (see below in this FAQ).

= How do I change the text of the dialogue? = 

You can use a translation plugin or tool to modify the default text.

= How do I translate %1$s? What does it mean? =

%1$s is a placeholder that represents the singular name of a WordPress post type. You don't need to translate it, just copy and use it exactly as is.

= How can I limit plugin functionality to a specific post type? =

With `get_post_type()`, a native WordPress function, you can enable or disable plugin functionality for specific post types (such as `post`, `page`, or any other post type). For example, to disable functionality for 'Pages', paste the following code snippet in the `functions.php` file of your WordPress theme:

`function cpa_pt_dequeue( $type )
{
	if ( is_plugin_active( 'confirm-publishing-actions/cpa.php' ) && class_exists( 'cpa_confirm_publishing_actions' ) )
	{
		global $post;
		$type = get_post_type( $post );
		if( 'page' != $type )
			return;
		wp_dequeue_script( 'cpa' );
	}
	return;
}
add_action( 'admin_enqueue_scripts', 'cpa_pt_dequeue' );`

= How can I limit plugin functionality to selected user roles? =

With `current_user_can()`, a native WordPress function, you can enable or disable functionality for specific user roles, based on the capabilities assigned to them. For example, to disable functionality for admins only, paste the following code snippet in the `functions.php` file of your WordPress theme:

`function cpa_cap_dequeue()
{
	if ( is_plugin_active( 'confirm-publishing-actions/cpa.php' ) && class_exists( 'cpa_confirm_publishing_actions' ) )
	{
		if( ! current_user_can( 'manage_options' ) )
			return;
		wp_dequeue_script( 'cpa' );
	}
	return;
}
add_action( 'admin_enqueue_scripts', 'cpa_cap_dequeue' );`

== Screenshots ==

1. Example of a confirmation dialogue.

== Changelog ==

= 1.3 =

* Removes Quick Drafts (previously QuickPress) support
* Fixes bug where script fired on link insert cancel
* Adds support for touch devices
* Code cleanup

= 1.2.3 =

* catch schedule event

= 1.2.2 =

* fix php notices

= 1.2.1.1 =

* updated .pot file
* it_IT language files
* nl_NL language files

= 1.2.1 =

* es_ES language files
* yet another bugfix

= 1.2 =

* plugin code overhaul
* i18n fix, props inbytesinc

= 1.1.2 =

* Minified JS

= 1.0 =

* Initial release

== Upgrade Notice ==

= 1.3 =

fixes a minor bug, adds support for touch devices

= 1.2.3 =

catches schedule event

= 1.2.2 =

fix php notices

= 1.2.1.1 =

updated .pot file, added it_IT, nl_NL

= 1.2.1 =

es_ES language files, yet another bugfix

= 1.2 =

plugin code overhaul, i18n fix (props inbytesinc)

= 1.1.2 =

Minified JS

= 1.0 =

Initial release

== Other Notes ==

= License =

The Confirm Publishing Actions plugin for WordPress is released under GPLv2, you can use it free of charge on your personal or commercial website.

= Support =

Find support at the [WordPress international forums](https://wordpress.org/support/plugin/confirm-publishing-actions "WordPress international forums") or raise a ticket on [Github](https://github.com/diggy/confirm-publishing-actions/issues "Github").

= Contribute =

Check out the source code on [Github](https://github.com/diggy/confirm-publishing-actions/ "Github").

= Translate =

Submit a pull request on [Github](https://github.com/diggy/confirm-publishing-actions/ "Github").

= Donate =

If you like the Confirm Publishing Actions plugin and use it lot, please consider making a [donation](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=H23P4H8CHF95N "donation"). Thanks!
