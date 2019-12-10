<?php
session_start();

$id_professor = $_POST["id_professor"];
$nome_professor = utf8_decode($_POST["nome_professor"]);
$email = utf8_decode($_POST["email_prof"]);
$data_nascimento = $_POST["data_nascimento_prof"];
$senha = $_POST["senha_prof"];
$matricula = $_POST["matricula_professor"];

//Conexao com o banco de dados
$conn = mysqli_connect('mysql', 'root', '123.456','db_projetosAcademicos');
if (!$conn) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

if($id_professor == "" || $id_professor == null || $nome_professor == "" || $nome_professor == null || $email == "" || $email == null || $data_nascimento == "" || $data_nascimento == null ||   $senha == "" || $senha == null ||$matricula =="" || $matricula  == null ){
    echo"<script language='javascript' type='text/javascript'>
    alert('Favor preencher todos os campos');</script>";
    echo"<script language= 'JavaScript'>location.href='/archive/gerenciar_professores.php'</script>";
	}else
	{

		$sql = "UPDATE Professor SET nome_prof = '$nome_professor',data_nascimento ='$data_nascimento',matricula_prof = '$matricula' WHERE id ='$id_professor'";
		$update = mysqli_query($conn,$sql);
		
		$query_select = "SELECT fk_Usuario_id from Professor WHERE id ='$id_professor'";
		$select = mysqli_query($conn,$query_select);
		$rows_id_usuario =  mysqli_fetch_array($select);

		$id_usuario = $rows_id_usuario['fk_Usuario_id'];


		$sql2 = "UPDATE Usuario SET email = '$email',senha = '$senha' WHERE id ='$id_usuario'";
		$update2 = mysqli_query($conn,$sql2);
		

		if($update && $update2){
			echo"<script language='javascript' type='text/javascript'>
		    alert('Professor editado com sucesso!');</script>";
			echo"<script language= 'JavaScript'>location.href='/archive/gerenciar_professores.php'</script>";
		}else{
			echo"<script language='javascript' type='text/javascript'>
		    alert('Não foi possível editar esse Professor, tente novamente e verifique suas permissões.');</script>";
			echo"<script language= 'JavaScript'>location.href='/archive/gerenciar_professores.php'</script>";
		}
	}

mysqli_close($conn);

?>