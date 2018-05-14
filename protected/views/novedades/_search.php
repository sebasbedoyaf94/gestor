<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

		<?php echo $form->textFieldGroup($model,'nov_id',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'')))); ?>

		<?php echo $form->textFieldGroup($model,'nov_nombre',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'')))); ?>

		<?php echo $form->textFieldGroup($model,'nov_abreviatura',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'')))); ?>

		<?php echo $form->textAreaGroup($model,'nov_descripcion', array('widgetOptions'=>array('htmlOptions'=>array('rows'=>6, 'cols'=>50, 'class'=>'')))); ?>

		<?php echo $form->dropDownListGroup($model,'nov_paga', array('widgetOptions'=>array('data'=>array("Si"=>"Si","No"=>"No",), 'htmlOptions'=>array('class'=>'input-large')))); ?>

		<?php echo $form->dropDownListGroup($model,'nov_habilitado', array('widgetOptions'=>array('data'=>array("Si"=>"Si","No"=>"No",), 'htmlOptions'=>array('class'=>'input-large')))); ?>

		<?php echo $form->textFieldGroup($model,'nov_fechacreado',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'')))); ?>

		<?php echo $form->textFieldGroup($model,'nov_creadopor',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'')))); ?>

		<?php echo $form->textFieldGroup($model,'nov_fechamodificado',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'')))); ?>

		<?php echo $form->textFieldGroup($model,'nov_modificadopor',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'')))); ?>

	<div class="form-actions">
		<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType' => 'submit',
			'context'=>'primary',
			'label'=>'Filtrar',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
