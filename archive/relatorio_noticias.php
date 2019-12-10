<?php
session_start();

$tipo_noticia = utf8_decode($_POST["tipo_noticia"]);
$data = $_POST["data"];

#$data_inicio = $_POST["data_inicio"];
#$data_fim = $_POST["data_fim"];

//Conexao com o banco de dados
$conn = mysqli_connect('mysql', 'root', '123.456','db_projetosAcademicos');
if (!$conn) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

if($tipo_noticia == "" || $tipo_noticia == null || $data == "" || $data == null){
    echo"<script language='javascript' type='text/javascript'>
    alert('Favor preencher todos os campos');</script>";
    echo"<script language= 'JavaScript'>location.href='/archive/noticias.php'</script>";
	}

mysqli_close($conn);

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
		<h2 align="center" style="margin-top: 3%;font-family: Fantasy"> Notícias </h2>
		<div class="row">
			<div class="col" align="right">
				<button data-toggle="modal" data-target="#myModalCadastro" href="#myModalCadastro" id="btnCrud">Cadastrar notícia</button>
			</div>
		</div>
		<div class="row">
			<div class="col" align="right">
				<button data-toggle="modal" data-target="#myModalEditar" href="#myModalEditar" id="btnCrud">Editar notícia</button>
			</div>
		</div>
		<div class="row">
			<div class="col" align="right">
				<button data-toggle="modal" data-target="#myModalExcluir" href="#myModalExcluir" id="btnCrud">Excluir notícia</button>
			</div>
		</div>
		<div class="row">
			<div class="col" align="right">
				<button data-toggle="modal" data-target="#myModalRelatorioN" href="#myModalRelatorioN" id="btnCrud">Emitir Relatório</button>
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
				if($tipo_noticia == "todos"){
					$query_select = "SELECT * FROM Noticia";
					$pularlinha = "\n";
					if ($result = $conn->query($query_select)) {
						while ($row = $result->fetch_row()) {
							//pegando nome laboratorio
							$id_laboratorio = $row[3];
							
							$query_idLab = "SELECT nome_lab FROM Laboratorio WHERE id = '$id_laboratorio'";
							$select = mysqli_query($conn,$query_idLab);
							$array = mysqli_fetch_array($select);
	       					$nome_laboratorio = $array['nome_lab'];
							//pegando nome projeto
	       					$id_projeto = $row[4];
	       					$query_idLab = "SELECT nome_projeto FROM Projeto WHERE id = '$id_projeto'";
							$select = mysqli_query($conn,$query_idLab);
							$array = mysqli_fetch_array($select);
	       					$nome_projeto = $array['nome_projeto'];
	       					echo nl2br($pularlinha);
	       					echo nl2br($pularlinha);
	       					printf ("TIPO : %s ".nl2br($pularlinha)." DESCRIÇÃO : %s ".nl2br($pularlinha)." \n",utf8_encode($row[2]),utf8_encode($row[1]));		
	    					//printf ("%s \n", $row);
	    				}
	    			}
				}else{
					$query_select = "SELECT * FROM Noticia WHERE tipo ='$tipo_noticia'";
					$pularlinha = "\n";
					if ($result = $conn->query($query_select)) {
						while ($row = $result->fetch_row()) {
							//pegando nome laboratorio
							$id_laboratorio = $row[3];
							$query_idLab = "SELECT nome_lab FROM Laboratorio WHERE id = '$id_laboratorio'";
							$select = mysqli_query($conn,$query_idLab);
							$array = mysqli_fetch_array($select);
	       					$nome_laboratorio = $array['nome_lab'];
							//pegando nome projeto
	       					$id_projeto = $row[4];
	       					$query_idLab = "SELECT nome_projeto FROM Projeto WHERE id = '$id_projeto'";
							$select = mysqli_query($conn,$query_idLab);
							$array = mysqli_fetch_array($select);
	       					$nome_projeto = $array['nome_projeto'];
	       					echo nl2br($pularlinha);
	       					echo nl2br($pularlinha);
	       					printf ("TIPO : %s ".nl2br($pularlinha)." DESCRIÇÃO : %s ".nl2br($pularlinha)." \n",utf8_encode($row[2]),utf8_encode($row[1]));		
	    					//printf ("%s \n", $row);
	    				}
	    			}
				}

				?>
		</div>
	</div>

	<div class="modal fade " id="myModalCadastro" role="dialog">
		<div class="modal-dialog">		     
		  	<div class="modal-content" align="left">
			    <div class="modal-header">
			    	<h4 class="modal-title">Cadastro de notícia</h4>
			      	<button type="button" class="close" data-dismiss="modal">&times;</button>
			    </div>
			    <form id="cadastro_noticia" action="cadastro_noticia.php" method="POST"> 
			        <div class="modal-body" style="padding-top: 2%">
				        <label for="noticia_tipo">Tipo de Noticia</label>
				        <input type="text" id="noticia_tipo" name="noticia_tipo"></input>
				    </div>
				    <div class="modal-body" style="padding-top: 2%">
				        <label for="noticia_desc">Descrição da Noticia</label>
				        <input type="text" id="noticia_desc" name="noticia_desc"></input>
				    </div>
