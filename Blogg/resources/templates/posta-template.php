<?php
// Include header
require ('resources/views/header.php');
navigation($header);
//Början på ett form för att kunna posta nya inlägg.
?>
<div class="content">
    <form action="posta.php" method="post">
    Name: <input type="text" name="name"><br>
    E-mail: <input type="text" name="email"><br>
<input type="submit">
</form>
</div>

<?php
//Inlcude Footer
require ('resources/views/footer.php');
?>
