<?php session_start();

$conn = mysqli_connect('mysql', 'root', '123.456','db_projetosAcademicos');
if (!$conn) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
$query_projeto = "SELECT COUNT(*) FROM Projeto;";
$verifica_projeto = mysqli_query($conn,$query_projeto);
$array = mysqli_fetch_array($verifica_projeto);
$total_projetos = $array[0];

$query_laboratorio = "SELECT COUNT(*) FROM Laboratorio;";
$verifica_laboratorio = mysqli_query($conn,$query_laboratorio);
$array_laboratorio = mysqli_fetch_array($verifica_laboratorio);
$total_laboratorios = $array_laboratorio[0];

$query_aluno = "SELECT COUNT(*) FROM Aluno;";
$verifica_aluno = mysqli_query($conn,$query_aluno);
$array_aluno = mysqli_fetch_array($verifica_aluno);
$total_alunos = $array_aluno[0];

$query_professores = "SELECT COUNT(*) FROM Professor;";
$verifica_professores = mysqli_query($conn,$query_professores);
$array_professores = mysqli_fetch_array($verifica_professores);
$total_professores = $array_professores[0];

?>

<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="estilo.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="" style="background-image: url('imagens/91352.jpg')">
		<div class="row">
			<div class="col-2">
				<img src="imagens/logo2.png" width=120 height=100 style="margin-top:30%; margin-bottom: 5%;margin-left: 20%" align: left>
			</div>
			<div class="col-10">
				<h2 id="tittle" style="margin-top: 5%;font-family: Fantasy;font-size: 40px" align="left">Arquivo IFES - Painel Administrativo</h2>
			</div>
		</div>
	</div>
	<nav id="menu">
	    	<ul align="center">
	        	<li></li>
	        	<li></li>
	        	<li></li>
	        	<li style="margin-right: 85%"></li>
	        	<li></li>
				<li><a href="logout.php">Sair</a></li>
	    	</ul>
	</nav>
	<div class="container">
		<div class="row" style="margin-top: 5%;font-family: fantasy;">
			<div class="col-3">
				<div class="card text-white bg-primary mb-3" style="max-width: 25rem;" align="center" >
				  <div class="card-header">Alunos</div>
				  <div class="card-body">
				    <h5 class="card-title" style="font-size: 36px;"><?echo $total_alunos?></h5>
				    <p class="card-text">Alunos cadastrados.</p>
				  </div>
				  <div class="card-footer"><a href="#" style="color: white">Gerenciar Alunos</a></div>
				</div>
			</div >
			<div class="col-3">	
				<div class="card text-white bg-secondary mb-3" style="max-width: 25rem;" align="center">
				  <div class="card-header">Professores</div>
				  <div class="card-body">
				    <h5 class="card-title" style="font-size: 36px;"><?echo $total_professores?></h5>
				    <p class="card-text">Professores cadastrados.</p>
				  </div>
				  <div class="card-footer"><a href="#" style="color: white">Gerenciar Professores</a></div>
				</div>
			</div>
			<div class="col-3">	
				<div class="card text-white bg-danger mb-3" style="max-width: 25rem;" align="center">
				  <div class="card-header">Laboratórios</div>
				  <div class="card-body">
				    <h5 class="card-title" style="font-size: 36px;"><?echo $total_laboratorios?></h5>
				    <p class="card-text">Laboratórios cadastrados.</p>
				  </div>
				  <div class="card-footer"><a href="#" style="color: white">Gerenciar Laboratórios</a></div>
				</div>
			</div>
			<div class="col-3">	
				<div class="card text-white bg-success mb-3" style="max-width: 25rem;" align="center">
				  <div class="card-header">Projetos</div>
				  <div class="card-body">
				    <h5 class="card-title" style="font-size: 36px;"><?echo $total_projetos?></h5>
				    <p class="card-text">Projetos cadastrados.</p>
				  </div>
				  <div class="card-footer"><a href="#" style="color: white">Gerenciar Projetos</a></div>
				</div>
			</div>
		</div>
	</div>