<?php
session_start();
// echo "<br>Nome: " . $_POST["nome_cadastro"];
// echo "<br>Login/Email: " . $_POST["email_cadastro"];


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

if($noticia_tipo == "" ||$noticia_tipo == null|| $noticia_desc == null|| $noticia_desc == ""){
	
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
		$sql = "INSERT INTO Noticia(descricao_noticia,tipo) VALUES ('$noticia_desc','$noticia_tipo')";
		$insert = mysqli_query($conn,$sql);

	    if($insert){
	     	header("Location:noticias.php");
	    }else{
	    	header("Location:erro.html");
	    }
	  }
    }
mysqli_close($conn);

?>