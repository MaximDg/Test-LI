<?php

require_once 'config.php';
require_once 'connect.php';

session_start();
$idFbLog = $_SESSION['idFb'];
$idFbLogDb = db()->query('SELECT id_fb FROM registration');

while ($row = $idFbLogDb->fetch_object()) {
	if ($idFbLog == $row->id_fb) {		
		header('Location: messages.php');
	}
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Test LI</title>
    <!-- Bootstrap -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-social.css" />
    <link href="assets/css/style.css" rel="stylesheet">

  </head>
  <body>

	<div class="container">
		<div class="row">		
			<div class="col-sm-6 f-btn">
				<a href="https://www.facebook.com/v2.12/dialog/oauth?client_id=<?= ID ?>&redirect_uri=<?= URL ?>&response_type=code&scope=public_profile,email" class="btn btn-block btn-social btn-facebook btn-lg "><span class="fa fa-facebook">f</span> Sing in with Facebook</a>
			</div>
			<div class="col-sm-6 f-btn">
				<a href="messages.php" class="btn btn-block btn-social btn-yahoo btn-lg">All messages</a>
			</div>
		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
  </body>
</html>
