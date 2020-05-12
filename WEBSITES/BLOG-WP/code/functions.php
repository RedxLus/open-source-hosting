<?php
//Tamaño de imagen 
add_image_size( 'destacada', 1254, 300, true );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'custom-logo', array(
    //ALTO
    'height'      => 50,
    //ANCHO
    'width'       => 250,
    //PERMITIR FLEXIBILIDAD EN EL TAMAÑO
	'flex-height' => true,
    'flex-width'  => true,
    //
	'header-text' => array( 'site-title', 'site-description' ),
) );    

?>