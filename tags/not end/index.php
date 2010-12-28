<?php
	session_start();
	##--Functions--##
	include('functions.php');
	
	##-- Actions --##
	$action = $_REQUEST['action'];
	
	##-- Login --##
	$logged = FALSE;
	if(isset($_SESSION['account'])) 
	{
		$account_logged = $ots->createObject('Account');
		$account_logged->load($_SESSION['account']);
		if($account_logged->isLoaded() && $account_logged->getPassword() == $_SESSION['password']) {
			$logged = TRUE;
			$group_id_of_acc_logged = $account_logged->getPageAccess();
		} else {
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
		if($account_logged->isLoaded()) {
			if($login_password == $account_logged->getPassword()) {
				$_SESSION['account'] = $account_logged->getId();
				$_SESSION['password'] = $login_password;
				$logged = TRUE;
				$account_logged->setCustomField("page_lastday", time());
				$group_id_of_acc_logged = $account_logged->getPageAccess();
			} else
				$logged = FALSE;
		}
	}
	
	##-- Logout --##
	if($action == "logout") 
	{
		unset($_SESSION['account']);
		unset($_SESSION['password']);
	}
?>