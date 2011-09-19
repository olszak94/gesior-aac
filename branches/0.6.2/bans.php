<?PHP
$page = $_REQUEST['page'];
##-- Config
$bans = $SQL->query('SELECT `bans`.`id`, `bans`.`type`, `bans`.`value`, `bans`.`comment`,`bans`.`admin_id`, `bans`.`expires`, `bans`.`added`, `bans`.`reason` FROM `bans`, `players` WHERE `players`.`account_id` = `bans`.`value` AND `bans`.`active` = 1 GROUP BY `bans`.`value` ORDER BY `bans`.`added` DESC')->fetchAll();
$banType = array(1 => 'Ip Banishment', 2 => 'Namelock', 3 => 'Account Banishment', 4 => 'Notation', 5 => 'Deletion');
##-- List
if($page == '')
{
	$number_of_players = 0;
	if(!$bans)
		$players_rows .= '<TR BGCOLOR='.$config['site']['lightborder'].'><td colspan=6><b>No one is banned at the moment at '.$config['server']['serverName'].'</b></td></tr>';
	else
	{
		foreach($bans as $ban) 
		{
			$nick = $SQL->query("SELECT name, id, level, account_id FROM `players` WHERE account_id =".$ban['value']." ORDER BY level DESC LIMIT 1")->fetch();
			$gmnick = $SQL->query("SELECT name, id FROM `players` WHERE id =".$ban['admin_id']."")->fetch();
			if($ban['admin_id'] > 0)
				$banby = "<a href=?subtopic=characters&name=".urlencode($gmnick['name']).">".$gmnick['name']."</a>";
			else
				$banby = "Auto Ban System";
			$number_of_players++;
			if(is_int($number_of_players / 2))
				$bgcolor = $config['site']['darkborder'];
			else
				$bgcolor = $config['site']['lightborder'];
			if ($ban['expires'] == "-1") // If the banishment is permanent
				$expires = "Permament";
			else
				$expires = date("d/m/Y, G:i:s", $ban['expires']);
			$players_rows .= '<TR BGCOLOR='.$bgcolor.'><TD WIDTH=15%><A HREF="?subtopic=characters&name='.$nick['name'].'">'.$nick['name'].'</A></TD><TD WIDTH=5%>'.getReason($ban['reason']).'</TD><TD WIDTH=15%>'.$ban['comment'].'</TD><TD>'.$banby.'</TD><td>'.date("d/m/Y, G:i:s", $ban['added']).'</td><TD>'.$expires.'</TD></TR>';
		}
	}
    //list of players
    $main_content .= '<TABLE BORDER=0 CELLSPACING=1 CELLPADDING=4 WIDTH=100%><TR BGCOLOR="'.$config['site']['vdarkborder'].'"><TD CLASS=white><b>Banned Player</b></TD><TD class="white"><b>Reason</b></TD><TD class="white"><b>Comment</b></TD><TD class="white"><b>Banned By</b></TD><TD class="white"><b>Date</b></TD><TD class="white"><b>Expires</b></TD></TR>'.$players_rows.'</TABLE>';
	if($group_id_of_acc_logged >= 3)
		$main_content .= '<br><table width=100%><tr><td align=right><a href="index.php?subtopic=bansmeneger&page=admin">Admin Panel</a></td></tr></table>';
}
##-- Admin
if($page == "admin")
{
	if($group_id_of_acc_logged >= 3)
	{
		$number_of_players = 0;
		if(!$bans)
			$players_rows .= '<TR BGCOLOR='.$config['site']['lightborder'].'><td colspan=5><b>No one is banned at the moment at '.$config['server']['serverName'].'</b></td></tr>';
		else
		{
			foreach($bans as $ban) 
			{
				$nick = $SQL->query("SELECT name, id, level, account_id FROM `players` WHERE account_id =".$ban['value']." ORDER BY level DESC LIMIT 1")->fetch();
				$number_of_players++;
				if(is_int($number_of_players / 2))
					$bgcolor = $config['site']['darkborder'];
				else
					$bgcolor = $config['site']['lightborder'];
				if ($ban['expires'] == "-1") // If the banishment is permanent
					$expires = "Permament";
				else
					$expires = date("d/m/Y, G:i:s", $ban['expires']);
				$players_rows .= '<TR BGCOLOR='.$bgcolor.'><TD WIDTH=15%><A HREF="?subtopic=characters&name='.$nick['name'].'">'.$nick['name'].'</A></TD><TD WIDTH=5%>'.getReason($ban['reason']).'</TD><td>'.date("d/m/Y, G:i:s", $ban['added']).'</td><TD>'.$expires.'</TD><TD><a href="index.php?subtopic=bansmeneger&page=delete&id='.$ban['id'].'">unbanned</a></TD></TR>';
			}
		}
		$main_content .= 'In this place you can <b>unbanned</b> or <b>undeleted</b> bans. Letter you can see list raport send from pleyers.<br><br>';
		$main_content .= '<table border=0 cellspacing=1 cellpadding=4 width=100%>
			<tr bgcolor="'.$config['site']['vdarkborder'].'" class=white>
				<td><b>Name</b></td><td><b>Reson</b></td><td><b>Data Add</b></td><td><b>Expires</b></td><td><b>Option</b></td>
			</tr>
			'.$players_rows.'
		</table>';
	}
	else
		$main_content .= "You don't have admin right.";
}
##-- Deletion ban
if($page == "delete")
{
	if($group_id_of_acc_logged >= 4)
	{
		$banId = (int) $_REQUEST['id'];
		$SQL->query('UPDATE '.$SQL->tableName('bans').' SET active = 0 WHERE '.$SQL->fieldName('id').' = '.$banId.';');
		header("Location: index.php?subtopic=bansmeneger&page=admin");
	}
	else
		$main_content .= "You don't have admin right.";
}
?>