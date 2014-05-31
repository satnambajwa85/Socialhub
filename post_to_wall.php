<?php
# We require the library
if(isset($_POST['submit']))
{
require 'facebook/facebook.php';
require 'config/fbconfig.php';
require 'config/functions.php';

$facebook = new Facebook(array(
            'appId' => APP_ID,
            'secret' => APP_SECRET,
            ));
# Let's see if we have an active session
 	try{
		$uid = $facebook->getUser();
		
		# let's check if the user has granted access to posting in the wall
		$api_call = array(
			'method' => 'users.hasAppPermission',
			'uid' => $uid,
			'ext_perm' => 'publish_stream'
		);
		$can_post = $facebook->api($api_call);
		$message=$_POST['status'];
		if($can_post){
			# post it!
			$facebook->api('/'.$uid.'/feed', 'post', array('message' => $message));
			
			# using all the arguments
			$facebook->api('/'.$uid.'/feed', 'post', array(
				'message' => $message,
				'name' => 'API TEST',
				'description' => 'Hackthon Testing for SocialHub',
				'caption' => 'SocialHub',
				'picture' => 'http://www.maloon.de/sites/default/files/styles/fullhd/public/SocialHubLogo_0.png',
				'link' => 'http://admin.cricmasti.info/'
			));
			echo 'Posted!';
		} else {
			die('Permissions required!');
		}
	} catch (Exception $e){
	echo $e;die;
	}
}
?>
 <html>
 	<head>
		<title>
			Update Status</title>
	</head>
	<body>
		<form action=" " method="post" name="Status">
			<textarea label="Status" placeholder="what's in you mind" name='status'></textarea>
			<input type="submit" value="Post" name="submit"/>
		</form>
	</body>
</html>