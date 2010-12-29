<?PHP
if($action == "") {
$allowed_order_by = array('name', 'spell', 'spell_type', 'mana', 'lvl', 'mlvl', 'soul');
$vocation_id = (int) $_REQUEST['vocation_id'];
$order = $_REQUEST['order'];
if(in_array($order, $allowed_order_by)) {
$orderby = $order;
}
else
{
$orderby = 'lvl';
}
$spells = $SQL->query('SELECT * FROM z_spells WHERE hide_spell != 1 ORDER BY '.$orderby.', lvl');
$main_content .= '<FORM ACTION="index.php?subtopic=spells" METHOD=post>
<TABLE BORDER=0 CELLSPACING=1 CELLPADDING=4 WIDTH=100%>
<TR BGCOLOR='.$config['site']['vdarkborder'].'><TD CLASS=white><B>Spell Search</B></TD></TR>
<TR BGCOLOR='.$config['site']['darkborder'].'><TD>Only for vocation: <SELECT NAME="vocation_id">';
$main_content .= '<OPTION VALUE="All" ';
if('All' == $vocation_id) {
$main_content .= 'SELECTED';
}
$main_content .= '>All';
foreach($config_vocations as $id => $vocation) {
$main_content .= '<OPTION VALUE="'.$id.'" ';
if($id == $vocation_id && $vocation_id != "All" && $vocation_id != '') {
$main_content .= 'SELECTED';
}
$main_content .= '>'.$vocation;
}
$main_content .= '</SELECT><input type="hidden" name="order" value="'.$orderby.'">&nbsp;&nbsp;&nbsp;<INPUT TYPE=image NAME="Submit" ALT="Submit" SRC="'.$layout_name.'/images/buttons/sbutton_submit.gif" BORDER=0 WIDTH=120 HEIGHT=18></TD><TR>
</TABLE></FORM>';
$main_content .= '<TABLE BORDER=0 CELLSPACING=1 CELLPADDING=4 WIDTH=100%><TR BGCOLOR='.$config['site']['vdarkborder'].'><TD CLASS=white><B><a href="index.php?subtopic=spells&vocation_id='.$vocation_id.'&order=name"><font CLASS=white>Name</a></B></TD><TD CLASS=white><B><a href="index.php?subtopic=spells&vocation_id='.$vocation_id.'&order=spell"><font CLASS=white>Sentence</a></B></TD><TD CLASS=white><B><a href="index.php?subtopic=spells&vocation_id='.$vocation_id.'&order=spell_type"><font CLASS=white>Type<br/>(count)</a></B></TD><TD CLASS=white><B><a href="index.php?subtopic=spells&vocation_id='.$vocation_id.'&order=mana"><font CLASS=white>Mana</a></B></TD><TD CLASS=white><B><a href="index.php?subtopic=spells&vocation_id='.$vocation_id.'&order=lvl"><font CLASS=white>Exp.<br/>Level</a></B></TD><TD CLASS=white><B><a href="index.php?subtopic=spells&vocation_id='.$vocation_id.'&order=mlvl"><font CLASS=white>Magic<br/>Level</a></B></TD><TD CLASS=white><B><a href="index.php?subtopic=spells&vocation_id='.$vocation_id.'&order=soul"><font CLASS=white>Soul</a></B></TD><TD CLASS=white><B>PACC</B></TD><TD CLASS=white><B>For<br/>Vocations:</B></TD></TR>';
if(isset($vocation_id) && $vocation_id != 'All' && $vocation_id != '') {
foreach($spells as $spell) {
$spell_vocations = explode(",", $spell['vocations']);
if(in_array($vocation_id, $spell_vocations) || empty($spell['vocations'])) {
if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['lightborder']; } else { $bgcolor = $config['site']['darkborder']; } $number_of_rows++;
$main_content .= '<TR BGCOLOR="'.$bgcolor.'"><TD>'.$spell['name'].'</TD><TD>'.$spell['spell'].'</TD>';
if($spell['spell_type'] == 'conjure') {
$main_content .= '<TD>'.$spell['spell_type'].'('.$spell['conj_count'].')</TD>';
}
else
{
$main_content .= '<TD>'.$spell['spell_type'].'</TD>';
}
$main_content .= '<TD>'.$spell['mana'].'</TD><TD>'.$spell['lvl'].'</TD><TD>'.$spell['mlvl'].'</TD><TD>'.$spell['soul'].'</TD><TD>'.$spell['pacc'].'</TD><TD>'.$config_vocations[$vocation_id].'</TD></TR>';
}
}
}
else
{
foreach($spells as $spell) {
$spell_vocations = explode(",", $spell['vocations']);
if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['lightborder']; } else { $bgcolor = $config['site']['darkborder']; } $number_of_rows++;
$main_content .= '<TR BGCOLOR="'.$bgcolor.'"><TD>'.$spell['name'].'</TD><TD>'.$spell['spell'].'</TD>';
if($spell['spell_type'] == 'conjure') {
$main_content .= '<TD>'.$spell['spell_type'].'('.$spell['conj_count'].')</TD>';
}
else
{
$main_content .= '<TD>'.$spell['spell_type'].'</TD>';
}
$main_content .= '<TD>'.$spell['mana'].'</TD><TD>'.$spell['lvl'].'</TD><TD>'.$spell['mlvl'].'</TD><TD>'.$spell['soul'].'</TD><TD>'.$spell['pacc'].'</TD><TD><font size="1">';
//wyswietla liste wszystkich dostepnych profesji
$showed_vocations = 0;
foreach($spell_vocations as $spell_vocation) {
$main_content .= $config_vocations[$spell_vocation];
$showed_vocations++;
if($showed_vocations != count($spell_vocations)) {
$main_content .= '<br/>';
}
}

$main_content .= '</font></TD></TR>';
}
}

$main_content .= '</TABLE>';
}
?>