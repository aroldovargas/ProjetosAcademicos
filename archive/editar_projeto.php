<?php
session_start();

$id_projeto = $_POST["id_projeto"];
$nome_projeto = utf8_decode($_POST["nome_projeto"]);
$descricao = utf8_decode($_POST["descricao_projeto"]);
$data_inicio = $_POST["data_inicio"];
$data_fim = $_POST["data_fim"];

//Conexao com o banco de dados
$conn = mysqli_connect('mysql', 'root', '123.456','db_projetosAcademicos');
if (!$conn) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

if($id_projeto == "" || $id_projeto == null || $nome_projeto == "" || $nome_projeto == null || $descricao == "" || $descricao == null || $data_inicio == "" || $data_inicio == null ||   $data_fim == "" || $data_fim == null){
    echo"<script language='javascript' type='text/javascript'>
    alert('Favor preencher todos os campos');</script>";
    echo"<script language= 'JavaScript'>location.href='/archive/projetos.php'</script>";
	}else
	{

		$sql = "UPDATE Projeto SET nome_projeto = '$nome_projeto',descricao_projeto = '$descricao',data_inicio ='$data_inicio', data_fim = '$data_fim' WHERE id ='$id_projeto'";
		$update = mysqli_query($conn,$sql);
		if($update){
			echo"<script language='javascript' type='text/javascript'>
		    alert('Projeto editado com sucesso!');</script>";
			echo"<script language= 'JavaScript'>location.href='/archive/projetos.php'</script>";
		}else{
			echo"<script language='javascript' type='text/javascript'>
		    alert('Não foi possível editar esse Projeto, tente novamente e verifique suas permissões.');</script>";
			echo"<script language= 'JavaScript'>location.href='/archive/projetos.php'</script>";
		}
	}

mysqli_close($conn);

?>