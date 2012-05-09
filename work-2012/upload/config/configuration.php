<?php

/*
 * OpenTibiaAAC Project 2012
 *
 * @package		OpenTibiaAAC
 * @version		0.1 pre-alfa
 * @license		http://opensource.org/licenses/gpl-license.php GNU General Public License v3
 *
*/

$SystemConfig = array
(
	// Main
	'basepath'	=> './',
	'cachedir'	=> './cache',
	'compile_dir'	=> './templates_c',
	'modulespath'	=> './modules/',
	'templatespath' => './templates/',

	'timezone'	=> 'Europe/Warsaw',
	'charset'	=> 'UTF-8',
	
	'sql_connect'	=> true,
	'sql_host'	=> 'localhost',
	
	'template'	=> 'tibiacom',
	'site_news'	=> 5
)

foreach($SystemConfig as $key => $value) define(strtoupper($key), $value);

/*
 * Database configuration
*/

$config_db = array
(
	'host'		=> SQL_HOST,
	'user'		=> 'devel',
	'password'	=> 'Chujowe@12a!',
	'database'	=> 'euforia_laptop'.
);

/*
 * Countries
*/

$allowed_countries = array(
	'af' => 'Afghanistan',
	'al' => 'Albania',
	'dz' => 'Algeria',
	'as' => 'American Samoa',
	'ad' => 'Andorra',
	'ao' => 'Angola',
	'ai' => 'Anguilla',
	'aq' => 'Antarctica',
	'ag' => 'Antigua and Barbuda',
	'ar' => 'Argentina',
	'am' => 'Armenia',
	'aw' => 'Aruba',
	'au' => 'Australia',
	'at' => 'Austria',
	'az' => 'Azerbaijan',
	'bs' => 'Bahamas',
	'bh' => 'Bahrain',
	'bd' => 'Bangladesh',
	'bb' => 'Barbados',
	'by' => 'Belarus',
	'be' => 'Belgium',
	'bz' => 'Belize',
	'bj' => 'Benin',
	'bm' => 'Bermuda',
	'bt' => 'Bhutan',
	'bo' => 'Bolivia',
	'ba' => 'Bosnia and Herzegowina',
	'bw' => 'Botswana',
	'bv' => 'Bouvet Island',
	'br' => 'Brazil',
        'io' => 'British Indian Ocean Territory',
        'bn' => 'Brunei Darussalam',
        'bg' => 'Bulgaria',
        'bf' => 'Burkina Faso',
        'bi' => 'Burundi',
        'kh' => 'Cambodia',
        'cm' => 'Cameroon',
        'ca' => 'Canada',
        'cv' => 'Cape Verde',
        'ky' => 'Cayman Islands',
        'cf' => 'Central African Republic',
        'td' => 'Chad',
        'cl' => 'Chile',
        'cn' => 'China',
        'cx' => 'Christmas Island',
        'cc' => 'Cocos Islands',
        'co' => 'Colombia',
        'km' => 'Comoros',
        'cd' => 'Congo',
        'cg' => 'Congo',
        'ck' => 'Cook Islands',
        'cr' => 'Costa Rica',
        'ci' => 'Cote DIvoire',
        'hr' => 'Croatia',
        'cu' => 'Cuba',
        'cy' => 'Cyprus',
        'cz' => 'Czech Republic',
        'dk' => 'Denmark',
        'dj' => 'Djibouti',
        'dm' => 'Dominica',
        'do' => 'Dominican Republic',
        'tp' => 'East Timor',
        'ec' => 'Ecuador',
        'eg' => 'Egypt',
        'sv' => 'El Salvador',
        'gq' => 'Equatorial Guinea',
        'er' => 'Eritrea',
        'ee' => 'Estonia',
        'et' => 'Ethiopia',
        'fk' => 'Falkland Islands',
        'fo' => 'Faroe Islands',
        'fj' => 'Fiji',
        'fi' => 'Finland',
        'fr' => 'France',
        'gf' => 'French Guiana',
        'pf' => 'French Polynesia',
        'tf' => 'French Southern Territories',
        'ga' => 'Gabon',
        'gm' => 'Gambia',
        'ge' => 'Georgia',
        'de' => 'Germany',
        'gh' => 'Ghana',
        'gi' => 'Gibraltar',
        'gr' => 'Greece',
        'gl' => 'Greenland',
        'gd' => 'Grenada',
        'gp' => 'Guadeloupe',
        'gu' => 'Guam',
        'gt' => 'Guatemala',
        'gn' => 'Guinea',
        'gw' => 'Guinea-Bissau',
        'gy' => 'Guyana',
        'ht' => 'Haiti',
        'hm' => 'Heard and Mc Donald Islands',
        'hn' => 'Honduras',
        'hk' => 'Hong Kong',
        'hu' => 'Hungary',
        'is' => 'Iceland',
        'in' => 'India',
        'id' => 'Indonesia',
        'ir' => 'Iran',
        'iq' => 'Iraq',
        'ie' => 'Ireland',
        'il' => 'Israel',
        'it' => 'Italy',
        'jm' => 'Jamaica',
        'jp' => 'Japan',
        'jo' => 'Jordan',
        'kz' => 'Kazakhstan',
        'ke' => 'Kenya',
        'ki' => 'Kiribati',
        'kr' => 'Korea',
        'kp' => 'Korea',
        'kw' => 'Kuwait',
        'kg' => 'Kyrgyzstan',
        'la' => 'Lao Peoples Democratic Republic',
        'lv' => 'Latvia',
        'lb' => 'Lebanon',
        'ls' => 'Lesotho',
        'lr' => 'Liberia',
        'ly' => 'Libyan Arab Jamahiriya',
        'li' => 'Liechtenstein',
        'lt' => 'Lithuania',
        'lu' => 'Luxembourg',
        'mo' => 'Macau',
        'mk' => 'Macedonia',
        'mg' => 'Madagascar',
        'mw' => 'Malawi',
        'my' => 'Malaysia',
        'mv' => 'Maldives',
        'ml' => 'Mali',
        'mt' => 'Malta',
        'mh' => 'Marshall Islands',
        'mq' => 'Martinique',
        'mr' => 'Mauritania',
        'mu' => 'Mauritius',
        'yt' => 'Mayotte',
        'mx' => 'Mexico',
        'fm' => 'Micronesia',
        'md' => 'Moldova',
        'mc' => 'Monaco',
        'mn' => 'Mongolia',
        'ms' => 'Montserrat',
        'ma' => 'Morocco',
        'mz' => 'Mozambique',
        'mm' => 'Myanmar',
        'na' => 'Namibia',
        'nr' => 'Nauru',
        'np' => 'Nepal',
        'nl' => 'Netherlands',
        'an' => 'Netherlands Antilles',
        'nc' => 'New Caledonia',
        'nz' => 'New Zealand',
        'ni' => 'Nicaragua',
        'ne' => 'Niger',
        'ng' => 'Nigeria',
        'nu' => 'Niue',
        'nf' => 'Norfolk Island',
        'mp' => 'Northern Mariana Islands',
        'no' => 'Norway',
        'om' => 'Oman',
        'pk' => 'Pakistan',
        'pw' => 'Palau',
        'pa' => 'Panama',
        'pg' => 'Papua New Guinea',
        'py' => 'Paraguay',
        'pe' => 'Peru',
        'ph' => 'Philippines',
        'pn' => 'Pitcairn',
        'pl' => 'Poland',
        'pt' => 'Portugal',
        'pr' => 'Puerto Rico',
        'qa' => 'Qatar',
        're' => 'Reunion',
        'ro' => 'Romania',
        'ru' => 'Russian Federation',
        'rw' => 'Rwanda',
        'kn' => 'Saint Kitts and Nevis',
        'lc' => 'Saint Lucia',
        'ws' => 'Samoa',
        'sm' => 'San Marino',
        'st' => 'Sao Tome and Principe',
        'sa' => 'Saudi Arabia',
        'sn' => 'Senegal',
        'sc' => 'Seychelles',
        'sl' => 'Sierra Leone',
        'sg' => 'Singapore',
        'sk' => 'Slovakia',
        'si' => 'Slovenia',
        'sb' => 'Solomon Islands',
        'so' => 'Somalia',
        'za' => 'South Africa',
        'es' => 'Spain',
        'lk' => 'Sri Lanka',
        'sh' => 'St. Helena',
        'pm' => 'St. Pierre and Miquelon',
        'sd' => 'Sudan',
        'sr' => 'Suriname',
        'sj' => 'Svalbard and Jan Mayen Islands',
        'sz' => 'Swaziland',
        'se' => 'Sweden',
        'ch' => 'Switzerland',
        'sy' => 'Syrian Arab Republic',
        'tw' => 'Taiwan',
        'tj' => 'Tajikistan',
        'tz' => 'Tanzania',
        'th' => 'Thailand',
        'tg' => 'Togo',
        'tk' => 'Tokelau',
        'to' => 'Tonga',
        'tt' => 'Trinidad and Tobago',
        'tn' => 'Tunisia',
        'tr' => 'Turkey',
        'tm' => 'Turkmenistan',
        'tc' => 'Turks and Caicos Islands',
        'tv' => 'Tuvalu',
        'ug' => 'Uganda',
        'ua' => 'Ukraine',
        'ae' => 'United Arab Emirates',
        'gb' => 'United Kingdom',
        'us' => 'United States',
        'uy' => 'Uruguay',
        'uz' => 'Uzbekistan',
        'vu' => 'Vanuatu',
        'va' => 'Vatican',
        've' => 'Venezuela',
        'vn' => 'Viet Nam',
        'vg' => 'Virgin Islands (British)',
        'vi' => 'Virgin Islands (US)',
        'wf' => 'Wallis and Futuna Islands',
        'eh' => 'Western Sahara',
        'ye' => 'Yemen',
        'yu' => 'Yugoslavia',
        'zm' => 'Zambia',
        'zw' => 'Zimbabwe'
);

