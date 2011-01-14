<?PHP
$list = $_REQUEST['list'];
$page = $_REQUEST['page'];

switch($list)
{
	case "fist":
		$id = 0;
		$list_name = 'Fist Fighting';
	break;
	case "club":
		$id = 1;
		$list_name = 'Club Fighting';
	break;
	case "sword":
		$id = 2;
		$list_name = 'Sword Fighting';
	break;
	case "axe":
		$id = 3;
		$list_name = 'Axe Fighting';
	break;
	case "distance":
		$id = 4;
		$list_name = 'Distance Fighting';
	break;
	case "shield":
		$id = 5;
		$list_name = 'Shielding';
	break;
	case "fishing":
		$id = 6;
		$list_name = 'Fishing';
	break;
}
if(count($config['site']['worlds']) > 1)
{
	$worlds .= '<i>Select world:</i> ';
	foreach($config['site']['worlds'] as $idd => $world_n)
	{
		if($idd == (int) $_GET['world'])
		{
			$world_id = $idd;
			$world_name = $world_n;
		}
	}
}
if($idd == (int) $_GET['world'])
{
	$world_id = $idd;
	$world_name = $world_n;
}
if(!isset($world_id))
{
	$world_id = 0;
	$world_name = $config['server']['serverName'];
}
$offset = $page * 100;
//jesli chodzi o skilla
if(isset($id)) 
{
	$skills = $SQL->query('SELECT * FROM players, player_skills WHERE players.world_id = '.$world_id.' AND players.deleted = 0 AND players.group_id < '.$config['site']['players_group_id_block'].' AND players.id = player_skills.player_id AND player_skills.skillid = '.$id.' AND players.account_id != 1 ORDER BY value DESC, count DESC LIMIT 101 OFFSET '.$offset);
}
else
{
	//jesli chodzi o level lub mlvl
	if($list == "magic") 
	{
		$list_name = 'Magic Level';
		$skills = $SQL->query('SELECT * FROM players WHERE players.world_id = '.$world_id.' AND players.deleted = 0 AND players.group_id < '.$config['site']['players_group_id_block'].' AND account_id != 1 ORDER BY maglevel DESC, manaspent DESC LIMIT 101 OFFSET '.$offset);
	}
	else
	{
		$skills = $SQL->query('SELECT * FROM players WHERE players.world_id = '.$world_id.' AND players.deleted = 0 AND players.group_id < '.$config['site']['players_group_id_block'].' AND account_id != 1 ORDER BY level DESC, experience DESC LIMIT 101 OFFSET '.$offset);
		$list_name = 'Experience';
		$list = 'experience';
	}
}
//wyswietlanie wszystkiego
$main_content .= '<TABLE BORDER=0 CELLPADDING=0 CELLSPACING=0 WIDTH=100%><TR><TD><IMG SRC="'.$layout_name.'/images/general/blank.gif" WIDTH=10 HEIGHT=1 BORDER=0></TD><TD><CENTER><H2>Ranking for '.$list_name.' on '.$world_name.'</H2></CENTER><BR>';
	if(count($config['site']['worlds']) > 1)
	{
		$main_content .= '<TABLE BORDER=0 CELLPADDING=0 CELLSPACING=0 WIDTH=100%><TR><TD>
		<FORM ACTION="index.php?subtopic=highscores" METHOD=get><INPUT TYPE=hidden NAME=subtopic VALUE=highscores><INPUT TYPE=hidden NAME=list VALUE=experience>
		<TABLE WIDTH=100% BORDER=0 CELLSPACING=1 CELLPADDING=4><TR><TD BGCOLOR="'.$config['site']['vdarkborder'].'" CLASS=white><B>World Selection</B></TD></TR><TR><TD BGCOLOR="'.$config['site']['lightborder'].'">
		<TABLE BORDER=0 CELLPADDING=1><TR><TD>World: </TD><TD><SELECT SIZE="1" NAME="world"><OPTION VALUE="" SELECTED>(choose world)</OPTION>';
		foreach($config['site']['worlds'] as $id => $world_n)
		{
			$main_content .= '<OPTION VALUE="'.$id.'">'.$world_n.'</OPTION>';
		}
		$main_content .= '</SELECT> </TD><TD><INPUT TYPE=image NAME="Submit" ALT="Submit" SRC="'.$layout_name.'/images/buttons/sbutton_submit.gif" BORDER=0 WIDTH=120 HEIGHT=18>
		</TD></TR></TABLE></TABLE></FORM></TABLE><br>';
	}
	$main_content .= '<TABLE BORDER=0 CELLPADDING=4 CELLSPACING=1 WIDTH=100%><TR BGCOLOR="'.$config['site']['vdarkborder'].'"><TD WIDTH=10% CLASS=whites><B>Rank</B></TD><TD WIDTH=75% CLASS=whites><B>Name</B></TD><TD WIDTH=15% CLASS=whites><b><center>Level</center></B></TD>';
