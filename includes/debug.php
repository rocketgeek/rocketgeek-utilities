<?php
/**
 * RocketGeek Utility Functions
 *
 * @package           RocketGeek Utility Functions
 * @author            Chad Butler
 * @copyright         2020 RocketGeek.com
 * @license           MIT
 *
 * RocketGeek Utility Functions <https://rocketgeek.com>
 * A set of utility functions for WordPress development and debugging.
 */

/*
Copyright 2020 Chad Butler, RocketGeek.com

Permission is hereby granted, free of charge, to any person obtaining a copy of
this software and associated documentation files (the "Software"), to deal in 
the Software without restriction, including without limitation the rights to 
use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies 
of the Software, and to permit persons to whom the Software is furnished to do
so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all 
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR 
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, 
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE 
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER 
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, 
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN 
THE SOFTWARE.
*/

/**

 Changelog
 
 1.0.0 Initial version.
 1.0.1 Added test for what_is() if $var is empty.
 
 **/

if ( ! function_exists('rktgk_break_point')):
function rktgk_break_point( $print = 'you are here' ) {
	if ( false == $print ) {
		exit();
	}
	echo $print;
	exit();
}
endif;

if ( ! function_exists('rktgk_write_log')):
function rktgk_write_log( $log )  {
    if ( is_array( $log ) || is_object( $log ) ) {
        error_log( print_r( $log, true ) );
    } else {
        error_log( $log );
    }
}
endif;

if ( ! function_exists('rktgk_what_is')):
function rktgk_what_is( $var, $exit = false, $output = true, $title = true ) {
	
	$is_obj = false;
	
	switch( $var ) {
			
		case empty( $var ) :
			echo '$var is empty';
			break;
		
		case is_string( $var ) :
			echo ( true === $title )  ? '$var is a string' : '';
			echo ( true === $title && true === $output ) ? ": " : "";
			echo ( true === $output ) ? $var : '';
			break;
			
		case is_object( $var ) :
			echo ( true === $title )  ? '$var is an object' : '';
			$is_obj = true;
			
		case is_array( $var ) :
			echo ( true === $title && false === $is_obj )  ? '$var is an array' : '';
			
			echo ( true === $title && true === $output ) ? ": " : "";
			
			if ( true === $output ) {
				echo '<pre>';
				print_r( $var );
				echo '</pre>'; 
			}
			break;
	}
	if ( 'exit' == $exit || true == $exit ) {
		exit();
	}
}
endif;

if ( ! function_exists( 'rktgk_write_line' ) ):
function rktgk_write_line( $line ) {
	echo $line . "<br />";
}
endif;