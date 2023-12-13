<?php 

try {
    //ID:'root', Password: xamppは 空白 ''
    $pdo = new PDO('mysql:dbname=notes;charset=utf8;host=localhost', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    exit('DBConnectError:' . $e->getMessage());
}


?>