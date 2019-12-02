<?php
session_start();

$id_noticia = $_POST["id_noticia"];
$tipo = utf8_decode($_POST["noticia_tipo"]);
$descricao = utf8_decode($_POST["noticia_desc"]);

//Conexao com o banco de dados
$conn = mysqli_connect('mysql', 'root', '123.456','db_projetosAcademicos');
if (!$conn) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

if($id_noticia == "" || $id_noticia == null || $tipo == "" || $tipo == null || $descricao == "" || $descricao == null){
	
    // echo"<script language='javascript' type='text/javascript'>
    // alert('Favor preencher todos os campos');</script>";
    // echo"<script language= 'JavaScript'>location.href='/archive/login.html'</script>";
	}else
	{
		$sql = "UPDATE Noticia SET descricao_noticia = '$descricao',tipo = '$tipo' WHERE id ='$id_noticia'";
		$update = mysqli_query($conn,$sql);
		if($update){
			echo"<script language='javascript' type='text/javascript'>
		    alert('Noticia editada com sucesso!');</script>";
			echo"<script language= 'JavaScript'>location.href='/archive/noticias.php'</script>";
		}else{
			echo"<script language='javascript' type='text/javascript'>
		    alert('Não foi possível editar essa noticia, tente novamente e verifique suas permissões.');</script>";
			echo"<script language= 'JavaScript'>location.href='/archive/noticias.php'</script>";
		}
	}

mysqli_close($conn);

?>