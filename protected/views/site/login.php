<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Iniciar Sesion';
$this->breadcrumbs=array(
	'Iniciar Sesion',
);
?>


<div class="form col-xs-12 text-center">
	<h1>Iniciar Sesion</h1>
	
	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'login-form',
		'enableClientValidation'=>true,
		'clientOptions'=>array(
			'validateOnSubmit'=>true,
		),
		'focus'=>array($model,'username'),
		'htmlOptions' => array(
			'autocomplete'=>"off",
		),
	)); ?>


	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username'); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password'); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<p class="note">Los campos con <span class="required">*</span> son obligatorios.</p>

	<div class="col-xs-12 text-center">
		<div class="form-actions">
			<?php $this->widget('booster.widgets.TbButton', array(
					'buttonType'=>'submit',
					'context'=>'primary',
					'label'=>'Iniciar Sesion',
				)); ?>
		</div>
	</div>

	<?php $this->endWidget(); ?>
</div><!-- form -->
