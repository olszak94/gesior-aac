<?php  
    if($groups = simplexml_load_file($config['site']['server_path'].'/data/XML/groups.xml') or die('<b>Could not load groups!</b>'))  
        foreach($groups->group as $g)    
            $groupList[(int)$g['id']] = $g['name'];  
    $list = $SQL->query("SELECT `name`, `online`, `group_id`, `world_id`, `account_id` FROM `players` WHERE `group_id` > 1 ORDER BY `group_id` DESC"); 
    $showed_players = 0; 
    $main_content .= '<center><h2>Support in game</h2></center>';  
    $group_id = 0; 
    foreach($list as $gm) 
    { 
        if($group_id != (int)$gm['group_id'])  
        {  
            if($group_id != 0)  
                $main_content .= '</table>';  
            $main_content .= '<center><h2>'.$groupList[(int)$gm['group_id']].'</h2></center>
				<table border="0" cellspacing="1" cellpadding="4" width="100%"> 
				<tr bgcolor="'.$config['site']['vdarkborder'].'"> 
					<td width="75%"><font class=white><b>Name</b></font></td> 
					<td width="15%"><font class=white><b>Status</b></font></td> 
					<td width="20%"><font class=white><b>World</b></font></td>';  
            $group_id = (int)$gm['group_id'];  
        }
		if($config['site']['show_flag'])
		{
			$account = $SQL->query('SELECT * FROM `accounts` WHERE '.$SQL->fieldName('id').' = '.$gm['account_id'].'')->fetch();
			$flag = '<image src="http://images.boardhost.com/flags/'.$account['flag'].'.png"/> ';
		}
        $main_content .= '<tr bgcolor="'.(is_int($showed_players++ / 2) ? $config['site']['darkborder'] : $config['site']['lightborder']).'" class="over"><td>'.$flag.'<a href="?subtopic=characters&name='.urlencode($gm['name']).'">'.$gm['name'].'</a></td><td><font color="'.($gm['online'] == 0 ? 'red">Offline' : 'green">Online').'</font></td><td>'.$config['site']['worlds'][$gm['world_id']].'</td></tr>';  
    }  
    $main_content .= '</table>';
?>