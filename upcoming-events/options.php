<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options  = array(
  'upcoming_events_bg' => array(
    'type'  => 'upload',
    'value' => '',
    'label' => __( 'Background image', 'the-core' ),
    'desc'  => __( '', 'the-core' )
  ),
  'upcoming_events_title' => array(
    'type'  => 'text',
    'value' => '',
    'label' => __( 'Section title', 'the-core' ),
    'desc'  => __( '', 'the-core' )
  ),
  'upcoming_events_subtitle' => array(
    'type'  => 'text',
    'value' => '',
    'label' => __( 'Section subtitle', 'the-core' ),
    'desc'  => __( '', 'the-core' )
  ),
);
