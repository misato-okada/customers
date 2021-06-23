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

function insertValidate($company, $name, $email)
{
    $errors = [];

    if ($company == '') {
        $errors[] =MSG_COMPANY_REQUIRED;
    }
    if ($name == '') {
        $errors[] =MSG_NAME_REQUIRED;
    }
    if ($email == '') {
        $errors[] =MSG_EMAIL_REQUIRED;
    }

    return $errors;
}

function insertCustomer($company, $name, $email)
{
    $dbh = connectDb();

    $sql = <<<EOM
    INSERT INTO
        customers
        (company, name, email)
    VALUES
        (:company, :name, :email)
    EOM;

    $stmt = $dbh->prepare($sql);

    $stmt->bindParam(':company',$company, PDO::PARAM_STR);
    $stmt->bindParam(':name',$name, PDO::PARAM_STR);
    $stmt->bindParam(':email',$email, PDO::PARAM_STR);

    $stmt->execute();
}

function createErrMsg($errors)
{
    $err_msg = "<ul class=\"errors\">\n";

    foreach ($errors as $error) {
        $err_msg .= "<li>" . h($error) . "</li>\n";
    }

    $err_msg .= "</ul>\n";

    return $err_msg;
}

function findById($id)
{
    $dbh = connectDb();

    $sql = <<<EOM
    SELECT
        *
    FROM
        customers
    WHERE
        id = :id;
    EOM;

    $stmt = $dbh->prepare($sql);

    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function updateValidate($company, $name, $email, $customer)
{
    $errors = [];

    if ($company == '') {
        $errors[] =MSG_COMPANY_REQUIRED;
    }
    if ($name == '') {
        $errors[] =MSG_NAME_REQUIRED;
    }
    if ($email == '') {
        $errors[] =MSG_EMAIL_REQUIRED;
    }
    if ($company == $customer['company'] && $name == $customer['name'] && $email == $customer['email']) {
        $errors[] = MSG_NO_CHANGE;
    }

    return $errors;
}

function updateCustomer($id, $company, $name, $email)
{
    $dbh = connectDb();

    $sql = <<<EOM
    UPDATE
        customers
    SET
        company = :company,
        name = :name,
        email = :email
    WHERE
        id = :id
    EOM;

    $stmt = $dbh->prepare($sql);

    $stmt->bindParam(':company', $company, PDO::PARAM_STR);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    $stmt->execute();
}

function deleteCustomer($id)
{
    $dbh = connectDb();

    $sql = <<<EOM
    DELETE FROM
        customers
    WHERE
        id = :id
    EOM;

    $stmt = $dbh->prepare($sql);

    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    $stmt->execute();
}