<?PHP
// ###################### CONFIG ########################
//load page config file
$config['site'] = parse_ini_file('config/config.ini');
//check install
if($config['site']['install'] != "no") {
	header("Location: install.php");
	exit;
}
//parse data from page config file
$vocations_from_config = explode(":", $config['site']['char_vocations']);
foreach(explode(":", $config['site']['char_vocations']) as $value)
{
	$char_vocations_add = explode(",", $value);
	$config['char_vocations'][$char_vocations_add['0']] = $char_vocations_add['1'];
}
if($config['site']['char_type'] != "main") {
	$config['char_vocations']['Rook'] = $config['site']['char_rook_name'];
}
foreach(explode(":", $config['site']['towns_list']) as $value)
{
	$add_town = explode(",", $value);
	$towns_list[$add_town['0']] = $add_town['1'];
}
$config_vocations = explode(",", $config['site']['vocations_list']);
$config_vocations_short = explode(",", $config['site']['vocations_short_list']);
//load server config
$config['server'] = parse_ini_file($config['site']['server_path'].'config.lua');
if(isset($config['server']['mysqlHost']))
{
	//new (0.2.6+) ots config.lua file
	$mysqlhost = $config['server']['mysqlHost'];
	$mysqluser = $config['server']['mysqlUser'];
	$mysqlpass = $config['server']['mysqlPass'];
	$mysqldatabase = $config['server']['mysqlDatabase'];
}
elseif(isset($config['server']['sqlHost']))
{
	//old (0.2.4) ots config.lua file
	$mysqlhost = $config['server']['sqlHost'];
	$mysqluser = $config['server']['sqlUser'];
	$mysqlpass = $config['server']['sqlPass'];
	$mysqldatabase = $config['server']['sqlDatabase'];
}
$sqlitefile = $config['server']['sqliteDatabase'];
$passwordency = '';
if(strtolower($config['server']['useMD5Passwords']) == 'yes' || strtolower($config['server']['passwordType']) == 'md5')
{
	$passwordency = 'md5';
}
if(strtolower($config['server']['passwordType']) == 'sha1')
{
	$passwordency = 'sha1';
}
// loads #####POT mainfile#####
include('pot/OTS.php');
// PDO and POT connects to database
$ots = POT::getInstance();
if(strtolower($config['server']['sqlType']) == "mysql")
{
	//connect to MySQL database
	try
	{
		$ots->connect(POT::DB_MYSQL, array('host' => $mysqlhost, 'user' => $mysqluser, 'password' => $mysqlpass, 'database' => $mysqldatabase) );
	}
	catch(PDOException $error)
	{
	    echo 'Database error - can\'t connect to MySQL database. Possible reasons:<br>1. MySQL server is not running on host.<br>2. MySQL user, password, database or host isn\'t configured in: <b>'.$config['site']['server_path'].'config.lua</b> .<br>3. MySQL user, password, database or host is wrong.';
		exit;
	}
}
elseif(strtolower($config['server']['sqlType']) == "sqlite")
{
	//connect to SQLite database
	$link_to_sqlitedatabase = $config['site']['server_path'].$sqlitefile;
	try
	{
		$ots->connect(POT::DB_SQLITE, array('database' => $link_to_sqlitedatabase));
	}
	catch(PDOException $error)
	{
	    echo 'Database error - can\'t open SQLite database. Possible reasons:<br><b>'.$link_to_sqlitedatabase.'</b> - file isn\'t valid SQLite database.<br><b>'.$link_to_sqlitedatabase.'</b> - doesn\'t exist.<br><font color="red">Wrong PHP configuration. Default PHP does not work with SQLite databases!</font>';
		exit;
	}
}
else
{
	echo 'Database error. Unknown database type in <b>'.$config['site']['server_path'].'config.lua</b> . Must be equal to: "<b>mysql</b>" or "<b>sqlite</b>". Now is: "<b>'.strtolower($config['server']['sqlType']).'"</b>';
	exit;
}

$SQL = POT::getInstance()->getDBHandle();
$layout_name = "layouts/".$layout_name = $config['site']['layout'];;
$layout_ini = parse_ini_file($layout_name.'/layout_config.ini');
foreach($layout_ini as $key => $value)
	$config['site'][$key] = $value;
