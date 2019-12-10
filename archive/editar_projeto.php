<?php
session_start();

$id_projeto = $_POST["id_projeto"];
$nome_projeto = utf8_decode($_POST["nome_projeto"]);
$descricao = utf8_decode($_POST["descricao_projeto"]);
$data_inicio = $_POST["data_inicio"];
$data_fim = $_POST["data_fim"];
$id_laboratorio = $_POST["id_laboratorio"];
$id_status = $_POST["id_status"];

//Conexao com o banco de dados
$conn = mysqli_connect('mysql', 'root', '123.456','db_projetosAcademicos');
if (!$conn) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

if($id_projeto == "" || $id_projeto == null || $nome_projeto == "" || $nome_projeto == null || $descricao == "" || $descricao == null || $data_inicio == "" || $data_inicio == null ||   $data_fim == "" || $data_fim == null ||$id_laboratorio =="" || $id_laboratorio  == null || $id_status =="" || $id_status == null ){
    echo"<script language='javascript' type='text/javascript'>
    alert('Favor preencher todos os campos');</script>";
    echo"<script language= 'JavaScript'>location.href='/archive/projetos.php'</script>";
	}else
	{

		$sql = "UPDATE Projeto SET nome_projeto = '$nome_projeto',descricao_projeto = '$descricao',data_inicio ='$data_inicio', data_fim = '$data_fim',fk_Status_id = '$id_status' WHERE id ='$id_projeto'";
		$update = mysqli_query($conn,$sql);
		#atualizando tabela desenvolvido que eh a relacao entre projeto e laboratorio
		#fk_Projeto_id  fk_Laboratorio_id
		$sql2 = "UPDATE desenvolvido SET fk_Projeto_id = '$id_projeto',fk_Laboratorio_id = '$id_laboratorio' WHERE fk_Projeto_id ='$id_projeto'";
		$update2 = mysqli_query($conn,$sql2);
		if($update && $update2){
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