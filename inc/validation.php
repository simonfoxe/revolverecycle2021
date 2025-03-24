<?php
/**
 * Validatikon Functions and filters
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;


// Australian mobile number format
add_filter( 'gform_phone_formats', 'phone_number_formats', 10, 2 );
function phone_number_formats( $phone_formats ) {
  $phone_formats['au'] = array(
    'label'       => 'Australia',
    'mask'        => false,
    'regex'       => '/^04([0-9]{8})$/',
    'instruction' => false,
  );
  return $phone_formats;
}

// Australian mobile number validation
add_filter( 'gform_field_validation', 'validate_mobile', 10, 4 );
function validate_mobile( $result, $value, $form, $field ) {
  $pattern = "/^04([0-9]{8})$/";
  if ( $field->type == 'phone' && $field->phoneFormat != 'standard' && ! preg_match( $pattern, $value ) ) {
    $result['is_valid'] = false;
    $result['message']  = 'Please enter a valid mobile number';
  }
  return $result;
}