//###################### FUNCTIONS ######################
//save config in ini file
function saveconfig_ini($config)
{
	$file = fopen("config/config.ini", "w");
	foreach($config as $param => $data)
	{
$file_data .= $param.' = "'.str_replace('"', '', $data).'"
';
	}
	rewind($file);
	fwrite($file, $file_data);
	fclose($file);
}
//return password to db
function password_ency($password) {
	$ency = $GLOBALS['passwordency'];
	if($ency == 'sha1')
		return sha1($password);
	elseif($ency == 'md5')
		return md5($password);
	elseif($ency == '')
		return $password;
}
//delete player with name
function delete_player($name) {
	$SQL = $GLOBALS['SQL'];
	$player = new OTS_Player();
	$player->find($name);
	if($player->isLoaded()) {
		try { $SQL->query("DELETE FROM player_skills WHERE player_id = '".$player->getId()."';"); } catch(PDOException $error) {}
		try { $SQL->query("DELETE FROM guild_invites WHERE player_id = '".$player->getId()."';"); } catch(PDOException $error) {}
		try { $SQL->query("DELETE FROM player_items WHERE player_id = '".$player->getId()."';"); } catch(PDOException $error) {}
		try { $SQL->query("DELETE FROM player_depotitems WHERE player_id = '".$player->getId()."';"); } catch(PDOException $error) {}
		try { $SQL->query("DELETE FROM player_spells WHERE player_id = '".$player->getId()."';"); } catch(PDOException $error) {}
		try { $SQL->query("DELETE FROM player_storage WHERE player_id = '".$player->getId()."';"); } catch(PDOException $error) {}
		try { $SQL->query("DELETE FROM player_viplist WHERE player_id = '".$player->getId()."';"); } catch(PDOException $error) {}
		try { $SQL->query("DELETE FROM player_deaths WHERE player_id = '".$player->getId()."';"); } catch(PDOException $error) {}
		try { $SQL->query("DELETE FROM player_deaths WHERE killed_by = '".str_replace("'", "\'", $player->getName())."';"); } catch(PDOException $error) {}
		$rank = $player->getRank();
		if(!empty($rank)) {
			$guild = $rank->getGuild();
			if($guild->getOwner()->getId() == $player->getId()) {
				$rank_list = $guild->getGuildRanksList();
				if(count($rank_list) > 0) {
					$rank_list->orderBy('level');
					foreach($rank_list as $rank_in_guild) {
						$players_with_rank = $rank_in_guild->getPlayersList();
						$players_with_rank->orderBy('name');
						$players_with_rank_number = count($players_with_rank);
						if($players_with_rank_number > 0) {
							foreach($players_with_rank as $player_in_guild) {
								$player_in_guild->setRank();
								$player_in_guild->save();
							}
						}
						$rank_in_guild->delete();
					}
					$guild->delete();
				}
			}
		}
		$player->delete();
		return TRUE;
	}
}

//delete account with id, nto ready
function delete_account($id) {

}

//delete guild with id
function delete_guild($id) {
	$guild = new OTS_Guild();
	$guild->load($id);
	if($guild->isLoaded()) {
		$rank_list = $guild->getGuildRanksList();
		if(count($rank_list) > 0) {
			$rank_list->orderBy('level');
			foreach($rank_list as $rank_in_guild) {
				$players_with_rank = $rank_in_guild->getPlayersList();
				if(count($players_with_rank) > 0) {
					foreach($players_with_rank as $player_in_guild) {
						$player_in_guild->setRank();
						$player_in_guild->save();
					}
				}
				$rank_in_guild->delete();
			}
		}
		$guild->delete();
		return TRUE;
	}
	else
		return FALSE;
}

//is it valid nick?
function check_name($name)//sprawdza name
{
  $temp = strspn("$name", "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM- [ ] '");
  if ($temp != strlen($name)) {
	return false;
  }
  else
  {
	$ok = "/[a-zA-Z ']{1,25}/";
	return (preg_match($ok, $name))? true: false;
  }
}

