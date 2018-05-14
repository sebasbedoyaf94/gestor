<?php
/* @var $this ChecklistController */
/* @var $model Checklist */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'check_id'); ?>
		<?php echo $form->textField($model,'check_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'check_proy_id'); ?>
		<?php echo $form->textField($model,'check_proy_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'check_url_pruebas'); ?>
		<?php echo $form->textField($model,'check_url_pruebas',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'check_ruta_doc_funcional'); ?>
		<?php echo $form->textField($model,'check_ruta_doc_funcional',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'check_ruta_doc_tecnica'); ?>
		<?php echo $form->textField($model,'check_ruta_doc_tecnica',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'check_observaciones'); ?>
		<?php echo $form->textField($model,'check_observaciones',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'check_usuario_pruebas'); ?>
		<?php echo $form->textField($model,'check_usuario_pruebas',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'check_contrasena_pruebas'); ?>
		<?php echo $form->textField($model,'check_contrasena_pruebas',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'check_creadopor'); ?>
		<?php echo $form->textField($model,'check_creadopor'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'check_fechacreado'); ?>
		<?php echo $form->textField($model,'check_fechacreado'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'check_modificadopor'); ?>
		<?php echo $form->textField($model,'check_modificadopor'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'check_fechamodificado'); ?>
		<?php echo $form->textField($model,'check_fechamodificado'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->