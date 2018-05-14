<?php
/* @var $this CargaController */
/* @var $model Carga */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'carga_id'); ?>
		<?php echo $form->textField($model,'carga_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'carga_nombre_archivo'); ?>
		<?php echo $form->textField($model,'carga_nombre_archivo',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'carga_ruta_archivo'); ?>
		<?php echo $form->textField($model,'carga_ruta_archivo',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'carga_proy_id'); ?>
		<?php echo $form->textField($model,'carga_proy_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'carga_fase'); ?>
		<?php echo $form->textField($model,'carga_fase',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'carga_descripcion'); ?>
		<?php echo $form->textField($model,'carga_descripcion',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'carga_creadopor'); ?>
		<?php echo $form->textField($model,'carga_creadopor'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'carga_fechacreado'); ?>
		<?php echo $form->textField($model,'carga_fechacreado'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'carga_modificadopor'); ?>
		<?php echo $form->textField($model,'carga_modificadopor'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'carga_fechamodificado'); ?>
		<?php echo $form->textField($model,'carga_fechamodificado'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->