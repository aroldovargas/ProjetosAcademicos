<?php
session_start();
$id_laboratorio = $_POST["id_laboratorio"];
//Conexao com o banco de dados
$conn = mysqli_connect('mysql', 'root', '123.456','db_projetosAcademicos');
if (!$conn) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

if($id_laboratorio == "" || $id_laboratorio == null )
	{
	
    echo"<script language='javascript' type='text/javascript'>
    alert('Favor preencher todos os campos');</script>";
    echo"<script language= 'JavaScript'>location.href='/archive/gerenciar_laboratorios.php'</script>";
	}else{

		if($id_laboratorio){
			$query_delete1 = "DELETE FROM desenvolvido WHERE fk_Laboratorio_id = '$id_laboratorio'";
			$delete1 = mysqli_query($conn,$query_delete1);
			$query_delete = "DELETE FROM Laboratorio WHERE id = '$id_laboratorio'";
			$delete = mysqli_query($conn,$query_delete);
			if($delete && $delete1){
				echo"<script language='javascript' type='text/javascript'>
			    alert('LABORATORIO EXCLUIDO COM SUCESSO');</script>";
		    	echo"<script language= 'JavaScript'>location.href='/archive/gerenciar_laboratorios.php'</script>";
			}else{
				echo"<script language='javascript' type='text/javascript'>
			    alert('NÃO FOI POSSÍVEL EXCLUIR O LABORATÓRIO, TENTE NOVAMENTE E VERIFIQUE SUAS PERMISSÕES');</script>";
		    	echo"<script language= 'JavaScript'>location.href='/archive/gerenciar_laboratorios.php'</script>";
			}
		}else{
			echo"<script language='javascript' type='text/javascript'>
		    alert('Esse Projeto não existe');</script>";
	    	echo"<script language= 'JavaScript'>location.href='/archive/gerenciar_laboratorios.php'</script>";
		}

  	}
    
mysqli_close($conn);

?>