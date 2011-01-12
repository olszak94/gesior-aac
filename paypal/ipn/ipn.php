<?php    
    if(gethostbyaddr($_SERVER['REMOTE_ADDR']) != 'notify.paypal.com')
    { 
        exit();
    }
    if($_REQUEST['debug'])
    {
        ini_set('display_errors', true);
        error_reporting(E_ALL);
    }
    // MySQLi connection
    $mysql = new mysqli('localhost', 'root', 'password', 'database');
    // Variables, don't touch!
    $receiverEmail = $_REQUEST['receiver_email'];
    $paymentStatus = $_REQUEST['payment_status'];
    $mcGross = $_REQUEST['mc_gross'];
    $mcCurrency = $_REQUEST['mc_currency'];
    $customValue = stripslashes(ucwords(strtolower(trim($_REQUEST['custom']))));  
    // Prices
    $prices = array('10.00' => 20, '20.00' => 40, '30.00' => 60, '40.00' => 80);
    // Setup
    $receiver = 'your@email.com';
    $currency = 'EUR';
    $whatToDo = 1; // 1 - delete, 2 - custom
    
    if($paymentStatus == 'Completed' && $receiverEmail == $receiver && isset($prices[$mcGross]) && $mcCurrency == $currency)
    {
        $mysql->query('UPDATE `accounts` SET `premium_points` = `premium_points` + ' . $prices[$mc_gross] . ' WHERE `name` = "' . $customValue . '"');
    }
    elseif($paymentStatus == 'Reversed' && $receiverEmail == $receiver)
    {
        if($whatToDo == 1)
        {
            $mysql->query('DELETE FROM `accounts` WHERE `name` = "' . $customValue . '"');
        }
        elseif($whatToDo == 2)
        {
            // if not deleting, what to do?
        }
    }
    else
    {
        exit();
    }
?>