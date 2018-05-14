<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'asesores-servicios-form',
	'enableAjaxValidation'=>true,
	'enableClientValidation'=>true,
	'clientOptions'=>array(
            'validateOnSubmit'=>true,
    ),
)); ?>


<div class="row">
	<div class="col-xs-12 col-sm-12 well">
		<div class="col-xs-12 col-sm-12">
			<h3 class='subtitulo'>Información del servicio del asesor</h3>
		</div>

		<div class="col-xs-12 col-sm-6">
			<?php echo $form->dropDownListGroup($model,'aseserv_ase_id',
				array(
					'wrapperHtmlOptions' => array(
						'class' => '',
					),
					'widgetOptions' => array(
						'data' => CHtml::listData(Asesores::model()->findAll(array("condition"=>"ase_habilitado='Si'")), 'ase_id', function($ase) {
							    return CHtml::encode($ase->ase_nombre . " " . $ase->ase_apellidos);
							}),
						'htmlOptions' => array(
							'empty'=>'-- Seleccione un Asesor --',
						),
					),
				)
			); ?>
		</div>

		<div class="col-xs-12 col-sm-6">
			<?php echo $form->dropDownListGroup($model,'aseserv_serv_id',
				array(
					'wrapperHtmlOptions' => array(
						'class' => '',
					),
					'widgetOptions' => array(
						'data' => CHtml::listData(Servicios::model()->findAll(array("condition"=>"serv_habilitado='Si'")), 'serv_id', function($serv) {
							    return CHtml::encode($serv->serv_nombre . " (" . $serv->servProg->prog_nombre." - " . $serv->servProg->progCli->cli_nombre .")");
							}),
						'htmlOptions' => array(
							'empty'=>'-- Seleccione un Servicio --',
						),
					),
				)
			); ?>
		</div>

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
