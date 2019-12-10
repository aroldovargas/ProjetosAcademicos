<?php
session_start();
$id_projeto = $_POST["id_projeto"];
//Conexao com o banco de dados
$conn = mysqli_connect('mysql', 'root', '123.456','db_projetosAcademicos');
if (!$conn) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

if($id_projeto == "" || $id_projeto == null ){
	echo"<script language='javascript' type='text/javascript'>
    alert('Favor preencher todos os campos');</script>";
    echo"<script language= 'JavaScript'>location.href='/archive/gerenciar_projetos.php'</script>";
	}else{

		// $query_select = "SELECT id FROM Projeto WHERE id = '$id_projeto'";
		// $select = mysqli_query($conn,$query_select);
		// $array = mysqli_fetch_array($select);
		// $id_projeto_base = $array['id'];
		if($id_projeto){
			$query_delete1 = "DELETE FROM desenvolvido WHERE fk_Projeto_id = '$id_projeto'";
			$delete1 = mysqli_query($conn,$query_delete1);

			$query_delete = "DELETE FROM Projeto WHERE id = '$id_projeto'";
			$delete = mysqli_query($conn,$query_delete);

			if($delete && $delete1){
				echo"<script language='javascript' type='text/javascript'>
			    alert('PROJETO EXCLUIDO COM SUCESSO');</script>";
		    	echo"<script language= 'JavaScript'>location.href='/archive/gerenciar_projetos.php'</script>";
			}else{
				echo"<script language='javascript' type='text/javascript'>
			    alert('NÃO FOI POSSÍVEL EXCLUIR O PROJETO, TENTE NOVAMENTE E VERIFIQUE SUAS PERMISSÕES');</script>";
		    	echo"<script language= 'JavaScript'>location.href='/archive/gerenciar_projetos.php'</script>";
			}
		}else{
			echo"<script language='javascript' type='text/javascript'>
		    alert('Esse Projeto não existe');</script>";
	    	echo"<script language= 'JavaScript'>location.href='/archive/gerenciar_projetos.php'</script>";
		}
  	}
    
mysqli_close($conn);

?>