<?php
require 'facebook/facebook.php';
require 'config/fbconfig.php';
require 'config/functions.php';
$facebook = new Facebook(array(
            'appId' => APP_ID,
            'secret' => APP_SECRET,
            ));
$user_home = $facebook->api('/me');
$friend = $facebook->api('/me/friends');
$frientds	=	$friend['data'];
$notifications = $facebook->api('/me/notifications');
$notification	=	$notifications['data'];

$messages = $facebook->api('/me/inbox');
$message	=	$messages['data'];

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
        	<span class="badge"><?php echo count($notification);?></span><i class="icon-warning-sign"></i>
        </a>
        <ul class="dropdown-menu">
        	<li class="nav-notifications-header">
            	<a tabindex="-1" href="#">You have <strong><?php echo count($notification);?></strong> new notifications</a>
            </li>
        </ul>
	</li>
	
 
 
    <!--<li class="dropdown nav-messages">
     
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <span class="badge">8</span>
        <i class="icon-envelope"></i>
        </a>
 
 
        <ul class="dropdown-menu">
         
        <li class="nav-messages-header">
        <a tabindex="-1" href="#">You have <strong>8</strong> new messages</a>
        </li>
 
 
        <li class="nav-message-body">
        <a>
        <img src="../../assets/img/people-face/user1_55.jpg" alt="User">
        <div>
        <small class="pull-right">Just Now</small>
        <strong>Yadra Abels</strong>
        </div>
        <div>
        Lorem ipsum dolor sit amet, consectetur...
        </div>
        </a>
        </li>

 
 
<li class="nav-messages-footer">
<a tabindex="-1" href="chat-inbox.html">View all messages
</a>
</li>
 
</ul>
 
</li>-->
 
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
Basic User Profile
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
<div id="user-profile" class="social-box">
<div class="body">
<div class="row-fluid">
<div class="span2">
<div class="row-fluid">
<img src="<?php echo 'http://graph.facebook.com/'.$user_home['id'].'/picture?type=square';?>" class="img-polaroid avatar span12">
</div>
<p>
<a class="btn btn-block btn-success"><i class="icon-envelope-alt"></i> Send message</a>
</p>
 
<p id="social-icons" class="text-center">
<a href="#"><i class="icon-facebook-sign icon-2x"></i></a>
<a href="#"><i class="icon-twitter-sign icon-2x"></i></a>
<a href="#"><i class="icon-linkedin-sign icon-2x"></i></a>
<a href="#"><i class="icon-google-plus-sign icon-2x"></i></a>
</p>
 
</div>
<div class="span10">
<div class="row-fluid">
 
<div id="user-status" class="span10 text-left">
<h3><?php echo $user_home['name'];?></h3>
<h5><?php echo $user_home['hometown']['name'].'<br>'.$user_home['location']['name'];?></h5>
</div>
 
<div class="span2">
<!--<a href="#edit" class="btn btn-block btn-primary" id="edit-profile-button">Edit Profile</a>-->
</div>
</div>
 
<p id="panoramic" class="row-fluid hidden-phone">
<img src="<?php echo 'http://graph.facebook.com/'.$user_home['id'].'/picture?type=rectangle';?>" class="img-rounded span12" height="160">
</p>
 
</div>
</div>
<div class="row-fluid">
<div class="span3">
 
<div id="friends-list" class="social-box">
<div class="header">
<h4>Friends</h4>
</div>
<div class="body">
<div class="row-fluid" style="height:400px;overflow:scroll;">
<?php foreach($frientds as $frie){?>
<div class="span4" style="float:left">
<a href="#" data-toggle="tooltip" title="<?php echo $frie['name'];?>">
<img src="<?php echo 'http://graph.facebook.com/'.$frie['id'].'/picture?type=square';?>" class="img-rounded" alt="<?php echo $frie['name'];?>">
</a>
</div>
<?php } ?>
</div>
</div>
</div>
 
</div>
<div class="span9">
 
<div class="row-fluid">
<ul id="profileTab" class="nav nav-tabs">

<li class="active">
<a href="#info" data-toggle="tab">Info</a>
</li>
<li>
<a href="#Teams">Teams</a>
</li>
<li>
<a href="#Athletes">Athletes</a>
</li>
</ul>
</div>
 
<div class="row-fluid">
 
<div id="profileTabContent" class="tab-content span9">
<div class="tab-pane fade in active" id="info">
    <dl class="dl-horizontal">
        <dt>Introduction</dt>
        <dd><?php echo (isset($user_home['bio']))?$user_home['bio']:'';?></dd>
        <dd class="divider"></dd>
        <dt>Employer Name</dt>
        <dd><?php echo $user_home['work'][0]['employer']['name'];?></dd>
        <dd class="divider"></dd>
        <dt>Employment location</dt>
        <dd><?php echo $user_home['work'][0]['location']['name'];?></dd>
        <dt>Occupation</dt>
        <dd><?php echo $user_home['work'][0]['position']['name'];?></dd>
        <dt>Description</dt>
        <dd><?php echo (isset($user_home['work'][0]['description']))?$user_home['work'][0]['description']:'';;?></dd>
        <dt>Start Date</dt>
        <dd><?php echo $user_home['work'][0]['start_date'];?></dd>
    
        <dd>
            <div id="places-lived" style="height: 150px;"></div>
        </dd>
    </dl>
