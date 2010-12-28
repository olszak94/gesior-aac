<?PHP
if($group_id_of_acc_logged >= $config['site']['access_admin_panel']) {
$main_content .= '<script type="text/javascript">
var showednewticker_state = "0";
function showNewTickerForm()
{
if(showednewticker_state == "0") {
document.getElementById("newtickerform").innerHTML = \'<form action="index.php?subtopic=latestnews&action=newticker" method="post" ><table border="0"><tr><td bgcolor="D4C0A1" align="center"><b>Select icon:</b></td><td><table border="0" bgcolor="F1E0C6"><tr><td><img src="images/news/icon_0.gif" width="20"></td><td><img src="images/news/icon_1.gif" width="20"></td><td><img src="images/news/icon_2.gif" width="20"></td><td><img src="images/news/icon_3.gif" width="20"></td><td><img src="images/news/icon_4.gif" width="20"></td></tr><tr><td><input type="radio" name="icon_id" value="0" checked="checked"></td><td><input type="radio" name="icon_id" value="1"></td><td><input type="radio" name="icon_id" value="2"></td><td><input type="radio" name="icon_id" value="3"></td><td><input type="radio" name="icon_id" value="4"></td></tr></table></td></tr><tr><td align="center" bgcolor="D4C0A1"><b>New<br>ticker<br>text:</b></td><td bgcolor="F1E0C6"><textarea name="new_ticker" rows="3" cols="45"></textarea></td></tr><tr><td><div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif);" ></div><input class="ButtonText" type="image" name="Submit" alt="Submit" src="'.$layout_name.'/images/buttons/_sbutton_submit.gif" ></div></div></form><div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif);" ></div><img class="ButtonText" id="AddTicker" src="'.$layout_name.'/images/buttons/_sbutton_cancel.gif" onClick="showNewTickerForm()" alt="AddTicker" /></div></div></td></tr></table>\';
document.getElementById("jajo").innerHTML = \'\';
showednewticker_state = "1";
}
else {
document.getElementById("newtickerform").innerHTML = \'\';
document.getElementById("jajo").innerHTML = \'<div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif);" ></div><img class="ButtonText" id="AddTicker" src="'.$layout_name.'/images/buttons/addticker.gif" onClick="showNewTickerForm()" alt="AddTicker" /></div></div>\';
showednewticker_state = "0";
}
}
var showednewnews_state = "0";
function showNewNewsForm()
{
if(showednewnews_state == "0") {
document.getElementById("newnewsform").innerHTML = \'<form action="index.php?subtopic=latestnews&action=newnews" method="post" ><table border="0"><tr><td bgcolor="D4C0A1" align="center"><b>Select icon:</b></td><td><table border="0" bgcolor="F1E0C6"><tr><td><img src="images/news/icon_0.gif" width="20"></td><td><img src="images/news/icon_1.gif" width="20"></td><td><img src="images/news/icon_2.gif" width="20"></td><td><img src="images/news/icon_3.gif" width="20"></td><td><img src="images/news/icon_4.gif" width="20"></td></tr><tr><td><input type="radio" name="icon_id" value="0" checked="checked"></td><td><input type="radio" name="icon_id" value="1"></td><td><input type="radio" name="icon_id" value="2"></td><td><input type="radio" name="icon_id" value="3"></td><td><input type="radio" name="icon_id" value="4"></td></tr></table></td></tr><tr><td align="center" bgcolor="F1E0C6"><b>Topic:</b></td><td><input type="text" name="news_topic" maxlenght="50" style="width: 300px" ></td></tr><tr><td align="center" bgcolor="D4C0A1"><b>News<br>text:</b></td><td bgcolor="F1E0C6"><textarea name="news_text" rows="6" cols="60"></textarea></td></tr><tr><td align="center" bgcolor="F1E0C6"><b>Your nick:</b></td><td><input type="text" name="news_name" maxlenght="40" style="width: 200px" ></td></tr><tr><td><div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif);" ></div><input class="ButtonText" type="image" name="Submit" alt="Submit" src="'.$layout_name.'/images/buttons/_sbutton_submit.gif" ></div></div></form><div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif);" ></div><img class="ButtonText" id="CancelAddNews" src="'.$layout_name.'/images/buttons/_sbutton_cancel.gif" onClick="showNewNewsForm()" alt="CancelAddNews" /></div></div></td></tr></table>\';
document.getElementById("chicken").innerHTML = \'\';
showednewnews_state = "1";
}
else {
document.getElementById("newnewsform").innerHTML = \'\';
document.getElementById("chicken").innerHTML = \'<div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif);" ></div><img class="ButtonText" id="AddNews" src="'.$layout_name.'/images/buttons/addnews.gif" onClick="showNewNewsForm()" alt="AddNews" /></div></div>\';
showednewnews_state = "0";
}
}</script>';
if($action == "") {
//wyswietla wszystko mozliwe opcje dla admina takie jak "news", "reload configs", "edit configs","admin players/accounts", "set access rights"
$main_content .= '<center><h2>News system</h2></center>Here you can add new ticker and new message, edit access rights and set limit of showed <b>Tickers</b> and <b>News</b>.<br/><table style=\'clear:both\' border=0 cellpadding=0 cellspacing=0 width=\'100%\'>
<tr bgcolor='.$config['site']['darkborder'].'><td width="150"><font color="red"><b>Option</b></font></td><td><font color="red"><b>Description</b></font></td></tr>
<tr bgcolor='.$config['site']['lightborder'].'><td><div id="newtickerform"></div><div id="jajo"><div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif);" ></div><img class="ButtonText" id="AddTicker" src="'.$layout_name.'/images/buttons/_sbutton_submit.gif" onClick="showNewTickerForm()" alt="AddTicker" /></div></div></div></td><td><b>Press "Submit" to add new ticker.</b></td></tr>
<tr bgcolor='.$config['site']['darkborder'].'><td><div id="newnewsform"></div><div id="chicken"><div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif);" ></div><img class="ButtonText" id="AddNews" src="'.$layout_name.'/images/buttons/_sbutton_submit.gif" onClick="showNewNewsForm()" alt="AddNews" /></div></div></div></td><td><b>Press "Submit" to add new message (news).</b></td></tr>
<tr bgcolor='.$config['site']['lightborder'].'><td width="150"><b><a href="index.php?subtopic=latestnews">Edit/Delete</a></b></td><td><b>Here you can edit and delete news.</b></td></tr>
<tr bgcolor='.$config['site']['darkborder'].'><td width="150"><b><a href="index.php?subtopic=adminpanel&action=editnews&todo=access">Set access rights and limits.</a></b></td><td><b>Here you can set access ID needed to add/edit/delete tickers and news also you can set number of tickers and news showed on page.</b></td></tr>
</table>';
$main_content .= '<center><h2>Edit configurations</h2></center>Here you can choose what configuration you want to edit.<br/><table style=\'clear:both\' border=0 cellpadding=0 cellspacing=0 width=\'100%\'>
<tr bgcolor='.$config['site']['darkborder'].'><td width="150"><font color="red"><b>Option</b></font></td><td><font color="red"><b>Description</b></font></td></tr>
<tr bgcolor='.$config['site']['lightborder'].'><td width="150"><b><a href="index.php?subtopic=adminpanel&action=editaccountmanager">Account Manager</a></b></td><td><b>Edit account manager options.</b></td></tr>
<tr bgcolor='.$config['site']['darkborder'].'><td width="150"><b><a href="index.php?subtopic=adminpanel&action=editcreateaccount">Create Account</a></b></td><td><b>Edit create account options.</b></td></tr>
<tr bgcolor='.$config['site']['lightborder'].'><td width="150"><b><a href="index.php?subtopic=adminpanel&action=editguilds">Guilds</a></b></td><td><b>Edit guild requirements and limits.</b></td></tr>
<tr bgcolor='.$config['site']['darkborder'].'><td width="150"><b><a href="index.php?subtopic=adminpanel&action=editmonsters">Monsters</a></b></td><td><b>Hide or set visible monsters on list.</b></td></tr>
<tr bgcolor='.$config['site']['lightborder'].'><td width="150"><b><a href="index.php?subtopic=adminpanel&action=editnews">News</a></b></td><td><b>Edit news configuration and add, edit, delete news and tickers.</b></td></tr>
<tr bgcolor='.$config['site']['darkborder'].'><td width="150"><b><a href="index.php?subtopic=adminpanel&action=editspells">Spells</a></b></td><td><b>Hide or set visible spells on list.</b></td></tr>
<tr bgcolor='.$config['site']['lightborder'].'><td width="150"><b><a href="index.php?subtopic=adminpanel&action=editmainconfig">SITE CONFIG</a></b></td><td><b>Edit configuration of site options.</b></td></tr>
<tr bgcolor='.$config['site']['darkborder'].'><td width="150"><b><a href="index.php?subtopic=adminpanel&action=edit_towns">Edit Towns list</a></b></td><td><b>Edit list of towns on your OTS.</b></td></tr>
</table>';
$main_content .= '<center><h2>Load configurations</h2></center>Here you can choose what configuration you want to reload. It load configuration from OTS files.<br/><table style=\'clear:both\' border=0 cellpadding=0 cellspacing=0 width=\'100%\'>
<tr bgcolor='.$config['site']['darkborder'].'><td width="150"><font color="red"><b>Option</b></font></td><td><font color="red"><b>Description</b></font></td></tr>
<tr bgcolor='.$config['site']['lightborder'].'><td width="150"><b><a href="index.php?subtopic=adminpanel&action=install_monsters">Reload Monsters</a></b></td><td><b>Load information about monsters from directory "your_server_path/data/monsters/". Delete old mosters configuration!</b></td></tr>
<tr bgcolor='.$config['site']['darkborder'].'><td width="150"><b><a href="index.php?subtopic=adminpanel&action=install_spells">Reload Spells</a></b></td><td><b>Load information about spells from file "your_server_path/data/spells/spells.xml". Delete old spells configuration!</b></td></tr>
<tr bgcolor='.$config['site']['lightborder'].'><td width="150"><b><a href="index.php?subtopic=adminpanel&action=install_vocations">Load Vocations</a></b></td><td><b>Load information about vocations from file "'.$config['site']['vocationXML_file_subdir'].'".</b></td></tr>
</table>';
}

