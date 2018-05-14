<?php
/* @var $this ProyectosController */
/* @var $model Proyectos */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'proy_id'); ?>
		<?php echo $form->textField($model,'proy_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'proy_nombre'); ?>
		<?php echo $form->textField($model,'proy_nombre',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'proy_cli_id'); ?>
		<?php echo $form->textField($model,'proy_cli_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'proy_fechaInicio'); ?>
		<?php echo $form->textField($model,'proy_fechaInicio'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'proy_fechaFin'); ?>
		<?php echo $form->textField($model,'proy_fechaFin'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'proy_creadopor'); ?>
		<?php echo $form->textField($model,'proy_creadopor'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'proy_fechacreado'); ?>
		<?php echo $form->textField($model,'proy_fechacreado'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'proy_modificadopor'); ?>
		<?php echo $form->textField($model,'proy_modificadopor'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'proy_fechamodificado'); ?>
		<?php echo $form->textField($model,'proy_fechamodificado'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->