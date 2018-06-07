<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'usuarios-form',
	'enableAjaxValidation'=>false,
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
			<?php echo $form->textFieldGroup($model,'usua_cedula',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'')))); ?>
		</div>

		<div class="col-xs-12 col-sm-6">
			<?php echo $form->textFieldGroup($model,'usua_celular',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'')))); ?>
		</div>

		<div class="col-xs-12 col-sm-6">
			<?php echo $form->textFieldGroup($model,'usua_correo',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'')))); ?>
		</div>

		<div class="col-xs-12 col-sm-6">
			<?php echo $form->textFieldGroup($model,'usua_usuariored',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'')))); ?>
		</div>

		<div class="col-xs-12 col-sm-6">
			<?php echo $form->textFieldGroup($model,'usua_contrasena',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'')))); ?>
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
			<?php echo $form->dropDownListGroup($model,'usua_jefe_id',
				array(
					'wrapperHtmlOptions' => array(
						'class' => '',
					),
					'widgetOptions' => array(
						'data' => CHtml::listData(Usuarios::model()->findAll(array("condition"=>"usua_rol_id='1'")), 'usua_id', function($usua) {
							    return CHtml::encode($usua->usua_nombre . " " . $usua->usua_apellidos);
							}),
						'htmlOptions' => array(
							'empty'=>'-- Seleccione un Usuario --',
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
					'label'=>$model->isNewRecord ? 'Crear Usuario' : 'Guardar Cambios',
				)); ?>
		</div>
	</div>
</div>

<?php $this->endWidget(); ?>