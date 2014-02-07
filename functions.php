<?php   
    function create_theme_options() {
        require_once('assets/functions/theme-options-init.php');    
    }
	if(is_admin()){	
		create_theme_options();
	}
	
	$header_defaults = array(
	'default-image'          => '',
	'random-default'         => false,
	'width'                  => 0,
	'height'                 => 0,
	'flex-height'            => true,
	'flex-width'             => true,
	'default-text-color'     => '',
	'header-text'            => false,
	'uploads'                => true,
	'wp-head-callback'       => '',
	'admin-head-callback'    => '',
	'admin-preview-callback' => '',
);
add_theme_support( 'custom-header', $header_defaults );
remove_theme_support('custom-background');
	$bg_args = array(
		'default-color'          => '#000000',
		'default-image'          => get_stylesheet_directory_uri() . '/assets/images/default_bg.jpg',
		'wp-head-callback'       => '_custom_background_cb',
		'admin-head-callback'    => '',
		'admin-preview-callback' => ''
	);
add_theme_support( 'custom-background', $bg_args  );
?>