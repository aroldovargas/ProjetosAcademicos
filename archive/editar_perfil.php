<?php
session_start();

$id_aluno = $_POST["id_aluno"];
$nome_aluno = utf8_decode($_POST["nome_cadastro"]);
$email = utf8_decode($_POST["email_cadastro"]);
$data_nascimento = $_POST["data_nascimento_cadastro"];
$senha = $_POST["senha_cadastro"];
$matricula = $_POST["matricula_cadastro"];
$id_curso = $_POST["curso_cadastro"];

$_SESSION['nome'] = $nome_aluno;
$_SESSION['email'] = $email;
// echo nl2br($id_aluno."\n");
// echo nl2br($nome_aluno."\n");
// echo nl2br($email."\n");
// echo nl2br($data_nascimento."\n");
// echo nl2br($senha."\n");
// echo nl2br($matricula."\n");
// echo nl2br($id_curso."\n");



//Conexao com o banco de dados
$conn = mysqli_connect('mysql', 'root', '123.456','db_projetosAcademicos');
if (!$conn) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

if($id_aluno == "" || $id_aluno == null || $nome_aluno == "" || $nome_aluno == null || $email == "" || $email == null || $data_nascimento == "" || $data_nascimento == null ||   $senha == "" || $senha == null || $matricula == "" || $matricula  == null || $id_curso == "" || $id_curso  == null){
    echo"<script language='javascript' type='text/javascript'>
    alert('Favor preencher todos os campos');</script>";
    echo"<script language= 'JavaScript'>location.href='/archive/perfil.php'</script>";
	}else
	{

		$sql = "UPDATE Aluno SET nome_aluno = '$nome_aluno',matricula_aluno ='$matricula',data_nascimento = '$data_nascimento',fk_Curso_id = '$id_curso' WHERE id ='$id_aluno'";
		$update = mysqli_query($conn,$sql);
		
		$query_select = "SELECT fk_Usuario_id from Aluno WHERE id ='$id_aluno'";
		$select = mysqli_query($conn,$query_select);
		$rows_id_usuario =  mysqli_fetch_array($select);

		$id_usuario = $rows_id_usuario['fk_Usuario_id'];


		$sql2 = "UPDATE Usuario SET email = '$email',senha = '$senha' WHERE id ='$id_usuario'";
		$update2 = mysqli_query($conn,$sql2);
		
		if($update && $update2){
			echo"<script language='javascript' type='text/javascript'>
		    alert('Perfil alterado com sucesso!');</script>";
			echo"<script language= 'JavaScript'>location.href='/archive/perfil.php'</script>";
		}else{
			echo"<script language='javascript' type='text/javascript'>
		    alert('Não foi possível editar esse perfil, tente novamente e verifique suas permissões.');</script>";
			echo"<script language= 'JavaScript'>location.href='/archive/perfil.php'</script>";
		}
	}

mysqli_close($conn);

?>