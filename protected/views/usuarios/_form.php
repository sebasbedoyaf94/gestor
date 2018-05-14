<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'usuarios-form',
	'enableAjaxValidation'=>true,
	'enableClientValidation'=>true,
	'clientOptions'=>array(
            'validateOnSubmit'=>true,
    ),
)); ?>


<div class="row">
	<div class="col-xs-12 col-sm-12 well">
		<div class="col-xs-12 col-sm-12">
			<h3 class='subtitulo'>Información del Usuario</h3>
		</div>
		<div class="col-xs-12 col-sm-6">
			<?php echo $form->textFieldGroup($model,'usua_nombre',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'')))); ?>
		</div>

		<div class="col-xs-12 col-sm-6">
			<?php echo $form->textFieldGroup($model,'usua_apellidos',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'')))); ?>
		</div>

		<div class="col-xs-12 col-sm-6">
			<?php echo $form->textFieldGroup($model,'usua_usuariored',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'')))); ?>
		</div>

		<div class="col-xs-12 col-sm-6">
			<?php echo $form->dropDownListGroup($model,'usua_rol_id',
				array(
					'wrapperHtmlOptions' => array(
						'class' => '',
					),
					'widgetOptions' => array(
						'data' => CHtml::listData(Roles::model()->findAll(array("condition"=>"rol_habilitado='Si'")), 'rol_id', 'rol_nombre'),
						'htmlOptions' => array(
							'empty'=>'-- Selecciona un Rol --',
						),
					),
				)
			); ?>
		</div>

		<div class="col-xs-12 col-sm-6">
			<?php echo $form->dropDownListGroup($model,'usua_habilitado', array('widgetOptions'=>array('data'=>array("Si"=>"Si","No"=>"No",), 'htmlOptions'=>array('class'=>'input-large')))); ?>
		</div>
	</div>
	

	<div class="col-xs-12 col-sm-12 well">
		<div class="col-xs-12 col-sm-12">
			<h3 class='subtitulo'>Servicios disponibles para asignar al Usuario</h3>
		</div>

		

		<!-- LISTAR CLIENTES ORDENADOS ALFABETICAMENTE -->
		<?php foreach ($modelClientes as $kcli => $cliente): ?>
			<div class="panel panel-danger col-xs-12 col-sm-12">
				<div class="panel-heading">
					<h3><?php echo $cliente->cli_nombre; ?></h3>
				</div>

				<!-- LISTAR PROGRAMAS DEL CLIENTE ORDENADOS ALFABETICAMENTE -->
				<?php foreach ($modelProgramas as $kprog => $programa): ?>
					<?php if ($programa->prog_cli_id == $cliente->cli_id): ?>
						<div class="col-xs-12 col-sm-6">

							<div class="panel-title">
								<h4><?php echo $programa->prog_nombre; ?></h4>
							</div>

							<div class="panel-body well">
								<!-- LISTAR LOS SERVICIOS DEL PROGRAMA  ORDENADOS ALFABETICAMENTE-->
								<?php foreach ($modelServicios as $kserv => $servicio): ?>
									<?php 
										$dataServicios = array();
										if ($servicio->serv_prog_id == $programa->prog_id): ?>
											<?php 
												//identificar si el servicio esta seleccionado para el usuario
												
												$default = false;
												if (in_array($servicio->serv_id, $usuarioServiciosExistentes)) {
													$default = true;
												}

												echo CHtml::CheckBox('ServiciosSeleccionados[]',$default, array(
		                                        'value'=>$servicio->serv_id,
		                                        ))." ".$servicio->serv_nombre."<br>"; 
		                                    ?>
									<?php endif ?>
								<?php endforeach ?>
							</div>
						</div>

					<?php endif ?>
				<?php endforeach ?>
			</div>
		<?php endforeach ?>

	</div>

	<div class="col-xs-12">
		<p class="help-block">Los campos con <span class="required">*</span> son obligatorios.</p>
		<?php echo $form->errorSummary($model); ?>
	</div>

	<div class="col-xs-12 text-center">
		<div class="form-actions">
			<?php $this->widget('booster.widgets.TbButton', array(
					'buttonType'=>'submit',
					'context'=>'primary',
					'label'=>$model->isNewRecord ? 'Crear Usuario' : 'Guardar Cambios',
				)); ?>
		</div>
	</div>
</div>

<?php $this->endWidget(); ?>