//EDIT CONFIGS
if($action == "editconfigs") {
$main_content .= '<center><h2>Edit configurations</h2></center>Here you can choose what configuration you want to edit.<br/><table style=\'clear:both\' border=0 cellpadding=0 cellspacing=0 width=\'100%\'>
<tr bgcolor='.$config['site']['darkborder'].'><td width="150"><font color="red"><b>Option</b></font></td><td><font color="red"><b>Description</b></font></td></tr>
<tr bgcolor='.$config['site']['lightborder'].'><td width="150"><b><a href="index.php?subtopic=adminpanel&action=editaccountmanager">Account Manager</a></b></td><td><b>Edit account manager options.</b></td></tr>
<tr bgcolor='.$config['site']['darkborder'].'><td width="150"><b><a href="index.php?subtopic=adminpanel&action=editcreateaccount">Create Account</a></b></td><td><b>Edit create account options.</b></td></tr>
<tr bgcolor='.$config['site']['lightborder'].'><td width="150"><b><a href="index.php?subtopic=adminpanel&action=editguilds">Guilds</a></b></td><td><b>Edit guild requirements and limits.</b></td></tr>
<tr bgcolor='.$config['site']['darkborder'].'><td width="150"><b><a href="index.php?subtopic=adminpanel&action=editmonsters">Monsters</a></b></td><td><b>Hide or set visible monsters on list.</b></td></tr>
<tr bgcolor='.$config['site']['lightborder'].'><td width="150"><b><a href="index.php?subtopic=adminpanel&action=editnews">News</a></b></td><td><b>Edit news configuration and add, edit, delete news and tickers.</b></td></tr>
<tr bgcolor='.$config['site']['darkborder'].'><td width="150"><b><a href="index.php?subtopic=adminpanel&action=editspells">Spells</a></b></td><td><b>Hide or set visible spells on list.</b></td></tr>
<tr bgcolor='.$config['site']['lightborder'].'><td width="150"><b><a href="index.php?subtopic=adminpanel&action=editmainconfig">SITE CONFIG</a></b></td><td><b>Edit configuration of site options.</b></td></tr>
<tr bgcolor='.$config['site']['darkborder'].'><td width="150"><b><a href="index.php?subtopic=adminpanel&action=edit_towns">Edit Towns list</a></b></td><td><b>Edit list of towns on your OTS.</b></td></tr>
</table>';
$main_content .= '<br/><center><form action="index.php?subtopic=adminpanel" METHOD=post><div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif);" ></div><input class="ButtonText" type="image" name="Back" alt="Back" src="'.$layout_name.'/images/buttons/_sbutton_back.gif" ></div></div></form></center>';
}

//RELOAD CONFIGS
if($action == "reloadconfigs") {
$main_content .= '<center><h2>Load configurations</h2></center>Here you can choose what configuration you want to reload. It load configuration from OTS files.<br/><table style=\'clear:both\' border=0 cellpadding=0 cellspacing=0 width=\'100%\'>
<tr bgcolor='.$config['site']['darkborder'].'><td width="150"><font color="red"><b>Option</b></font></td><td><font color="red"><b>Description</b></font></td></tr>
<tr bgcolor='.$config['site']['lightborder'].'><td width="150"><b><a href="index.php?subtopic=adminpanel&action=install_monsters">Reload Monsters</a></b></td><td><b>Load information about monsters from directory "your_server_path/data/monsters/". Delete old mosters configuration!</b></td></tr>
<tr bgcolor='.$config['site']['darkborder'].'><td width="150"><b><a href="index.php?subtopic=adminpanel&action=install_spells">Reload Spells</a></b></td><td><b>Load information about spells from file "your_server_path/data/spells/spells.xml". Delete old spells configuration!</b></td></tr>
<tr bgcolor='.$config['site']['lightborder'].'><td width="150"><b><a href="index.php?subtopic=adminpanel&action=install_vocations">Load Vocations</a></b></td><td><b>Load information about vocations from file "'.$config['site']['vocationXML_file_subdir'].'".</b></td></tr>
</table>';
$main_content .= '<br/><center><form action="index.php?subtopic=adminpanel" METHOD=post><div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif);" ></div><input class="ButtonText" type="image" name="Back" alt="Back" src="'.$layout_name.'/images/buttons/_sbutton_back.gif" ></div></div></form></center>';
}

//EDIT NEWS
if($action == "editnews") {
if(empty($_REQUEST['todo'])) {
$main_content .= '<center><h2>News system</h2></center>Here you can add new ticker and new message, edit access rights and set limit of showed <b>Tickers</b> and <b>News</b>.<br/><table style=\'clear:both\' border=0 cellpadding=0 cellspacing=0 width=\'100%\'>
<tr bgcolor='.$config['site']['darkborder'].'><td width="150"><font color="red"><b>Option</b></font></td><td><font color="red"><b>Description</b></font></td></tr>
<tr bgcolor='.$config['site']['lightborder'].'><td><div id="newtickerform"></div><div id="jajo"><div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif);" ></div><img class="ButtonText" id="AddTicker" src="'.$layout_name.'/images/buttons/_sbutton_submit.gif" onClick="showNewTickerForm()" alt="AddTicker" /></div></div></div></td><td><b>Press "Submit" to add new ticker.</b></td></tr>
<tr bgcolor='.$config['site']['darkborder'].'><td><div id="newnewsform"></div><div id="chicken"><div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif);" ></div><img class="ButtonText" id="AddNews" src="'.$layout_name.'/images/buttons/_sbutton_submit.gif" onClick="showNewNewsForm()" alt="AddNews" /></div></div></div></td><td><b>Press "Submit" to add new message (news).</b></td></tr>
<tr bgcolor='.$config['site']['lightborder'].'><td width="150"><b><a href="index.php?subtopic=latestnews">Edit/Delete</a></b></td><td><b>Here you can edit and delete news.</b></td></tr>
<tr bgcolor='.$config['site']['darkborder'].'><td width="150"><b><a href="index.php?subtopic=adminpanel&action=editnews&todo=access">Set access rights and limits.</a></b></td><td><b>Here you can set access ID needed to add/edit/delete tickers and news also you can set number of tickers and news showed on page.</b></td></tr>
</table>';
$main_content .= '<br/><center><form action="index.php?subtopic=adminpanel" METHOD=post><div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif);" ></div><input class="ButtonText" type="image" name="Back" alt="Back" src="'.$layout_name.'/images/buttons/_sbutton_back.gif" ></div></div></form></center>';
}
if($_REQUEST['todo'] == 'access_save') {
//save access config and show results
if(empty($_REQUEST['access_tickers'])) { $_REQUEST['access_tickers'] = "1"; }
$config['site']['access_tickers'] = (int) $_REQUEST['access_tickers'];
if(empty($_REQUEST['access_news'])) { $_REQUEST['access_news'] = "1"; }
$config['site']['access_news'] = (int) $_REQUEST['access_news'];
if(empty($_REQUEST['news_ticks_limit'])) { $_REQUEST['news_ticks_limit'] = "0"; }
$config['site']['news_ticks_limit'] = (int) $_REQUEST['news_ticks_limit'];
if(empty($_REQUEST['news_big_limit'])) { $_REQUEST['news_big_limit'] = "0"; }
$config['site']['news_big_limit'] = (int) $_REQUEST['news_big_limit'];
saveconfig_ini($config['site']);
$config['site'] = parse_ini_file('config/config.ini');
$main_content .= '<b>Access rights needed and limits of "News" and "Tickers" showed on page \'Lastes News\' saved in "config.ini".</b><br>
<table style=\'clear:both\' border=0 cellpadding=0 cellspacing=0 width=\'100%\'>
<tr bgcolor='.$config['site']['darkborder'].'><td width="140"><font color="red"><b><center>Value</center></b></font></td><td><font color="red"><b>Description</b></font></td></tr>
<tr bgcolor='.$config['site']['lightborder'].'><td><center>'.$config['site']['access_tickers'].'</center></td><td><b>Access ID needed to add/delete tickers.</b></td></tr>
<tr bgcolor='.$config['site']['darkborder'].'><td><center>'.$config['site']['access_news'].'</center></td><td><b>Access ID needed to add/edit/delete news.</b></td></tr>
<tr bgcolor='.$config['site']['lightborder'].'><td><center>'.$config['site']['news_ticks_limit'].'</center></td><td><b>Number of showed "Tickers" on page \'Latest News\'. Empty or 0 disable Tickers!</b></td></tr>
<tr bgcolor='.$config['site']['darkborder'].'><td><center>'.$config['site']['news_big_limit'].'</center></td><td><b>Number of showed "News" on page \'Latest News\'.</b></td></tr>
<form action="index.php?subtopic=adminpanel&action=editnews&todo=access" METHOD=post>
<tr bgcolor='.$config['site']['lightborder'].'><td><div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif);" ></div><input class="ButtonText" type="image" name="Submit" alt="Submit" src="'.$layout_name.'/images/buttons/_sbutton_edit.gif" ></div></div></td><td><b></b></td></tr>
</form></table>';
$main_content .= '<br/><center><form action="index.php?subtopic=adminpanel&action=editnews" METHOD=post><div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif);" ></div><input class="ButtonText" type="image" name="Back" alt="Back" src="'.$layout_name.'/images/buttons/_sbutton_back.gif" ></div></div></form></center>';
}
if($_REQUEST['todo'] == 'access') {
$main_content .= 'Here you can set access rights needed to add/edit/delete <b>news</b> and <b>tickers</b>. You can set number of <b>news</b> and <b>tickers</b> showed on page <b>\'latest news\'</b>.<br>
<form action="index.php?subtopic=adminpanel&action=editnews&todo=access_save" METHOD=post>
<table style=\'clear:both\' border=0 cellpadding=0 cellspacing=0 width=\'100%\'>
<tr bgcolor='.$config['site']['darkborder'].'><td width="155"><font color="red"><b>Value</b></font></td><td><font color="red"><b>Description</b></font></td></tr>
<tr bgcolor='.$config['site']['lightborder'].'><td><input type="text" name="access_tickers" value="'.$config['site']['access_tickers'].'"></td><td><b>Access ID needed to add/delete tickers.</b></td></tr>
<tr bgcolor='.$config['site']['darkborder'].'><td><input type="text" name="access_news" value="'.$config['site']['access_news'].'"></td><td><b>Access ID needed to add/edit/delete news.</b></td></tr>
<tr bgcolor='.$config['site']['lightborder'].'><td><input type="text" name="news_ticks_limit" value="'.$config['site']['news_ticks_limit'].'"></td><td><b>Number of showed "Tickers" on page \'Latest News\'. Empty or 0 disable Tickers!</b></td></tr>
<tr bgcolor='.$config['site']['darkborder'].'><td><input type="text" name="news_big_limit" value="'.$config['site']['news_big_limit'].'"></td><td><b>Number of showed "News" on page \'Latest News\'.</b></td></tr>
<tr bgcolor='.$config['site']['lightborder'].'><td><div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif);" ></div><input class="ButtonText" type="image" name="Submit" alt="Submit" src="'.$layout_name.'/images/buttons/_sbutton_submit.gif" ></div></div></td><td><b></b></td></tr>
</table></form>';
$main_content .= '<br/><center><form action="index.php?subtopic=adminpanel&action=editnews" METHOD=post><div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif);" ></div><input class="ButtonText" type="image" name="Back" alt="Back" src="'.$layout_name.'/images/buttons/_sbutton_back.gif" ></div></div></form></center>';
}
}

