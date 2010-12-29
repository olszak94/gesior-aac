   <?PHP
//////////////////
/// CREATED BY ///
///   SAMME    ///
/////  FROM  /////
/// OTLAND.NET ///
//////////////////

//Please respect the copyrights!//

$ban_reason = array("offensive name", "name containing part of sentence", "name with nonsensical letter combination", "invalid name format", "name not describing person", "name of celebrity", "name reffering to country", "Offtopic (Forum)", "name to fake official position", "offensive statement", "spamming", "advertisement not related to game", "macro use", "<center>--></center>", "off-topic public statement", "inciting rule violation", "bug abuse", "game weakness abuse", "Macro Use", "Destructive Behaviour", "<center>--></center>", "multi-clienting", "account trading", "<center>--></center>", "threatening gamemaster", "pretending to have official position", "pretending to have influence on gamemaster", "false report to gamemaster", "excessive unjustified player killing", "destructive behaviour", "spoiling auction", "invalid payment");

$players_banned = $SQL->query('SELECT `bans`.`account`, `bans`.`comment`, `bans`.`banned_by`, `bans`.`time`, `bans`.`reason_id` FROM `bans`, `players` WHERE `players`.`account_id` = `bans`.`account` AND `bans`.`time` > '.time().' AND `bans`.`type` = 3 GROUP BY `bans`.`account` ORDER BY `bans`.`time`')->fetchAll();
$number_of_players = 0;
if(!$players_banned) {
$main_content .= '<center><i>There are no players banned on '.$config['server']['serverName'].'</i></center>';
} else {
foreach($players_banned as $player) {
    $nick = $SQL->query("SELECT name, id, level, account_id FROM `players` WHERE account_id =".$player['account']." ORDER BY level DESC LIMIT 1")->fetch(); 
    $banned_by = $SQL->query("SELECT name, id FROM `players` WHERE id =".$player['banned_by']."")->fetch(); 
        
    
    if($player['banned_by'] >= "1")
        $banby = "<a href=?subtopic=characters&name=".urlencode($banned_by[0])."><font color ='green'>$banned_by[0]</font></a>";
    else
        $banby = "Auto Ban";
        
    if($player['time'] == "-1")
        $time = "Permament";
    else
        $time = date("d/m/Y, G:i:s", $player['time']);
        
    $number_of_players++;
    if(is_int($number_of_players / 2))
        $bgcolor = $config['site']['darkborder'];
    else
        $bgcolor = $config['site']['lightborder'];
    $players_rows .= '<TR BGCOLOR='.$bgcolor.'><TD WIDTH=15%><A HREF="?subtopic=characters&name='.$nick['name'].'">'.$nick['name'].'</A></TD><TD WIDTH=5%>'.$ban_reason[$player['reason_id']].'</TD><TD WIDTH=20%>'.$player['comment'].'</TD><TD>'.$banby.'</TD><TD>'.$time.'</TD></TR>';
}
    //list of players
    $main_content .= '<TABLE BORDER=0 CELLSPACING=1 CELLPADDING=4 WIDTH=100%><TR BGCOLOR="'.$config['site']['vdarkborder'].'"><TD CLASS=white><b><center>Banned Player</center></b></TD><TD class="white"><b><center>Reason</center></b></TD><TD class="white"><b><center>Comment</center></b></TD><TD class="white"><b><center>Banned By</center></b></TD><TD class="white"><b><center>Expires</center></b></TD></TR>'.$players_rows.'</TABLE>';
}
    //COPY RIGHTS!! DO NOT DELETE!
    $main_content .= '<br/><p align="right">Scripted by <B>Samme</B> from Otland.net</p>';
?> 