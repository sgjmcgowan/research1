<?php

  function logIn($username, $password, $ip) {
    require_once('connect.php');

    $lockout = 0; //variable to counter number of unsuccessful login attempts.
    $username = mysqli_real_escape_string($link, $username);
    $password = mysqli_real_escape_string($link, $password);
    $loginstring = "SELECT * FROM tbl_user WHERE user_name = '{$username}' AND user_pass = '{$password}'";
    $user_set = mysqli_query($link, $loginstring);

    if(mysqli_num_rows($user_set)) {
      $found_user = mysqli_fetch_array($user_set, MYSQLI_ASSOC);
      $id = $found_user['user_id'];
      $_SESSION['user_id'] = $id;
      $_SESSION['user_timestamp'] = $timeStamp; //pull timestamp data to display
      $_SESSION['user_datestamp'] = $dateStamp; //pull datestamp data to display
      $newTimestamp = date('H:i'); // current time to be recorded as login time.
      $newDatestamp = date('D M Y'); // current date to be recorded as login time
      $_SESSION['user_name'] = $found_user['user_fname'];

      if(mysqli_query($link, $loginstring)) {
        $updatestring = "UPDATE tbl_user SET user_ip='$ip' WHERE user_id=$id";
        $updatequery = mysqli_query($link, $updatestring);
        $updateTimestamp = "UPDATE tbl_user SET user_timestamp='$newTimestamp' WHERE user_id='$id'"; //query for timestamp update
        $updateDatestamp = "UPDATE tbl_user SET user_datestamp='$newDatestamp' WHERE user_id='$id'";
        $updateTimeQuery = mysqli_query($link, $updateTimestamp); // send the update to the database to be called next login
        $updateDateQuery = mysqli_query($link, $updateDatestamp);

        if($newTimestamp > 0 && < 12:00) {
          $greetingMessage = "Good morning. I hope it's not too early.";
        } elseif($newTimestamp > 12:00 && < 6:00) {
          $greetingMessage = "Good afternoon. I hope you remembered to have lunch.";
        } elseif($newTimestamp > 6:00 && < 11:59) {
          $greetingMessage = "Good evening. Try not to stay up too late.";
        }

      }

      $lockout = 0; //reset lockout count to 0 on successful login.
      $updateLockout = "UPDATE tbl_user SET user_lockout='0' WHERE user_id='$id'";
      $updateLockoutQuery = mysqli_query($link, $updateLockout);
      redirect_to('admin_index.php');

    } elseif('user_lockout' >= 3) {
      $message = "You have too many failed login attempts. Contact your system Admin to reset your login."
      return $message;
    }
    } else {
      $lockout += 1;
      $message = "Nah, brah.";
      return $message;
    }

    mysqli_close($link);
  }

?>