if($list == "experience") 
{
	$main_content .= '<TD CLASS=whites><b><center>Points</center></B></TD>';
}
$main_content .= '</TR><TR>';
foreach($skills as $skill)  
{
	if($config['site']['show_flag'])
	{
		$account = $SQL->query('SELECT * FROM accounts WHERE id = '.$skill['account_id'].'')->fetch();
		$flag = '<image src="http://images.boardhost.com/flags/'.$account['flag'].'.png"/> ';
	}
	if($number_of_rows < 100) 
	{
		if($list == "magic") 
			$skill['value'] = $skill['maglevel'];
		if($list == "experience") 
			$skill['value'] = $skill['level'];
		if(!is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['lightborder']; } $number_of_rows++;
		$main_content .= '<tr bgcolor="'.$bgcolor.'">
			<td>'.($offset + $number_of_rows).'.</td>
			<td>'.$flag.'<a href="index.php?subtopic=characters&name='.$skill['name'].'">'.$skill['name'].'</a></td>
			<td>'.$skill['value'].'</td>';
		if($list == "experience") 
			$main_content .= '<td>'.$skill['experience'].'</td>';
		$main_content .= '</tr>';
	}
	else
		$show_link_to_next_page = TRUE;
}
$main_content .= '</TABLE><TABLE BORDER=0 CELLPADDING=4 CELLSPACING=1 WIDTH=100%>';
//link to previous page if actual page isn't first
if($page > 0) 
	$main_content .= '<TR><TD WIDTH=100% ALIGN=right VALIGN=bottom><A HREF="index.php?subtopic=highscores&list='.$list.'&world='.$world_id.'&page='.($page - 1).'" CLASS="size_xxs">Previous Page</A></TD></TR>';
//link to next page if any result will be on next page
if($show_link_to_next_page) 
	$main_content .= '<TR><TD WIDTH=100% ALIGN=right VALIGN=bottom><A HREF="index.php?subtopic=highscores&list='.$list.'&world='.$world_id.'&page='.($page + 1).'" CLASS="size_xxs">Next Page</A></TD></TR>';
//end of page
$main_content .= '</TABLE></TD><TD WIDTH=5%><IMG SRC="'.$layout_name.'/images/general/blank.gif" WIDTH=1 HEIGHT=1 BORDER=0></TD><TD WIDTH=15% VALIGN=top ALIGN=right>
	<TABLE BORDER=0 CELLPADDING=4 CELLSPACING=1>
		<TR BGCOLOR="'.$config['site']['vdarkborder'].'">
			<TD CLASS=whites><B>Choose a skill</B></TD></TR><TR BGCOLOR="'.$config['site']['lightborder'].'"><TD>
				<A HREF="index.php?subtopic=highscores&list=experience&world='.$world_id.'" CLASS="size_xs">Experience</A><BR>
				<A HREF="index.php?subtopic=highscores&list=magic&world='.$world_id.'" CLASS="size_xs">Magic</A><BR>
				<A HREF="index.php?subtopic=highscores&list=shield&world='.$world_id.'" CLASS="size_xs">Shielding</A><BR>
				<A HREF="index.php?subtopic=highscores&list=distance&world='.$world_id.'" CLASS="size_xs">Distance</A><BR>
				<A HREF="index.php?subtopic=highscores&list=club&world='.$world_id.'" CLASS="size_xs">Club</A><BR>
				<A HREF="index.php?subtopic=highscores&list=sword&world='.$world_id.'" CLASS="size_xs">Sword</A><BR>
				<A HREF="index.php?subtopic=highscores&list=axe&world='.$world_id.'" CLASS="size_xs">Axe</A><BR>
				<A HREF="index.php?subtopic=highscores&list=fist&world='.$world_id.'" CLASS="size_xs">Fist</A><BR>
				<A HREF="index.php?subtopic=highscores&list=fishing&world='.$world_id.'" CLASS="size_xs">Fishing</A><BR>
			</TD>
		</TR>
	</TABLE></TD><TD><IMG SRC="'.$layout_name.'/images/general/blank.gif" WIDTH=10 HEIGHT=1 BORDER=0></TD></TR></TABLE>';
?>