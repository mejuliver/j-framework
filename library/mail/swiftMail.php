<?php namespace App\Library;

class swiftMail{

	function __construct(){

	}

	public function sendEmail($params = []){

		if( count($params) == 0 ){
			var_dump('You need to supply the email needed parameters');
			exit;
		}

		 /*----------------------------------------------------------------------------*\
		|*  Email settings for sending all emails from your website forms.              *|
		 \*============================================================================*/

		// Choose here whether to use php mail() function or your SMTP server (recommended) to send the email.
		// Use 'smtp' for better reliability, or use 'phpmail' for quick + easy setup with lower reliability.
		$emailMethod                = $params['mode'] ? $params['mode'] : 'smtp'; // REQUIRED value. Options: 'smtp' , 'phpmail'

		// Outgoing Server Settings - replace values on the right of the = sign with your own.
		// These 3 settings are only required if you choose 'smtp' for emailMethod above.
		$outgoingServerAddress      = $params['outgoing'] ? $params['outgoing'] : 'mail.yourdomain.com'; // Consult your hosting provider.
		$outgoingServerPort         = $params['outgoing_port'] ? $params['outgoing_port'] : '25';                  // Options: '587' , '25' - Consult your hosting provider.
		$outgoingServerSecurity     = $params['outgoing_mode'] ? $params['outgoing_mode'] : 'tls';                 // Options: 'ssl' , 'tls' , null - Consult your hosting provider.

		// Sending Account Settings - replace these details with an email account held on the SMTP server entered above.
		// These 2 settings are only required if you choose 'smtp' for emailMethod above.
		$sendingAccountUsername     = $params['username'] ? $params['username'] : 'email@domain.com';
		$sendingAccountPassword     = $params['password'] ? $params['password'] : '';

		// Recipient (To:) Details  - Change this to the email details of who will receive all the emails from the website.
		$recipientEmail             = $params['to'] ? $params['to'] : 'email@yourdomain.com'; // REQUIRED value.
		$recipientName              = $params['to_name'] ? $params['to_name'] : 'John Doe';             // REQUIRED value.

		// Email details            - Change these to suit your website needs
		$emailSubject               = $params['subject'] ? $params['subject'] : 'A message from Your Website'; // REQUIRED value. Subject of the email that the recipient will see
		$websiteName                = $params['website'] ? $params['website'] : 'Your Website';                // REQUIRED value. This is used when a name or email is not collected from the website form

		$timeZone					= $params['timezone'] ? $params['timezone'] : 'Australia/Melbourne';         // OPTIONAL, but some servers require this to be set. 
		                                                             // See a list of all supported timezones at: http://php.net/manual/en/timezones.php
		 /*----------------------------------------------------------------------------*\
		|*  You do not need to edit anything below this line, the rest is automatic.    *|
		 \*============================================================================*/
		 

		 //error_reporting(-1);
		//ini_set('display_errors', 'On');

		// Set default timezone as some servers do not have this set.
		if(isset($timeZone) && $timeZone != ""){
			date_default_timezone_set($timeZone);
		}
		else{
			date_default_timezone_set("UTC");
		}

		// Require the Swift Mailer library
		require_once 'swift_required.php';

		$messageText = "";

		if($emailMethod == 'phpmail'){ 
			$transport = Swift_MailTransport::newInstance(); 
		}elseif($emailMethod == 'smtp'){
		    $transport = Swift_SmtpTransport::newInstance( $outgoingServerAddress, $outgoingServerPort, $outgoingServerSecurity )
		    ->setUsername( $sendingAccountUsername )     
		    ->setPassword( $sendingAccountPassword );
		}

		$mailer = Swift_Mailer::newInstance($transport);

		// Creating the message text using fields sent through POST
		foreach ($_POST as $key => $value)
		{
			// Sets of checkboxes will be shown as comma-separated values as they are passed in as an array.
			if(is_array($value)){
				$value = implode(', ' , $value);
			}
			$messageText .= ucfirst($key).": ".$value."\n\n";
		}

		if(isset($_POST['email']) && isset($_POST['name']) ){
			$fromArray = array($_POST['email'] => $_POST['name']);
		}else{ $fromArray = array($sendingAccountUsername => $websiteName); }

		$message = Swift_Message::newInstance($emailSubject)
		  ->setFrom($fromArray)
		  ->setTo(array($recipientEmail => $recipientName))->setBody($messageText);

		// Send the message or catch an error if it occurs.
		try{
			echo($mailer->send($message));
		}
		catch(Exception $e){
			echo($e->getMessage());
		}
		exit;
	}
}