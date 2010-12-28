<?PHP
//CREATE ACCOUNT FORM PAGE
if($action == "")
{
	$main_content .= '<script type="text/javascript">

var accountHttp;

//sprawdza czy dane konto istnieje czy nie
function checkAccount()
{
	if(document.getElementById("account_number").value=="")
	{
		document.getElementById("acc_number_check").innerHTML = \'<b><font color="red">Please enter account number.</font></b>\';
		return;
	}
	accountHttp=GetXmlHttpObject();
	if (accountHttp==null)
	{
		return;
	}
	var account = document.getElementById("account_number").value;
	var url="ajax/check_account.php?account=" + account + "&uid="+Math.random();
	accountHttp.onreadystatechange=AccountStateChanged;
	accountHttp.open("GET",url,true);
	accountHttp.send(null);
} 

function AccountStateChanged() 
{ 
	if (accountHttp.readyState==4)
	{ 
		document.getElementById("acc_number_check").innerHTML=accountHttp.responseText;
	}
}

var emailHttp;

//sprawdza czy dane konto istnieje czy nie
function checkEmail()
{
	if(document.getElementById("email").value=="")
	{
		document.getElementById("email_check").innerHTML = \'<b><font color="red">Please enter e-mail.</font></b>\';
		return;
	}
	emailHttp=GetXmlHttpObject();
	if (emailHttp==null)
	{
		return;
	}
	var email = document.getElementById("email").value;
	var url="ajax/check_email.php?email=" + email + "&uid="+Math.random();
	emailHttp.onreadystatechange=EmailStateChanged;
	emailHttp.open("GET",url,true);
	emailHttp.send(null);
} 

function EmailStateChanged() 
{ 
	if (emailHttp.readyState==4)
	{ 
		document.getElementById("email_check").innerHTML=emailHttp.responseText;
	}
}

	function validate_required(field,alerttxt)
	{
	with (field)
	{
	if (value==null||value==""||value==" ")
	  {alert(alerttxt);return false;}
	else {return true}
	}
	}

	function validate_email(field,alerttxt)
	{
	with (field)
	{
	apos=value.indexOf("@");
	dotpos=value.lastIndexOf(".");
	if (apos<1||dotpos-apos<2) 
	  {alert(alerttxt);return false;}
	else {return true;}
	}
	}

	function validate_form(thisform)
	{
	with (thisform)
	{
	if (accountcustom==1) {
	if (validate_required(account_number,"Please enter number of new account!")==false)
	  {account_number.focus();return false;}
	 }
	if (validate_required(email,"Please enter your e-mail!")==false)
	  {email.focus();return false;}
	if (validate_email(email,"Invalid e-mail format!")==false)
	  {email.focus();return false;}
	if (validate_required(passor,"Please enter password!")==false)
	  {passor.focus();return false;}
	if (validate_required(passor2,"Please repeat password!")==false)
	  {passor2.focus();return false;}
	if (passor2.value!=passor.value)
	  {alert(\'Repeated password is not equal to password!\');return false;}
	if (verifya==1) {
	if (validate_required(verify,"Please enter verification code!")==false)
	  {verify.focus();return false;}
	}
	if(rules.checked==false)
	  {alert(\'To create account you must accept server rules!\');return false;}
	}
	}
	</script>';
	$main_content .= 'To play on '.$config['server']['serverName'].' you need an account. 
						All you have to do to create your new account is to enter your email address, password to new account, verification code from picture and to agree to the terms presented below. 
						If you have done so, your account number, password and e-mail address will be shown on the following page and your account and password will be sent 
						to your email address along with further instructions.<BR><BR>
						<FORM ACTION="index.php?subtopic=createaccount&action=saveaccount" onsubmit="return validate_form(this)" METHOD=post>
						<TABLE WIDTH=100% BORDER=0 CELLSPACING=1 CELLPADDING=4>
						<TR><TD BGCOLOR="'.$config['site']['vdarkborder'].'" CLASS=white><B>Create a '.$config['server']['serverName'].' Account</B></TD></TR>
						<TR><TD BGCOLOR="'.$config['site']['darkborder'].'"><TABLE BORDER=0 CELLSPACING=8 CELLPADDING=0>
						  <TR><TD>
						    <TABLE BORDER=0 CELLSPACING=5 CELLPADDING=0>';
	if($config['site']['account_number'] == 'custom')
		$main_content .= '<script type="text/javascript">var accountcustom=1;</script>
						  <TR><TD width="150" valign="top"><B>Account number: </B></TD><TD colspan="2"><INPUT id="account_number" NAME="reg_account" OnKeyUp="checkAccount();" VALUE="" SIZE=30 MAXLENGTH=50><BR><font size="1" face="verdana,arial,helvetica">(Select your account number)</font></TD></TR>
						  <TR><TD width="150"><b>Account status:</b></TD><TD colspan="2"><b><div id="acc_number_check">Please enter your account number.</div></b></TD></TR>';
	else
		$main_content .= '<script type="text/javascript">var accountcustom=0;</script>';
	$main_content .= '<TR><TD width="150" valign="top"><B>Email address: </B></TD><TD colspan="2"><INPUT id="email" NAME="reg_email" onkeyup="checkEmail();" VALUE="" SIZE=30 MAXLENGTH=50><BR><font size="1" face="verdana,arial,helvetica">(Your email address is required to recovery a '.$config['server']['serverName'].' account)</font></TD></TR>
					  <TR><TD width="150"><b>Email status:</b></TD><TD colspan="2"><b><div id="email_check">Please enter your e-mail.</div></b></TD></TR>
					  <TR><TD width="150" valign="top"><B>Password: </B></TD><TD colspan="2"><INPUT TYPE="password" id="passor" NAME="reg_password" VALUE="" SIZE=30 MAXLENGTH=50><BR><font size="1" face="verdana,arial,helvetica">(Here write your password to new account on '.$config['server']['serverName'].')</font></TD></TR>
					  <TR><TD width="150" valign="top"><B>Repeat password: </B></TD><TD colspan="2"><INPUT TYPE="password" id="passor2" NAME="reg_password2" VALUE="" SIZE=30 MAXLENGTH=50><BR><font size="1" face="verdana,arial,helvetica">(Repeat your password)</font></TD></TR>';
	if($config['site']['verify_code'] == 'yes')
		$main_content .= '<script type="text/javascript">var verifya=1;</script><TR><TD width="150"><B>Code: </B></TD><TD colspan="2"><img src="imgverification/imagebuilder.php" border="0" alt="Image Verification is missing, please contact the administrator"></TD></TR>
						  <TR><TD width="150" valign="top"><B>Verification Code: </B></TD><TD colspan="2"><INPUT id="verify" NAME="reg_code" VALUE="" SIZE=30 MAXLENGTH=50><BR><font size="1" face="verdana,arial,helvetica">(Here write verification code from picture)</font></TD></TR>';
	else
		$main_content .= '<script type="text/javascript">var verifya=0;</script>';
	$main_content .= '</TABLE>
					  </TD></TR>
					  <TR><TD>
					    <TABLE BORDER=0 CELLSPACING=5 CELLPADDING=0><TR><TD>
					       Please review the following terms and state your agreement below.
					    </TD></TR>
					    <TR><TD>
					      <B>'.$config['server']['serverName'].' Rules</B><BR>
					      <TEXTAREA ROWS="16" WRAP="physical" COLS="74" READONLY="true">';
	//load server rules from file
	include("tibiarules.php");
	$main_content .= '</TEXTAREA>
					    </TD></TR></TABLE>
					  </TD></TR>
					  <TR><TD>
					    <TABLE BORDER=0 CELLSPACING=5 CELLPADDING=0>
					    <TR><TD>
					      <INPUT TYPE="checkbox" NAME="rules" id="rules" value="true" /><label for="rules"><u> I agree to the '.$config['server']['serverName'].' Rules.</u></lable><BR>
					    </TD></TR>
					    <TR><TD>
					      If you fully agree to these terms, click on the "I Agree" button in order to create a '.$config['server']['serverName'].' account.<BR>
					      If you do not agree to these terms or do not want to create a '.$config['server']['serverName'].' account, please click on the "Cancel" button.
					    </TD></TR></TABLE>
					  </TD></TR>
					</TABLE></TD></TR>
					</TABLE>
					<BR>
					<TABLE BORDER=0 WIDTH=100%>
					  <TR><TD ALIGN=center>
					    <IMG SRC="'.$layout_name.'/images/general/blank.gif" WIDTH=120 HEIGHT=1 BORDER=0><BR>
					  </TD><TD ALIGN=center VALIGN=top>
					    <INPUT TYPE=image NAME="I Agree" SRC="'.$layout_name.'/images/buttons/sbutton_iagree.gif" BORDER=0 WIDTH=120 HEIGHT=18>
					    </FORM>
					  </TD><TD ALIGN=center>
					    <FORM  ACTION="index.php?subtopic=latestnews" METHOD=post>
					    <INPUT TYPE=image NAME="Cancel" SRC="'.$layout_name.'/images/buttons/sbutton_cancel.gif" BORDER=0 WIDTH=120 HEIGHT=18>
					    </FORM>
					  </TD><TD ALIGN=center>
					    <IMG SRC="/images/general/blank.gif" WIDTH=120 HEIGHT=1 BORDER=0><BR>
					  </TD></TR>
					</TABLE>
					</TD>
					<TD><IMG SRC="'.$layout_name.'/images/general/blank.gif" WIDTH=10 HEIGHT=1 BORDER=0></TD>
					</TR>
					</TABLE>';
}
//CREATE ACCOUNT PAGE (save account in database)
if($action == "saveaccount") {
	$posted_reg_account = (int) trim($_POST['reg_account']);
	$reg_email = trim($_POST['reg_email']);
	$reg_password = trim($_POST['reg_password']);
	$reg_code = trim($_POST['reg_code']);
	//FIRST check
	//check e-mail
	if(empty($reg_email))
		$reg_form_errors[] = "Please enter your email address.";
	else
	{
		if(!check_mail($reg_email))
			$reg_form_errors[] = "E-mail address is not correct.";
	}
	if($config['site']['verify_code'] == 'yes')
	{
		//check verification code
		$string = strtoupper($_SESSION['string']);
		$userstring = strtoupper($reg_code);
		session_destroy();
		if(empty($string))
			$reg_form_errors[] = "Information about verification code in session is empty.";
		else
		{
			if(empty($userstring))
				$reg_form_errors[] = "Please enter verification code.";
			else
			{
				if($string != $userstring)
					$reg_form_errors[] = "Verification code is incorrect.";
			}
		}
	}
	//check password
	if(empty($reg_password))
		$reg_form_errors[] = "Please enter password to your new account.";
	else
	{
		if(!check_password($reg_password))
			$reg_form_errors[] = "Password contains illegal chars (a-z, A-Z and 0-9 only!) or lenght.";
	}
	//SECOND check
	//check e-mail address in database
	if(empty($reg_form_errors)) {
		if($config['site']['one_email'] == "yes") {
			$test_email_account = $ots->createObject('Account');
			//load account with this e-mail
			$test_email_account->find($reg_email);
			if($test_email_account->isLoaded())
				$reg_form_errors[] = "Account with this e-mail address already exist in database.";
		}
	}
	if($config['site']['account_number'] == 'custom') {
		if($posted_reg_account != $_REQUEST['reg_account'] || empty($posted_reg_account))
			$reg_form_errors[] = "'Account number' isn't a number!";
		if(strlen($account) < 1 && strlen($account) > 8)
			$reg_form_errors[] = "Account number is too short or too long.";
		//check "is account in db"
		$test_account = $ots->createObject('Account');
		$test_account->load($posted_reg_account);
		if($test_account->isLoaded())
			$reg_form_errors[] = "Account with this number is already in database.";
	}

	// ----------creates account-------------(save in database)
	if(empty($reg_form_errors))
	{
		//create object 'account' and generate new acc. number
		$reg_account = $ots->createObject('Account');
		if($config['site']['account_number'] == 'custom')
			$number = $reg_account->create($posted_reg_account, $posted_reg_account);
		else
			$number = $reg_account->create();
		// saves account information in database
		$reg_password = password_ency($reg_password);
		$reg_account->setPassword($reg_password);
		$reg_account->setEMail($reg_email);
		$reg_account->unblock();
		$reg_account->save();
		$reg_account->setCustomField("created", time());
		$reg_account->setCustomField("premdays", $config['site']['newaccount_premdays']);
		$reg_account->setCustomField("lastday", time());
		//show information about registration
		$main_content .= 'Your account has been created. Please write down the account number and password. See you in Tibia!<BR><BR>';
		$main_content .= '<TABLE WIDTH=100% BORDER=0 CELLSPACING=1 CELLPADDING=4>
		<TR><TD BGCOLOR="'.$config['site']['vdarkborder'].'" CLASS=white><B>Account Created</B></TD></TR>
		<TR><TD BGCOLOR="'.$config['site']['darkborder'].'">
		  <TABLE BORDER=0 CELLPADDING=1><TR><TD>
		    <BR><FONT SIZE=5>Write down your account number: <B>'.$number.'</B></FONT><BR><BR>Your password is <b>'.trim($_POST['reg_password']).'</b>. ';
		$main_content .= 'You will need the account number and your password to play on '.$config['server']['serverName'].'.
		    Please keep your account number and password in a safe place and
		    never give your account number or password to anybody.<BR><BR>';
		if($config['site']['send_emails'] == "yes")
		{
			$mailBody = '<html>
			<body>
			<h3>Your account number and password!</h3>
			<p>You or someone else registred on server <a href="http://'.$_SERVER['SERVER_NAME'].$config['site']['subfolder'].'"><b>'.$config['server']['serverName'].'</b></a> with this e-mail.</p>
			<p>Account number: <b>'.$number.'</b></p>
			<p>Password: <b>'.trim($_POST['reg_password']).'</b></p>
			<br />
			<p>After login you can:</p>
			<li>Create new characters
			<li>Change your current password
			<li>Change your current e-mail
			</body>
			</html>';
			require("phpmailer/class.phpmailer.php");
			$mail = new PHPMailer();
			if ($config['site']['smtp_enabled'] == "yes")
			{
				$mail->IsSMTP();
				$mail->Host = $config['site']['smtp_host'];
				$mail->Port = (int)$config['site']['smtp_port'];
				$mail->SMTPAuth = ($config['site']['smtp_auth'] ? true : false);
				$mail->Username = $config['site']['smtp_user'];
				$mail->Password = $config['site']['smtp_pass'];

			}
			else
				$mail->IsMail();
			$mail->IsHTML(true);
			$mail->From = $config['site']['mail_address'];
			$mail->AddAddress($reg_email);
			$mail->Subject = $config['server']['serverName']." - Registration";
			$mail->Body = $mailBody;
			if($mail->Send())
				$main_content .= '<br /><small>These informations were send on email address <b>'.$reg_email.'</b>. Please check your inbox.';
			else
				$main_content .= '<br /><small>An error occorred while sending email!';
		}
			$main_content .= '</TD></TR></TABLE>
		</TD></TR>
		</TABLE><BR><BR>';
	}
	else
	{
		//SHOW ERRORs if data from form is wrong
		$main_content .= '<div class="SmallBox" >  <div class="MessageContainer" >    <div class="BoxFrameHorizontal" style="background-image:url('.$layout_name.'/images/content/box-frame-horizontal.gif);" /></div>    <div class="BoxFrameEdgeLeftTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);" /></div>    <div class="BoxFrameEdgeRightTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);" /></div>    <div class="ErrorMessage" >      <div class="BoxFrameVerticalLeft" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);" /></div>      <div class="BoxFrameVerticalRight" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);" /></div>      <div class="AttentionSign" style="background-image:url('.$layout_name.'/images/content/attentionsign.gif);" /></div><b>The Following Errors Have Occurred:</b><br/>';
		foreach($reg_form_errors as $show_msg)
		{
					$main_content .= '<li>'.$show_msg;
		}
		$main_content .= '</div>    <div class="BoxFrameHorizontal" style="background-image:url('.$layout_name.'/images/content/box-frame-horizontal.gif);" /></div>    <div class="BoxFrameEdgeRightBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);" /></div>    <div class="BoxFrameEdgeLeftBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);" /></div>  </div></div><br/>
		<BR>
		<CENTER>
		<TABLE BORDER=0 CELLSPACING=0 CELLPADDING=0><FORM ACTION=index.php?subtopic=createaccount METHOD=post><TR><TD>
		<INPUT TYPE=hidden NAME=email VALUE="">

		<INPUT TYPE=image NAME="Back" ALT="Back" SRC="'.$layout_name.'/images/buttons/sbutton_back.gif" BORDER=0 WIDTH=120 HEIGHT=18>
		</TD></TR></FORM></TABLE>
		</CENTER>';
	}
}
?>