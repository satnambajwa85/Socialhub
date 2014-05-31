<?php
//Always place this code at the top of the Page
session_start();
if (isset($_SESSION['id'])) {
    // Redirection to login page twitter or facebook
    header("location: home.php");
}

if (array_key_exists("login", $_GET)) {
    $oauth_provider = $_GET['oauth_provider'];
    if ($oauth_provider == 'twitter') {
        header("Location: login-twitter.php");
    } else if ($oauth_provider == 'facebook') {
        header("Location: login-facebook.php");
    }
}
?>
<title>SOCIAL HUB</title>
<style type="text/css">
    #buttons
	{
	text-align:center
	}
    #buttons img,
    #buttons a img
    { border: none;}
	h1
	{
	font-family:Arial, Helvetica, sans-serif;
	color:#999999;
	}
	
</style>
<body>


<div id="buttons">
<h1>Twitter Facebook Login </h1>
    <span id="signinButton">
	<a href="?login&oauth_provider=twitter"><img src="images/tw_login.png"></a>&nbsp;&nbsp;&nbsp;
    <a href="?login&oauth_provider=facebook"><img src="images/fb_login.png"></a> &nbsp;&nbsp;&nbsp;
	
  <span
    class="g-signin"
    data-callback="signinCallback"
    data-clientid="789316252023-t3aurce839vdsnjhqr7t68g96fnib1lp.apps.googleusercontent.com"
    data-cookiepolicy="single_host_origin"
    data-requestvisibleactions="http://schemas.google.com/AddActivity"
    data-scope="https://www.googleapis.com/auth/plus.login">
  </span>
</span>
	<br />
 </div>
 <!-- Place this asynchronous JavaScript just before your </body> tag -->
    <script type="text/javascript">
      (function() {
       var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
       po.src = 'https://apis.google.com/js/client:plusone.js';
       var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
     })();
    </script></body>