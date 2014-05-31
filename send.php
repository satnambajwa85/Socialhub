<?php
session_start();
require_once '/twitter/twitter.class.php';

// ENTER HERE YOUR CREDENTIALS (see readme.txt)
$twitter = new Twitter('8m1Yim1FcKcuMfAJX4664g','5njIWz3UQHDeNHj0YSKPPV1Tpbkb1soEoO0IFJP4tA', '131775606-naSM2kdAk78AxWSQi5hyNUKR7t3HxGxqVJ0vzl8N','G8Wtz162lVea2wOhcsZMEMWu49G5OCxkYwio994');

try {
	$tweet = $twitter->send('Testing Twitter API!');

} catch (TwitterException $e) {
	echo 'Error: ' . $e->getMessage();
}
?>