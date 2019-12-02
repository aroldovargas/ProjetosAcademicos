<?php
session_start();
// echo "<br>Nome: " . $_POST["nome_cadastro"];
// echo "<br>Login/Email: " . $_POST["email_cadastro"];

$nome = utf8_decode($_POST["nome_laboratorio"]);
$descricao = utf8_decode($_POST["descricao_laboratorio"]);
$sigla = $_POST["sigla_laboratorio"];

//Conexao com o banco de dados
$conn = mysqli_connect('mysql', 'root', '123.456','db_projetosAcademicos');
if (!$conn) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

if($nome == "" || $nome == null || $descricao == "" || $descricao == null || $sigla == "" || $sigla == null){
	
    // echo"<script language='javascript' type='text/javascript'>
    // alert('Favor preencher todos os campos');</script>";
    // echo"<script language= 'JavaScript'>location.href='/archive/login.html'</script>";
	}else{

		$query_select = "SELECT sigla FROM Laboratorio WHERE sigla = '$sigla'";
		$select = mysqli_query($conn,$query_select);
		$array = mysqli_fetch_array($select);
		$sigla_base = $array['sigla'];

	  if($sigla_base == $sigla){

	    echo"<script language='javascript' type='text/javascript'>
	    alert('Esse laboratório já está cadastrado');</script>";
    	echo"<script language= 'JavaScript'>location.href='/archive/laboratorios.php'</script>";

	    // die();

	  }else{
		$sql = "INSERT INTO Laboratorio(sigla,nome_lab,descricao_lab) VALUES ('$sigla','$nome','$descricao')";
		$insert = mysqli_query($conn,$sql);

	    if($insert){
	    	echo"<script language='javascript' type='text/javascript'>
		    alert('Laboratório inserido com sucesso!');</script>";
	    	echo"<script language= 'JavaScript'>location.href='/archive/laboratorios.php'</script>";
		    // header("Location:laboratorios.php");
	    }else{
	    	header("Location:erro.html");
	    }
	  }
    }
mysqli_close($conn);

?>