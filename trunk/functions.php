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
?>
