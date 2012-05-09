<?php

if(!function_exists('json_decode'))
{
	throw new Exception('No JSON extension.');
}

function loadClass($name)
{
	if(file_exists('classes/' . $name . '.php'))
		require_once('classes/' . $name . '.php');
	else
		throw new Exception('chuj cos sie pojebalo');
}

spl_autoload_register( 'loadClass' );



/**#@-*/

?>
