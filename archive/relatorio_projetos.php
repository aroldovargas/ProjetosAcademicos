<?php
session_start();

$id_laboratorio = $_POST["id_laboratorio"];
$id_status = $_POST["id_status"];

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

if($id_laboratorio == "" || $id_laboratorio == null || $id_status == "" || $id_status == null){
    echo"<script language='javascript' type='text/javascript'>
    alert('Favor preencher todos os campos');</script>";
    echo"<script language= 'JavaScript'>location.href='/archive/projetos.php'</script>";
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
				<button data-toggle="modal" data-target="#myModalCadastro" href="#myModalCadastro" id="btnCrud">Cadastrar projeto</button>
			</div>
		</div>
		<div class="row">
			<div class="col" align="right">
				<button data-toggle="modal" data-target="#myModalEditar" href="#myModalEditar" id="btnCrud">Editar projeto</button>
			</div>
		</div>
		<div class="row">
			<div class="col" align="right">
				<button data-toggle="modal" data-target="#myModalExcluir" href="#myModalExcluir" id="btnCrud">Excluir projeto</button>
			</div>
		</div>
		<div class="row">
			<div class="col" align="right">
				<button data-toggle="modal" data-target="#myModalRelatorioP" href="#myModalRelatorioP" id="btnCrud">Emitir Relatório</button>
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
				if($id_laboratorio == "todos"){
					if($id_status == "todos"){
						$query_select = "SELECT * FROM Projeto";
						$pularlinha = "\n";
						if($result = $conn->query($query_select)){
							while ($row = $result->fetch_row()){
								$id_projeto = $row[2];
								//encontrando id laboratorio
								$query_select_idL = "SELECT fk_Laboratorio_id FROM desenvolvido WHERE fk_Projeto_id = '$id_projeto'";
								$select_idL = mysqli_query($conn,$query_select_idL);
								$array_idL = mysqli_fetch_array($select_idL);
		       					$id_laboratorio = $array_idL['fk_Laboratorio_id'];
								//encontrando sigla do laboratorio
		       					$query_select_sigla = "SELECT sigla FROM Laboratorio WHERE id = '$id_laboratorio'";
								$select_sigla = mysqli_query($conn,$query_select_sigla);
								$array_sigla = mysqli_fetch_array($select_sigla);
		       					$sigla = $array_sigla['sigla'];

								$id_status = $row[5];
								$query_idStatus = "SELECT nome FROM Status WHERE id = '$id_status'";
								$select = mysqli_query($conn,$query_idStatus);
								$array = mysqli_fetch_array($select);
		       					$nome_status = $array['nome'];
		       					echo nl2br($pularlinha);
		       					echo nl2br($pularlinha);
		       					printf (" NOME : %s ".nl2br($pularlinha)." DESCRIÇÃO : %s ".nl2br($pularlinha)."  DATA INÍCIO : %s ".nl2br($pularlinha)." DATA TÉRMINO : %s ".nl2br($pularlinha)." STATUS : %s".nl2br($pularlinha)."LABORATÓRIO : %s \n",utf8_encode($row[3]),utf8_encode($row[1]),utf8_encode($row[0]),utf8_encode($row[4]),utf8_encode($nome_status),utf8_encode($sigla));		
		    					//printf ("%s \n", $row);
		    				}
		    			}
					}else{
						$query_select = "SELECT * FROM Projeto WHERE fk_Status_id = '$id_status'";
						$pularlinha = "\n";
						if($result = $conn->query($query_select)){
							while ($row = $result->fetch_row()){
								$id_projeto = $row[2];
								//encontrando id laboratorio
								$query_select_idL = "SELECT fk_Laboratorio_id FROM desenvolvido WHERE fk_Projeto_id = '$id_projeto'";
								$select_idL = mysqli_query($conn,$query_select_idL);
								$array_idL = mysqli_fetch_array($select_idL);
		       					$id_laboratorio = $array_idL['fk_Laboratorio_id'];
								//encontrando sigla do laboratorio
		       					$query_select_sigla = "SELECT sigla FROM Laboratorio WHERE id = '$id_laboratorio'";
								$select_sigla = mysqli_query($conn,$query_select_sigla);
								$array_sigla = mysqli_fetch_array($select_sigla);
		       					$sigla = $array_sigla['sigla'];

								$id_status = $row[5];
								$query_idStatus = "SELECT nome FROM Status WHERE id = '$id_status'";
								$select = mysqli_query($conn,$query_idStatus);
								$array = mysqli_fetch_array($select);
		       					$nome_status = $array['nome'];
		       					echo nl2br($pularlinha);
		       					echo nl2br($pularlinha);
		       					printf (" NOME : %s ".nl2br($pularlinha)." DESCRIÇÃO : %s ".nl2br($pularlinha)."  DATA INÍCIO : %s ".nl2br($pularlinha)." DATA TÉRMINO : %s ".nl2br($pularlinha)." STATUS : %s".nl2br($pularlinha)."LABORATÓRIO : %s \n",utf8_encode($row[3]),utf8_encode($row[1]),utf8_encode($row[0]),utf8_encode($row[4]),utf8_encode($nome_status),utf8_encode($sigla));		
		    					//printf ("%s \n", $row);
		    				}
		    			}
					}
				}else{
					if($id_status == "todos"){
						$query_select = "SELECT fk_Projeto_id FROM desenvolvido WHERE fk_Laboratorio_id = '$id_laboratorio'";
						// $result = mysqli_query($conn,$query_select);
						// $array_id = mysqli_fetch_array($result);
						if ($result = $conn->query($query_select)) {
							while ($row = $result->fetch_row()) {
								$id_P = $row[0];
								$query_select = "SELECT * FROM Projeto WHERE id = '$id_P'";
								$pularlinha = "\n";
								if($result2 = $conn->query($query_select)){
									while ($row2 = $result2->fetch_row()){
										$id_projeto = $row2[2];
										//encontrando id laboratorio
										$query_select_idL = "SELECT fk_Laboratorio_id FROM desenvolvido WHERE fk_Projeto_id = '$id_projeto'";
										$select_idL = mysqli_query($conn,$query_select_idL);
										$array_idL = mysqli_fetch_array($select_idL);
				       					$id_laboratorio = $array_idL['fk_Laboratorio_id'];
										//encontrando sigla do laboratorio
				       					$query_select_sigla = "SELECT sigla FROM Laboratorio WHERE id = '$id_laboratorio'";
										$select_sigla = mysqli_query($conn,$query_select_sigla);
										$array_sigla = mysqli_fetch_array($select_sigla);
				       					$sigla = $array_sigla['sigla'];

										$id_status = $row2[5];
										$query_idStatus = "SELECT nome FROM Status WHERE id = '$id_status'";
										$select = mysqli_query($conn,$query_idStatus);
										$array = mysqli_fetch_array($select);
				       					$nome_status = $array['nome'];
				       					echo nl2br($pularlinha);
				       					echo nl2br($pularlinha);
				       					printf (" NOME : %s ".nl2br($pularlinha)." DESCRIÇÃO : %s ".nl2br($pularlinha)."  DATA INÍCIO : %s ".nl2br($pularlinha)." DATA TÉRMINO : %s ".nl2br($pularlinha)." STATUS : %s".nl2br($pularlinha)."LABORATÓRIO : %s \n",utf8_encode($row2[3]),utf8_encode($row2[1]),utf8_encode($row2[0]),utf8_encode($row2[4]),utf8_encode($nome_status),utf8_encode($sigla));		
				    					//printf ("%s \n", $row);
				    				}
				    			}

							}
						}
						// echo "teste";
						// echo $array_id['fk_Projeto_id'];
					}else{
						$query_select = "SELECT fk_Projeto_id FROM desenvolvido WHERE fk_Laboratorio_id = '$id_laboratorio'";
						// $result = mysqli_query($conn,$query_select);
						// $array_id = mysqli_fetch_array($result);
						if ($result = $conn->query($query_select)) {
							while ($row = $result->fetch_row()) {
								$id_P = $row[0];
								$query_select = "SELECT * FROM Projeto WHERE id = '$id_P' AND fk_Status_id = '$id_status'";
								$pularlinha = "\n";
								if($result2 = $conn->query($query_select)){
									while ($row2 = $result2->fetch_row()){
										$id_projeto = $row2[2];
										//encontrando id laboratorio
										$query_select_idL = "SELECT fk_Laboratorio_id FROM desenvolvido WHERE fk_Projeto_id = '$id_projeto'";
										$select_idL = mysqli_query($conn,$query_select_idL);
										$array_idL = mysqli_fetch_array($select_idL);
				       					$id_laboratorio = $array_idL['fk_Laboratorio_id'];
										//encontrando sigla do laboratorio
				       					$query_select_sigla = "SELECT sigla FROM Laboratorio WHERE id = '$id_laboratorio'";
										$select_sigla = mysqli_query($conn,$query_select_sigla);
										$array_sigla = mysqli_fetch_array($select_sigla);
				       					$sigla = $array_sigla['sigla'];

										$id_status = $row2[5];
										$query_idStatus = "SELECT nome FROM Status WHERE id = '$id_status'";
										$select = mysqli_query($conn,$query_idStatus);
										$array = mysqli_fetch_array($select);
				       					$nome_status = $array['nome'];
				       					echo nl2br($pularlinha);
				       					echo nl2br($pularlinha);
				       					printf (" NOME : %s ".nl2br($pularlinha)." DESCRIÇÃO : %s ".nl2br($pularlinha)."  DATA INÍCIO : %s ".nl2br($pularlinha)." DATA TÉRMINO : %s ".nl2br($pularlinha)." STATUS : %s".nl2br($pularlinha)."LABORATÓRIO : %s \n",utf8_encode($row2[3]),utf8_encode($row2[1]),utf8_encode($row2[0]),utf8_encode($row2[4]),utf8_encode($nome_status),utf8_encode($sigla));
				    				}
				    			}
				    		}
				
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

				    <div class="modal-body" style="padding-top: 2%">
				        <label for="sigla_laboratorio">Laboratório</label>
				        <select style="width: 60%" type="text" id="id_laboratorio" name="id_laboratorio">
				        	<option value="">Selecione o Laboratório</option>
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
		          	<button type="submit" class="btn btn-default">Criar projeto</button>
		        </div>
				</form>
		    </div>	
		 </div>
	</div>

	<div class="modal fade " id="myModalEditar" role="dialog">
		<div class="modal-dialog">		     
		  	<div class="modal-content" align="left">
			    <div class="modal-header">
			    	<h4 class="modal-title" >Editar Projeto</h4>
			      	<button type="button" class="close" data-dismiss="modal">&times;</button>
			    </div>
			    <form id="editar_projeto" action="editar_projeto.php" method="POST">
			   		<div class="modal-body" style="padding-top: 2%">
				        <label for="nome_projeto">Projeto</label>
				        <select style="width: 60%" type="text" id="id_projeto" name="id_projeto">
				        	<option value="">Selecione o projeto que deseja editar...</option>
				  			<?php
								$conn = mysqli_connect('mysql', 'root', '123.456','db_projetosAcademicos');
								if (!$conn) {
								    echo "Error: Unable to connect to MySQL." . PHP_EOL;
								    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
								    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
								    exit;
								}
								$query_select = "SELECT id,nome_projeto FROM Projeto";
								if ($result = $conn->query($query_select)) {
									while ($row = $result->fetch_row()) { 
										?>
										<option value=<?php echo $row[0]?>><?php echo utf8_encode($row[1])?></option>
										<?php
									}
								}
							?>      					        
				       	</select>
				    </div> 
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
					<!--  <div class="modal-body" style="padding-top: 2%">
				        <label for="imagem">Imagem</label>
				        <input type="file" name="imagem"/>
				    </div> -->
				<div class="modal-footer">
		          	<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
		          	<button type="submit" class="btn btn-default">Editar Projeto</button>
		        </div>
				</form>
		    </div>	
		 </div>
	</div>

	<div class="modal fade " id="myModalExcluir" role="dialog">
		<div class="modal-dialog">		     
		  	<div class="modal-content" align="left">
			    <div class="modal-header">
			    	<h4 class="modal-title" >Excluir Projeto</h4>
			      	<button type="button" class="close" data-dismiss="modal">&times;</button>
			    </div>
			    <form id="deletar_projeto" action="deletar_projeto.php" method="POST"> 
			    	<div class="modal-body" style="padding-top: 2%">
				        <label for="nome_projeto">Projeto</label>
				        <select style="width: 60%" type="text" id="id_projeto" name="id_projeto">
				        	<option value="">Selecione o projeto que deseja excluir...</option>
				  			<?php
								$conn = mysqli_connect('mysql', 'root', '123.456','db_projetosAcademicos');
								if (!$conn) {
								    echo "Error: Unable to connect to MySQL." . PHP_EOL;
								    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
								    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
								    exit;
								}
								$query_select = "SELECT id,nome_projeto FROM Projeto";
								if ($result = $conn->query($query_select)) {
									while ($row = $result->fetch_row()) { 
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
		          	<button type="submit" class="btn btn-default">Excluir Projeto</button>
		        </div>
				</form>
		    </div>	
		 </div>
	</div>

	<div class="modal fade " id="myModalRelatorioP" role="dialog">
		<div class="modal-dialog">		     
		  	<div class="modal-content" align="left">
			    <div class="modal-header">
			    	<h4 class="modal-title">Relatório</h4>
			      	<button type="button" class="close" data-dismiss="modal">&times;</button>
			    </div>
			    <form id="relatorio_projetos" action="relatorio_projetos.php" method="POST"> 
			    	<div class="modal-body" style="padding-top: 2%">
				        <label for="nome_laboratorio">Laboratório</label>
				        <select style="width: 60%" type="text" id="id_laboratorio" name="id_laboratorio">
				        	<option value="">Selecione o Laboratório</option>
				        	<option value="todos">TODOS</option>
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
										?>
										<option value=<?php echo $row[0]?>><?php echo utf8_encode($row[1])?></option>
										<?php
									}
								}
							?>      					        
				       	</select>
				    </div>
			    	<div class="modal-body" style="padding-top: 2%">
				        <label for="status_projeto">Status</label>
				        <select style="width: 60%" type="text" id="id_status" name="id_status">
				        	<option value="">Selecione o status do projeto</option>
				        	<option value="todos">TODOS</option>
				  			<?php
								$conn = mysqli_connect('mysql', 'root', '123.456','db_projetosAcademicos');
								if (!$conn) {
								    echo "Error: Unable to connect to MySQL." . PHP_EOL;
								    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
								    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
								    exit;
								}
								$query_select = "SELECT id,nome FROM Status";
								if ($result = $conn->query($query_select)) {
									while ($row = $result->fetch_row()) { 
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
		          	<button type="submit" class="btn btn-default">Pesquisar</button>
		        </div>
				</form>
		    </div>	
		 </div>
	</div>

</body>
</html>
