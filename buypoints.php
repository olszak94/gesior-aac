<?PHP
####################       CONFIG      ###################################################
#aktywacja dotpay oraz dostepych systemow platnosci, wartosci: true / false
$config['paypal_active'] = $config['site']['paypal_active']; #active paypal system?
$config['zaypay_active'] = $config['site']['zaypay_active']; #active zaypay system?
# activation of DotPay system
$config['dotpay'] = array();
$config['dotpay_active'] = $config['site']['dotpay_active']; #active dotpay system?
	# opcje transferu
	$config['dotpay_active_sms'] = true; #active dotpay system?
	$config['dotpay_active_transfer'] = true; #active dotpay system?
	# przykladowy konfig dla SMS
	$config['dotpay'][0]['id'] = 21468;       # numer ID zarejestrowanego klienta
	$config['dotpay'][0]['code'] = "DEB3"; # identyfikator uslug SMS
	$config['dotpay'][0]['type'] = "sms";   # typ konta: C1 - 8 znakowy kod bezobslugowy, sms - dla sprawdzania SMSow
	$config['dotpay'][0]['addpoints'] = 100; # ile premium punktow daje dany sms
	$config['dotpay'][0]['sms_number'] = 73068; # numer na jaki nalezy wyslac kod
	$config['dotpay'][0]['sms_text'] = "AP.DEB3"; # tresc jaka ma byc w SMSie
	$config['dotpay'][0]['sms_cost'] = "3.69 zl brutto"; # cena za wyslanie sms
	# przykladowy konfig dla przelewu bankowego/karty kredytowej
	$config['dotpay'][1]['id'] = 21468;       # numer ID zarejestrowanego klienta
	$config['dotpay'][1]['code'] = "DEBT"; # identyfikator uslug SMS
	$config['dotpay'][1]['type'] = "C1";   # typ konta: C1 - 8 znakowy kod bezobslugowy, sms - dla sprawdzania SMSow
	$config['dotpay'][1]['addpoints'] = 400; # ile premium punktow daje dany sms
	$config['dotpay'][1]['sms_number'] = ""; # numer na jaki nalezy wyslac kod
	$config['dotpay'][1]['sms_text'] = "DEBT"; # tresc jaka ma byc w SMSie
	$config['dotpay'][1]['sms_cost'] = "5 zl brutto"; # cena za wyslanie sms
# activation of DaoPay system
$config['daopay'] = array();
$config['daopay_active'] = $config['site']['daopay_active']; #active daopay system?
	# example config for daopay
	$config['daopay'][0]['appcode'] = 46870; #
	$config['daopay'][0]['prodcode'] = 'DEB2'; #
	$config['daopay'][0]['addpoints'] = '100'; #
	$config['daopay'][0]['cost'] = "1 euro inc. VAT"; #
	# przk³ad
	$config['daopay'][1]['appcode'] = 46870; #
	$config['daopay'][1]['prodcode'] = 'DEB3'; #
	$config['daopay'][1]['addpoints'] = '200'; #
	$config['daopay'][1]['cost'] = "2 euro inc. VAT"; #
# activation of HomePay system
$config['homepay'] = array();
$config['homepay_active'] = $config['site']['homepayActive'];
	# opcje transferu
	$config['homepay_active_sms'] = true; #active homepay sms system?
	$config['homepay_active_transfer'] = true; #active homepay transfer system?
	# przykladowy konfig dla SMS
	$config['homepay'][0]['acc_id']=2;
	$config['homepay'][0]['addpoints']=10;
	$config['homepay'][0]['sms_number']="79550";
	$config['homepay'][0]['type']="sms";
	$config['homepay'][0]['sms_text']="HPAY.NASZAUSLUGA";
	$config['homepay'][0]['sms_cost']="10.98 zl brutto";
	# przykladowy konfig dla przelewu
	$config['homepay'][1]['acc_id']=1;
	$config['homepay'][1]['addpoints']=10;
	$config['homepay'][1]['link']="https://ssl.homepay.pl/wplata/1-NASZAUSLUGA";
	$config['homepay'][1]['type']="przelew";
	$config['homepay'][1]['przelew_text']="NASZAUSLUGA";
	$config['homepay'][1]['przelew_cost']="10.00 zl brutto";
