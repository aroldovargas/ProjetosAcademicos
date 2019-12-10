<?php 
session_start();
$nome = $_SESSION['nome'];
$email = $_SESSION['email'];

$conn = mysqli_connect('mysql', 'root', '123.456','db_projetosAcademicos');
if (!$conn) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

$sql = "SELECT fk_Tipo_Usuario_id FROM Usuario WHERE email ='$email'";
if ($result = $conn->query($sql)) {
	while ($row = $result->fetch_row()) {
		$tipo_usuario = $row[0];
		if ($tipo_usuario == '3'){
			$tipo = "Aluno";
			$query_aluno = "SELECT al.matricula_aluno,al.data_nascimento,cu.nome_curso,cu.nivel,al.id,al.fk_Curso_id FROM Aluno al INNER JOIN Curso cu ON al.fk_Curso_id = cu.id WHERE nome_aluno ='$nome'";
			if ($result_aluno = $conn->query($query_aluno)) {
				while ($row_aluno = $result_aluno->fetch_row()) {
					$matricula_aluno = $row_aluno[0];
					$data_nascimento = $row_aluno[1];
					$nome_curso = utf8_encode($row_aluno[2]);
					$nivel = utf8_encode($row_aluno[3]);
					$id_aluno = $row_aluno[4];
					$id_curso = $row_aluno[5];
				}
			}
		}
	
	}
}
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
<div class="container" >
	<h2 align="center" style="margin-top: 3%;font-family: Fantasy"> Perfil </h2>
	<div class="row">
		<div class="col" align="right">
			<button data-toggle="modal" data-target="#myModalEditar" href="#myModalEditar" id="btnCrud">Editar Perfil</button>
		</div>
	</div>
	<div class="row">
		<div class="col" align="right">
			<button data-toggle="modal" data-target="#myModalExcluir" href="#myModalExcluir" id="btnCrud">Excluir Perfil</button>
		</div>
	</div>
</div>

<div class="container">
	<div class="col">
		<div class="row">
			<div class="col-2">
				<img align="left" src="imagens/gato-rico.jpeg" width=180 height=200 style="border:2px solid black;">
			</div>
			<div  class="col-8" style="margin-bottom: 2%;margin-left:5%;font-family: fantasy;font-size: 100%">
				<?php
					$query_select = "SELECT * FROM Projeto WHERE id= 2 or id =8";
					$pularlinha = "\n";
					if ($result = $conn->query($query_select)) {
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
	       					?>
	       					<div class="card text-center col-10" style="margin-bottom: 4%;margin-top:2%;font-family: fantasy;">
								<div class="card-header" style="font-size: 18px"><?php echo utf8_encode($row[3]);?></div>
								<div class="card-body" align="left">
									<p class="card-text"><?php echo "DESCRIÇÃO: ".utf8_encode($row[1]);?></p>
									<p class="card-text"><?php echo "STATUS: ".utf8_encode($nome_status);?></p>
									<p class="card-text"><?php echo "LABORATÓRIO: ".utf8_encode($sigla);?></p>
									<p class="card-text"><?php echo "DATA INÍCIO: ".utf8_encode($row[0]);?></p>
									<p class="card-text"><?php echo "DATA TÉRMINO: ".utf8_encode($row[4]);?></p>
							  	</div>
								<div class="row" style="margin-top:2%;margin-left: 40%;margin-bottom: 2%;">
									<a href="#" id="btnBusca">VISITAR</a>
								</div>
							</div>
							<?php
	       					// echo nl2br($pularlinha);
	       					// echo nl2br($pularlinha);
	       					// printf (" NOME : %s ".nl2br($pularlinha)." DESCRIÇÃO : %s ".nl2br($pularlinha)."  DATA INÍCIO : %s ".nl2br($pularlinha)." DATA TÉRMINO : %s ".nl2br($pularlinha)." STATUS : %s".nl2br($pularlinha)."LABORATÓRIO : %s \n",utf8_encode($row[3]),utf8_encode($row[1]),utf8_encode($row[0]),utf8_encode($row[4]),utf8_encode($nome_status),utf8_encode($sigla));
	    					//printf ("%s \n", $row);
	    				}
	    			}
		    		
					?>
			</div>
		</div>
		<h3 align="left" style="margin-top: -35%;margin-left:2%;font-family: Fantasy"> <?php echo $nome;?> </h3>
		<div class="row">
			<div class="col" align="left" style="font-family: Fantasy">
				<?php echo "Contato: ".$email;?>
			</div>
		</div>
		<div class="row">
			<div class="col" align="left" style="font-family: Fantasy">
				<?php echo "Cargo: ".$tipo;?>
			</div>
		</div>
		<div class="row">
			<div class="col" align="left" style="font-family: Fantasy">
				<?php echo "Matricula: ".$matricula_aluno;?>
			</div>
		</div>
		<div class="row">
			<div class="col" align="left" style="font-family: Fantasy">
				<?php echo "Data de Nascimento: ".$data_nascimento;?>
			</div>
		</div>
		<div class="row">
			<div class="col" align="left" style="font-family: Fantasy">
				<?php echo "Curso: ".$nome_curso;?>
			</div>
		</div>
		<div class="row" style="margin-bottom: 5%">
			<div class="col" align="left" style="font-family: Fantasy">
				<?php echo "Nível: ".$nivel;?>
			</div>
		</div>
	</div>


	</div>
