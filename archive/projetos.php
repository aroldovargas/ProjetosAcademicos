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
<body>
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
		<h2 align="center" style="margin-top: 3%;font-family: Fantasy"> Projetos </h2>
		<div class="row">
			<div class="col" align="right">
				<button data-toggle="modal" data-target="#myModal" href="#myModal">Cadastrar projeto</button>
			</div>
		</div>
		<div class="row">
			<?php
				$conn = mysqli_connect('mysql', 'root', '123.456','db_projetosAcademicos');
				if (!$conn) {
				    echo "Error: Unable to connect to MySQL." . PHP_EOL;
				    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
				    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
				    exit;
				}
				$query_select = "SELECT * FROM Projeto";
				$pularlinha = "\n";
				if ($result = $conn->query($query_select)) {
					while ($row = $result->fetch_row()) {
						$id_status = $row[5];
						$query_idStatus = "SELECT nome FROM Status WHERE id = '$id_status'";
						$select = mysqli_query($conn,$query_idStatus);
						$array = mysqli_fetch_array($select);
       					$nome_status = $array['nome'];
       					echo nl2br($pularlinha);
       					echo nl2br($pularlinha);
       					printf (" NOME : %s ".nl2br($pularlinha)." DESCRIÇÃO : %s ".nl2br($pularlinha)."  DATA INÍCIO : %s ".nl2br($pularlinha)." DATA TÉRMINO : %s ".nl2br($pularlinha)." STATUS : %s \n",utf8_encode($row[3]),utf8_encode($row[1]),utf8_encode($row[0]),utf8_encode($row[4]),utf8_encode($nome_status));		
    					//printf ("%s \n", $row);
    				}
    			}
				?>
		</div>
	</div>

	<div class="modal fade " id="myModal" role="dialog">
		<div class="modal-dialog">		     
		  	<div class="modal-content" align="left">
			    <div class="modal-header">
			    	<h4 class="modal-title" >Cadastro de projeto</h4>
			      	<button type="button" class="close" data-dismiss="modal">&times;</button>
			    </div>
			    <form id="cadastro_projeto" action="cadastro_projeto.php" method="POST"> 
			    	<div class="modal-body" style="padding-top: 2%">
				        <label for="nome_projeto">Nome</label>
				        <input style="width: 50%" type="text" id="nome_projeto" name="nome_projeto"></input>
				    </div>
				    <div class="modal-body" style="padding-top: 2%">
				        <label for="descricao_projeto">Descrição</label>
				        <input style="width: 80%" type="text" id="descricao_projeto" name="descricao_projeto"></input>
				    </div>
				    <div class="modal-body" style="padding-top: 2%">
				        <label for="data_inicio">Data Inicio</label>
				        <input style="width: 30%" type="date" id="data_inicio" name="data_inicio"></input>
				    </div>
				    <div class="modal-body" style="padding-top: 2%">
				        <label for="data_fim">Data fim</label>
				        <input style="width: 30%" id="data_fim" type="date" name="data_fim"></input>
				    </div>
<!-- 				    <div class="modal-body" style="padding-top: 2%">
				        <label for="imagem">Imagem</label>
				        <input type="file" name="imagem"/>
				    </div> -->
				<div class="modal-footer">
		          	<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
		          	<button type="submit" class="btn btn-default">Criar projeto</button>
		        </div>
				</form>
		    </div>	
		 </div>
	</div>
</body>
</html>