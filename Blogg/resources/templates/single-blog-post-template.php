<?php
//Include Meta
require ('resources/includes/head.php');

//Include Header
require ('resources/views/header.php');

navigation($header);

//Content
?>
<div class="content">
    <h2><?php echo $title; ?></h2>
    <p class="author">Författare: <?php echo $author; ?></p>
    <p class="likes">Likes: <?php echo $likes; ?></p>
    <p class="date">Datum: <?php echo $date; ?></p>
    <p class="message"><?php echo $message; ?></p>
    <hr>
    <h3>Kommentarer </h3>
    <?php
    // Lägger till så att man kan se comments.
    if (!empty($comments)) {
        foreach ($comments as $key => $val) {
            echo <<<CMT
            <div class="post">
                <h3> {$val["Username"]} </h3>
                <p class="date">Datum: {$val["Creation_Time"]}</p>
                <p class="message"> {$val["Text"]}</p>
            </div>
CMT;
        }
    } else {
        echo "Inga kommentar ännu. ;(";
    }
    ?>
    </div>
<?php
//Inlcude Footer
require ('resources/views/footer.php');
?>
