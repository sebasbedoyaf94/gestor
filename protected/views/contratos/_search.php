<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

		<?php echo $form->textFieldGroup($model,'cont_id',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'')))); ?>

		<?php echo $form->textFieldGroup($model,'cont_total_horas_semana',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'')))); ?>

		<?php echo $form->textFieldGroup($model,'cont_min_horas_dia',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'')))); ?>

		<?php echo $form->textFieldGroup($model,'cont_max_horas_dia',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'')))); ?>

		<?php echo $form->dropDownListGroup($model,'cont_habilitado', array('widgetOptions'=>array('data'=>array("Si"=>"Si","No"=>"No",), 'htmlOptions'=>array('class'=>'input-large')))); ?>

		<?php echo $form->textFieldGroup($model,'cont_fechacreado',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'')))); ?>

		<?php echo $form->textFieldGroup($model,'cont_creadopor',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'')))); ?>

		<?php echo $form->textFieldGroup($model,'cont_modificadopor',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'')))); ?>

		<?php echo $form->textFieldGroup($model,'cont_fechamodificado',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'')))); ?>

	<div class="form-actions">
		<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType' => 'submit',
			'context'=>'primary',
			'label'=>'Filtrar',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
