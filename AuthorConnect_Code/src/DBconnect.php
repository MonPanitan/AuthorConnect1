<?php
require_once '../DBConfig.php'; //access the login values
try {
    $connection = new PDO($dsn, $username, $password, $options);
    echo 'DB successfully connected';
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>