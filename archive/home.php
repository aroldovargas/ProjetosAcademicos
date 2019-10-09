<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="estilo.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</head>
<div class="" style="background-image: url('imagens/91352.jpg')">
	<div class="row">
		<div class="col-2">
			<img src="imagens/logo2.png" width=150 height=150 style="margin-top:30%; margin-bottom: 5%;margin-left: 20%" align: left>
		</div>
		<div class="col-5">
			<h2 id="tittle" style="margin-top: 5%;font-family: Fantasy;font-size: 40px" align="left">Arquivo IFES</h2>
		</div>
		<div class="col-5">
			<div id="divBusca" style="margin-top: 20%">
			 	<input type="text" id="txtBusca" placeholder="Buscar..."/>
			 	<button type="submit" id="btnBusca">Buscar</button>
			</div>
		</div>
	</div>
</div>

<nav id="menu">
    	<ul align="center">
        	<li><a href="home.html">Home</a></li>
        	<li><a href="laboratorios.html">Laboratórios</a></li>
        	<li><a href="projetos.html">Projetos</a></li>
        	<li><a href="noticias.html">Noticias</a></li>
        	<li><a href="perfil.html"><?php
				session_start();
				if (!isset($_SESSION["nome"])){
					echo $_SESSION["nome"];
					var_dump($_SESSION["nome"]);
					echo $_SESSION["email"];
					echo "chegou";
				}else{
					echo "nao chegou";
				}

				?></a></li>
    	</ul>
</nav>
</html>

