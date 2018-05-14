<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'turnos-form',
	'enableAjaxValidation'=>true,
	'enableClientValidation'=>true,
	'clientOptions'=>array(
            'validateOnSubmit'=>true,
    ),
)); ?>


<div class="row">
	<div class="col-xs-12 col-sm-12 well">
		<div class="col-xs-12 col-sm-12">
			<h3 class='subtitulo'>Información del Turno</h3>
		</div>
		<div class="col-xs-12 col-sm-6">
			<?php echo $form->textFieldGroup($model,'tur_nombre',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'', 'disabled'=>'disabled')))); ?>
		</div>

		<div class="col-xs-12 col-sm-6">
			<?php echo $form->dropDownListGroup($model,'tur_habilitado', array('widgetOptions'=>array('data'=>array("Si"=>"Si","No"=>"No",), 'htmlOptions'=>array('class'=>'input-large')))); ?>
		</div>


		<div class="col-xs-12 col-sm-12">
			<h3 class='subtitulo'>Programación horario del Turno</h3>
		</div>

		<div class="col-xs-12">
						
			<div class="col-xs-12 col-sm-6">
			<?php echo $form->timePickerGroup($model,'tur_horaInicioLunes',array('widgetOptions' => array('noAppend' => true,'options' => array('disableFocus' => true,'showMeridian' => false),'wrapperHtmlOptions' => array('class' => ''),),'hint' => '',)); ?>
			</div>

			<div class="col-xs-12 col-sm-6">
			<?php echo $form->timePickerGroup($model,'tur_horaFinLunes',array('widgetOptions' => array('noAppend' => true,'options' => array('disableFocus' => true,'showMeridian' => false),'wrapperHtmlOptions' => array('class' => ''),),'hint' => '',)); ?>
			</div>
		</div>
		<div class="col-xs-12">
						
			<div class="col-xs-12 col-sm-6">
			<?php echo $form->timePickerGroup($model,'tur_horaInicioMartes',array('widgetOptions' => array('noAppend' => true,'options' => array('disableFocus' => true,'showMeridian' => false),'wrapperHtmlOptions' => array('class' => ''),),'hint' => '',)); ?>
			</div>

			<div class="col-xs-12 col-sm-6">
			<?php echo $form->timePickerGroup($model,'tur_horaFinMartes',array('widgetOptions' => array('noAppend' => true,'options' => array('disableFocus' => true,'showMeridian' => false),'wrapperHtmlOptions' => array('class' => ''),),'hint' => '',)); ?>
			</div>
		</div>
		<div class="col-xs-12">
						
			<div class="col-xs-12 col-sm-6">
			<?php echo $form->timePickerGroup($model,'tur_horaInicioMiercoles',array('widgetOptions' => array('noAppend' => true,'options' => array('disableFocus' => true,'showMeridian' => false),'wrapperHtmlOptions' => array('class' => ''),),'hint' => '',)); ?>
			</div>

			<div class="col-xs-12 col-sm-6">
			<?php echo $form->timePickerGroup($model,'tur_horaFinMiercoles',array('widgetOptions' => array('noAppend' => true,'options' => array('disableFocus' => true,'showMeridian' => false),'wrapperHtmlOptions' => array('class' => ''),),'hint' => '',)); ?>
			</div>
		</div>
		<div class="col-xs-12">
						
			<div class="col-xs-12 col-sm-6">
			<?php echo $form->timePickerGroup($model,'tur_horaInicioJueves',array('widgetOptions' => array('noAppend' => true,'options' => array('disableFocus' => true,'showMeridian' => false),'wrapperHtmlOptions' => array('class' => ''),),'hint' => '',)); ?>
			</div>

			<div class="col-xs-12 col-sm-6">
			<?php echo $form->timePickerGroup($model,'tur_horaFinJueves',array('widgetOptions' => array('noAppend' => true,'options' => array('disableFocus' => true,'showMeridian' => false),'wrapperHtmlOptions' => array('class' => ''),),'hint' => '',)); ?>
			</div>
		</div>
		<div class="col-xs-12">
						
			<div class="col-xs-12 col-sm-6">
			<?php echo $form->timePickerGroup($model,'tur_horaInicioViernes',array('widgetOptions' => array('noAppend' => true,'options' => array('disableFocus' => true,'showMeridian' => false),'wrapperHtmlOptions' => array('class' => ''),),'hint' => '',)); ?>
			</div>

			<div class="col-xs-12 col-sm-6">
			<?php echo $form->timePickerGroup($model,'tur_horaFinViernes',array('widgetOptions' => array('noAppend' => true,'options' => array('disableFocus' => true,'showMeridian' => false),'wrapperHtmlOptions' => array('class' => ''),),'hint' => '',)); ?>
			</div>
		</div>
		<div class="col-xs-12">
						
			<div class="col-xs-12 col-sm-6">
			<?php echo $form->timePickerGroup($model,'tur_horaInicioSabado',array('widgetOptions' => array('noAppend' => true,'options' => array('disableFocus' => true,'showMeridian' => false),'wrapperHtmlOptions' => array('class' => ''),),'hint' => '',)); ?>
			</div>

			<div class="col-xs-12 col-sm-6">
			<?php echo $form->timePickerGroup($model,'tur_horaFinSabado',array('widgetOptions' => array('noAppend' => true,'options' => array('disableFocus' => true,'showMeridian' => false),'wrapperHtmlOptions' => array('class' => ''),),'hint' => '',)); ?>
			</div>
		</div>
		<div class="col-xs-12">
						
			<div class="col-xs-12 col-sm-6">
			<?php echo $form->timePickerGroup($model,'tur_horaInicioDomingo',array('widgetOptions' => array('noAppend' => true,'options' => array('disableFocus' => true,'showMeridian' => false),'wrapperHtmlOptions' => array('class' => ''),),'hint' => '',)); ?>
			</div>

			<div class="col-xs-12 col-sm-6">
			<?php echo $form->timePickerGroup($model,'tur_horaFinDomingo',array('widgetOptions' => array('noAppend' => true,'options' => array('disableFocus' => true,'showMeridian' => false),'wrapperHtmlOptions' => array('class' => ''),),'hint' => '',)); ?>
			</div>
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
					'label'=>$model->isNewRecord ? 'Crear Turno' : 'Guardar Cambios',
				)); ?>
		</div>
	</div>
</div>

<?php $this->endWidget(); ?>
