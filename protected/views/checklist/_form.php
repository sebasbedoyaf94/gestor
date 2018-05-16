<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'checklist-form',
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>true,
	'clientOptions'=>array(
            'validateOnSubmit'=>true,
    ),
)); ?>


<div class="row">
	<div class="col-xs-12 col-sm-12 well">
		<div class="col-xs-12 col-sm-12">
			<h3 class='subtitulo'>Información del Checklist</h3>
		</div>

		<div class="col-xs-12 col-sm-12">
			<?php echo $form->dropDownListGroup($model,'check_proy_id',
				array(
					'wrapperHtmlOptions' => array(
						'class' => '',
					),
					'widgetOptions' => array(
						'data' => CHtml::listData(Proyectos::model()->findAll(array("condition"=>"proy_habilitado='Si'")), 'proy_id', 'proy_nombre'),
						'htmlOptions' => array(
							'empty'=>'-- Selecciona un Proyecto --',
						),
					),
				)
			); ?>
		</div>

		<div class="col-xs-12 col-sm-12">
			<?php echo $form->textFieldGroup($model,'check_url_pruebas',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'')))); ?>
		</div>

		<div class="col-xs-12 col-sm-12">
			<?php echo $form->textFieldGroup($model,'check_ruta_doc_funcional',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'')))); ?>
		</div>

		<div class="col-xs-12 col-sm-12">
			<?php echo $form->textFieldGroup($model,'check_ruta_doc_tecnica',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'')))); ?>
		</div>
		
		<div class="col-xs-12 col-sm-6">
			<?php echo $form->textFieldGroup($model,'check_usuario_pruebas',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'')))); ?>
		</div>

		<div class="col-xs-12 col-sm-6">
			<?php echo $form->textFieldGroup($model,'check_contrasena_pruebas',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'')))); ?>
		</div>

		<div class="col-xs-12 col-sm-12">
			<?php echo $form->textAreaGroup($model,'check_observaciones',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'')))); ?> 
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
					'label'=>$model->isNewRecord ? 'Crear Checklist' : 'Guardar Cambios',
				)); ?>
		</div>
	</div>
</div>

<?php $this->endWidget(); ?>
