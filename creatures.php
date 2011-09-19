<?PHP
if(empty($_REQUEST['creature'])) {
//SHOW MONSTERS LIST
$allowed_order_by = array('name', 'exp', 'health', 'summonable', 'convinceable', 'race');
$order = $_REQUEST['order'];
//generate sql query
if($_REQUEST['desc'] == 1) {
$desc = " DESC";
}
if($order == 'name') {
$whereandorder = ' ORDER BY name'.$desc;
}
elseif($order == 'exp') {
$whereandorder = ' ORDER BY exp'.$desc.', name';
}
elseif($order == 'health') {
$whereandorder = ' ORDER BY health'.$desc.', name';
}
elseif($order == 'summonable') {
$whereandorder = ' AND summonable = 1 ORDER BY mana'.$desc;
}
elseif($order == 'convinceable') {
$whereandorder = ' AND convinceable = 1 ORDER BY mana'.$desc;
}
elseif($order == 'race') {
$whereandorder = ' ORDER BY race'.$desc.', name';
}
else
{
$whereandorder = ' ORDER BY name';
}
//send query to database
$monsters = $SQL->query('SELECT * FROM '.$SQL->tableName('z_monsters').' WHERE hide_creature != 1'.$whereandorder);
$main_content .= '<TABLE BORDER=0 CELLSPACING=1 CELLPADDING=4 WIDTH=100%><TR BGCOLOR='.$config['site']['vdarkborder'].'>';
if($order == 'name' && !isset($_REQUEST['desc'])) {
$main_content .= '<TD CLASS=white width="200"><B><a href="?subtopic=creatures&order=name&desc=1"><font color=white>Name DESC</a></B></TD>';
} else {
$main_content .= '<TD CLASS=white width="200"><B><a href="?subtopic=creatures&order=name"><font color=white>Name</a></B></TD>';
}
if($order == 'health' && !isset($_REQUEST['desc'])) {
$main_content .= '<TD CLASS=white><B><a href="?subtopic=creatures&order=health&desc=1"><font color=white>Health<br/>DESC</a></B></TD>';
} else {
$main_content .= '<TD CLASS=white><B><a href="?subtopic=creatures&order=health"><font color=white>Health</a></B></TD>';
}
if($order == 'exp' && !isset($_REQUEST['desc'])) {
$main_content .= '<TD CLASS=white><B><a href="?subtopic=creatures&order=exp&desc=1"><font color=white>Experience<br/>DESC</a></B></TD>';
} else {
$main_content .= '<TD CLASS=white><B><a href="?subtopic=creatures&order=exp"><font color=white>Experience</a></B></TD>';
}
if($order == 'summonable' && !isset($_REQUEST['desc'])) {
$main_content .= '<TD CLASS=white><B><a href="?subtopic=creatures&order=summonable&desc=1"><font color=white>Summonable<br/>Mana DESC</a></B></TD>';
} else {
$main_content .= '<TD CLASS=white><B><a href="?subtopic=creatures&order=summonable"><font color=white>Summonable<br/>Mana</a></B></TD>';
}
if($order == 'convinceable' && !isset($_REQUEST['desc'])) {
$main_content .= '<TD CLASS=white><B><a href="?subtopic=creatures&order=convinceable&desc=1"><font color=white>Convinceable<br/>Mana DESC</a></B></TD>';
} else {
$main_content .= '<TD CLASS=white><B><a href="?subtopic=creatures&order=convinceable"><font color=white>Convinceable<br/>Mana</a></B></TD>';
}
if($order == 'race' && !isset($_REQUEST['desc'])) {
$main_content .= '<TD CLASS=white><B><a href="?subtopic=creatures&order=race&desc=1"><font color=white>Race<br/>DESC</a></B></TD></TR>';
} else {
$main_content .= '<TD CLASS=white><B><a href="?subtopic=creatures&order=race"><font color=white>Race</a></B></TD></TR>';
}
foreach($monsters as $monster) {
if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['lightborder']; } else { $bgcolor = $config['site']['darkborder']; } $number_of_rows++;
$main_content .= '<TR BGCOLOR="'.$bgcolor.'"><TD><a href="?subtopic=creatures&creature='.urlencode($monster['name']).'">'.$monster['name'].'</a></TD><TD>'.$monster['health'].'</TD><TD>'.$monster['exp'].'</TD>';
if($monster['summonable']) {
$main_content .= '<TD>'.$monster['mana'].'</TD>';
}
else
{
$main_content .= '<TD>---</TD>';
}
if($monster['convinceable']) {
$main_content .= '<TD>'.$monster['mana'].'</TD>';
}
else
{
$main_content .= '<TD>---</TD>';
}
$main_content .= '<TD>'.ucwords($monster['race']).'</TD></TR>';
}

