<?php
/* @var $this UsuariosProyectosController */
/* @var $model UsuariosProyectos */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'usuarios-proyectos-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'usuaproy_id'); ?>
		<?php echo $form->textField($model,'usuaproy_id'); ?>
		<?php echo $form->error($model,'usuaproy_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'usuaproy_usua_id'); ?>
		<?php echo $form->textField($model,'usuaproy_usua_id'); ?>
		<?php echo $form->error($model,'usuaproy_usua_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'usuaproy_proy_id'); ?>
		<?php echo $form->textField($model,'usuaproy_proy_id'); ?>
		<?php echo $form->error($model,'usuaproy_proy_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->