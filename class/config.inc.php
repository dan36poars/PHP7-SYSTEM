<?php

spl_autoload_register( function( $className ){ 

	$fileName = './class'.DIRECTORY_SEPARATOR.$className.'.php';

	if ( file_exists( $fileName ) && !is_dir( $fileName ) ) {
		require_once( $fileName );
	}else{
		echo "Arquivo: ".$fileName." Não foi encontrado";
		
	}

});

function Debug( $Var ){
	echo "<pre>";
	var_dump( $Var );
	echo "</pre>";
}


?>