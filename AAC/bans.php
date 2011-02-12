<?PHP
$ban_types = array(1 => 'IP Banishment', 2 => 'Namelock', 3 => 'Account Banishment', 4 => 'Notation', 5 => 'Until Deletion');
$ban_reason = array("Offensive Name", "Invalid Name Format", "Unsuitable Name", "Name Inciting Rule Violation", "Offensive Statement", "Spamming", "Illegal Advertising", "Off-Topic Public Statement", "Non-English Public Statement", "Inciting Rule Violation", "Bug Abuse", "Game Weakness Abuse", "Using Unofficial Software to Play", "Hacking", "Multi-Clienting", "Account Trading or Sharing", "Threatening Gamemaster", "Pretending to Have Influence on Rule Enforcer", "False Report to Gamemaster", "Destructive Behaviour", "Excessive Unjustified Player Killing", "Invalid Payment", "Spoiling Auction");
$bans = $SQL->query('SELECT `bans`.`type`, `bans`.`value`, `bans`.`comment`,`bans`.`admin_id`, `bans`.`expires`, `bans`.`added`, `bans`.`reason` FROM `bans`, `players` WHERE `players`.`account_id` = `bans`.`value` AND `bans`.`active` = 1 GROUP BY `bans`.`value` ORDER BY `bans`.`added` DESC')->fetchAll();
if(!$bans) 
	$main_content .= '<h2><b>No one is banned at the moment at '.$config['server']['serverName'].'</b></h2>';
else
{
    $number_of_players = 0;
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
    //list of players
    $main_content .= '<TABLE BORDER=0 CELLSPACING=1 CELLPADDING=4 WIDTH=100%><TR BGCOLOR="'.$config['site']['vdarkborder'].'"><TD CLASS=white><b>Banned Player</b></TD><TD class="white"><b>Reason</b></TD><TD class="white"><b>Comment</b></TD><TD class="white"><b>Banned By</b></TD><TD class="white"><b>Date</b></TD><TD class="white"><b>Expires</b></TD></TR>'.$players_rows.'</TABLE>';
}
?>
