<?php
/* @var $this ReportesController */
/* @var $model Reportes */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'rep_id'); ?>
		<?php echo $form->textField($model,'rep_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rep_fechaInicio'); ?>
		<?php echo $form->textField($model,'rep_fechaInicio'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rep_fechaFin'); ?>
		<?php echo $form->textField($model,'rep_fechaFin'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rep_fase'); ?>
		<?php echo $form->textField($model,'rep_fase',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rep_proy_id'); ?>
		<?php echo $form->textField($model,'rep_proy_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rep_tipo'); ?>
		<?php echo $form->textField($model,'rep_tipo'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->