#################################################################################
function check_code_daopay($appcode, $prodcode, $pin)
{
    $handle = fopen("https://daopay.com/svc/pincheck?appcode=".$appcode."&prodcode=".$prodcode."&pin=".$pin, 'r');  
	if(ereg('[^0-9A-Za-z]',$appcode) || ereg('[^0-9A-Za-z]',$prodcode) || ereg('[^0-9A-Za-z]',$pin))  
	{
		die("You what a duplikat point your are a loser");
	}
    if ($handle)
    {
        $status = fgets($handle, 128);
        fclose($handle);
        if($status[0] == 'o' && $status[1] == 'k')
            $return = 1;
        else
            $return = 2;
    }
    else
        $return = 3;
    return $return;
}

function check_code_dotpay($code, $posted_code, $user_id, $type)
{
    if(ereg('[^0-9A-Za-z]',$code) || ereg('[^0-9A-Za-z]',$posted_code) || ereg('[^0-9A-Za-z]',$user_id) || ereg('[^0-9A-Za-z]',$type))  
	{
		die("You what a duplikat point your are a loser");
    }
    $handle = fopen("http://dotpay.pl/check_code.php?id=".$user_id."&code=".$code."&check=".$posted_code."&type=".$type."&del=0", 'r');
    $status = fgets($handle, 8);
    $czas_zycia = fgets($handle, 24);
    fclose($handle);
    $czas_zycia = rtrim($czas_zycia);
    return array($status, $czas_zycia);
}

function delete_code_dotpay($code, $posted_code, $user_id, $type)
{
	$handle = fopen("http://dotpay.pl/check_code.php?id=".$user_id."&code=".$code."&check=".$posted_code."&type=".$type."&del=1", 'r');
    fclose($handle);
}

function check_code_homepay($code, $usluga)
{
	global $config;
	if(!preg_match("/^[A-Za-z0-9]{8}$/",$code)) return 0;
		$code=urlencode($code);
	$handle=fopen("http://homepay.pl/sms/check_code.php?acc_id=".(int)($config['homepay'][$usluga]['acc_id'])."&code=".$code,'r');
	$status=fgets($handle,8);
	fclose($handle);
	return $status;
}

function check_tcode_homepay($code, $usluga)
{
	global $config;
	if(!preg_match("/^[A-Za-z0-9]{8}$/",$code)) return 0;
		$code=urlencode($code);
	$handle=fopen("http://homepay.pl/API/check_tcode.php?acc_id=".(int)($config['homepay'][$usluga]['acc_id'])."&code=".$code,'r');
	$status=fgets($handle,8);
	fclose($handle);
	return $status;
}

