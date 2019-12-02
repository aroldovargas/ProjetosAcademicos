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
	<script src='https://kit.fontawesome.com/a076d05399.js'></script>
</head>
<body>

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
		<h2 align="center" style="margin-top: 3%;font-family: Fantasy"> Laboratórios </h2>
		<div class="row">
			<div class="col" align="right">
				<button data-toggle="modal" data-target="#myModalCadastro" href="#myModalCadastro" id="btnCrud">Cadastrar laboratório</button>
			</div>
		</div>
		<div class="row">
			<div class="col" align="right">
				<button data-toggle="modal" data-target="#myModalEditar" href="#myModalEditar" id="btnCrud">Editar laboratório</button>
			</div>
		</div>
		<div class="row">
			<div class="col" align="right">
				<button data-toggle="modal" data-target="#myModalDelete" href="#myModalDelete" id="btnCrud">Excluir laboratório</button>
			</div>
		</div>
		<div class="row" align="left">
			
			<?php
				$conn = mysqli_connect('mysql', 'root', '123.456','db_projetosAcademicos');
				if (!$conn) {
				    echo "Error: Unable to connect to MySQL." . PHP_EOL;
				    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
				    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
				    exit;
				}
				$query_select = "SELECT * FROM Laboratorio";
				$pularlinha = "\n";
				if ($result = $conn->query($query_select)) {
					while ($row = $result->fetch_row()) {
       					echo nl2br($pularlinha);
       					echo nl2br($pularlinha);
       					?>		
       					<!-- <div class="col-11" style="margin-bottom: 2%;font-family: fantasy;font-size: 100%"> -->
       					<div class="card text-center col-10" style="margin-bottom: 4%;margin-top:2%;font-family: fantasy;" >
							<div class="card-header" style="font-size: 18px"><?php echo utf8_encode($row[1]);?></div>
							<div class="card-body">
						    	<h5 class="card-title" style="font-size: 18px;margin-bottom: 4%"><?php echo utf8_encode($row[2]);?></h5>
						    	<p class="card-text" align="left"><?php echo utf8_encode($row[3]);?></p>
						    	
						  	</div>
							<div class="row" style="margin-top:5%;margin-left: 40%;margin-bottom: 2%;">
								<a href="#" id="btnBusca">VISITAR <?php echo utf8_encode($row[1]);?></a>
							</div>	
						</div>
       					<?php
       					// printf (" SIGLA : %s ".nl2br($pularlinha)." NOME : %s ".nl2br($pularlinha)."DESCRIÇÃO : %s \n",utf8_encode($row[1]),utf8_encode($row[2]),utf8_encode($row[3]));		
    					//printf ("%s \n", $row);
    					?>
			    		<!-- </div>			 -->
	
    					<?php
    				}
    			}
				?>
		</div>
	</div>

	<div class="modal fade " id="myModalCadastro" role="dialog">
		<div class="modal-dialog">		     
		  	<div class="modal-content" align="left">
			    <div class="modal-header">
			    	<h4 class="modal-title">Cadastro de Laboratório</h4>
			      	<button type="button" class="close" data-dismiss="modal">&times;</button>
			    </div>
			    <form id="cadastro_laboratorio" action="cadastro_laboratorio.php" method="POST"> 
			    	<div class="modal-body" style="padding-top: 2%">
				        <label for="nome_laboratorio">Nome</label>
				        <input style="width: 50%" type="text" id="nome_laboratorio" name="nome_laboratorio"></input>
				    </div>
				    <div class="modal-body" style="padding-top: 2%">
				        <label for="descricao_laboratorio">Descrição</label>
				        <input style="width: 50%" type="text" id="descricao_laboratorio" name="descricao_laboratorio"></input>
				    </div>
				    <div class="modal-body" style="padding-top: 2%">
				        <label for="sigla_laboratorio">Sigla</label>
				        <input style="width: 50%" type="text" id="sigla_laboratorio" name="sigla_laboratorio"></input>
				    </div>
				<div class="modal-footer">
		          	<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
		          	<button type="submit" class="btn btn-default">Criar laboratório</button>
		        </div>
				</form>
		    </div>	
		 </div>
	</div>

	<div class="modal fade " id="myModalDelete" role="dialog">
		<div class="modal-dialog">		     
		  	<div class="modal-content" align="left">
			    <div class="modal-header">
			    	<h4 class="modal-title">Excluir de Laboratório</h4>
			      	<button type="button" class="close" data-dismiss="modal">&times;</button>
			    </div>
			    <form id="deletar_laboratorio" action="deletar_laboratorio.php" method="POST"> 
			    	<div class="modal-body" style="padding-top: 2%">
				        <label for="nome_laboratorio">Laboratório</label>
				        <select style="width: 60%" type="text" id="id_laboratorio" name="id_laboratorio">
				        	<option value="">Selecione o laboratório que deseja excluir...</option>
				  			<?php
								$conn = mysqli_connect('mysql', 'root', '123.456','db_projetosAcademicos');
								if (!$conn) {
								    echo "Error: Unable to connect to MySQL." . PHP_EOL;
								    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
								    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
								    exit;
								}
								$query_select = "SELECT id,sigla FROM Laboratorio";
								if ($result = $conn->query($query_select)) {
									while ($row = $result->fetch_row()) { 
										//echo $row[0]; 
										?>
										<option value=<?php echo $row[0]?>><?php echo $row[1]?></option>
										<?php
									}
								}

							?>      					        
				       	</select>
				    </div>
				<div class="modal-footer">
		          	<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
		          	<button type="submit" class="btn btn-default">Excluir Laboratório</button>
		        </div>
				</form>
		    </div>	
		 </div>
	</div>
	<div class="modal fade " id="myModalEditar" role="dialog">
		<div class="modal-dialog">		     
		  	<div class="modal-content" align="left">
			    <div class="modal-header">
			    	<h4 class="modal-title">Editar Laboratório</h4>
			      	<button type="button" class="close" data-dismiss="modal">&times;</button>
			    </div>
			    <form id="editar_laboratorios" action="editar_laboratorios.php" method="POST"> 
			    	<div class="modal-body" style="padding-top: 2%">
				        <label for="nome_laboratorio">Laboratório</label>
				        <select style="width: 60%" type="text" id="id_laboratorio" name="id_laboratorio">
				        	<option value="">Selecione um laboratorio para editar...</option>
				  			<?php
								$conn = mysqli_connect('mysql', 'root', '123.456','db_projetosAcademicos');
								if (!$conn) {
								    echo "Error: Unable to connect to MySQL." . PHP_EOL;
								    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
								    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
								    exit;
								}
								$query_select = "SELECT id,sigla FROM Laboratorio";
								if ($result = $conn->query($query_select)) {
									while ($row = $result->fetch_row()) { 
										echo $row[0]; ?>
										<option value=<?php echo $row[0]?>><?php echo $row[1]?></option>
										<?php
									}
								}

							?>      					        
				       	</select>
				    </div>
			    	<div class="modal-body" style="padding-top: 2%">
				        <label for="nome_laboratorio">Nome</label>
				        <input style="width: 50%" type="text" id="nome_laboratorio" name="nome_laboratorio"></input>
				    </div>
				    <div class="modal-body" style="padding-top: 2%">
				        <label for="descricao_laboratorio">Descrição</label>
				        <input style="width: 50%" type="text" id="descricao_laboratorio" name="descricao_laboratorio"></input>
				    </div>
				    <div class="modal-body" style="padding-top: 2%">
				        <label for="sigla_laboratorio">Sigla</label>
				        <input style="width: 50%" type="text" id="sigla_laboratorio" name="sigla_laboratorio"></input>
				    </div>
<!-- 				    <div class="modal-body" style="padding-top: 2%">
				        <label for="imagem">Imagem</label>
				        <input type="file" name="imagem"/>
				    </div> -->
				<div class="modal-footer">
		          	<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
		          	<button type="submit" class="btn btn-default">Editar laboratório</button>
		        </div>
				</form>
		    </div>	
		 </div>
	</div>
</body>
</html>