<!-- 				    <div class="modal-body" style="padding-top: 2%">
				        <label for="imagem">Imagem</label>
				        <input type="file" name="imagem"/>
				    </div> -->
				<div class="modal-footer">
		          	<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
		          	<button type="submit" class="btn btn-default">Criar Notícia</button>
		        </div>
				</form>
		    </div>	
		 </div>
	</div>

		<div class="modal fade " id="myModalEditar" role="dialog">
		<div class="modal-dialog">		     
		  	<div class="modal-content" align="left">
			    <div class="modal-header">
			    	<h4 class="modal-title">Editar notícia</h4>
			      	<button type="button" class="close" data-dismiss="modal">&times;</button>
			    </div>
			    <form id="editar_noticia" action="editar_noticia.php" method="POST"> 
			    	<div class="modal-body" style="padding-top: 2%">
				        <label for="nome_noticia">Notícia</label>
				        <select style="width: 60%" type="text" id="id_noticia" name="id_noticia">
				        	<option value="">Selecione o notícia que deseja editar...</option>
				  			<?php
								$conn = mysqli_connect('mysql', 'root', '123.456','db_projetosAcademicos');
								if (!$conn) {
								    echo "Error: Unable to connect to MySQL." . PHP_EOL;
								    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
								    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
								    exit;
								}
								$query_select = "SELECT id,descricao_noticia FROM Noticia";
								if ($result = $conn->query($query_select)) {
									while ($row = $result->fetch_row()) { 
										//echo $row[0]; 
										?>
										<option value=<?php echo $row[0]?>><?php echo utf8_encode($row[1])?></option>
										<?php
									}
								}
							?>      					        
				       	</select>
				    </div>
			    	<div class="modal-body" style="padding-top: 2%">
				        <label for="noticia_tipo">Tipo de Noticia</label>
				        <input type="text" id="noticia_tipo" name="noticia_tipo"></input>
				    </div>
				    <div class="modal-body" style="padding-top: 2%">
				        <label for="noticia_desc">Descrição da Noticia</label>
				        <input type="text" id="noticia_desc" name="noticia_desc"></input>
				    </div>
<!-- 				    <div class="modal-body" style="padding-top: 2%">
				        <label for="imagem">Imagem</label>
				        <input type="file" name="imagem"/>
				    </div> -->
				<div class="modal-footer">
		          	<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
		          	<button type="submit" class="btn btn-default">Editar Notícia</button>
		        </div>
				</form>
		    </div>	
		 </div>
	</div>

	<div class="modal fade " id="myModalExcluir" role="dialog">
		<div class="modal-dialog">		     
		  	<div class="modal-content" align="left">
			    <div class="modal-header">
			    	<h4 class="modal-title">Excluir notícia</h4>
			      	<button type="button" class="close" data-dismiss="modal">&times;</button>
			    </div>
			    <form id="deletar_noticia" action="deletar_noticia.php" method="POST"> 
			    	<div class="modal-body" style="padding-top: 2%">
				        <label for="nome_laboratorio">Notícia</label>
				        <select style="width: 60%" type="text" id="id_noticia" name="id_noticia">
				        	<option value="">Selecione o notícia que deseja excluir...</option>
				  			<?php
								$conn = mysqli_connect('mysql', 'root', '123.456','db_projetosAcademicos');
								if (!$conn) {
								    echo "Error: Unable to connect to MySQL." . PHP_EOL;
								    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
								    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
								    exit;
								}
								$query_select = "SELECT id,descricao_noticia FROM Noticia";
								if ($result = $conn->query($query_select)) {
									while ($row = $result->fetch_row()) { 
										//echo $row[0]; 
										?>
										<option value=<?php echo $row[0]?>><?php echo utf8_encode($row[1])?></option>
										<?php
									}
								}
							?>      					        
				       	</select>
				    </div>
				<div class="modal-footer">
		          	<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
		          	<button type="submit" class="btn btn-default">Excluir Notícia</button>
		        </div>
				</form>
		    </div>	
		 </div>
	</div>

	<div class="modal fade " id="myModalRelatorioN" role="dialog">
		<div class="modal-dialog">		     
		  	<div class="modal-content" align="left">
			    <div class="modal-header">
			    	<h4 class="modal-title">Relatório</h4>
			      	<button type="button" class="close" data-dismiss="modal">&times;</button>
			    </div>
			    <form id="relatorio_noticias" action="relatorio_noticias.php" method="POST"> 
			    	<div class="modal-body" style="padding-top: 2%">
				        <label for="tipo_noticia">Tipo da noticia</label>
				        <select style="width: 60%" type="text" id="tipo_noticia" name="tipo_noticia">
				        	<option value="">Selecione o tipo da noticia</option>
				        	<option value="todos">TODOS</option>
     					    <option value="EVENTO ACADÊMICO">EVENTO ACADÊMICO</option>
     					    <option value="COMPETIÇÃO">COMPETIÇÃO</option>
     					    <option value="PUBLICAÇÃO">PUBLICAÇÃO</option>    
				       	</select>
				    </div>
			    	<div class="modal-body" style="padding-top: 2%">
				        <label for="status_projeto">Data</label>
				        <select style="width: 60%" type="text" id="data" name="data">
				        	<option value="">Selecione uma data</option>
				        	<option value="todos">TODOS</option>
				  			<?php
								$conn = mysqli_connect('mysql', 'root', '123.456','db_projetosAcademicos');
								if (!$conn) {
								    echo "Error: Unable to connect to MySQL." . PHP_EOL;
								    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
								    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
								    exit;
								}
							?>      					        
				       	</select>
				    </div>
				<div class="modal-footer">
		          	<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
		          	<button type="submit" class="btn btn-default">Pesquisar</button>
		        </div>
				</form>
		    </div>	
		 </div>
	</div>

</body>
</html>
