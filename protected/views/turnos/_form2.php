<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'turnos-form',
	'enableAjaxValidation'=>false,
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
			<?php echo $form->textFieldGroup($model,'tur_nombre',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'')))); ?>
		</div>

		<div class="col-xs-12 col-sm-6">
			<?php echo $form->dropDownListGroup($model,'tur_habilitado', array('widgetOptions'=>array('data'=>array("Si"=>"Si","No"=>"No",), 'htmlOptions'=>array('class'=>'input-large')))); ?>
		</div>





		<div class="col-xs-12 col-sm-12">
			<h3 class='subtitulo'>Programación horario del Turno</h3>
		</div>

		<div class="col-xs-12 col-sm-6">
			<?php echo $form->timePickerGroup($model,'tur_horaInicioLunes',array('widgetOptions' => array('noAppend' => true,'options' => array('disableFocus' => true,'showMeridian' => false),'wrapperHtmlOptions' => array('class' => ''),),'hint' => '',)); ?>
		</div>

		<div class="col-xs-12 col-sm-6">
		 	<?php echo $form->labelEx($model,'tur_horaFinLunes'); ?>
			<?php   
				$this->widget('application.extensions.timepicker.EJuiDateTimePicker',array(
		            'model'=>$model,
		            'attribute'=>'tur_horaFinLunes',
		            'timePickerOnly' => 'true',
		            'htmlOptions' => array('class' => ' form-control'),
		            'options'=>array(
		                'timeFormat' => 'hh:mm:ss',
		                ),
		            ));
			?>
			<?php echo $form->error($model,'tur_horaFinLunes'); ?>
		</div>

		<div class="col-xs-12 col-sm-6">
		 	<?php echo $form->labelEx($model,'tur_horaInicioMartes'); ?>
			<?php   
				$this->widget('application.extensions.timepicker.EJuiDateTimePicker',array(
		            'model'=>$model,
		            'attribute'=>'tur_horaInicioMartes',
		            'timePickerOnly' => 'true',
		            'htmlOptions' => array('class' => ' form-control'),
		            'options'=>array(
		                'timeFormat' => 'hh:mm:ss',
		                ),
		            ));
			?>
			<?php echo $form->error($model,'tur_horaInicioMartes'); ?>
		</div>

		<div class="col-xs-12 col-sm-6">
		 	<?php echo $form->labelEx($model,'tur_horaFinMartes'); ?>
			<?php   
				$this->widget('application.extensions.timepicker.EJuiDateTimePicker',array(
		            'model'=>$model,
		            'attribute'=>'tur_horaFinMartes',
		            'timePickerOnly' => 'true',
		            'htmlOptions' => array('class' => ' form-control'),
		            'options'=>array(
		                'timeFormat' => 'hh:mm:ss',
		                ),
		            ));
			?>
			<?php echo $form->error($model,'tur_horaFinMartes'); ?>
		</div>

		<div class="col-xs-12 col-sm-6">
		 	<?php echo $form->labelEx($model,'tur_horaInicioMiercoles'); ?>
			<?php   
				$this->widget('application.extensions.timepicker.EJuiDateTimePicker',array(
		            'model'=>$model,
		            'attribute'=>'tur_horaInicioMiercoles',
		            'timePickerOnly' => 'true',
		            'htmlOptions' => array('class' => ' form-control'),
		            'options'=>array(
		                'timeFormat' => 'hh:mm:ss',
		                ),
		            ));
			?>
			<?php echo $form->error($model,'tur_horaInicioMiercoles'); ?>
		</div>

		<div class="col-xs-12 col-sm-6">
		 	<?php echo $form->labelEx($model,'tur_horaFinMiercoles'); ?>
			<?php   
				$this->widget('application.extensions.timepicker.EJuiDateTimePicker',array(
		            'model'=>$model,
		            'attribute'=>'tur_horaFinMiercoles',
		            'timePickerOnly' => 'true',
		            'htmlOptions' => array('class' => ' form-control'),
		            'options'=>array(
		                'timeFormat' => 'hh:mm:ss',
		                ),
		            ));
			?>
			<?php echo $form->error($model,'tur_horaFinMiercoles'); ?>
		</div>

		<div class="col-xs-12 col-sm-6">
		 	<?php echo $form->labelEx($model,'tur_horaInicioJueves'); ?>
			<?php   
				$this->widget('application.extensions.timepicker.EJuiDateTimePicker',array(
		            'model'=>$model,
		            'attribute'=>'tur_horaInicioJueves',
		            'timePickerOnly' => 'true',
		            'htmlOptions' => array('class' => ' form-control'),
		            'options'=>array(
		                'timeFormat' => 'hh:mm:ss',
		                ),
		            ));
			?>
			<?php echo $form->error($model,'tur_horaInicioJueves'); ?>
		</div>

		<div class="col-xs-12 col-sm-6">
		 	<?php echo $form->labelEx($model,'tur_horaFinJueves'); ?>
			<?php   
				$this->widget('application.extensions.timepicker.EJuiDateTimePicker',array(
		            'model'=>$model,
		            'attribute'=>'tur_horaFinJueves',
		            'timePickerOnly' => 'true',
		            'htmlOptions' => array('class' => ' form-control'),
		            'options'=>array(
		                'timeFormat' => 'hh:mm:ss',
		                ),
		            ));
			?>
			<?php echo $form->error($model,'tur_horaFinJueves'); ?>
		</div>

		<div class="col-xs-12 col-sm-6">
		 	<?php echo $form->labelEx($model,'tur_horaInicioViernes'); ?>
			<?php   
				$this->widget('application.extensions.timepicker.EJuiDateTimePicker',array(
		            'model'=>$model,
		            'attribute'=>'tur_horaInicioViernes',
		            'timePickerOnly' => 'true',
		            'htmlOptions' => array('class' => ' form-control'),
		            'options'=>array(
		                'timeFormat' => 'hh:mm:ss',
		                ),
		            ));
			?>
			<?php echo $form->error($model,'tur_horaInicioViernes'); ?>
		</div>

		<div class="col-xs-12 col-sm-6">
		 	<?php echo $form->labelEx($model,'tur_horaFinViernes'); ?>
			<?php   
				$this->widget('application.extensions.timepicker.EJuiDateTimePicker',array(
		            'model'=>$model,
		            'attribute'=>'tur_horaFinViernes',
		            'timePickerOnly' => 'true',
		            'htmlOptions' => array('class' => ' form-control'),
		            'options'=>array(
		                'timeFormat' => 'hh:mm:ss',
		                ),
		            ));
			?>
			<?php echo $form->error($model,'tur_horaFinViernes'); ?>
		</div>

		<div class="col-xs-12 col-sm-6">
		 	<?php echo $form->labelEx($model,'tur_horaInicioSabado'); ?>
			<?php   
				$this->widget('application.extensions.timepicker.EJuiDateTimePicker',array(
		            'model'=>$model,
		            'attribute'=>'tur_horaInicioSabado',
		            'timePickerOnly' => 'true',
		            'htmlOptions' => array('class' => ' form-control'),
		            'options'=>array(
		                'timeFormat' => 'hh:mm:ss',
		                ),
		            ));
			?>
			<?php echo $form->error($model,'tur_horaInicioSabado'); ?>
		</div>

		<div class="col-xs-12 col-sm-6">
		 	<?php echo $form->labelEx($model,'tur_horaFinSabado'); ?>
			<?php   
				$this->widget('application.extensions.timepicker.EJuiDateTimePicker',array(
		            'model'=>$model,
		            'attribute'=>'tur_horaFinSabado',
		            'timePickerOnly' => 'true',
		            'htmlOptions' => array('class' => ' form-control'),
		            'options'=>array(
		                'timeFormat' => 'hh:mm:ss',
		                ),
		            ));
			?>
			<?php echo $form->error($model,'tur_horaFinSabado'); ?>
		</div>

		<div class="col-xs-12 col-sm-6">
		 	<?php echo $form->labelEx($model,'tur_horaInicioDomingo'); ?>
			<?php   
				$this->widget('application.extensions.timepicker.EJuiDateTimePicker',array(
		            'model'=>$model,
		            'attribute'=>'tur_horaInicioDomingo',
		            'timePickerOnly' => 'true',
		            'htmlOptions' => array('class' => ' form-control'),
		            'options'=>array(
		                'timeFormat' => 'hh:mm:ss',
		                ),
		            ));
			?>
			<?php echo $form->error($model,'tur_horaInicioDomingo'); ?>
		</div>

		<div class="col-xs-12 col-sm-6">
		 	<?php echo $form->labelEx($model,'tur_horaFinDomingo'); ?>
			<?php   
				$this->widget('application.extensions.timepicker.EJuiDateTimePicker',array(
		            'model'=>$model,
		            'attribute'=>'tur_horaFinDomingo',
		            'timePickerOnly' => 'true',
		            'htmlOptions' => array('class' => ' form-control'),
		            'options'=>array(
		                'timeFormat' => 'hh:mm:ss',
		                ),
		            ));
			?>
			<?php echo $form->error($model,'tur_horaFinDomingo'); ?>
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


<script type="text/javascript">
	$('.Turnos_tur_horaInicioMartes').timepicker();
</script>