window.onkeydown = function (e) {
if (e.keyCode === 116) {
alert("Função não permitida");
e.keyCode = 0;
e.returnValue = false;
return false;
}

}


$(function(){
	$('.addtocartform button').on('click', function(e){
		e.preventDefault();
	
	var qt =parseInt($('.addtocart_qt').val());
	var action = $(this).attr('data-action');
	
	if(action == 'decrease'){
		if(qt-1>=1){
			qt = qt -1;
		}
	}else if(action == 'increase'){
		qt= qt +1;
	}

	$('.addtocart_qt').val(qt);
	$('input[name=qt_product]').val(qt);
	});

	
});

function formatar(mascara, documento){
  var i = documento.value.length;
  var saida = mascara.substring(0,1);
  var texto = mascara.substring(i)
  
  if (texto.substring(0,1) != saida){
            documento.value += texto.substring(0,1);
  }
  
}
function Verificar()
 {
  var tecla=window.event.keyCode;
  if (tecla==116) {alert("ERROR!"); event.keyCode=0;
event.returnValue=false;}
 }

$(document).ready(function(){
    $('#telefone').mask('(00) 0000-0000');
});

$("#cpf").mask("000.000.000-00");