//EDIT GUILDS
if($action == "editguilds") {
if($_REQUEST['todo'] == 'guilds_save') {
//save access config and show results
if(empty($_REQUEST['guild_need_level'])) { $_REQUEST['guild_need_level'] = "8"; }
$config['site']['guild_need_level'] = (int) $_REQUEST['guild_need_level'];
if($_REQUEST['guild_need_pacc'] != 'yes' && $_REQUEST['guild_need_pacc'] != 'no') { $_REQUEST['guild_need_pacc'] = "no"; }
$config['site']['guild_need_pacc'] = $_REQUEST['guild_need_pacc'];
if(empty($_REQUEST['guild_image_size_kb'])) { $_REQUEST['guild_image_size_kb'] = "50"; }
$config['site']['guild_image_size_kb'] = (int) $_REQUEST['guild_image_size_kb'];
if(empty($_REQUEST['guild_description_chars_limit'])) { $_REQUEST['guild_description_chars_limit'] = "500"; }
$config['site']['guild_description_chars_limit'] = (int) $_REQUEST['guild_description_chars_limit'];
if(empty($_REQUEST['guild_description_lines_limit'])) { $_REQUEST['gguild_description_lines_limit'] = "6"; }
$config['site']['guild_description_lines_limit'] = (int) $_REQUEST['guild_description_lines_limit'];
if(empty($_REQUEST['guild_motd_chars_limit'])) { $_REQUEST['guild_motd_chars_limit'] = "150"; }
$config['site']['guild_motd_chars_limit'] = (int) $_REQUEST['guild_motd_chars_limit'];
saveconfig_ini($config['site']);
$config['site'] = parse_ini_file('config/config.ini');
$main_content .= '<b>Guilds configuration saved in "config.ini".</b><br>
<table style=\'clear:both\' border=0 cellpadding=0 cellspacing=0 width=\'100%\'>
<tr bgcolor='.$config['site']['darkborder'].'><td width="140"><font color="red"><b><center>Value</center></b></font></td><td><font color="red"><b>Description</b></font></td></tr>
<tr bgcolor='.$config['site']['lightborder'].'><td><center>'.$config['site']['guild_need_level'].'</center></td><td><b>Level needed to create guild.</b></td></tr>
<tr bgcolor='.$config['site']['darkborder'].'><td><center>'.ucwords($config['site']['guild_need_pacc']).'</center></td><td><b>PACC needed to create guild?</b></td></tr>
<tr bgcolor='.$config['site']['lightborder'].'><td><center>'.$config['site']['guild_image_size_kb'].' KB</center></td><td><b>Max. size of guild logo.</b></td></tr>
<tr bgcolor='.$config['site']['darkborder'].'><td><center>'.$config['site']['guild_description_chars_limit'].'</center></td><td><b>Guild description characters limit.</b></td></tr>
<tr bgcolor='.$config['site']['lightborder'].'><td><center>'.$config['site']['guild_description_lines_limit'].'</center></td><td><b>Guild description lines limit.</b></td></tr>
<tr bgcolor='.$config['site']['darkborder'].'><td><center>'.$config['site']['guild_motd_chars_limit'].'</center></td><td><b>MOTD (Message of the Day) characters limit.</b></td></tr>
<tr bgcolor='.$config['site']['lightborder'].'><td><div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif);" ></div><input class="ButtonText" type="image" name="Submit" alt="Submit" src="'.$layout_name.'/images/buttons/_sbutton_edit.gif" ></div></div></td><td><b></b></td></tr>
</form></table>';
$main_content .= '<br/><center><form action="index.php?subtopic=adminpanel" METHOD=post><div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif);" ></div><input class="ButtonText" type="image" name="Back" alt="Back" src="'.$layout_name.'/images/buttons/_sbutton_back.gif" ></div></div></form></center>';
}
if(empty($_REQUEST['todo'])) {
$main_content .= 'Here you can set limits of lines and characters in guild MOTD and description, max. size of guild logo and requirements to create guild.<br>
<form action="index.php?subtopic=adminpanel&action=editguilds&todo=guilds_save" METHOD=post>
<table style=\'clear:both\' border=0 cellpadding=0 cellspacing=0 width=\'100%\'>
<tr bgcolor='.$config['site']['darkborder'].'><td width="155"><font color="red"><b>Value</b></font></td><td><font color="red"><b>Description</b></font></td></tr>
<tr bgcolor='.$config['site']['lightborder'].'><td><input type="text" name="guild_need_level" value="'.$config['site']['guild_need_level'].'"></td><td><b>Level needed to create guild.</b></td></tr>
<tr bgcolor='.$config['site']['darkborder'].'><td>';
if($config['site']['guild_need_pacc'] == "yes") {
$main_content .= '<input type="radio" name="guild_need_pacc" value="yes" checked="checked">Yes';
$main_content .= '<input type="radio" name="guild_need_pacc" value="no">No';
} else {
$main_content .= '<input type="radio" name="guild_need_pacc" value="yes">Yes';
$main_content .= '<input type="radio" name="guild_need_pacc" value="no" checked="checked">No';
}
$main_content .= '</td><td><b>PACC needed to create guild?</b></td></tr>
<tr bgcolor='.$config['site']['lightborder'].'><td><input type="text" name="guild_image_size_kb" value="'.$config['site']['guild_image_size_kb'].'"> KB</td><td><b>Max. size of guild logo.</b></td></tr>
<tr bgcolor='.$config['site']['darkborder'].'><td><input type="text" name="guild_description_chars_limit" value="'.$config['site']['guild_description_chars_limit'].'"></td><td><b>Guild description characters limit.</b></td></tr>
<tr bgcolor='.$config['site']['lightborder'].'><td><input type="text" name="guild_description_lines_limit" value="'.$config['site']['guild_description_lines_limit'].'"></td><td><b>Guild description lines limit.</b></td></tr>
<tr bgcolor='.$config['site']['darkborder'].'><td><input type="text" name="guild_motd_chars_limit" value="'.$config['site']['guild_motd_chars_limit'].'"></td><td><b>MOTD (Message of the Day) characters limit.</b></td></tr>
<tr bgcolor='.$config['site']['lightborder'].'><td><div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif);" ></div><input class="ButtonText" type="image" name="Submit" alt="Submit" src="'.$layout_name.'/images/buttons/_sbutton_submit.gif" ></div></div></td><td><b></b></td></tr>
</table></form>';
$main_content .= '<br/><center><form action="index.php?subtopic=adminpanel" METHOD=post><div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif);" ></div><input class="ButtonText" type="image" name="Back" alt="Back" src="'.$layout_name.'/images/buttons/_sbutton_back.gif" ></div></div></form></center>';
}
}

//EDIT ACCOUNT MANAGER
if($action == 'editaccountmanager') {
if($_REQUEST['todo'] == 'save') {
//save access config
if(empty($_REQUEST['email_days_to_change'])) { $_REQUEST['email_days_to_change'] = "1"; }
$config['site']['email_days_to_change'] = (int) $_REQUEST['email_days_to_change'];
if(empty($_REQUEST['max_players_per_account'])) { $_REQUEST['max_players_per_account'] = "5"; }
$config['site']['max_players_per_account'] = (int) $_REQUEST['max_players_per_account'];
saveconfig_ini($config['site']);
//load saved config and show 
$config['site'] = parse_ini_file('config/config.ini');
$main_content .= '<b>All settings have been saved in "config.ini".</b><br>
<table style=\'clear:both\' border=0 cellpadding=0 cellspacing=0 width=\'100%\'>
<tr bgcolor='.$config['site']['darkborder'].'><td width="155"><center><font color="red"><b>Value</b></font></center></td><td><font color="red"><b>Description</b></font></td></tr>
<tr bgcolor='.$config['site']['lightborder'].'><td><center><b>'.$config['site']['email_days_to_change'].'</b></center></td><td><b>How many days player must wait before can accept new e-mail?</b></td></tr>
<tr bgcolor='.$config['site']['darkborder'].'><td><center><b>'.$config['site']['max_players_per_account'].'</b></center></td><td><b>Limit of characters per account (default 5).</b></td></tr>
<form action="index.php?subtopic=adminpanel&action=editaccountmanager" METHOD=post>
<tr bgcolor='.$config['site']['lightborder'].'><td><div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif);" ></div><input class="ButtonText" type="image" name="Submit" alt="Submit" src="'.$layout_name.'/images/buttons/_sbutton_edit.gif" ></div></div></td><td><b></b></td></tr>
</form></table>';
$main_content .= '<br/><center><form action="index.php?subtopic=adminpanel" METHOD=post><div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif);" ></div><input class="ButtonText" type="image" name="Back" alt="Back" src="'.$layout_name.'/images/buttons/_sbutton_back.gif" ></div></div></form></center>';
}
if(empty($_REQUEST['todo'])) {
$main_content .= 'Here you can edit site options configuration.<br>
<form action="index.php?subtopic=adminpanel&action=editaccountmanager&todo=save" METHOD=post>
<table style=\'clear:both\' border=0 cellpadding=0 cellspacing=0 width=\'100%\'>
<tr bgcolor='.$config['site']['lightborder'].'><td><a href="index.php?subtopic=adminpanel&action=install_vocations">Load Vocations</a></td><td><b>Load/Reload vocations and set characters to \'create character\' section.</b></td></tr>
<tr bgcolor='.$config['site']['darkborder'].'><td width="155"><font color="red"><b>Value</b></font></td><td><font color="red"><b>Description</b></font></td></tr>
<tr bgcolor='.$config['site']['lightborder'].'><td><input type="text" name="email_days_to_change" value="'.$config['site']['email_days_to_change'].'"></td><td><b>How many days player must wait before can accept new e-mail?</b></td></tr>
<tr bgcolor='.$config['site']['darkborder'].'><td><input type="text" name="max_players_per_account" value="'.$config['site']['max_players_per_account'].'"></td><td><b>Limit of characters per account (default 5).</b></td></tr>
<tr bgcolor='.$config['site']['lightborder'].'><td><div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif);" ></div><input class="ButtonText" type="image" name="Submit" alt="Submit" src="'.$layout_name.'/images/buttons/_sbutton_submit.gif" ></div></div></td><td><b></b></td></tr>
</table></form>';
$main_content .= '<br/><center><form action="index.php?subtopic=adminpanel" METHOD=post><div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif);" ></div><input class="ButtonText" type="image" name="Back" alt="Back" src="'.$layout_name.'/images/buttons/_sbutton_back.gif" ></div></div></form></center>';
}
}


