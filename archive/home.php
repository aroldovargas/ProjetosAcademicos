<?php session_start();?>
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
<div class="" style="background-image: url('imagens/91352.jpg')">
	<div class="row">
		<div class="col-2">
			<img src="imagens/logo2.png" width=120 height=100 style="margin-top:30%; margin-bottom: 5%;margin-left: 20%" align: left>
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
        	<li><a href="home.php">Home</a></li>
        	<li><a href="laboratorios.php">Laboratórios</a></li>
        	<li><a href="projetos.php">Projetos</a></li>
        	<li style="margin-right: 6%"><a href="noticias.php">Notícias</a></li>
        	<li><?php
				if (isset($_SESSION["nome"])){
					?><a href="perfil.php"><?php
					echo $_SESSION["nome"];
				}else{
					?><a href="login.html"> Fazer login</a><?php 
				}
				?></a></li>
			<li style="margin-right: -8%"><a href="logout.php">Sair</a></li>
    	</ul>
</nav>

<div class="container">
	<div class="row">
		<div class="col">
		</div>
	</div>
	<div class="container" style="width: 80%;height: 40%;">
	  <h2>Carousel Example</h2>  
	  <div id="myCarousel" class="carousel slide" data-ride="carousel">
	    <!-- Indicators -->
	    <ol class="carousel-indicators">
	      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
	      <li data-target="#myCarousel" data-slide-to="1"></li>
	      <li data-target="#myCarousel" data-slide-to="2"></li>
	    </ol>

	    <!-- Wrapper for slides -->
	    <div class="carousel-inner" >
	      <div class="item active">
	        <img src="imagens/gato-rico.jpeg" alt="Los Angeles" style="width:100%;">
	      </div>

	      <div class="item">
	        <img src="chicago.jpg" alt="Chicago" style="width:100%;">
	      </div>
	    
	      <div class="item">
	        <img src="ny.jpg" alt="New york" style="width:100%;">
	      </div>
	    </div>

	    <!-- Left and right controls -->
	    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
	      <span class="glyphicon glyphicon-chevron-left"></span>
	      <span class="sr-only">Previous</span>
	    </a>
	    <a class="right carousel-control" href="#myCarousel" data-slide="next">
	      <span class="glyphicon glyphicon-chevron-right"></span>
	      <span class="sr-only">Next</span>
	    </a>
	  </div>
	</div>

</body>
</html>

</div>

</html>

