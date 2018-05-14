<?php
/* @var $this UsuariosProyectosController */
/* @var $model UsuariosProyectos */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'usuaproy_id'); ?>
		<?php echo $form->textField($model,'usuaproy_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'usuaproy_usua_id'); ?>
		<?php echo $form->textField($model,'usuaproy_usua_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'usuaproy_proy_id'); ?>
		<?php echo $form->textField($model,'usuaproy_proy_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->