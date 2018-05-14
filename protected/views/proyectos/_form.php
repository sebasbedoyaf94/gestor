<?php
/* @var $this ProyectosController */
/* @var $model Proyectos */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'proyectos-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'proy_id'); ?>
		<?php echo $form->textField($model,'proy_id'); ?>
		<?php echo $form->error($model,'proy_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'proy_nombre'); ?>
		<?php echo $form->textField($model,'proy_nombre',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'proy_nombre'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'proy_cli_id'); ?>
		<?php echo $form->textField($model,'proy_cli_id'); ?>
		<?php echo $form->error($model,'proy_cli_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'proy_fechaInicio'); ?>
		<?php echo $form->textField($model,'proy_fechaInicio'); ?>
		<?php echo $form->error($model,'proy_fechaInicio'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'proy_fechaFin'); ?>
		<?php echo $form->textField($model,'proy_fechaFin'); ?>
		<?php echo $form->error($model,'proy_fechaFin'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'proy_creadopor'); ?>
		<?php echo $form->textField($model,'proy_creadopor'); ?>
		<?php echo $form->error($model,'proy_creadopor'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'proy_fechacreado'); ?>
		<?php echo $form->textField($model,'proy_fechacreado'); ?>
		<?php echo $form->error($model,'proy_fechacreado'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'proy_modificadopor'); ?>
		<?php echo $form->textField($model,'proy_modificadopor'); ?>
		<?php echo $form->error($model,'proy_modificadopor'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'proy_fechamodificado'); ?>
		<?php echo $form->textField($model,'proy_fechamodificado'); ?>
		<?php echo $form->error($model,'proy_fechamodificado'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->