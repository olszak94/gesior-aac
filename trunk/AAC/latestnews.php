<?PHP
//######################## SHOW TICKERS AND NEWS #######################
$time = time();
if($action == "") 
{
	//show tickers if any in database or not blocked (tickers limit = 0)
	$tickers = $SQL->query('SELECT * FROM '.$SQL->tableName('z_news_tickers').' WHERE hide_ticker != 1 ORDER BY date DESC LIMIT '.$config['site']['news_ticks_limit'].';');
	$number_of_tickers = 0;
	if(is_object($tickers)) 
	{
		foreach($tickers as $ticker) 
		{
			if(is_int($number_of_tickers / 2))
				$color = "Odd";
			else
				$color = "Even";
			$tickers_to_add .= '<div id="TickerEntry-'.$number_of_tickers.'" class="Row" onclick=\'TickerAction("TickerEntry-'.$number_of_tickers.'")\'>
				<div class="'.$color.'">
					<div class="NewsTickerIcon" style="background-image: url('.$layout_name.'/images/news/icon_'.$ticker['image_id'].'.gif);"></div>
					<div id="TickerEntry-'.$number_of_tickers.'-Button" class="NewsTickerExtend" style="background-image: url('.$layout_name.'/images/general/plus.gif);"></div>
					<div class="NewsTickerText">
						<span class="NewsTickerDate">'.date("j M Y", $ticker['date']).' -</span>
						<div id="TickerEntry-'.$number_of_tickers.'-ShortText" class="NewsTickerShortText">';
			//if admin show button to delete (hide) ticker
			if($group_id_of_acc_logged >= $config['site']['access_tickers']) 
				$tickers_to_add .= '<a href="index.php?subtopic=latestnews&action=deleteticker&id='.$ticker['date'].'"><img src="http://i63.photobucket.com/albums/h122/Mister_Dude/delete.png" border="0"></a>';
			$tickers_to_add .= short_text($ticker['text'], 60).'</div>
				<div id="TickerEntry-'.$number_of_tickers.'-FullText" class="NewsTickerFullText">';
			//if admin show button to delete (hide) ticker
			if($group_id_of_acc_logged >= $config['site']['access_tickers']) 
				$tickers_to_add .= '<a href="index.php?subtopic=latestnews&action=deleteticker&id='.$ticker['date'].'"><img src="http://i63.photobucket.com/albums/h122/Mister_Dude/delete.png" border="0"></a>';
			$tickers_to_add .= $ticker['text'].'</div>
				</div>
			  </div>
			</div>';
			$number_of_tickers++;
		}
	}
	if(!empty($tickers_to_add)) 
	{
		//show table with tickers
		$news_content .= '<div id="newsticker" class="Box">
			<div class="Corner-tl" style="background-image: url('.$layout_name.'/images/content/corner-tl.gif);"></div>
			<div class="Corner-tr" style="background-image: url('.$layout_name.'/images/content/corner-tr.gif);"></div>
			<div class="Border_1" style="background-image: url('.$layout_name.'/images/content/border-1.gif);"></div>
			<div class="BorderTitleText" style="background-image: url('.$layout_name.'/images/content/title-background-green.gif);"></div>
			<img class="Title" src="'.$layout_name.'/images/header/headline-newsticker.gif" alt="Contentbox headline">
			<div class="Border_2">
				<div class="Border_3">
					<div class="BoxContent" style="background-image: url('.$layout_name.'/images/content/scroll.gif);">';
					if($group_id_of_acc_logged >= $config['site']['access_tickers'])
					$tickers_to_add .= '<script type="text/javascript">
					var showednewticker_state = "0";
					function showNewTickerForm()
					{
						if(showednewticker_state == "0") 
						{
							document.getElementById("newtickerform").innerHTML = \'<form action="index.php?subtopic=latestnews&action=newticker" method="post" ><table border="0"><tr><td bgcolor="D4C0A1" align="center"><b>Select icon:</b></td><td><table border="0" bgcolor="F1E0C6"><tr><td><img src="images/news/icon_0.gif" width="20"></td><td><img src="images/news/icon_1.gif" width="20"></td><td><img src="images/news/icon_2.gif" width="20"></td><td><img src="images/news/icon_3.gif" width="20"></td><td><img src="images/news/icon_4.gif" width="20"></td></tr><tr><td><input type="radio" name="icon_id" value="0" checked="checked"></td><td><input type="radio" name="icon_id" value="1"></td><td><input type="radio" name="icon_id" value="2"></td><td><input type="radio" name="icon_id" value="3"></td><td><input type="radio" name="icon_id" value="4"></td></tr></table></td></tr><tr><td align="center" bgcolor="D4C0A1"><b>New<br>ticker<br>text:</b></td><td bgcolor="F1E0C6"><textarea name="new_ticker" rows="3" cols="45"></textarea></td></tr><tr><td><div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif);" ></div><input class="ButtonText" type="image" name="Submit" alt="Submit" src="'.$layout_name.'/images/buttons/_sbutton_submit.gif" ></div></div></form><div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif);" ></div><img class="ButtonText" id="AddTicker" src="'.$layout_name.'/images/buttons/_sbutton_cancel.gif" onClick="showNewTickerForm()" alt="AddTicker" /></div></div></td></tr></table>\';
							document.getElementById("jajo").innerHTML = \'\';
							showednewticker_state = "1";
						}
						else 
						{
							document.getElementById("newtickerform").innerHTML = \'\';
							document.getElementById("jajo").innerHTML = \'<div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif);" ></div><img class="ButtonText" id="AddTicker" src="'.$layout_name.'/images/buttons/addticker.gif" onClick="showNewTickerForm()" alt="AddTicker" /></div></div>\';
							showednewticker_state = "0";
						}
					}
		</script><div id="newtickerform"></div><div id="jajo"><div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif);" ></div><img class="ButtonText" id="AddTicker" src="'.$layout_name.'/images/buttons/addticker.gif" onClick="showNewTickerForm()" alt="AddTicker" /></div></div></div><hr/>';
		//add tickers list
		$news_content .= $tickers_to_add;
		//koniec
		$news_content .= '</div>
				</div>
			</div>
			<div class="Border_1" style="background-image: url('.$layout_name.'/images/content/border-1.gif);"></div>
			<div class="CornerWrapper-b"><div class="Corner-bl" style="background-image: url('.$layout_name.'/images/content/corner-bl.gif);"></div></div>
			<div class="CornerWrapper-b"><div class="Corner-br" style="background-image: url('.$layout_name.'/images/content/corner-br.gif);"></div></div>
		</div>';
	}
	//show "BIG" news here
	if($config['site']['langSystem'])
		$main_content .= '<table style="border: 1px solid #CFB181; border-spacing: 1px" width=100%>
				<tr style="vertical-align: middle">
					<td><b>Set news language:</b> 
						<a href="index.php?subtopic=latestnews&lang=en"><img src="http://images.boardhost.com/flags/us.png"></a>
						<a href="index.php?subtopic=latestnews&lang='.$config['site']['chooseLang'].'"><img src="http://images.boardhost.com/flags/'.$config['site']['chooseLang'].'.png"></a> 
					</td>
				</tr>
			</table><br>';
	$langConfig = $config['site']['chooseLang'];
	if($lang == 'en')
	{
		$newsLanguageSystem = 'topic_df, text_df';
		$newsTopicInfo = 'topic_df';
		$newsTextInfo = 'text_df';
	}
	elseif($lang == $langConfig)
	{
		$newsLanguageSystem = 'topic_ot, text_ot';
		$newsTopicInfo = 'topic_ot';
		$newsTextInfo = 'text_ot';
	}
	else
	{
		$newsLanguageSystem = 'topic_df, text_df';
		$newsTopicInfo = 'topic_df';
		$newsTextInfo = 'text_df';
	}
	$news_DB = $SQL->query('SELECT image_id, date, author, '.$newsLanguageSystem.' FROM z_news_big WHERE hide_news != 1 ORDER BY date DESC LIMIT '.$config['site']['news_big_limit'].';');
	//dla kazdego duzego newsa
	if(!empty($news_DB)) 
	{
		if($group_id_of_acc_logged >= $config['site']['access_news'])
			$main_content .= '<script type="text/javascript">
				var showednewnews_state = "0";
				function showNewNewsForm()
				{
					if(showednewnews_state == "0") 
					{
						document.getElementById("newnewsform").innerHTML = \'<form action="index.php?subtopic=latestnews&action=newnews" method="post" ><table border="0"><tr><td bgcolor="D4C0A1" align="center"><b>Select icon:</b></td><td><table border="0" bgcolor="F1E0C6"><tr><td><img src="images/news/icon_0.gif" width="20"></td><td><img src="images/news/icon_1.gif" width="20"></td><td><img src="images/news/icon_2.gif" width="20"></td><td><img src="images/news/icon_3.gif" width="20"></td><td><img src="images/news/icon_4.gif" width="20"></td></tr><tr><td><input type="radio" name="icon_id" value="0" checked="checked"></td><td><input type="radio" name="icon_id" value="1"></td><td><input type="radio" name="icon_id" value="2"></td><td><input type="radio" name="icon_id" value="3"></td><td><input type="radio" name="icon_id" value="4"></td></tr></table></td></tr><tr><td align="center" bgcolor="F1E0C6"><b><img src="http://images.boardhost.com/flags/us.png"> Topic defutal language:</b></td><td><input type="text" name="news_topic_df" maxlenght="50" style="width: 300px" ></td></tr><tr><td align="center" bgcolor="F1E0C6"><b><img src="http://images.boardhost.com/flags/'.$config['site']['chooseLang'].'.png"> Topic onther language:</b></td><td><input type="text" name="news_topic_ot" maxlenght="50" style="width: 300px" ></td></tr><tr><td align="center" bgcolor="D4C0A1"><b><img src="http://images.boardhost.com/flags/us.png"> News text:</b></td><td bgcolor="F1E0C6"><textarea name="news_text_df" rows="6" cols="40"></textarea></td></tr><tr><td align="center" bgcolor="D4C0A1"><b><img src="http://images.boardhost.com/flags/'.$config['site']['chooseLang'].'.png"> News text:</b></td><td bgcolor="F1E0C6"><textarea name="news_text_ot" rows="6" cols="40"></textarea></td></tr><tr><td align="center" bgcolor="F1E0C6"><b>Your nick:</b></td><td><input type="text" name="news_name" maxlenght="40" style="width: 200px" ></td></tr><tr><td><div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif);" ></div><input class="ButtonText" type="image" name="Submit" alt="Submit" src="'.$layout_name.'/images/buttons/_sbutton_submit.gif" ></div></div></form><div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif);" ></div><img class="ButtonText" id="CancelAddNews" src="'.$layout_name.'/images/buttons/_sbutton_cancel.gif" onClick="showNewNewsForm()" alt="CancelAddNews" /></div></div></td></tr></table>\';
						document.getElementById("chicken").innerHTML = \'\';
						showednewnews_state = "1";
					}
					else 
					{
						document.getElementById("newnewsform").innerHTML = \'\';
						document.getElementById("chicken").innerHTML = \'<div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif);" ></div><img class="ButtonText" id="AddNews" src="'.$layout_name.'/images/buttons/addnews.gif" onClick="showNewNewsForm()" alt="AddNews" /></div></div>\';
						showednewnews_state = "0";
					}
				}
			</script><div id="newnewsform"></div><div id="chicken"><div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif);" ></div><img class="ButtonText" id="AddNews" src="'.$layout_name.'/images/buttons/addnews.gif" onClick="showNewNewsForm()" alt="AddNews" /></div></div></div><hr/>';
		foreach($news_DB as $news) 
		{
			$newsTopic = stripslashes($news[''.$newsTopicInfo.'']);
			$newsText = stripslashes($news[''.$newsTextInfo.'']);
			$main_content .= '
			<div class=\'NewsHeadline\'>
				<div class=\'NewsHeadlineBackground\' style=\'background-image:url('.$layout_name.'/images/news/newsheadline_background.gif)\'>
					<table border=0>
						<tr>
							<td><img src="'.$layout_name.'/images/news/icon_'.$news['image_id'].'.gif" class=\'NewsHeadlineIcon\'  alt=\'\' /></td>
							<td><font color="'.$layout_ini['news_title_color'].'">'.date("j M Y", $news['date']).' - <b>'.$newsTopic.'</b></font></td>
						</tr>
					</table>
				</div>
			</div>
			<table style=\'clear:both\' border=0 cellpadding=0 cellspacing=0 width=\'100%\'><tr>
			<td><img src="'.$layout_name.'/images/global/general/blank.gif" width=10 height=1 border=0 alt=\'\' /></td>
			<td width="100%">'.$newsText.'<br><h6><i>Posted by </i><font color="green">'.stripslashes($news['author']).'</font>';
			if($group_id_of_acc_logged >= $config['site']['access_news']) 
			{
				$main_content .= '&nbsp;<a href="index.php?subtopic=latestnews&action=editnews&edit_date='.$news['date'].'&edit_author='.urlencode(stripslashes($news['author'])).'"><img src="'.$layout_name.'/images/news/edit_news.png" border="0"></a>&nbsp;<a href="index.php?subtopic=latestnews&action=deletenews&id='.$news['date'].'"><img src="'.$layout_name.'/images/news/delete_news.png" border="0"></a>';
			}
			$main_content .= '</h6></td>
			<td><img src="'.$layout_name.'/images/global/general/blank.gif" width=10 height=1 border=0 alt=\'\' /></td>
			</tr></table>';
		}
	}
}
//##################### ADD NEW TICKER #####################
if($action == "newticker") 
{
	if($group_id_of_acc_logged >= $config['site']['access_tickers']) 
	{
		$ticker_text = stripslashes(trim($_POST['new_ticker']));
		$ticker_icon = (int) $_POST['icon_id'];
		if(empty($ticker_text)) 
			$main_content .= 'You can\'t add empty ticker.';
		else
		{
			if(empty($ticker_icon)) 
				$ticker_icon = 0;
			$SQL->query('INSERT INTO '.$SQL->tableName('z_news_tickers').' (date, author, image_id, text, hide_ticker) VALUES ('.$SQL->quote($time).', '.$account_logged->getId().', '.$ticker_icon.', '.$SQL->quote($ticker_text).', 0)');
			$main_content .= '<center><h2><font color="red">Added new ticker:</font></h2></center><hr/><div id="newsticker" class="Box"><div id="TickerEntry-1" class="Row" onclick=\'TickerAction("TickerEntry-1")\'>
				<div class="Odd">
					<div class="NewsTickerIcon" style="background-image: url('.$layout_name.'/images/news/icon_'.$ticker['image_id'].'.gif);"></div>
					<div id="TickerEntry-1-Button" class="NewsTickerExtend" style="background-image: url('.$layout_name.'/images/general/plus.gif);"></div>
					<div class="NewsTickerText">
						<span class="NewsTickerDate">'.date("j M Y", $time).' -</span>
						<div id="TickerEntry-1-ShortText" class="NewsTickerShortText">';
					$main_content .= '<a href="index.php?subtopic=latestnews&action=deleteticker&id='.$time.'"><img src="http://i63.photobucket.com/albums/h122/Mister_Dude/delete.png" border="0"></a>';
					$main_content .= short_text($ticker_text, 60).'</div>
						<div id="TickerEntry-1-FullText" class="NewsTickerFullText">';
					$main_content .= '<a href="index.php?subtopic=latestnews&action=deleteticker&id='.$time.'"><img src="http://i63.photobucket.com/albums/h122/Mister_Dude/delete.png" border="0"></a>';
					$main_content .= $ticker_text.'</div>
					</div>
				</div>
			</div></div><hr/>';
		}
	}
	else
	{
		$main_content .= 'You don\'t have admin rights. You can\'t add new ticker.';
		$main_content .= '<form action="index.php?subtopic=latestnews" METHOD=post><div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif);" ></div><input class="ButtonText" type="image" name="Back" alt="Back" src="'.$layout_name.'/images/buttons/_sbutton_back.gif" ></div></div></form>';
	}
}
//#################### DELETE (HIDE only!) TICKER ############################
if($action == "deleteticker") 
{
	if($group_id_of_acc_logged >= $config['site']['access_tickers']) 
	{
		header("Location: index.php");
		$date = (int) $_REQUEST['id'];
		$SQL->query('UPDATE '.$SQL->tableName('z_news_tickers').' SET hide_ticker = 1 WHERE '.$SQL->fieldName('date').' = '.$date.';');
		$main_content .= '<center>News tickets with <b>date '.date("j F Y, g:i a", $date).'</b> has been deleted.<form action="index.php?subtopic=latestnews" METHOD=post><div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif);" ></div><input class="ButtonText" type="image" name="Back" alt="Back" src="'.$layout_name.'/images/buttons/_sbutton_back.gif" ></div></div></form></center>';
	}
	else
		$main_content .= '<center>You don\'t have admin rights. You can\'t delete tickers.<form action="index.php?subtopic=latestnews" METHOD=post><div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif);" ></div><input class="ButtonText" type="image" name="Back" alt="Back" src="'.$layout_name.'/images/buttons/_sbutton_back.gif" ></div></div></form></center>';
}
//################## ADD NEW NEWS ##################
if($action == "newnews") 
{
	if($group_id_of_acc_logged >= $config['site']['access_news']) 
	{
		$news_icon = (int) $_POST['icon_id'];
		$news_text_df = stripslashes(trim($_POST['news_text_df']));
		$news_topic_df = stripslashes(trim($_POST['news_topic_df']));
		$news_text_ot = stripslashes(trim($_POST['news_text_ot']));
		$news_topic_ot = stripslashes(trim($_POST['news_topic_ot']));
		$news_name = stripslashes(trim($_POST['news_name']));
		if(empty($news_icon)) 
			$news_icon = 0;
		if(empty($news_topic_df)) 
			$an_errors[] .= 'You can\'t add news without topic.';
		if(empty($news_text_df)) 
			$an_errors[] .= 'You can\'t add empty news.';
		if(empty($news_topic_ot)) 
			$an_errors[] .= 'You can\'t add news without topic.';
		if(empty($news_text_ot)) 
			$an_errors[] .= 'You can\'t add empty news.';
		if(empty($news_name)) 
			$an_errors[] .= 'You can\'t add news without author.';
		if(empty($an_errors)) 
		{
			$SQL->query('INSERT INTO z_news_big (hide_news, date, author, author_id, image_id, topic_df, text_df, topic_ot, text_ot) VALUES (0, '.$time.', '.$SQL->quote($news_name).', '.$account_logged->getId().', '.$news_icon.', '.$SQL->quote($news_topic_df).', '.$SQL->quote($news_text_df).', '.$SQL->quote($news_topic_ot).', '.$SQL->quote($news_text_ot).')');
			//show added data
			$main_content .= '<center><h2><font color="red">Added to news:</font></h2></center><hr/><div class=\'NewsHeadline\'>
				<div class=\'NewsHeadlineBackground\' style=\'background-image:url('.$layout_name.'/images/news/newsheadline_background.gif)\'>
					<table border=0><tr><td><img src="'.$layout_name.'/images/news/icon_'.$news_icon.'.gif" class=\'NewsHeadlineIcon\'  alt=\'\' />
						</td><td><font color="'.$layout_ini['news_title_color'].'">'.date("j M Y", $time).' - <b>'.$news_topic_df.' or '.$news_topic_ot.'</b></font></td></tr></table>
				</div>
			</div>
			<table style=\'clear:both\' border=0 cellpadding=0 cellspacing=0 width=\'100%\'>
				<tr>
					<td><img src="'.$layout_name.'/images/global/general/blank.gif" width=10 height=1 border=0 alt=\'\' /></td>
					<td width="100%"><img src="http://images.boardhost.com/flags/us.png"> '.$news_text_df.'<br><br><img src="http://images.boardhost.com/flags/'.$config['site']['chooseLang'].'.png"> '.$news_text_ot.'<br><br><h6><i>Posted by </i><font color="green">'.$news_name.'</font>&nbsp;
					<a href="index.php?subtopic=latestnews&action=editnews&edit_date='.$time.'&edit_author='.urlencode($news_name).'"><img src="'.$layout_name.'/images/news/edit_news.png" border="0"></a>&nbsp;<a href="index.php?subtopic=latestnews&action=deletenews&id='.$time.'"><img src="'.$layout_name.'/images/news/delete_news.png" border="0"></a></h6></td>
					<td><img src="'.$layout_name.'/images/global/general/blank.gif" width=10 height=1 border=0 alt=\'\' /></td>
				</tr>
			</table><br/><hr/>';
			//back button
			$main_content .= '<form action="index.php?subtopic=latestnews" METHOD=post><div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif);" ></div><input class="ButtonText" type="image" name="Back" alt="Back" src="'.$layout_name.'/images/buttons/_sbutton_back.gif" ></div></div></form>';
		}
		else
		{
			//show errors
			$main_content .= '<div class="SmallBox" >  <div class="MessageContainer" >    <div class="BoxFrameHorizontal" style="background-image:url('.$layout_name.'/images/content/box-frame-horizontal.gif);" /></div>    <div class="BoxFrameEdgeLeftTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);" /></div>    <div class="BoxFrameEdgeRightTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);" /></div>    <div class="ErrorMessage" >      <div class="BoxFrameVerticalLeft" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);" /></div>      <div class="BoxFrameVerticalRight" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);" /></div>      <div class="AttentionSign" style="background-image:url('.$layout_name.'/images/content/attentionsign.gif);" /></div><b>The Following Errors Have Occurred:</b><br/>';
			foreach($an_errors as $an_error) 
				$main_content .= '<li>'.$an_error;
			$main_content .= '</div>    <div class="BoxFrameHorizontal" style="background-image:url('.$layout_name.'/images/content/box-frame-horizontal.gif);" /></div>    <div class="BoxFrameEdgeRightBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);" /></div>    <div class="BoxFrameEdgeLeftBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);" /></div>  </div></div><br/>';
			//okno edycji newsa z wpisanymi danymi przeslanymi wczesniej
			$main_content .= '<form action="index.php?subtopic=latestnews&action=newnews" method="post" >
				<table border="0">
					<tr>
						<td bgcolor="'.$config['site']['darkborder'].'" align="center"><b>Select icon:</b></td>
						<td><table border="0" bgcolor="'.$config['site']['lightborder'].'"><tr><td><img src="'.$layout_name.'/images/news/icon_0.gif" width="20"></td><td><img src="'.$layout_name.'/images/news/icon_1.gif" width="20"></td><td><img src="'.$layout_name.'/images/news/icon_2.gif" width="20"></td><td><img src="'.$layout_name.'/images/news/icon_3.gif" width="20"></td><td><img src="'.$layout_name.'/images/news/icon_4.gif" width="20"></td></tr><tr><td><input type="radio" name="icon_id" value="0" checked="checked"></td><td><input type="radio" name="icon_id" value="1"></td><td><input type="radio" name="icon_id" value="2"></td><td><input type="radio" name="icon_id" value="3"></td><td><input type="radio" name="icon_id" value="4"></td></tr></table></td>
					</tr>
					<tr>
						<td align="center" bgcolor="'.$config['site']['lightborder'].'"><b><img src="http://images.boardhost.com/flags/us.png"> Topic defutal language:</b></td>
						<td><input type="text" name="news_topic_df" maxlenght="50" style="width: 300px" value="'.$news_topic_df.'" /></td>
					</tr>
					<tr>
						<td align="center" bgcolor="'.$config['site']['lightborder'].'"><b><img src="http://images.boardhost.com/flags/'.$config['site']['chooseLang'].'.png"> Topic onther language:</b></td>
						<td><input type="text" name="news_topic_ot" maxlenght="50" style="width: 300px" value="'.$news_topic_ot.'" /></td>
					</tr>
					<tr>
						<td align="center" bgcolor="'.$config['site']['darkborder'].'"><b><img src="http://images.boardhost.com/flags/us.png"> News text:</b></td>
						<td bgcolor="'.$config['site']['lightborder'].'"><textarea name="news_text_df" rows="6" cols="60">'.$news_text_df.'</textarea></td>
					</tr>
					<tr>
						<td align="center" bgcolor="'.$config['site']['darkborder'].'"><b><img src="http://images.boardhost.com/flags/'.$config['site']['chooseLang'].'.png"> News text:</b></td>
						<td bgcolor="'.$config['site']['lightborder'].'"><textarea name="news_text_ot" rows="6" cols="60">'.$news_text_ot.'</textarea></td>
					</tr>
					<tr>
						<td align="center" bgcolor="'.$config['site']['lightborder'].'"><b>Your nick:</b></td>
						<td><input type="text" name="news_name" maxlenght="40" style="width: 200px" value="'.$news_name.'" /></td>
					</tr>
					<tr>
						<td><div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif);" ></div><input class="ButtonText" type="image" name="Submit" alt="Submit" src="'.$layout_name.'/images/buttons/_sbutton_submit.gif" ></div></div></form></td>
						<td><div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif);" ></div><img class="ButtonText" id="CancelAddNews" src="'.$layout_name.'/images/buttons/_sbutton_cancel.gif" onClick="window.location =\'index.php?subtopic=latestnews\'" alt="CancelAddNews" /></div></div></td>
					</tr>
				</table>';
		}
	}
	else
	{
		$main_content .= 'You don\'t have site-admin rights. You can\'t add news.';
		//back button
		$main_content .= '<br><form action="index.php?subtopic=latestnews" METHOD=post><div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif);" ></div><input class="ButtonText" type="image" name="Back" alt="Back" src="'.$layout_name.'/images/buttons/_sbutton_back.gif" ></div></div></form>';
	}
}
//################## EDIT NEWS ##################
if($action == "editnews") 
{
	if(!empty($_REQUEST['edit_date'])) 
	{
		if(!empty($_REQUEST['edit_author'])) 
		{
			if($group_id_of_acc_logged >= $config['site']['access_news']) 
			{
				$news_date = (int) $_REQUEST['edit_date'];
				$news_old_name = stripslashes(trim($_REQUEST['edit_author']));
				if($_POST['saveedit'] == 1) 
				{
					$news_icon = (int) $_POST['icon_id'];
					$news_text_df = stripslashes(trim($_POST['news_text_df']));
					$news_topic_df = stripslashes(trim($_POST['news_topic_df']));
					$news_text_ot = stripslashes(trim($_POST['news_text_ot']));
					$news_topic_ot = stripslashes(trim($_POST['news_topic_ot']));
					$news_name = stripslashes(trim($_POST['news_name']));
					if(empty($news_icon)) 
						$news_icon = 0;
					if(empty($news_topic_df)) 
						$an_errors[] .= 'You can\'t save news without topic.';
					if(empty($news_text_df)) 
						$an_errors[] .= 'You can\'t save empty news.';
					if(empty($news_topic_ot)) 
						$an_errors[] .= 'You can\'t save news without topic.';
					if(empty($news_text_ot)) 
						$an_errors[] .= 'You can\'t save empty news.';
					if(empty($news_name))
						$an_errors[] .= 'You can\'t save news without author.';
					if(empty($an_errors)) 
					{
						$SQL->query('UPDATE z_news_big SET hide_news = "0", author = "'.$news_name.'", author_id = '.$account_logged->getId().', image_id = '.$news_icon.', topic_df = "'.$news_topic_df.'", text_df = "'.$news_text_df.'", topic_ot = "'.$news_topic_ot.'", text_ot = "'.$news_text_ot.'" WHERE author = "'.$news_old_name.'" AND date = '.$news_date.';');
						//show added data
						$main_content .= '<center><h2><font color="red">After edit:</font></h2></center><hr/><div class=NewsHeadline>
							<div class=NewsHeadlineBackground style=background-image:url('.$layout_name.'/images/news/newsheadline_background.gif)>
								<table border=0>
									<tr>
										<td><img src="'.$layout_name.'/images/news/icon_'.$news_icon.'.gif" class="NewsHeadlineIcon" alt="" /></td>
										<td><font color="'.$layout_ini['news_title_color'].'">'.date("j M Y", $time).' - <b>'.$news_topic_df.' or '.$news_topic_ot.'</b></font></td>
									</tr>
								</table>
							</div>
						</div>
						<table style=clear:both border=0 cellpadding=0 cellspacing=0 width=\'100%\'>
							<tr>
								<td width="100%"><img src="http://images.boardhost.com/flags/us.png"> '.$news_text_df.'<br><br><img src="http://images.boardhost.com/flags/'.$config['site']['chooseLang'].'.png"> '.$news_text_ot.'<br><br><h6><i>Posted by </i><font color="green">'.$news_name.'</font>&nbsp;
								<a href="index.php?subtopic=latestnews&action=editnews&edit_date='.htmlspecialchars($news_date).'&edit_author='.htmlspecialchars($news_name).'"><img src="'.$layout_name.'/images/news/edit_news.png" border="0"></a>&nbsp;
								<a href="index.php?subtopic=latestnews&action=deletenews&id='.$news_date.'"><img src="'.$layout_name.'/images/news/delete_news.png" border="0"></a></h6></td>
							</tr>
						</table><br/><hr/>';
						//back button
						$main_content .= '<form action="index.php?subtopic=latestnews" METHOD=post><div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif);" ></div><input class="ButtonText" type="image" name="Back" alt="Back" src="'.$layout_name.'/images/buttons/_sbutton_back.gif" ></div></div></form>';
					}
					else
					{
						//show errors
						$main_content .= '<div class="SmallBox" >  <div class="MessageContainer" >    <div class="BoxFrameHorizontal" style="background-image:url('.$layout_name.'/images/content/box-frame-horizontal.gif);" /></div>    <div class="BoxFrameEdgeLeftTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);" /></div>    <div class="BoxFrameEdgeRightTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);" /></div>    <div class="ErrorMessage" >      <div class="BoxFrameVerticalLeft" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);" /></div>      <div class="BoxFrameVerticalRight" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);" /></div>      <div class="AttentionSign" style="background-image:url('.$layout_name.'/images/content/attentionsign.gif);" /></div><b>The Following Errors Have Occurred:</b><br/>';
						foreach($an_errors as $an_error) 
							$main_content .= '<li>'.$an_error;
						$main_content .= '</div>    <div class="BoxFrameHorizontal" style="background-image:url('.$layout_name.'/images/content/box-frame-horizontal.gif);" /></div>    <div class="BoxFrameEdgeRightBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);" /></div>    <div class="BoxFrameEdgeLeftBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);" /></div>  </div></div><br/>';
						//okno edycji newsa z wpisanymi danymi przeslanymi wczesniej
						//<img src="http://images.boardhost.com/flags/us.png">
						//<img src="http://images.boardhost.com/flags/'.$config['site']['chooseLang'].'.png">
						$main_content .= '<form action="index.php?subtopic=latestnews&action=editnews" method="post" >
							<input type="hidden" name="saveedit" value="1"><input type="hidden" name="edit_date" value="'.$_REQUEST['edit_date'].'">
							<input type="hidden" name="edit_author" value="'.$_REQUEST['edit_author'].'">
								<table border="0">
									<tr>
										<td bgcolor="'.$config['site']['darkborder'].'" align="center"><b>Select icon:</b></td>
										<td><table border="0" bgcolor="'.$config['site']['lightborder'].'"><tr><td><img src="'.$layout_name.'/images/news/icon_0.gif" width="20"></td><td><img src="'.$layout_name.'/images/news/icon_1.gif" width="20"></td><td><img src="'.$layout_name.'/images/news/icon_2.gif" width="20"></td><td><img src="'.$layout_name.'/images/news/icon_3.gif" width="20"></td><td><img src="'.$layout_name.'/images/news/icon_4.gif" width="20"></td></tr><tr><td><input type="radio" name="icon_id" value="0" checked="checked"></td><td><input type="radio" name="icon_id" value="1"></td><td><input type="radio" name="icon_id" value="2"></td><td><input type="radio" name="icon_id" value="3"></td><td><input type="radio" name="icon_id" value="4"></td></tr></table></td>
									</tr>
									<tr>
										<td align="center" bgcolor="'.$config['site']['lightborder'].'"><b><img src="http://images.boardhost.com/flags/us.png"> Topic defutal language:</b></td>
										<td><input type="text" name="news_topic_df" maxlenght="50" style="width: 300px" value="'.$news_topic_df.'" /></td>
									</tr>
									<tr>
										<td align="center" bgcolor="'.$config['site']['lightborder'].'"><b><img src="http://images.boardhost.com/flags/'.$config['site']['chooseLang'].'.png"> Topic onther language:</b></td>
										<td><input type="text" name="news_topic_ot" maxlenght="50" style="width: 300px" value="'.$news_topic_ot.'" /></td>
									</tr>
									<tr>
										<td align="center" bgcolor="'.$config['site']['darkborder'].'"><b>News text:</b></td>
										<td bgcolor="'.$config['site']['lightborder'].'"><textarea name="news_text_df" rows="6" cols="60">'.$news_text_df.'</textarea></td>
									</tr>
									<tr>
										<td align="center" bgcolor="'.$config['site']['darkborder'].'"><b>News text:</b></td>
										<td bgcolor="'.$config['site']['lightborder'].'"><textarea name="news_text_ot" rows="6" cols="60">'.$news_text_ot.'</textarea></td>
									</tr>
									<tr>
										<td align="center" bgcolor="'.$config['site']['lightborder'].'"><b>Your nick:</b></td>
										<td><input type="text" name="news_name" maxlenght="40" style="width: 200px" value="'.$news_nick.'" /></td>
									</tr>
									<tr>
										<td><div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif);" ></div><input class="ButtonText" type="image" name="Submit" alt="Submit" src="'.$layout_name.'/images/buttons/_sbutton_submit.gif" ></div></div></form></td>
										<td><div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif);" ></div><img class="ButtonText" id="CancelAddNews" src="'.$layout_name.'/images/buttons/_sbutton_cancel.gif" onClick="window.location =\'index.php?subtopic=latestnews\'" alt="CancelAddNews" /></div></div></td>
									</tr>
								</table>';
					}
				}
				else
				{
					//wyswietlic zaladowany z bazy news do edycji wedlug ID
					$edited = $SQL->query('SELECT * FROM z_news_big WHERE '.$SQL->fieldName('date').' = "'.$news_date.'" AND '.$SQL->fieldName('author').' = '.$SQL->quote($news_old_name).';')->fetch();
					$main_content .= '<form action="index.php?subtopic=latestnews&action=editnews" method="post" >
						<input type="hidden" name="edit_date" value="'.$_REQUEST['edit_date'].'">
						<input type="hidden" name="edit_author" value="'.htmlspecialchars(stripslashes($_REQUEST['edit_author'])).'">
						<input type="hidden" name="saveedit" value="1">
						<table border="0">
							<tr>
								<td bgcolor="'.$config['site']['darkborder'].'" align="center"><b>Select icon:</b></td>
								<td>
									<table border="0" bgcolor="'.$config['site']['lightborder'].'">
										<tr>
											<td><img src="'.$layout_name.'/images/news/icon_0.gif" width="20"></td>
											<td><img src="'.$layout_name.'/images/news/icon_1.gif" width="20"></td>
											<td><img src="'.$layout_name.'/images/news/icon_2.gif" width="20"></td>
											<td><img src="'.$layout_name.'/images/news/icon_3.gif" width="20"></td>
											<td><img src="'.$layout_name.'/images/news/icon_4.gif" width="20"></td>
										</tr>
										<tr>
											<td><input type="radio" name="icon_id" value="0" checked="checked"></td>
											<td><input type="radio" name="icon_id" value="1"></td>
											<td><input type="radio" name="icon_id" value="2"></td>
											<td><input type="radio" name="icon_id" value="3"></td>
											<td><input type="radio" name="icon_id" value="4"></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td align="center" bgcolor="'.$config['site']['lightborder'].'"><b><img src="http://images.boardhost.com/flags/us.png"> Topic defutal language:</b></td>
								<td><input type="text" name="news_topic_df" maxlenght="50" style="width: 300px" value="'.htmlspecialchars(stripslashes($edited['topic_df'])).'" /></td>
							</tr>
							<tr>
								<td align="center" bgcolor="'.$config['site']['lightborder'].'"><b><img src="http://images.boardhost.com/flags/'.$config['site']['chooseLang'].'.png"> Topic onther language:</b></td>
								<td><input type="text" name="news_topic_ot" maxlenght="50" style="width: 300px" value="'.htmlspecialchars(stripslashes($edited['topic_ot'])).'" /></td>
							</tr>
							<tr>
								<td align="center" bgcolor="'.$config['site']['darkborder'].'"><b><img src="http://images.boardhost.com/flags/us.png"> News text:</b></td>
								<td bgcolor="'.$config['site']['lightborder'].'"><textarea name="news_text_df" rows="6" cols="60">'.stripslashes($edited['text_df']).'</textarea></td>
							</tr>
							<tr>
								<td align="center" bgcolor="'.$config['site']['darkborder'].'"><b><img src="http://images.boardhost.com/flags/'.$config['site']['chooseLang'].'.png"> News text:</b></td>
								<td bgcolor="'.$config['site']['lightborder'].'"><textarea name="news_text_ot" rows="6" cols="60">'.stripslashes($edited['text_ot']).'</textarea></td>
							</tr>
							<tr>
								<td align="center" bgcolor="'.$config['site']['lightborder'].'"><b>Your nick:</b></td>
								<td><input type="text" name="news_name" maxlenght="40" style="width: 200px" value="'.htmlspecialchars(stripslashes($edited['author'])).'"></td>
							</tr>
							<tr>
								<td><div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif);" ></div><input class="ButtonText" type="image" name="Submit" alt="Submit" src="'.$layout_name.'/images/buttons/_sbutton_submit.gif" ></div></div></form></td>
								<td><div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif);" ></div><img class="ButtonText" id="CancelAddNews" src="'.$layout_name.'/images/buttons/_sbutton_cancel.gif" onClick="window.location = \'index.php?subtopic=latestnews\'" alt="CancelEditNews" /></div></div></td>
							</tr>
						</table>';
				}
			}
			else
			{
				$main_content .= 'You don\'t have site-admin rights. You can\'t edit news.';
				//back button
				$main_content .= '<br><form action="index.php?subtopic=latestnews" METHOD=post><div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif);" ></div><input class="ButtonText" type="image" name="Back" alt="Back" src="'.$layout_name.'/images/buttons/_sbutton_back.gif" ></div></div></form>';
			}
		}
	}
}
//################## DELETE (hide only!) NEWS ##################
if($action == "deletenews") 
{
	if($group_id_of_acc_logged >= $config['site']['access_news']) 
	{
		header("Location: index.php");
		$date = (int) $_REQUEST['id'];
		$SQL->query('UPDATE '.$SQL->tableName('z_news_big').' SET hide_news = "1" WHERE date = '.$date);
		$main_content .= '<center>News with <b>date '.date("j F Y, g:i a", $date).'</b> has been deleted.<form action="index.php?subtopic=latestnews" METHOD=post><div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif);" ></div><input class="ButtonText" type="image" name="Back" alt="Back" src="'.$layout_name.'/images/buttons/_sbutton_back.gif" ></div></div></form></center>';
	}
	else
		$main_content .= '<center>You don\'t have admin rights. You can\'t delete news.<form action="index.php?subtopic=latestnews" METHOD=post><div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif);" ></div><input class="ButtonText" type="image" name="Back" alt="Back" src="'.$layout_name.'/images/buttons/_sbutton_back.gif" ></div></div></form></center>';
}
?>