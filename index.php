<?php

require( './class/config.inc.php' );

// Carrega um usuarios buscando pelo Id
//------------------------------------

// $user = new Usuario();

// $user->loadById(4);

// echo $user;

// echo "<hr>";

// Carrega um lista de todos od usuarios
//--------------------------------------

// $users = Usuario::getList();

// foreach ($users as $user) {
	
// 	foreach ($user as $key => $value) {
// 		echo $key." : ".$value."</br>";
// 	}
// 	echo "<hr>";
// }

// Carrega um lista de usuarios buscando pelo login
//--------------------------------------

// $searchs = Usuario::search(  );

// foreach ($searchs as $search) {
// 	foreach ($search as $key => $value) {
// 		echo $key." : ".$value."</br>";
// 	}
// 	echo "<hr>";
// }

// Busca o usuario passando senha e login
//---------------------------------------

$login = new Usuario();
$login->login('Root', 'user');
echo $login;
?>