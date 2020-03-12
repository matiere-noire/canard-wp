<?php
/**
 * Plugin Name: Matière Noire
 * Description: Plugin de base
 * Author     : Maière Noire
 * Author URI : https://www.matierenoire.io/
 * Version    : 0.1
 */

namespace MN;

if( file_exists( plugin_dir_path( __FILE__ ) . '/vendor/autoload.php' ) ){
    require plugin_dir_path( __FILE__ ) . '/vendor/autoload.php';
}

$mn = new MN();
$mn->initialize( __FILE__ );