//EDIT CREATE ACCOUNT
if($action == 'editcreateaccount') {
if($_REQUEST['todo'] == 'save') {
//save access config
if($_REQUEST['one_email'] != 'yes' && $_REQUEST['one_email'] != 'no') { $_REQUEST['one_email'] = "no"; }
$config['site']['one_email'] = $_REQUEST['one_email'];
if($_REQUEST['send_emails'] != 'yes' && $_REQUEST['send_emails'] != 'no') { $_REQUEST['send_emails'] = "no"; }
$config['site']['send_emails'] = $_REQUEST['send_emails'];
if($_REQUEST['account_number'] != 'custom' && $_REQUEST['account_number'] != 'random') { $_REQUEST['account_number'] = "random"; }
$config['site']['account_number'] = $_REQUEST['account_number'];
if($_REQUEST['verify_code'] != 'yes' && $_REQUEST['verify_code'] != 'no') { $_REQUEST['verify_code'] = "no"; }
$config['site']['verify_code'] = $_REQUEST['verify_code'];
saveconfig_ini($config['site']);
//load saved config and show 
$config['site'] = parse_ini_file('config/config.ini');
$main_content .= '<b>All settings have been saved in "config.ini".</b><br>
<table style=\'clear:both\' border=0 cellpadding=0 cellspacing=0 width=\'100%\'>
<tr bgcolor='.$config['site']['darkborder'].'><td width="155"><center><font color="red"><b>Value</b></font></center></td><td><font color="red"><b>Description</b></font></td></tr>
<tr bgcolor='.$config['site']['lightborder'].'><td><center><b>'.$config['site']['one_email'].'</b></center></td><td><b>One account with one e-mail?</b></td></tr>
<tr bgcolor='.$config['site']['darkborder'].'><td><center><b>'.$config['site']['send_emails'].'</b></center></td><td><b>Send e-mails?</b></td></tr>
<tr bgcolor='.$config['site']['lightborder'].'><td><center><b>'.$config['site']['account_number'].'</b></center></td><td><b>Account number type (random or custom).</b></td></tr>
<tr bgcolor='.$config['site']['darkborder'].'><td><center><b>'.$config['site']['verify_code'].'</b></center></td><td><b>Show image to verify user (block stupid bots)?</b></td></tr>
<form action="index.php?subtopic=adminpanel&action=editcreateaccount" METHOD=post>
<tr bgcolor='.$config['site']['lightborder'].'><td><div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif);" ></div><input class="ButtonText" type="image" name="Submit" alt="Submit" src="'.$layout_name.'/images/buttons/_sbutton_edit.gif" ></div></div></td><td><b></b></td></tr>
</form></table>';
$main_content .= '<br/><center><form action="index.php?subtopic=adminpanel" METHOD=post><div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif);" ></div><input class="ButtonText" type="image" name="Back" alt="Back" src="'.$layout_name.'/images/buttons/_sbutton_back.gif" ></div></div></form></center>';
}
if(empty($_REQUEST['todo'])) {
$main_content .= 'Here you can edit site options configuration.<br>
<form action="index.php?subtopic=adminpanel&action=editcreateaccount&todo=save" METHOD=post>
<table style=\'clear:both\' border=0 cellpadding=0 cellspacing=0 width=\'100%\'>
<tr bgcolor='.$config['site']['darkborder'].'><td width="155"><font color="red"><b>Value</b></font></td><td><font color="red"><b>Description</b></font></td></tr>
<tr bgcolor='.$config['site']['lightborder'].'><td>';
if($config['site']['one_email'] == "yes") {
$main_content .= '<input type="radio" name="one_email" value="yes" checked="checked">Yes';
$main_content .= '<input type="radio" name="one_email" value="no">No';
} else {
$main_content .= '<input type="radio" name="one_email" value="yes">Yes';
$main_content .= '<input type="radio" name="one_email" value="no" checked="checked">No';
}
$main_content .= '</td><td><b>One account with one e-mail?</b></td></tr>
<tr bgcolor='.$config['site']['darkborder'].'><td>';
if($config['site']['send_emails'] == "yes") {
$main_content .= '<input type="radio" name="send_emails" value="yes" checked="checked">Yes';
$main_content .= '<input type="radio" name="send_emails" value="no">No';
} else {
$main_content .= '<input type="radio" name="send_emails" value="yes">Yes';
$main_content .= '<input type="radio" name="send_emails" value="no" checked="checked">No';
}
$main_content .= '</td><td><b>Send e-mails?</b></td></tr>
<tr bgcolor='.$config['site']['lightborder'].'><td>';
if($config['site']['account_number'] == "random") {
$main_content .= '<input type="radio" name="account_number" value="random" checked="checked">Random';
$main_content .= '<input type="radio" name="account_number" value="custom">Custom';
} else {
$main_content .= '<input type="radio" name="account_number" value="random">Random';
$main_content .= '<input type="radio" name="account_number" value="custom" checked="checked">Custom';
}
$main_content .= '</td><td><b>Account number type.<br/>Random - new accounts have random number.<br/>Custom - user can select number for his account.</b></td></tr>

<tr bgcolor='.$config['site']['darkborder'].'><td>';
if($config['site']['verify_code'] == "yes") {
$main_content .= '<input type="radio" name="verify_code" value="yes" checked="checked">Yes';
$main_content .= '<input type="radio" name="verify_code" value="no">No';
} else {
$main_content .= '<input type="radio" name="verify_code" value="yes">Yes';
$main_content .= '<input type="radio" name="verify_code" value="no" checked="checked">No';
}
$main_content .= '</td><td><b>Show image to verify user (block stupid bots)?</b></td></tr>

<tr bgcolor='.$config['site']['darkborder'].'><td><div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif);" ></div><input class="ButtonText" type="image" name="Submit" alt="Submit" src="'.$layout_name.'/images/buttons/_sbutton_submit.gif" ></div></div></td><td><b></b></td></tr>
</table></form>';
$main_content .= '<br/><center><form action="index.php?subtopic=adminpanel" METHOD=post><div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif);" ></div><input class="ButtonText" type="image" name="Back" alt="Back" src="'.$layout_name.'/images/buttons/_sbutton_back.gif" ></div></div></form></center>';
}
}


