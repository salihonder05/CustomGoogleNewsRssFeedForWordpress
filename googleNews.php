<?php
	header( 'Content-Type:application/rss+xml; charset=UTF-8' );
?>
<?php echo '<?xml version="1.0" encoding="UTF-8" ?>'?>
<rss version="2.0"
xmlns:content="http://purl.org/rss/1.0/modules/content/"
xmlns:wfw="http://wellformedweb.org/CommentAPI/"
xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:atom="http://www.w3.org/2005/Atom"
xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
xmlns:slash="http://purl.org/rss/1.0/modules/slash/">
<channel>
<?php
define('DB_SERVER', 'localhost'); // Your DB SERVER
define('DB_USER', 'db_user'); // Your DB User Name
define('DB_PASSWORD', 'password'); // Your DB Password
define('DB_NAME', 'db_name'); // Your DB Name
$conn = new PDO("mysql:host=".DB_SERVER.";port=3306;charset=utf8;dbname=".DB_NAME, DB_USER, DB_PASSWORD);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$conn->exec("SET NAMES 'utf8'; SET CHARSET 'utf8'");

$getLast25Post = $conn->query("
SELECT
guid, post_content, post_excerpt, post_title, post_modified, post_title, user_email
FROM
wp_posts
JOIN wp_postmeta ON wp_posts.id = wp_postmeta.post_id
JOIN wp_users ON wp_posts.post_author = wp_users.ID
WHERE wp_postmeta.meta_key = 'google_news_status'
AND wp_postmeta.meta_value = 1
AND wp_posts.post_status = 'publish'
ORDER BY post_modified DESC LIMIT 25
");

$getLastPost = $conn->query("
SELECT post_modified FROM
wp_posts
JOIN wp_postmeta ON wp_posts.id = wp_postmeta.post_id
WHERE wp_postmeta.meta_key = 'google_news_status'
AND wp_posts.post_status = 'publish'
AND wp_postmeta.meta_value = 1
ORDER BY post_modified DESC LIMIT 1
");
$getLastPostModifiedTime = $getLastPost->fetch();
$result = $getLastPostModifiedTime['post_modified'];
?>
<lastBuildDate><?php echo date('D, d M Y H:i:s',strtotime($result)) . ' +0300'; ?></lastBuildDate>
<title>your service name</title>
<description>your description</description>
<link>https://www.yourwebsite.com</link>
<?php
while($row = $getLast25Post->fetch(PDO::FETCH_OBJ)){
echo "<item>";
	echo "<guid isPermaLink='true'>" .$row->guid."</guid>";
	echo "<pubDate>".date('D, d M Y H:i:s',strtotime($row->post_modified))."</pubDate>";
	echo "<title>".$row->post_title. "</title>";
	echo "<link>".$row->guid."</link>";
	echo "<description>".$row->post_excerpt.'</description>';
		echo "<content:encoded>";
		echo "<![CDATA[".$row->post_content ."]]>";
		echo "</content:encoded>";
	echo "<author>".$row->user_email ."</author>";
echo "</item>";
}
echo "</channel>";
echo "</rss>";
?>