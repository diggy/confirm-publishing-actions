<?php
/**
 * Plugin Name: Confirm Publishing Actions
 * Plugin URI: https://wordpress.org/plugins/confirm-publishing-actions/
 * Description: Confirm Publishing Actions is a WordPress plugin that prompts a user to click a confirm (or cancel) button whenever he is trying to submit, publish, update, schedule, or delete a WordPress post. Simple, lightweight, customizable and translation-ready.
 * Version: 1.3
 * Author: Peter J. Herrel, Ramiro García Espantaleón
 * License: GPL2
 * Copyright: 2011-2015 Shared and distributed between Peter J. Herrel, Ramiro García Espantaleón
 * Text Domain: pjh-cpa
 * Domain Path: /inc/lang
 */

/*
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2, as 
 * published by the Free Software Foundation.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

/*
 * Security
 */
if( ! defined( 'ABSPATH' ) ) {
    exit; 
}

/**
 * @class cpa_confirm_publishing_actions
 */
if( ! class_exists( 'cpa_confirm_publishing_actions' ) )
{
class cpa_confirm_publishing_actions
{
    protected static $_instance = null;

    public static $version = '1.3';

    /**
     * Instance
     */
    public static function instance()
    {
        if( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        if( ! is_admin() ) {
            return;
        }

        add_action( 'admin_init',               array( __CLASS__, 'admin_init' ) );
        add_action( 'admin_enqueue_scripts',    array( __CLASS__, 'admin_enqueue_scripts' ) );
        add_filter( 'plugin_row_meta',          array( __CLASS__, 'plugin_row_meta' ), 10, 2 );
    }
    /**
     * Admin init
     */
    public static function admin_init()
    {
        load_plugin_textdomain( 'pjh-cpa', false, plugin_basename( dirname( __FILE__ ) ) . '/inc/lang/' );

        do_action( 'cpa_admin_init' );
    }
    /**
     * Admin enqueue scripts
     */
    public static function admin_enqueue_scripts( $hook )
    {
        if( ! in_array( $hook, array( 'post.php', 'post-new.php', 'edit.php' ) ) ) {
            return;
        }

        $type = get_post_type_object( $GLOBALS['typenow'] );
        $t    = $type->labels->singular_name;
        $min  = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

        wp_enqueue_script( "cpa", self::plugin_url() . "/inc/js/cpa{$min}.js", array( "jquery" ), self::$version, true );

        wp_localize_script( 'cpa', 'cpa_l10n_obj', array(

             'confirm_delete'   => sprintf( __( 'You are about to delete this %1$s. Proceed?',              'pjh-cpa' ), $t )
            ,'confirm_submit'   => sprintf( __( 'You are about to submit this %1$s for review. Proceed?',   'pjh-cpa' ), $t )
            ,'confirm_publish'  => sprintf( __( 'You are about to publish this %1$s. Proceed?',             'pjh-cpa' ), $t )
            ,'confirm_update'   => sprintf( __( 'You are about to update this %1$s. Proceed?',              'pjh-cpa' ), $t )
            ,'confirm_schedule' => sprintf( __( 'You are about to schedule this %1$s. Proceed?',            'pjh-cpa' ), $t )
            ,'submit'           => __( 'Submit for Review' )
            ,'publish'          => __( 'Publish' )
            ,'update'           => __( 'Update' )
            ,'schedule'         => __( 'Schedule' )

        ) );

        do_action( 'cpa_admin_enqueue_scripts', $hook );
    }
    /**
     * Plugin row meta
     */
    public static function plugin_row_meta( $links, $file )
    {
        if( $file !== plugin_basename( __FILE__ ) )
            return $links;

        $links[] = sprintf( __( '<a href="%1$s">Documentation</a>', 'pjh-cpa' ), esc_url( 'https://wordpress.org/plugins/confirm-publishing-actions/faq/' ) );
        $links[] = sprintf( __( '<a href="%1$s">Support</a>',       'pjh-cpa' ), esc_url( 'https://wordpress.org/support/plugin/confirm-publishing-actions' ) );
        $links[] = sprintf( __( '<a href="%1$s">Donate</a>',        'pjh-cpa' ), esc_url( 'https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=H23P4H8CHF95N' ) );

        return $links;
    }
    /**
     * Plugin URL
     */
    public static function plugin_url()
    {
        return untrailingslashit( plugins_url( '/', __FILE__ ) );
    }
}
/**
 * Init cpa_confirm_publishing_actions class
 *
 * Initializes the main plugin class
 *
 * @since Confirm Publishing Actions 0.1
 */
cpa_confirm_publishing_actions::instance();

} // class_exists check

/* end of file */
