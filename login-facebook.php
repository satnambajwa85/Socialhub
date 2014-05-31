
<?php

require 'facebook/facebook.php';
require 'config/fbconfig.php';
require 'config/functions.php';

$facebook = new Facebook(array(
            'appId' => APP_ID,
            'secret' => APP_SECRET,
            ));

 
$user = $facebook->getUser();
if ($user) {

	  try {
		// Proceed knowing you have a logged in user who's authenticated.
		//var_dump($facebook->api('/me'));
//		die;
 	
		$user_profile = $facebook->api('/me');
		
	  } 
	catch (FacebookApiException $e) 
	{
		error_log($e);
		$user = null;
	  }

	if (!empty($user_profile ))
	 {
        # User info ok? Let's print it (Here we will be adding the login and registering routines)
  
        $username = $user_profile['name'];
			 $uid = $user_profile['id'];
		 $email = $user_profile['email'];
		 $twitter_otoken='';
		 $twitter_otoken_secret='';
        $user = new User();
        $userdata = $user->checkUser($uid, 'facebook', $username,$email,$twitter_otoken ,$twitter_otoken_secret);
        if(!empty($userdata))
		{
           // session_start();
            $_SESSION['id'] = $userdata['id'];
			$_SESSION['oauth_id'] = $uid;
            $_SESSION['username'] = $userdata['username'];
			$_SESSION['email'] = $email;
            $_SESSION['oauth_provider'] = $userdata['oauth_provider'];
            header("Location: home.php");
        }
    } 
	else
	 {
        # For testing purposes, if there was an error, let's kill the script
        die("There was an error Occured.");
    }
} 
else
{
//$params = array(
//    'canvas' => 1,
//    'scope'  => 'publish_stream,email,user_about_me,user_birthday,user_website',
//    'fbconnect' => 1,
//    'redirect_uri' => 'https://apps.facebook.com/280973568648095',
//);
//
//
//$fb_login_url = $facebook->getLoginUrl($params);
//header("Location:".$fb_login_url);
   // # There's no active session, let's generate one
	$login_url = $facebook->getLoginUrl(array( 'scope' => 'email,publish_stream,read_stream,manage_notifications,read_mailbox'));
    header("Location: " . $login_url);
}
?>
