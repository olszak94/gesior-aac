<?PHP
$players_deaths_data = $SQL->query('SELECT * FROM players,player_deaths WHERE players.id = player_deaths.player_id ORDER BY time DESC LIMIT '.$config['site']['last_deaths_limit']);
$number_of_players_deaths = 0;
if(!empty($players_deaths_data)) {
$vowels = array("e", "y", "u", "i", "o", "a");
foreach($players_deaths_data as $dead) {
	$number_of_players_deaths++;
	if(is_int($number_of_players_deaths / 2)) {
		$bgcolor = $config['site']['darkborder'];
	}
	else
	{
		$bgcolor = $config['site']['lightborder'];
	}
	$players_rows .= '<TR BGCOLOR="'.$bgcolor.'"><TD WIDTH="30"><center>'.$number_of_players_deaths.'.</<center></TD><TD><a href="index.php?subtopic=characters&name='.$dead['name'].'"><b>'.$dead['name'].'</b></a> killed at level <b>'.$dead['level'].'</b> by ';
	if($dead['is_player'] == 1) {
	$players_rows .= '<a href="index.php?subtopic=characters&name='.$dead['killed_by'].'"><b>'.$dead['killed_by'].'</b></a>';
	}
	else
	{
		if($dead['killed_by'] == "-1")
		{
			$players_rows .= "item or field";
		}
		else
		{
			if(in_array(substr(strtolower($dead['killed_by']), 0, 1), $vowels))
			{
				$players_rows .= "an ";
			}
			else
			{
				$players_rows .= "a ";
			}
			$players_rows .= $dead['killed_by'];
		}
	}
	$players_rows .= '.</TD></TR>';
}
}
if($number_of_players_deaths == 0) {
	//server status - server empty
	$main_content .= '<TABLE BORDER=0 CELLSPACING=1 CELLPADDING=4 WIDTH=100%><TR BGCOLOR="'.$config['site']['vdarkborder'].'"><TD CLASS=white><B>Last Deaths</B></TD></TR><TR BGCOLOR='.$config['site']['darkborder'].'><TD><TABLE BORDER=0 CELLSPACING=1 CELLPADDING=1><TR><TD>No one died on '.$config['server']['serverName'].'.</TD></TR></TABLE></TD></TR></TABLE><BR>';
}
else
{
	//server status - someone is online
	$main_content .= '<TABLE BORDER=0 CELLSPACING=1 CELLPADDING=4 WIDTH=100%><TR BGCOLOR="'.$config['site']['vdarkborder'].'"><TD CLASS=white><B>Last Deaths</B></TD></TR></TABLE>';
	//list of players
	$main_content .= '<TABLE BORDER=0 CELLSPACING=1 CELLPADDING=4 WIDTH=100%>'.$players_rows.'</TABLE>';
}
?>