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

	/**
	 * Add a new user on data base
	 **/
	public function insert( $login, $pass ){
		$sql = new Mysql();
		$result = $sql->select("CALL sp_usuarios_insert(:LOGIN, :PASS)", array(
			':LOGIN' => $login,
			':PASS' => $pass
		));

		if ( isset($result[0]) ) {
			$this->setResult($result[0]);	
		}else{
			$this->Result = false;
			$this->Error = ['WS_ERROR', 'Erro ao inserir um novo dado no banco'];
		}
	}

	/**
	 * update data inside database.
	 * @param $login
	 * @param $pass
	 * @param $id = null
	 **/
	public function update( $login, $pass, $id = null ){
		$id = ( $id === null ? $this->Result['idusuario'] : $id );
		$sql = new Mysql();
		$result = $sql->query("UPDATE tb_users SET deslogin = :LOGIN, dessenha = :PASS WHERE idusuario = :ID", array(
			":LOGIN" => $login,
			":PASS" => $pass,
			":ID" => $id
		));

		if ( isset($result) ) {
			$this->setResult(true);
		}else{
			$this->Result = false;
			$this->Error = ['WS_ERROR', 'Erro ao atualizar dado no banco'];
		}
	}

	/**
	 * Magic Method : mostra os dados em JSON.
	 * Uso: echo <Nome_da_instância>
	 **/
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