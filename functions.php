<?php
require_once __DIR__ . '/config.php';

function connectDb ()
{
    try {
        return new PDO(
            DSN,
            USER,
            PASSWORD,
            [PDO::ATTR_ERRMODE =>
            PDO::ERRMODE_EXCEPTION]
        );
    } catch (PDOException $e) {
        echo $e->getMessage();
        exit;
    }
}

function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

function findCustomers()
{
    $dbh = connectDb();

    $sql = <<<EOM
    SELECT
        *
    FROM
        customers;
    EOM;

    $stmt = $dbh->prepare($sql);

    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}