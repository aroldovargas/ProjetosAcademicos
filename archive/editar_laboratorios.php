<?php
session_start();

$id_laboratorio = $_POST["id_laboratorio"];
$nome = utf8_decode($_POST["nome_laboratorio"]);
$descricao = utf8_decode($_POST["descricao_laboratorio"]);
$sigla = $_POST["sigla_laboratorio"];

//Conexao com o banco de dados
$conn = mysqli_connect('mysql', 'root', '123.456','db_projetosAcademicos');
if (!$conn) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

if($nome == "" || $nome == null || $descricao == "" || $descricao == null || $sigla == "" || $sigla == null || $id_laboratorio == "" || $id_laboratorio == null){
	
    // echo"<script language='javascript' type='text/javascript'>
    // alert('Favor preencher todos os campos');</script>";
    // echo"<script language= 'JavaScript'>location.href='/archive/login.html'</script>";
	}else
	{

		$sql = "UPDATE Laboratorio SET sigla = '$sigla',nome_lab = '$nome',descricao_lab ='$descricao' WHERE id ='$id_laboratorio'";
		$update = mysqli_query($conn,$sql);
		if($update){
			echo"<script language='javascript' type='text/javascript'>
		    alert('Laboratório editado com sucesso!');</script>";
			echo"<script language= 'JavaScript'>location.href='/archive/laboratorios.php'</script>";
		}else{
			echo"<script language='javascript' type='text/javascript'>
		    alert('Não foi possível editar esse laboratório, tente novamente e verifique suas permissões.');</script>";
			echo"<script language= 'JavaScript'>location.href='/archive/laboratorios.php'</script>";
		}
	}

mysqli_close($conn);

?>