//EDIT SITE CONFIG
if($action == 'editmainconfig') {
if($_REQUEST['todo'] == 'save') {
//save access config
if(empty($_REQUEST['subfolder'])) { $_REQUEST['subfolder'] = ""; }
$config['site']['subfolder'] = $_REQUEST['subfolder'];
if(empty($_REQUEST['forum_link'])) { $_REQUEST['forum_link'] = ""; }
$config['site']['forum_link'] = $_REQUEST['forum_link'];
if(empty($_REQUEST['logo_monster'])) { $_REQUEST['logo_monster'] = "Troll"; }
$config['site']['logo_monster'] = $_REQUEST['logo_monster'];
if($_REQUEST['send_emails'] != 'yes' && $_REQUEST['send_emails'] != 'no') { $_REQUEST['send_emails'] = "no"; }
$config['site']['send_emails'] = $_REQUEST['send_emails'];
if(empty($_REQUEST['last_deaths_limit'])) { $_REQUEST['last_deaths_limit'] = "20"; }
$config['site']['last_deaths_limit'] = (int) $_REQUEST['last_deaths_limit'];
$config['site']['players_group_id_block'] = (int) $_REQUEST['players_group_id_block'];
if(empty($_REQUEST['show_mlvl'])) { $_REQUEST['show_mlvl'] = "0"; }
$config['site']['show_mlvl'] = (int) $_REQUEST['show_mlvl'];
if(empty($_REQUEST['show_creationdate'])) { $_REQUEST['show_creationdate'] = "0"; }
$config['site']['show_creationdate'] = (int) $_REQUEST['show_creationdate'];
if(empty($_REQUEST['shop_system'])) { $_REQUEST['shop_system'] = "0"; }
$config['site']['shop_system'] = (int) $_REQUEST['shop_system'];
if(empty($_REQUEST['download_page'])) { $_REQUEST['download_page'] = "0"; }
$config['site']['download_page'] = (int) $_REQUEST['download_page'];
if(empty($_REQUEST['serverinfo_page'])) { $_REQUEST['serverinfo_page'] = "0"; }
$config['site']['serverinfo_page'] = (int) $_REQUEST['serverinfo_page'];
if($_REQUEST['access_admin_panel'] <= $group_id_of_acc_logged) {
if(empty($_REQUEST['access_admin_panel'])) { $_REQUEST['access_admin_panel'] = $group_id_of_acc_logged; }
$config['site']['access_admin_panel'] = (int) $_REQUEST['access_admin_panel'];
} else {
$main_content .= '<font color="red"><b>Error. You can\'t set higher page-access level than your ('.$group_id_of_acc_logged.').</b></font></br>';
$config['site']['access_admin_panel'] = $group_id_of_acc_logged;
}
saveconfig_ini($config['site']);
//load saved config and show 
$config['site'] = parse_ini_file('config/config.ini');
$main_content .= '<b>All settings have been saved in "config.ini".</b><br>
<table style=\'clear:both\' border=0 cellpadding=0 cellspacing=0 width=\'100%\'>
<tr bgcolor='.$config['site']['darkborder'].'><td width="155"><center><font color="red"><b>Value</b></font></center></td><td><font color="red"><b>Description</b></font></td></tr>
<tr bgcolor='.$config['site']['lightborder'].'><td><center>'.$config['site']['subfolder'].'</center></td><td><b>Subfolder where is site. Like: <i>/ots</i>, leave empty if you use virtual host.</b></td></tr>
<tr bgcolor='.$config['site']['darkborder'].'><td><center>'.$config['site']['forum_link'].'</center></td><td><b>If server has forum put here link. It will be showed in "Community".</b></td></tr>
<tr bgcolor='.$config['site']['lightborder'].'><td><center>'.$config['site']['logo_monster'].'</center></td><td><b>Name of monster graphic added to logo.</b></td></tr>
<tr bgcolor='.$config['site']['darkborder'].'><td><center>';
if($config['site']['send_emails'] == "yes") {
$main_content .= 'Yes';
} else {
$main_content .= 'No';
}
$main_content .= '</center></td><td><b>Is your server configured to send registration e-mails?</b></td></tr>
<tr bgcolor='.$config['site']['lightborder'].'><td><center>'.$config['site']['last_deaths_limit'].'</center></td><td><b>Number of deaths showed in "Last Deaths".</b></td></tr>
<tr bgcolor='.$config['site']['darkborder'].'><td><center>'.$config['site']['players_group_id_block'].'</center></td><td><b>Players with this group ID or higher will not be showed in highscores.</b></td></tr>
<tr bgcolor='.$config['site']['lightborder'].'><td><center>';
if($config['site']['show_mlvl'] == "1") {
$main_content .= 'Yes';
} else {
$main_content .= 'No';
}
$main_content .= '</center></td><td><b>Show magic level in character search results?</b></td></tr>
<tr bgcolor='.$config['site']['darkborder'].'><td><center>';
if($config['site']['show_creationdate'] == "1") {
$main_content .= 'Yes';
} else {
$main_content .= 'No';
}
$main_content .= '</center></td><td><b>Show character creation date in character search results?</b></td></tr>
<tr bgcolor='.$config['site']['lightborder'].'><td><center>';
if($config['site']['shop_system'] == "1") {
$main_content .= 'Yes';
} else {
$main_content .= 'No';
}
$main_content .= '</center></td><td><b>Show "Shop System" submenu?</b></td></tr>
<tr bgcolor='.$config['site']['darkborder'].'><td><center>';
if($config['site']['download_page'] == "1") {
$main_content .= 'Yes';
} else {
$main_content .= 'No';
}
$main_content .= '</center></td><td><b>Show "downloads" subpage??</b></td></tr>
<tr bgcolor='.$config['site']['lightborder'].'><td><center>';
if($config['site']['serverinfo_page'] == "1") {
$main_content .= 'Yes';
} else {
$main_content .= 'No';
}
$main_content .= '</center></td><td><b>Show "Server Info" subpage?</b></td></tr>
<tr bgcolor='.$config['site']['darkborder'].'><td><center>'.$config['site']['access_admin_panel'].'</center></td><td><b>Page access ID to "Admin Panel" (this site!). Your page-access now: <font color="red"><b>'.$group_id_of_acc_logged.'</b></font>.</b></td></tr>
<form action="index.php?subtopic=adminpanel&action=editmainconfig" METHOD=post>
<tr bgcolor='.$config['site']['lightborder'].'><td><div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif);" ></div><input class="ButtonText" type="image" name="Submit" alt="Submit" src="'.$layout_name.'/images/buttons/_sbutton_edit.gif" ></div></div></td><td><b></b></td></tr>
</form></table>';
$main_content .= '<br/><center><form action="index.php?subtopic=adminpanel" METHOD=post><div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif);" ></div><input class="ButtonText" type="image" name="Back" alt="Back" src="'.$layout_name.'/images/buttons/_sbutton_back.gif" ></div></div></form></center>';
}
if(empty($_REQUEST['todo'])) {
$main_content .= 'Here you can edit site options configuration.<br>
<form action="index.php?subtopic=adminpanel&action=editmainconfig&todo=save" METHOD=post>
<table style=\'clear:both\' border=0 cellpadding=0 cellspacing=0 width=\'100%\'>
<tr bgcolor='.$config['site']['darkborder'].'><td width="155"><font color="red"><b>Value</b></font></td><td><font color="red"><b>Description</b></font></td></tr>
<tr bgcolor='.$config['site']['lightborder'].'><td><input type="text" name="subfolder" value="'.$config['site']['subfolder'].'"></td><td><b>Subfolder where is site. Like: <i>/ots</i>, leave empty if you use virtual host.</b></td></tr>
<tr bgcolor='.$config['site']['darkborder'].'><td><input type="text" name="forum_link" value="'.$config['site']['forum_link'].'"></td><td><b>If server has forum put here link. It will be showed in "Community".</b></td></tr>
<tr bgcolor='.$config['site']['lightborder'].'><td><input type="text" name="logo_monster" value="'.$config['site']['logo_monster'].'"></td><td><b>Name of monster graphic added to logo.</b></td></tr>';
$main_content .= '<tr bgcolor='.$config['site']['darkborder'].'><td>';
if($config['site']['send_emails'] == "yes") {
$main_content .= '<input type="radio" name="send_emails" value="yes" checked="checked">Yes';
$main_content .= '<input type="radio" name="send_emails" value="no">No';
} else {
$main_content .= '<input type="radio" name="send_emails" value="yes">Yes';
$main_content .= '<input type="radio" name="send_emails" value="no" checked="checked">No';
}
$main_content .= '</td><td><b>Is your server configured to send registration e-mails?</b></td></tr>
<tr bgcolor='.$config['site']['lightborder'].'><td><input type="text" name="last_deaths_limit" value="'.$config['site']['last_deaths_limit'].'"></td><td><b>Number of deaths showed in "Last Deaths".</b></td></tr>
<tr bgcolor='.$config['site']['darkborder'].'><td><input type="text" name="players_group_id_block" value="'.$config['site']['players_group_id_block'].'"></td><td><b>Players with this group ID or higher will not be showed in highscores.</b></td></tr>
<tr bgcolor='.$config['site']['lightborder'].'><td>';
if($config['site']['show_mlvl'] == "1") {
$main_content .= '<input type="radio" name="show_mlvl" value="1" checked="checked">Yes';
$main_content .= '<input type="radio" name="show_mlvl" value="0">No';
} else {
$main_content .= '<input type="radio" name="show_mlvl" value="1">Yes';
$main_content .= '<input type="radio" name="show_mlvl" value="0" checked="checked">No';
}
$main_content .= '</td><td><b>Show magic level in character search results?</b></td></tr>
<tr bgcolor='.$config['site']['darkborder'].'><td>';
if($config['site']['show_creationdate'] == "1") {
$main_content .= '<input type="radio" name="show_creationdate" value="1" checked="checked">Yes';
$main_content .= '<input type="radio" name="show_creationdate" value="0">No';
} else {
$main_content .= '<input type="radio" name="show_creationdate" value="1">Yes';
$main_content .= '<input type="radio" name="show_creationdate" value="0" checked="checked">No';
}
$main_content .= '</td><td><b>Show character creation date in character search results?</b></td></tr>



<tr bgcolor='.$config['site']['lightborder'].'><td>';
if($config['site']['shop_system'] == "1") {
$main_content .= '<input type="radio" name="shop_system" value="1" checked="checked">Yes';
$main_content .= '<input type="radio" name="shop_system" value="0">No';
} else {
$main_content .= '<input type="radio" name="shop_system" value="1">Yes';
$main_content .= '<input type="radio" name="shop_system" value="0" checked="checked">No';
}
$main_content .= '</td><td><b>Show "Shop System" submenu? ("Yes" only if installed! Read FAQ)</b></td></tr>



<tr bgcolor='.$config['site']['darkborder'].'><td>';
if($config['site']['download_page'] == "1") {
$main_content .= '<input type="radio" name="download_page" value="1" checked="checked">Yes';
$main_content .= '<input type="radio" name="download_page" value="0">No';
} else {
$main_content .= '<input type="radio" name="download_page" value="1">Yes';
$main_content .= '<input type="radio" name="download_page" value="0" checked="checked">No';
}
$main_content .= '</td><td><b>Show "Downloads" subpage?</b></td></tr>



<tr bgcolor='.$config['site']['lightborder'].'><td>';
if($config['site']['serverinfo_page'] == "1") {
$main_content .= '<input type="radio" name="serverinfo_page" value="1" checked="checked">Yes';
$main_content .= '<input type="radio" name="serverinfo_page" value="0">No';
} else {
$main_content .= '<input type="radio" name="serverinfo_page" value="1">Yes';
$main_content .= '<input type="radio" name="serverinfo_page" value="0" checked="checked">No';
}
$main_content .= '</td><td><b>Show "Server Info" subpage?</b></td></tr>



<tr bgcolor='.$config['site']['darkborder'].'><td><input type="text" name="access_admin_panel" value="'.$config['site']['access_admin_panel'].'"></td><td><b>Page access ID to "Admin Panel" (this site!). Your page-access now: <font color="red"><b>'.$group_id_of_acc_logged.'</b></font>.</b></td></tr>
<tr bgcolor='.$config['site']['lightborder'].'><td><div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif);" ></div><input class="ButtonText" type="image" name="Submit" alt="Submit" src="'.$layout_name.'/images/buttons/_sbutton_submit.gif" ></div></div></td><td><b></b></td></tr>
</table></form>';
$main_content .= '<br/><center><form action="index.php?subtopic=adminpanel" METHOD=post><div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif);" ></div><input class="ButtonText" type="image" name="Back" alt="Back" src="'.$layout_name.'/images/buttons/_sbutton_back.gif" ></div></div></form></center>';
}
}


