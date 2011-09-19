<?php

$main_content .= '<center><h1>Guild Wars</h1></center>
<FONT SIZE=2 COLOR=#DF0101>
    * <b>/war invite,guild name,fraglimit</b> :
        <FONT SIZE=1 COLOR=green>
            Send an invitation to start a war.<br>
            <u>Example</u>: /war invite,Black Ninjas,150
        </FONT><br>
    * <b>/war accept,guild name</b> :
        <FONT SIZE=1 COLOR=green>
            Accept the invitation to start a war.
        </FONT><br>
    * <b>/war reject,guild name</b> :
        <FONT SIZE=1 COLOR=green>
            Reject the invitation to start a war.
        </FONT><br>
    * <b>/war cancel,guild name</b> :
        <FONT SIZE=1 COLOR=green>
            This will cancel the invitation to the guild "Black Ninjas"
        </FONT><br>
    </FONT>
    <br> 
<FONT SIZE=2 COLOR=#8A0808>
        Those commands can only be executed by guild leaders.<br><br>
        <table border="1"><tr border="1"><td border="1"><h3>Remember:</h3>
        <ul>
		<li><h5>This war system is just like real Tibia\'s. During the war, the killing of a war opponent will always be a justified kill. However, attacking a war ponent will result in a protection zone block. If the attacked character hits back, he will also receive a protection zone block even though he did not initiate the act.<h5></li>
<li><h5>Characters that are currently in war will be marked with special icons. This allows an easy identification of friendly and opposing characters, as well as characters who are involved in other ongoing wars you are not part of. <h5></li>
        </ul></td></tr></table>
    </FONT> <br><br>
<table width="100%" border="0" cellspacing="1" cellpadding="4">
    <TR BGCOLOR='.$config['site']['vdarkborder'].'><TD COLSPAN=3 CLASS=white><B>Active Wars</B></TD></TR>
<TR BGCOLOR='.$config['site']['vdarkborder'].'>
<td class="vdarkborder" class="white" width="150"><b>Aggressor</b></td>
<td class="vdarkborder" class="white"><b>Information</b></td>
<td class="vdarkborder" class="white" width="150"><b>Enemy</b></td>
</tr>';
 
$count = 0;
foreach($SQL->query('SELECT * FROM `guild_wars` WHERE (`end` >= (UNIX_TIMESTAMP() - 604800) OR `end` = 0) AND `status` IN (1,4);') as $war) /* 0,5 */
{
	$a = $ots->createObject('Guild');
	$a->load($war['guild_id']);
	if(!$a->isLoaded())
		continue;
 
	$e = $ots->createObject('Guild');
	$e->load($war['enemy_id']);
	if(!$e->isLoaded())
		continue;
 
	$alogo = $a->getCustomField('logo_gfx_name');
	if(empty($alogo) || !file_exists('images/guilds/' . $alogo))
		$alogo = 'default_logo.gif';
 
	$elogo = $e->getCustomField('logo_gfx_name');
	if(empty($elogo) || !file_exists('images/guilds/' . $elogo))
		$elogo = 'default_logo.gif';
 
	$count++;
	if(is_int($count / 2))
		$bgcolor = $config['site']['darkborder'];
	else
		$bgcolor = $config['site']['lightborder'];
 
	$main_content .= "<tr style=\"background: ".$bgcolor.";\">
<td align=\"center\"><a href=\"?subtopic=guilds&action=show&guild=".$a->getId()."\"><img src=\"images/guilds/".$alogo."\" width=\"64\" height=\"64\" border=\"0\"/><br />".$a->getName()."</a></td>
<td class=\"white\" align=\"center\"><font color=\"#3D3D3D\">";
	switch($war['status'])
	{
		case 1:
		{
			$main_content .= "<span style=\"color: red;\"><font size=\"12\">" . $war['guild_kills'] . " : " . $war['enemy_kills'] . "</font><br /><br /><b>On a brutal war</b></span><br />Began on " . date("M d Y, H:i:s", $war['begin']) . ($war['end'] > 0 ? ", will end up at " . date("M d Y, H:i:s", $war['end']) : "") . ".<br />The frag limit is set to " . $war['frags'] . " frags, " . ($war['payment'] > 0 ? "with payment of " . $war['payment'] . " gold coins." : "without any payment.");
			break;
		}
 
		case 4:
		{
			$main_content .= "<span style=\"color: red;\"><font size=\"12\">" . $war['guild_kills'] . " : " . $war['enemy_kills'] . "</font><br /><br />Pending end</span><br />Began on " . date("M d Y, H:i:s", $war['begin']) . ", signed armstice on " . date("M d Y, H:i:s", $war['end']) . ".<br />Will expire after reaching " . $war['frags'] . " frags. ".($war['payment'] > 0 ? "The payment is set to " . $war['payment'] . " gold coins." : "There's no payment set.");
			break;
		}
		default:
		{
			$main_content .= "Unknown, please contact with gamemaster.";
			break;
		}
	}
 
	$main_content .= "</font></td>
<td align=\"center\"><a href=\"?subtopic=guilds&action=show&guild=".$e->getId()."\"><img src=\"images/guilds/".$elogo."\" width=\"64\" height=\"64\" border=\"0\"/><br />".$e->getName()."</a></td>
</tr>";
}
 
