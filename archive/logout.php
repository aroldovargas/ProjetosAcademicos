<?php
	session_start(); // Pega a sessão que já foi iniciada
	session_destroy(); // Cancela/Exclui a sessão iniciada
	header('location: login.html'); 
	
?>