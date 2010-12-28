<?PHP
$list = $_REQUEST['list'];
$page = $_REQUEST['page'];

switch($list){
  case "fist":
   $id = 0;
   $list_name = 'Fist Fighting';
   break;
  case "club":
   $id = 1;
   $list_name = 'Club Fighting';
   break;
  case "sword":
   $id = 2;
   $list_name = 'Sword Fighting';
   break;
  case "axe":
   $id = 3;
   $list_name = 'Axe Fighting';
   break;
  case "distance":
   $id = 4;
   $list_name = 'Distance Fighting';
   break;
  case "shield":
   $id = 5;
   $list_name = 'Shielding';
   break;
  case "fishing":
   $id = 6;
   $list_name = 'Fishing';
   break;
}
$offset = $page * 100;
//jesli chodzi o skilla
if(isset($id)) {
$skills = $SQL->query('SELECT name,value FROM players,player_skills WHERE group_id < '.$config['site']['players_group_id_block'].' AND players.id = player_skills.player_id AND player_skills.skillid = '.$id.' ORDER BY value DESC, count DESC LIMIT 101 OFFSET '.$offset);
}
else
{
//jesli chodzi o level lub mlvl
if($list == "magic") {
$list_name = 'Magic Level';
$skills = $SQL->query('SELECT name,maglevel FROM players WHERE group_id < '.$config['site']['players_group_id_block'].' AND name != "Account Manager" ORDER BY maglevel DESC, manaspent DESC LIMIT 101 OFFSET '.$offset);
}
else
{
$skills = $SQL->query('SELECT name,level,experience FROM players WHERE group_id < '.$config['site']['players_group_id_block'].' AND name != "Account Manager" ORDER BY level DESC, experience DESC LIMIT 101 OFFSET '.$offset);
$list_name = 'Experience';
$list = 'experience';
}
}
//wyswietlanie wszystkiego
$main_content .= '<TABLE BORDER=0 CELLPADDING=0 CELLSPACING=0 WIDTH=100%><TR><TD><IMG SRC="'.$layout_name.'/images/general/blank.gif" WIDTH=10 HEIGHT=1 BORDER=0></TD><TD><CENTER><H2>Ranking for '.$list_name.' on '.$config['server']['serverName'].'</H2></CENTER><BR><TABLE BORDER=0 CELLPADDING=4 CELLSPACING=1 WIDTH=100%></TABLE><TABLE BORDER=0 CELLPADDING=4 CELLSPACING=1 WIDTH=100%><TR BGCOLOR="'.$config['site']['vdarkborder'].'"><TD WIDTH=10% CLASS=whites><B>Rank</B></TD><TD WIDTH=75% CLASS=whites><B>Name</B></TD><TD WIDTH=15% CLASS=whites><b><center>Level</center></B></TD>';
if($list == "experience") {
$main_content .= '<TD CLASS=whites><b><center>Points</center></B></TD>';
}
$main_content .= '</TR><TR>';
foreach($skills as $skill)  {
if($number_of_rows < 100) {
if($list == "magic") {
$skill['value'] = $skill['maglevel'];
}
if($list == "experience") {
$skill['value'] = $skill['level'];
}
if(!is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['lightborder']; } $number_of_rows++;
$main_content .= '<tr bgcolor="'.$bgcolor.'"><td>'.($offset + $number_of_rows).'.</td><td><a href="index.php?subtopic=characters&name='.$skill['name'].'">'.$skill['name'].'</a></td><td><center>'.$skill['value'].'</center></td>';
if($list == "experience") {
$main_content .= '<td><center>'.$skill['experience'].'</center></td>';
}
$main_content .= '</tr>';
}
else
{
$show_link_to_next_page = TRUE;
}
}
$main_content .= '</TABLE><TABLE BORDER=0 CELLPADDING=4 CELLSPACING=1 WIDTH=100%>';
//link to previous page if actual page isn't first
if($page > 0) {
$main_content .= '<TR><TD WIDTH=100% ALIGN=right VALIGN=bottom><A HREF="index.php?subtopic=highscores&list='.$list.'&page='.($page - 1).'" CLASS="size_xxs">Previous Page</A></TD></TR>';
}
//link to next page if any result will be on next page
if($show_link_to_next_page) {
$main_content .= '<TR><TD WIDTH=100% ALIGN=right VALIGN=bottom><A HREF="index.php?subtopic=highscores&list='.$list.'&page='.($page + 1).'" CLASS="size_xxs">Next Page</A></TD></TR>';
}
//end of page
$main_content .= '</TABLE></TD><TD WIDTH=5%><IMG SRC="'.$layout_name.'/images/general/blank.gif" WIDTH=1 HEIGHT=1 BORDER=0></TD><TD WIDTH=15% VALIGN=top ALIGN=right><TABLE BORDER=0 CELLPADDING=4 CELLSPACING=1><TR BGCOLOR="'.$config['site']['vdarkborder'].'"><TD CLASS=whites><B>Choose a skill</B></TD></TR><TR BGCOLOR="'.$config['site']['lightborder'].'"><TD><A HREF="index.php?subtopic=highscores&list=experience" CLASS="size_xs">Experience</A><BR><A HREF="index.php?subtopic=highscores&list=magic" CLASS="size_xs">Magic</A><BR><A HREF="index.php?subtopic=highscores&list=shield" CLASS="size_xs">Shielding</A><BR><A HREF="index.php?subtopic=highscores&list=distance" CLASS="size_xs">Distance</A><BR><A HREF="index.php?subtopic=highscores&list=club" CLASS="size_xs">Club</A><BR><A HREF="index.php?subtopic=highscores&list=sword" CLASS="size_xs">Sword</A><BR><A HREF="index.php?subtopic=highscores&list=axe" CLASS="size_xs">Axe</A><BR><A HREF="index.php?subtopic=highscores&list=fist" CLASS="size_xs">Fist</A><BR><A HREF="index.php?subtopic=highscores&list=fishing" CLASS="size_xs">Fishing</A><BR></TD></TR></TABLE></TD><TD><IMG SRC="'.$layout_name.'/images/general/blank.gif" WIDTH=10 HEIGHT=1 BORDER=0></TD></TR></TABLE>';

?>