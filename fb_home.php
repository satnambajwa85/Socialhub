<?php
//To fetch basic user information
# We require the library
require 'facebook/facebook.php';
require 'config/fbconfig.php';
require 'config/functions.php';

$facebook = new Facebook(array(
            'appId' => APP_ID,
            'secret' => APP_SECRET,
            ));

if(isset($_POST['submit']))
{

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
			/*$facebook->api('/'.$uid.'/feed', 'post', array(
				'message' => $message,
				'name' => 'API TEST',
				'description' => 'Hackthon Testing for SocialHub',
				'caption' => 'SocialHub',
				'picture' => 'http://www.maloon.de/sites/default/files/styles/fullhd/public/SocialHubLogo_0.png',
				'link' => 'http://admin.cricmasti.info/'
			));*/
			echo 'Posted!';
		} else {
			die('Permissions required!');
		}
	} catch (Exception $e){
	echo $e;die;
	}
}


?>
<?php
$user_homes = $facebook->api('/me/home');
$user_home	=	$user_homes['data'];

require 'header.php';
require 'sidebar.php';	
?>

<header>
 
<nav class="navbar navbar-fixed-top social-navbar social-sm">
<div class="navbar-inner">
<div class="container-fluid">


 
<ul class="nav pull-right nav-indicators">
	<li class="dropdown nav-notifications">
    	<a href="#" class="dropdown-toggle" data-toggle="dropdown">
        	<span class="badge"><?php if(isset($notification)){echo count($notification);}else echo '0';?></span><i class="icon-warning-sign"></i>
        </a>
        <ul class="dropdown-menu">
        	<li class="nav-notifications-header">
            	<a tabindex="-1" href="#">You have <strong><?php if(isset($notification)){echo count($notification);}else echo '0';?></strong> new notifications</a>
            </li>
        </ul>
	</li>

<li class="divider-vertical"></li>
 
<li class="dropdown">
<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-caret-down"></i></a>
<ul class="dropdown-menu">
<li><a href="basic-user-profile.html"><i class="icon-user"></i> My Profile</a></li>
<li><a href="#"><i class="icon-cogs"></i> Settings</a></li>
<li><a href="../login.html"><i class="icon-off"></i> Log Out</a></li>
<li class="divider"></li>
<li><a href="faq.html"><i class="icon-info-sign"></i> Help</a></li>
</ul>
</li>
 
</ul>
 
 

 
</div>
</div>
</nav>
 
</header>
 
<div id="main">
 
<div class="container-fluid">
<div class="row-fluid">
<div class="span12">
<h3 class="page-title">
Home Page
</h3>
 
<ul class="breadcrumb">
<li><a href="fb_home.php">Home</a>
<span class="icon-angle-right"></span>
</li>
<li><a href="fb_profile.php">Profile</a>
</li>
</ul>
 
</div>
</div>

<div class="row-fluid">
<div class="span12">
<form action=" " method="post" name="Status">
	<textarea label="Status" placeholder="what's in you mind" name='status' rows="4" style="width:500px !important;margin-top:20px;"></textarea>
	<input type="submit" value="Post" name="submit"/>
</form> 
</div>
</div>


<div class="chat-messages-list" style="height:400px">
<div class="content">
<?php 

foreach($user_home as $posts){?>
<div class="chat-message">
	<div class="chat-message-avatar">
		<img width="55" height="55" src="<?php echo 'http://graph.facebook.com/'.$posts['from']['id'].'/picture?type=square';?>" alt="Julio Marquez">
	</div>
	<div class="chat-message-body">
		<div class="chat-message-body-header">
			<?php echo $posts['from']['name'];?>
        </div>
        <div class="chat-message-body-content"><?php echo (isset($posts['message']))?$posts['message']:'';?></div>
    </div>    
</div>
<hr />
<?php } ?>
</div>
</div>
 


 

 
</div>
 
 
 
</div>

<?php require 'footer.php';?>