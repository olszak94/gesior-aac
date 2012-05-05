<?PHP
##-- world --##
$houses_world = (int) $_POST['world'];
if(count($config['site']['worlds']) > 1)
{
	$colspan = 4;
	foreach($config['site']['worlds'] as $world_idd => $world_names)
	{
		if($world_idd == $houses_world)
		{
			$world_id = $world_idd;
			$world_name = $world_names;
		}
	}
}
if(!isset($world_id))
{
	$colspan = 3;
	$world_id = 0;
	$world_name = $config['server']['serverName'];
}
##-- town --##
$houses_town = (int) $_POST['town'];
if(count($towns_list[$world_id]) > 0)
{
	foreach($towns_list[$world_id] as $town_ids => $town_names)
	{
		if($town_ids == $houses_town)
		{
			$town_id = $town_ids;
			$town_name = $town_names;
		}
	}
}
##-- owner --##
$houses_owner = (int) $_POST['owner'];
if($houses_owner == 0)
{
	$owner_sql = '';
}
elseif($houses_owner == 1)
{
	$owner_sql = ' AND owner = 0';
}
elseif($houses_owner == 2)
{
	$owner_sql = ' AND owner > 0';
}
##-- order --##
$houses_order = (int) $_POST['order'];
if($houses_order == 0)
{
	$order_sql = 'name';
}
elseif($houses_order == 1)
{
	$order_sql = 'size';
}
elseif($houses_order == 2)
{
	$order_sql = 'rent';
}
##-- status --##
$houses_status = (int) $_POST['status'];
if($houses_status == 0)
{
	$status_sql = ' AND guild = 0';
	$status_name = 'Houses and Flats';
}
elseif($houses_status == 1)
{
	$status_sql = ' AND guild = 1';
	$status_name = 'Guildhalls';
}
##-- List Houses --##
$id = (int) $_GET['show'];
if(empty($id))
{
	$main_content .= 'Here you can see the list of all available houses, flats or guildhall. Click on any view button to get more information about a house or adjust the search criteria and start a new search.<br><br>';
	if($houses_town > 0)
	{
		$main_content .= '<table border=0 cellspacing=1 cellpadding=4 width=100%>
			<tr bgcolor="'.$config['site']['vdarkborder'].'" class=white>
				<td colspan=5><b>Available '.$status_name.' in '.$town_name.' on '.$world_name.'</b></td>
			</tr>
			<tr bgcolor="'.$config['site']['darkborder'].'">
				<td width=24%><b>Name</b></td><td width=11%><b>Size</b></td><td width=15%><b>Rent</b></td><td width=30%><b>Status</b></td><td width=20%></td>
			</tr>';
			$houses_sql = $SQL->query('SELECT * FROM houses WHERE world_id = '.$world_id.' AND town = '.$town_id.''.$owner_sql.''.$status_sql.' ORDER BY '.$order_sql.' DESC')->fetchAll();
			$counter = 0;
			foreach($houses_sql as $house)
			{
				if(is_int($counter / 2))
					$bgcolor = $config['site']['lightborder'];
				else
					$bgcolor = $config['site']['darkborder'];
				$counter++;
				if($house['owner'] == 0)
				{
					$owner = 'Empty';
				}
				elseif($house['owner'] > 0)
				{
					$player = $ots->createObject('Player');
					$player->load($house['owner']);
					$owner = 'Rented by <a href="?subtopic=characters&name='.urlencode($player->getName()).'">'.$player->getName().'</a>';
				}
				$main_content .= '<tr bgcolor="'.$bgcolor.'">
					<td>'.$house['name'].'</td>
					<td>'.$house['size'].' sqm</td>
					<td>'.$house['rent'].' gold</td>
					<td>'.$owner.'</td>
					<td><a href="index.php?subtopic=houses&show='.$house['id'].'"><image src="'.$layout_name.'/images/buttons/sbutton_view.gif"</a></td>
				</tr>';
			}
		$main_content .= '</table><br>';
	}
	$main_content .= '<form action="?subtopic=houses" method="post">
		<table border=0 cellspacing=1 cellpadding=4 width=100%>
			<tr bgcolor="'.$config['site']['vdarkborder'].'" class=white>
				<td colspan='.$colspan.'><b>House Search</b></td>
			</tr>
			<tr bgcolor="'.$config['site']['darkborder'].'">';
				if(count($config['site']['worlds']) > 1)
					$main_content .= '<td width=25%><b>World</b></td>';
				$main_content .= '<td width=25%><b>Town</b></td>
				<td width=25%><b>Status</b>
				</td><td width=25%><b>Order</b></td>
			</tr>
			<tr bgcolor="'.$config['site']['darkborder'].'">';
				if(count($config['site']['worlds']) > 1)
				{
					$main_content .= '<td valign=top rowspan=2><select name="world"><option value="">(choose world)</option>';
						foreach($config['site']['worlds'] as $id => $world_n)
						{
							$main_content .= '<option value="'.$id.'" ';
							if($houses_world == $id)
								$main_content .= 'SELECTED';
							$main_content .= '>'.$world_n.'</option>';
						}
					$main_content .= '</select></td>';
				}
				$main_content .= '<td valign=top rowspan=2>';
					foreach($towns_list[$world_id] as $id => $town_n)
					{
						$main_content .= '<input type="radio" name="town" value="'.$id.'" ';
						if($houses_town == $id)
							$main_content .= 'checked="checked" ';
						$main_content .= '>'.$town_n.'<br>';
					}
				$main_content .= '</td>
				<td valign=top>
					<input type="radio" name="owner" value="0" ';
					if($houses_owner == 0)
						$main_content .= 'checked="checked" ';
					$main_content .= '>all states<br>
					<input type="radio" name="owner" value="1" ';
					if($houses_owner == 1)
						$main_content .= 'checked="checked" ';
					$main_content .= '>empty<br>
					<input type="radio" name="owner" value="2" ';
					if($houses_owner == 2)
						$main_content .= 'checked="checked" ';
					$main_content .= '>rented<br>
				</td>
				<td valign=top rowspan=2>
					<input type="radio" name="order" value="0" ';
					if($houses_order == 0)
						$main_content .= 'checked="checked" ';
					$main_content .= '>by name<br>
					<input type="radio" name="order" value="1" ';
					if($houses_order == 1)
						$main_content .= 'checked="checked" ';
					$main_content .= '>by size<br>
					<input type="radio" name="order" value="2" ';
					if($houses_order == 2)
						$main_content .= 'checked="checked" ';
					$main_content .= '>by rent<br>
				</td>
			</tr>
			<tr bgcolor="'.$config['site']['darkborder'].'">
				<td valign=top>
					<input type="radio" name="status" value="0" ';
					if($houses_status == 0)
						$main_content .= 'checked="checked" ';
					$main_content .= '>houses and flats<br>';
					if($config['server']['guildHalls'] == true)
					{
						$main_content .= '<input type="radio" name="status" value="1" ';
						if($houses_status == 1)
							$main_content .= 'checked="checked" ';
						$main_content .= '>guildhalls<br>';
					}
					$main_content .= '
				</td>
			</tr>
			<tr>
				<td colspan='.$colspan.'><br><center><input type=image name="Submit" alt="Submit" src="'.$layout_name.'/images/buttons/sbutton_submit.gif" BORDER=0 WIDTH=120 HEIGHT=18></center></td>
			</tr>
		</table>
	</form>';
}
##-- Show House --##
else
{
	$house = $SQL->query('SELECT * FROM houses WHERE id = '.$id.'')->fetch();
	if($house['doors'] == 0)
		$door = '1 door';
	else
		$door = $house['doors'] + 1 .' doors';
	if($house['beds'] == 0)
		$bed = '1 bed';
	else
		$bed = $house['beds'].' beds';
	if($house['owner'] > 0)
	{
		$player = $ots->createObject('Player');
		$player->load($house['owner']);
		if($house['paid'] > 0)
			$paid = ' and paid until <b>Feb 08 2011, 23:58:43'.date("M j Y, H:i:s", $house['paid']).' CET</b>';
		$owner = '<br>The house is currently rented by <a href="?subtopic=characters&name='.urlencode($player->getName()).'">'.$player->getName().'</a>'.$paid.'.';
	}
	$main_content .= '<table border=0 cellspacing=1 cellpadding=4 width=100%>
		<tr>
			<td></td>
			<td>
				<b>'.$house['name'].'</b><br><br>
				This house is located in <b>'.$towns_list[$house['world_id']][$house['town']].'</b>.<br>
				It has '.$door.' and '.$bed.' on size of <b>'.$house['size'].' square meters</b>.<br>
				The weekly rent is <b>'.$house['rent'].' gold</b> and will be debited to the bank account on <b>'.$world_name.'</b>.<br>
				'.$owner.'
			</td>
		</tr>
		<tr>
			<td colspan=2></td>
		</tr>
	</table>';
}
?>
