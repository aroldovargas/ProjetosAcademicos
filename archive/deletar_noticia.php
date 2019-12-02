<?php
session_start();

$id_noticia = $_POST["id_noticia"];

//Conexao com o banco de dados
$conn = mysqli_connect('mysql', 'root', '123.456','db_projetosAcademicos');
if (!$conn) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

if($id_noticia == "" || $id_noticia == null){
	
    echo"<script language='javascript' type='text/javascript'>
    alert('Favor preencher todos os campos');</script>";
    echo"<script language= 'JavaScript'>location.href='/archive/noticias.php'</script>";
	}else{
		if($id_noticia){
			$query_delete = "DELETE FROM Noticia WHERE id = '$id_noticia'";
			$delete = mysqli_query($conn,$query_delete);
			if($delete){
				echo"<script language='javascript' type='text/javascript'>
			    alert('NOTICIA EXCLUIDO COM SUCESSO');</script>";
		    	echo"<script language= 'JavaScript'>location.href='/archive/noticias.php'</script>";
			}else{
				echo"<script language='javascript' type='text/javascript'>
			    alert('NÃO FOI POSSÍVEL EXCLUIR A NOTICIA, TENTE NOVAMENTE E VERIFIQUE SUAS PERMISSÕES');</script>";
		    	echo"<script language= 'JavaScript'>location.href='/archive/noticias.php'</script>";
			}
		}else{
			echo"<script language='javascript' type='text/javascript'>
		    alert('Essa Noticia não existe');</script>";
	    	echo"<script language= 'JavaScript'>location.href='/archive/noticias.php'</script>";
		}
    }
mysqli_close($conn);

?>