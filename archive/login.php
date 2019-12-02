<?php
session_start();
$email = $_POST['email'];
$senha = $_POST['senha'];


if($email == "admin@admin.com" || $senha=='admin'){
	echo"<script language= 'JavaScript'>location.href='/archive/painel.php'</script>";
}

$conn = mysqli_connect('mysql', 'root', '123.456','db_projetosAcademicos');
if (!$conn) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

$query_usuario = "SELECT * FROM Usuario WHERE email = '$email'";
$verifica_usuario = mysqli_query($conn,$query_usuario);
$array = mysqli_fetch_array($verifica_usuario);

//professor = 1 aluno =2 administrador =0

if($array["fk_Tipo_Usuario_id"] == 2){
	$id_professor = $array["id"];
	$query_professor = "SELECT nome_prof FROM Professor WHERE id = '$id_professor'";
	$verifica_professor = mysqli_query($conn,$query_professor);
	$arrayUsuario = mysqli_fetch_array($verifica_professor);
	$nome = $arrayUsuario["nome_prof"];
}
if($array["fk_Tipo_Usuario_id"] == 3){
	$id_aluno = $array["id"];
	$query_aluno = "SELECT nome_aluno FROM Aluno WHERE id = '$id_aluno'";
	$verifica_aluno = mysqli_query($conn,$query_aluno);
	$arrayUsuario = mysqli_fetch_array($verifica_aluno);
	$nome = $arrayUsuario["nome_aluno"];
}

if($array["fk_Tipo_Usuario_id"] == 1){
	$nome = "Admin";
}

$senhadb = $array["senha"];

if ($senhadb == $senha){
	$_SESSION['nome'] = $nome;
	$_SESSION['email'] = $email;
	// header("Location:home.php");
	echo"<script language='javascript' type='text/javascript'>alert('Bem vindo, ".$nome."');</script>";
	echo"<script language= 'JavaScript'>location.href='/archive/home.php'</script>";
}else{
	echo"<script language='javascript' type='text/javascript'>alert('Login e/ou senha incorretos');</script>";
	echo"<script language= 'JavaScript'>location.href='/archive/login.html'</script>";
}

// if (isset($email)) {
// 	$query = "SELECT * FROM usuario WHERE email = '$email' AND senha = '$senha'";
// 	$verifica = mysqli_query($conn,$query);
// 	$array = mysqli_fetch_array($verifica);

// 	echo "array:".$array;
// 	if (mysqli_num_rows($array)<=0){
// 		echo"<script language='javascript' type='text/javascript'>alert('Login e/ou senha incorretos');</script>";
//     	die();
// 	}else{
// 	    setcookie("email",$email);
// 	    echo "Bem vindo".$email;
// 	    header("Location:archive/home.html");
//   }
// }

mysqli_close($conn);

?>