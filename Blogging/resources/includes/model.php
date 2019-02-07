<?php

$host = 'localhost';
$dbname = 'blogg';
$user = 'admin';
$password = 'd#/y%j8Z(S6^@*?7.~s7s`9$_UB~%Y2D&qnBSpr;Q_.stfq-d#EL2U$=n.b-"H84"jqp"s;/="9q4kd3G*zmVv8Q(';

//Ändrar teckenkodning
$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

$attr = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);

$pdo = new PDO($dsn,$user,$password,$attr);

//Array för posts
if($pdo) {
//Definera model-array
    $model = array();

    $sql = 'SELECT p.Slug, p.Headline, u.Username, p.Likes, p.Creation_Time, p.Text FROM posts AS p JOIN users AS u ON p.User_ID = u.ID ORDER BY CREATION_Time DESC';

    echo "<pre>";
    //Associative array
    foreach($pdo->query($sql) as $row) {
        $model += array(
            $row['Slug'] => array(
                     'title' => $row['Headline'],
                     'author' => $row['Username'],
                     'likes' => $row['Likes'],
                     'date' => $row['Creation_Time'],
                     'text' => $row['Text']
                 )

        );

    }

    echo "</pre>";
//Vid fel så kommer ett felmeddelande
} else {
print_r($pdo->errorInfo());
}

?>
