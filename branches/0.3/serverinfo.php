<?PHP
if($config['site']['serverinfo_page'])
{
	$stages = simplexml_load_file($config['site']['server_path'].'/data/XML/stages.xml');
	$servers = simplexml_load_file($config['site']['server_path'].'/data/XML/servers.xml');
	$talkactions = simplexml_load_file($config['site']['server_path'].'/data/talkactions/talkactions.xml');
	$main_content .= '<br><center>
		<table border="0" cellpadding="4" cellspacing="1" width="95%">
			<tr bgcolor="'.$config['site']['vdarkborder'].'">
				<td colspan="2"><font class="white"><b>Status</b></font></td>
			</tr>
			<tr bgcolor="'.$config['site']['vdarkborder'].'">
				<td width="50%"><font class="white">Name</font></td><td><font class="white">Value</font></td>
			</tr>
			<tr bgcolor="'.$config['site']['darkborder'].'">
				<td>Server</td><td>'.(($config['status']['serverStatus_online'] == 1) ? '<font color="grenn"><b>OnLine</b></font>' : '<font color="red"><b>OffLine</b></font>').'</td>
			</tr>
			<tr bgcolor="'.$config['site']['lightborder'].'">
				<td>Player Online</td><td>'.$config['status']['serverStatus_players'].'</td>
			</tr>
			<tr bgcolor="'.$config['site']['darkborder'].'">
				<td>UpTime</td><td>'.$config['status']['serverStatus_uptime'].'</td>
			</tr>
			<tr bgcolor="'.$config['site']['lightborder'].'">
				<td>Monster</td><td>'.$config['status']['serverStatus_monsters'].'</td>
			</tr>
			<!--
			<tr bgcolor="'.$config['site']['darkborder'].'">
				<td>NPC</td><td>'.$config['status']['serverStatus_npc'].'</td>
			</tr>
			-->
		</table>
		<br>';
	if($config['server']['experienceStages'] == false)
        $rateExperience .= $config['server']['rateExperience'].' x';
    else
	{
        $rateExperience .= '<table width="100%">';
        foreach($stages as $exp1)
        {
			$i = 0;
			$ots = (int) $exp1["id"];
			if($ots > 0)
				$rateExperience .= '<tr align="center" bgcolor="'.$config['site']['vdarkborder'].'"><td colspan="3"><strong>Experience Stages on '.$config['site']['worlds'][$ots].'</strong></td></tr>';
			$rateExperience .= '<tr align="center" bgcolor="'.$config['site']['vdarkborder'].'"><td class="white">From Level</td><td class="white">To Level</td><td class="white">Rate</td></tr>';
			foreach($exp1 as $exp)
            {
				if(isset($exp["maxlevel"]))
					$max = $exp["maxlevel"];
				else
					$max = "-";
				if(is_int($i/2))
					$bgcolor=$config['site']['lightborder'];
				else
					$bgcolor=$config['site']['darkborder'];
				$rateExperience .= '<tr align="center" bgcolor="'.$bgcolor.'"><td>'.$exp["minlevel"].'</td><td>'.$max.'</td><td>'.$exp["multiplier"].'</td></tr>';
				$i++;
			}
        }
        $rateExperience .= '</table>';
	}
	$main_content .= '<table border="0" cellpadding="4" cellspacing="1" width="95%">
			<tr bgcolor="'.$config['site']['vdarkborder'].'">
				<td colspan="2"><font class="white"><b>Rates</b></font></td>
			</tr>
			<tr bgcolor="'.$config['site']['vdarkborder'].'">
				<td><font class="white">Name</font></td><td><font class="white">Value</font></td>
			</tr>
			<tr bgcolor="'.$config['site']['darkborder'].'">
				<td width="50%">Experience</td><td>'.$rateExperience.'</td>
			</tr>
			<tr bgcolor="'.$config['site']['lightborder'].'">
				<td>Skill</td><td>'.$config['server']['rateSkill'].' x</td>
			</tr>
			<tr bgcolor="'.$config['site']['darkborder'].'">
				<td>Magic</td><td>'.$config['server']['rateMagic'].' x</td>
			</tr>
			<tr bgcolor="'.$config['site']['lightborder'].'">
				<td>Loot</td><td>'.$config['server']['rateLoot'].' x</td>
			</tr>
			<tr bgcolor="'.$config['site']['darkborder'].'">
				<td>Spawn</td><td>'.$config['server']['rateSpawn'].' x</td>
			</tr>
		</table><br>';
	foreach($servers as $server)
	{
		$v1 = $server['versionMin'];
		$v2 = $server['versionMax'];
		if($v1 == $v2) 
        {
            $version = str_split($v1); 
            $version = $version[0].'.'.$version[1].$version[2]; 
        }
		else
        {
            $v1 = str_split($v1); 
            $v2 = str_split($v2); 
            $version = $v1[0].'.'.$v1[1].$v1[2].'~'.$v2[0].'.'.$v2[1].$v2[2]; 
        }
	}
	///Queries ///
		$query = $SQL->query('SELECT `name`, `id`, `level`, `experience` FROM `players` WHERE players.group_id < '.$config['site']['players_group_id_block'].' AND account_id != 1 ORDER BY `level` DESC, `experience` DESC LIMIT 1;')->fetch();
		$query2 = $SQL->query('SELECT `id`, `name` FROM `players` ORDER BY `id` DESC LIMIT 1;')->fetch();
		$housesfree = $SQL->query('SELECT COUNT(*) FROM `houses` WHERE `owner`=0;')->fetch();
		$housesrented = $SQL->query('SELECT COUNT(*) FROM `houses` WHERE `owner`=1;')->fetch();
		$banned = $SQL->query('SELECT COUNT(*) FROM `bans` WHERE `id`>0;')->fetch();
		$accounts = $SQL->query('SELECT COUNT(*) FROM `accounts` WHERE `id`>0;')->fetch();
		$players = $SQL->query('SELECT COUNT(*) FROM `players` WHERE `id`>0;')->fetch();
		$guilds = $SQL->query('SELECT COUNT(*) FROM `guilds` WHERE `id`>0;')->fetch();
	///End Queries ///
	$main_content .= '<table border="0" cellpadding="4" cellspacing="1" width="95%">
		<tr bgcolor="'.$config['site']['vdarkborder'].'">
			<td colspan="2"><font class="white"><b>Info Server</b></font></td>
		</tr>
		<tr bgcolor="'.$config['site']['vdarkborder'].'">
			<td width="50%"><font class="white">Name</font></td><td><font class="white">Value</font></td>
		</tr>
		<tr bgcolor="'.$config['site']['darkborder'].'">
			<td>World Type</td><td>'.$config['server']['worldType'].'</td>
		</tr>
		<tr bgcolor="'.$config['site']['lightborder'].'">
			<td>Client Version</td><td>'.$version.'</td>
		</tr>
		<tr bgcolor="'.$config['site']['darkborder'].'">
			<td>Server motd</td><td>'.$config['server']['motd'].'</td>
		</tr>
		<tr bgcolor="'.$config['site']['lightborder'].'">
			<td>Last joined</td><td><a href="?subtopic=characters&name='.urlencode($query2['name']).'">'.$query2['name'].'</a></td>
		</tr>
		<tr bgcolor="'.$config['site']['darkborder'].'">
			<td>Best Level</td><td><a href="index.php?subtopic=characters&name='.urlencode($query['name']).'">'.$query['name'].'</a> ('.$query['level'].')</td>
		</tr>
		<tr bgcolor="'.$config['site']['lightborder'].'">
			<td>Free Houses</td><td>'.$housesfree[0].'</td>
		</tr>
		<tr bgcolor="'.$config['site']['darkborder'].'">
			<td>Rented Houses:</td><td>'.$housesrented[0].'</td>
		</tr>
		<tr bgcolor="'.$config['site']['lightborder'].'">
			<td>Banned accounts:</td><td>'.$banned[0].'</td>
		</tr>
		<tr bgcolor="'.$config['site']['darkborder'].'">
			<td>Accounts in database:</td><td>'.$accounts[0].'</td>
		</tr>
		<tr bgcolor="'.$config['site']['lightborder'].'">
			<td>Players in database:</td><td>'.$players[0].'</td>
		</tr>
		<tr bgcolor="'.$config['site']['darkborder'].'">
			<td>Guilds in databese:</td><td>'.$guilds[0].'</td>
		</tr>
	</table><br>';
    $main_content .= '<table border="0" cellpadding="4" cellspacing="1" width="95%">
			<tr bgcolor="'.$config['site']['vdarkborder'].'">
				<td colspan="2"><font class="white"><b>Commands</b></font></td>
			</tr>';
    $i = 1;
    $k = 0;
    foreach($talkactions as $command)
    {
        if(empty($command["access"]) or $command["access"] == 0)
        {
			if(is_int($k/2))
				$bgcolor=$config['site']['lightborder'];
			else
				$bgcolor=$config['site']['darkborder'];
			if(is_int($i/2))
				$main_content .= '<td>'.$command["words"].'</td></tr>';
			else
            {
				$main_content .= '<tr align="center" bgcolor="'.$bgcolor.'"><td width="50%">'.$command["words"].'</td>';
				$k++;
            }
			$i++;
		}
	}
	$main_content .= '</table><br>';
	$whiteSkullTime = explode("*", $config['server']['whiteSkullTime']);
	$whiteSkullTime = $whiteSkullTime[0].(count($whiteSkullTime) == 3 ? ' minutes' : ' seconds'); 
	# Info for Red Skull
	$redSkullLength = explode("*", $config['server']['redSkullLength']);
    $redSkullLength = $redSkullLength[0].(count($redSkullLength) == 4 ? ' days' : ' hours'); 
	$fragsToRedSkull = 'Daily: '.$config['server']['dailyFragsToRedSkull'].' | Weekly: '.$config['server']['weeklyFragsToRedSkull'].' | Monthly: '.$config['server']['monthlyFragsToRedSkull'];
	# Info for Ban
	$killsBanLength = explode("*", $config['server']['killsBanLength']);
    $killsBanLength = $killsBanLength[0].(count($killsBanLength) == 4 ? ' days' : ' hours'); 
    $kill_daily = is_numeric($config['server']['dailyFragsToBanishment']) ? $config['server']['dailyFragsToBanishment'] : $config['server']['dailyFragsToRedSkull'];
    $kill_weekly = is_numeric($config['server']['weeklyFragsToBanishment']) ? $config['server']['weeklyFragsToBanishment'] : $config['server']['weeklyFragsToRedSkull'];
    $kill_monthly = is_numeric($config['server']['monthlyFragsToBanishment']) ? $config['server']['monthlyFragsToBanishment'] : $config['server']['monthlyFragsToRedSkull'];
	$fragsToBanishment = 'Daily: '.$kill_daily.' | Weekly: '.$kill_weekly.' | Monthly: '.$kill_monthly;
	# Info for Black Skull
	if($config['server']['useBlackSkull'] == true)
	{
		$blackSkullLength = explode("*", $config['server']['blackSkullLength']);
		$blackSkullLength = $blackSkullLength[0].(count($blackSkullLength) == 4 ? ' days' : ' hours'); 
		$black_daily = is_numeric($config['server']['dailyFragsToBlackSkull']) ? $config['server']['dailyFragsToBlackSkull'] : $config['server']['dailyFragsToRedSkull'];
		$black_weekly = is_numeric($config['server']['weeklyFragsToBlackSkull']) ? $config['server']['weeklyFragsToBlackSkull'] : $config['server']['weeklyFragsToRedSkull'];
		$black_monthly = is_numeric($config['server']['monthlyFragsToBlackSkull']) ? $config['server']['monthlyFragsToBlackSkull'] : $config['server']['monthlyFragsToRedSkull'];
		$fragsToBlackSkull = 'Daily: '.$black_daily.' | Weekly: '.$black_weekly.' | Monthly: '.$black_monthly;
		$blackSkull = $blackSkullLength;
	}
	else
	{
		$blackSkull = "Disabled";
		$fragsToBlackSkull = "Disabled";
	}
	$main_content .= '<table border="0" cellpadding="4" cellspacing="1" width="95%">
		<tr bgcolor="'.$config['site']['vdarkborder'].'">
			<td colspan="2"><font class="white"><b>Frags</b></font></td>
		</tr>
		<tr bgcolor="'.$config['site']['vdarkborder'].'">
			<td width="50%"><font class="white">Name</font></td><td><font class="white">Value</font></td>
		</tr>
		<tr bgcolor="'.$config['site']['darkborder'].'">
			<td>White Skull Time</td><td>'.$whiteSkullTime.'</td>
		</tr>
		<tr bgcolor="'.$config['site']['lightborder'].'">
			<td>Red Skull Time</td><td>'.$redSkullLength.'</td>
		</tr>
		<tr bgcolor="'.$config['site']['darkborder'].'">
			<td>Black Skull Time</td><td>'.$blackSkull.'</td>
		</tr>
		<tr bgcolor="'.$config['site']['lightborder'].'">
			<td>Black Skull Time</td><td>'.$killsBanLength.'</td>
		</tr>
		<tr bgcolor="'.$config['site']['darkborder'].'">
			<td>Frags to Red Skull</td><td>'.$fragsToRedSkull.'</td>
		</tr>
		<tr bgcolor="'.$config['site']['lightborder'].'">
			<td>Frags to Black Skull</td><td>'.$fragsToBlackSkull.'</td>
		</tr>
		<tr bgcolor="'.$config['site']['darkborder'].'">
			<td>Frags to Ban</td><td>'.$fragsToBanishment.'</td>
		</tr>
	</table><br>';
	$idleKickTime = explode("*", $config['server']['idleKickTime']);
	$idleKickTime = $idleKickTime[0].(count($idleKickTime) == 4 ? ' minuts' : ' hours'); 
	$pzLocked = explode("*", $config['server']['pzLocked']);
	$pzLocked = $pzLocked[0].(count($pzLocked) == 3 ? ' minuts' : ' seconds'); 
	if($config['server']['freePremium'] == true)
		$freePremium = "Free";
	else
		$freePremium = 'Not Free';
	if($config['server']['bankSystem'] == true)
		$bankSystem = "Enabled";
	else
		$bankSystem = "Disabled";
	if($config['server']['guildHalls'] == true)
		$guildHalls = "Enabled";
	else
		$guildHalls = "Disabled";
	$main_content .= '<table border="0" cellpadding="4" cellspacing="1" width="95%">
		<tr bgcolor="'.$config['site']['vdarkborder'].'">
			<td colspan="2"><font class="white"><b>Onther information</b></font></td>
		</tr>
		<tr bgcolor="'.$config['site']['vdarkborder'].'">
			<td width="50%"><font class="white">Name</font></td><td><font class="white">Value</font></td>
		</tr>
		<tr bgcolor="'.$config['site']['darkborder'].'">
			<td>Premium</td><td>'.$freePremium.'</td>
		</tr>
		<tr bgcolor="'.$config['site']['lightborder'].'">
			<td>Bank System</td><td>'.$bankSystem.'</td>
		</tr>
		<tr bgcolor="'.$config['site']['darkborder'].'">
			<td>Guild halls</td><td>'.$guildHalls.'</td>
		</tr>
		<tr bgcolor="'.$config['site']['lightborder'].'">
			<td>Kick Time</td><td>'.$idleKickTime.'</td>
		</tr>
		<tr bgcolor="'.$config['site']['darkborder'].'">
			<td>PZ Lock</td><td>'.$pzLocked.'</td>
		</tr>
		<tr bgcolor="'.$config['site']['lightborder'].'">
			<td>Protection Level</td><td>'.$config['server']['protectionLevel'].'</td>
		</tr>
		<tr bgcolor="'.$config['site']['darkborder'].'">
			<td>Level to buy house</td><td>'.$config['server']['levelToBuyHouse'].'</td>
		</tr>
		<tr bgcolor="'.$config['site']['lightborder'].'">
			<td>Level to create guild</td><td>'.$config['site']['guild_need_level'].'</td>
		</tr>
		<!--
		<tr bgcolor="'.$config['site']['darkborder'].'">
			<td></td><td></td>
		</tr>
		<tr bgcolor="'.$config['site']['lightborder'].'">
			<td></td><td></td>
		</tr>
		-->
	</table><br>';
	$main_content .= '</center>';
}
else
	$main_content .= "Invalid subtopic. Can't load page.";
?>

