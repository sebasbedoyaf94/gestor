<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'servicios-form',
	'enableAjaxValidation'=>true,
	'enableClientValidation'=>true,
	'clientOptions'=>array(
            'validateOnSubmit'=>true,
    ),
)); ?>


<div class="row">
	<div class="col-xs-12 col-sm-12 well">
		<div class="col-xs-12 col-sm-12">
			<h3 class='subtitulo'>Información del Servicio</h3>
		</div>

		<div class="col-xs-12 col-sm-4">
			<?php echo $form->dropDownListGroup($model,'serv_prog_id',
				array(
					'wrapperHtmlOptions' => array(
						'class' => '',
					),
					'widgetOptions' => array(
						'data' => CHtml::listData(Programas::model()->findAll(array("condition"=>"prog_habilitado='Si'")), 'prog_id', function($prog) {
							    return CHtml::encode($prog->prog_nombre.' ('.$prog->progCli->cli_nombre.')');
							}),
						// 'data' => CHtml::listData(Programas::model()->findAll(array("condition"=>"prog_habilitado='Si'")), 'prog_id', 'prog_nombre '.'prog_cli_id'),
						'htmlOptions' => array(
							'empty'=>'-- Selecciona un Programa --',
						),
					),
				)
			); ?>
		</div>

		<div class="col-xs-12 col-sm-4">
			<?php echo $form->textFieldGroup($model,'serv_nombre',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'')))); ?>
		</div>

		<div class="col-xs-12 col-sm-4">
			<?php echo $form->dropDownListGroup($model,'serv_habilitado', array('widgetOptions'=>array('data'=>array("Si"=>"Si","No"=>"No",), 'htmlOptions'=>array('class'=>'input-large')))); ?>
		</div>

		<div class="col-xs-12 col-sm-12">
			<?php echo $form->textAreaGroup($model,'serv_descripcion', array('widgetOptions'=>array('htmlOptions'=>array('rows'=>6, 'cols'=>50, 'class'=>'')))); ?>
		</div>
	</div>

	<div class="col-xs-12 col-sm-12 well">
		<div class="col-xs-12 col-sm-12">
			<h3 class='subtitulo'>Información Horarios del Servicio</h3>
		</div>

		<div class="col-xs-12 col-sm-6">
			<?php echo $form->timePickerGroup($model,'serv_horaInicioLunes',array('widgetOptions' => array('noAppend' => true,'options' => array('disableFocus' => true,'showMeridian' => false),'wrapperHtmlOptions' => array('class' => ''),),'hint' => '',)); ?>
		</div>

		<div class="col-xs-12 col-sm-6">
			<?php echo $form->timePickerGroup($model,'serv_horaFinLunes',array('widgetOptions' => array('noAppend' => true,'options' => array('disableFocus' => true,'showMeridian' => false),'wrapperHtmlOptions' => array('class' => ''),),'hint' => '',)); ?>
		</div>

		<div class="col-xs-12 col-sm-6">
			<?php echo $form->timePickerGroup($model,'serv_horaInicioMartes',array('widgetOptions' => array('noAppend' => true,'options' => array('disableFocus' => true,'showMeridian' => false),'wrapperHtmlOptions' => array('class' => ''),),'hint' => '',)); ?>
		</div>

		<div class="col-xs-12 col-sm-6">
			<?php echo $form->timePickerGroup($model,'serv_horaFinMartes',array('widgetOptions' => array('noAppend' => true,'options' => array('disableFocus' => true,'showMeridian' => false),'wrapperHtmlOptions' => array('class' => ''),),'hint' => '',)); ?>
		</div>

		<div class="col-xs-12 col-sm-6">
			<?php echo $form->timePickerGroup($model,'serv_horaInicioMiercoles',array('widgetOptions' => array('noAppend' => true,'options' => array('disableFocus' => true,'showMeridian' => false),'wrapperHtmlOptions' => array('class' => ''),),'hint' => '',)); ?>
		</div>

		<div class="col-xs-12 col-sm-6">
			<?php echo $form->timePickerGroup($model,'serv_horaFinMiercoles',array('widgetOptions' => array('noAppend' => true,'options' => array('disableFocus' => true,'showMeridian' => false),'wrapperHtmlOptions' => array('class' => ''),),'hint' => '',)); ?>
		</div>

		<div class="col-xs-12 col-sm-6">
			<?php echo $form->timePickerGroup($model,'serv_horaInicioJueves',array('widgetOptions' => array('noAppend' => true,'options' => array('disableFocus' => true,'showMeridian' => false),'wrapperHtmlOptions' => array('class' => ''),),'hint' => '',)); ?>
		</div>

		<div class="col-xs-12 col-sm-6">
			<?php echo $form->timePickerGroup($model,'serv_horaFinJueves',array('widgetOptions' => array('noAppend' => true,'options' => array('disableFocus' => true,'showMeridian' => false),'wrapperHtmlOptions' => array('class' => ''),),'hint' => '',)); ?>
		</div>

		<div class="col-xs-12 col-sm-6">
			<?php echo $form->timePickerGroup($model,'serv_horaInicioViernes',array('widgetOptions' => array('noAppend' => true,'options' => array('disableFocus' => true,'showMeridian' => false),'wrapperHtmlOptions' => array('class' => ''),),'hint' => '',)); ?>
		</div>

		<div class="col-xs-12 col-sm-6">
			<?php echo $form->timePickerGroup($model,'serv_horaFinViernes',array('widgetOptions' => array('noAppend' => true,'options' => array('disableFocus' => true,'showMeridian' => false),'wrapperHtmlOptions' => array('class' => ''),),'hint' => '',)); ?>
		</div>

		<div class="col-xs-12 col-sm-6">
			<?php echo $form->timePickerGroup($model,'serv_horaInicioSabado',array('widgetOptions' => array('noAppend' => true,'options' => array('disableFocus' => true,'showMeridian' => false),'wrapperHtmlOptions' => array('class' => ''),),'hint' => '',)); ?>
		</div>

		<div class="col-xs-12 col-sm-6">
			<?php echo $form->timePickerGroup($model,'serv_horaFinSabado',array('widgetOptions' => array('noAppend' => true,'options' => array('disableFocus' => true,'showMeridian' => false),'wrapperHtmlOptions' => array('class' => ''),),'hint' => '',)); ?>
		</div>

		<div class="col-xs-12 col-sm-6">
			<?php echo $form->timePickerGroup($model,'serv_horaInicioDomingo',array('widgetOptions' => array('noAppend' => true,'options' => array('disableFocus' => true,'showMeridian' => false),'wrapperHtmlOptions' => array('class' => ''),),'hint' => '',)); ?>
		</div>

		<div class="col-xs-12 col-sm-6">
			<?php echo $form->timePickerGroup($model,'serv_horaFinDomingo',array('widgetOptions' => array('noAppend' => true,'options' => array('disableFocus' => true,'showMeridian' => false),'wrapperHtmlOptions' => array('class' => ''),),'hint' => '',)); ?>
		</div>

	</div>

	<div class="col-xs-12">
		<p class="help-block">Los campos con <span class="required">*</span> son obligatorios.</p>
		<?php echo $form->errorSummary($model); ?>
	</div>

	<div class="col-xs-12 text-center">
		<div class="form-actions">
			<?php $this->widget('booster.widgets.TbButton', array(
					'buttonType'=>'submit',
					'context'=>'primary',
					'label'=>$model->isNewRecord ? 'Crear Servicios' : 'Guardar Cambios',
				)); ?>
		</div>
	</div>
</div>

<?php $this->endWidget(); ?>
