<?PHP
$name = stripslashes(ucwords(strtolower(trim($_REQUEST['name']))));
if(empty($name)) {
	$main_content .= 'Here you can get detailed information about a certain player on '.$config['server']['serverName'].'.<BR>  <FORM ACTION="index.php?subtopic=characters" METHOD=post><TABLE WIDTH=100% BORDER=0 CELLSPACING=1 CELLPADDING=4><TR><TD BGCOLOR="'.$config['site']['vdarkborder'].'" CLASS=white><B>Search Character</B></TD></TR><TR><TD BGCOLOR="'.$config['site']['darkborder'].'"><TABLE BORDER=0 CELLPADDING=1><TR><TD>Name:</TD><TD><INPUT NAME="name" VALUE=""SIZE=29 MAXLENGTH=29></TD><TD><INPUT TYPE=image NAME="Submit" SRC="'.$layout_name.'/images/buttons/sbutton_submit.gif" BORDER=0 WIDTH=120 HEIGHT=18></TD></TR></TABLE></TD></TR></TABLE></FORM>';
}
else
{
	if(check_name($name)) {
		$player = $ots->createObject('Player');
		$player->find($name);
		if($player->isLoaded()) {
			$account = $player->getAccount();
			//check is premy account
			if($account->getCustomField("premdays") == 0) {
				$account_status = '<b><span class="red">Free Account</span></b>';
			}
			else
			{
				$account_status = '<b><span class="green">Premium Account</span></b>';
			}
			//set sex name
			if($player->getSex() == 0)
				$sex = 'female';
			else
				$sex = 'male';
			$main_content .= '<TABLE BORDER=0 CELLPADDING=0 CELLSPACING=0 WIDTH=100%><TR><TD><IMG SRC="'.$layout_name.'/images/general/blank.gif" WIDTH=10 HEIGHT=1 BORDER=0></TD><TD><TABLE BORDER=0 CELLSPACING=1 CELLPADDING=4 WIDTH=100%><TR BGCOLOR='.$config['site']['vdarkborder'].'><TD COLSPAN=2 CLASS=white><B>Character Information</B></TD></TR>';
			if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['lightborder']; } $number_of_rows++;
			$main_content .= '<TR BGCOLOR="'.$bgcolor.'"><TD WIDTH=20%>Name:</TD><TD>'.$player->getName().'</TD></TR>';
			if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['lightborder']; } $number_of_rows++;
			$main_content .= '<TR BGCOLOR="'.$bgcolor.'"><TD>Sex:</TD><TD>'.$sex.'</TD></TR>';
			if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['lightborder']; } $number_of_rows++;
			$main_content .= '<TR BGCOLOR="'.$bgcolor.'"><TD>Profession:</TD><TD>'.$config_vocations[$player->getVocation()].'</TD></TR>';
			if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['lightborder']; } $number_of_rows++;
			$main_content .= '<TR BGCOLOR="'.$bgcolor.'"><TD>Level:</TD><TD>'.$player->getLevel().'</TD></TR>';
			if($config['site']['show_mlvl'] == 1)
			{
				if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['lightborder']; } $number_of_rows++;
				$main_content .= '<TR BGCOLOR="'.$bgcolor.'"><TD>Magic Level:</TD><TD>'.$player->getMagLevel().'</TD></TR>';
			}
			if(!empty($towns_list[$player->getTownId()]))
			{
				if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['lightborder']; } $number_of_rows++;
				$main_content .= '<TR BGCOLOR="'.$bgcolor.'"><TD>Residence:</TD><TD>'.$towns_list[$player->getTownId()].'</TD></TR>';
			}
			$rank_of_player = $player->getRank();
			if(!empty($rank_of_player))
			{
				$guild_name = $rank_of_player->getGuild()->getName();
				if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['lightborder']; } $number_of_rows++;
				$main_content .= '<TR BGCOLOR="'.$bgcolor.'"><TD>Guild membership:</TD><TD>'.$rank_of_player->getName().' of the <a href="index.php?subtopic=guilds&action=show&guild='.$guild_name.'">'.$guild_name.'</a></TD></TR>';
			}
			if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['lightborder']; } $number_of_rows++;
			$lastlogin = $player->getLastLogin();
			if(empty($lastlogin))
				$main_content .= '<TR BGCOLOR="'.$bgcolor.'"><TD>Last login:</TD><TD>Never logged in.</TD></TR>';
			else
				$main_content .= '<TR BGCOLOR="'.$bgcolor.'"><TD>Last login:</TD><TD>'.date("j F Y, g:i a", $lastlogin).'</TD></TR>';
			if($config['site']['show_creationdate'] == 1)
			{
				if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['lightborder']; } $number_of_rows++;
				$main_content .= '<TR BGCOLOR="'.$bgcolor.'"><TD>Created:</TD><TD>'.date("j F Y, g:i a", $player->getCustomField("created")).'</TD></TR>';
			}
			$comment = $player->getCustomField("comment");
			$newlines   = array("\r\n", "\n", "\r");
			$comment_with_lines = str_replace($newlines, '<br />', $comment, $count);
			if($count < 50)
				$comment = $comment_with_lines;
			if(!empty($comment))
			{
				if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['lightborder']; } $number_of_rows++;
				$main_content .= '<TR BGCOLOR="'.$bgcolor.'"><TD VALIGN=top>Comment:</TD><TD>'.$comment.'</TD></TR>';
			}
			if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['lightborder']; } $number_of_rows++;
			$main_content .= '<TR BGCOLOR="'.$bgcolor.'"><TD>Account&#160;Status:</TD><TD>'.$account_status.'</TD></TR>';
			if($config['site']['show_vip_status'])
			{
           		 $id = $player->getCustomField("id");
         		   $main_content .= '<TR BGCOLOR="'.$config['site']['darkborder'].'"><TD WIDTH=10%>Vip Status:</TD>';
                        $vip = $SQL->query('SELECT * FROM player_storage WHERE player_id = '.$id.' AND `key` = '.$config['site']['show_vip_storage'].';')->fetch();
         		   if($vip == false) {
        		    $main_content .= '<TD><span class="red"><B>NOT VIP</B></TD></TR></Table>';
        		    }
        		    else
       			     {
       		          $main_content .= '<TD><span class="green"><B>VIP</B></TD></TR></table>';
          		  }
			}

			//modified status scripts by ballack13
			$main_content .= '<table width=100%><tr>';

                        //Hp/Mana/Exp Status by ballack13
                        $hp = ($player->getHealth() / $player->getHealthMax() * 100);
                        $mana = ($player->getMana() / $player->getManaMax() * 100);
          		$main_content .= '<td align=center ><table width=100%><tr><td align=center><table CELLSPACING="1" CELLPADDING="4"><tr><td BGCOLOR="#D4C0A1" align="left" width="20%"><b>Player Health:</b></td>
                  		          <td BGCOLOR="#D4C0A1" align="left">'.$player->getHealth().'/'.$player->getHealthMax().'<div style="width: 100%; height: 3px; border: 1px solid #000;"><div style="background: red; width: '.$hp.'%; height: 3px;"></td></tr>
                  		          <tr><td BGCOLOR="#F1E0C6" align="left"><b>Player Mana:</b></td><td BGCOLOR="#F1E0C6" align="left">'.$player->getMana().'/'.$player->getManaMax().'<div style="width: 100%; height: 3px; border: 1px solid #000;"><div style="background: blue; width: '.$mana.'%; height: 3px;"></td></tr></table><tr>';

                        $next = ($player->getLevel() + 1);
                        $exp = ((50 / 3) * ($player->getLevel() * $player->getLevel() * $player->getLevel()) - (100 * ($player->getLevel() * $player->getLevel())) + ((850/3) * $player->getLevel()) - 200);
                        $expnext = ((50 / 3) * ($next * $next * $next) - (100 * ($next * $next)) + ((850/3) * $next) - 200 - $player->getExperience());
                        $expresult = (100 - ($expnext / (($expnext  + $player->getExperience()) - $exp) * 100));
           	        $main_content .= '<tr><table CELLSPACING="1" CELLPADDING="4"><tr><td BGCOLOR="#D4C0A1" align="left" width="20%"><b>Player Level:</b></td><td BGCOLOR="#D4C0A1" align="left">'.$player->getLevel().'</td></tr>
                        		  <tr><td BGCOLOR="#F1E0C6" align="left"><b>Player Experience:</b></td><td BGCOLOR="#F1E0C6" align="left">'.$player->getExperience().' EXP.</td></tr>
                		          <tr><td BGCOLOR="#D4C0A1" align="left"><b>To Next Level:</b></td><td BGCOLOR="#D4C0A1" align="left">You need <b>'.$expnext.' EXP</b> to Level <b>'.$next.'</b>.<div title="99.320604545 %" style="width: 100%; height: 3px; border: 1px solid #000;"><div style="background: red; width: '.$expresult.'%; height: 3px;"></td></tr></table></td></tr></table></tr></TABLE></td>';

			//quest status by ballack13
			$id = $player->getCustomField("id");
			$number_of_quests = 0;
			$main_content .= '<TABLE BORDER=0 CELLSPACING=1 CELLPADDING=4 WIDTH=100%><TR BGCOLOR='.$config['site']['vdarkborder'].'><TD align="left" COLSPAN=2 CLASS=white><B>Quests</B></TD></TD align="right"></TD></TR>';		
                        $quests = array('Annihilator' => 5000,'Demon Helmet' => 2645,'Pits of Inferno' => 5550,'Inquisition' => 6076,'Mountain Annihilator' => 8850,'Djinn Tower' => 9050,'Jugga Jungle Quest' => 8884,'Yalahari Quest' => 5429); 
                        foreach ($quests as $storage => $name) {
				if(is_int($number_of_quests / 2))
					$bgcolor = $config['site']['darkborder'];
				else
					$bgcolor = $config['site']['lightborder'];
				$number_of_quests++;
			$main_content .= '<TR BGCOLOR="'.$bgcolor.'"><TD WIDTH=95%>'.$storage.'</TD>';
                        $quest = $SQL->query('SELECT * FROM player_storage WHERE player_id = '.$id.' AND `key` = '.$quests[$storage].';')->fetch();
                           if($quest == false) {
			$main_content .= '<TD><img src="images/false.png"/></TD></TR>';
                        }
			else
			{
			$main_content .= '<TD><img src="images/true.png"/></TD></TR>';
			}
			}
			$main_content .= '</TABLE></td></tr></table>';
			//deaths list
			$player_deaths = $SQL->query('SELECT * FROM player_deaths WHERE '.$player->getId().' = player_id ORDER BY time DESC');
			$number_of_players_deaths = 0;
			$dead_add_content .= '<br><TABLE BORDER=0 CELLSPACING=1 CELLPADDING=4 WIDTH=100%><TR BGCOLOR='.$config['site']['vdarkborder'].'><TD COLSPAN=2 CLASS=white><B>Deaths</B></TD></TR>';
			if(!empty($player_deaths)) {
				$vowels = array("e", "y", "u", "i", "o", "a");
				foreach($player_deaths as $dead) {
					if(is_int($number_of_player_deaths / 2))
						$bgcolor = $config['site']['darkborder'];
					else
						$bgcolor = $config['site']['lightborder'];
					$number_of_player_deaths++;
					$dead_add_content .= '<TR BGCOLOR="'.$bgcolor.'"><TD WIDTH=20%>'.date("j M Y, H:i", $dead['time']).'</TD><TD>Killed at Level '.$dead['level'].' by ';
					if($dead['is_player'] == 1)
						$dead_add_content .= '<a href="index.php?subtopic=characters&name='.$dead['killed_by'].'"><b>'.$dead['killed_by'].'</b></a>';
					else
					{
						if($dead['killed_by'] == "-1")
							$dead_add_content .= "item or field";
						else
						{
							if(in_array(substr(strtolower($dead['killed_by']), 0, 1), $vowels))
								$dead_add_content .= "an ";
							else
								$dead_add_content .= "a ";
							$dead_add_content .= $dead['killed_by'];
						}
					}
					$dead_add_content .= '.</TD></TR>';
				}
			}
			$dead_add_content .= '</TABLE>';
			if($number_of_player_deaths > 0)
				$main_content .= $dead_add_content;
			if($player->getCustomField("hide_char") != 1) {
				//account info
				$main_content .= '<br><TABLE BORDER=0><TR><TD></TD></TR></TABLE><TABLE BORDER=0 CELLSPACING=1 CELLPADDING=4 WIDTH=100%><TR BGCOLOR='.$config['site']['vdarkborder'].'><TD COLSPAN=2 CLASS=white><B>Account Information</B></TD></TR><TR BGCOLOR='.$config['site']['lightborder'].'><TD WIDTH=20%>Real name:</TD><TD>'.$account->getCustomField("rlname").'</TD></TR><TR BGCOLOR='.$config['site']['darkborder'].'><TD WIDTH=20%>Location:</TD><TD>'.$account->getCustomField("location").'</TD></TR><TR BGCOLOR='.$config['site']['lightborder'].'><TD WIDTH=20%>Created:</TD><TD>'.date("j F Y, g:i a", $account->getCustomField("created")).'</TD></TR></TABLE>';
				//char list table
				$main_content .= '<br><TABLE BORDER=0><TR><TD></TD></TR></TABLE><TABLE BORDER=0 CELLSPACING=1 CELLPADDING=4 WIDTH=100%><TR BGCOLOR='.$config['site']['vdarkborder'].'><TD COLSPAN=4 CLASS=white><B>Characters</B></TD></TR>
				<TR BGCOLOR='.$config['site']['darkborder'].'><TD><B>Name</B></TD><TD><B>Level</B></TD><TD><b>Status</b></TD><TD><B>&#160;</B></TD></TR>';
				//for each player on account
				$account_players = $account->getPlayersList();
				$account_players->orderBy('name');
				$player_number = 0;
				foreach($account_players as $player_list)
				{
					if($player_list->getCustomField("hide_char") != 1)
					{
					$player_number++;
					if(is_int($player_number / 2))
						$bgcolor = $config['site']['darkborder'];
					else
						$bgcolor = $config['site']['lightborder'];
					if($player_list->getCustomField("online") == 0)
						$player_list_status = '<font color="red">Offline</font>';
					else
						$player_list_status = '<font color="green">Online</font>';
					$main_content .= '<TR BGCOLOR="'.$bgcolor.'"><TD WIDTH=72%><NOBR>'.$player_number.'.&#160;'.$player_list->getName().'</NOBR></TD><TD WIDTH=20%>'.$player_list->getLevel().' '.$config_vocations[$player_list->getVocation()].'</TD><TD WIDTH="8%"><b>'.$player_list_status.'</b></TD><TD><TABLE BORDER=0 CELLSPACING=0 CELLPADDING=0><FORM ACTION="index.php?subtopic=characters" METHOD=post><TR><TD><INPUT TYPE=hidden NAME=name VALUE="'.$player_list->getName().'"><INPUT TYPE=image NAME="View '.$player_list->getName().'" ALT="View '.$player_list->getName().'" SRC="'.$layout_name.'/images/buttons/sbutton_view.gif" BORDER=0 WIDTH=120 HEIGHT=18></TD></TR></FORM></TABLE></TD></TR>';
					}
				}
				$main_content .= '</TABLE></TD><TD><IMG SRC="'.$layout_name.'/images/general/blank.gif" WIDTH=10 HEIGHT=1 BORDER=0></TD></TR></TABLE>';
				//end of char list table
			}
			//show search form
			$main_content .= '<BR><BR><FORM ACTION="index.php?subtopic=characters" METHOD=post><TABLE WIDTH=100% BORDER=0 CELLSPACING=1 CELLPADDING=4><TR><TD BGCOLOR="'.$config['site']['vdarkborder'].'" CLASS=white><B>Search Character</B></TD></TR><TR><TD BGCOLOR="'.$config['site']['darkborder'].'"><TABLE BORDER=0 CELLPADDING=1><TR><TD>Name:</TD><TD><INPUT NAME="name" VALUE=""SIZE=29 MAXLENGTH=29></TD><TD><INPUT TYPE=image NAME="Submit" SRC="'.$layout_name.'/images/buttons/sbutton_submit.gif" BORDER=0 WIDTH=120 HEIGHT=18></TD></TR></TABLE></TD></TR></TABLE></FORM>';
			$main_content .= '</TABLE>';
		}
		else
		{
			$search_errors[] = 'Character <b>'.$name.'</b> does not exist.';
			//gracz nie istnieje - komunikat
		}
	}
	else
	{
		$search_errors[] = 'This name contains invalid letters. Please use only A-Z, a-z and space.';
		//niepoprawne imie gracza
	}
	if(!empty($search_errors)) {
		$main_content .= '<div class="SmallBox" >  <div class="MessageContainer" >    <div class="BoxFrameHorizontal" style="background-image:url('.$layout_name.'/images/content/box-frame-horizontal.gif);" /></div>    <div class="BoxFrameEdgeLeftTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);" /></div>    <div class="BoxFrameEdgeRightTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);" /></div>    <div class="ErrorMessage" >      <div class="BoxFrameVerticalLeft" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);" /></div>      <div class="BoxFrameVerticalRight" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);" /></div>      <div class="AttentionSign" style="background-image:url('.$layout_name.'/images/content/attentionsign.gif);" /></div><b>The Following Errors Have Occurred:</b><br/>';
		foreach($search_errors as $search_error)
			$main_content .= '<li>'.$search_error;
		$main_content .= '</div>    <div class="BoxFrameHorizontal" style="background-image:url('.$layout_name.'/images/content/box-frame-horizontal.gif);" /></div>    <div class="BoxFrameEdgeRightBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);" /></div>    <div class="BoxFrameEdgeLeftBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);" /></div>  </div></div><br/>';
		$main_content .= '<BR><FORM ACTION="index.php?subtopic=characters" METHOD=post><TABLE WIDTH=100% BORDER=0 CELLSPACING=1 CELLPADDING=4><TR><TD BGCOLOR="'.$config['site']['vdarkborder'].'" CLASS=white><B>Search Character</B></TD></TR><TR><TD BGCOLOR="'.$config['site']['darkborder'].'"><TABLE BORDER=0 CELLPADDING=1><TR><TD>Name:</TD><TD><INPUT NAME="name" VALUE=""SIZE=29 MAXLENGTH=29></TD><TD><INPUT TYPE=image NAME="Submit" SRC="'.$layout_name.'/images/buttons/sbutton_submit.gif" BORDER=0 WIDTH=120 HEIGHT=18></TD></TR></TABLE></TD></TR></TABLE></FORM>';
	}
}
?>