$main_content .= '</TABLE>';
}
else
//SHOW INFORMATION ABOUT MONSTER
{
$monster_name = stripslashes(trim(ucwords($_REQUEST['creature'])));
$monster = $SQL->query('SELECT * FROM '.$SQL->tableName('z_monsters').' WHERE '.$SQL->fieldName('hide_creature').' != 1 AND '.$SQL->fieldName('name').' = '.$SQL->quote($monster_name).';')->fetch();
if(isset($monster['name'])) {
$main_content .= '<TABLE BORDER=0 CELLSPACING=0 CELLPADDING=1 WIDTH=100%><TR BGCOLOR="' .$config['site']['vdarkborder'] . '"><TD BGCOLOR="" CLASS="white" ALIGN="center"><h3>'.$monster['name'].'</h3></TD></TR>
<TABLE BORDER=0 CELLSPACING=0 CELLPADDING=3 WIDTH=100%>
<tbody>
	<tr bgcolor='.$config['site']['vdarkborder'].'>
		<td class=white>Picture</td>
		<td class=white colspan=2>Information</td>
	</tr>';
if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['lightborder']; } $number_of_rows++;
$main_content .= '<tr BGCOLOR="'.$bgcolor.'"><td align="center" rowspan=5 width=30%><img src="';
	 if(file_exists('images/monsters/'.$monster['gfx_name'])) 
		$main_content .= 'images/monsters/'.$monster['gfx_name']; 
	else 
		$main_content .= 'images/monsters/nophoto.png'; 
$main_content .= '" height="100" width="100"></td><td width="100"><b>Health: </b></td><td>'.$monster['health'].'</td></tr>';
if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['lightborder']; } $number_of_rows++;
$main_content .= '<tr BGCOLOR="'.$bgcolor.'"><td width="100"><b>Give<br/>Experience: </b></td><td>'.$monster['exp'].'</td></tr>';
if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['lightborder']; } $number_of_rows++;
$main_content .= '<tr BGCOLOR="'.$bgcolor.'"><td width="100"><b>Speed like: </b></td><td>'.$monster['speed_lvl'].' level';
if($monster['use_haste']) {
$main_content .= ' (Can use haste)</td></tr>';
} else {
$main_content .= '</td></tr>';
}
if($monster['summonable'] == 1) {
if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['lightborder']; } $number_of_rows++;
$main_content .= '<tr BGCOLOR="'.$bgcolor.'"><td width="100"><b>Summon: </b></td><td>'.$monster['mana'].' mana</td></tr>';
}
else
{
if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['lightborder']; } $number_of_rows++;
$main_content .= '<tr BGCOLOR="'.$bgcolor.'"><td width="100"><b>Summon: </b></td><td>Impossible</td></tr>';
}
if($monster['convinceable'] == 1) {
if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['lightborder']; } $number_of_rows++;
$main_content .= '<tr BGCOLOR="'.$bgcolor.'"><td width="100"><b>Convince: </b></td><td>'.$monster['mana'].' mana</td></tr>';
}
else
{
if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['lightborder']; } $number_of_rows++;
$main_content .= '<tr BGCOLOR="'.$bgcolor.'"><td width="100"><b>Convince: </b></td><td>Impossible</td></tr>';
}

$main_content .= '</tbody></TABLE>
<TABLE BORDER=0 CELLSPACING=0 CELLPADDING=4 WIDTH=100%>';
if(!empty($monster['immunities'])) {
if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['lightborder']; } $number_of_rows++;
$main_content .= '<tr BGCOLOR="'.$bgcolor.'"><td width="100"><b>Immunities: </b></td><td width="100%">'.$monster['immunities'].'</td></tr>';
}
if(!empty($monster['voices'])) {
if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['lightborder']; } $number_of_rows++;
$main_content .= '<tr BGCOLOR="'.$bgcolor.'"><td width="100"><b>Voices: </b></td><td width="100%">'.$monster['voices'].'</td></tr>';
}
$main_content .= '</TABLE></td></tr>
</TABLE>';
}
else
{
$main_content .= 'Monster with name <b>'.$monster_name.'</b> doesn\'t exist.<br/></br><center><form action="?subtopic=creatures" METHOD=post><div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif);" ></div><input class="ButtonText" type="image" name="Back" alt="Back" src="'.$layout_name.'/images/buttons/_sbutton_back.gif" ></div></div></form></center>';
}
//back button
$main_content .= '<br/></br><center><form action="?subtopic=creatures" METHOD=post><div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif);" ></div><input class="ButtonText" type="image" name="Back" alt="Back" src="'.$layout_name.'/images/buttons/_sbutton_back.gif" ></div></div></form></center>';
}
?>
