<?php
if(isset($_SERVER['REDIRECT_URL']))
	header( 'location: /index.php?subtopic=error&id='.$_SERVER['REDIRECT_STATUS'] );

if(isset($_GET['id']))
	if($_GET['id'] == '404')
		$main_content .= '<h2>The requested URL was not found on this server.</h2>';
	elseif($_GET['id'] == '403')
		$main_content .= '<h2>You don\'t have permission to access the requested object.<br />It is either read-protected or not readable by the server.</h2>';
	else
		$main_content .= '<h2>Unknown error...</h2>';
?>
