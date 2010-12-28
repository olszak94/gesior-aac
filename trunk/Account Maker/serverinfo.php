<?PHP
$content = file_get_contents("serverinfo.htm");
if($content != FALSE)
	$main_content .= $content;
else
	$main_content .= 'Can not load file <b>erverinfo.htm</b> or file is empty.';
?>