//is it valid nick for new char?
function check_name_new_char($name)//sprawdza name
{
	$name_to_check = strtolower($name);
	//first word can't be:
	//names blocked:
	$names_blocked = array('gm','cm', 'god', 'tutor');
	$first_words_blocked = array('gm ','cm ', 'god ','tutor ', "'", '-');
	//name can't contain:
	$words_blocked = array('gamemaster', 'game master', 'game-master', "game'master", '--', "''","' ", " '", '- ', ' -', "-'", "'-", 'fuck', 'sux', 'suck', 'noob', 'tutor');
	foreach($first_words_blocked as $word)
		if($word == substr($name_to_check, 0, strlen($word)))
			return false;
	if(substr($name_to_check, -1) == "'" || substr($name_to_check, -1) == "-")
		return false;
	if(substr($name_to_check, 1, 1) == ' ')
		return false;
	if(substr($name_to_check, -2, 1) == " ")
		return false;
foreach($names_blocked as $word)
	if($word == $name)
		return false;
	for($i = 0; $i < strlen($name_to_check); $i++)
		if($name_to_check[$i-1] == ' ' && $name_to_check[$i+1] == ' ')
			return false;
	foreach($words_blocked as $word)
		if (!(strpos($name_to_check, $word) === false))
			return false;
	for($i = 0; $i < strlen($name_to_check); $i++)
		if($name_to_check[$i] == $name_to_check[($i+1)] && $name_to_check[$i] == $name_to_check[($i+2)])
			return false;
	for($i = 0; $i < strlen($name_to_check); $i++)
		if($name_to_check[$i-1] == ' ' && $name_to_check[$i+1] == ' ')
			return false;
	$temp = strspn("$name", "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM- '");
	if ($temp != strlen($name))
		return false;
	else
	{
		$ok = "/[a-zA-Z ']{1,25}/";
		return (preg_match($ok, $name))? true: false;
	}
}

//is rank name valid?
function check_rank_name($name)//sprawdza name
{
  $temp = strspn("$name", "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM0123456789-[ ] ");
  if ($temp != strlen($name)) {
	return false;
  }
  else
  {
	$ok = "/[a-zA-Z ]{1,60}/";
	return (preg_match($ok, $name))? true: false;
  }
}
//is guild name valid?
function check_guild_name($name)
{
  $temp = strspn("$name", "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM0123456789- ");
  if ($temp != strlen($name)) {
	return false;
  }
  else
  {
	$ok = "/[a-zA-Z ]{1,60}/";
	return (preg_match($ok, $name))? true: false;
  }
}
//is it valid password?
function check_password($pass)//sprawdza haslo
{
  $temp = strspn("$pass", "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM1234567890");
  if ($temp != strlen($pass)) {
  return false;
  }
  else
  {
  $ok = "/[a-zA-Z0-9]{1,40}/";
  return (preg_match($ok, $pass))? true: false;
  }
}
//is it valid e-mail?
function check_mail($email)//sprawdza mail
{
  $ok = "/[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z]{2,4}/";
  return (preg_match($ok, $email))? true: false;
}

//################### DISPLAY FUNCTIONS #####################
//return shorter text (news ticker)
function short_text($text, $chars_limit) 
{
  if (strlen($text) > $chars_limit) 
    return substr($text, 0, strrpos(substr($text, 0, $chars_limit), " ")).'...';
  else return $text;
}
//return text to news msg
function news_place() {
if($GLOBALS['subtopic'] == "latestnews") {
//add tickers to site - without it tickers will not be showed
//$news .= $GLOBALS['news_content'];
/*
//featured article
$layout_name = $GLOBALS['layout_name'];
$news .= '  <div id="featuredarticle" class="Box">
    <div class="Corner-tl" style="background-image:url('.$layout_name.'/images/content/corner-tl.gif);"></div>
    <div class="Corner-tr" style="background-image:url('.$layout_name.'/images/content/corner-tr.gif);"></div>
    <div class="Border_1" style="background-image:url('.$layout_name.'/images/content/border-1.gif);"></div>
    <div class="BorderTitleText" style="background-image:url('.$layout_name.'/images/content/title-background-green.gif);"></div>
    <img class="Title" src="'.$layout_name.'/images/strings/headline-featuredarticle.gif" alt="Contentbox headline" />
    <div class="Border_2">
      <div class="Border_3">
        <div class="BoxContent" style="background-image:url('.$layout_name.'/images/content/scroll.gif);">
<div id=\'TeaserThumbnail\'><img src="'.$layout_name.'/images/news/features.jpg" width=150 height=100 border=0 alt="" /></div><div id=\'TeaserText\'><div style="position: relative; top: -2px; margin-bottom: 2px;" >
<b>Tutaj wpisz tytul</b></div>
tutaj wpisz tresc newsa<br>
zdjecie laduje sie w <i>tibiacom/images/news/features.jpg</i><br>
skad sie laduje mozesz zmienic linijke ponad komentarzem
</div>        </div>
      </div>
    </div>
    <div class="Border_1" style="background-image:url('.$layout_name.'/images/content/border-1.gif);"></div>
    <div class="CornerWrapper-b"><div class="Corner-bl" style="background-image:url('.$layout_name.'/images/content/corner-bl.gif);"></div></div>
    <div class="CornerWrapper-b"><div class="Corner-br" style="background-image:url('.$layout_name.'/images/content/corner-br.gif);"></div></div>
  </div>';
 */
}
return $news;
}
//set monster of week
function logo_monster() {
	return str_replace(" ", "", trim(mb_strtolower($GLOBALS['config']['site']['logo_monster'])));
}
$statustimeout = 1;
foreach(explode("*", str_replace(" ", "", $config['server']['statusTimeout'])) as $status_var)
	if($status_var > 0)
		$statustimeout = $statustimeout * $status_var;
