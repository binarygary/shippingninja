<?php
/*
Plugin Name: Shippingninja
Version: 0.1.0
Description: Provides Reporting and Visibility for Third Party Orders from Ship Station
Author: Gary Kovar
Author URI: http://www.binarygary.com/
Plugin URI: http://www.binarygary.com/
Text Domain: shippingninja

Shippingninja is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
Shippingninja is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with Shippingninja. If not, see https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html.
*/

$directory = plugin_dir_path( __FILE__ ) . "post-types";
$scanned_directory = array_diff( scandir( $directory ), array( '..', '.' ) );
foreach ( $scanned_directory as $postType ) {
  include ( "post-types/$postType" );
}

