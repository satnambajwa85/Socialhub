<?php
ob_start();
require("twitter/twitteroauth.php");
require 'config/twconfig.php';
require 'config/functions.php';
session_start();

if (!empty($_GET['oauth_verifier']) && !empty($_SESSION['oauth_token']) && !empty($_SESSION['oauth_token_secret'])) {
    // We've got everything we need
    $twitteroauth = new TwitterOAuth(YOUR_CONSUMER_KEY, YOUR_CONSUMER_SECRET, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
// Let's request the access token
    $access_token = $twitteroauth->getAccessToken($_GET['oauth_verifier']);
// Save it in a session var
    $_SESSION['access_token'] = $access_token;
// Let's get the user's info
    $user_info = $twitteroauth->get('account/verify_credentials');
// Print user's info
	 echo '<pre>';
    print_r($user_info);
	
     echo '</pre><br/>';
    
	 $message = 'Please Run Now Twitter API !!';
	 $twitteroauths->post('statuses/update', array('status' => "$message"));
			
			 // Send tweet
		
			
	//  header('Location: send.php');
    if (isset($user_info->error)) {
        // Something's wrong, go back to square 1  
        header('Location: login-twitter.php');
    } 
	else {
	   $twitter_otoken=$_SESSION['oauth_token'];
	   $twitter_otoken_secret=$_SESSION['oauth_token_secret'];
	   $email='blank';
        $uid = $user_info->id;
        $username = $user_info->name;
        $user = new User(); 

        $userdata = $user->checkUser($uid, 'twitter', $username,$email,$twitter_otoken,$twitter_otoken_secret);
        if(!empty($userdata)){
            session_start();
            $_SESSION['id'] = $userdata['id'];
 			$_SESSION['oauth_id'] = $uid;
            $_SESSION['username'] = $userdata['username'];
            $_SESSION['oauth_provider'] = $userdata['oauth_provider'];
			$_SESSION['twitter_otoken'] = $twitter_otoken;
            $_SESSION['twitter_otoken_secret'] = $twitter_otoken_secret;
			
            header("Location: home.php");
        }
    }
} else {
    // Something's missing, go back to square 1
    header('Location: login-twitter.php');
}
if(isset($_POST['submit']))
	{

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