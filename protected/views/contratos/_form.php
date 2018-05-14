<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'contratos-form',
	'enableAjaxValidation'=>true,
	'enableClientValidation'=>true,
	'clientOptions'=>array(
            'validateOnSubmit'=>true,
    ),
)); ?>


<div class="row">
	<div class="col-xs-12 col-sm-12 well">
		<div class="col-xs-12 col-sm-12">
			<h3 class='subtitulo'>Información del Contratos</h3>
		</div>
		<div class="col-xs-12 col-sm-3">
			<?php echo $form->textFieldGroup($model,'cont_total_horas_semana',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'')))); ?>
		</div>

		<div class="col-xs-12 col-sm-3">
			<?php echo $form->textFieldGroup($model,'cont_min_horas_dia',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'')))); ?>
		</div>

		<div class="col-xs-12 col-sm-3">
			<?php echo $form->textFieldGroup($model,'cont_max_horas_dia',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'')))); ?>
		</div>

		<div class="col-xs-12 col-sm-3">
			<?php echo $form->dropDownListGroup($model,'cont_habilitado', array('widgetOptions'=>array('data'=>array("Si"=>"Si","No"=>"No",), 'htmlOptions'=>array('class'=>'input-large')))); ?>
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
					'label'=>$model->isNewRecord ? 'Crear Contrato' : 'Guardar Cambios',
				)); ?>
		</div>
	</div>
</div>

<?php $this->endWidget(); ?>