/*
 * Vocations 
*/

$vocation_name[0] = array(0 => 'None', 1 => 'Sorcerer', 2 => 'Druid', 3 => 'Paladin', 4 => 'Knight');
$vocation_name[1] = array(1 => 'Master Sorcerer', 2 => 'Elder Druid', 3 => 'Royal Paladin', 4 => 'Elite Knight');

/*
 * Towns - only for display in character page
*/

$towns = array
(
1 => 'Darashia',
2 => 'Carlin',
3 => 'Venore',
4 => 'Ab\'Dendriel',
5 => 'Thais',
6 => 'Edron',
7 => 'Ankrahmun',
8 => 'Svargrond',
9 => 'Yalahar',
10 => 'Liberty Bay',
11 => 'Port Hope',
12 => 'Gengia',
13 => 'Pyre',
14 => 'Oken',
15 => 'Pyre 1',
16 => 'Avalon',
17 => 'Nhorolieth',
18 => 'Polaris',
19 => 'Desert',
20 => 'GM Isle'
);

/*
 * Towns - only for account creation
*/

$towns_create = array
(
1 => 'Darashia',
2 => 'Carlin',
3 => 'Venore',
4 => 'Ab\'Dendriel',
5 => 'Thais',
6 => 'Edron',
7 => 'Ankrahmun',
8 => 'Svargrond',
9 => 'Yalahar',
10 => 'Liberty Bay',
11 => 'Port Hope',
12 => 'Gengia',
13 => 'Pyre',
14 => 'Oken',
15 => 'Pyre 1',
16 => 'Avalon',
17 => 'Nhorolieth',
18 => 'Polaris',
19 => 'Desert'
);