function add_points(OTS_Account $account, $number_of_points)
{
	if($account->isLoaded())
	{
		$account->setCustomField('premium_points', ($account->getCustomField('premium_points')+$number_of_points));
		return true;
	}
	else
		return false;
}
if ($_REQUEST['system'] == 'paypal' && $config['paypal_active']) 
{
	$content = file_get_contents("paypal/paypal.htm");
		$main_content .= $content;
}
elseif ($_REQUEST['system'] == 'zaypay' && $config['zaypay_active']) 
{
	if(!$logged)
		$main_content .= '<center><b>Please login first to donate via ZayPay.</B></center>';
	if($logged)
		$main_content .= '<iframe src="'.$REMOTE_ADDR.'/zaypay/pay.php" frameborder="no" width="98%" height="350px;">
		<p>Need IFRAME support, please download Opera,Firefox or Chrome</p></iframe><br>';
}
elseif ($_REQUEST['system'] == 'daopay' && $config['daopay_active'])
{
	#################################################################################
	$offer_id = (int) $_POST['offer_id'];
	$posted_pincode = trim($_POST['pincode']);
	$to_user = trim($_POST['to_user']);
	$verify_code = trim($_POST['verify_code']);
	#################################################################################
	if(!empty($to_user))
	{
		if(is_numeric($to_user))
		{
			$account = new OTS_Account();
			$account->find($to_user);
		}
		else
		{
			$player = new OTS_Player();
			$player->find($to_user);
			if($player->isLoaded())
				$account = $player->getAccount();
			else
				$account = new OTS_Account();
		}
		if(empty($posted_pincode))
			$errors[] = 'Please enter your PIN code.';
		if(!$account->isLoaded())
			$errors[] = 'Account/account of player with this name doesn\'t exist.';
		if(count($errors) == 0)
		{
			$code_info = check_code_daopay($config['daopay'][$offer_id]['appcode'], $config['daopay'][$offer_id]['prodcode'], $posted_pincode);
			if($code_info == 3)
				$errors[] = 'Server has problem with connection to daopay.com, can\'t verify PIN code.';
			elseif($code_info == 2)
				$errors[] = 'Wrong PIN code, try to enter code again.';
			elseif($code_info == 1)
			{
				if(add_points($account, $config['daopay'][$offer_id]['addpoints']))
				{
					$executedaopaylog = $SQL->query("INSERT INTO `z_shop_points_bought` (`id` ,`amount` ,`type` ,`accountid` , `code`, `paypalmail`, `date`) VALUES (NULL , '".$config['daopay'][$offer_id]['addpoints']."', 'Daopay', '".$account->getId()."', '".$posted_pincode."', 'N/A',CURRENT_TIMESTAMP);");
                    $main_content .= '<h2><font color="red">Good PIN code. Added '.$config['daopay'][$offer_id]['addpoints'].' Premium Points to account of: '.$to_user.' !</font></h2>';
				}
				else
					$errors[] = 'Error occured, try again.';
			}
		}
	}
	if(count($errors) > 0)
	{
		$main_content .= '<font color="red"><b>Errors occured:</b></font>';
		foreach($errors as $error)
			$main_content .= '<br />* '.$error;
		$main_content .= '<hr /><hr />';
	}
	$main_content .= 'Buy Premium Points. For this points you can buy pacc/items in Shop. To buy points:<br />
	1. Visit one of our pages and donate us (send SMS/call special number).<br />
	2. After donate daopay.com will show you PIN code.<br />
	3. Save somewhere this PIN code and open this page again.<br />
	4. Enter your character name or account and your PIN code in form below.<br />
	5. Select donation cost from list and press "Check Code".<br />
	6. If account and PIN code is valid you get premium points.<br />
	7. Open "Shop Offer" and buy items/pacc :)<br />
	<h2><font color="red"><b>Our pages:</b></h2></font>';
	foreach($config['daopay'] as $offer) 
	{
		$order++;
		$main_content .= '<b><h3>'.$order.'. Address: <font color="red"><a href="http://daopay.com/payment/?appcode='.urlencode($offer['appcode']).'&prodcode='.urlencode($offer['prodcode']).'">Buy '.$offer['addpoints'].' Shop points for '.$offer['cost'].'</a></font><br></h3>';
	}
	$main_content .= '<hr /><form action="?subtopic=buypoints&system=daopay" method="POST"><table>';
	$main_content .= '<tr><td><b>Player name or account name: </b></td><td><input type="text" size="20" value="'.$to_user.'" name="to_user" /></td></tr>
	<tr><td><b>PIN code: </b></td<td><input type="text" size="20" value="'.$posted_pincode.'" name="pincode" /></td></tr><tr><td><b>Offer type: </b></td><td><select name="offer_id">';
	foreach($config['daopay'] as $id => $offer)
		$main_content .= '<option value="'.$id.'">'.$offer['prodcode'].' - cost '.$offer['cost'].' - points '.$offer['addpoints'].'</option>';
	$main_content .= '</select></td></tr><tr><td></td><td><input type="submit" value="Check Code" /></td></tr></table></form>';
}
elseif ($_REQUEST['system'] == 'homepay' && $config['homepay_active'])
{
	#################################################################################
	$sms_type = (int) $_POST['sms_type'];
	$posted_code = trim($_POST['code']);
	$to_user = trim($_POST['to_user']);
	$verify_code = trim($_POST['verify_code']);
	#################################################################################
	if(!empty($to_user))
	{
		if(is_numeric($to_user))
		{
			$account = new OTS_Account();
			$account->find($to_user);
		}
		else
		{
			$player = new OTS_Player();
			$player->find($to_user);
			if($player->isLoaded())
				$account = $player->getAccount();
			else
				$account = new OTS_Account();
		}
		if(empty($posted_code))
			$errors[] = 'Prosze wpisac kod z SMSa/przelewu.';
		if(!$account->isLoaded())
			$errors[] = 'Konto/konto postaci o podanym nicku nie istnieje.';
		if(count($errors) == 0)
		{
			if(count($errors) == 0)
			{
				if($config['homepay'][$sms_type]['type']=="sms")
				   $code_info = check_code_homepay($posted_code,$sms_type);
				else
				   $code_info = check_tcode_homepay($posted_code,$sms_type);
				if($code_info != "1")
					$errors[] = 'Podany kod z SMSa/przelewu jest niepoprawny lub wybrano zla opcje SMSa/przelewu.';
				else
				{
					if(add_points($account, $config['homepay'][$sms_type]['addpoints']))
					{
						$executehomepaylog = $SQL->query("INSERT INTO `z_shop_points_bought` (`id` ,`amount` ,`type` ,`accountid` , `code`, `paypalmail`, `date`) VALUES (NULL , '".$config['homepay'][$sms_type]['addpoints']."', 'Homepay', '".$account->getId()."', '".$posted_code."', 'N/A', CURRENT_TIMESTAMP);");
						$main_content .= '<h1><font color="red">Dodano '.$config['homepay'][$sms_type]['addpoints'].' punktow premium do konta: '.$to_user.' !</font></h1>';
					}
					else
					 $errors[] = 'Wystapil blad podczas dodawania punktow do konta, sproboj ponownie.';
				}
			}
		}
	}
	if(count($errors) > 0)
	{
		$main_content .= 'Wystapily bledy:';
		foreach($errors as $error)
			$main_content .= '<br />* '.$error;
		$main_content .= '<hr /><hr />';
	}
	if($config['homepay_active_sms'])
	{
		$main_content .= '<table><tr><td><h2 align="center">SMS</h2>Prosimy zapoznaæ siê z regulaminem œwiadczonych us³ug zamieszczonym na dole tej strony.<br/><br/>';
		foreach($config['homepay'] as $typ)
			if($typ['type'] == 'sms')
				$main_content .= '<b>* Na numer <font color="green">'.$typ['sms_number'].'</font> o tresci <font color="green"><b>'.$typ['sms_text'].'</b></font> za <font color="green"><b>'.$typ['sms_cost'].'</b></font>, a za kod dostaniesz <font color="green"><b>'.$typ['addpoints'].'</b></font> punktow premium.</b><br/>';
		$main_content .= '</td></tr></table><br />';
	}
	if($config['homepay_active_transfer'])
	{
		$main_content .= '<table><tr><td><h2 align="center">Przelew</h2>Prosimy zapoznaæ siê z regulaminem œwiadczonych us³ug zamieszczonym na dole tej strony.<br/><br/>';
		foreach($config['homepay'] as $typ)
			if($typ['type'] == 'przelew')
				$main_content .= '<b>* Adres - <a href="'.$typ['link'].'"><font color="green">'.$typ['link'].'</font></a> - koszt <font color="green"><b>'.$typ['przelew_cost'].'</b></font>, a za kod dostaniesz <font color="green"><b>'.$typ['addpoints'].'</b></font> punktow premium.</b><br/>';
		$main_content .= '</td></tr></table><br />';
	}
	$main_content .= '<table><tr><td><form action="?subtopic=buypoints&system=homepay" method="POST"><table>';
	$main_content .= '<tr><td><b>Nick postaci lub numer konta: </b></td><td><input type="text" size="20" value="'.$to_user.'" name="to_user" /></td></tr>
	<tr><td><b>Kod z SMSa: </b></td><td><input type="text" size="20" value="'.$posted_code.'" name="code" /></td></tr><tr><td><b>Typ wyslanego SMSa: </b></td><td><select name="sms_type">';
	foreach($config['homepay'] as $id => $typ)
		if($typ['type'] == 'sms')
			$main_content .= '<option value="'.$id.'">numer '.$typ['sms_number'].' - kod '.$typ['sms_text'].' - SMS za '.$typ['sms_cost'].'</option>';
		elseif($typ['type'] == 'przelew')
			$main_content .= '<option value="'.$id.'">przelew - kod '.$typ['przelew_text'].' - za '.$typ['przelew_cost'].'</option>';
	$main_content .= '</select></td></tr><tr><td></td><td><input type="submit" value="Sprawdz" /></td></tr></table></form>
	<h2 align="center"><font color="green">Po zakupie itemków proszê przelogowaæ postaæ, aby zapobiec utracie rzeczy.</font></h2></td></tr></table><br />
	<table><tr><td>
	<center><img border="0" src="http://homepay.pl/theme/default/image/logo/homepay_logo26.png"></center><br />
	<hr>
	Serwis SMS obslugiwany przez <a href="http://www.homepay.pl" target="_blank">Homepay.pl</a><br />
		 Regulamin: <a href="http://homepay.pl/regulamin/regulamin_sms_premium/" target="_blank">http://homepay.pl/regulamin/regulamin_sms_premium/</a><br />
		 Usluga dostepna w sieciach: Era, Orange, Play, Plus GSM.<br/>
	<hr>
	<b>Regulamin us³ug dostêpnych na stronie:</b><br/>
	<b>1.a)</b> Kiedy Twój poprawnie wys³any SMS zostanie dostarczony otrzymasz SMS zwrotny z kodem.<br/>
	<b>1.b)</b> Kiedy Twój przelew zostanie zaksiêgowany (z kart kredytowych i bankow internetowych z listy, jest to kwestia paru sekund) na e-mail który poda³eœ w formularzu otrzymasz kod.<br/>
	<b>2.</b> Po otrzymaniu kodu SMS/przelewu i wpisaniu go wraz z nazw¹ konta w powy¿szym formularzu, na serwerze '.$config['server']['serverName'].' podane konto zostanie automatycznie do³adowane o okreslon¹ iloœæ <b>punktów premium</b> które nastepnie moga byc zamienione na wirtualne przedmioty w grze Open Tibia Serwer zwan¹ <b>'.$config['server']['serverName'].'</b>.<br/>
	<b>3.</b> Do pe³nego skozystania z us³ugi wymagana jest przegl¹darka internetowa oraz po³¹czenie z sieci¹ Internet.<br/>
	<b>4.</b> <b>'.$config['server']['serverName'].'</b> nie odpowiada za Ÿle wpisane tresci SMS.<br/>
	<b>5.</b> W razie problemów z dzia³aniem us³ugi nale¿y kontaktowaæ siê z <a href="mailto:kontakt@adres.pl">kontakt@adres.pl</a>
	</td></tr></table>';
}
elseif ($_REQUEST['system'] == 'dotpay' && $config['dotpay_active'])
{
	#################################################################################
	$sms_type = (int) $_POST['sms_type'];
	$posted_code = trim($_POST['code']);
	$to_user = trim($_POST['to_user']);
	$verify_code = trim($_POST['verify_code']);
	#################################################################################
	if(!empty($to_user))
	{
		if(is_numeric($to_user))
		{
			$account = new OTS_Account();
			$account->find($to_user);
		}
		else
		{
			$player = new OTS_Player();
			$player->find($to_user);
			if($player->isLoaded())
				$account = $player->getAccount();
			else
				$account = new OTS_Account();
		}
		
		if(empty($posted_code))
			$errors[] = 'Prosze wpisac kod z SMSa/przelewu.';
			
		if(!$account->isLoaded())
			$errors[] = 'Konto/konto postaci o podanym nicku nie istnieje.';
			
		if(count($errors) == 0)
		{
			$code_info = check_code_dotpay($config['dotpay'][$sms_type]['code'], $posted_code, $config['dotpay'][$sms_type]['id'], $config['dotpay'][$sms_type]['type']);
			if($code_info[0] == 0)
				$errors[] = 'Podany kod z SMSa/przelewu jest niepoprawny lub wybrano zla opcje SMSa/przelewu.';
			else
			{
				if(add_points($account, $config['dotpay'][$sms_type]['addpoints']))
				{
					$code_info = delete_code_dotpay($config['dotpay'][$sms_type]['code'], $posted_code, $config['dotpay'][$sms_type]['id'], $config['dotpay'][$sms_type]['type']);
					$executedotpaylog = $SQL->query("INSERT INTO `z_shop_points_bought` (`id` ,`amount` ,`type` ,`accountid` , `code`, `paypalmail`, `date`) VALUES (NULL , '".$config['dotpay'][$sms_type]['addpoints']."', 'Dotpay', '".$account->getId()."', '".$posted_code."', 'N/A', CURRENT_TIMESTAMP);");
                    $main_content .= '<h1><font color="red">Dodano '.$config['dotpay'][$sms_type]['addpoints'].' punktow premium do konta: '.$to_user.' !</font></h1>';
				}
				else
					$errors[] = 'Wystapil blad podczas dodawania punktow do konta, sproboj ponownie.';
			}
		}
	}
	if(count($errors) > 0)
	{
		$main_content .= 'Wystapily bledy:';
		foreach($errors as $error)
			$main_content .= '<br />* '.$error;
		$main_content .= '<hr /><hr />';
	}
	if($config['dotpay_active_sms'])
	{
		$main_content .= '<h2>SMS</h2>Kup punkty premium, mozesz je wymienic w sklepie OTSa na PACC/przedmioty w grze, aby zakupic punkty premium wyslij SMSa:';
		foreach($config['dotpay'] as $sms)
			if($sms['type'] == 'sms')
				$main_content .= '<br /><b>* Na numer <font color="red">'.$sms['sms_number'].'</font> o tresci <font color="red"><b>'.$sms['sms_text'].'</b></font> za <font color="red"><b>'.$sms['sms_cost'].'</b></font>, a za kod dostaniesz <font color="red"><b>'.$sms['addpoints'].'</b></font> punktow premium.</b>';
		$main_content .= '<br />W SMSie zwrotnym otrzymasz specjalny kod. Wpisz ten kod w formularzu wraz z nickiem postaci lub numerem konta osoby ktora ma otrzymac punkty.<br />
		Serwis SMS obslugiwany przez <a href="http://www.dotpay.pl" target="_blank">Dotpay.pl</a><br />
		Regulamin: <a href="http://www.dotpay.pl/regulaminsms" target="_blank">http://www.dotpay.pl/regulaminsms</a><br />
		Usluga dostepna w sieciach: Orange, Plus GSM, Era.<br />
		<b>'.$config['server']['serverName'].'</b> nie odpowieda za zle wpisane tresci SMS.<hr />';
	}
	if($config['dotpay_active_transfer'])
	{
		$main_content .= '<h2>Przelew/karta kredytowa</h2>Kup punkty premium, mozesz je wymienic w sklepie OTSa na PACC/przedmioty w grze, aby zakupic punkty premium wejdz na jeden z adresow i wypelnij formularz:';
		foreach($config['dotpay'] as $przelew)
			if($przelew['type'] == 'C1')
				$main_content .= '<br /><b>* Adres - <a href="https://ssl.allpay.pl/?id='.$przelew['id'].'&code='.$przelew['code'].'"><font color="red">https://ssl.allpay.pl/?id='.$przelew['id'].'&code='.$przelew['code'].'</font></a> - koszt <font color="red"><b>'.$przelew['sms_cost'].'</b></font>, a za kod dostaniesz <font color="red"><b>'.$przelew['addpoints'].'</b></font> punktow premium.</b>';
		$main_content .= 'Kiedy Twoj przelew dojdzie (z kart kredytowych i bankow internetowych z listy jest to kwestia paru sekund) na e-mail ktory podales w formularzu otrzymasz kod. Kod ten mozesz wymienic na tej stronie na punkty premium w formularzu ponizej.<hr />';
	}
	$main_content .= '<form action="?subtopic=buypoints&system=dotpay" method="POST"><table>';
	$main_content .= '<tr><td><b>Nick postaci lub numer konta: </b></td><td><input type="text" size="20" value="'.$to_user.'" name="to_user" /></td></tr>
	<tr><td><b>Kod z SMSa: </b></td<td><input type="text" size="20" value="'.$posted_code.'" name="code" /></td></tr><tr><td><b>Typ wyslanego SMSa: </b></td><td><select name="sms_type">';
	foreach($config['dotpay'] as $id => $sms)
		if($sms['type'] == 'sms')
			$main_content .= '<option value="'.$id.'">numer '.$sms['sms_number'].' - kod '.$sms['sms_text'].' - SMS za '.$sms['sms_cost'].'</option>';
		elseif($przelew['type'] == 'C1')
			$main_content .= '<option value="'.$id.'">przelew - kod '.$sms['sms_text'].' - za '.$sms['sms_cost'].'</option>';
	$main_content .= '</select></td></tr><tr><td></td><td><input type="submit" value="Sprawdz" /></td></tr></table></form>';
}
else
{
    if($config['homepay_active'])
        $main_content .= '<br /><br /><a href="?subtopic=buypoints&system=homepay"><h2>Homepay - LINK</h2><img border="0" src="http://homepay.pl/theme/default/image/logo/homepay_logo26.png"></a><h3>Zaplac SMS lub przelewem bankowym.</h3>';
	if($config['dotpay_active'])
		$main_content .= '<br /><br /><a href="?subtopic=buypoints&system=dotpay"><h2>For users from Poland - LINK</h2></a><h3>Zaplac SMS, karta kredytowa lub przelewem bankowym.</h3>';
	if($config['daopay_active'])
		$main_content .= '<br /><br /><a href="?subtopic=buypoints&system=daopay"><h2>Donate via Daopay</h2></a><h3>Send SMS (not for all countries) or call special number to donate and get points.</h3>';
	if($config['zaypay_active'])
		$main_content .= '<br /><br /><a href="?subtopic=buypoints&system=zaypay"><h2>Donate via Zaypay</h2></a><h3>Send SMS (not for all countries) or call special number to donate and get points.</h3>';
	if($config['paypal_active'])
		$main_content .= '<br /><br /><a href="?subtopic=buypoints&system=paypal"><h2>Donate via Paypal</h2></a><h3>Donate via Paypal to get 12 shop points.</h3>';
}
?>