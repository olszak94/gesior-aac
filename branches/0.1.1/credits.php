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
		Korzystaj¹c z tego oprogramowania zgadzasz siê na nasz¹ licencjê i terminów. Ten program nie ma ¿adnych gwarancji, chodzi jak to jest.
		<br><br>
		Jeœli link do tej strony nie jest widoczna na stronie internetowej, prosimy o kontakt z twórców Gesior-AAC natychmiast. 
	<hr>
	';
}
else
	$main_content .= "Invalid subtopic. Can't load page.";
?>