if($count == 0)
	$main_content .= "<tr style=\"background: ".$config['site']['darkborder'].";\">
<td colspan=\"3\">Currently there are no active wars.</td>
</tr>";
 
$main_content .= '</table><br><br><table width="100%" border="0" cellspacing="1" cellpadding="4"><TR BGCOLOR='.$config['site']['vdarkborder'].'><TD COLSPAN=3 CLASS=white><B>Pending declarations</B></TD></TR><TR BGCOLOR='.$config['site']['vdarkborder'].'>
<td class="vdarkborder" class="white" width="150"><b>Aggressor</b></td>
<td class="vdarkborder" class="white"><b>Information</b></td>
<td class="vdarkborder" class="white" width="150"><b>Enemy</b></td>
</tr>';
 
$count = 0;
foreach($SQL->query('SELECT * FROM `guild_wars` WHERE (`end` >= (UNIX_TIMESTAMP() - 604800) OR `end` = 0) AND `status` IN (0);') as $war) /* 0,5 */
{
	$a = $ots->createObject('Guild');
	$a->load($war['guild_id']);
	if(!$a->isLoaded())
		continue;
 
	$e = $ots->createObject('Guild');
	$e->load($war['enemy_id']);
	if(!$e->isLoaded())
		continue;
 
	$alogo = $a->getCustomField('logo_gfx_name');
	if(empty($alogo) || !file_exists('images/guilds/' . $alogo))
		$alogo = 'default_logo.gif';
 
	$elogo = $e->getCustomField('logo_gfx_name');
	if(empty($elogo) || !file_exists('images/guilds/' . $elogo))
		$elogo = 'default_logo.gif';
 
	$count++;
	if(is_int($count / 2))
		$bgcolor = $config['site']['darkborder'];
	else
		$bgcolor = $config['site']['lightborder'];
 
	$main_content .= "<tr style=\"background: ".$bgcolor.";\">
<td align=\"center\"><a href=\"?subtopic=guilds&action=show&guild=".$a->getId()."\"><img src=\"images/guilds/".$alogo."\" width=\"64\" height=\"64\" border=\"0\"/><br />".$a->getName()."</a></td>
<td class=\"white\" align=\"center\"><font color=\"#3D3D3D\">";
	switch($war['status'])
	{
		case 0:
		{
			$main_content .= "<b>Pending acceptation</b><br />Invited on " . date("M d Y, H:i:s", $war['begin']) . " for " . ($war['end'] > 0 ? (($war['end'] - $war['begin']) / 86400) : "unspecified") . " days. The frag limit is set to " . $war['frags'] . " frags, " . ($war['payment'] > 0 ? "with payment of " . $war['payment'] . " gold coins." : "without any payment.")."<br />Will expire in two days.";
			break;
		}
		default:
		{
			$main_content .= "Unknown, please contact with gamemaster.";
			break;
		}
	}
 
	$main_content .= "</font></td>
<td align=\"center\"><a href=\"?subtopic=guilds&action=show&guild=".$e->getId()."\"><img src=\"images/guilds/".$elogo."\" width=\"64\" height=\"64\" border=\"0\"/><br />".$e->getName()."</a></td>
</tr>";
}
 
