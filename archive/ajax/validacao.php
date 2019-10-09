<?php
// Campo que fez requisição
$campo = $_GET['campo'];
// Valor do campo que fez requisição
$valor = $_GET['valor'];
 
 
// Verificando o campo email
if ($campo == "email") {
 
	if (!preg_match("/^[a-z0-9_\.\-]+@[a-z0-9_\.\-]*[a-z0-9_\-]+\.[a-z]{2,4}$/", $valor)) {
		echo "Preencha com um email válido"; //
	}
 
}

if ($campo == "senha") {
	if (strlen($valor) > 20) {
		echo "A senha deve ter no máximo 20 caracteres.";
	} elseif (strlen($valor) < 4) {
		echo "A senha deve ter no minímo 4 caracteres.";
	} elseif (!preg_match('/^[a-z\d_]{4,28}$/i', $valor)) {
		echo "A senha deve conter somente letras e numeros.";
	}
 
}
?>