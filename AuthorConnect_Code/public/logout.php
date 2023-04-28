<?php
require_once '../src/session.php';
$session = new \src\session();
$session->forgetSession();

exit;