</div>

<div class="modal fade " id="myModalEditar" role="dialog">
	<div class="modal-dialog">		     
	  	<div class="modal-content" align="left">
		    <div class="modal-header">
		    	<h4 class="modal-title" align="left">Alterar Cadastro</h4>
		      	<button type="button" class="close" data-dismiss="modal">&times;</button>
				
		    </div>
		    <form id="cadastro" action="editar_perfil.php" method="POST"> 
		    	<div class="modal-body" style="padding-top: 2%;display: none;">
			        <input style="width: 50%" type="text" id="id_aluno" name="id_aluno" value="<?php echo $id_aluno;?>"></input>
			    </div>
		    	<div class="modal-body" style="padding-top: 2%">
			        <label for="nome_cadastro">Nome</label>
			        <input style="width: 50%" type="text" id="nome_cadastro" name="nome_cadastro" value="<?php echo $nome;?>"></input>
			    </div>
			    <div class="modal-body" style="padding-top: 2%">
			        <label for="email_cadastro">E-mail</label>
			        <input style="width: 50%" type="email" id="email_cadastro" name="email_cadastro" value="<?php echo $email;?>"></input>
			    </div>
			    <div class="modal-body" style="padding-top: 2%">
			        <label for="matricula_cadastro">Matricula</label>
			        <input type="text" id="matricula_cadastro" name="matricula_cadastro" value="<?php echo $matricula_aluno;?>"></input>
			    </div>
			    <div class="modal-body" style="padding-top: 2%">
			        <label for="data_nascimento_cadastro">Data de Nascimento</label>
			        <input type="date" id="data_nascimento_cadastro" name="data_nascimento_cadastro" value="<?php echo $data_nascimento;?>"></input>
			    </div>
			    <div class="modal-body" style="padding-top: 2%">
			        <label for="senha">Senha</label>
			        <input type="password" minlength="4" id="senha_cadastro" name="senha_cadastro"></input>			      
			    </div>
			   	<div class="modal-body" style="padding-top: 2%" align="left">
			   		<label for="funcao_cadastro">Função</label>
			    	<input type="radio" id="funcao_cadastro" name="funcao_cadastro" value="Professor">Professor
					<input style="margin-left: 2%" type="radio" id="funcao_cadastro" name="funcao_cadastro" value="Aluno">Aluno<br>
				</div>
					<div class="modal-body" id="curso_cadastro" style="padding-top: 2%">
				        <label for="curso_cadastro">Curso</label>
				        <select size="1" name="curso_cadastro" class="form-control" id="curso_cadastro" style="width: 60%">
						    <option value="<?php echo $id_curso?>"><?php echo $nome_curso;?></option>
						    <option value="1">Sistemas de Informação</option>
						    <option value="2">Enegnharia de Controle e Automação</option>
						    <option value="3">Automação Industrial</option>
						    <option value="4">Informática</option>
						    <option value="5">Mecatrônica</option>
						    <option value="6">Computação Aplicada</option>
					    </select>
			    </div>
			<div class="modal-footer">
	          	<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
	          	<button type="submit" class="btn btn-default">Editar Perfil</button>
	        </div>
			</form>
	    </div>	
	 </div>
</div>

<div class="modal fade " id="myModalExcluir" role="dialog">
	<div class="modal-dialog">		     
	  	<div class="modal-content" align="left">
		    <div class="modal-header">
		      	<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Deseja realmente excluir seu cadastro</h4>
		    </div>
		    <form id="cadastro" action="cadastro.php" method="POST"> 
			<div class="modal-footer">
	          	<button type="button" class="btn btn-default" data-dismiss="modal">Não</button>
	          	<button type="submit" class="btn btn-default">Sim</button>
	        </div>
			</form>
	    </div>	
	 </div>
</div>

</html>