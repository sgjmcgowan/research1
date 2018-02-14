<?php

  require_once('phpscripts/config.php');
  confirm_logged_in();

?>

<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>CMS Portal</title>
</head>
<body>

  <h1>Welcome to Your Admin Page!</h1>
  <?php echo "<h2>Hi-{$_SESSION['user_name']}</h2>";?>
  <?php echo "You last logged in on {$dateStamp} at {$timeStamp}.";?>
  <?php echo "{$greetingMessage}"; ?>

</body>
</html>
