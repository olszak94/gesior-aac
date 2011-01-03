<?PHP
	foreach($config['site']['worlds'] as $idd => $world_n)
	{
		if($idd == (int) $_REQUEST['world'])
		{
			$world_id = $idd;
			$world_name = $world_n;
		}
	}
	if(!isset($world_id))
	{
		$world_id = 0;
		$world_name = $config['server']['serverName'];
	}
	$main_content .= '<TABLE BORDER=0 CELLPADDING=0 CELLSPACING=0 WIDTH=100%><TR><TD></TD><TD>
	<FORM ACTION="" METHOD=get><INPUT TYPE=hidden NAME=subtopic VALUE=houses><TABLE WIDTH=100% BORDER=0 CELLSPACING=1 CELLPADDING=4><TR><TD BGCOLOR="'.$config['site']['vdarkborder'].'" CLASS=white><B>World Selection</B></TD></TR><TR><TD BGCOLOR="'.$config['site']['darkborder'].'">
    <TABLE BORDER=0 CELLPADDING=1><TR><TD>World: </TD><TD><INPUT TYPE=hidden NAME=subtopic VALUE=houses><SELECT SIZE="1" NAME="world"><OPTION VALUE="" SELECTED>(choose world)</OPTION>';
	foreach($config['site']['worlds'] as $id => $world_n)
	{
		$main_content .= '<OPTION VALUE="'.$id.'">'.$world_n.'</OPTION>';
	}
	$main_content .= '</SELECT> </TD><td><INPUT TYPE=image NAME="Submit" ALT="Submit" SRC="'.$layout_name.'/images/buttons/sbutton_submit.gif">
    </TD></TR></TABLE></TABLE></FORM></TABLE>';
	//###### SHOW LIST HOUSE
	$server = parse_ini_file($config['site']['server_path'].'config.lua');
	$id = (int) $_GET['id'];
	$auc = $_GET['auc'];
	$houses_list = new OTS_HousesList($config['site']['server_path'].'data\world\forgotten-house.xml');
	if ((empty($id) || !$houses_list->hasHouseId($id)) && !isset($auc))
	{
		$house_query = $SQL->query('SELECT * FROM houses WHERE owner = 0 AND world_id = '.$world_id.' ORDER BY price DESC')->fetchAll();
		$counter = 0;
		foreach($house_query as $house)
		{
			if(is_int($counter / 2))
				$bgcolor = $config['site']['lightborder'];
			else
				$bgcolor = $config['site']['darkborder'];
			$counter++;
			$house_town = !empty($towns_list[''.$house['world_id'].''][''.$house['town'].'']) ? $towns_list[''.$house['world_id'].''][''.$house['town'].''] : 'Unnamed';
			$house_name = !empty($house['name']) ? $house['name'] : 'No name House '.$counter;
			$houses .= '<tr bgcolor="'.$bgcolor.'">
				<td width="100">'.$house_town.'</td>
				<td width="170">'.$house_name.'</td>
				<td width="90">'.$house['size'].' sqm</td>
				<td width="170">'.$house['price'].' gols</td>
				<td width="120"><a href="index.php?subtopic=houses&id='.$house['id'].'"><image src="'.$layout_name.'/images/buttons/sbutton_view.gif"</a></td>
			</tr>';    
		}
	$main_content .= '<table border=0 cellspacing=1 cellpadding=4 width=100%>
	<tr bgcolor="'.$config['site']['vdarkborder'].'">
		<td class=white colspan=5><b>Houses and Flats in '.$town_name.' on '.$world_name.'</b></td>
	</tr>
	<tr bgcolor="'.$config['site']['darkborder'].'">
		<td width="100"><b>Town</b></td>
		<td width="170"><b>Name</b></td>
		<td width="90"><b>Size</b></td>
		<td width="170"><b>Price</b></td>
		<td width="100"></td>
	</tr>'.$houses.'</table>';
	}
?>