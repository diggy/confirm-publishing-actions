<?php
/*
Plugin Name: Confirm Publishing Actions
Plugin URI: http://peterherrel.com/wordpress/plugins/confirm-publishing-actions/
Description: Confirm Publishing Actions is a WordPress plugin that prompts a user to click a confirm (or cancel) button whenever he is trying to submit, publish, update or delete a WordPress post. Simple, lightweight, customizable and translation-ready.
Version: 1.2
Author: donutz
Author URI: http://peterherrel.com/
License: GPL2
Text Domain: pjh-cpa
Domain Path: /inc/lang
*/

/*  Copyright 2011-2013  Peter J. Herrel  (email : peterherrel <at> gmail <dot> com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/**
 * Security
 */
if ( ! defined( 'ABSPATH' ) )
    exit; 

/*################################################*/
/*########### CPA PLUGIN FOR WORDPRESS ###########*/
/*################################################*/

if ( ! class_exists( 'CPA_Confirm_Publishing_Actions' ) )
{
/**
 * CPA_Confirm_Publishing_Actions class
 */
class CPA_Confirm_Publishing_Actions
{
    var $version = '1.2';
    var $plugin_dir_url = '';
    
    function CPA_Confirm_Publishing_Actions()
    {
        $this->__construct();
    }
    function __construct()
    {
        $this->plugin_dir_url = trailingslashit( plugins_url( dirname( plugin_basename( __FILE__ ) ) ) );
        
        if ( ! is_admin() )
            return;
        
        add_action( 'admin_init',               array( &$this, 'admin_init' ) );
        add_action( 'admin_enqueue_scripts',    array( &$this, 'admin_enqueue_scripts' ) );
        add_filter( 'plugin_row_meta',          array( &$this, 'plugin_row_meta' ), 10, 2 );
    }
    function admin_init()
    {
        load_plugin_textdomain( 'pjh-cpa', false, $this->plugin_dir_url . 'inc/lang/' );
        
        do_action( 'cpa_admin_init' );
    }
    public function admin_enqueue_scripts( $hook )
    {
        $hooks = array( 'index.php', 'post.php', 'post-new.php', 'edit.php' );
        
        if( ! in_array( $hook, $hooks ) )
            return;
        
        $min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
        
        wp_enqueue_script( 'cpa', $this->plugin_dir_url . 'inc/js/cpa' . $min . '.js', array( 'jquery' ), $this->version, true );
        
        if( 'index.php' == $hook ) {
            $t = __( 'Post', 'pjh-cpa' );
        } else {
            global $post;
            $type = get_post_type_object( get_post_type( $post ) );
            $t = $type->labels->singular_name;
        }
        
        $d = sprintf( __( 'You are about to delete this %1$s. Proceed?', 'pjh-cpa' ),               $t );
        $s = sprintf( __( 'You are about to submit this %1$s for review. Proceed?', 'pjh-cpa' ),    $t );
        $p = sprintf( __( 'You are about to publish this %1$s. Proceed?', 'pjh-cpa' ),              $t );
        $u = sprintf( __( 'You are about to update this %1$s. Proceed?', 'pjh-cpa' ),               $t );
        
        $cpa_l10n_data = array( 
            'confirm_delete'    => $d
            ,'confirm_submit'   => $s
            ,'confirm_publish'  => $p
            ,'confirm_update'   => $u
            ,'submit'           => __( 'Submit for Review' )
            ,'publish'          => __( 'Publish' )
            ,'update'           => __( 'Update' )
        );
        
        wp_localize_script( 'cpa', 'cpa_l10n_obj', $cpa_l10n_data );
        
        do_action( 'cpa_admin_enqueue_scripts', $hook );
    }
    function plugin_row_meta( $links, $file )
    {
        $plugin = plugin_basename( __FILE__ );
        
        if ( $plugin === $file )
        {
            $links[] = sprintf( __( '<a href="%1$s">Documentation</a>', 'pjh-cpa' ),    esc_url( 'http://peterherrel.com/wordpress/plugins/confirm-publishing-actions/' ) );
            $links[] = sprintf( __( '<a href="%1$s">Support</a>', 'pjh-cpa' ),          esc_url( 'http://wordpress.org/support/plugin/confirm-publishing-actions' ) );
            $links[] = sprintf( __( '<a href="%1$s">Donate</a>', 'pjh-cpa' ),           esc_url( 'https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=H23P4H8CHF95N' ) );
        }
        
        return $links;
    }
}
/**
 * Init CPA_Confirm_Publishing_Actions class
 *
 * Initializes the main plugin class
 *
 * @since Confirm Publishing Actions 0.1
 */
new CPA_Confirm_Publishing_Actions;

} // class_exists check