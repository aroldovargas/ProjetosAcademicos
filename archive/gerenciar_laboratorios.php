<?php 
session_start();

$conn = mysqli_connect('mysql', 'root', '123.456','db_projetosAcademicos');
if (!$conn) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
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
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
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
	        	<li><a href="painel.php">Voltar</a></li>
	        	<li></li>
	        	<li></li>
	        	<li style="margin-right: 75%"></li>
	        	<li></li>
				<li><a href="logout.php">Sair</a></li>
	    	</ul>
	</nav>
	<div class="container">
		<h2 align="center" style="margin-top: 3%;font-family: Fantasy"> Gerenciamento de Laboratórios</h2>
		<table class="table table-hover" style="margin-top:5%;">
		  <thead>
		    <tr style="font-size: 14px">
		      <th scope="col">#</th>
		      <th scope="col">Sigla</th>
		      <th scope="col">Nome</th>
		      <th scope="col">Descrição</th>
		      <th scope="col"></th>
		      <th scope="col"></th>
		    </tr>
		  </thead>
		  <tbody>
		  	<?php 
		  	$query_select = "select * from Laboratorio";
	  		$cont = 0;
			$pularlinha = "\n";
			if ($result = $conn->query($query_select)) {
				while($rows_laboratorios = mysqli_fetch_assoc($result)){
					$cont +=1;
			?>
				    <tr style="font-size: 12px">
				      <th scope="row"><?echo $cont?></th>
				      <td><?echo $rows_laboratorios['sigla']?></td>
				      <td><?echo utf8_encode($rows_laboratorios['nome_lab'])?></td>
				      <td><?echo utf8_encode($rows_laboratorios['descricao_lab'])?></td>
				      <td><button data-toggle="modal" data-target="#myModalEditar<?echo $rows_laboratorios['id']?>"><i class="material-icons">edit</i></button></td>
				      <td><button data-toggle="modal" data-target="#myModalExcluir<?echo $rows_laboratorios['id']?>"><i class="material-icons">delete</i></button></td>
				    </tr>
			    	<div class="modal fade " id="myModalEditar<?echo $rows_laboratorios['id'] ?>" role="dialog">
						<div class="modal-dialog">		     
						  	<div class="modal-content" align="left" >
							    <div class="modal-header">
							    	<h4 class="modal-title" >Editar Projeto</h4>
							      	<button type="button" class="close" data-dismiss="modal">&times;</button>
							    </div>
							    <form id="editar_laboratorios" action="editar_laboratorios_admin.php" method="POST">
							    	<div class="modal-body" style="padding-top: 2%;display: none;">
								        <input style="width: 100%" type="text" id="id_laboratorio" name="id_laboratorio" value="<?echo utf8_encode($rows_laboratorios['id'])?>"></input>
								    </div>
							    	<div class="modal-body" style="padding-top: 2%">
								        <label for="nome_laboratorio">Nome</label>
								        <input style="width: 100%" type="text" id="nome_laboratorio" name="nome_laboratorio" value="<?echo utf8_encode($rows_laboratorios['nome_lab'])?>"></input>
								    </div>
								    <div class="modal-body" style="padding-top: 2%">
								        <label for="descricao_laboratorio">Descrição</label>
								        <input style="width: 100%" type="text"  id="descricao_laboratorio" name="descricao_laboratorio" value="<?echo utf8_encode($rows_laboratorios['descricao_lab'])?>"></input>
								    </div>
								    <div class="modal-body" style="padding-top: 2%">
								        <label for="sigla_laboratorio">Sigla</label>
								        <input style="width: 50%" type="text" id="sigla_laboratorio" name="sigla_laboratorio" value="<?echo utf8_encode($rows_laboratorios['sigla'])?>"></input>
								    </div>
								<div class="modal-footer">
						          	<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
						          	<button type="submit" class="btn btn-default">Editar Projeto</button>
						        </div>
								</form>
						    </div>	
						 </div>
					</div>
					<div class="modal fade " id="myModalExcluir<?echo $rows_laboratorios['id'] ?>" role="dialog">
						<div class="modal-dialog">		     
						  	<div class="modal-content">
							    <form id="deletar_laboratorio" action="deletar_laboratorio_admin.php" method="POST"> 
							     	<div class="modal-body" style="padding-top: 2%;display: none;">
								        <input style="width: 100%" type="text" id="id_laboratorio" name="id_laboratorio" value="<?echo $rows_laboratorios['id']?>"></input>
								    </div>
							    	<div class="modal-body" style="padding-top: 2%">
								        <h4 align="center">Você realmente deseja excluir o Laboratório "<?echo utf8_encode($rows_laboratorios['sigla'])?>" do sistema ?</h4>
								        <i class="material-icons" style="font-size:48px;color:red;margin-left: 45%;">warning</i>
								    </div>
								<div class="modal-footer">
						          	<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
						          	<button type="submit" class="btn btn-default">Excluir Laboratório</button>
						        </div>
								</form>
						    </div>	
						 </div>
					</div>				    

		    <?
				}
			}
			?>
		  </tbody>
		</table>
	</div>