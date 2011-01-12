<?PHP
// Admin option
$config['site']['access_admin_panel'] = 6;

// World option
$config['site']['worlds'] = array(0 => 's1', 1 => 's2');

// Create Account option
$config['site']['verify_code'] = 1;
$config['site']['one_email'] = 0;
$config['site']['choose_countr'] = 1;
$config['site']['newaccount_premdays'] = 3;
	// ReCapatha
	$config['site']['publickey'] = "6LfZAAoAAAAAALswKC2UCdCo_wf3ilh_C0qBhQJs "; // Public Key
	$config['site']['privkey'] = "6LfZAAoAAAAAAA7_sZX1ZPomaqqTKBka5t6so0Un";; // Private Key
	// Use only if configure emial sender
	$config['site']['send_register_email'] = 0; // send e-mail when register account
	$config['site']['create_account_verify_mail'] = 0; // when create account player must use right e-mail, he will receive random password to account like on RL tibia, 1 = yes, 0 = no
	$config['site']['send_mail_when_change_password'] = 0; // send e-mail with new password when change password to account, set 0 if someone abuse to send spam
	$config['site']['send_mail_when_generate_reckey'] = 0; // send e-mail with rec key (key is displayed on page anyway when generate), set 0 if someone abuse to send spam

// Acount option
$config['site']['max_players_per_account'] = 15;
$config['site']['email_days_to_change'] = 1;
	// Generate RecKey
	$config['site']['generate_new_reckey'] = 0; // let player generate new recovery key, he will receive e-mail with new rec key (not display on page, hacker can't generate rec key)
	$config['site']['generate_new_reckey_price'] = 5; // you can get some Premium Points for new rec key
	// New Character option
		// If rook only:	$config['site']['newchar_vocations'][getWorld]
		$config['site']['newchar_vocations'][0] = array(1 => 'Sorcerer Sample', 2 => 'Druid Sample', 3 => 'Paladin Sample', 4 => 'Knight Sample');
		$config['site']['newchar_vocations'][1] = array(0 => 'Rook Sample');
		// If you want choose many town 
		$config['site']['newchar_towns'][0] = array(1, 2, 3, 4, 5);
		$config['site']['newchar_towns'][1] = array(1);
	
// Guilds option
$config['site']['guild_need_level'] = 8;
$config['site']['guild_need_pacc'] = 0;
$config['site']['guild_image_size_kb'] = 50;
$config['site']['guild_description_chars_limit'] = 1000;
$config['site']['guild_description_lines_limit'] = 6;
$config['site']['guild_motd_chars_limit'] = 150;

// News option
$config['site']['access_tickers'] = 5;
$config['site']['access_news'] = 6;
	// Limit show news on site
	$config['site']['news_ticks_limit'] = 5;
	$config['site']['news_big_limit'] = 3;

// E-Mail option
$config['site']['send_emails'] = 0;
$config['site']['mail_address'] = "gesiormail@vp.pl";
$config['site']['smtp_enabled'] = "yes";
$config['site']['smtp_host'] = "smtp.poczta.onet.pl";
$config['site']['smtp_port'] = 465;
$config['site']['smtp_auth'] = "yes";
$config['site']['smtp_user'] = "gesiormail@vp.pl";
$config['site']['smtp_pass'] = "qwerty";
$config['site']['email_lai_sec_interval'] = 300;

// Page option
	// Page
	$config['site']['download_page'] = 0;
	$config['site']['serverinfo_page'] = 0;
	$config['site']['gallery_page'] = 0;
	$config['site']['credits_page'] = 1;
	$config['site']['forum_link'] = "";
	// Info
	$config['site']['show_flag'] = 1;
	$config['site']['show_creationdate'] = 1;
	$config['site']['players_group_id_block'] = 2;
		// Limit
		$config['site']['limit_show_death'] = 50;
		// Show name vocation world -- $vocation_name[getWorld][getPromotion]
		$vocation_name[0][0] = array(0 => 'None', 1 => 'Sorcerer', 2 => 'Druid', 3 => 'Paladin', 4 => 'Knight'); 
		$vocation_name[0][1] = array(1 => 'Master Sorcerer', 2 => 'Elder Druid', 3 => 'Royal Paladin', 4 => 'Elite Knight'); 
		$vocation_name[1][0] = array(0 => 'None', 1 => 'Sorcerer', 2 => 'Druid', 3 => 'Paladin', 4 => 'Knight'); 
		$vocation_name[1][1] = array(1 => 'Master Sorcerer', 2 => 'Elder Druid', 3 => 'Royal Paladin', 4 => 'Elite Knight'); 
		// Show name town in world -- $towns_list[getWorld]
		$towns_list[0] = array(1 => 'Venore', 2 => 'Edron', 3 => 'Thais', 4 => 'Carlin');
		$towns_list[1] = array(1 => 'Venore');

// Shop option
$config['site']['shop_system'] = 1;
	// Option for buy points
	$config['site']['paypal_active'] = 0;
	$config['site']['zaypay_active'] = 0;
	$config['site']['dotpay_active'] = 0;
	$config['site']['daopay_active'] = 0;
	$config['site']['homepayActive'] = 0;
	
// Layout option
$config['site']['layout'] = "tibiacom";
?>