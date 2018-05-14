<?php
/* @var $this ChecklistController */
/* @var $model Checklist */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'checklist-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'check_id'); ?>
		<?php echo $form->textField($model,'check_id'); ?>
		<?php echo $form->error($model,'check_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'check_proy_id'); ?>
		<?php echo $form->textField($model,'check_proy_id'); ?>
		<?php echo $form->error($model,'check_proy_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'check_url_pruebas'); ?>
		<?php echo $form->textField($model,'check_url_pruebas',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'check_url_pruebas'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'check_ruta_doc_funcional'); ?>
		<?php echo $form->textField($model,'check_ruta_doc_funcional',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'check_ruta_doc_funcional'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'check_ruta_doc_tecnica'); ?>
		<?php echo $form->textField($model,'check_ruta_doc_tecnica',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'check_ruta_doc_tecnica'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'check_observaciones'); ?>
		<?php echo $form->textField($model,'check_observaciones',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'check_observaciones'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'check_usuario_pruebas'); ?>
		<?php echo $form->textField($model,'check_usuario_pruebas',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'check_usuario_pruebas'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'check_contrasena_pruebas'); ?>
		<?php echo $form->textField($model,'check_contrasena_pruebas',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'check_contrasena_pruebas'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'check_creadopor'); ?>
		<?php echo $form->textField($model,'check_creadopor'); ?>
		<?php echo $form->error($model,'check_creadopor'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'check_fechacreado'); ?>
		<?php echo $form->textField($model,'check_fechacreado'); ?>
		<?php echo $form->error($model,'check_fechacreado'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'check_modificadopor'); ?>
		<?php echo $form->textField($model,'check_modificadopor'); ?>
		<?php echo $form->error($model,'check_modificadopor'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'check_fechamodificado'); ?>
		<?php echo $form->textField($model,'check_fechamodificado'); ?>
		<?php echo $form->error($model,'check_fechamodificado'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->