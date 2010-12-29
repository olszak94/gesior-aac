<?PHP
$order = $_REQUEST['order'];
if($order == 'name') {
	$orderby = 'name';
}
if($order == 'level') {
	$orderby = 'level';
}
if($order == 'vocation') {
	$orderby = 'vocation';
}
if(empty($orderby)) {
	$orderby = 'name';
}
$players_online_data = $SQL->query('SELECT * FROM players WHERE online = 1 ORDER BY '.$orderby);
$number_of_players_online = 0;
foreach($players_online_data as $player) {
	$number_of_players_online++;
	if(is_int($number_of_players_online / 2)) {
		$bgcolor = $config['site']['darkborder'];
	}
	else
	{
		$bgcolor = $config['site']['lightborder'];
	}
	$players_rows .= '<TR BGCOLOR='.$bgcolor.'><TD WIDTH=70%><A HREF="index.php?subtopic=characters&name='.$player['name'].'">'.$player['name'].'</A></TD><TD WIDTH=10%>'.$player['level'].'</TD><TD WIDTH=20%>'.$config_vocations[$player['vocation']].'</TD></TR>';
}
if($number_of_players_online == 0) {
	//server status - server empty
	$main_content .= '<TABLE BORDER=0 CELLSPACING=1 CELLPADDING=4 WIDTH=100%><TR BGCOLOR="'.$config['site']['vdarkborder'].'"><TD CLASS=white><B>Server Status</B></TD></TR><TR BGCOLOR='.$config['site']['darkborder'].'><TD><TABLE BORDER=0 CELLSPACING=1 CELLPADDING=1><TR><TD>Currently no one is playing on '.$config['server']['serverName'].'.</TD></TR></TABLE></TD></TR></TABLE><BR>';
}
else
{
	//server status - someone is online
	$main_content .= '<TABLE BORDER=0 CELLSPACING=1 CELLPADDING=4 WIDTH=100%><TR BGCOLOR="'.$config['site']['vdarkborder'].'"><TD CLASS=white><B>Server Status</B></TD></TR><TR BGCOLOR='.$config['site']['darkborder'].'><TD><TABLE BORDER=0 CELLSPACING=1 CELLPADDING=1><TR><TD>Currently '.$number_of_players_online.' players are online.</TD></TR></TABLE></TD></TR></TABLE><BR>';
	//list of players
	$main_content .= '<TABLE BORDER=0 CELLSPACING=1 CELLPADDING=4 WIDTH=100%><TR BGCOLOR="'.$config['site']['vdarkborder'].'"><TD><A HREF="index.php?subtopic=whoisonline&order=name" CLASS=white>Name</A></TD><TD><A HREF="index.php?subtopic=whoisonline&order=level" CLASS=white>Level</A></TD><TD><A HREF="index.php?subtopic=whoisonline&order=vocation" CLASS=white>Vocation</TD></TR>'.$players_rows.'</TABLE>';
	//search bar
	$main_content .= '<BR><FORM ACTION="index.php?subtopic=characters" METHOD=post>  <TABLE WIDTH=100% BORDER=0 CELLSPACING=1 CELLPADDING=4><TR><TD BGCOLOR="'.$config['site']['vdarkborder'].'" CLASS=white><B>Search Character</B></TD></TR><TR><TD BGCOLOR="'.$config['site']['darkborder'].'"><TABLE BORDER=0 CELLPADDING=1><TR><TD>Name:</TD><TD><INPUT NAME="name" VALUE=""SIZE=29 MAXLENGTH=29></TD><TD><INPUT TYPE=image NAME="Submit" SRC="'.$layout_name.'/images/buttons/sbutton_submit.gif" BORDER=0 WIDTH=120 HEIGHT=18></TD></TR></TABLE></TD></TR></TABLE></FORM>';
}
?>