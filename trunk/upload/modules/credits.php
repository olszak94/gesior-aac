<?PHP
if($config['site']['credits_page'])
{
	$main_content .= '
	<center>
		New Gesior-AAC
	</center>
	<hr>
		<b>Developers</b><br>
		Xart - Official Developer<br />
		redbull915 - Official Developer<br />
		Dulin - Developer tylko pod wpływem %<br />
		<br /><br />
		<b>Special Greetings to people</b><br />
		Kowol<br />
		Gesior<br />
		Karpio<br />
	<hr>
		Korzystając z tego oprogramowania zgadzasz się na nasza licencjcę. Ten program nie ma zadnych gwarancji, chodzi jak to jest.
		<br />
	<hr>
	';
}
else
	$main_content .= "Invalid subtopic. Can't load page.";
?>
