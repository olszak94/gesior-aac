<?php

error_reporting(E_ALL ^ E_NOTICE); 
ini_set('session.use_trans_sid', 0);
session_start();
ob_start("ob_gzhandler");
ini_set('include_path', ini_get('include_path') . ':./libs');
date_default_timezone_set('Europe/Warsaw');

function microtime_float()
{
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
}
$time_start = microtime_float();

include('config-and-functions.php');
$action = $_REQUEST['action'];
if($action == "logout") 
{
	unset($_SESSION['account']);
	unset($_SESSION['password']);
}

//check is player logged
$logged = FALSE;
if(isset($_SESSION['account'])) 
{
	$account_logged = $ots->createObject('Account');
	$account_logged->load($_SESSION['account']);
	if($account_logged->isLoaded() && $account_logged->getPassword() == $_SESSION['password']) 
	{
		$logged = TRUE;
		$group_id_of_acc_logged = $account_logged->getPageAccess();
	} 
	else 
	{
		$logged = FALSE;
		unset($_SESSION['account']);
		unset($account_logged);
	}
}
$login_account = strtoupper(trim($_POST['account_login']));
$login_password = trim($_POST['password_login']);
if(!$logged && !empty($login_account) && !empty($login_password)) 
{
	$login_password = password_ency($login_password);
	$account_logged = $ots->createObject('Account');
	$account_logged->find($login_account);
	if($account_logged->isLoaded()) 
	{
		if($login_password == $account_logged->getPassword()) 
		{
			$_SESSION['account'] = $account_logged->getId();
			$_SESSION['password'] = $login_password;
			$logged = TRUE;
			$account_logged->setCustomField("page_lastday", time());
			$group_id_of_acc_logged = $account_logged->getPageAccess();
		} 
		else
			$logged = FALSE;
	}
}

//load subtopic page
if(empty($_REQUEST['subtopic'])) 
{
	$_REQUEST['subtopic'] = "latestnews";
	$subtopic = "latestnews";
}
switch($_REQUEST['subtopic']) 
{
	case "latestnews":
		$topic = "Latest News";
		$subtopic = "latestnews";
		require_once("modules/latestnews.php");
	break;
	case "archive";
		$topic = "News Archives";
		$subtopic = "archive";
		require_once("modules/archive.php");
	break;
	case "creatures";
		$topic = "Creatures";
		$subtopic = "creatures";
		require_once("modules/creatures.php");
	break;
	case "spells";
		$topic = "Spells";
		$subtopic = "spells";
		require_once("modules/spells.php");
	break;
	case "serverinfo";
		$topic = "Server Info";
		$subtopic = "serverinfo";
		require_once("modules/serverinfo.php");
	break;
	case "experiencetable";
		$topic = "Experience Table";
		$subtopic = "experiencetable";
		require_once("modules/experiencetable.php");
	break;
	case "characters";
		$topic = "Characters";
		$subtopic = "characters";
		require_once("modules/characters.php");
	break;
	case "whoisonline";
		$topic = "Who is online?";
		$subtopic = "whoisonline";
		require_once("modules/whoisonline.php");
	break;
	case "highscores";
		$topic = "Highscores";
		$subtopic = "highscores";
		require_once("modules/highscores.php");
	break;
	case "killstatistics";
		$topic = "Last Kills";
		$subtopic = "killstatistics";
		require_once("modules/killstatistics.php");
	break;
  	case "bans":
		$topic = "Banishments";
 		$subtopic = "bans";
		require_once("modules/bans.php");
 	break;
	case "houses";
		$topic = "Houses";
		$subtopic = "houses";
		require_once("modules/houses.php");
	break;
	case "guilds";
		$topic = "Guilds";
		$subtopic = "guilds";
		require_once("modules/guilds.php");
	break;
	case "questmakers";
		$topic = "Quest Makers";
		$subtopic = "questmakers";
		require_once("modules/questmakers.php");
	break;
	case "bansmeneger";
		$topic = "Bans Menager";
		$subtopic = "bansmeneger";
		require_once("modules/bansmeneger.php");
	break;
	case "forum":
		$topic = "Forum";
		$subtopic = "forum";
		require_once("modules/forum.php");
	break;
	case "accountmanagement";
		$topic = "Account Management";
		$subtopic = "accountmanagement";
		require_once("modules/accountmanagement.php");
	break;
	case "createaccount";
		$topic = "Create Account";
		$subtopic = "createaccount";
		require_once("modules/createaccount.php");
	break;
	case "lostaccount";
		$topic = "Lost Account Interface";
		$subtopic = "lostaccount";
		require_once("modules/lostaccount.php");
	break;
	case "downloads";
		$subtopic = "downloads";
		$topic = "Downloads";
		require_once("modules/downloads.php");
	break;
	case "tibiarules";
		$topic = "Server Rules";
		$subtopic = "tibiarules";
		require_once("modules/tibiarules.php");
	break;
	case "tracker";
		$subtopic = "tracker";
		$topic = "Tracker";
		require_once("modules/tracker.php");
	break;
	case "changelog";
		$topic = "Change Log";
		$subtopic = "changelog";
		require_once("modules/changelog.php");
	break;
	case "team";
		$topic = "Gamemasters List";
		$subtopic = "team";
		require_once("modules/team.php");
	break;
	case "wars";
		$topic = "Guilds Wars";
		$subtopic = "wars";
		require_once("modules/wars.php");
	break;
	case "adminpanel":
		$topic = "Admin Panel";
		$subtopic = "adminpanel";
		require_once("modules/adminpanel.php");
	break;
	case "namelock";
		$topic = "Namelock Manager";
		$subtopic = "namelock";
		require_once("modules/namelocks.php");
	break;
	case "buypoints";
		$topic = "Buy Points";
		$subtopic = "buypoints";
		include("modules/buypoints.php");
	break;
	case "shopsystem";
		$topic = "Shop System";
		$subtopic = "shopsystem";
		require_once("modules/shopsystem.php");
	break;
  	case "credits":
		$topic = "Credits";
 		$subtopic = "credits";
		require_once("modules/credits.php");
 	break;
	case "error":
		$topic = "Error";
		$subtopic = "error";
		require_once("modules/error.php");
	break;
}
// generate title of page
if(empty($topic)) 
{
	$title = $GLOBALS['config']['server']["serverName"]." - OTS";
	$main_content .= 'Invalid subtopic. Can\'t load page.';
} 
else
{
	$title = $GLOBALS['config']['server']["serverName"]." - ".$topic;
}
// ##### ADD Fotter for Credits
function getFooter()
{
	echo 'Account maker by <a href="index.php?subtopic=credits">Credits</a>. Layout by '.$GLOBALS['config']['site']['layout'].'.';
}
// ##### LAYOUT
$layout_header = '<script type=\'text/javascript\'>
function GetXmlHttpObject()
{
	var xmlHttp=null;
	try
	{
		xmlHttp=new XMLHttpRequest();
	}
	catch (e)
	{
		try
		{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch (e)
		{
			xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
	}
	return xmlHttp;
}
function MouseOverBigButton(source)
{
	source.firstChild.style.visibility = "visible";
}
function MouseOutBigButton(source)
{
	source.firstChild.style.visibility = "hidden";
}
function BigButtonAction(path)
{
	window.location = path;
}
var';
if($logged)
{
	$layout_header .= "loginStatus=1; loginStatus='true';"; 
} 
else 
{ 
	$layout_header .= "loginStatus=0; loginStatus='false';"; 
}
$layout_header .= " var activeSubmenuItem='".$subtopic."';</script>";
include($layout_name."/layout.php");
ob_end_flush();

?>
