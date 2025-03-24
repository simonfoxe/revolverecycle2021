<?php
/**
 * Common Functions & Utilites
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;


// Write to the WP error log
if (!function_exists('write_log')):
function write_log($log) {
  if (is_array($log) || is_object($log)) {
    error_log(print_r($log, true));
  } else {
    error_log($log);
  }
}
endif;


// Determine if a variable is "" or null, but accepts 0, "0"
function emptyish($var) {
  return ( $var === NULL || $var !== FALSE || $var === "" );
}


// Determine if a string is valid JSON or not
function isJson($string) {
   json_decode($string);
   return json_last_error() === JSON_ERROR_NONE;
}


function youtube_id_from_url($url) {
  $pattern =
  '%^# Match any youtube URL
  (?:https?://)?  # Optional scheme. Either http or https
  (?:www\.)?      # Optional www subdomain
  (?:             # Group host alternatives
  youtu\.be/    # Either youtu.be,
  | youtube\.com  # or youtube.com
  (?:           # Group path alternatives
  /embed/     # Either /embed/
  | /v/         # or /v/
  | /watch\?v=  # or /watch\?v=
  )             # End path alternatives.
  )               # End host alternatives.
  ([\w-]{10,12})  # Allow 10-12 for 11 char youtube id.
  $%x'
  ;
  $result = preg_match($pattern, $url, $matches);
  if ($result) {
    return $matches[1];
  }
  return false;
}


/* Function which displays your post date in time ago format */
function meks_time_ago() {
	return human_time_diff( get_the_date( 'U' ), current_time( 'timestamp' ) ).' '.__( 'ago' );
}


// Return an inline SVG
function get_svg($svg_filename) {
  if ( !file_exists($svg_filename) ) { return false; }
  return file_get_contents($svg_filename);
}