</div>

<div class="tab-pane fade in active" id="Teams">
    <dl class="dl-horizontal">
    
        <dt>Favorite Teams</dt>
       	<?php foreach($user_home['favorite_teams'] as $data){?>
        <dd><?php echo $data['name'];?></dd>
        <dd class="divider"></dd>
        <?php } ?>
       
    
        <dd>
            <div id="places-lived" style="height: 150px;"></div>
        </dd>
    </dl>
</div>


<div class="tab-pane fade in active" id="Athletes">
    <dl class="dl-horizontal">
        <dt>Favorite Athletes</dt>
       	<?php foreach($user_home['favorite_athletes'] as $data){?>
        <dd><?php echo $data['name'];?></dd>
        <dd class="divider"></dd>
        <?php } ?>
        <dd>
		<div id="places-lived" style="height: 150px;"></div>
        </dd>
    </dl>
</div>


</div>
 
</div>
</div>
</div>
</div>
</div>
 
<div id="user-edit" class="row-fluid social-box hide">
<div class="body">
<a href="#back" class="btn btn-warning" id="back-profile-button">
<i class="icon-circle-arrow-left"></i> Go Back
</a>
<div class="span12">
<div class="row-fluid">
<div>
<form class="form-horizontal span6">
<div class="heading">
<h4 class="form-heading">Change User Data</h4>
</div>
<div class="control-group">
<label class="control-label" for="username">User Name</label>
<div class="controls">
<input type="text" id="username" value="myUsername">
</div>
</div>
<div class="control-group">
<label class="control-label">Avatar</label>
<div class="controls">
<div class="fileupload fileupload-new" data-provides="fileupload">
<div class="fileupload-new thumbnail" style="width: 50px; height: 50px;">
<img src="../../assets/img/avatar-55.png" alt="Selected image"/>
</div>
<div class="fileupload-preview fileupload-exists thumbnail" style="width: 50px; height: 50px;"></div>
<span class="btn btn-file">
<span class="fileupload-new">Select image</span>
<span class="fileupload-exists">Change</span>
<input type="file"/>
</span>
<a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
</div>
</div>
</div>
<div class="control-group">
<label class="control-label" for="firstname">First Name</label>
<div class="controls">
<input type="text" id="firstname" value="Julio">
</div>
</div>
<div class="control-group">
<label class="control-label" for="lastname">Last Name</label>
<div class="controls">
<input type="text" id="lastname" value="Márquez">
</div>
</div>
<div class="control-group">
<label class="control-label" for="email">Email</label>
<div class="controls">
<input type="text" id="email" value="email@example.com">
</div>
</div>
<div class="control-group">
<label class="control-label" for="language">Language</label>
<div class="controls" style="width: 220px;">
<select id="language" class="chzn-select">
<option>English</option>
<option selected="selected">Español</option>
<option>Portugais</option>
<option>Français</option>
<option>Türk</option>
</select>
</div>
</div>
<div class="control-group">
<div class="controls">
<button type="submit" class="btn btn-primary">Save</button>
</div>
</div>
</form>
</div>
<div>
<form class="form-horizontal span6">
<div class="heading">
<h4 class="form-heading">Change Password</h4>
</div>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Libero, reprehenderit dignissimos possimus error animi nobis suscipit. Tenetur, neque, autem eligendi est voluptas consequatur adipisci eum doloribus facilis quaerat aut incidunt.</p>
<div class="control-group">
<label class="control-label" for="currentpassword">Current Password</label>
<div class="controls">
<input type="password" id="currentpassword">
</div>
</div>
<div class="control-group">
<label class="control-label" for="newpassword">New Password</label>
<div class="controls">
<input type="password" id="newpassword" placeholder="Min. 8 Characters">
</div>
</div>
<div class="control-group">
<label class="control-label" for="confirmpassword">Confirm Password</label>
<div class="controls">
<input type="password" id="confirmpassword" placeholder="Min. 8 Characters">
</div>
</div>
<div class="control-group">
<div class="controls">
<button type="submit" class="btn btn-primary">Change Password</button>
</div>
</div>
</form>
</div>
</div>
</div>
<div class="clearfix"></div>
</div>
<div class="footer text-center">
Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae, vel!
</div>
</div>
 
</div>
 
 
<footer id="footer">
<div class="container-fluid">
2013 © <em>Social - Hub</em> by <a href="#" target="_blank">Social hub</a>.
</div>
</footer>
 
</div>

<?php require 'footer.php';?>