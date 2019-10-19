<?php
session_start();

$nome = utf8_decode($_POST["nome_projeto"]);
$descricao = utf8_decode($_POST["descricao_projeto"]);
$data_inic = $_POST["data_inicio"];
$data_fim = $_POST["data_fim"];

//Conexao com o banco de dados
$conn = mysqli_connect('mysql', 'root', '123.456','db_projetosAcademicos');
if (!$conn) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

if($nome == "" || $nome == null || $descricao == "" || $descricao == null || $data_inic == "" || $data_inic == null || $data_fim == "" || $data_fim == null){
	
    // echo"<script language='javascript' type='text/javascript'>
    // alert('Favor preencher todos os campos');</script>";
    // echo"<script language= 'JavaScript'>location.href='/archive/login.html'</script>";
	}else{

		$query_select = "SELECT nome_projeto FROM Projeto WHERE nome_projeto = '$nome'";
		$select = mysqli_query($conn,$query_select);
		$array = mysqli_fetch_array($select);
		$nome_base = $array['nome_projeto'];

	  if($nome_base == $nome){

	    echo"<script language='javascript' type='text/javascript'>
	    alert('Esse Laboratório já está cadastrado');</script>";
    	echo"<script language= 'JavaScript'>location.href='/archive/projetos.php'</script>";

	    // die();

	  }else{
	  	$query_select = "SELECT id FROM Status WHERE nome = 'Em Andamento'";
		$select = mysqli_query($conn,$query_select);
		$array = mysqli_fetch_array($select);
		$id_status = $array['id'];
		//echo $id_status;

		$sql = "INSERT INTO Projeto(data_inicio,descricao_projeto,nome_projeto,data_fim,fk_Status_id) VALUES ('$data_inic','$descricao','$nome','$data_fim','$id_status')";
		$insert = mysqli_query($conn,$sql);

	    if($insert){
	     	header("Location:projetos.php");
	    }else{
	    	header("Location:erro.html");
	    }
	  }
    }
mysqli_close($conn);

?>