//EDIT MONSTERS
if($action == "editmonsters") {

if($_REQUEST['todo'] == "setall") {
$visibility = $_REQUEST['visibility'];
if($visibility == "visible") {
try { $SQL->query('UPDATE z_monsters SET hide_creature = 0'); } catch(PDOException $error) {}
$main_content .= '<h3>All creatures are now VISIBLE!</h3>';
}
elseif($visibility == "hidden") {
try { $SQL->query('UPDATE z_monsters SET hide_creature = 1'); } catch(PDOException $error) {}
$main_content .= '<h3>All creatures are now HIDDEN!</h3>';
}
}

if($_REQUEST['todo'] == "editgfxlink") {
$monster_name = stripslashes($_REQUEST['monster']);
$new_link = stripslashes($_REQUEST['new_link']);
if(empty($_REQUEST['savenewgfxlink'])) {
$show_list = "no";
try { $monster = $SQL->query('SELECT * FROM z_monsters WHERE name = '.$SQL->quote($monster_name).';')->fetch(); } catch(PDOException $error) {}
$main_content .= '<center><h2>Edit link</h2></center><b>Link to image: </b>http://'.$_SERVER['SERVER_NAME'].$config['site']['subfolder'].'/monsters/<form action="index.php?subtopic=adminpanel&action=editmonsters&todo=editgfxlink" method=POST><input type="hidden" name="savenewgfxlink" value="yes"><input type="hidden" name="monster" value="'.$monster_name.'"><input type="text" name="new_link" value="'.$monster['gfx_name'].'"><input type="submit" value="Save"></form>';
} else {
try { $SQL->query('UPDATE z_monsters SET gfx_name = '.$SQL->quote($new_link).' WHERE name = '.$SQL->quote($monster_name).';'); } catch(PDOException $error) {}
$main_content .= 'New link <b>'.$new_link.'</b> to <b>'.$monster_name.'</b> has been saved.<br/>';
}
}

if($_REQUEST['todo'] == "hide_monsters") {
$main_content .= '<center><h2>Hide monsters</h2></center>Monsters:<b>';
foreach($_REQUEST['hide_array'] as $monster_to_hide) {
$main_content .= '<li>'.$monster_to_hide;
try { $SQL->query('UPDATE z_monsters SET hide_creature = 1 WHERE name = '.$SQL->quote(stripslashes($monster_to_hide)).';'); } catch(PDOException $error) {}
}
$main_content .= '</b><br/>are now HIDDEN.';
}

if($_REQUEST['todo'] == "show_monsters") {
$main_content .= '<center><h2>Show monsters</h2></center>Monsters:<b>';
foreach($_REQUEST['show_array'] as $monster_to_hide) {
$main_content .= '<li>'.$monster_to_hide;
try { $SQL->query('UPDATE z_monsters SET hide_creature = 0 WHERE name = '.$SQL->quote(stripslashes($monster_to_hide)).';'); } catch(PDOException $error) {}
}
$main_content .= '</b><br/>are now VISIBLE.';
}

if($show_list != "no") {
//visible monsters list
try { $monsters = $SQL->query('SELECT * FROM z_monsters WHERE hide_creature != 1 ORDER BY name'); } catch(PDOException $error) {}
$main_content .= '<center><h2>Edit monsters</h2></center><h3>Visible monsters</h3><h4><a href="index.php?subtopic=adminpanel&action=editmonsters&todo=setall&visibility=hidden">Set all monsters HIDDEN</a></h4><form action="index.php?subtopic=adminpanel&action=editmonsters&todo=hide_monsters" method=POST><TABLE BORDER=0 CELLSPACING=1 CELLPADDING=4 WIDTH=100%><TR BGCOLOR='.$config['site']['vdarkborder'].'><TD CLASS=white width="200"><B><font CLASS=white>Photo</B></TD><TD CLASS=white width="200"><B><font CLASS=white>Edit photo</B></TD><TD CLASS=white width="200"><B><font CLASS=white>Name</B></TD><TD CLASS=white><B><font CLASS=white>Health</B></TD><TD CLASS=white><B><font CLASS=white>Experience</B></TD><TD CLASS=white><B><font CLASS=white>Hide Creature</B></TD></TR>';
foreach($monsters as $monster) {
if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['lightborder']; } else { $bgcolor = $config['site']['darkborder']; } $number_of_rows++;
$main_content .= '<TR BGCOLOR="'.$bgcolor.'"><TD>';
if(file_exists('monsters/'.$monster['gfx_name'])) {
$main_content .= '<img src="monsters/'.$monster['gfx_name'].'" height="40" width="40">';
} else {
$main_content .= '<img src="http://i63.photobucket.com/albums/h122/Mister_Dude/nophoto.png" height="40" width="40">';
}
$main_content .= '</TD><TD><a href="index.php?subtopic=adminpanel&action=editmonsters&todo=editgfxlink&monster='.urlencode($monster['name']).'">Change image name</a></TD><TD>'.$monster['name'].'</TD><TD>'.$monster['health'].'</TD><TD>'.$monster['exp'].'</TD><TD><input type="checkbox" name="hide_array[]" value="'.$monster['name'].'"></TD>';
}
$main_content .= '<TR><TD></TD><TD></TD><TD></TD><TD>Hide</TD><TD>monsters:</TD><TD><input type="submit" value="Hide monsters"></TD></TR></TABLE></form>';

//hidden monsters list
try { $monsters = $SQL->query('SELECT * FROM z_monsters WHERE hide_creature != 0 ORDER BY name'); } catch(PDOException $error) {}
$main_content .= '<h3>Hidden monsters:</h3><h4><a href="index.php?subtopic=adminpanel&action=editmonsters&todo=setall&visibility=visible">Set all monsters VISIBLE</a></h4><form action="index.php?subtopic=adminpanel&action=editmonsters&todo=show_monsters" method=POST><TABLE BORDER=0 CELLSPACING=1 CELLPADDING=4 WIDTH=100%><TR BGCOLOR='.$config['site']['vdarkborder'].'><TD CLASS=white width="200"><B><font CLASS=white>Photo</B></TD><TD CLASS=white width="200"><B><font CLASS=white>Edit photo</B></TD><TD CLASS=white width="200"><B><font CLASS=white>Name</B></TD><TD CLASS=white><B><font CLASS=white>Health</B></TD><TD CLASS=white><B><font CLASS=white>Experience</B></TD><TD CLASS=white><B><font CLASS=white>Hide Creature</B></TD></TR>';
foreach($monsters as $monster) {
if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['lightborder']; } else { $bgcolor = $config['site']['darkborder']; } $number_of_rows++;
$main_content .= '<TR BGCOLOR="'.$bgcolor.'"><TD>';
if(file_exists('monsters/'.$monster['gfx_name'])) {
$main_content .= '<img src="monsters/'.$monster['gfx_name'].'" height="40" width="40">';
} else {
$main_content .= '<img src="http://i63.photobucket.com/albums/h122/Mister_Dude/nophoto.png" height="40" width="40">';
}
$main_content .= '</TD><TD><a href="index.php?subtopic=adminpanel&action=editmonsters&todo=editgfxlink&monster='.$monster['name'].'">Change image name</a></TD><TD>'.$monster['name'].'</TD><TD>'.$monster['health'].'</TD><TD>'.$monster['exp'].'</TD><TD><input type="checkbox" name="show_array[]" value="'.$monster['name'].'"></TD>';
}
$main_content .= '<TR><TD></TD><TD></TD><TD></TD><TD>Show</TD><TD>monsters:</TD><TD><input type="submit" value="Show monsters"></TD></TR></TABLE></form>';
}
$main_content .= '<center><form action="index.php?subtopic=adminpanel" METHOD=post><div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif);" ></div><input class="ButtonText" type="image" name="Back" alt="Back" src="'.$layout_name.'/images/buttons/_sbutton_back.gif" ></div></div></form></center>';
}

