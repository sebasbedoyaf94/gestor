<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

		<?php echo $form->textFieldGroup($model,'serv_id',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'')))); ?>

		<?php echo $form->textFieldGroup($model,'serv_prog_id',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'')))); ?>

		<?php echo $form->textFieldGroup($model,'serv_nombre',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'')))); ?>

		<?php echo $form->textAreaGroup($model,'serv_descripcion', array('widgetOptions'=>array('htmlOptions'=>array('rows'=>6, 'cols'=>50, 'class'=>'')))); ?>

		<?php echo $form->textFieldGroup($model,'serv_horaInicioLunes',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'')))); ?>

		<?php echo $form->textFieldGroup($model,'serv_horaFinLunes',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'')))); ?>

		<?php echo $form->textFieldGroup($model,'serv_horaInicioMartes',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'')))); ?>

		<?php echo $form->textFieldGroup($model,'serv_horaFinMartes',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'')))); ?>

		<?php echo $form->textFieldGroup($model,'serv_horaInicioMiercoles',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'')))); ?>

		<?php echo $form->textFieldGroup($model,'serv_horaFinMiercoles',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'')))); ?>

		<?php echo $form->textFieldGroup($model,'serv_horaInicioJueves',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'')))); ?>

		<?php echo $form->textFieldGroup($model,'serv_horaFinJueves',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'')))); ?>

		<?php echo $form->textFieldGroup($model,'serv_horaInicioViernes',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'')))); ?>

		<?php echo $form->textFieldGroup($model,'serv_horaFinViernes',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'')))); ?>

		<?php echo $form->textFieldGroup($model,'serv_horaInicioSabado',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'')))); ?>

		<?php echo $form->textFieldGroup($model,'serv_horaFinSabado',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'')))); ?>

		<?php echo $form->textFieldGroup($model,'serv_horaInicioDomingo',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'')))); ?>

		<?php echo $form->textFieldGroup($model,'serv_horaFinDomingo',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'')))); ?>

		<?php echo $form->dropDownListGroup($model,'serv_habilitado', array('widgetOptions'=>array('data'=>array("Si"=>"Si","No"=>"No",), 'htmlOptions'=>array('class'=>'input-large')))); ?>

		<?php echo $form->textFieldGroup($model,'serv_fechacreado',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'')))); ?>

		<?php echo $form->textFieldGroup($model,'serv_creadopor',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'')))); ?>

		<?php echo $form->textFieldGroup($model,'serv_fechamodificado',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'')))); ?>

		<?php echo $form->textFieldGroup($model,'serv_modificadopor',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'')))); ?>

	<div class="form-actions">
		<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType' => 'submit',
			'context'=>'primary',
			'label'=>'Filtrar',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