if($count == 0)
	$main_content .= "<tr style=\"background: ".$config['site']['darkborder'].";\">
<td colspan=\"3\">Currently there are no under declaration of war.</td>
</tr>";
 
$main_content .= '</table><br><br><table width="100%" border="0" cellspacing="1" cellpadding="4"><TR BGCOLOR='.$config['site']['vdarkborder'].'><TD COLSPAN=3 CLASS=white><B>Finished Wars</B></TD></TR><TR BGCOLOR='.$config['site']['vdarkborder'].'>
<td class="vdarkborder" class="white" width="150"><b>Aggressor</b></td>
<td class="vdarkborder" class="white"><b>Information</b></td>
<td class="vdarkborder" class="white" width="150"><b>Enemy</b></td>
</tr>';
 
$count = 0;
foreach($SQL->query('SELECT * FROM `guild_wars` WHERE `status` IN (5);') as $war) /* 0,5 */
{
	$a = $ots->createObject('Guild');
	$a->load($war['guild_id']);
	if(!$a->isLoaded())
		continue;
 
	$e = $ots->createObject('Guild');
	$e->load($war['enemy_id']);
	if(!$e->isLoaded())
		continue;
 
	$alogo = $a->getCustomField('logo_gfx_name');
	if(empty($alogo) || !file_exists('images/guilds/' . $alogo))
		$alogo = 'default_logo.gif';
 
	$elogo = $e->getCustomField('logo_gfx_name');
	if(empty($elogo) || !file_exists('images/guilds/' . $elogo))
		$elogo = 'default_logo.gif';
 
	$count++;
	if(is_int($count / 2))
		$bgcolor = $config['site']['darkborder'];
	else
		$bgcolor = $config['site']['lightborder'];
 
	$main_content .= "<tr style=\"background: ".$bgcolor.";\">
<td align=\"center\"><a href=\"?subtopic=guilds&action=show&guild=".$a->getId()."\"><img src=\"images/guilds/".$alogo."\" width=\"64\" height=\"64\" border=\"0\"/><br />".$a->getName()."</a></td>
<td class=\"white\" align=\"center\"><font color=\"#3D3D3D\">";
	switch($war['status'])
	{
		case 5:
		{
			$main_content .= "<i>Ended</i><br />Began on " . date("M d Y, H:i:s", $war['begin']) . ", ended on " . date("M d Y, H:i:s", $war['end']) . ". Frag statistics: " . $war['guild_kills'] . " to " . $war['enemy_kills'] . ".";
			break;
		}
		default:
		{
			$main_content .= "Unknown, please contact with gamemaster.";
			break;
		}
	}
 
	$main_content .= "</font></td>
<td align=\"center\"><a href=\"?subtopic=guilds&action=show&guild=".$e->getId()."\"><img src=\"images/guilds/".$elogo."\" width=\"64\" height=\"64\" border=\"0\"/><br />".$e->getName()."</a></td>
</tr>";
}
 
if($count == 0)
	$main_content .= "<tr style=\"background: ".$config['site']['darkborder'].";\">
<td colspan=\"3\">Currently there are no finished wars.</td>
</tr>";
 
$main_content .= "</table>";
?>
