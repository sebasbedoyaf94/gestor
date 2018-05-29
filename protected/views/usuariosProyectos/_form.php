<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'usuarios-proyectos-form',
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>true,
	'clientOptions'=>array(
            'validateOnSubmit'=>true,
    ),
)); ?>


<div class="row">
	<div class="col-xs-12 col-sm-12 well">
		<div class="col-xs-12 col-sm-12">
			<h3 class='subtitulo'>Información</h3>
		</div>

		<div class="col-xs-12 col-sm-6">
			<?php echo $form->dropDownListGroup($model,'usuaproy_usua_id',
				array(
					'wrapperHtmlOptions' => array(
						'class' => '',
					),
					'widgetOptions' => array(
						'data' => CHtml::listData(Usuarios::model()->findAll(array("condition"=>"usua_habilitado='Si'")), 'usua_id', function($usua) {
							    return CHtml::encode($usua->usua_nombre . " " . $usua->usua_apellidos);
							}),
						'htmlOptions' => array(
							'empty'=>'-- Selecciona un Usuario --',
						),
					),
				)
			); ?>
		</div>

		<div class="col-xs-12 col-sm-6">
			<?php echo $form->dropDownListGroup($model,'usuaproy_proy_id',
				array(
					'wrapperHtmlOptions' => array(
						'class' => '',
					),
					'widgetOptions' => array(
						'data' => CHtml::listData(Proyectos::model()->findAll(array("condition"=>"proy_habilitado='Si'")), 'proy_id', function($proy) {
							    return CHtml::encode($proy->proy_nombre . " (" . $proy->proyCli->cli_nombre.")");
							}),
						'htmlOptions' => array(
							'empty'=>'-- Seleccione un Proyecto --',
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