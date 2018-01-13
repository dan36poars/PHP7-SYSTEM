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

	public function getResult(){
		return $this->Result;
	} 

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

	public function __toString(){
		return json_encode(array(
			'Result' => $this->getResult()
		));
	}

// PRIVATE METHODS

	private function setResult( $Result ){
		$this->Result = $Result;
	}


}



?>