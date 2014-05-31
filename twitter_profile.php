<?php
session_start();
require_once '/twitter/twitter.class.php';

$twitter = new Twitter('8m1Yim1FcKcuMfAJX4664g','5njIWz3UQHDeNHj0YSKPPV1Tpbkb1soEoO0IFJP4tA', $_SESSION['access_token']['oauth_token'],$_SESSION['access_token']['oauth_token_secret']);
$statuses = $twitter->load(Twitter::ME_AND_FRIENDS);
$userInfo	=	$_SESSION['twitter_profile'];



if(isset($_POST['submit']))
{
$message=$_POST['status'];
$twitter = new Twitter('8m1Yim1FcKcuMfAJX4664g','5njIWz3UQHDeNHj0YSKPPV1Tpbkb1soEoO0IFJP4tA',$_SESSION['access_token']['oauth_token'],$_SESSION['access_token']['oauth_token_secret']);
$tweet = $twitter->send($message);
}

require 'header.php';
require 'sidebar.php';
?>

<div id="main">
 
<div class="container-fluid">
<div class="row-fluid">
<div class="span12">
<form action=" " method="post" name="Status">
	<textarea label="Status" placeholder="what's in you mind" name='status' rows="4" style="width:500px !important;margin-top:20px;"></textarea>
	<input type="submit" value="Post" name="submit"/>
</form> 
</div>
</div>
<div class="row-fluid">
<div class="span12">
<h3 class="page-title">
Twitter
</h3>
<ul class="breadcrumb">
	<li><i class="icon-home"></i><a href="twitter_profile.php">Profile</a><span class="icon-angle-right"></span></li>
	<li><a href="twitter.php">Login</a><span class="icon-angle-right"></span></li>
</ul>
 
</div>
</div>
<div class="row-fluid">
<div class="social-box social-bordered">
<div class="body">


<div class="row-fluid">
<div class="span2">
<div class="row-fluid">
<img class="img-polaroid avatar span12" src="<?php echo $userInfo->profile_image_url;?>">
</div>
 
</div>
<div class="span10">
<div class="row-fluid">
 
<div class="span10 text-left" id="user-status">
<h3><?php echo $userInfo->name.' ( '.$userInfo->screen_name.' ) ';?></h3>
<h5><?php echo $userInfo->location;?></h5>
<h5><?php echo $userInfo->description;?></h5>
</div>
</div>
</div>
</div>

<div class="row-fluid">
<div class="span4">
<div id="users-list">
<div class="content">
 
<div class="well  alert alert-block" style="padding: 8px;margin-bottom: 10px;">
<div class="row-fluid">
<div class="span3">
<img src="<?php echo $userInfo->profile_image_url;?>" alt="Friend">
</div>
<div class="span9">
<small class="pull-right" style="margin-right: 5px;">Yesterday</small>
<p>John Doe</p>
<p><strong>First Last Name</strong> .....</p>
</div>
</div>
</div>
 
 
</div>
</div>
 
</div>
 
 
<div class="span8">
 
<div class="social-box social-blue social-bordered">
<div class="header">
<h4><?php echo $userInfo->name;?></h4>
 
<div class="tools">
<div class="btn-group">
<button class="btn dropdown-toggle" data-toggle="dropdown"><i class="icon-cog"></i> Actions</button>
<ul class="dropdown-menu pull-right">
<li><a href="#">Marck as Unread</a></li>
<li class="divider"></li>
<li><a href="#">Delete Conversation</a></li>
<li><a href="#">Archive</a></li>
<li><a href="#">Move to...</a></li>
</ul>
</div>
</div>
 
</div>
 
<div class="body chat">
 
<div class="chat-messages-list" style="height:400px">
<div class="content">
<?php 
$count = 0 ;
foreach($statuses as $tweet){?>
<div class="chat-message <?php echo ($count%2)?'pull-right':'';?>">
<div class="chat-message-avatar">
<img width="55" height="55" src="<?php echo $tweet->user->profile_image_url;?>" alt="Julio Marquez">
</div>
<div class="chat-message-body">
<div class="chat-message-body-header"><?php echo $tweet->user->name;?> <small><?php echo $tweet->user->location;?></small></div>
<div class="chat-message-body-content">
<?php echo $tweet->text;?>
</div>
</div>
</div>
 <?php 
 $count++;
 } ?>
</div>
</div>
 
 
<div class="chat-composer">
<div class="chat-form">
<div class="chat-input">
<input id="composerMessage" type="text" placeholder="Type a message...">
</div>
<button class="btn btn-primary chat-sender" type="submit">
<span class="icon icon-share-alt "></span>
</button>
</div>
</div>
 
</div>
 
</div>
  </div>
</div>
<div class="clearfix"></div>
</div>
</div>
</div>
</div>
 
 
<footer id="footer">
<div class="container-fluid">
2013 © <em>Social - Premium Responsive Admin Template</em> by <a href="http://cesarlab.com/" target="_blank">CesarLab.com</a>.
</div>
</footer>
 
</div>
<?php 
require 'footer.php';
?>