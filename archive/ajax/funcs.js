// Variável que receberá o objeto XMLHttpRequest
var req;
 
function validarDados(campo, valor) {
 
// Verificar o Browser
// Firefox, Google Chrome, Safari e outros
if(window.XMLHttpRequest) {
   req = new XMLHttpRequest();
}
// Internet Explorer
else if(window.ActiveXObject) {
   req = new ActiveXObject("Microsoft.XMLHTTP");
}
 
// Aqui vai o valor e o nome do campo que pediu a requisição.
var url = "ajax/validacao.php?campo="+campo+"&valor="+valor;
 
// Chamada do método open para processar a requisição
req.open("Get", url, true);
 
// Quando o objeto recebe o retorno, chamamos a seguinte função;
req.onreadystatechange = function() {
 
	// Exibe a mensagem "Verificando" enquanto carrega
	if(req.readyState == 1) {
		document.getElementById('campo_' + campo + '').innerHTML = '<font color="gray">Verificando...</font>';
	}
 
	// Verifica se o Ajax realizou todas as operações corretamente (essencial)
	if(req.readyState == 4 && req.status == 200) {
	// Resposta retornada pelo validacao.php
	var resposta = req.responseText;
 
	// Abaixo colocamos a resposta na div do campo que fez a requisição
	document.getElementById('campo_'+ campo +'').innerHTML = resposta;
	}
 
}
 
req.send(null);
 
}

function validaForm(frm) {
    //Verifica se o campo nome foi preenchido e
    //contém no mínimo três caracteres.
    if(frm.nome.value == """ || frm.nome.value == null || frm.nome.value.lenght < 3){
        //É mostrado um alerta, caso o campo esteja vazio.
        alert("Por favor, indique o seu nome.");
        //Foi definido um focus no campo.
        frm.nome.focus();
        //o form não é enviado.
        return false;
    }
    //o campo e-mail precisa de conter: "@", "." e não pode estar vazio
    if(frm.email.value.indexOf("@") == -1 ||
      frm.email.valueOf.indexOf(".") == -1 ||
      frm.email.value == "" ||
      frm.email.value == null) {
        alert("Por favor, indique um e-mail válido.");
        frm.email.focus();
        return false;
    }
}
