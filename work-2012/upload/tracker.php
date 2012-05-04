<?php
if($logged)
{
	// type (1 = question; 2 = answer)
	// status (1 = open; 2 = new message; 3 = closed;)
	$dark = $config['site']['darkborder'];
	$light = $config['site']['lightborder'];
	$typetracker = array(1 => "Bug", "Feature");
	$priority = array(1 => "Low", "Normal", "Emergency");
	$tags = array(1 => "[MAP]", "[WEBSITE]", "[CLIENT]", "[MONSTER]", "[NPC]", "[OTHER]");
	if($group_id_of_acc_logged >= $config['site']['access_admin_panel'] and $_REQUEST['control'] == "true")
	{
		if(empty($_REQUEST['id']) and empty($_REQUEST['acc']) or !is_numeric($_REQUEST['acc']) or !is_numeric($_REQUEST['id']) )
			$bug[1] = $SQL->query('SELECT * FROM z_tracker where type = 1 order by uid desc');
		if(!empty($_REQUEST['id']) and is_numeric($_REQUEST['id']) and !empty($_REQUEST['acc']) and is_numeric($_REQUEST['acc']))
			$bug[2] = $SQL->query('SELECT * FROM z_tracker where account = '.$_REQUEST['acc'].' and id = '.$_REQUEST['id'].' and type = 1')->fetch();
		if(!empty($_REQUEST['id']) and is_numeric($_REQUEST['id']) and !empty($_REQUEST['acc']) and is_numeric($_REQUEST['acc']))
		{
			if(!empty($_REQUEST['reply']))
				$reply=true;
			$account = $ots->createObject('Account');
			$account->load($_REQUEST['acc']);
			$account->isLoaded();
			$players = $account->getPlayersList();
			if(!$reply)
			{
				if($bug[2]['status'] == 2)
					$value = "<font color=gray><b>WAITING</b> <img src=images/tracker/waiting.gif></font>";
				elseif($bug[2]['status'] == 4)
					$value = "<font color=green><b>SUPPORTED</b></font> <img src=images/tracker/ok.png>";
				elseif($bug[2]['status'] == 3)
					$value = "<font color=red><b>NOT A BUG</b></font> <img src=images/tracker/closed.png>";
				elseif($bug[2]['status'] == 1)
					$value = "<font color=#4169E1><b>NEW ANSWER</b></font> <img src=images/tracker/new.png>";
				if($bug[2]['typetracker'] == 1) 
					$valueType = "<img src=images/tracker/type_bug.png> Bug";
				elseif($bug[2]['typetracker'] == 2) 
					$valueType = "<img src=images/tracker/type_feature.png> Feature";
				$main_content .= '<TABLE BORDER=0 CELLSPACING=1 CELLPADDING=4 WIDTH=100%><TR BGCOLOR='.$config['site']['vdarkborder'].'><TD COLSPAN=2 CLASS=white><B>Tracker</B></TD></TR>';                            
				$main_content .= '<TR BGCOLOR="'.$dark.'"><td width=40%><img src=images/tracker/report.png> <b>Subject:</b></td><td> '.$tags[$bug[2]['tag']].' '.$bug[2]['subject'].'  '.$value.'</td></tr>';    
				$main_content .= '<TR BGCOLOR="'.$light.'"><td><img src=images/tracker/tag.png> <b>Type:</b></td><td>'.$valueType.'</td></tr>';    
				$main_content .= '<TR BGCOLOR="'.$dark.'"><td><img src=images/tracker/pri.gif> <b>Priority:</b></td><td> <img src=images/tracker/'.$bug[2]['priority'].'.png> '.$priority[$bug[2]['priority']].'';    
				$main_content .= '<TR BGCOLOR="'.$light.'"><td><img src=images/tracker/tibia.png> <b>Posted by:</b></td><td>';    
				foreach($players as $player)
				{
					$main_content .= '<img src=images/tracker/t.png> '.$player->getName().'<br>';
				}
				$main_content .= '</td></tr>';
				$main_content .= '<TR BGCOLOR="'.$dark.'"><td colspan=2><img src=images/tracker/des.png><b>Description:</b></td></tr>';    
				$main_content .= '<TR BGCOLOR="'.$light.'"><td colspan=2>'.nl2br($bug[2]['text']).'</td></tr>';    
				$main_content .= '</TABLE>';
				$answers = $SQL->query('SELECT * FROM z_tracker where account = '.$_REQUEST['acc'].' and id = '.$_REQUEST['id'].' and type = 2 order by reply');
				$ot = $config['site']['worlds'];
				foreach($answers as $answer)
				{
					if($answer['who'] == 1)
						$who = "<img src=images/tracker/staff.gif> <font color=red><b>SUPPORT</b></font>";
					else
						$who = "<img src=images/tracker/player.gif> <font color=green><b>PLAYER</b></font>";
					$main_content .= '<br><TABLE BORDER=0 CELLSPACING=1 CELLPADDING=4 WIDTH=100%><TR BGCOLOR='.$config['site']['vdarkborder'].'><TD COLSPAN=2 CLASS=white><B>Answer #'.$answer['reply'].'</B></TD></TR>';                            
					$main_content .= '<TR BGCOLOR="'.$dark.'"><td width=70%><img src=images/tracker/tibia.png><i><b>Posted by:</b></i></td><td>'.$who.'</td></tr>';    
					$main_content .= '<TR BGCOLOR="'.$light.'"><td colspan=2><img src=images/tracker/des.png><i><b>Description:</b></i></td></tr>';    
					$main_content .= '<TR BGCOLOR="'.$dark.'"><td colspan=2>'.nl2br($answer['text']).'</td></tr>';    
					$main_content .= '</TABLE>';
				}
				if($bug[2]['status'] < 3)
					$main_content .= '<br><a href="index.php?subtopic=tracker&control=true&id='.$_REQUEST['id'].'&acc='.$_REQUEST['acc'].'&reply=true"><b>[REPLY]</b></a>';
			}
			else
			{
				if($bug[2]['status'] < 3)
				{
					$reply = $SQL->query('SELECT MAX(reply) FROM z_tracker where account = '.$_REQUEST['acc'].' and id = '.$_REQUEST['id'].' and type = 2')->fetch();
					$reply = $reply[0] + 1;
					$iswho = $SQL->query('SELECT * FROM z_tracker where account = '.$_REQUEST['acc'].' and id = '.$_REQUEST['id'].' and type = 2 order by reply desc limit 1')->fetch();
					if(isset($_POST['finish']))
					{
						if(empty($_POST['text']))
							$error[] = "<font color=black><b>Description cannot be empty.</b></font>";
						if($iswho['who'] == 1)
							$error[] = "<font color=black><b>You must wait for User answer.</b></font>";
						if(empty($_POST['status']))
							$error[] = "<font color=black><b>Status cannot be empty.</b></font>";
						if(!empty($error))
						{
							$main_content .= '<div class="SmallBox" >  <div class="MessageContainer" >    <div class="BoxFrameHorizontal" style="background-image:url('.$layout_name.'/images/content/box-frame-horizontal.gif);" /></div>    <div class="BoxFrameEdgeLeftTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);" /></div>    <div class="BoxFrameEdgeRightTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);" /></div>    <div class="ErrorMessage" >      <div class="BoxFrameVerticalLeft" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);" /></div>      <div class="BoxFrameVerticalRight" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);" /></div>      <div class="AttentionSign" style="background-image:url('.$layout_name.'/images/content/attentionsign.gif);" /></div><b>The Following Errors Have Occurred:</b><br/>';
							foreach($error as $errors)
								$main_content .= '<li>'.$errors.'';
							$main_content .= '</div>    <div class="BoxFrameHorizontal" style="background-image:url('.$layout_name.'/images/content/box-frame-horizontal.gif);" /></div>    <div class="BoxFrameEdgeRightBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);" /></div>    <div class="BoxFrameEdgeLeftBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);" /></div>  </div></div><br/>';
						}
						else
						{
							$type = 2;
							$INSERT = $SQL->query('INSERT INTO z_tracker (account,id,text,reply,type, who) VALUES ('.$SQL->quote($_REQUEST['acc']).','.$SQL->quote($_REQUEST['id']).','.$SQL->quote($_POST['text']).','.$SQL->quote($reply).','.$SQL->quote($type).','.$SQL->quote(1).')');
							$UPDATE = $SQL->query('UPDATE z_tracker SET status = '.$_POST['status'].' where account = '.$_REQUEST['acc'].' and id = '.$_REQUEST['id'].'');
							header('Location: index.php?subtopic=tracker&control=true&id='.$_REQUEST['id'].'&acc='.$_REQUEST['acc'].'');
						}
					}
					$main_content .= '<br><form method="post" action="">
						<table border=0 cellspacing=1 cellpadding=4 width=100%>
							<tr bgcolor='.$config['site']['vdarkborder'].'><td colspan=2><font class=white><b>Answer</b></font></td></tr>
							<tr bgcolor='.$dark.'><td><b>Message:</b></i></td><td><textarea name="text" rows="3" cols="25"></textarea></td></tr>
							<tr bgcolor='.$light.'><td><font color=gray><b>IN PROGRESS</b></font> <img src=images/tracker/waiting.gif></td><td><input type=radio name=status value=2></td></tr>
							<tr bgcolor='.$dark.'><td><font color=green><b>SUPPORTED <img src=images/tracker/ok.png></b></font></td><td><input type=radio name=status value=4></td></tr>
							<tr bgcolor='.$light.'><td><font color=red><b>NOT A BUG <img src=images/tracker/closed.png></b></font></td><td><input type=radio name=status value=3></td></tr>
							<tr bgcolor='.$dark.'><td colspan=2><input type="submit" name="finish" value="Submit" class="input2"/></td></tr>
						</table></form>';
				}
				else
					$main_content .= "<br><font color=black><b>You can't add answer to closed bug thread.</b></font>";
			}
			$post=true;
		}
		if(!$post)
		{
			$main_content .= '<TABLE BORDER=0 CELLSPACING=1 CELLPADDING=4 WIDTH=100%><TR BGCOLOR='.$config['site']['vdarkborder'].'><TD colspan=3 CLASS=white><B>Tracker Admin</B></TD></TR>';            
			$i=1;
			foreach($bug[1] as $report)
			{
				if($report['status'] == 2)
					$value = "<font color=gray><b>WAITING</b> <img src=images/tracker/waiting.gif></font>";
				elseif($report['status'] == 3)
					$value = "<font color=red><b>NOT A BUG</b></font> <img src=images/tracker/closed.png>";
				elseif($report['status'] == 4)
					$value = "<font color=green><b>SUPPORTED</b></font> <img src=images/tracker/ok.png>";
				elseif($report['status'] == 1)
					$value = "<font color=#4169E1><b>NEW ANSWER</b></font> <img src=images/tracker/new.png>";
				if($report['typetracker'] == 1) 
					$valueType = "<img src=images/tracker/type_bug.png> Bug";
				elseif($report['typetracker'] == 2) 
					$valueType = "<img src=images/tracker/type_feature.png> Feature";
				if(is_int($i / 2))
				{
					$bgcolor = $dark;
				}
				else
				{
					$bgcolor = $light;
				}
				$main_content .= '<TR BGCOLOR="'.$bgcolor.'"><td>'.$valueType.'</td><td width=70%><img src=images/tracker/'.$report['priority'].'.png> <a href="index.php?subtopic=tracker&control=true&id='.$report['id'].'&acc='.$report['account'].'">'.$tags[$report['tag']].' '.$report['subject'].'</a></td><td>'.$value.'</td></tr>';            
				$showed=true;
				$i++;
			}
			$main_content .= '</TABLE>';
		}
	}
	else
	{        
		$acc = $account_logged->getId();
		$account_players = $account_logged->getPlayersList();
		foreach($account_players as $player)
		{
			$allow=true;
		}
		if(!empty($_REQUEST['id']))
			$id = addslashes(htmlspecialchars(trim($_REQUEST['id'])));
		if(empty($_REQUEST['id']))
			$bug[1] = $SQL->query('SELECT * FROM z_tracker where account = '.$account_logged->getId().' and type = 1 order by id desc');
		if(!empty($_REQUEST['id']) and is_numeric($_REQUEST['id']))
			$bug[2] = $SQL->query('SELECT * FROM z_tracker where account = '.$account_logged->getId().' and id = '.$id.' and type = 1')->fetch();
		else
			$bug[2] = NULL;
		if(!empty($_REQUEST['id']) and $bug[2] != NULL)
		{
			if(!empty($_REQUEST['reply']))
				$reply=true;
			if(!$reply)
			{
				if($bug[2]['status'] == 1)
					$value = "<font color=gray><b>WAITING</b> <img src=images/tracker/waiting.gif></font>";
				elseif($bug[2]['status'] == 2)
					$value = "<font color=#4169E1><b>NEW ANSWER</b></font> <img src=images/tracker/new.png>";
				elseif($bug[2]['status'] == 3)
					$value = "<font color=red><b>NOT A BUG</b></font> <img src=images/tracker/closed.png>";
				elseif($bug[2]['status'] == 4)     
					$value = "<font color=green><b>SUPPORTED</b></font> <img src=images/tracker/ok.png>";
				if($bug[2]['typetracker'] == 1) 
					$valueType = "<img src=images/tracker/type_bug.png> Bug";
				elseif($bug[2]['typetracker'] == 2) 
					$valueType = "<img src=images/tracker/type_feature.png> Feature";
				$main_content .= '<TABLE BORDER=0 CELLSPACING=1 CELLPADDING=4 WIDTH=100%><TR BGCOLOR='.$config['site']['vdarkborder'].'><TD COLSPAN=2 CLASS=white><B>Tracker</B></TD></TR>';                            
				$main_content .= '<TR BGCOLOR="'.$dark.'"><td width=40%><img src=images/tracker/report.png><b> Subject:</b></td><td> '.$tags[$bug[2]['tag']].' '.$bug[2]['subject'].' '.$value.'</td></tr>';    
				$main_content .= '<TR BGCOLOR="'.$light.'"><td><img src=images/tracker/tag.png> <b>Type:</b></td><td>'.$valueType.'</td>';    
				$main_content .= '<TR BGCOLOR="'.$dark.'"><td><img src=images/tracker/pri.gif> <b>Priority:</b></td><td> <img src=images/tracker/'.$bug[2]['priority'].'.png> '.$priority[$bug[2]['priority']].'';  
				$main_content .= '<TR BGCOLOR="'.$light.'"><td><img src=images/tracker/tibia.png> <b>Posted by:</b></td><td><img src=images/tracker/t.png> You </td></tr>';
				$main_content .= '<TR BGCOLOR="'.$dark.'"><td colspan=2><img src=images/tracker/des.png><b>Description:</b></td></tr>';    
				$main_content .= '<TR BGCOLOR="'.$light.'"><td colspan=2>'.nl2br($bug[2]['text']).'</td></tr>';    
				$main_content .= '</TABLE>';
				$answers = $SQL->query('SELECT * FROM z_tracker where account = '.$account_logged->getId().' and id = '.$id.' and type = 2 order by reply');
				foreach($answers as $answer)
				{
					if($answer['who'] == 1)
						$who = "<img src=images/tracker/staff.gif> <font color=red><b>SUPPORT</b></font>";
					else
						$who = "<img src=images/tracker/player.gif> <font color=green><b>YOU</b></font>";
					$main_content .= '<br><TABLE BORDER=0 CELLSPACING=1 CELLPADDING=4 WIDTH=100%><TR BGCOLOR='.$config['site']['vdarkborder'].'><TD COLSPAN=2 CLASS=white><B>Answer #'.$answer['reply'].'</B></TD></TR>';                            
					$main_content .= '<TR BGCOLOR="'.$dark.'"><td width=70%><img src=images/tracker/tibia.png><i><b> Posted by:</b></i></td><td>'.$who.'</td></tr>';    
					$main_content .= '<TR BGCOLOR="'.$light.'"><td colspan=2><img src=images/tracker/des.png><i><b>Description:</b></i></td></tr>';    
					$main_content .= '<TR BGCOLOR="'.$dark.'"><td colspan=2>'.nl2br($answer['text']).'</td></tr>';    
					$main_content .= '</TABLE>';
				}
				if($bug[2]['status'] < 3)
					$main_content .= '<br><a href="index.php?subtopic=tracker&id='.$id.'&reply=true"><b>[REPLY]</b></a>';
			}
			else
			{
				if($bug[2]['status'] != 3)
				{
					$reply = $SQL->query('SELECT MAX(reply) FROM z_tracker where account = '.$acc.' and id = '.$id.' and type = 2')->fetch();
					$reply = $reply[0] + 1;
					$iswho = $SQL->query('SELECT * FROM z_tracker where account = '.$acc.' and id = '.$id.' and type = 2 order by reply desc limit 1')->fetch();
					if(isset($_POST['finish']))
					{
						if(empty($_POST['text']))
							$error[] = "<font color=black><b>Description cannot be empty.</b></font>";
						if($iswho['who'] == 0)
							$error[] = "<font color=black><b>You must wait for Administrator answer.</b></font>";
						if(!$allow)
							$error[] = "<font color=black><b>You haven't any characters on account.</b></font>";
						if(!empty($error))
						{
							$main_content .= '<div class="SmallBox" >  <div class="MessageContainer" >    <div class="BoxFrameHorizontal" style="background-image:url('.$layout_name.'/images/content/box-frame-horizontal.gif);" /></div>    <div class="BoxFrameEdgeLeftTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);" /></div>    <div class="BoxFrameEdgeRightTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);" /></div>    <div class="ErrorMessage" >      <div class="BoxFrameVerticalLeft" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);" /></div>      <div class="BoxFrameVerticalRight" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);" /></div>      <div class="AttentionSign" style="background-image:url('.$layout_name.'/images/content/attentionsign.gif);" /></div><b>The Following Errors Have Occurred:</b><br/>';
							foreach($error as $errors)
								$main_content .= '<li>'.$errors.'';
							$main_content .= '</div>    <div class="BoxFrameHorizontal" style="background-image:url('.$layout_name.'/images/content/box-frame-horizontal.gif);" /></div>    <div class="BoxFrameEdgeRightBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);" /></div>    <div class="BoxFrameEdgeLeftBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);" /></div>  </div></div><br/>';
						}
						else
						{
							$type = 2;
							$INSERT = $SQL->query('INSERT INTO z_tracker (account, id, text, reply,type) VALUES ('.$SQL->quote($acc).','.$SQL->quote($id).','.$SQL->quote($_POST['text']).','.$SQL->quote($reply).','.$SQL->quote($type).')');
							$UPDATE = $SQL->query('UPDATE z_tracker SET status = 1 where account = '.$acc.' and id = '.$id.'');
							header('Location: index.php?subtopic=tracker&id='.$id.'');
						}
					}
					$main_content .= '<br><form method="post" action="">
						<table border=0 cellspacing=1 cellpadding=4 width=100%>
							<tr bgcolor='.$config['site']['vdarkborder'].'><td colspan=2><font class=white><b>Answer</b></font></td></tr>
							<tr bgcolor='.$dark.'><td><i>Description</i></td><td><textarea name="text" rows="15" cols="35"></textarea></td></tr>
							<tr bgcolor='.$light.'><td colspan=2><input type="submit" name="finish" value="Submit" class="input2"/></td></tr>
						</table></form>';
				}
				else
				{
					$main_content .= "<br><font color=black><b>You can't add answer to closed bug thread.</b></font>";
				}
			}
			$post=true;
		}
		elseif(!empty($_REQUEST['id']) and $bug[2] == NULL)
		{
			$main_content .= '<TABLE BORDER=0 CELLSPACING=1 CELLPADDING=4 WIDTH=100%><TR BGCOLOR='.$config['site']['vdarkborder'].'><TD CLASS=white><B>Tracker</B></TD></TR>';                            
			$main_content .= '<TR BGCOLOR="'.$dark.'"><td><i>Bug doesn\'t exist.</i></td></tr>';    
			$main_content .= '</TABLE>';
			$post=true;
		}
		if(!$post)
		{
			if($_REQUEST['add'] != TRUE)
			{
				$main_content .= '<TABLE BORDER=0 CELLSPACING=1 CELLPADDING=4 WIDTH=100%><TR BGCOLOR='.$config['site']['vdarkborder'].'><TD colspan=3 CLASS=white><B>Tracker</B></TD></TR>';            
				foreach($bug[1] as $report)
				{
					if($report['status'] == 1)
						$value = "<font color=gray><b>WAITING</b> <img src=images/tracker/waiting.gif></font>";
					elseif($report['status'] == 2)
						$value = "<font color=#4169E1><b>NEW ANSWER</b></font> <img src=images/tracker/new.png>";
					elseif($report['status'] == 3)
						$value = "<font color=red><b>NOT A BUG</b></font> <img src=images/tracker/closed.png>";
					elseif($report['status'] == 4)                    
						$value = "<font color=green><b>SUPPORTED</b></font> <img src=images/tracker/ok.png>";
					if($report['typetracker'] == 1) 
						$valueType = "<img src=images/tracker/type_bug.png> Bug";
					elseif($report['typetracker'] == 2) 
						$valueType = "<img src=images/tracker/type_feature.png> Feature";
					if(is_int($report['id'] / 2))
					{
						$bgcolor = $dark;
					}
					else
					{
						$bgcolor = $light;
					}
					$main_content .= '<TR BGCOLOR="'.$bgcolor.'"><td>'.$valueType.'</td><td width=70%><img src=images/tracker/'.$report['priority'].'.png> <a href="index.php?subtopic=tracker&id='.$report['id'].'">'.$tags[$report['tag']].' '.$report['subject'].'</a></td><td>'.$value.'</td></tr>';            
					$showed=true;
				}	
				if(!$showed)
				{
					$main_content .= '<TR BGCOLOR="'.$dark.'"><td><i>You don\'t have reported any bugs.</i></td></tr>';    
				}
				$main_content .= '</TABLE>';
				$main_content .= '<br><a href="index.php?subtopic=tracker&add=true"><b>[ADD REPORT]</b></a>';
			}
			elseif($_REQUEST['add'] == TRUE)
			{
				$thread = $SQL->query('SELECT * FROM z_tracker where account = '.$acc.' and type = 1 order by id desc')->fetch();
				$id_next = $SQL->query('SELECT MAX(id) FROM z_tracker where account = '.$acc.' and type = 1')->fetch();
				$id_next = $id_next[0] + 1;
				if(empty($thread))
					$thread['status'] = 3;
				if(isset($_POST['submit']))
				{
					if($thread['status'] < 3)
						$error[] = "<font color=red>Can be only 1 open bug thread.</font>";
					if(empty($_POST['subject']))
						$error[] = "<font color=red>Subject cannot be empty.</font>";
					if(empty($_POST['text']))
						$error[] = "<font color=red>Description cannot be empty.</font>";
					if(!$allow)
						$error[] = "<font color=red>You haven't any characters on account.</font>";
					if(empty($_POST['tags']))
						$error[] = "<font color=red>Tag cannot be empty.</font>";
					if(empty($_POST['typetracker']))
						$error[] = "<font color=red>Type cannot be empty.</font>";
					if(!empty($error))
					{
						$main_content .= '<div class="SmallBox" >  <div class="MessageContainer" >    <div class="BoxFrameHorizontal" style="background-image:url('.$layout_name.'/images/content/box-frame-horizontal.gif);" /></div>    <div class="BoxFrameEdgeLeftTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);" /></div>    <div class="BoxFrameEdgeRightTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);" /></div>    <div class="ErrorMessage" >      <div class="BoxFrameVerticalLeft" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);" /></div>      <div class="BoxFrameVerticalRight" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);" /></div>      <div class="AttentionSign" style="background-image:url('.$layout_name.'/images/content/attentionsign.gif);" /></div><b>The Following Errors Have Occurred:</b><br/>';
						foreach($error as $errors)
							$main_content .= '<li>'.$errors.'';
						$main_content .= '</div>    <div class="BoxFrameHorizontal" style="background-image:url('.$layout_name.'/images/content/box-frame-horizontal.gif);" /></div>    <div class="BoxFrameEdgeRightBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);" /></div>    <div class="BoxFrameEdgeLeftBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);" /></div>  </div></div><br/>';
					}
					else
					{
						$type = 1;
						$status = 1;
						$INSERT = $SQL->query('INSERT INTO z_tracker (account, id, text, type, subject, status, typetracker, tag, priority) VALUES ('.$SQL->quote($acc).','.$SQL->quote($id_next).','.$SQL->quote($_POST['text']).','.$SQL->quote($type).','.$SQL->quote($_POST['subject']).','.$SQL->quote($status).','.$SQL->quote($_POST['typetracker']).','.$SQL->quote($_POST['tags']).','.$SQL->quote($_POST['priority']).')');
						header('Location: index.php?subtopic=tracker&id='.$id_next.'');
					}
				}
				
				$main_content .= '<br><form method="post" action="">
					<table border=0 cellspacing=1 cellpadding=4 width=100%>
						<tr bgcolor='.$config['site']['vdarkborder'].'>
							<td colspan=2><font class=white><b>Tracker</b></font></td>
						</tr>
						<tr  bgcolor='.$dark.'>
							<td><img src=images/tracker/des.png><b>Type:</b></td><td><select name="typetracker"><option value="">SELECT</option>';
							for($i = 1; $i <= count($typetracker); $i++)
							{
								$main_content .= '<option value="' . $i . '">' . $typetracker[$i] . '</option>';
							}
							$main_content .= '</select></td>
						</tr>
						<tr bgcolor='.$light.'>
							<td><img src=images/tracker/report.png> <b>Subject:</b></td><td><input type=text name="subject"/></td>
						</tr>
						<tr bgcolor='.$dark.'>
							<td><img src=images/tracker/des.png><b>Description:</b></td><td><textarea name="text" rows="4" cols="15"></textarea></td>
						</tr>
						<tr bgcolor='.$light.'>
							<td><img src=images/tracker/tag.png> <b>TAG:</b></td><td><select name="tags"><option value="">SELECT</option>';
							for($i = 1; $i <= count($tags); $i++)
							{
								$main_content .= '<option value="' . $i . '">' . $tags[$i] . '</option>';
							}
							$main_content .= '</select></td>
						</tr>
						<tr  bgcolor='.$dark.'>
							<td><img src=images/tracker/pri.gif> <b>Priority:</b></td><td><select name="priority"><option value="">SELECT</option>';
							for($i = 1; $i <= count($priority); $i++)
							{
								$main_content .= '<option value="' . $i . '">' . $priority[$i] . '</option>';
							}
							$main_content .= '</select></td>
						</tr>
						<tr bgcolor='.$light.'>
							<td colspan=2><center><input type="submit" name="submit" value="Submit" class="input2"/><center></td>
						</tr>
					</table></form>';
			}
		}
	}
	if($group_id_of_acc_logged >= $config['site']['access_admin_panel'] and empty($_REQUEST['control']))
	{
		$main_content .= '<br><br><a href="index.php?subtopic=tracker&control=true">[ADMIN PANEL]</a>';
	}
}
else
{
	$main_content .= 'Please enter your account name and your password.<br/><a href="?subtopic=createaccount" >Create an account</a> if you do not have one yet.<br/><br/><form action="?subtopic=tracker" method="post" ><div class="TableContainer" >  <table class="Table1" cellpadding="0" cellspacing="0" >    <div class="CaptionContainer" >      <div class="CaptionInnerContainer" >        <span class="CaptionEdgeLeftTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);" /></span>        <span class="CaptionEdgeRightTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);" /></span>        <span class="CaptionBorderTop" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif);" ></span>        <span class="CaptionVerticalLeft" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);" /></span>        <div class="Text" >Account Login</div>        <span class="CaptionVerticalRight" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);" /></span>        <span class="CaptionBorderBottom" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif);" ></span>        <span class="CaptionEdgeLeftBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);" /></span>        <span class="CaptionEdgeRightBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);" /></span>      </div>    </div>    <tr>      <td>        <div class="InnerTableContainer" >          <table style="width:100%;" ><tr><td class="LabelV" ><span >Account Name:</span></td><td style="width:100%;" ><input type="password" name="account_login" SIZE="10" maxlength="10" ></td></tr><tr><td class="LabelV" ><span >Password:</span></td><td><input type="password" name="password_login" size="30" maxlength="29" ></td></tr>          </table>        </div>  </table></div></td></tr><br/><table width="100%" ><tr align="center" ><td><table border="0" cellspacing="0" cellpadding="0" ><tr><td style="border:0px;" ><div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif);" ></div><input class="ButtonText" type="image" name="Submit" alt="Submit" src="'.$layout_name.'/images/buttons/_sbutton_submit.gif" ></div></div></td><tr></form></table></td><td><table border="0" cellspacing="0" cellpadding="0" ><form action="?subtopic=lostaccount" method="post" ><tr><td style="border:0px;" ><div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif);" ></div><input class="ButtonText" type="image" name="Account lost?" alt="Account lost?" src="'.$layout_name.'/images/buttons/_sbutton_accountlost.gif" ></div></div></td></tr></form></table></td></tr></table>';
}
?> 