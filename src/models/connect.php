<?php
try {

    $pdo = new PDO(
        'mysql:host=localhost;dbname=mycavedb;charset=utf8',
        'root',
        '',
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ]
    );

} catch (\PDOException $messageErrorConnection) {

    echo $messageErrorConnection->getMessage();
}
?>
<?php
/* try {

    $pdo = new PDO(
        'mysql:host=localhost;dbname=id16718210_mycavedb;charset=utf8',
        'id16718210_mycave2021db',
        'Mabase2021x@',
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ]
    );

} catch (\PDOException $messageErrorConnection) {

    echo $messageErrorConnection->getMessage();
} */
?>