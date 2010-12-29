<?php
function showGroup($group)
{
	global $SQL;
	global $config;
	$return .= "<table border=0 cellspacing=1 cellpadding=4 width=100%>
	<tr bgcolor=\"#".$config['site']['vdarkborder']."\">
	<td width=\"80%\"><font class=white><b>Name</b></font></td>
	<td width=\"20%\"><font class=white><b>Status</b></font></td>";
	$groupMembers = $SQL->query('SELECT `name`, `online` FROM `players` WHERE `group_id` = '.$group);
	$membersCount = 0;
	foreach($groupMembers as $member)
	{
		$membersCount++;
		if(is_int($membersCount / 2))
			$bgcolor = $config['site']['darkborder'];
		else
			$bgcolor = $config['site']['lightborder'];
		$return .= "<tr bgcolor=\"".$bgcolor."\">
		<td>".$member['name']."</td>
		<td>".($member['online']>0 ? "Online" : "Offline")."</td>
		</tr>";
	}
	if ($membersCount = 0) $return .= "<tr bgcolor=\"".$config['site']['darkborder']."\">
	<td colspan=\"2\">No members available.</td>
	</tr>";
	$return .= "</table>";
	
	return $return;
}
//list of players
$main_content .= '<center><h2>Support in game</h2></center>';
$main_content .= "<table border=0 cellspacing=1 cellpadding=4 width=100%>
	<tr bgcolor=\"".$config['site']['vdarkborder']."\">
	<td width=\"20%\"><font class=white><b>Group</b></font></td>
	<td width=\"60%\"><font class=white><b>Name</b></font></td>
	<td width=\"20%\"><font class=white><b>Status</b></font></td>";
$showed_players = 0;
$groups_list = new OTS_Groups_List();
$groups_list->init();
$groups_list->orderBy('id', POT::ORDER_DESC);
foreach($groups_list as $group)
{
if($group->getId() >= $config['site']['players_group_id_block'])
{
	$group_members = $group->getPlayersList();
	if(count($group_members) > 0)
		foreach($group_members as $member)
		{
		$showed_players++;
		if(is_int($showed_players / 2))
			$bgcolor = $config['site']['darkborder'];
		else
			$bgcolor = $config['site']['lightborder'];
		$main_content .= "<tr bgcolor=\"".$bgcolor."\">
		<td>".ucwords($group->getName())."</td>
		<td>".$member->getName()."</td>
		<td>".($member->getCustomField('online')>0 ? "<font color=\"green\"><b>Online</b></font>" : "<font color=\"red\"><b>Offline</b></font>")."</td>
		</tr>";
		}
}
}

if($showed_players == 0)
	$main_content .= "<tr bgcolor=\"".$config['site']['darkborder']."\">
	<td colspan=\"3\">No members of support team available.</td>
	</tr>";
$main_content .= "</table>";
?>