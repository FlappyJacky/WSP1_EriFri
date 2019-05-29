<?php

function get_dbh() {
    static $dbh;
    if (is_null($dbh)) {
        $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";
        $attr = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        );
        try {
            $dbh = new PDO($dsn, DB_USER, DB_PASSWORD, $attr);
            if (empty($dbh)) {
                throw new Exception(
                    "PDO kunde inte instansieras, uppkoppling misslyckad"
                );
                }
                //SÅ OM FEL/EXCEPTION HÄNDE DÅ VISAS MEDDELANDET UPP
                // $mode_sql = 'SET SESSION sql_mode ="STRICT_ALL_TABLE, NO_ZERO_IN_DATE" ';
                // $resp = $dbh->query($mode_sql);

                $safe_sql = 'SET sql_safe_updates=1, sql_select_limit=1000, max_join_size=100000';
                $resp = $dbh->query($safe_sql);
            }
        catch(Exception $e) {
            echo '<pre>';
            var_dump($e);
            echo '<hr>';
            var_dump($dbh->errorInfo());
            echo '<hr>';
            echo '</pre>';
            exit;
        }
    }
    return $dbh;
}

// Hämtar alla information från tabeln comments.
function fetch_comments($PostID, $dbh) {
    $sql = "SELECT c.*, u.Username FROM comments AS c JOIN users AS u ON c.User_ID = u.ID WHERE Post_ID = :pid ORDER BY Creation_Time DESC";
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(":pid", $PostID);
    $stmt->execute();
    $comments = $stmt->fetchALL(PDO::FETCH_ASSOC);

    //Insert XXS prevention HERE
    foreach ($comments as &$cmt) {
        $cmt["Username"] = htmlspecialchars($cmt["Username"], ENQ_QUOTES);
        $cmt["text"] = htmlspecialchars($cmt["text"], ENQ_QUOTES);
    }

    return $comments;

}


?>
