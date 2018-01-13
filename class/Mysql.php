<?php

/**
* Class Mysql [DAO]
* classe responsável em se comunicar com
* o banco de dados com o driver mysql
* @author Daniel Corrêa, Geekyweb Ltda 2018.
*/


class Mysql extends PDO
{
	/* Variáveis privadas */
	private $Conn;
	private $Result = array();
	private $Error;

	/* Constantes */
	Const Dns = 'mysql';
	Const Host = 'localhost';
	Const User = 'root';
	Const Pass = '';
	Const Db = 'dbphp7';
	
	function __construct()
	{		

			try {
				$this->Conn = new PDO(self::Dns.':dbname='.self::Db.';host='.self::Host, self::User, self::Pass);
				$this->Conn->exec("set names utf8");
				
			} catch (PDOException $e) {
				echo 'Erro ao conectar com o MySQL: ' . $e->getMessage();
			}

	}

	public function query( $rawQuery, $params = array() ){

		$stmt = $this->Conn->prepare( $rawQuery );		
		$this->setParams( $stmt, $params );
	 	$stmt->execute();		
		return $stmt;
	}

	public function select( $rawQuery, $params = array() ) {

		$stmt = $this->query( $rawQuery, $params );
		$this->Result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $this->getResult();

	}

	public function getResult(){
		return $this->Result;
	}

	public function getError(){
		return $this->Error;
	}

// PRIVATE METHODS


	private function setParams( $statement, $parameters = array() ){

		foreach ($parameters as $key => $value) {
			$this->setParam( $statement, $key, $value );
		}

	}

	private function setParam( $statement, $key, $value ){
		$statement->bindParam( $key, $value );
	}


}



?>