//EDIT SPELLS
if($action == "editspells") {
if(!empty($_REQUEST['allspells'])) {
if($_REQUEST['allspells'] == 'visible') {
try { $SQL->query('UPDATE z_spells SET hide_spell = "0"'); } catch(PDOException $error) {}
$main_content .= 'All spells are now <b>visible</b>!';
}
elseif($_REQUEST['allspells'] == 'hidden') {
try { $SQL->query('UPDATE z_spells SET hide_spell = "1"'); } catch(PDOException $error) {}
$main_content .= 'All spells are now <b>hidden</b>!';
}
}
if($_REQUEST['savespell'] == "yes") {
if(!empty($_REQUEST['spell_name'])) {
if($_REQUEST['visible'] == "yes") {
try { $SQL->query('UPDATE z_spells SET hide_spell = 0 WHERE name = "'.$_REQUEST['spell_name'].'"'); } catch(PDOException $error) {}
$main_content .= "<b>'".$_REQUEST['spell_name']."'</b> is now VISIBLE!";
}
if($_REQUEST['visible'] == "no") {
try { $SQL->query('UPDATE z_spells SET hide_spell = "1" WHERE name = "'.$_REQUEST['spell_name'].'"'); } catch(PDOException $error) {}
$main_content .= "<b>'".$_REQUEST['spell_name']."'</b> is now HIDDEN!";
}
}
}
try { $spells = $SQL->query('SELECT * FROM z_spells ORDER BY name'); } catch(PDOException $error) {}
$main_content .= '<FORM ACTION="index.php?subtopic=adminpanel&action=editspells" METHOD=post><input type="hidden" name="savespell" value="yes">
<TABLE BORDER=0 CELLSPACING=1 CELLPADDING=4 WIDTH=100%>
<TR BGCOLOR='.$config['site']['vdarkborder'].'><TD CLASS=white><B>Set spell visible or hidden</B></TD></TR>
<TR BGCOLOR='.$config['site']['darkborder'].'><TD><b>Spell: </b><SELECT NAME="spell_name">';
foreach($spells as $spell) {
$main_content .= '<OPTION VALUE="'.$spell['name'].'">'.$spell['name'];
if($spell['hide_spell'] == 1) {
$main_content .= ' (hidden)';
} else {
$main_content .= ' (visible)';
}
}
$main_content .= '</SELECT><b>Visible:</b> Yes<input type="radio" name="visible" value="yes" />No<input type="radio" name="visible" value="no" />&nbsp;&nbsp;&nbsp;<INPUT TYPE=image NAME="Submit" ALT="Submit" SRC="'.$layout_name.'/images/buttons/sbutton_submit.gif" BORDER=0 WIDTH=120 HEIGHT=18></TD><TR>
</TABLE></FORM>';
//show visible spells
$main_content .= '<h3>Visible spells list:</h3><a href="index.php?subtopic=adminpanel&action=editspells&allspells=hidden">Set all spells: HIDDEN</a><TABLE BORDER=0 CELLSPACING=1 CELLPADDING=4 WIDTH=100%><TR BGCOLOR='.$config['site']['vdarkborder'].'><TD><B><font CLASS=white>Name</font></B></TD><TD><B><font CLASS=white>Sentence</font></a></B></TD><TD><B><font CLASS=white>Type<br/>(count)</font></B></TD><TD><B><font CLASS=white>Mana</font></B></TD><TD><B><font CLASS=white>Exp.<br/>Level</font></B></TD><TD><B><font CLASS=white>Magic<br/>Level</font></B></TD><TD><B><font CLASS=white>Soul</font></B></TD><TD CLASS=white><B>Need<br/>PACC?</B></TD></TR>';
try { $spells = $SQL->query('SELECT * FROM z_spells ORDER BY name'); } catch(PDOException $error) {}
foreach($spells as $spell) {
if($spell['hide_spell'] == "0") {
if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['lightborder']; } else { $bgcolor = $config['site']['darkborder']; } $number_of_rows++;
$main_content .= '<TR BGCOLOR="'.$bgcolor.'"><TD>'.$spell['name'].'</TD><TD>'.$spell['spell'].'</TD>';
if($spell['spell_type'] == 'conjure') {
$main_content .= '<TD>'.$spell['spell_type'].'('.$spell['conj_count'].')</TD>';
}
else
{
$main_content .= '<TD>'.$spell['spell_type'].'</TD>';
}
$main_content .= '<TD>'.$spell['mana'].'</TD><TD>'.$spell['lvl'].'</TD><TD>'.$spell['mlvl'].'</TD><TD>'.$spell['soul'].'</TD><TD>'.$spell['pacc'].'</TD></TR>';
}
}
$main_content .= '</TABLE>';
//show hidden spells
$main_content .= '<h3>Hidden spells list:</h3><a href="index.php?subtopic=adminpanel&action=editspells&allspells=visible">Set all spells: VISIBLE</a><TABLE BORDER=0 CELLSPACING=1 CELLPADDING=4 WIDTH=100%><TR BGCOLOR='.$config['site']['vdarkborder'].'><TD><B><font CLASS=white>Name</font></B></TD><TD><B><font CLASS=white>Sentence</font></a></B></TD><TD><B><font CLASS=white>Type<br/>(count)</font></B></TD><TD><B><font CLASS=white>Mana</font></B></TD><TD><B><font CLASS=white>Exp.<br/>Level</font></B></TD><TD><B><font CLASS=white>Magic<br/>Level</font></B></TD><TD><B><font CLASS=white>Soul</font></B></TD><TD CLASS=white><B>Need<br/>PACC?</B></TD></TR>';
try { $spells = $SQL->query('SELECT * FROM z_spells ORDER BY name'); } catch(PDOException $error) {}
foreach($spells as $spell) {
if($spell['hide_spell'] == "1") {
if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['lightborder']; } else { $bgcolor = $config['site']['darkborder']; } $number_of_rows++;
$main_content .= '<TR BGCOLOR="'.$bgcolor.'"><TD>'.$spell['name'].'</TD><TD>'.$spell['spell'].'</TD>';
if($spell['spell_type'] == 'conjure') {
$main_content .= '<TD>'.$spell['spell_type'].'('.$spell['conj_count'].')</TD>';
}
else
{
$main_content .= '<TD>'.$spell['spell_type'].'</TD>';
}
$main_content .= '<TD>'.$spell['mana'].'</TD><TD>'.$spell['lvl'].'</TD><TD>'.$spell['mlvl'].'</TD><TD>'.$spell['soul'].'</TD><TD>'.$spell['pacc'].'</TD></TR>';
}
}
$main_content .= '</TABLE><br/><center><form action="index.php?subtopic=adminpanel" METHOD=post><div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif);" ></div><input class="ButtonText" type="image" name="Back" alt="Back" src="'.$layout_name.'/images/buttons/_sbutton_back.gif" ></div></div></form></center>';
}

//INSTALL MONSTERS
if($action == "install_monsters") {
try { $SQL->query("DELETE FROM ".$SQL->tableName('z_monsters').";"); } catch(PDOException $error) {}
$main_content .= '<h2>Reload monsters.</h2>';
$main_content .= '<h2>All records deleted from table \'z_monsters\' in database.</h2>';
$allmonsters = new OTS_MonstersList($config['site']['server_path']."data/monster/");
//$names_added must be an array
$names_added[] = '';
//add monsters
foreach($allmonsters as $lol) {
$monster = $allmonsters->current();
//load monster mana needed to summon/convince
$mana = $monster->getManaCost();
//load monster experience
$exp = $monster->getExperience();
//load monster name
$name = $monster->getName();
//load monster health
$health = $monster->getHealth();
//load monster speed and calculate "speed level"
$speed_ini = $monster->getSpeed();
if($speed_ini <= 220) {
$speed_lvl = 1;
} else {
$speed_lvl = ($speed_ini - 220) / 2;
}
//check "is monster use haste spell"
$defenses = $monster->getDefenses();
$use_haste = 0;
foreach($defenses as $defense) {
if($defense == 'speed') {
$use_haste = 1;
}
}
//load monster flags
$flags = $monster->getFlags();
//create string with immunities
$immunities = $monster->getImmunities();
$imu_nr = 0;
$imu_count = count($immunities);
$immunities_string = '';
foreach($immunities as $immunitie) {
$immunities_string .= $immunitie;
$imu_nr++;
if($imu_count != $imu_nr) {
$immunities_string .= ", ";
}
}
//create string with voices
$voices = $monster->getVoices();
$voice_nr = 0;
$voice_count = count($voices);
$voices_string = '';
foreach($voices as $voice) {
$voices_string .= '"'.$voice.'"';
$voice_nr++;
if($voice_count != $voice_nr) {
$voices_string .= ", ";
}
}
//load race
$race = $monster->getRace();
//create monster gfx name
$gfx_name =  str_replace(" ", "", trim(mb_strtolower($name))).".gif";
//don't add 2 monsters with same name, like Butterfly
if(!in_array($name, $names_added)) {
try { $SQL->query('INSERT INTO '.$SQL->tableName('z_monsters').' (hide_creature, name, mana, exp, health, speed_lvl, use_haste, voices, immunities, summonable, convinceable, race, gfx_name) VALUES (0, '.$SQL->quote($name).', '.$mana.', '.$exp.', '.$health.', '.$speed_lvl.', '.$use_haste.', '.$SQL->quote($voices_string).', '.$SQL->quote($immunities_string).', '.$flags['summonable'].', '.$flags['convinceable'].', '.$SQL->quote($race).', '.$SQL->quote($gfx_name).');'); } catch(PDOException $error) {}
$names_added[] = $name;
$main_content .= "Added: ".$name."<br/>";
}
}
//back button
$main_content .= '<center><form action="index.php?subtopic=adminpanel" METHOD=post><div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif);" ></div><input class="ButtonText" type="image" name="Back" alt="Back" src="'.$layout_name.'/images/buttons/_sbutton_back.gif" ></div></div></form></center>';
}

//SPELLS
if($action == "install_spells") {
try { $SQL->query("DELETE FROM ".$SQL->tableName('z_spells').";"); } catch(PDOException $error) {}
$main_content .= '<h2>Reload spells.</h2>';
$main_content .= '<h2>All records deleted from table \'z_spells\' in database.</h2>';
foreach($config_vocations as $voc_id => $voc_name) {
	$vocations_ids[$voc_name] = $voc_id;
}
$allspells = new OTS_SpellsList($config['site']['server_path']."data/spells/spells.xml");
//add conjure spells
$conjurelist = $allspells->getConjuresList();
$main_content .= "<h3>Conjure:</h3>";
foreach($conjurelist as $spellname) {
$spell = $allspells->getConjure($spellname);
$lvl = $spell->getLevel();
$mlvl = $spell->getMagicLevel();
$mana = $spell->getMana();
$name = $spell->getName();
$soul = $spell->getSoul();
$spell_txt = $spell->getWords();
$vocations = $spell->getVocations();
$nr_of_vocations = count($vocations);
$vocations_to_db = "";
$voc_nr = 0;
foreach($vocations as $vocation_to_add_name) {
$vocations_to_db .= $vocations_ids[$vocation_to_add_name];
$voc_nr++;
if($voc_nr != $nr_of_vocations) {
$vocations_to_db .= ',';
}
}
$enabled = $spell->isEnabled();
if($enabled) {
$hide_spell = 0;
}
else
{
$hide_spell = 1;
}
$pacc = $spell->isPremium();
if($pacc) {
$pacc = 'yes';
}
else
{
$pacc = 'no';
}
$type = 'conjure';
$count = $spell->getConjureCount();
try { $SQL->query('INSERT INTO '.$SQL->tableName('z_spells').' (name, spell, spell_type, mana, lvl, mlvl, soul, pacc, vocations, conj_count, hide_spell) VALUES ('.$SQL->quote($name).', '.$SQL->quote($spell_txt).', \''.$type.'\', \''.$mana.'\', \''.$lvl.'\', \''.$mlvl.'\', \''.$soul.'\', \''.$pacc.'\', '.$SQL->quote($vocations_to_db).', \''.$count.'\', \''.$hide_spell.'\')'); } catch(PDOException $error) {}
$main_content .= "Added: ".$name."<br>";
}
//add instant spells
$instantlist = $allspells->getInstantsList();
$main_content .= "<h3>Instant:</h3>";
foreach($instantlist as $spellname) {
$spell = $allspells->getInstant($spellname);
$lvl = $spell->getLevel();
$mlvl = $spell->getMagicLevel();
$mana = $spell->getMana();
$name = $spell->getName();
$soul = $spell->getSoul();
$spell_txt = $spell->getWords();
$vocations = $spell->getVocations();
$nr_of_vocations = count($vocations);
$vocations_to_db = "";
$voc_nr = 0;
foreach($vocations as $vocation_to_add_name) {
$vocations_to_db .= $vocations_ids[$vocation_to_add_name];
$voc_nr++;
if($voc_nr != $nr_of_vocations) {
$vocations_to_db .= ',';
}
}
$enabled = $spell->isEnabled();
if($enabled) {
$hide_spell = 0;
}
else
{
$hide_spell = 1;
}
$pacc = $spell->isPremium();
if($pacc) {
$pacc = 'yes';
}
else
{
$pacc = 'no';
}
$type = 'instant';
$count = 0;
try { $SQL->query('INSERT INTO z_spells (name, spell, spell_type, mana, lvl, mlvl, soul, pacc, vocations, conj_count, hide_spell) VALUES ('.$SQL->quote($name).', '.$SQL->quote($spell_txt).', \''.$type.'\', \''.$mana.'\', \''.$lvl.'\', \''.$mlvl.'\', \''.$soul.'\', \''.$pacc.'\', '.$SQL->quote($vocations_to_db).', \''.$count.'\', \''.$hide_spell.'\')'); } catch(PDOException $error) {}
$main_content .= "Added: ".$name."<br/>";
}
$main_content .= '<center><form action="index.php?subtopic=adminpanel" METHOD=post><div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif);" ></div><input class="ButtonText" type="image" name="Back" alt="Back" src="'.$layout_name.'/images/buttons/_sbutton_back.gif" ></div></div></form></center>';
}

