<?php
require './resources/includes/config.php';
require './resources/includes/dbh.inc.php';

$dbh = get_dbh();


$template ="all-blog-posts";
$sql = 'SELECT p.*, u.Username FROM posts AS p JOIN users AS u ON p.User_ID = u.ID';
$order = 'DESC';
$text = '';

    $sql .= " ORDER BY Creation_Time {$order}";

    $stmt = $dbh->prepare($sql);
    $stmt->execute();

    $model = array();

    //Associative array
    foreach($stmt as $row) {
        $model += array(
            $row['ID'] => array(
                     'Slug' => $row['Slug'],
                     'title' => $row['Headline'],
                     'author' => $row['Username'],
                     'likes' => $row['Likes'],
                     'date' => $row['Creation_Time'],
                     'text' => $row['Text']
                 )
        );
    }

if (array_key_exists($post, $model)) {
   $template ="single-blog-post";
	$comments = fetch_comments($post, $dbh);
	$title = $model[$post]['title'];
	$author = $model[$post]['author'];
	$likes = $model[$post]['likes'];
	$date = $model[$post]['date'];
	$message = $model[$post]['text'];
}
    elseif (!empty($post)) {
    $template = "page";
    $content = "skit";
}


?>
