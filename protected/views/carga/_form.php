<?php
/* @var $this CargaController */
/* @var $model Carga */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'carga-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'carga_id'); ?>
		<?php echo $form->textField($model,'carga_id'); ?>
		<?php echo $form->error($model,'carga_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'carga_nombre_archivo'); ?>
		<?php echo $form->textField($model,'carga_nombre_archivo',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'carga_nombre_archivo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'carga_ruta_archivo'); ?>
		<?php echo $form->textField($model,'carga_ruta_archivo',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'carga_ruta_archivo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'carga_proy_id'); ?>
		<?php echo $form->textField($model,'carga_proy_id'); ?>
		<?php echo $form->error($model,'carga_proy_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'carga_fase'); ?>
		<?php echo $form->textField($model,'carga_fase',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'carga_fase'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'carga_descripcion'); ?>
		<?php echo $form->textField($model,'carga_descripcion',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'carga_descripcion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'carga_creadopor'); ?>
		<?php echo $form->textField($model,'carga_creadopor'); ?>
		<?php echo $form->error($model,'carga_creadopor'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'carga_fechacreado'); ?>
		<?php echo $form->textField($model,'carga_fechacreado'); ?>
		<?php echo $form->error($model,'carga_fechacreado'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'carga_modificadopor'); ?>
		<?php echo $form->textField($model,'carga_modificadopor'); ?>
		<?php echo $form->error($model,'carga_modificadopor'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'carga_fechamodificado'); ?>
		<?php echo $form->textField($model,'carga_fechamodificado'); ?>
		<?php echo $form->error($model,'carga_fechamodificado'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->