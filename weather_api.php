<?php

require ('httpful/bootstrap.php');

define("API_HOST", "http://api.openweathermap.org/data/2.5");

function fetch_weather_api_data($url, $body, $method = 'get' ) {

  switch ($method) {
  	// case 'post':
  	// 	$response = \Httpful\Request::post($url)
   //      ->sendsJson()
   //      ->body($body)
   //      ->expectsJson()
   //      ->send();
   //    break;
  	// case 'put':
  	// 	$response = \Httpful\Request::put($url)
   //      ->sendsJson()
   //      ->body($body)
   //      ->expectsJson()
   //      ->send();
  	// 	break;
  	// case 'delete':
  	// 	 $response = \Httpful\Request::delete($url)
   //      ->sendsJson()
   //      ->body($body)
   //      ->expectsJson()
   //      ->send();
  	// 	break;
  	// default: # case 'get'
      $response = \Httpful\Request::get($url)
        ->expectsJson()
        ->send();
  		break;
  }
  try {
    # $obj = json_decode ( $response['body'], true);
  } catch(Exception $e) {
    var_dump($response);
    $obj = array();
    echo 'Caught exception: ',  $e->getMessage(), "\n";
  }
  return $response->body;
}
?>