/*
 * Groups - Players Groups
*/

$groups = array
(
1 => 'Player',
2 => 'Tutor',
3 => 'Senior Tutor',
4 => 'Game Master',
5 => 'Community Manager',
6 => 'God'
);

/*
 * Account access for edit webpage
*/

interface ACCESS
{
	const USER = 0;
	const MOD = 1;
	const ADMIN = 2;
}

/**#@-*/

/* TODO


// Admin option
$config['site']['access_admin_panel'] = 6;

// World option
$config['site']['worlds'] = array(0 => 's1', 1 => 's2');

// News option
$config['site']['access_tickers'] = 5;
$config['site']['access_news'] = 6;
$config['site']['langSystem'] = 1;
	// Limit show news on site
	$config['site']['news_ticks_limit'] = 5;
	$config['site']['news_big_limit'] = 10;
	$config['site']['chooseLang'] = 'pl';

// Create Account option
$config['site']['verify_code'] = 1;
$config['site']['one_email'] = 0;
$config['site']['choose_countr'] = 1;
$config['site']['referrer'] = 0;
$config['site']['newaccount_premdays'] = 3;
	// ReCapatha
	$config['site']['publickey'] = "6LfZAAoAAAAAALswKC2UCdCo_wf3ilh_C0qBhQJs "; // Public Key
	$config['site']['privkey'] = "6LfZAAoAAAAAAA7_sZX1ZPomaqqTKBka5t6so0Un";; // Private Key
	// Use only if configure emial sender
	$config['site']['send_register_email'] = 0; // send e-mail when register account
	$config['site']['create_account_verify_mail'] = 0; // when create account player must use right e-mail, he will receive random password to account like on RL tibia, 1 = yes, 0 = no
	$config['site']['send_mail_when_change_password'] = 0; // send e-mail with new password when change password to account, set 0 if someone abuse to send spam
	$config['site']['send_mail_when_generate_reckey'] = 0; // send e-mail with rec key (key is displayed on page anyway when generate), set 0 if someone abuse to send spam

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

// character option
$config['site']['showStatistic'] = 0;
$config['site']['showAdvenceStatistic'] = 0;
$config['site']['showQuests'] = 0;
$config['site']['showVipList'] = 0;
$config['site']['showVictims'] = 0;
	// Limit show
	$config['site']['limitDeath'] = 10;
	$config['site']['limitVictims'] = 10;
	
// Guilds option
$config['site']['guild_need_level'] = 8;
$config['site']['guild_need_pacc'] = 0;
$config['site']['guild_image_size_kb'] = 50;
$config['site']['guild_description_chars_limit'] = 1000;
$config['site']['guild_description_lines_limit'] = 6;
$config['site']['guild_motd_chars_limit'] = 150;
	// Show statistics Guild
	$config['site']['showStat'] = 0;
	$config['site']['showAdvenceStat'] = 0;

// Page option
	// Page
	$config['site']['download_page'] = 0;
	$config['site']['serverinfo_page'] = 1;
	$config['site']['gallery_page'] = 0;
	$config['site']['credits_page'] = 1;
	$config['site']['forum_link'] = "";
	// Info
	$config['site']['quests'] = array('Gazbran Room' => 5500, 'Annihilator' => 5000, 'Demon Helmet' => 2645, 'Pits of Inferno' => 5550); // list of quests, 'questname' => storage-id,
	$config['site']['show_flag'] = 0;
	$config['site']['showMoreInfo'] = 0;
	$config['site']['show_creationdate'] = 1;
	$config['site']['players_group_id_block'] = 2;
		// Limit
		$config['site']['limit_show_death'] = 50;
		// Show name vocation world -- $vocation_name[getWorld][getPromotion]
		$vocation_name[0][0] = array(0 => 'None', 1 => 'Sorcerer', 2 => 'Druid', 3 => 'Paladin', 4 => 'Knight'); 
		$vocation_name[0][1] = array(1 => 'Master Sorcerer', 2 => 'Elder Druid', 3 => 'Royal Paladin', 4 => 'Elite Knight'); 
		$vocation_name[1][0] = array(0 => 'None', 1 => 'Sorcerer', 2 => 'Druid', 3 => 'Paladin', 4 => 'Knight'); 
		$vocation_name[1][1] = array(1 => 'Master Sorcerer', 2 => 'Elder Druid', 3 => 'Royal Paladin', 4 => 'Elite Knight'); 
		// Show name town in world -- $towns_list[getWorld][getTownId]
		$towns_list[0] = array(1 => 'Venore', 2 => 'Edron', 3 => 'Thais', 4 => 'Carlin');
		$towns_list[1] = array(1 => 'Venore', 2 => 'Elion');
		// Constant Mana -- $vocationConstantMana[getWorld][getVocation]
		$vocationConstantMana[0] = array(0 => 4.0, 1 => 1.1, 2 => 1.1, 3 => 1.4, 4 => 3.0);
		$vocationConstantMana[1] = array(0 => 4.0, 1 => 1.1, 2 => 1.1, 3 => 1.4, 4 => 3.0);

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
*/
?>
