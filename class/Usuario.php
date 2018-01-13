<?php

/**
* Class Usuario [MODEL]
* Classe responsável em gerenciar os usuários
* no sistema
* @author Daniel Corrêa, Geekyweb Ltda 2018.
*/
class Usuario
{
	private $Result;
	private $Error;

	/**
	 * Finding a user by specific Id
	 **/
	public function loadById( $id ){
		$sql = new Mysql();

		$result = $sql->select("SELECT * FROM tb_users WHERE idusuario = :id", array(
			':id' => $id
		) );

		if ( isset($result[0]) ) {
			$row = $result[0];
			$this->setResult( $row );
		}else{
			$this->Result = false;
			$this->Error = [ 'WS_ERROR', 'Não retornou Dados!' ];
		}
	}
	
	/**
	 * getting data from data base with login and password authentication
	 **/

	public function login($login, $pass){
		$sql = new Mysql();

		$result = $sql->select("SELECT * FROM tb_users WHERE deslogin = :LOGIN AND dessenha = :PASS", array(
			':LOGIN' => $login,
			':PASS' => $pass 
		));

		if ( isset($result[0]) ) {
			$this->setResult($result[0]);	
		}else{
			$this->Result = false;
			$this->Error = ['WS_ERROR', 'Login e senha incorretos'];
		}
	}

	public function __toString(){
		return json_encode(array(
			'Result' => $this->getResult()
		));
	}

	public function getResult(){
		return $this->Result;
	} 

// STATIC METHODS

	/**
	 * search a user by login
	 **/
	public static function search( $login ){
		$sql = new Mysql();

		return $sql->select("SELECT * FROM tb_users WHERE deslogin LIKE :SEARCH ORDER BY deslogin ASC", array(
			':SEARCH' => "%".$login."%"
		));
	}

	/**
	 * Obtain a list all users on the data base
	 **/
	public static function getList(){
		$sql = new Mysql();

		$result = $sql->select("SELECT * FROM tb_users ORDER BY deslogin ASC;");

		return $result;
	}

// PRIVATE METHODS

	private function setResult( $Result ){
		$this->Result = $Result;
	}


}



?>