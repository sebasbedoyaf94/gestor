<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'novedades-asesores-form',
	'enableAjaxValidation'=>true,
	'enableClientValidation'=>true,
	'clientOptions'=>array(
            'validateOnSubmit'=>true,
    ),
)); ?>


<div class="row">
	<div class="col-xs-12 col-sm-12 well">
		<div class="col-xs-12 col-sm-12">
			<h3 class='subtitulo'>Información de la novedad del asesor</h3>
		</div>

		<div class="col-xs-12 col-sm-6">
			<?php echo $form->dropDownListGroup($model,'novase_ase_id',
				array(
					'wrapperHtmlOptions' => array(
						'class' => '',
					),
					'widgetOptions' => array(
						'data' => CHtml::listData(Asesores::model()->findAll(array("condition"=>"ase_habilitado='Si'")), 'ase_id', function($ase) {
							    return CHtml::encode($ase->ase_nombre ." ". $ase->ase_apellidos);
							}),
						'htmlOptions' => array(
							'empty'=>'-- Seleccione un Asesor --',
						),
					),
				)
			); ?>
		</div>

		<div class="col-xs-12 col-sm-6">
			<?php echo $form->dropDownListGroup($model,'novase_nov_id',
				array(
					'wrapperHtmlOptions' => array(
						'class' => '',
					),
					'widgetOptions' => array(
						'data' => CHtml::listData(Novedades::model()->findAll(array("condition"=>"nov_habilitado='Si'")), 'nov_id', function($nov) {
							    return CHtml::encode($nov->nov_nombre);
							}),
						'htmlOptions' => array(
							'empty'=>'-- Seleccione una Novedad --',
						),
					),
				)
			); ?>
		</div>

		<div class="col-xs-12 col-sm-6">
			<?php echo $form->datePickerGroup($model,'novase_fecha',array('widgetOptions'=>array('options'=>array('format'=>'yyyy-mm-dd'),'htmlOptions'=>array('class'=>'')), 'prepend'=>'<i class="glyphicon glyphicon-calendar"></i>')); ?>
		</div>

		<div class="col-xs-12 col-sm-6">
			<?php echo $form->timePickerGroup($model,'novase_horaInicio',array('widgetOptions' => array('noAppend' => true,'options' => array('disableFocus' => true,'showMeridian' => false),'wrapperHtmlOptions' => array('class' => ''),),'hint' => '',)); ?>
		</div>

		<div class="col-xs-12 col-sm-6">
			<?php echo $form->timePickerGroup($model,'novase_horaFin',array('widgetOptions' => array('noAppend' => true,'options' => array('disableFocus' => true,'showMeridian' => false),'wrapperHtmlOptions' => array('class' => ''),),'hint' => '',)); ?>
		</div>

		<div class="col-xs-12 col-sm-6">
			<?php echo $form->textAreaGroup($model,'novase_observaciones', array('widgetOptions'=>array('htmlOptions'=>array('rows'=>6, 'cols'=>50, 'class'=>'')))); ?>
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
					'label'=>$model->isNewRecord ? 'Crear Novedad Asesor' : 'Guardar Cambios',
				)); ?>
		</div>
	</div>
</div>

<?php $this->endWidget(); ?>
