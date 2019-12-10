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
		<h2 align="center" style="margin-top: 3%;font-family: Fantasy"> Gerenciamento de Projetos</h2>
		<table class="table table-hover" style="margin-top:5%;">
		  <thead>
		    <tr style="font-size: 14px">
		      <th scope="col">#</th>
		      <th scope="col">Nome</th>
		      <th scope="col">Descrição</th>
		      <th scope="col">Data Inicio</th>
		      <th scope="col">Data Fim</th>
		      <th scope="col">Status</th>
		      <th scope="col">Laboratório</th>
		      <th scope="col"></th>
		      <th scope="col"></th>
		    </tr>
		  </thead>
		  <tbody>
		  	<?php 
		  	$query_select = "select pr.id,pr.nome_projeto,pr.descricao_projeto,pr.data_inicio,pr.data_fim,st.nome,la.sigla,de.fk_Laboratorio_id,de.fk_Projeto_id,pr.fk_Status_id from Projeto pr inner join Status st on pr.fk_Status_id = st.id inner join desenvolvido de on pr.id = de.fk_Projeto_id inner join Laboratorio la on la.id = de.fk_Laboratorio_id";
	  		$cont = 0;
			if ($result = $conn->query($query_select)) {
				#while ($row = $result->fetch_row()) {
				while($rows_projetos = mysqli_fetch_assoc($result))
				{
					$cont +=1;	

			?>
				    <tr style="font-size: 10px">
				      <th scope="row"><?echo $cont?></th>
				      <td><?echo utf8_encode($rows_projetos['nome_projeto'])?></td>
				      <td><?echo utf8_encode($rows_projetos['descricao_projeto'])?></td>
				      <td><?echo $rows_projetos['data_inicio']?></td>
				      <td><?echo $rows_projetos['data_fim']?></td>
				      <td><?echo utf8_encode($rows_projetos['nome'])?></td>
				      <td><?echo utf8_encode($rows_projetos['sigla'])?></td>
				      <td><button data-toggle="modal" data-target="#myModalEditar<?echo $rows_projetos['id']?>"><i class="material-icons">edit</i></button></td>
				      <td><button data-toggle="modal" data-target="#myModalExcluir<?echo $rows_projetos['id']?>"><i class="material-icons">delete</i></button></td>
				    </tr>
			    	<div class="modal fade " id="myModalEditar<?echo $rows_projetos['id'] ?>" role="dialog">
						<div class="modal-dialog">		     
						  	<div class="modal-content" align="left">
							    <div class="modal-header">
							    	<h4 class="modal-title" >Editar Projeto</h4>
							      	<button type="button" class="close" data-dismiss="modal">&times;</button>
							    </div>
							    <form id="editar_projeto_amin" action="editar_projeto_admin.php" method="POST">
							    	<div class="modal-body" style="padding-top: 2%;display: none;">
								        <input style="width: 100%" type="text" id="id_projeto" name="id_projeto" value="<?echo utf8_encode($rows_projetos['id'])?>"></input>
								    </div>
							    	<div class="modal-body" style="padding-top: 2%">
								        <label for="nome_projeto">Nome</label>
								        <input style="width: 50%" type="text" id="nome_projeto" name="nome_projeto" value="<?echo utf8_encode($rows_projetos['nome_projeto'])?>"></input>
								    </div>
								    <div class="modal-body" style="padding-top: 2%">
								        <label for="descricao_projeto">Descrição</label>
								        <input style="width: 80%" type="text" id="descricao_projeto" name="descricao_projeto" value="<?echo utf8_encode($rows_projetos['descricao_projeto'])?>"></input>
								    </div>
								    <div class="modal-body" style="padding-top: 2%">
								        <label for="data_inicio">Data Inicio</label>
								        <input style="width: 30%" type="date" id="data_inicio" name="data_inicio" value="<?echo utf8_encode($rows_projetos['data_inicio'])?>"></input>
								    </div>
								    <div class="modal-body" style="padding-top: 2%">
								        <label for="data_fim">Data fim</label>
								        <input style="width: 30%" id="data_fim" type="date" name="data_fim" value="<?echo utf8_encode($rows_projetos['data_fim'])?>"></input>
								    </div>
								   	<div class="modal-body" style="padding-top: 2%">
								        <label for="sigla_laboratorio">Laboratório</label>
								        <select style="width: 60%" type="text" id="id_laboratorio" name="id_laboratorio">
								        	<option value="<?echo utf8_encode($rows_projetos['fk_Laboratorio_id'])?>"><?echo utf8_encode($rows_projetos['sigla'])?></option>
								        	<?php
								        		$sigla_lab = utf8_encode($rows_projetos['sigla']);
												$query_select_lab = "SELECT id,sigla FROM Laboratorio WHERE sigla != '$sigla_lab'";
												if ($result_lab = $conn->query($query_select_lab)) {
													while ($row_lab = $result_lab->fetch_row()) { 
														?>
														<option value=<?php echo $row_lab[0]?>><?php echo utf8_encode($row_lab[1])?></option>
														<?php
													}
												}
											?>      					        
								       	</select>
								    </div>
								    <div class="modal-body" style="padding-top: 2%">
								        <label for="status_projeto">Status</label>
								        <select style="width: 60%" type="text" id="id_status" name="id_status">
								        	<option value="<?echo utf8_encode($rows_projetos['fk_Status_id'])?>"><?echo utf8_encode($rows_projetos['nome'])?></option>
								        	<?php
								        		$nome_status = utf8_encode($rows_projetos['nome']);
												$query_select_st = "SELECT id,nome FROM Status WHERE nome != '$nome_status'";
												if ($result_st = $conn->query($query_select_st)) {
													while ($row_st = $result_st->fetch_row()) { 
														?>
														<option value=<?php echo $row_st[0]?>><?php echo utf8_encode($row_st[1])?></option>
														<?php
													}
												}
											?>      					        
								       	</select>
								    </div>

								   <!--  <div class="modal-body" style="padding-top: 2%">
								        <label for="status_projeto">Status</label>
								        <input style="width: 30%" id="status_projeto" type="text" name="status_projeto" value="<?echo utf8_encode($rows_projetos['nome'])?>"></input>
								    </div> -->
								<div class="modal-footer">
						          	<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
						          	<button type="submit" class="btn btn-default">Editar Projeto</button>
						        </div>
								</form>
						    </div>	
						 </div>
					</div>

					<div class="modal fade " id="myModalExcluir<?echo $rows_projetos['id'] ?>" role="dialog">
						<div class="modal-dialog">		     
						  	<div class="modal-content">
							    <form id="deletar_projeto_admin" action="deletar_projeto_admin.php" method="POST"> 
							     	<div class="modal-body" style="padding-top: 2%;display: none;">
								        <input style="width: 100%" type="text" id="id_projeto" name="id_projeto" value="<?echo $rows_projetos['id']?>"></input>
								    </div>
							    	<div class="modal-body" style="padding-top: 2%">
								        <h4 align="center">Você realmente deseja excluir o projeto "<?echo utf8_encode($rows_projetos['nome_projeto'])?>" do sistema ?</h4>
								        <i class="material-icons" style="font-size:48px;color:red;margin-left: 45%;">warning</i>
								    </div>
								<div class="modal-footer">
						          	<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
						          	<button type="submit" class="btn btn-default">Excluir Projeto</button>
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