$statustimeout = $statustimeout / 1000;
$config['status'] = parse_ini_file('config/serverstatus');
if($config['status']['serverStatus_lastCheck']+$statustimeout < time())
{
	$config['status']['serverStatus_checkInterval'] = $statustimeout+3;
	$config['status']['serverStatus_lastCheck'] = time();
	$info = chr(6).chr(0).chr(255).chr(255).'info';
	$sock = @fsockopen("127.0.0.1", $config['server']['statusProtocolPort'], $errno, $errstr, 1);
	if ($sock)
	{
		fwrite($sock, $info); 
		$data=''; 
		while (!feof($sock))
			$data .= fgets($sock, 1024);
		fclose($sock);
		preg_match('/players online="(\d+)" max="(\d+)"/', $data, $matches);
		$config['status']['serverStatus_online'] = 1;
		$config['status']['serverStatus_players'] = $matches[1];
		$config['status']['serverStatus_playersMax'] = $matches[2];
		preg_match('/uptime="(\d+)"/', $data, $matches);
		$h = floor($matches[1] / 3600);
		$m = floor(($matches[1] - $h*3600) / 60);
		$config['status']['serverStatus_uptime'] = $h.'h '.$m.'m';
		preg_match('/monsters total="(\d+)"/', $data, $matches);
		$config['status']['serverStatus_monsters'] = $matches[1];
	}
	else
	{
		$config['status']['serverStatus_online'] = 0;
		$config['status']['serverStatus_players'] = 0;
		$config['status']['serverStatus_playersMax'] = 0;
	}
	$file = fopen("config/serverstatus", "w");
	foreach($config['status'] as $param => $data)
	{
$file_data .= $param.' = "'.str_replace('"', '', $data).'"
';
	}
	rewind($file);
	fwrite($file, $file_data);
	fclose($file);
}

//PAGE VIEWS COUNTER :)
$views_counter = "usercounter.dat";
// checking if the file exists
if (file_exists($views_counter)) {
    // het bestand bestaat, waarde + 1
    $actie = fopen($views_counter, "r+"); 
    $page_views = fgets($actie, 9); 
    $page_views++; 
    rewind($actie); 
    fputs($actie, $page_views, 9); 
    fclose($actie); 
}
else
{ 
    // the file doesn't exist, creating a new one with value 1
    $actie = fopen($views_counter, "w"); 
    $page_views = 1; 
    fputs($actie, $page_views, 9); 
    fclose($actie); 
} 
function makeOrder($arr, $order, $default) {
    // Function by Colandus!
    $type = 'asc';
    if(isset($_GET['order'])) {
        $v = explode('_', strrev($_GET['order']), 2);
        if(count($v) == 2)
            if($orderBy = $arr[strrev($v[1])])
                $default = $orderBy;
                $type = (strrev($v[0]) == 'asc' ? 'desc' : 'asc');
    }
    
    return 'ORDER BY ' . $default . ' ' . $type;
}

function getOrder($arr, $order, $this) {
    // Function by Colandus!
    $type = 'asc';
    if($orderBy = $arr[$this])
        if(isset($_GET[$order])) {
            $v = explode('_', strrev($_GET[$order]), 2);
            if(strrev($v[1]) == $this)
                $type = (strrev($v[0]) == 'asc' ? 'desc' : 'asc');
        }
    
    return $this . '_' . $type;
}  

?>