//VOCATIONS INSTALL
if($action == "install_vocations") {

if($_REQUEST['todo'] == '') {
//zaladowac profesje z vocations.xml i wyswietlic tabele danych do edycji
$vocations_xml = $ots->loadVocations($config['site']['server_path'].$config['site']['vocationXML_file_subdir']);
$vocations_xml_list = $ots->getVocationsList();
$voc_number = count($vocations_xml_list);
if($voc_number > 0) {
$main_content .= '<form action="index.php?subtopic=adminpanel&action=install_vocations&todo=savevocs" method=POST><TABLE BORDER=0 CELLSPACING=1 CELLPADDING=4 WIDTH=100%><TR bgcolor="'.$config['site']['darkborder'].'"><TD>ID</TD><TD>Vocation</TD><TD>Char to copy</TD><TD>Add to<br/>\'create character\' list?</TD><TD>Short name<br/>of Vocation</TD></TR>';
$voc_id = 0;
foreach($vocations_xml_list as $vocation) {
//wyswietlanie tabeli
if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['lightborder']; } else { $bgcolor = $config['site']['darkborder']; } $number_of_rows++;
$main_content .= '<TR bgcolor="'.$bgcolor.'"><TD>'.$voc_id.'</TD><TD><input type="text" name="vocation_name'.$voc_id.'" value="'.$vocation.'" readonly="readonly"></TD><TD><input type="text" name="vocation_char'.$voc_id.'" value="'.$config['char_vocations'][$vocation].'"></TD><TD><input type="checkbox" name="save_char'.$voc_id.'" value="yes"></TD><TD><input type="text" name="vocation_short'.$voc_id.'" value="'.$config_vocations_short[$voc_id].'"></TD></TR>';
$voc_id++;
}
if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['lightborder']; } else { $bgcolor = $config['site']['darkborder']; } $number_of_rows++;
$main_content .= '<TR><TD></TD><TD></TD><TD></TD><TD></TD><TD><input type="submit" value="Save All"></TD></TR></TABLE></form>';
$main_content .= '<center><form action="index.php?subtopic=adminpanel" METHOD=post><div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif);" ></div><input class="ButtonText" type="image" name="Back" alt="Back" src="'.$layout_name.'/images/buttons/_sbutton_back.gif" ></div></div></form></center>';
}
else
{
$main_content .= 'Can\'t load vocations from: <b>'.$config['site']['server_path'].$config['site']['vocationXML_file_subdir'].'</b>';
$main_content .= '<center><form action="index.php?subtopic=adminpanel" METHOD=post><div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif);" ></div><input class="ButtonText" type="image" name="Back" alt="Back" src="'.$layout_name.'/images/buttons/_sbutton_back.gif" ></div></div></form></center>';
}
}
if($_REQUEST['todo'] == 'savevocs') {
$vocations_xml = $ots->loadVocations($config['site']['server_path'].$config['site']['vocationXML_file_subdir']);
$vocations_xml_list = $ots->getVocationsList();
$voc_number = count($vocations_xml_list);
if($voc_number > 0) {
$voc_id = 0;
$chars_to_create_nr = 0;
foreach($vocations_xml_list as $vocation) {
$new_vocations_list[$voc_id] = $vocation;
$new_vocations_short_list[$voc_id] = $_REQUEST['vocation_short'.$voc_id];
if($_REQUEST['save_char'.$voc_id] == 'yes') {
$new_char_vocations_list[$chars_to_create_nr]['0'] = $vocation;
$new_char_vocations_list[$chars_to_create_nr]['1'] = $_REQUEST['vocation_char'.$voc_id];
$chars_to_create_nr++;
$rook_char = $_REQUEST['vocation_char'.$voc_id];
$added_to_create .= '<br>'.$vocation.' (char: <b>'.$_REQUEST['vocation_char'.$voc_id].'</b>)';
}
$voc_id++;
}
foreach($new_char_vocations_list as $new_char_voc) {
$add_vocation_to_char_list[] = $new_char_voc['0'].','.$new_char_voc['1'];
}
$config['site']['char_vocations'] = implode(':', $add_vocation_to_char_list);
$config['site']['vocations_list'] = implode(',', $new_vocations_list);
$config['site']['vocations_short_list'] = implode(',', $new_vocations_short_list);
if($chars_to_create_nr == 1) {
$config['site']['char_type'] = 'rook';
$config['site']['char_rook_name'] = $rook_char;
}
elseif($chars_to_create_nr > 1)
{
$config['site']['char_type'] = 'main';
}
}
saveconfig_ini($config['site']);
$main_content .= '<h3>New vocations configuration saved.</h3>Loaded <b>'.$voc_number.'</b> vocations.<br/>Vocations on \'create character\' list:'.$added_to_create;
$main_content .= '<br/><center><form action="index.php?subtopic=adminpanel" METHOD=post><div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif);" ></div><input class="ButtonText" type="image" name="Back" alt="Back" src="'.$layout_name.'/images/buttons/_sbutton_back.gif" ></div></div></form></center>';
}
}
//CONFIG TOWNS
if($action == "edit_towns")
{
	if($_REQUEST['todo'] == 'delete')
	{
		$delete_id = $_REQUEST['id'];
		foreach($towns_list as $town_id => $town_name) {
			if($delete_id == $town_id)
			{
				unset($towns_list[$town_id]);
				$main_content .= 'Deleted city: <b>'.$town_name.'</b><br>';
			}
			else
			$towns_array[] = $town_id.','.$town_name;
		}
		$config['site']['towns_list'] = implode(":", $towns_array);
		saveconfig_ini($config['site']);
	}
	elseif($_REQUEST['todo'] == 'add')
	{
		$add_town_id = (int) $_REQUEST['id'];
		$add_town_name = stripslashes($_REQUEST['town_name']);
		foreach($towns_list as $town_id => $town_name) {
			if($delete_id == $town_id)
				unset($towns_list[$town_id]);
		}
		foreach($towns_list as $town_id => $town_name) {
			$towns_array[] = $town_id.','.$town_name;
		}
		$towns_array[] = $add_town_id.','.str_replace(",", " ", $add_town_name);
		$main_content .= 'Added city: <b>'.$add_town_name.'</b><br>';
		$config['site']['towns_list'] = implode(":", $towns_array);
		saveconfig_ini($config['site']);
	}
	foreach(explode(":", $config['site']['towns_list']) as $value) {
		$add_town = explode(",", $value);
		$towns_list[$add_town['0']] = $add_town['1'];
	}
	$main_content .= 'Here you can edit list of towns on OTS.<BR>
					<FORM ACTION="index.php?subtopic=adminpanel&action=edit_towns&todo=add" METHOD=post>
					<TABLE CELLSPACING=1 CELLPADDING=4 BORDER=0 WIDTH=100%>
					<TR><TD BGCOLOR="'.$config['site']['vdarkborder'].'" CLASS=white><B>List of towns on OTS</B></TD></TR>
					<TR><TD BGCOLOR="'.$config['site']['darkborder'].'">';
		foreach($towns_list as $town_id => $town_name)
					$main_content .= '<INPUT TYPE=text NAME="'.$town_id.'1zx2" VALUE="'.$town_id.'" SIZE="2" readonly="readonly"><INPUT TYPE=text NAME="'.$town_name.'1zx2" VALUE="'.$town_name.'" SIZE="30" readonly="readonly"><a href="index.php?subtopic=adminpanel&action=edit_towns&todo=delete&id='.$town_id.'">DELETE TOWN</a><BR>';
					$main_content .= '<INPUT TYPE=text NAME="id" VALUE="" SIZE="2"><INPUT TYPE=text NAME="town_name" VALUE="" SIZE="30"><INPUT TYPE="submit" value="ADD TOWN"></TD></TR>
					</TABLE>
					</FORM>';
	$main_content .= '<br/><center><form action="index.php?subtopic=adminpanel" METHOD=post><div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif);" ></div><input class="ButtonText" type="image" name="Back" alt="Back" src="'.$layout_name.'/images/buttons/_sbutton_back.gif" ></div></div></form></center>';
}

}
else
{
$main_content .= 'You don\'t have admin access.';
$main_content .= '<center><form action="index.php" METHOD=post><div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif);" ></div><input class="ButtonText" type="image" name="Back" alt="Back" src="'.$layout_name.'/images/buttons/_sbutton_back.gif" ></div></div></form></center>';
}
?>