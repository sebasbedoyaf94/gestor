<?php
/* @var $this ClientesController */
/* @var $model Clientes */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'cli_id'); ?>
		<?php echo $form->textField($model,'cli_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cli_nombre'); ?>
		<?php echo $form->textField($model,'cli_nombre',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cli_habilitado'); ?>
		<?php echo $form->textField($model,'cli_habilitado',array('size'=>2,'maxlength'=>2)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->