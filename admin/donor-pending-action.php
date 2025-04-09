<?php require_once('header.php'); ?>

<?php
// Preventing the direct access of this page.
if(!isset($_REQUEST['id'])) {
	header('location: logout.php');
	exit;
} else {
	// Check the id is valid or not
	$statement = $pdo->prepare("SELECT * FROM tbl_donor WHERE donor_id=?");
	$statement->execute(array($_REQUEST['id']));
	$total = $statement->rowCount();
	if( $total == 0 ) {
		header('location: logout.php');
		exit;
	}
}
?>

<?php
	
	$statement = $pdo->prepare("UPDATE tbl_donor SET status=? WHERE donor_id=?");
	$statement->execute(array(1,$_REQUEST['id']));

	// Send email to agent that his item is approved
	
	// getting agent id from tbl_donor
	$statement = $pdo->prepare("SELECT * FROM tbl_donor WHERE donor_id=?");
	$statement->execute(array($_REQUEST['id']));
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
	foreach ($result as $row) {
		$agent_id = $row['agent_id'];
	}

	// getting agent email address from tbl_agent
	$statement = $pdo->prepare("SELECT * FROM tbl_agent WHERE agent_id=?");
	$statement->execute(array($agent_id));
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
	foreach ($result as $row) {
		$agent_email = $row['agent_email'];
	}

	$donor_page_url = BASE_URL.'donor.php?id='.$_REQUEST['id'];

	$msg = 'Your update for the selected donor information is approved successfully! Please visit the following link to see it live: <br><a href="'.$donor_page_url.'">'.$donor_page_url.'</a>';

	$statement = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=1");
	$statement->execute();
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
	foreach ($result as $row) 
	{
		$send_email_from = $row['send_email_from'];
		$receive_email_to = $row['receive_email_to'];
		$smtp_host = $row['smtp_host'];
		$smtp_port = $row['smtp_port'];
		$smtp_username = $row['smtp_username'];
		$smtp_password = $row['smtp_password'];
	}

	require_once '../vendor/autoload.php';

	$transport = (new Swift_SmtpTransport($smtp_host, $smtp_port))
	->setUsername($smtp_username)
	->setPassword($smtp_password);

	$mailer = new Swift_Mailer($transport);

	$message = (new Swift_Message('Your donor update is approved and is live now.'))
	->setFrom([$send_email_from])
	->setTo([$agent_email])
	->setReplyTo([$receive_email_to])
	->setBody($msg,'text/html');

	$mailer->send($message);

	header('location: donor-pending.php');
?>