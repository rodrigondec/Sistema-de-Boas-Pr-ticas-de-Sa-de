<div class='text-center'>
	<h2>Cadastrar Hospital</h2>
	<hr />
</div>
<?php 
    if(count($_POST) > 0){
    	var_dump($_POST);
    	foreach ($_POST as $key => $value) {
    		$_POST[$key] = retirar_mascara($key, $value);
    	}
    	insert($_POST, 'hospital');
    	//ob_clean();
    	//header('LOCATION: '.ADMIN.'listar_hospitais');
    }



	$estados = select_many('id, nome, uf', 'estado');
	foreach ($estados as $key => $estado) {
		$estados[$key]['cidades'] = select_many('id, nome', 'cidade', 'id_estado', $estado['id']);
	}
	echo '<script type="text/javascript">var num_estados = '.count($estados).';</script>';
?>
<div class='container col-md-5 col-lg-5 col-sm-5 col-xs-6 center'>
	<form method='post'>
		<div class='form-group'>
			<label for='nome'>Nome</label>
			<input class='form-control' type='text' name='nome' placeholder='Nome' required />
		</div>
		<div class='form-group'>
			<label for='select_estado'>Estado</label>
			<div onclick='show_hide_cidade($("#select_estado").selectpicker("val"))'>
			<select name='estado' id='select_estado' class='form-control selectpicker' data-style="btn-info" data-live-search='true' required>
				<option disabled selected value=''>Selecione um estado</option>
				<?php 
				    foreach ($estados as $key => $estado):
				?>
				<option value='<?php echo $estado['id']; ?>'>
					<?php echo $estado['nome']?>
				</option>
				<?php
				    endforeach;
				?>
			</select>
			</div>
		</div>
		<?php
		    foreach ($estados as $key => $estado):
		?>
		<div id='div_select_cidade<?php echo $estado['id']; ?>' class='form-group hidden'>
			<label for='id_cidade'>Cidade (<?php echo $estado['nome'] ?>)</label>
			<select id='select_cidade<?php echo $estado['id']; ?>' class='form-control selectpicker' data-style="btn-info" data-live-search='true' name='id_cidade'>
				<option value='' disabled selected>Selecione uma cidade</option>
				<?php 
					foreach ($estado['cidades'] as $key2 => $cidade):
				?>
				<option value='<?php echo $cidade['id']; ?>'>
					<?php echo $cidade['nome']; ?>
				</option>
				<?php endforeach; ?>
			</select>
		</div>
		<?php 
		    endforeach;
		?>
		<div class='form-group'>
			<label for='cnpj'>CNPJ</label>
			<input class='form-control' type='text' name='cnpj' data-mask='00.000.000/0000-00' placeholder='CNPJ' required />
		</div>
		<div class='form-group'>
			<label for='telefone'>Telefone</label>
			<input class='form-control' type='text' name='telefone' data-mask='(00) 0000-0000' placeholder='Telefone' required />
		</div>
		<div class='form-group'>
			<label for='endereço'>Endereço</label>
			<input class='form-control' type='text' name='endereço' placeholder='Endereço' required />
		</div>
		<div class='form-group'>
			<label for='cep'>CEP</label>
			<input class='form-control' type='text' name='cep' data-mask='00.000-000' placeholder='CEP' required />
		</div>
		<input type='reset' value='Apagar' class='btn btn-warning' />
		<input type='submit' value='Cadastrar' class='btn btn-primary' />
	</form>
</div>
<script type="text/javascript">
	function show_hide_cidade(valor){
		console.log(valor);
		for (id = 1; id <= num_estados; id++){
			if(id == valor){
				// HIDE TODOS OS SELECTS
				for (j = 1; j <= num_estados; j++) {
					$("#div_select_cidade"+j).attr('class', 'form-group hidden')
					$("#select_cidade"+j).attr('required', false)
				}
				// SHOW SELECIONADO
				$("#div_select_cidade"+id).attr('class', 'form-group')
				$("#select_cidade"+id).attr('required', true)
			}
			else{

			}
		}
	}
</script>