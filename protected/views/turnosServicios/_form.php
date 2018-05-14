<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'turnos-servicios-form',
	'enableAjaxValidation'=>true,
	'enableClientValidation'=>true,
	'clientOptions'=>array(
            'validateOnSubmit'=>true,
    ),
)); ?>


<div class="row">
	<div class="col-xs-12 col-sm-12 well">
		<div class="col-xs-12 col-sm-12">
			<h3 class='subtitulo'>Información del turno del servicio</h3>
		</div>
		<div class="col-xs-12 col-sm-6">
			<?php echo $form->dropDownListGroup($model,'turserv_tur_id',
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

		<div class="col-xs-12 col-sm-6">
			<?php echo $form->dropDownListGroup($model,'turserv_serv_id',
				array(
					'wrapperHtmlOptions' => array(
						'class' => '',
					),
					'widgetOptions' => array(
						'data' => CHtml::listData(Servicios::model()->findAll(array("condition"=>"serv_habilitado='Si'")), 'serv_id', function($ser) {
							    return CHtml::encode($ser->serv_nombre . " (" . $ser->servProg->prog_nombre . " - " . $ser->servProg->progCli->cli_nombre . ")");
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
