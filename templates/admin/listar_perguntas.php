<?php 
    $perguntas = select_many('*', 'pergunta');
    $indicadores = select_many('*', 'indicador');
?>
<div class='text-center'>
	<h2>Perguntas</h2>
	<hr />
</div>
<div class="table-responsive container">
<table class="table table-striped table-bordered table-hover table-condensed">
	<thead>
		<tr>
			<th class='col-lg-1 col-md-1 col-sm-1 col-xs-1'>Id</th>
			<th class='col-lg-2 col-md-2 col-sm-2 col-xs-2'>Indicador</th>
			<th>Texto</th>
			<th>Obrigatória</th>
			<th>Observação</th>
			<th class='col-lg-1 col-md-1 col-sm-1 col-xs-1'></th>
		</tr>
	</thead>
	<tbody>
	<?php 
	    foreach ($perguntas as $key => $value):
	?>
		<tr>
			<td class='col-lg-1 col-md-1 col-sm-1'>
				<?php echo $perguntas[$key]['id']; ?>
			</td>
			<td class='col-lg-2 col-md-2 col-sm-2'>
				<?php 
					echo select('nome', 'indicador', 'id', $perguntas[$key]['id_indicador'])['nome'];
				?>
			</td>
			<td>
				<?php echo $perguntas[$key]['texto']; ?>
			</td>
			<td class='col-lg-1 col-md-1 col-sm-1'>
				<?php
					if($perguntas[$key]['obrigatória'] == '1'){
						echo 'Sim';
					}
					else{
						echo 'Não';
					}
				?>
			</td>
			<td>
				<?php echo $perguntas[$key]['observação']; ?>
			</td>
			<td class='col-lg-1 col-md-1 col-sm-1'>
				<a class='btn btn-primary' data-toggle="modal"  data-target="#myModal<?php echo $perguntas[$key]['id']; ?>">
					Alterar
				</a>
				<!-- Modal -->
				<div id="myModal<?php echo $perguntas[$key]['id']; ?>" class="modal fade" role="dialog">
			  		<div class="modal-dialog modal-sm">
					    <!-- Modal content-->
					    <div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Alterar Pergunta</h4>
							</div>
							<div class="modal-body">
								<form method='post'>
									<input type='number' name='id' value="<?php echo $perguntas[$key]['id']; ?>" hidden required />
									<div class='form-group'>
                        				<label for='id_indicador'>Indicador</label>
										<select class='form-control selectpicker' data-style='btn-info' data-live-search='true' name='id_indicador' required>
											<?php 
											    foreach ($indicadores as $key2 => $value):
											?>
											<option value='<?php echo $indicadores[$key2]['id']; ?>' <?php if($perguntas[$key]['id_indicador'] == $indicadores[$key2]['id']){echo 'selected';} ?>>
												<?php echo $indicadores[$key2]['nome']?>
											</option>
											<?php
											    endforeach;
											?>
										</select>
									</div>
									<div class='form-group'>
                        				<label for='texto'>Texto</label>
										<textarea class='form-control' name='texto' required><?php echo $perguntas[$key]['texto']; ?></textarea>
									</div>
									<div class='form-group'>
                        				<label for='obrigatória'>Obrigatória?</label>
										<select class='form-control selectpicker' name='obrigatória' data-style='btn-info' required>
											<option value='1' <?php if($perguntas[$key]['obrigatória'] == '1'){echo 'selected';} ?> >
												Sim
											</option>
											<option value='0' <?php if($perguntas[$key]['obrigatória'] == '0'){echo 'selected';} ?> >
												Não
											</option>
										</select>
									</div>
									<div class='form-group'>
                        				<label for='observação'>Observação</label>
										<textarea class='form-control' name='observação'><?php echo $perguntas[$key]['observação']; ?></textarea>
									</div>
									<input type='submit' value='Alterar' class='btn btn-primary' />
								</form>
							</div>
					    </div>
				  </div>
				</div>
			</td>
		</tr>
	<?php
	    endforeach;
	?>
	</tbody>
</table>
</div>
<?php 
    if(count($_POST) > 0){
    	var_dump($_POST);
    	foreach ($_POST as $key => $value){
    		if($key != 'id'){
    			$dados[$key] = $value;
    		}
    	}
    	update($dados, 'pergunta', 'id', $_POST['id']);
    	ob_clean();
    	header('LOCATION: '.ADMIN.'listar_perguntas');
    }
?>