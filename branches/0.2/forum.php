<?PHP
if(!empty($config['site']['forum_link']))
	$main_content .= '<iframe name="forum" height="600" width="100%" border="0" frameborder="0" src="'.$config['site']['forum_link'].'"></iframe>';
else
	$main_content .= 'Forum address not configured.';
?>