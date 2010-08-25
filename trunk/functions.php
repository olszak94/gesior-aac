<?PHP
	##-- load file ini--##
	$config['site'] = parse_ini_file('config/config.ini');
	
	##-- config --##
	include('Config/Config.php');
	
	##-- cheak install page--##
	if($config['site']['install'] != "no")
	{
		header("Location: Install/install.php");
		exit;
	}
	
	##-- Connect server --##
	$config['server'] = parse_ini_file($config['site']['server_path'].'config.lua');
	if(isset($config['server']['mysqlHost']))
	{	##-- Connect Mysql TFS 0.2 --##
		$mysqlhost = $config['server']['mysqlHost'];
		$mysqluser = $config['server']['mysqlUser'];
		$mysqlpass = $config['server']['mysqlPass'];
		$mysqldatabase = $config['server']['mysqlDatabase'];
	}
	elseif(isset($config['server']['sqlHost']))
	{	##-- Connect Mysql TFS 0.3 and 0.4 --##
		$mysqlhost = $config['server']['sqlHost'];
		$mysqluser = $config['server']['sqlUser'];
		$mysqlpass = $config['server']['sqlPass'];
		$mysqldatabase = $config['server']['sqlDatabase'];
	}
	
	##-- encryption password --##
	$passwordency = '';
	if(strtolower($config['server']['encryptionType']) == 'md5')
		$passwordency = 'md5';
	if(strtolower($config['server']['encryptionType']) == 'sha1')
		$passwordency = 'sha1';
	
	##-- POT --##
	include('POT/OTS.php');
	
	##-- Connect MySql database --##
	$ots = POT::getInstance();
	if(strtolower($config['server']['sqlType']) == "mysql")
	{
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
	$SQL = POT::getInstance()->getDBHandle();
	
	##-- Layout connect --##
	$layout_name = "layouts/".$layout_name = $config['site']['layout'];;
	$layout_ini = parse_ini_file($layout_name.'/layout_config.ini');
	foreach($layout_ini as $key => $value)
		$config['site'][$key] = $value;
		
	####-- Functions --####
	// Return password to db
	function password_ency($password)
	{
		$ency = $GLOBALS['passwordency'];
		if($ency == 'sha1')
			return sha1($password);
		elseif($ency == 'md5')
			return md5($password);
		elseif($ency == '')
			return $password;
	}
	// Save config in ini file
	function saveconfig_ini($config)
	{
		$file = fopen("config/config.ini", "w");
		foreach($config as $param => $data)
		{
			$file_data .= $param.' = "'.str_replace('"', '', $data).'"';
		}
		rewind($file);
		fwrite($file, $file_data);
		fclose($file);
	}
	// Reason of ban
	function getReason($reasonId)
	{
		switch($reasonId)
		{
			case 0:
				return "Offensive Name";
			case 1:
				return "Invalid Name Format";
			case 2:
				return "Unsuitable Name";
			case 3:
				return "Name Inciting Rule Violation";
			case 4:
				return "Offensive Statement";
			case 5:
				return "Spamming";
			case 6:
				return "Illegal Advertising";
			case 7:
				return "Off-Topic Public Statement";
			case 8:
				return "Non-English Public Statement";
			case 9:
				return "Inciting Rule Violation";
			case 10:
				return "Bug Abuse";
			case 11:
				return "Game Weakness Abuse";
			case 12:
				return "Using Unofficial Software to Play";
			case 13:
				return "Hacking";
			case 14:
				return "Multi-Clienting";
			case 15:
				return "Account Trading or Sharing";
			case 16:
				return "Threatening Gamemaster";
			case 17:
				return "Pretending to Have Influence on Rule Enforcement";
			case 18:
				return "False Report to Gamemaster";
			case 19:
				return "Destructive Behaviour";
			case 20:
				return "Excessive Unjustified Player Killing";
			case 21:
				return "Invalid Payment";
			case 22:
				return "Spoiling Auction";
			default:
				break;
		}
		return "Unknown Reason";
	}
	// Set monster of week
	function logo_monster() 
	{
		return str_replace(" ", "", trim(mb_strtolower($GLOBALS['layout_ini']['logo_monster'])));
	}
	// Status server
	$statustimeout = 1;
	foreach(explode("*", str_replace(" ", "", $config['server']['statusTimeout'])) as $status_var)
		if($status_var > 0)
			$statustimeout = $statustimeout * $status_var;
			$statustimeout = $statustimeout / 1000;
			$config['status'] = parse_ini_file('Config/serverstatus');
			if($config['status']['serverStatus_lastCheck']+$statustimeout < time())
			{
				$config['status']['serverStatus_checkInterval'] = $statustimeout+3;
				$config['status']['serverStatus_lastCheck'] = time();
				$info = chr(6).chr(0).chr(255).chr(255).'info';
				$sock = @fsockopen($config['server']['ip'], $config['server']['statusPort'], $errno, $errstr, 1);
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
				$file = fopen("Config/serverstatus", "w");
				foreach($config['status'] as $param => $data)
				{
					$file_data .= $param.' = "'.str_replace('"', '', $data).'"';
				}
				rewind($file);
				fwrite($file, $file_data);
				fclose($file);
			}
	// Page viwer count
	$views_counter = "usercounter.dat";
	if (file_exists($views_counter)) 
	{	// het bestand bestaat, waarde + 1
		$actie = fopen($views_counter, "r+");
		$page_views = fgets($actie, 9);
		$page_views++;
		rewind($actie);
		fputs($actie, $page_views, 9);
		fclose($actie);
	}
	else
	{	// the file doesn't exist, creating a new one with value 1
		$actie = fopen($views_counter, "w");
		$page_views = 1;
		fputs($actie, $page_views, 9);
		fclose($actie);
	}

?>
