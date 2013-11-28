<?php
setlocale(LC_ALL,'ja_JP.UTF-8');
require './lib/skinny.php';



$app = new App();

$app->on_get( "/", create_function('$app', '$app->show("index.php" , array("time" => time() ));	'));

function greeting($app){ 
	$name = "takuya";
	if( $app->param("name") ) {
		$name = $app->param("name");
	}
	$ret = $app->show(array("name" => $name ) );
};

$app->on_get( "/hello", "greeting" );

if( phpversion() >= 5.3 )
	$app->on_get( "/hi", function($app){   echo "hi"; });

$app->run();




