<?PHP
if($config['site']['credits_page'])
{
	$main_content .= '
	<center>
		New Gesior-AAC
	</center>
	<hr>
		<b>Developers</b><br>
		Xart - Official Developer
		<br><br>
		<b>Special Greetings to people</b><br>
		Kowol<br>
		Gesior<br>
	<hr>
		Korzystając z tego oprogramowania zgadzasz sie na nasza licencjc i terminow. Ten program nie ma zadnych gwarancji, chodzi jak to jest.
		<br><br>
		Jesli link do tej strony nie jest widoczna na stronie internetowej, prosimy o kontakt z tworcami Gesior-AAC natychmiast. 
	<hr>
	';
}
else
	$main_content .= "Invalid subtopic. Can't load page.";
?>