function log_out(){
	swal({
  		title: "",
  		text: "Deseja mesmo sair?",
  		type: "warning",
  		showCancelButton: true,
  		cancelButtonText: "Cancelar",
  		confirmButtonClass: "btn-danger",
  		confirmButtonText: "sair!",
  		closeOnConfirm: false
	},
	function(){
	  window.location = '/smbps/logout.php';
	});
}

function sa(head, body, tipo, loc){
	if(loc == ''){
		swal(head, body, tipo);
	}
	else{
		swal({
			title: head,
			text: body,
			type: tipo,
			closeOnConfirm: false,
			html: false
		}, 
		function(){
			window.location = loc;
		});
	}
}

function upper(textbox) {
    textbox.value = textbox.value.toUpperCase();
}

function lower(textbox){
	textbox.value = textbox.value.toLowerCase();
}