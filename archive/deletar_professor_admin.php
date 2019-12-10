<?php
session_start();
$id_professor = $_POST["id_professor"];
//Conexao com o banco de dados
$conn = mysqli_connect('mysql', 'root', '123.456','db_projetosAcademicos');
if (!$conn) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

if($id_professor == "" || $id_professor == null )
	{
	
    echo"<script language='javascript' type='text/javascript'>
    alert('Favor preencher todos os campos');</script>";
    echo"<script language= 'JavaScript'>location.href='/archive/gerenciar_professores.php'</script>";
	}else{

		if($id_professor){
			$query_select = "SELECT fk_Usuario_id FROM Professor WHERE id = '$id_professor'";
			$select = mysqli_query($conn,$query_select);
			$row_usuario = mysqli_fetch_array($select);
			$id_usuario = $row_usuario['fk_Usuario_id'];

			$query_delete = "DELETE FROM Professor WHERE id = '$id_professor'";
			$delete = mysqli_query($conn,$query_delete);

			if($delete){
				$query_delete1 = "DELETE FROM Usuario WHERE id = '$id_usuario'";
				$delete1 = mysqli_query($conn,$query_delete1);
				if($delete1){
					echo"<script language='javascript' type='text/javascript'>
					alert('Professor excluido com sucesso');</script>";
					echo"<script language= 'JavaScript'>location.href='/archive/gerenciar_professores.php'</script>";
				}

			}
		}else{
			echo"<script language='javascript' type='text/javascript'>
		    alert('Esse professor não existe');</script>";
	    	echo"<script language= 'JavaScript'>location.href='/archive/gerenciar_professores.php'</script>";
		}

  	}
    
mysqli_close($conn);

?>