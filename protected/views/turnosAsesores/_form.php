<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'turnos-asesores-form',
	'enableAjaxValidation'=>true,
	'enableClientValidation'=>true,
	'clientOptions'=>array(
            'validateOnSubmit'=>true,
    ),
)); ?>


<div class="row">
	<div class="col-xs-12 col-sm-12 well">
		<div class="col-xs-12 col-sm-12">
			<h3 class='subtitulo'>Turno</h3>
		</div>
		<div class="col-xs-12 col-sm-6">
			<?php echo $form->dropDownListGroup($model,'turase_tur_id',
				array(
					'wrapperHtmlOptions' => array(
						'class' => '',
					),
					'widgetOptions' => array(
						'data' => CHtml::listData(Turnos::model()->findAll(array("condition"=>"tur_habilitado='Si'")), 'tur_id', function($tur) {
							    return CHtml::encode($tur->tur_nombre);
							}),
						'htmlOptions' => array(
							'empty'=>'-- Seleccione un Turno --',
						),
					),
				)
			); ?>
		</div>
	</div>

	<div class="col-xs-12 col-sm-12 well">
		<div class="col-xs-12 col-sm-12">
			<h3 class='subtitulo'>Servicios y Asesores</h3>
		</div>

		<!-- LISTAR SERVICIOS ASOCIADOS AL TURNO ORDENADOS ALFABETICAMENTE -->
		<?php foreach ($modelServicios as $kserv => $servicio): ?>
			<div class="panel panel-danger col-xs-12 col-sm-12">
				<div class="panel-heading">
					<h4><?php echo $servicio->serv_nombre . " ( ".$servicio->servProg->prog_nombre ." - ". $servicio->servProg->progCli->cli_nombre . " )"; ?></h4>
				</div>

				<!-- LISTAR ASESORES DEL SERVICIO ORDENADOS ALFABETICAMENTE -->
				<div class="col-xs-12 col-sm-6">
					<div class="panel-body well">
						<?php foreach ($modelAsesorServicio as $kaseserv => $aseserv): ?>
							<?php if ($aseserv->aseserv_serv_id == $servicio->serv_id): ?>
								<?php foreach ($modelAsesores as $kase => $asesor): ?>
									<?php
										if ($asesor->ase_id == $aseserv->aseserv_ase_id):
											$default = false;

											echo CHtml::CheckBox('AsesoresSeleccionados[]',$default,
												array(
													'value'=>$aseserv->aseserv_id,
													)) ." ".$asesor->ase_nombre." ".$asesor->ase_apellidos ."<br>" ;
										endif
									?>
								<?php endforeach ?>
							<?php endif ?>
						<?php endforeach ?>
					</div>
				</div>
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
					'label'=>$model->isNewRecord ? 'Crear' : 'Guardar Cambios',
				)); ?>
		</div>
	</div>
</div>

<?php $this->endWidget(); ?>
