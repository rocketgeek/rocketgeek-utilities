<?php

if ( ! function_exists( 'rktgk_format_date' ) ):
/**
 * Display a localized date based on the WP date format setting.
 *
 * @since 1.0.0
 *
 * @param mixed $args
 * @return date $date
 */
function rktgk_format_date( $args ) {
	if ( ! is_array( $args ) ) {
		$args = array( 'date' => $args );
	}
	
	$defaults = array( 
		'date_format' => get_option( 'date_format' ),
		'time_format' => get_option( 'time_format' ),
		'localize'    => true,
		'timestamp'   => true,
		'date_only'   => true,
	);
	
	$args = wp_parse_args( $args, $defaults );

	/**
	 * Filter the date display and format settings.
	 *
	 * @since 1.0.0
	 *
	 * @param arrag $args
	 */
	$args = apply_filters( 'rktgk_format_date_args', $args );
	
	$date_format = ( true === $args['date_only'] ) ? $args['date_format'] : $args['date_format'] . ' ' . $args['time_format'];
	
	$date = ( true === $args['timestamp'] ) ? $args['date'] : strtotime( $args['date'] );
	$date = ( true === $args['localize']  ) ? date_i18n( $date_format, $date ) : date( $date_format, $date );
	
	return $date;
}
endif;

if ( ! function_exists( 'rktgk_date_format_map' ) ):
/**
 * Returns a conversion map array for various date formats.
 *
 * @since 1.0.0
 */
function rktgk_date_format_map() {
	return array(
		'YYYY-MM-DD' => 'Y-m-d',
		'EUROPEAN'   => 'j F Y',
		'AMERICAN'   => 'F j, Y',
		'MM/DD/YYYY' => 'm/d/Y',
		'DD/MM/YYYY' => 'd/m/Y',
	);
}
endif;

if ( ! function_exists( 'rktgk_date_format' ) ):
/**
 * Converts certain date formats to PHP.
 *
 * If no format is matched, it returns the original format.
 *
 * @since 1.0.0
 *
 * @param  string  $format
 * @return string  
 */
function rktgk_date_format( $format ) {
	$format = strtoupper( $format );
	$convert = rktgk_date_format_map();
	return ( ! isset( $convert[ $format ] ) ) ? $format : $convert[ $format ];
}
endif;