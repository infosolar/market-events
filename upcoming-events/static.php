<?php if (!defined('FW')) die('Forbidden');

// find the uri to the shortcode folder
$uri = fw_get_template_customizations_directory_uri('/extensions/shortcodes/shortcodes/upcoming-events');
wp_enqueue_style(
  'upcoming-events',
  $uri . '/static/css/styles.css'
);

