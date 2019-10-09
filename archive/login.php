<?php
$email = $_POST['email'];
$senha = $_POST['senha'];

$conn = mysqli_connect('mysql', 'root', '123.456','archive');
if (!$conn) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

$query = "SELECT * FROM usuario WHERE email = '$email'";
$verifica = mysqli_query($conn,$query);
$array = mysqli_fetch_array($verifica);

$nome = $array["nome"];
$senhadb = $array["senha"];

if ($senhadb == $senha){
	session_start();
	$_SESSION['nome'] = $nome;
	$_SESSION['email'] = $email;
	header("Location:home.php");
	echo"<script language='javascript' type='text/javascript'>alert('Bem vindo');</script>";
}else{
	echo"<script language='javascript' type='text/javascript'>alert('Login e/ou senha incorretos');</script>";
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