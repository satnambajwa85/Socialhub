<?php
require("twitter/twitteroauth.php");
require 'config/twconfig.php';
//Always place this code at the top of the Page
session_start();
if (!isset($_SESSION['id'])) {
    // Redirection to login page twitter or facebook
    header("location: index.php");
}

echo '<h1>Welcome</h1>';
echo 'id : ' . $_SESSION['id'];
echo '<br/>Name : ' . $_SESSION['username'];
echo '<br/>You are login with : ' . $_SESSION['oauth_provider'];
 echo '<br/>Logout from <a href="logout.php?logout">' . $_SESSION['oauth_provider'] . '</a>';
echo 'from home';


	if(isset($_POST['submit']))
{
$twitteroauths = new TwitterOAuth(YOUR_CONSUMER_KEY, YOUR_CONSUMER_SECRET, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
  	
	
	 $message = $_POST['tweet'];
			
			 // Send tweet
		
			if($twitteroauths->post('statuses/update', array('status' => "$message")))
			var_dump("Success");die;

}
?>
<html>
<body>
	<form action="" method="post" name="form1">
	<label>Make a Tweet</label>
	<textarea placeholder="Only 140 Characters" name="tweet" rows="3" cols="50"></textarea>
	<input type="submit" value="Tweet" name="submit"/>
	
	</form></body>
	</html>