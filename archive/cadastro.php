<?php
session_start();
// echo "<br>Nome: " . $_POST["nome_cadastro"];
// echo "<br>Login/Email: " . $_POST["email_cadastro"];
// echo "<br>Senha: " . $_POST["senha_cadastro"];
// echo "<br>Matricula: " . $_POST["matricula_cadastro"];
// echo "<br>Data de nascimento: " . $_POST["data_nascimento_cadastro"];
// echo "<br>Curso: " . $_POST["curso_cadastro"];
// echo "<br>Funcao: " . $_POST["funcao_cadastro"];

$nome = utf8_decode($_POST["nome_cadastro"]);
$email = $_POST["email_cadastro"];
$senha = $_POST["senha_cadastro"];
$matricula = $_POST["matricula_cadastro"];
$data_nasc = $_POST["data_nascimento_cadastro"];
$curso = utf8_decode($_POST["curso_cadastro"]);
$Tipo_usu = utf8_decode($_POST["funcao_cadastro"]);

//Conexao com o banco de dados
$conn = mysqli_connect('mysql', 'root', '123.456','db_projetosAcademicos');
if (!$conn) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}


if($nome == "" || $nome == null || $email == "" || $email == null || $senha == "" || $senha == null || $matricula == "" || $matricula == null || $data_nasc == "" || $data_nasc == null || $curso == "" || $curso == null || $Tipo_usu == "" || $Tipo_usu == null){
	
    // echo"<script language='javascript' type='text/javascript'>
    // alert('Favor preencher todos os campos');</script>";
    // echo"<script language= 'JavaScript'>location.href='/archive/login.html'</script>";
	}else{

		$query_select = "SELECT email FROM Usuario WHERE email = '$email'";
		$select = mysqli_query($conn,$query_select);
		$array = mysqli_fetch_array($select);
		$email_base = $array['email'];

	  if($email_base == $email){

	    echo"<script language='javascript' type='text/javascript'>
	    alert('Esse email já está cadastrado');</script>";
    	echo"<script language= 'JavaScript'>location.href='/archive/login.html'</script>";

	    // die();

	  }else{


	    $sql = "SELECT id FROM Tipo_Usuario WHERE desc_tipo_usuario ='$Tipo_usu'";
		$result = mysqli_query($conn, $sql);
		$array = mysqli_fetch_array($result);
		$id_tipoUsuario = $array['id'];

		$sql = "SELECT id FROM Curso WHERE nome_curso ='$curso'";
		$result = mysqli_query($conn, $sql);
		$array = mysqli_fetch_array($result);
		$id_curso = $array['id'];
		//inserindo todos os usuarios de todos os tipos ,ADM ALUNO PROFESSOR
		$sql = "INSERT INTO Usuario(email,senha,fk_Tipo_Usuario_id) VALUES ('$email','$senha','$id_tipoUsuario')";
		$insert = mysqli_query($conn,$sql);
		//pegando id_usuario
		$sql = "SELECT id FROM Usuario WHERE email ='$email'";
		$result = mysqli_query($conn, $sql);
		$array = mysqli_fetch_array($result);
		$id_usuario = $array['id'];
		//SE CHEGAR AQUI NAO EH ADM , EH professor = 2 aluno = 3
		if($id_tipoUsuario == 2){
			$sql_prof = "INSERT INTO Professor(data_nascimento,matricula_prof,nome_prof,fk_Usuario_id) VALUES ('$data_nasc','$matricula','$nome','$id_usuario')";
			$insert = mysqli_query($conn,$sql_prof);
		}
		if($id_tipoUsuario == 3){
			$sql_aluno = "INSERT INTO Aluno(nome_aluno,matricula_aluno,data_nascimento,fk_Usuario_id,fk_Curso_id) VALUES ('$nome','$matricula','$data_nasc','$id_usuario','$id_curso')";
			$insert = mysqli_query($conn,$sql_aluno);
		}

	    if($insert){
			$_SESSION['nome'] = $nome;
			$_SESSION['email'] = $email;
	     	header("Location:home.php");
	    }else{
	    	header("Location:erro.html");
	    }
	  }
    }
mysqli_close($conn);

?>