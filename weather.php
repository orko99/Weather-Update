<?php
/*
Plugin Name: Weather Update
Plugin URI: https://wordpress.org/plugins/
Description: This plugin is for Weather Update based on Location from openweathermap.org API .
Author: Kofil Mahamud
Version: 1.0.0
Author URI: 
*/
require('weather_api.php');

function get_weather_details($location, $units) {
	$appid = '[Your APPID from openweathermap.org]';

  $url = API_HOST . '/forecast?q=' . $location . '&units=' . $units .'&APPID=' . $appid .'';
  $body = null;

  $response = fetch_weather_api_data($url, $body);
  return $response;
}
function weather_code($location, $units, $height, $width) {
	$wheatehrDetails = get_weather_details($location, $units);
	$wheatehrDetailsValues = $wheatehrDetails->list;
	$wheatehrCityName = $wheatehrDetails->city->name;
	echo '<figure>';
 	foreach($wheatehrDetailsValues as $wheatehrDetailsValue){
		$temp = $wheatehrDetailsValue->main->temp;
		$weathers = $wheatehrDetailsValue->weather;
			foreach($weathers as $weather){
				$weatherstype = $weather->main;
			}
	 	echo '<div class="medium-12 large-12 mSingleSlide" rel="bookmark" style="height: ' . $height . '; width: ' . $width . ';" target="_blank">';	
			echo '<p><strong>City Name: </strong>'. $wheatehrCityName . '</p>';
			echo '<p><strong>Temparature: </strong>'. $temp .'</p>';
			echo '<p><strong>Weather Type: </strong>'. $weatherstype .'</p>'; 
	 	echo'</div>';
		break;
	}
echo '</figure>';
}
function weather_styles() {
	wp_register_style( 'weather-style', (plugin_dir_url( __FILE__ ) .'css/style.css'));
	wp_enqueue_style( 'weather-style' );
}
add_action( 'wp_enqueue_scripts', 'weather_styles' );

function weather_files() {
	wp_register_script( 'weather-script', (plugin_dir_url( __FILE__ ) .'js/custom.js'), false, '1.0', true);
  wp_enqueue_script( 'weather-script' );
}
add_action( 'init', 'weather_files' );

function weather_shortcode( $atts ) {
	$a = shortcode_atts( array(
		'unit' => 'metric',
		'location' => 'Dhaka',
		'height' => '400px',
		'width' => '400px'
	), $atts );

	$units = $a['unit'];
	$location = $a['location'];
	$height = esc_attr($a['height']);
	$width = esc_attr($a['width']);

	ob_start();
	weather_code($location, $units, $height, $width);

 	return ob_get_clean();
}
add_shortcode( 'show_weather', 'weather_shortcode' );
?>
