<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

		<?php echo $form->textFieldGroup($model,'rol_id',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'')))); ?>

		<?php echo $form->textFieldGroup($model,'rol_nombre',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'')))); ?>

		<?php echo $form->dropDownListGroup($model,'rol_habilitado', array('widgetOptions'=>array('data'=>array("Si"=>"Si","No"=>"No",), 'htmlOptions'=>array('class'=>'input-large')))); ?>

	<div class="form-actions">
		<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType' => 'submit',
			'context'=>'primary',
			'label'=>'Filtrar',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
