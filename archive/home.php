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
		<div class="row" style="margin-top: 4%">
			<div class="col" align="right">
				<button data-toggle="modal" data-target="#myModalCadastro" id="btnCrud">O IFES</button>
			</div>
		</div>
		<div class="row">
			<div class="col" align="right">
				<button data-toggle="modal" data-target="#myModalEditar" id="btnCrud">Cursos</button>
			</div>
		</div>
		<div class="row">
			<div class="col" align="right">
				<button data-toggle="modal" data-target="#myModalExcluir" id="btnCrud">Campus Serra</button>
			</div>
		</div>
		<div class="row">
			<div class="col" align="right">
				<button data-toggle="modal" data-target="#myModalRelatorioP" id="btnCrud">Processo Seletivo</button>
			</div>
		</div>
		<div class="row">
			<div class="col-9" >
				<h3 style="font-family: Fantasy;margin-top: -5%">Institucional</h3>
				<p style="font-family: cursive;">Desde a criação da Escola de Aprendizes Artífices do Espírito Santo, em 1909, até a transformação em Instituto Federal do Espírito Santo, a instituição é referência em educação na sociedade capixaba.

				Resultado da união das unidades do Centro Federal de Educação Tecnológica e das Escolas Agrotécnicas Federais, em 2008, o Ifes promove educação profissional pública de excelência, integrando ensino, pesquisa e extensão, para a construção de uma sociedade democrática, justa e sustentável.

				O Instituto Federal do Espírito Santo oferece desde cursos técnicos a mestrados e possui aproximadamente 36 mil alunos. São mais de 100 cursos técnicos, 70 cursos de graduação, 25 especializações e 11 mestrados.

				Com 21 campi em funcionamento, o Ifes se faz presente em todas as microrregiões capixabas. O Instituto possui ainda 40 polos de educação a distância no Espírito Santo.</p>
			</div>
		</div>
		<div class="row">
			<div class="col-9" >
				<h3 style="font-family: Fantasy;margin-top: 5%">História</h3>
				<p style="font-family: cursive;">O Ifes é o resultado da união de quatro antigas instituições federais de educação: o Centro Federal de Educação Tecnológica do Espírito Santo (Cefetes), a Escola Agrotécnica Federal de Alegre, a Escola Agrotécnica Federal de Colatina e a Escola Agrotécnica Federal de Santa Teresa. A história dessas instituições é centenária, sendo a mais antiga delas o Cefetes, fundado em 1909, durante o governo de Nilo Peçanha, sob o nome de Escola de Aprendizes Artífices do Espírito Santo.

				Em dezembro de 2008, o então presidente da República, Luiz Inácio Lula da Silva, sancionou a Lei nº 11.892, que criou 38 institutos federais de educação, ciência e tecnologia no país. No Espírito Santo, o Cefetes e as escolas agrotécnicas se integraram em uma estrutura única, o Instituto Federal do Espírito Santo.

				No ano de sua criação, o Ifes já contava com 12 unidades. Os campi Aracruz, Cachoeiro de Itapemirim, Cariacica, Colatina, Linhares, Nova Venécia, São Mateus, Serra e Vitória, que eram unidades do Cefetes, somaram-se aos campi de Alegre, Itapina e Santa Teresa, originalmente as escolas agrotécnicas. Além disso, já fazia parte do Instituto o Cead, atual Cefor (Centro de Referência em Formação e Educação a Distância).

				A partir de então, o Ifes ampliou a sua rede e a sua oferta de educação profissional e tecnológica. No ano de 2010 foram inaugurados os campi Guarapari, Ibatiba, Piúma, Venda Nova do Imigrante e Vila Velha. Em 2014, iniciaram-se os trabalhos nos campi Barra de São Francisco e Montanha. Um ano mais tarde, em 2015, aconteceram as inaugurações dos campi Centro-Serrano e Viana, além do Polo de Inovação Vitória, que atende à demanda de inovação industrial tecnológica por meio de pesquisa aplicada.
				</p>
			</div>
		</div>


</div>

</body>
</html>

</div>

</html>

