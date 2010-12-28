<?PHP
echo '<?xml version="1.0" encoding="utf-8" standalone="yes"?>';
$config_ini = parse_ini_file('../config/config.ini');
$acc_re = trim($_REQUEST['account']);
$account = (int) trim($_REQUEST['account']);
if(empty($account))
{
	echo '<font color="red">Please enter an account number. Use only numbers.</font>';
	exit;
}
	if(strlen($account) > 0 && strlen($account) < 9)
	{
		//connect to DB
		$server_config = parse_ini_file($config_ini['server_path'].'config.lua');
		if(isset($server_config['mysqlHost']))
		{
			//new (0.2.6+) ots config.lua file
			$mysqlhost = $server_config['mysqlHost'];
			$mysqluser = $server_config['mysqlUser'];
			$mysqlpass = $server_config['mysqlPass'];
			$mysqldatabase = $server_config['mysqlDatabase'];
			$sqlitefile = $server_config['sqliteDatabase'];
		}
		elseif(isset($server_config['sqlHost']))
		{
			//old (0.2.4) ots config.lua file
			$mysqlhost = $server_config['sqlHost'];
			$mysqluser = $server_config['sqlUser'];
			$mysqlpass = $server_config['sqlPass'];
			$mysqldatabase = $server_config['sqlDatabase'];
			$sqlitefile = $server_config['sqliteDatabase'];
		}
		// loads #####POT mainfile#####
		include('../pot/OTS.php');
		// PDO and POT connects to database
		$ots = POT::getInstance();
		if($server_config['sqlType'] == "mysql")
			$ots->connect(POT::DB_MYSQL, array('host' => $mysqlhost, 'user' => $mysqluser, 'password' => $mysqlpass, 'database' => $mysqldatabase) );
		elseif($server_config['sqlType'] == "sqlite")
			$ots->connect(POT::DB_SQLITE, array('database' => $config_ini['server_path'].$sqlitefile));
		$account_db = new OTS_Account();
		$account_db->load($account);
		if($account_db->isLoaded())
			echo '<font color="red">Account with this number already exist.</font>';
		else
			echo '<font color="green">Good account number ( '.$account.' ). You can create account.</font>';
	}
	else
		echo '<font color="red">Account number is too long (max. 8 chars).</font>';

?>