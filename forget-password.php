<?php require_once('header.php'); ?>

<?php
$statement = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
foreach ($result as $row) {
	$banner_forget_password = $row['banner_forget_password'];
}
?>

<?php
if(isset($_POST['form1'])) {

	$valid = 1;
        
    if(empty($_POST['agent_email'])) {
        $valid = 0;
        $error_message .= "Email can not be empty.\\n";
    } else {
    	if (filter_var($_POST['agent_email'], FILTER_VALIDATE_EMAIL) === false) {
	        $valid = 0;
	        $error_message .= 'Email address must be valid.\\n';
	    } else {
	    	$statement = $pdo->prepare("SELECT * FROM tbl_agent WHERE agent_email=?");
	    	$statement->execute(array($_POST['agent_email']));
	    	$total = $statement->rowCount();						
	    	if(!$total) {
	    		$valid = 0;
	        	$error_message .= 'You email address is not found in our system.\\n';
	    	}
	    }
    }

    if($valid == 1) {

    	$statement = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=1");
    	$statement->execute();
    	$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
    	foreach ($result as $row) {
    		$receive_email_to = $row['receive_email_to'];
			$send_email_from = $row['send_email_from'];
			$smtp_host = $row['smtp_host'];
			$smtp_port = $row['smtp_port'];
			$smtp_username = $row['smtp_username'];
			$smtp_password = $row['smtp_password'];
    	}

    	$token = md5(rand());
    	$now = time();

		$statement = $pdo->prepare("UPDATE tbl_agent SET agent_token=?,agent_time=? WHERE agent_email=?");
		$statement->execute(array($token,$now,$_POST['agent_email']));
		
		$msg = '<p>To reset your password, please <a href="'.BASE_URL.'reset-password.php?email='.$_POST['agent_email'].'&token='.$token.'">click here</a> and enter a new password for your account';
		
		$to = $_POST['agent_email'];

		require_once 'vendor/autoload.php';

		$transport = (new Swift_SmtpTransport($smtp_host, $smtp_port))
		->setUsername($smtp_username)
		->setPassword($smtp_password);

		$mailer = new Swift_Mailer($transport);

		$message = (new Swift_Message('Password Reset Request'))
		->setFrom([$send_email_from])
		->setTo([$to])
		->setReplyTo([$receive_email_to])
		->setBody($msg,'text/html');

		$mailer->send($message);

		$success_message = "A confirmation link is sent to your email address. You will get the password reset information in there.";
    }
}
?>

<div class="banner-slider" style="background-image: url(<?php echo BASE_URL.'assets/uploads/'.$banner_forget_password; ?>)">
	<div class="bg"></div>
	<div class="bannder-table">
		<div class="banner-text">
			<h1>Forget Password</h1>
		</div>
	</div>
</div>

<div class="login-area bg-area">
	<div class="container">
		<div class="row">
			<?php
			if($error_message != '') {
				echo "<script>alert('".$error_message."')</script>";
			}
			if($success_message != '') {
				echo "<script>alert('".$success_message."')</script>";
			}
			?>
			<div class="col-md-offset-4 col-md-4">
				<div class="login-form">
					<form action="" method="post">
						<div class="form-row">
							<div class="form-group">
								<label for="">Email Address</label>
								<input autocomplete="off" type="email" class="form-control" placeholder="Enter Email Address" name="agent_email">
							</div>
							<button type="submit" class="btn btn-primary" name="form1">Submit</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<?php require_once('footer.php'); ?>