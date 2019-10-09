<?php
// echo "<br>Nome: " . $_POST["nome"];
// echo "<br>Login/Email: " . $_POST["email"];
// echo "<br>Senha: " . $_POST["senha"];
// echo "<br>Matricula: " . $_POST["matricula"];
// echo "<br>Data de nascimento: " . $_POST["data_nascimento"];
// echo "<br>Curso: " . $_POST["curso"];
// echo "<br>Funcao: " . $_POST["funcao"];

$nome = utf8_decode($_POST["nome_cadastro"]);
$email = $_POST["email_cadastro"];
$senha = $_POST["senha_cadastro"];
$matricula = $_POST["matricula_cadastro"];
$data_nasc = $_POST["data_nascimento_cadastro"];
$curso = utf8_decode($_POST["curso_cadastro"]);
$funcao = utf8_decode($_POST["funcao_cadastro"]);

//Conexao com o banco de dados
$conn = mysqli_connect('mysql', 'root', '123.456','archive');
if (!$conn) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}


if($nome == "" || $nome == null || $email == "" || $email == null || $senha == "" || $senha == null || $matricula == "" || $matricula == null || $data_nasc == "" || $data_nasc == null || $curso == "" || $curso == null || $funcao == "" || $funcao == null){
	echo "primeiro if";
    // echo"<script language='javascript' type='text/javascript'>
    // alert('Favor preencher todos os campos');</script>";
    // echo"<script language= 'JavaScript'>location.href='/archive/login.html'</script>";
	}else{
		$query_select = "SELECT email FROM usuario WHERE email = '$email'";
		$select = mysqli_query($conn,$query_select);
		$array = mysqli_fetch_array($select);
		$email_base = $array['email'];

	  if($email_base == $email){

	    echo"<script language='javascript' type='text/javascript'>
	    alert('Esse email já está cadastrado');</script>";
    	echo"<script language= 'JavaScript'>location.href='/archive/login.html'</script>";

	    // die();

	  }else{

	    $sql = "SELECT id FROM funcao WHERE nome ='$funcao'";
		$result = mysqli_query($conn, $sql);
		$array = mysqli_fetch_array($result);
		$id_funcao = $array['id'];

		$sql = "SELECT id FROM curso WHERE nome ='$curso'";
		$result = mysqli_query($conn, $sql);
		$array = mysqli_fetch_array($result);
		$id_curso = $array['id'];

		$sql = "INSERT INTO usuario(nome,email,senha,matricula,data_nasc,curso,funcao) VALUES ('$nome','$email','$senha','$matricula','$data_nasc','$id_curso','$id_funcao')";
		$insert = mysqli_query($conn,$sql);
	    if($insert){
	    	session_start();
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