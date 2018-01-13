<?php

require( './class/config.inc.php' );

$user = new Usuario();

$user->loadById(1);

echo $user;







?>