<?php 
	if(count($_POST) > 0){
		$usuario = select('*', 'usuário', 'email', $_POST['email']);
		if($usuario && $usuario['senha'] == md5($_POST['senha'])){
			session_start();
			var_dump($usuario);
			$_SESSION['id_usuario'] = $usuario['id'];
			$_SESSION['email'] = $usuario['email'];
			$_SESSION['privilegio'] = $usuario['id_papel'];
			if($_SESSION['privilegio'] == '2'){
				$_SESSION['id_hospital'] = $usuario['id_hospital'];
				var_dump($_SESSION);
			}
			ob_clean();
			header('LOCATION: /'.BASE);
		}
		else{
			include_once('templates/sistema/home.php');
		}
	}
?>
<script type='text/javascript'>
	window.onload = function(){
		str = '<div class="alert alert-danger alert-dismissible text-center" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><p><strong>Dados incorretos!</strong></p> Tente novamente</div>';
		$('#entrar').click()
		$('#warning_entrar').html(str)
	}
</script>