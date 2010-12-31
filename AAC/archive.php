<?php
$news_DB = $SQL->query('SELECT * FROM '.$SQL->tableName('z_news_big').' WHERE hide_news != 1 ORDER BY date DESC');
if(empty($_REQUEST['id']))
{
	$main_content .= '<table border=0 cellspacing=1 cellpadding=4 width=100%>
	<tr bgcolor="'.$config['site']['vdarkborder'].'">
	<TD COLSPAN=3 CLASS=white><B>Archive</B></TD></TR>';
	foreach($news_DB as $news)
	{
		if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['lightborder']; } $number_of_rows++;
			$main_content .= '<tr BGCOLOR='.$bgcolor.'><td width=4%><center><img src="'.$layout_name.'/images/news/icon_'.$news['image_id'].'.gif"></center></td><td>'.date("j.n.Y", $news['date']).'</td><td><b><a href="index.php?subtopic=archive&id='.$news['date'].'">'.stripslashes($news['topic']).'</a></b></td></tr>';
	}
	$main_content .= '</table>';
	$showed=true;
}
foreach($news_DB as $news)
	if($_REQUEST['id'] == $news['date'])
	{
		$main_content .= '
		<div class=\'NewsHeadline\'>
		<div class=\'NewsHeadlineBackground\' style=\'background-image:url('.$layout_name.'/images/news/newsheadline_background.gif)\'>
		<table border=0><tr><td><img src="'.$layout_name.'/images/news/icon_'.$news['image_id'].'.gif" class=\'NewsHeadlineIcon\'  alt=\'\' />
		</td><td><font color="'.$layout_ini['news_title_color'].'">'.date("j.n.Y", $news['date']).' - <b>'.stripslashes($news['topic']).'</b></font></td></tr></table>
		</div>
		</div>
		<table style=\'clear:both\' border=0 cellpadding=0 cellspacing=0 width=\'100%\'><tr>
		<td><img src="'.$layout_name.'/images/global/general/blank.gif" width=10 height=1 border=0 alt=\'\' /></td>
		<td width="100%"><font size=2>'.stripslashes(nl2br($news['text'])).'<br></font><br></td>
		<td><img src="'.$layout_name.'/images/global/general/blank.gif" width=10 height=1 border=0 alt=\'\' /></td>
		</tr></table>';
		$main_content .= '<br><a href="index.php?subtopic=archive"><font size="2"><b>Go to Archive</b></font></a>';
		$showed=true;
	}
if(!$showed)
{
	$main_content .= 'This news doeasn\'t exist.<br>';
	$main_content .= '<br /><a href="index.php?subtopic=archive"><font size="2"><b>Go to Archive</b></font></a>';
}
?>