<?php

require( './class/config.inc.php' );

$conn = new Mysql;
$conn->select('SELECT * FROM tb_users');

debug( $conn->getResult() );






?>