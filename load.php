<?php
session_start();
require_once '/twitter/twitter.class.php';

 
$twitter = new Twitter('8m1Yim1FcKcuMfAJX4664g','5njIWz3UQHDeNHj0YSKPPV1Tpbkb1soEoO0IFJP4tA', '131775606-naSM2kdAk78AxWSQi5hyNUKR7t3HxGxqVJ0vzl8N','G8Wtz162lVea2wOhcsZMEMWu49G5OCxkYwio994');
$statuses = $twitter->load(Twitter::ME_AND_FRIENDS);

?>
<!doctype html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Twitter timeline demo</title>

<ul>
<?php foreach ($statuses as $status): ?>
	<li><a href="http://twitter.com/<?php echo $status->user->screen_name ?>"><img src="<?php echo htmlspecialchars($status->user->profile_image_url) ?>">
		<?php echo htmlspecialchars($status->user->name) ?></a>:
		<?php echo Twitter::clickable($status) ?>
		<small>at <?php echo date("j.n.Y H:i", strtotime($status->created_at)) ?></small>
	</li>
<?php endforeach ?>
</ul>
