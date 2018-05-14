<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

		<?php echo $form->textFieldGroup($model,'turase_id',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'')))); ?>

		<?php echo $form->textFieldGroup($model,'turase_tur_id',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'')))); ?>

		<?php echo $form->textFieldGroup($model,'turase_aseserv_id',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'')))); ?>

		<?php echo $form->datePickerGroup($model,'turase_fechaInicio',array('widgetOptions'=>array('options'=>array(),'htmlOptions'=>array('class'=>'')), 'prepend'=>'<i class="glyphicon glyphicon-calendar"></i>', 'append'=>'Click on Month/Year to select a different Month/Year.')); ?>

		<?php echo $form->datePickerGroup($model,'turase_fechaFin',array('widgetOptions'=>array('options'=>array(),'htmlOptions'=>array('class'=>'')), 'prepend'=>'<i class="glyphicon glyphicon-calendar"></i>', 'append'=>'Click on Month/Year to select a different Month/Year.')); ?>

		<?php echo $form->textFieldGroup($model,'turase_fechacreado',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'')))); ?>

		<?php echo $form->textFieldGroup($model,'turase_creadopor',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'')))); ?>

		<?php echo $form->textFieldGroup($model,'turase_fechamodificado',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'')))); ?>

		<?php echo $form->textFieldGroup($model,'turase_modificadopor',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'')))); ?>

	<div class="form-actions">
		<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType' => 'submit',
			'context'=>'primary',
			'label'=>'Filtrar',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
