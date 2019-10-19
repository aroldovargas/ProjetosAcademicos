<?php
session_start();
// echo "<br>Nome: " . $_POST["nome_cadastro"];
// echo "<br>Login/Email: " . $_POST["email_cadastro"];

$noticia_lab = utf8_decode($_POST["noticia_lab"]);
$noticia_projeto = utf8_decode($_POST["noticia_projeto"]);
$noticia_tipo = utf8_decode($_POST["noticia_tipo"]);
$noticia_desc = utf8_decode($_POST["noticia_desc"]);
//Conexao com o banco de dados
$conn = mysqli_connect('mysql', 'root', '123.456','db_projetosAcademicos');
if (!$conn) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

if($noticia_lab == "" || $noticia_lab == null || $noticia_projeto == null || $noticia_projeto == "" || $noticia_tipo == "" ||$noticia_tipo == null|| $noticia_desc == null|| $noticia_desc == ""){
	
    // echo"<script language='javascript' type='text/javascript'>
    // alert('Favor preencher todos os campos');</script>";
    // echo"<script language= 'JavaScript'>location.href='/archive/login.html'</script>";
	}else{

		$query_select = "SELECT descricao_noticia FROM Noticia WHERE descricao_noticia = '$noticia_desc'";
		$select = mysqli_query($conn,$query_select);
		$array = mysqli_fetch_array($select);
		$noticia_desc_base = $array['descricao_noticia'];

	  if($noticia_desc_base == $noticia_desc){

	    echo"<script language='javascript' type='text/javascript'>
	    alert('Essa Noticia já está cadastrado');</script>";
    	echo"<script language= 'JavaScript'>location.href='/archive/login.html'</script>";

	    // die();

	  }else{
		//pegando id laboratorio
	  	$query_idlab = "SELECT id FROM Laboratorio WHERE nome_lab = '$noticia_lab' " ;
	  	$select = mysqli_query($conn,$query_select);
		$array = mysqli_fetch_array($select);
		$id_lab_noticia = $array['id'];
		//pegando id projeto
		$query_idlab = "SELECT id FROM Projeto WHERE nome_projeto = '$noticia_projeto' " ;
	  	$select = mysqli_query($conn,$query_select);
		$array = mysqli_fetch_array($select);
		$id_projeto_noticia = $array['id'];


		$sql = "INSERT INTO Noticia(descricao_noticia,tipo,fk_Laboratorio_id,fk_Projeto_id) VALUES ('$noticia_desc','$noticia_tipo','$id_lab_noticia','$id_projeto_noticia')";
		$insert = mysqli_query($conn,$sql);

	    if($insert){
	     	header("Location:laboratorios.php");
	    }else{
	    	header("Location:erro.html");
	    }
	  }
    }
mysqli_close($conn);

?>